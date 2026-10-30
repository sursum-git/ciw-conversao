'use strict';
// Somente massa nova explicitamente autorizada; nenhuma empresa existente e gravada.
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const state=path.resolve(__dirname,'../../.runtime/construtor-pg');
const token=JSON.parse(fs.readFileSync(path.join(state,'empresas-connection.json'),'utf8').replace(/^\uFEFF/,'' )).integrationToken;
const marker='CODEX CONC '+Date.now()+' '+crypto.randomBytes(4).toString('hex');
const uri='http://127.0.0.1:19910/med/web/SursumPrograms/empresas';
async function api(body){
 const r=await fetch(uri,{method:'POST',headers:{'Content-Type':'application/json','X-Empresas-Token':token},body:JSON.stringify(body)});
 assert.equal(r.status,200);return r.json();
}
async function rows(){const r=await api({operation:'read'});assert.ok(!r.error,r.error?.code);return r.data;}
(async()=>{
 const initial=await rows();assert.equal(initial.filter(r=>r.nome?.startsWith(marker)).length,0);
 const initialIds=new Set(initial.map(r=>r.empresa_id));
 const names=Array.from({length:4},(_,i)=>marker+' '+i);
 let conflicts=0;let createdIds=[];
 try{
  const results=await Promise.all(names.map(nome=>api({operation:'create',nome,cod_emp_ems2:0,cod_emp_ems5:0})));
  for(let i=0;i<results.length;i++){
   let result=results[i];
   if(result.error){
    assert.equal(result.error.code,'EMPRESA_BUSY');assert.equal(result.error.status,409);
    conflicts++;result=await api({operation:'create',nome:names[i],cod_emp_ems2:0,cod_emp_ems5:0});
   }
   assert.ok(!result.error,result.error?.code);assert.equal(result.data.nome,names[i]);
   assert.ok(Number.isInteger(result.data.empresa_id));assert.ok(!initialIds.has(result.data.empresa_id));
   createdIds.push(result.data.empresa_id);
  }
  assert.equal(new Set(createdIds).size,4,'Inclusoes simultaneas preservam IDs unicos');
  const current=await rows();assert.equal(current.filter(r=>names.includes(r.nome)).length,4);
  console.log('PASS: quatro inclusões concorrentes, quatro IDs distintos; conflitos explícitos='+conflicts+'.');
 }finally{
  const cleanup=[];
  for(const row of (await rows()).filter(r=>r.nome?.startsWith(marker))){
   assert.ok(!initialIds.has(row.empresa_id));assert.ok(names.includes(row.nome),'Excluir somente nomes exatos desta execucao');
   const detail=await api({operation:'get',id:row.empresa_id});assert.equal(detail.data.nome,row.nome);
   const result=await api({operation:'delete',id:row.empresa_id});
   if(result.error){cleanup.push(result.error.code);continue;}
   assert.equal(result.success,true);
  }
  assert.deepEqual(cleanup,[],'Todas as exclusoes de limpeza passaram');
  const after=await rows();assert.equal(after.filter(r=>r.nome?.startsWith(marker)).length,0,'Sem registros de teste residuais');
  for(const original of initial){
   assert.deepEqual(after.find(r=>r.empresa_id===original.empresa_id),original,'Empresa preexistente preservada');
  }
  fs.writeFileSync(path.join(state,'empresas-concurrency-evidence.json'),JSON.stringify({at:new Date().toISOString(),createdIds,conflicts,cleanup:true,existingRowsPreserved:true},null,2));
  console.log('PASS: todos os registros desta execução removidos; empresas preexistentes preservadas.');
 }
})().catch(e=>{console.error(e.message);process.exitCode=1;});
