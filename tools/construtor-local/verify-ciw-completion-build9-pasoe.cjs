'use strict';
// Fixed MED reader only; no writer/process/DDL/catalog access.
const c=require('./purchase-payments-builder-common.cjs'),fs=c.fs,path=c.path;
const state=path.join(c.root,'.runtime/ciw-completion-20261028/official-build9-v2'),runtime=path.join(c.root,'.runtime/ciw-completion-20261028/runtime-build9-v2');
const exact=(v,keys)=>v&&typeof v==='object'&&!Array.isArray(v)&&JSON.stringify(Object.keys(v).sort())===JSON.stringify([...keys].sort());
const fields=['container_id','nf_key','documento_localizado','estab','documento','serie','cod_emitente','nat_operacao','especie','dt_emissao','dt_trans','tot_valor','despesa_nota','valor_embal','valor_frete','valor_mercad','valor_outras','valor_seguro'];
function row(v,cid){c.assert.ok(exact(v,fields));c.assert.equal(v.container_id,cid);c.assert.equal(v.documento_localizado,true);c.assert.match(v.nf_key,/^nf_[A-F0-9]{64}$/);c.assert.ok(typeof v.estab==='string'&&v.estab.startsWith('5'));c.assert.ok(typeof v.nat_operacao==='string'&&v.nat_operacao.startsWith('3'));c.assert.ok(Number.isInteger(v.cod_emitente));for(const f of ['documento','serie'])c.assert.ok(v[f]===null||typeof v[f]==='string');for(const f of ['especie','tot_valor','despesa_nota','valor_embal','valor_frete','valor_mercad','valor_outras','valor_seguro'])c.assert.ok(v[f]===null||typeof v[f]==='number'&&Number.isFinite(v[f]));for(const f of ['dt_emissao','dt_trans'])c.assert.match(v[f],/^\d{4}-\d{2}-\d{2}$/);}
const denied=(b,status)=>{c.assert.equal(b.success,false);c.assert.equal(b.error.status,status);c.assert.equal(Object.hasOwn(b,'data'),false);};
async function main(){
 c.assert.ok(!fs.existsSync(path.join(state,'pasoe-read-proof.json')),'Inspect previous proof before replay');
 const active=c.readJson(path.join(runtime,'active-manifest.json'));c.assert.ok(active.success&&active.medWebRestored&&active.imaWebUnchanged);fs.writeFileSync(path.join(state,'active-manifest.json'),fs.readFileSync(path.join(runtime,'active-manifest.json')));
 const cfg=c.readJson(path.join(c.root,'.runtime/construtor-pg/containers-connection.json'));
 c.assert.ok(typeof cfg.integrationToken==='string'&&cfg.integrationToken.length>0);
 const requests=[],observed=[];let selected;
 const save=(name,v)=>fs.writeFileSync(path.join(state,name),JSON.stringify(v,null,2)+'\n');
 async function call(body,auth=true){c.assert.ok(['read','get'].includes(body.operation)&&body.resource==='nfs-disponiveis');const r=await fetch('http://127.0.0.1:19910/med/web/SursumPrograms/containers-financeiro',{method:'POST',headers:{'Content-Type':'application/json',...(auth?{'X-Containers-Token':cfg.integrationToken}:{})},body:JSON.stringify(body),signal:AbortSignal.timeout(30000)});c.assert.equal(r.status,200);const b=await r.json();requests.push({operation:body.operation,container:body.container_id??null,auth,success:b.success,errorCode:b.error?.code??null,errorStatus:b.error?.status??null});save('pasoe9-attempts.json',requests);return b;}
 try{
  for(const cid of [332526,331126,200019,333426,1525]){
   const result=await call({operation:'read',resource:'nfs-disponiveis',container_id:cid});
   if(result.success!==true){c.assert.ok([422,503].includes(result.error?.status));observed.push({container:cid,read:false,errorCode:result.error.code});continue;}
   c.assert.ok(exact(result,['success','data'])&&Array.isArray(result.data)&&result.data.length<=200);result.data.forEach(v=>row(v,cid));c.assert.equal(new Set(result.data.map(v=>v.nf_key)).size,result.data.length);
   save('nf-available-'+cid+'-rows-private.json',result);
   observed.push({container:cid,read:true,count:result.data.length});
   if(result.data.length&&!selected)selected={cid,row:result.data[0]};
  }
  c.assert.ok(observed.some(x=>x.read),'No valid MED read observed');
  if(selected){
   const{cid,row:v}=selected;const b=await call({operation:'get',resource:'nfs-disponiveis',container_id:cid,id:v.nf_key,nf_key:v.nf_key});c.assert.ok(exact(b,['success','data'])&&b.success);row(b.data,cid);c.assert.deepEqual(b.data,v);
   denied(await call({operation:'get',resource:'nfs-disponiveis',container_id:cid,id:v.nf_key,nf_key:v.nf_key+' '}),422);
   denied(await call({operation:'get',resource:'nfs-disponiveis',container_id:cid,id:v.nf_key.toLowerCase()}),422);
   save('pasoe-positive-get-private.json',selected);
  }
  const cid=observed.find(x=>x.read).container;
  for(const body of [{operation:'read',resource:'nfs-disponiveis'},{operation:'read',resource:'nfs-disponiveis',container_id:String(cid)},{operation:'read',resource:'nfs-disponiveis',container_id:cid,database:'ems2ima'},{operation:'read',resource:'nfs-disponiveis',container_id:cid,empresa_id:5},{operation:'get',resource:'nfs-disponiveis',container_id:cid,id:'{}'}])denied(await call(body),422);
  denied(await call({operation:'read',resource:'nfs-disponiveis',container_id:cid},false),401);
  save('pasoe-read-proof.json',{success:true,instance:'sursum-api',context:'med',observed,positiveGet:!!selected,positiveGetRequiredRemaining:!selected,requestNegatives:5,authDenied:1,businessWrites:false,processRuns:false,catalogWrites:false,partialOrigin:true});
  console.log('PASS published NF reader: '+observed.filter(x=>x.read).length+' valid MED lists; positiveGET='+!!selected+'; no business writes');
 }finally{cfg.integrationToken=undefined;}
}
main().catch(()=>{console.error('BUILD9_PASOE_READ_CHECK_FAILED; inspect private attempt journal');process.exitCode=1;});
