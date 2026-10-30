'use strict';
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),{spawnSync}=require('node:child_process');
const {createRequire}=require('node:module'),{chromium}=createRequire('D:/opencode/construtor-pg/package.json')('playwright');
const state=path.resolve(__dirname,'../../.runtime/construtor-pg'),marker='CODEx-LOG-UI-'+Date.now();
(async()=>{
 const password=fs.readFileSync(path.join(state,'acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const integration=JSON.parse(fs.readFileSync(path.join(state,'despesas-connection.json'),'utf8').replace(/^\uFEFF/,''));
 const browser=await chromium.launch({channel:'msedge',headless:true}),page=await browser.newPage({viewport:{width:1540,height:1080}}),errors=[];
 page.on('pageerror',e=>errors.push(e.message));let owned,before;
 const api=(screen,op,data)=>page.evaluate(async({screen,op,data})=>{
  const r=await window.productionCrudEngine.httpClient.request({url:'/api/runtime/screens/'+screen+'/endpoints/'+op,method:'POST',data});
  return r.data&&!Array.isArray(r.data)?r.data:r;
 },{screen,op,data});
 try{
  await page.goto('http://127.0.0.1:8765/production/login.html?noRemember=1');
  await page.locator('#login-user').fill('admin');await page.locator('#login-password').fill(password);await page.locator('#login-submit').click();
  await page.getByRole('button',{name:/administrativa/i}).click({timeout:20000});await page.waitForURL(/\/production\/home\.html/,{timeout:20000});
  await page.goto('http://127.0.0.1:8765/production/app.html?screenId=ciw.despesas');
  await page.waitForFunction(()=>window.productionCrudEngine?.gridRenderer?.grid&&document.querySelector('[data-render-state="ready"]'),null,{timeout:25000});
  before=(await api('ciw.despesas','read',{take:500})).data;
  owned=await api('ciw.despesas','create',{record:{descricao:marker,log_imposto:0,md_relacs_desp:[]}});
  fs.writeFileSync(path.join(state,'logs-form-test-ownership.json'),JSON.stringify({marker,id:owned.despesa_id,cleanup:false},null,2));
  const requestHeaders=await page.evaluate(()=>{const c=window.productionCrudEngine.httpClient;return {Authorization:'Bearer '+c.authToken,'X-Runtime-Auth-Token':c.authToken,'X-Runtime-Tenant-Id':c.tenantId,'X-Runtime-User-Id':c.userId,'X-Runtime-Session-Id':c.sessionId};});
  const probes=[];
  for(const mode of ['success','rollback']){
   const input={url:'http://127.0.0.1:19910/med/web/SursumPrograms/program-log-verificar',headers:{'X-Despesas-Token':integration.integrationToken},requestHeaders,payload:{mode},screenId:'ciw.despesas',programId:'cd0092',recordId:owned.despesa_id};
   const run=spawnSync('php',[path.join(__dirname,'probe-progress-log-bridge.php')],{cwd:'D:/opencode/construtor-pg/backend',input:JSON.stringify(input),encoding:'utf8',timeout:40000});
   assert.equal(run.status,0,'Harness PHP falhou: '+(run.stderr||'').slice(0,700));
   const evidence=JSON.parse(run.stdout);
   fs.writeFileSync(path.join(state,'logs-bridge-harness-last.json'),JSON.stringify(evidence,null,2));
   assert.equal(evidence.errorCode,mode==='rollback'?'PROBE_ROLLBACK':null);
   const progress=evidence.logs.filter(x=>x.eventType.startsWith('progress.log.'));
   assert.equal(progress.length,mode==='rollback'?2:1,JSON.stringify(evidence));assert.ok(progress.every(x=>x.currentUser==='admin'));
   assert.ok(progress.every(x=>typeof x.occurredAt==='string'&&x.occurredAt.length>0),'Instante original Progress ausente');
   probes.push({mode,transactionId:evidence.transactionId,progressEvents:progress.length});
  }
  await page.evaluate(async id=>{const e=window.productionCrudEngine;await e.openRecord('view',id);await e.formRenderer.optionsReady;},owned.despesa_id);
  const logButton=page.locator('.crud-form-header-appbar').getByRole('button',{name:'Logs',exact:true});
  await logButton.waitFor();await logButton.click();
  const iframe=page.locator('iframe.crud-log-frame').last();await iframe.waitFor();
  const src=await iframe.getAttribute('src');assert.ok(src.includes('admin.transacoes'));assert.ok(src.includes('filter__record_id='+owned.despesa_id));
  const transactions=await (await iframe.elementHandle()).contentFrame();
  await transactions.waitForFunction(()=>window.productionCrudEngine?.gridRenderer?.grid&&document.querySelector('[data-render-state="ready"]'),null,{timeout:25000});
  const transactionRows=await transactions.evaluate(()=>Array.from(window.productionCrudEngine.gridRenderer.grid.dataSource.data()).map(x=>({id:x.id,recordId:x.record_id,screenId:x.screen_id})));
  assert.ok(transactionRows.length);assert.ok(transactionRows.every(x=>String(x.recordId)===String(owned.despesa_id)&&x.screenId==='ciw.despesas'));
  const target=probes.find(x=>x.mode==='rollback');
  await transactions.locator('a.crud-row-link[href*="context__transaction_id='+target.transactionId+'"]').getByText('Logs',{exact:true}).click();
  await transactions.waitForURL(/screenId=admin.logs-transacoes/,{timeout:20000});
  await transactions.waitForFunction(()=>window.productionCrudEngine?.definition?.screenId==='admin.logs-transacoes'&&window.productionCrudEngine.gridRenderer?.grid&&document.querySelector('[data-render-state="ready"]'),null,{timeout:25000});
  const events=await transactions.evaluate(()=>Array.from(window.productionCrudEngine.gridRenderer.grid.dataSource.data()).map(x=>({id:x.id,transaction_id:x.transaction_id,event_type:x.event_type,message:x.message})));
  assert.ok(events.every(x=>Number(x.transaction_id)===target.transactionId));
  assert.equal(events.filter(x=>x.event_type.startsWith('progress.log.')).length,2);
  assert.ok(events.some(x=>x.message.includes('ação dentro da transação')));
  await page.screenshot({path:path.join(state,'logs-form-transacao.png'),fullPage:true});
  assert.deepEqual(errors,[]);
  fs.writeFileSync(path.join(state,'logs-form-ui-evidence.json'),JSON.stringify({at:new Date().toISOString(),formButton:true,transactionsFiltered:true,rowLink:true,progressEventsInNativeViewer:true,probes,errors},null,2));
  console.log('PASS: botao Logs do formulario, transacoes do registro, link de eventos e logs ABL de sucesso/rollback no frontend existente.');
 }catch(error){try{await page.screenshot({path:path.join(state,'logs-form-ui-failure.png'),fullPage:true});}catch{}throw error;}
 finally{
  try{
   if(owned){await api('ciw.despesas','delete',{id:owned.despesa_id});const after=(await api('ciw.despesas','read',{take:500})).data;
    assert.deepEqual(after.slice().sort((a,b)=>a.despesa_id-b.despesa_id),before.slice().sort((a,b)=>a.despesa_id-b.despesa_id));
    fs.writeFileSync(path.join(state,'logs-form-test-ownership.json'),JSON.stringify({marker,id:owned.despesa_id,cleanup:true},null,2));console.log('PASS: registro novo de teste removido; despesas anteriores preservadas.');}
   if(await page.evaluate(()=>Boolean(window.productionCrudEngine)))await page.evaluate(()=>window.productionCrudEngine.httpClient.logout());
  }finally{await browser.close();}
 }
})().catch(e=>{console.error(e.stack||e.message);process.exitCode=1;});
