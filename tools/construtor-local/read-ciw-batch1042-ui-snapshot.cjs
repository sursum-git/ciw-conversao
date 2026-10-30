'use strict';
// Root-only fixed readonly observation around a real native grid edit/cancel.
const c=require('./purchase-payments-builder-common.cjs'),e=require('./exercise-ciw-batch1042.cjs');
const dir=c.path.join(c.root,'.runtime/ciw-completion-20261028/batch1042-exercise');
async function main(){
 const mode=process.argv.find(x=>x.startsWith('--mode='))?.slice(7);c.assert.ok(['before','after'].includes(mode),'CLOSED_UI_OBSERVATION_MODE');
 const statePath=c.path.join(dir,'state.json'),state=c.readJson(statePath),stateSha=c.sha(statePath);c.assert.equal(state.pending,null);c.assert.deepEqual(state.steps,['create-header','create-A','create-B']);
 const target=c.path.join(dir,'ui-'+mode+'.json');c.assert.ok(!c.fs.existsSync(target),'UI_OBSERVATION_ALREADY_EXISTS_NO_REPLAY');
 const observedAt=new Date().toISOString();
 await c.session(async({runtime})=>{
  const def=await runtime('ciw.container-despesas-lote');c.assert.equal(def.program.id,'op1042');c.assert.equal(def.program.version,'1.0.0');c.assert.deepEqual(def.crud.grid.editing.snapshot.originalFields,e.FIELDS);
  const result=await runtime('ciw.container-despesas-lote/endpoints/read',{context:{container_id:e.CID},take:200,skip:0});const own=e.alive(state,'despesas_container');c.assert.equal(result.total,own.length);c.assert.equal(result.data.length,own.length);c.assert.ok(own.length<=22);
  const rows=result.data.map(e.original).sort((a,b)=>a.despesa_container_id-b.despesa_container_id);c.assert.equal(new Set(rows.map(x=>x.despesa_container_id)).size,rows.length);
  for(const row of rows)c.assert.deepEqual(e.canonical(row),e.canonical(state.owned.despesas_container[row.despesa_container_id]?.image),'UI_OBSERVATION_REQUIRES_EXACT_OWNED_IMAGES');
  c.assert.equal(c.sha(statePath),stateSha,'OWNED_STATE_CHANGED_DURING_UI_OBSERVATION');
  if(mode==='after'){const before=c.readJson(c.path.join(dir,'ui-before.json'));c.assert.equal(before.ownedStateSha256,stateSha);c.assert.deepEqual(rows,before.rows,'NATIVE_UI_CANCEL_CHANGED_DATA');}
  c.fs.writeFileSync(target,JSON.stringify({success:true,mode,screen:'ciw.container-despesas-lote',containerId:e.CID,programVersion:'1.0.0',observedAt,completedAt:new Date().toISOString(),ownedStateSha256:stateSha,rows,businessWrites:false,networkRequests:'read/get only; this tool does not attest browser traffic or UI actions'},null,2)+'\n',{flag:'wx'});
  console.log('PASS readonly1042 UI '+mode+' full14 observation; browser action/network proof separate');
 });
}
if(require.main===module)main().catch(()=>{console.error('CIW1042_UI_READONLY_OBSERVATION_STOPPED');process.exitCode=1;});
