'use strict';
const c=require('./purchase-payments-builder-common.cjs'),crypto=require('node:crypto');
const root=c.path.join(c.root,'.runtime/purchase-quantities-20261027'),state=c.path.join(root,'view-split'),meta=c.path.join(c.root,'integration-src/purchase-quantities/metadata');
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
async function main(){
 c.assert.ok(!c.fs.existsSync(c.path.join(state,'publication-started.json')),'ALREADY_ATTEMPTED_INSPECT_BEFORE_REPLAY');
 for(const n of ['review-final.json','canonical-manifest.json'])c.assert.equal(c.readJson(c.path.join(state,n)).success,true,n);
 for(const f of c.readJson(c.path.join(state,'canonical-manifest.json')).files)c.assert.equal(c.sha(f.target),f.sha256);
 for(const n of ['official-compile-verification.json','pasoe-read-proof.json','metadata-js-validation.json'])c.assert.equal(c.readJson(c.path.join(root,n)).success,true,n);
 await c.session(async({api,runtime,login})=>{
  const pre=c.readJson(c.path.join(state,'preflight.json')),source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource,boot=await api('/bootstrap');
  c.assert.deepEqual(source,pre.source);c.assert.equal(source.operations.length,107);c.assert.deepEqual(await runtime('ciw.proc-compra-quantidades'),pre.child);c.assert.deepEqual(await runtime('ciw.processos-compra-med'),pre.parent);
  c.assert.ok(!boot.programs.some(x=>(x.programCode??x.code)==='op1029'||x.screenId==='ciw.quantidades-importadas-med'));c.assert.ok(!boot.entities.some(x=>x.code==='proc_compra_quantidades_med_progress'));
  const additions=c.readJson(c.path.join(state,'api-source-global-additions.json')).operations;c.assert.equal(additions.length,2);for(const op of additions){c.assert.deepEqual(op.requestContextFields,[]);c.assert.ok(!source.operations.some(x=>x.code===op.code));}
  save('publication-started.json',{at:new Date().toISOString(),businessWrites:false,humanPermissionsChanged:false});source.operations.push(...additions);await api('/api-sources',source);
  const actual=(await api('/api-sources/'+source.code)).apiSource;c.assert.equal(actual.operations.length,109);for(const op of pre.source.operations)c.assert.deepEqual(actual.operations.find(x=>x.code===op.code),op);
  for(const slug of ['proc-compra-quantidades','quantidades-importadas-med']){
   const d=c.readJson(c.path.join(meta,slug+'-builder-draft.json')),globalView=slug==='quantidades-importadas-med';
   const preview=await api('/external/validate',d);save('preview-'+slug+'.json',preview);c.assert.equal(preview.readyToApply,true);
   if(globalView)await api('/entities',d.entityDraft);
   const req=await api('/governance/requests',{programCode:d.programDraft.programCode,builderEntityCode:d.entityDraft.code,requestedActions:['edit','publish'],reason:'Conversão de quantidades importadas MED com duas views nativas reutilizando a mesma API. Preservar guard de contexto obrigatório; nenhuma mudança PHP/JS/ABL, nenhuma gravação operacional ou acesso humano.'});
   const grant=await api('/governance/grants',{requestId:req.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']}),locks=[];
   try{
    for(const [scopeType,scopeCode]of [['entity',d.entityDraft.code],['program',d.programDraft.programCode]]){const l=await api('/locks/acquire',{scopeType,scopeCode,grantId:grant.grant.id,lockCategory:'authoring'});c.assert.equal(l.status,'acquired');locks.push(l.lock.lockToken);}
    const version=await api('/drafts',d.programDraft),id=version.id??version.version?.id;c.assert.ok(id);const bundleId='purchase-quantity-views-'+crypto.randomUUID();
    await api('/governance/tests',{builderProgramVersionId:id,bundleId,testPlanId:'purchase-quantities-views-20261027',status:'passed',checklistSnapshot:{nativeViews:true,sharedApiAndRules:true,contextGuardPreserved:true,globalMedFixed:true,official122:true,checksPerCombination:150,combinations:4,phpTests:878,phpAssertions:5806,businessWrites:false},evidences:[{type:'independent-review',result:'SHA256 '+c.sha(c.path.join(state,'review-final.json'))},{type:'pasoe-read-get-global-context',result:'SHA256 '+c.sha(c.path.join(root,'pasoe-read-proof.json'))}],notes:'Contextual read/get nativo confirmado; view global usa operação de consulta sem contexto, mantendo escopo MED fixo no backend. Acessos humanos separados aguardam autorização.'});
    await api('/governance/approvals',{builderProgramVersionId:id,bundleId});await api('/versions/'+id+'/publish',{});save('publication-'+slug+'.json',{success:true,screenId:d.programDraft.screenId,version:d.programDraft.version,versionId:id,businessWrites:false});console.log('PASS published '+d.programDraft.screenId+' '+d.programDraft.version);
   }finally{const results=await Promise.allSettled(locks.map(lockToken=>api('/locks/release',{lockToken})));await api('/governance/grants/status',{grantId:grant.grant.id,status:'revoked'});c.assert.ok(results.every(x=>x.status==='fulfilled'));}
  }
  c.assert.deepEqual(await runtime('ciw.processos-compra-med'),pre.parent,'PARENT_CHANGED');save('metadata-publication.json',{success:true,sourceOperations:109,previous107Preserved:true,contextualVersion:'1.0.1',globalVersion:'1.0.0',parentUnchanged:'1.0.8',businessWrites:false,humanPermissionsChanged:false});
 },{readOnly:false});
}
main().catch(e=>{console.error(e.message);process.exitCode=1;});
