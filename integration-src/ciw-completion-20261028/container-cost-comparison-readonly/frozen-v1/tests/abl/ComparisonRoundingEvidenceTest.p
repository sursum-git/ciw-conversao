BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE inputValue AS JsonObject NO-UNDO.
DEFINE VARIABLE outputValue AS JsonObject NO-UNDO.
DEFINE VARIABLE rowValue AS JsonObject NO-UNDO.
DEFINE VARIABLE vectors AS JsonArray NO-UNDO.
DEFINE VARIABLE vectorValue AS JsonObject NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE q AS INTEGER NO-UNDO.
DEFINE VARIABLE c AS INTEGER NO-UNDO.
DEFINE VARIABLE d AS INTEGER NO-UNDO.
DEFINE VARIABLE costValue AS DECIMAL DECIMALS 10 NO-UNDO.
DEFINE VARIABLE expenseValue AS DECIMAL DECIMALS 10 NO-UNDO.
DEFINE VARIABLE withoutValue AS DECIMAL DECIMALS 10 NO-UNDO.
DEFINE VARIABLE unitValue AS DECIMAL DECIMALS 10 NO-UNDO.
DEFINE VARIABLE sqlExpressionValue AS DECIMAL DECIMALS 10 NO-UNDO.
DEFINE VARIABLE coreUnitValue AS DECIMAL DECIMALS 10 NO-UNDO.
DEFINE VARIABLE mismatches AS INTEGER NO-UNDO.
DEFINE VARIABLE proofValue AS JsonObject NO-UNDO.
DEFINE VARIABLE distributionValue AS DECIMAL DECIMALS 10 NO-UNDO.
OUTPUT TO 'comparison-rounding-tests.log'.
DO ON ERROR UNDO, THROW:
 RUN Check(NUM-DBS=0,'zero databases').
 vectors=NEW JsonArray().
 DO c=1 TO 2:
  DO q=3 TO 7 BY 2:
   DO d=1 TO 2:
    RUN Fixture(OUTPUT inputValue).
    inputValue:Set('mode','resumo'). inputValue:Set('currency',IF c=1 THEN 'real' ELSE 'dolar').
    inputValue:GetJsonArray('items'):GetJsonObject(1):Set('qt_alocada',q).
    inputValue:GetJsonArray('items'):GetJsonObject(1):Set('distribuicao_real',IF d=1 THEN 1 ELSE 7).
    RUN VALUE('ContainersCustoCalculator.p')(inputValue,OUTPUT outputValue).
    RUN Check(outputValue:GetLogical('success'),'existing central calculator invoked unchanged').
    rowValue=outputValue:GetJsonObject('data'):GetJsonArray('items'):GetJsonObject(1).
    IF d=2 THEN DO:
     distributionValue=rowValue:GetDecimal('vl_total_prev_sem_distr_custo') * (IF c=1 THEN 1 ELSE outputValue:GetJsonObject('data'):GetDecimal('dolar_medio')) - 0.00000001.
     inputValue:GetJsonArray('items'):GetJsonObject(1):Set('distribuicao_real',distributionValue).
     RUN VALUE('ContainersCustoCalculator.p')(inputValue,OUTPUT outputValue).
     RUN Check(outputValue:GetLogical('success'),'same core accepts closed near-cancellation vector').
     rowValue=outputValue:GetJsonObject('data'):GetJsonArray('items'):GetJsonObject(1).
    END.
    ELSE distributionValue=1.
    ASSIGN costValue=rowValue:GetDecimal('vl_merc_prev') expenseValue=rowValue:GetDecimal('vl_desp_prev')
     withoutValue=rowValue:GetDecimal('vl_desp_prev_sem_distr_custo') unitValue=rowValue:GetDecimal('vl_unit_prev')
     coreUnitValue=rowValue:GetDecimal('vl_unit_prev_sem_distr_custo').
    /* This is a source-expression witness, not a new production formula. */
    sqlExpressionValue=(costValue + withoutValue) / ((costValue + expenseValue) / unitValue).
    vectorValue=NEW JsonObject(). vectorValue:Add('currency',IF c=1 THEN 'real' ELSE 'dolar'). vectorValue:Add('quantity',q).
    vectorValue:Add('distribution',distributionValue). vectorValue:Add('stored_merch',costValue). vectorValue:Add('stored_expense',expenseValue).
    vectorValue:Add('stored_expense_without',withoutValue). vectorValue:Add('stored_unit',unitValue). vectorValue:Add('core_unit_without',coreUnitValue).
    vectorValue:Add('persisted_expression_abl10',sqlExpressionValue).
    vectorValue:Add('different_at_10',ROUND(sqlExpressionValue,10)<>coreUnitValue).
    IF ROUND(sqlExpressionValue,10)<>coreUnitValue THEN mismatches=mismatches + 1.
    vectors:Add(vectorValue).
   END.
  END.
 END.
 RUN Check(mismatches>0,'rounded inputs are not generally equivalent to central quantity calculation').
 proofValue=NEW JsonObject(). proofValue:Add('source','unchanged-core-vs-rounded-persisted-expression-witness').
 proofValue:Add('sqlExecution',FALSE). proofValue:Add('numDbs',NUM-DBS). proofValue:Add('differentAt10Count',mismatches). proofValue:Add('vectors',vectors).
 proofValue:WriteFile('comparison-rounding-actual.json',TRUE).
 RUN Check(NUM-DBS=0,'zero databases after').
 PUT UNFORMATTED 'PASS ' checks ' checks' SKIP.
 CATCH err AS Progress.Lang.Error: PUT UNFORMATTED 'FAIL checks=' checks ' errorNumber=' err:GetMessageNum(1) SKIP. END CATCH.
END.
OUTPUT CLOSE. QUIT.
PROCEDURE Check:
 DEFINE INPUT PARAMETER okValue AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER labelValue AS CHARACTER NO-UNDO.
 checks=checks + 1.
 IF okValue<>TRUE OR okValue=? THEN UNDO,THROW NEW Progress.Lang.AppError(labelValue,1).
END PROCEDURE.
{ComparisonCoreFixture.i}
