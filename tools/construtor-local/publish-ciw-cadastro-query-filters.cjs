'use strict';
const c=require('./purchase-payments-builder-common.cjs'),crypto=require('node:crypto');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/cadastros-queries');
const meta=c.path.join(c.root,'integration-src/ciw-completion-20261028/cadastro-query-filters');
const save=(name,value)=>c.fs.writeFileSync(c.path.join(state,name),JSON.stringify(value,null,2)+'\n');
function assertRuntime(current,before,receipt){
 c.assert.equal(current.program.version,'1.0.1');
 const trace=current.runtime.traceability;
 c.assert.equal(trace.programCode,receipt.code);c.assert.equal(trace.programVersion,receipt.version);
 c.assert.equal(trace.builderProgramVersionId,receipt.versionId);c.assert.equal(trace.screenDefinitionVersion,receipt.version);
 c.assert.match(trace.schemaFingerprint,/^[a-f0-9]{64}$/);
 const restored=structuredClone(current);restored.program.version=before.program.version;restored.crud.filter.fields=before.crud.filter.fields;
 for(const field of ['programVersion','builderProgramVersionId','screenDefinitionVersion','schemaFingerprint'])restored.runtime.traceability[field]=before.runtime.traceability[field];
 c.assert.deepEqual(restored,before,'RUNTIME_DELTA_OUTSIDE_FILTERS_AND_DERIVED_TRACEABILITY');
}
async function main(){
 const resume=process.argv.includes('--resume-remaining');
 c.assert.ok(!c.fs.existsSync(c.path.join(state,'metadata-publication.json')),'COMPLETED_DO_NOT_REPLAY');
 if(resume){
  c.assert.ok(c.fs.existsSync(c.path.join(state,'publication-started.json')));
  c.assert.ok(!c.fs.existsSync(c.path.join(state,'publication-resumed.json')),'RESUME_ATTEMPTED_INSPECT_STATE');
  const inspected=c.readJson(c.path.join(state,'partial-publication-inspection.json'));c.assert.equal(inspected.success,true);
  c.assert.deepEqual(inspected.screens.map(s=>[s.code,s.version,s.publicationReceipt]),[['cd0094','1.0.1',true],['cd0095','1.0.0',false],['cd0096','1.0.0',false],['cd0097','1.0.0',false],['cd0098','1.0.0',false]]);
 }else c.assert.ok(!c.fs.existsSync(c.path.join(state,'publication-started.json')),'PRIOR_ATTEMPT_INSPECT_DO_NOT_REPLAY');
 const candidates=c.readJson(c.path.join(state,'filter-candidates.json'));c.assert.equal(candidates.success,true);
 c.assert.equal(c.readJson(c.path.join(state,'filter-validation.json')).success,true);
 const review=c.readJson(c.path.join(state,'manager-review.json'));c.assert.equal(review.success,true);
 for(const s of candidates.screens)c.assert.equal(c.sha(c.path.join(meta,s.code+'-program-draft.json')),s.draftSha256);
 const evidence=['filter-validation.json','manager-review.json'].map(n=>({type:n,result:'SHA256 '+c.sha(c.path.join(state,n))}));
 await c.session(async({api,runtime,login})=>{
  const beforeBootstrap=await api('/bootstrap'),sourceBefore=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;
  const preserved=new Map(),entities=new Map();
  for(const s of candidates.screens){
   const baseline=c.readJson(c.path.join(state,s.code+'-program-before.json'));
   if(resume&&s.code==='cd0094'){
    const receipt=c.readJson(c.path.join(state,'publication-cd0094.json'));
    const actual=(await api('/programs/'+s.code)).versions.find(v=>v.status==='published');c.assert.equal(actual.id,receipt.versionId);
    c.assert.deepEqual(actual.generatedDefinition,c.readJson(c.path.join(state,s.code+'-preview.json')).generatedDefinition);
    assertRuntime(await runtime(s.screenId),c.readJson(c.path.join(state,s.screenId+'.json')).definition,receipt);
   }else c.assert.deepEqual(await api('/programs/'+s.code),baseline,'PROGRAM_CHANGED');
   const draft=c.readJson(c.path.join(meta,s.code+'-program-draft.json'));
   entities.set(draft.builderEntityCode,(await api('/entities/'+draft.builderEntityCode)).entity);
   preserved.set(s.screenId,await runtime(s.screenId));
  }
  save(resume?'publication-resumed.json':'publication-started.json',{at:new Date().toISOString(),codes:candidates.screens.filter(s=>!resume||s.code!=='cd0094').map(s=>s.code),businessWrites:false,humanPermissionsChanged:false,skippedAlreadyPublished:resume?['cd0094']:[]});
  const published=[];
  for(const s of candidates.screens){
   if(resume&&s.code==='cd0094'){published.push(c.readJson(c.path.join(state,'publication-cd0094.json')));console.log('PASS preserved existing ciw.coloracoes1.0.1; no replay');continue;}
   const draft=c.readJson(c.path.join(meta,s.code+'-program-draft.json'));
   c.assert.deepEqual((await api('/preview',draft)).generatedDefinition,c.readJson(c.path.join(state,s.code+'-preview.json')).generatedDefinition,'PREVIEW_CHANGED');
   const request=await api('/governance/requests',{programCode:s.code,builderEntityCode:draft.builderEntityCode,requestedActions:['edit','publish'],reason:'Concluir conversão das consultas Scriptcase de cadastros: expor filtros de texto por metadados. Alterar somente versão/filtros; entidades, APIs, gravação, grid e Logs preservados. Sem grants humanos ou dados comerciais.'});
   const grant=await api('/governance/grants',{requestId:request.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']}),locks=[];
   try{
    for(const [scopeType,scopeCode]of [['entity',draft.builderEntityCode],['program',s.code]]){
     const lock=await api('/locks/acquire',{scopeType,scopeCode,grantId:grant.grant.id,lockCategory:'authoring'});c.assert.equal(lock.status,'acquired');locks.push(lock.lock.lockToken);
    }
    const version=await api('/drafts',draft),id=version.id??version.version?.id;c.assert.ok(id);
    const bundleId='ciw-query-filters-'+crypto.randomUUID();
    await api('/governance/tests',{builderProgramVersionId:id,bundleId,testPlanId:'ciw-completion-cadastro-query-filters-20261028',status:'passed',checklistSnapshot:{metadataOnly:true,nativeJs:true,legacyColumns:true,deltaOnlyVersionAndFilters:true,get:true,paging:true,positiveTextFilters:true,negativeTextFilters:true,parameterValuePositiveNotTested:true,apiAndAblUnchanged:true,businessWrites:false},evidences:evidence,notes:'5 previews/validadorJS;5GET/5páginas;6filtros negativos/5positivos. val_param testado apenas negativo/vazio, sem expor valores de parâmetros. Revisão independente semP1/P2. Nenhum cadastro real modificado.'});
    const approval=await api('/governance/approvals',{builderProgramVersionId:id,bundleId});
    await api('/versions/'+id+'/publish',{});
    const receipt={success:true,published:true,code:s.code,screenId:s.screenId,version:draft.version,versionId:id,approvalId:approval.approval.id,draftSha256:s.draftSha256};save('publication-'+s.code+'.json',receipt);published.push(receipt);
   }finally{
    const releases=await Promise.allSettled(locks.map(lockToken=>api('/locks/release',{lockToken})));
    await api('/governance/grants/status',{grantId:grant.grant.id,status:'revoked'});c.assert.ok(releases.every(r=>r.status==='fulfilled'),'LOCK_RELEASE_FAILED');
   }
   const current=await runtime(s.screenId);c.assert.equal(current.program.version,'1.0.1');c.assert.deepEqual(current.crud.filter.fields.map(f=>f.field),s.fields);
   assertRuntime(current,preserved.get(s.screenId),published[published.length-1]);
   console.log('PASS published '+s.screenId+' 1.0.1; only filters changed');
  }
  c.assert.deepEqual((await api('/api-sources/motor_progress_ciw_cadastros')).apiSource,sourceBefore,'SOURCE_CHANGED');
  for(const [code,entity]of entities)c.assert.deepEqual((await api('/entities/'+code)).entity,entity,'ENTITY_CHANGED');
  const changed=new Set(candidates.screens.map(s=>s.code));const untouched=p=>p.programs.filter(x=>!changed.has(x.programCode??x.code));
  c.assert.deepEqual(untouched(await api('/bootstrap')),untouched(beforeBootstrap),'OTHER_PROGRAMS_CHANGED');
  save('metadata-publication.json',{success:true,screens:published,sourceOperationsUnchanged:sourceBefore.operations.length,entitiesUnchanged:true,otherProgramsUnchanged:true,gridFormsWritersLogsUnchanged:true,businessWrites:false,humanPermissionsChanged:false});
 },{readOnly:false});
}
main().catch(e=>{console.error(e.message);process.exitCode=1});
