'use strict';
const c=require('./purchase-payments-builder-common.cjs'),v=require('./verify-ciw-completion-build7-pasoe.cjs');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build7');
async function main(){
 const cfg=c.readJson(c.path.join(c.root,'.runtime/ciw-cadastros-20261020/private/connection.json'));
 const save=(name,data)=>c.fs.writeFileSync(c.path.join(state,name),JSON.stringify(data,null,2)+'\n');
 async function call(resource,body){c.assert.ok(['container_versoes_historico_med','custo_distribuicao_lancamentos_item'].includes(resource)&&['read','get'].includes(body.operation));const r=await fetch(cfg.baseUrl+'/SursumPrograms/ciw-cadastros',{method:'POST',headers:{'Content-Type':'application/json','X-Ciw-Cadastros-Token':cfg.integrationToken,'X-Sursum-User':'admin'},body:JSON.stringify({resource,...body}),signal:AbortSignal.timeout(45000)});c.assert.equal(r.status,200);return r.json();}
 const history=await call('container_versoes_historico_med',{operation:'read',container_id:332526,versao_id:2354,take:200,skip:0});c.assert.equal(history.success,true);save('ledger-owner-history-private.json',history);
 const owners=[...new Set(history.data.map(x=>x.item_container_id).filter(x=>Number.isInteger(x)&&x>0))].slice(0,5),attempts=[];
 for(const owner of owners){
  const context={item_container_id:owner},read=await call('custo_distribuicao_lancamentos_item',{operation:'read',...context,take:200,skip:0});
  if(read.success!==true){c.assert.equal(read.error?.status,404);attempts.push({currentOwnerMissing:true});continue;}
  v.readShape('custo_distribuicao_lancamentos_item',read,context,200);attempts.push({total:read.total});
  if(!read.data.length)continue;
  save('ledger-history-owner-rows-private.json',read);const first=read.data[0];
  const detail=await call('custo_distribuicao_lancamentos_item',{operation:'get',...context,id:first.record_key,record_key:first.record_key});c.assert.equal(detail.success,true);c.assert.deepEqual(detail.data,first);
  const positive=await call('custo_distribuicao_lancamentos_item',{operation:'read',...context,take:200,filter:{field:'cta_corren_custo_distr_id',operator:'eq',value:first.cta_corren_custo_distr_id}});v.readShape('custo_distribuicao_lancamentos_item',positive,context,200);c.assert.equal(positive.total,1);c.assert.deepEqual(positive.data[0],first);
  const other=c.readJson(c.path.join(state,'custo_distribuicao_itens_aptos-rows-private.json')).data.find(x=>x.item_container!==owner);c.assert.ok(other);
  const denied=await call('custo_distribuicao_lancamentos_item',{operation:'get',item_container_id:other.item_container,id:first.record_key,record_key:first.record_key});c.assert.equal(denied.success,false);c.assert.equal(denied.error?.status,404);
  save('pasoe-ledger-positive-proof.json',{success:true,positiveGetProved:true,positivePkFilter:true,crossOwnerRejected:true,ownerObservedByExistingHistoryApi:true,attempts,businessWrites:false});console.log('PASS itemledger positiveget/filter/crossowner from existing history API owner;no business writes');return;
 }
 save('pasoe-ledger-positive-proof.json',{success:true,positiveGetProved:false,ownerObservedByExistingHistoryApi:true,attempts,businessWrites:false});console.log('No positive ledger found for bounded observed history owners;recorded honestly;no business writes');
}
main().catch(e=>{console.error(e.message);process.exitCode=1});
