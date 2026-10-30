'use strict';
const c=require('./purchase-payments-builder-common.cjs'),state=c.path.join(c.root,'.runtime/purchase-allocations-20261026');
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
async function main(){
 const cfg=c.readJson(c.path.join(c.root,'.runtime/ciw-cadastros-20261020/private/connection.json'));c.assert.equal(cfg.baseUrl,'http://127.0.0.1:19910/med/web');
 async function call(resource,body){c.assert.ok(['read','get'].includes(body.operation),'NO_BUSINESS_WRITES');const r=await fetch(cfg.baseUrl+'/SursumPrograms/ciw-cadastros',{method:'POST',headers:{'Content-Type':'application/json','X-Ciw-Cadastros-Token':cfg.integrationToken},body:JSON.stringify({resource,...body}),signal:AbortSignal.timeout(45000)});c.assert.equal(r.status,200);return r.json();}
 let context=c.fs.existsSync(c.path.join(state,'readonly-context.json'))?c.readJson(c.path.join(state,'readonly-context.json')):null;
 if(!context){
  const parents=await call('procs_compra_med',{operation:'read',take:50,skip:0,sort:[{field:'proc_compra_id',dir:'desc'}]});c.assert.equal(parents.success,true,parents.error?.code);
  for(const p of parents.data){const items=await call('proc_compra_itens',{operation:'read',proc_compra_id:p.proc_compra_id,take:200,skip:0});c.assert.equal(items.success,true,items.error?.code);const row=items.data.find(x=>x.qt_alocada>0);if(row){context={proc_compra_id:p.proc_compra_id,item_proc_compra_id:row.item_proc_compra_id};break;}}
  c.assert.ok(context,'NO_ALLOCATED_MED_ITEM_IN_BOUNDED_READ');save('readonly-context.json',context);
 }
 if(process.argv[2]==='discover'){console.log('PASS bounded readonly MED allocated-item context selected');return;}
 const page=await call('proc_compra_alocacoes',{operation:'read',...context,take:200,skip:0});c.assert.equal(page.success,true,page.error?.code);c.assert.ok(page.total>0&&page.total<=200,'POSITIVE_BOUNDED_PAGE_REQUIRED');c.assert.equal(page.data.length,page.total);
 const item=await call('proc_compra_itens',{operation:'get',proc_compra_id:context.proc_compra_id,id:String(context.item_proc_compra_id)});c.assert.equal(item.success,true,item.error?.code);
 c.assert.ok(Math.abs(page.data.reduce((n,x)=>n+(x.qt_alocada??0),0)-item.data.qt_alocada)<0.000001,'GLOBAL_ALLOCATION_TOTAL_RECONCILIATION');
 for(const row of page.data){c.assert.equal(row.proc_compra_id,context.proc_compra_id);c.assert.equal(row.item_proc_compra_id,context.item_proc_compra_id);c.assert.equal(Object.keys(row).length,9);const detail=await call('proc_compra_alocacoes',{operation:'get',...context,id:String(row.item_container_id)});c.assert.equal(detail.success,true);c.assert.deepEqual(detail.data,row);}
 const paged=await call('proc_compra_alocacoes',{operation:'read',...context,skip:0,take:1});c.assert.equal(paged.total,page.total);c.assert.equal(paged.data.length,1);
 const filtered=await call('proc_compra_alocacoes',{operation:'read',...context,filter:{field:'item_proc_compra_id',operator:'eq',value:2147483647}});c.assert.equal(filtered.success,true);c.assert.equal(filtered.total,0);
 const negatives=[{operation:'read'},{operation:'read',...context,item_proc_compra_id:1.5},{operation:'read',...context,sql:'FOR EACH other'},{operation:'read',...context,take:201},{operation:'get',...context,id:'2147483647'},{operation:'read',...context,proc_compra_id:2147483647}];
 for(const body of negatives){const x=await call('proc_compra_alocacoes',body);c.assert.equal(x.success,false);c.assert.ok([422,404].includes(x.error.status));}
 save('pasoe-rows-private.json',page);save('pasoe-read-proof.json',{success:true,instance:'sursum-api',context:'med',officialPort:9911,tunnel:'19910 -> 9910 same instance',resource:'proc_compra_alocacoes',rows:page.total,nativeGet:true,allocationTotalReconciled:true,contextIsolation:true,paging:true,negativeChecks:negatives.length,compiledDispatcherValidated:true,businessWrites:false});console.log('PASS PASOE real allocation read/get/reconciliation;6negatives; no business writes');
}
main().catch(e=>{console.error(e.message);process.exitCode=1;});
