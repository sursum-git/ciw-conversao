/* Trusted fixed history buffer only. No BC, ID provider, writes or ERP binding. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE INPUT PARAMETER phHistory AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER pdRunDate AS DATE NO-UNDO.
DEFINE INPUT PARAMETER piMaxReads AS INTEGER NO-UNDO.
DEFINE INPUT PARAMETER piMaxMs AS INTEGER NO-UNDO.
DEFINE OUTPUT PARAMETER poStatus AS JsonObject NO-UNDO.
DEFINE VARIABLE b AS HANDLE NO-UNDO.
DEFINE VARIABLE q AS HANDLE NO-UNDO.
DEFINE VARIABLE fieldHandle AS HANDLE NO-UNDO.
DEFINE VARIABLE selected AS JsonObject NO-UNDO.
DEFINE VARIABLE errorInfo AS JsonObject NO-UNDO.
DEFINE VARIABLE names AS CHARACTER NO-UNDO INITIAL 'hist_cotacao_bc_id,data,serie,valor,log_ok,log_manual'.
DEFINE VARIABLE types AS CHARACTER NO-UNDO INITIAL 'INTEGER,DATE,INTEGER,DECIMAL,LOGICAL,LOGICAL'.
DEFINE VARIABLE failureCode AS CHARACTER NO-UNDO INITIAL 'DAILY_CURRENCY_STATUS_INVALID'.
DEFINE VARIABLE failureStatus AS INTEGER NO-UNDO INITIAL 503.
DEFINE VARIABLE clause AS CHARACTER NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE identityValue AS INTEGER NO-UNDO.
DEFINE VARIABLE priorId AS INTEGER NO-UNDO.
DEFINE VARIABLE reads AS INTEGER NO-UNDO.
DEFINE VARIABLE startMs AS INTEGER NO-UNDO.
DEFINE VARIABLE completed AS LOGICAL NO-UNDO.
DEFINE VARIABLE prepared AS LOGICAL NO-UNDO.
startMs=ETIME(FALSE).
DO ON ERROR UNDO, THROW:
 IF NOT VALID-HANDLE(phHistory) OR pdRunDate=? OR piMaxReads<1 OR piMaxReads>50000 OR piMaxMs<1 OR piMaxMs>10000 THEN UNDO, THROW NEW Progress.Lang.AppError(failureCode,1).
 IF phHistory:TYPE<>'BUFFER' THEN UNDO, THROW NEW Progress.Lang.AppError(failureCode,1).
 CREATE BUFFER b FOR TABLE phHistory.
 DO n=1 TO NUM-ENTRIES(names):
  fieldHandle=b:BUFFER-FIELD(ENTRY(n,names)).
  IF fieldHandle:DATA-TYPE<>ENTRY(n,types) OR fieldHandle:EXTENT<>0 THEN UNDO, THROW NEW Progress.Lang.AppError(failureCode,1).
 END.
 clause='FOR EACH ' + b:NAME + ' WHERE ' + b:NAME + '.serie = 1 AND ' + b:NAME + '.data = DATE(' + TRIM(STRING(MONTH(pdRunDate))) + ',' + TRIM(STRING(DAY(pdRunDate))) + ',' + TRIM(STRING(YEAR(pdRunDate))) + ') AND (' + b:NAME + '.log_ok = TRUE OR ' + b:NAME + '.log_manual = TRUE) NO-LOCK BY ' + b:NAME + '.hist_cotacao_bc_id DESCENDING'.
 DO STOP-AFTER 10 ON STOP UNDO, LEAVE:
  CREATE QUERY q. q:SET-BUFFERS(b).
  prepared=q:QUERY-PREPARE(clause) NO-ERROR.
  IF NOT prepared OR ERROR-STATUS:ERROR THEN UNDO, THROW NEW Progress.Lang.AppError(failureCode,1).
  q:QUERY-OPEN(). failureCode='DAILY_CURRENCY_STATUS_LIMIT'.
  RUN Budget. q:GET-FIRST(NO-LOCK).
  DO WHILE NOT q:QUERY-OFF-END:
   identityValue=INTEGER(b:BUFFER-FIELD('hist_cotacao_bc_id'):BUFFER-VALUE).
   IF identityValue=? OR identityValue<=0 THEN DO: failureCode='DAILY_CURRENCY_STATUS_INVALID'. UNDO, THROW NEW Progress.Lang.AppError(failureCode,1). END.
   IF identityValue=priorId THEN DO: failureCode='DAILY_CURRENCY_STATUS_AMBIGUOUS'. failureStatus=409. UNDO, THROW NEW Progress.Lang.AppError(failureCode,1). END.
   priorId=identityValue.
   IF NOT VALID-OBJECT(selected) THEN DO:
    selected=NEW JsonObject().
    DO n=1 TO NUM-ENTRIES(names):
     fieldHandle=b:BUFFER-FIELD(ENTRY(n,names)).
     IF fieldHandle:BUFFER-VALUE=? THEN selected:AddNull(ENTRY(n,names)).
     ELSE CASE ENTRY(n,types):
      WHEN 'INTEGER' THEN selected:Add(ENTRY(n,names),INTEGER(fieldHandle:BUFFER-VALUE)).
      WHEN 'DECIMAL' THEN selected:Add(ENTRY(n,names),DECIMAL(fieldHandle:BUFFER-VALUE)).
      WHEN 'DATE' THEN selected:Add(ENTRY(n,names),ISO-DATE(DATE(fieldHandle:BUFFER-VALUE))).
      WHEN 'LOGICAL' THEN selected:Add(ENTRY(n,names),LOGICAL(fieldHandle:BUFFER-VALUE)).
     END CASE.
    END.
   END.
   RUN Budget. q:GET-NEXT(NO-LOCK).
  END.
  IF ETIME(FALSE) - startMs>piMaxMs THEN UNDO, THROW NEW Progress.Lang.AppError(failureCode,1).
  completed=TRUE.
 END.
 CATCH err AS Progress.Lang.Error:
  completed=FALSE.
 END CATCH.
 FINALLY:
  IF VALID-HANDLE(q) THEN DELETE OBJECT q NO-ERROR.
  IF VALID-HANDLE(b) THEN DELETE OBJECT b NO-ERROR.
 END FINALLY.
END.
poStatus=NEW JsonObject(). poStatus:Add('success',completed). poStatus:Add('completed',completed).
IF completed THEN DO:
 poStatus:Add('run_date',ISO-DATE(pdRunDate)). poStatus:Add('serie',1). poStatus:Add('erp_ready',FALSE).
 IF VALID-OBJECT(selected) THEN poStatus:Add('history',selected). ELSE poStatus:AddNull('history').
END.
ELSE DO:
 errorInfo=NEW JsonObject(). errorInfo:Add('code',failureCode). errorInfo:Add('status',failureStatus).
 poStatus:Add('error',errorInfo). IF VALID-OBJECT(selected) THEN DELETE OBJECT selected.
END.
PROCEDURE Budget:
 IF reads>=piMaxReads OR ETIME(FALSE) - startMs>piMaxMs THEN UNDO, THROW NEW Progress.Lang.AppError(failureCode,1).
 reads=reads + 1.
END PROCEDURE.
