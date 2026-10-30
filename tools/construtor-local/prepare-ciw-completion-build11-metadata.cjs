'use strict';
// Offline only. No session, credentials, network or catalog mutation.
const fs=require('node:fs'),path=require('node:path'),crypto=require('node:crypto'),assert=require('node:assert/strict');
const root=path.resolve(__dirname,'../..'),dir=path.join(root,'.runtime/ciw-completion-20261028/build11-metadata-publication-preparation');
const build=path.join(root,'.runtime/ciw-completion-20261028/official-build11');
const product=path.join(root,'integration-src/ciw-completion-20261028/expense-tax-relations-readonly/frozen-v1.1');
const PRODUCT_SHA='1865e6c18f4fc8ecc26d8f7a697058c1c943d378f4a9e01c5d25c0e2021df79e';
const read=p=>JSON.parse(fs.readFileSync(p,'utf8')),sha=p=>crypto.createHash('sha256').update(fs.readFileSync(p)).digest('hex'),clone=v=>structuredClone(v);
const safe=v=>Array.isArray(v)?v.map(safe):v&&typeof v==='object'?Object.fromEntries(Object.entries(v).map(([k,x])=>[k,k==='authHeaders'?[]:safe(x)])):v;
function invariantSource(source){const result=clone(source);delete result.operations;delete result.updatedAt;return result;}
function sourceFromExport(dto){const sources=Array.isArray(dto)?dto:[dto],matches=sources.map(x=>x.apiSource??x).filter(x=>x.code==='motor_progress_ciw_cadastros');assert.equal(matches.length,1,'EXACT_SOURCE_EXPORT_REQUIRED');return matches[0];}
function assertOperations(ops){
 assert.equal(ops.length,2);assert.deepEqual(ops.map(x=>[x.code,x.type,x.bodyTemplate.operation]),[['despesas_impostos_geral_read','list','read'],['despesas_impostos_geral_get','detail','get']]);
 for(const op of ops){assert.equal(op.method,'POST');assert.equal(op.path,'http://127.0.0.1:19910/med/web/SursumPrograms/ciw-cadastros');assert.deepEqual(op.bodyTemplate,{resource:'despesas_impostos_geral',operation:op.bodyTemplate.operation});assert.deepEqual(op.requestContextFields,[]);assert.deepEqual(op.headers,[]);assert.deepEqual(op.queryParams,[]);assert.ok(!op.allowProcess);}
 assert.equal(ops[0].itemsPath,'data');assert.equal(ops[0].totalPath,'total');assert.equal(ops[1].itemPath,'data');
}
function appendOperations(before,ops){
 assert.equal(before.code,'motor_progress_ciw_cadastros');assert.equal(before.operations.length,144);assertOperations(ops);
 for(const op of ops)assert.ok(!before.operations.some(x=>x.code===op.code),'OPERATION_COLLISION');
 const result=clone(before);result.operations=[...clone(before.operations),...clone(ops)];assert.deepEqual(result.operations.slice(0,144),before.operations);return result;
}
function assertSourceBaseline(actual,baseline){assert.deepEqual(safe(invariantSource(actual)),safe(invariantSource(baseline)),'SOURCE_CONFIG_BASELINE_CHANGED');assert.deepEqual(safe(actual.operations),safe(baseline.operations),'SOURCE_OPERATIONS_BASELINE_CHANGED');assert.equal(actual.operations.length,144);}
function assertSpec(spec){
 assert.equal(spec.programDraft.programCode,'op1055');assert.equal(spec.entityDraft.code,'despesas_impostos_geral_progress');assert.equal(spec.programDraft.builderEntityCode,spec.entityDraft.code);assert.equal(spec.programDraft.screenId,'ciw.despesas-impostos-geral');assert.equal(spec.programDraft.version,'1.0.0');assert.equal(spec.entityDraft.apiSourceCode,'motor_progress_ciw_cadastros');
 assert.equal(spec.entityDraft.createPhysicalTable,false);assert.equal(spec.programDraft.pageType,'crud');assert.deepEqual(spec.programDraft.contextFields,[]);assert.deepEqual(spec.programDraft.rowLinks,[]);for(const key of ['allowCreate','allowUpdate','allowDelete'])assert.equal(spec.programDraft[key],false);
 assert.deepEqual(spec.entityDraft.fields.map(x=>x.code),['despesa_id','imposto_id','empresa_id','record_key']);
}
function assertProofContracts(official,canonical,active,pasoe){
 assert.ok(official.success&&official.version==='12.2'&&official.compileCount===7&&official.numDbsCompile===1&&official.numDbsTests===0&&official.totalChecks===384&&official.testLogs===8,'OFFICIAL11_REQUIRED');
 assert.ok(canonical.success&&canonical.files.length===5&&canonical.businessWrites===false,'CANONICAL11_REQUIRED');
 assert.ok(active.success&&active.instance==='sursum-api'&&active.context==='med'&&active.businessWrites===false&&active.coherentWebMedPause===true&&active.medWebRestored===true&&active.imaWebUnchanged===true,'ACTIVE_SAME_MED11_REQUIRED');
 assert.ok(pasoe.success&&pasoe.instance==='sursum-api'&&pasoe.context==='med'&&pasoe.officialPort===9911&&pasoe.checks===17&&pasoe.positiveGet&&pasoe.pk3&&pasoe.paging&&pasoe.filters&&pasoe.aliasRejected&&pasoe.invalidContextsRejected&&pasoe.authDenied&&pasoe.businessWrites===false&&pasoe.processRuns===false&&pasoe.catalogWrites===false,'PASOE11_READ_PROOF_REQUIRED');
 for(const name of ['CiwErpReadService.p','CiwCadastrosCrud.p']){const row=canonical.files.find(x=>x.target.replaceAll('\\','/').endsWith('/'+name));assert.ok(row);assert.equal(active.targets['sursum-api/programs/'+name].sha256,row.sha256);}
 for(const[name,target]of Object.entries(active.targets)){const physical=official.files.find(x=>x.relative===name);assert.ok(physical,'OFFICIAL_ARTIFACT_MISSING');assert.equal(target.sha256,physical.sha256);}
}
function verifyPlanInputs(plan){
 assert.equal(plan.state,'PREPARED_OFFLINE_NOT_EXECUTED');assert.equal(plan.source.before,144);assert.equal(plan.source.after,146);assert.equal(plan.parent,null);assertOperations(plan.source.operations);
 for(const item of plan.inputs)assert.equal(sha(item.path),item.sha256,'PINNED_INPUT_CHANGED');
 assert.equal(sha(plan.productManifest.path),PRODUCT_SHA);for(const item of read(plan.productManifest.path).sourceFiles)assert.equal(sha(path.join(product,item.path)),item.sha256,'FROZEN_PRODUCT_CHANGED');
 const official=read(plan.proofPaths.official),canonical=read(plan.proofPaths.canonical),active=read(plan.proofPaths.active),pasoe=read(plan.proofPaths.pasoe);assertProofContracts(official,canonical,active,pasoe);
 for(const item of canonical.files)assert.equal(sha(item.target),item.sha256,'CANONICAL_CURRENT_CHANGED');
 for(const item of plan.dependencies)assert.equal(sha(item.path),item.sha256,'CURRENT_DEPENDENCY_CHANGED');
 assertSpec(read(plan.newProgram.path));assert.equal(sha(plan.newProgram.path),plan.newProgram.sha256);return true;
}
function prepare(){
 assert.ok(!fs.existsSync(path.join(dir,'plan.json')),'ALREADY_PREPARED_DO_NOT_OVERWRITE');
 const manifest=path.join(product,'manifest.json');assert.equal(sha(manifest),PRODUCT_SHA);for(const item of read(manifest).sourceFiles)assert.equal(sha(path.join(product,item.path)),item.sha256);
 const sourceAddition=path.join(product,'metadata/source-addition.json'),addition=read(sourceAddition);assert.equal(sha(addition.target),addition.baselineSha256);const source=sourceFromExport(read(addition.target)),ops=addition.operations.map(x=>x.value);appendOperations(source,ops);
 const proofPaths={official:path.join(build,'official-compile-verification.json'),canonical:path.join(build,'canonical-manifest.json'),active:path.join(root,'.runtime/ciw-completion-20261028/runtime-build11/active-manifest.json'),pasoe:path.join(build,'pasoe-read-proof.json')};
 const managerRelease=path.join(build,'manager-release.json');assert.ok(read(managerRelease).success);assert.equal(read(managerRelease).productManifestSha256,PRODUCT_SHA);
 const spec=path.join(product,'metadata/builder-draft.json');assertSpec(read(spec));
 const dependencies=[{path:'D:/opencode/construtor-pg/backend/src/Builder/ProgramBuilderService.php',sha256:'72c6dafbfa0e93196b443ec45cd6d7c743fddd6415719febd70a0965d1fe18ee'},{path:'D:/opencode/motor-progress/v2/sursum-api/programs/ContainersPainelFinanceReadService.p',sha256:'614795f3af80f29a51c467e8170f954540a76a8902034b9cf6186b1c328ac7b5'}];
 const paths=[manifest,sourceAddition,spec,addition.target,managerRelease,path.join(build,'release.json'),path.join(build,'php-full.xml'),...Object.values(proofPaths),path.join(__dirname,'purchase-payments-builder-common.cjs')];
 const plan={state:'PREPARED_OFFLINE_NOT_EXECUTED',productManifest:{path:manifest,sha256:PRODUCT_SHA},buildRelease:{path:managerRelease,sha256:sha(managerRelease)},inputs:paths.map(p=>({path:p,sha256:sha(p)})),dependencies,proofPaths,source:{code:source.code,baselinePath:addition.target,baselineSha256:addition.baselineSha256,before:144,after:146,operations:ops,preserveActualAuthenticationInMemory:true,replaceSanitizedSource:false},newProgram:{path:spec,sha256:sha(spec),programCode:'op1055',entityCode:'despesas_impostos_geral_progress',newEntity:true},parent:null,journal:path.join(dir,'publication-started.json'),normalizerProof:path.join(dir,'normalizer-proof.json'),offlineTests:path.join(dir,'offline-tests.json'),managerMetadataRelease:path.join(dir,'manager-metadata-release.json'),phases:['Readonly actual source/config and collision preflight','Atomic one-attempt journal before first catalog mutation','Append exactly two operations to an independent actual source clone; preserve actual auth and all144','Validate actual external draft after source registration','One new op1055/entity phase: same grant for both authoring locks before entity save; publish; finally release locks/revoke grant','Verify new native definition/owner and preserve all unrelated programs/entities'],partialAttempt:'No automatic rollback or generic resume. Any partial attempt needs observed current state and a new separately reviewed exact companion.',catalogMetadataWrites:'Only root executing reviewed publisher; preparation is offline',businessWrites:false,processRuns:false,humanPermissionsChanged:false,networkExecuted:false};
 verifyPlanInputs(plan);fs.mkdirSync(dir,{recursive:true});fs.writeFileSync(path.join(dir,'plan.json'),JSON.stringify(plan,null,2)+'\n',{flag:'wx'});console.log(JSON.stringify({success:true,state:plan.state,planSha256:sha(path.join(dir,'plan.json')),networkExecuted:false}));return plan;
}
module.exports={root,dir,build,product,PRODUCT_SHA,read,sha,clone,safe,invariantSource,sourceFromExport,assertOperations,appendOperations,assertSourceBaseline,assertSpec,assertProofContracts,verifyPlanInputs,prepare};
if(require.main===module)try{prepare();}catch{console.error('BUILD11_METADATA_PREPARATION_FAILED_INSPECT_INPUTS');process.exitCode=1;}
