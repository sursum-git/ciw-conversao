/* Read-only adapter of the central persisted-version snapshot. No calculation. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE INPUT PARAMETER phMaster AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phTypes AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phVersions AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phItems AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phExpenses AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phNfs AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phPayments AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phDiscounts AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER poRequest AS JsonObject NO-UNDO.
DEFINE OUTPUT PARAMETER poResponse AS JsonObject NO-UNDO.
{sursum-api/includes/ContainersVersionHistoryTable.i}
DEFINE VARIABLE central AS CHARACTER NO-UNDO.
DEFINE VARIABLE reader AS CHARACTER NO-UNDO.
DEFINE VARIABLE cid AS INTEGER NO-UNDO.
DEFINE VARIABLE vid AS INTEGER NO-UNDO.
DEFINE VARIABLE op AS CHARACTER CASE-SENSITIVE NO-UNDO.
DEFINE VARIABLE names AS CHARACTER EXTENT NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE j AS INTEGER NO-UNDO.
DEFINE VARIABLE fieldValue AS HANDLE NO-UNDO.
DEFINE VARIABLE rowBuffer AS HANDLE NO-UNDO.
DEFINE VARIABLE child AS JsonObject NO-UNDO.
DEFINE VARIABLE snapshot AS JsonObject NO-UNDO.
DEFINE VARIABLE persisted AS JsonArray NO-UNDO.
DEFINE VARIABLE internalRequest AS JsonObject NO-UNDO.
DEFINE VARIABLE internalResponse AS JsonObject NO-UNDO.
DEFINE VARIABLE policy AS JsonObject NO-UNDO.
DEFINE VARIABLE clean AS JsonObject NO-UNDO.
DEFINE VARIABLE complete AS LOGICAL NO-UNDO.
DEFINE VARIABLE prefix AS CHARACTER NO-UNDO.
DEFINE VARIABLE diagnosticStage AS CHARACTER NO-UNDO INITIAL "entry".
DEFINE VARIABLE diagnostic AS JsonObject NO-UNDO.
DEFINE VARIABLE diagnosticCodes AS JsonArray NO-UNDO.
DEFINE VARIABLE diagnosticNo AS INTEGER NO-UNDO.
FUNCTION Exact RETURNS LOGICAL(nameValue AS CHARACTER,listValue AS CHARACTER):
 DEFINE VARIABLE checkedValue AS CHARACTER CASE-SENSITIVE NO-UNDO.
 DEFINE VARIABLE indexValue AS INTEGER NO-UNDO.
 checkedValue=nameValue.
 DO indexValue=1 TO NUM-ENTRIES(listValue): IF checkedValue=ENTRY(indexValue,listValue) THEN RETURN TRUE. END.
 RETURN FALSE.
END FUNCTION.
FUNCTION IdValue RETURNS INTEGER(nameValue AS CHARACTER):
 DEFINE VARIABLE v AS DECIMAL NO-UNDO.
 IF NOT poRequest:Has(nameValue) OR poRequest:GetType(nameValue)<>JsonDataType:NUMBER THEN RETURN ?.
 v=poRequest:GetDecimal(nameValue).
 IF v=? OR v<1 OR v>2147483647 OR v<>TRUNCATE(v,0) THEN RETURN ?.
 RETURN INTEGER(v).
END FUNCTION.
DO ON ERROR UNDO, THROW:
 diagnosticStage='validation'.
 IF NOT VALID-OBJECT(poRequest) THEN RUN Fail('VERSION_HISTORY_REQUEST',422).
 IF NOT poRequest:Has('operation') OR poRequest:GetType('operation')<>JsonDataType:STRING THEN RUN Fail('VERSION_HISTORY_REQUEST',422).
 op=poRequest:GetCharacter('operation').
 IF op<>'read' AND op<>'get' THEN RUN Fail('VERSION_HISTORY_READ_ONLY',405).
 names=poRequest:GetNames().
 DO n=1 TO EXTENT(names):
  IF NOT Exact(names[n],IF op='get' THEN 'operation,container_id,versao_id,id,record_key' ELSE 'operation,container_id,versao_id,skip,take,filter,sort') THEN RUN Fail('VERSION_HISTORY_REQUEST',422).
 END.
 cid=IdValue('container_id'). vid=IdValue('versao_id').
 IF cid=? OR vid=? THEN RUN Fail('VERSION_HISTORY_CONTEXT',422).
 diagnosticStage='compiled-paths'.
 central=SEARCH('sursum-api/programs/ContainersVersionService.r'). reader=SEARCH('sursum-api/programs/CiwErpReadService.r').
 IF central=? OR reader=? OR NOT VALID-HANDLE(phMaster) THEN RUN Fail('VERSION_HISTORY_CONFIGURATION',503).
 diagnosticStage="master-lookup".
 DO STOP-AFTER 10 ON STOP UNDO, LEAVE:
  IF NOT phMaster:FIND-FIRST('WHERE ' + phMaster:NAME + '.nr-container=' + TRIM(STRING(cid,'->>>>>>>>>9')),NO-LOCK) THEN RUN Fail('VERSION_HISTORY_PARENT',404).
  prefix=phMaster:BUFFER-FIELD('cod-estabel'):BUFFER-VALUE.
  IF prefix=? OR LENGTH(prefix)=0 THEN RUN Fail('VERSION_HISTORY_PARENT',404).
  IF SUBSTRING(prefix,1,1)<>'5' THEN RUN Fail('VERSION_HISTORY_PARENT',404).
  internalRequest=NEW JsonObject(). internalRequest:Add('operation','consultar'). internalRequest:Add('container_id',cid). internalRequest:Add('versao_id',vid).
  policy=NEW JsonObject().
  diagnosticStage="central-call".
  RUN VALUE(central)(phMaster,phTypes,phVersions,phItems,phExpenses,phNfs,phPayments,phDiscounts,?,policy,internalRequest,OUTPUT internalResponse).
  diagnosticStage='central-success'.
  IF NOT internalResponse:GetLogical('success') THEN DO: poResponse=CAST(internalResponse:Clone(),JsonObject). RETURN. END.
  diagnosticStage='snapshot-read'.
  snapshot=internalResponse:GetJsonObject('snapshot'). persisted=snapshot:GetJsonArray('items').
  diagnosticStage="item-loop".
  DO n=1 TO persisted:Length:
   child=persisted:GetJsonObject(n).
   IF child:GetInteger('versao_id')<>vid OR child:GetInteger('item_container_custo_id')<=0 THEN RUN Fail('VERSION_HISTORY_IDENTITY',409).
   CREATE ttVersionHistory. ttVersionHistory.container_id=cid.
   rowBuffer=BUFFER ttVersionHistory:HANDLE.
   DO j=2 TO rowBuffer:NUM-FIELDS:
    diagnosticStage="item-field".
    fieldValue=rowBuffer:BUFFER-FIELD(j).
    IF NOT child:Has(fieldValue:NAME) THEN RUN Fail('VERSION_HISTORY_SNAPSHOT',503).
    IF child:IsNull(fieldValue:NAME) THEN fieldValue:BUFFER-VALUE=?.
    ELSE CASE fieldValue:DATA-TYPE:
     WHEN 'INTEGER' THEN fieldValue:BUFFER-VALUE=child:GetInteger(fieldValue:NAME).
     WHEN 'DECIMAL' THEN fieldValue:BUFFER-VALUE=child:GetDecimal(fieldValue:NAME).
     WHEN 'CHARACTER' THEN fieldValue:BUFFER-VALUE=child:GetCharacter(fieldValue:NAME).
     OTHERWISE RUN Fail('VERSION_HISTORY_CONFIGURATION',503).
    END CASE.
   END.
   RELEASE ttVersionHistory.
  END.
  diagnosticStage="reader-request".
  clean=CAST(poRequest:Clone(),JsonObject). clean:Remove('container_id'). clean:Remove('versao_id').
  diagnosticStage="reader-call".
  RUN VALUE(reader)(INPUT BUFFER ttVersionHistory:HANDLE,'container_versoes_historico_med','',clean,OUTPUT poResponse).
  diagnosticStage="reader-response".
  complete=TRUE.
 END.
 IF NOT complete THEN RUN Fail('VERSION_HISTORY_TIMEOUT',503).
 CATCH e AS Progress.Lang.Error:
  IF NOT VALID-OBJECT(poResponse) OR NOT poResponse:Has('error') THEN RUN ErrorResponse('VERSION_HISTORY_CONFIGURATION',503).
  diagnostic=NEW JsonObject(). diagnostic:Add('stage',diagnosticStage). diagnostic:Add('item_position',n). diagnostic:Add('field_position',j).
  IF VALID-HANDLE(fieldValue) THEN DO: diagnostic:Add('field_name',fieldValue:NAME). diagnostic:Add('tt_field_type',fieldValue:DATA-TYPE). END.
  diagnosticCodes=NEW JsonArray(). DO diagnosticNo=1 TO e:NumMessages: diagnosticCodes:Add(e:GetMessageNum(diagnosticNo)). END.
  diagnostic:Add('error_numbers',diagnosticCodes). diagnostic:Add('callstack',e:CallStack).
  poResponse:Add('diagnostic',diagnostic).
 END CATCH.
 FINALLY:
  IF VALID-HANDLE(phMaster) THEN phMaster:BUFFER-RELEASE() NO-ERROR.
  IF VALID-OBJECT(internalRequest) THEN DELETE OBJECT internalRequest.
  IF VALID-OBJECT(internalResponse) THEN DELETE OBJECT internalResponse.
  IF VALID-OBJECT(policy) THEN DELETE OBJECT policy.
  IF VALID-OBJECT(clean) THEN DELETE OBJECT clean.
 END FINALLY.
END.
PROCEDURE Fail:
 DEFINE INPUT PARAMETER codeValue AS CHARACTER NO-UNDO.
 DEFINE INPUT PARAMETER statusValue AS INTEGER NO-UNDO.
 RUN ErrorResponse(codeValue,statusValue).
 UNDO, THROW NEW Progress.Lang.AppError(codeValue,1).
END PROCEDURE.
PROCEDURE ErrorResponse:
 DEFINE INPUT PARAMETER codeValue AS CHARACTER NO-UNDO.
 DEFINE INPUT PARAMETER statusValue AS INTEGER NO-UNDO.
 DEFINE VARIABLE err AS JsonObject NO-UNDO.
 IF VALID-OBJECT(poResponse) THEN DELETE OBJECT poResponse.
 poResponse=NEW JsonObject(). err=NEW JsonObject(). err:Add('code',codeValue). err:Add('status',statusValue). err:Add('message','Consulta historica de versao indisponivel.').
 poResponse:Add('success',FALSE). poResponse:Add('error',err).
END PROCEDURE.
