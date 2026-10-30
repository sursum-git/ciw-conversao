'use strict';
// Somente registros novos marcados; nunca altera os registros anteriores.
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const state=path.resolve(__dirname,'../../.runtime/construtor-pg'),base='http://127.0.0.1:8765';
const marker='CODEx-AUD2-'+Date.now();
let headers={'Content-Type':'application/json'},login,beforeE,beforeT;
const ownedE=new Set(),ownedT=new Set(),evidence={marker};
async function request(url,body,status=200){
 const r=await fetch(base+url,{method:body===undefined?'GET':'POST',headers,body:body===undefined?undefined:JSON.stringify(body)});
 const j=await r.json(); assert.equal(r.status,status,j.error?.code||url);return j;
}
const api=(screen,op,body,status)=>request('/api/runtime/screens/'+screen+'/endpoints/'+op,body,status);
const unwrap=x=>x.data&&!Array.isArray(x.data)?x.data:x;
const read=async screen=>{const r=await api(screen,'read',{take:500});assert.ok(r.total<500);return r.data;};
const batch=(changes,status=200)=>api('ciw.tipos-anexo','batch',{changes},status);
const decode=row=>{for(const k of ['before_data','after_data','diff_data','metadata'])if(typeof row[k]==='string')row[k]=JSON.parse(row[k]);return row;};
async function latest(screen,endpoint,status='succeeded'){
 const rows=(await api('admin.transacoes','read',{take:500,filters:[{field:'screen_id',operator:'eq',value:screen},{field:'session_id',operator:'eq',value:login.session.sessionId}]})).data;
 const tx=rows.filter(x=>x.endpoint_id===endpoint&&x.status===status).sort((a,b)=>b.id-a.id)[0];assert.ok(tx,'Transacao '+screen+'/'+endpoint+'/'+status);return tx;
}
async function events(tx){return (await api('admin.logs-transacoes','read',{take:500,filters:[{field:'transaction_id',operator:'eq',value:tx.id}]})).data.map(decode);}
function checkActor(row){assert.equal(row.actor_user_id,String(login.user.id));assert.ok(row.actor_user_name);}
function checkAudit(row,resource,op,id){
 assert.ok(row);checkActor(row);assert.equal(row.metadata.audit.available,true);assert.equal(row.metadata.audit.version,1);
 assert.equal(row.metadata.audit.source,'progress-transaction');assert.equal(row.metadata.audit.resource,resource);
 assert.equal(row.metadata.audit.operation,op);assert.equal(row.metadata.audit.recordId,id);
}
function journal(){fs.writeFileSync(path.join(state,'empresas-tipos-audit-ownership.json'),JSON.stringify({marker,empresas:[...ownedE],tipos:[...ownedT]},null,2));}
(async()=>{
 const password=fs.readFileSync(path.join(state,'acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 login=await request('/api/auth/login',{username:'admin',password,tenantId:'default',rememberMe:false});
 headers={...headers,Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 try{
  beforeE=await read('ciw.empresas');beforeT=await read('ciw.tipos-anexo');
  const e=unwrap(await api('ciw.empresas','create',{record:{nome:marker+' anterior',cod_emp_ems2:0,cod_emp_ems5:0}}));
  assert.ok(Number.isInteger(e.empresa_id));ownedE.add(e.empresa_id);journal();
  let tx=await latest('ciw.empresas','create'),rows=await events(tx),log=rows.find(x=>x.event_type==='empresas_progress.api.create');
  checkAudit(log,'empresas','create',e.empresa_id);assert.equal(Object.keys(log.before_data).length,0);assert.equal(log.after_data.nome,marker+' anterior');
  await api('ciw.empresas','update',{record:{empresa_id:e.empresa_id,nome:marker+' atual',cod_emp_ems2:-7}});
  tx=await latest('ciw.empresas','update');rows=await events(tx);log=rows.find(x=>x.event_type==='empresas_progress.api.update');
  checkAudit(log,'empresas','update',e.empresa_id);
  assert.deepEqual(log.before_data,{empresa_id:e.empresa_id,nome:marker+' anterior',cod_emp_ems2:0,cod_emp_ems5:0});
  assert.deepEqual(log.after_data,{empresa_id:e.empresa_id,nome:marker+' atual',cod_emp_ems2:-7,cod_emp_ems5:0});
  assert.deepEqual(log.diff_data.nome,{before:marker+' anterior',after:marker+' atual'});
  evidence.empresas={recordId:e.empresa_id,transactionId:tx.id,logId:log.id,actor:log.actor_user_id,create:true,update:true};
  await api('ciw.empresas','update',{record:{empresa_id:e.empresa_id,nome:'x'.repeat(51)}},422);
  assert.equal(unwrap(await api('ciw.empresas','get',{id:e.empresa_id})).nome,marker+' atual');
  await api('ciw.empresas','delete',{id:e.empresa_id});ownedE.delete(e.empresa_id);journal();
  tx=await latest('ciw.empresas','delete');log=(await events(tx)).find(x=>x.event_type==='empresas_progress.api.delete');
  checkAudit(log,'empresas','delete',e.empresa_id);assert.equal(log.before_data.nome,marker+' atual');assert.equal(Object.keys(log.after_data).length,0);evidence.empresas.delete=true;

  let result=await batch([{operation:'create',clientId:'create-a',data:{descricao:marker+' A'}},{operation:'create',clientId:'create-b',data:{descricao:marker+' B'}}]);
  for(const r of result.results)ownedT.add(r.id);journal();
  const a=result.results.find(x=>x.clientId==='create-a').id,b=result.results.find(x=>x.clientId==='create-b').id;
  tx=await latest('ciw.tipos-anexo','batch');rows=(await events(tx)).filter(x=>x.event_type==='tipos_anexo_progress.api.create');assert.equal(rows.length,2);
  for(const r of rows){checkAudit(r,'tipos_anexo','create',r.after_data.tipo_anexo_id);assert.equal(Object.keys(r.before_data).length,0);}
  result=await batch([{operation:'update',clientId:'update-a',id:a,original:{descricao:marker+' A'},data:{descricao:marker+' Atual'}},{operation:'delete',clientId:'delete-b',id:b,original:{descricao:marker+' B'}},{operation:'create',clientId:'create-c',data:{descricao:marker+' C'}}]);
  ownedT.delete(b);const c=result.results.find(x=>x.clientId==='create-c').id;ownedT.add(c);journal();
  tx=await latest('ciw.tipos-anexo','batch');rows=(await events(tx)).filter(x=>/^tipos_anexo_progress\.api\.(create|update|delete)$/.test(x.event_type));assert.equal(rows.length,3);
  log=rows.find(x=>x.event_type==='tipos_anexo_progress.api.update');checkAudit(log,'tipos_anexo','update',a);
  assert.deepEqual(log.before_data,{tipo_anexo_id:a,descricao:marker+' A'});assert.deepEqual(log.after_data,{tipo_anexo_id:a,descricao:marker+' Atual'});
  assert.deepEqual(log.diff_data.descricao,{before:marker+' A',after:marker+' Atual'});
  const removed=rows.find(x=>x.event_type==='tipos_anexo_progress.api.delete');checkAudit(removed,'tipos_anexo','delete',b);assert.deepEqual(removed.before_data,{tipo_anexo_id:b,descricao:marker+' B'});assert.equal(Object.keys(removed.after_data).length,0);
  const added=rows.find(x=>x.event_type==='tipos_anexo_progress.api.create');checkAudit(added,'tipos_anexo','create',c);assert.equal(Object.keys(added.before_data).length,0);assert.equal(added.after_data.descricao,marker+' C');
  evidence.tipos={transactionId:tx.id,logId:log.id,recordId:a,actor:log.actor_user_id,batchPerLine:true,create:true,update:true,delete:true};
  let absent=2147483647;const all=await read('ciw.tipos-anexo');while(all.some(x=>x.tipo_anexo_id===absent))absent--;
  await batch([{operation:'update',clientId:'rollback-update',id:a,original:{descricao:marker+' Atual'},data:{descricao:marker+' NAO ALTERAR'}},{operation:'create',clientId:'rollback-create',data:{descricao:marker+' NAO CRIAR'}},{operation:'delete',clientId:'rollback-missing',id:absent,original:{descricao:null}}],404);
  const unchanged=await read('ciw.tipos-anexo');assert.equal(unchanged.find(x=>x.tipo_anexo_id===a).descricao,marker+' Atual');assert.ok(!unchanged.some(x=>x.descricao===marker+' NAO CRIAR'));
  tx=await latest('ciw.tipos-anexo','batch','failed');assert.ok(!(await events(tx)).some(x=>/^tipos_anexo_progress\.api\.(create|update|delete)$/.test(x.event_type)));
  evidence.tipos.rollbackWithoutConfirmedAudit=true;
 }finally{
  try{
   for(const id of ownedE){const row=unwrap(await api('ciw.empresas','get',{id}));assert.ok(row.nome.startsWith(marker));await api('ciw.empresas','delete',{id});ownedE.delete(id);journal();}
   const cleanup=(await read('ciw.tipos-anexo')).filter(x=>ownedT.has(x.tipo_anexo_id));
   assert.ok(cleanup.every(x=>typeof x.descricao==='string'&&x.descricao.startsWith(marker)));
   if(cleanup.length)await batch(cleanup.map((x,i)=>({operation:'delete',clientId:'cleanup-'+i,id:x.tipo_anexo_id,original:{descricao:x.descricao}})));
   ownedT.clear();journal();
   if(beforeE)assert.deepEqual((await read('ciw.empresas')).sort((a,b)=>a.empresa_id-b.empresa_id),beforeE.sort((a,b)=>a.empresa_id-b.empresa_id));
   if(beforeT)assert.deepEqual((await read('ciw.tipos-anexo')).sort((a,b)=>a.tipo_anexo_id-b.tipo_anexo_id),beforeT.sort((a,b)=>a.tipo_anexo_id-b.tipo_anexo_id));
   evidence.originalRecordsPreserved=true;evidence.cleanup=true;
  }finally{await request('/api/auth/logout',{});}
 }
 evidence.at=new Date().toISOString();fs.writeFileSync(path.join(state,'empresas-tipos-snapshots-evidence.json'),JSON.stringify(evidence,null,2));
 console.log('PASS: empresas CRUD com snapshots; tipos batch por linha com snapshots e rollback sem confirmacao; autoria e originais preservados; testes limpos.');
})().catch(e=>{console.error(e.stack||e.message);process.exitCode=1;});
