/* Configuration/dictionary only. No public parameters, business rows or writer calls. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE TEMP-TABLE ttDef NO-UNDO FIELD id AS INTEGER FIELD caption AS CHARACTER FIELD tax AS INTEGER FIELD calculated AS LOGICAL FIELD percentage AS DECIMAL FIELD perItem AS LOGICAL FIELD ordinal AS INTEGER FIELD taxType AS INTEGER FIELD productBase AS LOGICAL INDEX pk IS UNIQUE PRIMARY id.
DEFINE TEMP-TABLE ttLink NO-UNDO FIELD id AS INTEGER FIELD active AS INTEGER FIELD percentage AS DECIMAL FIELD costId AS INTEGER FIELD costPercentage AS DECIMAL INDEX pk IS UNIQUE PRIMARY id.
DEFINE TEMP-TABLE ttBase NO-UNDO FIELD taxId AS INTEGER FIELD baseId AS INTEGER INDEX pk taxId baseId.
DEFINE TEMP-TABLE ttRel NO-UNDO FIELD id AS INTEGER FIELD baseId AS INTEGER INDEX pk id baseId.
DEFINE TEMP-TABLE ttTarget NO-UNDO FIELD id AS INTEGER INDEX pk IS UNIQUE PRIMARY id.
DEFINE VARIABLE report AS JsonObject NO-UNDO.
DEFINE VARIABLE rows AS JsonArray NO-UNDO.
DEFINE VARIABLE candidates AS JsonArray NO-UNDO.
DEFINE VARIABLE preferredPair AS JsonArray NO-UNDO.
DEFINE VARIABLE dependencies AS JsonArray NO-UNDO.
DEFINE VARIABLE rowValue AS JsonObject NO-UNDO.
DEFINE VARIABLE buffers AS HANDLE EXTENT 5 NO-UNDO.
DEFINE VARIABLE q AS HANDLE NO-UNDO.
DEFINE VARIABLE metaFile AS HANDLE NO-UNDO.
DEFINE VARIABLE metaTrigger AS HANDLE NO-UNDO.
DEFINE VARIABLE companyId AS INTEGER NO-UNDO.
DEFINE VARIABLE companyCount AS INTEGER NO-UNDO.
DEFINE VARIABLE distributionId AS INTEGER NO-UNDO.
DEFINE VARIABLE scanned AS INTEGER NO-UNDO.
DEFINE VARIABLE started AS INTEGER NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE targetCount AS INTEGER NO-UNDO.
DEFINE VARIABLE taxCount AS INTEGER NO-UNDO.
DEFINE VARIABLE costCount AS INTEGER NO-UNDO.
DEFINE VARIABLE c AS CHARACTER NO-UNDO.
DEFINE VARIABLE pathValue AS CHARACTER NO-UNDO.
DEFINE VARIABLE configReady AS LOGICAL NO-UNDO INITIAL TRUE.
DEFINE VARIABLE completed AS LOGICAL NO-UNDO.
{sursum-api/includes/parametros_ima.i}
PROCEDURE Scan:
 DEFINE INPUT PARAMETER slot AS INTEGER NO-UNDO. DEFINE INPUT PARAMETER whereValue AS CHARACTER NO-UNDO.
 IF VALID-HANDLE(q) THEN DO: q:QUERY-CLOSE() NO-ERROR. DELETE OBJECT q. END.
 CREATE QUERY q. q:SET-BUFFERS(buffers[slot]).
 IF NOT q:QUERY-PREPARE('FOR EACH ' + buffers[slot]:NAME + ' NO-LOCK WHERE ' + whereValue) THEN UNDO, THROW NEW Progress.Lang.AppError('Fixed configuration query unavailable.',1).
 q:QUERY-OPEN(). q:GET-FIRST(NO-LOCK).
END PROCEDURE.
PROCEDURE CheckBudget:
 scanned=scanned + 1.
 IF scanned>50000 OR ETIME - started>10000 THEN UNDO, THROW NEW Progress.Lang.AppError('Configuration budget exceeded.',1).
END PROCEDURE.
PROCEDURE Probe:
 IF NOT CONNECTED('espec') THEN UNDO, THROW NEW Progress.Lang.AppError('espec read-only connection required.',1).
 c=buscarParametroIma('despesa_distr_custo','0').
 IF c=? OR c='' THEN UNDO, THROW NEW Progress.Lang.AppError('Distribution parameter invalid.',1).
 distributionId=INTEGER(c).
 IF distributionId<0 OR STRING(DECIMAL(c))<>STRING(DECIMAL(distributionId)) THEN UNDO, THROW NEW Progress.Lang.AppError('Distribution parameter must be integer.',1).
 DO n=1 TO 5: CREATE BUFFER buffers[n] FOR TABLE ('espec.' + ENTRY(n,'empresas,despesas,empresas_despesa,despesas_impostos,relacs_desp_calculada')) BUFFER-NAME ('b1042cfg' + STRING(n)). END.
 RUN Scan(1,buffers[1]:NAME + '.cod_emp_ems2=5').
 DO WHILE NOT q:QUERY-OFF-END: RUN CheckBudget. companyCount=companyCount + 1. companyId=buffers[1]:BUFFER-FIELD('empresa_id'):BUFFER-VALUE. q:GET-NEXT(NO-LOCK). END.
 IF companyCount<>1 OR companyId=? OR companyId<1 THEN UNDO, THROW NEW Progress.Lang.AppError('MED company missing or ambiguous.',1).
 report:Add('company_id',companyId). report:Add('distribution_expense_id',distributionId).
 RUN Scan(2,'TRUE'). rows=NEW JsonArray().
 DO WHILE NOT q:QUERY-OFF-END:
  RUN CheckBudget. CREATE ttDef. ASSIGN ttDef.id=buffers[2]:BUFFER-FIELD('despesa_id'):BUFFER-VALUE ttDef.caption=buffers[2]:BUFFER-FIELD('descricao'):BUFFER-VALUE ttDef.tax=buffers[2]:BUFFER-FIELD('log_imposto'):BUFFER-VALUE ttDef.calculated=buffers[2]:BUFFER-FIELD('log_calculada'):BUFFER-VALUE ttDef.percentage=buffers[2]:BUFFER-FIELD('perc_calculo'):BUFFER-VALUE ttDef.perItem=buffers[2]:BUFFER-FIELD('log_calc_por_item'):BUFFER-VALUE.
  ASSIGN ttDef.ordinal=buffers[2]:BUFFER-FIELD('ordem'):BUFFER-VALUE ttDef.taxType=buffers[2]:BUFFER-FIELD('ind_imposto'):BUFFER-VALUE ttDef.productBase=buffers[2]:BUFFER-FIELD('log_vl_prod_base_calculo'):BUFFER-VALUE.
  rowValue=NEW JsonObject(). rowValue:Add('despesa_id',ttDef.id).
  IF ttDef.caption=? THEN rowValue:AddNull('descricao'). ELSE rowValue:Add('descricao',ttDef.caption).
  IF ttDef.tax=? THEN rowValue:AddNull('log_imposto'). ELSE rowValue:Add('log_imposto',ttDef.tax).
  IF ttDef.calculated=? THEN rowValue:AddNull('log_calculada'). ELSE rowValue:Add('log_calculada',ttDef.calculated).
  IF ttDef.percentage=? THEN rowValue:AddNull('perc_calculo'). ELSE rowValue:Add('perc_calculo',ttDef.percentage).
  IF ttDef.perItem=? THEN rowValue:AddNull('log_calc_por_item'). ELSE rowValue:Add('log_calc_por_item',ttDef.perItem).
  IF ttDef.ordinal=? THEN rowValue:AddNull('ordem'). ELSE rowValue:Add('ordem',ttDef.ordinal).
  IF ttDef.taxType=? THEN rowValue:AddNull('ind_imposto'). ELSE rowValue:Add('ind_imposto',ttDef.taxType).
  IF ttDef.productBase=? THEN rowValue:AddNull('log_vl_prod_base_calculo'). ELSE rowValue:Add('log_vl_prod_base_calculo',ttDef.productBase).
  rows:Add(rowValue). q:GET-NEXT(NO-LOCK).
 END. report:Add('expense_definitions',rows).
 RUN Scan(3,buffers[3]:NAME + '.empresa_id=' + TRIM(STRING(companyId,'->>>>>>>>>9'))). rows=NEW JsonArray().
 DO WHILE NOT q:QUERY-OFF-END:
  RUN CheckBudget. CREATE ttLink. ASSIGN ttLink.id=buffers[3]:BUFFER-FIELD('despesa_id'):BUFFER-VALUE ttLink.active=buffers[3]:BUFFER-FIELD('log_ativo'):BUFFER-VALUE ttLink.percentage=buffers[3]:BUFFER-FIELD('percentual'):BUFFER-VALUE ttLink.costId=buffers[3]:BUFFER-FIELD('despesa_custo_id'):BUFFER-VALUE ttLink.costPercentage=buffers[3]:BUFFER-FIELD('percentual_custo'):BUFFER-VALUE.
  rowValue=NEW JsonObject(). rowValue:Add('despesa_id',ttLink.id).
  IF ttLink.active=? THEN rowValue:AddNull('log_ativo'). ELSE rowValue:Add('log_ativo',ttLink.active).
  IF ttLink.percentage=? THEN rowValue:AddNull('percentual'). ELSE rowValue:Add('percentual',ttLink.percentage).
  IF ttLink.costId=? THEN rowValue:AddNull('despesa_custo_id'). ELSE rowValue:Add('despesa_custo_id',ttLink.costId).
  IF ttLink.costPercentage=? THEN rowValue:AddNull('percentual_custo'). ELSE rowValue:Add('percentual_custo',ttLink.costPercentage).
  rows:Add(rowValue). q:GET-NEXT(NO-LOCK).
 END. report:Add('company_expenses',rows).
 RUN Scan(4,buffers[4]:NAME + '.empresa_id=' + TRIM(STRING(companyId,'->>>>>>>>>9'))). rows=NEW JsonArray().
 DO WHILE NOT q:QUERY-OFF-END:
  RUN CheckBudget. CREATE ttBase. ASSIGN ttBase.taxId=buffers[4]:BUFFER-FIELD('imposto_id'):BUFFER-VALUE ttBase.baseId=buffers[4]:BUFFER-FIELD('despesa_id'):BUFFER-VALUE.
  rowValue=NEW JsonObject(). IF ttBase.taxId=? THEN rowValue:AddNull('imposto_id'). ELSE rowValue:Add('imposto_id',ttBase.taxId).
  IF ttBase.baseId=? THEN rowValue:AddNull('despesa_id'). ELSE rowValue:Add('despesa_id',ttBase.baseId).
  rows:Add(rowValue). q:GET-NEXT(NO-LOCK).
 END. report:Add('tax_bases',rows).
 RUN Scan(5,'TRUE'). rows=NEW JsonArray().
 DO WHILE NOT q:QUERY-OFF-END:
  RUN CheckBudget. CREATE ttRel. ASSIGN ttRel.id=buffers[5]:BUFFER-FIELD('despesa_id'):BUFFER-VALUE ttRel.baseId=buffers[5]:BUFFER-FIELD('despesa_id_base'):BUFFER-VALUE.
  rowValue=NEW JsonObject(). IF ttRel.id=? THEN rowValue:AddNull('despesa_id'). ELSE rowValue:Add('despesa_id',ttRel.id).
  IF ttRel.baseId=? THEN rowValue:AddNull('despesa_id_base'). ELSE rowValue:Add('despesa_id_base',ttRel.baseId).
  rows:Add(rowValue). q:GET-NEXT(NO-LOCK).
 END. report:Add('calculated_relations',rows).
 FOR EACH ttLink:
  FIND ttDef WHERE ttDef.id=ttLink.id NO-ERROR.
  IF NOT AVAILABLE ttDef THEN DO: configReady=FALSE. NEXT. END.
  IF ttDef.tax=1 AND ttDef.perItem=FALSE THEN DO:
   taxCount=taxCount + 1. IF ttLink.percentage=? THEN configReady=FALSE.
   IF NOT CAN-FIND(FIRST ttTarget WHERE ttTarget.id=ttDef.id) THEN DO: CREATE ttTarget. ttTarget.id=ttDef.id. END.
  END.
  IF ttLink.costId=? THEN configReady=FALSE.
  ELSE IF ttLink.costId<>0 THEN DO:
   costCount=costCount + 1.
   IF ttLink.percentage=? OR ttLink.percentage=0 OR ttLink.costPercentage=? OR NOT CAN-FIND(FIRST ttDef WHERE ttDef.id=ttLink.costId) THEN configReady=FALSE.
   IF NOT CAN-FIND(FIRST ttTarget WHERE ttTarget.id=ttLink.costId) THEN DO: CREATE ttTarget. ttTarget.id=ttLink.costId. END.
  END.
 END.
 FOR EACH ttTarget: targetCount=targetCount + 1. END.
 FOR EACH ttDef BY ttDef.id:
  FIND ttLink WHERE ttLink.id=ttDef.id NO-ERROR.
  IF NOT AVAILABLE ttLink THEN NEXT.
  IF ttLink.active=? OR ttLink.active<>1 OR ttDef.tax=? OR ttDef.tax<>0 OR ttDef.calculated=? OR ttDef.calculated<>FALSE OR ttDef.perItem=? OR ttDef.perItem<>FALSE OR ttDef.percentage=? OR ttDef.percentage<>0 OR ttLink.percentage=? OR ttLink.percentage<>0 OR ttLink.costId=? OR ttLink.costId<>0 OR ttDef.id=distributionId THEN NEXT.
  IF CAN-FIND(FIRST ttBase WHERE ttBase.baseId=ttDef.id) OR CAN-FIND(FIRST ttRel WHERE ttRel.baseId=ttDef.id) OR CAN-FIND(FIRST ttLink WHERE ttLink.costId=ttDef.id) THEN NEXT.
  rowValue=NEW JsonObject(). rowValue:Add('despesa_id',ttDef.id). IF ttDef.caption=? THEN rowValue:AddNull('descricao'). ELSE rowValue:Add('descricao',ttDef.caption).
  rowValue:Add('reason','active non-tax non-calculated non-item zero-percent; not tax/calculated base, distribution or nonrecoverable target'). candidates:Add(rowValue).
  IF candidates:Length<=2 THEN preferredPair:Add(ttDef.id).
  IF candidates:Length>200 THEN UNDO, THROW NEW Progress.Lang.AppError('More than200 candidates; no truncation.',1).
 END.
 report:Add('tax_target_count',taxCount). report:Add('nonrecoverable_binding_count',costCount). report:Add('maximum_distinct_fiscal_expenses_without_items',targetCount).
 report:Add('local_configuration_prerequisites_valid',configReady). report:Add('zero_fiscal_proven',FALSE).
 report:Add('zero_fiscal_gate','Root must replay captured configuration through central planner using TT with zero items/base values, check cycles/duplicates/rounding and <=20 fiscal targets; this probe never invokes a writer.').
 report:Add('safe_definition_candidates',candidates). report:Add('preferred_pair_for_readonly_review',preferredPair).
END PROCEDURE.
PROCEDURE CleanupDependencies:
 DEFINE VARIABLE tableName AS CHARACTER NO-UNDO. DEFINE VARIABLE procName AS CHARACTER NO-UNDO.
 rowValue=NEW JsonObject(). pathValue=SEARCH('estrg\tdpp001.p'). IF pathValue=? THEN rowValue:AddNull('windows_p'). ELSE rowValue:Add('windows_p',pathValue).
 pathValue=SEARCH('estrg\tdpp001.r'). IF pathValue=? THEN rowValue:AddNull('windows_r'). ELSE rowValue:Add('windows_r',pathValue).
 pathValue=SEARCH('estrg/tdpp001.p'). IF pathValue=? THEN rowValue:AddNull('portable_p'). ELSE rowValue:Add('portable_p',pathValue).
 pathValue=SEARCH('estrg/tdpp001.r'). IF pathValue=? THEN rowValue:AddNull('portable_r'). ELSE rowValue:Add('portable_r',pathValue).
 report:Add('tdpp001_search',rowValue).
 DO n=1 TO NUM-ENTRIES('ContainersCabecalhoCrudService,ContainersCabecalhoRules,ContainersCabecalhoRuntime'):
  c=ENTRY(n,'ContainersCabecalhoCrudService,ContainersCabecalhoRules,ContainersCabecalhoRuntime'). rowValue=NEW JsonObject(). rowValue:Add('program',c).
  pathValue=SEARCH('sursum-api/programs/' + c + '.r'). IF pathValue=? THEN rowValue:AddNull('compiled'). ELSE rowValue:Add('compiled',pathValue). dependencies:Add(rowValue).
 END.
 report:Add('cleanup_program_dependencies',dependencies).
 IF NOT CONNECTED('espec') THEN RETURN.
 CREATE BUFFER metaFile FOR TABLE 'espec._File' BUFFER-NAME 'b1042file'. CREATE BUFFER metaTrigger FOR TABLE 'espec._File-Trig' BUFFER-NAME 'b1042trig'.
 rows=NEW JsonArray().
 DO n=1 TO NUM-ENTRIES('pp-container,despesas_container,calcs_imp_container'):
  tableName=ENTRY(n,'pp-container,despesas_container,calcs_imp_container').
  IF VALID-HANDLE(q) THEN DO: q:QUERY-CLOSE() NO-ERROR. DELETE OBJECT q. END.
  CREATE QUERY q. q:SET-BUFFERS(metaFile,metaTrigger).
  IF NOT q:QUERY-PREPARE('FOR EACH b1042file NO-LOCK WHERE b1042file._File-Name=' + QUOTER(tableName) + ', EACH b1042trig NO-LOCK WHERE b1042trig._File-Recid=RECID(b1042file)') THEN UNDO, THROW NEW Progress.Lang.AppError('Fixed trigger dictionary query unavailable.',1).
  q:QUERY-OPEN(). q:GET-FIRST(NO-LOCK).
  DO WHILE NOT q:QUERY-OFF-END:
   RUN CheckBudget. procName=metaTrigger:BUFFER-FIELD('_Proc-Name'):BUFFER-VALUE. rowValue=NEW JsonObject(). rowValue:Add('table',tableName).
   rowValue:Add('event',STRING(metaTrigger:BUFFER-FIELD('_Event'):BUFFER-VALUE)). rowValue:Add('procedure',procName).
   pathValue=SEARCH(procName). IF pathValue=? THEN rowValue:AddNull('search_exact'). ELSE rowValue:Add('search_exact',pathValue).
   pathValue=SEARCH(REPLACE(procName,'\','/')). IF pathValue=? THEN rowValue:AddNull('search_portable'). ELSE rowValue:Add('search_portable',pathValue).
   rows:Add(rowValue). q:GET-NEXT(NO-LOCK).
  END.
 END. report:Add('dictionary_triggers',rows).
END PROCEDURE.
report=NEW JsonObject(). candidates=NEW JsonArray(). preferredPair=NEW JsonArray(). dependencies=NEW JsonArray(). started=ETIME.
report:Add('kind','1042-readonly-configuration-preflight'). report:Add('parameters','none; fixed MED configuration and cleanup metadata only'). report:Add('openedge',PROVERSION). report:Add('num_dbs',NUM-DBS).
report:Add('cleanup_proven',FALSE). report:Add('cleanup_gate','Do not create fixture until root proves trigger/dependency closure. Preserve existing triggers; never disable or bypass missing tdpp001.').
DO ON ERROR UNDO, THROW:
 DO STOP-AFTER 10 ON STOP UNDO, LEAVE:
  DO ON ERROR UNDO, THROW:
   RUN CleanupDependencies.
   CATCH metadataError AS Progress.Lang.Error: report:Add('cleanup_dictionary_error',metadataError:GetMessage(1)). END CATCH.
  END.
  RUN Probe. completed=TRUE.
 END.
 report:Add('completed',completed). report:Add('scanned_configuration_rows',scanned).
 CATCH e AS Progress.Lang.Error: report:Add('completed',FALSE). report:Add('error',e:GetMessage(1)). END CATCH.
 FINALLY:
  IF VALID-HANDLE(q) THEN DO: q:QUERY-CLOSE() NO-ERROR. DELETE OBJECT q NO-ERROR. END.
  DO n=1 TO 5: IF VALID-HANDLE(buffers[n]) THEN DELETE OBJECT buffers[n] NO-ERROR. END.
  IF VALID-HANDLE(metaTrigger) THEN DELETE OBJECT metaTrigger NO-ERROR. IF VALID-HANDLE(metaFile) THEN DELETE OBJECT metaFile NO-ERROR.
 END FINALLY.
END.
report:WriteFile('expense-batch-preflight.json',TRUE).
MESSAGE '1042 readonly preflight report prepared; no writer/trigger/sequence executed.'.
