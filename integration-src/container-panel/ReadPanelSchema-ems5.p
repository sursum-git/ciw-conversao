BLOCK-LEVEL ON ERROR UNDO, THROW.
/* Probe de schema: apenas leitura do dicionario das tabelas de despesas; nenhuma escrita de negocio. */
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE cTable AS CHARACTER NO-UNDO.
DEFINE VARIABLE iTable AS INTEGER NO-UNDO.
DEFINE VARIABLE joResult AS JsonObject NO-UNDO.
DEFINE VARIABLE jaFields AS JsonArray NO-UNDO.
DEFINE VARIABLE jaIndexes AS JsonArray NO-UNDO.
DEFINE VARIABLE jaTriggers AS JsonArray NO-UNDO.
DEFINE VARIABLE joItem AS JsonObject NO-UNDO.
DEFINE VARIABLE jaIndexFields AS JsonArray NO-UNDO.
DEFINE VARIABLE jaReferences AS JsonArray NO-UNDO.
DEFINE VARIABLE jaFieldTriggers AS JsonArray NO-UNDO.
DEFINE VARIABLE joTrigger AS JsonObject NO-UNDO.

DO iTable = 1 TO NUM-ENTRIES("tit_ap,val_tit_ap,fornecedor"):
cTable = ENTRY(iTable,"tit_ap,val_tit_ap,fornecedor").
joResult = NEW JsonObject().
jaFields = NEW JsonArray().
jaIndexes = NEW JsonArray().
jaTriggers = NEW JsonArray().
FIND FIRST ems5._File WHERE ems5._File._File-Name = cTable NO-LOCK NO-ERROR.
IF NOT AVAILABLE ems5._File THEN NEXT.
joResult:Add("database", "ems5").
joResult:Add("table", ems5._File._File-Name).
FOR EACH ems5._Field WHERE ems5._Field._File-recid = RECID(ems5._File) NO-LOCK BY ems5._Field._Order:
  joItem = NEW JsonObject().
  joItem:Add("name", ems5._Field._Field-Name).
  joItem:Add("type", ems5._Field._Data-Type).
  joItem:Add("format", ems5._Field._Format).
  joItem:Add("decimals", ems5._Field._Decimals).
  joItem:Add("initial", ems5._Field._Initial).
  joItem:Add("mandatory", ems5._Field._Mandatory).
  joItem:Add("extent", ems5._Field._Extent).
  joItem:Add("validation", ems5._Field._Valexp).
  jaFieldTriggers = NEW JsonArray().
  FOR EACH ems5._Field-trig WHERE ems5._Field-trig._Field-recid = RECID(ems5._Field) NO-LOCK:
    joTrigger = NEW JsonObject().
    joTrigger:Add("event", ems5._Field-trig._Event).
    joTrigger:Add("procedure", ems5._Field-trig._Proc-Name).
    jaFieldTriggers:Add(joTrigger).
  END.
  joItem:Add("triggers", jaFieldTriggers).
  jaFields:Add(joItem).
END.
FOR EACH ems5._Index WHERE ems5._Index._File-recid = RECID(ems5._File) NO-LOCK:
  joItem = NEW JsonObject().
  jaIndexFields = NEW JsonArray().
  joItem:Add("name", ems5._Index._Index-Name).
  joItem:Add("unique", ems5._Index._Unique).
  joItem:Add("primary", RECID(ems5._Index) = ems5._File._Prime-Index).
  FOR EACH ems5._Index-field WHERE ems5._Index-field._Index-recid = RECID(ems5._Index) NO-LOCK BY ems5._Index-field._Index-Seq:
    FIND ems5._Field WHERE RECID(ems5._Field) = ems5._Index-field._Field-recid NO-LOCK.
    jaIndexFields:Add(ems5._Field._Field-Name).
  END.
  joItem:Add("fields", jaIndexFields).
  jaIndexes:Add(joItem).
END.
FOR EACH ems5._File-trig WHERE ems5._File-trig._File-recid = RECID(ems5._File) NO-LOCK:
  joItem = NEW JsonObject().
  joItem:Add("event", ems5._File-trig._Event).
  joItem:Add("procedure", ems5._File-trig._Proc-Name).
  jaTriggers:Add(joItem).
END.
joResult:Add("fields", jaFields).
joResult:Add("indexes", jaIndexes).
joResult:Add("triggers", jaTriggers).
joResult:WriteFile("schema-" + cTable + ".json", TRUE).
END.
QUIT.

