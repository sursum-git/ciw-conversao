'use strict';
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const {chromium}=require('D:/opencode/construtor-pg/node_modules/playwright');
const state=path.resolve(__dirname,'../../.runtime/iol-gerencial');
(async()=>{
 const access=JSON.parse(fs.readFileSync(path.join(state,'acesso-local-tadeu.json'),'utf8'));
 const browser=await chromium.launch({channel:'msedge',headless:true});
 try{
  const page=await browser.newPage({viewport:{width:1366,height:980}}),errors=[];
  page.on('pageerror',e=>errors.push(e.message));
  await page.goto(access.loginUrl);
  await page.locator('#login-user').fill(access.username);await page.locator('#login-password').fill(access.password);
  await page.locator('#login-submit').click();await page.waitForURL(/home\.html|app\.html/);
  await page.goto(access.panelUrl);
  await page.locator('.analytics-toolbar').waitFor({timeout:30000});
  await page.locator('.analytics-dashboard-grid').waitFor({timeout:30000});
  assert.equal(await page.locator('.analytics-dashboard-links a').count(),8);
  assert.equal(await page.locator('.analytics-dashboard-list li').count(),6);
  await page.screenshot({path:path.join(state,'panel-desktop.png'),fullPage:true});
  const firstGroup=page.locator('.analytics-dashboard-group-body').first();assert.equal(await firstGroup.isVisible(),true);
  assert.equal(await page.locator('.analytics-dashboard-tile h3').first().evaluate(e=>getComputedStyle(e).fontSize),'12px');
  assert.equal(await page.locator('.analytics-kpi strong').first().evaluate(e=>getComputedStyle(e).fontSize),'20px');
  await page.getByRole('button',{name:'Ocultar indicadores de Meta de Faturamento'}).click();assert.equal(await firstGroup.isVisible(),false);
  await page.getByRole('button',{name:'Mostrar indicadores de Meta de Faturamento'}).click();assert.equal(await firstGroup.isVisible(),true);
  assert.match(await firstGroup.innerText(),/R\$/);
  await page.screenshot({path:path.join(state,'panel-metas.png'),fullPage:true});
  await page.getByRole('button',{name:'Ocultar indicadores de Meta de Faturamento'}).click();assert.equal(await firstGroup.isVisible(),false);
  const status=await page.locator('.analytics-status').allTextContents();
  console.log(JSON.stringify({url:page.url(),status,errors,groups:await page.locator('.analytics-dashboard-group').count(),links:await page.locator('.analytics-dashboard-links a').count()}));
  assert.deepEqual(errors,[]);
  await page.setViewportSize({width:390,height:850});await page.screenshot({path:path.join(state,'panel-mobile.png'),fullPage:true});
  assert.ok(await page.evaluate(()=>document.documentElement.scrollWidth<=innerWidth+1),'Overflow mobile');
  fs.writeFileSync(path.join(state,'ui-verification.json'),JSON.stringify({at:new Date().toISOString(),login:'tasilpar',desktop:true,mobileWidth:390,noOverflow:true,metaToggle:true,noJavascriptErrors:errors.length===0,navigationDestinations:10},null,2));
 }finally{await browser.close();}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
