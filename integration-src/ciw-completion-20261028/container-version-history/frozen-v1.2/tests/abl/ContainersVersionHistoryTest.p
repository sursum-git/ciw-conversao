/* TT only, NUM-DBS must stay zero. Never publish tests as business programs. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE ht AS HANDLE EXTENT 8 NO-UNDO.
DEFINE VARIABLE hb AS HANDLE EXTENT 8 NO-UNDO.
DEFINE VARIABLE cFields AS CHARACTER EXTENT 8 NO-UNDO.
DEFINE VARIABLE i AS INTEGER NO-UNDO.
DEFINE VARIABLE j AS INTEGER NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE f AS CHARACTER NO-UNDO.
DEFINE VARIABLE pathValue AS CHARACTER NO-UNDO.
DEFINE VARIABLE requestValue AS JsonObject NO-UNDO.
DEFINE VARIABLE responseValue AS JsonObject NO-UNDO.
DEFINE VARIABLE policyValue AS JsonObject NO-UNDO.
DEFINE VARIABLE parser AS ObjectModelParser NO-UNDO.
DEFINE VARIABLE keyValue AS CHARACTER NO-UNDO.
DEFINE VARIABLE textValue AS LONGCHAR NO-UNDO.
{ContainersVersionHistoryTestTables.i}
cFields[1]=cFields[1] + ',cod-estabel:character'.
DO i=1 TO 8:
 CREATE TEMP-TABLE ht[i].
 DO j=1 TO NUM-ENTRIES(cFields[i]): f=ENTRY(j,cFields[i]). ht[i]:ADD-NEW-FIELD(ENTRY(1,f,':'),ENTRY(2,f,':')). END.
 ht[i]:ADD-NEW-INDEX('pk',TRUE,TRUE).
 ht[i]:ADD-INDEX-FIELD('pk',ENTRY(i,'nr-container,tipo_versao_custo_id,versao_id,item_container_custo_id,despesa_id,documento,num_id_tit_ap,desconto_importacao_id')).
 ht[i]:TEMP-TABLE-PREPARE('fxHistory' + STRING(i)). hb[i]=ht[i]:DEFAULT-BUFFER-HANDLE.
END.
hb[1]:BUFFER-CREATE(). hb[1]:BUFFER-FIELD('nr-container'):BUFFER-VALUE=123. hb[1]:BUFFER-FIELD('cod-estabel'):BUFFER-VALUE='5TEST'. hb[1]:BUFFER-RELEASE().
hb[1]:BUFFER-CREATE(). hb[1]:BUFFER-FIELD('nr-container'):BUFFER-VALUE=456. hb[1]:BUFFER-FIELD('cod-estabel'):BUFFER-VALUE='1TEST'. hb[1]:BUFFER-RELEASE().
DO i=1001 TO 1004:
 hb[3]:BUFFER-CREATE(). hb[3]:BUFFER-FIELD('versao_id'):BUFFER-VALUE=i. hb[3]:BUFFER-FIELD('container_id'):BUFFER-VALUE=IF i=1003 THEN 456 ELSE 123. hb[3]:BUFFER-RELEASE().
END.
DO i=1 TO 205:
 hb[4]:BUFFER-CREATE(). hb[4]:BUFFER-FIELD('item_container_custo_id'):BUFFER-VALUE=2000 + i. hb[4]:BUFFER-FIELD('versao_id'):BUFFER-VALUE=1001.
 /* Same item ID is legal: the real PK is the persisted cost-item ID. */
 hb[4]:BUFFER-FIELD('item_container_id'):BUFFER-VALUE=999. hb[4]:BUFFER-FIELD('it_codigo'):BUFFER-VALUE='ITEM'.
 hb[4]:BUFFER-FIELD('vl_unit_realiz'):BUFFER-VALUE=IF i=1 THEN ? ELSE 0.
 hb[4]:BUFFER-FIELD('qt_embarcada'):BUFFER-VALUE=12.34.
 hb[4]:BUFFER-FIELD('vl_desconto_utiliz_real'):BUFFER-VALUE=' 1.234,50 original '.
 hb[4]:BUFFER-RELEASE().
END.
hb[4]:BUFFER-CREATE(). hb[4]:BUFFER-FIELD('item_container_custo_id'):BUFFER-VALUE=3001. hb[4]:BUFFER-FIELD('versao_id'):BUFFER-VALUE=1002. hb[4]:BUFFER-FIELD('item_container_id'):BUFFER-VALUE=999. hb[4]:BUFFER-RELEASE().
pathValue=SEARCH('sursum-api/programs/ContainersVersionHistoryService.r').
RUN Check(pathValue<>?,'history compiled service available').
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001,"take":200}'). RUN Invoke.
RUN Check(responseValue:GetLogical('success'),'read succeeds').
RUN Check(responseValue:GetInteger('total')=205 AND responseValue:GetJsonArray('data'):Length=200,'global total and max page').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):IsNull('vl_unit_realiz'),'historical null retained').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(2):GetDecimal('vl_unit_realiz')=0,'historical zero distinct').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('vl_desconto_utiliz_real')=' 1.234,50 original ','original character amount retained').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetDecimal('qt_embarcada')=12.34,'physical quantity retained').
keyValue=responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('record_key').
FIX-CODEPAGE(textValue)='UTF-8'.
parser=NEW ObjectModelParser(). textValue=keyValue. policyValue=CAST(parser:Parse(textValue),JsonObject).
RUN Check(policyValue:GetInteger('container_id')=123 AND policyValue:GetInteger('versao_id')=1001 AND policyValue:GetInteger('item_container_custo_id')=2001,'full persisted identity').
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001,"skip":200,"take":200}'). RUN Invoke.
RUN Check(responseValue:GetJsonArray('data'):Length=5,'page beyond first 200').
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001,"filter":~{"field":"item_container_custo_id","operator":"eq","value":2205}}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=1 AND responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('item_container_custo_id')=2205,'filter finds item beyond first page').
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001,"sort":[~{"field":"item_container_custo_id","dir":"desc"}],"take":1}'). RUN Invoke.
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('item_container_custo_id')=2205,'global sort before page').
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001,"filter":~{"field":"vl_unit_realiz","operator":"isnull"}}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=1,'null filter does not match zero').
RUN Parse('~{"operation":"get","container_id":123,"versao_id":1001}'). requestValue:Add('id',keyValue). requestValue:Add('record_key',keyValue). RUN Invoke.
RUN Check(responseValue:GetLogical('success') AND responseValue:GetJsonObject('data'):GetInteger('item_container_custo_id')=2001,'strict equal key alias succeeds').
requestValue:Set('record_key',keyValue + ' '). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"get","container_id":123,"versao_id":1002}'). requestValue:Add('id',keyValue). RUN Invoke. RUN Code(404).
RUN Parse('~{"operation":"read","container_id":456,"versao_id":1003}'). RUN Invoke. RUN Code(404).
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1003}'). RUN Invoke. RUN Code(404).
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1004}'). RUN Invoke. RUN Check(responseValue:GetInteger('total')=0,'empty persisted version is empty').
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001,"take":201}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001,"Take":10}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","container_id":123}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001.5}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"update","container_id":123,"versao_id":1001}'). RUN Invoke. RUN Code(405).
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001,"read_max_rows":1}'). RUN Invoke. RUN Code(422).
/* The trusted internal ceiling can only lower 50000. Public requests cannot set it. */
RUN Parse('~{"operation":"consultar","container_id":123,"versao_id":1001}').
policyValue=NEW JsonObject(). policyValue:Add('read_max_rows',2).
pathValue=SEARCH('sursum-api/programs/ContainersVersionService.r').
RUN InvokeCentral.
RUN Check(NOT responseValue:GetLogical('success') AND responseValue:GetJsonObject('error'):GetCharacter('code')='VERSION_READ_LIMIT','central aggregate budget fails closed').
RUN Check(NOT responseValue:Has('data') AND NOT responseValue:Has('snapshot') AND NOT responseValue:Has('audit'),'no partial data or business audit').
policyValue:Set('read_max_rows',50001). RUN InvokeCentral. RUN Code(503).
RUN Check(NUM-DBS=0 AND NOT TRANSACTION,'TT only and no transaction left').
OUTPUT TO 'container-version-history-tests.log'. PUT UNFORMATTED 'PASS ' checks ' NUMDBS=' NUM-DBS SKIP. OUTPUT CLOSE.
DO i=1 TO 8: DELETE OBJECT ht[i] NO-ERROR. END.
RETURN.
PROCEDURE Parse:
 DEFINE INPUT PARAMETER valueText AS LONGCHAR NO-UNDO.
 DEFINE VARIABLE p AS ObjectModelParser NO-UNDO.
 p=NEW ObjectModelParser(). requestValue=CAST(p:Parse(valueText),JsonObject). DELETE OBJECT p.
END PROCEDURE.
PROCEDURE Invoke:
 RUN VALUE(pathValue)(hb[1],hb[2],hb[3],hb[4],hb[5],hb[6],hb[7],hb[8],requestValue,OUTPUT responseValue).
END PROCEDURE.
PROCEDURE InvokeCentral:
 RUN VALUE(pathValue)(hb[1],hb[2],hb[3],hb[4],hb[5],hb[6],hb[7],hb[8],?,policyValue,requestValue,OUTPUT responseValue).
END PROCEDURE.
PROCEDURE Code:
 DEFINE INPUT PARAMETER expected AS INTEGER NO-UNDO.
 RUN Check(NOT responseValue:GetLogical('success') AND responseValue:GetJsonObject('error'):GetInteger('status')=expected,'expected rejection ' + STRING(expected)).
END PROCEDURE.
PROCEDURE Check:
 DEFINE INPUT PARAMETER conditionValue AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER messageValue AS CHARACTER NO-UNDO.
 IF conditionValue<>TRUE THEN UNDO, THROW NEW Progress.Lang.AppError(messageValue,1).
 checks=checks + 1.
END PROCEDURE.
