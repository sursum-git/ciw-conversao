'use strict';
// Authorized new fixture only. Credentials arrive over an anonymous pipe, never files/arguments.
const c=require('./purchase-payments-builder-common.cjs'),{fs,path,assert}=c;
const state=path.join(c.root,'.runtime/container-allocation-batch-20261026'),dir=path.join(state,'exercise');
const TAG='SC_TEST_ALOC_LOTE_20261026',ERP='ZTSC261026',CID=2147000107;
const P='ciw.processos-compra-med',I='ciw.proc-compra-itens',C='ciw.container-painel',CI='ciw.container-itens',T='ciw.container-alocar-itens',L='admin.logs-transacoes';
const plain=r=>r?.data&&!Array.isArray(r.data)?r.data:r;
const save=(name,value)=>fs.writeFileSync(path.join(dir,name),JSON.stringify(value,null,2)+'\n',{flag:'wx',mode:0o600});
const read=name=>c.readJson(path.join(dir,name)),has=name=>fs.existsSync(path.join(dir,name));
function approval(){const a=c.readJson(path.join(state,'authorizations.json'));assert.equal(a.authorized,true);assert.equal(a.scenarioAuthorized,true);assert.equal(a.tag,TAG);assert.equal(a.containerId,CID);assert.equal(a.syntheticErp,ERP);assert.equal(a.newProcessCount,1);assert.equal(a.newPurchaseItems,3);assert.equal(a.maxNewExpenses,100);assert.equal(a.maxNewCalculations,10);assert.equal(a.existingRecordsWritable,false);assert.equal(a.titlesAllowed,false);assert.ok(a.humanApprovalReference);}
function confirmed(name){const x=read('confirmed-'+name+'.json');assert.equal(x.success,true);assert.equal(x.tag,TAG);return x.record;}
async function main(){
  const mode=process.argv[2];assert.ok(['login-check','setup','prepare-items','allocate','verify','cleanup','inspect'].includes(mode));approval();fs.mkdirSync(dir,{recursive:true});
  let secret=JSON.parse(fs.readFileSync(0,'utf8'));assert.equal(secret.username,'tadeu.parreiras');assert.equal(typeof secret.password,'string');
  const response=await fetch(c.base+'/api/auth/login',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({username:secret.username,password:secret.password,tenantId:'default',remember:false}),signal:AbortSignal.timeout(30000)});secret=undefined;
  const login=await response.json();assert.ok(response.ok&&login.authenticated&&login.token,'LDAP_AUTHENTICATION_FAILED');assert.equal(String(login.user.id),'tadeu.parreiras');
  const headers={'Content-Type':'application/json',Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
  const request=async(screen,op,body)=>{const r=await fetch(c.base+'/api/runtime/screens/'+screen+(op?'/endpoints/'+op:''),{method:body===undefined?'GET':'POST',headers,...(body===undefined?{}:{body:JSON.stringify(body)}),signal:AbortSignal.timeout(150000)});return {status:r.status,body:await r.json()};};
  const call=async(screen,op,body,status=200)=>{const r=await request(screen,op,body);assert.equal(r.status,status,screen+'/'+op+' HTTP'+r.status+' '+(r.body.error?.code??''));if(status===200)assert.ok(!r.body.error,screen+'/'+op);return r.body;};
  const get=async(screen,id,context)=>plain(await call(screen,'get',{id,...(context?{context}:{})}));
  const stage=async(name,fn)=>{assert.ok(!has('confirmed-'+name+'.json'),'STAGE_ALREADY_CONFIRMED '+name);const result=await fn();save('confirmed-'+name+'.json',{success:true,tag:TAG,actor:login.user.id,record:result,at:new Date().toISOString()});console.log('PASS allocation stage '+name);return result;};
  const once=async(name,screen,op,body,expected=200)=>{
    assert.ok(!has('started-'+name+'.json')&&!has('response-'+name+'.json'),'NO_REPLAY_INSPECT_RECEIPTS '+name);
    save('started-'+name+'.json',{tag:TAG,actor:login.user.id,screen,operation:op,body,at:new Date().toISOString()});
    const r=await request(screen,op,body);save('response-'+name+'.json',r);
    assert.equal(r.status,expected,screen+'/'+op+' HTTP'+r.status+' '+(r.body.error?.code??''));if(expected===200)assert.ok(!r.body.error,screen+'/'+op);return r.body;
  };
  const order=()=>confirmed('create-parent'),context=()=>({proc_compra_id:order().proc_compra_id}),containerContext={container_id:CID};
  const itemReceipts=()=>['A','B','C'].filter(x=>has('confirmed-create-item-'+x+'.json')).map(x=>confirmed('create-item-'+x));
  const listAllocations=async()=>{const r=await call(CI,'read',{context:containerContext,skip:0,take:100});assert.equal(r.total,r.data.length);assert.ok(r.data.length<=2);for(const row of r.data){assert.equal(row.container_id,CID);assert.ok(itemReceipts().some(x=>x.item_proc_compra_id===row.item_proc_compra_id));}return r.data;};
  const logs=async(screen,id)=>{const r=await call(L,'read',{take:1000,skip:0,sort:[{field:'id',dir:'asc'}],filters:[{field:'audit_screen_id',operator:'eq',value:screen},{field:'audit_record_id',operator:'eq',value:id}]});assert.equal(r.total,r.data.length);return r.data.map(x=>({...x,meta:typeof x.metadata==='string'?JSON.parse(x.metadata):x.metadata,before:typeof x.before_data==='string'?JSON.parse(x.before_data):x.before_data,after:typeof x.after_data==='string'?JSON.parse(x.after_data):x.after_data}));};
  async function verify(){
    const allocation=confirmed('allocate');assert.equal(allocation.audit?.available,true);assert.equal(allocation.audit.allocatedCount,2);assert.equal(allocation.audit.skippedCount,0);
    const rows=await listAllocations();assert.equal(rows.length,2);const owned=itemReceipts();
    for(const row of rows){const origin=owned.find(x=>x.item_proc_compra_id===row.item_proc_compra_id);assert.equal(row.qt_alocada,origin.qt_comprada);assert.equal(row.qt_confirm_emb,0);}
    const events=await logs(C,CID),roots=events.filter(x=>x.event_type==='container_alocacao_progress.api.process'&&x.meta?.audit?.available===true);
    assert.equal(roots.length,2,'allocation and explicit repeat');
    const first=roots.find(x=>x.meta.audit.allocatedCount===2);assert.ok(first);assert.equal(first.meta.audit.containerId,CID);assert.equal(first.meta.audit.operation,'allocate');
    const batch=events.filter(x=>x.transaction_id===first.transaction_id&&x.meta?.audit?.available===true);
    const creations=batch.filter(x=>x.meta.audit.resource==='itens_container'&&x.meta.audit.operation==='create');assert.equal(creations.length,2);
    for(const e of batch){assert.equal(e.actor_user_id,'tadeu.parreiras');assert.equal(e.meta.actor.username,'tadeu.parreiras');assert.equal(e.meta.actor.source,'authenticated-session');assert.equal(e.meta.audit.containerId,CID);}
    for(const row of rows){const event=creations.find(x=>x.meta.audit.recordId===row.item_container_id);assert.ok(event);assert.equal(Object.keys(event.before).length,0);assert.equal(event.after.qt_alocada,row.qt_alocada);assert.equal(event.after.item_proc_compra_id,row.item_proc_compra_id);const physical=c.readJson(path.join(state,'physical-allocated/probe.json'));const actual=physical.allocations.find(x=>x.item_container_id===row.item_container_id);assert.ok(actual);assert.deepEqual(event.after,actual,'Complete15field physical after image');assert.ok((await logs(CI,row.item_container_id)).some(x=>x.transaction_id===first.transaction_id));}
    const repeat=roots.find(x=>x.meta.audit.skippedCount===2);assert.ok(repeat);assert.deepEqual(repeat.before,repeat.after);
    assert.ok(!batch.some(x=>['item_custos','item_container_custos','container_versions','versoes_item_custo_container','cta_corren_fornec_imp','pagtos_container'].includes(x.meta.audit.resource)),'No titles, stock, cost closing or financial forecast effects');
    save('frozen-allocations.json',{tag:TAG,containerId:CID,rows});save('batch-logs-proof.json',{success:true,tag:TAG,transactionId:first.transaction_id,repeatTransactionId:repeat.transaction_id,actor:'tadeu.parreiras',before:first.before,after:first.after,events:batch,allocations:rows});
    return {transactionId:first.transaction_id,repeatTransactionId:repeat.transaction_id,confirmedEvents:batch.length,actor:'tadeu.parreiras',allocationIds:rows.map(x=>x.item_container_id),beforeAfterVerified:true};
  }
  try{
    if(mode==='login-check'){
      for(const screen of [P,I,CI,C,T]){const d=(await call(screen)).permissions;assert.equal(d.read,true);if(screen===T)assert.equal(d.process,true);else if(screen===P||screen===I){assert.equal(d.create,true);assert.equal(d.edit,true);assert.equal(d.delete,true);}}
      save('ldap-login-check.json',{success:true,user:login.user.id,readAndProcess:true,existingCrudPermissionsPreserved:true});console.log('PASS own LDAP session and required existing permissions');return;
    }
    if(mode==='prepare-items'){
      assert.equal(confirmed('preflight').markerAbsent,true);const parent=await get(P,order().proc_compra_id);assert.equal(parent.cod_proc_fornec,TAG);assert.equal(parent.log_considerar_previsao,false);
      const existing=await call(I,'read',{context:context(),skip:0,take:10});assert.equal(existing.total,0,'Failed alphanumeric request created no item');
      const rejected=read('response-create-item-A.json');assert.equal(rejected.status,422);assert.equal(rejected.body.error.code,'PURCHASE_ITEM_VALIDATION');assert.equal(rejected.body.error.message,'Codigo ERP aceita somente digitos.');
      const fields=c.readJson('D:/opencode/construtor-pg/integrations/ciw-purchase-items/proc-compra-itens-builder-draft.json').entityDraft.fields.filter(x=>!x.readonlyField&&x.options?.writable===true);assert.equal(fields.length,44);
      for(const [label,quantity]of [['A',3],['B',5],['C',0]])await stage('create-item-'+label,async()=>{const values=Object.fromEntries(fields.map(x=>{assert.ok(Object.hasOwn(x.options,'defaultValue'));return[x.code,x.options.defaultValue];}));Object.assign(values,{descricao:TAG+'/'+label,observacao:TAG+'/'+label,codigo_erp:'',unid_medida:'MT',qt_comprada:quantity,vl_base_tributacao:2,vl_negociado:2,vl_custo_dolar:2});const row=plain(await once('create-blank-item-'+label,I,'create',{context:context(),record:values}));assert.equal(row.proc_compra_id,order().proc_compra_id);assert.equal(row.codigo_erp,'');assert.equal(row.qt_comprada,quantity);return row;});
      return;
    }
    if(mode==='setup'||mode==='allocate'){
      if(mode==='setup'){
      await stage('preflight',async()=>{const physical=c.readJson(path.join(state,'physical-before/probe.json'));assert.equal(physical.success,true);for(const v of Object.values(physical))if(Array.isArray(v))assert.equal(v.length,0);const rows=await call(P,'read',{take:1,skip:0,filters:[{field:'cod_proc_fornec',operator:'eq',value:TAG}]});assert.equal(rows.total,0);await call(C,'get',{id:CID,context:containerContext},404);return {markerAbsent:true,physicalAbsent:true};});
      await stage('create-parent',async()=>{const row=plain(await once('create-parent',P,'create',{record:{cod_situacao:1,cod_proc_fornec:TAG,observacao:TAG,dt_registro:'2026-10-26',fornecedor_id:26715,qt_dias_translado:0,dt_limite:null,log_facilid_contato_fornec:true,log_considerar_previsao:false,nr_container_original:''}}));assert.ok(Number.isInteger(row.proc_compra_id)&&row.proc_compra_id>0);assert.equal(row.empresa_id,2);assert.equal(row.cod_proc_fornec,TAG);assert.equal(row.log_considerar_previsao,false);return row;});
      const fields=c.readJson('D:/opencode/construtor-pg/integrations/ciw-purchase-items/proc-compra-itens-builder-draft.json').entityDraft.fields.filter(x=>!x.readonlyField&&x.options?.writable===true);assert.equal(fields.length,44);
      for(const [label,quantity]of [['A',3],['B',5],['C',0]])await stage('create-item-'+label,async()=>{const values=Object.fromEntries(fields.map(x=>{assert.ok(Object.hasOwn(x.options,'defaultValue'));return[x.code,x.options.defaultValue];}));Object.assign(values,{descricao:TAG+'/'+label,observacao:TAG+'/'+label,codigo_erp:ERP,unid_medida:'MT',qt_comprada:quantity,vl_base_tributacao:2,vl_negociado:2,vl_custo_dolar:2});const row=plain(await once('create-item-'+label,I,'create',{context:context(),record:values}));assert.equal(row.proc_compra_id,order().proc_compra_id);assert.equal(row.codigo_erp,ERP);assert.equal(row.qt_comprada,quantity);return row;});
      }
      if(mode==='allocate'){const proof=c.readJson(path.join(state,'private-code-fixture/v2/fixture.json'));assert.equal(proof.success,true);assert.equal(proof.parentId,order().proc_compra_id);assert.equal(proof.erp,ERP);for(const row of itemReceipts()){const current=await get(I,row.item_proc_compra_id,context());assert.equal(current.codigo_erp,ERP);assert.equal(current.descricao,row.descricao);}}
      if(!has('confirmed-create-container.json')) await stage('create-container',async()=>{
        assert.ok(!has('started-create-container.json'));save('started-create-container.json',{tag:TAG,containerId:CID,actor:login.user.id,at:new Date().toISOString()});
        const token=c.readJson(path.join(c.root,'.runtime/construtor-pg/containers-connection.json')).integrationToken;
        const body={resource:'containers',operation:'create',container_id:CID,values:{narrativa:TAG,cod_estabel:'505',cod_emit_forn:26715,situacao_container_id:7,ordem_busca_dolar_compra:'2',ordem_busca_dolar_di:'4',cod_tipo_proj_dolar:1,vl_dolar_compra:5,vl_dolar_di:5,vl_proj_dolar:0,vl_dolar_venda:5,log_gerar_saldo_a_pagar:false,log_gerar_distr_custo:false,log_liberar_custo_realizado:false}};
        const response=await fetch('http://127.0.0.1:19910/med/web/SursumPrograms/containers-cabecalho',{method:'POST',headers:{'Content-Type':'application/json','X-Containers-Token':token,'X-Sursum-User':String(login.user.id)},body:JSON.stringify(body),signal:AbortSignal.timeout(120000)});const r=await response.json();save('response-create-container.json',r);assert.equal(r.success,true);assert.equal(r.audit.recordId,CID);const row=await get(C,CID,containerContext);assert.equal(row.narrativa,TAG);assert.equal(row.log_gerar_saldo_a_pagar,false);assert.equal(row.log_gerar_distr_custo,false);return row;
      });
      const [a,b,z]=itemReceipts();
      if(!has('confirmed-reject-invalid-balance.json')) await stage('reject-invalid-balance',async()=>{
        let response;
        if(has('response-reject-invalid-balance.json')){
          const sent=read('started-reject-invalid-balance.json'),received=read('response-reject-invalid-balance.json');
          assert.deepEqual(sent.body,{context:containerContext,parameters:{item_ids:[a.item_proc_compra_id,z.item_proc_compra_id]}});
          assert.equal(received.status,409);response=received.body;
        }else response=await once('reject-invalid-balance',T,'run',{context:containerContext,parameters:{item_ids:[a.item_proc_compra_id,z.item_proc_compra_id]}},409);
        assert.equal(response.error.code,'CONTAINER_ALLOCATION_BALANCE');assert.equal((await listAllocations()).length,0);return {rejected:true,noAllocations:true,httpStatus:409,requestNotRepeated:true};
      });
      await stage('allocate',async()=>{const r=await once('allocate',T,'run',{context:containerContext,parameters:{item_ids:[b.item_proc_compra_id,a.item_proc_compra_id]}});assert.equal(r.status,'succeeded');assert.equal(r.audit?.available,true);assert.equal(r.audit.allocatedCount,2);assert.equal(r.audit.skippedCount,0);return r;});
      await stage('repeat',async()=>{const before=await listAllocations(),r=await once('repeat',T,'run',{context:containerContext,parameters:{item_ids:[a.item_proc_compra_id,b.item_proc_compra_id]}});assert.equal(r.status,'succeeded');assert.equal(r.audit?.available,true);assert.equal(r.audit.allocatedCount,0);assert.equal(r.audit.skippedCount,2);assert.deepEqual(await listAllocations(),before);return r;});
      await stage('verify',verify);return;
    }
    if(mode==='verify'){await stage('verify',verify);return;}
    if(mode==='inspect'){
      const result={tag:TAG,actor:login.user.id};result.parent=await request(C,'get',{id:CID,context:containerContext});if(result.parent.status===200){result.allocations=await listAllocations();result.logs=await logs(C,CID);}save('inspection-'+Date.now()+'.json',result);console.log('PASS read-only recovery inspection');return;
    }
    // Cleanup is an explicit second phase, only after an independent physical receipt.
    const physical=c.readJson(path.join(state,'physical-allocated/probe.json'));assert.equal(physical.success,true);assert.equal(physical.parents.length,1);assert.equal(physical.parents[0].narrativa,TAG);assert.equal(physical.orders.length,1);assert.equal(physical.purchaseItems.length,3);assert.equal(physical.allocations.length,2);assert.ok(physical.expenses.length<=100);assert.ok(physical.calculations.length<=10);assert.equal(physical.ledger.length,0);assert.equal(physical.containerPayments.length,0);assert.equal(physical.versions.length,0);assert.equal(physical.erpCosts.length,0);
    const frozen=read('frozen-allocations.json');assert.equal(frozen.tag,TAG);assert.deepEqual(await listAllocations(),frozen.rows);
    for(const row of frozen.rows)await stage('delete-allocation-'+row.item_container_id,async()=>{const current=await get(CI,row.item_container_id,containerContext);assert.equal(current.item_proc_compra_id,row.item_proc_compra_id);assert.equal(current.qt_alocada,row.qt_alocada);assert.equal(current.qt_confirm_emb,0);return once('delete-allocation-'+row.item_container_id,CI,'delete',{id:row.item_container_id,context:containerContext});});
    assert.equal((await listAllocations()).length,0);
    for(const row of itemReceipts())await stage('delete-item-'+row.item_proc_compra_id,async()=>{const current=await get(I,row.item_proc_compra_id,context());assert.equal(current.proc_compra_id,order().proc_compra_id);assert.equal(current.codigo_erp,ERP);assert.equal(current.descricao,row.descricao);return once('delete-item-'+row.item_proc_compra_id,I,'delete',{id:row.item_proc_compra_id,context:context(),record:current});});
    await stage('delete-parent',async()=>{const current=await get(P,order().proc_compra_id);assert.equal(current.cod_proc_fornec,TAG);assert.equal(current.log_considerar_previsao,false);return once('delete-parent',P,'delete',{id:current.proc_compra_id,record:current});});
    await stage('delete-container',async()=>{const current=await get(C,CID,containerContext);assert.equal(current.narrativa,TAG);assert.equal(current.log_gerar_saldo_a_pagar,false);return once('delete-container',C,'delete',{id:CID,context:containerContext});});
    await stage('verify-cleanup',async()=>{await call(C,'get',{id:CID,context:containerContext},404);await call(P,'get',{id:order().proc_compra_id},404);const events=await logs(C,CID);const creations=events.filter(x=>x.transaction_id===read('batch-logs-proof.json').transactionId&&x.meta?.audit?.available===true);assert.equal(creations.length,read('batch-logs-proof.json').events.length);for(const row of frozen.rows){const deleted=events.find(x=>x.meta?.audit?.resource==='itens_container'&&x.meta.audit.operation==='delete'&&x.meta.audit.recordId===row.item_container_id);assert.ok(deleted);assert.equal(deleted.before.qt_alocada,row.qt_alocada);assert.equal(Object.keys(deleted.after).length,0);assert.equal(deleted.actor_user_id,'tadeu.parreiras');}return {ownParentAndContainerAbsent:true,logsPreserved:events.length,actor:'tadeu.parreiras'};});
  }finally{await fetch(c.base+'/api/auth/logout',{method:'POST',headers,body:'{}',signal:AbortSignal.timeout(15000)});}
}
if(require.main===module)main().catch(e=>{console.error('Stage unconfirmed: '+e.message+'; inspect durable receipts; do not replay writes.');process.exitCode=1;});
