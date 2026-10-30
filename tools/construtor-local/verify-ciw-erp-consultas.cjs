/* Publicacao oficial Builder, somente o editor de parametros autorizado. */
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/ciw-fase2-20261022'),meta=path.join(root,'integration-src/ciw-erp-consultas/metadata'),base='http://127.0.0.1:8765';
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



 const proof={businessWrites:false,origin:'MED',checks:[]};
 const save=(n,d)=>fs.writeFileSync(path.join(state,n),JSON.stringify(d,null,2));
 async function runtime(url,body,status=200){const r=await fetch(base+'/api/runtime/screens/'+url,{method:body===undefined?'GET':'POST',headers,...(body===undefined?{}:{body:JSON.stringify(body)}),signal:AbortSignal.timeout(30000)});const d=await r.json();assert.equal(r.status,status,d.error?.code||'RUNTIME_STATUS');return d;}
 const vm=require('node:vm');const context={window:null,jQuery:()=>{throw Error("DOM_UNEXPECTED");},URL,console,location:{href:base,origin:base}};context.window=context;vm.createContext(context);
 for(const file of ['src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudDefinitionValidator.js','src/crud-engine/CrudFilterRenderer.js'])vm.runInContext(fs.readFileSync(path.join('D:/opencode/construtor-pg',file),'utf8'),context);
 const bar=(field,type,operator,value)=>JSON.parse(JSON.stringify(context.CrudFilterRenderer.prototype.buildFilterValue({filter:{id:field,label:field,field,type},type},operator,value,String(value))));
 try{
  for(const slug of ['notas-fiscais-med','titulos-pagar-med']){
   const screen='ciw.'+slug,d=await runtime(screen);save('runtime-definition-'+slug+'.json',d);assert.equal(d.program.version,'1.0.0');assert.ok(d.program.title.includes('MED'));assert.ok(d.program.subtitle.includes('MED'));
   assert.equal(new context.CrudDefinitionValidator().validate(d),true);for(const op of ['create','edit','delete'])assert.equal(d.permissions[op],false);
   const fields=d.dataModel.fields;for(const f of Object.values(fields)){if(f.type==='integer'){assert.ok(f.decimals==null||f.decimals===0);assert.ok(f.format==null||f.format==='n0');}}
   const req={skip:0,take:2,pageSize:2,page:1,sort:d.query?.defaultSort||d.crud?.grid?.defaultSort||[]};
   const a=await runtime(screen+'/endpoints/read',req);assert.equal(a.data.length,2);assert.ok(a.total>2);save('private-runtime-page-'+slug+'.json',a);for(const [name,f] of Object.entries(fields))if(f.type==='integer')assert.ok(a.data.every(row=>row[name]===null||Number.isInteger(row[name])));
   const b=await runtime(screen+'/endpoints/read',{...req,skip:2,page:2});assert.equal(b.total,a.total);assert.ok(!a.data.some(x=>b.data.some(y=>x.record_key===y.record_key)));
   const row=a.data[0],get=await runtime(screen+'/endpoints/get',{id:row.record_key});assert.deepEqual(get.data??get,row);
   if(slug==='titulos-pagar-med')assert.ok([...a.data,...b.data].every(x=>x.cod_empresa==='500'));
   const stringField=slug==='notas-fiscais-med'?'nr_nota_fis':'cod_tit_ap',intField=slug==='notas-fiscais-med'?'cod_emitente':'cdn_fornecedor',dateField=slug==='notas-fiscais-med'?'dt_emis_nota':'dat_emis_docto';
   const prefix=String(row[stringField]).slice(0,2),filtered=await runtime(screen+'/endpoints/read',{take:2,skip:0,filters:[bar(stringField,'text','startsWith',prefix)]});assert.ok(filtered.data.every(x=>String(x[stringField]).toLowerCase().startsWith(prefix.toLowerCase())));
   const ints=await runtime(screen+'/endpoints/read',{take:2,skip:0,filters:[bar(intField,'integer','eq',row[intField])]});assert.ok(ints.data.length>0&&ints.data.every(x=>x[intField]===row[intField]));
   const date=String(row[dateField]).slice(0,10);assert.match(date,/^\d{4}-\d{2}-\d{2}$/);
   const dates=await runtime(screen+'/endpoints/read',{take:2,skip:0,filter:{field:dateField,operator:'eq',value:date+'T03:00:00.000Z'}});assert.ok(dates.data.length>0&&dates.data.every(x=>String(x[dateField]).startsWith(date)));
   const range=await runtime(screen+'/endpoints/read',{take:2,skip:0,filters:[bar(dateField,'date','between',{start:date+'T03:00:00.000Z',end:date+'T23:59:59.999-03:00'})]});assert.equal(range.total,dates.total);
   const empty=await runtime(screen+'/endpoints/read',{take:2,skip:0,filter:{field:stringField,operator:'eq',value:'SC_NO_RECORD_2147000109'}});assert.equal(empty.total,0);assert.deepEqual(empty.data,[]);
   for(const bad of [{take:201},{take:1,context:{empresa_id:1}},{filter:{field:'nat_operacao OR TRUE','operator':'eq','value':'3'}},{filter:{field:intField,operator:'eq',value:'1 OR TRUE'}}]){const rejected=await runtime(screen+'/endpoints/read',bad,422);assert.equal(rejected.error.code,'CIW_ERP_QUERY_INVALID');}
   proof.checks.push({screen,version:d.program.version,nativeValidator:true,columns:d.crud.grid.columns.length,total:a.total,paging:true,get:true,nativeToolbar:true,integerFilter:true,dateFilter:true,dateRange:true,empty:true,rejectedInvalidQueries:4});
  }
  const home=await runtime('home');for(const slug of ['notas-fiscais-med','titulos-pagar-med']){const links=home.programs.filter(x=>x.screenId==='ciw.'+slug);assert.equal(links.length,1);assert.ok(home.navigation.groups.find(x=>x.id==='ciw-consultas').items.some(x=>x.programId===links[0].id));}proof.homeLinks=true;
  proof.success=true;proof.at=new Date().toISOString();save('runtime-verification.json',proof);console.log(JSON.stringify(proof));
 }finally{await fetch(base+'/api/auth/logout',{method:'POST',headers,body:'{}'});}
})().catch(e=>{console.error(e.stack);process.exitCode=1;});
