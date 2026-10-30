/* Leitura restrita: codigos de parametros candidatos e somente valores inteiros.
   Nunca exportar valores de senha/token/credenciais. Nao altera dados. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE ja AS JsonArray NO-UNDO.
DEFINE VARIABLE jo AS JsonObject NO-UNDO.
DEFINE VARIABLE cCode AS CHARACTER NO-UNDO.
DEFINE VARIABLE cValue AS CHARACTER NO-UNDO.
DEFINE VARIABLE i AS INTEGER NO-UNDO.
DEFINE VARIABLE lInteger AS LOGICAL NO-UNDO.
DEFINE VARIABLE iValue AS INTEGER NO-UNDO.
ja = NEW JsonArray().
FOR EACH espec.im-param NO-LOCK:
    cCode = CAPS(espec.im-param.cod-param).
    IF NOT (cCode MATCHES "*PRO*FORMA*" OR cCode MATCHES "*ANEXO*") THEN NEXT.
    IF cCode MATCHES "*SENHA*" OR cCode MATCHES "*TOKEN*" OR cCode MATCHES "*CRED*"
       OR cCode MATCHES "*SECRET*" OR cCode MATCHES "*PASSWORD*" OR cCode MATCHES "*AUTH*" THEN NEXT.
    jo = NEW JsonObject().
    jo:Add("code", espec.im-param.cod-param).
    cValue = TRIM(espec.im-param.val-param).
    lInteger = cValue <> ? AND LENGTH(cValue) > 0 AND LENGTH(cValue) <= 10.
    IF lInteger THEN DO i = 1 TO LENGTH(cValue):
        IF INDEX("0123456789", SUBSTRING(cValue, i, 1)) = 0 THEN lInteger = FALSE.
    END.
    IF lInteger THEN DO:
        iValue = INTEGER(cValue) NO-ERROR.
        IF ERROR-STATUS:ERROR THEN lInteger = FALSE.
    END.
    jo:Add("valueIsInteger", lInteger).
    IF lInteger THEN jo:Add("integerValue", iValue).
    ja:Add(jo).
END.
ja:WriteFile("proforma-parameter-candidates.json", TRUE).
QUIT.
