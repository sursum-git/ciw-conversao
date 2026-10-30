'use strict';
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const {createRequire}=require('node:module'),{chromium}=createRequire('D:/opencode/construtor-pg/package.json')('playwright');
const state=path.resolve(__dirname,'../../.runtime/construtor-pg'),marker='CODEx-DESP-UI-'+Date.now()+'-';
(async()=>{
 const pw=fs.readFileSync(path.join(state,'acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const browser=await chromium.launch({channel:'msedge',headless:true});
 const context=await browser.newContext({viewport:{width:1440,height:1050}}),page=await context.newPage(),errors=[];
 context.on('page',p=>p.on('pageerror',e=>errors.push(e.message)));page.on('pageerror',e=>errors.push(e.message));
 let ready=false,child,before,beforeLinks;
 const api=(kind,op,data)=>page.evaluate(async({kind,op,data})=>{
  const r=await window.productionCrudEngine.httpClient.request({url:'/api/runtime/screens/ciw.'+kind+'/endpoints/'+op,method:'POST',data});
  return r.data&&!Array.isArray(r.data)?r.data:r;
 },{kind,op,data});
 try{
  await page.goto('http://127.0.0.1:8765/production/login.html?noRemember=1');
  await page.locator('#login-user').fill('admin');await page.locator('#login-password').fill(pw);await page.locator('#login-submit').click();
  await page.getByRole('button',{name:/administrativa/i}).click({timeout:20000});await page.waitForURL(/\/production\/home\.html/,{timeout:20000});
  await page.goto('http://127.0.0.1:8765/production/app.html?screenId=ciw.despesas');
  await page.waitForFunction(()=>window.productionCrudEngine?.gridRenderer?.grid&&document.querySelector('[data-render-state="ready"]'),null,{timeout:25000});
  ready=true;before=(await api('despesas','read',{take:500})).data;
  beforeLinks=(await api('empresas-despesa','read',{take:500})).data;
  const b=await api('despesas','create',{record:{descricao:marker+'Base',log_imposto:0,md_relacs_desp:[]}});
  const tax=await api('despesas','create',{record:{descricao:marker+'Imposto',log_imposto:1,ind_imposto:1,md_relacs_desp:[]}});
  const calc=await api('despesas','create',{record:{descricao:marker+'Calculada',log_imposto:0,log_calculada:true,perc_calculo:2.34,md_relacs_desp:[]}});
  await page.evaluate(async id=>{const e=window.productionCrudEngine;await e.openRecord('edit',id);await e.formRenderer.optionsReady;if(e.formRenderer.optionsFailed)throw new Error('Opcoes do formulario indisponiveis');},calc.despesa_id);
  await page.waitForFunction(()=>window.productionCrudEngine.formRenderer.inputs.md_relacs_desp?.input.data('kendoMultiSelect')?.dataSource.data().length>0,null,{timeout:20000});
  const editInfo=await page.evaluate(id=>{
   const f=window.productionCrudEngine.formRenderer,m=f.inputs.md_relacs_desp.input.data('kendoMultiSelect');
   m.value([id]);m.trigger('change');
   return {decimals:f.inputs.perc_calculo.input.data('kendoNumericTextBox').options.decimals,collection:Array.from(m.value()),visible:f.inputs.md_relacs_desp.wrapper.is(':visible')};
  },b.despesa_id);
  assert.equal(editInfo.decimals,2);assert.ok(editInfo.visible);
  const saved=page.waitForResponse(r=>r.url().endsWith('/ciw.despesas/endpoints/update'));
  await page.evaluate(()=>window.productionCrudEngine.formRenderer.save());assert.equal((await saved).status(),200);
  await page.waitForFunction(()=>!window.productionCrudEngine.formRenderer.submitInProgress);
  let current=await api('despesas','get',{id:calc.despesa_id});assert.deepEqual(current.md_relacs_desp,[b.despesa_id]);
  await page.evaluate(()=>window.productionCrudEngine.formRenderer.close(true));
  await page.evaluate(id=>window.productionCrudEngine.applyFilters([{field:'despesa_id',operator:'eq',value:id}]),calc.despesa_id);
  await page.waitForFunction(()=>window.productionCrudEngine.gridRenderer.grid.dataSource.total()===1);
  const link=page.getByRole('link',{name:'Empresas',exact:true}).first();await link.waitFor();
  const href=await link.getAttribute('href');assert.ok(href.includes('screenId=ciw.empresas-despesa'));assert.ok(href.includes('context__despesa_id='+calc.despesa_id));
  if(await link.getAttribute('target')==='_blank'){
   const popup=context.waitForEvent('page');await link.click();child=await popup;
  }else{await link.click();child=page;}
  await child.waitForFunction(()=>window.productionCrudEngine?.gridRenderer?.grid&&document.querySelector('[data-render-state="ready"]'),null,{timeout:25000});
  await child.evaluate(async()=>{const e=window.productionCrudEngine;await e.openCreate();await e.formRenderer.optionsReady;if(e.formRenderer.optionsFailed)throw new Error('Opcoes do formulario indisponiveis');});
  await child.waitForFunction(()=>{
   const f=window.productionCrudEngine.formRenderer;
   return f.inputs.impostos?.input.data('kendoMultiSelect')?.dataSource.data().length>0&&f.inputs.empresa_id?.input.data('kendoDropDownList')?.dataSource.data().length>0&&f.data.eh_imposto===false;
  },null,{timeout:20000});
  const creation=await child.evaluate(({parent,taxId})=>{
   const f=window.productionCrudEngine.formRenderer,company=f.inputs.empresa_id.input.data('kendoDropDownList'),taxes=f.inputs.impostos.input.data('kendoMultiSelect');
   const available=company.dataSource.data().find(x=>Number(x.value)>0);company.value(available.value);company.trigger('change');
   const amount=f.inputs.vl_padrao.input.data('kendoNumericTextBox');amount.value(32.10);amount.trigger('change');
   taxes.value([taxId]);taxes.trigger('change');
   return {parent:f.data.despesa_id,expected:parent,parentReadonly:f.inputs.despesa_id.readonly,ehImposto:f.data.eh_imposto,percentualEnabled:!f.inputs.percentual.input.prop('disabled'),company:available.value};
  },{parent:calc.despesa_id,taxId:tax.despesa_id});
  assert.equal(creation.parent,calc.despesa_id);assert.equal(creation.parentReadonly,true);assert.equal(creation.ehImposto,false);assert.equal(creation.percentualEnabled,false);
  const created=child.waitForResponse(r=>r.url().endsWith('/ciw.empresas-despesa/endpoints/create'));
  await child.evaluate(()=>window.productionCrudEngine.formRenderer.save());assert.equal((await created).status(),200);
  await child.waitForFunction(()=>!window.productionCrudEngine.formRenderer.submitInProgress);
  const list=await api('empresas-despesa','read',{take:500,filters:[{field:'despesa_id',operator:'eq',value:calc.despesa_id}]});
  assert.equal(list.total,1);assert.deepEqual(list.data[0].impostos,[tax.despesa_id]);
  await child.evaluate(()=>window.productionCrudEngine.formRenderer.close(true));
  await child.screenshot({path:path.join(state,'despesas-empresas-consulta.png'),fullPage:true});
  await child.goto('http://127.0.0.1:8765/production/app.html?screenId=ciw.empresas-despesa&context__despesa_id='+tax.despesa_id);
  await child.waitForFunction(()=>window.productionCrudEngine?.gridRenderer?.grid&&document.querySelector('[data-render-state="ready"]'),null,{timeout:25000});
  await child.evaluate(async()=>{const e=window.productionCrudEngine;await e.openCreate();await e.formRenderer.optionsReady;if(e.formRenderer.optionsFailed)throw new Error('Opcoes do formulario indisponiveis');});
  await child.waitForFunction(()=>window.productionCrudEngine.formRenderer.data.eh_imposto===true,null,{timeout:20000});
  const taxForm=await child.evaluate(()=>{
   const f=window.productionCrudEngine.formRenderer;
   return {valueDisabled:f.inputs.vl_padrao.input.prop('disabled'),percentualDecimals:f.inputs.percentual.input.data('kendoNumericTextBox').options.decimals,percentualEnabled:!f.inputs.percentual.input.prop('disabled')};
  });assert.deepEqual(taxForm,{valueDisabled:true,percentualDecimals:2,percentualEnabled:true});
  await child.screenshot({path:path.join(state,'despesas-empresa-formulario.png'),fullPage:true});
  await child.evaluate(()=>window.productionCrudEngine.formRenderer.close(true));
  assert.deepEqual(errors,[]);
  fs.writeFileSync(path.join(state,'despesas-ui-evidence.json'),JSON.stringify({at:new Date().toISOString(),linkContext:true,editMultiSelect:true,saveRelation:true,createDefaultReadonly:true,remoteCompanyInteger:true,remoteTaxMultiSelect:true,conditionsFromLookup:true,taxForm,errors},null,2));
  console.log('PASS: formularios reais, selecoes multiplas, link contextual, inclusao por empresa e condicoes/precisao.');
 }catch(e){try{await (child||page).screenshot({path:path.join(state,'despesas-ui-failure.png'),fullPage:true});}catch{}throw e;}
 finally{
  try{
   if(ready){
    // Garantir que a pagina usada para limpeza possui um engine autenticado ativo.
    if(child===page)await page.goto('http://127.0.0.1:8765/production/app.html?screenId=ciw.despesas');
    await page.waitForFunction(()=>window.productionCrudEngine?.gridRenderer?.grid,null,{timeout:25000});
    const own=(await api('despesas','read',{take:500})).data.filter(x=>x.descricao?.startsWith(marker)),ids=new Set(own.map(x=>x.despesa_id));
    for(const v of (await api('empresas-despesa','read',{take:500})).data)if(ids.has(v.despesa_id))await api('empresas-despesa','delete',{id:v.empresa_despesa_id});
    for(const d of own)await api('despesas','update',{record:{despesa_id:d.despesa_id,md_relacs_desp:[]}});
    for(const d of own)await api('despesas','delete',{id:d.despesa_id});
    const after=(await api('despesas','read',{take:500})).data;
    if(before)assert.deepEqual(after.slice().sort((a,b)=>a.despesa_id-b.despesa_id),before.slice().sort((a,b)=>a.despesa_id-b.despesa_id));
    const afterLinks=(await api('empresas-despesa','read',{take:500})).data;
    if(beforeLinks)assert.deepEqual(afterLinks.slice().sort((a,b)=>a.empresa_despesa_id-b.empresa_despesa_id),beforeLinks.slice().sort((a,b)=>a.empresa_despesa_id-b.empresa_despesa_id));
    console.log('PASS: limpeza UI completa; registros anteriores preservados.');
    await page.evaluate(async()=>{await new window.CrudHttpClient().logout();});
   }
  }finally{await browser.close();}
 }
})().catch(e=>{console.error(e.stack||e.message);process.exitCode=1;});



