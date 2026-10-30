patchPlans=[]
def patch(name,changes):
 before=files[name];after=before
 for old,new in changes:
  assert after.count(old)==1,(name,old);after=after.replace(old,new)
 target=canonical/name;p=root/'patches';p.mkdir(exist_ok=True)
 (p/(target.name+'.patch')).write_text(''.join(difflib.unified_diff(before.splitlines(True),after.splitlines(True),fromfile=str(target),tofile=str(target))),encoding='utf-8')
 patchPlans.append({'target':target.as_posix(),'baselineSha256':physicalBaselines[name]if integrated[name]else hashlib.sha256(before.encode()).hexdigest(),'baselineIsFuture1043':not integrated[name],'changes':[{'old':a,'new':b}for a,b in changes]});files[name]=after
name='sursum-api/programs/ContainersImpostosService.p';text=files[name]
company=text[text.index(' cPrefix=phContainer:BUFFER-FIELD("cod-estabel"):BUFFER-VALUE.',text.index('PROCEDURE LoadState:')):text.index(' RUN Open(phItems,',text.index('PROCEDURE LoadState:'))]
catalog=text[text.index(' /* Catalog/configuration locks'):text.index(' RUN Open(phExpenses,')]
companyNew=company.replace(' cPrefix=SUBSTRING(cPrefix,1,1).',' IF (cOperation="selecionar_despesas" OR cOperation="opcoes_despesas_selecao") AND NOT cPrefix BEGINS "5" THEN RUN Fail("CONTAINER_SELECTION_MED_REQUIRED","Selecao exige container MED sob lock.",422).\n cPrefix=SUBSTRING(cPrefix,1,1).')
catalogNew=catalog.replace('  RUN Next.\n END.\n RUN Open(phLinks,','  IF cOperation="selecionar_despesas" OR cOperation="opcoes_despesas_selecao" THEN ttDef.description=phDefs:BUFFER-FIELD("descricao"):BUFFER-VALUE.\n  RUN Next.\n END.\n RUN Open(phLinks,',1).replace('  RUN Next.\n END.\n RUN Open(phTaxBases,','  IF cOperation="selecionar_despesas" OR cOperation="opcoes_despesas_selecao" THEN ASSIGN ttLink.active=phLinks:BUFFER-FIELD("log_ativo"):BUFFER-VALUE ttLink.defaultValue=phLinks:BUFFER-FIELD("vl_padrao"):BUFFER-VALUE.\n  RUN Next.\n END.\n RUN Open(phTaxBases,',1)
patch(name,[
 (' FIELD id AS INTEGER FIELD ordinal AS INTEGER FIELD tax AS INTEGER FIELD calculated AS LOGICAL',' FIELD id AS INTEGER FIELD ordinal AS INTEGER FIELD tax AS INTEGER FIELD calculated AS LOGICAL FIELD description AS CHARACTER'),
 ('DEFINE TEMP-TABLE ttLink NO-UNDO FIELD id AS INTEGER FIELD percentage AS DECIMAL DECIMALS 10','DEFINE TEMP-TABLE ttLink NO-UNDO FIELD id AS INTEGER FIELD percentage AS DECIMAL DECIMALS 10 FIELD active AS INTEGER FIELD defaultValue AS DECIMAL DECIMALS 10'),
 (' FIELD changed AS LOGICAL FIELD useNewCalc AS LOGICAL',' FIELD used AS LOGICAL FIELD changed AS LOGICAL FIELD useNewCalc AS LOGICAL'),
 ('DEFINE BUFFER bWork FOR ttWork.','DEFINE BUFFER bWork FOR ttWork.\nDEFINE BUFFER bLink FOR ttLink.\nDEFINE TEMP-TABLE ttSelected NO-UNDO FIELD id AS INTEGER FIELD ordinal AS INTEGER FIELD calculated AS LOGICAL INDEX pk IS PRIMARY UNIQUE id.\nDEFINE TEMP-TABLE ttSelectionOrder NO-UNDO FIELD id AS INTEGER FIELD position AS INTEGER INDEX pk IS PRIMARY UNIQUE id.\nDEFINE VARIABLE lSelectedCalculated AS LOGICAL NO-UNDO.'),
 (' IF cOperation="calcular_impostos" AND NOT hq:QUERY-OFF-END THEN DO:',' IF (cOperation="calcular_impostos" OR cOperation="selecionar_despesas" OR cOperation="opcoes_despesas_selecao") AND NOT hq:QUERY-OFF-END THEN DO:'),
 (company,' RUN LoadCompany.\n'),
 (catalog,' RUN LoadCatalog.\n'),
 ('PROCEDURE UpsertPlan:','PROCEDURE LoadCompany:\n DEFINE VARIABLE companyCount AS INTEGER NO-UNDO.\n'+companyNew+'END PROCEDURE.\nPROCEDURE LoadCatalog:\n DEFINE VARIABLE idValue AS INTEGER NO-UNDO.\n'+catalogNew+'END PROCEDURE.\n{sursum-api/includes/ContainerExpenseDefaultsPlan.i}\nPROCEDURE UpsertPlan:'),
 ('  joBefore:Add(Num(ttExpense.id),Snapshot(phExpenses,','  IF cOperation="selecionar_despesas" THEN ASSIGN ttExpense.used=phExpenses:BUFFER-FIELD("log_utilizado"):BUFFER-VALUE ttExpense.percentage=phExpenses:BUFFER-FIELD("perc_calc"):BUFFER-VALUE ttExpense.memoryText=phExpenses:BUFFER-FIELD("memoria_calculo"):BUFFER-VALUE.\n  joBefore:Add(Num(ttExpense.id),Snapshot(phExpenses,'),
 ('  ttExpense.percentage=percentage ttExpense.calcId=0 ttExpense.useNewCalc=useCalc ttExpense.memoryText=memoryText ttExpense.changed=TRUE.','  ttExpense.percentage=percentage ttExpense.calcId=0 ttExpense.useNewCalc=useCalc ttExpense.memoryText=memoryText ttExpense.changed=TRUE.\n IF cOperation="selecionar_despesas" THEN ttExpense.ledgerId=0.'),
 (' FOR EACH ttExpense WHERE ttExpense.manual=FALSE:\n  FIND ttDef',' FOR EACH ttExpense WHERE ttExpense.manual=FALSE:\n  IF cOperation="selecionar_despesas" AND lSelectedCalculated AND NOT CAN-FIND(FIRST ttSelected WHERE ttSelected.id=ttExpense.expenseId AND ttSelected.calculated) THEN NEXT.\n  FIND ttDef'),
 ('CREATE ttWork. ASSIGN ttWork.kind="calculated" ttWork.id=ttDef.id ttWork.ordinal=ttDef.ordinal.','CREATE ttWork. ASSIGN ttWork.kind="calculated" ttWork.id=ttDef.id ttWork.ordinal=ttDef.ordinal.\n   IF cOperation="selecionar_despesas" THEN DO: FIND ttSelectionOrder WHERE ttSelectionOrder.id=ttDef.id. ttWork.ordinal=ttSelectionOrder.position. END.'),
 ('   FOR EACH ttRel WHERE ttRel.id=ttWork.id:\n    IF CAN-FIND','   IF cOperation<>"selecionar_despesas" THEN FOR EACH ttRel WHERE ttRel.id=ttWork.id:\n    IF CAN-FIND'),
 (' IF cOperation="sincronizar" OR cOperation="calcular_impostos" THEN DO:\n  RUN NextCalculoId',' IF cOperation="sincronizar" OR cOperation="calcular_impostos" OR cOperation="selecionar_despesas" THEN DO:\n  RUN NextCalculoId'),
 ('phExpenses:BUFFER-FIELD("calc_imp_container_id"):BUFFER-VALUE=IF ttExpense.useNewCalc THEN iCalcId ELSE 0','phExpenses:BUFFER-FIELD("calc_imp_container_id"):BUFFER-VALUE=IF ttExpense.useNewCalc THEN iCalcId ELSE (IF cOperation="selecionar_despesas" THEN ttExpense.calcId ELSE 0)'),
 ('phExpenses:BUFFER-FIELD("cta_corren_custo_distr_id"):BUFFER-VALUE=0 phExpenses:BUFFER-FIELD("perc_calc"):BUFFER-VALUE=ttExpense.percentage','phExpenses:BUFFER-FIELD("cta_corren_custo_distr_id"):BUFFER-VALUE=(IF cOperation="selecionar_despesas" THEN ttExpense.ledgerId ELSE 0) phExpenses:BUFFER-FIELD("perc_calc"):BUFFER-VALUE=ttExpense.percentage'),
 ('  IF NOT phExpenses:BUFFER-VALIDATE() THEN UNDO, THROW NEW Progress.Lang.AppError("Expense validation failed.",0).','  IF cOperation="selecionar_despesas" THEN phExpenses:BUFFER-FIELD("log_utilizado"):BUFFER-VALUE=ttExpense.used.\n  IF NOT phExpenses:BUFFER-VALIDATE() THEN UNDO, THROW NEW Progress.Lang.AppError("Expense validation failed.",0).'),
 (' AND cOperation<>"atualizar_despesas_calculadas" THEN RUN Fail',' AND cOperation<>"selecionar_despesas" AND cOperation<>"opcoes_despesas_selecao" AND cOperation<>"atualizar_despesas_calculadas" THEN RUN Fail'),
 ('IF cField<>"operation" AND cField<>"container_id" THEN RUN Fail','IF cField<>"operation" AND cField<>"container_id" AND NOT (cOperation="selecionar_despesas" AND cField="despesa_ids") AND NOT ((cOperation="selecionar_despesas" OR cOperation="opcoes_despesas_selecao") AND (cField="ordem_campo" OR cField="ordem_direcao")) THEN RUN Fail'),
 (' joBefore=NEW JsonObject(). jaSteps=NEW JsonArray().',' IF cOperation="selecionar_despesas" THEN RUN DefaultsSelectionInput.\n joBefore=NEW JsonObject(). jaSteps=NEW JsonArray().'),
 ('Num(iContainer),TRUE) THEN RUN Fail("CONTAINER_NOT_FOUND"','Num(iContainer),cOperation<>"opcoes_despesas_selecao") THEN RUN Fail("CONTAINER_NOT_FOUND"'),
 ('  IF cOperation="calcular_impostos" THEN DO:\n   iTaxOnlyStarted=ETIME.','  IF cOperation="calcular_impostos" OR cOperation="selecionar_despesas" OR cOperation="opcoes_despesas_selecao" THEN DO:\n   iTaxOnlyStarted=ETIME.'),
 (' /* Standalone: the real transaction ended. Nested: only the caller can confirm. */',' IF cOperation="opcoes_despesas_selecao" THEN RETURN.\n /* Standalone: the real transaction ended. Nested: only the caller can confirm. */'),
 ('PROCEDURE FiscalPlan:\n RUN CheckInputs. RUN LoadState.','''PROCEDURE FiscalPlan:
 IF cOperation="opcoes_despesas_selecao" THEN DO:
  RUN DefaultsPolicy. RUN LoadCompany. RUN LoadCatalog. RUN DefaultsBuildOrder. RUN DefaultsOptions. RETURN.
 END.
 RUN CheckInputs. RUN LoadState.'''),
 (' ELSE IF cOperation="calcular_impostos" THEN RUN TaxPlan.',' ELSE IF cOperation="calcular_impostos" THEN RUN TaxPlan.\n ELSE IF cOperation="selecionar_despesas" THEN DO: RUN DefaultsBuildOrder. RUN DefaultsPlan. RUN CalculatedPlan. RUN TaxPlan. RUN IpiPlan. END.')
])
files['sursum-api/includes/ContainerExpenseDefaultsPlan.i']=(root/'abl/ContainerExpenseDefaultsPlan.i').read_text(encoding='utf-8')
patch('sursum-api/includes/ContainerProcessBoundary.i',[
 (' ELSE IF resourceValue<>"impostos" OR (operationValue<>"sincronizar" AND operationValue<>"calcular_impostos") THEN', ''' ELSE IF resourceValue="despesas-selecao" AND operationValue="options" THEN fieldsValue=fieldsValue + ",ordem_campo,ordem_direcao".
 ELSE IF resourceValue="impostos" AND operationValue="selecionar_despesas" THEN DO:
  fieldsValue=fieldsValue + ",despesa_ids,ordem_campo,ordem_direcao".
  IF NOT requestValue:Has("despesa_ids") THEN UNDO, THROW NEW Progress.Lang.AppError("Selecao obrigatoria.",1).
  IF requestValue:GetType("despesa_ids")<>JsonDataType:ARRAY THEN UNDO, THROW NEW Progress.Lang.AppError("Selecao invalida.",1).
  IF requestValue:GetJsonArray("despesa_ids"):Length<1 OR requestValue:GetJsonArray("despesa_ids"):Length>100 THEN UNDO, THROW NEW Progress.Lang.AppError("Selecione de1a100despesas.",1).
 END.
 ELSE IF resourceValue<>"impostos" OR (operationValue<>"sincronizar" AND operationValue<>"calcular_impostos") THEN''')
])
patch('sursum-api/programs/ContainersProcessosService.p',[
 (' rootTransaction: DO TRANSACTION ON ERROR UNDO, THROW:', ''' IF op="options" THEN DO:
  clean:Set("operation","opcoes_despesas_selecao").
  RUN VALUE(servicePath)(phFiscal[1],phFiscal[2],phFiscal[3],phFiscal[4],phFiscal[5],phFiscal[6],phFiscal[7],phFiscal[8],phFiscal[9],phFiscal[10],phFiscal[11],phHeaderRuntime,policy,?,clean,OUTPUT poResponse).
  RETURN.
 END.
 rootTransaction: DO TRANSACTION ON ERROR UNDO, THROW:'''),
 ('  IF op="calcular_impostos" THEN DO:','  IF op="calcular_impostos" OR op="selecionar_despesas" THEN DO:'),
 ('  IF op="sincronizar" OR op="calcular_impostos" THEN DO:','  IF op="sincronizar" OR op="calcular_impostos" OR op="selecionar_despesas" THEN DO:'),
 ('IF op="calcular_impostos" THEN poResponse:Add("committed",TRUE).','IF op="calcular_impostos" OR op="selecionar_despesas" THEN poResponse:Add("committed",TRUE).'),
 ('(IF op="calcular_impostos" THEN "impostos calculados; memoria " ELSE "impostos sincronizados; memoria ")','(IF op="calcular_impostos" THEN "impostos calculados; memoria " ELSE IF op="selecionar_despesas" THEN "defaults e despesas selecionadas processados; memoria " ELSE "impostos sincronizados; memoria ")')
])
patch('sursum-api/programs/ContainersProcessos.p',[
 (' IF op="calcular_impostos" AND NOT cEstab BEGINS "5" THEN',' IF (op="calcular_impostos" OR op="selecionar_despesas" OR op="options") AND NOT cEstab BEGINS "5" THEN')
])
(root/'patches/core-plan.json').write_text(json.dumps({'requiresPredecessorManifestSha256':'b1235ab3d39a9c930abd12f7a05a9674cad4149ac9765169eb6d3b6b940ce5c3','predecessorBaselines':predecessorHashes,'textPatches':patchPlans},indent=2),encoding='utf-8')
