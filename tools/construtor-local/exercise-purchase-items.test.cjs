'use strict';
const test=require('node:test'),assert=require('node:assert/strict'),fs=require('node:fs'),path=require('node:path');
const file=path.join(__dirname,'exercise-purchase-items.cjs');
const h=fs.existsSync(file)?require(file):{};
const draft=JSON.parse(fs.readFileSync(path.join(__dirname,'../../integration-src/purchase-items/metadata/proc-compra-itens-builder-draft.json'),'utf8'));
const auth=()=>({authorized:true,tag:'SC_TEST_PROC_ITENS_20261022',newHeader:true,generatedItemIds:true,allowExistingTitleWrites:false,allowContainerWrites:false,humanApproval:{source:'human-user-message',reference:'approval-message-id'},expectedActor:'admin',titleIds:[71,72]});
const title=id=>({num_id_tit_ap:id,titleMatches:1,origin:'MED',validCurrency:true,eligible:true,title:{num_id_tit_ap:id,cod_estab:'505',amount:12},title_values:[{currency:'Dolar',value:5}],container_links:[],order_links:[],ledger_rows:[]});
const ledger=(overrides={})=>({cta_corren_fornec_imp_id:901,fornecedor_id:27,data:'2026-10-22',item_proc_compra_id:101,historico:'test',cod_tipo_movto:3,vl_lancto:30,cod_acao:1,login:'admin',data_hora:'2026-10-22T12:00:00',num_id_tit_ap:0,item_container_id:0,transacao_id:0,proc_compra_id:81,...overrides});
const scope=()=>({proc_compra_id:81,itemIds:[101,102,103],titleIds:[71,72],supplierId:27,actor:'admin'});
const event=(row,operation='create')=>({id:17,transaction_id:7,actor_user_id:'admin',meta:{audit:{available:true,source:'progress-transaction',version:1,resource:'cta_corren_fornec_imp',operation,recordId:row.cta_corren_fornec_imp_id,procCompraId:81,originProcCompraId:81,itemProcCompraId:row.item_proc_compra_id}},before:operation==='create'?{}:row,after:operation==='delete'?{}:row});
function temp(){const base=path.resolve(__dirname,'../../.runtime/purchase-items-20261022/test-runs');fs.mkdirSync(base,{recursive:true});return fs.mkdtempSync(path.join(base,'isolated-'));}
test('authorization refuses old scopes, missing human consent and fixed item IDs',()=>{
 assert.equal(typeof h.assertAuthorization,'function','authorization guard must exist');h.assertAuthorization(auth());
 for(const override of [{authorized:false},{tag:'SC_TEST_PROC_COMPRA_20261022'},{newHeader:false},{generatedItemIds:false},{allowExistingTitleWrites:true},{allowContainerWrites:true},{humanApproval:null},{humanApproval:{source:'agent',reference:'self'}},{itemIds:[101,102]}])assert.throws(()=>h.assertAuthorization({...auth(),...override}));
});
test('new item uses metadata defaults, exact numeric ERP text and excludes generated/read-only fields',()=>{
 assert.equal(typeof h.buildItemCreate,'function');const body=h.buildItemCreate(draft,81,'A');
 assert.equal(Object.keys(body.record).length,44);assert.deepEqual(body.context,{proc_compra_id:81});
 for(const name of ['item_proc_compra_id','proc_compra_id','row_stamp','calc_gm','qt_saldo','qt_alocada'])assert.ok(!(name in body.record));
 assert.equal(body.record.codigo_erp,'2147000107');assert.equal(body.record.qt_comprada,10);assert.equal(body.record.vl_negociado,3);assert.equal(body.record.vl_custo_dolar,2);assert.equal(body.record.unid_medida,'MT');
 for(const name of ['coloracao_id','formato_amostra_id','item_estacao'])assert.equal(body.record[name],0);
 for(const field of draft.entityDraft.fields.filter(x=>x.dataType==='date'))assert.equal(body.record[field.code],null);
 const b=h.buildItemCreate(draft,81,'B');assert.equal(b.record.qt_comprada,20);assert.equal(b.record.vl_negociado,5);assert.equal(b.record.vl_custo_dolar,4);
});
test('immutable title comparison preserves every physical field, null, type and duplicate value rows',()=>{
 assert.equal(typeof h.assertTitlesUnchanged,'function');const baseline=[title(71),title(72)];h.assertTitlesUnchanged(baseline,[title(72),title(71)]);
 for(const mutate of [v=>v[0].title.amount++,v=>v[0].title_values.push(v[0].title_values[0]),v=>delete v[1].title.cod_estab,v=>v[0].title.amount='12',v=>v.pop()]){const next=structuredClone(baseline);mutate(next);assert.throws(()=>h.assertTitlesUnchanged(baseline,next));}
});
test('ledger cleanup ownership rejects foreign item/title/container/actor/supplier and incomplete images',()=>{
 assert.equal(typeof h.assertOwnedLedger,'function');h.assertOwnedLedger(ledger(),scope());
 for(const override of [{item_proc_compra_id:104},{proc_compra_id:82},{num_id_tit_ap:73},{item_container_id:1},{container_id:1},{login:'other'},{fornecedor_id:28},{cod_tipo_movto:5}])assert.throws(()=>h.assertOwnedLedger(ledger(override),scope()));
 const missing=ledger();delete missing.data_hora;assert.throws(()=>h.assertOwnedLedger(missing,scope()));
});
test('cleanup manifest requires native creation IDs, exact current images, physical confirmation and zero balances',()=>{
 assert.equal(typeof h.prepareCleanupManifest,'function');const rows=[ledger(),ledger({cta_corren_fornec_imp_id:902,vl_lancto:-30})];
 const events=rows.map((r,i)=>({...event(r),id:17+i}));const physical={source:'official-openedge12.2',readOnly:true,ledger:rows};
 const result=h.prepareCleanupManifest(scope(),events,rows,physical);assert.deepEqual(result.ledgerIds,[901,902]);assert.equal(result.broadDeleteAllowed,false);assert.equal(result.deleteConfirmedLogs,false);
 assert.ok(Array.isArray(result.physicalRows),'physical13 snapshots required');assert.equal(result.physicalRows[0].cta_corren_fornec_imp_id,901);assert.equal(Object.keys(result.physicalRows[0]).length,13);assert.ok(!Object.hasOwn(result.physicalRows[0],'proc_compra_id'));
 assert.throws(()=>h.prepareCleanupManifest(scope(),events.slice(1),rows,physical));
 assert.throws(()=>h.prepareCleanupManifest(scope(),events,rows,{...physical,ledger:[rows[0]]}));
 assert.throws(()=>h.prepareCleanupManifest(scope(),events,rows.map(r=>({...r,vl_lancto:0})),physical));
 assert.throws(()=>h.prepareCleanupManifest(scope(),events,[rows[0]],{...physical,ledger:[rows[0]]}));
});
test('native audits validate real owners and initiators and never accept a forged actor or other resource',()=>{
 assert.equal(typeof h.validateEvents,'function');h.validateEvents([event(ledger())],scope(),'associate');
 for(const mutate of [e=>e.actor_user_id='other',e=>e.meta.audit.originProcCompraId=82,e=>e.meta.audit.procCompraId=82,e=>e.meta.audit.available=false,e=>e.meta.audit.resource='containers',e=>e.meta.audit.recordId=999]){const e=event(ledger());mutate(e);assert.throws(()=>h.validateEvents([e],scope(),'associate'));}
});
test('financial verifier checks signed historical balance rather than number of rows',()=>{
 assert.equal(typeof h.verifyFinancial,'function');const rows=[ledger(),ledger({cta_corren_fornec_imp_id:902,vl_lancto:10}),ledger({cta_corren_fornec_imp_id:903,item_proc_compra_id:102,vl_lancto:100}),ledger({cta_corren_fornec_imp_id:904,cod_tipo_movto:4,num_id_tit_ap:71,vl_lancto:-2}),ledger({cta_corren_fornec_imp_id:905,cod_tipo_movto:4,num_id_tit_ap:71,vl_lancto:-2})];
 h.verifyFinancial(rows,{obligations:{101:40,102:100},allocations:{'101:71':-4}},scope());
 assert.throws(()=>h.verifyFinancial(rows,{obligations:{101:30,102:100},allocations:{'101:71':-4}},scope()));
});
test('all session entry points reject missing consent before opening a session',async t=>{
 assert.equal(typeof h.createHarness,'function');let sessions=0;const state=temp(t);const harness=h.createHarness({state,authorization:()=>({...auth(),authorized:false}),session:async()=>{sessions++;throw Error('must not open');}});
 for(const mode of h.MODES)await assert.rejects(harness.run(mode),/AUTHORIZATION/);assert.equal(sessions,0);
});
test('unknown write attempt receipt blocks replay before session or network',async t=>{
 assert.equal(typeof h.createHarness,'function');const state=temp(t);fs.writeFileSync(path.join(state,'write-started-create-header.json'),'{}');let sessions=0;
 const harness=h.createHarness({state,authorization:auth,session:async()=>{sessions++;}});await assert.rejects(harness.run('create-header'),/REPLAY/);assert.equal(sessions,0);
});
test('confirmed stage cannot be replayed even if write-started receipt is absent',async t=>{
 assert.equal(typeof h.createHarness,'function');const state=temp(t);fs.writeFileSync(path.join(state,'confirmed-create-header.json'),'{}');let sessions=0;
 const harness=h.createHarness({state,authorization:auth,session:async()=>{sessions++;}});await assert.rejects(harness.run('create-header'),/REPLAY/);assert.equal(sessions,0);
});
test('missing physical bridge blocks server entry instead of manufacturing title or physical proof',async t=>{
 assert.equal(typeof h.createHarness,'function');let sessions=0;const harness=h.createHarness({state:temp(t),authorization:auth,session:async()=>{sessions++;}});
 await assert.rejects(harness.run('preflight'),/PHYSICAL_PROBE/);assert.equal(sessions,0);
});
test('import does not load credential/session modules or fetch',()=>{
 assert.ok(fs.existsSync(file),'pure executor must exist');const {spawnSync}=require('node:child_process');
 const code="const fs=require('node:fs');const original=fs.readFileSync;fs.readFileSync=(p,...a)=>{if(String(p).includes('acesso-local'))throw Error('CREDENTIAL_READ');return original(p,...a)};global.fetch=()=>{throw Error('NETWORK')};require(process.argv[1]);if(Object.keys(require.cache).some(p=>p.endsWith('purchase-items-metadata-common.cjs')))throw Error('SESSION_MODULE_LOADED');";
 const r=spawnSync(process.execPath,['-e',code,file],{encoding:'utf8'});assert.equal(r.status,0,r.stderr);
});

// In-memory endpoint substitute: the real dependency requires a published server
// and new human consent. It deliberately exposes native shapes, not harness helpers.
function localScenario(state,{loseHeaderResponse=false}={}){
 let header=null,nextItem=101,nextLedger=901,nextLog=1,transaction=0,stamp=0,requests=[];const items=new Map(),rows=new Map(),native=[],linked=new Map();
 const clone=v=>JSON.parse(JSON.stringify(v));const stampRow=row=>({...row,row_stamp:(++stamp).toString(16).toUpperCase().padStart(64,'0')});
 const image=row=>Object.fromEntries(Object.entries(row).filter(([key])=>!['row_stamp','qt_alocada','qt_saldo','calc_gm'].includes(key)));
 const emit=(resource,op,before,after,originItem)=>{
  const row=op==='delete'?before:after;const id=row[resource==='procs_compra'?'proc_compra_id':resource==='itens_proc_compra'?'item_proc_compra_id':resource==='purchase_payment_links'?'pagamento_key':'cta_corren_fornec_imp_id'];
  const audit={available:true,version:1,source:'progress-transaction',resource,operation:op,recordId:id,procCompraId:81};
  if(resource==='purchase_payment_links')audit.paymentKey=id;else if(resource==='cta_corren_fornec_imp'&&op==='create'&&row.cod_tipo_movto===4&&!originItem&&linked.size)audit.paymentKey=[...linked.values()].find(l=>l.num_id_tit_ap===row.num_id_tit_ap)?.pagamento_key;
  else audit.originProcCompraId=81;
  if(resource==='itens_proc_compra'){audit.itemProcCompraId=id;audit.originItemProcCompraId=id;}
  if(resource==='cta_corren_fornec_imp'&&originItem){audit.itemProcCompraId=row.item_proc_compra_id;audit.originItemProcCompraId=originItem;}
  native.push({id:nextLog++,transaction_id:transaction,actor_user_id:'admin',metadata:JSON.stringify({audit}),before_data:JSON.stringify(before),after_data:JSON.stringify(after)});
 };
 const balance=(id,kind,tid=0)=>[...rows.values()].filter(r=>r.item_proc_compra_id===id&&r.cod_tipo_movto===kind&&r.num_id_tit_ap===tid).reduce((s,r)=>s+r.vl_lancto,0);
 const append=(id,kind,tid,amount,origin)=>{if(Math.abs(amount)<0.005)return;const row=ledger({cta_corren_fornec_imp_id:nextLedger++,item_proc_compra_id:id,cod_tipo_movto:kind,num_id_tit_ap:tid,vl_lancto:Math.round(amount*100)/100});rows.set(row.cta_corren_fornec_imp_id,row);emit('cta_corren_fornec_imp','create',{},row,origin);};
 const reconcile=origin=>{
  const total=[...items.values()].reduce((s,r)=>s+r.qt_comprada*r.vl_negociado,0);const allIds=new Set([...items.keys(),...[...rows.values()].map(r=>r.item_proc_compra_id)]);
  for(const id of allIds){const row=items.get(id),obligation=header.log_considerar_previsao&&row?row.qt_comprada*row.vl_negociado:0;append(id,3,0,obligation-balance(id,3),origin);
   for(const tid of [71,72]){const link=linked.get(tid),expected=link&&row&&total?-Math.round(link.valor_dolar*row.qt_comprada*row.vl_negociado/total*100)/100:0;append(id,4,tid,expected-balance(id,4,tid),origin);}
  }
 };
 const definition=screen=>({screenId:screen,program:{id:screen===h.PARENT?'cd0108':screen===h.SCREEN?'op1014':'op1013',version:screen===h.PARENT?'1.0.1':'1.0.0'},dataSource:{api:Object.fromEntries(['read','get','create','update','delete'].map(op=>[op,{endpointId:op}]))}});
 async function runtime(url,body,status=200){
  requests.push({url,body:clone(body??null),status});if(!url.includes('/endpoints/'))return definition(url);
  const [screen,op]=url.split('/endpoints/');
  if(screen===h.LOGS){assert.deepEqual(body.filters,[{field:'audit_screen_id',operator:'eq',value:h.PARENT},{field:'audit_record_id',operator:'eq',value:81}]);return {data:clone(native),total:native.length};}
  if(screen===h.PARENT&&op==='read')return {data:header?[clone(header)]:[],total:header?1:0};
  if(screen===h.PARENT&&op==='get'){assert.equal(body.id,81);assert.equal(status,header?200:404);return header?{data:clone(header)}:{error:{code:'NOT_FOUND'}};}
  if(screen===h.SCREEN){assert.deepEqual(body.context,{proc_compra_id:81});if(op==='get'){const row=items.get(body.id);assert.equal(status,row?200:404);return row?{data:clone(row)}:{error:{code:'NOT_FOUND'}};}}
  if(screen===h.PAYMENTS){assert.deepEqual(body.context,{proc_compra_id:81});if(op==='read')return {data:clone([...linked.values()]),total:linked.size};if(op==='options.titulos')return {data:[{value:71},{value:72}]};}
  if(!['create','update','delete'].includes(op))throw Error('Unexpected local endpoint '+url);
  transaction++;
  if(screen===h.PARENT){
   if(op==='create'){assert.ok(!('proc_compra_id'in body.record));header=stampRow({proc_compra_id:81,empresa_id:2,qt_container:0,cotacao_prevista:0,...body.record});emit('procs_compra','create',{},image(header));if(loseHeaderResponse)throw Error('SIMULATED_POST_TIMEOUT');return {data:clone(header)};}
   if(op==='update'){const before=image(header);header=stampRow({...body.record});emit('procs_compra','update',before,image(header));for(const [id,row]of rows)if(items.has(row.item_proc_compra_id)){emit('cta_corren_fornec_imp','delete',row,{});rows.delete(id);}return {data:clone(header)};}
   emit('procs_compra','delete',image(header),{});header=null;return {success:true};
  }
  if(screen===h.SCREEN){
   const id=op==='create'?nextItem++:body.id,before=items.get(id);if(op==='update'&&body.record.row_stamp!==before.row_stamp){assert.equal(status,409);return {error:{code:'PURCHASE_ITEM_CHANGED'}};}
   if(op==='delete'){items.delete(id);emit('itens_proc_compra','delete',image(before),{},id);if(header.log_considerar_previsao)reconcile(id);return {success:true};}
   const row={...body.record,item_proc_compra_id:id,proc_compra_id:81};delete row.row_stamp;
   Object.assign(row,{qt_alocada:0,qt_saldo:row.qt_comprada,calc_gm:row.peso==='150'&&row.largura==='140,5'?210.75:null});
   if(row.dt_real_aprov_so_ld==='2026-10-22')row.dt_maxima_producao='2026-10-27';if(row.dt_real_envio_desenhos==='2026-10-22')row.dt_prev_recbto_so_ld='2026-10-25';
   const changed=!before||JSON.stringify(image(row))!==JSON.stringify(image(before));const current=changed?stampRow(row):{...row,row_stamp:before.row_stamp};items.set(id,current);emit('itens_proc_compra',op,before?image(before):{},image(current),id);if(header.log_considerar_previsao)reconcile(id);return {data:clone(current)};
  }
  if(screen===h.PAYMENTS){
   if(op==='create'){assert.deepEqual(body.record.titulos,[71,72]);for(const tid of body.record.titulos){const row={pagamento_key:'p_'+String(tid).padStart(64,'A'),proc_compra_id:81,num_id_tit_ap:tid,titulos:[tid],valor_dolar:tid===71?14:28};linked.set(tid,row);emit('purchase_payment_links','create',{},row);}reconcile();return {success:true};}
   const entry=[...linked.values()].find(l=>l.pagamento_key===body.id);assert.ok(entry);emit('purchase_payment_links','delete',entry,{});linked.delete(entry.num_id_tit_ap);return {success:true};
  }
 }
 const physicalProbe=async request=>({...request,source:'official-openedge12.2',readOnly:true,success:true,capturedAt:'2026-10-22T12:00:01Z',supplierId:27,untouchedCommercialSha256:'a'.repeat(64),titles:[title(71),title(72)],orders:header?[image(header)]:[],items:[...items.values()].map(image),payment_links:clone([...linked.values()]),ledger:clone([...rows.values()])});
 const options={state,authorization:auth,config:{titleIds:[71,72],seed:{fornecedor_id:27,empresa_id:2,dt_registro:'2026-10-22'}},draft,now:()=> '2026-10-22T12:00:00Z',session:async callback=>callback({runtime,login:{user:{username:'admin'}}}),physicalProbe};
 return {options,requests,rows,native};
}
test('lost POST response leaves irreversible attempt guard and inspect can read unknown new header without adoption',async()=>{
 const state=temp(),s=localScenario(state,{loseHeaderResponse:true}),harness=h.createHarness(s.options);await harness.run('preflight');await assert.rejects(harness.run('create-header'),/SIMULATED_POST_TIMEOUT/);
 const requests=s.requests.length;await assert.rejects(harness.run('create-header'),/REPLAY/);assert.equal(s.requests.length,requests);
 const inspection=await harness.run('inspect');assert.equal(inspection.readOnly,true);assert.equal(fs.existsSync(path.join(state,'confirmed-create-header.json')),false);
});
test('native payment metadata accepts its confirmed payment initiator without inventing an origin field',()=>{
 const e=event(ledger({cod_tipo_movto:4,num_id_tit_ap:71,vl_lancto:-1}));delete e.meta.audit.originProcCompraId;e.meta.audit.paymentKey='p_'+'A'.repeat(64);h.validateEvents([e],scope(),'associate');
});
test('full isolated sequence preserves deleted A zero history, generates C, tears down API first and exact root cleanup last',async()=>{
 const state=temp(),s=localScenario(state),harness=h.createHarness(s.options);
 for(const mode of ['preflight',...h.WRITES]){const result=await harness.run(mode);assert.equal(result.success,true,mode);}
 const createA=JSON.parse(fs.readFileSync(path.join(state,'confirmed-create-a.json'))),createB=JSON.parse(fs.readFileSync(path.join(state,'confirmed-create-b.json'))),createC=JSON.parse(fs.readFileSync(path.join(state,'confirmed-create-c.json')));
 const observed=JSON.parse(fs.readFileSync(path.join(state,'observed-native-create-a.json')));assert.equal(observed.validatedNativeEvents,true);assert.equal(observed.events.find(e=>e.meta.audit.resource==='itens_proc_compra').after.item_proc_compra_id,101);
 assert.deepEqual([createA.record.item_proc_compra_id,createB.record.item_proc_compra_id,createC.record.item_proc_compra_id],[101,102,103]);
 const deleteA=JSON.parse(fs.readFileSync(path.join(state,'confirmed-delete-a.json')));assert.equal(deleteA.physical.items.some(r=>r.item_proc_compra_id===101),false);assert.ok(deleteA.ledger.some(r=>r.item_proc_compra_id===101));
 await harness.run('prepare-cleanup');const manifest=JSON.parse(fs.readFileSync(path.join(state,'cleanup-exact-ledger-manifest.json')));assert.ok(manifest.ledgerIds.length>0);assert.ok(manifest.ledger.every(r=>r.item_proc_compra_id===101));
 await assert.rejects(harness.run('verify-final'),/ROOT_CLEANUP_PROOF/);for(const id of manifest.ledgerIds)s.rows.delete(id);
 const final=h.createHarness({...s.options,cleanupProof:{success:true,source:'official-openedge12.2',manifestSha256:h.hash(manifest),removedLedgerIds:manifest.ledgerIds,confirmedLogsPreserved:true}});await final.run('verify-final');
 assert.equal(s.rows.size,0);assert.ok(s.native.length>0);assert.equal(s.requests.filter(r=>r.url.endsWith('/endpoints/create')&&r.url.startsWith(h.PARENT)).length,1);
 for(const request of s.requests){const screen=request.url.split('/endpoints/')[0];assert.ok([h.PARENT,h.PAYMENTS,h.SCREEN,h.LOGS].includes(screen));if(screen===h.LOGS)assert.ok(request.url.endsWith('/endpoints/read'));}
});
test('fresh title drift rejects header creation before POST and preserves the unstarted stage',async()=>{
 const state=temp(),s=localScenario(state),base=s.options.physicalProbe;s.options.physicalProbe=async request=>{const p=await base(request);if(request.phase==='create-header-before')p.titles[1].title_values[0].value=999;return p;};
 const harness=h.createHarness(s.options);await harness.run('preflight');await assert.rejects(harness.run('create-header'),/IMMUTABLE/);assert.equal(fs.existsSync(path.join(state,'write-started-create-header.json')),false);
 assert.equal(s.requests.some(r=>r.url.endsWith('/endpoints/create')),false);
});
test('physical evidence must be freshly captured and bound to the exact selected title IDs',async()=>{
 for(const mutation of [p=>p.capturedAt='2026-10-21T00:00:00Z',p=>p.titleIds=[71,73]]){
  const s=localScenario(temp()),base=s.options.physicalProbe;s.options.physicalProbe=async request=>{const p=await base(request);mutation(p);return p;};await assert.rejects(h.createHarness(s.options).run('preflight'));
 }
});
test('item audit ledger initiator must identify the item executing this stage',()=>{
 const e=event(ledger());e.meta.audit.originItemProcCompraId=102;
 assert.throws(()=>h.validateEvents([e],{...scope(),initiatingItemId:101},'update-a'));
});
test('authorization scope and actor changes after the physical probe prevent POST before write-started',async()=>{
 for(const mutate of [a=>a.authorized=false,a=>a.titleIds=[71,73],a=>a.expectedActor='other']){
  const state=temp(),s=localScenario(state),file=path.join(state,'human-authorization.json');fs.writeFileSync(file,JSON.stringify(auth()));s.options.authorization=()=>JSON.parse(fs.readFileSync(file));
  const base=s.options.physicalProbe;s.options.physicalProbe=async request=>{const p=await base(request);if(request.phase==='create-header-before'){const a=JSON.parse(fs.readFileSync(file));mutate(a);fs.writeFileSync(file,JSON.stringify(a));}return p;};
  const harness=h.createHarness(s.options);await harness.run('preflight');await assert.rejects(harness.run('create-header'),/AUTHORIZATION/);assert.equal(s.requests.some(r=>r.url.endsWith('/endpoints/create')),false);assert.equal(fs.existsSync(path.join(state,'write-started-create-header.json')),false);
 }
});
test('the CLI authorization file provider rereads approval rather than retaining the first object',()=>{
 assert.equal(typeof h.authorizationFileProvider,'function');const state=temp(),file=path.join(state,'human-authorization.json');fs.writeFileSync(file,JSON.stringify(auth()));const provider=h.authorizationFileProvider(file);assert.equal(provider().authorized,true);fs.writeFileSync(file,JSON.stringify({...auth(),authorized:false}));assert.equal(provider().authorized,false);
});
function withAuditEnvelope(s,mutate){
 const session=s.options.session;s.options.session=callback=>session(ctx=>callback({...ctx,runtime:async(...args)=>{const result=await ctx.runtime(...args);if(args[0]===h.LOGS+'/endpoints/read')return mutate(result);return result;}}));
}
const technicalAuditRows=()=>['runtime.request','api.execution','get','runtime.success'].map((event_type,i)=>({id:500+i,transaction_id:7,event_type,metadata:JSON.stringify(i===1?{audit:{available:false,reason:'technical-event'}}:{}),before_data:'{}',after_data:'{}'}));
test('technical audit events are ignored and native header proof exists before the physical after-probe',async()=>{
 const state=temp(),s=localScenario(state);withAuditEnvelope(s,r=>({data:[...technicalAuditRows(),...r.data],total:r.total+4}));
 const probe=s.options.physicalProbe;let checked=false;s.options.physicalProbe=async request=>{if(request.phase==='create-header-after'){const observed=JSON.parse(fs.readFileSync(path.join(state,'observed-native-create-header.json')));assert.equal(observed.validatedNativeEvents,true);assert.equal(observed.events.length,1);assert.equal(observed.events[0].after.proc_compra_id,81);checked=true;}return probe(request);};
 const harness=h.createHarness(s.options);await harness.run('preflight');await harness.run('create-header');assert.equal(checked,true);
 const confirmed=JSON.parse(fs.readFileSync(path.join(state,'confirmed-create-header.json')));assert.equal(confirmed.events.length,1);assert.equal(s.requests.filter(r=>r.url===h.PARENT+'/endpoints/create').length,1);
});
test('technical audit filtering never disguises a partially returned page',async()=>{
 const state=temp(),s=localScenario(state);withAuditEnvelope(s,r=>({data:[...technicalAuditRows(),...r.data],total:r.total+5}));const harness=h.createHarness(s.options);await harness.run('preflight');await assert.rejects(harness.run('create-header'),/NO_PARTIAL_AUDIT/);assert.equal(fs.existsSync(path.join(state,'confirmed-create-header.json')),false);await assert.rejects(harness.run('create-header'),/REPLAY/);
});
test('every available native audit is retained and invalid scope/source/actor/resource still fails',async()=>{
 for(const mutate of [e=>{const m=JSON.parse(e.metadata);m.audit.procCompraId=82;m.audit.originProcCompraId=82;e.metadata=JSON.stringify(m);},e=>{const m=JSON.parse(e.metadata);m.audit.source='technical';e.metadata=JSON.stringify(m);},e=>e.actor_user_id='other',e=>{const m=JSON.parse(e.metadata);m.audit.resource='containers';e.metadata=JSON.stringify(m);}]){
  const state=temp(),s=localScenario(state);withAuditEnvelope(s,r=>{const events=structuredClone(r.data);mutate(events[0]);return {data:[...technicalAuditRows(),...events],total:events.length+4};});const harness=h.createHarness(s.options);await harness.run('preflight');await assert.rejects(harness.run('create-header'));assert.equal(fs.existsSync(path.join(state,'observed-native-create-header.json')),false);assert.equal(fs.existsSync(path.join(state,'confirmed-create-header.json')),false);
 }
});
