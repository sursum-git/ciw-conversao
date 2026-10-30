const fs=require('fs'),path=require('path'),assert=require('assert/strict'),{chromium}=require('D:/opencode/construtor-pg/node_modules/playwright');
const repo='D:/opencode/construtor-pg',state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/item-cost-manual';
(async()=>{const browser=await chromium.launch({headless:true,channel:'msedge'});try{
 const page=await browser.newPage(),errors=[];page.on('pageerror',e=>errors.push(e.message));await page.setContent('<div id="root"></div>');
 for(const f of ['vendor/jquery/jquery-4.0.0.min.js','kendo/js/kendo.all.min.js','src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudKendoFormRenderer.js','src/crud-engine/CrudKendoGridRenderer.js','src/crud-engine/CrudEngine.js','src/crud-engine/CrudDefinitionValidator.js'])await page.addScriptTag({path:path.join(repo,f)});
 const def=JSON.parse(fs.readFileSync(state+'/native-preview.json','utf8')),body=JSON.parse(fs.readFileSync(state+'/local/manual-read-actual.json','utf8'));
 const result=await page.evaluate(async({def,body})=>{
  const d=new PageDefinitionNormalizer().normalize(def);d.permissions={read:true,create:false,edit:false,delete:false};d.api={read:{url:'/manual-read',method:'POST'},get:{url:'/manual-get',method:'POST'}};d.dataSource.api=d.api;
  const calls=[],writes=[];CrudUtils.showMessage=()=>{};const client={request:async req=>{calls.push(req);if(req.url==='/manual-read')return{data:body.data,total:body.total};if(req.url==='/manual-get')return body.data.find(r=>r.record_key===req.data.id);writes.push(req);throw Error('writer not allowed');}};
  const renderer=new CrudKendoGridRenderer({definition:d,httpClient:client});renderer.render($('#root'));await renderer.waitForInitialRead();
  const form=new CrudKendoFormRenderer({definition:d,httpClient:client}),e=Object.create(CrudEngine.prototype);e.definition=d;e.contextValues={};e.httpClient=client;e.gridRenderer=renderer;e.formRenderer=form;
  const row=await e.openRecord('view',body.data[0].record_key);await form.optionsReady;
  const fieldCount=Object.keys(form.inputs).length,allReadonly=Object.values(form.inputs).every(f=>f.readonly),rawElements=form.window.wrapper.find('raw,img,script').length,rawValue=form.inputs.memoria_calculo.input?.val()||form.window.wrapper.text(),writeButtons=form.window.wrapper.find('button').filter((_,x)=>/Salvar|Excluir|Incluir/.test($(x).text())).length;
  const rows=renderer.grid.dataSource.total(),key=renderer.grid.dataSource.at(0).record_key,formMode=form.mode;form.close(true);renderer.destroy();
  return{calls,writes,rows,key,row,fieldCount,allReadonly,rawElements,rawValue,writeButtons,formMode};
 },{def,body});
 assert.equal(result.rows,2);assert.equal(result.key,body.data[0].record_key);assert.equal(result.formMode,'view');assert.equal(result.fieldCount,23);assert.equal(result.allReadonly,true);assert.equal(result.rawElements,0);assert.match(result.rawValue,/<raw>/);assert.equal(result.writeButtons,0);assert.equal(result.writes.length,0);assert.equal(result.row.qt_estoque,null);assert.equal(result.calls.filter(r=>r.url==='/manual-get').length,1);assert.deepEqual(result.calls.find(r=>r.url==='/manual-get').data,{record_key:body.data[0].record_key,id:body.data[0].record_key,context:{}});assert.deepEqual(errors,[]);
 fs.writeFileSync(state+'/browser-result.json',JSON.stringify({success:true,checks:13,readonly:true,writes:0},null,2));console.log('PASS native real grid/get/view/raw escaping/readonly checks=13');
}finally{await browser.close();}})().catch(e=>{console.error(e);process.exitCode=1;});
