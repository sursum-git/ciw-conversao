'use strict';
// One bounded, read-only supplement. No replay of the original 87-call suite.
const c=require('./purchase-payments-builder-common.cjs');
const p=require('./prepare-ciw-build13-metadata.cjs');
const v=require('./verify-ciw-build13-pasoe.cjs');
const dir=c.path.join(p.r,'build13-pagination-complement');
const positive=x=>Number.isInteger(x)&&x>0&&x<=2147483647;
async function main(){
 c.assert.deepEqual(process.argv.slice(2),['--verify-readonly-pagination']);p.evidence(true);
 c.assert.ok(!c.fs.existsSync(dir),'NO_REPLAY');c.fs.mkdirSync(dir);
 const cfg=c.readJson(c.path.join(p.root,'.runtime/ciw-cadastros-20261020/private/connection.json'));
 c.assert.equal(cfg.baseUrl,'http://127.0.0.1:19910/med/web');c.assert.ok(cfg.integrationToken);
 let calls=0,nativeCalls=0;const observed=[],startedAtUtc=new Date().toISOString();
 const save=(name,value)=>{const text=JSON.stringify(value,null,2)+'\n';c.assert.ok(!text.includes(cfg.integrationToken));c.fs.writeFileSync(c.path.join(dir,name),text,{flag:'wx'});};
 save('attempt.json',{state:'STARTED',startedAtUtc,toolSha256:c.sha(__filename),businessWrites:false});
 try{
  const result=await c.session(async({runtime})=>{
   async function call(resource,body){
    c.assert.ok(v.resources.includes(resource)&&['read','get'].includes(body.operation)&&calls<48);calls++;
    const response=await fetch(cfg.baseUrl+'/SursumPrograms/ciw-cadastros',{method:'POST',headers:{'Content-Type':'application/json','X-Sursum-User':'admin','X-Ciw-Cadastros-Token':cfg.integrationToken},body:JSON.stringify({resource,...body}),signal:AbortSignal.timeout(30000)});
    c.assert.equal(response.status,200);const value=await response.json();save('response-'+String(calls).padStart(3,'0')+'-private.json',{resource,request:body,response:value});return value;
   }
   // All four CIDs were already observed in the completed build12 MED proof.
   for(const container_id of [331126,200019,333426,1525]){
    nativeCalls++;const versions=await runtime('ciw.container-versoes-custo/endpoints/read',{take:5,skip:0,context:{container_id}});save('versions-'+container_id+'-private.json',versions);c.assert.ok(Array.isArray(versions.data));
    const ids=[...new Set(versions.data.filter(x=>x.container_id===container_id&&positive(x.versao_id)).map(x=>x.versao_id))].slice(0,5);
    for(const versao_id of ids){
     const context={container_id,versao_id},pages=[];
     for(const resource of v.resources){
      const first=await call(resource,{operation:'read',...context,take:2,skip:0,sort:[{field:'item_container_custo_id',dir:'asc'}]});
      if(first.success===false&&first.error?.status===422&&first.error?.code==='COMPARISON_ZERO_DIVISOR'){observed.push({resource,...context,domainRejection:'COMPARISON_ZERO_DIVISOR'});break;}
      v.page(first,context,2);observed.push({resource,...context,total:first.total});if(first.total<3)break;pages.push({resource,first});
     }
     if(pages.length!==2)continue;
     const results=[];
     for(const {resource,first}of pages){
      const base={operation:'read',...context,take:2,sort:[{field:'item_container_custo_id',dir:'asc'}]};
      const second=await call(resource,{...base,skip:2});v.page(second,context,2,2);c.assert.equal(second.total,first.total);c.assert.ok(second.data.length>0);c.assert.ok(!second.data.some(x=>first.data.some(y=>x.record_key===y.record_key)));
      const tailSkip=first.total-2,tail=await call(resource,{...base,skip:tailSkip});v.page(tail,context,2,tailSkip);c.assert.equal(tail.total,first.total);c.assert.equal(tail.data.length,2);
      const after=await call(resource,{...base,skip:first.total});v.page(after,context,2,first.total);c.assert.equal(after.total,first.total);c.assert.equal(after.data.length,0);
      const selected=second.data[0];v.key(selected.record_key);const detail=await call(resource,{operation:'get',...context,id:selected.record_key,record_key:selected.record_key});c.assert.equal(detail.success,true);v.row(detail.data,context);c.assert.deepEqual(detail.data,selected);
      results.push({resource,total:first.total,secondPageRows:second.data.length,tailRows:tail.data.length,beyondEmpty:true,secondPageGetEqual:true});
     }
     return{state:'PROVED',nonemptySecondPage:true,results};
    }
   }
   return{state:'INCONCLUSIVE_NO_QUALIFYING_OBSERVED_DATA',nonemptySecondPage:false,results:[]};
  });
  const proof={success:true,readOnly:true,...result,startedAtUtc,completedAtUtc:new Date().toISOString(),calls,nativeCalls,observed,toolSha256:c.sha(__filename),activeManifestSha256:c.sha(c.path.join(p.r,'runtime-build13-v4/active-manifest.json')),originalProofSha256:c.sha(c.path.join(p.r,'runtime-build13-v4/pasoe-read-proof.json')),businessWrites:false,catalogWrites:false,processRuns:false};
  save('proof.json',proof);console.log(JSON.stringify({success:true,state:proof.state,nonemptySecondPage:proof.nonemptySecondPage,calls,nativeCalls,proofSha256:c.sha(c.path.join(dir,'proof.json'))}));
 }catch(error){save('failure.json',{success:false,code:error.code??'CHECK_FAILED',calls,nativeCalls,businessWrites:false});throw error;}finally{cfg.integrationToken=undefined;}
}
module.exports={main};if(require.main===module)main().catch(()=>{console.error('BUILD13_PAGINATION_COMPLEMENT_FAILED; inspect journal without replay');process.exitCode=1;});
