/* Compiler/test runner only; tests use temp-tables, never business writes. */
DEFINE VARIABLE files AS CHARACTER NO-UNDO.
DEFINE VARIABLE tests AS CHARACTER NO-UNDO.
DEFINE VARIABLE i AS INTEGER NO-UNDO.
DEFINE VARIABLE j AS INTEGER NO-UNDO.
DEFINE VARIABLE cultureIndex AS INTEGER NO-UNDO.
DEFINE VARIABLE sourceFile AS CHARACTER NO-UNDO.
DEFINE VARIABLE failed AS LOGICAL NO-UNDO.
files="ContainersPainelFinanceReadService.p,ContainersPainelFinanceReadTest.p,ContainersPagamentoTotalsService.p,ContainersPagamentoTotalsTest.p,ContainersCustoCalculator.p,ContainersCustoCalculatorTest.p,ContainersCustoReadService.p,ContainersCustoReadTest.p,ContainerFinancePolicyTest.p,ContainersPainelFinanceRead.p,ContainersCustoBoundaryTest.p,ContainersCustoRead.p,ContainersVersaoCostAdapter.p,ContainersVersaoCostAdapterTest.p".
tests="ContainersPainelFinanceReadTest.p,ContainersPagamentoTotalsTest.p,ContainersCustoCalculatorTest.p,ContainersCustoReadTest.p,ContainerFinancePolicyTest.p,ContainersCustoBoundaryTest.p,ContainersVersaoCostAdapterTest.p".
OUTPUT TO "compile-container-panel-integration.log".
PUT UNFORMATTED "OpenEdge " PROVERSION SKIP.
DO i=1 TO NUM-ENTRIES(files):
 sourceFile=ENTRY(i,files).
 COMPILE VALUE(sourceFile) SAVE NO-ERROR.
 PUT UNFORMATTED sourceFile " COMPILER:ERROR=" COMPILER:ERROR SKIP.
 IF COMPILER:ERROR OR ERROR-STATUS:ERROR THEN failed=TRUE.
 DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END.
END.
OUTPUT CLOSE.
IF NOT failed THEN DO cultureIndex=1 TO 2:
 SESSION:NUMERIC-FORMAT=ENTRY(cultureIndex,"AMERICAN,EUROPEAN").
 DO i=1 TO NUM-ENTRIES(tests):
  sourceFile=ENTRY(i,tests).
  RUN VALUE(sourceFile) NO-ERROR.
  OUTPUT TO "compile-container-panel-integration.log" APPEND.
  IF ERROR-STATUS:ERROR THEN DO:
   failed=TRUE.
   PUT UNFORMATTED "FAIL " sourceFile " " SESSION:NUMERIC-FORMAT SKIP.
   DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END.
  END.
  ELSE PUT UNFORMATTED "PASS " sourceFile " " SESSION:NUMERIC-FORMAT SKIP.
  OUTPUT CLOSE.
 END.
END.
OUTPUT TO "compile-container-panel-integration.log" APPEND.
PUT UNFORMATTED (IF failed THEN "FAIL PANEL INTEGRATION" ELSE "PASS PANEL INTEGRATION") SKIP.
OUTPUT CLOSE.
QUIT.
