/* Private synthetic timing proof. Never publish this test or its two fixtures. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
{AvailableNfFixture.i}
DEFINE VARIABLE request AS JsonObject NO-UNDO. DEFINE VARIABLE response AS JsonObject NO-UNDO.
DEFINE VARIABLE started AS INTEGER NO-UNDO. DEFINE VARIABLE elapsed AS INTEGER NO-UNDO.
IF NUM-DBS<>0 THEN UNDO, THROW NEW Progress.Lang.AppError('DB forbidden',1).
CREATE ttMaster. ASSIGN ttMaster.nr-container=71 ttMaster.cod-estabel='501' ttMaster.cod-emit-forn=51.
CREATE ttDoc. ASSIGN ttDoc.nro-docto='BUDGET-ONLY' ttDoc.serie-docto='A' ttDoc.cod-emitente=51 ttDoc.nat-operacao='3101' ttDoc.cod-estabel='501' ttDoc.idi-sit-nf-eletro=3.
request=NEW JsonObject(). request:Add('resource','nfs-disponiveis'). request:Add('operation','read'). request:Add('container_id',71).
started=ETIME.
RUN VALUE('sursum-api/programs/NfPageBudgetFixture.r') (INPUT BUFFER ttMaster:HANDLE,?,?,?,?,?,?,?,INPUT BUFFER ttLink:HANDLE,INPUT BUFFER ttDoc:HANDLE,?,request,OUTPUT response).
elapsed=ETIME - started.
IF response:GetLogical('success') OR NOT response:Has('error') OR response:GetJsonObject('error'):GetCharacter('code')<>'CONTAINER_NF_QUERY_TIMEOUT' OR response:GetJsonObject('error'):GetInteger('status')<>503 THEN UNDO, THROW NEW Progress.Lang.AppError('outer collection deadline must interrupt the RUN reader',1).
IF response:Has('data') OR response:Has('total') THEN UNDO, THROW NEW Progress.Lang.AppError('timeout must not disclose partial page/total',1).
/* Slow reader sleeps2s; inner reader budget remains10s; outer-only fixture1s.
   Receiving timeout proves the deadline is shared rather than two budgets. */
OUTPUT TO VALUE('nf-page-budget-' + SESSION:NUMERIC-FORMAT + '.log'). PUT UNFORMATTED 'PASS 2 checks NUMDBS=' NUM-DBS ' elapsedMs=' elapsed SKIP. OUTPUT CLOSE.
