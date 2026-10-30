/* Diagnostico independente, somente leitura em staging; nunca publicar. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE TEMP-TABLE ttDistinct NO-UNDO FIELD cdn_repres AS INTEGER
 FIELD nom_pessoa AS CHARACTER CASE-SENSITIVE FIELD nom_abrev AS CHARACTER CASE-SENSITIVE
 INDEX pk IS PRIMARY UNIQUE cdn_repres nom_pessoa nom_abrev.
DEFINE VARIABLE b AS HANDLE NO-UNDO.
DEFINE VARIABLE q AS HANDLE NO-UNDO.
DEFINE VARIABLE rootData AS JsonObject NO-UNDO.
DEFINE VARIABLE info AS JsonObject NO-UNDO.
DEFINE VARIABLE firstRow AS JsonObject NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE countRows AS INTEGER NO-UNDO.
DEFINE VARIABLE physicalRows AS INTEGER NO-UNDO.
DEFINE VARIABLE keySum AS INT64 NO-UNDO.
DEFINE VARIABLE repCode AS INTEGER NO-UNDO.
DEFINE VARIABLE repName AS CHARACTER CASE-SENSITIVE NO-UNDO.
DEFINE VARIABLE repAbrev AS CHARACTER CASE-SENSITIVE NO-UNDO.
rootData = NEW JsonObject().
DO n = 1 TO 2:
 CREATE BUFFER b FOR TABLE ENTRY(n,"ems2med.item,ems5.representante").
 CREATE QUERY q. q:SET-BUFFERS(b).
 IF NOT q:QUERY-PREPARE("FOR EACH " + b:NAME + " WHERE " + ENTRY(n,"ge-codigo >= 50 AND ge-codigo <= 60,dat_desligto = ?") + " NO-LOCK BY " + (IF n = 1 THEN "it-codigo" ELSE "cdn_repres BY nom_pessoa BY nom_abrev")) THEN RETURN ERROR.
 IF NOT q:QUERY-OPEN() THEN RETURN ERROR.
 ASSIGN countRows = 0 physicalRows = 0 keySum = 0.
 q:GET-FIRST(NO-LOCK). info = NEW JsonObject().
 DO WHILE NOT q:QUERY-OFF-END:
  physicalRows = physicalRows + 1.
  IF n = 2 THEN DO:
   ASSIGN repCode = b:BUFFER-FIELD("cdn_repres"):BUFFER-VALUE repName = b:BUFFER-FIELD("nom_pessoa"):BUFFER-VALUE repAbrev = b:BUFFER-FIELD("nom_abrev"):BUFFER-VALUE.
   FIND ttDistinct WHERE ttDistinct.cdn_repres = repCode AND ttDistinct.nom_pessoa = repName AND ttDistinct.nom_abrev = repAbrev NO-ERROR.
   IF AVAILABLE ttDistinct THEN DO: q:GET-NEXT(NO-LOCK). NEXT. END.
   CREATE ttDistinct. ASSIGN ttDistinct.cdn_repres = repCode ttDistinct.nom_pessoa = repName ttDistinct.nom_abrev = repAbrev.
  END.
  IF countRows = 0 THEN DO:
   firstRow = NEW JsonObject().
   IF n = 1 THEN DO:
    firstRow:Add("it_codigo",STRING(b:BUFFER-FIELD("it-codigo"):BUFFER-VALUE)).
    IF b:BUFFER-FIELD("desc-item"):BUFFER-VALUE = ? THEN firstRow:AddNull("descricao").
    ELSE firstRow:Add("descricao",STRING(b:BUFFER-FIELD("desc-item"):BUFFER-VALUE)).
   END.
   ELSE DO:
    firstRow:Add("cdn_repres",repCode).
    IF repName = ? THEN firstRow:AddNull("nom_pessoa"). ELSE firstRow:Add("nom_pessoa",repName).
    IF repAbrev = ? THEN firstRow:AddNull("nom_abrev"). ELSE firstRow:Add("nom_abrev",repAbrev).
   END.
   info:Add("first",firstRow).
  END.
  ASSIGN countRows = countRows + 1
   keySum = keySum + (IF n = 1 THEN LENGTH(STRING(b:BUFFER-FIELD("it-codigo"):BUFFER-VALUE)) ELSE repCode).
  q:GET-NEXT(NO-LOCK).
 END.
 info:Add("count",countRows). info:Add("physicalCount",physicalRows). info:Add("keySum",keySum).
 rootData:Add(ENTRY(n,"itens,representantes_ativos"),info).
 DELETE OBJECT q. DELETE OBJECT b.
END.
rootData:WriteFile("referencias-coverage.json",TRUE).
QUIT.
