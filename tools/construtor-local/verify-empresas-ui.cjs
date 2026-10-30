'use strict';
const fs=require('node:fs');
const path=require('node:path');
const assert=require('node:assert/strict');
const {createRequire}=require('node:module');
const {chromium}=createRequire('D:/opencode/construtor-pg/package.json')('playwright');
const state=path.resolve(__dirname,'../../.runtime/construtor-pg');
(async()=>{
 const password=fs.readFileSync(path.join(state,'acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice('Senha inicial='.length);
 const browser=await chromium.launch({channel:'msedge',headless:true});
 const page=await browser.newPage({viewport:{width:1440,height:1000}});
 const errors=[];page.on('pageerror',e=>errors.push(e.message));
 const calls=[];page.on('response',r=>{if(r.url().includes('/api/runtime/screens/ciw.empresas'))calls.push({url:r.url(),status:r.status()});});
 try{
  await page.goto('http://127.0.0.1:8765/production/login.html?noRemember=1');
  await page.locator('#login-user').fill('admin');await page.locator('#login-password').fill(password);
  await page.locator('#login-submit').click();
  await page.getByRole('button',{name:/administrativa/i}).click({timeout:20000});
  await page.waitForURL(/\/production\/home\.html/,{timeout:20000});
  await page.goto('http://127.0.0.1:8765/production/app.html?screenId=ciw.empresas');
  await page.waitForFunction(()=>window.productionCrudEngine?.gridRenderer?.grid,null,{timeout:25000});
  await page.waitForFunction(()=>window.productionCrudEngine.gridRenderer.grid.dataSource.total()>0,null,{timeout:25000});
  const info=await page.evaluate(()=>{
   const engine=window.productionCrudEngine;
   return {title:engine.definition.program?.title,columns:engine.gridRenderer.grid.columns.map(c=>c.field).filter(Boolean),
    total:engine.gridRenderer.grid.dataSource.total(),firstId:engine.gridRenderer.grid.dataSource.view()[0]?.empresa_id,
    endpoints:engine.definition.transport?.endpoints};
  });
  assert.deepEqual(info.columns.filter(x=>['empresa_id','nome','cod_emp_ems2','cod_emp_ems5'].includes(x)),['empresa_id','nome','cod_emp_ems2','cod_emp_ems5']);
  await page.screenshot({path:path.join(state,'empresas-consulta.png'),fullPage:true});
  await page.evaluate(id=>window.productionCrudEngine.openRecord('view',id),info.firstId);
  await page.getByText('Detalhe de empresas',{exact:true}).waitFor({timeout:15000});
  assert.ok((await page.locator('body').innerText()).includes('Detalhe de empresas'));
  await page.waitForFunction(()=>{
   const box=window.productionCrudEngine.formRenderer.window.wrapper[0].getBoundingClientRect();
   return box.width>window.innerWidth*0.8&&box.height>window.innerHeight*0.8;
  },null,{timeout:10000});
  await page.screenshot({path:path.join(state,'empresas-formulario.png'),fullPage:true});
  await page.evaluate(()=>{
   const engine=window.productionCrudEngine;
   engine.formRenderer.close(true);
   engine.gridRenderer.grid.dataSource.filter({field:'empresa_id',operator:'eq',value:engine.gridRenderer.grid.dataSource.view()[0].empresa_id});
  });
  await page.waitForFunction(()=>window.productionCrudEngine.gridRenderer.grid.dataSource.total()===1,null,{timeout:15000});
  await page.evaluate(()=>window.productionCrudEngine.gridRenderer.grid.dataSource.filter({}));
  await page.waitForFunction(total=>window.productionCrudEngine.gridRenderer.grid.dataSource.total()===total,info.total,{timeout:15000});
  await page.evaluate(()=>window.productionCrudEngine.openCreate());
  await page.waitForFunction(()=>window.productionCrudEngine.formRenderer.mode==='create',null,{timeout:15000});
  const form=await page.evaluate(()=>{
   const renderer=window.productionCrudEngine.formRenderer;
   return {readonlyId:renderer.inputs.empresa_id.readonly,nomePresent:!!renderer.inputs.nome};
  });
  assert.ok(form.readonlyId&&form.nomePresent,'Formulário de inclusão mantém ID somente leitura');
  await page.waitForFunction(()=>{
   const box=window.productionCrudEngine.formRenderer.window.wrapper[0].getBoundingClientRect();
   return box.width>window.innerWidth*0.8&&box.height>window.innerHeight*0.8;
  },null,{timeout:10000});
  const numbers=await page.evaluate(()=>{
   const renderer=window.productionCrudEngine.formRenderer;
   const integers=['cod_emp_ems2','cod_emp_ems5'].map((name,index)=>{
    const widget=renderer.inputs[name].input.data('kendoNumericTextBox');
    widget.value(index===0?17:500);
    return {name,text:widget.wrapper.find('input:visible').val(),decimals:widget.options.decimals};
   });
   const probe=window.jQuery('<input>').appendTo(document.body);
   renderer.createWidget(probe,{type:'decimal'},12.5);
   const decimal=probe.data('kendoNumericTextBox');
   const decimalText=decimal.wrapper.find('input:visible').val();
   const wrapper=decimal.wrapper;decimal.destroy();wrapper.remove();
   return {integers,decimalText};
  });
  assert.deepEqual(numbers.integers.map(field=>field.text),['17','500'],'Inteiros exibidos sem casas decimais');
  assert.ok(numbers.integers.every(field=>field.decimals===0));
  assert.equal(numbers.decimalText,'12,50','Campos decimais preservam duas casas');
  await page.screenshot({path:path.join(state,'empresas-inclusao.png'),fullPage:true});
  await page.evaluate(()=>window.productionCrudEngine.formRenderer.close(true));
  assert.equal(errors.length,0,errors.join(';'));
  assert.ok(calls.length>=3);assert.ok(calls.every(c=>c.status===200),JSON.stringify(calls));
  fs.writeFileSync(path.join(state,'empresas-ui-evidence.json'),JSON.stringify({at:new Date().toISOString(),total:info.total,columns:info.columns,calls,errors,numbers},null,2));
  console.log('PASS: consulta Kendo com '+info.total+' empresas, filtro e total corretos; formulários de visualização e inclusão (sem salvar), ID somente leitura; nenhum erro JavaScript.');
  await page.evaluate(async()=>{await new window.CrudHttpClient().logout();});
 }catch(error){
  await page.screenshot({path:path.join(state,'empresas-ui-failure.png'),fullPage:true});
  console.error('HTTP:',JSON.stringify(calls));
  console.error('JavaScript:',JSON.stringify(errors));
  console.error((await page.locator('body').innerText()).slice(0,1800));
  throw error;
 }finally{await browser.close();}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
