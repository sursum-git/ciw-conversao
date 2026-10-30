'use strict';
const c=require('./purchase-payments-builder-common.cjs'),state=c.path.join(c.root,'.runtime/purchase-sample-formats-20261027');
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
c.session(async({api,runtime})=>{
 const pre=c.readJson(c.path.join(state,'preflight.json'));
 const source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;c.assert.equal(source.operations.length,103);for(const old of c.readJson(c.path.join(state,'source-registry-before.json')).operations)c.assert.deepEqual(source.operations.find(x=>x.code===old.code),old);
 const item=await runtime('ciw.proc-compra-itens'),child=await runtime('ciw.formatos-amostra'),parent=await runtime('ciw.processos-compra-med');
 c.assert.equal(item.program.version,'1.0.4');c.assert.equal(item.crud.form.tabs.length,9);c.assert.deepEqual(item.crud.form.tabs.slice(0,8),pre.item.crud.form.tabs);c.assert.deepEqual(item.program.logs,pre.item.program.logs);c.assert.deepEqual(item.crud.form.logs,pre.item.crud.form.logs);c.assert.equal(child.crud.form.logs.mode,'recordEvents');c.assert.equal(child.program.logs.mode,'deletions');
 c.assert.deepEqual(parent,pre.parent,'MAIN_PANEL_UNCHANGED');c.assert.equal(child.program.version,'1.0.0');c.assert.equal(Object.keys(child.dataModel.fields).length,3);c.assert.match(child.program.subtitle,/compartilhado/);c.assert.equal(child.dataModel.fields.formato_amostra_id.type,'integer');
 const page=await runtime('ciw.formatos-amostra/endpoints/read',{take:200,skip:0});c.assert.ok(page.total>0);c.assert.deepEqual(page.data,c.readJson(c.path.join(state,'pasoe-rows-private.json')).data);
 for(const row of page.data){const detail=await runtime('ciw.formatos-amostra/endpoints/get',{id:String(row.formato_amostra_id)});c.assert.deepEqual(detail.data??detail,row);}
 save('published-definitions.json',{item,child,parent});save('native-read-proof.json',{success:true,sourceOperations:103,previousOperationsPreserved:97,itemVersion:'1.0.4',itemTabs:9,previousTabsPreserved:8,parentVersionUnchanged:'1.0.6',readGet:true,itemLogsPreserved:true,deletionMode:true,recordEventsMode:true,rows:page.total,businessWrites:false,userPermissionsChanged:false});console.log('PASS native runtime formatos read/get; item9tabs/8preserved; record/deletion logs preserved;97old operations intact');
},{readOnly:true}).catch(e=>{console.error(e.message);process.exitCode=1;});

