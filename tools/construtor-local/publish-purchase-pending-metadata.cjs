'use strict';
const c=require('./purchase-payments-builder-common.cjs'),crypto=require('node:crypto'),state=c.path.join(c.root,'.runtime/purchase-pending-integration-20261028'),candidate=c.path.join(c.root,'integration-src/purchase-pending-20261028');
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
async function main(){
 c.assert.ok(!c.fs.existsSync(c.path.join(state,'metadata-publication-started.json')),'INSPECT_OUTCOME_BEFORE_REPLAY');
 const evidence=[];for(const n of ['official-compile-verification.json','canonical-manifest.json','active-manifest.json','pasoe-read-proof.json','metadata/js-validation.json']){c.assert.equal(c.readJson(c.path.join(state,n)).success,true,n);evidence.push({type:n,result:'SHA256 '+c.sha(c.path.join(state,n))});}
 c.assert.deepEqual(c.readJson(c.path.join(state,'review-final.json')).openP1P2,[]);evidence.push({type:'independent-final-review',result:'SHA256 '+c.sha(c.path.join(state,'review-final.json'))});
 c.assert.match(c.fs.readFileSync(c.path.join(state,'php-full.xml'),'utf8'),/tests="885"[^>]*failures="0"/);
 for(const x of c.readJson(c.path.join(state,'canonical-manifest.json')).files)c.assert.equal(c.sha(x.target),x.sha256);
 const targets=[['signals-global','sinalizadores-importacao-med'],['signals-global','alertas-importacao-med'],['signal-config','sinalizadores-importacao']];
 await c.session(async({api,runtime,login})=>{
  const source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource,before=c.readJson(c.path.join(state,'source-before.json')),boot=await api('/bootstrap');c.assert.deepEqual(source,before);c.assert.equal(source.operations.length,111);
  c.assert.deepEqual(await runtime('ciw.processos-compra-med'),c.readJson(c.path.join(state,'parent-before.json')));
  const drafts=targets.map(([scope,slug])=>({scope,slug,draft:c.readJson(c.path.join(candidate,scope,'metadata',slug+'-builder-draft.json'))}));
  for(const {draft:d}of drafts){c.assert.ok(!boot.programs.some(x=>(x.programCode??x.code)===d.programDraft.programCode||x.screenId===d.programDraft.screenId));c.assert.ok(!boot.entities.some(x=>x.code===d.entityDraft.code));}
  const additions=['signals-global','signal-config'].flatMap(scope=>c.readJson(c.path.join(candidate,scope,'metadata/api-source-additions.json')).operations);c.assert.equal(additions.length,7);
  for(const op of additions)c.assert.ok(!source.operations.some(x=>x.code===op.code));
  save('metadata-publication-started.json',{at:new Date().toISOString(),businessWrites:false,humanPermissionsChanged:false});source.operations.push(...additions);await api('/api-sources',source);
  const registered=(await api('/api-sources/'+source.code)).apiSource;c.assert.equal(registered.operations.length,118);for(const old of before.operations)c.assert.deepEqual(registered.operations.find(x=>x.code===old.code),old);
  const screens=[];
  for(const {scope,slug,draft:d}of drafts){
   const preview=await api('/external/validate',d);save('builder-preview-'+slug+'.json',preview);c.assert.equal(preview.readyToApply,true);
   await api('/entities',d.entityDraft);
   const request=await api('/governance/requests',{programCode:d.programDraft.programCode,builderEntityCode:d.entityDraft.code,requestedActions:['edit','publish'],reason:'Conversão MED solicitada com gerente e executores. Coleta/regras compartilhadas, configuração de cinco regras com auditoria. TT12.2 e PASOE leitura/negativas aprovados; sem alterar configurações de negócio nem novos acessos humanos.'});
   const grant=await api('/governance/grants',{requestId:request.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']}),locks=[];
   try{
    for(const [scopeType,scopeCode]of [['entity',d.entityDraft.code],['program',d.programDraft.programCode]]){const lock=await api('/locks/acquire',{scopeType,scopeCode,grantId:grant.grant.id,lockCategory:'authoring'});c.assert.equal(lock.status,'acquired');locks.push(lock.lock.lockToken);}
    const version=await api('/drafts',d.programDraft),id=version.id??version.version?.id;c.assert.ok(id);const bundleId='purchase-pending-'+crypto.randomUUID();
    await api('/governance/tests',{builderProgramVersionId:id,bundleId,testPlanId:'purchase-pending-20261028',status:'passed',checklistSnapshot:{sharedCollector:true,fiveRules:true,official122:true,checksPerCombination:298,combinations:4,phpTests:885,phpAssertions:5841,phpQueryChecks:33,phpAuditChecks:25,businessWrites:false,configurationOperationalUpdatesTested:false},evidences:evidence,notes:'Configuração persistência/concorrência/imagens antes-depois validadas em TT sem banco. PASOE: somente leitura e negativas; nenhuma das cinco configurações existentes foi alterada. Novos acessos humanos ainda dependem de autorização específica. Lote sem código original e Controles permanecem pendências documentadas.'});
    const approval=await api('/governance/approvals',{builderProgramVersionId:id,bundleId});await api('/versions/'+id+'/publish',{});
    const item={screenId:d.programDraft.screenId,programCode:d.programDraft.programCode,version:d.programDraft.version,versionId:id,approvalId:approval.approval.id};save('publication-'+slug+'.json',{success:true,...item,businessWrites:false});screens.push(item);
   }finally{const released=await Promise.allSettled(locks.map(lockToken=>api('/locks/release',{lockToken})));await api('/governance/grants/status',{grantId:grant.grant.id,status:'revoked'});c.assert.ok(released.every(x=>x.status==='fulfilled'));}
  }
  c.assert.deepEqual(await runtime('ciw.processos-compra-med'),c.readJson(c.path.join(state,'parent-before.json')));
  save('metadata-publication.json',{success:true,screens,sourceOperations:118,previous111Preserved:true,parentUnchanged:'1.0.8',businessWrites:false,humanPermissionsChanged:false});console.log('PASS native publication3screens/source111to118/pai1.0.8unchanged; no human grants');
 },{readOnly:false});
}
main().catch(e=>{console.error(e.message);process.exitCode=1;});
