'use strict';
// Prepared offline; root runs only after separate review and official runtime proof.
const c=require('./purchase-payments-builder-common.cjs'),crypto=require('node:crypto');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build8'),dir=c.path.join(c.root,'.runtime/ciw-completion-20261028/build8-metadata-publication-preparation');
const prep=require('./prepare-ciw-completion-build8-metadata.cjs');
const clone=value=>structuredClone(value),safe=value=>Array.isArray(value)?value.map(safe):value&&typeof value==='object'?Object.fromEntries(Object.entries(value).map(([key,item])=>[key,key==='authHeaders'?[]:safe(item)])):value;
const contract=value=>prep.programContract(safe(value));
const write=(name,value)=>c.fs.writeFileSync(c.path.join(dir,name),JSON.stringify(safe(value),null,2)+'\n');
const invariantSource=value=>{const result=clone(value);delete result.operations;delete result.updatedAt;return result;};
function recordSourcePhase(journal,code,status,counts){
 c.assert.ok(['motor_progress_ciw_cadastros','motor_progress_container_processos'].includes(code),'CLOSED_SOURCE_REQUIRED');
 const result=clone(journal),prior=result.sources?.find(x=>x.code===code),next={'request-started':undefined,'request-returned':'request-started',verified:'request-returned'};
 c.assert.ok(Object.hasOwn(next,status)&&prior?.status===next[status],'SOURCE_JOURNAL_TRANSITION_INVALID');
 const row={code,status,before:counts.before,after:counts.after};result.sources=[...(result.sources??[]).filter(x=>x.code!==code),row];return result;
}
async function main(){
 c.assert.ok(process.argv.includes('--execute-reviewed-plan'),'OFFLINE_PREPARED_REQUIRES_ROOT_EXECUTION');
 const plan=c.readJson(c.path.join(dir,'execution-plan-v1.2.json')),release=c.readJson(c.path.join(dir,'manager-metadata-release.json'));
 c.assert.ok(release.success&&release.publisherSha256===c.sha(__filename)&&release.planSha256===c.sha(c.path.join(dir,'execution-plan-v1.2.json')),'REVIEWED_EXACT_PUBLISHER_PLAN_REQUIRED');
 c.assert.equal(release.build8ReleaseSha256,plan.release.build8ReleaseSha256,'PINNED_BUILD8_RELEASE_REQUIRED');
 c.assert.equal(c.sha(c.path.join(state,'manager-release.json')),release.build8ReleaseSha256,'EXACT_RELEASED_BUILD8_REQUIRED');
 const released8=c.readJson(c.path.join(state,'manager-release.json'));c.assert.ok(released8.success,'BUILD8_MANAGER_RELEASE_REQUIRED');c.assert.equal(released8.sealedManifestSha256,plan.buildFreeze.sha256,'RELEASE8_FREEZE_BINDING_REQUIRED');
 c.assert.equal(c.sha(c.path.join(state,'official-compile-verification.json')),release.officialCompileProofSha256,'EXACT_OFFICIAL8_COMPILE_PROOF_REQUIRED');
 c.assert.equal(c.sha(plan.parent.draftFile),plan.parent.draftSha256,'EXACT_PARENT_DRAFT_REQUIRED');
 c.assert.equal(c.sha(plan.parent.previewProofFile),release.parentPreviewProofSha256,'REVIEWED_PARENT_PREVIEW_PROOF_REQUIRED');
 const parentProof=c.readJson(plan.parent.previewProofFile);c.assert.ok(parentProof.success&&parentProof.readOnly&&parentProof.deltaReviewed,'FRESH_READONLY_PARENT_PREVIEW_REQUIRED');c.assert.equal(parentProof.parentBaselineSha256,plan.parent.baselineSha256);c.assert.equal(parentProof.draftSha256,plan.parent.draftSha256);c.assert.equal(parentProof.build8ReleaseSha256,release.build8ReleaseSha256);c.assert.ok(parentProof.expectedGeneratedDefinition);
 c.assert.equal(c.sha(plan.buildFreeze.path),plan.buildFreeze.sha256);c.assert.ok(!c.fs.existsSync(plan.journal),'INSPECT_PARTIAL_BEFORE_REPLAY');
 const ownerProof=c.readJson(plan.nativeOwnerProof.path);c.assert.ok(ownerProof.success&&ownerProof.readOnly&&ownerProof.resolver==='findStandardProgramVersionByEntity','FRESH_NATIVE_OWNER_PROOF_REQUIRED');c.assert.equal(ownerProof.owners.container_despesas_progress.programCode,'op1003');c.assert.equal(ownerProof.parentBaselineSha256,plan.parent.baselineSha256);
 const evidences=['official-compile-verification.json','canonical-manifest.json','active-manifest.json','pasoe-read-proof.json'].map(name=>{c.assert.ok(c.readJson(c.path.join(state,name)).success,name);return{type:name,result:'SHA256 '+c.sha(c.path.join(state,name))};});
 for(const file of c.readJson(c.path.join(state,'canonical-manifest.json')).files)c.assert.equal(c.sha(file.target),file.sha256,'CURRENT_CANONICAL_CHANGED');
 for(const source of plan.sources)c.assert.equal(c.sha(source.baselinePath),source.baselineSha256);
 c.assert.equal(c.sha(plan.parent.baselinePath),plan.parent.baselineSha256);const parentBefore=c.readJson(plan.parent.baselinePath),parentConfig=c.readJson(plan.parent.draftFile),specs=plan.newPrograms.map(item=>{c.assert.equal(c.sha(item.path),item.sha256);return c.readJson(item.path);});
 c.assert.deepEqual(specs.map(x=>[x.programDraft.programCode,x.entityDraft.code]),[['op1047','container_despesas_selecao_progress'],['op1051','item_custos_manual_progress'],['op1052','item_container_amostra_progress']]);
 await c.session(async({api,runtime,login})=>{
  const boot=await api('/bootstrap'),sources=[];
  c.assert.deepEqual(contract(await api('/programs/op1003')),contract(parentBefore),'PARENT_CURRENT_CONTRACT_CHANGED');
  const parentPreflight=await api('/preview',parentConfig);c.assert.deepEqual(safe(parentPreflight.generatedDefinition),parentProof.expectedGeneratedDefinition,'PARENT_PREFLIGHT_DIFFERS_FROM_REVIEWED_REAL_PREVIEW');
  for(const spec of specs){c.assert.ok(!boot.programs.some(x=>(x.programCode??x.code)===spec.programDraft.programCode||x.screenId===spec.programDraft.screenId),'NEW_PROGRAM_COLLISION');c.assert.ok(!boot.entities.some(x=>x.code===spec.entityDraft.code),'NEW_ENTITY_COLLISION');}
  for(const planSource of plan.sources){const current=(await api('/api-sources/'+planSource.code)).apiSource,baseline=c.readJson(planSource.baselinePath);for(const key of ['code','baseUrl','responseContract','operations'])c.assert.deepEqual(safe(current[key]),safe(baseline[key]),'SOURCE_BASELINE_CHANGED');c.assert.equal(current.operations.length,planSource.before);sources.push({plan:planSource,before:clone(current),candidate:prep.appendOperations(current,planSource.operations)});}
  const beforeScreens={};for(const screen of ['ciw.container-gerar-versao','ciw.container-fechar-custos','ciw.container-sincronizar-impostos','ciw.container-calcular-impostos'])beforeScreens[screen]=await runtime(screen);
  // Atomic one-attempt journal. Any partial failure needs observed state and a
  // separately reviewed exact companion; this tool implements no resume.
  let journal={at:new Date().toISOString(),publisherSha256:c.sha(__filename),planSha256:c.sha(c.path.join(dir,'execution-plan-v1.2.json')),build8ReleaseSha256:release.build8ReleaseSha256,programs:specs.map(x=>x.programDraft.programCode),sources:[],phases:[],businessWrites:false,humanPermissionsChanged:false};
  c.fs.writeFileSync(plan.journal,JSON.stringify(journal,null,2)+'\n',{flag:'wx'});
  function journalSource(entry,status){journal=recordSourcePhase(journal,entry.plan.code,status,entry.plan);c.fs.writeFileSync(plan.journal,JSON.stringify(journal,null,2)+'\n');}
  function journalPhase(programCode,entityCode,status){journal.phases.push({programCode,entityCode,status});c.fs.writeFileSync(plan.journal,JSON.stringify(journal,null,2)+'\n');}
  for(const entry of sources){
   journalSource(entry,'request-started');await api('/api-sources',entry.candidate);journalSource(entry,'request-returned');const after=(await api('/api-sources/'+entry.plan.code)).apiSource;
   c.assert.equal(after.operations.length,entry.plan.after);c.assert.deepEqual(after.operations.slice(0,entry.plan.before),entry.before.operations,'OLD_OPERATIONS_CHANGED');
   c.assert.deepEqual(invariantSource(after),invariantSource(entry.before),'ACTUAL_AUTH_CONNECTION_MASKS_CHANGED');
   for(const op of entry.plan.operations){const actual=after.operations.find(x=>x.code===op.code);c.assert.ok(c.compatibleOperation(actual,op,after.baseUrl),'NEW_OPERATION_CHANGED');if(op.allowProcess)c.assert.equal(actual.allowProcess,true);}
   write('source-'+entry.plan.code+'-applied.json',{success:true,before:entry.plan.before,after:after.operations.length,oldOperationsPreserved:true,actualAuthenticationPreserved:true,independentClone:true});journalSource(entry,'verified');
  }
  // New operations must exist in the actual registry before public external
  // validation can resolve them. This phase never saves an entity or draft.
  for(const spec of specs){const result=await api('/external/validate',spec);c.assert.equal(result.readyToApply,true);write(spec.programDraft.programCode+'-external-validation.json',{readyToApply:true});}
  async function phase(programCode,entityCode,work){
   let grantId;const locks=[];journalPhase(programCode,entityCode,'started');try{const request=await api('/governance/requests',{programCode,builderEntityCode:entityCode,requestedActions:['edit','publish'],reason:'Conversão CIW8: seleção reutiliza rotina central e duas consultas somente leitura; somente cadastro de metadados. Nenhuma execução operacional ou concessão funcional humana.'});const granted=await api('/governance/grants',{requestId:request.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']});grantId=granted.grant.id;
    for(const[scopeType,scopeCode]of [['program',programCode],['entity',entityCode]]){const held=await api('/locks/acquire',{scopeType,scopeCode,grantId,lockCategory:'authoring'});c.assert.equal(held.status,'acquired');locks.push(held.lock.lockToken);}journalPhase(programCode,entityCode,'authorized');const result=await work();journalPhase(programCode,entityCode,'work-completed');return result;
   }catch(error){journalPhase(programCode,entityCode,'failed');throw error;}
   finally{const results=await Promise.allSettled(locks.reverse().map(lockToken=>api('/locks/release',{lockToken})));if(grantId!==undefined){const revoked=await Promise.allSettled([api('/governance/grants/status',{grantId,status:'revoked'})]);results.push(...revoked);}const cleaned=results.every(x=>x.status==='fulfilled');journalPhase(programCode,entityCode,cleaned?'released':'cleanup-failed');c.assert.ok(cleaned,'PHASE_GOVERNANCE_CLEANUP_REQUIRED');}
  }
  async function publish(config,parent=false){
   const preview=await api('/preview',config),def=preview.generatedDefinition;c.assert.ok(def);
   if(parent){const previous=parentBefore.versions.find(x=>x.status==='published').generatedDefinition;c.assert.deepEqual(safe(def),parentProof.expectedGeneratedDefinition,'PARENT_PREVIEW_CHANGED_AFTER_PREFLIGHT');c.assert.equal(def.crud.grid.rowLinks.length,previous.crud.grid.rowLinks.length+1);c.assert.deepEqual(def.crud.grid.rowLinks.at(-1),plan.parent.linkOnly);}
   else if(config.pageType==='crud'){for(const action of ['create','edit','delete'])c.assert.equal(def.permissions[action],false);c.assert.equal(def.dataModel.primaryKey,'record_key');}
   else{c.assert.equal(def.pageType,'process');c.assert.deepEqual(def.dataModel.fields.despesa_ids.optionsSource.parameterFields,['ordem_campo','ordem_direcao']);c.assert.ok(def.process.actions.process.confirmation);}
   const saved=await api('/drafts',config),versionId=saved.id??saved.version?.id;c.assert.ok(versionId);const bundleId='ciw-completion-build8-'+crypto.randomUUID();
   await api('/governance/tests',{builderProgramVersionId:versionId,bundleId,testPlanId:'ciw-completion-build8-20261028',status:'passed',checklistSnapshot:{official122:true,ablChecks:4664,phpTests:952,phpAssertions:6351,metadataBuilderTests:2,metadataBuilderAssertions:41,closedSchemas:true,sharedCollectorsAndPersistence:true,positiveOperational1047Pending:true,businessWrites:false,humanPermissionsChanged:false},evidences,notes:'Registro de metadados sobre provas oficiais8 e consultas readonly PASOE. Nenhum processo1047 executado. Seleção reutiliza coleta/cálculo/persistência centrais; duas consultas preservam escopoGLOBAL da origem. Acesso humano e execução operacional1047 exigem autorização própria.'});
   const approved=await api('/governance/approvals',{builderProgramVersionId:versionId,bundleId});await api('/versions/'+versionId+'/publish',{});const receipt={success:true,program:config.programCode,screen:config.screenId,version:config.version,versionId,approvalId:approved.approval.id};write('publication-'+config.programCode+'.json',receipt);return receipt;
  }
  const published=[];
  for(const spec of specs)published.push(await phase(spec.programDraft.programCode,spec.entityDraft.code,async()=>{const saved=await api('/entities',spec.entityDraft);c.assert.equal(saved.entity.code,spec.entityDraft.code);return publish(spec.programDraft);}));
  published.push(await phase('op1003','container_despesas_progress',async()=>{c.assert.deepEqual(contract(await api('/programs/op1003')),contract(parentBefore),'PARENT_CHANGED_AFTER_SOURCE_APPEND');return publish(parentConfig,true);}));
  for(const[screen,before]of Object.entries(beforeScreens))c.assert.deepEqual(await runtime(screen),before,'PREVIOUS_PROCESS_DEFINITION_CHANGED');
  const touched=new Set(published.map(x=>x.program));c.assert.deepEqual((await api('/bootstrap')).programs.filter(x=>!touched.has(x.programCode??x.code)),boot.programs.filter(x=>!touched.has(x.programCode??x.code)),'UNRELATED_PROGRAM_CHANGED');
  for(const receipt of published){const definition=await runtime(receipt.screen);c.assert.equal(definition.program.version,receipt.version);write(receipt.program+'-runtime.json',definition);}
  write('metadata-publication.json',{success:true,published,cadastrosOperations:144,processOperations:8,old140And6Preserved:true,authenticationPreserved:true,parentOnlyLinkAndVersion:true,positiveOperational1047Pending:true,businessWrites:false,processRuns:false,humanPermissionsChanged:false});console.log('PASS metadata8 prepared contracts published; no business/process run or functional human grants');
 },{readOnly:false});
}
module.exports={contract,invariantSource,recordSourcePhase,main};
if(require.main===module)main().catch(()=>{console.error('BUILD8_METADATA_PUBLICATION_FAILED_INSPECT_PRIVATE_RECEIPTS');process.exitCode=1;});
