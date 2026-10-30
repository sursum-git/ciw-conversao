'use strict';
// Fixed authorized synthetic fixture only. Preparing this file executes nothing.
// One explicit mode per run. Never remove attempt guards to retry an uncertain commit.
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const root=path.resolve(__dirname,'../..'),folder=path.join(root,'.runtime/container-items-20261017'),state=path.join(root,'.runtime/construtor-pg');
const cid=2147000101,orderId=2147000200,purchaseId=2147000201,tag='SC_TEST_ITENS_20261017',erp='ZTSC171026',mode=process.argv[2];
assert.ok(['create-parent','maintain','maintain-zero','maintain-zero-refreshed','logs','deallocate','delete-parent','inspect'].includes(mode),'Use one explicit documented mode');
const read=p=>fs.readFileSync(p,'utf8').replace(/^\uFEFF/,''),load=name=>JSON.parse(read(path.join(folder,name))),exists=name=>fs.existsSync(path.join(folder,name));
const save=(name,value)=>fs.writeFileSync(path.join(folder,name),JSON.stringify(value,null,2)+'\n');
const evidence={at:new Date().toISOString(),mode,container_id:cid,checks:[],timings:[]};
let headers={'Content-Type':'application/json'},integrationToken;
function safeError(message){const e=new Error(message);e.safeHarnessMessage=true;return e;}
function scope(o){assert.equal(o.container_id,cid);assert.equal(o.proc_compra_id,orderId);assert.equal(o.item_proc_compra_id,purchaseId);assert.equal(o.tag,tag);assert.equal(o.synthetic_erp,erp);}
function setup(){const s=load('items-fixture-setup.json');scope(s);assert.equal(s.success,true);assert.match(s.setup_guard_sha256,/^[A-Fa-f0-9]{64}$/);return s;}
function ownership(){const s=setup();const owned=exists('items-fixture-owned.json')?load('items-fixture-owned.json'):{container_id:cid,proc_compra_id:orderId,item_proc_compra_id:purchaseId,tag,synthetic_erp:erp,setup_guard_sha256:s.setup_guard_sha256,item_container_ids:[],ledger_rows:[]};scope(owned);assert.equal(owned.setup_guard_sha256,s.setup_guard_sha256);return owned;}
function ownedItem(){const o=ownership();assert.equal(o.item_container_ids.length,1,'Exactly one confirmed synthetic allocation required');assert.ok(Number.isSafeInteger(o.item_container_ids[0])&&o.item_container_ids[0]>0);return o.item_container_ids[0];}
function dataRecord(body){return body?.data&&!Array.isArray(body.data)?body.data:body;}
async function transport(base,route,body,requestHeaders,recordTiming=true){
 const started=Date.now();let response,json;
 try{response=await fetch(base+route,{method:body===undefined?'GET':'POST',headers:requestHeaders,body:body===undefined?undefined:JSON.stringify(body),signal:AbortSignal.timeout(120000)});json=await response.json();}
 catch{throw safeError('Transport/JSON outcome uncertain. Do not retry a mutation; use inspect and logs.');}
 const elapsedMs=Date.now()-started;if(recordTiming)evidence.timings.push({route,status:response.status,elapsedMs});
 return {status:response.status,body:json,elapsedMs};
}
const apiRaw=(route,body)=>transport('http://127.0.0.1:8765',route,body,headers,!route.startsWith('/api/auth/'));
const endpoint=(screen,op)=>'/api/runtime/screens/'+screen+'/endpoints/'+op;
const runtimeRaw=(screen,op,payload)=>apiRaw(endpoint(screen,op),payload);
async function expected(response,status=200){assert.equal(response.status,status,'Unexpected HTTP status; inspect private response and committed state before replaying');return response.body;}
async function runtime(screen,op,payload,status=200){return expected(await runtimeRaw(screen,op,payload),status);}
async function pasoe(route,body){return (await transport('http://127.0.0.1:19910','/med/web/SursumPrograms/'+route,body,{'Content-Type':'application/json','X-Containers-Token':integrationToken,'X-Sursum-User':'admin'})).body;}
async function once(name,invoke){
 const file=path.join(folder,'items-attempt-'+name+'.json');let fd;
 try{fd=fs.openSync(file,'wx');}catch{throw safeError('Attempt already exists: '+name+'. Inspect committed state; never replay automatically.');}
 const attempt={startedAt:new Date().toISOString(),name,container_id:cid,outcome:'unknown-until-confirmed'};fs.writeFileSync(fd,JSON.stringify(attempt,null,2)+'\n');fs.closeSync(fd);
 try{const result=await invoke();save('items-response-'+name+'.json',result);save('items-attempt-'+name+'.json',{...attempt,receivedAt:new Date().toISOString(),outcome:'response-received-review-business-and-audit',httpStatus:result.status??null});return result;}
 catch(error){save('items-failure-'+name+'.json',{at:new Date().toISOString(),container_id:cid,outcome:'unknown-do-not-retry',errorCode:error.code||'HARNESS_ACTION_FAILED',recoveryModes:['inspect','logs']});throw error;}
}
async function parent(required=true){const r=await pasoe('containers-painel',{resource:'painel',operation:'get',container_id:cid,id:cid});if(!required&&r.success===false){assert.equal(r.error?.status,404);return null;}assert.equal(r.success,true,'Marked parent required');assert.ok(typeof r.data.narrativa==='string'&&r.data.narrativa.startsWith(tag),'Parent ownership marker mismatch');return r.data;}
const ctx={container_id:cid};
async function itemRead(){const r=await runtime('ciw.container-itens','read',{take:500,context:ctx});assert.ok(Array.isArray(r.data));for(const row of r.data)assert.equal(row.container_id,cid);return r;}
async function itemGet(id){const r=dataRecord(await runtime('ciw.container-itens','get',{id,context:ctx}));assert.equal(r.container_id,cid);assert.equal(r.item_container_id,id);assert.equal(r.item_proc_compra_id,purchaseId);return r;}
function quantities(row,allocated,confirmed){assert.equal(Number(row.qt_alocada),allocated);assert.equal(Number(row.qt_confirm_emb),confirmed);}
const decode=row=>({...row,meta:typeof row.metadata==='string'?JSON.parse(row.metadata):row.metadata,before:typeof row.before_data==='string'?JSON.parse(row.before_data):row.before_data,after:typeof row.after_data==='string'?JSON.parse(row.after_data):row.after_data,diff:typeof row.diff_data==='string'?JSON.parse(row.diff_data):row.diff_data});
async function logRows(screen,id,operation){
 const filters=[{field:'audit_screen_id',operator:'eq',value:screen},{field:'audit_record_id',operator:'eq',value:String(id)}];if(operation)filters.push({field:'audit_operation',operator:'eq',value:operation});
 let rows=[],skip=0;do{const r=await runtime('admin.logs-transacoes','read',{take:500,skip,filters,sort:[{field:'id',dir:'asc'}]});assert.ok(Array.isArray(r.data));rows.push(...r.data);skip+=r.data.length;if(skip>=Number(r.total??skip)||r.data.length===0)break;assert.ok(skip<5000,'Bounded fixture logs only');}while(true);
 return rows.map(decode);
}
async function collectLogs(requireMaintenance=true){
 const id=ownedItem(),parentRows=await logRows('ciw.container-painel',cid),itemRows=await logRows('ciw.container-itens',id);
 const all=[...new Map([...parentRows,...itemRows].map(row=>[String(row.id),row])).values()].sort((a,b)=>Number(a.id)-Number(b.id));
 save('items-logs-raw-'+Date.now()+'.json',{container_id:cid,item_container_id:id,parentRows,itemRows});
 const events=all.filter(row=>row.meta?.audit?.source==='progress-transaction'&&row.meta.audit.available===true);
 for(const row of events){assert.equal(row.meta.audit.containerId,cid);assert.equal(row.actor_user_id,'admin');assert.equal(row.actor_user_name,'Administrador');assert.ok(!String(row.event_type).includes('failed'));}
 const main=events.filter(row=>row.meta.audit.resource==='itens_container'&&Number(row.meta.audit.recordId)===id);
 if(requireMaintenance){
  assert.ok(main.some(row=>row.meta.audit.operation==='create'&&Number(row.after?.qt_alocada)===2&&Number(row.after?.qt_confirm_emb)===0),'Confirmed create2/0 missing');
  assert.ok(main.some(row=>row.meta.audit.operation==='update'&&Number(row.before?.qt_alocada)===2&&Number(row.after?.qt_alocada)===3&&Number(row.before?.qt_confirm_emb)===0&&Number(row.after?.qt_confirm_emb)===4),'Confirmed update2→3 and0→4 missing');
  assert.ok(main.some(row=>row.meta.audit.operation==='update'&&Number(row.before?.qt_confirm_emb)===4&&Number(row.after?.qt_confirm_emb)===5),'Confirmed update4→5 missing');
 }
 const financial=events.filter(row=>row.meta.audit.resource==='cta_corren_fornec_imp');
 const creations=financial.filter(row=>row.meta.audit.operation==='create'&&Number(row.after?.cod_tipo_movto)===10);
 if(requireMaintenance){assert.equal(creations.length,2,'Exactly two committed type10 deltas expected');assert.equal(new Set(creations.map(row=>row.after.cta_corren_fornec_imp_id)).size,2);}
 for(const row of creations){assert.equal(row.after.item_container_id,id);assert.equal(row.after.item_proc_compra_id,purchaseId);assert.equal(row.after.num_id_tit_ap,0);assert.equal(Number(row.after.vl_lancto),2);assert.equal(row.after.cod_acao,2);assert.equal(row.after.login,'admin');assert.equal(row.after.container_id,cid);}
 assert.ok(!events.some(row=>['item_custos','item_container_custos','versoes_item_custo_container'].includes(row.meta.audit.resource)),'Cost closing/version not authorized');
 const owned=ownership(),latest=new Map(owned.ledger_rows.map(row=>[row.cta_corren_fornec_imp_id,row]));
 for(const event of financial){const row=Object.keys(event.after||{}).length?event.after:event.before;if(!row||!Number.isInteger(row.cta_corren_fornec_imp_id))continue;assert.equal(row.container_id,cid);assert.equal(row.item_proc_compra_id,purchaseId);assert.equal(row.item_container_id,id);assert.equal(row.num_id_tit_ap,0);latest.set(row.cta_corren_fornec_imp_id,row);}
 owned.ledger_rows=[...latest.values()];owned.lastConfirmedLogAt=new Date().toISOString();save('items-fixture-owned.json',owned);
 if(exists('items-response-deallocate.json')){
  const deleted=main.find(row=>row.meta.audit.operation==='delete');assert.ok(deleted,'Confirmed main delete audit missing');quantities(deleted.before,3,5);assert.equal(deleted.before.container_id,cid);assert.equal(deleted.before.item_container_id,id);assert.equal(Object.keys(deleted.after||{}).length,0);
  const deletionRows=await logRows('ciw.container-itens',id,'delete');assert.ok(deletionRows.some(row=>row.meta?.audit?.source==='progress-transaction'&&row.meta.audit.operation==='delete'&&Number(row.meta.audit.recordId)===id),'Logs Exclusão record scope missing');
 }
 const result={at:new Date().toISOString(),container_id:cid,item_container_id:id,confirmedEvents:events.length,mainEvents:main.length,financialEvents:financial.length,type10Deltas:creations.map(row=>({id:row.after.cta_corren_fornec_imp_id,usd:row.after.vl_lancto})),ownedLedgerIds:owned.ledger_rows.map(row=>row.cta_corren_fornec_imp_id),main,financial};
 save('items-confirmed-logs.json',result);evidence.checks.push('confirmed actor/admin, parent/item record scopes, quantity before/after and USD2+2 deltas');return result;
}
(async()=>{
 integrationToken=JSON.parse(read(path.join(state,'containers-connection.json'))).integrationToken;
 const password=read(path.join(state,'acesso-local.txt')).split(/\r?\n/).find(line=>line.startsWith('Senha inicial=')).slice(14);
 const login=await expected(await apiRaw('/api/auth/login',{username:'admin',password,tenantId:'default',rememberMe:false}));assert.equal(login.authenticated,true);
 headers={...headers,Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 try{
  if(mode==='create-parent'){
   assert.equal(await parent(false),null,'Fixed CID must be absent');
   const result=await once('create-parent',async()=>({body:await pasoe('containers-cabecalho',{resource:'containers',operation:'create',container_id:cid,values:{narrativa:tag,cod_estabel:'505',cod_emit_forn:26715,situacao_container_id:7,ordem_busca_dolar_compra:'2',ordem_busca_dolar_di:'4',cod_tipo_proj_dolar:1,vl_dolar_compra:5,vl_dolar_di:5,vl_proj_dolar:0,vl_dolar_venda:5,log_gerar_saldo_a_pagar:false,log_gerar_distr_custo:false,log_liberar_custo_realizado:false}})}));
   assert.equal(result.body.success,true);assert.equal(result.body.audit?.source,'progress-transaction');assert.equal(result.body.audit.recordId,cid);assert.deepEqual(result.body.audit.before,{});await parent();evidence.checks.push('new marked parent created and audited; SQL fixture remains separate');
  }else if(mode==='maintain'){
   await parent();setup();const initial=await itemRead();assert.equal(initial.data.length,0,'Fixture must have no allocation before create');
   const definition=await expected(await apiRaw('/api/runtime/screens/ciw.container-itens'));assert.ok(definition.permissions.create&&definition.permissions.edit&&definition.permissions.delete,'Published native CRUD grants required');
   const values={item_proc_compra_id:purchaseId,qt_alocada:2,qt_confirm_emb:0,qt_recbto_fisico:0,log_rec_doc_prazo_emb:false,observacao:tag,cod_tipo_calculo:0,perc_custo:0,log_calc_icms:true,log_calc_ipi:true,perc_icms:0,perc_ipi:0};
   const created=dataRecord(await expected(await once('allocate',()=>runtimeRaw('ciw.container-itens','create',{record:values,context:ctx}))));
   const id=created.item_container_id;assert.ok(Number.isInteger(id)&&id>0);assert.equal(created.container_id,cid);assert.equal(created.item_proc_compra_id,purchaseId);quantities(created,2,0);
   const owned=ownership();assert.equal(owned.item_container_ids.length,0);owned.item_container_ids=[id];save('items-fixture-owned.json',owned);
   await itemGet(id);
   const first=dataRecord(await expected(await once('update-allocated3-confirmed4',()=>runtimeRaw('ciw.container-itens','update',{id,record:{...values,qt_alocada:3,qt_confirm_emb:4},context:ctx}))));quantities(first,3,4);
   const second=dataRecord(await expected(await once('update-confirmed5',()=>runtimeRaw('ciw.container-itens','update',{id,record:{...values,qt_alocada:3,qt_confirm_emb:5},context:ctx}))));quantities(second,3,5);
   const rejected=await once('reject-overrun11',()=>runtimeRaw('ciw.container-itens','update',{id,record:{qt_alocada:11},context:ctx}));await expected(rejected,422);assert.equal(rejected.body.error?.code,'CONTAINER_ITEM_ALLOCATION_EXCEEDED');
   const duplicate=await once('reject-duplicate',()=>runtimeRaw('ciw.container-itens','create',{record:values,context:ctx}));await expected(duplicate,409);assert.equal(duplicate.body.error?.code,'CONTAINER_ITEM_EXISTS');
   await runtime('ciw.container-itens','get',{id,context:{container_id:332526}},404);
   const final=await itemGet(id);quantities(final,3,5);assert.equal((await itemRead()).data.length,1);evidence.item_container_id=id;evidence.checks.push('native allocate2/0, update3/4→3/5, overrun/duplicate/context rejection with state preserved');
  }else if(mode==='maintain-zero'||mode==='maintain-zero-refreshed'){
   const suffix=mode==='maintain-zero-refreshed'?'-refreshed':'';
   if(suffix){const prior=load('items-response-update-zero.json');assert.equal(prior.status,422);assert.equal(prior.body.error?.code,'CONTAINER_ITEM_RULE_FAILED');assert.ok(prior.body.error.message.includes('ZERO_DENOMINATOR'));const refresh=JSON.parse(read(path.join(root,'.runtime/container-fiscal-quotes-publish-20261017/med-session-refresh.json')));assert.equal(refresh.instance,'sursum-api');assert.equal(refresh.postcondition,'vendor confirmed every inspected idle session; validate current HTTP behavior before completion');}
   await parent();const id=ownedItem();const before=await itemGet(id);quantities(before,3,5);const previous=await collectLogs();
   const zero=dataRecord(await expected(await once('update-zero'+suffix,()=>runtimeRaw('ciw.container-itens','update',{id,record:{qt_alocada:0,qt_confirm_emb:0,log_calc_icms:false,log_calc_ipi:false},context:ctx}))));quantities(zero,0,0);assert.equal(zero.log_calc_icms,false);assert.equal(zero.log_calc_ipi,false);
   const zeroEvents=(await logRows('ciw.container-itens',id)).filter(row=>row.meta?.audit?.source==='progress-transaction');
   assert.ok(zeroEvents.some(row=>row.meta.audit.resource==='itens_container'&&row.meta.audit.operation==='update'&&Number(row.before?.qt_alocada)===3&&Number(row.after?.qt_alocada)===0&&Number(row.before?.qt_confirm_emb)===5&&Number(row.after?.qt_confirm_emb)===0),'Confirmed zero snapshot missing');
   const beforeIds=new Set(previous.type10Deltas.map(row=>row.id));
   assert.ok(zeroEvents.filter(row=>row.meta.audit.resource==='cta_corren_fornec_imp'&&Number(row.after?.cod_tipo_movto)===10).every(row=>beforeIds.has(row.after.cta_corren_fornec_imp_id)),'Zero must retain previous type10 without reversal/new row');
   const restored=dataRecord(await expected(await once('restore-after-zero'+suffix,()=>runtimeRaw('ciw.container-itens','update',{id,record:{qt_alocada:3,qt_confirm_emb:5,log_calc_icms:false,log_calc_ipi:false},context:ctx}))));quantities(restored,3,5);
   const after=await collectLogs();assert.deepEqual(after.type10Deltas.map(row=>row.id).sort(),previous.type10Deltas.map(row=>row.id).sort(),'Restore target equals previous ledger balance; no new type10');
   const warningVisible=JSON.stringify(zero).includes('Tipo10 anterior mantido');
   save('items-zero-observation.json',{at:new Date().toISOString(),container_id:cid,item_container_id:id,zero,restored,type10IdsRetained:[...beforeIds],warningVisible,warningObservation:warningVisible?'warning visible in native record response':'Native PHP currently returns record only and audit importer omits warnings; no claim that warning was exposed. Legacy retention proven by confirmed snapshots and unchanged ledger IDs.'});
   evidence.checks.push('zero allocation/confirmed with fiscal flags false, restore3/5, retained type10 balance without new delta');
  }else if(mode==='logs'){
   await collectLogs();
  }else if(mode==='deallocate'){
   await parent();const id=ownedItem();assert.ok(exists('items-confirmed-logs.json'),'Capture confirmed ledgers before deallocation; legacy10 remains');quantities(await itemGet(id),3,5);
   await expected(await once('deallocate',()=>runtimeRaw('ciw.container-itens','delete',{id,context:ctx})));
   assert.equal((await itemRead()).data.length,0);await runtime('ciw.container-itens','get',{id,context:ctx},404);await collectLogs();evidence.checks.push('API deallocated item; before snapshot in Logs Exclusão; owned ledger manifest refreshed');
  }else if(mode==='delete-parent'){
   const cleanup=load('items-fixture-cleanup.json');scope(cleanup);assert.equal(cleanup.success,true);assert.equal(cleanup.synthetic_purchase_records_removed,true);assert.equal(cleanup.parent_preserved,true);await parent();assert.equal((await itemRead()).data.length,0);
   await expected(await once('delete-parent',()=>runtimeRaw('ciw.container-painel','delete',{id:cid,context:ctx})));assert.equal(await parent(false),null);
   const deleted=(await logRows('ciw.container-painel',cid,'delete')).filter(row=>row.meta?.audit?.source==='progress-transaction'&&row.meta.audit.resource==='containers'&&Number(row.meta.audit.recordId)===cid);
   assert.ok(deleted.some(row=>row.before?.narrativa?.startsWith(tag)&&Object.keys(row.after||{}).length===0));save('items-parent-deletion-logs.json',deleted);evidence.checks.push('parent API delete after fixture cleanup; fiscal cleanup and before snapshot audited');
  }else{
   const master=await parent(false);const observations={at:new Date().toISOString(),container_id:cid,parent:master,attempts:fs.readdirSync(folder).filter(name=>name.startsWith('items-attempt-')).map(name=>({file:name,...load(name)}))};
   if(master)observations.items=await itemRead();if(exists('items-fixture-owned.json')){observations.owned=ownership();observations.confirmedLogs=await logRows('ciw.container-painel',cid);}
   save('items-inspect-'+Date.now()+'.json',observations);evidence.checks.push('read-only recovery snapshots; no mutation retries');
  }
  save('items-http-'+mode+'-evidence.json',evidence);console.log('PASS '+mode+': '+evidence.checks.length+' checks; private evidence saved.');
 }finally{try{await expected(await apiRaw('/api/auth/logout',{}));}catch{save('items-logout-observation.json',{at:new Date().toISOString(),logout:'unconfirmed; no business retry'});}}
})().catch(error=>{save('items-http-'+mode+'-failure.json',{at:new Date().toISOString(),mode,container_id:cid,code:error.code||'HARNESS_FAILED',message:error.safeHarnessMessage?error.message:'Assertion/action failed; inspect private responses and committed audit before retry.',recoveryModes:['inspect','logs']});console.error(error.safeHarnessMessage?error.message:'FAIL '+mode+': inspect private evidence; do not retry mutations automatically.');process.exitCode=1;});
