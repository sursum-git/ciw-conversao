'use strict';
const c=require('./purchase-payments-builder-common.cjs'),validator=require('./verify-ciw-completion-build7-pasoe.cjs');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build7');
async function main(){
 const cfg=c.readJson(c.path.join(c.root,'.runtime/ciw-cadastros-20261020/private/connection.json'));
 const parent=c.readJson(c.path.join(state,'import_descontos_geral-rows-private.json')).data[0];c.assert.ok(Number.isInteger(parent.desconto_importacao_id));
 const context={desconto_importacao_id:parent.desconto_importacao_id};
 const response=await fetch(cfg.baseUrl+'/SursumPrograms/ciw-cadastros',{method:'POST',headers:{'Content-Type':'application/json','X-Ciw-Cadastros-Token':cfg.integrationToken,'X-Sursum-User':'admin'},body:JSON.stringify({resource:'import_descontos_lancamentos',operation:'read',...context,take:200,skip:0}),signal:AbortSignal.timeout(45000)});
 c.assert.equal(response.status,200);const read=await response.json();c.assert.equal(read.success,true);c.assert.ok(read.data.length>0);
 c.fs.writeFileSync(c.path.join(state,'ledger-first-read-diagnostic-private.json'),JSON.stringify(read,null,2)+'\n');
 let reason=null;try{validator.rowShape('import_descontos_lancamentos',read.data[0],context);}catch(e){c.assert.match(e.message,/^[A-Z0-9_]+$/);reason=e.message;}
 const actualKeys=Object.keys(JSON.parse(read.data[0].record_key)),expectedKeys=validator.resources.import_descontos_lancamentos.key;
 const proof={success:true,responseSuccess:true,failure:reason,actualKeys,expectedKeys,sameKeySet:JSON.stringify([...actualKeys].sort())===JSON.stringify([...expectedKeys].sort()),businessWrites:false};
 c.fs.writeFileSync(c.path.join(state,'ledger-key-order-diagnostic.json'),JSON.stringify(proof,null,2)+'\n');console.log(JSON.stringify(proof));
}
main().catch(e=>{console.error(e.message);process.exitCode=1});
