'use strict';
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const state=path.resolve(__dirname,'../../.runtime/construtor-pg');
const base='http://127.0.0.1:8765';
const raw='http://127.0.0.1:19910/med/web/SursumPrograms/empresas';
async function json(url,body,headers={},status=200){
 const r=await fetch(url,{method:body===undefined?'GET':'POST',headers:{'Content-Type':'application/json',...headers},body:body===undefined?undefined:JSON.stringify(body)});
 const j=await r.json();assert.equal(r.status,status,j.error?.code||url);return j;
}
(async()=>{
 const token=JSON.parse(fs.readFileSync(path.join(state,'empresas-connection.json'),'utf8').replace(/^\uFEFF/,'' )).integrationToken;
 for(const header of [{},{'X-Empresas-Token':'invalid-token-'.repeat(5)}]){
  const denied=await json(raw,{operation:'read'},header);
  assert.equal(denied.error.code,'EMPRESA_AUTH_REQUIRED');assert.equal(denied.success,false);
 }
 const rows=await json(raw,{operation:'read'},{'X-Empresas-Token':token});assert.ok(Array.isArray(rows.data));
 const missing=await json(raw,{operation:'get',id:2147483647},{'X-Empresas-Token':token});
 assert.equal(missing.error.code,'EMPRESA_NOT_FOUND');assert.equal(missing.success,false);
 const pw=fs.readFileSync(path.join(state,'acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const login=await json(base+'/api/auth/login',{username:'admin',password:pw,tenantId:'default',rememberMe:false});
 const headers={Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,
  'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 try{
  const definition=await json(base+'/api/runtime/screens/ciw.empresas',undefined,headers);
  assert.ok(!JSON.stringify(definition).includes(token));
  const data=await json(base+'/api/runtime/screens/ciw.empresas/endpoints/read',{take:1,skip:0},headers);
  assert.equal(data.data.length,Math.min(1,rows.data.length));assert.equal(data.total,rows.data.length);
  const error=await json(base+'/api/runtime/screens/ciw.empresas/endpoints/get',{id:2147483647},headers,404);
  assert.equal(error.error.code,'EMPRESA_NOT_FOUND');
  fs.writeFileSync(path.join(state,'empresas-read-evidence.json'),JSON.stringify({at:new Date().toISOString(),total:data.total,
   headerAuthentication:true,missingAndWrongCredentialsDenied:true,publicDefinitionNoSecret:true,pagination:true,error404Translated:true},null,2));
  console.log('PASS: API publicada usa cabeçalho; credenciais ausente/inválida recusadas; consulta PHP e paginação reais; erro Progress HTTP200 traduzido em HTTP404; segredo ausente da tela.');
 }finally{await json(base+'/api/auth/logout',{},headers);}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
