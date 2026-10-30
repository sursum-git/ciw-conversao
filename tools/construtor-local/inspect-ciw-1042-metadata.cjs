'use strict';
// Read-only catalog preflight for the newly authorized, bounded 1042 scenario.
const c=require('./purchase-payments-builder-common.cjs');
const s=c.path.join(c.root,'.runtime/ciw-completion-20261028/batch1042-metadata');
const safe=v=>Array.isArray(v)?v.map(safe):v&&typeof v==='object'?Object.fromEntries(Object.entries(v).map(([k,x])=>[k,k==='authHeaders'?[]:safe(x)])):v;
async function main(){
 c.fs.mkdirSync(s,{recursive:true});c.assert.ok(!c.fs.existsSync(c.path.join(s,'preflight.json')));
 const authorization=c.readJson(c.path.join(c.root,'.runtime/ciw-completion-20261028/container-expense-batch-preflight/human-authorization-20261028.json'));
 c.assert.equal(authorization.containerId,2147000110);c.assert.equal(authorization.consumed,false);
 await c.session(async({api})=>{
  const boot=await api('/bootstrap'),parent=await api('/programs/op1003');
  c.assert.equal(boot.programs.filter(x=>(x.programCode??x.code)==='op1042').length,0,'Inspect existing1042 before any mutation');
  c.assert.equal(boot.entities.filter(x=>x.code==='container_despesas_lote_progress').length,0,'Inspect existing entity before mutation');
  const published=parent.versions.filter(x=>x.status==='published');c.assert.equal(published.length,1);c.assert.equal(published[0].builderConfig.version,'1.0.4');
  c.fs.writeFileSync(c.path.join(s,'parent-before.json'),JSON.stringify(safe(parent),null,2)+'\n');
  c.fs.writeFileSync(c.path.join(s,'bootstrap-before.json'),JSON.stringify(safe(boot),null,2)+'\n');
  const source=await api('/api-sources/motor_progress_container_despesas');
  c.assert.ok(source.apiSource);c.assert.equal(source.apiSource.baseUrl,'http://127.0.0.1:19910/med/web');
  c.fs.writeFileSync(c.path.join(s,'expense-source-before-sanitized.json'),JSON.stringify(safe(source.apiSource),null,2)+'\n');
  c.fs.writeFileSync(c.path.join(s,'preflight.json'),JSON.stringify({success:true,readOnly:true,parentVersion:'1.0.4',parentFileSha256:c.sha(c.path.join(s,'parent-before.json')),program1042Absent:true,entity1042Absent:true,existingSourceAuthHeaderNames:Object.keys(source.apiSource.authHeaders??{}),businessWrites:false,catalogWrites:false},null,2)+'\n');
  console.log('PASS1042 readonly metadata preflight; no catalog/business writes');
 });
}
main().catch(e=>{console.error('1042_METADATA_PREFLIGHT_FAILED '+e.message);process.exitCode=1;});
