/* Closed metadata probe. Never opens a business-table buffer or invokes a trigger. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE report AS JsonObject NO-UNDO.
DEFINE VARIABLE tables AS JsonArray NO-UNDO.
DEFINE VARIABLE tableInfo AS JsonObject NO-UNDO.
DEFINE VARIABLE fields AS JsonArray NO-UNDO.
DEFINE VARIABLE indexes AS JsonArray NO-UNDO.
DEFINE VARIABLE triggers AS JsonArray NO-UNDO.
DEFINE VARIABLE fieldTriggers AS JsonArray NO-UNDO.
DEFINE VARIABLE components AS JsonArray NO-UNDO.
DEFINE VARIABLE item AS JsonObject NO-UNDO.
DEFINE VARIABLE triggerInfo AS JsonObject NO-UNDO.
DEFINE VARIABLE reads AS INTEGER NO-UNDO.
DEFINE VARIABLE fieldCount AS INTEGER NO-UNDO.
DEFINE VARIABLE indexCount AS INTEGER NO-UNDO.
DEFINE VARIABLE componentCount AS INTEGER NO-UNDO.
DEFINE VARIABLE triggerCount AS INTEGER NO-UNDO.
DEFINE VARIABLE completed AS LOGICAL NO-UNDO.
DEFINE VARIABLE ignored AS INTEGER NO-UNDO.
DEFINE VARIABLE errorNumber AS INTEGER NO-UNDO.
ignored=ETIME(TRUE).
report=NEW JsonObject(). tables=NEW JsonArray().
DO ON ERROR UNDO, THROW:
 IF NOT PROVERSION BEGINS '12.2' OR NUM-DBS<>2 OR NOT CONNECTED('comum') OR NOT CONNECTED('ems5') THEN UNDO, THROW NEW Progress.Lang.AppError('CURRENCY_DICTIONARY_ENVIRONMENT',1).
 DO STOP-AFTER 10 ON STOP UNDO, LEAVE:
  {CurrencyDictionaryTable.i &DB=comum &TABLE=cotacao}
  {CurrencyDictionaryTable.i &DB=ems5 &TABLE=cotac_parid}
  completed=TRUE.
 END.
 CATCH err AS Progress.Lang.Error:
  completed=FALSE.
 END CATCH.
END.
report:Add('completed',completed). report:Add('partial',FALSE).
report:Add('openEdge',PROVERSION). report:Add('numDbs',NUM-DBS).
report:Add('dictionaryReads',reads). report:Add('durationMs',ETIME(FALSE)).
report:Add('businessReads',FALSE). report:Add('businessWrites',FALSE).
IF completed THEN report:Add('tables',tables).
ELSE DO: report:Add('code','CURRENCY_DICTIONARY_INCOMPLETE'). report:Add('tables',NEW JsonArray()). END.
report:WriteFile('currency-dictionary-private.json',TRUE).
QUIT.
PROCEDURE Budget:
 IF reads>=50000 OR ETIME(FALSE)>10000 THEN UNDO, THROW NEW Progress.Lang.AppError('CURRENCY_DICTIONARY_LIMIT',1).
 reads=reads + 1.
END PROCEDURE.
