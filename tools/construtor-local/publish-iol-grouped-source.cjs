'use strict';
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/iol-gerencial'),meta=path.join(root,'integration-src/iol-pagina-inicial-gerencial/metadata');
const read=p=>fs.readFileSync(p,'utf8').replace(/^\uFEFF/,''),json=p=>JSON.parse(read(p));
const base='http://127.0.0.1:8765',prefix='/api/admin/program-builder';let headers={'Content-Type':'application/json'};
async function api(route,body,method=body===undefined?'GET':'POST'){
 const r=await fetch(base+route,{method,headers,body:body===undefined?undefined:JSON.stringify(body)});const b=await r.json();
 if(!r.ok||b.error)throw Error(route+' HTTP '+r.status+' '+(b.error?.message||''));return b;
}
async function governed(programCode,entityCode,scopes,work){
 let grantId;const locks=[];
 try{
  const request=await api(prefix+'/governance/requests',{programCode,builderEntityCode:entityCode,requestedActions:['edit','publish'],reason:'Otimizacao IOL autorizada: leitura unificada sem alterar campos ou permissoes.'});
  const granted=await api(prefix+'/governance/grants',{requestId:request.request.id,grantedToUserId:headers['X-Runtime-User-Id'],allowedActions:['edit','publish']});grantId=granted.grant.id;
  for(const scope of scopes){const r=await api(prefix+'/locks/acquire',{scopeType:scope.type,scopeCode:scope.code,grantId,lockCategory:'authoring'});assert.equal(r.status,'acquired');locks.push(r.lock.lockToken);}
  return await work();
 }finally{for(const lockToken of locks)await api(prefix+'/locks/release',{lockToken});if(grantId)await api(prefix+'/governance/grants/status',{grantId,status:'revoked'});}
}
(async()=>{
 const password=read(path.join(root,'.runtime/construtor-pg/acesso-local.txt')).split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const login=await api('/api/auth/login',{username:'admin',password,tenantId:'default',rememberMe:false});assert.equal(login.authenticated,true);
 headers={...headers,Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 try{
  const code='motor_progress_iol_gerencial',source=(await api(prefix+'/api-sources/'+code)).apiSource;
  assert.equal(source.responseContract,'sursum-programs');assert.equal(source.operations.length,2);
  const before=structuredClone(source);const entities=[];
  for(const [operation,resource] of [['read_resumo','resumo'],['read_vendedores','vendedores']]){
   const op=source.operations.find(o=>o.code===operation);assert.ok(op);assert.equal(op.method,'POST');assert.ok(['/SursumPrograms/iol-inicial-gerencial','http://127.0.0.1:19910/med/web/SursumPrograms/iol-inicial-gerencial'].includes(op.path));assert.equal(op.type,'list');assert.equal(op.bodyTemplate.operation,'read');assert.ok([resource,'painel'].includes(op.bodyTemplate.resource));
   op.bodyTemplate={operation:'read',resource:'painel'};op.itemsPath='data.'+resource;
   const entity=(await api(prefix+'/entities/iol_gerencial_'+resource+'_progress')).entity;assert.equal(entity.entityType,'api');assert.equal(entity.apiSourceCode,code);assert.equal(entity.apiListOperationCode,operation);
   assert.ok(!entity.apiCreateOperationCode&&!entity.apiUpdateOperationCode&&!entity.apiDeleteOperationCode);entities.push(entity);
  }
  fs.writeFileSync(path.join(state,'grouped-source-before.json'),JSON.stringify({source:before,entities},null,2));
  const token=json(path.join(state,'connection.json')).integrationToken;source.authHeaders={'X-Iol-Gerencial-Token':token};
  const result=await api(prefix+'/api-sources',source);assert.ok(!JSON.stringify(result).includes(token));
  for(const entity of entities){await governed('op1012',entity.code,[{type:'entity',code:entity.code},{type:'program',code:'op1012'}],()=>api(prefix+'/entities',entity));console.log('Projecao readonly atualizada: '+entity.code);}
  const current=(await api(prefix+'/api-sources/'+code)).apiSource;
  assert.ok(current.operations.every(op=>op.bodyTemplate.resource==='painel'));
  fs.writeFileSync(path.join(state,'grouped-source-publication.json'),JSON.stringify({at:new Date().toISOString(),code,operations:current.operations.map(o=>({code:o.code,resource:o.bodyTemplate.resource,itemsPath:o.itemsPath}))},null,2));
  const example=json(path.join(meta,'api-source.json'));for(const op of example.operations){op.bodyTemplate.resource='painel';op.itemsPath=op.code==='read_resumo'?'data.resumo':'data.vendedores';}fs.writeFileSync(path.join(meta,'api-source.json'),JSON.stringify(example,null,2)+'\n');
  console.log('Fonte IOL agora usa uma resposta painel para as duas projecoes.');
 }finally{await api('/api/auth/logout',{});}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
