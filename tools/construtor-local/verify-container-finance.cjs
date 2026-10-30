'use strict';
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const root=path.resolve(__dirname,'../..'),privateRoot=path.join(root,'.runtime/construtor-pg');
const connection=JSON.parse(fs.readFileSync(path.join(privateRoot,'containers-connection.json'),'utf8').replace(/^\uFEFF/,''));
const base='http://127.0.0.1:19910/med/web/SursumPrograms/';
const evidence={checks:[],resources:{},businessWrites:false};
async function call(route,body,token=connection.integrationToken){
 const start=Date.now();const response=await fetch(base+route,{method:'POST',headers:{'Content-Type':'application/json',...(token?{'X-Containers-Token':token}:{})},body:JSON.stringify(body)});
 return {status:response.status,body:await response.json(),elapsedMs:Date.now()-start};
}
function data(result){assert.equal(result.status,200);assert.equal(result.body.success,true,JSON.stringify(result.body));return result.body.data;}
function denied(result,status){assert.equal(result.body.success,false);assert.equal(result.body.error.status,status,JSON.stringify(result.body));}
(async()=>{
 for(const token of [null,'invalid-token-'.repeat(4)]){denied(await call('containers-financeiro',{operation:'read',resource:'pagamentos',container_id:332526},token),401);evidence.checks.push('auth');}
 const before=data(await call('containers-consulta',{operation:'read'}));
 const ids=[331126,200019,332526,333426,1525];
 for(const container_id of ids){
  evidence.resources[container_id]={};
  for(const resource of ['pagamentos','nfs']){
   const result=await call('containers-financeiro',{operation:'read',resource,container_id});
   const rows=data(result);assert.ok(Array.isArray(rows));assert.ok(rows.every(row=>row.container_id===container_id));
   const key=resource==='pagamentos'?'pagamento_key':'nf_key';
   assert.equal(new Set(rows.map(row=>row[key])).size,rows.length);
   evidence.resources[container_id][resource]={count:rows.length,elapsedMs:result.elapsedMs};
   if(rows.length){
    const row=rows[0];const detail=data(await call('containers-financeiro',{operation:'get',resource,container_id,id:row[key],[key]:row[key]}));assert.deepEqual(detail,row);
    denied(await call('containers-financeiro',{operation:'get',resource,container_id:container_id===331126?332526:331126,id:row[key]}),404);
    evidence.checks.push('get/scope '+resource+' '+container_id);
   }
   evidence.checks.push('read '+resource+' '+container_id);
  }
 }
 for(const resource of ['pagamentos','nfs'])assert.ok(Object.values(evidence.resources).some(r=>r[resource].count>0),'Amostra vazia: '+resource);
 for(const request of [
  {operation:'read',resource:'pagamentos'},
  {operation:'read',resource:'nfs',container_id:'1 OR TRUE'},
  {operation:'read',resource:'pagamentos',container_id:332526,policy:{}},
  {operation:'read',resource:'nfs',container_id:332526,database:'ems2ima'},
  {operation:'delete',resource:'pagamentos',container_id:332526},
  {operation:'update',resource:'nfs',container_id:332526},
  {operation:'read',resource:'unknown',container_id:332526},
 ]){denied(await call('containers-financeiro',request),422);evidence.checks.push('invalid rejected');}
 denied(await call('containers-financeiro',{operation:'read',resource:'nfs',container_id:2147483647}),404);
 assert.deepEqual(data(await call('containers-consulta',{operation:'read'})),before);evidence.checks.push('master preserved');
 fs.writeFileSync(path.join(privateRoot,'container-finance-pasoe-evidence.json'),JSON.stringify(evidence,null,2)+'\n');
 console.log('PASS: '+evidence.checks.length+' verificacoes financeiras PASOE, somente leitura.');console.log(JSON.stringify(evidence.resources));
})().catch(error=>{console.error(error.message);process.exitCode=1;});
