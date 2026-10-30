'use strict';
const c=require('./purchase-payments-builder-common.cjs'),vm=require('node:vm');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build6-v2');
const scope={console,URL,window:null,jQuery:()=>{throw Error('DOM_NOT_EXPECTED');},location:{href:c.base,origin:c.base}};scope.window=scope;vm.createContext(scope);
for(const f of ['src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudDefinitionValidator.js'])vm.runInContext(c.fs.readFileSync(c.path.join('D:/opencode/construtor-pg',f),'utf8'),scope,{filename:f});
async function main(){
 const receipt=c.readJson(c.path.join(state,'lookup-metadata-publication.json'));c.assert.ok(receipt.success);c.assert.equal(receipt.published.length,3);
 await c.session(async({api,runtime})=>{
  const context={container_id:332526,versao_id:2354},results=[];
  for(const row of receipt.published){
   const screen=await runtime(row.screen);c.assert.equal(screen.program.version,'1.0.1');c.assert.equal(new scope.CrudDefinitionValidator().validate(screen),true);
   c.assert.ok(screen.dataModel.fields[row.fieldAdded]);c.assert.ok(screen.crud.grid.columns.some(x=>x.field===row.fieldAdded));
   for(const action of ['create','edit','delete'])c.assert.equal(screen.permissions[action],false);
   const read=await runtime(row.screen+'/endpoints/read',{context,take:200,skip:0});c.assert.ok(read.data.length>0);
   for(const item of read.data){c.assert.equal(item.container_id,context.container_id);c.assert.equal(item.versao_id,context.versao_id);c.assert.ok(Object.hasOwn(item,row.fieldAdded));}
   const detail=await runtime(row.screen+'/endpoints/get',{context,id:read.data[0].record_key});c.assert.deepEqual(detail.data??detail,read.data[0]);
   const selected=read.data.find(x=>typeof x[row.fieldAdded]==='string'&&x[row.fieldAdded].length);c.assert.ok(selected);
   const filter={logic:'and',filters:[{field:row.fieldAdded,operator:'eq',value:selected[row.fieldAdded]}]};
   const positive=await runtime(row.screen+'/endpoints/read',{context,take:200,skip:0,filter});c.assert.ok(positive.data.length>0);for(const item of positive.data)c.assert.equal(item[row.fieldAdded],selected[row.fieldAdded]);
   filter.filters[0].value='__SC_LABEL_NOT_FOUND_20261028__';const negative=await runtime(row.screen+'/endpoints/read',{context,take:200,skip:0,filter});c.assert.equal(negative.total,0);
   await runtime(row.screen+'/endpoints/read',{context:{container_id:context.container_id},take:200},422);
   results.push({program:row.program,screen:row.screen,version:'1.0.1',field:row.fieldAdded,nativeValidator:true,column:true,readonly:true,read:true,get:true,positiveFilter:true,negativeFilter:true,missingContextRejected:true});
  }
  const source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;c.assert.equal(source.operations.length,132);
  c.fs.writeFileSync(c.path.join(state,'lookup-runtime-proof.json'),JSON.stringify({success:true,results,source132:true,businessWrites:false,humanPermissionsChanged:false},null,2)+'\n');
  console.log('PASS3native history screens1.0.1/labels/columns/read/get/positive-negative filters/context;source132/no business writes');
 },{readOnly:true});
}
main().catch(e=>{console.error(e.message);process.exitCode=1});
