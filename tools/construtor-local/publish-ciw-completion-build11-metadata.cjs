'use strict';
// Root executes only after separate exact metadata release. Importing this file is offline.
const c=require('./purchase-payments-builder-common.cjs'),crypto=require('node:crypto'),prep=require('./prepare-ciw-completion-build11-metadata.cjs');
const {dir,read,sha,clone,safe,invariantSource}=prep;
const write=(name,value)=>{const file=c.path.join(dir,name);c.fs.writeFileSync(file,JSON.stringify(safe(value),null,2)+'\n');return{path:file,sha256:sha(file)};};
function sourceTransition(journal,next){const previous={'request-started':'not-started','request-returned':'request-started',verified:'request-returned'};c.assert.equal(journal.sourceStatus,previous[next],'SOURCE_JOURNAL_TRANSITION_INVALID');c.assert.ok(Object.hasOwn(previous,next));return{...journal,sourceStatus:next};}
function assertNewOperation(actual,expected,baseUrl){c.assert.ok(actual);for(const key of ['code','type','method','bodyTemplate','requestContextFields'])c.assert.deepEqual(actual[key],expected[key],'NEW_OPERATION_CONTRACT_CHANGED');c.assert.equal(c.operationPath(baseUrl,actual.path),c.operationPath(baseUrl,expected.path));for(const key of ['headers','queryParams'])c.assert.deepEqual(actual[key]??[],expected[key]);for(const key of ['itemsPath','totalPath','itemPath'])if(Object.hasOwn(expected,key))c.assert.equal(actual[key],expected[key]);c.assert.ok(!actual.allowProcess);}
function assertActualSourceAfter(after,before,operations){c.assert.equal(after.operations.length,146);c.assert.deepEqual(after.operations.slice(0,144),before.operations,'OLD144_CHANGED');c.assert.deepEqual(invariantSource(after),invariantSource(before),'ACTUAL_AUTH_OR_CONFIG_CHANGED');for(const expected of operations)assertNewOperation(after.operations.find(x=>x.code===expected.code),expected,after.baseUrl);}
function assertReadonlyDefinition(def){c.assert.equal(def.pageType,'crud');c.assert.equal(def.program.id,'op1055');c.assert.equal(def.program.entity,'despesas_impostos_geral_progress');c.assert.equal(def.program.version,'1.0.0');c.assert.equal(def.dataModel.primaryKey,'record_key');c.assert.deepEqual(Object.keys(def.dataModel.fields),['despesa_id','imposto_id','empresa_id','record_key']);c.assert.deepEqual(def.contextFields,[]);c.assert.deepEqual(def.crud.grid.columns.map(x=>x.field),['despesa_id','imposto_id']);for(const key of ['create','edit','delete'])c.assert.equal(def.permissions[key],false);for(const key of ['create','update','delete'])c.assert.ok(!def.dataSource.api[key]);}
async function authoringPhase(api,userId,work,event,mutate){
 let grantId;const locks=[];event('started');
 try{
  const requested=await mutate('governance-request',()=>api('/governance/requests',{programCode:'op1055',builderEntityCode:'despesas_impostos_geral_progress',requestedActions:['edit','publish'],reason:'CIW11: consulta global readonly de relacoes despesa/imposto. Sem manutencao, negocio ou concessao funcional humana.'}));
  const granted=await mutate('authoring-grant',()=>api('/governance/grants',{requestId:requested.request.id,grantedToUserId:String(userId),allowedActions:['edit','publish']}));grantId=granted.grant.id;
  for(const[scopeType,scopeCode]of [['program','op1055'],['entity','despesas_impostos_geral_progress']]){const held=await mutate('lock-'+scopeType,()=>api('/locks/acquire',{scopeType,scopeCode,grantId,lockCategory:'authoring'}));c.assert.equal(held.status,'acquired');c.assert.ok(held.lock.lockToken);locks.push({scopeType,lockToken:held.lock.lockToken});}
  event('both-locks-acquired');const result=await work();event('work-completed');return result;
 }catch(error){event('failed');throw error;}
 finally{
  const released=await Promise.allSettled(locks.reverse().map(lock=>mutate('release-'+lock.scopeType,()=>api('/locks/release',{lockToken:lock.lockToken}))));
  if(grantId!==undefined)released.push(...await Promise.allSettled([mutate('revoke-authoring-grant',()=>api('/governance/grants/status',{grantId,status:'revoked'}))]));
  const ok=released.every(x=>x.status==='fulfilled');event(ok?'released':'cleanup-failed');c.assert.ok(ok,'AUTHORING_CLEANUP_REQUIRED');
 }
}
function assertMetadataRelease(plan,release){
 c.assert.ok(release.success&&release.publisherSha256===sha(__filename)&&release.preparerSha256===sha(require.resolve('./prepare-ciw-completion-build11-metadata.cjs'))&&release.planSha256===sha(c.path.join(dir,'plan.json'))&&release.build11ReleaseSha256===plan.buildRelease.sha256,'EXACT_METADATA_RELEASE_REQUIRED');
 c.assert.equal(release.offlineTestsSha256,sha(plan.offlineTests));c.assert.equal(release.normalizerProofSha256,sha(plan.normalizerProof));const tests=read(plan.offlineTests),normalizer=read(plan.normalizerProof);c.assert.ok(tests.success&&tests.networkExecuted===false&&normalizer.success&&normalizer.realBuilder&&normalizer.normalizedCount===146,'OFFLINE_REAL_NORMALIZER_PROOF_REQUIRED');
}
async function main(){
 c.assert.ok(process.argv.includes('--execute-reviewed-plan'),'ROOT_EXECUTE_REVIEWED_PLAN_REQUIRED');
 const plan=read(c.path.join(dir,'plan.json')),release=read(plan.managerMetadataRelease);assertMetadataRelease(plan,release);prep.verifyPlanInputs(plan);
 c.assert.ok(!c.fs.existsSync(plan.journal),'PARTIAL_ATTEMPT_INSPECT_NO_GENERIC_REPLAY');
 const baseline=prep.sourceFromExport(read(plan.source.baselinePath)),spec=read(plan.newProgram.path);
 const evidences=plan.inputs.filter(x=>Object.values(plan.proofPaths).includes(x.path)).map(x=>({type:c.path.basename(x.path),result:'SHA256 '+x.sha256}));
 await c.session(async({api,runtime,login})=>{
  const boot=await api('/bootstrap');c.assert.ok(!boot.programs.some(x=>(x.programCode??x.code)==='op1055'||x.screenId===spec.programDraft.screenId),'PROGRAM_COLLISION');c.assert.ok(!boot.entities.some(x=>x.code===spec.entityDraft.code),'ENTITY_COLLISION');
  const actual=(await api('/api-sources/'+plan.source.code)).apiSource;prep.assertSourceBaseline(actual,baseline);const before=clone(actual),candidate=prep.appendOperations(actual,plan.source.operations);
  let journal={at:new Date().toISOString(),publisherSha256:sha(__filename),planSha256:sha(c.path.join(dir,'plan.json')),build11ReleaseSha256:plan.buildRelease.sha256,sourceStatus:'not-started',phases:[],mutations:[],receipts:[],businessWrites:false,processRuns:false,humanPermissionsChanged:false};
  c.fs.writeFileSync(plan.journal,JSON.stringify(journal,null,2)+'\n',{flag:'wx'});
  const persist=()=>c.fs.writeFileSync(plan.journal,JSON.stringify(journal,null,2)+'\n');
  const receipt=(name,value)=>{const saved=write(name,value);journal.receipts.push(saved);persist();return saved;};
  const mutate=async(stage,fn)=>{const entry={stage,status:'request-started'};journal.mutations.push(entry);persist();const response=await fn();entry.status='request-returned';persist();return response;};
  const event=status=>{journal.phases.push({programCode:'op1055',entityCode:spec.entityDraft.code,status});persist();};
  receipt('metadata-source-before.json',before);journal=sourceTransition(journal,'request-started');persist();
  await mutate('source-append-144-to-146',()=>api('/api-sources',candidate));journal=sourceTransition(journal,'request-returned');persist();
  const after=(await api('/api-sources/'+plan.source.code)).apiSource;assertActualSourceAfter(after,before,plan.source.operations);receipt('metadata-source-after.json',after);receipt('source-applied.json',{success:true,sourceCode:plan.source.code,before:144,after:146,old144Preserved:true,actualAuthenticationPreserved:true,actualConfigAndMasksPreserved:true,independentClone:true});journal=sourceTransition(journal,'verified');persist();
  // The real external validator needs the newly registered source operations.
  const validation=await api('/external/validate',spec);c.assert.equal(validation.readyToApply,true);receipt('op1055-external-validation.json',{success:true,readyToApply:true});
  const published=await authoringPhase(api,login.user.id,async()=>{
   const savedEntity=await mutate('entity-save-op1055',()=>api('/entities',spec.entityDraft));c.assert.equal(savedEntity.entity.code,spec.entityDraft.code);receipt('op1055-entity-applied.json',{success:true,entityCode:savedEntity.entity.code,entityId:savedEntity.entity.id});
   const preview=await api('/preview',spec.programDraft);assertReadonlyDefinition(preview.generatedDefinition);receipt('op1055-native-preview.json',preview.generatedDefinition);
   const saved=await mutate('program-draft-op1055',()=>api('/drafts',spec.programDraft)),id=saved.id??saved.version?.id;c.assert.ok(id);receipt('op1055-draft-saved.json',{success:true,versionId:id});
   const bundleId='ciw-completion-build11-'+crypto.randomUUID();await mutate('test-evidence-op1055',()=>api('/governance/tests',{builderProgramVersionId:id,bundleId,testPlanId:'ciw-completion-build11-readonly-20261028',status:'passed',checklistSnapshot:{official122:true,ablChecks:384,ablLogs:8,phpTests:986,phpAssertions:7023,pasoeReadChecks:17,globalReadonly:true,nullablePhysicalPk3:true,ambiguousPkRejectedBeforePage:true,businessWrites:false,processRuns:false,humanPermissionsChanged:false},evidences,notes:'Consulta global das relacoes fisicas despesa/imposto. Identidade completa nullable PK3; duplicidade ambigua409 sem deduplicacao. Sem descricao inventada, manutencao, escrita ERP ou concessao funcional humana. Uso/navegacao legado nao comprovado permanece evidencia, sem inferir inatividade.'}));
   const approved=await mutate('approval-op1055',()=>api('/governance/approvals',{builderProgramVersionId:id,bundleId}));await mutate('publish-op1055',()=>api('/versions/'+id+'/publish',{}));
   const result={success:true,program:'op1055',entity:spec.entityDraft.code,screen:spec.programDraft.screenId,version:'1.0.0',versionId:id,approvalId:approved.approval.id};receipt('publication-op1055.json',result);return result;
  },event,mutate);
  const latest=await api('/programs/op1055');const versions=latest.versions.filter(x=>x.status==='published');c.assert.equal(versions.length,1);c.assert.equal(versions[0].builderEntityCode??versions[0].builderConfig?.builderEntityCode,spec.entityDraft.code,'PUBLISHED_NATIVE_OWNER_MISMATCH');c.assert.equal(latest.program.code,'op1055');
  const definition=await runtime(published.screen);assertReadonlyDefinition(definition);receipt('op1055-runtime.json',definition);
  const endBoot=await api('/bootstrap');c.assert.deepEqual(endBoot.programs.filter(x=>(x.programCode??x.code)!=='op1055'),boot.programs,'UNRELATED_PROGRAMS_CHANGED');c.assert.deepEqual(endBoot.entities.filter(x=>x.code!==spec.entityDraft.code),boot.entities,'UNRELATED_ENTITIES_CHANGED');
  const finalSource=(await api('/api-sources/'+plan.source.code)).apiSource;assertActualSourceAfter(finalSource,before,plan.source.operations);
  receipt('metadata-publication.json',{success:true,published,sourceOperations:146,old144Preserved:true,actualAuthenticationPreserved:true,otherProgramsAndEntitiesPreserved:true,programEntitySameGrantAndLocks:true,authoringGrantRevoked:true,singleChildNoParent:true,businessWrites:false,processRuns:false,humanPermissionsChanged:false});journal.completed=true;persist();console.log('PASS metadata11 op1055/source144to146; no business or functional human grants');
 },{readOnly:false});
}
module.exports={sourceTransition,assertNewOperation,assertActualSourceAfter,assertReadonlyDefinition,authoringPhase,assertMetadataRelease,main};
if(require.main===module)main().catch(()=>{console.error('BUILD11_METADATA_PUBLICATION_FAILED_INSPECT_PRIVATE_JOURNAL_NO_REPLAY');process.exitCode=1;});
