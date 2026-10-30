'use strict';
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const state=path.resolve(__dirname,'../../.runtime/construtor-pg');
const base='http://127.0.0.1:8765',pasoe='http://127.0.0.1:19910/med/web/SursumDynamicQuery';
async function json(url,body,headers={}){
 const r=await fetch(url,{method:body===undefined?'GET':'POST',headers:{'Content-Type':'application/json',...headers},body:body===undefined?undefined:JSON.stringify(body)});
 const j=await r.json();assert.equal(r.status,200,j.error?.code||url);assert.ok(!j.error,j.error?.code);return j;
}
(async()=>{
 const previous=new Set((await json(pasoe+'/executions?limit=30')).data.map(row=>row.executionId));
 const pw=fs.readFileSync(path.join(state,'acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const login=await json(base+'/api/auth/login',{username:'admin',password:pw,tenantId:'default',rememberMe:false});
 const headers={Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,
  'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId,'X-Sursum-User':'forged-browser-user'};
 try{
  await json(base+'/api/runtime/screens/ciw.despesas/endpoints/read',{take:1,userName:'forged-payload-user'},headers);
  const rows=(await json(pasoe+'/executions?limit=30')).data;
  const current=rows.find(row=>!previous.has(row.executionId)&&row.endpoint==='POST /SursumPrograms/despesas');
  assert.ok(current,'Execucao nova registrada');assert.equal(current.userName,'admin','Usuario provem do login validado');
  assert.ok(current.pasoePid);assert.equal(current.status,'completed');
  if(process.argv.includes('--require-runtime')){
   assert.equal(current.pasoeInstance,'sursum-api');assert.match(current.pasoeAgent,/^agent-\d+$/);
  }
  const evidence={at:new Date().toISOString(),executionId:current.executionId,userName:current.userName,pasoePid:current.pasoePid,
   pasoeAgent:current.pasoeAgent,pasoeInstance:current.pasoeInstance,durationMs:current.durationMs,status:current.status};
  fs.writeFileSync(path.join(state,'despesas-identity-evidence.json'),JSON.stringify(evidence,null,2));
  console.log('PASS: '+JSON.stringify(evidence));
 }finally{await json(base+'/api/auth/logout',{},headers);}
})().catch(e=>{console.error(e.message);process.exitCode=1;});

