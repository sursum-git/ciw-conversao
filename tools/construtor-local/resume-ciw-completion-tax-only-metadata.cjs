'use strict';
const c=require('./purchase-payments-builder-common.cjs'),crypto=require('node:crypto');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build6-v2'),dir=c.path.join(state,'tax-only-metadata');
const meta=c.path.join(c.root,'integration-src/ciw-completion-20261028/container-tax-only/frozen-v1.1/metadata');
const safe=v=>Array.isArray(v)?v.map(safe):v&&typeof v==='object'?Object.fromEntries(Object.entries(v).map(([k,x])=>[k,k==='authHeaders'?[]:safe(x)])):v;
// Program DTO includes current authoring requests/grants. They change when this
// publisher obtains its own lock; the published contract must remain guarded.
const programContract=dto=>{const clone=structuredClone(dto);for(const version of clone.versions??[])delete version.governance;return clone;};
const save=(n,v)=>c.fs.writeFileSync(c.path.join(dir,n),JSON.stringify(safe(v),null,2)+'\n');
async function main(){
 c.assert.ok(c.fs.existsSync(c.path.join(dir,'publication-started.json'))&&!c.fs.existsSync(c.path.join(dir,'resume-started.json'))&&!c.fs.existsSync(c.path.join(dir,'metadata-publication.json')),'INSPECT_PARTIAL_BEFORE_REPLAY');
 const proofNames=['official-compile-verification.json','canonical-manifest.json','active-manifest.json','pasoe-read-proof.json'];
 const evidences=proofNames.map(n=>{c.assert.ok(c.readJson(c.path.join(state,n)).success,n);return{type:n,result:'SHA256 '+c.sha(c.path.join(state,n))};});
 c.assert.ok(c.readJson(c.path.join(dir,'preflight.json')).success);
 const draft=c.readJson(c.path.join(meta,'tax-only-builder-draft.json')).programDraft,parentDraft=c.readJson(c.path.join(dir,'op1003-parent-draft.json'));
 const addition=c.readJson(c.path.join(meta,'source-addition.json')).operations[0].value;
 c.assert.equal(draft.programCode,'op1043');c.assert.equal(draft.pageType,'process');c.assert.equal(addition.code,'calcular_impostos');
 await c.session(async({api,runtime,login})=>{
  const boot=await api('/bootstrap'),source=(await api('/api-sources/motor_progress_container_processos')).apiSource,entityDto=await api('/entities/container_processos_progress');
  c.assert.deepEqual(safe(source),c.readJson(c.path.join(dir,'source-six-after.json')));c.assert.equal(source.operations.length,6);
  const baselineFive=c.readJson(c.path.join(dir,'source-five-before.json'));for(const op of baselineFive.operations)c.assert.deepEqual(source.operations.find(x=>x.code===op.code),op);c.assert.ok(c.compatibleOperation(source.operations.find(x=>x.code===addition.code),addition,source.baseUrl));
  c.assert.deepEqual(safe(entityDto),c.readJson(c.path.join(dir,'entity-before.json')));c.assert.deepEqual(programContract(await api('/programs/op1003')),programContract(c.readJson(c.path.join(dir,'op1003-before.json'))));
  c.assert.ok(!boot.programs.some(x=>(x.programCode??x.code)==='op1043'));
  const oldOperations=structuredClone(source.operations),oldSource=structuredClone(source),oldEntity=structuredClone(entityDto.entity),existingScreens={};
  for(const screen of ['ciw.container-gerar-versao','ciw.container-fechar-custos','ciw.container-sincronizar-impostos'])existingScreens[screen]=await runtime(screen);
  const grants=[],locks=[];
  async function authorize(programCode,entityCode){
   const request=await api('/governance/requests',{programCode,builderEntityCode:entityCode,requestedActions:['edit','publish'],reason:'Conversão CIW: comando separado de impostos reutiliza rotina central; cadastro de metadados e link contextual. Não executa cálculo nem concede acesso humano.'});
   const granted=await api('/governance/grants',{requestId:request.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']});grants.push(granted.grant.id);return granted.grant.id;
  }
  async function lock(scopeType,scopeCode,grantId){const held=await api('/locks/acquire',{scopeType,scopeCode,grantId,lockCategory:'authoring'});c.assert.equal(held.status,'acquired');locks.push(held.lock.lockToken);}
  async function publish(config){
   const preview=await api('/preview',config);save(config.programCode+'-preview.json',preview);c.assert.ok(preview.generatedDefinition);
   if(config.programCode==='op1043'){
    c.assert.equal(preview.generatedDefinition.pageType,'process');c.assert.equal(preview.generatedDefinition.permissions.read,config.permissionPrefix+'.read');c.assert.equal(preview.generatedDefinition.permissions.process,config.permissionPrefix+'.process');
    c.assert.deepEqual(preview.generatedDefinition.contextFields,[{field:'container_id',required:true,readonly:true}]);
    c.assert.equal(preview.generatedDefinition.process.parameters.fields.length,1);c.assert.ok(preview.generatedDefinition.process.actions.process.confirmation);
   }else{
    const previous=c.readJson(c.path.join(dir,'op1003-before.json')).versions.find(v=>v.status==='published').generatedDefinition;
    const reverse=structuredClone(preview.generatedDefinition);reverse.program.version=previous.program.version;reverse.crud.grid.rowLinks=previous.crud.grid.rowLinks;c.assert.deepEqual(reverse,previous,'PARENT_OTHER_DELTA');
   }
   const version=await api('/drafts',config),id=version.id??version.version?.id;c.assert.ok(id);const bundleId='ciw-tax-only-'+crypto.randomUUID();
   await api('/governance/tests',{builderProgramVersionId:id,bundleId,testPlanId:'ciw-container-tax-only-20261028',status:'passed',checklistSnapshot:{official122:true,ablChecks:3616,phpTests:885,phpAssertions:5841,sharedTaxPlanPersistPlan:true,confirmationRequired:true,mandatoryContainerContext:true,missingContextRejectedRealPasoe:true,positiveOperationalTestPending:true,businessWrites:false,humanPermissionsChanged:false},evidences,notes:'Validação oficial TT e rejeição real por contexto ausente concluídas. Cadastro de metadados sem executar o comando. Teste operacional positivo NÃO executado e NÃO autorizado. Nenhuma autorização de lote1042 abrange este cálculo. Usuários finais ainda precisam das permissões específicas.'});
   const approval=await api('/governance/approvals',{builderProgramVersionId:id,bundleId});await api('/versions/'+id+'/publish',{});
   const receipt={success:true,program:config.programCode,screen:config.screenId,version:config.version,versionId:id,approvalId:approval.approval.id};save('publication-'+config.programCode+'.json',receipt);return receipt;
  }
  async function phase(programCode,entityCode,run){
   const grantIndex=grants.length,lockIndex=locks.length;
   try{const grantId=await authorize(programCode,entityCode);await lock('program',programCode,grantId);await lock('entity',entityCode,grantId);return await run();}
   finally{const unlocked=await Promise.allSettled(locks.splice(lockIndex).reverse().map(lockToken=>api('/locks/release',{lockToken})));const revoked=await Promise.allSettled(grants.splice(grantIndex).reverse().map(grantId=>api('/governance/grants/status',{grantId,status:'revoked'})));c.assert.ok([...unlocked,...revoked].every(x=>x.status==='fulfilled'),'PHASE_GOVERNANCE_CLEANUP_REQUIRED');}
  }
  try{
   const ownerProof=c.readJson(c.path.join(dir,'native-governance-owners.json'));c.assert.ok(ownerProof.success&&ownerProof.readOnly);c.assert.equal(ownerProof.owners.container_processos_progress.programCode,'op1016');c.assert.equal(ownerProof.owners.container_despesas_progress.programCode,'op1003');
   save('resume-started.json',{at:new Date().toISOString(),alreadyAppliedSourceOperations:6,skipSourceMutation:true,businessWrites:false,humanPermissionsChanged:false,positiveOperationalTestPending:true});
   await phase('op1016',oldEntity.code,async()=>{
    c.assert.deepEqual(safe((await api('/api-sources/'+source.code)).apiSource),safe(oldSource));c.assert.deepEqual(safe(await api('/entities/'+oldEntity.code)),safe(entityDto));
    const entityPayload=structuredClone(oldEntity);entityPayload.createPhysicalTable=false;const saved=await api('/entities',entityPayload);save('entity-refreshed.json',saved);
    c.assert.deepEqual(saved.entity.fields,oldEntity.fields,'ENTITY_FIELDS_CHANGED');
    const withoutSnapshot=x=>{const y=safe(structuredClone(x));delete y.apiSource;if(y.metadata)delete y.metadata.apiSource;delete y.updatedAt;return y;};c.assert.deepEqual(withoutSnapshot(saved.entity),withoutSnapshot(oldEntity),'ENTITY_OUTSIDE_API_SNAPSHOT_CHANGED');
   });
   const published=[];
   published.push(await phase(draft.programCode,oldEntity.code,()=>publish(draft)));
   published.push(await phase(parentDraft.programCode,parentDraft.builderEntityCode,async()=>{c.assert.deepEqual(programContract(await api('/programs/op1003')),programContract(c.readJson(c.path.join(dir,'op1003-before.json'))));return publish(parentDraft);}));
   for(const [screen,before]of Object.entries(existingScreens))c.assert.deepEqual(await runtime(screen),before,'PREVIOUS_PROCESS_DEFINITION_CHANGED');
   const touched=new Set(['op1043','op1003']);c.assert.deepEqual((await api('/bootstrap')).programs.filter(x=>!touched.has(x.programCode??x.code)),boot.programs.filter(x=>!touched.has(x.programCode??x.code)),'OTHER_PROGRAMS_CHANGED');
   const process=await runtime(draft.screenId);c.assert.equal(process.pageType,'process');c.assert.equal(process.program.version,'1.0.0');save('process-runtime.json',process);
   const parent=await runtime(parentDraft.screenId);c.assert.equal(parent.program.version,'1.0.3');c.assert.ok(parent.crud.grid.rowLinks.some(x=>x.id==='calcular_impostos'));
   save('metadata-publication.json',{success:true,published,sourceOperations:6,previousFiveOperationsPreserved:true,previousProcessDefinitionsPreserved:true,parentOnlyLinkAndVersion:true,businessWrites:false,humanPermissionsChanged:false,positiveOperationalTestPending:true,permissions:{read:draft.permissionPrefix+'.read',process:draft.permissionPrefix+'.process'}});
   console.log('PASS1043process+parentlink metadata published/source5to6;no process execution/grants;positive operational test pending');
  }finally{
   const results=await Promise.allSettled(locks.reverse().map(lockToken=>api('/locks/release',{lockToken})));const revoked=await Promise.allSettled(grants.reverse().map(grantId=>api('/governance/grants/status',{grantId,status:'revoked'})));c.assert.ok([...results,...revoked].every(x=>x.status==='fulfilled'),'GOVERNANCE_CLEANUP_REQUIRED');
  }
 },{readOnly:false});
}
main().catch(e=>{console.error(e.message);process.exitCode=1});
