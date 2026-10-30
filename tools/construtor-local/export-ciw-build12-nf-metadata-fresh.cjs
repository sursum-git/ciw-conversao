'use strict';
// Readonly fresh exports. Authentication/lock tokens are never written.
const c=require('./purchase-payments-builder-common.cjs');
const dir=c.path.join(c.root,'.runtime/ciw-completion-20261028/build12-nf-metadata-fresh');
function safe(value){
 if(Array.isArray(value))return value.map(safe);
 if(value&&typeof value==='object')return Object.fromEntries(Object.entries(value).filter(([k])=>k!=='governance').map(([k,v])=>[k,k==='authHeaders'?[]:/password|secret|token|credential/i.test(k)?'[REDACTED]':safe(v)]));
 return value;
}
async function main(){
 c.assert.ok(!c.fs.existsSync(dir),'FRESH_EXPORT_EXISTS_DO_NOT_OVERWRITE');
 c.assert.equal(c.sha('D:/opencode/construtor-pg/backend/src/Builder/ProgramBuilderService.php'),'205ebd14329f8e8896d07c07716939db8a12d58345fecf76cab5252f4e0694a7');
 await c.session(async({api})=>{
  const source=await api('/api-sources/motor_progress_container_financeiro'),parent=await api('/programs/op1000');
  c.assert.equal(source.apiSource.code,'motor_progress_container_financeiro');c.assert.equal(source.apiSource.operations.length,4);c.assert.equal(source.apiSource.baseUrl,'http://127.0.0.1:19910/med/web');
  const published=parent.versions.filter(x=>x.status==='published');c.assert.equal(published.length,1);c.assert.equal(published[0].version,'1.0.2');
  c.fs.mkdirSync(dir);const files=[];
  for(const[name,value]of [['source-current.json',source],['op1000-current.json',parent]]){const file=c.path.join(dir,name);c.fs.writeFileSync(file,JSON.stringify(safe(value),null,2)+'\n',{flag:'wx'});files.push({path:file,sha256:c.sha(file)});}
  c.fs.writeFileSync(c.path.join(dir,'export-proof.json'),JSON.stringify({success:true,observedAtUtc:new Date().toISOString(),files,sourceOperations:4,parentVersion:'1.0.2',builderSha256:c.sha('D:/opencode/construtor-pg/backend/src/Builder/ProgramBuilderService.php'),sensitivePropertiesRedacted:true,authHeadersRemoved:true,governanceExcludedFromContract:true,catalogWrites:false,businessWrites:false},null,2)+'\n',{flag:'wx'});
  console.log(JSON.stringify({success:true,files,sourceOperations:4,parentVersion:'1.0.2',catalogWrites:false,businessWrites:false}));
 });
}
if(require.main===module)main().catch(()=>{console.error('FRESH_NF_METADATA_EXPORT_FAILED; inspect readonly result, no mutation attempted');process.exitCode=1;});
module.exports={safe,main};
