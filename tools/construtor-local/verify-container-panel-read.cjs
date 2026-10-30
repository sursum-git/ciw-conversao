'use strict';
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const root=path.resolve(__dirname,'../..'),privateRoot=path.join(root,'.runtime/construtor-pg');
const connection=JSON.parse(fs.readFileSync(path.join(privateRoot,'containers-connection.json'),'utf8').replace(/^\uFEFF/,''));
const base='http://127.0.0.1:19910/med/web/SursumPrograms/';
const evidence={checks:[],businessWrites:false};
async function call(route,body,token=connection.integrationToken){
 const response=await fetch(base+route,{method:'POST',headers:{'Content-Type':'application/json',...(token?{'X-Containers-Token':token}:{})},body:JSON.stringify(body)});
 return {status:response.status,body:await response.json()};
}
function ok(result){assert.equal(result.status,200,JSON.stringify(result.body));assert.equal(result.body.success,true,JSON.stringify(result.body));return result.body.data;}
(async()=>{
 for(const token of [null,'incorrect-token-'.repeat(3)]){
  const r=await call('containers-painel',{operation:'read',resource:'painel',container_id:331126},token);
  assert.equal(r.body.success,false);assert.equal(r.body.error.status,401);evidence.checks.push('auth denied');
 }
 const containers=ok(await call('containers-consulta',{operation:'read'}));
 assert.equal(containers.length,2393);
 const probe=JSON.parse(fs.readFileSync(path.join(root,'.runtime/container-panel-calculator-compiled-20261016/container-panel-samples.json'),'utf8').replace(/^\uFEFF/,''));
 const samples=[...new Set([331126,containers.find(row=>row.container_id!==331126&&String(row.cod_estabel).startsWith('5')).container_id,...['itens','versoes','anexos'].map(resource=>probe[resource][0].container_id)])];
 evidence.containers=samples;evidence.resources={};
 for(const container_id of samples){
  const counts={};
  for(const resource of ['painel','itens','despesas','anexos','versoes']){
   const rows=ok(await call('containers-painel',{operation:'read',resource,container_id}));
   assert.ok(Array.isArray(rows));assert.ok(rows.every(row=>row.container_id===container_id));
   const key={painel:'container_id',itens:'item_container_id',despesas:'despesa_container_id',anexos:'anexo_container_id',versoes:'versao_id'}[resource];
   counts[resource]=rows.length;
   if(rows.length){
    const first=rows[0];
    const detail=ok(await call('containers-painel',{operation:'get',resource,container_id,id:first[key],[key]:first[key]}));
    assert.deepEqual(detail,first);
    assert.ok(!Object.hasOwn(detail,'caminho_arquivo'));
    if(resource!=='painel'){
     const wrong=await call('containers-painel',{operation:'get',resource,container_id:samples.find(v=>v!==container_id),id:first[key]});
     assert.equal(wrong.body.success,false);assert.equal(wrong.body.error.status,404);evidence.checks.push('child scope '+resource);
    }
   }
   evidence.checks.push('read/get '+resource+' '+container_id);
  }
  evidence.resources[container_id]=counts;
 }
 for(const resource of ['itens','versoes','anexos'])assert.ok(Object.values(evidence.resources).some(counts=>counts[resource]>0),'Non-empty fixture '+resource);
 for(const body of [
  {operation:'read',resource:'painel'}, {operation:'read',resource:'itens',container_id:'1 OR TRUE'},
  {operation:'read',resource:'itens',container_id:0}, {operation:'read',resource:'itens',container_id:331126,table:'foo'},
  {operation:'create',resource:'painel',container_id:331126}, {operation:'update',resource:'painel',container_id:331126},
  {operation:'delete',resource:'painel',container_id:331126}, {operation:'read',resource:'unknown',container_id:331126},
 ]){const r=await call('containers-painel',body);assert.equal(r.body.success,false);assert.equal(r.body.error.status,422,JSON.stringify(r.body));evidence.checks.push('invalid input rejected');}
 const missing=await call('containers-painel',{operation:'get',resource:'painel',container_id:2147483647,id:2147483647});assert.equal(missing.body.success,false);assert.equal(missing.body.error.status,404);
 const after=ok(await call('containers-consulta',{operation:'read'}));assert.deepEqual(after,containers);
 evidence.checks.push('master dataset preserved');
 fs.writeFileSync(path.join(privateRoot,'container-panel-pasoe-evidence.json'),JSON.stringify(evidence,null,2)+'\n');
 console.log('PASS: '+evidence.checks.length+' checks PASOE12.2 painel readonly, scoped read/get, auth and rejected writes.');
 console.log(JSON.stringify({containers:samples,counts:evidence.resources}));
})().catch(error=>{console.error(error.message);process.exitCode=1;});
