'use strict';
// Testes operacionais autorizados: somente registros novos com marcador exclusivo.
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const state=path.resolve(__dirname,'../../.runtime/construtor-pg');
const base='http://127.0.0.1:8765',raw='http://127.0.0.1:19910/med/web/SursumPrograms/tipos-anexo';
const monitor='http://127.0.0.1:19910/med/web/SursumDynamicQuery/executions?limit=100';
async function json(url,body,headers={},status=200){
 const r=await fetch(url,{method:body===undefined?'GET':'POST',headers:{'Content-Type':'application/json',...headers},body:body===undefined?undefined:JSON.stringify(body)});
 const j=await r.json();assert.equal(r.status,status,j.error?.code||url);return j;
}
(async()=>{
 const marker='CODEx-TIPOS-'+Date.now()+'-';
 const token=JSON.parse(fs.readFileSync(path.join(state,'tipos-anexo-connection.json'),'utf8').replace(/^\uFEFF/,'')).integrationToken;
 for(const h of [{},{'X-Tipos-Anexo-Token':'invalid-token-'.repeat(5)}]){
  const denied=await json(raw,{operation:'read'},h);assert.equal(denied.error.code,'TIPO_ANEXO_AUTH_REQUIRED');
 }
 const pw=fs.readFileSync(path.join(state,'acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const login=await json(base+'/api/auth/login',{username:'admin',password:pw,tenantId:'default',rememberMe:false});
 const headers={Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,
  'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId,'X-Sursum-User':'forged-browser-user'};
 const endpoint=base+'/api/runtime/screens/ciw.tipos-anexo/endpoints/';
 const read=async()=> (await json(endpoint+'read',{take:100000,skip:0},headers)).data;
 const batch=async(changes,status=200)=>json(endpoint+'batch',{changes},headers,status);
 let before;
 try{
  const d=await json(base+'/api/runtime/screens/ciw.tipos-anexo',undefined,headers);
  assert.ok(!JSON.stringify(d).includes(token));
  assert.equal(d.crud.grid.editing.mode,'batch');assert.equal(d.dataSource.api.batch.endpointId,'batch');
  const fields=d.dataModel.fields;
  assert.equal(fields.tipo_anexo_id.editable,false);assert.equal(fields.descricao.editable,true);
  assert.equal(fields.descricao.validation.maxLength,100);assert.equal(fields.descricao.validation.required,false);
  before=await read();assert.ok(before.length);
  const previous=new Set((await json(monitor)).data.map(x=>x.executionId));
  let r=await batch([
   {operation:'create',clientId:'create-a',data:{descricao:marker+'Açã'}},
   {operation:'create',clientId:'create-b',data:{descricao:marker+'B'}}
  ]);
  assert.equal(r.results.length,2);assert.ok(r.results.every(x=>Number.isInteger(x.id)));
  const executions=(await json(monitor)).data.filter(x=>!previous.has(x.executionId)&&x.endpoint==='POST /SursumPrograms/tipos-anexo');
  assert.equal(executions.length,1,'Um lote corresponde a uma chamada Progress');
  const identity=executions[0];assert.equal(identity.userName,'admin');assert.equal(identity.pasoeInstance,'sursum-api');assert.match(identity.pasoeAgent,/^agent-\d+$/);assert.ok(identity.pasoePid);
  const a=r.results.find(x=>x.clientId==='create-a').id,b=r.results.find(x=>x.clientId==='create-b').id;
  r=await batch([
   {operation:'update',clientId:'update-a',id:a,original:{descricao:marker+'Açã'},data:{descricao:marker+'A alterado'}},
   {operation:'delete',clientId:'delete-b',id:b,original:{descricao:marker+'B'}},
   {operation:'create',clientId:'create-c',data:{descricao:marker+'C'}}
  ]);
  assert.equal(r.results.length,3);
  let rows=await read();assert.equal(rows.find(x=>x.tipo_anexo_id===a).descricao,marker+'A alterado');assert.ok(!rows.some(x=>x.tipo_anexo_id===b));
  const stale=await batch([{operation:'update',clientId:'stale',id:a,original:{descricao:marker+'Açã'},data:{descricao:marker+'incorreto'}}],409);
  assert.equal(stale.error.code,'TIPO_ANEXO_CHANGED');assert.match(stale.error.message,/Linha 1/);
  let absent=2147483647;while(rows.some(x=>x.tipo_anexo_id===absent))absent--;
  const failed=await batch([
   {operation:'update',clientId:'rollback-a',id:a,original:{descricao:marker+'A alterado'},data:{descricao:marker+'NAO PERSISTIR'}},
   {operation:'create',clientId:'rollback-create',data:{descricao:marker+'NAO CRIAR'}},
   {operation:'delete',clientId:'rollback-missing',id:absent,original:{descricao:null}}
  ],404);
  assert.equal(failed.error.code,'TIPO_ANEXO_NOT_FOUND');assert.match(failed.error.message,/Linha 3/);
  rows=await read();assert.equal(rows.find(x=>x.tipo_anexo_id===a).descricao,marker+'A alterado');assert.ok(!rows.some(x=>x.descricao===marker+'NAO CRIAR'));
  await batch([{operation:'create',clientId:'unknown-field',data:{descricao:marker+'INVALID',outro:'x'}}],422);
  await batch([{operation:'create',clientId:'long',data:{descricao:'á'.repeat(101)}}],422);
  const evidence={at:new Date().toISOString(),originalCount:before.length,headerAuthentication:true,definitionNoSecret:true,
   batchMetadata:true,atomicMixedCrud:true,oneExternalCall:true,optimisticConcurrency:true,fullRollback:true,strictValidation:true,
   identity:{executionId:identity.executionId,userName:identity.userName,pasoeAgent:identity.pasoeAgent,pasoeInstance:identity.pasoeInstance,pasoePid:identity.pasoePid,durationMs:identity.durationMs}};
  fs.writeFileSync(path.join(state,'tipos-anexo-http-evidence.json'),JSON.stringify(evidence,null,2));
  console.log('PASS: CRUD multirow real, chamada unica, rollback integral, concorrencia, validacao e identidade PASOE.');
 }finally{
  try{
   const own=(await read()).filter(x=>typeof x.descricao==='string'&&x.descricao.startsWith(marker));
   if(own.length)await batch(own.map((x,i)=>({operation:'delete',clientId:'cleanup-'+i,id:x.tipo_anexo_id,original:{descricao:x.descricao}})));
   const after=await read();assert.ok(!after.some(x=>typeof x.descricao==='string'&&x.descricao.startsWith(marker)));
   if(before)assert.deepEqual(after.slice().sort((a,b)=>a.tipo_anexo_id-b.tipo_anexo_id),before.slice().sort((a,b)=>a.tipo_anexo_id-b.tipo_anexo_id),'Registros originais preservados');
   console.log('PASS: registros proprios removidos; dados anteriores preservados.');
  }finally{await json(base+'/api/auth/logout',{},headers);}
 }
})().catch(e=>{console.error(e.message);process.exitCode=1;});
