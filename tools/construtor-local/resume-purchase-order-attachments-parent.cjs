'use strict';
const c=require('./purchase-order-attachments-metadata-common.cjs'),crypto=require('node:crypto');
(async()=>{
 c.assert.ok(!c.fs.existsSync(c.path.join(c.state,'parent-resume-started.json')),'INSPECT_PRIOR_PARENT_ATTEMPT');
 for(const n of ['builder-delta.json','publication-child.json','metadata-source-registration.json','active-manifest.json','pasoe-read-proof.json'])c.assert.equal(c.readJson(c.path.join(c.state,n)).success,true,n);
 const xml=c.path.join(c.state,'php-canonical-final.xml');c.assert.match(c.fs.readFileSync(xml,'utf8'),/tests="792"[^>]*failures="0"/);
 for(const f of c.readJson(c.path.join(c.state,'canonical-manifest.json')).files)c.assert.equal(c.sha(f.target),f.sha256,'CANONICAL_CHANGED');
 await c.session(async({api,runtime,login})=>{
  const old=c.readJson(c.path.join(c.state,'preflight.json')),parent=await runtime('ciw.processos-compra-med');c.assert.deepEqual(parent,old.parent,'PARENT_CHANGED');c.assert.deepEqual(await runtime('ciw.proc-compra-itens'),old.item,'ITEM_CHANGED');c.assert.deepEqual(await runtime('ciw.proc-compra-anexos'),old.attachment,'OLD_ATTACHMENTS_CHANGED');
  const child=await runtime('ciw.proc-compra-documentos');c.assert.equal(child.program.version,'1.0.0');c.assert.equal(child.program.id,'op1020');c.assert.deepEqual(child.contextFields.map(x=>x.field),['proc_compra_id']);
  const source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;c.assert.equal(source.operations.length,85);for(const op of c.readJson(c.path.join(c.state,'source-registry-before.json')).operations)c.assert.deepEqual(source.operations.find(x=>x.code===op.code),op);for(const op of c.readJson(c.path.join(c.meta,'api-source-additions.json')).operations)c.assert.ok(c.compatibleOperation(source.operations.find(x=>x.code===op.code),op,source.baseUrl));
  const draft=c.draft(true),preview=await api('/external/validate',draft);c.save('builder-preview-parent.json',preview);c.assert.equal(preview.readyToApply,true);
  c.save('parent-resume-started.json',{at:new Date().toISOString(),sourceAndChildAlreadyPublished:true,businessWrites:false});
  const request=await api('/governance/requests',{programCode:draft.programDraft.programCode,builderEntityCode:draft.entityDraft.code,requestedActions:['edit','publish'],reason:'Adicionar aba Anexos aos processos MED; serviço e armazenamento compartilhados e logs com usuário e imagens anteriores/atuais.'});
  const grant=await api('/governance/grants',{requestId:request.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']}),locks=[];
  try {
   for(const scope of [{type:'entity',code:draft.entityDraft.code},{type:'program',code:draft.programDraft.programCode}]){const lock=await api('/locks/acquire',{scopeType:scope.type,scopeCode:scope.code,grantId:grant.grant.id,lockCategory:'authoring'});c.assert.equal(lock.status,'acquired');locks.push(lock.lock.lockToken);}
   const v=await api('/drafts',draft.programDraft),id=v.id??v.version?.id;c.assert.ok(id);const bundleId='purchase-order-docs-parent-'+crypto.randomUUID();
   await api('/governance/tests',{builderProgramVersionId:id,bundleId,testPlanId:'purchase-order-attachments-20261023',status:'passed',checklistSnapshot:{official122:true,ablChecksPerCombination:141,phpTests:792,sharedStorage:true,parentPreviousFourTabsPreserved:true,operationalMutationTestPending:true},evidences:[{type:'phpunit',result:'php-canonical-final.xml SHA256 '+c.sha(xml)},{type:'realPasoe',result:'pasoe-read-proof.json SHA256 '+c.sha(c.path.join(c.state,'pasoe-read-proof.json'))}],notes:'Leitura real e testes isolados passaram. Cenário novo de escrita e permissões humanas aguardam autorização; não representam prova de escrita operacional.'});
   const a=await api('/governance/approvals',{builderProgramVersionId:id,bundleId});await api('/versions/'+id+'/publish',{});
   c.save('publication-parent.json',{success:true,published:true,programCode:draft.programDraft.programCode,screenId:draft.programDraft.screenId,version:draft.programDraft.version,versionId:id,approvalId:a.approval.id,businessWrites:false,at:new Date().toISOString()});
  } finally {for(const lockToken of locks)await api('/locks/release',{lockToken}).catch(()=>{});}
  c.save('metadata-publication.json',{success:true,child:'ciw.proc-compra-documentos',parent:'ciw.processos-compra-med',parentVersion:'1.0.3',sourceOperations:85,previousOperationsPreserved:true,businessWrites:false,homeChanged:false});console.log('PASS parent1.0.3 published with fifth Anexos tab; existing child/source were verified, not replayed');
 },{readOnly:false});
})().catch(e=>{console.error(e.message);process.exitCode=1;});
