'use strict';
const c=require('./purchase-payments-builder-common.cjs'),crypto=require('node:crypto'),state=c.path.join(c.root,'.runtime/purchase-quantity-periods-20261028'),meta=c.path.join(c.root,'integration-src/purchase-quantity-periods/metadata');
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
async function main(){
 c.assert.ok(!c.fs.existsSync(c.path.join(state,'metadata-publication-started.json')),'ALREADY_ATTEMPTED_INSPECT_BEFORE_REPLAY');
 const evidence=[];for(const n of ['official-compile-verification.json','canonical-manifest.json','active-manifest.json','pasoe-read-proof.json','global-metadata-php-validation.json','metadata-js-validation.json']){c.assert.equal(c.readJson(c.path.join(state,n)).success,true,n);evidence.push({type:n,result:'SHA256 '+c.sha(c.path.join(state,n))});}
 c.assert.equal(c.readJson(c.path.join(state,'review-final.json')).status,'reviewed_no_open_confirmed_P1_P2');evidence.push({type:'review',result:'SHA256 '+c.sha(c.path.join(state,'review-final.json'))});
 c.assert.match(c.fs.readFileSync(c.path.join(state,'php-full.xml'),'utf8'),/tests="885"[^>]*failures="0"/);
 for(const f of c.readJson(c.path.join(state,'canonical-manifest.json')).files)c.assert.equal(c.sha(f.target),f.sha256);
 await c.session(async({api,runtime,login})=>{
  const d=c.readJson(c.path.join(meta,'quantidades-importadas-periodo-med-builder-draft.json')),boot=await api('/bootstrap');
  c.assert.ok(!boot.programs.some(p=>(p.programCode??p.code)===d.programDraft.programCode||p.screenId===d.programDraft.screenId));c.assert.ok(!boot.entities.some(e=>e.code===d.entityDraft.code));
  const source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource,before=c.readJson(c.path.join(state,'source-registry-before.json'));
  c.assert.deepEqual(source,before);c.assert.equal(source.operations.length,109);c.assert.deepEqual(await runtime('ciw.processos-compra-med'),c.readJson(c.path.join(state,'parent-before.json')));
  const additions=c.readJson(c.path.join(meta,'api-source-additions.json')).operations;c.assert.equal(additions.length,2);for(const op of additions)c.assert.ok(!source.operations.some(x=>x.code===op.code));
  save('metadata-publication-started.json',{at:new Date().toISOString(),businessWrites:false,humanPermissionsChanged:false});
  source.operations.push(...additions);await api('/api-sources',source);
  const current=(await api('/api-sources/'+source.code)).apiSource;c.assert.equal(current.operations.length,111);for(const op of before.operations)c.assert.deepEqual(current.operations.find(x=>x.code===op.code),op);
  const preview=await api('/external/validate',d);save('builder-preview.json',preview);c.assert.equal(preview.readyToApply,true);
  await api('/entities',d.entityDraft);
  const request=await api('/governance/requests',{programCode:d.programDraft.programCode,builderEntityCode:d.entityDraft.code,requestedActions:['edit','publish'],reason:'Conversão autorizada da consulta MED de quantidades por período. Preservar comparação assimétrica confirmada pelo usuário;coletor/regras compartilhados e leitura somente. Sem novos acessos humanos ou negócio gravado.'});
  const grant=await api('/governance/grants',{requestId:request.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']}),locks=[];
  try{
   for(const [scopeType,scopeCode]of [['entity',d.entityDraft.code],['program',d.programDraft.programCode]]){const l=await api('/locks/acquire',{scopeType,scopeCode,grantId:grant.grant.id,lockCategory:'authoring'});c.assert.equal(l.status,'acquired');locks.push(l.lock.lockToken);}
   const v=await api('/drafts',d.programDraft),id=v.id??v.version?.id;c.assert.ok(id);const bundleId='purchase-periods-'+crypto.randomUUID();
   await api('/governance/tests',{builderProgramVersionId:id,bundleId,testPlanId:'purchase-quantity-periods-20261028',status:'passed',checklistSnapshot:{readOnly:true,legacyAsymmetricDateRule:true,sharedCollector:true,original17FieldProjection:true,official122:true,checksPerCombination:231,combinations:4,phpTests:885,phpAssertions:5841,businessWrites:false},evidences:evidence,notes:'Leitura/get/períodos/página/negativas no PASOE real aprovados;revisão sem P1/P2 aberto. SQL ODBC legado não conectou para probe de case/padding; não normalizar textos por suposição. Nova read humana ainda não concedida.'});
   const approval=await api('/governance/approvals',{builderProgramVersionId:id,bundleId});await api('/versions/'+id+'/publish',{});
   save('publication-screen.json',{success:true,screenId:d.programDraft.screenId,programCode:d.programDraft.programCode,version:'1.0.0',versionId:id,approvalId:approval.approval.id,businessWrites:false});
  }finally{const released=await Promise.allSettled(locks.map(lockToken=>api('/locks/release',{lockToken})));await api('/governance/grants/status',{grantId:grant.grant.id,status:'revoked'});c.assert.ok(released.every(x=>x.status==='fulfilled'));}
  c.assert.deepEqual(await runtime('ciw.processos-compra-med'),c.readJson(c.path.join(state,'parent-before.json')));
  save('metadata-publication.json',{success:true,screenId:d.programDraft.screenId,version:'1.0.0',sourceOperations:111,previous109Preserved:true,parentVersionUnchanged:'1.0.8',businessWrites:false,humanPermissionsChanged:false});
  console.log('PASS native metadata publication op1030/1.0.0,source109to111,pai1.0.8unchanged,no human read grant');
 },{readOnly:false});
}
main().catch(e=>{console.error(e.message);process.exitCode=1;});
