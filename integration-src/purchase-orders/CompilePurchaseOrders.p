DEFINE VARIABLE listValue AS CHARACTER NO-UNDO INITIAL 'PurchaseOrdersService.p,ContainersItensFinanceiroService.p,ContainersItensRuntime.p,CiwErpReadService.p,CiwCadastrosCrud.p,PurchaseOrderIdService.p,PurchaseOrdersTest.p,PurchaseOrdersFinanceTest.p,PurchaseOrdersReadTest.p,PurchaseOrderIdTest.p'.
DEFINE VARIABLE i AS INTEGER NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO. DEFINE VARIABLE bad AS LOGICAL NO-UNDO.
OUTPUT TO 'compile-all-orders.log'.
DO i=1 TO NUM-ENTRIES(listValue):
 COMPILE VALUE(ENTRY(i,listValue)) SAVE NO-ERROR. PUT UNFORMATTED ENTRY(i,listValue) ' ERROR=' COMPILER:ERROR SKIP.
 IF COMPILER:ERROR THEN bad=TRUE.
 DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END.
END. OUTPUT CLOSE.
IF NOT bad THEN DO:
 SESSION:NUMERIC-FORMAT=SESSION:PARAMETER.
 RUN PurchaseOrdersTest.r. RUN PurchaseOrdersFinanceTest.r. RUN PurchaseOrdersReadTest.r. RUN PurchaseOrderIdTest.r.
END.
QUIT.
