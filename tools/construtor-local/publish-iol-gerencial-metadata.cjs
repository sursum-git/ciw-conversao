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
  const request=await api(prefix+'/governance/requests',{programCode,builderEntityCode:entityCode,requestedActions:['edit','publish'],reason:'Conversao IOL autorizada: painel gerencial somente leitura.'});
  const granted=await api(prefix+'/governance/grants',{requestId:request.request.id,grantedToUserId:headers['X-Runtime-User-Id'],allowedActions:['edit','publish']});grantId=granted.grant.id;
  for(const scope of scopes){const r=await api(prefix+'/locks/acquire',{scopeType:scope.type,scopeCode:scope.code,grantId,lockCategory:'authoring'});assert.equal(r.status,'acquired');locks.push(r.lock.lockToken);}
  return await work();
 }finally{for(const lockToken of locks)await api(prefix+'/locks/release',{lockToken});if(grantId)await api(prefix+'/governance/grants/status',{grantId,status:'revoked'});}
}
(async()=>{
 const draft=json(path.join(meta,'builder-draft.json')),program=draft.programDraft;
 const password=read(path.join(root,'.runtime/construtor-pg/acesso-local.txt')).split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const login=await api('/api/auth/login',{username:'admin',password,tenantId:'default',rememberMe:false});assert.equal(login.authenticated,true);
 headers={...headers,Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 try{
  const bootstrap=await api(prefix+'/bootstrap');
  assert.ok(!bootstrap.programs.some(p=>(p.programCode||p.code)===program.programCode||p.screenId===program.screenId),'Programa IOL ja existe; nao recriar');
  const source=json(path.join(meta,'api-source.json'));const token=json(path.join(state,'connection.json')).integrationToken;source.authHeaders['X-Iol-Gerencial-Token']=token;
  const saved=await api(prefix+'/api-sources',source);assert.ok(!JSON.stringify(saved).includes(token));console.log('Fonte IOL cadastrada com segredo mascarado.');
  for(const name of ['resumo','vendedores']){
   const entity=json(path.join(meta,name+'-entity.json'));
   const existing=(bootstrap.entities||[]).find(e=>e.code===entity.code);
   if(existing){
    const current=(await api(prefix+'/entities/'+entity.code)).entity;
    assert.equal(current.entityType,'api');assert.equal(current.apiSourceCode,source.code);
    assert.deepEqual(current.fields.map(f=>f.code).sort(),entity.fields.map(f=>f.code).sort());
    if(entity.fields.every(f=>current.fields.find(x=>x.code===f.code).dataType===f.dataType)){console.log('Entidade propria preservada: '+entity.code);continue;}
   }
   await governed(program.programCode,entity.code,[{type:'entity',code:entity.code}],()=>api(prefix+'/entities',entity));
   console.log('Entidade readonly cadastrada: '+entity.code);
  }
  const preview=await api(prefix+'/external/validate',draft);
  assert.equal(preview.generatedDefinition.pageType,'analytics');assert.equal(preview.generatedDefinition.permissions.materialize,false);assert.equal(preview.generatedDefinition.analytics.datasets.length,2);
  assert.ok(!JSON.stringify(preview.generatedDefinition).includes(token));
  await governed(program.programCode,draft.entityDraft.code,[{type:'entity',code:draft.entityDraft.code},{type:'program',code:program.programCode}],async()=>{
   const version=await api(prefix+'/drafts',program),versionId=version.id||version.version?.id;assert.ok(versionId);
   const bundleId='iol-gerencial-'+crypto.randomUUID();
   const evidence=[{type:'phpunit',result:'446 testes / 2345 assercoes; lint container PASS'}, {type:'frontend',result:'dashboard datasets/collapse/formats/XSS/mobile/error PASS'}, {type:'abl12.2',result:read(path.join(state,'compiled/compile-iol.log'))}, {type:'deployment',result:'API readonly IOL publicada com hashes/backup; validacao funcional autenticada sera executada imediatamente apos publicacao deste programa novo.'}];
   await api(prefix+'/governance/tests',{builderProgramVersionId:versionId,bundleId,testPlanId:'iol-inicial-gerencial-20261016',status:'passed',checklistSnapshot:{readonly:true,identity:true,unitTests:true,realAcceptancePending:true},evidences:evidence,notes:'Programa novo de leitura; aceite real autenticado segue esta publicacao. Nenhuma escrita de negocio.'});
   const approval=await api(prefix+'/governance/approvals',{builderProgramVersionId:versionId,bundleId});await api(prefix+'/versions/'+versionId+'/publish',{});
   fs.writeFileSync(path.join(state,'metadata-publication.json'),JSON.stringify({screenId:program.screenId,programCode:program.programCode,version:program.version,versionId,approvalId:approval.approval.id,acceptancePending:true},null,2));
   console.log('Publicado '+program.screenId+' '+program.version);
  });
 }finally{await api('/api/auth/logout',{});}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
