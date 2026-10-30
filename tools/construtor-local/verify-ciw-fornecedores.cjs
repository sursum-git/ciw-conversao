/* Leitura real, sem mutacoes de negocio e sem substituir a sessao humana. */
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/ciw-fornecedores-20261020'),base='http://127.0.0.1:8765';
(async()=>{
 let password=fs.readFileSync(path.join(root,'.runtime/construtor-pg/acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const login=await fetch(base+'/api/auth/login',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({username:'admin',password,tenantId:'default',remember:false})}).then(x=>x.json());password=undefined;assert.ok(login.authenticated);
 const headers={'Content-Type':'application/json',Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 const cfg=JSON.parse(fs.readFileSync(path.join(root,'.runtime/ciw-cadastros-20261020/private/connection.json'),'utf8'));
 const coverage=JSON.parse(fs.readFileSync(path.join(state,'coverage.json'),'utf8').replace(/^\uFEFF/,''));
 const proof={instance:'sursum-api',context:'med',businessWrites:false,resources:{}};
 async function raw(body,authorized=true){return fetch(cfg.baseUrl+'/SursumPrograms/ciw-cadastros',{method:'POST',headers:{'Content-Type':'application/json',...(authorized?{'X-Ciw-Cadastros-Token':cfg.integrationToken,'X-Sursum-User':login.user.username||'admin','X-Session-Id':login.session.sessionId}:{})},body:JSON.stringify(body),signal:AbortSignal.timeout(30000)}).then(x=>x.json());}
 async function api(screen,op,body){const r=await fetch(base+'/api/runtime/screens/'+screen+(op?'/endpoints/'+op:''),{method:body===undefined?'GET':'POST',headers,...(body===undefined?{}:{body:JSON.stringify(body)}),signal:AbortSignal.timeout(40000)});const d=await r.json();assert.equal(r.status,200,d.error?.code||screen);return d;}
 try{
  for(const [resource,screen]of [['fornecedores','ciw.fornecedores'],['fornecedores_estrangeiros','ciw.fornecedores-estrangeiros']]){
   const expected=coverage[resource],legacyFields=resource==='fornecedores'?['cod_emitente','nome_abrev','nome_emit']:['cod_emitente','nome_abrev','nome_emit','data_implant'];
   const result=await raw({resource,operation:'read'});assert.equal(result.success,true,result.error?.code);assert.equal(result.data.length,expected.count);assert.equal(result.total,expected.count);
   assert.equal(result.data.reduce((sum,x)=>sum+x.cod_emitente,0),expected.idSum);
   assert.deepEqual(result.data[0],expected.first);assert.equal(new Set(result.data.map(x=>x.cod_emitente)).size,result.data.length);
   for(let i=0;i<result.data.length;i++){const row=result.data[i];assert.deepEqual(Object.keys(row).sort(),[...legacyFields].sort());if(i)assert.ok(row.cod_emitente>result.data[i-1].cod_emitente);if(row.data_implant!==undefined&&row.data_implant!==null)assert.match(row.data_implant,/^\d{4}-\d{2}-\d{2}$/);}
   const definition=await api(screen);assert.equal(definition.dataModel.primaryKey,'cod_emitente');
   const list=await api(screen,'read',{take:30,sort:[{field:'cod_emitente',dir:'asc'}]});assert.equal(list.total,expected.count);assert.equal(list.data.length,Math.min(30,expected.count));
   const first=list.data[0],detail=await api(screen,'get',{id:first.cod_emitente});assert.equal((detail.data||detail).cod_emitente,first.cod_emitente);
   const filtered=await api(screen,'read',{take:30,filter:{logic:'and',filters:[{field:'cod_emitente',operator:'eq',value:first.cod_emitente}]}});assert.equal(filtered.total,1);assert.equal(filtered.data[0].cod_emitente,first.cod_emitente);
   if(expected.count>30){const page2=await api(screen,'read',{skip:30,take:30,sort:[{field:'cod_emitente',dir:'asc'}]});assert.equal(page2.data[0].cod_emitente,result.data[30].cod_emitente);}
   // ABL nao possui writer; operacao negativa nao pode alterar dados.
   assert.equal((await raw({resource,operation:'delete',id:first.cod_emitente})).error?.code,'CIW_FORNECEDOR_READ_ONLY');
   assert.equal((await raw({resource,operation:'read',sql:'x'})).error?.code,'CIW_FORNECEDOR_FIELD_INVALID');
   proof.resources[resource]={screen,count:expected.count,directDatabaseCountAndSum:true,firstRowExact:true,projection:true,ordered:true,detail:true,filter:true,pagination:true,writeRejected:true};
  }
  assert.equal((await raw({resource:'fornecedores',operation:'read'},false)).error?.code,'CIW_CADASTRO_AUTH_REQUIRED');proof.authenticationRequired=true;
  for(const screen of ['ciw.coloracoes','ciw.situacoes-container','ciw.tipos-versao-custo','ciw.motivos-desconto','ciw.parametros-ima'])await api(screen,'read',{take:1});proof.previousResourcesRead=true;
  fs.writeFileSync(path.join(state,'real-validation.json'),JSON.stringify(proof,null,2));
  console.log('PASS: 2 consultas PASOE/runtime, contagens e somas conferidas contra DB, filtros/paginacao/detalhe e recusa de escrita; recursos anteriores preservados.');
 }finally{await fetch(base+'/api/auth/logout',{method:'POST',headers,body:'{}'});}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
