'use strict';
const c=require('./purchase-payments-builder-common.cjs'),state=c.path.join(c.root,'.runtime/purchase-pending-integration-20261028');
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
async function main(){
 const cfg=c.readJson(c.path.join(c.root,'.runtime/ciw-cadastros-20261020/private/connection.json'));c.assert.equal(cfg.baseUrl,'http://127.0.0.1:19910/med/web');
 async function call(resource,body){c.assert.ok(['read','get'].includes(body.operation));const r=await fetch(cfg.baseUrl+'/SursumPrograms/ciw-cadastros',{method:'POST',headers:{'Content-Type':'application/json','X-Ciw-Cadastros-Token':cfg.integrationToken},body:JSON.stringify({resource,...body}),signal:AbortSignal.timeout(45000)});c.assert.equal(r.status,200);return r.json();}
 const summary=await call('proc_compra_sinalizadores',{operation:'read',take:200});c.assert.equal(summary.success,true,summary.error?.code);c.assert.equal(summary.total,5);c.assert.equal(summary.data.length,5);
 c.assert.deepEqual(summary.data.map(x=>x.sinaliz_imp_id).sort(),[1,2,3,4,5]);c.assert.equal(Object.keys(summary.data[0]).length,9);
 const head=summary.data[0],headGet=await call('proc_compra_sinalizadores',{operation:'get',id:head.record_key});c.assert.equal(headGet.success,true);c.assert.deepEqual(headGet.data,head);
 const checks=[],privateRows={summary};let chosen=null;
 for(const row of summary.data){
  const detail=await call('proc_compra_sinalizados',{operation:'read',sinaliz_imp_id:row.sinaliz_imp_id,take:200});c.assert.equal(detail.success,true,detail.error?.code);c.assert.equal(detail.total,row.quantidade);c.assert.ok(detail.data.every(x=>x.sinaliz_imp_id===row.sinaliz_imp_id));
  if(detail.data.length){const first=detail.data[0];c.assert.equal(Object.keys(first).length,19);for(const x of detail.data){if(x.tipo_registro==='Container'){c.assert.equal(x.link_proc_compra_id,null);c.assert.equal(x.link_container_id,x.container_id);}else{c.assert.equal(x.link_container_id,null);c.assert.equal(x.link_proc_compra_id,x.proc_compra_id);}}
   const item=await call('proc_compra_sinalizados',{operation:'get',sinaliz_imp_id:row.sinaliz_imp_id,id:first.record_key});c.assert.equal(item.success,true,item.error?.code);c.assert.deepEqual(item.data,first);if(!chosen)chosen=first;
  }
  privateRows['rule'+row.sinaliz_imp_id]=detail;checks.push({rule:row.sinaliz_imp_id,count:detail.total,detailGet:detail.data.length>0});
 }
 const configuration=await call('sinalizadores_importacao',{operation:'read'});c.assert.equal(configuration.success,true);c.assert.equal(configuration.data.length,5);c.assert.equal(Object.keys(configuration.data[0]).length,5);
 const configGet=await call('sinalizadores_importacao',{operation:'get',id:1});c.assert.equal(configGet.success,true);c.assert.deepEqual(configGet.data,configuration.data.find(x=>x.sinaliz_imp_id===1));
 const negatives=[['proc_compra_sinalizadores',{operation:'read',sinaliz_imp_id:1}],['proc_compra_sinalizados',{operation:'read'}],['proc_compra_sinalizados',{operation:'read',sinaliz_imp_id:6}],['proc_compra_sinalizados',{operation:'read',sinaliz_imp_id:'01'}],['proc_compra_sinalizados',{operation:'read',sinaliz_imp_id:1,today:'2000-01-01'}],['proc_compra_sinalizados',{operation:'read',sinaliz_imp_id:1,piScanBudget:999999}],['proc_compra_sinalizados',{operation:'read',sinaliz_imp_id:1,empresa_id:3}],['proc_compra_sinalizadores',{operation:'read',take:201}],['proc_compra_sinalizadores',{operation:'read',filter:{field:'sql',operator:'eq',value:'other'}}],['sinalizadores_importacao',{operation:'get',id:6}],['sinalizadores_importacao',{operation:'get'}],['sinalizadores_importacao',{operation:'read',sql:'other'}]];
 for(const [resource,body]of negatives){const x=await call(resource,body);c.assert.equal(x.success,false);c.assert.equal(x.error.status,422,resource+' '+x.error.code);}
 if(chosen){const x=await call('proc_compra_sinalizados',{operation:'get',sinaliz_imp_id:chosen.sinaliz_imp_id===1?2:1,id:chosen.record_key});c.assert.equal(x.success,false);c.assert.ok([404,422].includes(x.error.status));}
 const old=await call('proc_compra_alertas',{operation:'read',proc_compra_id:1679,take:200});c.assert.equal(old.success,true);c.assert.ok(old.total>0);c.assert.equal(Object.keys(old.data[0]).length,16);
 const periods=await call('proc_compra_quantidades_periodo_med',{operation:'read',take:1});c.assert.equal(periods.success,true);c.assert.equal(Object.keys(periods.data[0]).length,21);
 save('pasoe-private-rows.json',{...privateRows,configuration});save('pasoe-read-proof.json',{success:true,instance:'sursum-api',context:'med',officialPort:9911,summaryFields:9,detailFields:19,configurationFields:5,summaryFiveRules:true,countsEqualDetails:true,checks,negativeChecks:negatives.length+(chosen?1:0),nullLinksCorrect:true,contextualContractPreserved:true,previousResources:2,configurationWritesExecuted:false,businessWrites:false});console.log('PASS PASOE5summary rules/counts/get/detail/context/nullLinks/config5fields/'+negatives.length+' negatives/2priorresources;no business writes');
}
main().catch(e=>{console.error(e.message);process.exitCode=1;});
