'use strict';
// Closed catalog GETs only. Sanitized DTOs are evidence, never authentication input.
const c=require('./purchase-payments-builder-common.cjs');
const redact=require('./export-ciw-container-item-action-current.cjs').safe;
const dir=c.path.join(c.root,'.runtime/ciw-completion-20261028/build13-metadata-fresh');
function safe(value){
 value=redact(value);
 const clean=v=>Array.isArray(v)?v.map(clean):v&&typeof v==='object'?Object.fromEntries(Object.entries(v).filter(([key])=>key!=='governance').map(([key,item])=>[key,clean(item)])):v;
 return clean(value);
}
async function main(){
 c.assert.deepEqual(process.argv.slice(2),['--export-readonly']);
 c.assert.ok(!c.fs.existsSync(dir),'PRESERVE_PRIOR_EXPORT_NO_REPLAY');
 const builder='D:/opencode/construtor-pg/backend/src/Builder/ProgramBuilderService.php';
 c.assert.equal(c.sha(builder),'205ebd14329f8e8896d07c07716939db8a12d58345fecf76cab5252f4e0694a7');
 await c.session(async({api})=>{
  const source=await api('/api-sources/motor_progress_ciw_cadastros');
  const parent=await api('/programs/op1005');
  c.assert.equal(source.apiSource.code,'motor_progress_ciw_cadastros');
  c.assert.equal(source.apiSource.baseUrl,'http://127.0.0.1:19910/med/web');
  c.assert.equal(source.apiSource.operations.length,146);
  c.assert.equal(parent.program.code,'op1005');c.assert.equal(parent.program.screenId,'ciw.container-versoes-custo');
  const published=parent.versions.filter(x=>x.status==='published');
  c.assert.equal(published.length,1);c.assert.equal(published[0].version,'1.0.2');
  const entityCode=published[0].builderEntityCode;c.assert.match(entityCode,/^[a-z][a-z0-9_]+$/);
  const entity=await api('/entities/'+entityCode);c.assert.equal(entity.entity.code,entityCode);
  c.fs.mkdirSync(dir);const files=[];
  for(const[name,value]of [['source-current.json',source],['op1005-current.json',parent],['parent-entity-current.json',entity]]){
   const path=c.path.join(dir,name);c.fs.writeFileSync(path,JSON.stringify(safe(value),null,2)+'\n',{flag:'wx'});files.push({path,sha256:c.sha(path)});
  }
  const proof={success:true,observedAtUtc:new Date().toISOString(),toolSha256:c.sha(__filename),files,sourceOperations:146,parentProgram:'op1005',parentScreen:'ciw.container-versoes-custo',parentVersion:'1.0.2',parentEntityCode:entityCode,builderSha256:c.sha(builder),catalogGets:3,sourceAuthenticationInMemoryOnly:true,sanitizedDtoNeverAuthenticationInput:true,authHeadersOmittedRecursively:true,sensitivePropertiesRedacted:true,governanceExcluded:true,catalogWrites:false,erpCalls:false,businessWrites:false};
  const file=c.path.join(dir,'export-proof.json');c.fs.writeFileSync(file,JSON.stringify(proof,null,2)+'\n',{flag:'wx'});
  console.log(JSON.stringify({success:true,proof:file,proofSha256:c.sha(file),sourceOperations:146,parentVersion:'1.0.2',parentEntityCode:entityCode,catalogWrites:false,businessWrites:false}));
 },{readOnly:true});
}
module.exports={safe,main};
if(require.main===module)main().catch(()=>{console.error('BUILD13_METADATA_EXPORT_FAILED_INSPECT_READONLY_STATE_NO_MUTATION');process.exitCode=1;});
