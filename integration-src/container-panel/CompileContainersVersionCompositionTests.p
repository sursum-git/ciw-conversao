DEFINE VARIABLE i AS INTEGER NO-UNDO.
DEFINE VARIABLE j AS INTEGER NO-UNDO.
DEFINE VARIABLE filename AS CHARACTER NO-UNDO.
DEFINE VARIABLE failed AS LOGICAL NO-UNDO.
OUTPUT TO "compile-containers-version-composition.log".
PUT UNFORMATTED "OpenEdge " PROVERSION SKIP.
DO i=1 TO 10:
 filename=ENTRY(i,"ContainersCustoCalculator.p,ContainersCustoReadService.p,ContainersVersaoCostAdapter.p,ContainersPagamentoTotalsService.p,ContainersVersionAuxSnapshotService.p,ContainersVersionRuntime.p,ContainersVersionService.p,ContainersDistribuicaoCalculator.p,ContainersDistribuicaoService.p,ContainersVersionCompositionTest.p").
 COMPILE VALUE(filename) SAVE NO-ERROR.
 PUT UNFORMATTED filename " COMPILER:ERROR=" COMPILER:ERROR SKIP.
 IF COMPILER:ERROR OR ERROR-STATUS:ERROR THEN failed=TRUE.
 DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END.
END.
OUTPUT CLOSE.
IF NOT failed THEN DO i=1 TO 2:
 SESSION:NUMERIC-FORMAT=ENTRY(i,"AMERICAN,EUROPEAN"). RUN ContainersVersionCompositionTest.p NO-ERROR.
 OUTPUT TO "compile-containers-version-composition.log" APPEND.
 IF ERROR-STATUS:ERROR THEN DO: failed=TRUE. DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END. END.
 ELSE PUT UNFORMATTED "PASS " SESSION:NUMERIC-FORMAT SKIP.
 OUTPUT CLOSE.
END.
OUTPUT TO "compile-containers-version-composition.log" APPEND. PUT UNFORMATTED (IF failed THEN "FAIL COMPOSITION" ELSE "PASS COMPOSITION") SKIP. OUTPUT CLOSE. QUIT.

