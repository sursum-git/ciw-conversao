USING Progress.Json.ObjectModel.*.
BLOCK-LEVEL ON ERROR UNDO, THROW.
DEFINE VARIABLE requestJSON AS JsonObject NO-UNDO.
DEFINE VARIABLE responseJSON AS JsonObject NO-UNDO.
DEFINE VARIABLE c AS CHARACTER NO-UNDO.
IF NUM-DBS <> 1 OR INDEX(PDBNAME(1),"api-wp-notas-20261020/wpfixture") = 0 THEN
 UNDO, THROW NEW Progress.Lang.AppError("Somente fixture isolada",0).
requestJSON = NEW JsonObject().
requestJSON:Add("login","TEST-API").
requestJSON:Add("clienteIni",1.5).
RUN http-api/api_cons_nota_fiscal_wp.p(requestJSON, OUTPUT responseJSON).
IF responseJSON:GetLogical("success") OR NOT responseJSON:Has("error") THEN
 UNDO, THROW NEW Progress.Lang.AppError("API deve rejeitar tipo antes de consultar",0).
IF CAN-FIND(FIRST espec.wp) THEN UNDO, THROW NEW Progress.Lang.AppError("API invalida gravou dados",0).
requestJSON:Remove("clienteIni").
RUN http-api/api_cons_nota_fiscal_wp.p(requestJSON, OUTPUT responseJSON).
IF NOT responseJSON:GetLogical("success") THEN UNDO, THROW NEW Progress.Lang.AppError(responseJSON:GetCharacter("error"),0).
c = responseJSON:GetCharacter("codWp").
IF responseJSON:GetInteger("total") <> 1 OR responseJSON:GetInteger("inserted") <> 1 THEN
 UNDO, THROW NEW Progress.Lang.AppError("API nao preservou total",0).
IF NOT CAN-FIND(FIRST espec.wp_nota_fiscal WHERE espec.wp_nota_fiscal.cod_wp = c AND espec.wp_nota_fiscal.tipo_nota = 987) THEN
 UNDO, THROW NEW Progress.Lang.AppError("API nao persistiu consulta fixture",0).
DO TRANSACTION:
 FOR EACH espec.wp_nota_fiscal WHERE espec.wp_nota_fiscal.cod_wp = c EXCLUSIVE-LOCK: DELETE espec.wp_nota_fiscal. END.
 FOR EACH espec.wp WHERE espec.wp.cod_wp = c EXCLUSIVE-LOCK: DELETE espec.wp. END.
END.
IF CAN-FIND(FIRST espec.wp) OR CAN-FIND(FIRST espec.wp_nota_fiscal) THEN UNDO, THROW NEW Progress.Lang.AppError("Fixture suja",0).
requestJSON:Add("empresa","WP-FAIL").
RUN http-api/api_cons_nota_fiscal_wp.p(requestJSON, OUTPUT responseJSON).
IF responseJSON:GetLogical("success") OR NOT responseJSON:Has("error")
 OR responseJSON:Has("codWp") OR responseJSON:Has("total") OR responseJSON:Has("inserted") THEN
 UNDO, THROW NEW Progress.Lang.AppError("Falha writer deve retornar somente erro",0).
IF CAN-FIND(FIRST espec.wp) OR CAN-FIND(FIRST espec.wp_nota_fiscal) THEN
 UNDO, THROW NEW Progress.Lang.AppError("Falha writer deixou pesquisa parcial",0).
PUT UNFORMATTED "PASS API checks=7 (consulta substituida por fixture isolada)" SKIP.

