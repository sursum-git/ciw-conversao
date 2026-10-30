'use strict';
// Root only, after immutable official9/PASOE proofs and a separate exact metadata release.
const c=require('./purchase-payments-builder-common.cjs'),crypto=require('node:crypto'),prep=require('./prepare-ciw-completion-build9-metadata.cjs');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build9-v2'),dir=c.path.join(c.root,'.runtime/ciw-completion-20261028/build9-v2-metadata-publication-preparation');
const clone=v=>structuredClone(v),safe=v=>Array.isArray(v)?v.map(safe):v&&typeof v==='object'?Object.fromEntries(Object.entries(v).map(([k,x])=>[k,k==='authHeaders'?[]:safe(x)])):v;
const contract=v=>prep.programContract(safe(v));
const invariantSource=v=>{const x=clone(v);delete x.operations;delete x.updatedAt;return x;};
const write=(name,value)=>c.fs.writeFileSync(c.path.join(dir,name),JSON.stringify(safe(value),null,2)+'\n');
function sourceTransition(journal,status){const next={'request-started':undefined,'request-returned':'request-started',verified:'request-returned'};c.assert.ok(Object.hasOwn(next,status)&&journal.sourceStatus===next[status],'SOURCE_JOURNAL_TRANSITION_INVALID');return{...journal,sourceStatus:status};}
async function main(){
 c.assert.ok(process.argv.includes('--execute-reviewed-plan'),'ROOT_REVIEWED_EXECUTION_REQUIRED');
 const planFile=c.path.join(dir,'plan.json'),plan=c.readJson(planFile),release=c.readJson(c.path.join(dir,'manager-metadata-release.json'));
 c.assert.ok(release.success&&release.publisherSha256===c.sha(__filename)&&release.preparerSha256===c.sha(require.resolve('./prepare-ciw-completion-build9-metadata.cjs'))&&release.planSha256===c.sha(planFile),'EXACT_METADATA_RELEASE_REQUIRED');
 c.assert.equal(c.sha(plan.buildRelease.path),plan.buildRelease.sha256);c.assert.equal(plan.buildRelease.sha256,release.build9ReleaseSha256);c.assert.ok(c.readJson(plan.buildRelease.path).success,'BUILD9_RELEASE_REQUIRED');
 c.assert.equal(c.sha(plan.productFreeze.path),plan.productFreeze.sha256);c.assert.equal(plan.productFreeze.sha256,'60aa0eefd598d7bbb0d9e3da07deef060283367c164612f7bf09d3243a3851ff');
 c.assert.equal(c.sha(plan.source.baselinePath),plan.source.baselineSha256);c.assert.equal(c.sha(plan.parent.baselinePath),plan.parent.baselineSha256);c.assert.equal(c.sha(plan.parent.draftFile),plan.parent.draftSha256);c.assert.equal(c.sha(plan.newProgram.path),plan.newProgram.sha256);
 c.assert.equal(c.sha(plan.nativeOwnerProof.path),release.nativeOwnerProofSha256);c.assert.equal(c.sha(plan.parent.previewProofFile),release.parentPreviewProofSha256);
 const owner=c.readJson(plan.nativeOwnerProof.path),parentProof=c.readJson(plan.parent.previewProofFile);
 c.assert.ok(owner.success&&owner.readOnly&&owner.resolver==='findStandardProgramVersionByEntity','NATIVE_OWNER_PROOF_REQUIRED');c.assert.equal(owner.owners.containers_progress.programCode,'op1000');c.assert.equal(owner.parentBaselineSha256,plan.parent.baselineSha256);
 c.assert.ok(parentProof.success&&parentProof.readOnly&&parentProof.deltaReviewed&&parentProof.wholeDefinitionCompared,'WHOLE_PARENT_PREVIEW_REQUIRED');c.assert.equal(parentProof.parentBaselineSha256,plan.parent.baselineSha256);c.assert.equal(parentProof.draftSha256,plan.parent.draftSha256);c.assert.equal(parentProof.build9ReleaseSha256,release.build9ReleaseSha256);c.assert.ok(parentProof.expectedGeneratedDefinition);
 const evidences=[];for(const name of ['official-compile-verification.json','canonical-manifest.json','active-manifest.json','pasoe-read-proof.json']){const file=c.path.join(state,name);c.assert.ok(c.readJson(file).success,name);c.assert.equal(c.sha(file),release.proofSha256[name],'EXACT_OFFICIAL_RUNTIME_PROOF_REQUIRED');evidences.push({type:name,result:'SHA256 '+c.sha(file)});}
 for(const file of c.readJson(c.path.join(state,'canonical-manifest.json')).files)c.assert.equal(c.sha(file.target),file.sha256,'CURRENT_CANONICAL_CHANGED');
 c.assert.ok(!c.fs.existsSync(plan.journal),'PARTIAL_ATTEMPT_REQUIRES_INSPECTION_NO_REPLAY');
 const baselineExport=c.readJson(plan.source.baselinePath),sourceBefore=baselineExport.apiSource??baselineExport,parentBefore=c.readJson(plan.parent.baselinePath),parentDraft=c.readJson(plan.parent.draftFile),spec=c.readJson(plan.newProgram.path);
 c.assert.equal(spec.programDraft.programCode,'op1053');c.assert.equal(spec.entityDraft.code,'container_nfs_disponiveis_med_progress');c.assert.equal(parentDraft.programCode,'op1000');c.assert.equal(parentDraft.builderEntityCode,'containers_progress');
 await c.session(async({api,runtime,login})=>{
  const boot=await api('/bootstrap');c.assert.ok(!boot.programs.some(x=>(x.programCode??x.code)==='op1053'||x.screenId===spec.programDraft.screenId),'PROGRAM_COLLISION');c.assert.ok(!boot.entities.some(x=>x.code===spec.entityDraft.code),'ENTITY_COLLISION');
  c.assert.deepEqual(contract(await api('/programs/op1000')),contract(parentBefore),'PARENT_CHANGED');
  const parentPreview=await api('/preview',parentDraft);c.assert.deepEqual(safe(parentPreview.generatedDefinition),parentProof.expectedGeneratedDefinition,'WHOLE_PARENT_PREVIEW_CHANGED');
  const actual=(await api('/api-sources/'+plan.source.code)).apiSource;
  for(const field of ['code','baseUrl','responseContract','operations'])c.assert.deepEqual(safe(actual[field]),safe(sourceBefore[field]),'SOURCE_BASELINE_CHANGED');
  const before=clone(actual),candidate=prep.appendOperations(actual,plan.source.operations),previous={};
  for(const screen of ['ciw.container-nfs','ciw.container-pagamentos','ciw.container-despesas'])previous[screen]=await runtime(screen);
  let journal={at:new Date().toISOString(),publisherSha256:c.sha(__filename),planSha256:c.sha(planFile),build9ReleaseSha256:release.build9ReleaseSha256,phases:[],businessWrites:false,humanPermissionsChanged:false};c.fs.writeFileSync(plan.journal,JSON.stringify(journal,null,2)+'\n',{flag:'wx'});
  const persist=()=>c.fs.writeFileSync(plan.journal,JSON.stringify(journal,null,2)+'\n');
  const transition=status=>{journal=sourceTransition(journal,status);persist();};
  transition('request-started');await api('/api-sources',candidate);transition('request-returned');
  const after=(await api('/api-sources/'+plan.source.code)).apiSource;c.assert.equal(after.operations.length,6);c.assert.deepEqual(after.operations.slice(0,4),before.operations,'OLD4_OPERATIONS_CHANGED');c.assert.deepEqual(invariantSource(after),invariantSource(before),'ACTUAL_AUTH_CONNECTION_MASKS_CHANGED');
  for(const op of plan.source.operations){const saved=after.operations.find(x=>x.code===op.code);c.assert.ok(c.compatibleOperation(saved,op,after.baseUrl),'NEW_OPERATION_CONTRACT_CHANGED');c.assert.equal(saved.type,op.type,'NATIVE_LIST_DETAIL_TYPE_REQUIRED');}
  write('source-applied.json',{success:true,code:plan.source.code,before:4,after:6,oldFourPreserved:true,actualAuthenticationPreserved:true,independentClone:true});transition('verified');
  const external=await api('/external/validate',spec);c.assert.equal(external.readyToApply,true);write('op1053-external-validation.json',{success:true,readyToApply:true});
  function phaseEvent(programCode,entityCode,status){journal.phases.push({programCode,entityCode,status});persist();}
  async function phase(programCode,entityCode,work){let grantId;const locks=[];phaseEvent(programCode,entityCode,'started');try{
   const requested=await api('/governance/requests',{programCode,builderEntityCode:entityCode,requestedActions:['edit','publish'],reason:'Conversão CIW9: consulta MED de NFs disponíveis e somente link no cabeçalho. Sem associação/desassociação, negócio ou concessão funcional humana.'});const granted=await api('/governance/grants',{requestId:requested.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']});grantId=granted.grant.id;
   for(const[scopeType,scopeCode]of [['program',programCode],['entity',entityCode]]){const held=await api('/locks/acquire',{scopeType,scopeCode,grantId,lockCategory:'authoring'});c.assert.equal(held.status,'acquired');locks.push(held.lock.lockToken);}phaseEvent(programCode,entityCode,'authorized');const result=await work();phaseEvent(programCode,entityCode,'work-completed');return result;
  }catch(error){phaseEvent(programCode,entityCode,'failed');throw error;}finally{const cleaned=await Promise.allSettled(locks.reverse().map(lockToken=>api('/locks/release',{lockToken})));if(grantId!==undefined)cleaned.push(...await Promise.allSettled([api('/governance/grants/status',{grantId,status:'revoked'})]));const ok=cleaned.every(x=>x.status==='fulfilled');phaseEvent(programCode,entityCode,ok?'released':'cleanup-failed');c.assert.ok(ok,'AUTHORING_CLEANUP_REQUIRED');}}
  async function publish(config,isParent){const preview=await api('/preview',config),definition=preview.generatedDefinition;c.assert.ok(definition);
   if(isParent)c.assert.deepEqual(safe(definition),parentProof.expectedGeneratedDefinition,'PARENT_PREVIEW_CHANGED_AFTER_PREFLIGHT');
   else{c.assert.equal(definition.pageType,'crud');c.assert.equal(definition.dataModel.primaryKey,'nf_key');c.assert.equal(Object.keys(definition.dataModel.fields).length,18);for(const action of ['create','edit','delete'])c.assert.equal(definition.permissions[action],false);}
   const saved=await api('/drafts',config),id=saved.id??saved.version?.id;c.assert.ok(id);const bundleId='ciw-completion-build9-'+crypto.randomUUID();
   await api('/governance/tests',{builderProgramVersionId:id,bundleId,testPlanId:'ciw-completion-build9-20261028',status:'passed',checklistSnapshot:{official122:true,ablChecks:1080,phpTests:968,phpAssertions:6529,readonlyMedOnly:true,sharedNfProjection:true,partialOrigin:true,businessWrites:false,humanPermissionsChanged:false},evidences,notes:'Consulta parcial MED; reutiliza NfRow/NfKey e Finance10handles. IMA, associação e desassociação permanecem fora desta entrega. Não houve negócio, writer nem concessão funcional humana.'});const approved=await api('/governance/approvals',{builderProgramVersionId:id,bundleId});await api('/versions/'+id+'/publish',{});const receipt={success:true,program:config.programCode,screen:config.screenId,version:config.version,versionId:id,approvalId:approved.approval.id};write('publication-'+config.programCode+'.json',receipt);return receipt;
  }
  const published=[];published.push(await phase('op1053',spec.entityDraft.code,async()=>{const saved=await api('/entities',spec.entityDraft);c.assert.equal(saved.entity.code,spec.entityDraft.code);return publish(spec.programDraft,false);}));
  published.push(await phase('op1000','containers_progress',async()=>{c.assert.deepEqual(contract(await api('/programs/op1000')),contract(parentBefore),'PARENT_CHANGED_DURING_PUBLICATION');return publish(parentDraft,true);}));
  for(const[screen,beforeDefinition]of Object.entries(previous))c.assert.deepEqual(await runtime(screen),beforeDefinition,'OTHER_RUNTIME_DEFINITION_CHANGED');
  const touched=new Set(published.map(x=>x.program));c.assert.deepEqual((await api('/bootstrap')).programs.filter(x=>!touched.has(x.programCode??x.code)),boot.programs.filter(x=>!touched.has(x.programCode??x.code)),'UNRELATED_PROGRAM_CHANGED');
  for(const receipt of published){const def=await runtime(receipt.screen);c.assert.equal(def.program.version,receipt.version);write(receipt.program+'-runtime.json',def);}
  write('metadata-publication.json',{success:true,published,financialOperations:6,oldFourPreserved:true,actualAuthenticationPreserved:true,parentOnlyLinkAndVersion:true,scope:'MED available NF read/get only; origin partial',businessWrites:false,processRuns:false,humanPermissionsChanged:false});console.log('PASS metadata9; no business or human permissions changed');
 },{readOnly:false});
}
module.exports={safe,contract,invariantSource,sourceTransition,main};if(require.main===module)main().catch(()=>{console.error('BUILD9_METADATA_PUBLICATION_FAILED_INSPECT_PRIVATE_RECEIPTS');process.exitCode=1;});
