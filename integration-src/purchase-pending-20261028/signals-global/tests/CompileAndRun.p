BLOCK-LEVEL ON ERROR UNDO, THROW.
DEFINE VARIABLE entries AS CHARACTER NO-UNDO.
DEFINE VARIABLE i AS INTEGER NO-UNDO.
DEFINE VARIABLE fileName AS CHARACTER NO-UNDO.
entries='sursum-api/programs/PurchaseSignalRules.p,sursum-api/programs/PurchaseSignalContainerRules.p,sursum-api/programs/CiwMedCompanyContext.p,sursum-api/programs/CiwErpReadService.p,sursum-api/programs/PurchaseSignalsCollector.p,sursum-api/programs/PurchaseSignalsService.p,sursum-api/programs/PurchaseSignalsGlobalService.p,tests/PurchaseSignalContainerRulesTest.p,tests/PurchaseSignalsGlobalServiceTest.p,tests/PurchaseSignalsServiceTest.p'.
OUTPUT TO 'compile.log'.
DO i=1 TO NUM-ENTRIES(entries):
 fileName=ENTRY(i,entries).
 COMPILE VALUE(fileName) SAVE NO-ERROR.
 IF COMPILER:ERROR THEN DO:
  PUT UNFORMATTED 'FAIL ' fileName SKIP.
  DO i=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(i) SKIP. END.
  OUTPUT CLOSE. QUIT.
 END.
 PUT UNFORMATTED 'PASS ' fileName SKIP.
END.
OUTPUT CLOSE.
RUN tests/PurchaseSignalContainerRulesTest.r.
RUN tests/PurchaseSignalsGlobalServiceTest.r.
RUN tests/PurchaseSignalsServiceTest.r.
QUIT.
