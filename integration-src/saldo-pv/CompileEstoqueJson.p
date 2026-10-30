DEFINE VARIABLE i AS INTEGER NO-UNDO.
DEFINE VARIABLE j AS INTEGER NO-UNDO.
DEFINE VARIABLE nameSource AS CHARACTER NO-UNDO.
DEFINE VARIABLE failed AS LOGICAL NO-UNDO.
OUTPUT TO "estoque-json-compile.log".
PUT UNFORMATTED "OpenEdge " PROVERSION SKIP.
DO i = 1 TO NUM-ENTRIES("esapi/estoque/EstoqueJsonParser.p,esapi/estoque/EstoqueUsuarioEscopo.p,http-api/api_cons_estoque.p"):
 nameSource = ENTRY(i,"esapi/estoque/EstoqueJsonParser.p,esapi/estoque/EstoqueUsuarioEscopo.p,http-api/api_cons_estoque.p").
 COMPILE VALUE(nameSource) SAVE XREF VALUE("estoque-json-compile-" + STRING(i) + ".xref") NO-ERROR.
 PUT UNFORMATTED nameSource " COMPILER:ERROR=" COMPILER:ERROR SKIP.
 IF COMPILER:ERROR OR ERROR-STATUS:ERROR THEN failed = TRUE.
 DO j = 1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END.
END.
PUT UNFORMATTED (IF failed THEN "FAIL" ELSE "PASS") SKIP.
OUTPUT CLOSE.
QUIT.
