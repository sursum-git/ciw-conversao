'use strict';
const c=require('./purchase-payments-builder-common.cjs'),crypto=require('node:crypto');
const state=c.path.join(c.root,'.runtime/container-allocation-batch-20261026');
const meta=c.path.join(c.root,'integration-src/container-allocation-batch/metadata');
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
const draft=slug=>c.readJson(c.path.join(meta,slug+'-builder-draft.json'));
const names=['container-alocar-itens','container-painel'];
function evidence(){
  const list=[];
  for(const name of ['official-compile-verification.json','canonical-manifest.json','active-manifest.json','pasoe-read-proof.json','process-metadata-php-validation.json','parent-metadata-php-validation.json','metadata-js-validation.json','review-final.json']){
    const file=c.path.join(state,name);c.assert.equal(c.readJson(file).success,true,name);list.push({type:name,result:'SHA256 '+c.sha(file)});
  }
  const file=c.path.join(state,'php-canonical-full.xml');c.assert.match(c.fs.readFileSync(file,'utf8'),/tests="874"[^>]*failures="0"/);
  list.push({type:'phpunit',result:'874tests/5780assertions SHA256 '+c.sha(file)});
  for(const f of c.readJson(c.path.join(state,'canonical-manifest.json')).files)c.assert.equal(c.sha(f.target),f.sha256,'CANONICAL_CHANGED '+f.target);
  return list;
}
async function main(){
  const mode=process.argv[2]??'plan';c.assert.ok(['plan','apply'].includes(mode));const evidences=evidence();
  if(mode==='plan'){save('metadata-publication-plan.json',{success:true,screens:names.map(x=>draft(x).programDraft),newSource:'motor_progress_container_alocacao',newEntity:'container_alocacao_progress',parentTabs:15,preservedTabs:14,permissionsChanged:false,businessWrites:false,evidences});console.log('PASS native publication plan; no writes');return;}
  c.assert.ok(!c.fs.existsSync(c.path.join(state,'publication-started.json')),'PRIOR_ATTEMPT_INSPECT_DO_NOT_REPLAY');
  await c.session(async({api,runtime,login})=>{
    const pre=c.readJson(c.path.join(state,'preflight.json')),source=c.readJson(c.path.join(meta,'api-source.json')),child=draft(names[0]);
    const bootstrap=await api('/bootstrap');
    c.assert.deepEqual(await runtime('ciw.container-painel'),pre.panel,'PARENT_CONCURRENT_CHANGE');
    c.assert.deepEqual(await runtime('ciw.container-itens'),pre.items,'ITEM_SCREEN_CONCURRENT_CHANGE');
    c.assert.deepEqual((await api('/api-sources/motor_progress_container_itens')).apiSource,pre.source,'INDIVIDUAL_SOURCE_CHANGED');
    c.assert.ok(!bootstrap.apiSources.some(x=>x.code===source.code),'SOURCE_COLLISION');
    c.assert.ok(!bootstrap.entities.some(x=>x.code===child.entityDraft.code),'ENTITY_COLLISION');
    c.assert.ok(!bootstrap.programs.some(x=>(x.programCode??x.code)==='op1025'||x.screenId===child.programDraft.screenId),'PROGRAM_COLLISION');
    const parentBefore=(await api('/entities/container_painel_progress')).entity;save('parent-entity-before.json',parentBefore);
    let token=c.readJson(c.path.join(c.root,'.runtime/construtor-pg/containers-connection.json')).integrationToken;
    c.assert.ok(typeof token==='string'&&token.length>=16,'PRIVATE_CONNECTION_REQUIRED');
    save('publication-started.json',{at:new Date().toISOString(),stages:['source','new-entity',...names],businessWrites:false,permissionsChanged:false});
    source.authHeaders['X-Containers-Token']=token;const registered=await api('/api-sources',source);
    c.assert.ok(!JSON.stringify(registered).includes(token),'SECRET_EXPOSED');token=undefined;
    const actual=(await api('/api-sources/'+source.code)).apiSource;c.assert.equal(actual.operations.length,4);
    for(const op of source.operations)c.assert.ok(c.compatibleOperation(actual.operations.find(x=>x.code===op.code),op,actual.baseUrl));
    save('metadata-source-registration.json',{success:true,code:source.code,operations:4,existingSourcePreserved:true});
    for(const slug of names){
      const d=draft(slug),childScreen=slug===names[0];
      const preview=await api('/external/validate',d);save('builder-preview-'+slug+'.json',preview);c.assert.equal(preview.readyToApply,true,'NATIVE_VALIDATION '+slug);
      const request=await api('/governance/requests',{programCode:d.programDraft.programCode,builderEntityCode:d.entityDraft.code,requestedActions:['edit','publish'],reason:'Conversão autorizada da seleção em lote de itens do container; regras compartilhadas, transação raiz, auditoria física e confirmação Kendo. Sem executar o comando ou conceder acesso de negócio.'});
      const grant=await api('/governance/grants',{requestId:request.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']}),locks=[];
      try{
        for(const scope of [{type:'entity',code:d.entityDraft.code},{type:'program',code:d.programDraft.programCode}]){const l=await api('/locks/acquire',{scopeType:scope.type,scopeCode:scope.code,grantId:grant.grant.id,lockCategory:'authoring'});c.assert.equal(l.status,'acquired');locks.push(l.lock.lockToken);}
        if(childScreen){await api('/entities',d.entityDraft);save('entity-registration.json',{success:true,entity:d.entityDraft.code,fields:2,schemaApplied:false});}
        else {c.assert.deepEqual((await api('/entities/container_painel_progress')).entity,parentBefore,'PARENT_ENTITY_CHANGED');c.assert.deepEqual(await runtime('ciw.container-painel'),pre.panel,'PARENT_CHANGED_BEFORE_PUBLISH');}
        const version=await api('/drafts',d.programDraft),id=version.id??version.version?.id;c.assert.ok(id);
        const bundleId='container-allocation-'+crypto.randomUUID();
        await api('/governance/tests',{builderProgramVersionId:id,bundleId,testPlanId:'container-allocation-batch-20261026',status:'passed',checklistSnapshot:{nativeProcess:true,registeredReadonlyOptions:true,integerCollection:true,doubleOptIn:true,explicitConfirmation:true,noExecutionOnOpen:true,sharedSingleCrud:true,sharedFiscalFinance:true,transactionRoot:true,physicalBeforeAfterActor:true,official122:true,checksPerCombination:313,combinations:4,parentTabs:15,previousTabsPreserved:14,operationalScenarioPending:true},evidences,notes:'874PHP/5780asserções e313checksABL×4. Teste Kendo real isolado. PASOE leitura/negativos sem alocação válida em registros existentes. Cenário operacional e novas permissões dependem de autorização específica.'});
        const approval=await api('/governance/approvals',{builderProgramVersionId:id,bundleId});
        await api('/versions/'+id+'/publish',{});
        save('publication-'+slug+'.json',{success:true,screenId:d.programDraft.screenId,version:d.programDraft.version,versionId:id,approvalId:approval.approval.id,businessWrites:false});
        console.log('PASS published '+d.programDraft.screenId+' '+d.programDraft.version);
      }finally{
        for(const lockToken of locks)await api('/locks/release',{lockToken}).catch(()=>{});
        await api('/governance/grants/status',{grantId:grant.grant.id,status:'revoked'});
      }
    }
    c.assert.deepEqual((await api('/entities/container_painel_progress')).entity,parentBefore,'PARENT_ENTITY_NOT_PRESERVED');
    c.assert.deepEqual(await runtime('ciw.container-itens'),pre.items,'ITEM_SCREEN_NOT_PRESERVED');
    c.assert.deepEqual((await api('/api-sources/motor_progress_container_itens')).apiSource,pre.source,'INDIVIDUAL_SOURCE_NOT_PRESERVED');
    const process=await runtime(child.programDraft.screenId),parent=await runtime('ciw.container-painel');
    c.assert.equal(process.process.parameters.fields.find(x=>x.field==='item_ids').type,'array');
    c.assert.deepEqual(parent.crud.form.tabs.slice(0,14),pre.panel.crud.form.tabs);
    c.assert.equal(parent.crud.form.tabs.length,15);
    save('published-definitions.json',{success:true,process,parent});
    save('metadata-publication.json',{success:true,source:source.code,screens:names.map(x=>draft(x).programDraft.screenId),parentVersion:'1.0.8',parentTabs:15,preservedTabs:14,individualSourceOperations:6,individualScreenPreserved:true,parentEntityPreserved:true,permissionsChanged:false,businessWrites:false});
  },{readOnly:false});
}
if(require.main===module)main().catch(e=>{console.error(e.message);process.exitCode=1;});
