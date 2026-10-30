/* Negativos sem credenciais reais. Nunca persiste body, headers ou token. */
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const root=path.resolve(__dirname,'../..'),dir=path.join(root,'.runtime/ciw-auth-20261017');
const cfg=JSON.parse(fs.readFileSync(path.join(dir,'connection.json'),'utf8'));
const body={operation:'authenticate',username:'CIW_AUTH_TEST_NO_USER_20261017',password:'CIW_AUTH_SYNTHETIC_NOT_REAL'};
const cases=[
 ['missing_token','POST',body,{},401,'AUTH_INTEGRATION_REQUIRED'],
 ['wrong_token','POST',body,{'X-Ciw-Auth-Token':'b'.repeat(64)},401,'AUTH_INTEGRATION_REQUIRED'],
 ['unknown_user','POST',body,{'X-Ciw-Auth-Token':cfg.token},401,'INVALID_CREDENTIALS'],
 ['array','POST',[],{'X-Ciw-Auth-Token':cfg.token},400,'AUTH_INVALID_REQUEST'],
 ['extra_field','POST',{...body,table:'forged'},{'X-Ciw-Auth-Token':cfg.token},400,'AUTH_INVALID_REQUEST'],
 ['invalid_password_type','POST',{...body,password:123},{'X-Ciw-Auth-Token':cfg.token},400,'AUTH_INVALID_REQUEST'],
 ['missing_password','POST',{operation:'authenticate',username:body.username},{'X-Ciw-Auth-Token':cfg.token},400,'AUTH_INVALID_REQUEST'],
 ['method_get','GET',null,{'X-Ciw-Auth-Token':cfg.token},405,'AUTH_METHOD_NOT_ALLOWED'],
 ['method_options','OPTIONS',null,{'X-Ciw-Auth-Token':cfg.token},405,'AUTH_METHOD_NOT_ALLOWED'],
 ['malformed','POST','{"password":"CIW_AUTH_SYNTHETIC_NOT_REAL"',{'X-Ciw-Auth-Token':cfg.token},400,'AUTH_INVALID_REQUEST'],
 ['oversized','POST','x'.repeat(16385),{'X-Ciw-Auth-Token':cfg.token},400,'AUTH_INVALID_REQUEST'],
];
(async()=>{
 const results=[];
 for(const[name,method,payload,headers,status,code]of cases){
  const response=await fetch(cfg.url,{method,headers:{'Content-Type':'application/json',...headers},
   ...(payload===null?{}:{body:typeof payload==='string'?payload:JSON.stringify(payload)}),signal:AbortSignal.timeout(20000)});
  const text=await response.text();let data;
  try{data=JSON.parse(text);}catch{throw new Error(name+': resposta nao JSON, HTTP'+response.status);}
  assert.equal(response.status,status,name+':HTTP');
  assert.equal(data.success,false,name+':denial');
  assert.equal(data.error?.code,code,name+':code');
  assert.ok(!text.includes(cfg.token)&&!text.includes('CIW_AUTH_SYNTHETIC_NOT_REAL'),name+':no credential echo');
  assert.equal(response.headers.get('cache-control'),'no-store',name+':no-store');
  assert.ok(!response.headers.has('access-control-allow-origin'),name+':no browser CORS');
  results.push({name,status,code,passed:true});console.log('PASS '+name+' HTTP'+status+' '+code);
 }
 fs.writeFileSync(path.join(dir,'pasoe-negative-validation.json'),JSON.stringify({instance:'sursum-api',context:'med',businessWrites:false,cases:results,
  positiveCase:'pending_real_account_and_session',phase1AComplete:false},null,2)+'\n');
})().catch(e=>{console.error(e.message);process.exitCode=1;});
