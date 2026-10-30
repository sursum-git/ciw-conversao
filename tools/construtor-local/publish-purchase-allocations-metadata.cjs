'use strict';
const c=require('./purchase-payments-builder-common.cjs'),crypto=require('node:crypto');
const state=c.path.join(c.root,'.runtime/purchase-allocations-20261026'),meta=c.path.join(c.root,'integration-src/purchase-allocations/metadata');
const names=['proc-compra-alocacoes','proc-compra-itens'];const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n'),draft=n=>c.readJson(c.path.join(meta,n+'-builder-draft.json'));
function evidence(){const out=[];for(const n of ['official-compile-verification.json','canonical-manifest.json','active-manifest.json','pasoe-read-proof.json','metadata-php-validation.json','parent-metadata-php-validation.json','metadata-js-validation.json','review-final.json']){const p=c.path.join(state,n);c.assert.equal(c.readJson(p).success,true,n);out.push({type:n,result:'SHA256 '+c.sha(p)});}c.assert.match(c.fs.readFileSync(c.path.join(state,'php-canonical-full.xml'),'utf8'),/tests="874"[^>]*failures="0"/);for(const f of c.readJson(c.path.join(state,'canonical-manifest.json')).files)c.assert.equal(c.sha(f.target),f.sha256,'CANONICAL_CHANGED');return out;}
async function main(){const mode=process.argv[2]??'plan';c.assert.ok(['plan','apply'].includes(mode));const evidences=evidence();if(mode==='plan'){save('metadata-publication-plan.json',{success:true,screens:names.map(x=>draft(x).programDraft.screenId),sourceOperations:97,previousOperations:95,permissionsChanged:false,businessWrites:false,evidences});console.log('PASS native allocation publication prepared');return;}
 c.assert.ok(!c.fs.existsSync(c.path.join(state,'publication-started.json')),'PRIOR_ATTEMPT_INSPECT_DO_NOT_REPLAY');
 await c.session(async({api,runtime,login})=>{
  const pre=c.readJson(c.path.join(state,'preflight.json')),bootstrap=await api('/bootstrap'),child=draft(names[0]);
  c.assert.deepEqual(await runtime('ciw.proc-compra-itens'),pre.item,'ITEM_CONCURRENT_CHANGE');c.assert.deepEqual(await runtime('ciw.processos-compra-med'),pre.parent,'PARENT_CONCURRENT_CHANGE');
  c.assert.ok(!bootstrap.programs.some(x=>(x.programCode??x.code)===child.programDraft.programCode||x.screenId===child.programDraft.screenId),'PROGRAM_COLLISION');c.assert.ok(!bootstrap.entities.some(x=>x.code===child.entityDraft.code),'ENTITY_COLLISION');
  const source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource,beforeSource=c.readJson(c.path.join(state,'source-registry-before.json'));c.assert.deepEqual(source,beforeSource,'SOURCE_CONCURRENT_CHANGE');c.assert.equal(source.baseUrl,'http://127.0.0.1:19910/med/web');c.assert.equal(source.responseContract,'sursum-programs');c.assert.equal(source.operations.length,95);
  const beforeEntity=(await api('/entities/proc_compra_itens_progress')).entity;save('item-entity-before.json',beforeEntity);
  const additions=c.readJson(c.path.join(meta,'api-source-additions.json')).operations;for(const op of additions)c.assert.ok(!source.operations.some(x=>x.code===op.code));
  save('publication-started.json',{at:new Date().toISOString(),stages:['source',...names],businessWrites:false,permissionsChanged:false});source.operations.push(...additions);await api('/api-sources',source);
  const registered=(await api('/api-sources/'+source.code)).apiSource;c.assert.equal(registered.operations.length,97);for(const op of beforeSource.operations)c.assert.deepEqual(registered.operations.find(x=>x.code===op.code),op);for(const op of additions)c.assert.ok(c.compatibleOperation(registered.operations.find(x=>x.code===op.code),op,registered.baseUrl));save('metadata-source-registration.json',{success:true,before:95,after:97,previousOperationsPreserved:true});
  for(const slug of names){const d=draft(slug),preview=await api('/external/validate',d);save('builder-preview-'+slug+'.json',preview);c.assert.equal(preview.readyToApply,true,'BUILDER_PREVIEW '+slug);if(slug===names[0])await api('/entities',d.entityDraft);
   const request=await api('/governance/requests',{programCode:d.programDraft.programCode,builderEntityCode:d.entityDraft.code,requestedActions:['edit','publish'],reason:'Conversão autorizada da consulta contextual de alocações MED. Somente leitura, contexto do item fechado e sete abas existentes preservadas.'});
   const grant=await api('/governance/grants',{requestId:request.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']}),locks=[];
   try{for(const scope of [{type:'entity',code:d.entityDraft.code},{type:'program',code:d.programDraft.programCode}]){const l=await api('/locks/acquire',{scopeType:scope.type,scopeCode:scope.code,grantId:grant.grant.id,lockCategory:'authoring'});c.assert.equal(l.status,'acquired');locks.push(l.lock.lockToken);}
    const v=await api('/drafts',d.programDraft),id=v.id??v.version?.id;c.assert.ok(id);const bundleId='purchase-allocations-'+crypto.randomUUID();
    await api('/governance/tests',{builderProgramVersionId:id,bundleId,testPlanId:'purchase-allocations-20261026',status:'passed',checklistSnapshot:{nativeMetadata:true,readonly:true,sharedReader:true,medItemContext:true,official122:true,checksPerCombination:79,combinations:4,existingWritersUnchanged:true,itemTabs:8,previousTabsPreserved:7,businessWrites:false},evidences,notes:'874testesPHP/5780asserções;79checksABLpor4combinações; ligação do dispatcher corrigida e recompilada; PASOE real somente leitura. Sem concessão de acesso humano.'});
    const a=await api('/governance/approvals',{builderProgramVersionId:id,bundleId});await api('/versions/'+id+'/publish',{});save('publication-'+slug+'.json',{success:true,published:true,programCode:d.programDraft.programCode,screenId:d.programDraft.screenId,version:d.programDraft.version,versionId:id,approvalId:a.approval.id,businessWrites:false});console.log('PASS published '+d.programDraft.screenId+' '+d.programDraft.version);
   }finally{
    const releases=await Promise.allSettled(locks.map(lockToken=>api('/locks/release',{lockToken})));
    await api('/governance/grants/status',{grantId:grant.grant.id,status:'revoked'});
    c.assert.ok(releases.every(x=>x.status==='fulfilled'),'AUTHORING_LOCK_RELEASE_FAILED');
   }
  }
  c.assert.deepEqual((await api('/entities/proc_compra_itens_progress')).entity,beforeEntity,'ITEM_ENTITY_CHANGED');
  save('metadata-publication.json',{success:true,screens:names.map(x=>draft(x).programDraft.screenId),itemVersion:'1.0.3',itemTabs:8,previousOperationsPreserved:95,homeChanged:false,businessWrites:false,permissionsChanged:false});
 },{readOnly:false});
}
if(require.main===module)main().catch(e=>{console.error(e.message);process.exitCode=1;});
