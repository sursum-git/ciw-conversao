BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE TEMP-TABLE ttAllocation NO-UNDO FIELD item_container_id AS INTEGER FIELD item_proc_compra_id AS INTEGER INDEX pk IS PRIMARY item_container_id.
DEFINE TEMP-TABLE ttPurchase NO-UNDO FIELD item_proc_compra_id AS INTEGER FIELD descricao AS CHARACTER FIELD codigo_erp AS CHARACTER INDEX pk IS PRIMARY item_proc_compra_id.
DEFINE VARIABLE snapshot AS JsonObject NO-UNDO.
DEFINE VARIABLE headerValue AS JsonObject NO-UNDO.
DEFINE VARIABLE itemValue AS JsonObject NO-UNDO.
DEFINE VARIABLE valuesArray AS JsonArray NO-UNDO.
DEFINE VARIABLE outputValue AS JsonObject NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE reads AS INTEGER NO-UNDO.
DEFINE VARIABLE started AS INTEGER NO-UNDO.
DEFINE VARIABLE currencyValue AS CHARACTER NO-UNDO.
OUTPUT TO 'comparison-materializer-tests.log'.
DO ON ERROR UNDO, THROW:
 started=ETIME. currencyValue='real'.
 RUN Check(NUM-DBS=0,'zero databases').
 CREATE ttAllocation. ttAllocation.item_container_id=1. ttAllocation.item_proc_compra_id=3. RELEASE ttAllocation.
 CREATE ttPurchase. ttPurchase.item_proc_compra_id=3. ttPurchase.descricao=?. ttPurchase.codigo_erp=?. RELEASE ttPurchase.
 RUN Fixture. RUN Invoke.
 RUN Check(outputValue:GetLogical('success'),'snapshot projection succeeds').
 valuesArray=outputValue:GetJsonArray('data').
 RUN Check(valuesArray:Length=1,'source inner join excludes missing current allocation').
 itemValue=valuesArray:GetJsonObject(1).
 RUN Check(itemValue:IsNull('codigo_erp') AND itemValue:IsNull('descricao'),'existing join NULL text remains').
 RUN Check(itemValue:GetInteger('container_id')=123 AND itemValue:GetInteger('versao_id')=7 AND itemValue:GetInteger('item_container_custo_id')=101,'complete selected ownership').
 RUN Check(itemValue:GetDecimal('vl_unit_sem_distr_custo')=11,'BRL uses selected persisted fields').
 RUN Check(itemValue:GetCharacter('_projection_error')='','normal row has no deferred query error').
 currencyValue='dolar'. RUN Fixture. RUN Invoke.
 itemValue=outputValue:GetJsonArray('data'):GetJsonObject(1).
 RUN Check(itemValue:GetDecimal('vl_unit_sem_distr_custo')=22,'USD same helper with persisted USD inputs').
 RUN Check(itemValue:GetDecimal('vl_desp_prev_perc_fixo')=10,'version header percent reused').
 currencyValue='real'. RUN Fixture.
 snapshot:GetJsonArray('items'):GetJsonObject(1):Set('vl_unit_prev',0). RUN Invoke.
 RUN Check(outputValue:GetLogical('success'),'known query error deferred until shared filter selects row').
 RUN Check(outputValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('_projection_error')='COMPARISON_ZERO_DIVISOR','deferred code never fabricated unit zero').
 RUN Fixture. snapshot:GetJsonObject('header'):Set('container_id',124). RUN Invoke.
 RUN Check(outputValue:GetJsonObject('error'):GetCharacter('code')='COMPARISON_CONTEXT','crossowner snapshot rejected').
 RUN Check(NOT outputValue:Has('data'),'context failure no partial data').
 RUN Check(NUM-DBS=0,'zero databases after').
 PUT UNFORMATTED 'PASS ' checks ' checks' SKIP.
 CATCH err AS Progress.Lang.Error: PUT UNFORMATTED 'FAIL checks=' checks ' errorNumber=' err:GetMessageNum(1) SKIP. END CATCH.
END.
OUTPUT CLOSE. QUIT.
PROCEDURE Fixture:
 headerValue=NEW JsonObject(). headerValue:Add('container_id',123). headerValue:Add('versao_id',7). headerValue:Add('perc_fixo_container',5).
 valuesArray=NEW JsonArray().
 RUN Row(101,1). valuesArray:Add(itemValue). RUN Row(102,2). valuesArray:Add(itemValue).
 snapshot=NEW JsonObject(). snapshot:Add('header',headerValue). snapshot:Add('items',valuesArray).
END PROCEDURE.
PROCEDURE Row:
 DEFINE INPUT PARAMETER idValue AS INTEGER NO-UNDO.
 DEFINE INPUT PARAMETER allocationValue AS INTEGER NO-UNDO.
 itemValue=NEW JsonObject(). itemValue:Add('item_container_custo_id',idValue). itemValue:Add('versao_id',7). itemValue:Add('item_container_id',allocationValue).
 itemValue:Add('qt_alocada',3). itemValue:AddNull('qt_confirm_emb').
 itemValue:Add('vl_custo_prev_real',100). itemValue:Add('vl_desp_prev_real',20). itemValue:Add('vl_unit_prev',12). itemValue:Add('vl_desp_prev_real_sem_distr_cust',10).
 itemValue:Add('vl_custo_prev_dolar',200). itemValue:Add('vl_desp_prev_dolar',40). itemValue:Add('vl_unit_prev_dolar',24). itemValue:Add('vl_desp_prev_dolar_sem_distr_cus',20).
END PROCEDURE.
PROCEDURE Invoke:
 RUN VALUE('ContainersVersionComparisonMaterializer.p')(INPUT BUFFER ttAllocation:HANDLE,INPUT BUFFER ttPurchase:HANDLE,INPUT snapshot,INPUT 123,INPUT 7,INPUT currencyValue,INPUT started,INPUT-OUTPUT reads,OUTPUT outputValue).
END PROCEDURE.
PROCEDURE Check:
 DEFINE INPUT PARAMETER okValue AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER labelValue AS CHARACTER NO-UNDO.
 checks=checks + 1.
 IF okValue<>TRUE OR okValue=? THEN UNDO,THROW NEW Progress.Lang.AppError(labelValue,1).
END PROCEDURE.
