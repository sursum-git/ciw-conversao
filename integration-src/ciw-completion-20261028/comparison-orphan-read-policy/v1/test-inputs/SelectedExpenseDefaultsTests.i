PROCEDURE SelectedDefaultTests:
 DEFINE VARIABLE ids AS JsonArray NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.
 DEFINE VARIABLE eventRow AS JsonObject NO-UNDO.
 RUN Seed(0).
 DO TRANSACTION:
  FOR EACH ttLinks: ASSIGN ttLinks.log_ativo=1 ttLinks.vl_padrao=12. END.
  FIND ttLinks WHERE ttLinks.despesa_id=30. ttLinks.vl_padrao=200.
  FIND ttLinks WHERE ttLinks.despesa_id=40. ttLinks.vl_padrao=0.
  FIND ttExpenses WHERE ttExpenses.despesa_id=30. ASSIGN ttExpenses.vl_prev=999 ttExpenses.log_utilizado=TRUE ttExpenses.memoria_calculo='antes' ttExpenses.perc_calc=3.
  FIND ttExpenses WHERE ttExpenses.despesa_id=40. ttExpenses.log_utilizado=?.
 END.
 RUN Request('selecionar_despesas'). ids=NEW JsonArray(). ids:Add(40). joRequest:Add('despesa_ids',ids).
 RUN ExecuteRequest.
 RUN AssertTrue(joResponse:GetLogical('success'),'selected defaults operation succeeds over central core').
 FIND ttExpenses WHERE ttExpenses.despesa_id=30 AND ttExpenses.item_container_id=0.
 RUN AssertTrue(ttExpenses.vl_prev=200 AND ttExpenses.vl_negociado=0 AND ttExpenses.vl_proforma=0,'ALL defaults overwrite even unselected existing expense').
 RUN AssertTrue(ttExpenses.log_manual=TRUE AND ttExpenses.log_utilizado=TRUE AND ttExpenses.memoria_calculo='' AND ttExpenses.perc_calc=0,'default update preserves manual/previous used and resets intended fields').
 FIND ttExpenses WHERE ttExpenses.despesa_id=40.
 RUN AssertTrue(ttExpenses.log_utilizado=TRUE AND ttExpenses.vl_prev=620,'selected calculated runs AFTER default200 with central product basis6000').
 FIND ttExpenses WHERE ttExpenses.despesa_id=10.
 RUN AssertTrue(ttExpenses.vl_prev=762,'tax synchronization runs AFTER defaults/calculated and reuses persisted tax override120').
 RUN AssertTrue(CAN-FIND(ttExpenses WHERE ttExpenses.despesa_id=20 AND ttExpenses.item_container_id=1),'selected defaults ends with full synchronization including IPI').
 RUN AssertTrue(joResponse:GetJsonObject('audit'):GetCharacter('operation')='selecionar_despesas','selection has explicit audit operation').
 joResponse:WriteFile('selection-core-success.json',TRUE).
 RUN Seed(0).
 DO TRANSACTION:
  FOR EACH ttLinks: ASSIGN ttLinks.log_ativo=1 ttLinks.vl_padrao=12. END.
  FIND ttLinks WHERE ttLinks.despesa_id=30. ttLinks.log_ativo=?.
 END.
 RUN Request('selecionar_despesas'). ids=NEW JsonArray(). ids:Add(30). joRequest:Add('despesa_ids',ids). RUN ExecuteRequest.
 RUN ExpectError('CONTAINER_SELECTION_STALE').
 RUN AssertTrue(iCalcSeq=900 AND iExpenseCalls=0,'NULL active is excluded by SQL active=1 semantics before IDs').
 RUN SelectionSeed.
 DO TRANSACTION:
  CREATE ttDefs. ASSIGN ttDefs.despesa_id=42 ttDefs.log_imposto=? ttDefs.perc_calculo=0 ttDefs.ordem=10.
  CREATE ttLinks. ASSIGN ttLinks.empresa_despesa_id=42 ttLinks.empresa_id=35 ttLinks.despesa_id=42 ttLinks.log_ativo=1 ttLinks.vl_padrao=19.
 END.
 RUN SelectionRequest(40). RUN ExecuteRequest.
 RUN AssertTrue(joResponse:GetLogical('success') AND NOT CAN-FIND(ttExpenses WHERE ttExpenses.despesa_id=42),'SQL non-tax=0 excludes NULL tax from ALL defaults').
 RUN SelectionSeed. RUN SelectionRequest(40). RUN ExecuteRequest.
 RUN AssertTrue(joResponse:GetLogical('success'),'selected calculated subset succeeds').
 FIND ttExpenses WHERE ttExpenses.despesa_id=41. RUN AssertTrue(ttExpenses.vl_prev=3,'unselected calculated default is overwritten but not recalculated by nonempty subset').
 RUN SelectionSeed. RUN SelectionRequest(30). RUN ExecuteRequest.
 RUN AssertTrue(joResponse:GetLogical('success'),'selection only non-calculated triggers empty calculated subset fallback').
 FIND ttExpenses WHERE ttExpenses.despesa_id=40. RUN AssertTrue(ttExpenses.vl_prev=620,'fallback calculates original40 after all defaults').
 FIND ttExpenses WHERE ttExpenses.despesa_id=41. RUN AssertTrue(ttExpenses.vl_prev=10 AND ttExpenses.log_utilizado=?,'fallback calculates unselected41 while preserving used NULL').
 RUN SelectionSeed. RUN SelectionRequest(31). RUN ExecuteRequest.
 RUN AssertTrue(joResponse:GetLogical('success'),'defaults create absent general line and mark existing item line').
 FIND ttExpenses WHERE ttExpenses.despesa_id=31 AND ttExpenses.item_container_id=0.
 RUN AssertTrue(ttExpenses.vl_prev=15 AND ttExpenses.log_manual=TRUE AND ttExpenses.log_utilizado=TRUE,'new general default derives manual from zero percentage and marks selected').
 FIND ttExpenses WHERE ttExpenses.despesa_id=31 AND ttExpenses.item_container_id=1.
 RUN AssertTrue(ttExpenses.vl_prev=88 AND ttExpenses.calc_imp_container_id=? AND ttExpenses.cta_corren_custo_distr_id=? AND ttExpenses.perc_calc=? AND ttExpenses.memoria_calculo=? AND ttExpenses.log_manual=? AND ttExpenses.log_utilizado=TRUE,'mark-only item preserves raw fields/NULL and only marks used').
 RUN SelectionSeed. RUN SelectionRequest(30). iFailAt=2. RUN ExecuteRequest.
 RUN AssertTrue(NOT joResponse:GetLogical('success') AND NOT joResponse:Has('audit') AND NOT CAN-FIND(ttCalcs WHERE ttCalcs.calc_imp_container_id=901),'selection persistence failure rolls back calc/new rows/audit').
 FIND ttExpenses WHERE ttExpenses.despesa_id=30. RUN AssertTrue(ttExpenses.vl_prev=100 AND NOT CAN-FIND(FIRST ttProviderLog),'selection rollback restores overwritten nonselected defaults and no log').
 RUN SelectionSeed. RUN SelectionRequest(30).
 FIND ttLinks WHERE ttLinks.despesa_id=41. ttLinks.vl_padrao=?. RUN ExecuteRequest.
 RUN ExpectError('CONTAINER_VALUE_UNKNOWN'). RUN AssertTrue(iCalcSeq=900 AND iExpenseCalls=0,'late invalid ALL default fails before first persistent ID/effect').
 RUN SelectionSeed. RUN SelectionRequest(30). joInputs:GetJsonObject('container_snapshot'):Set('vl-dolar-compra',99). RUN ExecuteRequest.
 RUN ExpectError('CONTAINER_INPUT_STALE'). RUN AssertTrue(iCalcSeq=900 AND iExpenseCalls=0,'selection stale rates fail before defaults/effects').
 RUN SelectionSeed. RUN SelectionRequest(30). joRequest:GetJsonArray('despesa_ids'):Add(30). RUN ExecuteRequest. RUN ExpectError('CONTAINER_SELECTION_INVALID').
 RUN SelectionSeed. RUN Request('selecionar_despesas'). joRequest:Add('despesa_ids',NEW JsonArray()). RUN ExecuteRequest. RUN ExpectError('CONTAINER_SELECTION_INVALID').
 RUN SelectionOrderTests.
 RUN SelectionLimitsTests.
END PROCEDURE.
PROCEDURE SelectionLimitsTests:
 DEFINE VARIABLE j AS INTEGER NO-UNDO.
 RUN SelectionSeed. RUN SelectionRequest(40).
 DO j=1 TO 100: joRequest:GetJsonArray('despesa_ids'):Add(10000 + j). END.
 RUN ExecuteRequest. RUN ExpectError('CONTAINER_SELECTION_INVALID').
 RUN AssertTrue(iCalcSeq=900 AND iExpenseCalls=0,'101 public IDs fail before effects').
 RUN SelectionSeed.
 DO TRANSACTION:
  FIND ttDefs WHERE ttDefs.despesa_id=40. ttDefs.ordem=?.
 END.
 RUN SelectionRequest(40). RUN ExecuteRequest. RUN ExpectError('CONTAINER_SELECTION_ORDER_UNPROVEN').
 RUN AssertTrue(iCalcSeq=900 AND iExpenseCalls=0,'relevant NULL order fails closed before IDs').
 RUN SelectionSeed.
 DO TRANSACTION:
  DO j=1001 TO 1201:
   CREATE ttDefs. ASSIGN ttDefs.despesa_id=j ttDefs.log_imposto=0 ttDefs.ordem=j.
   CREATE ttLinks. ASSIGN ttLinks.empresa_despesa_id=j ttLinks.empresa_id=35 ttLinks.despesa_id=j ttLinks.log_ativo=1.
  END.
 END.
 joPolicy:Add('despesa_distr_custo',0). RUN Request('opcoes_despesas_selecao'). RUN ExecuteRequest.
 RUN ExpectError('CONTAINER_SELECTION_OPTIONS_LIMIT').
 RUN AssertTrue(iCalcSeq=900 AND iExpenseCalls=0 AND NOT joResponse:Has('data'),'more than200 options refused without truncated data or effects').
END PROCEDURE.
PROCEDURE SelectionSeed:
 RUN Seed(0).
 DO TRANSACTION:
  FOR EACH ttLinks: ASSIGN ttLinks.log_ativo=1 ttLinks.vl_padrao=12. END.
  FIND ttLinks WHERE ttLinks.despesa_id=30. ttLinks.vl_padrao=200.
  FIND ttLinks WHERE ttLinks.despesa_id=40. ttLinks.vl_padrao=0.
  CREATE ttDefs. ASSIGN ttDefs.despesa_id=41 ttDefs.log_calculada=TRUE ttDefs.perc_calculo=5 ttDefs.ordem=9 ttDefs.log_imposto=0.
  CREATE ttLinks. ASSIGN ttLinks.empresa_despesa_id=41 ttLinks.empresa_id=35 ttLinks.despesa_id=41 ttLinks.log_ativo=1 ttLinks.vl_padrao=3.
  CREATE ttRelations. ASSIGN ttRelations.relac_desp_calculada_id=41 ttRelations.despesa_id=41 ttRelations.despesa_id_base=30.
  CREATE ttExpenses. ASSIGN ttExpenses.despesa_container_id=401 ttExpenses.container_id=71 ttExpenses.despesa_id=41 ttExpenses.item_container_id=0 ttExpenses.vl_prev=666 ttExpenses.log_manual=FALSE ttExpenses.log_utilizado=?.
  CREATE ttDefs. ASSIGN ttDefs.despesa_id=31 ttDefs.ordem=8 ttDefs.log_imposto=0.
  CREATE ttLinks. ASSIGN ttLinks.empresa_despesa_id=31 ttLinks.empresa_id=35 ttLinks.despesa_id=31 ttLinks.log_ativo=1 ttLinks.vl_padrao=15.
  CREATE ttExpenses. ASSIGN ttExpenses.despesa_container_id=311 ttExpenses.container_id=71 ttExpenses.despesa_id=31 ttExpenses.item_container_id=1 ttExpenses.vl_prev=88 ttExpenses.log_manual=? ttExpenses.calc_imp_container_id=? ttExpenses.cta_corren_custo_distr_id=? ttExpenses.perc_calc=? ttExpenses.memoria_calculo=?.
 END.
END PROCEDURE.
PROCEDURE SelectionRequest:
 DEFINE INPUT PARAMETER expenseId AS INTEGER NO-UNDO. DEFINE VARIABLE a AS JsonArray NO-UNDO.
 RUN Request('selecionar_despesas'). a=NEW JsonArray(). a:Add(expenseId). joRequest:Add('despesa_ids',a).
END PROCEDURE.
PROCEDURE SelectionOrderSeed:
 RUN SelectionSeed.
 DO TRANSACTION:
  FIND ttDefs WHERE ttDefs.despesa_id=40. ASSIGN ttDefs.log_vl_prod_base_calculo=FALSE ttDefs.ordem=1.
  FIND ttDefs WHERE ttDefs.despesa_id=41. ttDefs.ordem=2.
  FIND ttRelations WHERE ttRelations.despesa_id=40. ttRelations.despesa_id_base=41.
  CREATE ttDefs. ASSIGN ttDefs.despesa_id=9001 ttDefs.ordem=?.
 END.
END PROCEDURE.
PROCEDURE SelectionOrderTests:
 DEFINE VARIABLE optionsResult AS JsonObject NO-UNDO. DEFINE VARIABLE rowValue AS JsonObject NO-UNDO.
 DEFINE VARIABLE p40 AS INTEGER NO-UNDO. DEFINE VARIABLE p41 AS INTEGER NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.
 RUN SelectionOrderSeed. RUN SelectionRequest(41). joRequest:GetJsonArray('despesa_ids'):Add(40). joRequest:Add('ordem_campo','ordem'). joRequest:Add('ordem_direcao','asc'). RUN ExecuteRequest.
 RUN AssertTrue(joResponse:GetLogical('success'),'ordered selection A before B succeeds even client clicks B before A').
 FIND ttExpenses WHERE ttExpenses.despesa_id=40. RUN AssertTrue(ttExpenses.vl_prev=0.3,'legacy A depends B: A before B uses B default3 =>0.3').
 FIND ttExpenses WHERE ttExpenses.despesa_id=41. RUN AssertTrue(ttExpenses.vl_prev=10,'B later computes200x5% =>10').
 RUN SelectionOrderSeed. RUN SelectionRequest(40). joRequest:GetJsonArray('despesa_ids'):Add(41). joRequest:Add('ordem_campo','ordem'). joRequest:Add('ordem_direcao','desc'). RUN ExecuteRequest.
 RUN AssertTrue(joResponse:GetLogical('success'),'reverse server order B before A succeeds').
 FIND ttExpenses WHERE ttExpenses.despesa_id=40. RUN AssertTrue(ttExpenses.vl_prev=1,'legacy B before A uses B calculated10 =>1, observable order difference').
 RUN SelectionOrderSeed. RUN Request('atualizar_despesas_calculadas'). RUN ExecuteRequest.
 FIND ttExpenses WHERE ttExpenses.despesa_id=40. RUN AssertTrue(ttExpenses.vl_prev=0.5,'old planner still topological using original base100 B=5 then A=0.5').
 RUN SelectionOrderSeed. joPolicy:Add('despesa_distr_custo',0). RUN Request('opcoes_despesas_selecao'). joRequest:Add('ordem_campo','ordem'). joRequest:Add('ordem_direcao','asc'). RUN ExecuteRequest.
 RUN AssertTrue(joResponse:GetLogical('success') AND NOT joResponse:Has('audit'),'lookup is read-only no fabricated commercial audit').
 optionsResult=joResponse.
 DO j=1 TO optionsResult:GetJsonArray('data'):Length:
  rowValue=optionsResult:GetJsonArray('data'):GetJsonObject(j).
  IF rowValue:GetInteger('despesa_id')=40 THEN p40=rowValue:GetInteger('position').
  IF rowValue:GetInteger('despesa_id')=41 THEN p41=rowValue:GetInteger('position').
 END.
 RUN AssertTrue(p40<p41,'lookup projection matches ascending execution order').
 optionsResult:WriteFile('selection-options-success.json',TRUE).
 RUN SelectionOrderSeed. RUN SelectionRequest(40). joRequest:Add('ordem_campo','descricao'). RUN ExecuteRequest. RUN ExpectError('CONTAINER_SELECTION_ORDER_UNPROVEN').
 RUN SelectionOrderSeed. RUN SelectionRequest(40). joRequest:Add('ordem_campo','ordem;delete'). RUN ExecuteRequest. RUN ExpectError('CONTAINER_SELECTION_ORDER').
END PROCEDURE.
