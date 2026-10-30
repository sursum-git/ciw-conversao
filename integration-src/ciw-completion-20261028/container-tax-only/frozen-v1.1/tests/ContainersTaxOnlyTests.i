PROCEDURE TaxOnlyTests:
 DEFINE VARIABLE oldItems AS LONGCHAR NO-UNDO. DEFINE VARIABLE newItems AS LONGCHAR NO-UNDO.
 DEFINE VARIABLE oldMaster AS LONGCHAR NO-UNDO. DEFINE VARIABLE newMaster AS LONGCHAR NO-UNDO.
 DEFINE VARIABLE eventRow AS JsonObject NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.
 RUN Seed(0). RUN Request('calcular_impostos').
 TEMP-TABLE ttItems:WRITE-JSON('LONGCHAR',oldItems). TEMP-TABLE ttContainer:WRITE-JSON('LONGCHAR',oldMaster).
 RUN ExecuteRequest.
 RUN AssertTrue(joResponse:GetLogical('success'),'tax-only operation succeeds using actual fiscal writer').
 RUN AssertTrue(joResponse:GetJsonObject('data'):GetLogical('committed'),'tax-only confirms own commit').
 FIND ttExpenses WHERE ttExpenses.despesa_id=10 AND ttExpenses.item_container_id=0.
 RUN AssertTrue(ttExpenses.vl_prev=762 AND ttExpenses.vl_proforma=612 AND ttExpenses.vl_negociado=762,'tax-only uses central three tax bases').
 FIND ttExpenses WHERE ttExpenses.despesa_id=11.
 RUN AssertTrue(ttExpenses.vl_prev=152.4,'tax-only retains central nonrecoverable cost generation').
 RUN AssertTrue(NOT CAN-FIND(ttExpenses WHERE ttExpenses.despesa_id=20 AND ttExpenses.item_container_id=1),'tax-only never inserts enabled IPI').
 FIND ttExpenses WHERE ttExpenses.despesa_id=20 AND ttExpenses.item_container_id=2.
 RUN AssertTrue(ttExpenses.vl_prev=555,'tax-only preserves previous IPI').
 FIND ttExpenses WHERE ttExpenses.despesa_id=40.
 RUN AssertTrue(ttExpenses.vl_prev=0,'tax-only never updates calculated expenses').
 TEMP-TABLE ttItems:WRITE-JSON('LONGCHAR',newItems). TEMP-TABLE ttContainer:WRITE-JSON('LONGCHAR',newMaster).
 RUN AssertTrue(COMPARE(STRING(oldItems),'=',STRING(newItems),'RAW'),'tax-only preserves all physical item fields').
 RUN AssertTrue(COMPARE(STRING(oldMaster),'=',STRING(newMaster),'RAW'),'tax-only preserves all physical master fields').
 RUN AssertTrue(joResponse:GetJsonObject('audit'):GetCharacter('operation')='calcular_impostos' AND joResponse:GetJsonObject('audit'):GetCharacter('actor')='test-fiscal','tax-only audit operation and actor').
 RUN AssertTrue(joResponse:GetJsonObject('audit'):GetJsonArray('children'):Length=5,'tax-only calculation plus four expense images').
 DO j=1 TO joResponse:GetJsonObject('audit'):GetJsonArray('children'):Length:
  eventRow=joResponse:GetJsonObject('audit'):GetJsonArray('children'):GetJsonObject(j).
  IF eventRow:GetCharacter('resource')='despesas_container' THEN RUN AssertTrue(eventRow:GetJsonObject('after'):GetInteger('despesa_id')<>20 AND eventRow:GetJsonObject('after'):GetInteger('despesa_id')<>40,'audit excludes IPI and calculated effects').
 END.
 joResponse:WriteFile('tax-only-core-success.json',TRUE).
 RUN Seed(0). iFailAt=2. RUN Request('calcular_impostos'). RUN ExecuteRequest.
 RUN AssertTrue(NOT joResponse:GetLogical('success') AND NOT joResponse:Has('audit'),'tax-only failed persist no confirmed audit').
 RUN AssertTrue(NOT CAN-FIND(ttCalcs WHERE ttCalcs.calc_imp_container_id=901) AND NOT CAN-FIND(ttExpenses WHERE ttExpenses.despesa_id=10),'tax-only rollback calculation and new expense').
 FIND ttExpenses WHERE ttExpenses.despesa_id=9.
 RUN AssertTrue(ttExpenses.vl_prev=1 AND NOT CAN-FIND(FIRST ttProviderLog),'tax-only rollback earlier update and no postcommit log').
 RUN Seed(0). RUN Request('calcular_impostos'). joInputs:GetJsonObject('container_snapshot'):Set('vl-dolar-compra',99). RUN ExecuteRequest.
 RUN ExpectError('CONTAINER_INPUT_STALE').
 RUN AssertTrue(iCalcSeq=900 AND iExpenseCalls=0,'stale internal rates cause zero IDs/mutations').
 RUN Seed(0). RUN Request('calcular_impostos').
 DO TRANSACTION ON ERROR UNDO, THROW:
  RUN ExecuteRequest.
  RUN AssertTrue(joResponse:GetLogical('success') AND NOT joResponse:Has('audit') AND joResponse:Has('pendingChanges'),'nested tax-only never claims commit').
  UNDO, LEAVE.
 END.
 RUN AssertTrue(NOT CAN-FIND(ttCalcs WHERE ttCalcs.calc_imp_container_id=901),'root rollback undoes tax-only nested writes').
 RUN Seed(0). RUN Request('calcular_impostos'). iFailAt=-1. RUN ExecuteRequest.
 RUN ExpectError('CONTAINER_TAX_LIMIT').
 RUN AssertTrue(NOT joResponse:Has('audit') AND NOT CAN-FIND(ttCalcs WHERE ttCalcs.calc_imp_container_id=901) AND NOT CAN-FIND(FIRST ttProviderLog),'STOP inside tax-only deadline rolls back writes and no log').
 RUN Seed(0). RUN Request('calcular_impostos').
 DO TRANSACTION:
  DO j=100 TO 50100: CREATE ttDefs. ttDefs.despesa_id=j. END.
 END.
 RUN ExecuteRequest. RUN ExpectError('CONTAINER_TAX_LIMIT').
 RUN AssertTrue(iCalcSeq=900 AND iExpenseCalls=0 AND NOT joResponse:Has('audit'),'collection 50k budget fails before any IDs/mutations').
END PROCEDURE.
