'use strict';
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const {createRequire}=require('node:module');
const {chromium}=createRequire('D:/opencode/construtor-pg/package.json')('playwright');
const state=path.resolve(__dirname,'../../.runtime/construtor-pg');
(async()=>{
 const browser=await chromium.launch({channel:'msedge',headless:true});
 const page=await browser.newPage({viewport:{width:1600,height:1050}});
 const errors=[];page.on('pageerror',e=>errors.push(e.message));
 try{
  await page.goto('http://127.0.0.1:19910/med/pasoe-request-monitor/index.html');
  await page.waitForFunction(()=>window.jQuery?.('#executionGrid').data('kendoGrid'),null,{timeout:25000});
  await page.locator('#baseUrlInput').fill('/med/web/SursumDynamicQuery');
  await page.locator('#endpointInput').fill('empresas');
  await page.locator('#refreshButton').click();
  await page.waitForFunction(()=>window.jQuery('#executionGrid').data('kendoGrid').dataSource.view()
   .some(row=>row.userName==='admin'&&row.pasoeAgent&&row.pasoeInstance==='sursum-api'),null,{timeout:20000});
  const selected=await page.evaluate(()=>{
   const grid=window.jQuery('#executionGrid').data('kendoGrid');
   const item=grid.dataSource.view().find(row=>row.userName==='admin'&&row.pasoeAgent&&row.pasoeInstance==='sursum-api');
   grid.select(grid.tbody.find('tr[data-uid="'+item.uid+'"]'));grid.trigger('change');
   return {executionId:item.executionId,userName:item.userName,agent:item.pasoeAgent,instance:item.pasoeInstance,
    columns:grid.columns.map(column=>column.field).filter(Boolean)};
  });
  assert.ok(selected.columns.includes('pasoeAgent'));assert.ok(selected.columns.includes('pasoeInstance'));
  await page.waitForFunction(()=>document.querySelector('#detailList').textContent.includes('sursum-api'),null,{timeout:10000});
  const detail=await page.locator('#detailList').innerText();
  assert.ok(detail.includes(selected.agent));assert.ok(detail.includes('admin'));
  assert.equal(errors.length,0,errors.join(';'));
  await page.screenshot({path:path.join(state,'pasoe-identidade-monitor.png'),fullPage:true});
  fs.writeFileSync(path.join(state,'pasoe-monitor-evidence.json'),JSON.stringify({at:new Date().toISOString(),...selected,errors},null,2));
  console.log('PASS: monitor publicado exibe usuário, PID, agente e instância na consulta e nos detalhes.');
 }finally{await browser.close();}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
