// Somente a fixture confirmada: detalhe e Logs nativos, sem nenhuma mutação de negócio.
const c=require('./purchase-payments-builder-common.cjs'),{createRequire}=require('node:module');
const {chromium}=createRequire('D:/opencode/construtor-pg/package.json')('playwright');
const directory=c.path.join(c.state,'fixture-v2'),decode=x=>typeof x==='string'?JSON.parse(x):x;
async function main(){
 const fixture=c.readJson(c.path.join(directory,'api-create-confirmed.json'));c.assert.equal(fixture.success,true);c.assert.equal(fixture.proc_compra_id,2147000104);c.assert.equal(fixture.links.length,2);
 let password=c.fs.readFileSync(c.path.join(c.root,'.runtime/construtor-pg/acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial='))?.slice(14);c.assert.ok(password);
 const browser=await chromium.launch({channel:'msedge',headless:true}),context=await browser.newContext({viewport:{width:1540,height:1400}}),page=await context.newPage(),errors=[],blocked=[];page.on('pageerror',e=>errors.push(e.message));
 await context.route('**/api/runtime/screens/**/endpoints/**',async route=>{const operation=route.request().url().split('/endpoints/')[1]?.split('?')[0];if(['create','update','delete','batch','process'].includes(operation)){blocked.push(operation);await route.abort('blockedbyclient');}else await route.continue();});
 let authenticated=false,proof;
 try{
  await page.goto(c.base+'/production/login.html?noRemember=1');await page.locator('#login-user').fill('admin');await page.locator('#login-password').fill(password);password=undefined;await page.locator('#login-submit').click();await page.getByRole('button',{name:/administrativa/i}).click({timeout:20000});await page.waitForURL(/\/production\/home\.html/,{timeout:20000});authenticated=true;
  await page.goto(c.base+'/production/app.html?screenId=ciw.proc-compra-pagamentos&context__proc_compra_id=2147000104');
  await page.waitForFunction(()=>window.productionCrudEngine?.gridRenderer?.grid&&document.querySelector('[data-render-state="ready"]'),null,{timeout:30000});
  const rows=await page.evaluate(()=>Array.from(window.productionCrudEngine.gridRenderer.grid.dataSource.data()).map(x=>x.toJSON?x.toJSON():x));c.assert.equal(rows.length,2);c.assert.deepEqual(rows.map(x=>x.pagamento_key).sort(),fixture.links.map(x=>x.pagamento_key).sort());
  await page.screenshot({path:c.path.join(directory,'ui-two-linked-payments.png'),fullPage:true});
  const target=fixture.links[0];
  const actualGet=await page.evaluate(async id=>{const e=window.productionCrudEngine,r=await e.httpClient.request({url:'/api/runtime/screens/ciw.proc-compra-pagamentos/endpoints/get',method:'POST',data:{id,context:{proc_compra_id:2147000104}}});return r.data&&!Array.isArray(r.data)?r.data:r;},target.pagamento_key);c.assert.deepEqual(actualGet,target);c.assert.deepEqual(actualGet.titulos,[target.num_id_tit_ap]);
  await page.evaluate(id=>window.productionCrudEngine.openRecord('view',id),target.pagamento_key);
  await page.waitForFunction(()=>window.productionCrudEngine.formRenderer?.data?.pagamento_key,null,{timeout:20000});
  const detail=await page.evaluate(()=>{const f=window.productionCrudEngine.formRenderer;return {key:f.data.pagamento_key,titulos:Array.from(f.data.titulos),isArray:Array.isArray(f.data.titulos),parent:f.data.proc_compra_id};});c.assert.equal(detail.key,target.pagamento_key);c.assert.equal(detail.isArray,true);c.assert.deepEqual(detail.titulos,[target.num_id_tit_ap]);c.assert.equal(detail.parent,2147000104);
  await page.screenshot({path:c.path.join(directory,'ui-payment-detail.png'),fullPage:true});
  const logsButton=page.locator('.crud-form-header-appbar').getByRole('button',{name:'Logs',exact:true});await logsButton.waitFor();await logsButton.click();
  const iframe=page.locator('iframe.crud-log-frame').last();await iframe.waitFor();const src=await iframe.getAttribute('src');c.assert.ok(src.includes('admin.transacoes'));c.assert.ok(src.includes('context__record_id='+target.pagamento_key));
  const frame=await (await iframe.elementHandle()).contentFrame();frame.on('pageerror',e=>errors.push(e.message));
  await frame.waitForFunction(()=>window.productionCrudEngine?.gridRenderer?.grid&&document.querySelector('[data-render-state="ready"]'),null,{timeout:30000});
  const transactions=await frame.evaluate(()=>Array.from(window.productionCrudEngine.gridRenderer.grid.dataSource.data()).map(x=>x.toJSON?x.toJSON():x));c.assert.ok(transactions.some(x=>Number(x.id)===fixture.transaction_id));
  await frame.locator('a.crud-row-link[href*="context__transaction_id='+fixture.transaction_id+'"]').click();
  await frame.waitForURL(/screenId=admin.logs-transacoes/,{timeout:20000});await frame.waitForFunction(()=>window.productionCrudEngine?.definition?.screenId==='admin.logs-transacoes'&&window.productionCrudEngine?.gridRenderer?.grid&&document.querySelector('[data-render-state="ready"]'),null,{timeout:30000});
  const raw=await frame.evaluate(()=>Array.from(window.productionCrudEngine.gridRenderer.grid.dataSource.data()).map(x=>x.toJSON?x.toJSON():x));
  const events=raw.map(x=>({...x,meta:decode(x.metadata),before:decode(x.before_data),after:decode(x.after_data)})).filter(x=>x.meta?.audit?.available===true&&x.meta.audit.paymentKey===target.pagamento_key);
  const main=events.filter(x=>x.meta.audit.resource==='purchase_payment_links'&&x.meta.audit.operation==='create');const ledgers=events.filter(x=>x.meta.audit.resource==='cta_corren_fornec_imp'&&x.meta.audit.operation==='create');
  c.assert.equal(main.length,1);c.assert.equal(ledgers.length,2);c.assert.equal(Object.keys(main[0].before).length,0);c.assert.equal(Object.keys(main[0].after).length,18);c.assert.deepEqual(main[0].after,target);
  for(const event of [...main,...ledgers]){c.assert.equal(event.actor_user_id,'admin');c.assert.equal(event.meta.audit.paymentKey,target.pagamento_key);c.assert.equal(event.meta.audit.procCompraId,2147000104);c.assert.equal(Object.keys(event.before).length,0);}
  const expectedLedger=fixture.ledger_rows.filter(x=>x.num_id_tit_ap===target.num_id_tit_ap);c.assert.equal(expectedLedger.length,2);c.assert.deepEqual(ledgers.map(x=>x.after).sort((a,b)=>a.cta_corren_fornec_imp_id-b.cta_corren_fornec_imp_id),expectedLedger.sort((a,b)=>a.cta_corren_fornec_imp_id-b.cta_corren_fornec_imp_id));
  c.fs.writeFileSync(c.path.join(directory,'ui-native-link-log-events-private.json'),JSON.stringify(events,null,2));
  await page.screenshot({path:c.path.join(directory,'ui-native-payment-logs-grid.png'),fullPage:true});
  await frame.evaluate(id=>window.productionCrudEngine.openRecord('view',id),main[0].id);await frame.waitForFunction(()=>window.productionCrudEngine.formRenderer?.data?.id,null,{timeout:20000});
  const logDetail=await frame.evaluate(()=>({before:window.productionCrudEngine.formRenderer.data.before_data,after:window.productionCrudEngine.formRenderer.data.after_data,actor:window.productionCrudEngine.formRenderer.data.actor_user_id}));c.assert.equal(Object.keys(decode(logDetail.before)).length,0);c.assert.equal(Object.keys(decode(logDetail.after)).length,18);c.assert.equal(logDetail.actor,'admin');
  await page.screenshot({path:c.path.join(directory,'ui-native-payment-log-images.png'),fullPage:true});c.assert.deepEqual(errors,[]);c.assert.deepEqual(blocked,[]);
  proof={success:true,at:new Date().toISOString(),browser:'isolated-msedge-headless',proc_compra_id:2147000104,paymentKey:target.pagamento_key,paymentRows:2,getDetail:true,nativeIntegerArray:true,formLogsButton:true,nativeRecordScopedTransactions:true,nativeTransactionLogsLink:true,actor:'admin',associationBeforeFields:0,associationAfterFields:18,ledgerEventsForPaymentKey:2,ledgerImagesMatch:true,logDetailBeforeAfterVisible:true,pageErrors:errors,blockedMutationAttempts:blocked,businessWrites:false,saved:false,deleted:false,screenshots:['ui-two-linked-payments.png','ui-payment-detail.png','ui-native-payment-logs-grid.png','ui-native-payment-log-images.png']};
 }catch(error){await page.screenshot({path:c.path.join(directory,'ui-audit-failure.png'),fullPage:true}).catch(()=>{});throw error;}
 finally{if(authenticated)await page.evaluate(()=>window.productionCrudEngine.httpClient.logout()).catch(()=>{});await browser.close();}
 c.fs.writeFileSync(c.path.join(directory,'ui-link-logs-proof.json'),JSON.stringify({...proof,ownSessionLoggedOut:true,browserClosed:true},null,2));console.log('PASS: two links,get/detail,form Logs,admin,0/18images,two exact ledger events; no business writes.');
}
if(require.main===module)main().catch(error=>{console.error(error.message);process.exitCode=1;});
