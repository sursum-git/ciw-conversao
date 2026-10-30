/* Shared readonly forecast collector. SQL SUM semantics: skip unknown terms;
   empty/all-unknown sum is zero. No rounding per item, tax rule or persistence. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
DEFINE INPUT PARAMETER phItems AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phExpenses AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER piOrder AS INTEGER NO-UNDO.
DEFINE INPUT PARAMETER pdExchange AS DECIMAL NO-UNDO.
DEFINE INPUT PARAMETER piContainers AS INTEGER NO-UNDO.
DEFINE OUTPUT PARAMETER pdItems AS DECIMAL DECIMALS 10 NO-UNDO.
DEFINE OUTPUT PARAMETER pdExpenseBase AS DECIMAL DECIMALS 10 NO-UNDO.
DEFINE OUTPUT PARAMETER pdExpenses AS DECIMAL DECIMALS 10 NO-UNDO.
DEFINE VARIABLE q AS HANDLE NO-UNDO. DEFINE VARIABLE h AS HANDLE NO-UNDO.
DEFINE VARIABLE amountTerm AS DECIMAL DECIMALS 10 NO-UNDO.
DEFINE VARIABLE pass AS INTEGER NO-UNDO. DEFINE VARIABLE scanned AS INTEGER NO-UNDO.
DEFINE VARIABLE started AS INTEGER NO-UNDO. DEFINE VARIABLE complete AS LOGICAL NO-UNDO.
IF NOT VALID-HANDLE(phItems) OR NOT VALID-HANDLE(phExpenses) OR piOrder=? OR piOrder<1 THEN UNDO, THROW NEW Progress.Lang.AppError('Invalid forecast context',1).
ASSIGN pdItems=0 pdExpenseBase=0 pdExpenses=0 started=ETIME.
DO ON ERROR UNDO, THROW:
 DO STOP-AFTER 10 ON STOP UNDO, LEAVE:
  DO pass=1 TO 2:
   h=IF pass=1 THEN phItems ELSE phExpenses.
   CREATE QUERY q. q:SET-BUFFERS(h).
   IF NOT q:QUERY-PREPARE('FOR EACH ' + h:NAME + ' WHERE proc_compra_id=' + TRIM(STRING(piOrder,'->>>>>>>>>9')) + ' NO-LOCK') THEN UNDO, THROW NEW Progress.Lang.AppError('Forecast query unavailable',1).
   q:QUERY-OPEN(). q:GET-FIRST(NO-LOCK).
   DO WHILE NOT q:QUERY-OFF-END:
    scanned=scanned + 1.
    IF scanned>50000 OR ETIME - started>10000 THEN UNDO, THROW NEW Progress.Lang.AppError('Forecast limit exceeded',1).
    IF pass=1 THEN DO:
     amountTerm=pdExchange * DECIMAL(h:BUFFER-FIELD('qt_comprada'):BUFFER-VALUE) * DECIMAL(h:BUFFER-FIELD('vl_negociado'):BUFFER-VALUE).
     IF amountTerm<>? THEN pdItems=pdItems + amountTerm.
    END.
    ELSE DO:
     amountTerm=h:BUFFER-FIELD('vl_prev'):BUFFER-VALUE.
     IF amountTerm<>? THEN pdExpenseBase=pdExpenseBase + amountTerm.
    END.
    q:GET-NEXT(NO-LOCK).
   END.
   q:QUERY-CLOSE(). DELETE OBJECT q.
  END.
  complete=TRUE.
 END.
 IF NOT complete THEN UNDO, THROW NEW Progress.Lang.AppError('Forecast timeout',1).
 pdExpenses=pdExpenseBase * (IF piContainers=? THEN 0 ELSE piContainers).
 FINALLY: IF VALID-HANDLE(q) THEN DELETE OBJECT q NO-ERROR. END FINALLY.
END.
