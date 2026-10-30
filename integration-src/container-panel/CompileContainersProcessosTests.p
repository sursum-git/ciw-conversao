DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE c AS INTEGER NO-UNDO.
DEFINE VARIABLE j AS INTEGER NO-UNDO.
DEFINE VARIABLE failed AS LOGICAL NO-UNDO.
DEFINE VARIABLE nameValue AS CHARACTER NO-UNDO.
OUTPUT TO "compile-containers-processes.log".
PUT UNFORMATTED "OpenEdge " PROVERSION SKIP.
DO n=1 TO 12:
 nameValue=ENTRY(n,"ContainersVersionFixture.p,ContainersVersionService.p,ContainersProcessosService.p,ContainersProcessosTest.p,ContainersProcessBoundaryTest.p,ContainersItemCustoCalculator.p,ContainersItemCustoInputsService.p,ContainersItemCustoCloseService.p,ContainersProcessosCloseTest.p,ContainersImpostosService.p,ContainersProcessosFiscalTest.p,ContainersProcessAuditTest.p").
 COMPILE VALUE(nameValue) SAVE NO-ERROR.
 PUT UNFORMATTED nameValue " COMPILER:ERROR=" COMPILER:ERROR SKIP.
 IF COMPILER:ERROR OR ERROR-STATUS:ERROR THEN failed=TRUE.
 DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END.
END.
OUTPUT CLOSE.
IF NOT failed THEN DO c=1 TO 2:
 SESSION:NUMERIC-FORMAT=ENTRY(c,"AMERICAN,EUROPEAN").
 DO n=1 TO 5:
  nameValue=ENTRY(n,"ContainersProcessosTest.r,ContainersProcessBoundaryTest.r,ContainersProcessosCloseTest.r,ContainersProcessosFiscalTest.r,ContainersProcessAuditTest.r").
  RUN VALUE(nameValue) NO-ERROR.
  OUTPUT TO "compile-containers-processes.log" APPEND.
  IF ERROR-STATUS:ERROR THEN DO:
   failed=TRUE.
   DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END.
  END.
  ELSE PUT UNFORMATTED "PASS " nameValue " " SESSION:NUMERIC-FORMAT SKIP.
  OUTPUT CLOSE.
 END.
END.
OUTPUT TO "compile-containers-processes.log" APPEND.
PUT UNFORMATTED (IF failed THEN "FAIL PROCESSES" ELSE "PASS PROCESSES") SKIP.
OUTPUT CLOSE. QUIT.
