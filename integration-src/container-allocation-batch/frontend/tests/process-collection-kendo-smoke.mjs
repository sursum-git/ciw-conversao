import assert from 'node:assert/strict';
import path from 'node:path';
import fs from 'node:fs';
import {chromium} from 'file:///D:/opencode/construtor-pg/node_modules/playwright/index.mjs';
const root=path.resolve(import.meta.dirname || path.dirname(new URL(import.meta.url).pathname.replace(/^\/([A-Z]:)/,'$1')),'../../../..');
const candidate=path.join(root,'integration-src/container-allocation-batch/frontend');
const browser=await chromium.launch({headless:true,channel:'msedge'});
try {
  const page=await browser.newPage(); const errors=[]; page.on('pageerror',e=>errors.push(e.message));
  await page.setContent('<div id="root"></div>');
  for (const file of ['vendor/jquery/jquery-4.0.0.min.js','kendo/js/kendo.all.min.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudConfigLoader.js','src/process-engine/ProcessDefinitionLoader.js','src/process-engine/ProcessDefinitionValidator.js','src/process-engine/ProcessEngine.js']) {
    const local=file.includes('ProcessEngine.js')||file.includes('ProcessDefinitionValidator.js')?path.join(candidate,file):path.join('D:/opencode/construtor-pg',file);
    await page.addScriptTag({path:local});
  }
  const definition=JSON.parse(fs.readFileSync(path.join(root,'.runtime/container-allocation-batch-20261026/process-metadata-preview.json'),'utf8'));
  const result=await page.evaluate(async definition=>{
    const sent=[]; let releaseOptions;
    definition.dataSource.api.process={url:'/registered/run',method:'POST'};
    definition.dataSource.api['options.item_ids']={url:'/registered/options',method:'POST'};
    const engine=new ProcessEngine({root:'#root',definition,config:{},contextValues:{container_id:'17'},httpClient:{request:async req=>{
      sent.push(req);
      if(req.url==='/registered/options') return new Promise(resolve=>{releaseOptions=()=>resolve({data:[{value:11,text:'Pedido 1 | <img src=x onerror=bad()> | saldo 40'},{value:12,text:'Pedido 2 | ERP12 | saldo 30'}]});});
      return {ok:true,status:'succeeded',result:{type:'message',message:'Confirmado'}};
    }}});
    await engine.init();
    await engine.execute();
    const blockedWhileLoading=sent.length===1;
    releaseOptions(); await engine.optionsPromise;
    const widget=engine.fieldWidgets.item_ids;
    widget.value([11,12]); const selected=engine.collectParameters();
    CrudUtils.confirm=async()=>false; await engine.execute(); const canceled=sent.length===1;
    CrudUtils.confirm=async()=>true; await engine.execute();
    const payload=sent[1]?.data;
    const native=widget instanceof kendo.ui.MultiSelect;
    const escaped=$('#root img').length===0;
    const callsOnOpen=sent.filter(x=>x.url==='/registered/options').length;
    engine.destroy();
    return {native,escaped,selected,payload,blockedWhileLoading,canceled,callsOnOpen,sent:sent.length};
  },definition);
  assert.equal(result.native,true);assert.equal(result.escaped,true);assert.equal(result.blockedWhileLoading,true);assert.equal(result.canceled,true);
  assert.equal(result.callsOnOpen,1);assert.equal(result.sent,2);
  assert.deepEqual(result.selected.values.item_ids,[11,12]);assert.deepEqual(result.payload.parameters.item_ids,[11,12]);assert.equal(result.payload.context.container_id,17);
  assert.deepEqual(errors,[]);
  console.log('PASS real Kendo MultiSelect, escaped labels, loading gate, cancel without POST, fixed context and integer IDs');
} finally {await browser.close();}
