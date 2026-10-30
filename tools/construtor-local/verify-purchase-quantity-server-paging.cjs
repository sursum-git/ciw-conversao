'use strict';
const c=require('./purchase-payments-builder-common.cjs'),state=c.path.join(c.root,'.runtime/purchase-quantities-20261027/paging-fix');
const phase=process.argv[2];c.assert.ok(['before','after'].includes(phase));
c.session(async({runtime})=>{
 const cfg=c.readJson(c.path.join(c.root,'.runtime/ciw-cadastros-20261020/private/connection.json'));
 const bodies=[{operation:'read',take:1,skip:200},{operation:'read',take:1,skip:0,filter:{field:'proc_compra_id',operator:'eq',value:1679}},{operation:'read',take:1,skip:0,sort:[{field:'proc_compra_id',dir:'desc'}]}],checks=[];
 for(const body of bodies){
  const r=await fetch(cfg.baseUrl+'/SursumPrograms/ciw-cadastros',{method:'POST',headers:{'Content-Type':'application/json','X-Ciw-Cadastros-Token':cfg.integrationToken},body:JSON.stringify({resource:'proc_compra_quantidades',...body}),signal:AbortSignal.timeout(45000)});c.assert.equal(r.status,200);const expected=await r.json();c.assert.equal(expected.success,true);
  const payload={...body};delete payload.operation;const actual=await runtime('ciw.quantidades-importadas-med/endpoints/read',payload);
  const equal=require('node:util').isDeepStrictEqual(actual.data,expected.data)&&actual.total===expected.total;checks.push({name:body.skip?'pageAfterFirst200':body.filter?'globalFilterOutsideFirstPage':'globalDescendingSort',equal,expectedRows:expected.data.length,actualRows:actual.data.length,expectedTotal:expected.total,actualTotal:actual.total});
  if(phase==='after'){c.assert.deepEqual(actual.data,expected.data);c.assert.equal(actual.total,expected.total);}
 }
 if(phase==='before')c.assert.ok(checks.every(x=>!x.equal),'Expected to reproduce missing server-paging registration');
 else{const p=await runtime('ciw.proc-compra-quantidades/endpoints/read',{context:{proc_compra_id:1679},take:1,skip:0,sort:[{field:'item_proc_compra_id',dir:'desc'}]});c.assert.equal(p.data.length,1);c.assert.equal(p.data[0].proc_compra_id,1679);}
 c.fs.writeFileSync(c.path.join(state,phase+'-native-paging.json'),JSON.stringify({success:phase==='after',expectedRed:phase==='before',checks,businessWrites:false},null,2)+'\n');console.log('PASS '+phase+' native paging proof; '+checks.map(x=>x.name+':'+x.equal).join(', '));
},{readOnly:true}).catch(e=>{console.error(e.message);process.exitCode=1;});
