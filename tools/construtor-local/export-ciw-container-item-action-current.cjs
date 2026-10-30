'use strict';
// Root-only execution. Closed metadata GETs; no runtime/ERP request or catalog mutation.
const c=require('./purchase-payments-builder-common.cjs');
const DIR=c.path.join(c.root,'.runtime/ciw-completion-20261028/container-item-action-native/current');
const TARGETS=[['op1008','ciw.container-custos-itens'],['op1002','ciw.container-itens']];
const sensitive=new Set(['authorization','password','passwd','secret','clientsecret','token','accesstoken','refreshtoken','apikey','credentials','credential','cookie','setcookie','xruntimeauthtoken','xcontainerstoken']);
function safe(value){
 if(Array.isArray(value))return value.map(safe);
 if(value&&typeof value==='object')return Object.fromEntries(Object.entries(value).filter(([key])=>!['authheaders','headers'].includes(key.replace(/[^a-z0-9]/gi,'').toLowerCase())).map(([key,item])=>[key,sensitive.has(key.replace(/[^a-z0-9]/gi,'').toLowerCase())?'[REDACTED]':safe(item)]));
 if(typeof value==='string'&&/^https?:\/\//i.test(value)){
  try{const url=new URL(value);if(url.username||url.password){url.username='REDACTED';url.password='REDACTED';}for(const key of url.searchParams.keys())url.searchParams.set(key,'REDACTED');return url.toString();}catch{throw Error('INVALID_METADATA_URL');}
 }
 return value;
}
function published(program,screen){
 c.assert.equal(program?.program?.screenId,screen,'PROGRAM_SCREEN_MISMATCH');
 const versions=(program.versions??[]).filter(v=>v.status==='published');
 c.assert.equal(versions.length,1,'EXACTLY_ONE_CURRENT_PUBLISHED_VERSION_REQUIRED');
 const version=versions[0];c.assert.equal(version.screenId,screen,'VERSION_SCREEN_MISMATCH');
 c.assert.match(version.builderEntityCode??'',/^[a-z][a-z0-9_]*$/,'ENTITY_CODE_REQUIRED');return version;
}
async function collect(api){
 const bootstrap=await api('/bootstrap');
 const matches=(bootstrap.programs??[]).filter(p=>p.screenId==='ciw.proc-compra-itens');
 c.assert.equal(matches.length,1,'UNIQUE_PURCHASE_ITEMS_PROGRAM_REQUIRED');
 const purchaseCode=matches[0].programCode??matches[0].code;c.assert.match(purchaseCode??'',/^(?:op|cd)[0-9]{4}$/,'CLOSED_PROGRAM_CODE_REQUIRED');
 const targets=TARGETS.concat([[purchaseCode,'ciw.proc-compra-itens']]);
 c.assert.equal(new Set(targets.map(t=>t[0])).size,3,'PROGRAM_COLLISION');
 const documents=[],bindings=[],sources=new Map();
 for(const [code,screen]of targets){
  const program=await api('/programs/'+code);c.assert.equal(program.program.code,code,'PROGRAM_CODE_MISMATCH');
  const version=published(program,screen),entityCode=version.builderEntityCode;
  const entity=await api('/entities/'+entityCode);c.assert.equal(entity?.entity?.code,entityCode,'ENTITY_CODE_MISMATCH');
  const sourceCode=entity.entity.apiSourceCode;c.assert.match(sourceCode??'',/^motor_progress_[a-z0-9_]+$/,'SOURCE_CODE_REQUIRED');
  documents.push([code+'-program.json',safe(program)],[entityCode+'-entity.json',safe(entity)]);
  bindings.push({programCode:code,screenId:screen,version:version.version,entityCode,sourceCode});
  if(!sources.has(sourceCode)){
   const source=await api('/api-sources/'+sourceCode);c.assert.equal(source?.apiSource?.code,sourceCode,'SOURCE_CODE_MISMATCH');
   c.assert.ok(Array.isArray(source.apiSource.operations),'OPERATIONS_REQUIRED');
   sources.set(sourceCode,{operationCount:source.apiSource.operations.length});documents.push(['source-'+sourceCode+'.json',safe(source)]);
  }
 }
 return {documents,bindings,sourceCodes:Array.from(sources.keys()),sourceOperationCounts:Object.fromEntries(Array.from(sources,([key,item])=>[key,item.operationCount])),metadataGets:1+targets.length*2+sources.size};
}
async function main(){
 c.assert.deepEqual(process.argv.slice(2),['--export-readonly'],'REQUIRES_EXPLICIT_ROOT_EXPORT_READONLY');
 c.assert.ok(!c.fs.existsSync(DIR),'EXPORT_ALREADY_EXISTS_NO_REPLAY');c.fs.mkdirSync(DIR,{recursive:true});
 await c.session(async({api})=>{
  const result=await collect(api),files=[];
  for(const[name,data]of result.documents){const file=c.path.join(DIR,name);c.fs.writeFileSync(file,JSON.stringify(data,null,2)+'\n',{flag:'wx'});files.push({path:file,sha256:c.sha(file)});}
  const proof={success:true,observedAtUtc:new Date().toISOString(),toolSha256:c.sha(__filename),sessionHelperSha256:c.sha(c.path.join(__dirname,'purchase-payments-builder-common.cjs')),bindings:result.bindings,sourceCodesDerivedFromCurrentEntities:result.sourceCodes,sourceOperationCounts:result.sourceOperationCounts,metadataGets:result.metadataGets,allNestedAuthHeadersOmitted:true,sensitivePropertiesRedacted:true,sourceAuthenticationInMemoryOnly:true,doNotReplaceActualAuthenticationFromSanitizedDto:true,catalogWrites:false,runtimeCalls:false,erpCalls:false,businessWrites:false,files};
  const file=c.path.join(DIR,'export-proof.json');c.fs.writeFileSync(file,JSON.stringify(proof,null,2)+'\n',{flag:'wx'});
  console.log(JSON.stringify({success:true,path:DIR,proofSha256:c.sha(file),files:files.length,metadataGets:result.metadataGets,catalogWrites:false,businessWrites:false}));
 },{readOnly:true});
}
module.exports={safe,published,collect,main};
if(require.main===module)main().catch(()=>{console.error('READONLY_METADATA_EXPORT_FAILED; preserve folder; inspect privately; no automatic retry.');process.exitCode=1;});
