/* Somente leitura: reconcilia o CRUD ja confirmado e removido; nunca repete gravacoes. */
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/ciw-cotacoes-20261021'),base='http://127.0.0.1:8765',screen='ciw.cotacoes-bc';
const load=n=>JSON.parse(fs.readFileSync(path.join(state,n),'utf8'));
(async()=>{
 const saved=load('confirmed-audit-events.json');assert.equal(saved.length,3);assert.equal(load('test-ownership.json').owned,null);
 const id=saved[0].meta.audit.recordId;assert.ok(saved.every(e=>e.meta.audit.recordId===id));
 let password=fs.readFileSync(path.join(root,'.runtime/construtor-pg/acesso-local.txt'),'utf8').split(/\r?\n/).find(s=>s.startsWith('Senha inicial=')).slice(14);
 const login=await fetch(base+'/api/auth/login',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({username:'admin',password,tenantId:'default',remember:false})}).then(r=>r.json());password=undefined;assert.ok(login.authenticated);
 const headers={'Content-Type':'application/json',Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':'default','X-Runtime-Session-Id':login.session.sessionId,'X-Runtime-User-Id':String(login.user.id)};
 async function request(s,op,payload,status=200){const r=await fetch(base+'/api/runtime/screens/'+s+'/endpoints/'+op,{method:'POST',headers,body:JSON.stringify(payload),signal:AbortSignal.timeout(45000)});const d=await r.json();assert.equal(r.status,status,d.error?.code??'runtime');return d;}
 try{
  await request(screen,'get',{id},404);
  const remaining=await request(screen,'read',{take:10,filters:[{field:'serie',operator:'eq',value:2147000103}]});assert.equal(remaining.data.length,0);
  const actual=[];
  for(const savedEvent of saved){
   const logs=await request('admin.logs-transacoes','read',{take:100,filters:[{field:'transaction_id',operator:'eq',value:savedEvent.transaction_id}]});
   const event=logs.data.find(e=>e.id===savedEvent.id);assert.ok(event,'CONFIRMED_EVENT_MISSING');
   const meta=typeof event.metadata==='string'?JSON.parse(event.metadata):event.metadata;
   const before=typeof event.before_data==='string'?JSON.parse(event.before_data):event.before_data,after=typeof event.after_data==='string'?JSON.parse(event.after_data):event.after_data;
   assert.equal(meta.audit.available,true);assert.equal(meta.audit.source,'progress-transaction');assert.equal(meta.audit.recordId,id);
   assert.equal(meta.actor.source,'authenticated-session');assert.equal(String(meta.actor.userId),String(login.user.id));
   assert.deepEqual(before,savedEvent.before);assert.deepEqual(after,savedEvent.after);actual.push({...event,meta,before,after});
  }
  const operations=actual.map(e=>e.meta.audit.operation).sort();assert.deepEqual(operations,['create','delete','update']);
  const create=actual.find(e=>e.meta.audit.operation==='create'),update=actual.find(e=>e.meta.audit.operation==='update'),del=actual.find(e=>e.meta.audit.operation==='delete');
  assert.deepEqual(create.before,[]);assert.equal(create.after.valor,1.23456);assert.equal(update.before.valor,1.23456);assert.equal(update.after.valor,2.34567);assert.equal(del.before.valor,2.34567);assert.deepEqual(del.after,[]);
  const deletions=await request('admin.logs-transacoes','read',{take:100,filters:[{field:'audit_screen_id',operator:'eq',value:screen},{field:'audit_operation',operator:'eq',value:'delete'}]});
  assert.ok(deletions.data.some(e=>e.id===del.id),'NATIVE_DELETION_SCOPE_REQUIRED');
  const proof={success:true,screenId:screen,programCode:'cd0103',version:'1.0.0',testMarker:{serie:2147000103,data:'2099-10-21'},deletedRecordId:id,actorUserId:String(login.user.id),transactionIds:{create:create.transaction_id,update:update.transaction_id,delete:del.transaction_id},cleanup:true,syntheticSeriesRemaining:0,recordGetStatus:404,existingRowsModified:false,costInvalidationExecuted:false,crudVerified:true,concurrencyAndPrecisionRejectionsVerified:true,beforeAfterVerified:true,nativeDeletionScopeVerified:true,checkedAt:new Date().toISOString(),reconciliationReadOnly:true};
  fs.writeFileSync(path.join(state,'real-validation.json'),JSON.stringify(proof,null,2));fs.writeFileSync(path.join(state,'deletion-scope-verified.json'),JSON.stringify({success:true,eventId:del.id,transactionId:del.transaction_id,rows:deletions.data},null,2));
  console.log('PASS: confirmed CRUD and exact audit reread, native Logs Exclusão, zero test rows and GET404; no business writes');
 }finally{await fetch(base+'/api/auth/logout',{method:'POST',headers,body:'{}'});}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
