'use strict';
// Apenas leitura de auditoria e metadados; a unica sessao criada e encerrada aqui.
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const state=path.resolve(__dirname,'../../.runtime/construtor-pg'),base='http://127.0.0.1:8765';
let headers={'Content-Type':'application/json'};
async function request(url,body,status=200){
 const r=await fetch(base+url,{method:body===undefined?'GET':'POST',headers,body:body===undefined?undefined:JSON.stringify(body)});
 const j=await r.json();assert.equal(r.status,status,j.error?.code||url);return j;
}
const endpoint='/api/runtime/screens/admin.logs-transacoes/endpoints/read';
const scope=(screen,field,value)=>[{field:'audit_screen_id',operator:'eq',value:screen},{field,operator:'eq',value}];
const decode=row=>{for(const key of ['metadata','before_data','after_data','diff_data'])if(typeof row[key]==='string')row[key]=JSON.parse(row[key]);return row;};
(async()=>{
 const password=fs.readFileSync(path.join(state,'acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const login=await request('/api/auth/login',{username:'admin',password,tenantId:'default',rememberMe:false});
 headers={...headers,Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 const evidence={at:new Date().toISOString(),readOnly:true,screens:[]};
 try{
  for(const screen of ['ciw.empresas','ciw.tipos-anexo','ciw.despesas','ciw.empresas-despesa']){
   const definition=await request('/api/runtime/screens/'+screen);
   const header=definition.program?.logs||definition.logs;
   assert.equal(header.title,'Logs Exclusão');assert.equal(header.mode,'deletions');
   assert.equal(definition.crud.form.logs.requiresRecord,true);
   assert.equal(definition.crud.form.logs.mode,definition.crud.grid.editing?.mode==='batch'?'recordEvents':'transactions');
   const filters=scope(screen,'audit_operation','delete');
   const response=await request(endpoint,{take:500,filters});assert.ok(response.total<500);
   const rows=response.data.map(decode);
   assert.ok(rows.every(x=>/\.delete$/.test(x.event_type)&&!x.event_type.includes('failed')));
   for(const row of rows){assert.ok(row.actor_user_id===null||typeof row.actor_user_id==='string');}
   if(response.total>1){
    const first=await request(endpoint,{take:1,skip:0,filters,sort:[{field:'id',dir:'desc'}]});
    const second=await request(endpoint,{take:1,skip:1,filters,sort:[{field:'id',dir:'desc'}]});
    assert.equal(first.total,response.total);assert.equal(second.total,response.total);assert.notEqual(first.data[0].id,second.data[0].id);
   }
   evidence.screens.push({screenId:screen,total:response.total,onlyDeletes:true});
   if(screen==='ciw.tipos-anexo'){
    const mixed=rows.filter(x=>String(x.transaction_id)==='549');
    assert.equal(mixed.length,1);assert.equal(mixed[0].id,1678);assert.equal(mixed[0].metadata.audit.recordId,22);
    evidence.mixedBatch={transactionId:549,deleteLogId:1678,onlyDeletedRecord:22};
   }
  }
  const events=await request('/api/runtime/screens/admin.logs-transacoes');
  for(const name of ['audit_screen_id','audit_operation','audit_record_id'])assert.ok(events.contextFields.some(x=>x.field===name&&x.filter));
  const record=await request(endpoint,{take:500,filters:scope('ciw.tipos-anexo','audit_record_id',21)});
  const mixed=record.data.map(decode).filter(x=>String(x.transaction_id)==='549');
  assert.equal(mixed.length,1);assert.equal(mixed[0].id,1677);assert.equal(mixed[0].metadata.audit.recordId,21);
  const cross=await request(endpoint,{take:500,filters:scope('ciw.empresas','audit_record_id',21)});
  assert.ok(!cross.data.some(x=>String(x.transaction_id)==='549'));
  evidence.recordScopeExcludesBatchSiblings=true;evidence.sourceScreenIsolation=true;
  await request(endpoint,{filters:scope('ciw.tipos-anexo','audit_operation','update')},422);
  await request(endpoint,{filters:[{field:'audit_screen_id',operator:'contains',value:'ciw.tipos-anexo'}]},422);
  await request(endpoint,{filters:scope('ciw.tipos-anexo','audit_record_id','1 OR 1=1')},422);
  evidence.invalidScopeRejected=true;
 }finally{await request('/api/auth/logout',{});}
 fs.writeFileSync(path.join(state,'deletion-logs-readonly-evidence.json'),JSON.stringify(evidence,null,2));
 console.log('PASS: Logs Exclusão em quatro consultas; filtro SQL, paginacao, lote misto sem inclusao/alteracao, escopo de registro e entradas invalidas. Nenhuma escrita de negocio.');
})().catch(e=>{console.error(e.stack||e.message);process.exitCode=1;});
