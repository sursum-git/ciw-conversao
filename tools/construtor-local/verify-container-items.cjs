'use strict';
// Read-only and rejected-request validation. No business fixtures are created.
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const root=path.resolve(__dirname,'../..'),folder=path.join(root,'.runtime/container-items-20261017'),state=path.join(root,'.runtime/construtor-pg');
const mode=process.argv[2]||'boundaries',read=p=>fs.readFileSync(p,'utf8').replace(/^\uFEFF/,''),json=p=>JSON.parse(read(p));
const evidence={at:new Date().toISOString(),mode,businessWrites:false,checks:[]};
const token=json(path.join(state,'containers-connection.json')).integrationToken;
let headers={'Content-Type':'application/json'};
const save=name=>fs.writeFileSync(path.join(folder,name),JSON.stringify(evidence,null,2)+'\n');
async function api(route,body,status=200){const r=await fetch('http://127.0.0.1:8765'+route,{method:body===undefined?'GET':'POST',headers,body:body===undefined?undefined:JSON.stringify(body),signal:AbortSignal.timeout(60000)});const result=await r.json();assert.equal(r.status,status,route+' '+(result.error?.code||result.error?.message||''));return result;}
async function pasoe(body,expected,overrides={},route='containers-itens'){
 const h={'Content-Type':'application/json','X-Containers-Token':token,'X-Sursum-User':'admin',...overrides};for(const k of Object.keys(h))if(h[k]===null)delete h[k];
 const r=await fetch('http://127.0.0.1:19910/med/web/SursumPrograms/'+route,{method:'POST',headers:h,body:JSON.stringify(body),signal:AbortSignal.timeout(60000)}),result=await r.json();
 assert.equal(result.success,expected===200,'Unexpected API success: '+JSON.stringify(result.error||{}));if(expected!==200)assert.equal(result.error?.status,expected,JSON.stringify(result.error||{}));
 evidence.checks.push({resource:body.resource,operation:body.operation,status:expected,code:result.error?.code||null});return result;
}
(async()=>{
 if(mode==='boundaries'){
  for(const operation of ['create','update','delete','get'])await pasoe({resource:'container-itens',operation},401,{'X-Containers-Token':null});
  await pasoe({resource:'itens-disponiveis',operation:'read',container_id:332526},401,{'X-Sursum-User':null});
  await pasoe({resource:'wrong',operation:'read',container_id:332526},422);
  for(const extra of [{},{container_id:0},{container_id:'332526'},{container_id:332526,policy:{allow_nested:true}},{container_id:332526,actor:'forged'}])await pasoe({resource:'itens-disponiveis',operation:'read',...extra},422);
  await pasoe({resource:'container-itens',operation:'create',container_id:2147483647,values:{qt_alocada:-1,item_proc_compra_id:1}},422);
  await pasoe({resource:'container-itens',operation:'update',container_id:2147483647,id:2147483647,values:{qt_alocada:1}},404);
  await pasoe({resource:'container-itens',operation:'delete',container_id:2147483647,id:2147483647},404);
  const options=await pasoe({resource:'itens-disponiveis',operation:'read',container_id:332526},200);
  assert.ok(Array.isArray(options.data)&&options.data.length>0&&options.data.length<=5000);
  for(const row of options.data){assert.equal(typeof row.item_proc_compra_id,'number');assert.equal(typeof row.label,'string');assert.equal(typeof row.saldo_disponivel_texto,'string');}
  evidence.optionCount=options.data.length;save('pasoe-boundaries.json');console.log('PASS: '+evidence.checks.length+' PASOE boundaries/read options; no business writes.');return;
 }
 if(mode==='quotes'){
  const q=await pasoe({resource:'cotacoes-fiscais',operation:'read',container_id:332526},200,{},'containers-custos');
  const old=await pasoe({resource:'rastro',operation:'read',container_id:332526},200,{},'containers-custos');
  assert.equal(q.data.length,12);assert.deepEqual(q.calculation.memory.compra_attempts,old.calculation.memory.compra_attempts);assert.deepEqual(q.calculation.memory.di_attempts,old.calculation.memory.di_attempts);
  await pasoe({resource:'cotacoes-fiscais',operation:'get',container_id:332526},422,{},'containers-custos');
  await pasoe({resource:'cotacoes-fiscais',operation:'read',container_id:332526,moeda:'dolar'},422,{},'containers-custos');
  evidence.checks.push('fiscal rate attempts exactly match current trace');save('pasoe-quotes-evidence.json');console.log('PASS: real fiscal quote read, scope, operation/currency gates and trace equivalence; no business writes.');return;
 }
 assert.equal(mode,'runtime-read');
 const password=read(path.join(state,'acesso-local.txt')).split(/\r?\n/).find(l=>l.startsWith('Senha inicial=')).slice(14);
 const login=await api('/api/auth/login',{username:'admin',password,tenantId:'default',rememberMe:false});assert.equal(login.authenticated,true);
 headers={...headers,Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 try{
  const screen=await api('/api/runtime/screens/ciw.container-itens'),panel=await api('/api/runtime/screens/ciw.container-painel');
  assert.equal(screen.program.version,'1.0.1');assert.equal(panel.program.version,'1.0.6');assert.ok(screen.permissions.create&&screen.permissions.edit&&screen.permissions.delete);
  assert.equal(panel.crud.form.tabs.length,14);assert.equal(screen.contextFields.find(f=>f.field==='container_id').required,true);
  assert.equal(panel.crud.form.tabs.find(tab=>tab.id==='itens').linkedPage.hideHeader,false);
  assert.equal(screen.program.logs.mode,'deletions');assert.equal(screen.program.logs.screenId,'ciw.container-itens');
  assert.ok(!JSON.stringify(screen).includes(token));
  const endpoint='/api/runtime/screens/ciw.container-itens/endpoints/';
  await api(endpoint+'options.item_proc_compra_id',{},422);
  await api(endpoint+'options.item_proc_compra_id',{context:{container_id:332526},container_id:1},422);
  const options=await api(endpoint+'options.item_proc_compra_id',{context:{container_id:332526}});
  const rows=await api(endpoint+'read',{take:500,context:{container_id:332526}});assert.ok(rows.data.length>0);
  for(const row of rows.data){assert.equal(row.container_id,332526);assert.ok(options.data.some(option=>option.value===row.item_proc_compra_id),'Current allocation must remain selectable for readonly edit');}
  const detail=await api(endpoint+'get',{id:rows.data[0].item_container_id,context:{container_id:332526}});assert.equal(detail.item_container_id,rows.data[0].item_container_id);
  await api(endpoint+'get',{id:rows.data[0].item_container_id,context:{container_id:331126}},404);
  evidence.checks=['published versions/permissions/14tabs','native child Itens header and screen-scoped deletions','missing/conflicting options context rejected','real contextual options','current allocated items present','read/get context isolation'];
  evidence.optionCount=options.data.length;evidence.itemCount=rows.data.length;save('runtime-read-evidence.json');console.log('PASS: published item metadata, PHP options/read/get and context isolation; no business writes.');
 }finally{await api('/api/auth/logout',{});}
})().catch(error=>{console.error(error.message);process.exitCode=1;});
