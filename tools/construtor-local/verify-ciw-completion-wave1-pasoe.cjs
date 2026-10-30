'use strict';
const c=require('./purchase-payments-builder-common.cjs'),state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build3');
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
async function main(){
 c.assert.equal(c.readJson(c.path.join(state,'active-manifest.json')).success,true);
 const cfg=c.readJson(c.path.join(c.root,'.runtime/ciw-cadastros-20261020/private/connection.json'));c.assert.equal(cfg.baseUrl,'http://127.0.0.1:19910/med/web');
 const attempts=[];
 async function call(resource,body){c.assert.ok(['read','get'].includes(body.operation),'READ_ONLY');const r=await fetch(cfg.baseUrl+'/SursumPrograms/ciw-cadastros',{method:'POST',headers:{'Content-Type':'application/json','X-Ciw-Cadastros-Token':cfg.integrationToken},body:JSON.stringify({resource,...body}),signal:AbortSignal.timeout(45000)});c.assert.equal(r.status,200);const result=await r.json();attempts.push({resource,body,success:result.success,error:result.error??null});save('pasoe-attempts-private.json',attempts);return result;}
 await c.session(async({runtime})=>{
  const cid=332526,context={container_id:cid};
  const expenses=await runtime('ciw.container-despesas/endpoints/read',{take:200,skip:0,context});
  const versions=await runtime('ciw.container-versoes-custo/endpoints/read',{take:200,skip:0,context});
  save('parent-rows-private.json',{expenses,versions});c.assert.ok(expenses.data.length>0&&versions.data.length>0);
  const expense=expenses.data.find(x=>x.calc_imp_container_id>0);c.assert.ok(expense,'NO_CALC_SELECTION');
  const selected=[{resource:'container_calculos_impostos_med',key:'calc_imp_container_id',id:expense.calc_imp_container_id},{resource:'container_despesa_memoria_med',key:'despesa_container_id',id:expense.despesa_container_id}];
  const results=[];
  for(const s of selected){
   const ctx={container_id:cid,[s.key]:s.id},read=await call(s.resource,{operation:'read',...ctx,take:200,skip:0});c.assert.equal(read.success,true,read.error?.code);c.assert.equal(read.total,1);c.assert.equal(read.data.length,1);c.assert.equal(read.data[0][s.key],s.id);c.assert.equal(read.data[0].container_id,cid);
   const get=await call(s.resource,{operation:'get',...ctx,id:s.id});c.assert.equal(get.success,true,get.error?.code);c.assert.deepEqual(get.data,read.data[0]);
   if(s.key==='despesa_container_id'){const row=read.data[0];c.assert.equal(row.link_calculo_id,typeof row.memoria_calculo==='string'&&row.memoria_calculo.length>0?null:row.calc_imp_container_id>0?row.calc_imp_container_id:null);}
   const bad=[{operation:'read',container_id:cid},{operation:'read',...ctx,take:201},{operation:'read',...ctx,table:'other'},{operation:'get',...ctx,id:s.id+1},{operation:'read',...ctx,container_id:1}];
   for(const body of bad){const x=await call(s.resource,body);c.assert.equal(x.success,false);c.assert.ok([404,422].includes(x.error.status),x.error.code);}
   save(s.resource+'-rows-private.json',read);results.push({...s,readGet:true,negativeChecks:bad.length,ownMemoryPrecedence:s.key==='despesa_container_id'});
  }
  const version=versions.data[0],resource='container_versoes_historico_med',ctx={container_id:cid,versao_id:version.versao_id};
  const history=await call(resource,{operation:'read',...ctx,take:200,skip:0});save('history-response-attempt-private.json',{context:ctx,response:history});c.assert.equal(history.success,true,history.error?.code);c.assert.ok(history.data.length>0);for(const row of history.data){c.assert.equal(row.container_id,cid);c.assert.equal(row.versao_id,ctx.versao_id);c.assert.equal(typeof row.record_key,'string');}
  const row=history.data[0],detail=await call(resource,{operation:'get',...ctx,id:row.record_key,record_key:row.record_key});c.assert.equal(detail.success,true,detail.error?.code);c.assert.deepEqual(detail.data,row);
  const page=await call(resource,{operation:'read',...ctx,take:1,skip:1});c.assert.equal(page.success,true);c.assert.equal(page.total,history.total);
  const negatives=[{operation:'read',container_id:cid},{operation:'read',...ctx,take:201},{operation:'read',...ctx,table:'other'},{operation:'get',...ctx,id:row.record_key,record_key:'other'},{operation:'read',...ctx,container_id:1}];
  for(const body of negatives){const x=await call(resource,body);c.assert.equal(x.success,false);c.assert.ok([404,422].includes(x.error.status),x.error.code);}
  save('history-rows-private.json',history);results.push({resource,readGet:true,paging:true,negativeChecks:negatives.length,totalObserved:history.total,fields:Object.keys(row).length});
  const old=await call('proc_compra_quantidades_periodo_med',{operation:'read',take:1,skip:0});c.assert.equal(old.success,true);
  save('pasoe-read-proof.json',{success:true,instance:'sursum-api',context:'med',officialPort:9911,results,oldResourceRegression:true,businessWrites:false});
  console.log('PASS real MED:3read/get,15negative requests,paging,memoryprecedence,oldresource regression');
 },{readOnly:true});
}
main().catch(e=>{console.error(e.message);process.exitCode=1});
