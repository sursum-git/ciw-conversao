const fs=require('fs'),path=require('path'),assert=require('assert/strict');
const{chromium}=require('D:/opencode/construtor-pg/node_modules/playwright');
const repo='D:/opencode/construtor-pg',state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-expense-default-selection';
(async()=>{const browser=await chromium.launch({headless:true,channel:'msedge'});try{
 const page=await browser.newPage(),errors=[];page.on('pageerror',e=>errors.push(e.message));await page.setContent('<div id="root"></div>');
 for(const file of ['vendor/jquery/jquery-4.0.0.min.js','kendo/js/kendo.all.min.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudConfigLoader.js','src/process-engine/ProcessDefinitionLoader.js','src/process-engine/ProcessDefinitionValidator.js','src/process-engine/ProcessEngine.js'])await page.addScriptTag({path:path.join(fs.existsSync(path.join(state,'native',file))?path.join(state,'native'):repo,file)});
 const raw=JSON.parse(fs.readFileSync(state+'/native-preview.json','utf8'));
 const result=await page.evaluate(async raw=>{
  const d=CrudUtils.clone(raw);d.permissions={read:true,process:true};d.dataSource.api.process={url:'/apply',method:'POST'};d.dataSource.api['options.despesa_ids']={url:'/options',method:'POST'};
  CrudUtils.showMessage=()=>{};const requests=[],pending=[],writes=[];let auto=true;
  const rows=[{value:40,text:'A'},{value:41,text:'B'}],client={request:async r=>{if(r.url==='/apply'){writes.push(r.data);return{ok:true,status:'succeeded',audit:{available:false},result:{type:'message',message:'Confirmado. Nao repita.'}};}requests.push(r.data);if(auto)return{data:rows};return await new Promise((resolve,reject)=>pending.push({resolve,reject}));}};
  const e=await new ProcessEngine({root:'#root',definition:d,config:{},contextValues:{container_id:'123'},httpClient:client}).init();await e.optionsPromise;
  const opening=writes.length,initial=requests[0];const empty=await e.execute();e.fieldWidgets.despesa_ids.value([41,40]);
  auto=false;e.fieldWidgets.ordem_direcao.value('desc');e.fieldWidgets.ordem_direcao.trigger('change');const loadingBlocked=await e.execute();
  e.fieldWidgets.ordem_direcao.value('asc');e.fieldWidgets.ordem_direcao.trigger('change');pending[1].resolve({data:rows});await e.optionsPromise;pending[0].resolve({data:[rows[1],rows[0]]});await new Promise(r=>setTimeout(r,0));
  const finalOrder=e.fieldWidgets.despesa_ids.dataSource.data().map(x=>x.value),finalLoading=e.optionsLoading;
  const confirmation=e.execute();await Promise.resolve();e.fieldWidgets.ordem_direcao.value('desc');e.fieldWidgets.ordem_direcao.trigger('change');$('.crud-confirm-content button').filter((_,b)=>$(b).text()==='Gerar despesas').trigger('click');await confirmation;const confirmationRaceWrites=writes.length;
  pending[2].resolve({data:[rows[1],rows[0]]});await e.optionsPromise;e.fieldWidgets.despesa_ids.value([40,41]);
  const cancel=e.execute();await Promise.resolve();$('.crud-confirm-content button').filter((_,b)=>$(b).text()==='Cancelar').trigger('click');await cancel;const cancelWrites=writes.length;
  const apply=e.execute();await Promise.resolve();$('.crud-confirm-content button').filter((_,b)=>$(b).text()==='Gerar despesas').trigger('click');await apply;const text=e.resultContent.text();e.destroy();
  let missing=false;try{await new ProcessEngine({root:'#root',definition:d,config:{},contextValues:{},httpClient:client}).init();}catch{missing=true;}
  const legacy=CrudUtils.clone(d);delete legacy.process.parameters.fields.find(f=>f.field==='despesa_ids').optionsSource.parameterFields;auto=true;const before=requests.length;
  const old=await new ProcessEngine({root:'#root',definition:legacy,config:{},contextValues:{container_id:123},httpClient:client}).init();await old.optionsPromise;const legacyPayload=requests[before];old.destroy();
  const invalid=await new ProcessEngine({root:'#root',definition:d,config:{},contextValues:{container_id:123},httpClient:client}).init();await invalid.optionsPromise;
  const priorInvalid=requests.length;let enumNoThrow=true;invalid.fieldWidgets.ordem_campo.value('unknown');try{invalid.fieldWidgets.ordem_campo.trigger('change');}catch{enumNoThrow=false;}await invalid.optionsPromise;const enumBlocked=await invalid.execute(),enumFailed=invalid.optionsFailed,invalidTransport=requests.length-priorInvalid;invalid.destroy();
  return{opening,initial,empty,loadingBlocked,finalOrder,finalLoading,confirmationRaceWrites,cancelWrites,writes,text,missing,legacyPayload,requests,enumNoThrow,enumBlocked,enumFailed,invalidTransport};
 },raw);
 assert.equal(result.opening,0);assert.deepEqual(result.initial,{context:{container_id:123},parameters:{ordem_campo:'ordem',ordem_direcao:'asc'}});assert.equal(result.empty,false);assert.equal(result.loadingBlocked,false);assert.deepEqual(result.finalOrder,[40,41]);assert.equal(result.finalLoading,false);assert.equal(result.confirmationRaceWrites,0);assert.equal(result.cancelWrites,0);assert.equal(result.writes.length,1);assert.deepEqual(result.writes[0].context,{container_id:123});assert.deepEqual(result.writes[0].parameters,{ordem_campo:'ordem',ordem_direcao:'desc',despesa_ids:[40,41],container_id:123});assert.match(result.text,/Nao repita/);assert.equal(result.missing,true);assert.deepEqual(result.legacyPayload,{context:{container_id:123}});assert.deepEqual(errors,[]);
 assert.equal(result.enumNoThrow,true);assert.equal(result.enumBlocked,false);assert.equal(result.enumFailed,true);assert.equal(result.invalidTransport,0);
 console.log('PASS native real selection/enums/async stale response/confirm race/context/legacy payload/invalid enum checks=19');
}finally{await browser.close();}})().catch(e=>{console.error(e);process.exitCode=1;});
