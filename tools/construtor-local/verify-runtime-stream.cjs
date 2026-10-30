'use strict';
// Somente consultas/autenticacao; nenhum dado de negocio alterado.
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const state=path.resolve(__dirname,'../../.runtime/construtor-pg'),base='http://127.0.0.1:8765';
(async()=>{
 const password=fs.readFileSync(path.join(state,'acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const auth=await fetch(base+'/api/auth/login',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({username:'admin',password,tenantId:'default',rememberMe:false}),signal:AbortSignal.timeout(15000)});
 assert.equal(auth.status,200);const login=await auth.json();
 const headers={'Content-Type':'application/json',Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 try{
  const started=Date.now();
  const streams=Array.from({length:3},async()=>{
   const r=await fetch(base+'/api/runtime/events',{headers,signal:AbortSignal.timeout(15000)});
   assert.equal(r.status,200);assert.ok(r.headers.get('content-type').includes('text/event-stream'));
   const raw=await r.text();assert.match(raw,/retry: 5000/);return Date.now()-started;
  });
  const read=async id=>{
   const r=await fetch(base+'/api/runtime/screens/admin.logs-transacoes/endpoints/read',{method:'POST',headers,body:JSON.stringify({take:500,filters:[{field:'transaction_id',operator:'eq',value:id}]}),signal:AbortSignal.timeout(15000)});
   assert.equal(r.status,200);const data=await r.json();assert.ok(data.data.length>0);assert.ok(data.data.every(x=>x.transaction_id===id));
   return {transactionId:id,total:data.total,events:data.data.map(x=>x.event_type),elapsedMs:Date.now()-started};
  };
  const results=await Promise.allSettled([...streams,read(446),read(443)]);
  for(const result of results)assert.equal(result.status,'fulfilled',result.reason?.message);
  const elapsedMs=Date.now()-started;assert.ok(elapsedMs<10000,'Streams bloquearam consultas: '+elapsedMs+'ms');
  fs.writeFileSync(path.join(state,'runtime-stream-evidence.json'),JSON.stringify({at:new Date().toISOString(),concurrentStreams:3,elapsedMs,streamsCompletedMs:results.slice(0,3).map(x=>x.value),reads:results.slice(3).map(x=>x.value),businessWrites:false},null,2));
  console.log('PASS: tres streams autenticados e consultas446/443 simultaneas sem espera de45s; '+elapsedMs+'ms.');
 }finally{const r=await fetch(base+'/api/auth/logout',{method:'POST',headers,body:'{}',signal:AbortSignal.timeout(15000)});assert.equal(r.status,200);}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
