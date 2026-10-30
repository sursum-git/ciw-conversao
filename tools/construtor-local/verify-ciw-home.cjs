/* Verificacao de menu/metadados. Nao chama endpoints de negocio. */
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/ciw-menu-20261020'),base='http://127.0.0.1:8765';
(async()=>{
 const patch=JSON.parse(fs.readFileSync(path.join(root,'integration-src/ciw-menu/home-menu.json'),'utf8'));
 let password=fs.readFileSync(path.join(root,'.runtime/construtor-pg/acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const login=await fetch(base+'/api/auth/login',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({username:'admin',password,tenantId:'default',remember:false})}).then(x=>x.json());password=undefined;assert.ok(login.authenticated);
 const headers={'Content-Type':'application/json',Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 async function screen(id){const r=await fetch(base+'/api/runtime/screens/'+id,{headers,signal:AbortSignal.timeout(20000)});assert.equal(r.status,200,id);return r.json();}
 try{
  const h=await screen('home');assert.equal(h.pageType,'home');assert.deepEqual(h.navigation.modules.find(x=>x.id==='ciw'),patch.module);
  const groups=h.navigation.groups.filter(x=>x.moduleId==='ciw');assert.deepEqual(groups,patch.groups);
  const links=groups.flatMap(x=>x.items);assert.equal(links.length,13);assert.equal(new Set(links.map(x=>x.programId)).size,13);
  const pids=new Set(patch.programs.map(x=>x.id)),hp=h.programs.filter(x=>pids.has(x.id));assert.equal(hp.length,13);
  for(const expected of patch.programs){
   assert.equal(h.permissions[expected.permission],true,'Referencia Home ausente: '+expected.permission);
   const p=hp.find(x=>x.id===expected.id);for(const k of ['id','code','title','type','screenId','moduleId','permission'])assert.equal(p[k],expected[k],k);
   const d=await screen(p.screenId);assert.equal(d.program.id,p.code);assert.equal(d.pageType,p.type);assert.ok(d.permissions.read);
   assert.ok(!(d.contextFields||[]).some(x=>x.required),p.screenId+' exige contexto');
  }
  assert.ok(!JSON.stringify(groups).toLowerCase().includes('conta corrente fornecedor'));
  assert.equal(h.programs.filter(x=>x.screenId?.startsWith('ciw.')).length,13);
  const expenses=await screen('ciw.despesas');assert.ok(JSON.stringify(expenses.crud).includes('ciw.empresas-despesa'),'Link Empresas preservado');
  const containers=await screen('ciw.containers');assert.ok(JSON.stringify(containers.crud).includes('ciw.container-painel'),'Link Painel preservado');
  const panel=await screen('ciw.container-painel');assert.equal(panel.crud.form.tabs.length,14,'Abas existentes preservadas');
  const receipt=JSON.parse(fs.readFileSync(path.join(state,'publication.json'),'utf8'));assert.ok(receipt.integrityValidated&&receipt.permissionsUnchanged&&receipt.otherMenusPreserved);
  const proof={homeHttp:200,module:'CIW',groups:groups.map(x=>({title:x.title,links:x.items.length})),directLinks:13,allTargetDefinitionsHttp200:true,nativePermissionReferencesPreserved:true,contextualNavigationPreserved:true,containerTabs:14,supplierCurrentAccountExcluded:true,businessEndpointsCalled:false,visualValidation:'pending'};
  fs.writeFileSync(path.join(state,'runtime-validation.json'),JSON.stringify(proof,null,2));
  console.log('PASS: Home CIW/3grupos/13links, todas definicoesHTTP200, referencias nativas de permissao e navegacao contextual preservadas; Conta corrente fornecedor ausente.');
 }finally{await fetch(base+'/api/auth/logout',{method:'POST',headers,body:'{}'});}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
