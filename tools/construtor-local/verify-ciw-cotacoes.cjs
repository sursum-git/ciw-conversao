/* Teste fechado: somente nova cotacao sintetica, nunca serie9999 nem registros existentes. */
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/ciw-cotacoes-20261021'),base='http://127.0.0.1:8765',screen='ciw.cotacoes-bc';
const marker={serie:2147000103,data:'2099-10-21'},fields=['hist_cotacao_bc_id','data','serie','valor','dt_hr_busca','nome_serie','log_ok','log_manual','row_stamp'];
const image=r=>Object.fromEntries(fields.map(k=>[k,r[k]]));
const unwrap=d=>d.record&&typeof d.record==='object'?d.record:d.data&&typeof d.data==='object'&&!Array.isArray(d.data)?d.data:d;
const same=(a,b)=>assert.deepEqual(image(a),image(b),'OWNED_ROW_CHANGED; preserve and inspect');
let headers,owned=null;const proof={screenId:screen,marker,existingRowsModified:false,costInvalidationExecuted:false,checks:[]};
const save=(name,data)=>fs.writeFileSync(path.join(state,name),JSON.stringify(data,null,2));
async function request(url,body,status=200){
 const r=await fetch(base+url,{method:body===undefined?'GET':'POST',headers,...(body===undefined?{}:{body:JSON.stringify(body)}),signal:AbortSignal.timeout(45000)});
 const d=await r.json();assert.equal(r.status,status,'Unexpected HTTP '+r.status+' '+(d.error?.code??'runtime'));return d;
}
const api=(op,body,status)=>request('/api/runtime/screens/'+screen+'/endpoints/'+op,body,status);
function journal(){save('test-ownership.json',{marker,owned:owned?image(owned):null});}
(async()=>{
 let password=fs.readFileSync(path.join(root,'.runtime/construtor-pg/acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const login=await fetch(base+'/api/auth/login',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({username:'admin',password,tenantId:'default',remember:false})}).then(r=>r.json());password=undefined;assert.ok(login.authenticated);
 headers={'Content-Type':'application/json',Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId,'X-Sursum-User':'forged-browser-user'};
 try{
  const definition=await request('/api/runtime/screens/'+screen);save('runtime-definition.json',definition);
  assert.equal(definition.program.id,'cd0103');assert.equal(definition.dataModel.primaryKey,'hist_cotacao_bc_id');
  assert.equal(definition.dataModel.fields.valor.decimals,5);assert.equal(definition.dataModel.fields.serie.type,'integer');
  assert.ok(definition.permissions.create&&definition.permissions.edit&&definition.permissions.delete);
  const rows=await api('read',{take:3,sort:[{field:'data',dir:'desc'}]});assert.ok(Array.isArray(rows.data));
  proof.checks.push('published definition, five-decimal value, integer series, native form, read');proof.readTotal=rows.total;
  if(rows.data[0]){const row=unwrap(await api('get',{id:rows.data[0].hist_cotacao_bc_id}));assert.equal(row.hist_cotacao_bc_id,rows.data[0].hist_cotacao_bc_id);proof.checks.push('existing detail read only');}
  const reserved=await api('read',{take:10,filters:[{field:'serie',operator:'eq',value:marker.serie}]});assert.equal(reserved.data.length,0,'SYNTHETIC_SERIES_ALREADY_EXISTS; no mutation');
  save('read-verification.json',{...proof,success:true});
  if(!process.argv.includes('--execute-owned-test')){console.log('PASS: published Cotações BC definition/read/get; no business writes');return;}
  assert.notEqual(marker.serie,9999);assert.equal(marker.data,'2099-10-21');
  const afterFix=process.argv.includes('--after-utc-fix');
  if(afterFix){
   const rejected=JSON.parse(fs.readFileSync(path.join(state,'first-create-rejected.json'),'utf8'));
   const probe=JSON.parse(fs.readFileSync(path.join(state,'validation-diagnosis.json'),'utf8'));
   assert.equal(rejected.owned,null);assert.match(rejected.message,/422 CIW_COTACAO_VALIDATION/);
   assert.ok(probe.ownedSeriesEmpty&&probe.absentTargetConfirmed);assert.ok(probe.results.every(r=>r.status===404));
   assert.equal(JSON.parse(fs.readFileSync(path.join(state,'utc-active-manifest.json'),'utf8')).context,'med');
  }
  fs.writeFileSync(path.join(state,afterFix?'crud-attempt-utc-fixed.json':'crud-attempt-once.json'),JSON.stringify({at:new Date().toISOString(),marker,afterConfirmedFix:afterFix,existingRowsAllowed:false,series9999Allowed:false}),{flag:'wx'});
  owned=unwrap(await api('create',{record:{...marker,valor:1.23456,dt_hr_busca:'2099-10-21T15:30:45.123Z'}}));
  assert.ok(Number.isInteger(owned.hist_cotacao_bc_id)&&owned.hist_cotacao_bc_id>0);assert.equal(owned.serie,marker.serie);assert.equal(owned.log_manual,true);assert.equal(owned.valor,1.23456);journal();
  const before={...owned};save('create-owned-image.json',image(owned));
  owned=unwrap(await api('update',{record:{...owned,valor:2.34567}}));assert.equal(owned.valor,2.34567);assert.notEqual(owned.row_stamp,before.row_stamp);journal();
  save('update-owned-image.json',image(owned));
  const stale=await api('update',{record:{...before,valor:9}},409);assert.equal(stale.error.code,'CIW_COTACAO_CHANGED');
  const precision=await api('update',{record:{...owned,valor:2.345678}},422);assert.equal(precision.error.code,'CIW_COTACAO_VALIDATION');
  same(unwrap(await api('get',{id:owned.hist_cotacao_bc_id})),owned);
  proof.checks.push('owned create/update, five decimals, obsolete hash rejected, excess precision rejected, unchanged final image');
  const id=owned.hist_cotacao_bc_id;save('delete-owned-image.json',image(owned));
  await api('delete',{id,record:owned});owned=null;journal();await api('get',{id},404);
  const txs=(await request('/api/runtime/screens/admin.transacoes/endpoints/read',{take:100,filters:[{field:'screen_id',operator:'eq',value:screen},{field:'session_id',operator:'eq',value:login.session.sessionId}]})).data;
  const events=[];
  for(const tx of txs){
   const rows=(await request('/api/runtime/screens/admin.logs-transacoes/endpoints/read',{take:100,filters:[{field:'transaction_id',operator:'eq',value:tx.id}]})).data;
   for(const row of rows){const m=typeof row.metadata==='string'?JSON.parse(row.metadata):row.metadata;
    if(/^hist_cotacoes_bc_progress\.api\.(create|update|delete)$/.test(row.event_type)&&m?.audit?.recordId===id){
     assert.equal(m.audit.available,true);assert.equal(m.audit.source,'progress-transaction');assert.equal(m.actor.source,'authenticated-session');assert.equal(String(m.actor.userId),String(login.user.id));
     events.push({...row,meta:m,before:typeof row.before_data==='string'?JSON.parse(row.before_data):row.before_data,after:typeof row.after_data==='string'?JSON.parse(row.after_data):row.after_data});
    }
   }
  }
  assert.equal(events.length,3,'CONFIRMED_CREATE_UPDATE_DELETE_AUDIT_REQUIRED');
  const update=events.find(e=>e.meta.audit.operation==='update'),del=events.find(e=>e.meta.audit.operation==='delete');
  assert.equal(update.before.valor,1.23456);assert.equal(update.after.valor,2.34567);assert.equal(del.before.valor,2.34567);assert.deepEqual(del.after,[]);
  save('confirmed-audit-events.json',events);
  proof.transactionIds=events.map(e=>e.transaction_id);proof.actorUserId=String(login.user.id);proof.deletedRecordId=id;
  const deletions=await request('/api/runtime/screens/admin.logs-transacoes/endpoints/read',{take:100,filters:[{field:'audit_screen_id',operator:'eq',value:screen},{field:'audit_operation',operator:'eq',value:'delete'}]});
  assert.ok(deletions.data.some(log=>log.id===del.id),'NATIVE_DELETION_SCOPE_REQUIRED');
  const remaining=await api('read',{take:10,filters:[{field:'serie',operator:'eq',value:marker.serie}]});assert.equal(remaining.data.length,0);
  proof.cleanup=true;proof.checks.push('three committed audit events from authenticated session with exact before/after','native Logs Exclusão scope','owned record removed and GET404');
  save('real-validation.json',{...proof,success:true});console.log('PASS: Cotações BC CRUD, concurrency, precision, authenticated audit and deletion scope; synthetic record removed');
 }finally{
  if(owned){
   const current=unwrap(await api('get',{id:owned.hist_cotacao_bc_id}));same(current,owned);
   assert.equal(current.serie,marker.serie);assert.equal(current.data,marker.data);assert.equal(current.log_manual,true);
   await api('delete',{id:owned.hist_cotacao_bc_id,record:owned});owned=null;journal();
  }
  await fetch(base+'/api/auth/logout',{method:'POST',headers,body:'{}'});
 }
})().catch(e=>{save('verification-error.json',{at:new Date().toISOString(),message:e.message,stack:e.stack,owned:owned?image(owned):null});console.error(e.message);process.exitCode=1;});
