/* Instantiated only for comum.cotacao and ems5.cotac_parid. Dictionary NO-LOCK. */
tableInfo=NEW JsonObject(). fieldValues=NEW JsonArray(). indexes=NEW JsonArray(). triggerValues=NEW JsonArray().
tableInfo:Add('database','{&DB}'). tableInfo:Add('table','{&TABLE}').
ASSIGN fieldCount=0 indexCount=0 triggerCount=0.
RUN Budget.
FIND FIRST {&DB}._File WHERE {&DB}._File._File-Name='{&TABLE}' NO-LOCK NO-ERROR.
DO errorNumber=1 TO ERROR-STATUS:NUM-MESSAGES:
 IF ERROR-STATUS:GET-NUMBER(errorNumber)<>565 THEN UNDO, THROW NEW Progress.Lang.AppError('CURRENCY_DICTIONARY_UNAVAILABLE',1).
END.
IF NOT AVAILABLE {&DB}._File THEN tableInfo:Add('found',FALSE).
ELSE DO:
 RUN Budget. tableInfo:Add('found',TRUE).
 FOR EACH {&DB}._Field WHERE {&DB}._Field._File-recid=RECID({&DB}._File) NO-LOCK BY {&DB}._Field._Order:
  RUN Budget. fieldCount=fieldCount + 1.
  IF fieldCount>512 THEN UNDO, THROW NEW Progress.Lang.AppError('CURRENCY_DICTIONARY_FIELD_LIMIT',1).
  item=NEW JsonObject(). fieldTriggers=NEW JsonArray().
  item:Add('name',{&DB}._Field._Field-Name). item:Add('type',{&DB}._Field._Data-Type).
  item:Add('format',{&DB}._Field._Format). item:Add('decimals',{&DB}._Field._Decimals).
  item:Add('initial',{&DB}._Field._Initial). item:Add('mandatory',{&DB}._Field._Mandatory).
  item:Add('extent',{&DB}._Field._Extent).
  FOR EACH {&DB}._Field-trig WHERE {&DB}._Field-trig._Field-recid=RECID({&DB}._Field) NO-LOCK:
   RUN Budget. triggerCount=triggerCount + 1.
   IF triggerCount>128 THEN UNDO, THROW NEW Progress.Lang.AppError('CURRENCY_DICTIONARY_TRIGGER_LIMIT',1).
   triggerInfo=NEW JsonObject(). triggerInfo:Add('event',{&DB}._Field-trig._Event). triggerInfo:Add('procedure',{&DB}._Field-trig._Proc-Name). fieldTriggers:Add(triggerInfo).
  END.
  item:Add('triggers',fieldTriggers). fieldValues:Add(item).
 END.
 FOR EACH {&DB}._Index WHERE {&DB}._Index._File-recid=RECID({&DB}._File) NO-LOCK:
  RUN Budget. indexCount=indexCount + 1. componentCount=0.
  IF indexCount>32 THEN UNDO, THROW NEW Progress.Lang.AppError('CURRENCY_DICTIONARY_INDEX_LIMIT',1).
  item=NEW JsonObject(). components=NEW JsonArray().
  item:Add('name',{&DB}._Index._Index-Name). item:Add('unique',{&DB}._Index._Unique).
  item:Add('primary',RECID({&DB}._Index)={&DB}._File._Prime-Index).
  FOR EACH {&DB}._Index-field WHERE {&DB}._Index-field._Index-recid=RECID({&DB}._Index) NO-LOCK BY {&DB}._Index-field._Index-Seq:
   RUN Budget. componentCount=componentCount + 1.
   IF componentCount>64 THEN UNDO, THROW NEW Progress.Lang.AppError('CURRENCY_DICTIONARY_COMPONENT_LIMIT',1).
   FIND {&DB}._Field WHERE RECID({&DB}._Field)={&DB}._Index-field._Field-recid NO-LOCK NO-ERROR.
   DO errorNumber=1 TO ERROR-STATUS:NUM-MESSAGES:
    IF ERROR-STATUS:GET-NUMBER(errorNumber)<>565 THEN UNDO, THROW NEW Progress.Lang.AppError('CURRENCY_DICTIONARY_UNAVAILABLE',1).
   END.
   IF NOT AVAILABLE {&DB}._Field THEN UNDO, THROW NEW Progress.Lang.AppError('CURRENCY_DICTIONARY_COMPONENT_UNAVAILABLE',1).
   RUN Budget. components:Add({&DB}._Field._Field-Name).
  END.
  item:Add('fields',components). indexes:Add(item).
 END.
 FOR EACH {&DB}._File-trig WHERE {&DB}._File-trig._File-recid=RECID({&DB}._File) NO-LOCK:
  RUN Budget. triggerCount=triggerCount + 1.
  IF triggerCount>128 THEN UNDO, THROW NEW Progress.Lang.AppError('CURRENCY_DICTIONARY_TRIGGER_LIMIT',1).
  item=NEW JsonObject(). item:Add('event',{&DB}._File-trig._Event). item:Add('procedure',{&DB}._File-trig._Proc-Name). triggerValues:Add(item).
 END.
END.
RUN Budget. tableInfo:Add('fields',fieldValues). tableInfo:Add('indexes',indexes). tableInfo:Add('triggers',triggerValues). tables:Add(tableInfo).
