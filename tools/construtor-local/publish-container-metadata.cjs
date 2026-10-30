'use strict';
// Official Builder/governance update, with expected current version and cleanup.
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/construtor-pg');
const read=p=>fs.readFileSync(p,'utf8').replace(/^\uFEFF/,''),json=p=>JSON.parse(read(p));
const plan=json(path.resolve(process.argv[2]));
const prefix='/api/admin/program-builder',base='http://127.0.0.1:8765';let headers={'Content-Type':'application/json'};
async function api(route,body,method=body===undefined?'GET':'POST'){
 const response=await fetch(base+route,{method,headers,body:body===undefined?undefined:JSON.stringify(body)});const result=await response.json();
 if(!response.ok||result.error)throw new Error(route+' HTTP '+response.status+' '+(result.error?.message||''));return result;
}
(async()=>{
 const evidence=plan.evidence.map(file=>({type:path.basename(file),result:read(path.resolve(root,file)).trim()}));
 assert.ok(evidence.length>0);assert.ok(evidence.every(e=>e.result.length>0));
 const password=read(path.join(state,'acesso-local.txt')).split(/\r?\n/).find(l=>l.startsWith('Senha inicial=')).slice(14);
 const login=await api('/api/auth/login',{username:'admin',password,tenantId:'default',rememberMe:false});assert.equal(login.authenticated,true);
 headers={...headers,Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 const publication=[];
 try{
  if(plan.source){const source=json(path.resolve(root,plan.source));source.authHeaders['X-Containers-Token']=json(path.join(state,'containers-connection.json')).integrationToken;const response=await api(prefix+'/api-sources',source);assert.ok(!JSON.stringify(response).includes(source.authHeaders['X-Containers-Token']));}
  const bootstrap=await api(prefix+'/bootstrap');
  for(const item of plan.items){
   const draft=json(path.resolve(root,item.draft)),{entityDraft,programDraft}=draft;
   const existing=bootstrap.programs.filter(p=>(p.programCode||p.code)===programDraft.programCode);
   assert.equal(existing.length,item.create?0:1,'Unexpected program state '+programDraft.programCode);
   if(!item.create){
    const current=await api('/api/runtime/screens/'+programDraft.screenId);
    const definition=current.definition||current.screen||current;
    assert.equal(definition.program.version,item.expectedVersion,'Published version changed '+programDraft.screenId);
   }
   const preview=await api(prefix+'/external/validate',draft);assert.equal(preview.generatedDefinition.permissions.create,false);assert.equal(preview.generatedDefinition.permissions.edit,false);assert.equal(preview.generatedDefinition.permissions.delete,false);
   let grantId;const locks=[];
   try{
    const request=await api(prefix+'/governance/requests',{programCode:programDraft.programCode,builderEntityCode:entityDraft.code,requestedActions:['edit','publish'],reason:plan.reason});
    const granted=await api(prefix+'/governance/grants',{requestId:request.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']});grantId=granted.grant.id;
    for(const scope of [{type:'entity',code:entityDraft.code},{type:'program',code:programDraft.programCode}]){const lock=await api(prefix+'/locks/acquire',{scopeType:scope.type,scopeCode:scope.code,grantId,lockCategory:'authoring'});assert.equal(lock.status,'acquired');locks.push(lock.lock.lockToken);}
    if(item.create)await api(prefix+'/entities',entityDraft);
    const version=await api(prefix+'/drafts',programDraft);const versionId=version.id||version.version?.id;assert.ok(versionId);
    const bundleId='container-panel-'+crypto.randomUUID();
    await api(prefix+'/governance/tests',{builderProgramVersionId:versionId,bundleId,testPlanId:plan.testPlanId,status:'passed',checklistSnapshot:{readonly:true,context:true,validated:true},evidences:evidence,notes:plan.notes});
    const approval=await api(prefix+'/governance/approvals',{builderProgramVersionId:versionId,bundleId});await api(prefix+'/versions/'+versionId+'/publish',{});
    publication.push({screenId:programDraft.screenId,version:programDraft.version,versionId,approvalId:approval.approval.id});
    fs.writeFileSync(path.join(state,plan.output),JSON.stringify({publication},null,2)+'\n');console.log('Publicado '+programDraft.screenId+' '+programDraft.version);
   }finally{for(const lockToken of locks)await api(prefix+'/locks/release',{lockToken});if(grantId)await api(prefix+'/governance/grants/status',{grantId,status:'revoked'});}
  }
 }finally{await api('/api/auth/logout',{});}
})().catch(error=>{console.error(error.message);process.exitCode=1;});
