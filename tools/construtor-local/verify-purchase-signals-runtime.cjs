'use strict';
const c=require('./purchase-payments-builder-common.cjs'),state=c.path.join(c.root,'.runtime/purchase-signals-20261027');
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
c.session(async({api,runtime})=>{
 const pre=c.readJson(c.path.join(state,'preflight.json')),ctx=c.readJson(c.path.join(state,'readonly-context.json'));
 const source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;c.assert.equal(source.operations.length,105);for(const old of c.readJson(c.path.join(state,'source-registry-before.json')).operations)c.assert.deepEqual(source.operations.find(x=>x.code===old.code),old);
 const child=await runtime('ciw.proc-compra-alertas'),parent=await runtime('ciw.processos-compra-med');
 c.assert.equal(parent.program.version,'1.0.7');c.assert.equal(parent.crud.form.tabs.length,10);c.assert.deepEqual(parent.crud.form.tabs.slice(0,9),pre.parent.crud.form.tabs);c.assert.deepEqual(parent.program.logs,pre.parent.program.logs);c.assert.deepEqual(parent.crud.form.logs,pre.parent.crud.form.logs);c.assert.equal(parent.crud.form.logs.mode,'recordEvents');c.assert.equal(parent.program.logs.mode,'deletions');
 c.assert.equal(child.program.version,'1.0.0');c.assert.equal(Object.keys(child.dataModel.fields).length,16);for(const key of ['create','edit','delete'])c.assert.equal(child.permissions[key],false);
 const page=await runtime('ciw.proc-compra-alertas/endpoints/read',{context:ctx,take:200,skip:0});c.assert.ok(page.total>0);c.assert.deepEqual(page.data,c.readJson(c.path.join(state,'pasoe-rows-private.json')).data);
 const row=page.data[0],detail=await runtime('ciw.proc-compra-alertas/endpoints/get',{context:ctx,id:row.record_key});c.assert.deepEqual(detail.data??detail,row);
 c.assert.deepEqual((await api('/entities/procs_compra_med_progress')).entity,c.readJson(c.path.join(state,'parent-entity-before.json')),'PARENT_ENTITY_CHANGED');
 save('published-definitions.json',{child,parent});save('native-read-proof.json',{success:true,sourceOperations:105,previousOperationsPreserved:103,parentVersion:'1.0.7',parentTabs:10,previousTabsPreserved:9,readGet:true,parentLogsPreserved:true,deletionMode:true,recordEventsMode:true,rows:page.total,businessWrites:false,userPermissionsChanged:false});console.log('PASS native runtime alerts read/get;parent10tabs/9preserved; record/deletion logs preserved;103old operations intact');
},{readOnly:true}).catch(e=>{console.error(e.message);process.exitCode=1;});
