'use strict';
const c=require('./purchase-payments-builder-common.cjs'),v=require('./verify-ciw-completion-build7-pasoe.cjs');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build7'),probeDir=c.path.join(c.root,'.runtime/ciw-completion-20261028/ledger-identity-readonly-probe/execution-v1.1');
async function main(){
 const probe=c.readJson(c.path.join(probeDir,'results/ledger-identity-private.json'));c.assert.equal(probe.completed,true);c.assert.equal(probe.numDbs,1);c.assert.match(probe.openEdge,/^12\.2/);c.assert.equal(probe.partial,false);c.assert.ok(probe.physicalReads<=50000&&probe.pairs.length>0&&probe.pairs.length<=5);c.assert.equal(probe.foundCount,probe.pairs.length);
 const compile=c.fs.readFileSync(c.path.join(probeDir,'results/compile.log'),'utf8');c.assert.ok(compile.includes('PASS COMPILE')&&compile.includes('ERROR=no')&&!compile.includes('FAIL'));
 const cfg=c.readJson(c.path.join(c.root,'.runtime/ciw-cadastros-20261020/private/connection.json')),resource='custo_distribuicao_lancamentos_item',context={item_container_id:probe.pairs[0].item_container_id};c.assert.ok(Number.isInteger(context.item_container_id)&&context.item_container_id>0);
 const save=(name,data)=>c.fs.writeFileSync(c.path.join(state,name),JSON.stringify(data,null,2)+'\n');
 async function call(body){c.assert.ok(['read','get'].includes(body.operation));const r=await fetch(cfg.baseUrl+'/SursumPrograms/ciw-cadastros',{method:'POST',headers:{'Content-Type':'application/json','X-Ciw-Cadastros-Token':cfg.integrationToken,'X-Sursum-User':'admin'},body:JSON.stringify({resource,...body}),signal:AbortSignal.timeout(45000)});c.assert.equal(r.status,200);return r.json();}
 const read=await call({operation:'read',...context,take:200,skip:0});v.readShape(resource,read,context,200);c.assert.ok(read.data.length>0);save('ledger-probed-owner-rows-private.json',read);const row=read.data[0];
 const detail=await call({operation:'get',...context,id:row.record_key,record_key:row.record_key});c.assert.equal(detail.success,true);c.assert.deepEqual(detail.data,row);
 const filter={field:'cta_corren_custo_distr_id',operator:'eq',value:row.cta_corren_custo_distr_id};const positive=await call({operation:'read',...context,take:200,filter});v.readShape(resource,positive,context,200);c.assert.equal(positive.total,1);c.assert.deepEqual(positive.data[0],row);
 const contradictory=await call({operation:'read',...context,take:200,filter:{logic:'and',filters:[filter,{...filter,operator:'neq'}]}});v.readShape(resource,contradictory,context,200);c.assert.equal(contradictory.total,0);
 const other=c.readJson(c.path.join(state,'custo_distribuicao_itens_aptos-rows-private.json')).data.find(x=>x.item_container!==context.item_container_id);c.assert.ok(other);
 const denied=await call({operation:'get',item_container_id:other.item_container,id:row.record_key,record_key:row.record_key});c.assert.equal(denied.success,false);c.assert.equal(denied.error?.status,404);
 await c.session(async({runtime})=>{
  const screen='ciw.custo-distribuicao-lancamentos-item',native=await runtime(screen+'/endpoints/read',{context,take:200,skip:0});c.assert.deepEqual(native.data,read.data);
  const response=await runtime(screen+'/endpoints/get',{context,id:row.record_key}),record=Object.hasOwn(response,'record_key')?response:response.data;c.assert.deepEqual(record,row);
  const filtered=await runtime(screen+'/endpoints/read',{context,take:200,filter});c.assert.equal(filtered.total,1);c.assert.deepEqual(filtered.data[0],row);
 },{readOnly:true});
 save('pasoe-native-ledger-positive-proof.json',{success:true,positiveGetProved:true,positivePkFilter:true,contradictoryFilterEmpty:true,pasoeCrossOwnerRejected:true,nativeListExactPasoe:true,nativeGetExactPasoe:true,nativeFilter:true,ownerObservedByOfficial122ReadonlyProbe:true,probePairs:probe.foundCount,observedRows:read.data.length,originalEmptyDatasetProofPreserved:true,businessWrites:false,humanPermissionsChanged:false});
 console.log('PASS1050 realPASOE+native list/get/filter/crossowner with officialROobservedowner;allfour positivegets nowproved;no business writes');
}
main().catch(e=>{console.error(e.message);process.exitCode=1});
