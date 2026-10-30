'use strict';
const c=require('./purchase-payments-builder-common.cjs');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build6-v2'),oldState=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build5-v6');
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
async function main(){
 const active=c.readJson(c.path.join(state,'active-manifest.json'));c.assert.ok(active.success&&active.coherentWebMedPause&&active.medWebRestored&&active.imaWebUnchanged);c.assert.equal(Object.keys(active.targets).length,21);
 const cfg=c.readJson(c.path.join(c.root,'.runtime/ciw-cadastros-20261020/private/connection.json')),container=c.readJson(c.path.join(c.root,'.runtime/construtor-pg/containers-connection.json'));
 const attempts=[];
 async function call(resource,body,kind='history'){
  c.assert.ok(['read','get'].includes(body.operation)||(kind==='process'&&body.operation==='calcular_impostos'&&!Object.hasOwn(body,'container_id')),'NO_BUSINESS_WRITER');
  const response=await fetch(cfg.baseUrl+'/SursumPrograms/'+(kind==='history'?'ciw-cadastros':kind==='batch'?'containers-despesas-lote':'containers-processos'),{method:'POST',headers:{'Content-Type':'application/json',[kind==='history'?'X-Ciw-Cadastros-Token':'X-Containers-Token']:kind==='history'?cfg.integrationToken:container.integrationToken,'X-Sursum-User':'admin'},body:JSON.stringify({resource,...body}),signal:AbortSignal.timeout(45000)});
  c.assert.equal(response.status,200);const data=await response.json();attempts.push({resource,body,success:data.success,error:data.error??null});save('pasoe-attempts-private.json',attempts);return data;
 }
 const ctx={container_id:332526,versao_id:2354},specs=[
  {resource:'container_versoes_historico_med',label:'item_descricao_atual',old:c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build3/history-rows-private.json')},
  {resource:'container_versao_pagtos_historico_med'},
  {resource:'container_versao_nfs_historico_med',label:'emitente_nome_abrev_atual'},
  {resource:'container_versao_descontos_historico_med'},
  {resource:'container_versao_despesas_historico_med',label:'despesa_descricao_atual'}];
 const results=[];
 for(const s of specs){
  const read=await call(s.resource,{operation:'read',...ctx,take:200,skip:0});c.assert.equal(read.success,true,read.error?.code);c.assert.ok(Array.isArray(read.data));save(s.resource+'-rows-private.json',read);
  const previous=c.readJson(s.old??c.path.join(oldState,s.resource+'-2354-rows-private.json'));
  const withoutLabels=read.data.map(row=>Object.fromEntries(Object.entries(row).filter(([key])=>key!==s.label)));c.assert.deepEqual(withoutLabels,previous.data,'PERSISTED_SNAPSHOT_CHANGED');
  let get=false,positiveLabel=false;
  if(read.data.length){const first=read.data[0],detail=await call(s.resource,{operation:'get',...ctx,id:first.record_key,record_key:first.record_key});c.assert.equal(detail.success,true,detail.error?.code);c.assert.deepEqual(detail.data,first);get=true;}
  if(s.label){
   for(const row of read.data)c.assert.ok(Object.hasOwn(row,s.label)&&(row[s.label]===null||typeof row[s.label]==='string'));
   const selected=read.data.find(row=>typeof row[s.label]==='string'&&row[s.label].length);
   if(selected){const filtered=await call(s.resource,{operation:'read',...ctx,take:200,skip:0,filter:{logic:'and',filters:[{field:s.label,operator:'eq',value:selected[s.label]}]}});c.assert.equal(filtered.success,true,filtered.error?.code);c.assert.ok(filtered.data.length>0);for(const row of filtered.data)c.assert.equal(row[s.label],selected[s.label]);positiveLabel=true;}
   const negative=await call(s.resource,{operation:'read',...ctx,take:200,skip:0,filter:{logic:'and',filters:[{field:s.label,operator:'eq',value:'__SC_LABEL_NOT_FOUND_20261028__'}]}});c.assert.equal(negative.success,true,negative.error?.code);c.assert.equal(negative.total,0);
  }
  for(const body of [{operation:'read',container_id:ctx.container_id},{operation:'read',...ctx,container_id:1},{operation:'read',...ctx,take:201}]){const x=await call(s.resource,body);c.assert.equal(x.success,false);c.assert.ok([404,422].includes(x.error?.status),x.error?.code);}
  results.push({resource:s.resource,total:read.total,read:true,get,newLabel:s.label??null,positiveLabelFilter:positiveLabel,negativeLabelFilter:!!s.label,persistedSnapshotsPreserved:true,negativeContexts:3});
 }
 const batch=await call('container-despesas-lote',{operation:'read',container_id:ctx.container_id,take:1,skip:0},'batch');c.assert.equal(batch.success,true,batch.error?.code);
 const denied=await call('impostos',{operation:'calcular_impostos'},'process');c.assert.equal(denied.success,false);c.assert.equal(denied.error.status,422);c.assert.equal(denied.error.code,'CONTAINER_PROCESS_INVALID_REQUEST');
 const old=await call('proc_compra_quantidades_periodo_med',{operation:'read',take:1,skip:0});c.assert.equal(old.success,true);
 save('pasoe-read-proof.json',{success:true,instance:'sursum-api',context:'med',officialPort:9911,results,batchReadRegression:true,taxOnlyMissingContextRejected:true,taxOnlyPositiveWrite:false,oldResourceRegression:true,businessWrites:false});
 console.log('PASS realMED5history reads/persisted snapshots/4get/3newlabel filters/context negatives;batchreadregression/taxonly missingcontext;no business writes');
}
main().catch(e=>{console.error(e.message);process.exitCode=1});
