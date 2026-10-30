'use strict';
// Cadastro/publicacao pelas APIs oficiais, sem alterar tabelas internas.
const fs=require('node:fs'),path=require('node:path'),crypto=require('node:crypto');
const assert=require('node:assert/strict');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/construtor-pg');
const metadata='D:/opencode/construtor-pg/integrations/ciw-containers';
const base='http://127.0.0.1:8765',prefix='/api/admin/program-builder';
const read=file=>fs.readFileSync(file,'utf8').replace(/^\uFEFF/,'');
const json=file=>JSON.parse(read(file));
const save=(name,data)=>fs.writeFileSync(path.join(state,name),JSON.stringify(data,null,2)+'\n');
let headers={'Content-Type':'application/json'};
async function api(route,body,method=body===undefined?'GET':'POST'){
 const r=await fetch(base+route,{method,headers,body:body===undefined?undefined:JSON.stringify(body)});
 const data=await r.json();
 if(!r.ok||data.error)throw new Error(route+' HTTP '+r.status+' '+(data.error?.code||'')+' '+(data.error?.message||''));
 return data;
}
(async()=>{
 const publish=process.argv.includes('--publish'),resume=process.argv.includes('--resume');
 const password=read(path.join(state,'acesso-local.txt')).split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const login=await api('/api/auth/login',{username:'admin',password,tenantId:'default',rememberMe:false});
 assert.equal(login.authenticated,true);
 headers={...headers,Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,
  'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 const locks=[];let grantId;
 try {
  const draft=json(path.join(metadata,'builder-draft.json')),source=json(path.join(metadata,'api-source.json'));
  const connection=json(path.join(state,'containers-connection.json'));
  source.authHeaders['X-Containers-Token']=connection.integrationToken;
  const savedSource=await api(prefix+'/api-sources',source);
  assert.equal(savedSource.apiSource.responseContract,'sursum-programs');
  assert.ok(!JSON.stringify(savedSource).includes(connection.integrationToken),'Credencial exposta pelo catalogo');
  const preview=await api(prefix+'/external/validate',draft);
  save('containers-preview.json',preview);
  assert.equal(preview.generatedDefinition.crud.query.pageSize,30);
  assert.equal(preview.generatedDefinition.crud.grid.columns.length,20);
  assert.equal(preview.generatedDefinition.crud.filter.fields.length,11);
  assert.equal(preview.generatedDefinition.crud.query.defaultGroup.length,2);
  assert.equal(preview.generatedDefinition.permissions.create,false);
  assert.equal(preview.generatedDefinition.permissions.edit,false);
  assert.equal(preview.generatedDefinition.permissions.delete,false);
  console.log('PASS: fonte API e consulta JSON validadas pelo builder real.');
  if(!publish)return;
  const logs={
   compiler:read(path.join(root,'.runtime/containers-compiled-20261016/compile-containers-tests-AMERICAN.log')),
   ablAmerican:read(path.join(root,'.runtime/containers-compiled-20261016/containers-tests-AMERICAN.log')),
   ablEuropean:read(path.join(root,'.runtime/containers-compiled-20261016/containers-tests-EUROPEAN.log')),
   php:read(path.join(root,'.runtime/containers-core-20261016/php-tests.log')),
   frontend:read(path.join(root,'.runtime/containers-core-20261016/frontend-tests.log'))
  };
  assert.match(logs.compiler,/OpenEdge 12\.2/);assert.ok(!/COMPILER:ERROR=yes|FAIL/.test(logs.compiler));
  assert.match(logs.ablAmerican,/^PASS [1-9][0-9]* checks NUMERIC-FORMAT=AMERICAN\s*$/m);
  assert.match(logs.ablEuropean,/^PASS [1-9][0-9]* checks NUMERIC-FORMAT=EUROPEAN\s*$/m);
  assert.ok(!/FAIL/.test(logs.ablAmerican+logs.ablEuropean));
  assert.match(logs.php,/OK \(/);assert.match(logs.frontend,/PASS/);
  assert.ok(!/node:internal|AssertionError|TimeoutError|^FAIL|^Error:/m.test(logs.frontend),'Smokes frontend possuem falhas');
  const bootstrap=await api(prefix+'/bootstrap');
  const existing=bootstrap.programs.filter(p=>(p.programCode||p.code)===draft.programDraft.programCode);
  let checkpoint={};
  if(resume){checkpoint=json(path.join(state,'containers-import-checkpoint.json'));}
  else assert.equal(existing.length,0,'Programa ja existe; revisar antes de importar novamente');
  const request=await api(prefix+'/governance/requests',{programCode:draft.programDraft.programCode,builderEntityCode:draft.entityDraft.code,
   requestedActions:['edit','publish'],reason:'Conversao da consulta Scriptcase de containers autorizada pelo usuario, com API Progress somente leitura e frontend existente.'});
  const grant=await api(prefix+'/governance/grants',{requestId:request.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']});
  grantId=grant.grant.id;
  for(const scope of [{type:'entity',code:draft.entityDraft.code},{type:'program',code:draft.programDraft.programCode}]){
   const lock=await api(prefix+'/locks/acquire',{scopeType:scope.type,scopeCode:scope.code,grantId,lockCategory:'authoring'});
   assert.equal(lock.status,'acquired');assert.ok(lock.lock.lockToken);locks.push(lock.lock.lockToken);
  }
  await api(prefix+'/entities',draft.entityDraft);
  const version=await api(prefix+'/drafts',{...draft.programDraft,...(checkpoint.versionId?{id:checkpoint.versionId}:{})});
  const versionId=version.id||version.version?.id;assert.ok(versionId);
  save('containers-import-checkpoint.json',{versionId,grantId,screenId:draft.programDraft.screenId});
  const bundleId='ciw-containers-'+crypto.randomUUID();
  await api(prefix+'/governance/tests',{builderProgramVersionId:versionId,bundleId,testPlanId:'ciw-containers-query',status:'passed',
   checklistSnapshot:{schema:true,php:true,abl:true,frontendExisting:true,readOnly:true},
   evidences:Object.entries(logs).map(([type,result])=>({type,result:result.trim()})),
   notes:'Testes reais de compilacao 12.2, temp-table e frontend existentes executados. Consulta operacional somente leitura sera validada apos publicacao.'});
  const approval=await api(prefix+'/governance/approvals',{builderProgramVersionId:versionId,bundleId});
  await api(prefix+'/versions/'+versionId+'/publish',{});
  save('containers-publicacao.json',{screenId:draft.programDraft.screenId,programCode:draft.programDraft.programCode,versionId,grantId,bundleId,approvalId:approval.approval.id});
  console.log('PASS: ciw.containers publicada pelo fluxo oficial do builder.');
 } finally {
  for(const lockToken of locks){try{await api(prefix+'/locks/release',{lockToken});}catch{}}
  if(grantId){try{await api(prefix+'/governance/grants/status',{grantId,status:'revoked'});}catch{}}
  await api('/api/auth/logout',{});
 }
})().catch(e=>{console.error(e.message);process.exitCode=1;});
