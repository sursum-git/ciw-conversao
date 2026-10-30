'use strict';
// Explicit stages, durable receipts before every POST, never retry unknown writes.
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const TAG='SC_TEST_PROC_AMOSTRAS_20261022',P='ciw.processos-compra-med',I='ciw.proc-compra-itens',S='ciw.proc-compra-amostras',L='admin.logs-transacoes';
const STAGES=['preflight','create-parent','create-item','create-a','create-b','update-a','stale-a','format','delete-a','delete-b','delete-item','delete-parent','verify-final'];
const plain=r=>r.data&&!Array.isArray(r.data)?r.data:r;
const fields=['envio_amostra_repres_id','item_proc_compra_id','cod_rep','dt_envio','apont_amostra_id','proc_compra_id'];
const image=r=>Object.fromEntries(fields.map(k=>[k,r[k]]));
function itemCreate(draft,pid){const values=Object.fromEntries(draft.entityDraft.fields.filter(f=>f.options?.writable===true&&!f.readonlyField).map(f=>{assert.ok(Object.hasOwn(f.options,'defaultValue'));return [f.code,f.options.defaultValue];}));Object.assign(values,{descricao:TAG,observacao:TAG,codigo_erp:'',unid_medida:'MT',qt_comprada:1,vl_negociado:0,vl_custo_dolar:0});assert.equal(Object.keys(values).length,44);return {record:values,context:{proc_compra_id:pid}};}
function validateApproval(a){assert.equal(a.scenario.authorized,true);assert.equal(a.scenario.tag,TAG);assert.equal(a.scenario.newOrders,1);assert.equal(a.scenario.newItems,1);assert.equal(a.scenario.newShipments,2);for(const k of ['forecast','existingRepresentativeWrites','titlesContainersNotesStock'])assert.equal(a.scenario[k],false);assert.equal(a.humanApproval.source,'human-user-message');assert.ok(a.humanApproval.reference);}
async function run(mode){
 assert.ok(STAGES.includes(mode),'EXPLICIT_STAGE');const c=require('./purchase-samples-metadata-common.cjs');const b=c.state,e=path.join(b,'exercise');fs.mkdirSync(e,{recursive:true});
 const read=n=>JSON.parse(fs.readFileSync(path.join(e,n),'utf8'));const has=n=>fs.existsSync(path.join(e,n));const save=(n,v)=>fs.writeFileSync(path.join(e,n),JSON.stringify(v,null,2)+'\n',{flag:'wx',mode:0o600});
 validateApproval(c.readJson(path.join(b,'authorizations.json')));const conf=c.readJson(path.join(b,'exercise-config.json'));assert.equal(conf.tag,TAG);assert.equal(conf.representativeIds.length,2);
 assert.ok(!has('confirmed-'+mode+'.json')&&!has('started-'+mode+'.json'),'NO_REPLAY_INSPECT_RECEIPTS');const index=STAGES.indexOf(mode);if(index)assert.equal(read('confirmed-'+STAGES[index-1]+'.json').success,true);
 const writing=index>0&&mode!=='verify-final';let parent=has('confirmed-create-parent.json')?read('confirmed-create-parent.json').record:null,item=has('confirmed-create-item.json')?read('confirmed-create-item.json').record:null;
 const context=()=>({proc_compra_id:parent.proc_compra_id,item_proc_compra_id:item.item_proc_compra_id});
 return c.session(async({runtime,login})=>{
  assert.equal(String(login.user.id),'admin');const call=(screen,op,body,expected=200)=>runtime(screen+'/endpoints/'+op,body,expected);
  const get=async(screen,id,ctx)=>plain(await call(screen,'get',{id,...(ctx?{context:ctx}:{})}));
  const sample=label=>read('confirmed-create-'+label+'.json').record;
  async function logs(screen,id){const r=await call(L,'read',{take:2000,skip:0,filters:[{field:'audit_screen_id',operator:'eq',value:screen},{field:'audit_record_id',operator:'eq',value:id}],sort:[{field:'id',dir:'asc'}]});assert.equal(r.total,r.data.length);return r.data.map(x=>({...x,meta:typeof x.metadata==='string'?JSON.parse(x.metadata):x.metadata,before:typeof x.before_data==='string'?JSON.parse(x.before_data):x.before_data,after:typeof x.after_data==='string'?JSON.parse(x.after_data):x.after_data})).filter(x=>x.meta?.audit?.available===true);}
  async function once(screen,op,body,status=200){assert.ok(writing);save('started-'+mode+'.json',{tag:TAG,screen,operation:op,body,at:new Date().toISOString()});const result=await call(screen,op,body,status);save('response-'+mode+'.json',result);return result;}
  let result=null,before=null,operation=null,id=null;
  if(mode==='preflight'){
   const physical=c.readJson(path.join(b,'physical-before/physical-probe.json'));assert.equal(physical.success,true);assert.equal(physical.readOnly,true);assert.equal(physical.ordersMarked,0);assert.equal(physical.itemsOwned,0);assert.equal(physical.financialOwned,0);assert.equal(physical.shipmentsOwned,0);
   const r=await call(P,'read',{take:2,skip:0,filters:[{field:'cod_proc_fornec',operator:'eq',value:TAG}]});assert.equal(r.total,0);assert.deepEqual(r.data,[]);
  }else if(mode==='create-parent'){
   result=plain(await once(P,'create',{record:{cod_situacao:1,cod_proc_fornec:TAG,observacao:TAG,dt_registro:conf.seed.dt_registro,fornecedor_id:conf.seed.fornecedor_id,qt_dias_translado:0,dt_limite:null,log_facilid_contato_fornec:true,log_considerar_previsao:false,nr_container_original:''}}));assert.ok(result.proc_compra_id>0);assert.equal(result.empresa_id,conf.seed.empresa_id);assert.equal(result.log_considerar_previsao,false);assert.equal(result.cod_proc_fornec,TAG);parent=result;
  }else if(mode==='create-item'){
   const draft=c.readJson(path.join(c.meta,'proc-compra-itens-builder-draft.json'));result=plain(await once(I,'create',itemCreate(draft,parent.proc_compra_id)));assert.ok(result.item_proc_compra_id>0);assert.equal(result.proc_compra_id,parent.proc_compra_id);assert.equal(result.descricao,TAG);item=result;
  }else if(mode==='create-a'||mode==='create-b'){
   operation='create';result=plain(await once(S,'create',{record:{cod_rep:conf.representativeIds[mode==='create-a'?0:1],dt_envio:mode==='create-a'?'2026-10-22':null},context:context()}));id=result.envio_amostra_repres_id;assert.ok(Number.isInteger(id)&&id>4);assert.equal(result.apont_amostra_id,0);assert.equal(Object.keys(result).length,8);assert.equal(result.item_proc_compra_id,item.item_proc_compra_id);assert.equal(result.proc_compra_id,parent.proc_compra_id);if(mode==='create-b')assert.ok(id>sample('a').envio_amostra_repres_id);
  }else if(mode==='update-a'||mode==='stale-a'){
   id=sample('a').envio_amostra_repres_id;before=await get(S,id,context());operation='update';const body={id,record:{...before,dt_envio:null},context:context()};if(mode==='stale-a')body.record.row_stamp=sample('a').row_stamp;
   result=await once(S,'update',body,mode==='stale-a'?409:200);
   if(mode==='stale-a'){assert.ok(result.error);assert.deepEqual(await get(S,id,context()),before);}else{result=plain(result);assert.equal(result.dt_envio,null);assert.equal(result.cod_rep,before.cod_rep);assert.notEqual(result.row_stamp,before.row_stamp);}
  }else if(mode==='format'){
   before=await get(I,item.item_proc_compra_id,{proc_compra_id:parent.proc_compra_id});result=plain(await once(I,'update',{id:item.item_proc_compra_id,record:{...before,formato_amostra_id:conf.formatId},context:{proc_compra_id:parent.proc_compra_id}}));assert.equal(result.formato_amostra_id,conf.formatId);assert.equal(result.descricao,TAG);
  }else if(mode==='delete-a'||mode==='delete-b'){
   id=sample(mode.at(-1)).envio_amostra_repres_id;before=await get(S,id,context());operation='delete';result=await once(S,'delete',{id,record:before,context:context()});await call(S,'get',{id,context:context()},404);
  }else if(mode==='delete-item'){
   const r=await call(S,'read',{take:2,skip:0,context:context()});assert.equal(r.total,0);before=await get(I,item.item_proc_compra_id,{proc_compra_id:parent.proc_compra_id});assert.equal(before.descricao,TAG);result=await once(I,'delete',{id:item.item_proc_compra_id,record:before,context:{proc_compra_id:parent.proc_compra_id}});await call(I,'get',{id:item.item_proc_compra_id,context:{proc_compra_id:parent.proc_compra_id}},404);
  }else if(mode==='delete-parent'){
   const r=await call(I,'read',{take:2,skip:0,context:{proc_compra_id:parent.proc_compra_id}});assert.equal(r.total,0);before=await get(P,parent.proc_compra_id);assert.equal(before.cod_proc_fornec,TAG);assert.equal(before.log_considerar_previsao,false);result=await once(P,'delete',{id:parent.proc_compra_id,record:before});await call(P,'get',{id:parent.proc_compra_id},404);
  }
  const events=parent?await logs(P,parent.proc_compra_id):[];
  for(const ev of events){assert.equal(ev.actor_user_id,'admin');assert.equal(ev.meta.audit.source,'progress-transaction');assert.equal(ev.meta.audit.version,1);assert.ok(ev.meta.audit.procCompraId===parent.proc_compra_id);assert.ok(['procs_compra','itens_proc_compra','envios_amostras_repres'].includes(ev.meta.audit.resource),'NO_FINANCIAL_EFFECT');}
  if(operation&&mode!=='stale-a'){
   const matches=events.filter(x=>x.meta.audit.resource==='envios_amostras_repres'&&x.meta.audit.recordId===id&&x.meta.audit.operation===operation);assert.equal(matches.length,1,'ONE_CONFIRMED_SAMPLE_LOG');const ev=matches[0];assert.equal(ev.meta.audit.itemProcCompraId,item.item_proc_compra_id);
   if(before)assert.deepEqual(ev.before,image(before));else assert.equal(Object.keys(ev.before).length,0);
   if(operation==='delete')assert.equal(Object.keys(ev.after).length,0);else assert.deepEqual(ev.after,image(result));
   const own=await logs(S,id);assert.ok(own.some(x=>x.id===ev.id),'RECORD_LOG_SCOPE');const itemLogs=await logs(I,item.item_proc_compra_id);assert.ok(itemLogs.some(x=>x.id===ev.id),'ITEM_AGGREGATION');
  }
  if(mode==='verify-final'){
   const a=c.readJson(path.join(b,'physical-before/physical-probe.json')),z=c.readJson(path.join(b,'physical-after/physical-probe.json'));assert.equal(z.success,true);assert.equal(z.readOnly,true);assert.equal(z.source,'official-openedge12.2');assert.equal(z.version,'12.2');assert.equal(z.scope,['after',parent.proc_compra_id,item.item_proc_compra_id,sample('a').envio_amostra_repres_id,sample('b').envio_amostra_repres_id].join(','));for(const k of ['ordersMarked','itemsOwned','financialOwned','shipmentsOwned'])assert.equal(z[k],0);assert.deepEqual(z.samples,a.samples,'EXISTING_SAMPLES_PRESERVED');assert.deepEqual(z.representatives,a.representatives,'REPRESENTATIVES_PRESERVED');
   const previous=read('confirmed-delete-parent.json');assert.deepEqual(events,previous.events,'LOGS_PRESERVED');assert.equal(events.filter(x=>x.meta.audit.resource==='envios_amostras_repres').length,5);assert.equal(events.length,10);await call(P,'get',{id:parent.proc_compra_id},404);
  }
  save('confirmed-'+mode+'.json',{success:true,tag:TAG,mode,record:result,events,at:new Date().toISOString()});console.log('PASS '+mode+'; private receipts saved');
 },{readOnly:!writing});
}
module.exports={STAGES,validateApproval,itemCreate,run};
if(require.main===module)run(process.argv[2]).catch(e=>{console.error('Stage unconfirmed: '+e.message+'; inspect private receipts, never retry unknown POST.');process.exitCode=1;});
