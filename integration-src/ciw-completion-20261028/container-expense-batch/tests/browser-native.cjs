const fs=require('fs'),path=require('path'),vm=require('vm'),assert=require('assert/strict');
const {chromium}=require('D:/opencode/construtor-pg/node_modules/playwright');
const repo='D:/opencode/construtor-pg',native=process.argv[2],state=process.argv[3];
(async()=>{const browser=await chromium.launch({headless:true,channel:'msedge'});try{
 const page=await browser.newPage();await page.setContent('<div id="root"></div>');
 for(const file of ['vendor/jquery/jquery-4.0.0.min.js','kendo/js/kendo.all.min.js','src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudDefinitionValidator.js','src/crud-engine/CrudKendoGridRenderer.js'])await page.addScriptTag({path:path.join(fs.existsSync(path.join(native,file))?native:repo,file)});
 const raw=JSON.parse(fs.readFileSync(path.join(state,'native-preview.json'),'utf8'));
 const result=await page.evaluate(async raw=>{
  const d=new PageDefinitionNormalizer().normalize(raw);new CrudDefinitionValidator().validate(d);d.permissions={read:true,create:false,edit:true,delete:true};d.api={read:{url:'/read'},batch:{url:'/batch',method:'POST'}};CrudUtils.showMessage=()=>{};
  const names=d.grid.editing.snapshot.originalFields,row=Object.fromEntries(names.map(n=>[n,n==='memoria_calculo'?'Memoria preservada':n==='log_manual'?true:n==='log_utilizado'?false:0]));Object.assign(row,{container_id:100,despesa_id:2,despesa_container_id:11});
  const batches=[];let amount=0;const renderer=new CrudKendoGridRenderer({definition:d,contextValues:{container_id:100},httpClient:{request:async request=>{if(request.url==='/batch'){batches.push(request.data);amount=77;return{committed:true,presentationAvailable:false,data:[],total:0};}return{data:[{...row,vl_prev:amount}],total:1};}}});
  renderer.render($('#root'));await renderer.waitForInitialRead();const model=renderer.grid.dataSource.at(0),immutable=!model.editable('despesa_id')&&!model.editable('despesa_container_id');model.set('vl_prev',77);
  const saved=await renderer.saveBatch(),draftCleared=renderer.collectBatchChanges().length===0,second=await renderer.saveBatch();renderer.destroy();return{batches,saved,draftCleared,second,immutable};
 },raw);
 assert.equal(result.saved,true);assert.equal(result.draftCleared,true);assert.equal(result.second,false);assert.equal(result.immutable,true);assert.equal(result.batches.length,1);assert.deepEqual(result.batches[0].context,{container_id:100});assert.equal(Object.keys(result.batches[0].changes[0].original).length,14);assert.deepEqual(Object.keys(result.batches[0].changes[0].data).sort(),['log_manual','vl_base_imp','vl_prev']);
 console.log('PASS real Kendo batch context14/editable3/PK immutable/confirmed presentation invalid discards draft checks=8');
}finally{await browser.close();}})().catch(e=>{console.error(e);process.exitCode=1;});
