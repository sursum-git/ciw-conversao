/* Somente contas explicitamente indicadas pelo usuario; nao cria contas. */
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/ciw-auth-20261017'),base='http://127.0.0.1:8765';
const bind=process.argv.includes('--bind');
const prepareMetadata=process.argv.includes('--prepare-metadata');
const userIndex=process.argv.indexOf('--user');
const username=userIndex<0?'tasilpar':process.argv[userIndex+1];
assert.ok(['tasilpar','thiago.cassimiro','tcassimiro'].includes(username),'account explicitly selected');
const accountState=username==='tasilpar'?state:path.join(root,username==='tcassimiro'?'.runtime/ciw-auth-tcassimiro-20261019':'.runtime/ciw-auth-thiago-20261019');
fs.mkdirSync(accountState,{recursive:true});
(async()=>{
 let password=fs.readFileSync(path.join(root,'.runtime/construtor-pg/acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const loginResponse=await fetch(base+'/api/auth/login',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({username:'admin',password,tenantId:'default',remember:false})});
 password=undefined;
 const login=await loginResponse.json();assert.ok(login.authenticated,'administrative login');
 const headers={'Content-Type':'application/json',Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 async function call(url,payload){
  const r=await fetch(base+url,{headers,method:payload===undefined?'GET':'POST',...(payload===undefined?{}:{body:JSON.stringify(payload)})});
  const data=await r.json();
  if(!r.ok)throw new Error('HTTP'+r.status+' '+(data.error?.code??'API_ERROR'));
  return data;
 }
 const api=(operation,payload)=>call('/api/runtime/screens/admin.usuarios/endpoints/'+operation,payload);
 async function current(){
  const result=await api('read',{take:2,filters:[{field:'username',operator:'eq',value:username},{field:'tenant_id',operator:'eq',value:'default'}]});
  if(result.data.length===0){
   const other=await api('read',{take:10,filters:[{field:'username',operator:'eq',value:username}]});
   const discovery={username,defaultFound:false,otherTenants:other.data.map(r=>({tenant:r.tenant_id,status:r.status,source:r.auth_source})),accountsCreated:false};
   fs.writeFileSync(path.join(accountState,'account-discovery.json'),JSON.stringify(discovery,null,2));
   throw new Error('ACCOUNT_NOT_FOUND: '+JSON.stringify(discovery));
  }
  assert.equal(result.data.length,1,'one authorized account');const row=result.data[0];
  assert.equal(row.username,username);assert.equal(row.tenant_id,'default');assert.equal(row.status,'active');
  assert.ok(!('password_hash'in row),'no credential data');
  return row;
 }
 try{
  const metadata=await call('/api/runtime/screens/admin.usuarios');
  if(prepareMetadata){
   const response=await call('/api/admin/program-builder/entities/auth_user');
   const entity=response.entity;assert.equal(entity.code,'auth_user');assert.equal(entity.tableName,'auth_user');
   assert.equal(entity.entityType,'persistence');assert.equal(entity.subscriberIsolationMode,'none');
   if(!entity.fields.some(f=>f.code==='auth_source')){
    const backup=path.join(state,'auth-user-entity-before.json');if(!fs.existsSync(backup))fs.writeFileSync(backup,JSON.stringify(response,null,2));
    const field={code:'auth_source',label:'Origem de acesso',dataType:'string',length:40,required:true,primaryKey:false,position:entity.fields.length,columnName:'auth_source',readonlyField:false,options:{type:'enum',editable:true,nullable:false,options:[{value:'local',label:'Local'},{value:'ima-user-web',label:'IMA — usuário Progress'}]}};
    assert.equal(entity.structureModuleCode,'');assert.equal(entity.structureBaseNumber,null);
    const saved=await call('/api/admin/program-builder/entities',{...entity,skipStructureValidation:true,subscriberGlobalTable:true,createPhysicalTable:false,allowTableRename:false,allowColumnRename:false,dropRemovedColumns:false,fields:[...entity.fields,field]});
    assert.deepEqual(saved.entity.fields.filter(f=>f.code!=='auth_source').map(f=>f.code),entity.fields.map(f=>f.code));
    const {subscriberIsolation,...otherMetadata}=saved.entity.metadata;
    for(const [key,value] of Object.entries(entity.metadata))assert.deepEqual(otherMetadata[key],value,'preserve metadata '+key);
    assert.deepEqual(subscriberIsolation,{mode:'none',columnName:null,globalTable:true});
    fs.writeFileSync(path.join(state,'auth-user-entity-after.json'),JSON.stringify(saved,null,2));
   }
   const afterEntity=await call('/api/admin/program-builder/entities/auth_user');
   const original=JSON.parse(fs.readFileSync(path.join(state,'auth-user-entity-before.json'),'utf8')).entity;
   for(const [key,value] of Object.entries(original.metadata))assert.deepEqual(afterEntity.entity.metadata[key],value,'preserve original metadata '+key);
   assert.equal(afterEntity.entity.tableName,original.tableName);assert.equal(afterEntity.entity.subscriberIsolationMode,original.subscriberIsolationMode);
   assert.equal(afterEntity.entity.softDeleteEnabled,false);assert.equal(afterEntity.entity.versioningEnabled,false);
   assert.deepEqual(afterEntity.entity.fields.filter(f=>f.code!=='auth_source').map(f=>f.code),original.fields.map(f=>f.code));
   fs.writeFileSync(path.join(state,'auth-user-entity-after.json'),JSON.stringify(afterEntity,null,2));
   const row=await current();assert.ok(['local','ima-user-web'].includes(row.auth_source));
   console.log('PASS: auth_source disponivel pelo CRUD oficial; nenhum usuario alterado');return;
  }
  const before=await current();
  if(!bind){
   const entity=await call('/api/admin/program-builder/entities/auth_user');
   const entityBackup=path.join(state,'auth-user-entity-before.json');if(!fs.existsSync(entityBackup))fs.writeFileSync(entityBackup,JSON.stringify(entity,null,2));
   console.log(JSON.stringify({username:before.username,status:before.status,authSource:before.auth_source,keys:Object.keys(before),entityKeys:Object.keys(entity),entityFields:entity.fields?.map(f=>({code:f.code,dataType:f.dataType,options:f.options})),locking:metadata.crud?.locking??null}));
   return;
  }
  const negative=JSON.parse(fs.readFileSync(path.join(state,'pasoe-negative-validation.json'),'utf8'));
  assert.equal(negative.cases.length,11);assert.ok(negative.cases.every(x=>x.passed));
  const registration=JSON.parse(fs.readFileSync(path.join(state,'provider-registration.json'),'utf8'));
  assert.equal(registration.enabled,true);
  assert.ok(['local','ima-user-web'].includes(before.auth_source),'unexpected existing provider');
  if(before.auth_source!=='ima-user-web'){
   const backup=path.join(accountState,'account-before.json');if(!fs.existsSync(backup))fs.writeFileSync(backup,JSON.stringify(before,null,2));
   const lock=await api('runtime.lock.acquire',{entityCode:'auth_user',recordId:before.id,operation:'update'});
   const lockToken=lock.lockToken??lock.token??lock.lock?.token;
   assert.ok(typeof lockToken==='string'||lock.lock?.mode==='none','write policy');
   try{await api('update',{id:before.id,values:{auth_source:'ima-user-web'},_runtime:{version:before._runtime.version,...(lockToken?{lockToken}:{})}});}
   finally{if(lockToken)await api('runtime.lock.release',{entityCode:'auth_user',recordId:before.id,lockToken});}
  }
  const after=await current();assert.equal(after.auth_source,'ima-user-web');
  for(const k of ['groups','permissions','display_name','email','status','username','tenant_id'])assert.deepEqual(after[k],before[k],'preserve '+k);
  fs.writeFileSync(path.join(accountState,'account-binding.json'),JSON.stringify({username:after.username,tenant:after.tenant_id,before:before.auth_source,after:after.auth_source,permissionsPreserved:true,progressUsersModified:false},null,2));
  console.log('PASS: somente auth_source de '+username+'/default alterado pelo CRUD administrativo; grupos/permissoes preservados');
 } finally{await fetch(base+'/api/auth/logout',{method:'POST',headers});}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
