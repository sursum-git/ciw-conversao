BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE inputValue AS JsonObject NO-UNDO.
DEFINE VARIABLE outputValue AS JsonObject NO-UNDO.
DEFINE VARIABLE rowValue AS JsonObject NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
OUTPUT TO 'comparison-projection-tests.log'.
DO ON ERROR UNDO, THROW:
 RUN Check(NUM-DBS=0,'zero databases').
 RUN Fixture. RUN Invoke.
 RUN Check(outputValue:GetLogical('success'),'normal persisted input').
 rowValue=outputValue:GetJsonObject('data').
 RUN Check(rowValue:GetDecimal('vl_tot_prev')=120,'total from stored components').
 RUN Check(rowValue:GetDecimal('vl_tot_sem_distr_custo')=110,'stored without-distribution total').
 RUN Check(rowValue:GetDecimal('vl_unit_sem_distr_custo')=11,'source stored-ratio unit').
 RUN Check(rowValue:GetDecimal('vl_desp_prev_perc_fixo')=5,'header fixed percentage').
 RUN Check(rowValue:GetDecimal('vl_tot_perc_fixo')=105,'fixed total').
 RUN Check(rowValue:GetDecimal('vl_unit_perc_fixo')=10.5,'fixed unit from same ratio').
 DO n=1 TO 4:
  RUN Fixture.
  inputValue:Remove(ENTRY(n,'vl_custo_prev,vl_desp_prev,vl_unit_prev,perc_fixo_container')).
  inputValue:AddNull(ENTRY(n,'vl_custo_prev,vl_desp_prev,vl_unit_prev,perc_fixo_container')).
  RUN Invoke. RUN Check(outputValue:GetLogical('success'),'unambiguous NULL with no known zero divisor').
  rowValue=outputValue:GetJsonObject('data').
  RUN Check(rowValue:IsNull('vl_unit_perc_fixo'),'raw logical NULL not ODBC string zero').
 END.
 RUN Fixture. inputValue:Set('vl_unit_prev',0). RUN Invoke.
 RUN Check(outputValue:GetJsonObject('error'):GetCharacter('code')='COMPARISON_ZERO_DIVISOR','known nonNULL inner division by zero fails query').
 RUN Check(NOT outputValue:Has('data'),'zero divisor no partial data').
 RUN Fixture. inputValue:Set('vl_custo_prev',-20). RUN Invoke.
 RUN Check(outputValue:GetJsonObject('error'):GetCharacter('code')='COMPARISON_ZERO_DIVISOR','known zero outer divisor fails query').
 RUN Fixture. inputValue:Remove('vl_custo_prev'). inputValue:AddNull('vl_custo_prev'). inputValue:Set('vl_unit_prev',0). RUN Invoke.
 RUN Check(outputValue:GetLogical('success'),'source-derived SQL NULL sum with zero unit succeeds').
 RUN Check(outputValue:GetJsonObject('data'):IsNull('vl_unit_perc_fixo'),'NULL zero boundary remains logical NULL').
 RUN Fixture. inputValue:Set('vl_custo_prev',1.23456). inputValue:Set('vl_desp_prev',0). inputValue:Set('vl_unit_prev',1). inputValue:Set('perc_fixo_container',1.23). RUN Invoke.
 RUN Check(outputValue:GetJsonObject('data'):GetDecimal('vl_desp_prev_perc_fixo')=.01518509,'physical fixed expense scale8').
 RUN Check(outputValue:GetJsonObject('data'):GetDecimal('vl_tot_perc_fixo')=1.249745088,'USD fixed total preserves ninth nonzero fraction; no blanket scale8').
 RUN Fixture. inputValue:Set('vl_custo_prev',1). inputValue:Set('vl_desp_prev',0). inputValue:Set('vl_unit_prev',10000000000). RUN Invoke.
 RUN Check(outputValue:GetJsonObject('error'):GetCharacter('code')='COMPARISON_ZERO_DIVISOR','inner SQL scale8 rounded zero is checked before outer division').
 RUN Fixture. inputValue:Add('currency','real'). RUN Invoke.
 RUN Check(outputValue:GetJsonObject('error'):GetCharacter('code')='COMPARISON_PROJECTION_REQUEST','closed input').
 RUN Check(NUM-DBS=0,'zero databases after').
 PUT UNFORMATTED 'PASS ' checks ' checks' SKIP.
 CATCH err AS Progress.Lang.Error: PUT UNFORMATTED 'FAIL checks=' checks ' errorNumber=' err:GetMessageNum(1) SKIP. END CATCH.
END.
OUTPUT CLOSE. QUIT.
PROCEDURE Fixture:
 inputValue=NEW JsonObject(). inputValue:Add('qt_alocada',3). inputValue:AddNull('qt_confirm_emb').
 inputValue:Add('vl_custo_prev',100). inputValue:Add('vl_desp_prev',20). inputValue:Add('vl_unit_prev',12).
 inputValue:Add('vl_desp_prev_sem_distr_custo',10). inputValue:Add('perc_fixo_container',5).
END PROCEDURE.
PROCEDURE Invoke:
 RUN VALUE('ContainersVersionComparisonProjection.p')(inputValue,OUTPUT outputValue).
END PROCEDURE.
PROCEDURE Check:
 DEFINE INPUT PARAMETER okValue AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER labelValue AS CHARACTER NO-UNDO.
 checks=checks + 1.
 IF okValue<>TRUE OR okValue=? THEN UNDO,THROW NEW Progress.Lang.AppError(labelValue,1).
END PROCEDURE.
