'use strict';
// Somente leitura; as operacoes de escrita abaixo devem ser recusadas antes de qualquer mutacao.
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/construtor-pg');
const read=name=>JSON.parse(fs.readFileSync(path.join(state,name),'utf8').replace(/^\uFEFF/,''));
const token=read('containers-connection.json').integrationToken;
const url='http://127.0.0.1:19910/med/web/SursumPrograms/containers-consulta';
const digest=value=>crypto.createHash('sha256').update(JSON.stringify(value)).digest('hex');
async function pasoe(body,credential=token){
 const r=await fetch(url,{method:'POST',headers:{'Content-Type':'application/json',...(credential?{'X-Containers-Token':credential}:{})},body:JSON.stringify(body)});
 const j=await r.json();return {http:r.status,body:j,executionId:r.headers.get('x-sursum-execution-id')};
}
function types(row){
 assert.equal(Object.keys(row).length,23);
 assert.ok(Number.isInteger(row.container_id)&&row.container_id>0);
 for(const key of ['cod_emit_forn','situacao','situacao_container_id','num_pedido','ind_dt_embarque','ind_dt_prev_chegada','cod_agente_cargas','cod_armador'])assert.ok(row[key]===null||Number.isInteger(row[key]),key);
 for(const key of ['cod_estabel','nome_ab_forn','situacao_container_descricao','agente_cargas_nome','armador_nome'])assert.ok(row[key]===null||typeof row[key]==='string',key);
 for(const key of ['exclusivo','log_pagto_final'])assert.ok(row[key]===null||typeof row[key]==='boolean',key);
 for(const key of ['dt_compra','dt_prev_chegada','dt_recebimento','dt_prev_embarque','dt_real_embarque'])assert.ok(row[key]===null||/^\d{4}-\d{2}-\d{2}$/.test(row[key]),key);
 for(const key of ['vl_dolar_compra','vl_dolar_venda'])assert.ok(row[key]===null||typeof row[key]==='number',key);
}
(async()=>{
 const evidence={at:new Date().toISOString(),readOnly:true};
 for(const credential of ['', '0'.repeat(64)]){
  const denied=await pasoe({operation:'read'},credential);assert.equal(denied.body.success,false);assert.equal(denied.body.error.status,401);
 }
 const initial=await pasoe({operation:'read'});
 assert.equal(initial.body.success,true,initial.body.error?.code);assert.ok(initial.body.data.length>0);
 const rows=initial.body.data;rows.forEach(types);
 const sample=rows[0];const detail=await pasoe({operation:'get',id:sample.container_id,container_id:sample.container_id});
 assert.equal(detail.body.success,true,detail.body.error?.code);assert.deepEqual(detail.body.data,sample);
 const tests=[
  [{operation:'get',id:'1 OR TRUE'},422],
  [{operation:'get',id:sample.container_id,container_id:sample.container_id+1},422],
  [{operation:'get',id:2147483647},404],
  ...['create','update','delete','batch'].map(operation=>[{operation},422])
 ];
 for(const [body,status] of tests){const result=await pasoe(body);assert.equal(result.body.success,false);assert.equal(result.body.error.status,status);assert.ok(!('data' in result.body));}
 evidence.pasoe={total:rows.length,fields:23,typedRows:true,authDenied:true,invalidIdsDenied:true,writesDenied:true,
  sampleId:sample.container_id,executionId:initial.executionId,rowsSha256:digest(rows)};
 if(!process.argv.includes('--pasoe-only')){
  const base='http://127.0.0.1:8765';let headers={'Content-Type':'application/json'};
  async function api(route,body,status=200){const r=await fetch(base+route,{method:body===undefined?'GET':'POST',headers,body:body===undefined?undefined:JSON.stringify(body)});const j=await r.json();assert.equal(r.status,status,j.error?.code);return j;}
  const password=fs.readFileSync(path.join(state,'acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
  const login=await api('/api/auth/login',{username:'admin',password,tenantId:'default',rememberMe:false});assert.equal(login.authenticated,true);
  headers={...headers,Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
  try {
   const definition=await api('/api/runtime/screens/ciw.containers');
   assert.equal(definition.permissions.create,false);assert.equal(definition.permissions.edit,false);assert.equal(definition.permissions.delete,false);
   assert.equal(definition.crud.grid.columns.length,20);assert.equal(definition.crud.grid.columns.filter(c=>c.visible===false).length,8);
   assert.equal(definition.crud.filter.fields.length,11);assert.equal(definition.crud.query.pageSize,30);assert.equal(definition.crud.query.defaultGroup.length,2);
   for(const key of ['vl_dolar_compra','vl_dolar_venda'])assert.equal(definition.dataModel.fields[key].decimals,5);
   assert.ok(!JSON.stringify(definition).includes(token));
   const endpoint='/api/runtime/screens/ciw.containers/endpoints/';
   const monitor='http://127.0.0.1:19910/med/web/SursumDynamicQuery/executions?limit=30';
   const known=new Set((await fetch(monitor).then(r=>r.json())).data.map(r=>r.executionId));
   const first=await api(endpoint+'read',{skip:0,take:30,sort:[{field:'container_id',dir:'asc'}]});assert.equal(first.total,rows.length);assert.equal(first.data.length,Math.min(30,rows.length));first.data.forEach(types);
   const execution=(await fetch(monitor).then(r=>r.json())).data.find(r=>!known.has(r.executionId)&&r.endpoint==='POST /SursumPrograms/containers-consulta'&&r.userName==='admin');
   assert.ok(execution,'Execucao PHP/Progress com usuario autenticado');assert.equal(execution.pasoeInstance,'sursum-api');
   assert.match(execution.pasoeAgent,/^agent-\d+$/);assert.ok(execution.pasoePid);assert.equal(execution.status,'completed');
   assert.ok(Number.isFinite(Number(execution.durationMs))&&Number(execution.durationMs)>=0);
   evidence.identity={executionId:execution.executionId,userName:execution.userName,pasoeInstance:execution.pasoeInstance,pasoeAgent:execution.pasoeAgent,pasoePid:execution.pasoePid,durationMs:execution.durationMs};
   const second=await api(endpoint+'read',{skip:30,take:30,sort:[{field:'container_id',dir:'asc'}]});assert.equal(second.total,rows.length);
   if(rows.length>30)assert.ok(!first.data.some(a=>second.data.some(b=>a.container_id===b.container_id)));
   const filtered=await api(endpoint+'read',{take:30,filters:[{field:'container_id',operator:'eq',value:sample.container_id}]});assert.equal(filtered.total,1);assert.deepEqual(filtered.data[0],sample);
   const got=await api(endpoint+'get',{id:sample.container_id});assert.deepEqual(got,sample);
   await api(endpoint+'get',{id:2147483647},404);
   const status=sample.situacao;
   if(status!==null){const byStatus=await api(endpoint+'read',{take:30,filters:[{field:'situacao',operator:'eq',value:status}]});assert.equal(byStatus.total,rows.filter(r=>r.situacao===status).length);assert.ok(byStatus.data.every(r=>r.situacao===status));}
   evidence.runtime={screenId:'ciw.containers',program:'op1000',total:first.total,pageSize:30,columns:20,hidden:8,filters:11,groups:2,detailMatches:true,filterAndPaging:true,tokenHidden:true,readOnlyPermissions:true};
   const previous={};for(const screen of ['ciw.empresas','ciw.tipos-anexo','ciw.despesas','ciw.empresas-despesa']){const result=await api('/api/runtime/screens/'+screen+'/endpoints/read',{take:1});previous[screen]=result.total;}evidence.previousScreens=previous;
  } finally {await api('/api/auth/logout',{});}
 }
 const final=await pasoe({operation:'read'});assert.equal(final.body.success,true);assert.equal(digest(final.body.data),digest(rows),'Dados alterados durante validacao somente leitura');
 fs.writeFileSync(path.join(state,process.argv.includes('--pasoe-only')?'containers-pasoe-evidence.json':'containers-readonly-evidence.json'),JSON.stringify(evidence,null,2)+'\n');
 console.log('PASS: consulta de containers '+rows.length+' registros,23campos tipados,autenticacao/IDs/operacoes verificadas'+(evidence.runtime?',frontend metadata/PHP filtros/paginacao e quatro regressões':'')+'. Nenhuma escrita de negocio.');
})().catch(e=>{console.error(e.message);process.exitCode=1;});
