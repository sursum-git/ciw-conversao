DEFINE VARIABLE i AS INTEGER NO-UNDO.
DEFINE VARIABLE j AS INTEGER NO-UNDO.
DEFINE VARIABLE nameSource AS CHARACTER NO-UNDO.
DEFINE VARIABLE failed AS LOGICAL NO-UNDO.
OUTPUT TO "estoque-termos-compile.log".
PUT UNFORMATTED "OpenEdge " PROVERSION SKIP.
DO i = 1 TO NUM-ENTRIES("esbo/normalizarPesquisaEstoque.p,esbo/boSaldoPV.p,sursum-api/programs/EstoqueTermosCrudService.p,sursum-api/programs/CiwCadastrosCrud.p"):
 nameSource = ENTRY(i,"esbo/normalizarPesquisaEstoque.p,esbo/boSaldoPV.p,sursum-api/programs/EstoqueTermosCrudService.p,sursum-api/programs/CiwCadastrosCrud.p").
 COMPILE VALUE(nameSource) SAVE XREF VALUE("estoque-termos-" + STRING(i) + ".xref") NO-ERROR.
 PUT UNFORMATTED nameSource " COMPILER:ERROR=" COMPILER:ERROR SKIP.
 IF COMPILER:ERROR OR ERROR-STATUS:ERROR THEN failed = TRUE.
 DO j = 1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END.
END.
PUT UNFORMATTED (IF failed THEN "FAIL" ELSE "PASS") SKIP.
OUTPUT CLOSE.
QUIT.
