'use strict';
// Native definition/read/get/options only. This tool has NO process endpoint call.
const c=require('./purchase-payments-builder-common.cjs'),vm=require('node:vm'),v=require('./verify-ciw-completion-build8-pasoe.cjs');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build8'),dir=c.path.join(c.root,'.runtime/ciw-completion-20261028/build8-metadata-publication-preparation');
const scope={console,URL,window:null,jQuery:()=>{throw Error('DOM_NOT_EXPECTED');},location:{href:c.base,origin:c.base}};scope.window=scope;vm.createContext(scope);
for(const file of ['src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudDefinitionValidator.js','src/process-engine/ProcessDefinitionValidator.js'])vm.runInContext(c.fs.readFileSync(c.path.join('D:/opencode/construtor-pg',file),'utf8'),scope,{filename:file});
async function main(){
 c.assert.ok(c.readJson(c.path.join(dir,'metadata-publication.json')).success);
 await c.session(async({api,runtime})=>{
  const results=[];
  for(const[screen,resource]of[['ciw.item-custos-manuais','item_custos_manual'],['ciw.itens-container-amostra','item_container_amostra']]){
   const def=await runtime(screen);c.assert.equal(new scope.CrudDefinitionValidator().validate(def),true);c.assert.equal(def.program.version,'1.0.0');
   for(const op of ['create','edit','delete'])c.assert.equal(def.permissions[op],false);
   const read=await runtime(screen+'/endpoints/read',{context:{},take:200,skip:0});c.assert.ok(Array.isArray(read.data));read.data.forEach(row=>v.rowShape(resource,row));
   c.assert.ok(read.data.length>0,'OBSERVED_POSITIVE_DATA_REQUIRED');
   const get=await runtime(screen+'/endpoints/get',{context:{},id:read.data[0].record_key}),record=Object.hasOwn(get,'record_key')?get:get.data;c.assert.deepEqual(record,read.data[0]);
   const pk=v.resources[resource].pk,filter={field:pk,operator:'eq',value:record[pk]},filtered=await runtime(screen+'/endpoints/read',{context:{},take:200,filter});c.assert.equal(filtered.total,1);c.assert.deepEqual(filtered.data,[record]);
   results.push({screen,nativeValidator:true,readonly:true,read:true,positiveGet:true,pkFilter:true,observedTotal:read.total});
  }
  const screen='ciw.container-selecionar-despesas',def=await runtime(screen);c.assert.equal(new scope.ProcessDefinitionValidator().validate(def),true);c.assert.equal(def.program.version,'1.0.0');
  c.assert.deepEqual(def.dataModel.fields.despesa_ids.optionsSource.parameterFields,['ordem_campo','ordem_direcao']);c.assert.ok(def.process.actions.process.confirmation);
  const context={container_id:332526},field=def.process.parameters.fields.find(x=>x.field==='ordem_campo'),direction=def.process.parameters.fields.find(x=>x.field==='ordem_direcao');let optionsRequests=0,observedOptions=0;
  for(const order of field.options)for(const sort of direction.options){
   const response=await runtime(screen+'/endpoints/options.despesa_ids',{context,parameters:{ordem_campo:order.value,ordem_direcao:sort.value}});
   c.assert.ok(Array.isArray(response.data)&&response.data.length<=5000);const values=new Set();for(const row of response.data){c.assert.ok(Number.isInteger(row.value)&&row.value>0&&typeof row.text==='string'&&!values.has(row.value));values.add(row.value);}observedOptions=Math.max(observedOptions,response.data.length);optionsRequests++;
  }
  c.assert.ok(observedOptions>0);await runtime(screen+'/endpoints/options.despesa_ids',{context:{},parameters:{ordem_campo:'ordem',ordem_direcao:'asc'}},422);
  await runtime(screen+'/endpoints/options.despesa_ids',{context,parameters:{ordem_campo:'not_allowed',ordem_direcao:'asc'}},422);
  const parent=await runtime('ciw.container-despesas');c.assert.equal(parent.program.version,'1.0.4');c.assert.ok(parent.crud.grid.rowLinks.some(x=>x.screenId===screen&&x.parameters.some(y=>y.field==='container_id'&&y.sourceField==='container_id')));
  for(const[code,count]of[['motor_progress_ciw_cadastros',144],['motor_progress_container_processos',8]])c.assert.equal((await api('/api-sources/'+code)).apiSource.operations.length,count);
  c.fs.writeFileSync(c.path.join(state,'runtime-read-proof.json'),JSON.stringify({success:true,results,processDefinitionValidator:true,processOptionsReadOnly:true,optionsRequests,observedOptions,missingContextRejected:true,invalidOrderRejected:true,parentContextLink:true,source144And8:true,businessWrites:false,processRuns:false,humanPermissionsChanged:false},null,2)+'\n');
  console.log('PASS2nativeCRUD/read/get/filter + processdefinition/options8sortcombinations/context/parentlink; NO process run');
 },{readOnly:true});
}
main().catch(e=>{console.error(e.message);process.exitCode=1});
