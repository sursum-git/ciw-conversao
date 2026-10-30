/* Delimited dictionary+read probe. No endpoint, no business writes, no messages. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE buffers AS HANDLE EXTENT 8 NO-UNDO.
DEFINE VARIABLE tables AS CHARACTER NO-UNDO INITIAL 'pp-container,tipos_versao_custo,versoes_item_custo_container,item_container_custos,item_container_custo_despesas,item_container_custo_nfs,item_container_custo_pgtos,item_container_custo_descontos'.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE j AS INTEGER NO-UNDO.
DEFINE VARIABLE cid AS INTEGER NO-UNDO.
DEFINE VARIABLE vid AS INTEGER NO-UNDO.
DEFINE VARIABLE textId AS CHARACTER NO-UNDO.
DEFINE VARIABLE amount AS DECIMAL NO-UNDO.
DEFINE VARIABLE phase AS CHARACTER NO-UNDO INITIAL 'parameters'.
DEFINE VARIABLE resultValue AS JsonObject NO-UNDO.
DEFINE VARIABLE bindings AS JsonArray NO-UNDO.
DEFINE VARIABLE shapes AS JsonArray NO-UNDO.
DEFINE VARIABLE item AS JsonObject NO-UNDO.
DEFINE VARIABLE errors AS JsonArray NO-UNDO.
DEFINE VARIABLE requestValue AS JsonObject NO-UNDO.
DEFINE VARIABLE responseValue AS JsonObject NO-UNDO.
DEFINE VARIABLE policyValue AS JsonObject NO-UNDO.
DEFINE VARIABLE central AS CHARACTER NO-UNDO.
DEFINE VARIABLE adapter AS CHARACTER NO-UNDO.
DEFINE VARIABLE f AS HANDLE NO-UNDO.
DEFINE VARIABLE g AS HANDLE NO-UNDO.
{sursum-api/includes/ContainersVersionHistoryTable.i}
FUNCTION SafeId RETURNS INTEGER(s AS CHARACTER):
 DEFINE VARIABLE i AS INTEGER NO-UNDO.
 DEFINE VARIABLE v AS DECIMAL NO-UNDO.
 IF s=? OR LENGTH(s)<1 OR LENGTH(s)>10 THEN RETURN ?.
 DO i=1 TO LENGTH(s): IF INDEX('0123456789',SUBSTRING(s,i,1))=0 THEN RETURN ?. END.
 v=DECIMAL(s). IF v<1 OR v>2147483647 THEN RETURN ?. RETURN INTEGER(v).
END FUNCTION.
FUNCTION Summary RETURNS JsonObject(r AS JsonObject):
 DEFINE VARIABLE o AS JsonObject NO-UNDO.
 DEFINE VARIABLE counts AS JsonObject NO-UNDO.
 DEFINE VARIABLE snap AS JsonObject NO-UNDO.
 DEFINE VARIABLE k AS INTEGER NO-UNDO.
 DEFINE VARIABLE label AS CHARACTER NO-UNDO.
 o=NEW JsonObject(). o:Add('valid_object',VALID-OBJECT(r)).
 IF NOT VALID-OBJECT(r) THEN RETURN o.
 IF r:Has('success') THEN o:Add('success',r:GetLogical('success')).
 IF r:Has('error') THEN DO: o:Add('error_code',r:GetJsonObject('error'):GetCharacter('code')). o:Add('error_status',r:GetJsonObject('error'):GetInteger('status')). END.
 IF r:Has('data') THEN o:Add('data_type',r:GetType('data')).
 IF r:Has('snapshot') THEN DO:
  snap=r:GetJsonObject('snapshot'). counts=NEW JsonObject().
  DO k=1 TO 5: label=ENTRY(k,'items,expenses,nfs,payments,discounts'). IF snap:Has(label) THEN counts:Add(label,snap:GetJsonArray(label):Length). END.
  o:Add('snapshot_counts',counts).
 END.
 IF r:Has('diagnostic') THEN o:Add('diagnostic',CAST(r:GetJsonObject('diagnostic'):Clone(),JsonObject)).
 RETURN o.
END FUNCTION.
resultValue=NEW JsonObject(). bindings=NEW JsonArray(). shapes=NEW JsonArray().
DO ON ERROR UNDO, THROW:
 IF NUM-ENTRIES(SESSION:PARAMETER)<>2 THEN UNDO, THROW NEW Progress.Lang.AppError('Numeric context required',1).
 cid=SafeId(ENTRY(1,SESSION:PARAMETER)). vid=SafeId(ENTRY(2,SESSION:PARAMETER)).
 IF cid=? OR vid=? THEN UNDO, THROW NEW Progress.Lang.AppError('Numeric context required',1).
 IF NOT CONNECTED('espec') THEN UNDO, THROW NEW Progress.Lang.AppError('Fixed alias absent',1).
 phase='bindings'.
 DO n=1 TO 8:
  item=NEW JsonObject(). item:Add('position',n). item:Add('fixed_table',ENTRY(n,tables)).
  CREATE BUFFER buffers[n] FOR TABLE 'espec.' + ENTRY(n,tables) NO-ERROR.
  errors=NEW JsonArray(). DO j=1 TO ERROR-STATUS:NUM-MESSAGES: errors:Add(ERROR-STATUS:GET-NUMBER(j)). END. item:Add('error_numbers',errors).
  item:Add('valid_handle',VALID-HANDLE(buffers[n])).
  IF VALID-HANDLE(buffers[n]) THEN DO: item:Add('buffer_name',buffers[n]:NAME). item:Add('fields',buffers[n]:NUM-FIELDS). END.
  bindings:Add(item).
  IF NOT VALID-HANDLE(buffers[n]) THEN UNDO, THROW NEW Progress.Lang.AppError('Binding unavailable',1).
 END.
 phase='item-field-shape'.
 DO n=2 TO BUFFER ttVersionHistory:NUM-FIELDS:
  f=BUFFER ttVersionHistory:BUFFER-FIELD(n). g=buffers[4]:BUFFER-FIELD(f:NAME) NO-ERROR.
  item=NEW JsonObject(). item:Add('name',f:NAME). item:Add('tt_type',f:DATA-TYPE). item:Add('physical_handle',VALID-HANDLE(g)). IF VALID-HANDLE(g) THEN item:Add('physical_type',g:DATA-TYPE). shapes:Add(item).
 END.
 central=SEARCH('sursum-api/programs/ContainersVersionService.r'). adapter=SEARCH('HistoryReadDiagnostic.r').
 resultValue:Add('central_compiled_present',central<>?). resultValue:Add('diagnostic_compiled_present',adapter<>?).
 IF central=? OR adapter=? THEN UNDO, THROW NEW Progress.Lang.AppError('Compiled dependency absent',1).
 policyValue=NEW JsonObject(). requestValue=NEW JsonObject(). requestValue:Add('operation','consultar'). requestValue:Add('container_id',cid). requestValue:Add('versao_id',vid).
 phase='central-direct'. RUN VALUE(central)(buffers[1],buffers[2],buffers[3],buffers[4],buffers[5],buffers[6],buffers[7],buffers[8],?,policyValue,requestValue,OUTPUT responseValue).
 resultValue:Add('central',Summary(responseValue)). DELETE OBJECT responseValue.
 requestValue:Set('operation','read'). requestValue:Add('take',1).
 phase='adapter-diagnostic'. RUN VALUE(adapter)(buffers[1],buffers[2],buffers[3],buffers[4],buffers[5],buffers[6],buffers[7],buffers[8],requestValue,OUTPUT responseValue).
 resultValue:Add('adapter',Summary(responseValue)). resultValue:Add('completed',TRUE).
 CATCH e AS Progress.Lang.Error:
  resultValue:Add('completed',FALSE). errors=NEW JsonArray(). DO j=1 TO e:NumMessages: errors:Add(e:GetMessageNum(j)). END. resultValue:Add('error_numbers',errors). resultValue:Add('callstack',e:CallStack).
 END CATCH.
 FINALLY:
  resultValue:Add('last_stage',phase). resultValue:Add('bindings',bindings). resultValue:Add('item_shapes',shapes). resultValue:Add('num_dbs',NUM-DBS).
  resultValue:WriteFile('history-physical-probe.json',TRUE).
  DO n=1 TO 8: IF VALID-HANDLE(buffers[n]) THEN DELETE OBJECT buffers[n] NO-ERROR. END.
 END FINALLY.
END.
QUIT.
