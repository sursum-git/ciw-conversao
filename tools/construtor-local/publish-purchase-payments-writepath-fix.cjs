// Correção nominal e limitada: somente op1013/1.0.0 -> 1.0.1 e writePath titulos.
const c=require('./purchase-payments-builder-common.cjs'),crypto=require('node:crypto');
const slug='proc-compra-pagamentos',oldDirectory=c.path.join(c.state,'metadata-1.0.0-before-writepath');
async function main(){
 c.assert.ok(process.argv.includes('--apply'),'NO_CHANGES: explicit --apply required');
 const receiptName='publication-'+slug+'.json',oldReceipt=c.readJson(c.path.join(oldDirectory,receiptName)),oldDraft=c.readJson(c.path.join(oldDirectory,slug+'-builder-draft.json')),draft=c.readJson(c.path.join(c.meta,slug+'-builder-draft.json'));
 c.assert.equal(oldReceipt.published,true);c.assert.equal(oldReceipt.programCode,'op1013');c.assert.equal(oldReceipt.version,'1.0.0');c.assert.equal(c.readJson(c.path.join(c.state,receiptName)).version,'1.0.0','ALREADY_UPDATED_DO_NOT_REPEAT');
 const expected=structuredClone(oldDraft);expected.programDraft.version='1.0.1';expected.entityDraft.fields.find(x=>x.code==='titulos').apiWritePath='values.titulos';c.assert.deepEqual(draft,expected,'DELTA_OUTSIDE_WRITEPATH_FIX');
 c.assert.equal(draft.programDraft.screenId,'ciw.proc-compra-pagamentos');c.assert.equal(draft.programDraft.programCode,'op1013');
 const gate=c.readJson(c.path.join(c.state,'builder-publication-gates.json'));c.assert.equal(gate.ready,true);
 // As provas de backend e PASOE são as já seladas; não altera ou reinterpreta o lote.
 for(const name of ['officialCompile','canonicalManifest','activeManifest','pasoeProof','phpSuite','phpCanonicalManifest']){const proof=gate[name];c.assert.equal(c.sha(c.path.resolve(c.state,proof.path)),proof.sha256,'BACKEND_PROOF_CHANGED '+name);}
 require('./publish-purchase-payments-builder.cjs').validateOfficialReceipt(c.readJson(c.path.join(c.state,gate.officialCompile.path)));
 for(const [file,hash] of Object.entries(gate.metadata)){if(file===slug+'-builder-draft.json')c.assert.equal(c.sha(c.path.join(oldDirectory,file)),hash);else c.assert.equal(c.sha(c.path.join(c.meta,file)),hash,'UNRELATED_METADATA_CHANGED '+file);}
 const canonical=c.readJson(c.path.join(c.state,'metadata-canonical-manifest-1.0.1.json'));c.assert.equal(canonical.success,true);c.assert.equal(c.sha(canonical.path),canonical.afterSha256);c.assert.equal(c.sha(c.path.join(c.meta,slug+'-builder-draft.json')),canonical.afterSha256);
 const contract=c.readJson(c.path.join(c.state,'metadata-write-payload-contract.json'));c.assert.equal(contract.success,true);c.assert.equal(contract.checks,3);c.assert.ok(c.readJson(c.path.join(c.state,'metadata-js-receipt.json')).receipts.every(x=>x.nativeCrudValidator==='PASS'));
 return c.session(async({api,runtime,login})=>{
  const sourceBefore=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource,homeBefore=await runtime('home'),parentBefore=await runtime('ciw.processos-compra-financeiro-med'),childBefore=await runtime(draft.programDraft.screenId);
  c.assert.equal(childBefore.program.id,'op1013');c.assert.equal(childBefore.program.version,'1.0.0');c.assert.equal(parentBefore.program.id,'cd0107');
  const preview=await api('/external/validate',{entityDraft:draft.entityDraft,programDraft:draft.programDraft});c.assert.equal(preview.readyToApply,true);c.save('builder-preview-'+slug+'-1.0.1.json',preview);
  const req=await api('/governance/requests',{programCode:'op1013',builderEntityCode:draft.entityDraft.code,requestedActions:['edit','publish'],reason:'Correção de contrato autorizada: somente apiWritePath de titulos para values.titulos, versão1.0.1. Sem alteração de operação API/Home ou negócio.'});
  const grant=await api('/governance/grants',{requestId:req.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']});const locks=[];
  try{
   for(const scope of [{type:'entity',code:draft.entityDraft.code},{type:'program',code:'op1013'}]){const lock=await api('/locks/acquire',{scopeType:scope.type,scopeCode:scope.code,grantId:grant.grant.id,lockCategory:'authoring'});c.assert.equal(lock.status,'acquired');locks.push(lock.lock.lockToken);}
   await api('/entities',draft.entityDraft);
   const version=await api('/drafts',draft.programDraft),id=version.id??version.version?.id;c.assert.ok(id);const bundleId='purchase-writepath-'+crypto.randomUUID();
   await api('/governance/tests',{builderProgramVersionId:id,bundleId,testPlanId:'purchase-payments-writepath-1.0.1',status:'passed',checklistSnapshot:{schema:true,nativePayloadContract:true,jsonPath:true,backendUnchanged:true,homeUnchanged:true,apiOperationsUnchanged:true},evidences:[{type:'canonical-private-buildWritePayload',result:'RED original root titulos -> GREEN nested values.titulos, integer array, proc_compra_id root; no HTTP/DB; metadata-write-payload-contract.json'},{type:'native-builder-and-js',result:'2previews PASS; only childversion1.0.1'},{type:'official-backend-unchanged',result:'sealed12.2/210checks x4combinations; hashes preserved'}],notes:'Correção exclusiva de metadados. Nenhuma mutação de negócio executada neste fluxo.'});
   const approval=await api('/governance/approvals',{builderProgramVersionId:id,bundleId});await api('/versions/'+id+'/publish',{});
   const childAfter=await runtime(draft.programDraft.screenId);c.assert.equal(childAfter.program.version,'1.0.1');c.assert.equal(childAfter.program.id,'op1013');
   const sourceAfter=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource,homeAfter=await runtime('home'),parentAfter=await runtime('ciw.processos-compra-financeiro-med');c.assert.deepEqual(sourceAfter.operations,sourceBefore.operations);c.assert.deepEqual(homeAfter.programs,homeBefore.programs);c.assert.deepEqual(homeAfter.navigation,homeBefore.navigation);c.assert.deepEqual(parentAfter.program,parentBefore.program);
   const receipt={published:true,screenId:draft.programDraft.screenId,programCode:'op1013',version:'1.0.1',versionId:id,approvalId:approval.approval.id,metadataSha256:canonical.afterSha256,businessWrites:false,apiOperationsUnchanged:true,homeUnchanged:true,parentUnchanged:true,oldVersionReceipt:'metadata-1.0.0-before-writepath/'+receiptName,at:new Date().toISOString()};c.save('publication-'+slug+'-1.0.1.json',receipt);c.save(receiptName,receipt);console.log('PASS: only op1013/1.0.1 published; values.titulos contract fixed; API operations/Home/parent preserved.');
  }finally{for(const lockToken of locks)await api('/locks/release',{lockToken}).catch(()=>{});}
 },{readOnly:false});
}
if(require.main===module)main().catch(error=>{console.error(error.message);process.exitCode=1;});
