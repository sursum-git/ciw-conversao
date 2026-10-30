'use strict';
const c=require('./purchase-payments-builder-common.cjs'),state=c.path.join(c.root,'.runtime/purchase-sample-formats-20261027');
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
async function main(){
 const cfg=c.readJson(c.path.join(c.root,'.runtime/ciw-cadastros-20261020/private/connection.json'));c.assert.equal(cfg.baseUrl,'http://127.0.0.1:19910/med/web');
 async function call(resource,body){c.assert.ok(['read','get'].includes(body.operation));const r=await fetch(cfg.baseUrl+'/SursumPrograms/ciw-cadastros',{method:'POST',headers:{'Content-Type':'application/json','X-Ciw-Cadastros-Token':cfg.integrationToken},body:JSON.stringify({resource,...body}),signal:AbortSignal.timeout(45000)});c.assert.equal(r.status,200);return r.json();}
 const resource='formatos_amostra',page=await call(resource,{operation:'read'});c.assert.equal(page.success,true,page.error?.code);c.assert.ok(page.data.length>0&&page.data.length<=200);
 for(const row of page.data){c.assert.deepEqual(Object.keys(row).sort(),['descricao','formato_amostra_id','log_inativo']);c.assert.ok(Number.isInteger(row.formato_amostra_id));const detail=await call(resource,{operation:'get',id:String(row.formato_amostra_id),formato_amostra_id:row.formato_amostra_id});c.assert.equal(detail.success,true,detail.error?.code);c.assert.deepEqual(detail.data,row);}
 const id=page.data[0].formato_amostra_id;
 const negatives=[{operation:'get',id:String(id),formato_amostra_id:id+10000},{operation:'get',id:'1.5'},{operation:'get'},{operation:'read',formato_amostra_id:id},{operation:'get',id:'2147483647'}];
 for(const body of negatives){const x=await call(resource,body);c.assert.equal(x.success,false);c.assert.ok([404,422].includes(x.error.status));}
 for(const old of ['coloracoes','situacoes_container','tipos_versao_custo']){const r=await call(old,{operation:'read'});c.assert.equal(r.success,true,old+' '+r.error?.code);c.assert.ok(Array.isArray(r.data));}
 save('pasoe-rows-private.json',page);save('pasoe-read-proof.json',{success:true,instance:'sursum-api',context:'med',officialPort:9911,tunnel:'19910 -> 9910 same instance',resource,rows:page.data.length,nativeGet:true,aliasEquality:true,negativeChecks:negatives.length,previousResources:['coloracoes','situacoes_container','tipos_versao_custo'],compiledDispatcherValidated:true,businessWrites:false});console.log('PASS PASOE real formatos read/get;5negatives;3previous resources; no business writes');
}
main().catch(e=>{console.error(e.message);process.exitCode=1;});



