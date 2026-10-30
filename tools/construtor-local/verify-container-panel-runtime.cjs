'use strict';
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/construtor-pg'),base='http://127.0.0.1:8765';
const evidence={at:new Date().toISOString(),businessWrites:false,resources:{}};let headers={'Content-Type':'application/json'};
async function api(route,body,status=200){const r=await fetch(base+route,{method:body===undefined?'GET':'POST',headers,body:body===undefined?undefined:JSON.stringify(body)});const j=await r.json();assert.equal(r.status,status,JSON.stringify(j.error||j));return j;}
(async()=>{
 const password=fs.readFileSync(path.join(state,'acesso-local.txt'),'utf8').split(/\r?\n/).find(l=>l.startsWith('Senha inicial=')).slice(14);
 const login=await api('/api/auth/login',{username:'admin',password,tenantId:'default',rememberMe:false});assert.equal(login.authenticated,true);
 headers={...headers,Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 try{
  for(const [resource,suffix,pk] of [['painel','painel','container_id'],['itens','itens','item_container_id'],['despesas','despesas','despesa_container_id'],['anexos','anexos','anexo_container_id'],['versoes','versoes-custo','versao_id'],['pagamentos','pagamentos','pagamento_key'],['nfs','nfs','nf_key'],['comparativos','comparativos','item_container_id'],['rastro','rastro-dolar','rastro_id'],['custos','custos-itens','item_container_id'],['resumo','resumo','container_id']]){
   const screen='ciw.container-'+suffix,definition=await api('/api/runtime/screens/'+screen);
   assert.equal(definition.permissions.create,resource==='despesas');assert.equal(definition.permissions.edit,['painel','despesas'].includes(resource));assert.equal(definition.permissions.delete,['painel','despesas'].includes(resource));
   assert.equal(definition.contextFields.find(f=>f.field==='container_id').required,true);
   assert.ok(!JSON.stringify(definition).includes('X-Containers-Token'));
   if(resource==='painel'){assert.equal(definition.program.version,'1.0.4');assert.equal(definition.crud.form.mode,'embedded');assert.equal(definition.crud.form.tabs.filter(t=>t.type==='linkedPage').length,13);}
   const endpoint='/api/runtime/screens/'+screen+'/endpoints/';
   await api(endpoint+'read',{take:30},422);
   const containerId=['pagamentos','nfs','comparativos','rastro','custos','resumo'].includes(resource)?332526:200019;
   const rows=await api(endpoint+'read',{take:500,filters:[{field:'container_id',operator:'eq',value:containerId}]});
   assert.ok(rows.data.every(row=>row.container_id===containerId));assert.ok(rows.data.length>0,resource+' non-empty');
   const detail=await api(endpoint+'get',{id:rows.data[0][pk],[pk]:rows.data[0][pk],context:{container_id:containerId}});
   assert.deepEqual(detail,rows.data[0]);
   if(!['painel','rastro','resumo'].includes(resource))await api(endpoint+'get',{id:rows.data[0][pk],context:{container_id:331126}},404);
   if(['rastro','resumo'].includes(resource))await api(endpoint+'get',{id:rows.data[0][pk],context:{container_id:331126}},422);
   await api(endpoint+'read',{take:30,filter:{logic:'or',filters:[{field:'container_id',operator:'eq',value:200019},{field:'container_id',operator:'eq',value:331126}]}},422);
   evidence.resources[resource]={screen,total:rows.total,readonly:!['painel','despesas'].includes(resource),contextEnforced:true,detailMatches:true};
  }
  const query=await api('/api/runtime/screens/ciw.containers');
  assert.equal(query.program.version,'1.0.2');assert.ok(query.crud.grid.rowLinks.some(l=>l.screenId==='ciw.container-painel'&&l.position==='start'));
  evidence.previous={};
  for(const screen of ['ciw.empresas','ciw.tipos-anexo','ciw.despesas','ciw.empresas-despesa','ciw.containers']){const rows=await api('/api/runtime/screens/'+screen+'/endpoints/read',{take:1});evidence.previous[screen]=rows.total;}
  fs.writeFileSync(path.join(state,'container-panel-runtime-evidence.json'),JSON.stringify(evidence,null,2)+'\n');
  console.log('PASS: PHP/runtime11telascontextuais, read/get, isolamento, permissões explícitas e consultas anteriores.');console.log(JSON.stringify(evidence.resources));
 }finally{await api('/api/auth/logout',{});}
})().catch(error=>{console.error(error.message);process.exitCode=1;});
