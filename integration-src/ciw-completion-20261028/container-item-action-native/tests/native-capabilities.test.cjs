'use strict';
const test=require('node:test'),assert=require('node:assert/strict'),vm=require('node:vm'),fs=require('node:fs');
const root='D:/opencode/construtor-pg',ctx={console,URLSearchParams,jQuery:()=>{throw Error('DOM_NOT_AUTHORIZED_IN_PROTOTYPE_PROBE');}};ctx.window=ctx;vm.createContext(ctx);
for(const name of['CrudUtils','CrudDefinitionValidator','CrudKendoGridRenderer','CrudEngine'])vm.runInContext(fs.readFileSync(root+'/src/crud-engine/'+name+'.js','utf8'),ctx);
test('native row link emits both actual parent and item IDs',()=>{
 const html=ctx.CrudKendoGridRenderer.prototype.buildRowLinkHtml({screenId:'ciw.proc-compra-itens',label:'Pedido',parameters:[{field:'proc_compra_id',sourceField:'proc_compra_id'},{field:'item_proc_compra_id',sourceField:'item_proc_compra_id'}]},{proc_compra_id:12,item_proc_compra_id:34});
 assert.match(html,/context__proc_compra_id=12/);assert.match(html,/context__item_proc_compra_id=34/);
});
test('constant row-link parameter is rejected by real declarative validator',()=>{
 const errors=[];new ctx.CrudDefinitionValidator().validateDeclarativeCapabilities({dataModel:{fields:{container_id:{type:'integer'}}},grid:{rowLinks:[{id:'usd',label:'USD',screenId:'ciw.container-custos-itens',parameters:[{field:'moeda',value:1}]}]}},errors);assert.ok(errors.some(e=>e.includes('rowLinks.parameters')));
});
test('native row-link runtime cannot synthesize a constant',()=>{
 const html=ctx.CrudKendoGridRenderer.prototype.buildRowLinkHtml({screenId:'ciw.container-custos-itens',label:'USD',parameters:[{field:'moeda',value:1}]},{container_id:12});assert.equal(html,'');
});
test('visibleWhen does not hide a grid column in current renderer',()=>{
 const fake={definition:{dataModel:{fields:{vl_total_real:{type:'number',visibleWhen:{field:'log_liberar_custo_realizado',value:true}}}},grid:{columns:[{field:'vl_total_real',visibleWhen:{field:'log_liberar_custo_realizado',value:true}}],rowLinks:[]}},isBatchMode:()=>false,isColumnFreezeEnabled:()=>false,applyMobileColumnConfig:v=>v,applyUserLayout:v=>v,isBulkActionsEnabled:()=>false,buildActionColumn:()=>null,getInitialGroup:()=>[]};
 const columns=ctx.CrudKendoGridRenderer.prototype.buildColumns.call(fake);assert.equal(columns.length,1);assert.equal(columns[0].hidden,false);
});
test('undeclared linked item context is discarded; parent alone selects all child rows',()=>{
 const fake={options:{contextValues:{proc_compra_id:12,item_proc_compra_id:34}},definition:{contextFields:[{field:'proc_compra_id',required:true}],dataModel:{fields:{proc_compra_id:{type:'integer'},item_proc_compra_id:{type:'integer'}}}}};
 ctx.CrudEngine.prototype.initializeNavigationContext.call(fake);assert.equal(fake.contextValues.proc_compra_id,12);assert.ok(!Object.hasOwn(fake.contextValues,'item_proc_compra_id'));
});
