// Somente o cenário novo explicitamente autorizado. Recibos privados, sem replay.
'use strict';
const c=require('./purchase-payments-builder-common.cjs');
const f=c.path.join(c.state,'fixture-v2'),pid=2147000104,items=[2147000201,2147000202],tag='SC_TEST_PAGTO_PROC_20261022';
const mode=process.argv[2];c.assert.ok(['create','unlink-first','unlink-second','inspect'].includes(mode));
const read=n=>c.readJson(c.path.join(f,n));
const save=(n,v)=>c.fs.writeFileSync(c.path.join(f,n),JSON.stringify(v,null,2)+'\n');
const auth=c.readJson(c.path.join(c.state,'user-authorization.json'));
c.assert.equal(auth.authorized,true);c.assert.equal(auth.proc_compra_id,pid);c.assert.deepEqual(auth.item_proc_compra_ids,items);c.assert.equal(auth.existingTitleWritesAllowed,false);
const config=read('fixture-config.json'),setup=read('fixture-setup.json');
c.assert.equal(config.proc_compra_id,pid);c.assert.equal(config.tag,tag);c.assert.deepEqual(config.item_proc_compra_ids,items);
c.assert.equal(setup.success,true);c.assert.equal(setup.fixture_created_new,true);c.assert.equal(setup.committed,true);c.assert.equal(setup.proc_compra_id,pid);
const titles=config.approved_titles.map(x=>x.num_id_tit_ap).sort((a,b)=>a-b);c.assert.equal(titles.length,2);c.assert.equal(new Set(titles).size,2);
const screen='ciw.proc-compra-pagamentos',context={proc_compra_id:pid};
const contractRetry=process.argv.includes('--after-contract-fix');
if(contractRetry){const rejected=c.readJson(c.path.join(c.state,'rejected-create-review.json'));c.assert.equal(rejected.reviewed,true);c.assert.equal(rejected.status,'failed');c.assert.equal(rejected.recordCount,0);const publication=c.readJson(c.path.join(c.state,'publication-proc-compra-pagamentos.json'));c.assert.equal(publication.version,'1.0.1');}
const decode=v=>typeof v==='string'?JSON.parse(v):v;
const record=v=>v?.data&&!Array.isArray(v.data)?v.data:v;
const empty=v=>v&&Object.keys(v).length===0;
async function once(label,action){
 const name='api-attempt-'+label+'.json';
 c.fs.writeFileSync(c.path.join(f,name),JSON.stringify({mode:label,proc_compra_id:pid,tag,at:new Date().toISOString(),outcome:'unknown-inspect-no-replay'}),{flag:'wx'});
 const result=await action();save('api-response-'+label+'.json',result);return result;
}
async function run(){return c.session(async({runtime,login})=>{
 const actor=login.user.username;c.assert.equal(actor,'admin');
 const call=(op,data)=>runtime(screen+'/endpoints/'+op,{...data,context});
 async function audit(){
  const result=await runtime('admin.logs-transacoes/endpoints/read',{take:500,skip:0,filters:[{field:'audit_screen_id',operator:'eq',value:'ciw.processos-compra-financeiro-med'},{field:'audit_record_id',operator:'eq',value:pid}],sort:[{field:'id',dir:'asc'}]});
  c.assert.ok(Array.isArray(result.data));c.assert.ok(result.total<=500);
  return result.data.map(x=>({...x,meta:decode(x.metadata),before:decode(x.before_data),after:decode(x.after_data)})).filter(x=>x.meta?.audit?.available===true&&x.meta.audit.procCompraId===pid);
 }
 function confirmActor(rows){for(const row of rows)c.assert.equal(row.actor_user_id,actor);}
 function links(rows,op){return rows.filter(x=>x.meta.audit.resource==='purchase_payment_links'&&x.meta.audit.operation===op);}
 if(mode==='create'){
  c.assert.deepEqual((await call('read',{take:100,skip:0})).data,[]);
  const options=await call('options.titulos',{});const values=options.data??options.options??options;
  c.assert.ok(Array.isArray(values));for(const title of titles)c.assert.ok(values.some(x=>(x.value??x.num_id_tit_ap)===title||String(x.value??x.num_id_tit_ap)===String(title)),'AUTHORIZED_TITLE_NOT_AVAILABLE');
  const response=await once(contractRetry?'create-contract-fixed':'create',()=>call('create',{record:{titulos:titles}}));
  const page=await call('read',{take:100,skip:0});c.assert.equal(page.data.length,2);c.assert.deepEqual(page.data.map(x=>x.num_id_tit_ap).sort((a,b)=>a-b),titles);
  for(const row of page.data){c.assert.equal(row.proc_compra_id,pid);c.assert.deepEqual(row.titulos,[row.num_id_tit_ap]);c.assert.deepEqual(record(await call('get',{id:row.pagamento_key})),row);}
  const rows=await audit();save('audit-after-create.json',rows);const created=links(rows,'create');c.assert.equal(created.length,2);confirmActor(created);
  c.assert.equal(new Set(created.map(x=>x.transaction_id)).size,1);
  const ledger=rows.filter(x=>x.meta.audit.resource==='cta_corren_fornec_imp');c.assert.equal(ledger.length,4);confirmActor(ledger);
  for(const row of created){c.assert.ok(empty(row.before));c.assert.equal(row.after.proc_compra_id,pid);c.assert.ok(titles.includes(row.after.num_id_tit_ap));}
  for(const row of ledger){c.assert.ok(empty(row.before));c.assert.equal(row.after.proc_compra_id,pid);c.assert.ok(items.includes(row.after.item_proc_compra_id));c.assert.equal(row.after.cod_tipo_movto,4);c.assert.equal(row.after.login,actor);c.assert.equal(row.after.item_container_id,0);c.assert.equal(row.after.transacao_id,0);
   const title=created.find(x=>x.after.num_id_tit_ap===row.after.num_id_tit_ap).after;
   const expected=Math.round((title.valor_dolar*(row.after.item_proc_compra_id===items[0]?0.25:0.75)+Number.EPSILON)*100)/100;
   c.assert.ok(Math.abs(row.after.vl_lancto+expected)<0.005,'SHARED_ALLOCATION_VALUE');
  }
  save('api-create-confirmed.json',{success:true,proc_compra_id:pid,tag,actor,transaction_id:Number(created[0].transaction_id),links:page.data,ledger_rows:ledger.map(x=>x.after),nativeLogImages:true});
 }else if(mode.startsWith('unlink-')){
  const created=read('api-create-confirmed.json');const target=created.links.find(x=>x.num_id_tit_ap===titles[mode==='unlink-first'?0:1]);c.assert.ok(target);
  c.assert.equal(record(await call('get',{id:target.pagamento_key})).pagamento_key,target.pagamento_key);
  await once(mode,()=>call('delete',{id:target.pagamento_key}));
  const page=await call('read',{take:100,skip:0});c.assert.ok(!page.data.some(x=>x.pagamento_key===target.pagamento_key));
  const rows=await audit();save('audit-after-'+mode+'.json',rows);
  const deleted=links(rows,'delete').filter(x=>x.meta.audit.recordId===target.pagamento_key);c.assert.equal(deleted.length,1);confirmActor(deleted);
  const log=deleted[0];c.assert.deepEqual(log.before,target);c.assert.ok(empty(log.after));
  const ledger=rows.filter(x=>x.meta.audit.resource==='cta_corren_fornec_imp'&&String(x.transaction_id)===String(log.transaction_id));c.assert.equal(ledger.length,2);confirmActor(ledger);
  for(const row of ledger){c.assert.equal(row.after.login,actor);const original=created.ledger_rows.find(x=>x.num_id_tit_ap===row.after.num_id_tit_ap&&x.item_proc_compra_id===row.after.item_proc_compra_id);c.assert.ok(original);c.assert.ok(Math.abs(row.after.vl_lancto+original.vl_lancto)<0.005,'STORNO_BALANCE');}
  save('api-'+mode+'-confirmed.json',{success:true,proc_compra_id:pid,num_id_tit_ap:target.num_id_tit_ap,pagamento_key:target.pagamento_key,create_transaction_id:created.transaction_id,delete_transaction_id:Number(log.transaction_id),delete_confirmed:true,ledger_rows:ledger.map(x=>x.after),actor,nativeLogImages:true});
  if(mode==='unlink-second'){
   c.assert.deepEqual(page.data,[]);const a=read('api-unlink-first-confirmed.json'),b=read('api-unlink-second-confirmed.json');
   const owned={version:1,proc_compra_id:pid,item_proc_compra_ids:items,tag,source:'runtime-confirmed-audit',setup_guard_sha256:setup.setup_guard_sha256,links_unlinked:[a,b].map(x=>({num_id_tit_ap:x.num_id_tit_ap,pagamento_key:x.pagamento_key,create_transaction_id:x.create_transaction_id,delete_transaction_id:x.delete_transaction_id,delete_confirmed:x.delete_confirmed})),ledger_rows:[...created.ledger_rows,...a.ledger_rows,...b.ledger_rows]};
   c.assert.equal(owned.ledger_rows.length,8);c.assert.equal(new Set(owned.ledger_rows.map(x=>x.cta_corren_fornec_imp_id)).size,8);save('fixture-cleanup-owned.json',owned);
  }
 }else{save('api-inspection.json',{at:new Date().toISOString(),proc_compra_id:pid,links:await call('read',{take:100,skip:0}),audit:await audit()});}
 console.log('PASS: cenário autorizado '+mode+'; recibos privados, usuário e imagens conferidos.');
},{readOnly:false});}
run().catch(e=>{save('api-failure-'+mode+(contractRetry?'-contract-fixed':'')+'.json',{message:e.message,at:new Date().toISOString(),noAutomaticRetry:true});console.error('Falha no cenário '+mode+': '+e.message+'; inspecionar recibos privados antes de qualquer repetição.');process.exitCode=1;});

