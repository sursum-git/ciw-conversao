'use strict';
// Offline only: no credentials, HTTP, SSH or AVM. Exercises actual validator code.
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const api=require('./verify-ciw-build13-pasoe.cjs'),root=path.resolve(__dirname,'../..');let checks=0;
const ok=(x)=>{assert.ok(x);checks++;},reject=f=>{assert.throws(f);checks++;};
function makeRow(cid=332526,vid=11,id=21){const value={container_id:cid,versao_id:vid,item_container_custo_id:id,item_container_id:id+100,codigo_erp:'A',descricao:null,...Object.fromEntries(api.NUMBERS.map((k,n)=>[k,n%3===0?null:n+.125]))};value.record_key=JSON.stringify({item_container_custo_id:id,versao_id:vid,container_id:cid});return value;}
const ctx={container_id:332526,versao_id:11},sample=makeRow();api.row(sample,ctx);checks++;
reject(()=>api.row({...sample,unexpected:1},ctx));reject(()=>api.row({...sample,qt_alocada:'1'},ctx));reject(()=>api.row(sample,{...ctx,container_id:1}));reject(()=>api.key(JSON.stringify({...JSON.parse(sample.record_key),extra:1})));
ok(api.requestAllowed(api.resources[0],{operation:'get',id:sample.record_key}));ok(!api.requestAllowed(api.resources[0],{operation:'update'}));ok(!api.requestAllowed('unknown',{operation:'read'}));
const B=path.join(root,'.runtime/ciw-completion-20261028/official-build13-v3'),P=path.join(root,'.runtime/ciw-completion-20261028/build13-root-companions-v3'),read=p=>JSON.parse(fs.readFileSync(p,'utf8'));
const official=read(path.join(P,'official-compile-verification.json')),targets=read(path.join(B,'runtime-targets.json')).targets.map(x=>x.relative),officialSha=crypto.createHash('sha256').update(fs.readFileSync(path.join(P,'official-compile-verification.json'))).digest('hex');
const gate={official,targets,officialSha,releaseSha:'7694b83727c554f9503cbafff4294f33c6da2f02bf2770dc4cc217d219cab9e9',managerSha:'ae932cc8b6b95435bed8b580ddcd6191d49d8ab3ce349bc53c44d6f3a408de92',operations:read(path.join(B,'metadata/api-source-additions.json')).operations,drafts:api.resources.map(x=>read(path.join(B,'metadata',x+'-builder-draft.json'))),active:{success:true,instance:'sursum-api',context:'med',medWebRestored:true,imaWebUnchanged:true,businessWrites:false,releaseSha256:official.releaseSha256,officialProofSha256:officialSha,targets:Object.fromEntries(official.files.map(x=>[x.relative,{sha256:x.sha256}]))}};
api.gates(gate);checks++;
for(const mutate of [g=>g.active.targets.extra={},g=>g.active.imaWebUnchanged=false,g=>g.official.compileCount=68,g=>g.official.numDbsTests=1,g=>g.active.officialProofSha256='bad',g=>g.operations[1].type='get']){const g=structuredClone(gate);mutate(g);reject(()=>api.gates(g));}
async function simulate(empty=false){
 const calls=[],saved=[],fail=(status=422,code='INVALID')=>({success:false,error:{status,code}});
 async function call(resource,body,auth=true){ok(api.requestAllowed(resource,body));calls.push({resource,body,auth});if(!auth)return fail(401);if(resource===api.OLD)return{success:true,data:[],total:0};
  const get=body.operation==='get',allowed=get?['operation','container_id','versao_id','id','record_key']:['operation','container_id','versao_id','take','skip','filter','sort'];
  if(Object.keys(body).some(k=>!allowed.includes(k))||!Number.isInteger(body.container_id)||body.container_id<1||!Number.isInteger(body.versao_id)||body.versao_id<1||body.take>200||body.skip<0)return fail();
  if(body.container_id===1)return fail(404,resource===api.HISTORY?'VERSION_HISTORY_PARENT':'VERSION_NOT_FOUND');
  const value=makeRow(body.container_id,body.versao_id),value2=makeRow(body.container_id,body.versao_id,22);value2.codigo_erp='B';let data=empty?[]:[value,value2];
  if(resource===api.HISTORY){const history={container_id:body.container_id,versao_id:body.versao_id,record_key:value.record_key};return get?{success:true,data:history}:{success:true,data:empty?[]:[history],total:empty?0:1};}
  if(get){let key;try{key=api.key(body.id);}catch{return fail();}if(body.record_key!==undefined&&body.record_key!==body.id)return fail();if(key.container_id!==body.container_id||key.versao_id!==body.versao_id)return fail(404);return{success:true,data:value};}
  function matches(filter,row){if(filter.logic)return filter.filters.every(x=>matches(x,row));if(!api.FIELDS.includes(filter.field))throw Error('invalid');return filter.operator==='neq'?row[filter.field]!==filter.value:row[filter.field]===filter.value;}
  if(body.filter){try{data=data.filter(x=>matches(body.filter,x));}catch{return fail();}}
  if(body.sort){if(body.sort[0].field!=='item_container_custo_id')return fail();if(body.sort[0].dir==='desc')data.reverse();}
  const total=data.length;return{success:true,data:data.slice(body.skip??0,(body.skip??0)+(body.take??200)),total};
 }
 const exec=()=>api.run({call,save:(name,value)=>saved.push({name,value}),nativeVersions:async()=>({data:[{container_id:332526,versao_id:11},{container_id:332526,versao_id:12}]})});
 if(empty){await assert.rejects(exec,/NO_POSITIVE_COMPARISON_DATA_OBSERVED/);checks++;return;}
 const result=await exec();ok(result.success&&result.results.length===2&&result.results.every(x=>x.readGet&&x.fields===19&&x.privatePolicyRejected&&x.crossContainerRejected&&x.crossObservedVersionRejected));
 ok(calls.filter(x=>x.body.operation==='get'&&x.body.id===sample.record_key&&x.auth).length>=3);ok(calls.every(x=>['read','get'].includes(x.body.operation)));ok(calls.length<160);ok(saved.length===3);return calls.length;
}
(async()=>{const positiveCalls=await simulate();await simulate(true);const d=path.join(root,'.runtime/ciw-completion-20261028/build13-pasoe-validator-preparation');fs.mkdirSync(d,{recursive:true});const proof={success:true,state:'OFFLINE_VALIDATOR_SELFTESTS_ONLY',checks,positiveCalls,sourceSha256:crypto.createHash('sha256').update(fs.readFileSync(path.join(__dirname,'verify-ciw-build13-pasoe.cjs'))).digest('hex'),credentialsRead:false,networkExecuted:false,businessWrites:false,realPasoeProofWritten:false};fs.writeFileSync(path.join(d,'selftest-proof.json'),JSON.stringify(proof,null,2)+'\n',{flag:'wx'});console.log(JSON.stringify(proof));})().catch(()=>{console.error('OFFLINE_VALIDATOR_SELFTEST_FAILED');process.exitCode=1;});
