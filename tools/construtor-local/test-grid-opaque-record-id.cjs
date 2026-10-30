'use strict';
const fs=require('node:fs'),vm=require('node:vm'),assert=require('node:assert/strict');
const source=process.argv[2]||'D:/opencode/construtor-pg/src/crud-engine/CrudKendoGridRenderer.js';
function check(id){
 let callback,called;const document={},element={},target={},record={record_key:id};
 const button={data:key=>key==='action'?'view':id.startsWith('{')?JSON.parse(id):String(Number(id))===id?Number(id):id,attr:key=>key==='data-id'?id:null,closest:()=>[element]};
 const chain={off(){return this;},on(...args){if(args[1]==='.crud-row-action')callback=args[2];return this;},find(){return this;}};
 const jq=x=>x===target?button:chain;
 const scope={window:null,document,jQuery:jq,console};scope.window=scope;vm.createContext(scope);vm.runInContext(fs.readFileSync(source,'utf8'),scope);
 const renderer=Object.create(scope.CrudKendoGridRenderer.prototype);Object.assign(renderer,{rowActionNamespace:'.test',definition:{dataModel:{primaryKey:'record_key'}},grid:{wrapper:chain,element:[element],dataSource:{view:()=>[record]}},closeRowActionsMenu(){},handlers:{view:(key,options)=>{called={key,record:options?.record};}}});
 renderer.bindRowActions();assert.equal(typeof callback,'function');callback({currentTarget:target,preventDefault(){}});
 assert.equal(called.key,id,'Opaque row key must remain its original string');assert.equal(called.record,record,'Row record must still resolve');
}
for(const id of ['{"sinaliz_imp_id":4,"proc_compra_id":1679,"item_proc_compra_id":0}','001','1679','f472b921-181d-4268-a91b-663347b0a139'])check(id);
console.log('PASS row actions preserve JSON, leading-zero, integer and UUID keys; resolved record forwarded');
