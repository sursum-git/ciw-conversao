'use strict';
// Diagnostic gate only. Never emits the final metadata publication proof.
const c=require('./purchase-payments-builder-common.cjs');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/runtime-build10');
async function main(){
 const proof=c.path.join(state,'pasoe-limit-diagnostic-proof.json');c.assert.ok(!c.fs.existsSync(proof));
 const active=c.readJson(c.path.join(state,'active-manifest.json'));c.assert.ok(active.success&&active.medWebRestored&&active.imaWebUnchanged);
 const old=c.readJson(c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build9-v2/nf-available-333426-rows-private.json'));c.assert.ok(old.success&&old.data.length>0);const key=old.data[0].nf_key;c.assert.match(key,/^nf_[A-F0-9]{64}$/);
 const cfg=c.readJson(c.path.join(c.root,'.runtime/construtor-pg/containers-connection.json'));
 const calls=[];const save=(name,v)=>c.fs.writeFileSync(c.path.join(state,name),JSON.stringify(v,null,2)+'\n');
 async function call(body){c.assert.ok(['get','read'].includes(body.operation)&&body.resource==='nfs-disponiveis');const started=Date.now();const response=await fetch('http://127.0.0.1:19910/med/web/SursumPrograms/containers-financeiro',{method:'POST',headers:{'Content-Type':'application/json','X-Containers-Token':cfg.integrationToken},body:JSON.stringify(body),signal:AbortSignal.timeout(30000)});c.assert.equal(response.status,200);const data=await response.json();calls.push({operation:body.operation,container:body.container_id,success:data.success,errorCode:data.error?.code??null,errorStatus:data.error?.status??null,durationMs:Date.now()-started});save('pasoe-diagnostic-attempts.json',calls);return data;}
 try{
  const base={operation:'get',resource:'nfs-disponiveis',container_id:333426,id:key};const get=await call({...base,nf_key:key});c.assert.equal(get.success,true);c.assert.equal(get.data.nf_key,key);c.assert.equal(get.data.container_id,333426);
  for(const bad of [{...base,nf_key:key+' '},{...base,nf_key:key.toLowerCase()},{...base,id:key.toLowerCase()}]){const result=await call(bad);c.assert.equal(result.success,false);c.assert.equal(result.error.status,422);c.assert.equal(Object.hasOwn(result,'data'),false);}
  const containers=[];
  for(const cid of [332526,331126,200019,333426,1525]){
   const result=await call({operation:'read',resource:'nfs-disponiveis',container_id:cid});
   if(result.success){c.assert.ok(Array.isArray(result.data)&&result.data.length<=200);c.assert.ok(result.data.every(row=>row.container_id===cid));containers.push({container:cid,success:true,rows:result.data.length});}
   else{c.assert.equal(result.error.status,503);c.assert.match(result.error.code,/^CONTAINER_NF_[A-Z_]+$/);c.assert.notEqual(result.error.code,'CONTAINER_NF_QUERY_LIMIT','Diagnostic must distinguish the actual limit');c.assert.equal(Object.hasOwn(result,'data'),false);containers.push({container:cid,success:false,limit:result.error.code});}
  }
  save('pasoe-limit-diagnostic-proof.json',{success:true,aliasWhitespaceRejected:true,aliasCaseRejected:true,idCaseRejected:true,positiveGet:true,containers,metadataReady:false,businessWrites:false,processRuns:false,catalogWrites:false});console.log('PASS alias regression and classified five-container limit diagnostic; metadata remains held');
 }finally{cfg.integrationToken=undefined;}
}
main().catch(()=>{console.error('BUILD10_DIAGNOSTIC_FAILED; inspect private attempts; no final proof emitted');process.exitCode=1;});
