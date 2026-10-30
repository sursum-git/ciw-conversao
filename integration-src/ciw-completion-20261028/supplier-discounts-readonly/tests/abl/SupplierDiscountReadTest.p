BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
{ImportDiscountSourceFixtures.i}
{ImportDiscountCurrentFixtures.i}
DEFINE VARIABLE requestValue AS JsonObject NO-UNDO.
DEFINE VARIABLE responseValue AS JsonObject NO-UNDO.
DEFINE VARIABLE parser AS ObjectModelParser NO-UNDO.
DEFINE VARIABLE textValue AS LONGCHAR NO-UNDO.
DEFINE VARIABLE keyValue AS CHARACTER NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE supplierValue AS INTEGER NO-UNDO INITIAL 7.
DEFINE VARIABLE resourceValue AS CHARACTER NO-UNDO INITIAL 'import_descontos_fornecedor'.
OUTPUT TO 'supplier-discounts-tests.log'.
DO ON ERROR UNDO, THROW:
 RUN Check(NUM-DBS=0,'zero databases').
 DO n=1 TO 205:
  CREATE discountSource. ASSIGN discountSource.desconto_importacao_id=n discountSource.item_container_id=42 discountSource.fornecedor_id=7 discountSource.motivo_desconto_id=8 discountSource.descricao=' SAME RAW ' discountSource.vl_dolar_autorizado=IF n=2 THEN ? ELSE 100 discountSource.arquivo=IF n=2 THEN ? ELSE ' raw arquivo.pdf '. RELEASE discountSource.
 END.
 /* More than the total budget exists for another supplier. Scope precedes aggregate. */
 DO n=206 TO 50206:
  CREATE discountSource. ASSIGN discountSource.desconto_importacao_id=n discountSource.fornecedor_id=8. RELEASE discountSource.
 END.
 CREATE discountSource. ASSIGN discountSource.desconto_importacao_id=0 discountSource.fornecedor_id=0 discountSource.vl_dolar_autorizado=0. RELEASE discountSource.
 CREATE discountSource. ASSIGN discountSource.desconto_importacao_id=-1 discountSource.fornecedor_id=-9 discountSource.vl_dolar_autorizado=10. RELEASE discountSource.
 CREATE discountSource. ASSIGN discountSource.desconto_importacao_id=-2 discountSource.fornecedor_id=? discountSource.vl_dolar_autorizado=10. RELEASE discountSource.
 CREATE ledgerSource. ASSIGN ledgerSource.cta_corren_desconto_id=1 ledgerSource.desconto_importacao_id=1 ledgerSource.valor_utilizado=10. RELEASE ledgerSource.
 CREATE ledgerSource. ASSIGN ledgerSource.cta_corren_desconto_id=2 ledgerSource.desconto_importacao_id=1 ledgerSource.valor_utilizado=?. RELEASE ledgerSource.
 CREATE ledgerSource. ASSIGN ledgerSource.cta_corren_desconto_id=3 ledgerSource.desconto_importacao_id=2 ledgerSource.valor_utilizado=?. RELEASE ledgerSource.
 CREATE currentEmitter. ASSIGN currentEmitter.cod-emitente=7 currentEmitter.nome-abrev='CURRENT SEVEN'. RELEASE currentEmitter.
 CREATE currentEmitter. ASSIGN currentEmitter.cod-emitente=0 currentEmitter.nome-abrev='CURRENT ZERO'. RELEASE currentEmitter.
 CREATE currentEmitter. ASSIGN currentEmitter.cod-emitente=-9 currentEmitter.nome-abrev='CURRENT NEGATIVE'. RELEASE currentEmitter.
 CREATE currentReason. ASSIGN currentReason.motivo_desconto_id=8 currentReason.descricao='CURRENT REASON'. RELEASE currentReason.
 RUN Request('read'). requestValue:Add('take',200). RUN Invoke.
 RUN Check(responseValue:GetLogical('success'),'fixed supplier resource accepted').
 RUN Check(responseValue:GetInteger('total')=205 AND responseValue:GetJsonArray('data'):Length=200,'all supplier rows and page200 despite50k unrelated headers').
 RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('item_container_id')=42 AND responseValue:GetJsonArray('data'):GetJsonObject(2):GetInteger('item_container_id')=42,'itemID duplicates preserved').
 RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('desconto_importacao_id')=1 AND responseValue:GetJsonArray('data'):GetJsonObject(2):GetInteger('desconto_importacao_id')=2,'hidden physical identities remain different').
 RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetDecimal('vl_utiliz')=10 AND responseValue:GetJsonArray('data'):GetJsonObject(1):GetDecimal('vl_saldo')=90,'unique existing collector computes usage and balance').
 RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(2):GetDecimal('vl_utiliz')=0 AND responseValue:GetJsonArray('data'):GetJsonObject(2):IsNull('vl_utiliz_detalhe') AND responseValue:GetJsonArray('data'):GetJsonObject(2):IsNull('vl_saldo'),'allNULLSUM/coalesce0 and NULLauthorized preserved').
 RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('arquivo')=' raw arquivo.pdf ' AND responseValue:GetJsonArray('data'):GetJsonObject(2):IsNull('arquivo'),'arquivo raw text/NULL only').
 RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('fornecedor_nome_abrev_atual')='CURRENT SEVEN' AND responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('motivo_descricao_atual')='CURRENT REASON','same existing fixed lookup helper').
 keyValue=responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('record_key').
 responseValue:WriteFile('supplier-discounts-actual.json',TRUE).
 RUN Request('get'). requestValue:Add('id',keyValue). requestValue:Add('record_key',keyValue). RUN Invoke.
 RUN Check(responseValue:GetJsonObject('data'):GetInteger('desconto_importacao_id')=1,'get same physical key').
 requestValue:Set('record_key',keyValue + ' '). RUN Invoke. RUN Code(422).
 supplierValue=9. RUN Request('get'). requestValue:Add('id',keyValue). RUN Invoke. RUN Code(404).
 supplierValue=7. RUN Request('read'). requestValue:Add('skip',200). requestValue:Add('take',200). RUN Invoke.
 RUN Check(responseValue:GetJsonArray('data'):Length=5,'page after200 in same supplier').
 RUN Request('read'). requestValue:Add('filter',NEW JsonObject()). requestValue:GetJsonObject('filter'):Add('field','vl_saldo'). requestValue:GetJsonObject('filter'):Add('operator','eq'). requestValue:GetJsonObject('filter'):Add('value',90). RUN Invoke.
 RUN Check(responseValue:GetInteger('total')=1,'existing balance filter after unique aggregate').
 supplierValue=0. RUN Request('read'). RUN Invoke.
 RUN Check(responseValue:GetInteger('total')=1 AND responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('desconto_importacao_id')=0,'zero supplier and physical PK0 allowed by source').
 RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('fornecedor_nome_abrev_atual')='CURRENT ZERO','zero lookup is not positiveFK invented').
 keyValue=responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('record_key'). RUN Request('get'). requestValue:Add('id',keyValue). RUN Invoke.
 RUN Check(responseValue:GetJsonObject('data'):GetInteger('fornecedor_id')=0,'get preserves zero owner').
 responseValue:WriteFile('supplier-zero-actual.json',TRUE).
 supplierValue=-9. RUN Request('read'). RUN Invoke.
 RUN Check(responseValue:GetInteger('total')=1 AND responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('fornecedor_id')=-9,'negative supplier preserved').
 RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('fornecedor_nome_abrev_atual')='CURRENT NEGATIVE','negative lookup reuses helper exactly').
 responseValue:WriteFile('supplier-negative-actual.json',TRUE).
 supplierValue=2147483647. RUN Request('read'). RUN Invoke. RUN Check(responseValue:GetInteger('total')=0,'maxsignedcontext no supplier FK lookup required').
 supplierValue=-2147483648. RUN Request('read'). RUN Invoke. RUN Check(responseValue:GetInteger('total')=0,'minsignedcontext accepted').
 RUN Request('read'). requestValue:Remove('fornecedor_id'). RUN Invoke. RUN Code(422).
 RUN Request('read'). requestValue:Remove('fornecedor_id'). requestValue:AddNull('fornecedor_id'). RUN Invoke. RUN Code(422).
 RUN Request('read'). requestValue:Set('fornecedor_id',1.5). RUN Invoke. RUN Code(422).
 RUN Request('read'). requestValue:Set('fornecedor_id',2147483648). RUN Invoke. RUN Code(422).
 RUN Request('read'). requestValue:Set('fornecedor_id','7'). RUN Invoke. RUN Code(422).
 RUN Request('read'). requestValue:Add('fornec_id',7). RUN Invoke. RUN Code(422).
 RUN Request('read'). requestValue:Add('empresa_id',5). RUN Invoke. RUN Code(422).
 RUN Request('read'). requestValue:Add('take',201). RUN Invoke. RUN Code(422).
 RUN Request('update'). RUN Invoke. RUN Code(405).
 RUN Check(NOT responseValue:Has('data'),'negative has no partial data').
 RUN Check(NUM-DBS=0 AND NOT TRANSACTION,'zero DB/no transaction').
 PUT UNFORMATTED 'PASS ' checks ' checks' SKIP.
 CATCH err AS Progress.Lang.Error: PUT UNFORMATTED 'FAIL checks=' checks ' error=' err:GetMessage(1) SKIP. END CATCH.
END.
OUTPUT CLOSE. QUIT.
PROCEDURE Request:
 DEFINE INPUT PARAMETER op AS CHARACTER NO-UNDO.
 requestValue=NEW JsonObject(). requestValue:Add('operation',op). requestValue:Add('fornecedor_id',supplierValue).
END PROCEDURE.
PROCEDURE Invoke:
 RUN VALUE('sursum-api/programs/ImportDiscountsReadService.r')(INPUT BUFFER discountSource:HANDLE,INPUT BUFFER ledgerSource:HANDLE,INPUT BUFFER currentAllocation:HANDLE,INPUT BUFFER currentPurchaseItem:HANDLE,INPUT BUFFER currentEmitter:HANDLE,INPUT BUFFER currentReason:HANDLE,resourceValue,requestValue,OUTPUT responseValue).
END PROCEDURE.
PROCEDURE Code:
 DEFINE INPUT PARAMETER statusValue AS INTEGER NO-UNDO.
 RUN Check(NOT responseValue:GetLogical('success') AND responseValue:GetJsonObject('error'):GetInteger('status')=statusValue,'closed negative').
END PROCEDURE.
PROCEDURE Check:
 DEFINE INPUT PARAMETER ok AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER labelValue AS CHARACTER NO-UNDO.
 checks=checks + 1. IF ok<>TRUE OR ok=? THEN UNDO,THROW NEW Progress.Lang.AppError(labelValue,1).
END PROCEDURE.
