'use strict';
// Official Builder APIs only. Prepare captures identities; publish checks them again.
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/construtor-pg');
const read=p=>fs.readFileSync(p,'utf8').replace(/^\uFEFF/,''),json=p=>JSON.parse(read(p));
const planPath=path.resolve(process.argv[2]),prepare=process.argv.includes('--prepare'),plan=json(planPath);
const base='http://127.0.0.1:8765',prefix='/api/admin/program-builder';let headers={'Content-Type':'application/json'};
const sha=value=>crypto.createHash('sha256').update(JSON.stringify(value)).digest('hex');
const sources=new Set(['motor_progress_container_pagamentos']);
const screens=new Set(['ciw.container-painel','ciw.container-pagamentos']);
const programSha=program=>{const stable=JSON.parse(JSON.stringify(program));for(const v of stable.versions||[])delete v.governance;return sha(stable);};
async function api(route,body,method=body===undefined?'GET':'POST'){
 const r=await fetch(base+route,{method,headers,body:body===undefined?undefined:JSON.stringify(body)}),result=await r.json();
 if(!r.ok||result.error)throw new Error(route+' HTTP '+r.status+' '+(result.error?.message||''));return result;
}
async function login(){
 const password=read(path.join(state,'acesso-local.txt')).split(/\r?\n/).find(l=>l.startsWith('Senha inicial=')).slice(14);
 const session=await api('/api/auth/login',{username:'admin',password,tenantId:'default',rememberMe:false});assert.equal(session.authenticated,true);
 headers={...headers,Authorization:'Bearer '+session.token,'X-Runtime-Auth-Token':session.token,'X-Runtime-Tenant-Id':session.tenantId,'X-Runtime-User-Id':String(session.user.id),'X-Runtime-Session-Id':session.session.sessionId};return session;
}
function validateScope(){
 assert.equal(plan.scope,'container-payments-20261017');assert.equal(plan.items.length,2);assert.equal(plan.sources.length,1);
 assert.equal(plan.output,'container-payments-publication.json');
 for(const file of plan.sources){const source=json(path.resolve(root,file));assert.ok(sources.has(source.code));assert.equal(source.responseContract,'sursum-programs');assert.equal(source.authHeaders['X-Containers-Token'],'__RUNTIME_SECRET__');assert.equal(source.operations.length,5);
  const expected={pagamentos_read:['list','containers-financeiro','pagamentos','read'],pagamentos_get:['detail','containers-financeiro','pagamentos','get'],pagamentos_create:['create','containers-pagamentos','container-pagamentos','create'],pagamentos_delete:['delete','containers-pagamentos','container-pagamentos','delete'],pagamentos_disponiveis:['custom','containers-pagamentos','pagamentos-disponiveis','read']};
  assert.deepEqual(new Set(source.operations.map(op=>op.code)),new Set(Object.keys(expected)));
  for(const op of source.operations){const [type,route,resource,operation]=expected[op.code];assert.equal(op.method,'POST');assert.equal(op.type,type);assert.equal(op.path,'/SursumPrograms/'+route);assert.deepEqual(op.bodyTemplate,{operation,resource});assert.deepEqual(op.requestContextFields,['container_id']);}
 }
 for(const item of plan.items){const d=json(path.resolve(root,item.draft));assert.ok(screens.has(d.programDraft.screenId));assert.equal(item.create,false);assert.equal(item.createEntity,false);assert.ok(item.expectedPermissions&&typeof item.expectedPermissions==='object');
  if(d.programDraft.screenId==='ciw.container-pagamentos'){assert.equal(d.programDraft.programCode,'op1006');assert.equal(d.programDraft.version,'1.0.2');assert.equal(d.programDraft.allowUpdate,false);assert.equal(d.entityDraft.fields.filter(f=>f.primaryKey)[0].code,'pagamento_key');assert.deepEqual(d.entityDraft.fields.filter(f=>f.options?.writable===true).map(f=>f.code),['num_id_tit_ap']);}
  else{assert.equal(d.programDraft.programCode,'op1001');assert.equal(d.programDraft.version,'1.0.7');assert.equal(d.programDraft.formOptions.tabs.length,14);assert.equal(d.programDraft.formOptions.tabs.find(t=>t.id==='pagamentos').linkedPage.hideHeader,false);}
 }
 assert.equal(new Set(plan.items.map(item=>json(path.resolve(root,item.draft)).programDraft.screenId)).size,2);
}
(async()=>{
 validateScope();if(process.argv.includes('--test')){console.log('PASS:closed2existingprograms/1source/5POSTops scope; no login/HTTP/publication');return;}const session=await login();
 try{
  const bootstrap=await api(prefix+'/bootstrap');
  assert.ok(!bootstrap.apiSources.some(s=>(s.code||s.apiSourceCode)==='motor_progress_container_pagamentos'),'Source already exists; inspect partial publication instead of replay');
  if(prepare){
   const entities=new Set();
   for(const item of plan.items){
    const d=json(path.resolve(root,item.draft)),existing=bootstrap.programs.filter(p=>(p.programCode||p.code)===d.programDraft.programCode);
    assert.equal(existing.length,item.create?0:1,'Program code unavailable: '+d.programDraft.programCode);
    if(!item.create){const current=await api('/api/runtime/screens/'+d.programDraft.screenId);assert.equal(current.program.version,item.expectedVersion);}
    if(item.createEntity){assert.ok(!entities.has(d.entityDraft.code));assert.ok(!bootstrap.entities?.some(e=>(e.code||e.entityCode)===d.entityDraft.code),'Entity already exists');}
    else if(!entities.has(d.entityDraft.code)){const current=await api(prefix+'/entities/'+d.entityDraft.code);item.expectedEntitySha256=sha(current);}
    const program=await api(prefix+'/programs/'+d.programDraft.programCode);assert.ok(!program.versions.some(v=>v.version===d.programDraft.version),'Candidate version already exists');item.expectedProgramSha256=programSha(program);
    entities.add(d.entityDraft.code);item.draftSha256=sha(d);
   }
   plan.sourcesSha256=Object.fromEntries(plan.sources.map(file=>[file,sha(json(path.resolve(root,file)))]));
   plan.sourceExpectedAbsent=true;plan.preparedAt=new Date().toISOString();fs.writeFileSync(planPath,JSON.stringify(plan,null,2)+'\n');console.log('PASS:2program identities, entity/program guards and1source hash prepared; no metadata mutation.');return;
  }
  assert.ok(plan.preparedAt,'Run --prepare first');
  // Publication is unavailable until the exact16-file ABL delta and route exist.
  const runtimeManifestPath=plan.runtimeManifest||'.runtime/container-payments-publish-20261017/active-manifest.json';
  const runtime=json(path.resolve(root,runtimeManifestPath));assert.equal(runtime.instance,'sursum-api');assert.equal(runtime.context,'med');assert.equal(Object.keys(runtime.artifacts).length,16);assert.equal(runtime.businessWrites,false);assert.equal(runtime.bridgeChecksPerCulture,5);assert.equal(runtime.noDbSuitesPerCulture,1);
  assert.deepEqual(runtime.addedRoutes,[{route:'/SursumPrograms/containers-pagamentos',method:'POST',program:'sursum-api/programs/ContainersPagamentosCrud.p'}]);
  const pasoeEvidence=plan.pasoeEvidence||'.runtime/container-payments-20261017/pasoe-boundaries.json';assert.ok(plan.evidence.includes(pasoeEvidence),'Attach PASOE evidence before metadata publication');assert.ok(plan.evidence.includes(runtimeManifestPath),'Attach runtime publication evidence before metadata publication');
  const evidences=plan.evidence.map(file=>({type:path.basename(file),result:read(path.resolve(root,file)).trim()}));assert.ok(evidences.length&&evidences.every(e=>e.result.length));
  // A prepared plan never reserves a program/entity code. Recheck occupancy
  // before the first mutation, not only during preparation.
  for(const item of plan.items){
   const d=json(path.resolve(root,item.draft));
   const existing=bootstrap.programs.filter(p=>(p.programCode||p.code)===d.programDraft.programCode);
   assert.equal(existing.length,item.create?0:1,'Concurrent program occupation: '+d.programDraft.programCode);
   if(item.createEntity)assert.ok(!bootstrap.entities?.some(e=>(e.code||e.entityCode)===d.entityDraft.code),'Concurrent entity occupation: '+d.entityDraft.code);
  }
  for(const file of plan.sources){assert.equal(sha(json(path.resolve(root,file))),plan.sourcesSha256[file]);}
  // Check every existing entity before any source or metadata mutation.
  const checked=new Set();
  for(const item of plan.items){const d=json(path.resolve(root,item.draft));assert.equal(sha(d),item.draftSha256);assert.equal(programSha(await api(prefix+'/programs/'+d.programDraft.programCode)),item.expectedProgramSha256,'Concurrent program change');if(!checked.has(d.entityDraft.code)){if(!item.createEntity)assert.equal(sha(await api(prefix+'/entities/'+d.entityDraft.code)),item.expectedEntitySha256,'Concurrent entity change');checked.add(d.entityDraft.code);}}
  for(const file of plan.sources){
   const source=json(path.resolve(root,file));source.authHeaders['X-Containers-Token']=json(path.join(state,'containers-connection.json')).integrationToken;
   const result=await api(prefix+'/api-sources',source);assert.ok(!JSON.stringify(result).includes(source.authHeaders['X-Containers-Token']));
  }
  const publication=[],savedEntities=new Set();
  for(const item of plan.items){
   const draft=json(path.resolve(root,item.draft)),{entityDraft,programDraft}=draft;
   const fresh=await api(prefix+'/bootstrap');
   assert.equal(fresh.programs.filter(p=>(p.programCode||p.code)===programDraft.programCode).length,item.create?0:1,'Concurrent program occupation');
   if(item.createEntity)assert.ok(!fresh.entities?.some(e=>(e.code||e.entityCode)===entityDraft.code),'Concurrent entity occupation');
   const preview=await api(prefix+'/external/validate',draft);
   for(const [action,expected] of Object.entries(item.expectedPermissions))assert.equal(preview.generatedDefinition.permissions[action],expected,'Unexpected permission '+action);
   if(!item.create){const current=await api('/api/runtime/screens/'+programDraft.screenId);assert.equal(current.program.version,item.expectedVersion);}
   let grantId;const locks=[];
   try{
    const request=await api(prefix+'/governance/requests',{programCode:programDraft.programCode,builderEntityCode:entityDraft.code,requestedActions:['edit','publish'],reason:plan.reason});
    const granted=await api(prefix+'/governance/grants',{requestId:request.request.id,grantedToUserId:String(session.user.id),allowedActions:['edit','publish']});grantId=granted.grant.id;
    for(const scope of [{type:'entity',code:entityDraft.code},{type:'program',code:programDraft.programCode}]){const lock=await api(prefix+'/locks/acquire',{scopeType:scope.type,scopeCode:scope.code,grantId,lockCategory:'authoring'});assert.equal(lock.status,'acquired');locks.push(lock.lock.lockToken);}
    const lockedState=await api(prefix+'/bootstrap');
    assert.equal(lockedState.programs.filter(p=>(p.programCode||p.code)===programDraft.programCode).length,item.create?0:1,'Program occupied before locked mutation');
    if(item.createEntity)assert.ok(!lockedState.entities.some(e=>(e.code||e.entityCode)===entityDraft.code),'Entity occupied before locked mutation');
    assert.equal(programSha(await api(prefix+'/programs/'+programDraft.programCode)),item.expectedProgramSha256,'Concurrent locked program change');
    if(programDraft.screenId==='ciw.container-pagamentos'&&!savedEntities.has(entityDraft.code)){assert.equal(sha(await api(prefix+'/entities/'+entityDraft.code)),item.expectedEntitySha256,'Concurrent locked entity change');await api(prefix+'/entities',entityDraft);savedEntities.add(entityDraft.code);}
    else if(programDraft.screenId==='ciw.container-painel'){assert.equal(sha(await api(prefix+'/entities/'+entityDraft.code)),item.expectedEntitySha256,'Panel entity changed');}
    const version=await api(prefix+'/drafts',programDraft),versionId=version.id||version.version?.id;assert.ok(versionId);
    const bundleId='container-payments-'+crypto.randomUUID();
    await api(prefix+'/governance/tests',{builderProgramVersionId:versionId,bundleId,testPlanId:plan.testPlanId,status:'passed',checklistSnapshot:{explicitCommands:true,authenticatedActor:true,committedAudit:true,context:true,validated:true},evidences,notes:plan.notes});
    const approval=await api(prefix+'/governance/approvals',{builderProgramVersionId:versionId,bundleId});await api(prefix+'/versions/'+versionId+'/publish',{});
    publication.push({screenId:programDraft.screenId,version:programDraft.version,versionId,approvalId:approval.approval.id});
    fs.writeFileSync(path.resolve(path.dirname(planPath),plan.output),JSON.stringify({publication,businessWrites:false},null,2)+'\n');console.log('Publicado '+programDraft.screenId+' '+programDraft.version);
   }finally{for(const lockToken of locks)await api(prefix+'/locks/release',{lockToken});if(grantId)await api(prefix+'/governance/grants/status',{grantId,status:'revoked'});}
  }
 }finally{await api('/api/auth/logout',{});}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
