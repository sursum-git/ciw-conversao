/* Publicacao oficial Builder, somente o editor de parametros autorizado. */
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/ciw-bc-client-20261021'),meta=path.join(root,'integration-src/ciw-bc-client/metadata'),base='http://127.0.0.1:8765';
const resources=['hist-cotacoes-bc'];
(async()=>{
 let password=fs.readFileSync(path.join(root,'.runtime/construtor-pg/acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const loginResponse=await fetch(base+'/api/auth/login',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({username:'admin',password,tenantId:'default',remember:false})});password=undefined;
 const login=await loginResponse.json();assert.ok(login.authenticated,'ADMIN_LOGIN_FAILED');
 const headers={'Content-Type':'application/json',Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 async function api(url,body,method=body===undefined?'GET':'POST'){
  const r=await fetch(base+'/api/admin/program-builder'+url,{method,headers,...(body===undefined?{}:{body:JSON.stringify(body)}),signal:AbortSignal.timeout(45000)});const d=await r.json();
  if(!r.ok||d.error)throw Error(url+' HTTP'+r.status+' '+(d.error?.code??'BUILDER_ERROR')+' '+(d.error?.message??''));return d;
 }


 const proof={businessProcessExecuted:false,existingRecordsModified:false,checks:[]};
 const save=(n,d)=>fs.writeFileSync(path.join(state,n),JSON.stringify(d,null,2));
 async function runtime(url,body,status=200){const r=await fetch(base+'/api/runtime/screens/'+url,{method:body===undefined?'GET':'POST',headers,...(body===undefined?{}:{body:JSON.stringify(body)}),signal:AbortSignal.timeout(25000)});const d=await r.json();assert.equal(r.status,status,d.error?.code||'RUNTIME_STATUS');return d;}
 try{
  const d=await runtime('ciw.cotacoes-bc-buscar');save('runtime-process-definition.json',d);assert.equal(d.program.id,'cd0104');assert.equal(d.program.version,'1.0.0');assert.equal(d.pageType,'process');
  assert.equal(d.process.parameters.fields.length,1);const field=d.process.parameters.fields[0];assert.equal(field.field,'serie');assert.equal(field.type,'integer');assert.equal(field.defaultValue,1);assert.equal(field.required,true);assert.ok(d.process.actions.process.confirmation.message);assert.equal(d.permissions.process,true);
  const vm=require('node:vm');const context={window:{console,location:{href:base,origin:base}},URL,console};vm.createContext(context);
  for(const file of ['src/crud-engine/CrudUtils.js','src/process-engine/ProcessDefinitionValidator.js'])vm.runInContext(fs.readFileSync(path.join('D:/opencode/construtor-pg',file),'utf8'),context);
  assert.equal(new context.window.ProcessDefinitionValidator().validate(d),true);proof.nativeProcessValidator=true;
  const c=await runtime('ciw.cotacoes-bc');save('runtime-crud-definition.json',c);assert.equal(c.program.version,'1.0.1');assert.ok(c.crud.grid.rowLinks.some(x=>x.screenId==='ciw.cotacoes-bc-buscar'&&x.label==='Buscar cotação'));
  const rows=await runtime('ciw.cotacoes-bc/endpoints/read',{take:1,skip:0});assert.ok(Array.isArray(rows.data));proof.historyRead=true;
  for(const parameters of [{serie:9999},{serie:1,valor:0}]){const bad=await runtime('ciw.cotacoes-bc-buscar/endpoints/run',{parameters,context:{}},422);assert.equal(bad.error.code,'ENTITY_API_PROCESS_INVALID');}proof.browserCannotSupplyQuote=true;
  const home=await runtime('home');const links=home.programs.filter(p=>p.screenId==='ciw.cotacoes-bc-buscar');assert.equal(links.length,1);assert.equal(links[0].type,'process');proof.homeLink=true;
  const entity=(await api('/entities/hist_cotacoes_bc_progress')).entity;assert.ok(entity.apiSource.operations.some(x=>x.code==='hist_cotacoes_bc_import'&&x.allowProcess===true));proof.sourceOperation=true;
  proof.success=true;proof.at=new Date().toISOString();save('runtime-verification.json',proof);console.log(JSON.stringify(proof));
 }finally{await fetch(base+'/api/auth/logout',{method:'POST',headers,body:'{}'});}
})().catch(e=>{console.error(e.message);process.exitCode=1;});

