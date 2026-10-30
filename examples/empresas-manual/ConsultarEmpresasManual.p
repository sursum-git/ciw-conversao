/* Exemplo de API manual de leitura. Nao publicado automaticamente.
   Compilar em OpenEdge 12.2 conectado ao banco logico espec.
   Executar pelo JsonProgramWebHandler, que registra usuario/PID/duracao.
*/
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.

DEFINE INPUT PARAMETER poRequest AS JsonObject NO-UNDO.
DEFINE OUTPUT PARAMETER poResponse AS JsonObject NO-UNDO.
DEFINE VARIABLE cToken AS CHARACTER NO-UNDO.
DEFINE VARIABLE cConfig AS CHARACTER NO-UNDO.
DEFINE VARIABLE lcConfig AS LONGCHAR NO-UNDO.
DEFINE VARIABLE oParser AS ObjectModelParser NO-UNDO.
DEFINE VARIABLE joConfig AS JsonObject NO-UNDO.
DEFINE VARIABLE jaEmpresas AS JsonArray NO-UNDO.
DEFINE VARIABLE joEmpresa AS JsonObject NO-UNDO.

DO ON ERROR UNDO, THROW:
    /* Reutiliza a credencial da fonte motor_progress_empresas.
       Nao receber senha ou token de integracao no corpo JSON. */
    cToken = WEB-CONTEXT:GET-CGI-VALUE("ENV", "HTTP_X_EMPRESAS_TOKEN") NO-ERROR.
    IF cToken = ? THEN cToken = "".
    IF LENGTH(cToken) < 32 OR LENGTH(cToken) > 128 THEN DO:
        RUN Falhar("EMPRESA_AUTH_REQUIRED", "Credencial da integracao invalida.", 401).
        RETURN.
    END.
    cConfig = SEARCH("sursum-conf/empresas-api.json").
    IF cConfig = ? THEN
        UNDO, THROW NEW Progress.Lang.AppError("Configuracao ausente", 0).
    FIX-CODEPAGE(lcConfig) = "UTF-8".
    COPY-LOB FROM FILE cConfig TO lcConfig.
    oParser = NEW ObjectModelParser().
    joConfig = CAST(oParser:Parse(lcConfig), JsonObject).
    IF CAPS(HEX-ENCODE(MESSAGE-DIGEST("SHA-256", cToken))) <>
       CAPS(joConfig:GetCharacter("tokenSha256")) THEN DO:
        RUN Falhar("EMPRESA_AUTH_REQUIRED", "Credencial da integracao invalida.", 401).
        RETURN.
    END.

    IF NOT CONNECTED("espec") THEN
        UNDO, THROW NEW Progress.Lang.AppError("Banco espec nao conectado", 0).

    jaEmpresas = NEW JsonArray().

    /* Consulta manual: a regra de negocio fica neste FOR EACH.
       Retornar a lista completa; PHP aplica filtro/ordenacao/paginacao. */
    FOR EACH espec.empresas NO-LOCK BY espec.empresas.empresa_id:
        joEmpresa = NEW JsonObject().
        IF espec.empresas.empresa_id = ? THEN joEmpresa:AddNull("empresa_id").
        ELSE joEmpresa:Add("empresa_id", espec.empresas.empresa_id).
        IF espec.empresas.nome = ? THEN joEmpresa:AddNull("nome").
        ELSE joEmpresa:Add("nome", espec.empresas.nome).
        IF espec.empresas.cod_emp_ems2 = ? THEN joEmpresa:AddNull("cod_emp_ems2").
        ELSE joEmpresa:Add("cod_emp_ems2", espec.empresas.cod_emp_ems2).
        IF espec.empresas.cod_emp_ems5 = ? THEN joEmpresa:AddNull("cod_emp_ems5").
        ELSE joEmpresa:Add("cod_emp_ems5", espec.empresas.cod_emp_ems5).
        jaEmpresas:Add(joEmpresa).
    END.

    poResponse = NEW JsonObject().
    poResponse:Add("success", TRUE).
    poResponse:Add("data", jaEmpresas).

    CATCH e AS Progress.Lang.Error:
        RUN Falhar("EMPRESA_QUERY_FAILED", "Nao foi possivel consultar empresas.", 500).
    END CATCH.
    FINALLY:
        IF VALID-OBJECT(joConfig) THEN DELETE OBJECT joConfig.
        IF VALID-OBJECT(oParser) THEN DELETE OBJECT oParser.
    END FINALLY.
END.

PROCEDURE Falhar:
    DEFINE INPUT PARAMETER pcCode AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER pcMessage AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER piStatus AS INTEGER NO-UNDO.
    DEFINE VARIABLE joError AS JsonObject NO-UNDO.
    poResponse = NEW JsonObject().
    joError = NEW JsonObject().
    joError:Add("code", pcCode).
    joError:Add("message", pcMessage).
    joError:Add("status", piStatus).
    poResponse:Add("success", FALSE).
    poResponse:Add("error", joError).
END PROCEDURE.
