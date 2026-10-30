/* Diagnostico somente leitura; staging .42, nunca publicar como rota. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE q AS HANDLE NO-UNDO.
DEFINE VARIABLE b AS HANDLE NO-UNDO.
DEFINE VARIABLE rootData AS JsonObject NO-UNDO.
DEFINE VARIABLE info AS JsonObject NO-UNDO.
DEFINE VARIABLE firstRow AS JsonObject NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE totalRows AS INTEGER NO-UNDO.
DEFINE VARIABLE idSum AS INT64 NO-UNDO.
DEFINE VARIABLE resourceName AS CHARACTER NO-UNDO.
DEFINE VARIABLE dt AS DATE NO-UNDO.
rootData = NEW JsonObject().
CREATE BUFFER b FOR TABLE "ems2cad.emitente".
DO n = 1 TO 2:
 resourceName = ENTRY(n,"fornecedores,fornecedores_estrangeiros").
 CREATE QUERY q. q:SET-BUFFERS(b).
 IF NOT q:QUERY-PREPARE("FOR EACH " + b:NAME + " WHERE " + (IF n = 1 THEN "identific = 2" ELSE "cod-gr-forn = 2") + " NO-LOCK BY cod-emitente") THEN RETURN ERROR.
 IF NOT q:QUERY-OPEN() THEN RETURN ERROR.
 ASSIGN totalRows = 0 idSum = 0.
 info = NEW JsonObject(). q:GET-FIRST(NO-LOCK).
 DO WHILE NOT q:QUERY-OFF-END:
  IF totalRows = 0 THEN DO:
   firstRow = NEW JsonObject().
   firstRow:Add("cod_emitente",INTEGER(b:BUFFER-FIELD("cod-emitente"):BUFFER-VALUE)).
   firstRow:Add("nome_abrev",STRING(b:BUFFER-FIELD("nome-abrev"):BUFFER-VALUE)).
   firstRow:Add("nome_emit",STRING(b:BUFFER-FIELD("nome-emit"):BUFFER-VALUE)).
   IF n = 2 THEN DO:
    dt = b:BUFFER-FIELD("data-implant"):BUFFER-VALUE.
    IF dt = ? THEN firstRow:AddNull("data_implant").
    ELSE firstRow:Add("data_implant",STRING(YEAR(dt),"9999") + "-" + STRING(MONTH(dt),"99") + "-" + STRING(DAY(dt),"99")).
   END.
   info:Add("first",firstRow).
  END.
  ASSIGN totalRows = totalRows + 1 idSum = idSum + INT64(b:BUFFER-FIELD("cod-emitente"):BUFFER-VALUE).
  q:GET-NEXT(NO-LOCK).
 END.
 info:Add("count",totalRows). info:Add("idSum",idSum). rootData:Add(resourceName,info).
 DELETE OBJECT q.
END.
rootData:WriteFile("fornecedores-coverage.json",TRUE).
QUIT.
