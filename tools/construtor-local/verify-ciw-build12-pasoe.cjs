'use strict';
// ROOT ONLY. Fixed read/get probes; no business writes or metadata activation.
const c=require('./purchase-payments-builder-common.cjs');
const dir=c.path.join(c.root,'.runtime/ciw-completion-20261028/runtime-build12');
const CIDS=[332526,331126,200019,333426,1525];
const FIELDS=['container_id','nf_key','documento_localizado','estab','documento','serie','cod_emitente','nat_operacao','especie','dt_emissao','dt_trans','tot_valor','despesa_nota','valor_embal','valor_frete','valor_mercad','valor_outras','valor_seguro'];
const exact=(value,fields)=>value&&typeof value==='object'&&!Array.isArray(value)&&JSON.stringify(Object.keys(value).sort())===JSON.stringify([...fields].sort());
function row(value,cid){
 c.assert.ok(exact(value,FIELDS));c.assert.equal(value.container_id,cid);c.assert.equal(value.documento_localizado,true);c.assert.match(value.nf_key,/^nf_[A-F0-9]{64}$/);
 c.assert.ok(typeof value.estab==='string'&&value.estab.startsWith('5'));c.assert.ok(typeof value.nat_operacao==='string'&&value.nat_operacao.startsWith('3'));
 c.assert.ok(Number.isInteger(value.cod_emitente));
 for(const field of ['documento','serie'])c.assert.ok(value[field]===null||typeof value[field]==='string');
 c.assert.ok(value.especie===null||Number.isInteger(value.especie));
 for(const field of ['dt_emissao','dt_trans'])c.assert.ok(value[field]===null||typeof value[field]==='string'&&/^\d{4}-\d{2}-\d{2}$/.test(value[field]));
 for(const field of FIELDS.slice(11))c.assert.ok(value[field]===null||typeof value[field]==='number'&&Number.isFinite(value[field]));
}
function page(value,cid,take,skip=0){
 c.assert.ok(exact(value,['success','data','total'])&&value.success);c.assert.ok(Number.isInteger(value.total)&&value.total>=0&&value.total<=50000);c.assert.ok(Array.isArray(value.data));
 c.assert.equal(value.data.length,Math.min(take,Math.max(0,value.total-skip)));value.data.forEach(x=>row(x,cid));c.assert.equal(new Set(value.data.map(x=>x.nf_key)).size,value.data.length);
}
function rejected(value,status){c.assert.equal(value.success,false);c.assert.equal(value.error.status,status);c.assert.equal(Object.hasOwn(value,'data'),false);}
async function main(){
 const proof=c.path.join(dir,'pasoe-paged-five-container-proof.json');c.assert.ok(!c.fs.existsSync(proof),'DO_NOT_REPLAY_CONFIRMED_PROBE');
 const active=c.readJson(c.path.join(dir,'active-manifest.json'));c.assert.ok(active.success&&active.medWebRestored&&active.imaWebUnchanged);c.assert.equal(Object.keys(active.targets).length,4);
 const config=c.readJson(c.path.join(c.root,'.runtime/construtor-pg/containers-connection.json'));
 const calls=[],containers=[];const save=(name,value)=>c.fs.writeFileSync(c.path.join(dir,name),JSON.stringify(value,null,2)+'\n');
 async function call(cid,body,auth=true){
  c.assert.ok(CIDS.includes(cid)&&['read','get'].includes(body.operation));const started=Date.now(),headers={'Content-Type':'application/json'};if(auth)headers['X-Containers-Token']=config.integrationToken;
  const response=await fetch('http://127.0.0.1:19910/med/web/SursumPrograms/containers-financeiro',{method:'POST',headers,body:JSON.stringify({resource:'nfs-disponiveis',container_id:cid,...body}),signal:AbortSignal.timeout(30000)});c.assert.equal(response.status,200);
  const value=await response.json();calls.push({container:cid,operation:body.operation,success:value.success,status:value.error?.status??null,code:value.error?.code??null,durationMs:Date.now()-started});save('pasoe-paged-attempts.json',calls);return value;
 }
 try{
  for(const cid of CIDS){
   const first=await call(cid,{operation:'read',take:200,skip:0});page(first,cid,200);save('nf-page-first-'+cid+'-private.json',first);c.assert.ok(first.data.length>0,'Positive data required; do not create ERP fixtures');
   const second=await call(cid,{operation:'read',take:200,skip:200});page(second,cid,200,200);c.assert.equal(second.total,first.total);for(const value of second.data)c.assert.ok(!first.data.some(x=>x.nf_key===value.nf_key));
   const lastSkip=Math.max(0,first.total-2),last=await call(cid,{operation:'read',take:2,skip:lastSkip});page(last,cid,2,lastSkip);c.assert.equal(last.total,first.total);
   const beyond=await call(cid,{operation:'read',take:2,skip:first.total});page(beyond,cid,2,first.total);c.assert.equal(beyond.total,first.total);
   const selected=first.data[0],detail=await call(cid,{operation:'get',id:selected.nf_key,nf_key:selected.nf_key});c.assert.deepEqual(detail,{success:true,data:selected});
   const filtered=await call(cid,{operation:'read',take:2,skip:0,filter:{field:'nf_key',operator:'eq',value:selected.nf_key}});page(filtered,cid,2);c.assert.equal(filtered.total,1);c.assert.deepEqual(filtered.data,[selected]);
   const sorted=await call(cid,{operation:'read',take:2,skip:0,sort:[{field:'nf_key',dir:'desc'}]});page(sorted,cid,2);c.assert.equal(sorted.total,first.total);if(sorted.data.length===2)c.assert.ok(sorted.data[0].nf_key>sorted.data[1].nf_key);
   containers.push({container:cid,total:first.total,first:first.data.length,second:second.data.length,last:last.data.length,positiveGet:true,filteredIdentity:true,fullTotalBeyondOldCandidateCap:first.total>200});
  }
  c.assert.ok(containers.some(x=>x.fullTotalBeyondOldCandidateCap),'Must demonstrate a real total above the former200 candidate cap');
  const cid=333426,key=c.readJson(c.path.join(dir,'nf-page-first-'+cid+'-private.json')).data[0].nf_key;
  for(const bad of [{operation:'get',id:key,nf_key:key+' '},{operation:'get',id:key,nf_key:key.toLowerCase()},{operation:'get',id:key.toLowerCase()},{operation:'read',take:201},{operation:'read',skip:-1},{operation:'read',filter:{field:'nf_key ',operator:'eq',value:key}},{operation:'read',sort:[{field:'nf_key ',dir:'asc'}]}])rejected(await call(cid,bad),422);
  rejected(await call(cid,{operation:'read',take:2},false),401);
  save('pasoe-paged-five-container-proof.json',{success:true,instance:'sursum-api',context:'med',officialPort:9911,activeManifestSha256:c.sha(c.path.join(dir,'active-manifest.json')),checks:calls.length,containers,positiveGetAllFive:true,pagingAllFive:true,filtersAndSort:true,rawAliasRejected:true,authDenied:true,metadataReady:true,businessWrites:false,processRuns:false,catalogWrites:false});
  console.log('PASS1053 PASOE5 contexts: complete totals, paging/get/filter/sort/alias/auth; checks='+calls.length);
 }finally{config.integrationToken=undefined;}
}
module.exports={row,page,rejected,CIDS,FIELDS,main};
if(require.main===module)main().catch(()=>{console.error('BUILD12_PAGED_PASOE_FAILED; inspect private attempts; no metadata publication proof');process.exitCode=1;});
