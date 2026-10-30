'use strict';
// Exercício privado por etapas. Importar este módulo não lê credenciais nem usa HTTP.
const c=require('./purchase-orders-metadata-common.cjs'),crypto=require('node:crypto');
const {assert,fs,path}=c;
const TAG='SC_TEST_PROC_COMPRA_20261022',ITEMS=Object.freeze([2147000205,2147000206]);
const SCREEN='ciw.processos-compra-med',PAYMENTS='ciw.proc-compra-pagamentos',FINANCIAL='ciw.processos-compra-financeiro-med';
const FIELDS=Object.freeze('proc_compra_id,empresa_id,qt_container,cod_situacao,cod_proc_fornec,qt_dias_translado,cotacao_prevista,observacao,dt_registro,fornecedor_id,dt_limite,log_facilid_contato_fornec,log_considerar_previsao,nr_container_original'.split(','));
const LEDGER_FIELDS=Object.freeze('cta_corren_fornec_imp_id,fornecedor_id,data,item_proc_compra_id,historico,cod_tipo_movto,vl_lancto,cod_acao,login,data_hora,num_id_tit_ap,item_container_id,transacao_id,proc_compra_id'.split(','));
const WRITES=Object.freeze(['create','associate','update','enable','disable','unlink1','unlink2','delete','reject-supplier','reject-stale','reject-delete-items']);
const MODES=Object.freeze(['preflight','inspect','prepare-cleanup',...WRITES]);
const id=v=>Number.isInteger(v)&&v>0&&v<=2147483647;
const decode=v=>typeof v==='string'?JSON.parse(v):v;
const record=v=>v?.data&&!Array.isArray(v.data)?v.data:v;
const empty=v=>v!==null&&typeof v==='object'&&Object.keys(v).length===0;
const sha=bytes=>crypto.createHash('sha256').update(bytes).digest('hex');
function assertAuthorization(a){
 assert.equal(a.authorized,true,'NEW_USER_AUTHORIZATION_PENDING');assert.equal(a.tag,TAG);assert.deepEqual(a.item_proc_compra_ids,ITEMS);
 assert.equal(a.ERPexistingWrite,false,'EXISTING_ERP_WRITES_FORBIDDEN');assert.equal(a.containerCreation,false,'OPERATIONAL_CONTAINER_FORBIDDEN');
}
function physical(row){
 assert.ok(row&&typeof row==='object'&&!Array.isArray(row),'HEADER_OBJECT_REQUIRED');
 assert.deepEqual(Object.keys(row).filter(x=>x!=='row_stamp').sort(),[...FIELDS].sort(),'EXACT14_PHYSICAL_HEADER_FIELDS');
 const value=Object.fromEntries(FIELDS.map(name=>[name,row[name]]));
 for(const name of ['proc_compra_id','empresa_id','fornecedor_id'])assert.ok(id(value[name]),name+'_POSITIVE_ID_REQUIRED');
 for(const name of ['log_facilid_contato_fornec','log_considerar_previsao'])assert.ok(value[name]===null||typeof value[name]==='boolean');
 return value;
}
function normalizeLog(row){return {...row,meta:decode(row.metadata??row.meta??{}),before:decode(row.before_data??row.before??{}),after:decode(row.after_data??row.after??{})};}
function deleteBody(row){physical(row);assert.match(row.row_stamp,/^[A-F0-9]{64}$/);return {id:row.proc_compra_id,record:{proc_compra_id:row.proc_compra_id,row_stamp:row.row_stamp}};}
function assertNative(row,pid){
 assert.equal(row.actor_user_id,'admin','AUTHENTICATED_NATIVE_ACTOR');assert.equal(row.meta.audit.available,true);assert.equal(row.meta.audit.source,'progress-transaction');
 assert.equal(row.meta.audit.procCompraId,pid);assert.ok(id(Number(row.transaction_id)),'NATIVE_TRANSACTION_REQUIRED');
}
function assertHeaderAudit(row,operation,pid,before,after){
 assertNative(row,pid);assert.equal(row.meta.audit.resource,'procs_compra');assert.equal(row.meta.audit.operation,operation);
 assert.equal(row.meta.audit.originProcCompraId,pid);assert.equal(Number(row.meta.audit.recordId),pid);
 if(operation==='create')assert.ok(empty(row.before));else assert.deepEqual(physical(row.before),physical(before));
 if(operation==='delete')assert.ok(empty(row.after));else assert.deepEqual(physical(row.after),physical(after));
}
function assertLedgerImage(row,pid){
 assert.deepEqual(Object.keys(row).sort(),[...LEDGER_FIELDS].sort(),'EXACT14_CTA_IMAGE');assert.equal(row.proc_compra_id,pid);assert.ok(ITEMS.includes(row.item_proc_compra_id));
 assert.equal(row.item_container_id,0,'NO_CONTAINER_EFFECT');assert.equal(row.transacao_id,0);assert.ok([3,4].includes(row.cod_tipo_movto),'ONLY_ORDER_TYPES_3_4');
 assert.ok(id(row.cta_corren_fornec_imp_id));
}
function applyLedger(previous,events,pid){
 const state=new Map(previous.map(x=>[x.cta_corren_fornec_imp_id,structuredClone(x)]));assert.equal(state.size,previous.length);
 for(const e of events.filter(x=>x.meta.audit.resource==='cta_corren_fornec_imp')){
  assert.equal(e.actor_user_id,'admin');assert.equal(e.meta.audit.source,'progress-transaction');assert.equal(e.meta.audit.available,true);assert.equal(e.meta.audit.procCompraId,pid);
  if(e.meta.audit.originProcCompraId!==undefined)assert.equal(e.meta.audit.originProcCompraId,pid);
  const op=e.meta.audit.operation,row=op==='create'?e.after:e.before;assertLedgerImage(row,pid);
  if(op==='create'){assert.ok(empty(e.before));assert.equal(row.login,'admin');assert.ok(!state.has(row.cta_corren_fornec_imp_id),'DUPLICATE_LEDGER_CREATE');state.set(row.cta_corren_fornec_imp_id,row);}
  else{assert.equal(op,'delete');assert.ok(empty(e.after));assert.deepEqual(state.get(row.cta_corren_fornec_imp_id),row,'EXACT_NATIVE_DELETE_BEFORE_IMAGE');state.delete(row.cta_corren_fornec_imp_id);}
 }
 return [...state.values()].sort((a,b)=>a.cta_corren_fornec_imp_id-b.cta_corren_fornec_imp_id);
}
function assertWeighted(rows,links){
 const values=rows.filter(x=>x.cod_tipo_movto===4);assert.equal(values.length,4);
 for(const link of links)for(let index=0;index<2;index++){
  const found=values.filter(x=>x.num_id_tit_ap===link.num_id_tit_ap&&x.item_proc_compra_id===ITEMS[index]);assert.equal(found.length,1);
  // Independent expectations for the fixed fixture: totals20+120, ratio1:6.
  const expected=-Math.round((link.valor_dolar*(index===0?1:6)/7+Number.EPSILON)*100)/100;
  assert.ok(Math.abs(found[0].vl_lancto-expected)<0.005,'FIXTURE_WEIGHT_20_140_AND_120_140');
 }
}
function createHarness({state=c.state,session=c.session,now=()=>new Date().toISOString()}={}){
 const work=path.join(state,'exercise'),fixture=path.join(state,'fixture');
 const file=name=>path.join(work,name),read=name=>c.readJson(file(name)),readFixture=name=>c.readJson(path.join(fixture,name));
 function saveAt(full,value){fs.mkdirSync(path.dirname(full),{recursive:true});fs.writeFileSync(full,JSON.stringify(value,null,2)+'\n',{flag:'wx'});}
 const save=(name,value)=>saveAt(file(name),value);
 const exists=name=>fs.existsSync(file(name));
 function authorization(){const a=c.readJson(path.join(state,'user-authorization.json'));assertAuthorization(a);return a;}
 function preflight(){const p=read('preflight.json');assert.equal(p.success,true);assert.equal(p.readOnly,true);assert.equal(p.tag,TAG);assert.deepEqual(p.item_proc_compra_ids,ITEMS);assert.equal(p.selected_title_ids.length,2);assert.equal(new Set(p.selected_title_ids).size,2);p.selected_title_ids.forEach(x=>assert.ok(id(x)));assert.ok(id(p.seed.fornecedor_id));assert.ok(/^\d{4}-\d{2}-\d{2}$/.test(p.seed.dt_registro));return p;}
 function created(){const v=read('api-create-confirmed.json');assert.equal(v.success,true);assert.equal(v.tag,TAG);assert.deepEqual(v.item_proc_compra_ids,ITEMS);assert.ok(id(v.proc_compra_id));assert.equal(v.create_proof.source,'runtime-confirmed-audit');assert.equal(v.create_proof.actor,'admin');assert.equal(v.create_proof.proc_compra_id,v.proc_compra_id);physical(v.create_proof.after_image);return v;}
 function setup(pid){const s=readFixture('fixture-setup.json'),config=readFixture('fixture-config.json');assert.equal(s.success,true);assert.equal(s.committed,true);assert.equal(s.fixture_created_new,true);assert.equal(s.parent_created,false);assert.equal(s.proc_compra_id,pid);assert.equal(s.tag,TAG);assert.deepEqual(s.item_proc_compra_ids,ITEMS);assert.match(s.setup_guard_sha256,/^[A-F0-9]{64}$/);assert.deepEqual(s.order,created().create_proof.after_image);assert.deepEqual(config.create_proof,created().create_proof);assert.equal(sha(fs.readFileSync(path.join(fixture,'fixture-config.json'))),sha(fs.readFileSync(path.join(fixture,'fixture-probe.json'))),'IMMUTABLE_CONFIG_EQUALS_ORIGINAL_PROBE');assert.equal(config.success,true);assert.equal(config.probe_source,'readonly-med-physical-snapshots');assert.deepEqual(config.approved_titles.map(x=>x.num_id_tit_ap),preflight().selected_title_ids);assert.deepEqual(s.purchase_items.map(x=>x.item_proc_compra_id),ITEMS);for(let k=0;k<2;k++){const x=s.purchase_items[k];assert.equal(x.proc_compra_id,pid);assert.equal(x.descricao,TAG);assert.equal(x.observacao,TAG);assert.equal(x.codigo_erp,'ZTSC221026');assert.equal(x.qt_comprada,k===0?2:6);assert.equal(x.vl_negociado,k===0?10:20);assert.equal(x.vl_custo_dolar,k===0?10:20);}assert.equal(config.proc_compra_id,pid);assert.deepEqual(config.selected_title_ids,preflight().selected_title_ids);return s;}
 function assertOwn(row,own){const p=physical(row),initial=own.create_proof.after_image;assert.equal(p.proc_compra_id,own.proc_compra_id);assert.equal(p.cod_proc_fornec,TAG);assert.ok(p.observacao.startsWith(TAG));for(const name of ['empresa_id','fornecedor_id','dt_registro'])assert.equal(p[name],initial[name]);assert.match(row.row_stamp,/^[A-F0-9]{64}$/);return p;}
 async function run(mode){
  assert.ok(MODES.includes(mode),'EXPLICIT_MODE_REQUIRED');
  const writing=WRITES.includes(mode);
  // Check gate and no-replay BEFORE credentials, login or business HTTP.
  if(writing){authorization();assert.ok(!exists('api-attempt-'+mode+'.json'),'ATTEMPT_EXISTS_INSPECT_NO_REPLAY');assert.ok(!exists('api-'+mode+'-confirmed.json'),'CONFIRMED_ACTION_NEVER_REPLAY');}
  if(mode==='create'){preflight();assert.ok(!exists('api-create-confirmed.json'));assert.ok(!fs.existsSync(path.join(fixture,'fixture-probe-config.json')),'FIXTURE_INPUT_ALREADY_EXISTS');}
  return session(async({runtime,login})=>{
   assert.equal(login.user.username,'admin');
   const call=(screen,op,body,expected=200)=>runtime(screen+'/endpoints/'+op,body,expected);
   async function audit(pid){const r=await call('admin.logs-transacoes','read',{take:500,skip:0,filters:[{field:'audit_screen_id',operator:'eq',value:SCREEN},{field:'audit_record_id',operator:'eq',value:String(pid)}],sort:[{field:'id',dir:'asc'}]});assert.ok(Array.isArray(r.data));assert.ok(Number.isInteger(r.total)&&r.total<=500,'NO_PARTIAL_AUDIT');return r.data.map(normalizeLog).filter(x=>x.meta?.audit?.available===true&&x.meta.audit.procCompraId===pid);}
   const signature=x=>JSON.stringify([x.id,x.transaction_id,x.meta.audit.resource,x.meta.audit.recordId,x.meta.audit.operation]);
   const delta=(before,after)=>{const ids=new Set(before.map(signature));return after.filter(x=>!ids.has(signature(x)));};
   async function once(label,screen,operation,body,expected=200){
    authorization();save('api-attempt-'+label+'.json',{mode:label,screen,operation,body,tag:TAG,item_proc_compra_ids:ITEMS,at:now(),outcome:'unknown-inspect-no-replay'});
    const result=await call(screen,operation,body,expected);save('api-response-'+label+'.json',result);return result;
   }
   if(mode==='preflight'){
    assert.ok(!exists('preflight.json'),'PREFLIGHT_ALREADY_FROZEN_USE_INSPECT');
    const page=await call(FINANCIAL,'read',{take:10,skip:0,sort:[{field:'proc_compra_id',dir:'desc'}]});assert.ok(Array.isArray(page.data)&&page.data.length<=10);
    save('preflight-recent-orders.json',page);
    for(const donor of page.data){
     if(!id(donor.proc_compra_id)||!id(donor.fornecedor_id)||!/^\d{4}-\d{2}-\d{2}$/.test(donor.dt_registro??''))continue;
     const options=await call(PAYMENTS,'options.titulos',{context:{proc_compra_id:donor.proc_compra_id}});save('preflight-options-'+donor.proc_compra_id+'.json',options);
     const entries=options.data??options.options??options;assert.ok(Array.isArray(entries));
     const selected=[...new Set(entries.map(x=>x.num_id_tit_ap??x.value).map(v=>typeof v==='number'?v:/^[1-9][0-9]{0,9}$/.test(v??'')?Number(v):NaN).filter(id))].sort((a,b)=>a-b).slice(0,2);
     if(selected.length!==2)continue;
     const p={success:true,readOnly:true,at:now(),tag:TAG,item_proc_compra_ids:ITEMS,selected_title_ids:selected,donor_proc_compra_id:donor.proc_compra_id,seed:{empresa_id:donor.empresa_id,fornecedor_id:donor.fornecedor_id,dt_registro:donor.dt_registro},alternativeSupplierId:page.data.find(x=>id(x.fornecedor_id)&&x.fornecedor_id!==donor.fornecedor_id)?.fornecedor_id??null};
     save('preflight.json',p);return {success:true,mode,readOnly:true};
    }throw Error('NO_PAIR_IN_TEN_RECENT_MED_ORDERS');
   }
   if(mode==='inspect'){
    const stamp=now().replace(/[^0-9]/g,'');let own=null;try{own=created();}catch{}
    const inspection={mode,readOnly:true,at:now(),headerDefinition:await runtime(SCREEN),paymentsDefinition:await runtime(PAYMENTS)};
    if(own){const deleted=exists('api-delete-confirmed.json');inspection.current=await call(SCREEN,'get',{id:own.proc_compra_id},deleted?404:200);if(!deleted)inspection.links=await call(PAYMENTS,'read',{context:{proc_compra_id:own.proc_compra_id},take:100,skip:0});inspection.audit=await audit(own.proc_compra_id);}
    else{
     if(exists('api-response-create.json'))inspection.unconfirmedCreate=read('api-response-create.json');
     inspection.markedParents=await call(SCREEN,'read',{take:2,skip:0,filters:[{field:'cod_proc_fornec',operator:'eq',value:TAG}]});
     if(inspection.markedParents.total===1&&id(inspection.markedParents.data[0]?.proc_compra_id)){const candidate=inspection.markedParents.data[0].proc_compra_id;inspection.unconfirmedCurrent=await call(SCREEN,'get',{id:candidate});inspection.unconfirmedAudit=await audit(candidate);}
     inspection.adoptedExistingParent=false;
    }
    save('api-inspection-'+stamp+'.json',inspection);return {success:true,mode,readOnly:true};
   }
   const definition=await runtime(SCREEN);assert.equal(definition.program.id,'cd0108');assert.equal(definition.program.version,'1.0.0');
   if(mode==='create'){
    const p=preflight();const collisions=await call(SCREEN,'read',{take:2,skip:0,filters:[{field:'cod_proc_fornec',operator:'eq',value:TAG}]});assert.equal(collisions.total,0,'TAG_ALREADY_USED_NEVER_ADOPT_EXISTING_PARENT');assert.deepEqual(collisions.data,[]);
    const body={record:{proc_compra_id:null,empresa_id:null,qt_container:0,cod_situacao:1,cod_proc_fornec:TAG,qt_dias_translado:0,cotacao_prevista:0,observacao:TAG,dt_registro:p.seed.dt_registro,fornecedor_id:p.seed.fornecedor_id,dt_limite:null,log_facilid_contato_fornec:true,log_considerar_previsao:false,nr_container_original:'',row_stamp:null}};
    const response=await once(mode,SCREEN,'create',body),returned=record(response);assert.ok(id(returned.proc_compra_id));
    const current=record(await call(SCREEN,'get',{id:returned.proc_compra_id}));assert.deepEqual(current,returned);const image=physical(current);
    for(const name of ['fornecedor_id','dt_registro'])assert.equal(image[name],p.seed[name]);if(id(p.seed.empresa_id))assert.equal(image.empresa_id,p.seed.empresa_id);assert.equal(image.cod_proc_fornec,TAG);assert.equal(image.observacao,TAG);assert.equal(image.log_considerar_previsao,false);
    const rows=await audit(image.proc_compra_id);save('audit-after-create.json',rows);const mains=rows.filter(x=>x.meta.audit.resource==='procs_compra'&&x.meta.audit.operation==='create');assert.equal(mains.length,1);assertHeaderAudit(mains[0],'create',image.proc_compra_id,[],image);assert.equal(rows.filter(x=>x.meta.audit.resource==='cta_corren_fornec_imp').length,0,'CREATE_HAS_NO_FINANCIAL_EFFECT');
    const create_proof={source:'runtime-confirmed-audit',success:true,committed:true,operation:'create',resource:'procs_compra_med',proc_compra_id:image.proc_compra_id,transaction_id:Number(mains[0].transaction_id),actor:'admin',before_image:null,after_image:image};
    const proof={success:true,proc_compra_id:image.proc_compra_id,tag:TAG,item_proc_compra_ids:ITEMS,record:current,create_proof,nativeLogImages:true};
    save('api-create-confirmed.json',proof);saveAt(path.join(fixture,'fixture-probe-config.json'),{version:1,proc_compra_id:image.proc_compra_id,tag:TAG,item_proc_compra_ids:ITEMS,selected_title_ids:p.selected_title_ids,create_proof});return {success:true,mode};
   }
   const own=created(),pid=own.proc_compra_id,context={proc_compra_id:pid};
   const payment=(op,body,expected=200)=>call(PAYMENTS,op,{...body,context},expected);
   const before=record(await call(SCREEN,'get',{id:pid}));assertOwn(before,own);
   const getLinks=async()=>{const p=await payment('read',{take:100,skip:0});assert.ok(Array.isArray(p.data));assert.equal(p.data.length,p.total);assert.ok(p.total<=2);for(const x of p.data){assert.equal(x.proc_compra_id,pid);assert.ok(preflight().selected_title_ids.includes(x.num_id_tit_ap));assert.match(x.pagamento_key,/^p_[A-F0-9]{64}$/);}return p.data;};
   const linksBefore=await getLinks(),auditBefore=await audit(pid);
   if(writing)save('api-before-'+mode+'.json',{record:before,links:linksBefore,audit:auditBefore,at:now()});
   if(mode==='prepare-cleanup'){
    const unlinked=read('api-unlink2-confirmed.json');assert.equal(unlinked.success,true);assert.deepEqual(unlinked.ledger_rows,[]);assert.deepEqual(linksBefore,[]);assert.equal(before.log_considerar_previsao,false);
    const s=setup(pid),verify=readFixture('fixture-verify-after-unlink.json');assert.equal(verify.success,true);assert.equal(verify.original_titles_unchanged,true);assert.equal(verify.reserved_container_absent,true);assert.equal(verify.proc_compra_id,pid);assert.deepEqual(verify.payment_links,[]);assert.deepEqual(verify.ledger_rows,[]);assert.deepEqual(verify.purchase_items,s.purchase_items);assert.deepEqual(verify.orders,[physical(before)]);
    const current=physical(before),bytes=JSON.stringify(current,null,2)+'\n',hash=sha(bytes);fs.mkdirSync(fixture,{recursive:true});fs.writeFileSync(path.join(fixture,'fixture-current-order.json'),bytes,{flag:'wx'});
    saveAt(path.join(fixture,'fixture-cleanup-owned.json'),{version:1,proc_compra_id:pid,tag:TAG,item_proc_compra_ids:ITEMS,source:'runtime-confirmed-audit',setup_guard_sha256:s.setup_guard_sha256,current_order_source:'native-get-after-unlink',current_order_root_sha256:hash,current_order:current});save('api-cleanup-prepared.json',{success:true,readOnly:true,proc_compra_id:pid,current_order_sha256:hash,setup_guard_sha256:s.setup_guard_sha256});return {success:true,mode,readOnly:true};
   }
   let previous=[];if(mode!=='associate'&&mode!=='delete'){const stage=mode==='update'||mode==='enable'||mode.startsWith('reject-')?'associate':mode==='disable'?'enable':mode==='unlink1'?'disable':'unlink1';const receipt=read('api-'+stage+'-confirmed.json');assert.equal(receipt.success,true);assert.equal(receipt.proc_compra_id,pid);previous=receipt.ledger_rows;}
   if(mode==='associate'){
    setup(pid);assert.deepEqual(linksBefore,[]);assert.equal(before.log_considerar_previsao,false);const selected=preflight().selected_title_ids;
    const options=await payment('options.titulos',{}),entries=options.data??options.options??options;assert.ok(Array.isArray(entries));for(const tid of selected)assert.ok(entries.some(x=>Number(x.num_id_tit_ap??x.value)===tid),'SELECTED_TITLE_NOT_AVAILABLE');
    await once(mode,PAYMENTS,'create',{record:{titulos:selected},context});
   }else if(mode.startsWith('reject-')){
    setup(pid);assert.equal(linksBefore.length,2);assert.ok(!exists('api-disable-confirmed.json'),'NEGATIVE_TESTS_ONLY_BEFORE_DISABLE');
    const body={record:{...before}},operation=mode==='reject-delete-items'?'delete':'update';
    if(mode==='reject-supplier')body.record.fornecedor_id=preflight().alternativeSupplierId??(before.fornecedor_id===1?2:1);
    if(mode==='reject-stale'){body.record.row_stamp='0'.repeat(64);assert.notEqual(body.record.row_stamp,before.row_stamp);}
    const response=await once(mode,SCREEN,operation,operation==='delete'?deleteBody(before):body,409);assert.equal(response.error?.code,mode==='reject-stale'?'PURCHASE_ORDER_CHANGED':'PURCHASE_ORDER_DEPENDENCY');
    assert.deepEqual(record(await call(SCREEN,'get',{id:pid})),before);assert.deepEqual(await getLinks(),linksBefore);const after=await audit(pid);assert.deepEqual(delta(auditBefore,after),[],'REJECTED_OPERATION_HAS_NO_CONFIRMED_NATIVE_EFFECT');save('api-'+mode+'-confirmed.json',{success:true,proc_compra_id:pid,expectedStatus:409,unchanged:true,nativeLogImages:true});return {success:true,mode};
   }else if(['update','enable','disable'].includes(mode)){
    setup(pid);assert.equal(linksBefore.length,2);if(mode==='enable'){assert.equal(read('api-update-confirmed.json').success,true);assert.equal(before.log_considerar_previsao,false);previous=read('api-associate-confirmed.json').ledger_rows;}else assert.equal(before.log_considerar_previsao,mode==='disable');
    const prior=read('api-'+(mode==='update'?'associate':mode==='enable'?'update':'enable')+'-confirmed.json');assert.deepEqual(before,prior.record,'UNCHANGED_EXPECTED_PRIOR_HEADER');
    const next={...before,observacao:TAG+'/alterado',log_considerar_previsao:mode==='enable'};
    await once(mode,SCREEN,'update',{record:next});
   }else if(mode==='unlink1'||mode==='unlink2'){
    setup(pid);assert.equal(before.log_considerar_previsao,false);assert.deepEqual(previous,[],'DISABLE_MUST_REMOVE_ALL_LEDGER_FIRST');const associated=read('api-associate-confirmed.json'),target=associated.links.find(x=>x.num_id_tit_ap===preflight().selected_title_ids[mode==='unlink1'?0:1]);assert.ok(target);assert.deepEqual(linksBefore.find(x=>x.pagamento_key===target.pagamento_key),target);assert.equal(linksBefore.length,mode==='unlink1'?2:1);
    await once(mode,PAYMENTS,'delete',{id:target.pagamento_key,context});
   }else if(mode==='delete'){
    assert.deepEqual(linksBefore,[]);const cleanup=readFixture('fixture-cleanup.json'),verify=readFixture('fixture-verify-after-cleanup.json');assert.equal(cleanup.success,true);assert.equal(cleanup.committed,true);assert.equal(cleanup.parent_retained,true);assert.equal(cleanup.removed_items,2);assert.equal(cleanup.removed_ledger_rows,0);assert.equal(cleanup.proc_compra_id,pid);assert.deepEqual(cleanup.retained_order,physical(before));assert.equal(verify.success,true);assert.equal(verify.proc_compra_id,pid);assert.equal(verify.original_titles_unchanged,true);assert.deepEqual(verify.orders,[physical(before)]);for(const k of ['purchase_items','payment_links','ledger_rows'])assert.deepEqual(verify[k],[]);
    await once(mode,SCREEN,'delete',deleteBody(before));
   }
   const auditAfter=await audit(pid),events=delta(auditBefore,auditAfter);save('audit-after-'+mode+'.json',auditAfter);save('audit-delta-'+mode+'.json',events);assert.equal(events.length,{associate:6,update:1,enable:11,disable:7,unlink1:1,unlink2:1,delete:1}[mode],'EXACT_NATIVE_EVENT_COUNT');events.forEach(x=>{assertNative(x,pid);assert.ok(['procs_compra','purchase_payment_links','cta_corren_fornec_imp'].includes(x.meta.audit.resource),'NO_OTHER_RESOURCE_EFFECT');});assert.equal(new Set(events.map(x=>String(x.transaction_id))).size,1,'SINGLE_NATIVE_TRANSACTION');
   let current=null,linksAfter=null;
   if(mode==='delete'){
    const mains=events.filter(x=>x.meta.audit.resource==='procs_compra');assert.equal(mains.length,1);assertHeaderAudit(mains[0],'delete',pid,physical(before),[]);assert.equal(events.length,1,'DELETE_LOG_ONLY_HEADER');const missing=await call(SCREEN,'get',{id:pid},404);assert.ok(missing.error);save('api-delete-confirmed.json',{success:true,proc_compra_id:pid,tag:TAG,nativeLogImages:true,actor:'admin',deletedMainOnly:true,transaction_id:Number(mains[0].transaction_id)});return {success:true,mode};
   }
   current=record(await call(SCREEN,'get',{id:pid}));assertOwn(current,own);linksAfter=await getLinks();
   if(mode==='associate'){
    assert.deepEqual(current,before);assert.equal(linksAfter.length,2);assert.deepEqual(linksAfter.map(x=>x.num_id_tit_ap).sort((a,b)=>a-b),preflight().selected_title_ids);
    for(const link of linksAfter){assert.deepEqual(record(await payment('get',{id:link.pagamento_key})),link);assert.deepEqual(link.titulos,[link.num_id_tit_ap]);}
    const createdLinks=events.filter(x=>x.meta.audit.resource==='purchase_payment_links');assert.equal(createdLinks.length,2);for(const x of createdLinks){assert.equal(x.meta.audit.operation,'create');assert.ok(empty(x.before));assert.deepEqual(x.after,linksAfter.find(y=>y.pagamento_key===x.meta.audit.recordId));}
    assert.equal(events.filter(x=>x.meta.audit.resource==='cta_corren_fornec_imp').length,4);
   }else if(['update','enable','disable'].includes(mode)){
    assert.deepEqual(linksAfter,linksBefore);const mains=events.filter(x=>x.meta.audit.resource==='procs_compra');assert.equal(mains.length,1);assertHeaderAudit(mains[0],'update',pid,physical(before),physical(current));assert.deepEqual(physical(current),physical({...before,observacao:TAG+'/alterado',log_considerar_previsao:mode==='enable'}),'ONLY_REQUESTED_HEADER_FIELDS_CHANGED');assert.notEqual(current.row_stamp,before.row_stamp);
    const effects=events.filter(x=>x.meta.audit.resource==='cta_corren_fornec_imp');for(const e of effects)assert.equal(e.meta.audit.originProcCompraId,pid);
    if(mode==='update')assert.deepEqual(effects,[]);
    if(mode==='enable'){assert.equal(effects.filter(x=>x.meta.audit.operation==='delete').length,4);assert.equal(effects.filter(x=>x.meta.audit.operation==='create').length,6);}
    if(mode==='disable'){assert.equal(effects.length,6);assert.ok(effects.every(x=>x.meta.audit.operation==='delete'));}
   }else{
    assert.deepEqual(current,before);assert.equal(linksAfter.length,mode==='unlink1'?1:0);const removed=linksBefore.filter(x=>!linksAfter.some(y=>x.pagamento_key===y.pagamento_key));assert.equal(removed.length,1);
    const deleted=events.filter(x=>x.meta.audit.resource==='purchase_payment_links');assert.equal(deleted.length,1);assert.equal(deleted[0].meta.audit.operation,'delete');assert.deepEqual(deleted[0].before,removed[0]);assert.ok(empty(deleted[0].after));assert.equal(events.filter(x=>x.meta.audit.resource==='cta_corren_fornec_imp').length,0,'ZERO_BALANCE_UNLINK_HAS_NO_LEDGER');
   }
   const ledger=applyLedger(previous,events,pid);
   if(mode==='associate'||mode==='enable')assertWeighted(ledger,linksAfter);
   if(mode==='enable'){const commitments=ledger.filter(x=>x.cod_tipo_movto===3);assert.equal(commitments.length,2);for(let k=0;k<2;k++){const found=commitments.filter(x=>x.item_proc_compra_id===ITEMS[k]);assert.equal(found.length,1);assert.equal(found[0].vl_lancto,k===0?20:120);}}
   if(['disable','unlink1','unlink2'].includes(mode))assert.deepEqual(ledger,[]);
   save('api-'+mode+'-confirmed.json',{success:true,proc_compra_id:pid,tag:TAG,actor:'admin',transaction_id:Number(events[0].transaction_id),record:current,links:linksAfter,ledger_rows:ledger,nativeLogImages:true});return {success:true,mode};
  },{readOnly:!writing});
 }
 return {run};
}
module.exports={TAG,ITEMS,SCREEN,PAYMENTS,FINANCIAL,FIELDS,WRITES,MODES,assertAuthorization,physical,normalizeLog,deleteBody,assertHeaderAudit,applyLedger,assertWeighted,createHarness};
if(require.main===module){const mode=process.argv[2];createHarness().run(mode).then(r=>console.log('PASS '+r.mode+'; comprovantes privados; nenhuma repetição automática.')).catch(error=>{try{const dir=path.join(c.state,'exercise');fs.mkdirSync(dir,{recursive:true});fs.writeFileSync(path.join(dir,'api-failure-'+(MODES.includes(mode)?mode:'invalid-mode')+'-'+Date.now()+'.json'),JSON.stringify({message:error.message,at:new Date().toISOString(),outcome:'unknown-inspect-no-replay',businessSuccess:false}),{flag:'wx'});}catch{}console.error('Exercício não confirmado; detalhes em .runtime/purchase-orders-20261022/exercise/. Inspecionar sem repetir escrita.');process.exitCode=1;});}
