'use strict';
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const root=path.resolve(__dirname,'../..'),privateRoot=path.join(root,'.runtime/construtor-pg');
const token=JSON.parse(fs.readFileSync(path.join(privateRoot,'containers-connection.json'),'utf8').replace(/^\uFEFF/,'')).integrationToken;
const base='http://127.0.0.1:19910/med/web/SursumPrograms/';
const evidence={at:new Date().toISOString(),businessWrites:false,checks:[],samples:{}};
const availableOnly=process.argv.includes('--available');
const requiredResources=availableOnly?['comparativos','rastro']:['itens','resumo','comparativos','rastro'];
const evidenceName=availableOnly?'container-cost-available-pasoe-evidence.json':'container-cost-pasoe-evidence.json';
async function call(route,body,credential=token){const start=Date.now();const response=await fetch(base+route,{method:'POST',headers:{'Content-Type':'application/json',...(credential?{'X-Containers-Token':credential}:{})},body:JSON.stringify(body)});return {status:response.status,body:await response.json(),elapsedMs:Date.now()-start};}
function ok(r){assert.equal(r.status,200);assert.equal(r.body.success,true,JSON.stringify(r.body));return r.body.data;}
function denied(r,status){assert.equal(r.body.success,false);assert.equal(r.body.error.status,status,JSON.stringify(r.body));}
(async()=>{
 for(const credential of [null,'invalid-token-'.repeat(4)]){denied(await call('containers-custos',{operation:'read',resource:'itens',container_id:332526},credential),401);evidence.checks.push('auth');}
 const before=ok(await call('containers-consulta',{operation:'read'}));const valid={};
 for(const container_id of [331126,331626,332526,333426,200019]){
  evidence.samples[container_id]={};
  for(const resource of ['itens','resumo','comparativos','rastro']){
   const result=await call('containers-custos',{operation:'read',resource,container_id});
   if(!result.body.success){
    evidence.samples[container_id][resource]={error:result.body.error,elapsedMs:result.elapsedMs};
    assert.ok([422,503].includes(result.body.error.status));console.log(JSON.stringify({container_id,resource,error:result.body.error}));continue;
   }
   const rows=ok(result);assert.ok(Array.isArray(rows));assert.ok(rows.every(row=>row.container_id===container_id));
   evidence.samples[container_id][resource]={count:rows.length,elapsedMs:result.elapsedMs,source:result.body.calculation?.source};
   if(rows.length){
    for(const row of rows){assert.equal(row.calculation_source,'calc_v1');assert.ok(typeof row.calculation_warning==='string');assert.ok(row.calculation_warning.length<=4000);assert.ok(Object.hasOwn(row,'quotation_date'));}
    valid[resource]??={container_id,row:rows[0],rows,calculation:result.body.calculation};
   }
   evidence.checks.push('read '+resource+' '+container_id);
  }
 }
 fs.writeFileSync(path.join(privateRoot,evidenceName),JSON.stringify(evidence,null,2)+'\n');
 for(const resource of requiredResources){
  const sample=valid[resource];assert.ok(sample,'Sem amostra calculavel '+resource);
  const key=resource==='resumo'?'container_id':resource==='rastro'?'rastro_id':'item_container_id';const id=sample.row[key];
  const detail=ok(await call('containers-custos',{operation:'get',resource,container_id:sample.container_id,id,[key]:id}));assert.deepEqual(detail,sample.row);evidence.checks.push('get '+resource);
  const dollar=ok(await call('containers-custos',{operation:'read',resource,container_id:sample.container_id,moeda:'dolar'}));assert.equal(dollar.length,sample.rows.length);evidence.checks.push('USD '+resource);
 }
 for(const resource of ['itens','comparativos'])assert.deepEqual(ok(await call('containers-custos',{operation:'read',resource,container_id:331126})),[]);
 for(const request of [
  {operation:'read',resource:'itens'}, {operation:'read',resource:'itens',container_id:'1 OR TRUE'},
  {operation:'update',resource:'itens',container_id:332526},{operation:'read',resource:'itens',container_id:332526,financial:{}},
  {operation:'read',resource:'itens',container_id:332526,table:'other'},{operation:'read',resource:'itens',container_id:332526,moeda:'euro'},
 ]){denied(await call('containers-custos',request),422);evidence.checks.push('invalid rejected');}
 assert.deepEqual(ok(await call('containers-consulta',{operation:'read'})),before);evidence.checks.push('master preserved');
 evidence.requiredResources=requiredResources;
 fs.writeFileSync(path.join(privateRoot,evidenceName),JSON.stringify(evidence,null,2)+'\n');
 console.log('PASS: '+evidence.checks.length+' verificacoes custos PASOE readonly,'+requiredResources.length+'recursos/2moedas/detalhes/origem.');console.log(JSON.stringify(evidence.samples));
})().catch(error=>{console.error(error.message);process.exitCode=1;});
