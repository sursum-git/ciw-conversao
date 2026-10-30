'use strict';
const c=require('./purchase-payments-builder-common.cjs'),state=c.path.join(c.root,'.runtime/purchase-allocations-20261026');
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
c.session(async({api,runtime})=>{
 const pre=c.readJson(c.path.join(state,'preflight.json')),ctx=c.readJson(c.path.join(state,'readonly-context.json'));
 const source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;c.assert.equal(source.operations.length,97);for(const old of c.readJson(c.path.join(state,'source-registry-before.json')).operations)c.assert.deepEqual(source.operations.find(x=>x.code===old.code),old);
 const item=await runtime('ciw.proc-compra-itens'),child=await runtime('ciw.proc-compra-alocacoes'),parent=await runtime('ciw.processos-compra-med');
 c.assert.equal(item.program.version,'1.0.3');c.assert.equal(item.crud.form.tabs.length,8);c.assert.deepEqual(item.crud.form.tabs.slice(0,7),pre.item.crud.form.tabs);c.assert.deepEqual(item.program.logs,pre.item.program.logs);c.assert.deepEqual(item.crud.form.logs,pre.item.crud.form.logs);c.assert.equal(item.crud.form.logs.mode,'recordEvents');c.assert.equal(item.program.logs.mode,'deletions');
 c.assert.deepEqual(parent,pre.parent,'MAIN_PANEL_UNCHANGED');c.assert.equal(child.program.version,'1.0.0');c.assert.equal(Object.keys(child.dataModel.fields).length,9);for(const key of ['create','edit','delete'])c.assert.equal(child.permissions[key],false);
 const page=await runtime('ciw.proc-compra-alocacoes/endpoints/read',{context:ctx,take:50,skip:0});c.assert.ok(page.total>0);c.assert.deepEqual(page.data,c.readJson(c.path.join(state,'pasoe-rows-private.json')).data);
 const row=page.data[0];const detail=await runtime('ciw.proc-compra-alocacoes/endpoints/get',{context:ctx,id:String(row.item_container_id)});c.assert.deepEqual(detail.data??detail,row);
 save('published-definitions.json',{item,child,parent});save('native-read-proof.json',{success:true,sourceOperations:97,previousOperationsPreserved:95,itemVersion:'1.0.3',itemTabs:8,previousTabsPreserved:7,parentVersionUnchanged:'1.0.6',readGet:true,itemLogsPreserved:true,deletionMode:true,recordEventsMode:true,rows:page.total,businessWrites:false,userPermissionsChanged:false});console.log('PASS native runtime read/get; item8tabs/7preserved; existing record/deletion logs preserved;95old operations intact');
},{readOnly:true}).catch(e=>{console.error(e.message);process.exitCode=1;});
