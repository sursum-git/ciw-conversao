'use strict';
// Import is pure: no credential/session module, filesystem read, HTTP or SSH.
const assert=require('node:assert/strict'),fs=require('node:fs'),path=require('node:path'),crypto=require('node:crypto');
const TAG='SC_TEST_PROC_ITENS_20261022',ERP='2147000107';
const SCREEN='ciw.proc-compra-itens',PARENT='ciw.processos-compra-med',PAYMENTS='ciw.proc-compra-pagamentos',LOGS='admin.logs-transacoes';
const WRITES=Object.freeze(['create-header','create-a','create-b','associate','update-a','repeat-a','stale-a','delete-a','update-b','create-c','disable','unlink1','unlink2','delete-b','delete-c','delete-header']);
const MODES=Object.freeze(['preflight',...WRITES,'inspect','prepare-cleanup','verify-final']);
const PREVIOUS=Object.freeze(Object.fromEntries(WRITES.map((stage,i)=>[stage,i?WRITES[i-1]:'preflight'])));
const LEDGER_FIELDS='cta_corren_fornec_imp_id,fornecedor_id,data,item_proc_compra_id,historico,cod_tipo_movto,vl_lancto,cod_acao,login,data_hora,num_id_tit_ap,item_container_id,transacao_id,proc_compra_id'.split(',');
const EXTRA=['row_stamp','qt_alocada','qt_saldo','calc_gm'];
const positive=v=>Number.isInteger(v)&&v>0&&v<=2147483647;
const decode=v=>typeof v==='string'?JSON.parse(v):v;
const record=r=>r?.data&&!Array.isArray(r.data)?r.data:r;
const empty=r=>r!==null&&typeof r==='object'&&Object.keys(r).length===0;
const canonical=v=>Array.isArray(v)?v.map(canonical):v&&typeof v==='object'?Object.fromEntries(Object.keys(v).sort().map(k=>[k,canonical(v[k])])):v;
const hash=v=>crypto.createHash('sha256').update(JSON.stringify(canonical(v))).digest('hex');
const ordered=rows=>rows.map(canonical).sort((a,b)=>JSON.stringify(a).localeCompare(JSON.stringify(b)));
const authorizationFileProvider=file=>()=>JSON.parse(fs.readFileSync(file,'utf8'));
function assertAuthorization(a){
 assert.equal(a?.authorized,true,'NEW_BUSINESS_AUTHORIZATION_PENDING');assert.equal(a.tag,TAG,'AUTHORIZATION_TAG');
 for(const key of ['newHeader','generatedItemIds'])assert.equal(a[key],true,'AUTHORIZATION_'+key);
 for(const key of ['allowExistingTitleWrites','allowContainerWrites'])assert.equal(a[key],false,'AUTHORIZATION_'+key);
 assert.equal(a.humanApproval?.source,'human-user-message','AUTHORIZATION_HUMAN_SOURCE');assert.ok(typeof a.humanApproval.reference==='string'&&a.humanApproval.reference.trim(),'AUTHORIZATION_HUMAN_REFERENCE');
 assert.ok(typeof a.expectedActor==='string'&&a.expectedActor.trim(),'AUTHORIZATION_ACTOR');
 assert.ok(Array.isArray(a.titleIds)&&a.titleIds.length===2&&a.titleIds.every(positive)&&new Set(a.titleIds).size===2,'AUTHORIZATION_TWO_EXACT_TITLES');
 for(const key of ['itemIds','item_proc_compra_ids','proc_compra_id'])assert.ok(!Object.hasOwn(a,key),'AUTHORIZATION_GENERATED_IDENTITIES_ONLY');
}
function buildItemCreate(draft,pid,label){
 assert.ok(positive(pid));assert.ok(['A','B','C'].includes(label));
 const fields=draft.entityDraft.fields;assert.equal(fields.length,50,'ITEM_METADATA50_REQUIRED');
 const editable=fields.filter(f=>!f.readonlyField&&f.options?.writable===true);assert.equal(editable.length,44,'ITEM_EDITABLE44_REQUIRED');
 const values=Object.fromEntries(editable.map(f=>{assert.ok(Object.hasOwn(f.options,'defaultValue'),'EXPLICIT_METADATA_DEFAULT');return [f.code,f.options.defaultValue];}));
 Object.assign(values,{descricao:TAG+'/'+label,observacao:TAG+'/'+label,codigo_erp:ERP,unid_medida:'MT',qt_comprada:label==='A'?10:label==='B'?20:5,vl_negociado:label==='B'?5:3,vl_custo_dolar:label==='B'?4:2});
 for(const key of ['coloracao_id','formato_amostra_id','item_estacao'])assert.equal(values[key],0,'OPTIONAL_REFERENCE_DEFAULT0');
 for(const f of editable.filter(f=>f.dataType==='date'))assert.equal(values[f.code],null,'DATE_DEFAULT_NULL');
 return {record:values,context:{proc_compra_id:pid}};
}
function assertTitlesUnchanged(baseline,current){
 assert.ok(Array.isArray(baseline)&&baseline.length===2&&Array.isArray(current)&&current.length===2,'EXACT_TWO_TITLE_SNAPSHOTS');
 const project=rows=>rows.map(row=>{assert.ok(positive(row.num_id_tit_ap));assert.equal(row.titleMatches,1,'TITLE_GLOBAL_UNIQUENESS');assert.ok(row.title&&typeof row.title==='object'&&!Array.isArray(row.title));assert.equal(row.title.num_id_tit_ap,row.num_id_tit_ap);assert.ok(Array.isArray(row.title_values)&&row.title_values.length>0,'FULL_TITLE_VALUES_REQUIRED');return {id:row.num_id_tit_ap,title:row.title,title_values:ordered(row.title_values)};}).sort((a,b)=>a.id-b.id);
 const before=project(baseline),after=project(current);assert.equal(new Set(before.map(x=>x.id)).size,2);assert.deepEqual(after,before,'TITLE_AND_VAL_TIT_AP_IMMUTABLE');
}
function assertOwnedLedger(row,scope){
 assert.deepEqual(Object.keys(row).sort(),[...LEDGER_FIELDS].sort(),'EXACT_LEDGER14_IMAGE');
 assert.ok(positive(row.cta_corren_fornec_imp_id));assert.ok(scope.itemIds.includes(row.item_proc_compra_id),'GENERATED_OWN_ITEM_ONLY');
 assert.equal(row.proc_compra_id,scope.proc_compra_id,'ACTUAL_LEDGER_OWNER');assert.equal(row.fornecedor_id,scope.supplierId);
 assert.equal(row.item_container_id,0,'CONTAINERS_FORBIDDEN');assert.ok([3,4].includes(row.cod_tipo_movto),'ONLY_PURCHASE_LEDGER3_4');
 assert.ok(row.num_id_tit_ap===0&&row.cod_tipo_movto===3||scope.titleIds.includes(row.num_id_tit_ap),'SELECTED_TITLE_ONLY');
 if(row.cod_tipo_movto===4)assert.ok(scope.titleIds.includes(row.num_id_tit_ap));
 assert.equal(row.login,scope.actor);assert.equal(row.transacao_id,0);assert.ok([1,2,3].includes(row.cod_acao));assert.ok(Number.isFinite(row.vl_lancto));
 assert.match(row.data,/^\d{4}-\d{2}-\d{2}$/);assert.equal(typeof row.data_hora,'string');assert.equal(typeof row.historico,'string');
}
function normalizeEvent(row){return {...row,meta:decode(row.metadata??row.meta??{}),before:decode(row.before_data??row.before??{}),after:decode(row.after_data??row.after??{})};}
function validateEvents(events,scope,mode){
 const ids=new Set();for(const e of events){
  assert.ok(positive(Number(e.id))&&!ids.has(String(e.id)),'UNIQUE_LOG_ID');ids.add(String(e.id));assert.ok(positive(Number(e.transaction_id)));
  assert.equal(e.actor_user_id,scope.actor,'TRANSACTION_PHP_ACTOR');const a=e.meta?.audit;assert.equal(a?.available,true);assert.equal(a.source,'progress-transaction');assert.equal(a.version,1);
  assert.ok(['procs_compra','itens_proc_compra','purchase_payment_links','cta_corren_fornec_imp'].includes(a.resource),'NO_OTHER_RESOURCE_EFFECT');
  assert.equal(a.procCompraId,scope.proc_compra_id,'ACTUAL_OWNER');
  if(a.originProcCompraId!==undefined)assert.equal(a.originProcCompraId,scope.proc_compra_id,'INITIATING_PARENT');
  else {assert.ok(['purchase_payment_links','cta_corren_fornec_imp'].includes(a.resource),'INITIATING_PARENT_REQUIRED');assert.match(a.paymentKey??'',/^p_[A-F0-9]{64}$/,'CONFIRMED_PAYMENT_INITIATOR_REQUIRED');}
  assert.ok(['create','update','delete'].includes(a.operation));
  if(a.resource==='cta_corren_fornec_imp'){
   const image=a.operation==='delete'?e.before:e.after;assertOwnedLedger(image,scope);assert.equal(Number(a.recordId),image.cta_corren_fornec_imp_id);
   if(a.itemProcCompraId!==undefined)assert.equal(a.itemProcCompraId,image.item_proc_compra_id);
   if(a.originItemProcCompraId!==undefined)assert.ok(scope.itemIds.includes(a.originItemProcCompraId),'INITIATING_OWN_ITEM');
   if(scope.initiatingItemId!==undefined)assert.equal(a.originItemProcCompraId,scope.initiatingItemId,'EXACT_INITIATING_ITEM');
  }
  if(a.resource==='itens_proc_compra'){assert.ok(scope.itemIds.includes(Number(a.recordId)));assert.equal(a.itemProcCompraId,Number(a.recordId));assert.equal(a.originItemProcCompraId,Number(a.recordId));}
  if(a.operation==='create')assert.ok(empty(e.before),'CREATE_EMPTY_BEFORE');if(a.operation==='delete')assert.ok(empty(e.after),'DELETE_EMPTY_AFTER');
 }
 if(events.length)assert.equal(new Set(events.map(e=>String(e.transaction_id))).size,1,'ONE_TRANSACTION_PER_POST');
 if(mode==='stale-a')assert.deepEqual(events,[],'STALE_HAS_ZERO_CONFIRMED_EFFECTS');
}
function verifyFinancial(rows,expected,scope){
 const obligations={},allocations={};for(const row of rows){assertOwnedLedger(row,scope);const target=row.cod_tipo_movto===3?obligations:allocations,key=row.cod_tipo_movto===3?String(row.item_proc_compra_id):row.item_proc_compra_id+':'+row.num_id_tit_ap;target[key]=(target[key]??0)+row.vl_lancto;}
 const compare=(actual,want)=>{for(const key of new Set([...Object.keys(actual),...Object.keys(want)]))assert.ok(Math.abs((actual[key]??0)-(want[key]??0))<0.011,'SIGNED_LEDGER_BALANCE_'+key);};compare(obligations,expected.obligations);compare(allocations,expected.allocations);
}
function replayLedger(previous,events,scope){
 const rows=new Map(previous.map(r=>[r.cta_corren_fornec_imp_id,r]));assert.equal(rows.size,previous.length);
 for(const e of events.filter(e=>e.meta.audit.resource==='cta_corren_fornec_imp')){
  const a=e.meta.audit,id=Number(a.recordId);if(a.operation==='create'){assert.ok(!rows.has(id),'NEW_LEDGER_ID_ONLY');assertOwnedLedger(e.after,scope);rows.set(id,e.after);}
  else {assert.equal(a.operation,'delete','LEDGER_UPDATE_NOT_EXPECTED');assert.deepEqual(rows.get(id),e.before,'DELETE_EXACT_CURRENT_LEDGER_IMAGE');rows.delete(id);}
 }return [...rows.values()].sort((a,b)=>a.cta_corren_fornec_imp_id-b.cta_corren_fornec_imp_id);
}
function prepareCleanupManifest(scope,allEvents,current,physical){
 assert.equal(physical.source,'official-openedge12.2');assert.equal(physical.readOnly,true);assert.deepEqual(ordered(physical.ledger),ordered(current),'EXACT_PHYSICAL_LEDGER');
 const created=new Map();for(const e of allEvents.filter(e=>e.meta.audit.resource==='cta_corren_fornec_imp'&&e.meta.audit.operation==='create')){
  // Each saved event has already passed the single-transaction validation at its stage.
  validateEvents([e],scope,'prepare-cleanup');const id=e.after.cta_corren_fornec_imp_id;assert.ok(!created.has(id),'NO_DUPLICATE_CONFIRMED_CREATION');created.set(id,{image:e.after,logId:Number(e.id),transactionId:Number(e.transaction_id)});
 }
 const ids=new Set();for(const row of current){assertOwnedLedger(row,scope);assert.ok(!ids.has(row.cta_corren_fornec_imp_id));ids.add(row.cta_corren_fornec_imp_id);assert.deepEqual(created.get(row.cta_corren_fornec_imp_id)?.image,row,'CLEANUP_REQUIRES_EXACT_CONFIRMED_CREATION_IMAGE');}
 verifyFinancial(current,{obligations:{},allocations:{}},scope);
 const physicalFields=LEDGER_FIELDS.filter(key=>key!=='proc_compra_id');
 return {version:1,tag:TAG,source:'confirmed-native-audit-and-official-openedge12.2',proc_compra_id:scope.proc_compra_id,itemIds:scope.itemIds,titleIds:scope.titleIds,ledgerIds:[...ids].sort((a,b)=>a-b),ledger:current,physicalLedgerFields:physicalFields,physicalRows:current.map(row=>Object.fromEntries(physicalFields.map(key=>[key,row[key]]))),ownership:current.map(r=>({ledgerId:r.cta_corren_fornec_imp_id,...created.get(r.cta_corren_fornec_imp_id)})),physicalSha256:hash(physical),broadDeleteAllowed:false,deleteConfirmedLogs:false,requiresRootGuardedHelper:true};
}
function noSecrets(value){
 if(Array.isArray(value)){value.forEach(noSecrets);return;}if(!value||typeof value!=='object')return;
 for(const [key,v]of Object.entries(value)){assert.ok(!/^(password|senha|token|authorization|authheaders|headers|access_token|refresh_token)$/i.test(key),'SECRET_RECEIPT_FORBIDDEN');noSecrets(v);}
}
function createHarness(options={}){
 const state=options.state??path.resolve(__dirname,'../../.runtime/purchase-items-20261022/exercise');
 const clock=options.now??(()=>new Date().toISOString()),exists=name=>fs.existsSync(path.join(state,name));
 const read=name=>JSON.parse(fs.readFileSync(path.join(state,name),'utf8'));
 const save=(name,value)=>{noSecrets(value);fs.mkdirSync(state,{recursive:true});fs.writeFileSync(path.join(state,name),JSON.stringify(value,null,2)+'\n',{flag:'wx',mode:0o600});return value;};
 const authorization=()=>{const a=options.authorization?options.authorization():JSON.parse(fs.readFileSync(path.resolve(state,'../authorization.json'),'utf8'));assertAuthorization(a);return a;};
 const confirmed=mode=>{const value=read('confirmed-'+mode+'.json');assert.equal(value.success,true,'PRIOR_STAGE_NOT_CONFIRMED');assert.equal(value.tag,TAG);return value;};
 const history=()=>WRITES.filter(m=>exists('confirmed-'+m+'.json')).map(confirmed);
 const own=()=>{const h=confirmed('create-header'),items={};for(const label of ['a','b','c'])if(exists('confirmed-create-'+label+'.json'))items[label.toUpperCase()]=confirmed('create-'+label).record.item_proc_compra_id;return {header:h.record,items};};
 async function run(mode){
  assert.ok(MODES.includes(mode),'EXPLICIT_STAGE_REQUIRED');const a=structuredClone(authorization()),approvalHash=hash(a),writing=WRITES.includes(mode);
  if(writing)assert.ok(!exists('write-started-'+mode+'.json')&&!exists('confirmed-'+mode+'.json'),'WRITE_REPLAY_FORBIDDEN_INSPECT_UNKNOWN_OUTCOME');
  assert.equal(typeof options.physicalProbe,'function','OFFICIAL_PHYSICAL_PROBE_REQUIRED_BEFORE_SESSION');assert.equal(typeof options.session,'function','EXPLICIT_SESSION_REQUIRED');
  if(writing)confirmed(PREVIOUS[mode]);
  if(mode==='preflight')assert.ok(!exists('confirmed-preflight.json'),'PREFLIGHT_ALREADY_FROZEN');
  const config=options.config??JSON.parse(fs.readFileSync(path.resolve(state,'../exercise-config.json'),'utf8'));
  assert.deepEqual(config.titleIds,a.titleIds,'CONFIG_AUTHORIZATION_TITLE_SCOPE');assert.ok(positive(config.seed?.fornecedor_id));assert.ok(positive(config.seed?.empresa_id));assert.match(config.seed.dt_registro,/^\d{4}-\d{2}-\d{2}$/);
  const draft=options.draft??JSON.parse(fs.readFileSync(path.resolve(__dirname,'../../integration-src/purchase-items/metadata/proc-compra-itens-builder-draft.json'),'utf8'));
  const startedAt=clock();let ownership=mode==='preflight'||mode==='create-header'||mode==='inspect'&&!exists('confirmed-create-header.json')?null:own();
  let scope={proc_compra_id:ownership?.header.proc_compra_id??null,itemIds:Object.values(ownership?.items??{}),titleIds:a.titleIds,supplierId:config.seed.fornecedor_id,actor:a.expectedActor};
  const probe=async phase=>{
   const request={phase,tag:TAG,proc_compra_id:scope.proc_compra_id,itemIds:scope.itemIds,titleIds:a.titleIds,notBefore:startedAt};
   const p=await options.physicalProbe(request);noSecrets(p);assert.equal(p.source,'official-openedge12.2');assert.equal(p.readOnly,true);assert.equal(p.success,true);assert.equal(p.phase,phase);assert.equal(p.tag,TAG);
   assert.ok(Number.isFinite(Date.parse(p.capturedAt))&&Date.parse(p.capturedAt)>=Date.parse(startedAt),'FRESH_PHYSICAL_EVIDENCE_REQUIRED');
   assert.equal(p.proc_compra_id,scope.proc_compra_id);assert.deepEqual(p.itemIds,scope.itemIds);assert.deepEqual(p.titleIds,a.titleIds);
   assert.ok(Array.isArray(p.ledger));p.ledger.forEach(row=>assertOwnedLedger(row,scope));assert.ok(Array.isArray(p.items)&&Array.isArray(p.orders)&&Array.isArray(p.payment_links));
   for(const row of p.items){assert.ok(scope.itemIds.includes(row.item_proc_compra_id),'PHYSICAL_OWN_ITEM_ONLY');assert.equal(row.proc_compra_id,scope.proc_compra_id);assert.equal(row.codigo_erp,ERP);assert.ok(row.descricao.startsWith(TAG+'/'));}
   for(const row of p.orders){if(scope.proc_compra_id!==null)assert.equal(row.proc_compra_id,scope.proc_compra_id);assert.equal(row.cod_proc_fornec,TAG);assert.equal(row.fornecedor_id,config.seed.fornecedor_id);}
   for(const row of p.payment_links){assert.equal(row.proc_compra_id,scope.proc_compra_id);assert.ok(a.titleIds.includes(row.num_id_tit_ap));}
   assert.ok(/^[a-f0-9]{64}$/.test(p.untouchedCommercialSha256??''),'CONTAINER_NOTE_STOCK_BASELINE_REQUIRED');
   if(mode!=='preflight'){const baseline=confirmed('preflight').physical;assertTitlesUnchanged(baseline.titles,p.titles);assert.equal(p.untouchedCommercialSha256,baseline.untouchedCommercialSha256,'CONTAINER_NOTE_STOCK_UNCHANGED');}
   return p;
  };
  return options.session(async({runtime,login})=>{
   assert.equal(login?.user?.username,a.expectedActor,'AUTHENTICATED_SESSION_ACTOR');const call=(screen,op,body,expected=200)=>runtime(screen+'/endpoints/'+op,body,expected);
   const context=()=>({proc_compra_id:scope.proc_compra_id});
   const payment=(op,body={},status=200)=>call(PAYMENTS,op,{...body,context:context()},status);
   const item=(op,body={},status=200)=>call(SCREEN,op,{...body,context:context()},status);
   async function audit(pid=scope.proc_compra_id){
    if(!pid)return [];
    // Parent recordEvents includes descendant item/payment actual or initiating owners.
    const response=await call(LOGS,'read',{take:2000,skip:0,filters:[{field:'audit_screen_id',operator:'eq',value:PARENT},{field:'audit_record_id',operator:'eq',value:pid}],sort:[{field:'id',dir:'asc'}]});
    assert.ok(Array.isArray(response.data)&&Number.isInteger(response.total)&&response.total===response.data.length&&response.total<=2000,'NO_PARTIAL_AUDIT');
    // The generic log endpoint also returns technical request/execution events.
    // Check completeness above before filtering; never discard an available
    // native audit because its source, owner, actor or resource is invalid.
    const events=response.data.map(normalizeEvent).filter(e=>e.meta?.audit?.available===true);for(const e of events){assert.ok(e.meta.audit.procCompraId===pid||e.meta.audit.originProcCompraId===pid,'CLOSED_AUDIT_SCOPE');}return events;
   }
   async function links(){const r=await payment('read',{take:100,skip:0});assert.ok(Array.isArray(r.data)&&r.total===r.data.length&&r.total<=2);for(const row of r.data){assert.equal(row.proc_compra_id,scope.proc_compra_id);assert.ok(a.titleIds.includes(row.num_id_tit_ap));assert.match(row.pagamento_key,/^p_[A-F0-9]{64}$/);}return r.data;}
   function physicalItem(row){const expected=draft.entityDraft.fields.filter(f=>!EXTRA.includes(f.code)).map(f=>f.code);assert.deepEqual(Object.keys(row).filter(k=>!EXTRA.includes(k)).sort(),expected.sort(),'ITEM_AUDIT46');return Object.fromEntries(expected.map(k=>[k,row[k]]));}
   function assertItem(row,label){assert.equal(Object.keys(row).length,50,'ITEM_DTO50');physicalItem(row);assert.equal(row.proc_compra_id,scope.proc_compra_id);assert.equal(row.item_proc_compra_id,ownership.items[label]);assert.equal(row.codigo_erp,ERP);assert.ok(row.descricao.startsWith(TAG+'/'+label));assert.ok(row.observacao.startsWith(TAG+'/'+label));assert.match(row.row_stamp,/^[A-F0-9]{64}$/);assert.equal(row.qt_alocada,0);assert.equal(row.qt_saldo,row.qt_comprada);}
   function assertParent(row){assert.equal(row.proc_compra_id,scope.proc_compra_id);assert.equal(row.cod_proc_fornec,TAG);assert.equal(row.observacao,TAG);for(const key of ['empresa_id','fornecedor_id','dt_registro'])assert.equal(row[key],ownership.header[key]);assert.match(row.row_stamp,/^[A-F0-9]{64}$/);}
   async function once(screen,operation,body,expected=200){
    assert.equal(hash(authorization()),approvalHash,'AUTHORIZATION_CHANGED_DURING_STAGE');save('write-started-'+mode+'.json',{version:1,tag:TAG,at:clock(),scope,screen,operation,body,expectedStatus:expected,outcome:'unknown-inspect-never-automatically-repeat'});
    const response=await call(screen,operation,body,expected);save('response-'+mode+'.json',response);return response;
   }
   const commit=value=>{save('confirmed-'+mode+'.json',{version:1,success:true,tag:TAG,mode,at:clock(),...value});return {success:true,mode,readOnly:!writing};};
   if(mode==='preflight'){
    const definitions={};for(const name of [PARENT,PAYMENTS,SCREEN]){const d=await runtime(name);assert.equal(d.screenId,name,'PUBLISHED_SCREEN_REQUIRED');for(const op of ['read','get','create','delete',...(name===PAYMENTS?[]:['update'])])assert.equal(d.dataSource?.api?.[op]?.endpointId,op);definitions[name]={screenId:d.screenId,program:d.program};}
    assert.equal(definitions[PARENT].program.id,'cd0108');assert.equal(definitions[PAYMENTS].program.id,'op1013');assert.equal(definitions[SCREEN].program.id,'op1014');
    const collisions=await call(PARENT,'read',{take:2,skip:0,filters:[{field:'cod_proc_fornec',operator:'eq',value:TAG}]});assert.equal(collisions.total,0,'NEVER_ADOPT_EXISTING_MARKER');assert.deepEqual(collisions.data,[]);
    const p=await probe('preflight');assertTitlesUnchanged(p.titles,p.titles);assert.deepEqual(p.titles.map(t=>t.num_id_tit_ap).sort((x,y)=>x-y),[...a.titleIds].sort((x,y)=>x-y));
    for(const t of p.titles){assert.equal(t.origin,'MED');assert.equal(t.validCurrency,true);assert.equal(t.eligible,true);for(const key of ['container_links','order_links','ledger_rows'])assert.deepEqual(t[key],[],'TITLE_PREEXISTING_RELATION_FORBIDDEN');}
    assert.deepEqual(p.ledger,[]);assert.deepEqual(p.items,[]);assert.deepEqual(p.orders,[]);assert.deepEqual(p.payment_links,[]);assert.equal(p.supplierId,config.seed.fornecedor_id);
    if(options.referenceTitles)assertTitlesUnchanged(options.referenceTitles,p.titles);return commit({readOnly:true,definitions,seed:config.seed,titleIds:a.titleIds,physical:p,referenceCompared:!!options.referenceTitles});
   }
   if(mode==='create-header'){
    const baseline=confirmed('preflight');assert.deepEqual(baseline.seed,config.seed);const before=await probe(mode+'-before');assert.deepEqual(before.orders,[]);
    const collision=await call(PARENT,'read',{take:2,skip:0,filters:[{field:'cod_proc_fornec',operator:'eq',value:TAG}]});assert.equal(collision.total,0);assert.deepEqual(collision.data,[]);
    const result=record(await once(PARENT,'create',{record:{cod_situacao:1,cod_proc_fornec:TAG,qt_dias_translado:0,observacao:TAG,dt_registro:config.seed.dt_registro,fornecedor_id:config.seed.fornecedor_id,dt_limite:null,log_facilid_contato_fornec:true,log_considerar_previsao:true,nr_container_original:''}}));
    assert.ok(positive(result.proc_compra_id));scope.proc_compra_id=result.proc_compra_id;ownership={header:result,items:{}};assertParent(result);assert.equal(result.log_considerar_previsao,true);assert.equal(result.empresa_id,config.seed.empresa_id);assert.deepEqual(record(await call(PARENT,'get',{id:scope.proc_compra_id})),result);
    const events=await audit();validateEvents(events,scope,mode);assert.equal(events.length,1);assert.equal(events[0].meta.audit.resource,'procs_compra');assert.equal(events[0].meta.audit.operation,'create');assert.deepEqual(events[0].after,Object.fromEntries(Object.entries(result).filter(([k])=>k!=='row_stamp')));
    save('observed-native-'+mode+'.json',{tag:TAG,mode,validatedNativeEvents:true,scope,events});
    const after=await probe(mode+'-after');assert.deepEqual(after.ledger,[]);return commit({scope,record:result,events,ledger:[],physical:after});
   }
   const prior=history(),allEvents=prior.flatMap(r=>r.events??[]),previousLedger=prior.at(-1)?.ledger??[];
   if(mode==='inspect'){
    const physical=await probe('inspect'),events=await audit();let unconfirmedCandidate=null;
    if(!scope.proc_compra_id){const marked=await call(PARENT,'read',{take:2,skip:0,filters:[{field:'cod_proc_fornec',operator:'eq',value:TAG}]});assert.ok(marked.total<=1,'AMBIGUOUS_UNCONFIRMED_HEADER');if(marked.total===1){const id=marked.data[0].proc_compra_id;assert.ok(positive(id));unconfirmedCandidate={record:record(await call(PARENT,'get',{id})),events:await audit(id)};}}
    const snapshot={success:true,tag:TAG,mode,at:clock(),readOnly:true,scope,physical,events,unconfirmedCandidate,unknownAttempts:WRITES.filter(m=>exists('write-started-'+m+'.json')&&!exists('confirmed-'+m+'.json')),adoptedUnconfirmedRecord:false};
    save('inspection-'+Date.now()+'.json',snapshot);return {success:true,mode,readOnly:true};
   }
   if(mode==='prepare-cleanup'||mode==='verify-final'){
    confirmed('delete-header');const physical=await probe(mode);for(const key of ['orders','items','payment_links'])assert.deepEqual(physical[key],[],'SCENARIO_HAS_NO_REMAINING_'+key);
    assert.deepEqual(await audit(),allEvents,'CONFIRMED_NATIVE_LOGS_PRESERVED');
    if(mode==='prepare-cleanup'){const manifest=prepareCleanupManifest(scope,allEvents,previousLedger,physical);save('cleanup-exact-ledger-manifest.json',manifest);return commit({scope,physical,ledger:previousLedger,manifestSha256:hash(manifest),requiresRootCleanup:manifest.ledgerIds.length>0});}
    const cleanup=options.cleanupProof;assert.ok(cleanup?.success===true&&cleanup.source==='official-openedge12.2','ROOT_CLEANUP_PROOF_REQUIRED');const manifest=read('cleanup-exact-ledger-manifest.json');assert.equal(cleanup.manifestSha256,hash(manifest));assert.deepEqual(cleanup.removedLedgerIds,manifest.ledgerIds);assert.equal(cleanup.confirmedLogsPreserved,true);assert.deepEqual(physical.ledger,[]);return commit({scope,physical,ledger:[],operationalFinalProof:true});
   }
   const physicalBefore=await probe(mode+'-before');assert.deepEqual(ordered(physicalBefore.ledger),ordered(previousLedger),'NO_UNCONFIRMED_LEDGER_CHANGE');
   const header=record(await call(PARENT,'get',{id:scope.proc_compra_id}));assertParent(header);const beforeLinks=await links(),auditBefore=await audit();
   assert.deepEqual(auditBefore.map(e=>String(e.id)).sort(),allEvents.map(e=>String(e.id)).sort(),'NO_UNCONFIRMED_NATIVE_EVENTS');
   let response,beforeItem=null,targetLabel=null,operation=null;
   if(/^create-[abc]$/.test(mode)){
    targetLabel=mode.at(-1).toUpperCase();operation='create';assert.equal(header.log_considerar_previsao,true);
    const body=buildItemCreate(draft,scope.proc_compra_id,targetLabel);response=record(await once(SCREEN,'create',body));assert.ok(positive(response.item_proc_compra_id));assert.ok(!scope.itemIds.includes(response.item_proc_compra_id),'GENERATED_SEQUENCE_ID_MUST_NOT_REUSE_A_B');ownership.items[targetLabel]=response.item_proc_compra_id;scope.itemIds.push(response.item_proc_compra_id);assertItem(response,targetLabel);
   }else if(mode==='associate'){
    assert.deepEqual(beforeLinks,[]);const available=await payment('options.titulos'),entries=available.data??available.options??available;assert.ok(Array.isArray(entries));for(const id of a.titleIds)assert.ok(entries.some(e=>Number(e.num_id_tit_ap??e.value)===id),'EXACT_SELECTED_TITLE_NOT_AVAILABLE');
    response=await once(PAYMENTS,'create',{record:{titulos:a.titleIds},context:context()});
   }else if(['update-a','repeat-a','stale-a','delete-a','update-b','delete-b','delete-c'].includes(mode)){
    targetLabel=mode.at(-1).toUpperCase();if(['repeat-a','stale-a'].includes(mode))targetLabel='A';const id=ownership.items[targetLabel];assert.ok(positive(id),'CONFIRMED_OWN_ITEM_REQUIRED');beforeItem=record(await item('get',{id}));assertItem(beforeItem,targetLabel);
    operation=mode.startsWith('delete')?'delete':'update';let next={...beforeItem};
    if(mode==='update-a')Object.assign(next,{qt_comprada:12,vl_negociado:4,vl_custo_dolar:2.5,descricao:TAG+'/A/alterado',observacao:TAG+'/A/alterado',peso:'150',largura:'140,5',dt_real_aprov_so_ld:'2026-10-22',qt_dias_producao:5,dt_maxima_producao:null,dt_real_envio_desenhos:'2026-10-22',qt_dias_calc_so_ld:3,dt_prev_recbto_so_ld:null});
    if(mode==='update-b')next.observacao=TAG+'/B/apos-exclusao-A';
    if(mode==='stale-a'){next.row_stamp=confirmed('create-a').record.row_stamp;assert.notEqual(next.row_stamp,beforeItem.row_stamp);}
    const body={id,record:next,context:context()};response=await once(SCREEN,operation,body,mode==='stale-a'?409:200);if(operation!=='delete'&&mode!=='stale-a')response=record(response);
   }else if(mode==='disable'){
    assert.equal(header.log_considerar_previsao,true);assert.equal(physicalBefore.items.length,2,'DISABLE_WHILE_B_C_EXIST');response=record(await once(PARENT,'update',{id:scope.proc_compra_id,record:{...header,log_considerar_previsao:false}}));
   }else if(mode==='unlink1'||mode==='unlink2'){
    assert.equal(header.log_considerar_previsao,false);const index=mode==='unlink1'?0:1,target=beforeLinks.find(l=>l.num_id_tit_ap===a.titleIds[index]);assert.ok(target);assert.equal(beforeLinks.length,mode==='unlink1'?2:1);response=await once(PAYMENTS,'delete',{id:target.pagamento_key,context:context()});
   }else if(mode==='delete-header'){
    assert.deepEqual(beforeLinks,[]);assert.equal(header.log_considerar_previsao,false);assert.deepEqual(physicalBefore.items,[]);response=await once(PARENT,'delete',{id:scope.proc_compra_id,record:header});
   }else throw Error('UNIMPLEMENTED_STAGE');
   if(targetLabel)scope.initiatingItemId=ownership.items[targetLabel];
   const auditAfter=await audit(),knownIds=new Set(auditBefore.map(e=>String(e.id))),events=auditAfter.filter(e=>!knownIds.has(String(e.id)));validateEvents(events,scope,mode);
   save('observed-native-'+mode+'.json',{tag:TAG,mode,validatedNativeEvents:true,scope,events});
   const ledger=replayLedger(previousLedger,events,scope),physicalAfter=await probe(mode+'-after');assert.deepEqual(ordered(physicalAfter.ledger),ordered(ledger),'PHYSICAL_LEDGER_EQUALS_CONFIRMED_NATIVE_EFFECTS');
   const afterLinks=mode==='delete-header'?[]:await links();
   if(targetLabel){
    const id=ownership.items[targetLabel],mains=events.filter(e=>e.meta.audit.resource==='itens_proc_compra');
    if(mode==='stale-a'){assert.ok(response.error);assert.deepEqual(record(await item('get',{id})),beforeItem);assert.deepEqual(physicalAfter, {...physicalBefore,phase:physicalAfter.phase,capturedAt:physicalAfter.capturedAt});assert.deepEqual(afterLinks,beforeLinks);}
    else {
     assert.equal(mains.length,1);const main=mains[0];assert.equal(main.meta.audit.operation,operation);assert.equal(Number(main.meta.audit.recordId),id);
     if(operation!=='create')assert.deepEqual(main.before,physicalItem(beforeItem));if(operation==='delete'){assert.ok(empty(main.after));await item('get',{id},404);assert.ok(!physicalAfter.items.some(r=>r.item_proc_compra_id===id),'DELETED_ITEM_PHYSICALLY_ABSENT');assert.ok(ledger.filter(r=>r.item_proc_compra_id===id).length>0||mode!=='delete-a','DELETED_A_HISTORY_RETAINED');verifyFinancial(ledger.filter(r=>r.item_proc_compra_id===id),{obligations:{},allocations:{}},scope);}
     else {assertItem(response,targetLabel);assert.deepEqual(main.after,physicalItem(response));assert.deepEqual(record(await item('get',{id})),response);assert.deepEqual(physicalAfter.items.find(r=>r.item_proc_compra_id===id),physicalItem(response),'EXACT_PHYSICAL_ITEM_AFTER');}
     if(mode==='update-a'){assert.notEqual(response.row_stamp,beforeItem.row_stamp);assert.equal(response.calc_gm,210.75);assert.equal(response.dt_maxima_producao,'2026-10-27');assert.equal(response.dt_prev_recbto_so_ld,'2026-10-25');assert.ok(events.some(e=>e.meta.audit.resource==='cta_corren_fornec_imp'&&e.after.cod_tipo_movto===3&&e.after.vl_lancto===18),'OBLIGATION_DIFFERENCE18');}
     if(mode==='repeat-a'){assert.deepEqual(response,beforeItem);assert.deepEqual(ledger,previousLedger);assert.equal(events.filter(e=>e.meta.audit.resource==='cta_corren_fornec_imp').length,0,'CONVERGENCE_NO_NEW_MOVEMENTS');}
     assert.deepEqual(afterLinks,beforeLinks);
    }
   }
   if(mode==='associate'){assert.equal(afterLinks.length,2);assert.deepEqual(afterLinks.map(l=>l.num_id_tit_ap).sort((x,y)=>x-y),[...a.titleIds].sort((x,y)=>x-y));assert.equal(events.filter(e=>e.meta.audit.resource==='purchase_payment_links').length,2);}
   if(mode==='unlink1'||mode==='unlink2')assert.equal(afterLinks.length,mode==='unlink1'?1:0);
   if(mode==='delete-header'){await call(PARENT,'get',{id:scope.proc_compra_id},404);assert.equal(events.length,1);assert.equal(events[0].meta.audit.resource,'procs_compra');assert.equal(events[0].meta.audit.operation,'delete');assert.deepEqual(events[0].before,Object.fromEntries(Object.entries(header).filter(([k])=>k!=='row_stamp')));}
   else if(mode==='disable')assert.equal(record(await call(PARENT,'get',{id:scope.proc_compra_id})).log_considerar_previsao,false);
   if(!['disable','unlink1','unlink2','delete-b','delete-c','delete-header','stale-a'].includes(mode)){
    const obligations={},allocations={},items=physicalAfter.items;let total=0;for(const row of items){assert.ok(scope.itemIds.includes(row.item_proc_compra_id));const value=row.qt_comprada*row.vl_negociado;obligations[row.item_proc_compra_id]=value;total+=value;}
    for(const link of afterLinks){assert.ok(Number.isFinite(link.valor_dolar),'TITLE_DOLLAR_AMOUNT_REQUIRED');for(const row of items)allocations[row.item_proc_compra_id+':'+link.num_id_tit_ap]=-Math.round(link.valor_dolar*obligations[row.item_proc_compra_id]/total*100)/100;}
    verifyFinancial(ledger,{obligations,allocations},scope);
   }
   return commit({scope,record:targetLabel&&operation!=='delete'&&mode!=='stale-a'?response:mode==='disable'?response:null,events,ledger,links:afterLinks,physical:physicalAfter,responseConfirmed:true});
  },{readOnly:!writing});
 }
 return {run};
}
module.exports={TAG,ERP,SCREEN,PARENT,PAYMENTS,LOGS,WRITES,MODES,assertAuthorization,authorizationFileProvider,buildItemCreate,assertTitlesUnchanged,assertOwnedLedger,normalizeEvent,validateEvents,verifyFinancial,replayLedger,prepareCleanupManifest,createHarness,hash};
if(require.main===module){
 // CLI is opt-in; the official read-only physical adapter must be prepared by root.
 (async()=>{assert.equal(process.argv[3],'--execute-session','EXPLICIT_SESSION_FLAG_REQUIRED');const mode=process.argv[2],state=path.resolve(__dirname,'../../.runtime/purchase-items-20261022/exercise');
  const authorization=authorizationFileProvider(path.resolve(state,'../authorization.json'));assertAuthorization(authorization());
  const adapterPath=path.resolve(state,'../physical-bridge/adapter.cjs');assert.ok(fs.existsSync(adapterPath),'ROOT_OFFICIAL_PHYSICAL_ADAPTER_PENDING');
  const bridge=require(adapterPath);assert.equal(typeof bridge.physicalProbe,'function');
  const c=require('./purchase-items-metadata-common.cjs');await createHarness({state,authorization,session:c.session,physicalProbe:bridge.physicalProbe,referenceTitles:bridge.referenceTitles,cleanupProof:bridge.cleanupProof}).run(mode);
  console.log('PASS '+mode+'; comprovantes privados.');
 })().catch(()=>{console.error('Etapa não confirmada. Inspecionar recibos privados; nunca repetir POST desconhecido.');process.exitCode=1;});
}
