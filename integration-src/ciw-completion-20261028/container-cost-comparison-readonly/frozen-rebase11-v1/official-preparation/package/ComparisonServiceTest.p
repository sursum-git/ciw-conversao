BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE ht AS HANDLE EXTENT 8 NO-UNDO.
DEFINE VARIABLE hb AS HANDLE EXTENT 8 NO-UNDO.
DEFINE VARIABLE cFields AS CHARACTER EXTENT 8 NO-UNDO.
DEFINE VARIABLE i AS INTEGER NO-UNDO.
DEFINE VARIABLE j AS INTEGER NO-UNDO.
DEFINE VARIABLE f AS CHARACTER NO-UNDO.
DEFINE VARIABLE requestValue AS JsonObject NO-UNDO.
DEFINE VARIABLE responseValue AS JsonObject NO-UNDO.
DEFINE VARIABLE parser AS ObjectModelParser NO-UNDO.
DEFINE VARIABLE keyObject AS JsonObject NO-UNDO.
DEFINE VARIABLE keyValue AS CHARACTER NO-UNDO.
DEFINE VARIABLE keyText AS LONGCHAR NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE currencyValue AS CHARACTER NO-UNDO INITIAL 'real'.
DEFINE TEMP-TABLE ttAllocation NO-UNDO FIELD item_container_id AS INTEGER FIELD item_proc_compra_id AS INTEGER INDEX pk IS UNIQUE PRIMARY item_container_id.
DEFINE TEMP-TABLE ttPurchase NO-UNDO FIELD item_proc_compra_id AS INTEGER FIELD descricao AS CHARACTER FIELD codigo_erp AS CHARACTER INDEX pk IS UNIQUE PRIMARY item_proc_compra_id.
{ComparisonSnapshotTestTables.i}
OUTPUT TO 'comparison-service-tests.log'.
DO ON ERROR UNDO, THROW:
 RUN Check(NUM-DBS=0,'zero databases').
 cFields[1]=cFields[1] + ',cod-estabel:character'.
 DO i=1 TO 8:
  CREATE TEMP-TABLE ht[i].
  DO j=1 TO NUM-ENTRIES(cFields[i]): f=ENTRY(j,cFields[i]). ht[i]:ADD-NEW-FIELD(ENTRY(1,f,':'),ENTRY(2,f,':')). END.
  ht[i]:ADD-NEW-INDEX('pk',TRUE,TRUE). ht[i]:ADD-INDEX-FIELD('pk',ENTRY(i,'nr-container,tipo_versao_custo_id,versao_id,item_container_custo_id,despesa_id,documento,num_id_tit_ap,desconto_importacao_id')).
  ht[i]:TEMP-TABLE-PREPARE('fxComparison' + STRING(i)). hb[i]=ht[i]:DEFAULT-BUFFER-HANDLE.
 END.
 hb[1]:BUFFER-CREATE(). hb[1]:BUFFER-FIELD('nr-container'):BUFFER-VALUE=123. hb[1]:BUFFER-FIELD('cod-estabel'):BUFFER-VALUE='1GLOBAL'. hb[1]:BUFFER-RELEASE().
 hb[3]:BUFFER-CREATE(). hb[3]:BUFFER-FIELD('versao_id'):BUFFER-VALUE=7. hb[3]:BUFFER-FIELD('container_id'):BUFFER-VALUE=123. hb[3]:BUFFER-FIELD('perc_fixo_container'):BUFFER-VALUE=5. hb[3]:BUFFER-RELEASE().
 CREATE ttAllocation. ttAllocation.item_container_id=42. ttAllocation.item_proc_compra_id=43. RELEASE ttAllocation.
 CREATE ttPurchase. ttPurchase.item_proc_compra_id=43. ttPurchase.descricao='Current item'. ttPurchase.codigo_erp='SYNTHETIC'. RELEASE ttPurchase.
 DO i=1 TO 205:
  hb[4]:BUFFER-CREATE(). hb[4]:BUFFER-FIELD('item_container_custo_id'):BUFFER-VALUE=1000 + i. hb[4]:BUFFER-FIELD('versao_id'):BUFFER-VALUE=7. hb[4]:BUFFER-FIELD('item_container_id'):BUFFER-VALUE=42.
  hb[4]:BUFFER-FIELD('vl_custo_prev_real'):BUFFER-VALUE=100. hb[4]:BUFFER-FIELD('vl_desp_prev_real'):BUFFER-VALUE=20. hb[4]:BUFFER-FIELD('vl_unit_prev'):BUFFER-VALUE=12. hb[4]:BUFFER-FIELD('vl_desp_prev_real_sem_distr_cust'):BUFFER-VALUE=10.
  hb[4]:BUFFER-FIELD('vl_custo_prev_dolar'):BUFFER-VALUE=200. hb[4]:BUFFER-FIELD('vl_desp_prev_dolar'):BUFFER-VALUE=40. hb[4]:BUFFER-FIELD('vl_unit_prev_dolar'):BUFFER-VALUE=24. hb[4]:BUFFER-FIELD('vl_desp_prev_dolar_sem_distr_cus'):BUFFER-VALUE=20.
  hb[4]:BUFFER-RELEASE().
 END.
 RUN Request('read'). requestValue:Add('take',200). RUN Invoke.
 RUN Check(responseValue:GetLogical('success'),'global nonMED version context accepted').
 RUN Check(responseValue:GetInteger('total')=205 AND responseValue:GetJsonArray('data'):Length=200,'central snapshot then global page200').
 RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetDecimal('vl_unit_sem_distr_custo')=11,'BRL single persisted projector').
 RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('descricao')='Current item','current source inner join').
 keyValue=responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('record_key'). FIX-CODEPAGE(keyText)='UTF-8'. keyText=keyValue.
 parser=NEW ObjectModelParser(). keyObject=CAST(parser:Parse(keyText),JsonObject).
 RUN Check(keyObject:GetInteger('container_id')=123 AND keyObject:GetInteger('versao_id')=7 AND keyObject:GetInteger('item_container_custo_id')=1001,'full key identity').
 responseValue:WriteFile('comparison-service-actual.json',TRUE).
 RUN Request('read'). requestValue:Add('skip',200). requestValue:Add('take',200). RUN Invoke.
 RUN Check(responseValue:GetJsonArray('data'):Length=5,'page beyond200').
 currencyValue='dolar'. RUN Request('read'). requestValue:Add('take',1). RUN Invoke.
 RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetDecimal('vl_unit_sem_distr_custo')=22,'USD same service/helper').
 currencyValue='real'. RUN Request('get'). requestValue:Add('id',keyValue). requestValue:Add('record_key',keyValue). RUN Invoke.
 RUN Check(responseValue:GetLogical('success'),'get full opaque identity').
 requestValue:Set('record_key',keyValue + ' '). RUN Invoke. RUN Code(422).
 RUN Request('read'). requestValue:Set('container_id',124). RUN Invoke. RUN Code(404).
 RUN Request('read'). requestValue:Set('versao_id',8). RUN Invoke. RUN Code(404).
 RUN Request('read'). requestValue:Remove('versao_id'). RUN Invoke. RUN Code(422).
 RUN Request('read'). requestValue:Add('take',201). RUN Invoke. RUN Code(422).
 RUN Request('read'). requestValue:Add('Take',1). RUN Invoke. RUN Code(422).
 RUN Request('delete'). RUN Invoke. RUN Code(405).
 currencyValue='usd'. RUN Request('read'). RUN Invoke. RUN Code(422). currencyValue='real'.
 FIND FIRST ttAllocation. DELETE ttAllocation.
 RUN Request('read'). RUN Invoke.
 RUN Check(responseValue:GetInteger('total')=0,'deleted current join excludes source rows').
 CREATE ttAllocation. ttAllocation.item_container_id=42. ttAllocation.item_proc_compra_id=43. RELEASE ttAllocation.
 RUN Check(hb[3]:FIND-FIRST('WHERE ' + hb[3]:NAME + '.versao_id=7',NO-LOCK),'persisted version exists before orphan check').
 hb[1]:FIND-FIRST('WHERE ' + hb[1]:NAME + '.nr-container=123',NO-LOCK). hb[1]:BUFFER-DELETE().
 RUN Request('read'). RUN Invoke. RUN Code(404). /* Explicit current gate: source joins permit this orphan. */
 RUN Check(NUM-DBS=0 AND NOT TRANSACTION,'zero databases/no transaction after').
 PUT UNFORMATTED 'PASS ' checks ' checks' SKIP.
 CATCH err AS Progress.Lang.Error: PUT UNFORMATTED 'FAIL checks=' checks ' errorNumber=' err:GetMessageNum(1) SKIP. END CATCH.
END.
OUTPUT CLOSE. QUIT.
PROCEDURE Request:
 DEFINE INPUT PARAMETER operationValue AS CHARACTER NO-UNDO.
 requestValue=NEW JsonObject(). requestValue:Add('operation',operationValue). requestValue:Add('container_id',123). requestValue:Add('versao_id',7).
END PROCEDURE.
PROCEDURE Invoke:
 RUN VALUE('ContainersVersionComparisonService.p')(hb[1],hb[2],hb[3],hb[4],hb[5],hb[6],hb[7],hb[8],INPUT BUFFER ttAllocation:HANDLE,INPUT BUFFER ttPurchase:HANDLE,currencyValue,requestValue,OUTPUT responseValue).
END PROCEDURE.
PROCEDURE Code:
 DEFINE INPUT PARAMETER expectedValue AS INTEGER NO-UNDO.
 RUN Check(NOT responseValue:GetLogical('success') AND responseValue:GetJsonObject('error'):GetInteger('status')=expectedValue,'closed negative').
END PROCEDURE.
PROCEDURE Check:
 DEFINE INPUT PARAMETER okValue AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER labelValue AS CHARACTER NO-UNDO.
 checks=checks + 1. IF okValue<>TRUE OR okValue=? THEN UNDO,THROW NEW Progress.Lang.AppError(labelValue,1).
END PROCEDURE.
