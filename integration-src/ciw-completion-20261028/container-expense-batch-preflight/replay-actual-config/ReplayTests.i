DEFINE VARIABLE captured AS JsonObject NO-UNDO.
DEFINE VARIABLE testUtf8 AS LONGCHAR NO-UNDO.
DEFINE VARIABLE fixtureQuote AS DECIMAL NO-UNDO.
DEFINE VARIABLE quotePass AS INTEGER NO-UNDO.
DEFINE VARIABLE aId AS INTEGER NO-UNDO.
DEFINE VARIABLE bId AS INTEGER NO-UNDO.
DEFINE VARIABLE originalA AS JsonObject NO-UNDO.
DEFINE VARIABLE originalB AS JsonObject NO-UNDO.
DEFINE VARIABLE savedSeq AS INTEGER NO-UNDO.
DEFINE VARIABLE savedQuotes AS INTEGER NO-UNDO.
DEFINE VARIABLE savedLogs AS INTEGER NO-UNDO.
DEFINE VARIABLE fiscalMaximum AS INTEGER NO-UNDO.
DEFINE VARIABLE memoryMaximum AS INTEGER NO-UNDO.
DEFINE VARIABLE rowsMaximum AS INTEGER NO-UNDO.
DEFINE VARIABLE runReceipt AS JsonObject NO-UNDO.
DEFINE VARIABLE runSteps AS JsonArray NO-UNDO.
DEFINE VARIABLE allRuns AS JsonArray NO-UNDO.
DEFINE VARIABLE runsReceipt AS JsonObject NO-UNDO.
DEFINE VARIABLE foundValue AS LOGICAL NO-UNDO.

FIX-CODEPAGE(testUtf8)='UTF-8'.
RUN Check(NUM-DBS=0,'NUMDBS0 required').
parser=NEW ObjectModelParser(). captured=CAST(parser:ParseFile('captured-config.json'),JsonObject).
RUN Check(captured:GetLogical('completed') AND captured:GetInteger('company_id')=2,'official captured prerequisites').
allRuns=NEW JsonArray().
DO quotePass=1 TO 2:
 fixtureQuote=IF quotePass=1 THEN 1 ELSE 7.123.
 runSteps=NEW JsonArray().
 RUN CapturedFixture.
 RUN IndividualCreate(4,1,OUTPUT aId). RUN RecordStep('create_A').
 RUN IndividualCreate(5,2,OUTPUT bId). RUN RecordStep('create_B').
 RUN Check(CountRows(10)=2,'two individual creates create two central memories').
 RUN Image(aId,OUTPUT originalA). RUN Image(bId,OUTPUT originalB).
 RUN BatchRequest('update',originalA,originalB,1.01,2.02). RUN InvokeBatch.
 RUN Check(result:GetLogical('success') AND result:GetLogical('committed'),'native batch update committed').
 RUN Check(CountRows(10)=3,'batch update creates one central memory').
 RUN AssertAmount(aId,1.01). RUN AssertAmount(bId,2.02). RUN RecordStep('batch_update').
 RUN Image(aId,OUTPUT originalA). RUN Image(bId,OUTPUT originalB).
 req=NEW JsonObject(). req:Add('operation','update'). req:Add('container_id',123). req:Add('id',bId).
 result=NEW JsonObject(). result:Add('vl_prev',2.03). req:Add('values',result). RUN Invoke.
 RUN Check(result:GetLogical('success'),'concurrent individual update succeeds').
 RUN Check(CountRows(10)=4,'concurrent update reaches four central memories'). RUN RecordStep('concurrent_B').
 ASSIGN savedSeq=seq savedQuotes=quoteCalls savedLogs=logCalls.
 RUN BatchRequest('update',originalA,originalB,1.02,2.04). RUN InvokeBatch.
 RUN Check(NOT result:GetLogical('success') AND result:GetJsonObject('error'):GetInteger('status')=409,'second stale original rejects entire batch').
 RUN Check(seq=savedSeq AND quoteCalls=savedQuotes AND logCalls=savedLogs,'stale second row has zero IDs callbacks logs').
 RUN AssertAmount(aId,1.01). RUN AssertAmount(bId,2.03).
 RUN Check(CountRows(10)=4,'stale batch has no memory'). RUN RecordStep('stale_batch_rejected').
 RUN Image(aId,OUTPUT originalA). RUN Image(bId,OUTPUT originalB).
 RUN BatchRequest('delete',originalA,originalB,0,0). RUN InvokeBatch.
 RUN Check(result:GetLogical('success') AND result:GetLogical('committed'),'native batch delete committed').
 RUN Check(seq=savedSeq AND quoteCalls=savedQuotes,'batch delete only invalidates without fiscal IDs quotes').
 foundValue=hb[11]:FIND-FIRST('WHERE fx11.despesa_container_id=' + STRING(aId),NO-LOCK) NO-ERROR. RUN Check(NOT foundValue,'A deleted').
 foundValue=hb[11]:FIND-FIRST('WHERE fx11.despesa_container_id=' + STRING(bId),NO-LOCK) NO-ERROR. RUN Check(NOT foundValue,'B deleted').
 RUN Check(CountRows(10)=4,'delete preserves four existing memories'). RUN RecordStep('batch_delete').
 RUN Check(quoteCalls=4,'exactly four central quote collections').
 RUN Check(logCalls=savedLogs + 1,'one postcommit delete log').
 RUN Check(fiscalMaximum<=20 AND memoryMaximum<=4 AND rowsMaximum<=22,'bounded fiscal effects').
 runReceipt=NEW JsonObject(). runReceipt:Add('fixtureQuote',fixtureQuote). runReceipt:Add('steps',runSteps).
 runReceipt:Add('centralQuoteCalls',quoteCalls). runReceipt:Add('maximumFiscalRows',fiscalMaximum).
 runReceipt:Add('maximumExpenseRows',rowsMaximum). runReceipt:Add('maximumMemories',memoryMaximum).
 allRuns:Add(runReceipt).
END.
runsReceipt=NEW JsonObject(). runsReceipt:Add('success',TRUE). runsReceipt:Add('num_dbs',NUM-DBS).
runsReceipt:Add('checks',checks). runsReceipt:Add('runs',allRuns). runsReceipt:Add('realBusinessExecuted',FALSE).
runsReceipt:Add('cleanupProven',FALSE). runsReceipt:Add('positiveQuoteFixtureOnly',TRUE).
runsReceipt:WriteFile('replay-result-' + SESSION:NUMERIC-FORMAT + '.json',TRUE).
OUTPUT TO VALUE('replay-' + SESSION:NUMERIC-FORMAT + '.log').
PUT UNFORMATTED 'PASS ' checks ' checks NUMDBS=' NUM-DBS ' central captured-config replay NUMERIC-FORMAT=' SESSION:NUMERIC-FORMAT SKIP. OUTPUT CLOSE.

PROCEDURE CapturedFixture:
 DEFINE VARIABLE n AS INTEGER NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.
 DEFINE VARIABLE data AS JsonArray NO-UNDO. DEFINE VARIABLE o AS JsonObject NO-UNDO.
 RUN Fixture.
 DO n=2 TO 11: ht[n]:EMPTY-TEMP-TABLE(). END.
 hb[1]:FIND-FIRST('',NO-LOCK). hb[1]:BUFFER-FIELD('vl-dolar-compra'):BUFFER-VALUE=fixtureQuote.
 hb[1]:BUFFER-FIELD('vl_dolar_di'):BUFFER-VALUE=fixtureQuote. hb[1]:BUFFER-RELEASE().
 RUN Seed(2,'~{"empresa_id":2,"cod_emp_ems2":5}').
 policy:Set('despesa_distr_custo',captured:GetInteger('distribution_expense_id')).
 data=captured:GetJsonArray('expense_definitions'). DO j=1 TO data:Length: RUN LoadCaptured(6,data:GetJsonObject(j)). END.
 data=captured:GetJsonArray('company_expenses'). DO j=1 TO data:Length:
  o=CAST(data:GetJsonObject(j):Clone(),JsonObject). o:Add('empresa_id',2).
  /* Probe has no physical link PK: only a private TT structural ordinal, never a fiscal parameter. */
  o:Add('empresa_despesa_id',j). RUN LoadCaptured(7,o).
 END.
 data=captured:GetJsonArray('tax_bases'). DO j=1 TO data:Length:
  o=CAST(data:GetJsonObject(j):Clone(),JsonObject). o:Add('empresa_id',2). RUN LoadCaptured(8,o).
 END.
 data=captured:GetJsonArray('calculated_relations'). DO j=1 TO data:Length: RUN LoadCaptured(9,data:GetJsonObject(j)). END.
 ASSIGN fiscalMaximum=0 memoryMaximum=0 rowsMaximum=0.
END PROCEDURE.
PROCEDURE LoadCaptured:
 DEFINE INPUT PARAMETER n AS INTEGER NO-UNDO. DEFINE INPUT PARAMETER o AS JsonObject NO-UNDO.
 DEFINE VARIABLE names AS CHARACTER EXTENT NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO. DEFINE VARIABLE f AS HANDLE NO-UNDO.
 names=o:GetNames(). hb[n]:BUFFER-CREATE().
 DO j=1 TO EXTENT(names):
  f=hb[n]:BUFFER-FIELD(names[j]).
  IF o:IsNull(names[j]) THEN f:BUFFER-VALUE=?.
  ELSE CASE f:DATA-TYPE:
   WHEN 'CHARACTER' THEN f:BUFFER-VALUE=o:GetCharacter(names[j]).
   WHEN 'INTEGER' THEN f:BUFFER-VALUE=o:GetInteger(names[j]).
   WHEN 'DECIMAL' THEN f:BUFFER-VALUE=o:GetDecimal(names[j]).
   WHEN 'LOGICAL' THEN f:BUFFER-VALUE=o:GetLogical(names[j]).
   OTHERWISE UNDO, THROW NEW Progress.Lang.AppError('Unsupported captured field type',1).
  END CASE.
 END.
 hb[n]:BUFFER-RELEASE().
END PROCEDURE.
PROCEDURE IndividualCreate:
 DEFINE INPUT PARAMETER defId AS INTEGER NO-UNDO. DEFINE INPUT PARAMETER amount AS DECIMAL NO-UNDO. DEFINE OUTPUT PARAMETER newId AS INTEGER NO-UNDO.
 DEFINE VARIABLE valuesObject AS JsonObject NO-UNDO.
 req=NEW JsonObject(). req:Add('operation','create'). req:Add('container_id',123).
 valuesObject=NEW JsonObject(). valuesObject:Add('despesa_id',defId). valuesObject:Add('vl_prev',amount). valuesObject:Add('log_manual',TRUE).
 req:Add('values',valuesObject). RUN Invoke. RUN Check(result:GetLogical('success'),'manual create using captured safe definition').
 newId=result:GetJsonObject('data'):GetInteger('despesa_container_id').
END PROCEDURE.
PROCEDURE Image:
 DEFINE INPUT PARAMETER idValue AS INTEGER NO-UNDO. DEFINE OUTPUT PARAMETER imageValue AS JsonObject NO-UNDO.
 DEFINE VARIABLE textValue AS LONGCHAR NO-UNDO.
 req=NEW JsonObject(). req:Add('resource','container-despesas-lote'). req:Add('operation','get'). req:Add('container_id',123). req:Add('id',idValue).
 RUN InvokeBatch. RUN Check(result:GetLogical('success'),'native real get produces full original').
 imageValue=CAST(result:GetJsonObject('data'):Clone(),JsonObject).
END PROCEDURE.
PROCEDURE BatchRequest:
 DEFINE INPUT PARAMETER opValue AS CHARACTER NO-UNDO. DEFINE INPUT PARAMETER a AS JsonObject NO-UNDO. DEFINE INPUT PARAMETER b AS JsonObject NO-UNDO.
 DEFINE INPUT PARAMETER amountA AS DECIMAL NO-UNDO. DEFINE INPUT PARAMETER amountB AS DECIMAL NO-UNDO.
 DEFINE VARIABLE changes AS JsonArray NO-UNDO. DEFINE VARIABLE change AS JsonObject NO-UNDO. DEFINE VARIABLE valueObject AS JsonObject NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.
 req=NEW JsonObject(). req:Add('resource','container-despesas-lote'). req:Add('operation','batch'). req:Add('container_id',123).
 changes=NEW JsonArray(). DO j=1 TO 2:
  change=NEW JsonObject(). change:Add('operation',opValue). change:Add('clientId',IF j=1 THEN 'captured-A' ELSE 'captured-B').
  change:Add('id',IF j=1 THEN a:GetInteger('despesa_container_id') ELSE b:GetInteger('despesa_container_id')).
  change:Add('original',IF j=1 THEN CAST(a:Clone(),JsonObject) ELSE CAST(b:Clone(),JsonObject)).
  IF opValue='update' THEN DO: valueObject=NEW JsonObject(). valueObject:Add('vl_prev',IF j=1 THEN amountA ELSE amountB). change:Add('data',valueObject). END.
  changes:Add(change).
 END. req:Add('changes',changes).
END PROCEDURE.
PROCEDURE InvokeBatch:
 RUN sursum-api/programs/ContainersDespesasBatchService.r(hb[1],hb[2],hb[3],hb[4],hb[5],hb[6],hb[7],hb[8],hb[9],hb[10],hb[11],THIS-PROCEDURE,policy,req,OUTPUT result).
END PROCEDURE.
PROCEDURE AssertAmount:
 DEFINE INPUT PARAMETER idValue AS INTEGER NO-UNDO. DEFINE INPUT PARAMETER amount AS DECIMAL NO-UNDO.
 RUN Check(hb[11]:FIND-FIRST('WHERE fx11.despesa_container_id=' + STRING(idValue),NO-LOCK),'expected expense remains').
 RUN Check(hb[11]:BUFFER-FIELD('vl_prev'):BUFFER-VALUE=amount,'expected persisted amount'). hb[11]:BUFFER-RELEASE().
END PROCEDURE.
PROCEDURE RecordStep:
 DEFINE INPUT PARAMETER nameValue AS CHARACTER NO-UNDO.
 DEFINE VARIABLE q AS HANDLE NO-UNDO. DEFINE VARIABLE fiscalCount AS INTEGER NO-UNDO. DEFINE VARIABLE o AS JsonObject NO-UNDO.
 RUN Check(CountRows(3)=0 AND CountRows(4)=0 AND CountRows(5)=0,'zero items and purchase buffers throughout').
 CREATE QUERY q. q:SET-BUFFERS(hb[11]). q:QUERY-PREPARE('FOR EACH fx11 NO-LOCK'). q:QUERY-OPEN(). q:GET-FIRST().
 DO WHILE NOT q:QUERY-OFF-END:
  IF hb[11]:BUFFER-FIELD('despesa_id'):BUFFER-VALUE<>4 AND hb[11]:BUFFER-FIELD('despesa_id'):BUFFER-VALUE<>5 THEN DO:
   fiscalCount=fiscalCount + 1.
   RUN Check(hb[11]:BUFFER-FIELD('vl_prev'):BUFFER-VALUE=0 AND hb[11]:BUFFER-FIELD('vl_negociado'):BUFFER-VALUE=0 AND hb[11]:BUFFER-FIELD('vl_proforma'):BUFFER-VALUE=0,'all generated fiscal amounts stay zero').
  END.
  q:GET-NEXT().
 END. q:QUERY-CLOSE(). DELETE OBJECT q.
 ASSIGN fiscalMaximum=MAXIMUM(fiscalMaximum,fiscalCount) memoryMaximum=MAXIMUM(memoryMaximum,CountRows(10)) rowsMaximum=MAXIMUM(rowsMaximum,CountRows(11)).
 RUN Check(fiscalCount<=20 AND CountRows(10)<=4 AND CountRows(11)<=22,'step effect caps').
 o=NEW JsonObject(). o:Add('step',nameValue). o:Add('fiscalRows',fiscalCount). o:Add('expenses',CountRows(11)). o:Add('memories',CountRows(10)). runSteps:Add(o).
END PROCEDURE.
