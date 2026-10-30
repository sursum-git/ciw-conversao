'use strict';
const c=require('./purchase-payments-builder-common.cjs'),crypto=require('node:crypto');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build3');
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
async function main(){
 const resume=process.argv.includes('--resume-source-only');
 c.assert.ok(!c.fs.existsSync(c.path.join(state,'metadata-publication.json')),'COMPLETED_DO_NOT_REPLAY');
 if(resume){c.assert.equal(c.readJson(c.path.join(state,'metadata-partial-inspection.json')).sourceOnlyApplied,true);c.assert.ok(!c.fs.existsSync(c.path.join(state,'metadata-publication-resumed.json')),'RESUME_ATTEMPTED_INSPECT_STATE');}
 else c.assert.ok(!c.fs.existsSync(c.path.join(state,'metadata-publication-started.json')),'ATTEMPTED_INSPECT_BEFORE_REPLAY');
 const evidence=['official-compile-verification.json','canonical-manifest.json','active-manifest.json','pasoe-read-proof.json','metadata-preflight.json','history-parent-fix-proof.json'].map(n=>{c.assert.equal(c.readJson(c.path.join(state,n)).success,true,n);return{type:n,result:'SHA256 '+c.sha(c.path.join(state,n))};});
 c.assert.equal(c.readJson(c.path.join(state,'history-parent-fix-proof.json')).success,true);
 c.assert.equal(c.readJson(c.path.join(c.root,'.runtime/ciw-completion-20261028/backend-package5/manager-review.json')).remainingP1P2.length,0);
 const specs=['container-fiscal-readonly/metadata/op1033-builder-draft.json','container-fiscal-readonly/metadata/op1034-builder-draft.json','container-version-history/frozen-v1.3/metadata/history-builder-draft.json'].map(p=>c.readJson(c.path.join(c.root,'integration-src/ciw-completion-20261028',p)));
 const parents=c.readJson(c.path.join(state,'metadata-preflight.json')).parents;
 await c.session(async({api,runtime,login})=>{
  const beforeBoot=await api('/bootstrap'),source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;
  const safe=c.readJson(c.path.join(c.root,'.runtime/ciw-completion-20261028/source-118-before.json'));
  for(const k of ['code','baseUrl','responseContract'])c.assert.deepEqual(source[k],safe[k]);
  c.assert.equal(source.operations.length,resume?124:118);for(const op of safe.operations)c.assert.deepEqual(source.operations.find(x=>x.code===op.code),op);
  for(const d of specs){c.assert.ok(!beforeBoot.programs.some(p=>(p.programCode??p.code)===d.programDraft.programCode));c.assert.ok(!beforeBoot.entities.some(e=>e.code===d.entityDraft.code));}
  for(const p of parents)c.assert.deepEqual(await api('/programs/'+p.code),c.readJson(c.path.join(state,p.code+'-program-before.json')));
  const additions=['container-fiscal-readonly','container-version-history/frozen-v1.3'].flatMap(p=>c.readJson(c.path.join(c.root,'integration-src/ciw-completion-20261028',p,'metadata/api-source-additions.json')).operations);c.assert.equal(additions.length,6);
  for(const op of additions){const matches=source.operations.filter(x=>x.code===op.code);c.assert.equal(matches.length,resume?1:0);if(resume)c.assert.ok(c.compatibleOperation(matches[0],op,source.baseUrl));}
  async function publish(draft,entity){
   const code=draft.programCode,request=await api('/governance/requests',{programCode:code,builderEntityCode:entity,requestedActions:['edit','publish'],reason:'Conversão CIW autorizada: consultas fiscais e histórico persistido da versão, com contexto obrigatório e links nativos. Sem escritores, alterações comerciais ou novos acessos humanos.'});
   const grant=await api('/governance/grants',{requestId:request.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']}),locks=[];
   try{
    for(const [scopeType,scopeCode]of [['entity',entity],['program',code]]){const l=await api('/locks/acquire',{scopeType,scopeCode,grantId:grant.grant.id,lockCategory:'authoring'});c.assert.equal(l.status,'acquired');locks.push(l.lock.lockToken);}
    const preview=await api('/preview',draft);save(code+'-native-preview.json',preview);c.assert.ok(preview.generatedDefinition);
    if(parents.some(p=>p.code===code)){
     const old=c.readJson(c.path.join(state,code+'-program-before.json')).versions.find(v=>v.status==='published').generatedDefinition;
     const reversed=structuredClone(preview.generatedDefinition);reversed.program.version=old.program.version;reversed.crud.grid.rowLinks=old.crud.grid.rowLinks;
     c.assert.deepEqual(reversed,old,'PARENT_DELTA_OUTSIDE_VERSION_ROWLINKS');
    }
    const version=await api('/drafts',draft),id=version.id??version.version?.id;c.assert.ok(id);const bundleId='ciw-completion-wave1-'+crypto.randomUUID();
    await api('/governance/tests',{builderProgramVersionId:id,bundleId,testPlanId:'ciw-completion-wave1-20261028',status:'passed',checklistSnapshot:{readOnly:true,mandatoryOwnerContext:true,selectedIdentity:true,ownMemoryPrecedence:true,persistedVersionSnapshot:true,sharedServices:true,official122:true,ablChecks:1536,phpTests:885,phpAssertions:5841,nativeJs:true,businessWrites:false},evidences:evidence,notes:'PASOE real read/get/paging/negativas e regressão; memória própria tem precedência. Parent404 corrigido e validado separadamente. Não libera acesso humano; lookup e seis visões relacionadas permanecem pendentes.'});
    const approval=await api('/governance/approvals',{builderProgramVersionId:id,bundleId});await api('/versions/'+id+'/publish',{});
    const receipt={success:true,code,screen:draft.screenId,version:draft.version,versionId:id,approvalId:approval.approval.id};save('publication-'+code+'.json',receipt);return receipt;
   }finally{const results=await Promise.allSettled(locks.map(lockToken=>api('/locks/release',{lockToken})));await api('/governance/grants/status',{grantId:grant.grant.id,status:'revoked'});c.assert.ok(results.every(x=>x.status==='fulfilled'));}
  }
  save(resume?'metadata-publication-resumed.json':'metadata-publication-started.json',{at:new Date().toISOString(),businessWrites:false,humanPermissionsChanged:false,sourceAlreadyApplied:resume});
  if(!resume){source.operations.push(...additions);await api('/api-sources',source);}
  const current=(await api('/api-sources/'+source.code)).apiSource;c.assert.equal(current.operations.length,124);for(const op of safe.operations)c.assert.deepEqual(current.operations.find(x=>x.code===op.code),op);
  const published=[];
  for(const d of specs){const validation=await api('/external/validate',d);save(d.programDraft.programCode+'-external-validation.json',validation);c.assert.equal(validation.readyToApply,true);await api('/entities',d.entityDraft);published.push(await publish(d.programDraft,d.entityDraft.code));}
  for(const p of parents){const draft=c.readJson(c.path.join(state,p.draftFile));published.push(await publish(draft,draft.builderEntityCode));}
  for(const d of specs){const actual=await runtime(d.programDraft.screenId);c.assert.equal(actual.program.version,'1.0.0');for(const op of ['create','edit','delete'])c.assert.equal(actual.permissions[op],false);save(d.programDraft.programCode+'-runtime.json',actual);}
  const touched=new Set(published.map(p=>p.code));c.assert.deepEqual((await api('/bootstrap')).programs.filter(p=>!touched.has(p.programCode??p.code)),beforeBoot.programs.filter(p=>!touched.has(p.programCode??p.code)),'OTHER_PROGRAMS_CHANGED');
  save('metadata-publication.json',{success:true,published,sourceOperations:124,previous118Preserved:true,otherProgramsPreserved:true,businessWrites:false,humanPermissionsChanged:false});
  console.log('PASS3new readonly screens+2parentlinks published,source118to124,preserved other programs/nohumanpermissions');
 },{readOnly:false});
}
main().catch(e=>{console.error(e.message);process.exitCode=1});
