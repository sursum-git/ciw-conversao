'use strict';
// Offline preparation. Exported authentication is never usable for publication.
const c=require('./purchase-payments-builder-common.cjs');
const dir=c.path.join(c.root,'.runtime/ciw-completion-20261028/batch1042-metadata');
const pkg=c.path.join(c.root,'integration-src/ciw-completion-20261028/container-expense-batch/metadata');
const clone=v=>structuredClone(v);
function safe(v){return Array.isArray(v)?v.map(safe):v&&typeof v==='object'?Object.fromEntries(Object.entries(v).map(([k,x])=>[k,k==='authHeaders'?[]:safe(x)])):v;}
function contract(v){const x=clone(v);for(const version of x.versions??[])delete version.governance;return safe(x);}
function validateSource(spec){
 c.assert.equal(spec.code,'motor_progress_container_despesas_lote');c.assert.equal(spec.providerType,'generic');c.assert.equal(spec.authMode,'header_static');c.assert.equal(spec.baseUrl,'http://127.0.0.1:19910/med/web');c.assert.equal(spec.responseContract,'sursum-programs');c.assert.equal(spec.timeoutSeconds,25);
 c.assert.deepEqual(spec.operations.map(x=>[x.code,x.type,x.bodyTemplate.operation]),[['despesas_lote_read','list','read'],['despesas_lote_get','detail','get'],['despesas_lote_batch','batch','batch']]);
 for(const x of spec.operations){c.assert.equal(x.method,'POST');c.assert.equal(x.path,'/SursumPrograms/containers-despesas-lote');c.assert.deepEqual(x.requestContextFields,['container_id']);c.assert.deepEqual(Object.keys(x.bodyTemplate).sort(),['operation','resource']);c.assert.equal(x.bodyTemplate.resource,'container-despesas-lote');}
 return spec;
}
function sourceWithActualAuth(spec,actual){
 validateSource(spec);c.assert.equal(actual.code,'motor_progress_container_despesas');c.assert.equal(actual.operations.length,5);c.assert.equal(actual.baseUrl,spec.baseUrl);c.assert.equal(actual.authMode,'header_static');c.assert.equal(actual.responseContract,spec.responseContract);
 const headers=actual.authHeaders;c.assert.ok(headers&&typeof headers==='object'&&!Array.isArray(headers),'ACTUAL_HEADER_MAP_REQUIRED');c.assert.deepEqual(Object.keys(headers),['X-Containers-Token']);c.assert.ok(typeof headers['X-Containers-Token']==='string'&&headers['X-Containers-Token'].length>0&&headers['X-Containers-Token']!=='********','UNMASKED_ACTUAL_TOKEN_REQUIRED');
 return {...clone(spec),authHeaders:clone(headers)};
}
function prepare(){
 const file=c.path.join(dir,'plan.json');c.assert.ok(!c.fs.existsSync(file),'PLAN_EXISTS_DO_NOT_OVERWRITE');
 const pin=file=>({path:file,sha256:c.sha(file)}),at=name=>c.path.join(dir,name),pre=c.readJson(at('preflight.json')),owner=c.readJson(at('native-owner-proof.json')),preview=c.readJson(at('parent-preview-proof.json'));
 c.assert.ok(pre.success&&pre.readOnly&&pre.program1042Absent&&pre.entity1042Absent);c.assert.ok(owner.success&&owner.readOnly&&owner.resolver==='findStandardProgramVersionByEntity');c.assert.equal(owner.owners.container_despesas_progress.programCode,'op1003');c.assert.equal(owner.owners.container_despesas_progress.versionId,120);
 c.assert.ok(preview.success&&preview.readOnly&&preview.deltaReviewed&&preview.onlyVersionAndLink);c.assert.deepEqual(preview.ignoredPaths,[]);c.assert.ok(preview.expectedGeneratedDefinition);c.assert.equal(preview.parentBeforeSha256,c.sha(at('parent-before.json')));c.assert.equal(preview.parentDraftSha256,c.sha(at('parent-draft.json')));
 const source=c.readJson(c.path.join(pkg,'api-source.json')),spec=c.readJson(c.path.join(pkg,'despesas-lote-builder-draft.json'));validateSource(source);c.assert.equal(spec.entityDraft.code,'container_despesas_lote_progress');c.assert.equal(spec.programDraft.programCode,'op1042');c.assert.equal(spec.programDraft.version,'1.0.0');c.assert.equal(spec.entityDraft.apiSourceCode,source.code);
 const proofFiles=['container-expense-batch-preflight/replay-after6-v1/official-verification.json','container-expense-batch-preflight/quotation-collector-proof.json','container-expense-batch-preflight/cleanup-runtime/cleanup-runtime-proof.json','native-batch-snapshot-schema/canonical-manifest.json'];
 const proofs=proofFiles.map(x=>pin(c.path.join(c.root,'.runtime/ciw-completion-20261028',x)));for(const x of proofs)c.assert.ok(c.readJson(x.path).success,'PRIOR_VERIFIED_PROOF_REQUIRED');
 const plan={success:true,status:'OFFLINE_PREPARED_NOT_EXECUTED',sourceSpec:pin(c.path.join(pkg,'api-source.json')),childSpec:pin(c.path.join(pkg,'despesas-lote-builder-draft.json')),parentBefore:pin(at('parent-before.json')),parentDraft:pin(at('parent-draft.json')),parentPreview:pin(at('parent-preview-proof.json')),nativeOwner:pin(at('native-owner-proof.json')),oldSource:pin(at('expense-source-before-sanitized.json')),preflight:pin(at('preflight.json')),proofs,authBridge:pin(c.path.join(__dirname,'read-ciw-batch1042-auth-memory.php')),builderBaseline:{path:'D:/opencode/construtor-pg/backend/src/Builder/ProgramBuilderService.php',sha256:'72c6dafbfa0e93196b443ec45cd6d7c743fddd6415719febd70a0965d1fe18ee'},journal:at('publication-started.json'),sourceCode:source.code,oldSourceCode:'motor_progress_container_despesas',parentVersionBefore:'1.0.4',parentVersionAfter:'1.0.5',businessWrites:false,humanPermissionsChanged:false,processRuns:false,positiveOperationalTest:'AUTHORIZED_SEPARATE_EXACT_SCENARIO_NOT_EXECUTED',partialFailure:'STOP_INSPECT_NO_REPLAY_OR_GENERIC_RESUME'};
 c.fs.writeFileSync(file,JSON.stringify(plan,null,2)+'\n',{flag:'wx'});console.log(JSON.stringify({success:true,offline:true,planSha256:c.sha(file),businessWrites:false}));return plan;
}
module.exports={dir,contract,safe,validateSource,sourceWithActualAuth,prepare};if(require.main===module)try{prepare();}catch{console.error('BATCH1042_OFFLINE_PREPARATION_FAILED');process.exitCode=1;}
