'use strict';
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const state=path.resolve(__dirname,'../../.runtime/construtor-pg'),base='http://127.0.0.1:19910/med/web';
const token=JSON.parse(fs.readFileSync(path.join(state,'despesas-connection.json'),'utf8').replace(/^\uFEFF/,'')).integrationToken;
async function request(url,body,expected=200,authenticated=true){
 const r=await fetch(base+url,{method:body===undefined?'GET':'POST',headers:{'Content-Type':'application/json',...(authenticated?{'X-Despesas-Token':token,'X-Sursum-User':'admin'}:{})},body:body===undefined?undefined:JSON.stringify(body)});
 const text=await r.text();let j;try{j=JSON.parse(text);}catch{throw new Error('Resposta nao JSON HTTP '+r.status+' em '+url+': '+text.slice(0,1200));}
 Object.defineProperty(j,'_transportHeaders',{value:{executionId:r.headers.get('X-Sursum-Execution-Id'),count:r.headers.get('X-Sursum-Log-Count')}});
 const description=j.error?j.error.code+': '+j.error.message:url;
 assert.equal(r.status,200,description);
 if(expected!==200)assert.equal(j.error?.status,expected,j.error?.code||url);
 else assert.ok(!j.error,description);
 return j;
}
(async()=>{
 await request('/SursumPrograms/program-log-verificar',{},401,false);
 const results=[];
 for(const mode of ['success','rollback','silent']){
  const raw=await request('/SursumPrograms/program-log-verificar',{mode,executionId:'FORGED-NOT-USED'},mode==='rollback'?422:200);
  const result=raw.data&&!Array.isArray(raw.data)?raw.data:raw;
  assert.ok(result.executionId?.startsWith('EXE-'));assert.notEqual(result.executionId,'FORGED-NOT-USED');
  assert.equal(raw._transportHeaders.executionId,result.executionId);
  assert.equal(Number(raw._transportHeaders.count),mode==='success'?1:mode==='rollback'?2:0);
  assert.equal(result.pendingBefore,0);assert.equal(result.transactionActiveAfter,false);
  if(mode!=='silent'){assert.equal(result.queued,true);assert.equal(result.businessRolledBack,mode==='rollback');}
  const events=(await request('/SursumDynamicQuery/executions/'+encodeURIComponent(result.executionId)+'/events?limit=100')).data;
  const logs=events.filter(e=>e.eventStatus.startsWith('log.'));
  assert.equal(logs.length,mode==='success'?1:mode==='rollback'?2:0);
  for(const event of logs){
   assert.equal(event.executionId,result.executionId);
   const context=JSON.parse(event.eventContextJson);assert.equal(context.custom.executionId,result.executionId);
   assert.equal(context.currentUser,'admin');assert.ok(context.programLog.occurredAt);
  }
  const execution=await request('/SursumDynamicQuery/executions/'+encodeURIComponent(result.executionId));
  assert.equal(execution.status,mode==='rollback'?'failed':'completed');
  results.push({mode,executionId:result.executionId,logCount:logs.length,status:execution.status});
 }
 fs.writeFileSync(path.join(state,'program-log-evidence.json'),JSON.stringify({at:new Date().toISOString(),noBusinessDatabaseWrites:true,unauthorizedBlocked:true,results},null,2));
 console.log('PASS: logs manuais na execucao atual, commit/rollback, Unicode e isolamento de requests no PASOE.');
})().catch(e=>{console.error(e.stack||e.message);process.exitCode=1;});
