const fs=require('fs'),path=require('path'),crypto=require('crypto');const root=__dirname,motor='D:/opencode/motor-progress/v2';
const original=fs.readFileSync(motor+'/sursum-api/programs/PurchaseSignalsService.p','utf8');
const start=original.indexOf('DEFINE TEMP-TABLE ttSignalRead'),end=original.indexOf('DEFINE VARIABLE purchaseContextCode');
fs.mkdirSync(root+'/includes',{recursive:true});fs.writeFileSync(root+'/includes/PurchaseSignalsTable.i','/* Shared projection contract for contextual and global signals. */\n'+original.slice(start,end));
let collector=original.slice(0,start)+'{sursum-api/includes/PurchaseSignalsTable.i}\nDEFINE OUTPUT PARAMETER TABLE FOR ttSignalRead.\nDEFINE OUTPUT PARAMETER piProcess AS INTEGER NO-UNDO.\nDEFINE OUTPUT PARAMETER piScanned AS INTEGER NO-UNDO.\n'+original.slice(end);
collector=collector.replace('/* Read-only contextual projection. Business evaluation lives in the reusable\n   rules program; the shared reader owns filters, ordering, paging and keys. */','/* Single read-only collector for contextual and global signals. Business\n   evaluation stays in PurchaseSignalRules; reader pagination is outside. */');
collector=collector.replace("rulePath=SEARCH('sursum-api/programs/PurchaseSignalRules.r'). readPath=SEARCH('sursum-api/programs/CiwErpReadService.r').","rulePath=SEARCH('sursum-api/programs/PurchaseSignalRules.r').");
collector=collector.replace('IF rulePath=? OR readPath=?','IF rulePath=?');
collector=collector.replace('DEFINE INPUT PARAMETER poRequest AS JsonObject NO-UNDO.','DEFINE INPUT PARAMETER piScanBudget AS INTEGER NO-UNDO.\nDEFINE INPUT PARAMETER piStarted AS INTEGER NO-UNDO.\nDEFINE INPUT PARAMETER poRequest AS JsonObject NO-UNDO.');
collector=collector.replace(' IF NOT VALID-HANDLE(phOrders)'," IF piScanBudget=? OR piScanBudget<0 OR piScanBudget>50000 OR piStarted=? OR piStarted<0 THEN RUN Fail('PURCHASE_SIGNAL_CONFIGURATION',503,'Private budget required.').\n started=piStarted.\n IF NOT VALID-HANDLE(phOrders)");
collector=collector.replace('q:GET-FIRST(NO-LOCK). started=ETIME.','q:GET-FIRST(NO-LOCK).');
collector=collector.replace('IF scanned>50000 OR ETIME - started>10000','IF scanned>piScanBudget OR ETIME - started>10000');
const readStart=collector.indexOf(' copyValue=CAST(poRequest:Clone(),JsonObject).');const readEnd=collector.indexOf(' CATCH e AS Progress.Lang.Error:',readStart);
collector=collector.slice(0,readStart)+" ASSIGN piProcess=pid piScanned=scanned.\n poResponse=NEW JsonObject(). poResponse:Add('success',TRUE).\n"+collector.slice(readEnd);
collector=collector.replace(" CATCH e AS Progress.Lang.Error:\n  poResponse=", " CATCH e AS Progress.Lang.Error:\n  piScanned=scanned.\n  EMPTY TEMP-TABLE ttSignalRead.\n  poResponse=");
fs.writeFileSync(root+'/abl/PurchaseSignalsCollector.p',collector);
const adapter=`/* Compatible contextual adapter; collection shared with global dashboard. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE INPUT PARAMETER phOrders AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phCompanies AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phItems AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phPayments AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phSignals AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER pdToday AS DATE NO-UNDO.
DEFINE INPUT PARAMETER poRequest AS JsonObject NO-UNDO.
DEFINE OUTPUT PARAMETER poResponse AS JsonObject NO-UNDO.
{sursum-api/includes/PurchaseSignalsTable.i}
DEFINE VARIABLE collectorPath AS CHARACTER NO-UNDO.
DEFINE VARIABLE readerPath AS CHARACTER NO-UNDO.
DEFINE VARIABLE pid AS INTEGER NO-UNDO.
DEFINE VARIABLE scanned AS INTEGER NO-UNDO.
DEFINE VARIABLE clean AS JsonObject NO-UNDO.
DEFINE VARIABLE err AS JsonObject NO-UNDO.
DO ON ERROR UNDO, THROW:
 collectorPath=SEARCH('sursum-api/programs/PurchaseSignalsCollector.r'). readerPath=SEARCH('sursum-api/programs/CiwErpReadService.r').
 IF collectorPath=? OR readerPath=? THEN UNDO, THROW NEW Progress.Lang.AppError('Collector absent',1).
 RUN VALUE(collectorPath)(phOrders,phCompanies,phItems,phPayments,phSignals,pdToday,50000,ETIME,poRequest,OUTPUT poResponse,OUTPUT TABLE ttSignalRead,OUTPUT pid,OUTPUT scanned).
 IF NOT poResponse:GetLogical('success') THEN RETURN.
 clean=CAST(poRequest:Clone(),JsonObject). clean:Remove('proc_compra_id').
 RUN VALUE(readerPath)(INPUT BUFFER ttSignalRead:HANDLE,'proc_compra_alertas',TRIM(STRING(pid,'->>>>>>>>>9')),clean,OUTPUT poResponse).
 CATCH e AS Progress.Lang.Error:
  poResponse=NEW JsonObject(). poResponse:Add('success',FALSE). err=NEW JsonObject(). err:Add('code','PURCHASE_SIGNAL_CONFIGURATION'). err:Add('status',503). err:Add('message','Consulta de alertas invalida ou indisponivel.'). poResponse:Add('error',err).
 END CATCH.
END.
`;
fs.writeFileSync(root+'/abl/PurchaseSignalsService.p',adapter);
fs.writeFileSync(root+'/patches/PurchaseSignalsService.p.json',JSON.stringify({target:motor+'/sursum-api/programs/PurchaseSignalsService.p',baselineSHA256:crypto.createHash('sha256').update(original).digest('hex'),operation:'replaceFile',candidate:'abl/PurchaseSignalsService.p',reason:'Extract existing collector once; contextual API/fields/filters remain compatible.'},null,2)+'\n');
