'use strict';
const c=require('./purchase-payments-builder-common.cjs');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build5-v6');
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
async function main(){
 c.assert.ok(c.readJson(c.path.join(state,'active-manifest.json')).success);
 const cfg=c.readJson(c.path.join(c.root,'.runtime/ciw-cadastros-20261020/private/connection.json'));
 const container=c.readJson(c.path.join(c.root,'.runtime/construtor-pg/containers-connection.json'));
 c.assert.equal(cfg.baseUrl,'http://127.0.0.1:19910/med/web');
 const attempts=[];
 async function call(resource,body,batch=false,auth=true){
  c.assert.ok(['read','get'].includes(body.operation)||(batch&&body.operation==='batch'&&Array.isArray(body.changes)&&body.changes.length===0),'NO_BUSINESS_WRITER');
  const headers={'Content-Type':'application/json','X-Sursum-User':'admin'};
  if(auth)headers[batch?'X-Containers-Token':'X-Ciw-Cadastros-Token']=batch?container.integrationToken:cfg.integrationToken;
  const response=await fetch(cfg.baseUrl+'/SursumPrograms/'+(batch?'containers-despesas-lote':'ciw-cadastros'),{method:'POST',headers,body:JSON.stringify({resource,...body}),signal:AbortSignal.timeout(45000)});
  c.assert.equal(response.status,200,'ROUTING_HTTP_'+response.status);const data=await response.json();attempts.push({resource,request:body,success:data.success,error:data.error??null});save('pasoe-attempts-private.json',attempts);return data;
 }
 const cid=332526,results=[];
 for(const resource of ['container_versao_pagtos_historico_med','container_versao_nfs_historico_med','container_versao_descontos_historico_med','container_versao_despesas_historico_med']){
  let selected;
  const observed=[];
  for(const vid of [2354,2357]){
   const ctx={container_id:cid,versao_id:vid},read=await call(resource,{operation:'read',...ctx,take:200,skip:0});save(resource+'-'+vid+'-rows-private.json',read);
   c.assert.equal(read.success,true,read.error?.code);c.assert.ok(Array.isArray(read.data));observed.push({version:vid,total:read.total});
   for(const row of read.data){c.assert.equal(row.container_id,cid);c.assert.equal(row.versao_id,vid);c.assert.equal(typeof row.record_key,'string');}
   if(read.data.length&&!selected){const row=read.data[0],detail=await call(resource,{operation:'get',...ctx,id:row.record_key,record_key:row.record_key});c.assert.equal(detail.success,true,detail.error?.code);c.assert.deepEqual(detail.data,row);selected={ctx,row};}
  }
  const ctx=selected?.ctx??{container_id:cid,versao_id:2354};
  const page=await call(resource,{operation:'read',...ctx,take:1,skip:1});c.assert.equal(page.success,true);
  const bad=[{operation:'read',container_id:cid},{operation:'read',...ctx,container_id:1},{operation:'read',...ctx,versao_id:2147483647},{operation:'read',...ctx,take:201},{operation:'read',...ctx,table:'other'}];
  if(selected)bad.push({operation:'get',...ctx,id:selected.row.record_key,record_key:'other'});
  for(const body of bad){const error=await call(resource,body);c.assert.equal(error.success,false);c.assert.ok([404,422].includes(error.error?.status),error.error?.code);}
  results.push({resource,read:true,get:!!selected,paging:true,observed,negativeChecks:bad.length});
 }
 const resource='container-despesas-lote',ctx={container_id:cid};
 const read=await call(resource,{operation:'read',...ctx,take:100,skip:0},true);save('batch-read-rows-private.json',read);c.assert.equal(read.success,true,read.error?.code);c.assert.ok(read.data.length>0);
 const row=read.data[0];c.assert.ok(row.despesa_container_id>0);
 const detail=await call(resource,{operation:'get',...ctx,id:row.despesa_container_id,despesa_container_id:row.despesa_container_id},true);c.assert.equal(detail.success,true,detail.error?.code);c.assert.deepEqual(detail.data,row);
 const bad=[{operation:'read'},{operation:'read',container_id:1},{operation:'read',...ctx,table:'other'},{operation:'get',...ctx,id:row.despesa_container_id,despesa_container_id:row.despesa_container_id+1},{operation:'batch',...ctx,changes:[]}];
 for(const body of bad){const error=await call(resource,body,true);c.assert.equal(error.success,false);c.assert.ok([404,422].includes(error.error?.status),error.error?.code);}
 const denied=await call(resource,{operation:'read',...ctx},true,false);c.assert.equal(denied.success,false);c.assert.equal(denied.error.status,401);
 const old=await call('proc_compra_quantidades_periodo_med',{operation:'read',take:1,skip:0});c.assert.equal(old.success,true);
 save('pasoe-read-proof.json',{success:true,instance:'sursum-api',context:'med',officialPort:9911,results,batch:{readGet:true,fields:Object.keys(row).length,negativeChecks:bad.length,authDenied:true,positiveBusinessWrite:false},oldResourceRegression:true,businessWrites:false});
 console.log('PASS real MED:4aux reads/paging/negative contexts; expensebatch read/get/auth/emptybatch rejection; no business writes');
}
main().catch(e=>{console.error(e.message);process.exitCode=1});
