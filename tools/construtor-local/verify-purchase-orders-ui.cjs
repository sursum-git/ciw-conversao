// Readonly UI regression: native header editor, stamp, tabs and contextual payments.
const c=require('./purchase-orders-metadata-common.cjs'),{createRequire}=require('node:module');
const {chromium}=createRequire('D:/opencode/construtor-pg/package.json')('playwright');
async function main(){
 let password=c.fs.readFileSync(c.path.join(c.root,'.runtime/construtor-pg/acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial='))?.slice(14);c.assert.ok(password);
 const browser=await chromium.launch({channel:'msedge',headless:true}),context=await browser.newContext({viewport:{width:1500,height:1200}}),page=await context.newPage(),errors=[],blocked=[];
 page.on('pageerror',e=>errors.push(e.message));
 await context.route('**/api/runtime/screens/**/endpoints/**',async route=>{const endpoint=route.request().url().split('/endpoints/')[1]?.split('?')[0];if(['create','update','delete','batch','process'].includes(endpoint)){blocked.push(endpoint);await route.abort('blockedbyclient');}else await route.continue();});
 let authenticated=false,proof;
 try{
  await page.goto(c.base+'/production/login.html?noRemember=1');await page.locator('#login-user').fill('admin');await page.locator('#login-password').fill(password);password=undefined;await page.locator('#login-submit').click();
  await page.getByRole('button',{name:/administrativa/i}).click({timeout:20000});await page.waitForURL(/\/production\/home\.html/,{timeout:20000});authenticated=true;
  await page.goto(c.base+'/production/app.html?screenId=ciw.processos-compra-med');await page.waitForFunction(()=>window.productionCrudEngine?.gridRenderer?.grid&&document.querySelector('[data-render-state="ready"]'),null,{timeout:30000});
  const grid=await page.evaluate(()=>{const e=window.productionCrudEngine,g=e.gridRenderer.grid,r=g.dataSource.data()[0];return{title:e.definition.program.title,total:g.dataSource.total(),pageSize:g.dataSource.pageSize(),id:r?.proc_compra_id,stamp:r?.row_stamp,logs:e.getLogsConfig()};});c.assert.ok(grid.title.includes('MED'));c.assert.ok(grid.total>0);c.assert.equal(grid.pageSize,50);c.assert.match(grid.stamp,/^[A-F0-9]{64}$/);c.assert.equal(grid.logs.mode,'deletions');c.assert.equal(grid.logs.requiresRecord,false);
  await page.screenshot({path:c.path.join(c.state,'ui-purchase-orders-grid.png'),fullPage:true});
  await page.evaluate(id=>window.productionCrudEngine.openRecord('edit',id),grid.id);await page.waitForFunction(()=>window.productionCrudEngine.formRenderer?.data?.row_stamp);
  // The form receives the whole normalized definition. Its top-level logs are
  // program 'Logs Exclusão'; the native form resolver reads form.logs instead.
  const edit=await page.evaluate(()=>{const e=window.productionCrudEngine,f=e.formRenderer,v=f.collectAllValues();return {id:v.proc_compra_id,stamp:v.row_stamp,companyReadonly:f.inputs.empresa_id.readonly,pkReadonly:f.inputs.proc_compra_id.readonly,daysDecimals:f.inputs.qt_dias_translado.input.data('kendoNumericTextBox')?.options.decimals,tabs:e.definition.form.tabs.map(t=>({id:t.id,title:t.title,type:t.type})),logs:f.getLogsConfig(),canOpenRecordLogs:f.canOpenCurrentRecordLogs()};});
  c.assert.equal(edit.id,grid.id);c.assert.equal(edit.stamp,grid.stamp);c.assert.equal(edit.companyReadonly,true);c.assert.equal(edit.pkReadonly,true);c.assert.equal(edit.daysDecimals,0);c.assert.ok(edit.tabs.some(x=>x.title==='Observação'));c.assert.equal(edit.logs.mode,'recordEvents');c.assert.equal(edit.logs.requiresRecord,true);c.assert.equal(edit.logs.documentId,'runtime.transaction-events');c.assert.equal(edit.canOpenRecordLogs,true);
  await page.waitForTimeout(400);await page.screenshot({path:c.path.join(c.state,'ui-purchase-orders-edit.png'),fullPage:true});
  await page.getByRole('tab',{name:'Observação',exact:true}).click();await page.waitForTimeout(300);await page.screenshot({path:c.path.join(c.state,'ui-purchase-orders-observation.png'),fullPage:true});
  await page.getByRole('tab',{name:'Pagamentos',exact:true}).click();await page.waitForFunction(()=>Object.values(window.productionCrudEngine.formRenderer.linkedPageEngines).some(x=>x.engine?.definition?.program?.id==='op1013'&&x.engine?.gridRenderer?.grid),null,{timeout:30000});
  const linked=await page.evaluate(()=>{const x=Object.values(window.productionCrudEngine.formRenderer.linkedPageEngines).find(x=>x.engine?.definition?.program?.id==='op1013').engine;return{screen:x.options.screenId,context:x.contextValues,total:x.gridRenderer.grid.dataSource.total()};});c.assert.equal(linked.screen,'ciw.proc-compra-pagamentos');c.assert.equal(linked.context.proc_compra_id,grid.id);
  await page.waitForTimeout(300);await page.screenshot({path:c.path.join(c.state,'ui-purchase-orders-payments.png'),fullPage:true});await page.evaluate(()=>window.productionCrudEngine.formRenderer.close(true));
  await page.getByRole('button',{name:'Incluir',exact:true}).click();await page.waitForFunction(()=>window.productionCrudEngine.formRenderer?.mode==='create');
  const create=await page.evaluate(()=>{const f=window.productionCrudEngine.formRenderer,v=f.collectAllValues();return {status:v.cod_situacao,days:v.qt_dias_translado,contact:v.log_facilid_contato_fornec,forecast:v.log_considerar_previsao,id:v.proc_compra_id??null,stamp:v.row_stamp??null,registration:v.dt_registro,limit:v.dt_limite};});
  c.assert.equal(create.status,1);c.assert.equal(create.days,0);c.assert.equal(create.contact,true);c.assert.equal(create.forecast,true);c.assert.ok(create.id===null||create.id==='');c.assert.ok(create.stamp===null||create.stamp==='');
  await page.waitForTimeout(350);await page.screenshot({path:c.path.join(c.state,'ui-purchase-orders-create.png'),fullPage:true});await page.evaluate(()=>window.productionCrudEngine.formRenderer.close(true));
  c.assert.deepEqual(errors,[]);c.assert.deepEqual(blocked,[]);
  proof={success:true,at:new Date().toISOString(),browser:'isolated-msedge-headless',ownSession:true,grid,edit,linkedPayments:linked,createDefaults:create,readonlyCompanyAndId:true,nativeIntegerEditor:true,hiddenStampPreserved:true,logsRecordEvents:true,programLogsDeletions:true,pageErrors:errors,blockedMutationAttempts:blocked,businessWrites:false,saved:false,deleted:false};
 }catch(e){await page.screenshot({path:c.path.join(c.state,'ui-purchase-orders-failure.png'),fullPage:true}).catch(()=>{});throw e;}
 finally{if(authenticated)await page.evaluate(()=>window.productionCrudEngine.httpClient.logout()).catch(()=>{});await browser.close();}
 c.save('metadata-ui-verification.json',{...proof,ownSessionLoggedOut:true,browserClosed:true});console.log('PASS: native header UI,stamp,defaults,tabs and contextual payments; no business writes.');
}
if(require.main===module)main().catch(e=>{console.error(e.message);process.exitCode=1;});
