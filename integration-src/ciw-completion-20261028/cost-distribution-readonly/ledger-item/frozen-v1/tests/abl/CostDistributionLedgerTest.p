BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
{LedgerFixtures.i}
{sursum-api/includes/CostDistributionLedgerTable.i}
DEFINE TEMP-TABLE brokenSource NO-UNDO FIELD unrelated AS INTEGER.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE selectedId AS INTEGER NO-UNDO INITIAL 1.
DEFINE VARIABLE started AS INTEGER NO-UNDO.
DEFINE VARIABLE maxRows AS INTEGER NO-UNDO INITIAL 50000.
DEFINE VARIABLE rowsRead AS INTEGER NO-UNDO.
DEFINE VARIABLE failed AS LOGICAL NO-UNDO.
DEFINE VARIABLE ledgerHandle AS HANDLE NO-UNDO.
DEFINE VARIABLE programPath AS CHARACTER NO-UNDO.
DEFINE VARIABLE requestValue AS JsonObject NO-UNDO.
DEFINE VARIABLE responseValue AS JsonObject NO-UNDO.
DEFINE VARIABLE keyValue AS CHARACTER NO-UNDO.
RUN Check(NUM-DBS=0,'no database').
programPath=SEARCH('sursum-api/programs/CostDistributionLedgerCollector.r'). RUN Check(programPath<>?,'new fixed owned ledger projection exists').
DO n=1 TO 206:
 CREATE ledgerSource. ASSIGN ledgerSource.cta_corren_custo_distr_id=n ledgerSource.item_container_id=IF n=206 THEN 2 ELSE 1 ledgerSource.data=IF n=1 THEN ? ELSE DATE(10,28,2026) ledgerSource.vl_lancto=IF n=1 THEN ? ELSE IF n=2 THEN -10 ELSE 0 ledgerSource.cod_tipo_movto=IF n=1 THEN ? ELSE n MODULO 5 ledgerSource.historico=' RAW ' ledgerSource.login=? ledgerSource.item_container_custo_id=700 + n. RELEASE ledgerSource.
END.
ledgerHandle=BUFFER ledgerSource:HANDLE. started=ETIME. RUN Collect.
RUN Check(rowsRead=205,'only matching physical ledger rows consume shared budget').
RUN Check(NOT CAN-FIND(FIRST ttCostDistributionLedger WHERE ttCostDistributionLedger.item_container_id<>1),'collector has only selected owner').
FIND ttCostDistributionLedger WHERE ttCostDistributionLedger.cta_corren_custo_distr_id=1.
RUN Check(ttCostDistributionLedger.vl_lancto=? AND ttCostDistributionLedger.data=? AND ttCostDistributionLedger.cod_tipo_movto=? AND ttCostDistributionLedger.login=?,'all original nulls retained').
FIND ttCostDistributionLedger WHERE ttCostDistributionLedger.cta_corren_custo_distr_id=2.
RUN Check(ttCostDistributionLedger.vl_lancto= -10 AND ttCostDistributionLedger.historico=' RAW ','signed amount and untrimmed text retained').
RUN Check(CAN-FIND(FIRST ttCostDistributionLedger WHERE ttCostDistributionLedger.cod_tipo_movto=0),'no invented movement predicate').
maxRows=1. rowsRead=0. failed=FALSE. DO ON ERROR UNDO, LEAVE: RUN Collect. CATCH e AS Progress.Lang.Error: failed=TRUE. END CATCH. END.
RUN Check(failed AND NOT CAN-FIND(FIRST ttCostDistributionLedger),'global limit cannot return a partial table').
maxRows=50000. started=ETIME - 10001. rowsRead=0. failed=FALSE. DO ON ERROR UNDO, LEAVE: RUN Collect. CATCH e AS Progress.Lang.Error: failed=TRUE. END CATCH. END.
RUN Check(failed AND rowsRead=0,'expired deadline stays expired').
started=ETIME. ledgerHandle=BUFFER brokenSource:HANDLE. failed=FALSE. DO ON ERROR UNDO, LEAVE: RUN Collect. CATCH e AS Progress.Lang.Error: failed=TRUE. END CATCH. END.
RUN Check(failed,'empty wrong schema rejected').
ledgerHandle=BUFFER ledgerSource:HANDLE. programPath=SEARCH('sursum-api/programs/CostDistributionLedgerReadService.r'). RUN Check(programPath<>?,'fixed ledger RO service exists').
RUN Parse('~{"operation":"read","item_container_id":1,"take":200}'). RUN Invoke.
RUN Check(responseValue:GetLogical('success') AND responseValue:GetInteger('total')=205 AND responseValue:GetJsonArray('data'):Length=200,'read before page max200').
keyValue=responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('record_key').
RUN Check(INDEX(keyValue,'item_container_id')>0 AND INDEX(keyValue,'cta_corren_custo_distr_id')>0,'identity has owner and physical PK').
RUN Parse('~{"operation":"get","item_container_id":1}'). requestValue:Add('id',keyValue). requestValue:Add('record_key',keyValue). RUN Invoke.
RUN Check(responseValue:GetJsonObject('data'):GetInteger('cta_corren_custo_distr_id')=1 AND responseValue:GetJsonObject('data'):IsNull('vl_lancto'),'GET keeps null amount').
requestValue:Set('item_container_id',2). RUN Invoke. RUN Code(404).
requestValue:Set('item_container_id',1). requestValue:Set('record_key',keyValue + ' '). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","item_container_id":1,"skip":200,"take":200}'). RUN Invoke. RUN Check(responseValue:GetJsonArray('data'):Length=5,'page after200').
RUN Parse('~{"operation":"read","item_container_id":1,"filter":~{"field":"vl_lancto","operator":"lt","value":0}}'). RUN Invoke. RUN Check(responseValue:GetInteger('total')=1,'signed native filter').
RUN Parse('~{"operation":"read","item_container_id":1,"sort":[~{"field":"cta_corren_custo_distr_id","dir":"desc"}],"take":1}'). RUN Invoke. RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('cta_corren_custo_distr_id')=205,'sort before paging').
RUN Parse('~{"operation":"read","item_container_id":999}'). RUN Invoke. RUN Check(responseValue:GetInteger('total')=0,'no invented parent join; source WHERE yields empty item ledger').
RUN Parse('~{"operation":"read"}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","item_container_id":1.5}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","item_container_id":0}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","item_container_id":1,"empresa_id":5}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","item_container_id":1,"take":201}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"delete","item_container_id":1}'). RUN Invoke. RUN Code(405).
RUN Parse('~{"operation":"READ","item_container_id":1}'). RUN Invoke. RUN Code(405).
ledgerHandle=BUFFER brokenSource:HANDLE. RUN Parse('~{"operation":"read","item_container_id":1}'). RUN Invoke. RUN Code(503). RUN Check(NOT responseValue:Has('data'),'schema failure has no partial data').
FIND ledgerSource WHERE ledgerSource.cta_corren_custo_distr_id=2. RUN Check(ledgerSource.vl_lancto= -10 AND ledgerSource.historico=' RAW ','read did not mutate ledger'). RELEASE ledgerSource.
RUN Check(NUM-DBS=0,'no database after test'). OUTPUT TO 'ledger-tests.log'. PUT UNFORMATTED 'PASS ' checks ' NUMDBS=' NUM-DBS ' CULTURE=' SESSION:NUMERIC-FORMAT SKIP. OUTPUT CLOSE.
PROCEDURE Collect:
 EMPTY TEMP-TABLE ttCostDistributionLedger.
 RUN VALUE(programPath)(ledgerHandle,selectedId,started,maxRows,INPUT-OUTPUT rowsRead,OUTPUT TABLE ttCostDistributionLedger).
END PROCEDURE.
PROCEDURE Invoke: RUN VALUE(programPath)(ledgerHandle,requestValue,OUTPUT responseValue). END PROCEDURE.
PROCEDURE Parse:
 DEFINE INPUT PARAMETER sourceValue AS LONGCHAR NO-UNDO. DEFINE VARIABLE utf8Value AS LONGCHAR NO-UNDO. DEFINE VARIABLE p AS ObjectModelParser NO-UNDO.
 FIX-CODEPAGE(utf8Value)='UTF-8'. utf8Value=sourceValue. p=NEW ObjectModelParser(). requestValue=CAST(p:Parse(utf8Value),JsonObject). DELETE OBJECT p.
END PROCEDURE.
PROCEDURE Check:
 DEFINE INPUT PARAMETER ok AS LOGICAL NO-UNDO. DEFINE INPUT PARAMETER messageText AS CHARACTER NO-UNDO.
 IF ok<>TRUE THEN UNDO, THROW NEW Progress.Lang.AppError(messageText,1). checks=checks + 1.
END PROCEDURE.
PROCEDURE Code:
 DEFINE INPUT PARAMETER expectedStatus AS INTEGER NO-UNDO.
 RUN Check(NOT responseValue:GetLogical('success') AND responseValue:GetJsonObject('error'):GetInteger('status')=expectedStatus,'expected status ' + STRING(expectedStatus)).
END PROCEDURE.
