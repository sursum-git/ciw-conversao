/* TT only. No DB aliases, no business or runtime callbacks. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE ht AS HANDLE EXTENT 8 NO-UNDO.
DEFINE VARIABLE hb AS HANDLE EXTENT 8 NO-UNDO.
DEFINE VARIABLE cFields AS CHARACTER EXTENT 8 NO-UNDO.
DEFINE VARIABLE i AS INTEGER NO-UNDO.
DEFINE VARIABLE j AS INTEGER NO-UNDO.
DEFINE VARIABLE f AS CHARACTER NO-UNDO.
DEFINE VARIABLE requestValue AS JsonObject NO-UNDO.
DEFINE VARIABLE policyValue AS JsonObject NO-UNDO.
DEFINE VARIABLE responseValue AS JsonObject NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE countValue AS INTEGER NO-UNDO.
DEFINE VARIABLE boundaryRejected AS LOGICAL NO-UNDO.
DEFINE VARIABLE parentFound AS LOGICAL NO-UNDO.
{sursum-api/includes/ContainerProcessBoundary.i}
{ComparisonSnapshotTestTables.i}
OUTPUT TO 'orphan-read-policy-tests.log'.
DO ON ERROR UNDO, THROW:
 RUN Check(NUM-DBS=0 AND NOT TRANSACTION,'zero databases/transaction').
 DO i=1 TO 8:
  CREATE TEMP-TABLE ht[i].
  DO j=1 TO NUM-ENTRIES(cFields[i]): f=ENTRY(j,cFields[i]). ht[i]:ADD-NEW-FIELD(ENTRY(1,f,':'),ENTRY(2,f,':')). END.
  ht[i]:ADD-NEW-INDEX('pk',TRUE,TRUE). ht[i]:ADD-INDEX-FIELD('pk',ENTRY(i,'nr-container,tipo_versao_custo_id,versao_id,item_container_custo_id,despesa_id,documento,num_id_tit_ap,desconto_importacao_id')).
  ht[i]:TEMP-TABLE-PREPARE('fxOrphan' + STRING(i)). hb[i]=ht[i]:DEFAULT-BUFFER-HANDLE.
 END.
 hb[3]:BUFFER-CREATE(). hb[3]:BUFFER-FIELD('versao_id'):BUFFER-VALUE=7. hb[3]:BUFFER-FIELD('container_id'):BUFFER-VALUE=123. hb[3]:BUFFER-FIELD('descricao'):BUFFER-VALUE='persisted orphan'. hb[3]:BUFFER-RELEASE().
 hb[4]:BUFFER-CREATE(). hb[4]:BUFFER-FIELD('item_container_custo_id'):BUFFER-VALUE=1001. hb[4]:BUFFER-FIELD('versao_id'):BUFFER-VALUE=7. hb[4]:BUFFER-FIELD('item_container_id'):BUFFER-VALUE=42.
 hb[4]:BUFFER-FIELD('vl_unit_realiz'):BUFFER-VALUE=?. hb[4]:BUFFER-FIELD('vl_pago_real'):BUFFER-VALUE=0. hb[4]:BUFFER-RELEASE().
 RUN Request. policyValue=NEW JsonObject(). RUN Invoke. RUN Code(404).
 RUN Check(responseValue:GetJsonObject('error'):GetCharacter('code')='VERSION_NOT_FOUND','default old behavior preserved').
 policyValue:Add('read_require_master',TRUE). RUN Invoke. RUN Code(404).
 policyValue:Set('read_require_master',FALSE). RUN Invoke.
 RUN Check(responseValue:GetLogical('success'),'private selected-version read accepts real orphan snapshot').
 RUN Check(responseValue:GetJsonObject('data'):GetInteger('container_id')=123 AND responseValue:GetJsonObject('data'):GetInteger('versao_id')=7,'identity unchanged').
 RUN Check(responseValue:GetJsonObject('snapshot'):GetJsonArray('items'):Length=1,'one persisted item from shared collector').
 RUN Check(responseValue:GetJsonObject('snapshot'):GetJsonArray('items'):GetJsonObject(1):GetInteger('item_container_custo_id')=1001,'physical child identity preserved').
 RUN Check(responseValue:GetJsonObject('snapshot'):GetJsonArray('items'):GetJsonObject(1):IsNull('vl_unit_realiz'),'NULL preserved').
 RUN Check(responseValue:GetJsonObject('snapshot'):GetJsonArray('items'):GetJsonObject(1):GetDecimal('vl_pago_real')=0,'zero distinct from NULL').
 RUN Check(NOT responseValue:Has('audit') AND NOT responseValue:Has('committed'),'readonly has no commit/audit').
 parentFound=hb[1]:FIND-FIRST() NO-ERROR.
 RUN Check(NOT parentFound,'no parent fabricated').
 /* Real old HTTP-facing service receives the untrusted request unchanged. */
 requestValue:Set('operation','read').
 RUN VALUE('sursum-api/programs/ContainersVersionHistoryService.r')(hb[1],hb[2],hb[3],hb[4],hb[5],hb[6],hb[7],hb[8],?,?,requestValue,OUTPUT responseValue).
 RUN Code(404).
 requestValue:Add('read_require_master',FALSE).
 RUN VALUE('sursum-api/programs/ContainersVersionHistoryService.r')(hb[1],hb[2],hb[3],hb[4],hb[5],hb[6],hb[7],hb[8],?,?,requestValue,OUTPUT responseValue).
 RUN Code(422).
 RUN Request.
 requestValue:Set('container_id',124). RUN Invoke. RUN Code(404).
 RUN Request. requestValue:Set('versao_id',8). RUN Invoke. RUN Code(404).
 RUN Request. requestValue:Remove('versao_id'). RUN Invoke. RUN Code(503).
 RUN Request. policyValue:Set('read_require_master','false'). RUN Invoke. RUN Code(503).
 policyValue:Remove('read_require_master'). policyValue:AddNull('read_require_master'). RUN Invoke. RUN Code(503).
 policyValue:Remove('read_require_master'). policyValue:Add('read_require_master',0). RUN Invoke. RUN Code(503).
 policyValue:Set('read_require_master',FALSE). policyValue:Add('read_max_rows',1). RUN Invoke. RUN Code(503).
 RUN Check(NOT responseValue:Has('snapshot'),'limit never returns partial snapshot').
 policyValue:Set('read_max_rows',2). RUN Invoke. RUN Check(responseValue:GetLogical('success'),'budget exactly version plus one child').
 policyValue=NEW JsonObject(). RUN Request. requestValue:Add('read_require_master',FALSE). RUN Invoke. RUN Code(422).
 requestValue:Remove('read_require_master'). requestValue:Add('policy',NEW JsonObject()). RUN Invoke. RUN Code(422).
 RUN Request. requestValue:Set('operation','excluir_incompleta'). requestValue:Add('expected_latest_version_id',7).
 policyValue=NEW JsonObject(). policyValue:Add('read_require_master',FALSE). RUN Invoke. RUN Code(503).
 RUN Check(hb[3]:FIND-FIRST() AND hb[4]:FIND-FIRST(),'policy cannot delete version/child').
 hb[1]:BUFFER-CREATE(). hb[1]:BUFFER-FIELD('nr-container'):BUFFER-VALUE=123. hb[1]:BUFFER-RELEASE().
 RUN Request. policyValue=NEW JsonObject(). RUN Invoke. RUN Check(responseValue:GetLogical('success'),'old selected read with real parent intact').
 requestValue:Remove('versao_id'). RUN Invoke. RUN Check(responseValue:GetLogical('success') AND responseValue:GetJsonArray('data'):Length=1,'old list intact').
 policyValue:Add('read_require_master',TRUE). RUN Invoke. RUN Check(responseValue:GetLogical('success'),'explicit default true list intact').
 /* Actual writer boundary include, no HTTP adapter mock and no side effects. */
 requestValue=NEW JsonObject(). requestValue:Add('resource','versoes'). requestValue:Add('operation','gerar'). requestValue:Add('container_id',123).
 requestValue:Add('tipo_versao_id',1). requestValue:Add('descricao','not executed'). requestValue:Add('expected_latest_version_id',7).
 requestValue:Add('read_require_master',FALSE). boundaryRejected=FALSE.
 DO ON ERROR UNDO, THROW:
  countValue=ContainerProcessRequest(requestValue).
  CATCH boundaryError AS Progress.Lang.Error: boundaryRejected=TRUE. END CATCH.
 END.
 RUN Check(boundaryRejected,'real process boundary rejects raw optin payload').
 RUN Check(NUM-DBS=0 AND NOT TRANSACTION,'zero databases/transaction after').
 PUT UNFORMATTED 'PASS ' checks ' checks' SKIP.
 CATCH err AS Progress.Lang.Error: PUT UNFORMATTED 'FAIL checks=' checks ' errorNumber=' err:GetMessageNum(1) ' label=' err:GetMessage(1) SKIP. END CATCH.
END.
OUTPUT CLOSE. QUIT.
PROCEDURE Request:
 requestValue=NEW JsonObject(). requestValue:Add('operation','consultar'). requestValue:Add('container_id',123). requestValue:Add('versao_id',7).
END PROCEDURE.
PROCEDURE Invoke:
 RUN VALUE('sursum-api/programs/ContainersVersionService.r')(hb[1],hb[2],hb[3],hb[4],hb[5],hb[6],hb[7],hb[8],?,policyValue,requestValue,OUTPUT responseValue).
END PROCEDURE.
PROCEDURE Code:
 DEFINE INPUT PARAMETER statusValue AS INTEGER NO-UNDO.
 RUN Check(NOT responseValue:GetLogical('success') AND responseValue:GetJsonObject('error'):GetInteger('status')=statusValue,'closed negative ' + STRING(statusValue)).
END PROCEDURE.
PROCEDURE Check:
 DEFINE INPUT PARAMETER okValue AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER labelValue AS CHARACTER NO-UNDO.
 checks=checks + 1. IF okValue<>TRUE OR okValue=? THEN UNDO,THROW NEW Progress.Lang.AppError(labelValue,1).
END PROCEDURE.
