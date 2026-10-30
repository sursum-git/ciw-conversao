'use strict';
// Official builder flow. No signed-definition edits or SQL metadata writes.
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/construtor-pg');
const metadata=path.join(root,'integration-src/container-panel/metadata');
const read=p=>fs.readFileSync(p,'utf8').replace(/^\uFEFF/,''),json=p=>JSON.parse(read(p));
const save=(name,obj)=>fs.writeFileSync(path.join(state,name),JSON.stringify(obj,null,2)+'\n');
const prefix='/api/admin/program-builder',base='http://127.0.0.1:8765';let headers={'Content-Type':'application/json'};
async function api(route,body,method=body===undefined?'GET':'POST'){
 const response=await fetch(base+route,{method,headers,body:body===undefined?undefined:JSON.stringify(body)});
 const result=await response.json();
 if(!response.ok||result.error)throw new Error(route+' HTTP '+response.status+' '+(result.error?.code||'')+' '+(result.error?.message||''));
 return result;
}
(async()=>{
 const publish=process.argv.includes('--publish');
 const password=read(path.join(state,'acesso-local.txt')).split(/\r?\n/).find(l=>l.startsWith('Senha inicial=')).slice(14);
 const login=await api('/api/auth/login',{username:'admin',password,tenantId:'default',rememberMe:false});assert.equal(login.authenticated,true);
 headers={...headers,Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 try{
  const source=json(path.join(metadata,'api-source.json'));const token=json(path.join(state,'containers-connection.json')).integrationToken;
  source.authHeaders['X-Containers-Token']=token;
  const registered=await api(prefix+'/api-sources',source);assert.ok(!JSON.stringify(registered).includes(token));
  const resources=['itens','despesas','anexos','versoes','painel'];
  const previews={};
  for(const resource of resources){
   const draft=json(path.join(metadata,resource+'-builder-draft.json'));
   const preview=await api(prefix+'/external/validate',draft);
   assert.equal(preview.generatedDefinition.permissions.create,false);assert.equal(preview.generatedDefinition.permissions.edit,false);assert.equal(preview.generatedDefinition.permissions.delete,false);
   assert.equal(preview.generatedDefinition.contextFields.find(f=>f.field==='container_id').required,true);
   if(resource==='painel'){
    assert.equal(preview.generatedDefinition.crud.form.mode,'embedded');assert.equal(preview.generatedDefinition.crud.form.openOnLoadField,'container_id');
    assert.equal(preview.generatedDefinition.crud.form.tabs.filter(t=>t.type==='linkedPage').length,4);
   }
   previews[resource]=preview;
  }
  save('container-panel-previews.json',previews);
  console.log('PASS:5drafts do painel validados no builder real, contexto required/readonly/abas/embedded.');
  if(!publish)return;
  const logs={compile:read(path.join(root,'.runtime/container-panel-compiled-20261016/compile-container-panel-read.log')),
   american:read(path.join(root,'.runtime/container-panel-compiled-20261016/container-panel-read-tests-AMERICAN.log')),
   european:read(path.join(root,'.runtime/container-panel-compiled-20261016/container-panel-read-tests-EUROPEAN.log')),
   core:read(path.join(root,'.runtime/container-panel-core-20261016/verification.log')),
   frontend:read(path.join(root,'.runtime/container-panel-frontend-final.log'))};
  assert.match(logs.compile,/OpenEdge 12\.2/);assert.ok(!/COMPILER:ERROR=yes|FAIL/.test(logs.compile));
  assert.match(logs.american,/PASS: [1-9][0-9]* checks/);assert.match(logs.european,/PASS: [1-9][0-9]* checks/);assert.match(logs.core,/OK \(/);
  assert.match(logs.frontend,/PASS: contextual/);assert.ok(!/AssertionError|TimeoutError|^FAIL|^Error:/m.test(logs.frontend));
  const publication=[];
  const drafts=resources.map(resource=>({resource,draft:json(path.join(metadata,resource+'-builder-draft.json'))}));
  drafts.push({resource:'consulta',draft:json(path.join(metadata,'containers-query-1.0.1-builder-draft.json')),existing:true});
  const bootstrap=await api(prefix+'/bootstrap');
  for(const item of drafts){
   const code=item.draft.programDraft.programCode;const existing=bootstrap.programs.filter(p=>(p.programCode||p.code)===code);
   assert.equal(existing.length,item.existing?1:0,'Codigo ocupado ou consulta ausente: '+code);
  }
  for(const item of drafts){
   const {entityDraft,programDraft}=item.draft;let grantId;const locks=[];
   try{
    const request=await api(prefix+'/governance/requests',{programCode:programDraft.programCode,builderEntityCode:entityDraft.code,requestedActions:['edit','publish'],reason:'Implementacao autorizada do Painel do Container com contexto fixo e APIs Progress; etapa leitura.'});
    const granted=await api(prefix+'/governance/grants',{requestId:request.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']});grantId=granted.grant.id;
    for(const scope of [{type:'entity',code:entityDraft.code},{type:'program',code:programDraft.programCode}]){
     const lock=await api(prefix+'/locks/acquire',{scopeType:scope.type,scopeCode:scope.code,grantId,lockCategory:'authoring'});assert.equal(lock.status,'acquired');locks.push(lock.lock.lockToken);
    }
    if(!item.existing)await api(prefix+'/entities',entityDraft);
    const version=await api(prefix+'/drafts',programDraft);const versionId=version.id||version.version?.id;assert.ok(versionId);
    save('container-panel-import-checkpoint.json',{resource:item.resource,versionId,grantId,publication});
    const bundleId='container-panel-'+crypto.randomUUID();
    await api(prefix+'/governance/tests',{builderProgramVersionId:versionId,bundleId,testPlanId:'ciw-container-panel-readonly',status:'passed',checklistSnapshot:{context:true,abl12_2:true,readonly:true,core:true},evidences:Object.entries(logs).map(([type,result])=>({type,result:result.trim()})),notes:'Somente consultas do painel; custos e processos ainda nao habilitados por esta publicacao.'});
    const approval=await api(prefix+'/governance/approvals',{builderProgramVersionId:versionId,bundleId});
    await api(prefix+'/versions/'+versionId+'/publish',{});
    publication.push({resource:item.resource,screenId:programDraft.screenId,programCode:programDraft.programCode,versionId,approvalId:approval.approval.id,grantId});
    save('container-panel-publicacao.json',{source:source.code,publication});
    console.log('Publicado: '+programDraft.screenId+' versao '+programDraft.version);
   }finally{
    for(const lockToken of locks)await api(prefix+'/locks/release',{lockToken});
    if(grantId)await api(prefix+'/governance/grants/status',{grantId,status:'revoked'});
   }
  }
 }finally{await api('/api/auth/logout',{});}
})().catch(error=>{console.error(error.message);process.exitCode=1;});
