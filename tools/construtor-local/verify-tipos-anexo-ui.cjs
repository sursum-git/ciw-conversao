'use strict';
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const {createRequire}=require('node:module');
const {chromium}=createRequire('D:/opencode/construtor-pg/package.json')('playwright');
const state=path.resolve(__dirname,'../../.runtime/construtor-pg');
(async()=>{
 const marker='CODEx-TIPOS-UI-'+Date.now()+'-';
 const pw=fs.readFileSync(path.join(state,'acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const browser=await chromium.launch({channel:'msedge',headless:true});
 const page=await browser.newPage({viewport:{width:1440,height:1000}}),errors=[],saves=[];
 page.on('pageerror',e=>errors.push(e.message));
 page.on('request',r=>{if(r.url().endsWith('/ciw.tipos-anexo/endpoints/batch'))saves.push(JSON.parse(r.postData()));});
 let ready=false,original;
 const rows=()=>page.evaluate(async()=>{
  const e=window.productionCrudEngine;return (await e.httpClient.request({url:e.definition.api.read.url,method:'POST',data:{take:100000,skip:0}})).data;
 });
 async function setDescription(text){
  await page.evaluate(()=>{
   const r=window.productionCrudEngine.gridRenderer;
   const index=r.grid.columns.findIndex(x=>x.field==='descricao');
   r.grid.editCell(r.grid.tbody.find('tr[data-uid]').first().find('td').eq(index));
  });
  const input=page.locator('.crud-grid input[name="descricao"]');
  await input.fill(text);await input.press('Tab');
 }
 async function waitClean(){await page.waitForFunction(()=>{
  const r=window.productionCrudEngine.gridRenderer;return !r.batchSaving&&!r.hasUnsavedChanges();
 },null,{timeout:30000});}
 try{
  await page.goto('http://127.0.0.1:8765/production/login.html?noRemember=1');
  await page.locator('#login-user').fill('admin');await page.locator('#login-password').fill(pw);await page.locator('#login-submit').click();
  await page.getByRole('button',{name:/administrativa/i}).click({timeout:20000});
  await page.waitForURL(/\/production\/home\.html/,{timeout:20000});
  await page.goto('http://127.0.0.1:8765/production/app.html?screenId=ciw.tipos-anexo');
  await page.waitForFunction(()=>window.productionCrudEngine?.gridRenderer?.grid,null,{timeout:25000});
  await page.waitForFunction(()=>document.querySelector('[data-render-state="ready"]'),null,{timeout:25000});
  ready=true;original=await rows();
  await page.evaluate(async()=>{
   const ds=window.productionCrudEngine.gridRenderer.grid.dataSource;
   ds.pageSize(100);await ds.read();
  });
  const metadata=await page.evaluate(()=>{
   const e=window.productionCrudEngine,r=e.gridRenderer;
   return {batch:r.isBatchMode(),readonly:!r.grid.dataSource.at(0).editable('tipo_anexo_id'),format:r.grid.columns.find(c=>c.field==='tipo_anexo_id').format};
  });
  assert.deepEqual(metadata,{batch:true,readonly:true,format:'{0:n0}'});
  await page.screenshot({path:path.join(state,'tipos-anexo-consulta.png'),fullPage:true});
  const add=page.getByRole('button',{name:'Adicionar linha',exact:true});
  await add.click();await setDescription(marker+'Açã');
  await add.click();await setDescription(marker+'B');
  assert.equal(await page.evaluate(()=>window.productionCrudEngine.gridRenderer.collectBatchChanges().length),2);
  await page.screenshot({path:path.join(state,'tipos-anexo-lote-rascunho.png'),fullPage:true});
  await page.locator('#crud-action-batchSave').click();await waitClean();
  assert.equal(saves.length,1);assert.equal(saves[0].changes.length,2);
  let own=(await rows()).filter(x=>x.descricao?.startsWith(marker));assert.equal(own.length,2);
  const ids=own.map(x=>x.tipo_anexo_id),a=own.find(x=>x.descricao===marker+'Açã'),b=own.find(x=>x.descricao===marker+'B');
  await page.evaluate(id=>{
   const r=window.productionCrudEngine.gridRenderer,row=r.grid.dataSource.get(id),index=r.grid.columns.findIndex(c=>c.field==='descricao');
   r.grid.editCell(r.grid.tbody.find('tr[data-uid="'+row.uid+'"]').find('td').eq(index));
  },a.tipo_anexo_id);
  await page.locator('.crud-grid input[name="descricao"]').fill(marker+'A editado');
  await page.locator('.crud-grid input[name="descricao"]').press('Tab');
  const bUid=await page.evaluate(id=>window.productionCrudEngine.gridRenderer.grid.dataSource.get(id).uid,b.tipo_anexo_id);
  await page.locator('.crud-batch-delete[data-uid="'+bUid+'"]').click();
  await page.locator('#crud-action-batchSave').click();await waitClean();
  assert.equal(saves.length,2);assert.deepEqual(saves[1].changes.map(x=>x.operation).sort(),['delete','update']);
  own=(await rows()).filter(x=>x.descricao?.startsWith(marker));assert.equal(own.length,1);assert.equal(own[0].descricao,marker+'A editado');
  await add.click();await setDescription(marker+'CANCELAR');
  await page.locator('#crud-action-batchCancel').click();
  await page.getByRole('button',{name:'Descartar alteracoes',exact:true}).click();await waitClean();
  assert.equal(saves.length,2);assert.ok(!(await rows()).some(x=>x.descricao===marker+'CANCELAR'));
  assert.equal(errors.length,0,errors.join(';'));
  fs.writeFileSync(path.join(state,'tipos-anexo-ui-evidence.json'),JSON.stringify({at:new Date().toISOString(),originalCount:original.length,metadata,
   realCellEditors:true,twoCreatesOneRequest:true,mixedUpdateDelete:true,cancelWithoutRequest:true,ids,errors},null,2));
  console.log('PASS: grade real editavel, duas inclusoes em um request, alteracao/exclusao conjuntas e cancelamento local.');
 }catch(e){await page.screenshot({path:path.join(state,'tipos-anexo-ui-failure.png'),fullPage:true});throw e;}
 finally{
  try{
   if(ready){
    await page.evaluate(()=>window.productionCrudEngine.gridRenderer.discardBatch());
    const own=(await rows()).filter(x=>x.descricao?.startsWith(marker));
    if(own.length)await page.evaluate(async list=>{
     const e=window.productionCrudEngine;await e.httpClient.request({url:e.definition.api.batch.url,method:'POST',data:{changes:list.map((x,i)=>({operation:'delete',clientId:'cleanup-ui-'+i,id:x.tipo_anexo_id,original:{descricao:x.descricao}}))}});
    },own);
    const after=await rows();assert.ok(!after.some(x=>x.descricao?.startsWith(marker)));
    if(original)assert.deepEqual(after.slice().sort((a,b)=>a.tipo_anexo_id-b.tipo_anexo_id),original.slice().sort((a,b)=>a.tipo_anexo_id-b.tipo_anexo_id));
    console.log('PASS: limpeza concluida; registros originais preservados.');
    await page.evaluate(async()=>{await new window.CrudHttpClient().logout();});
   }
  }finally{await browser.close();}
 }
})().catch(e=>{console.error(e.message);process.exitCode=1;});
