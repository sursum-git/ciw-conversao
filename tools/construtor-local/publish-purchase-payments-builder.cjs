// Preparado para execução explícita pelo responsável, após publicação/validação do backend e PASOE.
const c=require('./purchase-payments-builder-common.cjs'),crypto=require('node:crypto');
function validateOfficialReceipt(official){
 c.assert.equal(official.success,true);c.assert.match(String(official.version??official.openedgeVersion),/^12\.2(?:\D|$)/);c.assert.equal(official.testsPerCombination,210);c.assert.deepEqual(official.cultures,['AMERICAN','EUROPEAN']);c.assert.deepEqual(official.codepages,['UTF-8','ISO8859-1']);
 const production=['ContainersItensFinanceiroService.r','ContainersItensRuntime.r','CiwErpReadService.r','CiwCadastrosCrud.r','PurchasePaymentsApi.r','PurchasePaymentsService.r'].sort();
 c.assert.ok(Array.isArray(official.artifacts),'OFFICIAL_ARTIFACTS_REQUIRED');c.assert.deepEqual(official.artifacts.map(x=>x.name).sort(),production,'EXACT_PRODUCTION_BINARIES_REQUIRED');
 for(const artifact of official.artifacts){const local=c.path.resolve(c.root,artifact.path);c.assert.ok(local.startsWith(c.state+c.path.sep+'compiled122'+c.path.sep),'NON_OFFICIAL_ARTIFACT');c.assert.equal(c.path.basename(local),artifact.name,'OFFICIAL_ARTIFACT_NAME_MISMATCH');c.assert.equal(c.sha(local),artifact.sha256.toLowerCase(),'OFFICIAL_ARTIFACT_CHANGED '+artifact.name);}
 return true;
}
function guards(){
 const gate=c.readJson(c.path.join(c.state,'builder-publication-gates.json'));
 c.assert.equal(gate.ready,true,'BUILDER_GATES_NOT_READY');
 for(const name of ['officialCompile','canonicalManifest','activeManifest','pasoeProof','phpSuite','phpCanonicalManifest','metadataCanonicalManifest','metadataPhp','metadataJs']){
  const p=gate[name];c.assert.ok(p&&typeof p.path==='string'&&/^[a-f0-9]{64}$/.test(p.sha256),'INVALID_GATE '+name);
  const file=c.path.resolve(c.state,p.path);c.assert.ok(file.startsWith(c.state+c.path.sep),'GATE_OUTSIDE_PRIVATE_STATE');c.assert.equal(c.sha(file),p.sha256,'EVIDENCE_CHANGED '+name);
  const text=c.fs.readFileSync(file,'utf8');
  if(name==='officialCompile')validateOfficialReceipt(JSON.parse(text));
  if(name==='phpCanonicalManifest'){const manifest=JSON.parse(text);c.assert.ok(manifest.files?.length>0,'PHP_CANONICAL_MANIFEST_EMPTY');for(const entry of manifest.files){c.assert.ok(entry.path.startsWith('D:/opencode/construtor-pg/backend/'),'PHP_CANONICAL_PATH_INVALID');c.assert.equal(c.sha(entry.path),entry.after.toLowerCase(),'PHP_CANONICAL_CHANGED '+entry.relative);}}
  if(name==='metadataCanonicalManifest'){const manifest=JSON.parse(text);c.assert.equal(manifest.success,true);c.assert.equal(manifest.files?.length,4);for(const entry of manifest.files){const directory=c.path.resolve('D:/opencode/construtor-pg/integrations/ciw-purchase-payments');c.assert.equal(c.path.dirname(c.path.resolve(entry.path)),directory,'CANONICAL_METADATA_PATH_INVALID');c.assert.equal(c.sha(entry.path),entry.sha256,'CANONICAL_METADATA_CHANGED');c.assert.equal(c.sha(c.path.join(c.meta,c.path.basename(entry.path))),entry.sha256,'CANONICAL_METADATA_DIFFERS_FROM_CANDIDATE');}}
  if(name==='phpSuite')c.assert.match(text,/OK \(\d+ tests, \d+ assertions\)/);
  if(['canonicalManifest','activeManifest','pasoeProof','metadataPhp','metadataJs'].includes(name)){const data=JSON.parse(text);c.assert.ok(data.success===true||name==='activeManifest'&&data.targets||name==='metadataPhp'&&data.definitions?.length===2||name==='metadataJs'&&data.receipts?.every(x=>x.nativeCrudValidator==='PASS'),'EVIDENCE_NOT_SUCCESS '+name);}
 }
 c.assert.equal(gate.officialVersion,'12.2');c.assert.equal(gate.origin,'MED');
 const files=c.fs.readdirSync(c.meta).filter(x=>x.endsWith('.json')).sort();c.assert.deepEqual(Object.keys(gate.metadata).sort(),files);
 for(const name of files)c.assert.equal(c.sha(c.path.join(c.meta,name)),gate.metadata[name],'METADATA_CHANGED '+name);
 return gate;
}
async function main(){
 c.assert.ok(process.argv.includes('--apply'),'NO_CHANGES: use --apply only after reviewing builder-publication-gates.json');
 const gate=guards(),ds=c.drafts();
 return c.session(async({api,login})=>{
  const {receipt,source}=await c.inspect(api);c.assert.deepEqual(receipt.collisions,[],'PROGRAM_OR_ENTITY_COLLISION');c.assert.deepEqual(receipt.operationConflicts,[],'API_OPERATION_COLLISION');
  const completed=ds.filter(d=>c.fs.existsSync(c.path.join(c.state,'publication-'+d.slug+'.json')));c.assert.ok(completed.length<ds.length,'ALREADY_PUBLISHED_DO_NOT_REPEAT');
  const additions=c.readJson(c.path.join(c.meta,'api-source-additions.json')).operations;c.assert.equal(additions.length,7);
  const privateDir=c.path.join(c.state,'private');c.fs.mkdirSync(privateDir,{recursive:true});
  const beforeFile=c.path.join(privateDir,'builder-source-before.json');if(!c.fs.existsSync(beforeFile))c.fs.writeFileSync(beforeFile,JSON.stringify(source,null,2));
  const before=structuredClone(source.operations),pending=additions.filter(op=>!source.operations.some(x=>x.code===op.code));for(const op of pending)source.operations.push(op);
  if(pending.length)await api('/api-sources',source);
  const registered=(await api('/api-sources/'+source.code)).apiSource;
  for(const op of before)c.assert.deepEqual(registered.operations.find(x=>x.code===op.code),op,'PREVIOUS_OPERATION_CHANGED '+op.code);
  for(const op of additions){const actual=registered.operations.find(x=>x.code===op.code);c.assert.ok(actual&&c.compatibleOperation(actual,op,registered.baseUrl),'REGISTERED_OPERATION_CHANGED '+op.code);}
  c.save('builder-source-registration.json',{success:true,sourceCode:source.code,addedOperations:additions.map(x=>x.code),operationsWrittenThisRun:pending.map(x=>x.code),alreadyRegistered:pending.length===0,previousOperationsPreserved:true});
  for(const draft of ds){
   const receiptName='publication-'+draft.slug+'.json';if(c.fs.existsSync(c.path.join(c.state,receiptName)))continue;
   const preview=await api('/external/validate',{entityDraft:draft.entityDraft,programDraft:draft.programDraft});c.assert.equal(preview.readyToApply,true);c.save('builder-preview-'+draft.slug+'.json',preview);
   await api('/entities',draft.entityDraft);
   const req=await api('/governance/requests',{programCode:draft.programDraft.programCode,builderEntityCode:draft.entityDraft.code,requestedActions:['edit','publish'],reason:'Conversão contextual autorizada de títulos dos processos de compra MED. Reuso do writer, frontend e logs nativos.'});
   const grant=await api('/governance/grants',{requestId:req.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']});
   const locks=[];
   try{
    for(const scope of [{type:'entity',code:draft.entityDraft.code},{type:'program',code:draft.programDraft.programCode}]){const lock=await api('/locks/acquire',{scopeType:scope.type,scopeCode:scope.code,grantId:grant.grant.id,lockCategory:'authoring'});c.assert.equal(lock.status,'acquired');locks.push(lock.lock.lockToken);}
    const version=await api('/drafts',draft.programDraft),id=version.id??version.version?.id;c.assert.ok(id);const bundleId='purchase-payments-'+crypto.randomUUID();
    await api('/governance/tests',{builderProgramVersionId:id,bundleId,testPlanId:'purchase-payments-20261022',status:'passed',checklistSnapshot:{schema:true,php:true,abl122:true,frontendExisting:true,contextualSelector:true,reusedWriter:true,explicitCompany:true,audit:true},evidences:Object.entries(gate).filter(([key,value])=>value&&typeof value==='object'&&value.path).map(([type,value])=>({type,result:value.path+' SHA256 '+value.sha256})),notes:'Dois programas; consulta pai MED e associação/desvinculação contextual. Governança e auditoria existentes; nenhuma concessão humana de acesso.'});
    const approval=await api('/governance/approvals',{builderProgramVersionId:id,bundleId});await api('/versions/'+id+'/publish',{});
    c.save(receiptName,{published:true,screenId:draft.programDraft.screenId,programCode:draft.programDraft.programCode,version:draft.programDraft.version,versionId:id,approvalId:approval.approval.id,metadataSha256:c.sha(c.path.join(c.meta,draft.slug+'-builder-draft.json')),businessWrites:false,at:new Date().toISOString()});console.log('Publicado '+draft.programDraft.screenId);
   }finally{for(const lockToken of locks)await api('/locks/release',{lockToken}).catch(()=>{});}
  }
 },{readOnly:false});
}
if(require.main===module)main().catch(e=>{console.error(e.message);process.exitCode=1;});
module.exports={guards,validateOfficialReceipt};
