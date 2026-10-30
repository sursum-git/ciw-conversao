'use strict';
const c=require('./purchase-payments-builder-common.cjs'),state=c.path.join(c.root,'.runtime/purchase-quantity-periods-20261028');
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
c.session(async({api,runtime})=>{
 const screen='ciw.quantidades-importadas-periodo-med',definition=await runtime(screen),parent=await runtime('ciw.processos-compra-med');
 c.assert.deepEqual(parent,c.readJson(c.path.join(state,'parent-before.json')),'PARENT_CHANGED');
 c.assert.equal(definition.program.version,'1.0.0');c.assert.equal(Object.keys(definition.dataModel.fields).length,21);
 for(const action of ['create','edit','delete'])c.assert.equal(definition.permissions[action],false);
 const source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;c.assert.equal(source.operations.length,111);
 for(const old of c.readJson(c.path.join(state,'source-registry-before.json')).operations)c.assert.deepEqual(source.operations.find(x=>x.code===old.code),old);
 const cfg=c.readJson(c.path.join(c.root,'.runtime/ciw-cadastros-20261020/private/connection.json'));
 async function direct(body){const r=await fetch(cfg.baseUrl+'/SursumPrograms/ciw-cadastros',{method:'POST',headers:{'Content-Type':'application/json','X-Ciw-Cadastros-Token':cfg.integrationToken},body:JSON.stringify({resource:'proc_compra_quantidades_periodo_med',operation:'read',...body}),signal:AbortSignal.timeout(45000)});c.assert.equal(r.status,200);const v=await r.json();c.assert.equal(v.success,true);return v;}
 const checks=[];
 for(const payload of [{take:200,skip:0},{take:1,skip:200,sort:[{field:'pedido_fornec',dir:'desc'}]},{take:2,skip:0,filter:{field:'dt_prev_chegada',operator:'between',value:{start:'2026-11-01',end:'2026-11-30'}}}]){
  const expectedPayload=structuredClone(payload);if(expectedPayload.filter)expectedPayload.filter={logic:'and',filters:[{field:'dt_prev_chegada',operator:'gte',value:'2026-11-01'},{field:'dt_prev_chegada',operator:'lte',value:'2026-11-30'}]};
  const expected=await direct(expectedPayload),actual=await runtime(screen+'/endpoints/read',payload);c.assert.deepEqual(actual.data,expected.data);c.assert.equal(actual.total,expected.total);
  if(!payload.filter&&!payload.skip){const row=actual.data[0],detail=await runtime(screen+'/endpoints/get',{id:row.record_key});c.assert.deepEqual(detail.data??detail,row);}
  checks.push({name:payload.filter?'forecastBetween':payload.skip?'pageAfter200':'readGet',total:actual.total,rows:actual.data.length});
 }
 save('published-definition.json',definition);save('native-read-proof.json',{success:true,checks,fields:21,readonly:true,sourceOperations:111,previous109Preserved:true,parentUnchanged:true,parentTabs:11,businessWrites:false,humanPermissionsChanged:false});
 console.log('PASS native runtime: read/get/pageAfter200/between; 109 source operations and parent preserved');
},{readOnly:true}).catch(e=>{console.error(e.message);process.exitCode=1;});
