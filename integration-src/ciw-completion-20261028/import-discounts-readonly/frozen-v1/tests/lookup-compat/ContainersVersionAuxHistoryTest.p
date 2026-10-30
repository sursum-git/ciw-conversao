/* TT only, NUM-DBS must stay zero. Never publish tests as business programs. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE TEMP-TABLE brokenMaster NO-UNDO FIELD unrelated AS INTEGER.
DEFINE VARIABLE savedMaster AS HANDLE NO-UNDO.
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
DEFINE VARIABLE resourceName AS CHARACTER CASE-SENSITIVE NO-UNDO.
DEFINE VARIABLE textValue AS LONGCHAR NO-UNDO.
DEFINE TEMP-TABLE v4Alloc NO-UNDO FIELD item_container_id AS INTEGER FIELD item_proc_compra_id AS INTEGER INDEX pk IS UNIQUE PRIMARY item_container_id.
DEFINE TEMP-TABLE v4Item NO-UNDO FIELD item_proc_compra_id AS INTEGER FIELD descricao AS CHARACTER FIELD codigo_erp AS CHARACTER INDEX pk IS UNIQUE PRIMARY item_proc_compra_id.
DEFINE TEMP-TABLE v4Emitter NO-UNDO FIELD cod-emitente AS INTEGER FIELD nome-abrev AS CHARACTER INDEX pk IS UNIQUE PRIMARY cod-emitente.
DEFINE TEMP-TABLE v4Expense NO-UNDO FIELD despesa_id AS INTEGER FIELD descricao AS CHARACTER INDEX pk IS UNIQUE PRIMARY despesa_id.
{ContainersVersionHistoryTestTables.i}
cFields[1]=cFields[1] + ',cod-estabel:character'.
DO i=1 TO 8:
 CREATE TEMP-TABLE ht[i].
 DO j=1 TO NUM-ENTRIES(cFields[i]): f=ENTRY(j,cFields[i]). ht[i]:ADD-NEW-FIELD(ENTRY(1,f,':'),ENTRY(2,f,':')). END.
 ht[i]:ADD-NEW-INDEX('pk',TRUE,TRUE).
 IF i=6 THEN DO:
  DO j=1 TO NUM-ENTRIES('versao_id,documento,serie,estab,nat_operacao,cod_emitente'): ht[i]:ADD-INDEX-FIELD('pk',ENTRY(j,'versao_id,documento,serie,estab,nat_operacao,cod_emitente')). END.
 END.
 ELSE ht[i]:ADD-INDEX-FIELD('pk',ENTRY(i,'nr-container,tipo_versao_custo_id,versao_id,item_container_custo_id,despesa_id,documento,num_id_tit_ap,desconto_importacao_id')).
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

CREATE v4Alloc. ASSIGN v4Alloc.item_container_id=999 v4Alloc.item_proc_compra_id=321. RELEASE v4Alloc.
CREATE v4Item. ASSIGN v4Item.item_proc_compra_id=321 v4Item.descricao='CURRENT DESCRIPTION'. RELEASE v4Item.
CREATE v4Emitter. ASSIGN v4Emitter.cod-emitente=1234 v4Emitter.nome-abrev='CURRENT EMITTER'. RELEASE v4Emitter.
CREATE v4Expense. ASSIGN v4Expense.despesa_id=901 v4Expense.descricao='CURRENT EXPENSE'. RELEASE v4Expense.
pathValue=SEARCH('sursum-api/programs/ContainersVersionAuxHistoryService.r').
RUN Check(pathValue<>?,'aux history compiled service available').
hb[7]:BUFFER-CREATE(). hb[7]:BUFFER-FIELD('versao_id'):BUFFER-VALUE=1001. hb[7]:BUFFER-FIELD('num_id_tit_ap'):BUFFER-VALUE=5001. hb[7]:BUFFER-FIELD('vl_real'):BUFFER-VALUE=?. hb[7]:BUFFER-FIELD('vl_dolar'):BUFFER-VALUE=0. hb[7]:BUFFER-RELEASE().
hb[8]:BUFFER-CREATE(). hb[8]:BUFFER-FIELD('versao_id'):BUFFER-VALUE=1001. hb[8]:BUFFER-FIELD('desconto_importacao_id'):BUFFER-VALUE=6001. hb[8]:BUFFER-FIELD('vl_autoriz_real'):BUFFER-VALUE=12.34. hb[8]:BUFFER-FIELD('vl_autoriz_dolar'):BUFFER-VALUE=?. hb[8]:BUFFER-RELEASE().
DO i=1 TO 2:
 hb[6]:BUFFER-CREATE(). hb[6]:BUFFER-FIELD('versao_id'):BUFFER-VALUE=1001. hb[6]:BUFFER-FIELD('documento'):BUFFER-VALUE='NF-SAME'. hb[6]:BUFFER-FIELD('serie'):BUFFER-VALUE='1'. hb[6]:BUFFER-FIELD('estab'):BUFFER-VALUE=STRING(i). hb[6]:BUFFER-FIELD('nat_operacao'):BUFFER-VALUE='3101'. hb[6]:BUFFER-FIELD('cod_emitente'):BUFFER-VALUE=1234. hb[6]:BUFFER-FIELD('vl_mercadoria'):BUFFER-VALUE=IF i=1 THEN ? ELSE 0. hb[6]:BUFFER-RELEASE().
END.
resourceName='container_versao_pagtos_historico_med'.
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001}'). RUN Invoke.
RUN Check(responseValue:GetLogical('success') AND responseValue:GetInteger('total')=1,'persisted payments row').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):IsNull('vl_real') AND responseValue:GetJsonArray('data'):GetJsonObject(1):GetDecimal('vl_dolar')=0,'payment null distinct from zero').
keyValue=responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('record_key').
RUN Parse('~{"operation":"get","container_id":123,"versao_id":1001}'). requestValue:Add('id',keyValue). requestValue:Add('record_key',keyValue). RUN Invoke.
RUN Check(responseValue:GetJsonObject('data'):GetInteger('num_id_tit_ap')=5001,'payment full-key get').
resourceName='container_versao_nfs_historico_med'.
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=2,'same document across establishments remains two rows').
keyValue=responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('record_key').
RUN Check(INDEX(keyValue,'estab')>0 AND INDEX(keyValue,'nat_operacao')>0 AND INDEX(keyValue,'cod_emitente')>0,'NF full physical key retained').
RUN Parse('~{"operation":"get","container_id":123,"versao_id":1001}'). requestValue:Add('id',keyValue). RUN Invoke.
RUN Check(responseValue:GetJsonObject('data'):GetCharacter('estab')='1','NF get selects exact establishment').
RUN Check(responseValue:GetJsonObject('data'):GetCharacter('emitente_nome_abrev_atual')='CURRENT EMITTER','NF current name projected before reader').
requestValue:Add('record_key',keyValue + ' '). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1002}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=0,'no NF from another version leaked').
resourceName='container_versao_descontos_historico_med'.
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=1 AND responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('desconto_importacao_id')=6001,'persisted discount identity').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):IsNull('vl_autoriz_dolar'),'discount unknown remains null').
keyValue=responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('record_key').
RUN Parse('~{"operation":"get","container_id":123,"versao_id":1001}'). requestValue:Add('id',keyValue). RUN Invoke.
RUN Check(responseValue:GetJsonObject('data'):GetDecimal('vl_autoriz_real')=12.34,'discount detail value retained').
RUN Parse('~{"operation":"read","container_id":456,"versao_id":1001}'). RUN Invoke. RUN Code(404).
RUN Parse('~{"operation":"update","container_id":123,"versao_id":1001}'). RUN Invoke. RUN Code(405).
DO i=1 TO 4:
 hb[5]:BUFFER-CREATE(). hb[5]:BUFFER-FIELD('versao_id'):BUFFER-VALUE=1001. hb[5]:BUFFER-FIELD('despesa_id'):BUFFER-VALUE=900 + i.
 hb[5]:BUFFER-FIELD('vl_prev'):BUFFER-VALUE=IF i=1 THEN 12.34 ELSE IF i=2 THEN 0 ELSE IF i=3 THEN -1 ELSE ?.
 hb[5]:BUFFER-FIELD('vl_base_imp'):BUFFER-VALUE=?. hb[5]:BUFFER-FIELD('vl_negociado'):BUFFER-VALUE=10. hb[5]:BUFFER-FIELD('log_custo'):BUFFER-VALUE=?. hb[5]:BUFFER-RELEASE().
END.
resourceName='container_versao_despesas_historico_med'.
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=1,'expenses require positive known prior value').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetDecimal('vl_prev')=12.34,'singleton SQL SUM equals persisted value').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):IsNull('vl_base_imp') AND responseValue:GetJsonArray('data'):GetJsonObject(1):IsNull('log_custo'),'expense nulls and unknown group flag preserved').
keyValue=responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('record_key').
RUN Parse('~{"operation":"get","container_id":123,"versao_id":1001}'). requestValue:Add('id',keyValue). RUN Invoke.
RUN Check(responseValue:GetJsonObject('data'):GetInteger('despesa_id')=901,'expense physical key get without nullable group flag').
RUN Check(responseValue:GetJsonObject('data'):GetCharacter('despesa_descricao_atual')='CURRENT EXPENSE','expense current description projected').
RUN Parse('~{"operation":"read","container_id":1,"versao_id":1001}'). RUN Invoke. RUN Code(404).
RUN Check(responseValue:GetJsonObject('error'):GetCharacter('code')='VERSION_HISTORY_PARENT','missing parent absence is not a configuration error').
RUN Check(NOT responseValue:Has('data'),'missing parent returns no partial data').
savedMaster=hb[1]. hb[1]=BUFFER brokenMaster:HANDLE.
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001}'). RUN Invoke. RUN Code(503).
hb[1]=savedMaster.
FIND v4Emitter WHERE v4Emitter.cod-emitente=1234. DELETE v4Emitter.
resourceName='container_versao_nfs_historico_med'. RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001}'). RUN Invoke.
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):IsNull('emitente_nome_abrev_atual') AND responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('cod_emitente')=1234,'deleted emitter preserves physical historical ID').
FIND v4Expense WHERE v4Expense.despesa_id=901. DELETE v4Expense.
resourceName='container_versao_despesas_historico_med'. RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001}'). RUN Invoke.
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):IsNull('despesa_descricao_atual') AND responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('despesa_id')=901,'deleted expense label does not hide history').
resourceName='arbitrary'. RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001}'). RUN Invoke. RUN Code(422).
RUN Check(NUM-DBS=0 AND NOT TRANSACTION,'aux projections use TT only').
OUTPUT TO 'container-version-aux-history-tests.log'. PUT UNFORMATTED 'PASS ' checks ' NUMDBS=' NUM-DBS SKIP. OUTPUT CLOSE.
DO i=1 TO 8: DELETE OBJECT ht[i] NO-ERROR. END.
RETURN.
PROCEDURE Parse:
 DEFINE INPUT PARAMETER valueText AS LONGCHAR NO-UNDO.
 DEFINE VARIABLE p AS ObjectModelParser NO-UNDO.
 DEFINE VARIABLE utf8Value AS LONGCHAR NO-UNDO.
 FIX-CODEPAGE(utf8Value)='UTF-8'. utf8Value=valueText.
 p=NEW ObjectModelParser(). requestValue=CAST(p:Parse(utf8Value),JsonObject). DELETE OBJECT p.
END PROCEDURE.
PROCEDURE Invoke:
 RUN VALUE(pathValue)(hb[1],hb[2],hb[3],hb[4],hb[5],hb[6],hb[7],hb[8],resourceName,INPUT BUFFER v4Emitter:HANDLE,INPUT BUFFER v4Expense:HANDLE,requestValue,OUTPUT responseValue).
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
