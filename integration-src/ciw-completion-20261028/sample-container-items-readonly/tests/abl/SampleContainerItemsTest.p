BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
{SampleContainerItemsFixtures.i}
{sursum-api/includes/SampleContainerItemsTable.i}
DEFINE TEMP-TABLE brokenSource NO-UNDO FIELD unrelated AS INTEGER.
DEFINE TEMP-TABLE wrongTypeSource NO-UNDO FIELD item_container_id AS CHARACTER FIELD item_proc_compra_id AS INTEGER FIELD container_id AS INTEGER.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE started AS INTEGER NO-UNDO.
DEFINE VARIABLE rowsRead AS INTEGER NO-UNDO.
DEFINE VARIABLE maxRows AS INTEGER NO-UNDO INITIAL 50000.
DEFINE VARIABLE failed AS LOGICAL NO-UNDO.
DEFINE VARIABLE allocationHandle AS HANDLE NO-UNDO.
DEFINE VARIABLE containerHandle AS HANDLE NO-UNDO.
DEFINE VARIABLE purchaseHandle AS HANDLE NO-UNDO.
DEFINE VARIABLE programPath AS CHARACTER NO-UNDO.
DEFINE VARIABLE requestValue AS JsonObject NO-UNDO.
DEFINE VARIABLE responseValue AS JsonObject NO-UNDO.
DEFINE VARIABLE keyValue AS CHARACTER NO-UNDO.
ASSIGN containerHandle=BUFFER containerSource:HANDLE purchaseHandle=BUFFER purchaseSource:HANDLE allocationHandle=BUFFER allocationSource:HANDLE.
RUN Check(NUM-DBS=0,'tests have no database').
programPath=SEARCH('sursum-api/programs/SampleContainerItemsCollector.r').
RUN Check(programPath<>?,'new sample-only global collector is available').
DO n=1 TO 210:
 CREATE allocationSource. ASSIGN allocationSource.item_container_id=n allocationSource.item_proc_compra_id=n allocationSource.container_id=211 - n. RELEASE allocationSource.
 CREATE containerSource. ASSIGN containerSource.nr-container=211 - n containerSource.situacao=IF n=2 THEN 1 ELSE IF n=3 THEN ? ELSE 3 containerSource.situacao_container_id=IF n=4 THEN 1 ELSE IF n=5 THEN ? ELSE 3 containerSource.cod-estabel=IF n=6 THEN '1' ELSE '5'. RELEASE containerSource.
 CREATE purchaseSource. ASSIGN purchaseSource.item_proc_compra_id=n purchaseSource.codigo_erp=IF n=210 THEN 'LAST-CODE' ELSE ' CODE ' purchaseSource.descricao=IF n=210 THEN 'FINAL ITEM' ELSE ? purchaseSource.ind_distr_custo=0. RELEASE purchaseSource.
END.
CREATE allocationSource. ASSIGN allocationSource.item_container_id=211 allocationSource.container_id=999 allocationSource.item_proc_compra_id=1. RELEASE allocationSource.
CREATE allocationSource. ASSIGN allocationSource.item_container_id=212 allocationSource.container_id=1 allocationSource.item_proc_compra_id=999. RELEASE allocationSource.
started=ETIME. RUN Collect.
RUN Check(CAN-FIND(ttSampleContainerItems WHERE ttSampleContainerItems.item_container_id=1),'two source statuses3 included').
RUN Check(NOT CAN-FIND(ttSampleContainerItems WHERE ttSampleContainerItems.item_container_id=2),'ordinary status must be3').
RUN Check(NOT CAN-FIND(ttSampleContainerItems WHERE ttSampleContainerItems.item_container_id=3),'SQL NULL ordinary status excluded').
RUN Check(NOT CAN-FIND(ttSampleContainerItems WHERE ttSampleContainerItems.item_container_id=4),'sample status must be3 independently').
RUN Check(NOT CAN-FIND(ttSampleContainerItems WHERE ttSampleContainerItems.item_container_id=5),'SQL NULL sample status excluded').
RUN Check(CAN-FIND(ttSampleContainerItems WHERE ttSampleContainerItems.item_container_id=6),'no invented MED or distribution-flag predicate').
RUN Check(NOT CAN-FIND(ttSampleContainerItems WHERE ttSampleContainerItems.item_container_id>210),'missing inner join parents excluded').
FIND ttSampleContainerItems WHERE ttSampleContainerItems.item_container_id=1.
RUN Check(ttSampleContainerItems.descricao=? AND ttSampleContainerItems.codigo_erp=' CODE ' AND ttSampleContainerItems.container_id=210,'raw joined text null and IDs retained').
RUN Check(rowsRead>600 AND rowsRead<50000,'budget counts root and both joins globally').
maxRows=4. rowsRead=0. failed=FALSE. DO ON ERROR UNDO, LEAVE: RUN Collect. CATCH e AS Progress.Lang.Error: failed=TRUE. END CATCH. END.
RUN Check(failed AND NOT CAN-FIND(FIRST ttSampleContainerItems),'global row limit clears partial output').
maxRows=50000. started=ETIME - 10001. rowsRead=0. failed=FALSE. DO ON ERROR UNDO, LEAVE: RUN Collect. CATCH e AS Progress.Lang.Error: failed=TRUE. END CATCH. END.
RUN Check(failed AND rowsRead=0,'global clock never restarts per join').
started=ETIME. allocationHandle=BUFFER brokenSource:HANDLE. failed=FALSE. DO ON ERROR UNDO, LEAVE: RUN Collect. CATCH e AS Progress.Lang.Error: failed=TRUE. END CATCH. END.
RUN Check(failed,'missing physical field fails closed even empty').
allocationHandle=BUFFER wrongTypeSource:HANDLE. failed=FALSE. DO ON ERROR UNDO, LEAVE: RUN Collect. CATCH e AS Progress.Lang.Error: failed=TRUE. END CATCH. END.
RUN Check(failed,'wrong physical type fails closed even empty').
allocationHandle=BUFFER allocationSource:HANDLE.
programPath=SEARCH('sursum-api/programs/SampleContainerItemsReadService.r'). RUN Check(programPath<>?,'RO service available').
RUN Parse('~{"operation":"read","take":200}'). RUN Invoke.
RUN Check(responseValue:GetLogical('success') AND responseValue:GetInteger('total')=206 AND responseValue:GetJsonArray('data'):Length=200,'all global matches collected before paging').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('container_id')=1,'source container ordering before pagination').
keyValue=responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('record_key').
RUN Parse('~{"operation":"get"}'). requestValue:Add('id',keyValue). requestValue:Add('record_key',keyValue). RUN Invoke.
RUN Check(responseValue:GetJsonObject('data'):GetInteger('item_container_id')=210,'complete physical JSON key GET').
requestValue:Set('record_key',keyValue + ' '). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","skip":200,"take":200,"sort":[~{"field":"container_id","dir":"asc"}]}'). RUN Invoke.
RUN Check(responseValue:GetJsonArray('data'):Length=6,'page beyond200').
RUN Parse('~{"operation":"read","filter":~{"field":"codigo_erp","operator":"eq","value":"LAST-CODE"}}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=1 AND responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('item_container_id')=210,'joined text filter before page').
RUN Parse('~{"operation":"read","filter":~{"field":"container_id","operator":"eq","value":210}}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=1 AND responseValue:GetJsonArray('data'):GetJsonObject(1):IsNull('descricao'),'numeric container filter and null preserved').
RUN Parse('~{"operation":"get","id":"~{~\"item_container_id~\":2}"}'). RUN Invoke. RUN Code(404).
RUN Parse('~{"operation":"get","id":"~{~\"item_container_id~\":999}"}'). RUN Invoke. RUN Code(404).
RUN Parse('~{"operation":"get","id":"~{~\"item_container_id~\":1,~\"container_id~\":210}"}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","empresa_id":5}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","container_id":1}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","take":201}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"update"}'). RUN Invoke. RUN Code(405).
RUN Parse('~{"operation":"READ"}'). RUN Invoke. RUN Code(405).
RUN Parse('~{"operation":"read","Take":1}'). RUN Invoke. RUN Code(422).
allocationHandle=BUFFER brokenSource:HANDLE.
RUN Parse('~{"operation":"read"}'). RUN Invoke. RUN Code(503).
RUN Check(NOT responseValue:Has('data'),'schema failure exposes no stale data').
RUN Check(NUM-DBS=0,'tests finish without database').
OUTPUT TO 'sample-tests.log'. PUT UNFORMATTED 'PASS ' checks ' NUMDBS=' NUM-DBS ' CULTURE=' SESSION:NUMERIC-FORMAT SKIP. OUTPUT CLOSE.
PROCEDURE Collect:
 EMPTY TEMP-TABLE ttSampleContainerItems.
 RUN VALUE(programPath)(allocationHandle,containerHandle,purchaseHandle,started,maxRows,INPUT-OUTPUT rowsRead,OUTPUT TABLE ttSampleContainerItems).
END PROCEDURE.
PROCEDURE Invoke:
 RUN VALUE(programPath)(allocationHandle,containerHandle,purchaseHandle,requestValue,OUTPUT responseValue).
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
