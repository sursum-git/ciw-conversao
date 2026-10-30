USING Progress.Json.ObjectModel.*.
BLOCK-LEVEL ON ERROR UNDO, THROW.
DEFINE TEMP-TABLE ttData
 FIELD termo_digitado AS CHARACTER FIELD termo_pesquisa AS CHARACTER FIELD ativo AS LOGICAL INITIAL YES
 INDEX pk IS PRIMARY UNIQUE termo_digitado.
DEFINE VARIABLE req AS JsonObject NO-UNDO.
DEFINE VARIABLE res AS JsonObject NO-UNDO.
DEFINE VARIABLE stamp AS CHARACTER NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE failed AS LOGICAL NO-UNDO.
DEFINE VARIABLE culture AS INTEGER NO-UNDO.
DO culture = 1 TO 2:
 n = 0.
 SESSION:NUMERIC-FORMAT = ENTRY(culture,"AMERICAN,EUROPEAN").
 OUTPUT TO VALUE("termos-crud-" + SESSION:NUMERIC-FORMAT + ".log").
 RUN check(SEARCH("sursum-api/programs/EstoqueTermosCrudService.p") <> ?, "servico disponivel").
 IF failed THEN DO: OUTPUT CLOSE. QUIT. END.
 req = NEW JsonObject(). req:Add("operation","create"). req:Add("digitado"," cambraya "). req:Add("termo_pesquisa"," cambraia ").
 RUN callService.
 RUN check(res:GetLogical("success"), "cria normalizado").
 RUN check(res:GetJsonObject("data"):GetCharacter("termo_digitado") = "CAMBRAYA", "chave normalizada").
 RUN check(res:GetJsonObject("data"):GetCharacter("termo_pesquisa") = "CAMBRAIA", "destino normalizado").
 RUN check(res:GetJsonObject("data"):GetLogical("ativo"), "ativo padrao").
 RUN check(res:GetJsonObject("audit"):GetCharacter("operation") = "create", "auditoria create").
 stamp = res:GetJsonObject("data"):GetCharacter("row_stamp").
 RUN callService. RUN rejected("duplicidade").
 req = NEW JsonObject(). req:Add("operation","update"). req:Add("id","CAMBRAYA"). req:Add("row_stamp",stamp).
 req:Add("ativo",FALSE). RUN callService.
 RUN check(res:GetLogical("success") AND NOT res:GetJsonObject("data"):GetLogical("ativo"), "desativa").
 RUN check(res:GetJsonObject("audit"):GetJsonObject("before"):GetLogical("ativo"), "snapshot anterior").
 RUN callService. RUN rejected("stamp obsoleto").
 req = NEW JsonObject(). req:Add("operation","get"). req:Add("id","CAMBRAYA"). RUN callService.
 stamp = res:GetJsonObject("data"):GetCharacter("row_stamp").
 RUN check(res:GetLogical("success"), "get").
 req = NEW JsonObject(). req:Add("operation","update"). req:Add("id","CAMBRAYA"). req:Add("row_stamp",stamp).
 req:Add("digitado","CAIMAN"). RUN callService. RUN rejected("chave imutavel").
 req = NEW JsonObject(). req:Add("operation","create"). req:Add("digitado","ELASTANO"). req:Add("termo_pesquisa","ELAST.").
 RUN callService. RUN check(res:GetLogical("success"), "aceita ponto literal").
 req = NEW JsonObject(). req:Add("operation","create"). req:Add("digitado","ABC DEF"). req:Add("termo_pesquisa","X").
 RUN callService. RUN rejected("espacos internos").
 req:Remove("digitado"). req:Add("digitado","ABC%"). RUN callService. RUN rejected("curinga").
 req:Remove("digitado"). req:Add("digitado","123"). RUN callService. RUN rejected("codigo numerico").
 req:Remove("digitado"). req:Add("digitado","X"). RUN callService. RUN rejected("igual ao destino").
 req:Remove("digitado"). req:Add("digitado","Y"). req:Add("ativo","true"). RUN callService. RUN rejected("boolean texto").
 req = NEW JsonObject(). req:Add("operation","create"). req:Add("digitado","1E3"). req:Add("termo_pesquisa","CAMBRAIA").
 RUN callService. RUN rejected("origem numerica exponencial").
 req = NEW JsonObject(). req:Add("operation","create"). req:Add("digitado","NOTA"). req:Add("termo_pesquisa","2E-2").
 RUN callService. RUN rejected("destino numerico exponencial").
 req = NEW JsonObject(). req:Add("operation","read"). RUN callService.
 RUN check(res:GetLogical("success") AND res:GetJsonArray("data"):Length = 2, "lista").
 req = NEW JsonObject(). req:Add("operation","delete"). req:Add("id","CAMBRAYA"). req:Add("row_stamp",stamp).
 RUN callService. RUN check(res:GetLogical("success"), "exclui").
 RUN check(NOT CAN-FIND(ttData WHERE termo_digitado = "CAMBRAYA"), "exclusao efetiva").
 EMPTY TEMP-TABLE ttData.
 PUT UNFORMATTED (IF failed THEN "FAIL" ELSE "PASS") " checks=" n SKIP.
 OUTPUT CLOSE.
END.
QUIT.
PROCEDURE callService:
 RUN sursum-api/programs/EstoqueTermosCrudService.p(INPUT BUFFER ttData:HANDLE,req,OUTPUT res).
END PROCEDURE.
PROCEDURE rejected:
 DEFINE INPUT PARAMETER labelText AS CHARACTER NO-UNDO.
 RUN check(NOT res:GetLogical("success") AND res:Has("error"),labelText).
END PROCEDURE.
PROCEDURE check:
 DEFINE INPUT PARAMETER ok AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER labelText AS CHARACTER NO-UNDO.
 n = n + 1.
 IF ok <> TRUE OR ok = ? THEN DO: failed = TRUE. PUT UNFORMATTED "FAIL " labelText SKIP. END.
END PROCEDURE.
