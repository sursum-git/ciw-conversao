BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
{ImportDiscountSourceFixtures.i}
{ImportDiscountCurrentFixtures.i}
DEFINE TEMP-TABLE brokenLedger NO-UNDO FIELD unrelated AS INTEGER.
DEFINE VARIABLE servicePath AS CHARACTER NO-UNDO.
DEFINE VARIABLE resourceName AS CHARACTER CASE-SENSITIVE NO-UNDO INITIAL 'import_descontos_geral'.
DEFINE VARIABLE requestValue AS JsonObject NO-UNDO.
DEFINE VARIABLE responseValue AS JsonObject NO-UNDO.
DEFINE VARIABLE ledgerHandle AS HANDLE NO-UNDO.
DEFINE VARIABLE emitterHandle AS HANDLE NO-UNDO.
DEFINE VARIABLE keyValue AS CHARACTER NO-UNDO.
DEFINE VARIABLE i AS INTEGER NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
servicePath=SEARCH('sursum-api/programs/ImportDiscountsReadService.r').
RUN Check(servicePath<>?,'discount read service is available').
DO i=1 TO 205:
 CREATE discountSource. ASSIGN discountSource.desconto_importacao_id=i discountSource.item_container_id=100 + i discountSource.fornecedor_id=500 + i discountSource.motivo_desconto_id=8 discountSource.descricao=' RAW ' discountSource.log_credito=IF i=1 THEN ? ELSE TRUE discountSource.vl_real=? discountSource.vl_dolar_autorizado=100 discountSource.dt_autorizacao=DATE(10,28,2026). RELEASE discountSource.
END.
DO i=1 TO 2:
 CREATE ledgerSource. ASSIGN ledgerSource.cta_corren_desconto_id=1000 + i ledgerSource.desconto_importacao_id=i ledgerSource.container_id=600 + i ledgerSource.valor_utilizado=IF i=1 THEN 10 ELSE ? ledgerSource.data=? ledgerSource.cod_usuario=DATE(2,3,2024). RELEASE ledgerSource.
END.
ledgerHandle=BUFFER ledgerSource:HANDLE.
emitterHandle=BUFFER currentEmitter:HANDLE.
CREATE currentAllocation. ASSIGN currentAllocation.item_container_id=101 currentAllocation.item_proc_compra_id=10001. RELEASE currentAllocation.
CREATE currentAllocation. ASSIGN currentAllocation.item_container_id=305 currentAllocation.item_proc_compra_id=10005. RELEASE currentAllocation.
CREATE currentPurchaseItem. ASSIGN currentPurchaseItem.item_proc_compra_id=10001 currentPurchaseItem.codigo_erp='CURRENT-CODE' currentPurchaseItem.descricao='CURRENT ITEM'. RELEASE currentPurchaseItem.
CREATE currentPurchaseItem. ASSIGN currentPurchaseItem.item_proc_compra_id=10005 currentPurchaseItem.codigo_erp='LAST-CODE' currentPurchaseItem.descricao='LAST ITEM'. RELEASE currentPurchaseItem.
CREATE currentEmitter. ASSIGN currentEmitter.cod-emitente=501 currentEmitter.nome-abrev='CURRENT SUPPLIER' currentEmitter.identific=1. RELEASE currentEmitter.
CREATE currentReason. ASSIGN currentReason.motivo_desconto_id=8 currentReason.descricao='CURRENT REASON' currentReason.log_considerar_custo=0. RELEASE currentReason.
RUN Parse('~{"operation":"read","take":200}'). RUN Invoke.
RUN Check(responseValue:GetLogical('success') AND responseValue:GetInteger('total')=205 AND responseValue:GetJsonArray('data'):Length=200,'global list and max page preserve all discounts without MED predicate').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetDecimal('vl_utiliz')=10 AND responseValue:GetJsonArray('data'):GetJsonObject(1):GetDecimal('vl_utiliz_detalhe')=10,'same response exposes explicit list and detail utilization').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(2):GetDecimal('vl_utiliz')=0 AND responseValue:GetJsonArray('data'):GetJsonObject(2):IsNull('vl_utiliz_detalhe'),'all-null utilization differs in explicit detail field').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):IsNull('vl_real') AND responseValue:GetJsonArray('data'):GetJsonObject(1):IsNull('log_credito'),'physical monetary and logical unknowns retained').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('dt_autorizacao')='2026-10-28','physical header date is ISO independent of numeric culture').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('item_codigo_erp_atual')='CURRENT-CODE' AND responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('item_descricao_atual')='CURRENT ITEM','current item join returns code and description in one lookup').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('fornecedor_nome_abrev_atual')='CURRENT SUPPLIER' AND responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('motivo_descricao_atual')='CURRENT REASON','current supplier and reason have no invented identific or cost predicate').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(2):IsNull('item_descricao_atual') AND responseValue:GetJsonArray('data'):GetJsonObject(2):GetInteger('item_container_id')=102 AND responseValue:GetJsonArray('data'):GetJsonObject(2):IsNull('fornecedor_nome_abrev_atual'),'missing current names preserve physical original IDs').
keyValue=responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('record_key').
RUN Parse('~{"operation":"get"}'). requestValue:Add('id',keyValue). requestValue:Add('record_key',keyValue). RUN Invoke.
RUN Check(responseValue:GetJsonObject('data'):GetInteger('desconto_importacao_id')=1 AND responseValue:GetJsonObject('data'):GetDecimal('vl_saldo')=90,'full-key header detail uses same balance').
requestValue:Set('record_key',keyValue + ' '). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","skip":200,"take":200}'). RUN Invoke. RUN Check(responseValue:GetJsonArray('data'):Length=5,'page beyond first200').
RUN Parse('~{"operation":"read","sort":[~{"field":"desconto_importacao_id","dir":"desc"}],"take":1}'). RUN Invoke.
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('desconto_importacao_id')=205,'sort occurs globally before pagination').
RUN Parse('~{"operation":"read","filter":~{"field":"vl_saldo","operator":"eq","value":100}}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=204,'computed balance filter occurs after the unique aggregate').
RUN Parse('~{"operation":"read","filter":~{"field":"vl_utiliz_detalhe","operator":"isnull"}}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=204,'nullable detail sum is filterable without converting to zero').
RUN Parse('~{"operation":"read","filter":~{"field":"item_descricao_atual","operator":"eq","value":"LAST ITEM"},"take":1}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=1 AND responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('desconto_importacao_id')=205,'current item description filter finds rows beyond first200').
FIND currentPurchaseItem WHERE currentPurchaseItem.item_proc_compra_id=10001. currentPurchaseItem.descricao='UPDATED CURRENT ITEM'. RELEASE currentPurchaseItem.
RUN Parse('~{"operation":"read","filter":~{"field":"item_descricao_atual","operator":"eq","value":"UPDATED CURRENT ITEM"}}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=1,'current item labels update between requests without cache').
RUN Parse('~{"operation":"read","filter":~{"field":"fornecedor_nome_abrev_atual","operator":"eq","value":"CURRENT SUPPLIER"}}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=1,'supplier name is filterable before pagination').
RUN Parse('~{"operation":"read","filter":~{"field":"motivo_descricao_atual","operator":"eq","value":"CURRENT REASON"}}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=205,'reason description does not add a cost eligibility filter').
RUN Parse('~{"operation":"read","desconto_importacao_id":1}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","empresa_id":5}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","read_max_rows":1}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"update"}'). RUN Invoke. RUN Code(405).
RUN Parse('~{"operation":"read","take":201}'). RUN Invoke. RUN Code(422).
resourceName='import_descontos_lancamentos'.
RUN Parse('~{"operation":"read","desconto_importacao_id":1}'). RUN Invoke.
RUN Check(responseValue:GetLogical('success') AND responseValue:GetInteger('total')=1,'ledger belongs to selected discount').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('cod_usuario')='2024-02-03' AND responseValue:GetJsonArray('data'):GetJsonObject(1):IsNull('data'),'physical cod_usuario DATE is not a user identity').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('container_id')=601,'global source does not imply container MED ownership').
keyValue=responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('record_key').
RUN Check(INDEX(keyValue,'desconto_importacao_id')>0 AND INDEX(keyValue,'cta_corren_desconto_id')>0,'ledger identity includes owner context and complete physical PK').
RUN Parse('~{"operation":"get","desconto_importacao_id":1}'). requestValue:Add('id',keyValue). requestValue:Add('record_key',keyValue). RUN Invoke.
RUN Check(responseValue:GetJsonObject('data'):GetInteger('cta_corren_desconto_id')=1001,'ledger exact full key get').
requestValue:Set('record_key',keyValue + ' '). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"get","desconto_importacao_id":2}'). requestValue:Add('id',keyValue). RUN Invoke. RUN Code(404).
RUN Parse('~{"operation":"read","desconto_importacao_id":3}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=0,'existing discount with no usage has an empty ledger').
RUN Parse('~{"operation":"read","desconto_importacao_id":999}'). RUN Invoke. RUN Code(404).
RUN Check(NOT responseValue:Has('data'),'missing owner has no partial data').
RUN Parse('~{"operation":"read"}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","desconto_importacao_id":1.5}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","desconto_importacao_id":1,"cod_usuario":"actor"}'). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"create","desconto_importacao_id":1}'). RUN Invoke. RUN Code(405).
ledgerHandle=BUFFER brokenLedger:HANDLE.
RUN Parse('~{"operation":"read","desconto_importacao_id":1}'). RUN Invoke. RUN Code(503).
RUN Check(NOT responseValue:Has('data'),'configuration failure yields no partial rows').
ledgerHandle=BUFFER ledgerSource:HANDLE. resourceName='IMPORT_DESCONTOS_GERAL'.
RUN Parse('~{"operation":"read"}'). RUN Invoke. RUN Code(422).
resourceName='import_descontos_geral'. emitterHandle=BUFFER brokenLedger:HANDLE.
RUN Parse('~{"operation":"read"}'). RUN Invoke. RUN Code(503).
RUN Check(NOT responseValue:Has('data'),'current lookup query failure never returns partial discount rows').
RUN Check(NUM-DBS=0 AND NOT TRANSACTION,'read test only uses TT and leaves no transaction').
OUTPUT TO 'read-tests.log'. PUT UNFORMATTED 'PASS ' checks ' NUMDBS=' NUM-DBS SKIP. OUTPUT CLOSE.
PROCEDURE Invoke:
 RUN VALUE(servicePath)(INPUT BUFFER discountSource:HANDLE,ledgerHandle,INPUT BUFFER currentAllocation:HANDLE,INPUT BUFFER currentPurchaseItem:HANDLE,emitterHandle,INPUT BUFFER currentReason:HANDLE,resourceName,requestValue,OUTPUT responseValue).
END PROCEDURE.
PROCEDURE Parse:
 DEFINE INPUT PARAMETER valueText AS LONGCHAR NO-UNDO.
 DEFINE VARIABLE utf8Value AS LONGCHAR NO-UNDO.
 DEFINE VARIABLE parser AS ObjectModelParser NO-UNDO.
 FIX-CODEPAGE(utf8Value)='UTF-8'. utf8Value=valueText.
 parser=NEW ObjectModelParser(). requestValue=CAST(parser:Parse(utf8Value),JsonObject). DELETE OBJECT parser.
END PROCEDURE.
PROCEDURE Code:
 DEFINE INPUT PARAMETER expected AS INTEGER NO-UNDO.
 RUN Check(NOT responseValue:GetLogical('success') AND responseValue:GetJsonObject('error'):GetInteger('status')=expected,'expected closed response ' + STRING(expected)).
END PROCEDURE.
PROCEDURE Check:
 DEFINE INPUT PARAMETER checkedValue AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER messageValue AS CHARACTER NO-UNDO.
 IF checkedValue<>TRUE THEN UNDO, THROW NEW Progress.Lang.AppError(messageValue,1).
 checks=checks + 1.
END PROCEDURE.
