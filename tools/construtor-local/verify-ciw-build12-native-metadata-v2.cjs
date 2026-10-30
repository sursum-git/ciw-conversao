'use strict';
// ROOT ONLY: closed catalog GETs + native read/get. No grants, authoring, layout writes or ERP direct calls.
const c=require('./purchase-payments-builder-common.cjs'),vm=require('node:vm'),crypto=require('node:crypto');
const prep=require('./prepare-ciw-completion-build12-metadata.cjs'),pub=require('./publish-ciw-completion-build12-metadata.cjs'),shape=require('./verify-ciw-build12-pasoe.cjs');
const DIR=c.path.join(c.root,'.runtime/ciw-completion-20261028/build12-native-metadata-verification-v2');
const META=c.path.join(c.root,'.runtime/ciw-completion-20261028/build12-metadata-publication-preparation');
const OFFICIAL=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build12-v3');
const RELEASE='ab37b22d9d02afed0897bc4e342aaf8cde25632f90b625139e2a69ae79cc2c31';
const SCREEN='ciw.container-nfs-disponiveis-med',ENTITY='container_nfs_disponiveis_med_progress';
const DECIMALS=['tot_valor','despesa_nota','valor_embal','valor_frete','valor_mercad','valor_outras','valor_seguro'];
const digest=v=>crypto.createHash('sha256').update(v).digest('hex');
function unwrapGet(value){
 // nf_key is the record discriminator. A physical field named data must never imply an envelope.
 if(value&&typeof value==='object'&&!Array.isArray(value)&&Object.hasOwn(value,'nf_key'))return value;
 if(value?.data&&typeof value.data==='object'&&!Array.isArray(value.data)&&Object.hasOwn(value.data,'nf_key'))return value.data;
 throw Error('NATIVE_GET_RECORD_WITH_NF_KEY_REQUIRED');
}
function guardProofs({release,releaseHash,publication,sourceApplied,builderHash,pasoe,pasoeHash}){
 c.assert.equal(releaseHash,RELEASE,'EXACT_MANAGER_METADATA_RELEASE_REQUIRED');c.assert.ok(release.success);
 c.assert.equal(builderHash,prep.BUILDER,'ACTUAL_BUILDER205_REQUIRED');c.assert.equal(release.builderSha256,builderHash);
 c.assert.ok(publication.success&&publication.financialOperations===6&&publication.oldFourPreserved&&publication.actualAuthenticationPreserved&&publication.businessWrites===false&&publication.processRuns===false&&publication.humanPermissionsChanged===false,'METADATA_PUBLICATION_REQUIRED');
 c.assert.equal(publication.builderSha256,builderHash);for(const[program,screen,version]of[['op1053',SCREEN,'1.0.0'],['op1000','ciw.containers','1.0.3']])c.assert.equal(publication.published.filter(p=>p.program===program&&p.screen===screen&&p.version===version).length,1);
 c.assert.ok(sourceApplied.success&&sourceApplied.before===4&&sourceApplied.after===6&&sourceApplied.oldFourPreserved&&sourceApplied.actualAuthenticationPreserved,'SOURCE_APPLICATION_PROOF_REQUIRED');
 c.assert.equal(pasoeHash,release.proofSha256['pasoe-paged-five-container-proof.json']);c.assert.ok(pasoe.success&&pasoe.checks===43&&pasoe.positiveGetAllFive&&pasoe.pagingAllFive&&pasoe.businessWrites===false&&pasoe.containers.length===5);c.assert.deepEqual(pasoe.containers.map(x=>x.container),shape.CIDS);
}
function currentBinding(program,entity,source,definition,baseline,plan){
 c.assert.equal(program.program.code,'op1053');c.assert.equal(program.program.screenId,SCREEN);
 const versions=program.versions.filter(v=>v.status==='published');c.assert.equal(versions.length,1);c.assert.equal(versions[0].version,'1.0.0');c.assert.equal(versions[0].builderEntityCode,ENTITY);
 c.assert.equal(entity.entity.code,ENTITY);c.assert.equal(entity.entity.apiSourceCode,plan.source.code);c.assert.equal(source.code,plan.source.code);c.assert.equal(source.operations.length,6);c.assert.equal(source.baseUrl,'http://127.0.0.1:19910/med/web');
 for(const key of['code','baseUrl','responseContract'])c.assert.deepEqual(source[key],baseline[key]);c.assert.deepEqual(prep.safe(source.operations.slice(0,4)),prep.safe(baseline.operations),'OLD_FINANCIAL4_CHANGED');
 pub.assertReadonlyDefinition(definition);c.assert.equal(definition.program.id,'op1053');c.assert.equal(definition.program.version,'1.0.0');c.assert.equal(definition.screenId,SCREEN);
 const result={};
 for(const[action,property,type]of[['read','apiListOperationCode','list'],['get','apiDetailOperationCode','detail']]){
  const code=entity.entity[property];c.assert.equal(typeof code,'string');const found=source.operations.filter(op=>op.code===code);c.assert.equal(found.length,1);const op=found[0],native=definition.dataSource.api[action];
  c.assert.equal(op.type,type);c.assert.equal(op.method,'POST');c.assert.equal(c.operationPath(source.baseUrl,op.path),'http://127.0.0.1:19910/med/web/SursumPrograms/containers-financeiro');c.assert.deepEqual(op.bodyTemplate,{operation:action,resource:'nfs-disponiveis'});c.assert.deepEqual(op.requestContextFields,['container_id']);
  c.assert.equal(native.endpointId,action);c.assert.equal(native.method,'POST');if(action==='read'){c.assert.equal(op.itemsPath,'data');c.assert.equal(op.totalPath,'total');}else c.assert.equal(op.itemPath,'data');
  result[action]={endpointId:native.endpointId,operationCode:code,type};
 }
 return result;
}
function requestGuard(endpointId,payload){
 c.assert.ok(['read','get'].includes(endpointId),'READ_GET_ONLY');c.assert.ok(payload&&typeof payload==='object'&&!Array.isArray(payload));
 c.assert.ok(Object.keys(payload).every(k=>['context','id','nf_key','take','skip','filter','sort'].includes(k)),'CLOSED_READ_PAYLOAD');
 const context=payload.context??{};c.assert.ok(context&&typeof context==='object'&&!Array.isArray(context));c.assert.ok(Object.keys(context).every(k=>k==='container_id'));
 if(Object.hasOwn(context,'container_id'))c.assert.ok(shape.CIDS.includes(context.container_id)||context.container_id===0,'OBSERVED_CONTEXTS_OR_ZERO_NEGATIVE_ONLY');
 if(endpointId==='read'){c.assert.ok(!Object.hasOwn(payload,'id')&&!Object.hasOwn(payload,'nf_key'));c.assert.ok(Number.isInteger(payload.take)&&payload.take>=1&&payload.take<=200);c.assert.ok(Number.isInteger(payload.skip)&&payload.skip>=0&&payload.skip<=50000);}
 else{c.assert.match(payload.id??'',/^nf_[A-F0-9]{64}$/);if(Object.hasOwn(payload,'nf_key'))c.assert.equal(payload.nf_key,payload.id);}
 if(payload.filter)c.assert.ok(['nf_key',...DECIMALS].includes(payload.filter.field)&&payload.filter.operator==='eq'&&Object.keys(payload.filter).every(k=>['field','operator','value'].includes(k)));
 if(payload.sort)c.assert.deepEqual(payload.sort,[{field:'nf_key',dir:'asc'}]);
}
function nativeValidator(definition){const s={console,URL,URLSearchParams,window:null,jQuery:()=>{throw Error('DOM_NOT_EXECUTED');},location:{href:c.base,origin:c.base}};s.window=s;vm.createContext(s);for(const name of['page-engine/PageDefinitionNormalizer','crud-engine/CrudUtils','crud-engine/CrudDefinitionValidator'])vm.runInContext(c.fs.readFileSync('D:/opencode/construtor-pg/src/'+name+'.js','utf8'),s);const normalized=new s.PageDefinitionNormalizer().normalize(definition);new s.CrudDefinitionValidator().validate(normalized);return true;}
async function main(){
 c.assert.deepEqual(process.argv.slice(2),['--verify-readonly'],'EXPLICIT_ROOT_VERIFY_READONLY_REQUIRED');
 c.assert.ok(!c.fs.existsSync(DIR),'PRESERVE_PREVIOUS_ATTEMPT_NO_REPLAY');
 const read=name=>c.readJson(c.path.join(META,name)),release=read('manager-metadata-release.json'),publication=read('metadata-publication.json'),plan=read('plan.json'),pasoeFile=c.path.join(OFFICIAL,'pasoe-paged-five-container-proof.json');
 guardProofs({release,releaseHash:c.sha(c.path.join(META,'manager-metadata-release.json')),publication,sourceApplied:read('source-applied.json'),builderHash:c.sha(plan.builder.path),pasoe:c.readJson(pasoeFile),pasoeHash:c.sha(pasoeFile)});
 c.assert.equal(c.sha(c.path.join(META,'plan.json')),release.planSha256);for(const[name,expected]of Object.entries(release.proofSha256))c.assert.equal(c.sha(c.path.join(OFFICIAL,name)),expected);
 c.fs.mkdirSync(DIR,{recursive:true});const attempts=[],results=[];let activeStep='metadata',bindings;
 const persist=(name,value)=>c.fs.writeFileSync(c.path.join(DIR,name),JSON.stringify(value,null,2)+'\n',{flag:'wx'});
 try{await c.session(async({api,runtime,login})=>{
  const allowed=new Set(['/programs/op1053','/entities/'+ENTITY,'/api-sources/'+plan.source.code]);const catalog=async url=>{c.assert.ok(allowed.has(url));return api(url);};
  const program=await catalog('/programs/op1053'),entity=await catalog('/entities/'+ENTITY),source=(await catalog('/api-sources/'+plan.source.code)).apiSource,definition=await runtime(SCREEN);
  bindings=currentBinding(program,entity,source,definition,c.readJson(plan.source.baselinePath).apiSource,plan);nativeValidator(definition);
  const parent=await runtime('ciw.containers');c.assert.equal(parent.program.version,'1.0.3');c.assert.equal(parent.crud.grid.rowLinks.filter(link=>link.screenId===SCREEN&&link.parameters.some(p=>p.field==='container_id'&&p.sourceField==='container_id')).length,1);
  const headers={'Content-Type':'application/json',Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
  async function call(action,payload,expected=200){
   const endpointId=bindings[action].endpointId;requestGuard(endpointId,payload);c.assert.ok([200,422].includes(expected));activeStep=action+'-'+(payload.context?.container_id??'missing');const started=Date.now();
   const response=await fetch(c.base+'/api/runtime/screens/'+SCREEN+'/endpoints/'+endpointId,{method:'POST',headers,body:JSON.stringify(payload),signal:AbortSignal.timeout(45000)}),raw=await response.text();let body;try{body=JSON.parse(raw);}catch{}
   const attempt={action,container:payload.context?.container_id??null,httpStatus:response.status,expectedStatus:expected,durationMs:Date.now()-started,responseSha256:digest(raw),responseBytes:Buffer.byteLength(raw),parsedJson:body!==undefined,error:body?.error?{code:body.error.code??null,message:String(body.error.message??'').slice(0,1500),status:body.error.status??null,details:prep.safe(body.error.details??null)}:null};
   attempts.push(attempt);persist('attempt-'+String(attempts.length).padStart(2,'0')+'.json',attempt); // Capture before HTTP/shape assertions.
   c.assert.equal(response.status,expected,'NATIVE_HTTP_STATUS');c.assert.ok(body&&typeof body==='object','NATIVE_JSON_REQUIRED');if(expected===422){c.assert.ok(body.error&&typeof body.error.code==='string');c.assert.ok(!Object.hasOwn(body,'data'));return body;}c.assert.ok(!body.error,'NATIVE_ERROR_RESPONSE');return body;
  }
  for(const cid of shape.CIDS){
   const context={container_id:cid},sort=[{field:'nf_key',dir:'asc'}],first=await call('read',{context,take:2,skip:0,sort});c.assert.ok(Number.isInteger(first.total)&&first.total>2&&first.total<=50000);c.assert.equal(first.data.length,2);first.data.forEach(row=>shape.row(row,cid));
   const second=await call('read',{context,take:2,skip:2,sort});c.assert.equal(second.total,first.total);c.assert.equal(second.data.length,2);second.data.forEach(row=>{shape.row(row,cid);c.assert.ok(!first.data.some(prior=>prior.nf_key===row.nf_key));});
   const selected=first.data[0],detail=unwrapGet(await call('get',{context,id:selected.nf_key,nf_key:selected.nf_key}));shape.row(detail,cid);c.assert.deepEqual(detail,selected);
   const filtered=await call('read',{context,take:2,skip:0,filter:{field:'nf_key',operator:'eq',value:selected.nf_key}});c.assert.equal(filtered.total,1);c.assert.deepEqual(filtered.data,[selected]);
   results.push({container:cid,observedTotal:first.total,read:true,get:true,identityFilter:true,secondPage:true});
   if(cid===332526){
    c.assert.ok(first.total>200,'OBSERVED_TOTAL_ABOVE_OLD_CAP_REQUIRED');const last=await call('read',{context,take:2,skip:first.total-2,sort});c.assert.equal(last.total,first.total);c.assert.equal(last.data.length,2);last.data.forEach(row=>shape.row(row,cid));const beyond=await call('read',{context,take:2,skip:first.total,sort});c.assert.equal(beyond.total,first.total);c.assert.deepEqual(beyond.data,[]);
    const field=DECIMALS.find(name=>typeof selected[name]==='number');if(field){const numeric=await call('read',{context,take:2,skip:0,filter:{field,operator:'eq',value:selected[field]}});c.assert.ok(numeric.total>=1);c.assert.ok(numeric.data.every(row=>row[field]===selected[field]));results[0].numericEqNative=true;}else results[0].numericEqNative=false;
    await call('get',{context:{},id:selected.nf_key},422);
   }
  }
  await call('read',{context:{},take:2,skip:0},422);await call('read',{context:{container_id:0},take:2,skip:0},422);
  const after=(await catalog('/api-sources/'+plan.source.code)).apiSource;c.assert.deepEqual(after.operations,source.operations,'SOURCE_OPERATIONS_CHANGED_DURING_RO');c.assert.deepEqual(pub.invariantSource(after),pub.invariantSource(source),'SOURCE_AUTH_MASK_OR_CONFIG_CHANGED_DURING_RO');
 },{readOnly:true});
 persist('runtime-read-proof.json',{success:true,observedAtUtc:new Date().toISOString(),toolSha256:c.sha(__filename),managerMetadataReleaseSha256:RELEASE,metadataPublicationSha256:c.sha(c.path.join(META,'metadata-publication.json')),builderSha256:prep.BUILDER,bindings,checks:attempts.length,results,definitionValidated:true,read:true,get:true,paging:true,filter:true,context:true,nativeDefinitionValidator:true,nfKeyUnwrap:true,decimalFilterMetadata:7,decimalFilterOperators:'eq',sourceOldFourPreserved:true,sourceSixOperations:true,publicationAuthenticationPreservationReceipt:true,sourceAuthenticationMasksAndConfigurationUnchangedDuringReadOnly:true,sourceAuthenticationValuesPrinted:false,parentContextLink:true,officialPasoe43ReusedAsPrerequisite:true,claimLimit:'Own native calls only; prior direct PASOE43 proof is a prerequisite, not re-executed or reclassified as UI/DOM evidence.',catalogWrites:false,businessWrites:false,grants:false,processRuns:false});
 console.log(JSON.stringify({success:true,proof:c.path.join(DIR,'runtime-read-proof.json'),checks:attempts.length,contexts:results.length,businessWrites:false}));
 }catch(error){persist('failure.json',{success:false,observedAtUtc:new Date().toISOString(),step:activeStep,message:String(error.message).slice(0,2000),checksAttempted:attempts.length,catalogWrites:false,businessWrites:false,noAutomaticRetry:true});throw Error('NATIVE_METADATA_VERIFICATION_FAILED_INSPECT_PRIVATE_RECEIPTS');}
}
module.exports={unwrapGet,guardProofs,currentBinding,requestGuard,nativeValidator,main,RELEASE};
if(require.main===module)main().catch(()=>{console.error('BUILD12_NATIVE_RO_NOT_CONFIRMED; inspect prerequisites/private receipts; no automatic replay.');process.exitCode=1;});
