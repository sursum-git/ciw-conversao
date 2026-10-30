/* Server-owned composition. Item maintenance owns the transaction. Fiscal,
   payment currency conversion and supplier allocations stay reusable services. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE INPUT PARAMETER phFiscalRules AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phBaseRuntime AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phMaster AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phItems AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phPurchaseItems AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phPurchases AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phLedger AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phOrderPayments AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phContainerPayments AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phAllContainers AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phTitAp AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phValTitAp AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER poPolicy AS JsonObject NO-UNDO.
DEFINE INPUT PARAMETER poFinancePolicy AS JsonObject NO-UNDO.
CREATE WIDGET-POOL.
{sursum-api/includes/ContainerBufferSibling.i}
DEFINE TEMP-TABLE ttCurrencyLinks NO-UNDO FIELD container_id AS INTEGER FIELD num_id_tit_ap AS INTEGER
 INDEX pk IS PRIMARY UNIQUE container_id num_id_tit_ap.
DEFINE VARIABLE financePath AS CHARACTER NO-UNDO.
DEFINE VARIABLE paymentPath AS CHARACTER NO-UNDO.
DEFINE VARIABLE currentContainer AS INTEGER NO-UNDO.
ASSIGN financePath=SEARCH("sursum-api/programs/ContainersItensFinanceiroService.r")
 paymentPath=SEARCH("sursum-api/programs/ContainersPagamentoTotalsService.r").
IF financePath=? THEN financePath=SEARCH("ContainersItensFinanceiroService.r").
IF paymentPath=? THEN paymentPath=SEARCH("ContainersPagamentoTotalsService.r").

PROCEDURE RequireTransaction:
 IF NOT TRANSACTION THEN UNDO, THROW NEW Progress.Lang.AppError("CONTAINER_TRANSACTION_CONTEXT: composicao de itens requer transacao raiz.",1).
END PROCEDURE.
PROCEDURE GetCapabilities:
 DEFINE OUTPUT PARAMETER result AS JsonObject NO-UNDO.
 DEFINE VARIABLE fiscal AS JsonObject NO-UNDO.
 DEFINE VARIABLE ready AS LOGICAL NO-UNDO.
 IF VALID-HANDLE(phFiscalRules) THEN DO:
  IF phFiscalRules:TYPE="PROCEDURE" AND LOOKUP("GetCapabilities",phFiscalRules:INTERNAL-ENTRIES)>0 THEN DO:
   RUN GetCapabilities IN phFiscalRules(OUTPUT fiscal).
   IF VALID-OBJECT(fiscal) THEN ready=fiscal:GetCharacter("contract")="container-rules-v1" AND fiscal:GetLogical("onUpdate").
  END.
 END.
 result=NEW JsonObject(). result:Add("contract","container-item-rules-v1").
 result:Add("afterChange",ready AND financePath<>? AND paymentPath<>?). result:Add("nextItemId",TRUE).
END PROCEDURE.
PROCEDURE NextItemId:
 DEFINE OUTPUT PARAMETER valueId AS INTEGER NO-UNDO.
 RUN RequireTransaction.
 valueId=DYNAMIC-NEXT-VALUE("seq_itens_container","espec").
 IF valueId=? OR valueId<=0 THEN UNDO, THROW NEW Progress.Lang.AppError("CONTAINER_SEQUENCE_UNAVAILABLE: sequencia de itens indisponivel.",1).
END PROCEDURE.
PROCEDURE NextLedgerId:
 DEFINE OUTPUT PARAMETER valueId AS INTEGER NO-UNDO.
 RUN RequireTransaction.
 valueId=DYNAMIC-NEXT-VALUE("seq_cta_corren_fornec_imp","espec").
 IF valueId=? OR valueId<=0 THEN UNDO, THROW NEW Progress.Lang.AppError("CONTAINER_SEQUENCE_UNAVAILABLE: sequencia financeira indisponivel.",1).
END PROCEDURE.
PROCEDURE AfterChange:
 DEFINE INPUT PARAMETER master AS HANDLE NO-UNDO.
 DEFINE INPUT PARAMETER ctx AS JsonObject NO-UNDO.
 DEFINE OUTPUT PARAMETER result AS JsonObject NO-UNDO.
 DEFINE VARIABLE fiscalCtx AS JsonObject NO-UNDO.
 DEFINE VARIABLE fiscal AS JsonObject NO-UNDO.
 DEFINE VARIABLE financial AS JsonObject NO-UNDO.
 DEFINE VARIABLE financialPolicy AS JsonObject NO-UNDO.
 DEFINE VARIABLE changes AS JsonArray NO-UNDO.
 DEFINE VARIABLE warnings AS JsonArray NO-UNDO.
 DEFINE VARIABLE n AS INTEGER NO-UNDO.
 RUN RequireTransaction.
 IF NOT VALID-HANDLE(master) OR NOT VALID-OBJECT(ctx) THEN UNDO, THROW NEW Progress.Lang.AppError("CONTAINER_RULE_CONTEXT: contexto ausente.",1).
 IF NOT master:AVAILABLE THEN UNDO, THROW NEW Progress.Lang.AppError("CONTAINER_RULE_CONTEXT: mestre nao localizado.",1).
 currentContainer=master:BUFFER-FIELD("nr-container"):BUFFER-VALUE.
 IF currentContainer<>ctx:GetInteger("container_id") OR NOT master:FIND-BY-ROWID(master:ROWID,EXCLUSIVE-LOCK,NO-WAIT) THEN
  UNDO, THROW NEW Progress.Lang.AppError("CONTAINER_BUSY: contexto do mestre divergente ou em uso.",1).
 IF financePath=? OR paymentPath=? THEN UNDO, THROW NEW Progress.Lang.AppError("CONTAINER_RULE_UNAVAILABLE: composicao financeira nao publicada.",1).
 fiscalCtx=NEW JsonObject(). fiscalCtx:Add("operation","update"). fiscalCtx:Add("container_id",currentContainer).
 RUN OnUpdate IN phFiscalRules(master,fiscalCtx,OUTPUT fiscal).
 IF NOT VALID-OBJECT(fiscal) OR NOT fiscal:GetLogical("success") THEN UNDO, THROW NEW Progress.Lang.AppError("CONTAINER_RULE_UNAVAILABLE: sincronizacao fiscal recusada.",1).
 RUN RunFinancial(master,ctx,OUTPUT financial).
 changes=CAST(fiscal:GetJsonArray("changes"):Clone(),JsonArray). warnings=NEW JsonArray().
 DO n=1 TO financial:GetJsonArray("changes"):Length: changes:Add(CAST(financial:GetJsonArray("changes"):GetJsonObject(n):Clone(),JsonObject)). END.
 IF fiscal:Has("warnings") THEN DO n=1 TO fiscal:GetJsonArray("warnings"):Length: warnings:Add(fiscal:GetJsonArray("warnings"):GetCharacter(n)). END.
 IF financial:Has("warnings") THEN DO n=1 TO financial:GetJsonArray("warnings"):Length:
  IF financial:GetJsonArray("warnings"):GetType(n)=JsonDataType:OBJECT THEN warnings:Add(financial:GetJsonArray("warnings"):GetJsonObject(n):GetCharacter("message")).
  ELSE warnings:Add(financial:GetJsonArray("warnings"):GetCharacter(n)).
 END.
 result=NEW JsonObject(). result:Add("success",TRUE). result:Add("changes",changes). result:Add("warnings",warnings).
END PROCEDURE.
PROCEDURE RunFinancial:
 DEFINE INPUT PARAMETER master AS HANDLE NO-UNDO.
 DEFINE INPUT PARAMETER ctx AS JsonObject NO-UNDO.
 DEFINE OUTPUT PARAMETER result AS JsonObject NO-UNDO.
 DEFINE VARIABLE actorPolicy AS JsonObject NO-UNDO.
 RUN RequireTransaction.
 IF NOT master:AVAILABLE OR NOT VALID-OBJECT(ctx) THEN UNDO, THROW NEW Progress.Lang.AppError("CONTAINER_RULE_CONTEXT: mestre/contexto financeiro ausente.",1).
 currentContainer=master:BUFFER-FIELD("nr-container"):BUFFER-VALUE.
 IF currentContainer<>ctx:GetInteger("container_id") OR NOT master:FIND-BY-ROWID(master:ROWID,EXCLUSIVE-LOCK,NO-WAIT) THEN UNDO, THROW NEW Progress.Lang.AppError("CONTAINER_BUSY: contexto financeiro divergente ou em uso.",1).
 IF financePath=? OR paymentPath=? THEN UNDO, THROW NEW Progress.Lang.AppError("CONTAINER_RULE_UNAVAILABLE: composicao financeira nao publicada.",1).
 actorPolicy=NEW JsonObject(). actorPolicy:Add("actor",CAST(poPolicy:GetJsonObject("actor"):Clone(),JsonObject)).
 RUN VALUE(financePath)(phItems,phPurchaseItems,phPurchases,phLedger,phOrderPayments,phContainerPayments,phAllContainers,THIS-PROCEDURE,actorPolicy,ctx,OUTPUT result).
 IF NOT VALID-OBJECT(result) OR NOT result:GetLogical("success") THEN UNDO, THROW NEW Progress.Lang.AppError("CONTAINER_RULE_UNAVAILABLE: rateios financeiros recusados.",1).
END PROCEDURE.
PROCEDURE CollectContainerPayments:
 DEFINE INPUT PARAMETER master AS HANDLE NO-UNDO.
 DEFINE OUTPUT PARAMETER rows AS JsonArray NO-UNDO.
 DEFINE VARIABLE q AS HANDLE NO-UNDO.
 DEFINE VARIABLE source AS HANDLE NO-UNDO.
 RUN RequireTransaction.
 IF NOT master:AVAILABLE OR master:BUFFER-FIELD("nr-container"):BUFFER-VALUE<>currentContainer THEN UNDO, THROW NEW Progress.Lang.AppError("CONTAINER_RULE_CONTEXT: pagamentos de outro container.",1).
 RUN ContainerCreateSiblingBuffer(phContainerPayments,"bItemsCurrencyContainerLinks",OUTPUT source).
 DO ON ERROR UNDO, THROW:
  RUN PrepareLinks(source,"container_id",currentContainer,OUTPUT q).
  RUN ReadCurrencyRows(OUTPUT rows).
  FINALLY:
   IF VALID-HANDLE(q) THEN DO: q:QUERY-CLOSE() NO-ERROR. DELETE OBJECT q NO-ERROR. END.
   IF VALID-HANDLE(source) THEN DELETE OBJECT source NO-ERROR.
  END FINALLY.
 END.
END PROCEDURE.
PROCEDURE CollectOrderPayments:
 DEFINE INPUT PARAMETER purchase AS HANDLE NO-UNDO.
 DEFINE OUTPUT PARAMETER rows AS JsonArray NO-UNDO.
 DEFINE VARIABLE q AS HANDLE NO-UNDO.
 DEFINE VARIABLE source AS HANDLE NO-UNDO.
 DEFINE VARIABLE orderId AS INTEGER NO-UNDO.
 RUN RequireTransaction.
 IF NOT purchase:AVAILABLE THEN UNDO, THROW NEW Progress.Lang.AppError("CONTAINER_RULE_CONTEXT: pedido de compra nao localizado.",1).
 orderId=purchase:BUFFER-FIELD("proc_compra_id"):BUFFER-VALUE.
 RUN ContainerCreateSiblingBuffer(phOrderPayments,"bItemsCurrencyOrderLinks",OUTPUT source).
 DO ON ERROR UNDO, THROW:
  RUN PrepareLinks(source,"proc_compra_id",orderId,OUTPUT q).
  RUN ReadCurrencyRows(OUTPUT rows).
  FINALLY:
   IF VALID-HANDLE(q) THEN DO: q:QUERY-CLOSE() NO-ERROR. DELETE OBJECT q NO-ERROR. END.
   IF VALID-HANDLE(source) THEN DELETE OBJECT source NO-ERROR.
  END FINALLY.
 END.
END PROCEDURE.
PROCEDURE PrepareLinks:
 DEFINE INPUT PARAMETER source AS HANDLE NO-UNDO.
 DEFINE INPUT PARAMETER fk AS CHARACTER NO-UNDO.
 DEFINE INPUT PARAMETER valueId AS INTEGER NO-UNDO.
 DEFINE OUTPUT PARAMETER q AS HANDLE NO-UNDO.
 EMPTY TEMP-TABLE ttCurrencyLinks.
 CREATE QUERY q. q:SET-BUFFERS(source).
 IF NOT q:QUERY-PREPARE("FOR EACH " + source:NAME + " WHERE " + source:NAME + "." + fk + "=" + TRIM(STRING(valueId,"->>>>>>>>>9"))) THEN
  UNDO, THROW NEW Progress.Lang.AppError("CONTAINER_CONFIGURATION: consulta fixa de pagamentos invalida.",1).
 q:QUERY-OPEN(). q:GET-FIRST(SHARE-LOCK,NO-WAIT) NO-ERROR.
 DO WHILE NOT q:QUERY-OFF-END:
  IF source:LOCKED OR ERROR-STATUS:ERROR THEN UNDO, THROW NEW Progress.Lang.AppError("CONTAINER_BUSY: vinculo financeiro em uso.",1).
  IF NOT CAN-FIND(FIRST ttCurrencyLinks WHERE ttCurrencyLinks.container_id=currentContainer AND ttCurrencyLinks.num_id_tit_ap=source:BUFFER-FIELD("num_id_tit_ap"):BUFFER-VALUE) THEN DO:
   CREATE ttCurrencyLinks. ASSIGN ttCurrencyLinks.container_id=currentContainer ttCurrencyLinks.num_id_tit_ap=source:BUFFER-FIELD("num_id_tit_ap"):BUFFER-VALUE.
  END.
  q:GET-NEXT(SHARE-LOCK,NO-WAIT) NO-ERROR.
 END.
 IF ERROR-STATUS:ERROR THEN UNDO, THROW NEW Progress.Lang.AppError("CONTAINER_BUSY: leitura financeira nao confirmada.",1).
END PROCEDURE.
PROCEDURE ReadCurrencyRows:
 DEFINE OUTPUT PARAMETER rows AS JsonArray NO-UNDO.
 DEFINE VARIABLE response AS JsonObject NO-UNDO.
 DEFINE VARIABLE policy AS JsonObject NO-UNDO.
 DEFINE VARIABLE paymentMaster AS HANDLE NO-UNDO.
 RUN RequireTransaction.
 /* Same central conversion used by cost/version collection; adapters only
    normalize trusted link FKs. Do not infer currency from the payment grid. */
 policy=CAST(poFinancePolicy:Clone(),JsonObject). policy:Add("capture_rows",TRUE).
 RUN ContainerCreateSiblingBuffer(phMaster,"bItemsCurrencyMaster",OUTPUT paymentMaster).
 DO ON ERROR UNDO, THROW:
  RUN VALUE(paymentPath)(INPUT paymentMaster,INPUT BUFFER ttCurrencyLinks:HANDLE,INPUT phTitAp,INPUT phValTitAp,INPUT policy,INPUT currentContainer,OUTPUT response).
  IF NOT response:GetLogical("success") THEN UNDO, THROW NEW Progress.Lang.AppError(response:GetJsonObject("error"):GetCharacter("code") + ": " + response:GetJsonObject("error"):GetCharacter("message"),1).
  rows=CAST(response:GetJsonObject("data"):GetJsonArray("payment_rows"):Clone(),JsonArray).
  FINALLY:
   IF VALID-HANDLE(paymentMaster) THEN DELETE OBJECT paymentMaster NO-ERROR.
   IF VALID-OBJECT(policy) THEN DELETE OBJECT policy NO-ERROR.
   IF VALID-OBJECT(response) THEN DELETE OBJECT response NO-ERROR.
  END FINALLY.
 END.
END PROCEDURE.
