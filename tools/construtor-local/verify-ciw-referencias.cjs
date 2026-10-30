/* Leitura real e negativas fechadas; nenhum writer ou fixture operacional. */
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/ciw-referencias-20261020'),base='http://127.0.0.1:8765';
(async()=>{
 let password=fs.readFileSync(path.join(root,'.runtime/construtor-pg/acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const login=await fetch(base+'/api/auth/login',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({username:'admin',password,tenantId:'default',remember:false})}).then(x=>x.json());password=undefined;assert.ok(login.authenticated);
 const headers={'Content-Type':'application/json',Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 const cfg=JSON.parse(fs.readFileSync(path.join(root,'.runtime/ciw-cadastros-20261020/private/connection.json'),'utf8'));
 const coverage=JSON.parse(fs.readFileSync(path.join(state,'referencias-coverage.json'),'utf8').replace(/^\uFEFF/,''));
 const proof={instance:'sursum-api',context:'med',businessWrites:false,resources:{}};
 async function raw(body,authorized=true){return fetch(cfg.baseUrl+'/SursumPrograms/ciw-cadastros',{method:'POST',headers:{'Content-Type':'application/json',...(authorized?{'X-Ciw-Cadastros-Token':cfg.integrationToken,'X-Sursum-User':login.user.username||'admin','X-Session-Id':login.session.sessionId}:{})},body:JSON.stringify(body),signal:AbortSignal.timeout(30000)}).then(x=>x.json());}
 async function api(screen,op,body){const r=await fetch(base+'/api/runtime/screens/'+screen+(op?'/endpoints/'+op:''),{method:body===undefined?'GET':'POST',headers,...(body===undefined?{}:{body:JSON.stringify(body)}),signal:AbortSignal.timeout(40000)});const d=await r.json();assert.equal(r.status,200,d.error?.code||screen);return d;}
 try{
  for(const [resource,screen,key,displayKey]of [['itens','ciw.itens-erp','it_codigo','it_codigo'],['representantes_ativos','ciw.representantes-ativos','representante_key','cdn_repres']]){
   const expected=coverage[resource],fields=resource==='itens'?['it_codigo','descricao']:['cdn_repres','nom_pessoa','nom_abrev','representante_key'];
   const result=await raw({resource,operation:'read'});assert.equal(result.success,true,result.error?.code);assert.equal(result.data.length,expected.count);assert.equal(result.total,expected.count);
   assert.equal(result.data.reduce((sum,x)=>sum+(resource==='itens'?x.it_codigo.length:x.cdn_repres),0),expected.keySum);
   const firstRaw={...result.data[0]};delete firstRaw.representante_key;assert.deepEqual(firstRaw,expected.first);
   assert.equal(new Set(result.data.map(x=>x[key])).size,result.data.length);
   for(const row of result.data){assert.deepEqual(Object.keys(row).sort(),[...fields].sort());if(resource==='representantes_ativos'){
    assert.match(row.representante_key,/^[A-F0-9]{64}$/);
    const projection={cdn_repres:row.cdn_repres,nom_pessoa:row.nom_pessoa,nom_abrev:row.nom_abrev};
    // O writer JSON OpenEdge escapa solidus; Node preserva-o por padrao.
    const progressJson=JSON.stringify(projection).replaceAll('/','\\/');
    assert.equal(row.representante_key,crypto.createHash('sha256').update(progressJson,'utf8').digest('hex').toUpperCase());
   }}
   const definition=await api(screen);assert.equal(definition.dataModel.primaryKey,key);assert.equal(!!definition.permissions.create,false);assert.equal(!!definition.permissions.edit,false);assert.equal(!!definition.permissions.delete,false);
   const list=await api(screen,'read',{take:30,sort:[{field:displayKey,dir:'asc'}]});assert.equal(list.total,expected.count);assert.equal(list.data.length,Math.min(30,expected.count));
   const first=list.data[0],detail=await api(screen,'get',{id:first[key]});assert.equal((detail.data||detail)[key],first[key]);
   const matches=result.data.filter(x=>x[displayKey]===first[displayKey]);
   const filtered=await api(screen,'read',{take:30,filter:{logic:'and',filters:[{field:displayKey,operator:'eq',value:first[displayKey]}]}});assert.equal(filtered.total,matches.length);assert.equal(filtered.data[0][displayKey],first[displayKey]);
   if(expected.count>30){
    const sort=[{field:displayKey,dir:'asc'}];
    const page2=await api(screen,'read',{skip:30,take:30,sort});
    const combined=await api(screen,'read',{take:60,sort});
    assert.deepEqual(combined.data.slice(0,30).map(x=>x[key]),list.data.map(x=>x[key]));
    assert.deepEqual(combined.data.slice(30,60).map(x=>x[key]),page2.data.map(x=>x[key]));
    assert.equal(new Set([...list.data,...page2.data].map(x=>x[key])).size,combined.data.length);
   }
   assert.equal((await raw({resource,operation:'delete',id:first[key]})).error?.code,'CIW_REFERENCIA_READ_ONLY');
   assert.equal((await raw({resource,operation:'read',sql:'x'})).error?.code,'CIW_REFERENCIA_FIELD_INVALID');
   assert.equal((await raw({resource,operation:'get',id:first[key],[key]:resource==='itens'?'CODEx-DIVERGENTE':(first[key][0]==='A'?'B':'A')+first[key].slice(1)})).error?.code,'CIW_REFERENCIA_VALIDATION');
   proof.resources[resource]={screen,count:expected.count,physicalCount:expected.physicalCount,independentCoverage:true,firstRowExact:true,projection:true,distinctKeys:true,detail:true,filter:true,pagination:true,writeRejected:true,aliasConflictRejected:true};
  }
  assert.equal((await raw({resource:'itens',operation:'read'},false)).error?.code,'CIW_CADASTRO_AUTH_REQUIRED');proof.authenticationRequired=true;
  for(const screen of ['ciw.coloracoes','ciw.situacoes-container','ciw.tipos-versao-custo','ciw.motivos-desconto','ciw.parametros-ima','ciw.fornecedores','ciw.fornecedores-estrangeiros'])await api(screen,'read',{take:1});proof.previousResourcesRead=true;
  fs.writeFileSync(path.join(state,'real-validation.json'),JSON.stringify(proof,null,2));
  console.log('PASS: itens e representantes PASOE/runtime vsDB, DISTINCT/hashUTF8, detalhe/filtros/paginacao e negativas; 7 consultas anteriores preservadas.');
 }finally{await fetch(base+'/api/auth/logout',{method:'POST',headers,body:'{}'});}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
