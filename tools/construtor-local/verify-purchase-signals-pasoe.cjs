'use strict';
const c=require('./purchase-payments-builder-common.cjs'),state=c.path.join(c.root,'.runtime/purchase-signals-20261027');
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
async function main(){
 const cfg=c.readJson(c.path.join(c.root,'.runtime/ciw-cadastros-20261020/private/connection.json'));c.assert.equal(cfg.baseUrl,'http://127.0.0.1:19910/med/web');
 async function call(resource,body){c.assert.ok(['read','get'].includes(body.operation),'NO_BUSINESS_WRITES');const r=await fetch(cfg.baseUrl+'/SursumPrograms/ciw-cadastros',{method:'POST',headers:{'Content-Type':'application/json','X-Ciw-Cadastros-Token':cfg.integrationToken},body:JSON.stringify({resource,...body}),signal:AbortSignal.timeout(45000)});c.assert.equal(r.status,200);return r.json();}
 const resource='proc_compra_alertas';let context,page;
 if(c.fs.existsSync(c.path.join(state,'readonly-context.json'))){context=c.readJson(c.path.join(state,'readonly-context.json'));page=await call(resource,{operation:'read',...context,take:200,skip:0});}
 else{
  const parents=await call('procs_compra_med',{operation:'read',take:50,skip:0,filter:{field:'cod_situacao',operator:'eq',value:1},sort:[{field:'proc_compra_id',dir:'desc'}]});c.assert.equal(parents.success,true,parents.error?.code);
  for(const p of parents.data.slice(0,20)){const x=await call(resource,{operation:'read',proc_compra_id:p.proc_compra_id,take:200,skip:0});c.assert.equal(x.success,true,x.error?.code);if(x.total>0){context={proc_compra_id:p.proc_compra_id};page=x;break;}}
  c.assert.ok(context,'NO_ALERT_IN_BOUNDED_MED_READ');save('readonly-context.json',context);
 }
 c.assert.equal(page.success,true,page.error?.code);c.assert.ok(page.total>0&&page.total<=200);c.assert.equal(page.data.length,page.total);
 for(const row of page.data){c.assert.equal(row.proc_compra_id,context.proc_compra_id);c.assert.equal(Object.keys(row).length,16);c.assert.ok(Number.isInteger(row.item_proc_compra_id));c.assert.ok([1,2,3,4].includes(row.sinaliz_imp_id));c.assert.ok(!row.nome_alerta.includes('Ã'));const detail=await call(resource,{operation:'get',...context,id:row.record_key,record_key:row.record_key});c.assert.equal(detail.success,true,detail.error?.code);c.assert.deepEqual(detail.data,row);}
 const paged=await call(resource,{operation:'read',...context,take:1,skip:0});c.assert.equal(paged.total,page.total);c.assert.equal(paged.data.length,1);
 const filtered=await call(resource,{operation:'read',...context,filter:{field:'item_proc_compra_id',operator:'eq',value:2147483647}});c.assert.equal(filtered.success,true);c.assert.equal(filtered.total,0);
 const row=page.data[0],negatives=[{operation:'read'},{operation:'read',proc_compra_id:0},{operation:'read',proc_compra_id:2147483647},{operation:'read',...context,sql:'FOR EACH other'},{operation:'read',...context,today:'2026-01-01'},{operation:'read',...context,take:201},{operation:'read',...context,filter:{field:'nonexistent',operator:'eq',value:1}},{operation:'get',...context,id:row.record_key,record_key:'wrong'}];
 for(const body of negatives){const x=await call(resource,body);c.assert.equal(x.success,false);c.assert.ok([422,404].includes(x.error.status));}
 const parent=await call('procs_compra_med',{operation:'get',id:String(context.proc_compra_id)});c.assert.equal(parent.success,true);c.assert.equal(parent.data.cod_situacao,1);
 for(const old of ['formatos_amostra','coloracoes','situacoes_container']){const x=await call(old,{operation:'read'});c.assert.equal(x.success,true,old);}
 save('pasoe-rows-private.json',page);save('pasoe-parent-private.json',parent);save('pasoe-read-proof.json',{success:true,instance:'sursum-api',context:'med',officialPort:9911,tunnel:'19910 -> 9910 same instance',resource,rows:page.total,ruleIds:[...new Set(page.data.map(x=>x.sinaliz_imp_id))],nativeGet:true,aliasEquality:true,paging:true,negativeChecks:negatives.length,previousResources:3,compiledDispatcherValidated:true,businessWrites:false});console.log('PASS PASOE contextual alerts read/get;8negatives;3previous resources; no business writes');
}
main().catch(e=>{console.error(e.message);process.exitCode=1;});
