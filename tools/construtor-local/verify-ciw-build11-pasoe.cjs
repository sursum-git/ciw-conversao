'use strict';
const c=require('./purchase-payments-builder-common.cjs');
const s=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build11');
const resource='despesas_impostos_geral',keys=['despesa_id','imposto_id','empresa_id'];
const exact=(x,names)=>x&&typeof x==='object'&&!Array.isArray(x)&&JSON.stringify(Object.keys(x).sort())===JSON.stringify([...names].sort());
function row(x){c.assert.ok(exact(x,[...keys,'record_key']));const id=JSON.parse(x.record_key);c.assert.ok(exact(id,keys));for(const k of keys){c.assert.ok(x[k]===null||Number.isInteger(x[k])&&x[k]>=-2147483648&&x[k]<=2147483647);c.assert.equal(id[k],x[k]);}c.assert.equal(x.record_key,JSON.stringify(Object.fromEntries(keys.map(k=>[k,x[k]]))));}
function read(x,take){c.assert.ok(exact(x,['success','data','total'])&&x.success);c.assert.ok(Array.isArray(x.data)&&x.data.length<=take&&Number.isInteger(x.total)&&x.total>=0&&x.total<=50000);x.data.forEach(row);c.assert.equal(new Set(x.data.map(r=>r.record_key)).size,x.data.length);}
function rejected(x,status){c.assert.equal(x.success,false);c.assert.equal(x.error.status,status);c.assert.equal(Object.hasOwn(x,'data'),false);}
async function main(){
 const file=c.path.join(s,'pasoe-read-proof.json');c.assert.ok(!c.fs.existsSync(file));
 const active=c.readJson(c.path.join(c.root,'.runtime/ciw-completion-20261028/runtime-build11/active-manifest.json'));c.assert.ok(active.success&&active.medWebRestored&&active.imaWebUnchanged);
 const cfg=c.readJson(c.path.join(c.root,'.runtime/ciw-cadastros-20261020/private/connection.json'));c.assert.equal(cfg.baseUrl,'http://127.0.0.1:19910/med/web');
 const attempts=[];let checks=0;
 async function call(body,auth=true){
  c.assert.ok(['read','get'].includes(body.operation));
  const headers={'Content-Type':'application/json','X-Sursum-User':'admin'};if(auth)headers['X-Ciw-Cadastros-Token']=cfg.integrationToken;
  const response=await fetch(cfg.baseUrl+'/SursumPrograms/ciw-cadastros',{method:'POST',headers,body:JSON.stringify({resource,...body}),signal:AbortSignal.timeout(30000)});c.assert.equal(response.status,200);
  const data=await response.json();attempts.push({operation:body.operation,success:data.success,status:data.error?.status??null,code:data.error?.code??null});c.fs.writeFileSync(c.path.join(s,'pasoe-attempts-private.json'),JSON.stringify(attempts,null,2)+'\n');checks++;return data;
 }
 try{
  const first=await call({operation:'read',take:2});read(first,2);c.assert.ok(first.data.length>0,'Positive GET requires an observed row; do not fabricate records');
  c.fs.writeFileSync(c.path.join(s,'observed-relations-private.json'),JSON.stringify(first,null,2)+'\n');
  const next=await call({operation:'read',take:2,skip:2});read(next,2);c.assert.equal(next.total,first.total);for(const r of next.data)c.assert.ok(!first.data.some(x=>x.record_key===r.record_key));
  const selected=first.data[0],get=await call({operation:'get',id:selected.record_key,record_key:selected.record_key});c.assert.deepEqual(get,{success:true,data:selected});
  const filter={logic:'and',filters:keys.map(field=>({field,operator:'eq',value:selected[field]}))};
  const filtered=await call({operation:'read',take:2,filter});read(filtered,2);c.assert.equal(filtered.total,1);c.assert.deepEqual(filtered.data,[selected]);
  const empty=await call({operation:'read',filter:{logic:'and',filters:[filter,{field:keys[0],operator:'neq',value:selected[keys[0]]}]}});read(empty,200);c.assert.equal(empty.total,0);
  rejected(await call({operation:'get',id:selected.record_key,record_key:selected.record_key+' '}),422);
  const negatives=[{operation:'read',take:201},{operation:'read',skip:-1},{operation:'read',empresa_id:2},{operation:'read',container_id:1},{operation:'read',context:{empresa_id:2}},{operation:'read',filter:{field:'despesa_id ',operator:'eq',value:1}},{operation:'read',filter:{field:'sql',operator:'eq',value:1}},{operation:'read',sort:[{field:'imposto_id ',dir:'asc'}]},{operation:'get',id:'{}'},{operation:'get',id:JSON.stringify({...JSON.parse(selected.record_key),despesa_id:String(selected.despesa_id)})}];
  for(const bad of negatives)rejected(await call(bad),422);
  rejected(await call({operation:'read'},false),401);
  c.fs.writeFileSync(file,JSON.stringify({success:true,instance:'sursum-api',context:'med',officialPort:9911,checks,global:true,observedTotal:first.total,positiveGet:true,paging:true,pk3:true,filters:true,aliasRejected:true,invalidContextsRejected:true,authDenied:true,businessWrites:false,processRuns:false,catalogWrites:false},null,2)+'\n');
  console.log('PASS1055 PASOE global/PK3/read/get/paging/filter/aliases/auth checks='+checks);
 }finally{cfg.integrationToken=undefined;}
}
main().catch(()=>{console.error('BUILD11_PASOE_FAILED; inspect private attempts before further work');process.exitCode=1;});
