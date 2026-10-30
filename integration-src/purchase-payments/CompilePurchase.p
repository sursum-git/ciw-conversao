DEFINE VARIABLE names AS CHARACTER NO-UNDO INITIAL "ContainersItensFinanceiroService.p,ContainersItensRuntime.p,CiwErpReadService.p,CiwCadastrosCrud.p,PurchasePaymentsApi.p,PurchasePaymentsService.p,PurchasePaymentsTest.p,PurchasePaymentsFinanceTest.p,PurchasePaymentsParentReadTest.p".
DEFINE VARIABLE i AS INTEGER NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.
OUTPUT TO "compile-purchase.log".
PUT UNFORMATTED "OpenEdge " PROVERSION " NUMDBS=" NUM-DBS SKIP.
DO i=1 TO NUM-ENTRIES(names):
 COMPILE VALUE(ENTRY(i,names)) SAVE NO-ERROR.
 PUT UNFORMATTED ENTRY(i,names) " COMPILER:ERROR=" COMPILER:ERROR SKIP.
 DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END.
END.
OUTPUT CLOSE. QUIT.
