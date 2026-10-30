/* Deterministic branch test against the private zero-threshold fixture only. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
{AvailableNfFixture.i}
DEFINE VARIABLE request AS JsonObject NO-UNDO. DEFINE VARIABLE response AS JsonObject NO-UNDO.
IF NUM-DBS<>0 THEN UNDO, THROW NEW Progress.Lang.AppError('Connected DB forbidden',1).
CREATE ttMaster. ASSIGN ttMaster.nr-container=71 ttMaster.cod-estabel='501' ttMaster.cod-emit-forn=51.
CREATE ttDoc. ASSIGN ttDoc.nro-docto='TIMEOUT-ONLY' ttDoc.serie-docto='A' ttDoc.cod-emitente=51 ttDoc.nat-operacao='3101' ttDoc.cod-estabel='501' ttDoc.idi-sit-nf-eletro=3.
request=NEW JsonObject(). request:Add('resource','nfs-disponiveis'). request:Add('operation','read'). request:Add('container_id',71).
RUN VALUE('sursum-api/programs/FinanceTimeoutFixture.r') (INPUT BUFFER ttMaster:HANDLE,?,?,?,?,?,?,?,INPUT BUFFER ttLink:HANDLE,INPUT BUFFER ttDoc:HANDLE,?,request,OUTPUT response).
IF NOT response:Has('error') OR response:GetJsonObject('error'):GetCharacter('code')<>'CONTAINER_NF_QUERY_TIMEOUT' OR response:GetJsonObject('error'):GetInteger('status')<>503 THEN UNDO, THROW NEW Progress.Lang.AppError('timeout cause distinct',1).
IF response:Has('data') THEN UNDO, THROW NEW Progress.Lang.AppError('timeout no partial rows',1).
OUTPUT TO VALUE('alias-timeout-' + SESSION:NUMERIC-FORMAT + '.log'). PUT UNFORMATTED 'PASS 2 checks NUMDBS=' NUM-DBS SKIP. OUTPUT CLOSE.
