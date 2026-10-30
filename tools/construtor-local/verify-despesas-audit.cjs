'use strict';
// Somente registros novos marcados; auditoria permanece como evidência.
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const state=path.resolve(__dirname,'../../.runtime/construtor-pg'),base='http://127.0.0.1:8765',marker='CODEx-AUDIT-'+Date.now();
let headers={'Content-Type':'application/json'},owned,before;
async function request(url,body,status=200){
 const r=await fetch(base+url,{method:body===undefined?'GET':'POST',headers,body:body===undefined?undefined:JSON.stringify(body)}),j=await r.json();
 assert.equal(r.status,status,j.error?.code||url);return j;
}
const unwrap=x=>x.data&&!Array.isArray(x.data)?x.data:x;
const api=(screen,operation,body,status)=>request('/api/runtime/screens/'+screen+'/endpoints/'+operation,body,status);
const allExpenses=async()=>{const result=await api('ciw.despesas','read',{take:500});assert.ok(result.total<500);return result.data;};
const filters=(screen,id)=>[{field:'screen_id',operator:'eq',value:screen},{field:'record_id',operator:'eq',value:String(id)}];
const logs=async tx=>(await api('admin.logs-transacoes','read',{take:500,filters:[{field:'transaction_id',operator:'eq',value:tx}]})).data.map(row=>{
 for(const key of ['before_data','after_data','diff_data','metadata'])if(typeof row[key]==='string')row[key]=JSON.parse(row[key]);
 return row;
});
(async()=>{
 const password=fs.readFileSync(path.join(state,'acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const login=await request('/api/auth/login',{username:'admin',password,tenantId:'default',rememberMe:false});
 headers={...headers,Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 try{
  before=await allExpenses();
  owned=unwrap(await api('ciw.despesas','create',{record:{descricao:marker+' anterior',ordem:0,log_calculada:false,perc_calculo:0,log_imposto:0,md_relacs_desp:[]},actor:{userId:'FORGED',username:'FORGED'}}));
  assert.ok(Number.isInteger(owned.despesa_id));
  fs.writeFileSync(path.join(state,'despesas-audit-test-ownership.json'),JSON.stringify({marker,id:owned.despesa_id,cleanup:false},null,2));
  const updated=unwrap(await api('ciw.despesas','update',{record:{despesa_id:owned.despesa_id,descricao:marker+' atual',ordem:7,log_calculada:true,perc_calculo:12.34},actor:{userId:'FORGED',username:'FORGED'}}));
  assert.equal(updated.descricao,marker+' atual');
  let txs=(await api('admin.transacoes','read',{take:500,filters:filters('ciw.despesas',owned.despesa_id)})).data;
  const updateTx=txs.filter(x=>x.endpoint_id==='update'&&x.status==='succeeded').sort((a,b)=>b.id-a.id)[0];assert.ok(updateTx);
  const events=await logs(updateTx.id),event=events.find(x=>x.event_type==='despesas_progress.api.update');assert.ok(event);
  fs.writeFileSync(path.join(state,'despesas-audit-last-diagnostic.json'),JSON.stringify({transactionId:updateTx.id,logId:event.id,actorUserId:event.actor_user_id,audit:event.metadata?.audit,beforeKeys:Object.keys(event.before_data||{}),afterKeys:Object.keys(event.after_data||{})},null,2));
  for(const row of [updateTx,event]){assert.equal(row.actor_user_id,String(login.user.id));assert.ok(row.actor_user_name);assert.ok(!JSON.stringify(row).includes('FORGED'),'Identidade enviada no payload vazou para a auditoria');}
  assert.equal(event.before_data.descricao,marker+' anterior');assert.equal(event.after_data.descricao,marker+' atual');
  assert.deepEqual(event.diff_data.descricao,{before:marker+' anterior',after:marker+' atual'});
  assert.deepEqual(event.diff_data.ordem,{before:0,after:7});
  assert.deepEqual(event.diff_data.log_calculada,{before:false,after:true});
  assert.equal(event.metadata.audit.available,true);assert.equal(event.metadata.audit.source,'progress-transaction');
  const createTx=txs.filter(x=>x.endpoint_id==='create'&&x.status==='succeeded').sort((a,b)=>b.id-a.id)[0];assert.ok(createTx);
  const createEvent=(await logs(createTx.id)).find(x=>x.event_type==='despesas_progress.api.create');assert.ok(createEvent);
  assert.equal(Object.keys(createEvent.before_data).length,0);assert.equal(createEvent.after_data.despesa_id,owned.despesa_id);
  await api('ciw.despesas','update',{record:{despesa_id:owned.despesa_id,descricao:marker+' nao confirmar',md_relacs_desp:[2147483647]}},422);
  const preserved=unwrap(await api('ciw.despesas','get',{id:owned.despesa_id}));assert.equal(preserved.descricao,marker+' atual');
  txs=(await api('admin.transacoes','read',{take:500,filters:filters('ciw.despesas',owned.despesa_id)})).data;
  const failed=txs.filter(x=>x.endpoint_id==='update'&&x.status==='failed').sort((a,b)=>b.id-a.id)[0];assert.ok(failed);
  assert.ok(!(await logs(failed.id)).some(x=>x.event_type==='despesas_progress.api.update'),'Falha publicou alteracao confirmada');
  const id=owned.despesa_id;await api('ciw.despesas','delete',{id});owned=null;
  fs.writeFileSync(path.join(state,'despesas-audit-test-ownership.json'),JSON.stringify({marker,id,cleanup:true},null,2));
  txs=(await api('admin.transacoes','read',{take:500,filters:filters('ciw.despesas',id)})).data;
  const deleted=txs.filter(x=>x.endpoint_id==='delete'&&x.status==='succeeded').sort((a,b)=>b.id-a.id)[0];assert.ok(deleted);
  const deleteEvent=(await logs(deleted.id)).find(x=>x.event_type==='despesas_progress.api.delete');assert.ok(deleteEvent);
  assert.equal(deleteEvent.before_data.descricao,marker+' atual');assert.equal(Object.keys(deleteEvent.after_data).length,0);
  assert.deepEqual((await allExpenses()).slice().sort((a,b)=>a.despesa_id-b.despesa_id),before.slice().sort((a,b)=>a.despesa_id-b.despesa_id));
  fs.writeFileSync(path.join(state,'despesas-audit-test-ownership.json'),JSON.stringify({marker,id,cleanup:true},null,2));
  fs.writeFileSync(path.join(state,'despesas-snapshots-evidence.json'),JSON.stringify({at:new Date().toISOString(),marker,recordId:id,transactionId:updateTx.id,logId:event.id,actorUserId:event.actor_user_id,actorUserName:event.actor_user_name,beforeDescription:event.before_data.descricao,afterDescription:event.after_data.descricao,changedFields:Object.keys(event.diff_data),createSnapshot:true,updateSnapshot:true,deleteSnapshot:true,rollbackNotReportedAsConfirmed:true,originalRecordsPreserved:true},null,2));
  console.log('PASS: ator autenticado, snapshot Progress anterior/atual, diff zero/false, inclusao/exclusao e rollback; registros anteriores preservados.');
 }finally{
  try{if(owned){await api('ciw.despesas','delete',{id:owned.despesa_id});fs.writeFileSync(path.join(state,'despesas-audit-test-ownership.json'),JSON.stringify({marker,id:owned.despesa_id,cleanup:true},null,2));console.log('PASS: registro novo de teste removido.');}}finally{await request('/api/auth/logout',{});}
 }
})().catch(e=>{console.error(e.stack||e.message);process.exitCode=1;});
