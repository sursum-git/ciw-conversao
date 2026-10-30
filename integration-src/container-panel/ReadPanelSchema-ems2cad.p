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

DO iTable = 1 TO NUM-ENTRIES("emitente,estabelec"):
cTable = ENTRY(iTable,"emitente,estabelec").
joResult = NEW JsonObject().
jaFields = NEW JsonArray().
jaIndexes = NEW JsonArray().
jaTriggers = NEW JsonArray().
FIND FIRST ems2cad._File WHERE ems2cad._File._File-Name = cTable NO-LOCK NO-ERROR.
IF NOT AVAILABLE ems2cad._File THEN NEXT.
joResult:Add("database", "ems2cad").
joResult:Add("table", ems2cad._File._File-Name).
FOR EACH ems2cad._Field WHERE ems2cad._Field._File-recid = RECID(ems2cad._File) NO-LOCK BY ems2cad._Field._Order:
  joItem = NEW JsonObject().
  joItem:Add("name", ems2cad._Field._Field-Name).
  joItem:Add("type", ems2cad._Field._Data-Type).
  joItem:Add("format", ems2cad._Field._Format).
  joItem:Add("decimals", ems2cad._Field._Decimals).
  joItem:Add("initial", ems2cad._Field._Initial).
  joItem:Add("mandatory", ems2cad._Field._Mandatory).
  joItem:Add("extent", ems2cad._Field._Extent).
  joItem:Add("validation", ems2cad._Field._Valexp).
  jaFieldTriggers = NEW JsonArray().
  FOR EACH ems2cad._Field-trig WHERE ems2cad._Field-trig._Field-recid = RECID(ems2cad._Field) NO-LOCK:
    joTrigger = NEW JsonObject().
    joTrigger:Add("event", ems2cad._Field-trig._Event).
    joTrigger:Add("procedure", ems2cad._Field-trig._Proc-Name).
    jaFieldTriggers:Add(joTrigger).
  END.
  joItem:Add("triggers", jaFieldTriggers).
  jaFields:Add(joItem).
END.
FOR EACH ems2cad._Index WHERE ems2cad._Index._File-recid = RECID(ems2cad._File) NO-LOCK:
  joItem = NEW JsonObject().
  jaIndexFields = NEW JsonArray().
  joItem:Add("name", ems2cad._Index._Index-Name).
  joItem:Add("unique", ems2cad._Index._Unique).
  joItem:Add("primary", RECID(ems2cad._Index) = ems2cad._File._Prime-Index).
  FOR EACH ems2cad._Index-field WHERE ems2cad._Index-field._Index-recid = RECID(ems2cad._Index) NO-LOCK BY ems2cad._Index-field._Index-Seq:
    FIND ems2cad._Field WHERE RECID(ems2cad._Field) = ems2cad._Index-field._Field-recid NO-LOCK.
    jaIndexFields:Add(ems2cad._Field._Field-Name).
  END.
  joItem:Add("fields", jaIndexFields).
  jaIndexes:Add(joItem).
END.
FOR EACH ems2cad._File-trig WHERE ems2cad._File-trig._File-recid = RECID(ems2cad._File) NO-LOCK:
  joItem = NEW JsonObject().
  joItem:Add("event", ems2cad._File-trig._Event).
  joItem:Add("procedure", ems2cad._File-trig._Proc-Name).
  jaTriggers:Add(joItem).
END.
joResult:Add("fields", jaFields).
joResult:Add("indexes", jaIndexes).
joResult:Add("triggers", jaTriggers).
joResult:WriteFile("schema-" + cTable + ".json", TRUE).
END.
QUIT.

