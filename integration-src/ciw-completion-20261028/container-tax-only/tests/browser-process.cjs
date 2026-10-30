const fs=require('fs'),path=require('path'),assert=require('assert/strict');
const{chromium}=require('D:/opencode/construtor-pg/node_modules/playwright');
const repo='D:/opencode/construtor-pg',state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-tax-only';
(async()=>{const browser=await chromium.launch({headless:true,channel:'msedge'});try{
 const page=await browser.newPage(),errors=[];page.on('pageerror',e=>errors.push(e.message));await page.setContent('<div id="root"></div>');
 for(const file of ['vendor/jquery/jquery-4.0.0.min.js','kendo/js/kendo.all.min.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudConfigLoader.js','src/process-engine/ProcessDefinitionLoader.js','src/process-engine/ProcessDefinitionValidator.js','src/process-engine/ProcessEngine.js','src/crud-engine/CrudKendoGridRenderer.js'])await page.addScriptTag({path:path.join(repo,file)});
 const raw=JSON.parse(fs.readFileSync(state+'/native-preview.json','utf8'));
 const result=await page.evaluate(async raw=>{
  const d=CrudUtils.clone(raw);d.permissions={read:true,process:true};d.dataSource.api.process={url:'/tax-only',method:'POST'};new ProcessDefinitionValidator().validate(d);CrudUtils.showMessage=()=>{};
  const calls=[];const client={request:async r=>{calls.push(r.data);return{ok:true,status:'succeeded',audit:{available:false},result:{type:'message',message:'Processo confirmado. Nao repita; consulte os logs.'}};}};
  const make=(context,def=d)=>new ProcessEngine({root:'#root',definition:def,config:{},contextValues:context,httpClient:client});
  const e=await make({container_id:'123'}).init();const opening=calls.length,readonly=e.fieldInputs.container_id.prop('readonly');
  e.fieldWidgets.container_id.value(999);const cancelled=e.execute();await Promise.resolve();$('.crud-confirm-content button').filter((_,b)=>$(b).text()==='Cancelar').trigger('click');await cancelled;const afterCancel=calls.length;
  const promise=e.execute();await Promise.resolve();const beforeConfirm=calls.length,confirmText=$('.crud-confirm-content').text();$('.crud-confirm-content button').filter((_,b)=>$(b).text()==='Calcular impostos').trigger('click');await promise;const text=e.resultContent.text();e.destroy();
  let missing=false;try{await make({}).init();}catch{missing=true;}
  const denied=CrudUtils.clone(d);denied.permissions.process=false;const no=await make({container_id:123},denied).init();await no.execute();no.destroy();
  const link=CrudKendoGridRenderer.prototype.buildRowLinkHtml.call({}, {id:'calcular_impostos',screenId:d.screenId,label:'Calcular impostos',parameters:[{field:'container_id',sourceField:'container_id'}]}, {container_id:123});
  return{opening,readonly,afterCancel,beforeConfirm,confirmText,calls,text,missing,link};
 },raw);
 assert.equal(result.opening,0);assert.equal(result.readonly,true);assert.equal(result.afterCancel,0);assert.equal(result.beforeConfirm,0);assert.match(result.confirmText,/Confirma/);assert.equal(result.calls.length,1);assert.deepEqual(result.calls[0].context,{container_id:123});assert.deepEqual(result.calls[0].parameters,{container_id:123});assert.match(result.text,/Nao repita/);assert.equal(result.missing,true);assert.match(result.link,/context__container_id=123/);assert.match(result.link,/ciw.container-calcular-impostos/);assert.deepEqual(errors,[]);
 console.log('PASS real ProcessEngine/Kendo op1043 opening/cancel/confirm/fixedcontext/permission/navigation checks=13');
}finally{await browser.close();}})().catch(e=>{console.error(e);process.exitCode=1;});
