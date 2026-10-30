BLOCK-LEVEL ON ERROR UNDO, THROW.
DEFINE VARIABLE files AS CHARACTER NO-UNDO INITIAL 'PurchaseItemIdService.p,PurchaseItemsService.p,ContainersItensFinanceiroService.p,ContainersItensRuntime.p,CiwErpReadService.p,CiwCadastrosCrud.p'.
DEFINE VARIABLE i AS INTEGER NO-UNDO.
DEFINE VARIABLE j AS INTEGER NO-UNDO.
PROPATH='D:/opencode/conversao-sc/integration-src/purchase-items,D:/opencode/motor-progress/v2,' + PROPATH.
OUTPUT TO 'candidate-compile.log'.
DO i=1 TO NUM-ENTRIES(files):
 COMPILE VALUE(SEARCH(ENTRY(i,files))) NO-ERROR.
 PUT UNFORMATTED ENTRY(i,files) ' ERROR=' COMPILER:ERROR SKIP.
 DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END.
END.
OUTPUT CLOSE. QUIT.
