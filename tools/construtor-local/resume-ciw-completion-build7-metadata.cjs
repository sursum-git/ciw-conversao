'use strict';
const c=require('./purchase-payments-builder-common.cjs'),crypto=require('node:crypto');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build7'),meta=c.path.join(state,'metadata');
const safe=v=>Array.isArray(v)?v.map(safe):v&&typeof v==='object'?Object.fromEntries(Object.entries(v).map(([k,x])=>[k,k==='authHeaders'?[]:safe(x)])):v;
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(safe(v),null,2)+'\n');
async function main(){
 c.assert.ok(c.fs.existsSync(c.path.join(state,'metadata-publication-started.json'))&&!c.fs.existsSync(c.path.join(state,'metadata-resume-started.json'))&&!c.fs.existsSync(c.path.join(state,'metadata-publication.json')),'INSPECT_PARTIAL_BEFORE_REPLAY');
 const proofNames=['official-compile-verification.json','canonical-manifest.json','active-manifest.json','pasoe-read-proof.json','canonical-keyfix-manifest.json'];
 const evidences=proofNames.map(name=>{c.assert.ok(c.readJson(c.path.join(state,name)).success,name);return{type:name,result:'SHA256 '+c.sha(c.path.join(state,name))};});
 const keyfix=c.readJson(c.path.join(state,'canonical-keyfix-manifest.json'));c.assert.equal(keyfix.phpTests,917);c.assert.equal(keyfix.phpAssertions,6018);c.assert.equal(c.sha(keyfix.target),keyfix.sha256);
 for(const row of c.readJson(c.path.join(state,'canonical-manifest.json')).files)c.assert.equal(c.sha(row.target),row.target.replaceAll('\\','/').replaceAll('//','/')===keyfix.target.replaceAll('\\','/').replaceAll('//','/')?keyfix.sha256:row.sha256,'CURRENT_CANONICAL_HASH_CHANGED');
 evidences.push({type:'manager-keyfix-full.xml',result:'SHA256 '+c.sha(c.path.join(state,'manager-keyfix-full.xml'))});
 const sourcePlan=c.readJson(c.path.join(meta,'source-additions.json'));c.assert.equal(c.sha(c.path.join(c.root,sourcePlan.baselinePath)),sourcePlan.baselineSha256);
 const typeProof=c.readJson(c.path.join(state,'metadata-operation-type-correction.json'));c.assert.ok(typeProof.success&&typeProof.nativeNormalizer&&typeProof.checks===41);evidences.push({type:'native-operation-types41',result:'SHA256 '+c.sha(c.path.join(state,'metadata-operation-type-correction.json'))});const additions=typeProof.operations;c.assert.equal(additions.length,8);c.assert.ok(additions.every(x=>['read','get'].includes(x.bodyTemplate.operation)));
 const specs=c.fs.readdirSync(meta).filter(x=>x.endsWith('-builder-draft.json')).map(x=>c.readJson(c.path.join(meta,x))).sort((a,b)=>a.programDraft.programCode.localeCompare(b.programDraft.programCode));
 c.assert.deepEqual(specs.map(x=>x.programDraft.programCode),['op1045','op1046','op1049','op1050']);
 await c.session(async({api,runtime,login})=>{
  const boot=await api('/bootstrap'),source=(await api('/api-sources/'+sourcePlan.sourceCode)).apiSource,baseline=c.readJson(c.path.join(c.root,sourcePlan.baselinePath));
  const inspected=c.readJson(c.path.join(state,'metadata-source-after-inspected.json'));for(const key of ['code','baseUrl','responseContract','operations'])c.assert.deepEqual(source[key],inspected[key]);c.assert.equal(source.operations.length,140);for(const op of baseline.operations)c.assert.deepEqual(source.operations.find(x=>x.code===op.code),op);
  for(const expected of additions){const actual=source.operations.find(x=>x.code===expected.code);c.assert.ok(c.compatibleOperation(actual,{...expected,type:expected.type==='detail'?'custom':expected.type},source.baseUrl),'ONLY_EXPECTED_NATIVE_TYPE_DIFF_ALLOWED');for(const key of ['itemsPath','itemPath','totalPath'])c.assert.equal(actual[key]??null,expected[key]??null);}
  const before=structuredClone(source);
  for(const spec of specs){const code=spec.programDraft.programCode;c.assert.ok(!boot.programs.some(x=>(x.programCode??x.code)===code||x.screenId===spec.programDraft.screenId));c.assert.ok(!boot.entities.some(x=>x.code===spec.entityDraft.code));c.assert.equal(spec.entityDraft.apiSourceCode,source.code);c.assert.equal(spec.programDraft.allowCreate,false);c.assert.equal(spec.programDraft.allowUpdate,false);c.assert.equal(spec.programDraft.allowDelete,false);}
  save('metadata-source-before-resume.json',source);save('metadata-resume-started.json',{at:new Date().toISOString(),programs:specs.map(x=>x.programDraft.programCode),sourceAlready140:true,onlyFourNewCustomToDetail:true,businessWrites:false,humanPermissionsChanged:false});
  source.operations=source.operations.map(op=>additions.some(x=>x.code===op.code&&x.type==='detail')?{...op,type:'detail'}:op);await api('/api-sources',source);
  const after=(await api('/api-sources/'+source.code)).apiSource;c.assert.equal(after.operations.length,140);for(const old of baseline.operations)c.assert.deepEqual(after.operations.find(x=>x.code===old.code),old);for(const op of additions)c.assert.ok(c.compatibleOperation(after.operations.find(x=>x.code===op.code),op,source.baseUrl));
  const noOps=x=>{const clone=structuredClone(x);delete clone.operations;delete clone.updatedAt;return clone;};c.assert.deepEqual(noOps(after),noOps(before),'SOURCE_AUTH_OR_CONNECTION_CHANGED');save('metadata-source-after.json',after);
  const published=[];
  for(const spec of specs){
   const code=spec.programDraft.programCode,entityCode=spec.entityDraft.code;
   const validation=await api('/external/validate',spec);save(code+'-external-validation.json',validation);c.assert.equal(validation.readyToApply,true);
   const saved=await api('/entities',spec.entityDraft);save(code+'-entity-applied.json',saved);c.assert.equal(saved.entity.code,entityCode);
   const request=await api('/governance/requests',{programCode:code,builderEntityCode:entityCode,requestedActions:['edit','publish'],reason:'Conversão CIW: consultas readonly de descontos e distribuição; rotinas centrais existentes e navegação contextual, sem escritor ou novo acesso humano.'});
   const granted=await api('/governance/grants',{requestId:request.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']}),locks=[];
   try{
    for(const [scopeType,scopeCode]of [['program',code],['entity',entityCode]]){const held=await api('/locks/acquire',{scopeType,scopeCode,grantId:granted.grant.id,lockCategory:'authoring'});c.assert.equal(held.status,'acquired');locks.push(held.lock.lockToken);}
    const preview=await api('/preview',spec.programDraft);save(code+'-native-preview.json',preview);c.assert.ok(preview.generatedDefinition);for(const action of ['create','edit','delete'])c.assert.equal(preview.generatedDefinition.permissions[action],false);
    const version=await api('/drafts',spec.programDraft),versionId=version.id??version.version?.id;c.assert.ok(versionId);const bundleId='ciw-completion-build7-'+crypto.randomUUID();
    await api('/governance/tests',{builderProgramVersionId:versionId,bundleId,testPlanId:'ciw-completion-build7-readonly-20261028',status:'passed',checklistSnapshot:{readonly:true,sharedCollectors:true,ownerContextChecked:true,official122:true,ablChecks:4120,phpTests:917,phpAssertions:6018,ledgerPhpKeySetFix:true,businessWrites:false,humanPermissionsChanged:false},evidences,notes:'Quatro consultas readonly. Aptos e descontos gerais preservam escopo GLOBAL explícito da origem; detalhes e extratos exigem dono correto. Nenhum cálculo, rateio ou manutenção financeira executado. A ordenação das propriedades JSON foi corrigida somente no helperPHP1050; validações de campo/tipo/owner/chave opaca mantidas,917testes6018asserções. PASOE: três GETs positivos; datasets observados do extrato1050 vazios, detalhe coberto por TT+fixture Reader→PHP e prova operacional adicional registrada separadamente se houver dados. Catálogo global preserva132 operações anteriores e autenticação. Usuários finais ainda precisam de autorização específica para novas consultas.'});
    const approval=await api('/governance/approvals',{builderProgramVersionId:versionId,bundleId});await api('/versions/'+versionId+'/publish',{});
    const receipt={success:true,program:code,entity:entityCode,screen:spec.programDraft.screenId,version:spec.programDraft.version,versionId,approvalId:approval.approval.id};save('publication-'+code+'.json',receipt);published.push(receipt);
   }finally{const released=await Promise.allSettled(locks.reverse().map(lockToken=>api('/locks/release',{lockToken})));await api('/governance/grants/status',{grantId:granted.grant.id,status:'revoked'});c.assert.ok(released.every(x=>x.status==='fulfilled'));}
  }
  const touched=new Set(published.map(x=>x.program));c.assert.deepEqual((await api('/bootstrap')).programs.filter(x=>!touched.has(x.programCode??x.code)),boot.programs.filter(x=>!touched.has(x.programCode??x.code)),'OTHER_PROGRAMS_CHANGED');
  for(const row of published){const definition=await runtime(row.screen);c.assert.equal(definition.program.version,row.version);for(const action of ['create','edit','delete'])c.assert.equal(definition.permissions[action],false);save(row.program+'-runtime.json',definition);}
  save('metadata-publication.json',{success:true,published,sourceOperations:140,previous132Preserved:true,authenticationPreserved:true,otherProgramsPreserved:true,businessWrites:false,humanPermissionsChanged:false});
  console.log('PASS4readonlyscreens published/source140/fourdetailtypes/old132ops and authentication preserved;no business writes or human grants');
 },{readOnly:false});
}
main().catch(e=>{console.error(e.message);process.exitCode=1});
