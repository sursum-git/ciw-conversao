// Edge headless isolado: navegação e abertura do formulário; nenhuma ação de negócio.
const c=require('./purchase-payments-builder-common.cjs'),{createRequire}=require('node:module');
const {chromium}=createRequire('D:/opencode/construtor-pg/package.json')('playwright');
async function main(){
 let password=c.fs.readFileSync(c.path.join(c.root,'.runtime/construtor-pg/acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial='))?.slice(14);c.assert.ok(password);
 const browser=await chromium.launch({channel:'msedge',headless:true}),context=await browser.newContext({viewport:{width:1480,height:1400}}),page=await context.newPage(),errors=[],blockedMutations=[];
 const watch=p=>p.on('pageerror',error=>errors.push(error.message));watch(page);context.on('page',watch);
 await context.route('**/api/runtime/screens/**/endpoints/**',async route=>{const endpoint=route.request().url().split('/endpoints/')[1]?.split('?')[0];if(['create','update','delete','batch','process'].includes(endpoint)){blockedMutations.push(endpoint);await route.abort('blockedbyclient');}else await route.continue();});
 let child=page,authenticated=false;
 try{
  await page.goto(c.base+'/production/login.html?noRemember=1');await page.locator('#login-user').fill('admin');await page.locator('#login-password').fill(password);password=undefined;await page.locator('#login-submit').click();
  await page.getByRole('button',{name:/administrativa/i}).click({timeout:20000});await page.waitForURL(/\/production\/home\.html/,{timeout:20000});authenticated=true;
  await page.goto(c.base+'/production/app.html?screenId=ciw.processos-compra-financeiro-med');
  await page.waitForFunction(()=>window.productionCrudEngine?.gridRenderer?.grid&&document.querySelector('[data-render-state="ready"]'),null,{timeout:30000});
  const parent=await page.evaluate(()=>{const engine=window.productionCrudEngine,grid=engine.gridRenderer.grid;return {title:engine.definition.program.title,total:grid.dataSource.total(),pageSize:grid.dataSource.pageSize(),sort:grid.dataSource.sort()};});
  c.assert.ok(parent.title.includes('MED'));c.assert.ok(parent.total>0);c.assert.equal(parent.pageSize,50);
  await page.screenshot({path:c.path.join(c.state,'ui-processos-compra-med.png'),fullPage:true});
  const link=page.getByRole('link',{name:'Pagamentos',exact:true}).first();await link.waitFor({timeout:15000});const href=await link.getAttribute('href');c.assert.ok(href.includes('screenId=ciw.proc-compra-pagamentos'));const id=Number(new URL(href,c.base).searchParams.get('context__proc_compra_id'));c.assert.ok(Number.isSafeInteger(id)&&id>0);
  if(await link.getAttribute('target')==='_blank'){const popup=context.waitForEvent('page');await link.click();child=await popup;}else await link.click();
  await child.waitForFunction(()=>window.productionCrudEngine?.gridRenderer?.grid&&document.querySelector('[data-render-state="ready"]'),null,{timeout:30000});
  await child.getByRole('button',{name:'Incluir',exact:true}).click({timeout:15000});
  await child.waitForFunction(()=>window.productionCrudEngine?.formRenderer?.inputs?.titulos?.input.data('kendoMultiSelect'),null,{timeout:20000});
  const form=await child.evaluate(async()=>{const f=window.productionCrudEngine.formRenderer;await f.optionsReady;if(f.optionsFailed)throw Error('OPTIONS_FAILED');const input=f.inputs.titulos,widget=input.input.data('kendoMultiSelect');return {context:f.data.proc_compra_id,contextReadonly:f.inputs.proc_compra_id.readonly,nativeMultiSelect:!!widget,visible:input.wrapper.is(':visible'),optionsCount:widget.dataSource.data().length,selected:Array.from(widget.value()),title:window.productionCrudEngine.definition.program.title};});
  c.assert.equal(form.context,id);c.assert.equal(form.contextReadonly,true);c.assert.equal(form.nativeMultiSelect,true);c.assert.equal(form.visible,true);c.assert.deepEqual(form.selected,[]);c.assert.ok(form.title.includes('MED'));
  await child.evaluate(()=>window.productionCrudEngine.formRenderer.inputs.titulos.input.data('kendoMultiSelect').open());
  await child.waitForFunction(()=>{const m=window.productionCrudEngine.formRenderer.inputs.titulos.input.data('kendoMultiSelect');return m.popup.visible()&&!m.popup.element.is(':animated')&&!m.popup.element.closest('.k-animation-container').is(':animated');});
  await child.waitForTimeout(350);
  await child.screenshot({path:c.path.join(c.state,'ui-pagamentos-med-incluir.png'),fullPage:true});
  await child.evaluate(()=>window.productionCrudEngine.formRenderer.close(true));
  c.assert.deepEqual(errors,[]);c.assert.deepEqual(blockedMutations,[]);
  const proof={success:true,at:new Date().toISOString(),browser:'isolated-msedge-headless',ownSession:true,businessWrites:false,parent,contextLink:true,form,nativeMultiSelect:true,dropdownOpenCaptured:true,saved:false,deleted:false,pageErrors:errors,blockedMutationAttempts:blockedMutations,screenshots:['ui-processos-compra-med.png','ui-pagamentos-med-incluir.png']};c.save('builder-ui-verification.json',proof);console.log('PASS: parent,context link,native MultiSelect; no saves/deletes/business requests.');
 }catch(error){await child.screenshot({path:c.path.join(c.state,'ui-failure.png'),fullPage:true}).catch(()=>{});throw error;}
 finally{if(authenticated)await child.evaluate(async()=>{await new window.CrudHttpClient().logout();}).catch(()=>{});await browser.close();}
}
if(require.main===module)main().catch(error=>{console.error(error.message);process.exitCode=1;});
