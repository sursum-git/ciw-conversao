'use strict';
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/iol-gerencial'),base='http://127.0.0.1:8765';
const read=p=>JSON.parse(fs.readFileSync(p,'utf8').replace(/^\uFEFF/,''));
let headers={'Content-Type':'application/json'};
async function request(route,body){const r=await fetch(base+route,{method:body===undefined?'GET':'POST',headers,body:body===undefined?undefined:JSON.stringify(body)});return {status:r.status,body:await r.json()};}
(async()=>{
 const access=read(path.join(state,'acesso-local-tadeu.json'));
 const login=await request('/api/auth/login',{username:access.username,password:access.password,tenantId:access.tenantId,rememberMe:false});assert.equal(login.body.authenticated,true);
 const l=login.body;headers={...headers,Authorization:'Bearer '+l.token,'X-Runtime-Auth-Token':l.token,'X-Runtime-Tenant-Id':l.tenantId,'X-Runtime-User-Id':String(l.user.id),'X-Runtime-Session-Id':l.session.sessionId};
 try{
  const screen='iol.inicial-gerencial',prefix='/api/runtime/screens/'+screen;
  const definition=await request(prefix);assert.equal(definition.status,200);
  console.log('Endpoint configs: '+JSON.stringify(definition.body.api));
  assert.equal(definition.body.permissions.materialize,false);
  const evidence={screenId:screen,checkedAt:new Date().toISOString(),definition:true,datasets:{}};
  for(const datasetId of ['resumo','vendedores']){
   const r=await request(prefix+'/endpoints/analytics.query.run',{datasetId,take:datasetId==='resumo'?1:1000});
   if(r.status!==200){console.log(JSON.stringify({datasetId,status:r.status,error:r.body.error||r.body}));throw Error('Consulta IOL falhou');}
   assert.ok(Array.isArray(r.body.data));if(datasetId==='resumo')assert.equal(r.body.data.length,1);
   evidence.datasets[datasetId]={status:r.status,rows:r.body.data.length,total:r.body.total};
   console.log(datasetId+': HTTP 200; '+r.body.data.length+' linha(s); valores preservados somente em memoria.');
  }
  const spoof=await request(prefix+'/endpoints/analytics.query.run',{datasetId:'resumo',take:1,login:'admin'});assert.equal(spoof.status,422);evidence.spoofRejected=true;
  const other=await request('/api/runtime/screens/ciw.containers');assert.equal(other.status,403);evidence.otherScreenDenied=true;
  const materialize=await request(prefix+'/endpoints/analytics.cache.materialize',{datasetId:'resumo'});assert.ok([403,404,422].includes(materialize.status));evidence.materializeDenied=true;
  fs.writeFileSync(path.join(state,'runtime-verification.json'),JSON.stringify(evidence,null,2));
  const publication=read(path.join(state,'metadata-publication.json'));publication.acceptancePending=false;publication.verifiedAt=evidence.checkedAt;fs.writeFileSync(path.join(state,'metadata-publication.json'),JSON.stringify(publication,null,2));
  console.log('PASS: identidade autenticada, leitura real, escopo de tela e materializacao bloqueada.');
 }finally{await request('/api/auth/logout',{});}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
