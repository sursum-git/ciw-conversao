BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
{CostDistributionFixtures.i}
{sursum-api/includes/CostDistributionEligibleTable.i}
DEFINE TEMP-TABLE brokenSource NO-UNDO FIELD unrelated AS INTEGER.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE started AS INTEGER NO-UNDO.
DEFINE VARIABLE rowsRead AS INTEGER NO-UNDO.
DEFINE VARIABLE maxRows AS INTEGER NO-UNDO INITIAL 50000.
DEFINE VARIABLE failed AS LOGICAL NO-UNDO.
DEFINE VARIABLE allocationHandle AS HANDLE NO-UNDO.
DEFINE VARIABLE containerHandle AS HANDLE NO-UNDO.
DEFINE VARIABLE purchaseHandle AS HANDLE NO-UNDO.
DEFINE VARIABLE orderHandle AS HANDLE NO-UNDO.
DEFINE VARIABLE emitterHandle AS HANDLE NO-UNDO.
DEFINE VARIABLE programPath AS CHARACTER NO-UNDO.
DEFINE VARIABLE requestValue AS JsonObject NO-UNDO.
DEFINE VARIABLE responseValue AS JsonObject NO-UNDO.
DEFINE VARIABLE keyValue AS CHARACTER NO-UNDO.
ASSIGN containerHandle=BUFFER containerSource:HANDLE purchaseHandle=BUFFER purchaseSource:HANDLE orderHandle=BUFFER orderSource:HANDLE emitterHandle=BUFFER emitterSource:HANDLE.
RUN Check(NUM-DBS=0,'tests have no database').
programPath=SEARCH('sursum-api/programs/CostDistributionEligibleCollector.r').
RUN Check(programPath<>?,'new fixed eligible projection is available').
DO n=1 TO 205:
 CREATE allocationSource. ASSIGN allocationSource.item_container_id=n allocationSource.item_proc_compra_id=n allocationSource.container_id=n. RELEASE allocationSource.
 CREATE containerSource. ASSIGN containerSource.nr-container=n containerSource.situacao=IF n=2 THEN 3 ELSE IF n=3 THEN ? ELSE 1 containerSource.cod-emit-forn=700 containerSource.cod-estabel=IF n=4 THEN '1' ELSE '5'. RELEASE containerSource.
 CREATE purchaseSource. ASSIGN purchaseSource.item_proc_compra_id=n purchaseSource.proc_compra_id=n purchaseSource.codigo_erp=IF n=205 THEN 'LAST-CODE' ELSE ' CODE ' purchaseSource.descricao=IF n=205 THEN 'LAST ITEM' ELSE ? purchaseSource.ind_distr_custo=0. RELEASE purchaseSource.
 CREATE orderSource. ASSIGN orderSource.proc_compra_id=n orderSource.fornecedor_id=701 orderSource.cod_proc_fornec=' RAW '. RELEASE orderSource.
END.
/* An allocation missing each inner-join parent is absent, not a fabricated row. */
CREATE allocationSource. ASSIGN allocationSource.item_container_id=206 allocationSource.container_id=999 allocationSource.item_proc_compra_id=1. RELEASE allocationSource.
CREATE allocationSource. ASSIGN allocationSource.item_container_id=207 allocationSource.container_id=1 allocationSource.item_proc_compra_id=999. RELEASE allocationSource.
CREATE purchaseSource. ASSIGN purchaseSource.item_proc_compra_id=208 purchaseSource.proc_compra_id=999. RELEASE purchaseSource.
CREATE allocationSource. ASSIGN allocationSource.item_container_id=208 allocationSource.container_id=1 allocationSource.item_proc_compra_id=208. RELEASE allocationSource.
CREATE emitterSource. ASSIGN emitterSource.cod-emitente=700 emitterSource.nome-abrev='CURRENT CONTAINER SUPPLIER'. RELEASE emitterSource.
CREATE emitterSource. ASSIGN emitterSource.cod-emitente=701 emitterSource.nome-abrev='CURRENT PI SUPPLIER'. RELEASE emitterSource.
allocationHandle=BUFFER allocationSource:HANDLE. started=ETIME. RUN Collect.
RUN Check(CAN-FIND(ttCostDistributionEligible WHERE ttCostDistributionEligible.item_container=1),'ordinary eligible item').
RUN Check(NOT CAN-FIND(ttCostDistributionEligible WHERE ttCostDistributionEligible.item_container=2),'status3 excluded').
RUN Check(NOT CAN-FIND(ttCostDistributionEligible WHERE ttCostDistributionEligible.item_container=3),'SQL unknown status excluded').
RUN Check(CAN-FIND(ttCostDistributionEligible WHERE ttCostDistributionEligible.item_container=4),'no invented MED company predicate').
RUN Check(NOT CAN-FIND(ttCostDistributionEligible WHERE ttCostDistributionEligible.item_container>205),'all missing inner-join parents excluded').
FIND ttCostDistributionEligible WHERE ttCostDistributionEligible.item_container=1.
RUN Check(ttCostDistributionEligible.descricao=? AND ttCostDistributionEligible.codigo_erp=' CODE ' AND ttCostDistributionEligible.processo_fornec=' RAW ','raw text and null retained; no distribution flag predicate').
RUN Check(ttCostDistributionEligible.fornec_pi_nome_abrev_atual='CURRENT PI SUPPLIER' AND ttCostDistributionEligible.fornec_nome_abrev_atual='CURRENT CONTAINER SUPPLIER','two current supplier joins use shared helper').
RUN Check(rowsRead>1000 AND rowsRead<50000,'budget counts physical joins and both current lookups globally').
maxRows=4. rowsRead=0. failed=FALSE. DO ON ERROR UNDO, LEAVE: RUN Collect. CATCH e AS Progress.Lang.Error: failed=TRUE. END CATCH. END.
RUN Check(failed AND NOT CAN-FIND(FIRST ttCostDistributionEligible),'global budget failure clears partial projection').
maxRows=50000. started=ETIME - 10001. rowsRead=0. failed=FALSE. DO ON ERROR UNDO, LEAVE: RUN Collect. CATCH e AS Progress.Lang.Error: failed=TRUE. END CATCH. END.
RUN Check(failed AND rowsRead=0,'expired budget never restarts per row').
started=ETIME. allocationHandle=BUFFER brokenSource:HANDLE. failed=FALSE. DO ON ERROR UNDO, LEAVE: RUN Collect. CATCH e AS Progress.Lang.Error: failed=TRUE. END CATCH. END.
RUN Check(failed,'physical schema errors fail closed').
allocationHandle=BUFFER allocationSource:HANDLE.
programPath=SEARCH('sursum-api/programs/CostDistributionEligibleReadService.r'). RUN Check(programPath<>?,'RO service available').
RUN Parse('~{"operation":"read","take":200}'). RUN Invoke.
RUN Check(responseValue:GetLogical('success') AND responseValue:GetInteger('total')=203 AND responseValue:GetJsonArray('data'):Length=200,'global projection before paging').
keyValue=responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('record_key').
RUN Parse('~{"operation":"get"}'). requestValue:Add('id',keyValue). requestValue:Add('record_key',keyValue). RUN Invoke.
RUN Check(responseValue:GetJsonObject('data'):GetInteger('item_container')=1,'full JSON key GET').
requestValue:Set('record_key',keyValue + ' '). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","skip":200,"take":200}'). RUN Invoke.
RUN Check(responseValue:GetJsonArray('data'):Length=3,'page beyond200').
RUN Parse('~{"operation":"read","filter":~{"field":"codigo_erp","operator":"eq","value":"LAST-CODE"}}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=1 AND responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('item_container')=205,'source filter before pagination').
RUN Parse('~{"operation":"read","filter":~{"field":"fornec_pi_nome_abrev_atual","operator":"eq","value":"CURRENT PI SUPPLIER"}}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=203,'current supplier filter before pagination').
RUN Parse('~{"operation":"read","sort":[~{"field":"item_container","dir":"desc"}],"take":1}'). RUN Invoke.
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('item_container')=205,'global sort').
FIND emitterSource WHERE emitterSource.cod-emitente=701. emitterSource.nome-abrev='UPDATED'. RELEASE emitterSource.
RUN Parse('~{"operation":"read","filter":~{"field":"fornec_pi_nome_abrev_atual","operator":"eq","value":"UPDATED"}}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=203,'current lookup has no cache').
FIND emitterSource WHERE emitterSource.cod-emitente=701. DELETE emitterSource.
RUN Parse('~{"operation":"read","take":1}'). RUN Invoke.
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):IsNull('fornec_pi_nome_abrev_atual') AND responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('fornec_pi')=701,'deleted supplier keeps original ID with null label').
RUN Parse('~{"operation":"get","id":"~{~\"item_container~\":2}"}'). RUN Invoke. RUN Code(404).
RUN Parse('~{"operation":"read","empresa_id":5}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","container_id":1}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","take":201}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"update"}'). RUN Invoke. RUN Code(405).
RUN Parse('~{"operation":"READ"}'). RUN Invoke. RUN Code(405).
RUN Parse('~{"operation":"read","Take":1}'). RUN Invoke. RUN Code(422).
allocationHandle=BUFFER brokenSource:HANDLE.
RUN Parse('~{"operation":"read"}'). RUN Invoke. RUN Code(503).
RUN Check(NOT responseValue:Has('data'),'service schema failure exposes no partial or stale data').
RUN Check(NUM-DBS=0,'tests finish with no database').
OUTPUT TO 'eligible-tests.log'. PUT UNFORMATTED 'PASS ' checks ' NUMDBS=' NUM-DBS ' CULTURE=' SESSION:NUMERIC-FORMAT SKIP. OUTPUT CLOSE.
PROCEDURE Collect:
 EMPTY TEMP-TABLE ttCostDistributionEligible.
 RUN VALUE(programPath)(allocationHandle,containerHandle,purchaseHandle,orderHandle,emitterHandle,started,maxRows,INPUT-OUTPUT rowsRead,OUTPUT TABLE ttCostDistributionEligible).
END PROCEDURE.
PROCEDURE Invoke:
 RUN VALUE(programPath)(allocationHandle,containerHandle,purchaseHandle,orderHandle,emitterHandle,requestValue,OUTPUT responseValue).
END PROCEDURE.
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
 RUN Check(NOT responseValue:GetLogical('success') AND responseValue:GetJsonObject('error'):GetInteger('status')=expectedStatus,'expected error status ' + STRING(expectedStatus)).
END PROCEDURE.
