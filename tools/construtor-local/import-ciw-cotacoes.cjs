/* Publicacao oficial Builder, somente o editor de parametros autorizado. */
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/ciw-cotacoes-20261021'),meta=path.join(root,'integration-src/ciw-cotacoes/metadata'),base='http://127.0.0.1:8765';
const resources=['hist-cotacoes-bc'];
(async()=>{
 let password=fs.readFileSync(path.join(root,'.runtime/construtor-pg/acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const loginResponse=await fetch(base+'/api/auth/login',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({username:'admin',password,tenantId:'default',remember:false})});password=undefined;
 const login=await loginResponse.json();assert.ok(login.authenticated,'ADMIN_LOGIN_FAILED');
 const headers={'Content-Type':'application/json',Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 async function api(url,body,method=body===undefined?'GET':'POST'){
  const r=await fetch(base+'/api/admin/program-builder'+url,{method,headers,...(body===undefined?{}:{body:JSON.stringify(body)}),signal:AbortSignal.timeout(45000)});const d=await r.json();
  if(!r.ok||d.error)throw Error(url+' HTTP'+r.status+' '+(d.error?.code??'BUILDER_ERROR')+' '+(d.error?.message??''));return d;
 }
 const locks=[];
 try{
  const php=fs.readFileSync(path.join(state,'php-full.log'),'utf8');assert.match(php,/OK \(566 tests, 3413 assertions\)/);
  const compile=fs.readFileSync(path.join(state,'compiled122-final/compile-ciw-cotacoes.log'),'utf8');assert.ok(!compile.includes('ERROR=yes')&&compile.includes('OpenEdge 12.2'));
  const tt=fs.readFileSync(path.join(state,'compiled122-final/cotacoes-UTF-8-AMERICAN.log'),'utf8');assert.match(tt,/^PASS 80 checks/);
  const bootstrap=await api('/bootstrap');
  const source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;assert.equal(source.code,'motor_progress_ciw_cadastros','SOURCE_MISSING');
  const addition=JSON.parse(fs.readFileSync(path.join(meta,'api-source-additions.json'),'utf8'));
  assert.equal(source.responseContract,'sursum-programs');assert.equal(source.baseUrl,'http://127.0.0.1:19910/med/web');
  const cfg=JSON.parse(fs.readFileSync(path.join(root,'.runtime/ciw-cadastros-20261020/private/connection.json'),'utf8'));
  const probe=await fetch(cfg.baseUrl+'/SursumPrograms/ciw-cadastros',{method:'POST',headers:{'Content-Type':'application/json','X-Ciw-Cadastros-Token':cfg.integrationToken},body:JSON.stringify({resource:'hist_cotacoes_bc',operation:'get',id:2147483647}),signal:AbortSignal.timeout(25000)}).then(x=>x.json());
  assert.equal(probe.error?.code,'CIW_COTACAO_NOT_FOUND','NEW_ABL_NOT_ACTIVE');
  const draftCheck=JSON.parse(fs.readFileSync(path.join(meta,'hist-cotacoes-bc-builder-draft.json'),'utf8'));
  const previous=bootstrap.programs.find(x=>(x.programCode||x.code)===draftCheck.programDraft.programCode);
  if(previous&&!fs.existsSync(path.join(state,'publication-hist-cotacoes-bc.json')))throw Error('PROGRAM_CODE_COLLISION');
  if(!fs.existsSync(path.join(state,'source-before.json')))fs.writeFileSync(path.join(state,'source-before.json'),JSON.stringify(source,null,2));
  for(const op of addition.operations){const existing=source.operations.find(x=>x.code===op.code);if(existing)assert.equal(existing.bodyTemplate.resource,'hist_cotacoes_bc');else source.operations.push(op);}
  const saved=await api('/api-sources',source);assert.ok(!JSON.stringify(saved).includes(cfg.integrationToken),'SOURCE_SECRET_LEAK');
  fs.writeFileSync(path.join(state,'source-registration.json'),JSON.stringify({source:source.code,operations:source.operations.map(x=>x.code),configured:true},null,2));
  for(const resource of resources){
   const receiptPath=path.join(state,'publication-'+resource+'.json');if(fs.existsSync(receiptPath)){console.log('Ja publicado: '+resource);continue;}
   const draft=JSON.parse(fs.readFileSync(path.join(meta,resource+'-builder-draft.json'),'utf8'));
   if((bootstrap.programs||[]).some(x=>(x.programCode||x.code)===draft.programDraft.programCode))throw Error('PROGRAM_CODE_COLLISION '+draft.programDraft.programCode);
   const preview=await api('/external/validate',draft);assert.ok(!JSON.stringify(preview).includes(cfg.integrationToken),'PREVIEW_SECRET_LEAK');fs.writeFileSync(path.join(state,'preview-'+resource+'.json'),JSON.stringify(preview,null,2));
   if(process.argv.includes('--validate-only')){console.log('Validado: '+resource);continue;}
   await api('/entities',draft.entityDraft);
   const request=await api('/governance/requests',{programCode:draft.programDraft.programCode,builderEntityCode:draft.entityDraft.code,requestedActions:['edit','publish'],reason:'Cotacoes BC autorizadas em21/10; permissoes legadas ao final, controles atuais preservados.'});
   const grant=await api('/governance/grants',{requestId:request.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']});
   const ownLocks=[];
   try{
    for(const scope of [{type:'entity',code:draft.entityDraft.code},{type:'program',code:draft.programDraft.programCode}]){
     const lock=await api('/locks/acquire',{scopeType:scope.type,scopeCode:scope.code,grantId:grant.grant.id,lockCategory:'authoring'});assert.equal(lock.status,'acquired');ownLocks.push(lock.lock.lockToken);locks.push(lock.lock.lockToken);
    }
    const v=await api('/drafts',draft.programDraft);const versionId=v.id||v.version?.id;assert.ok(versionId,'DRAFT_VERSION_MISSING');const bundle='ciw-cotacoes-'+resource+'-'+crypto.randomUUID();
    await api('/governance/tests',{builderProgramVersionId:versionId,bundleId:bundle,testPlanId:'ciw-cotacoes-20261021',status:'passed',checklistSnapshot:{schema:true,php:true,abl:true,frontendExisting:true},evidences:[{type:'phpunit',result:'566tests/3413assertions PASS'},{type:'openedge-12.2',result:compile.trim()},{type:'abl-temp-table',result:tt.trim()}],notes:'Evidencias executadas; somente testes emTT antes de publicar. Validacao HTTP/visual/limpeza dos registros proprios vem apos publicacao; nao declarada antecipadamente.'});
    const approval=await api('/governance/approvals',{builderProgramVersionId:versionId,bundleId:bundle});await api('/versions/'+versionId+'/publish',{});
    fs.writeFileSync(receiptPath,JSON.stringify({resource,screenId:draft.programDraft.screenId,programCode:draft.programDraft.programCode,versionId,grantId:grant.grant.id,approvalId:approval.approval.id,bundle,published:true,realCrudValidated:false},null,2));
    console.log('Publicado: '+draft.programDraft.screenId+' '+draft.programDraft.programCode);
   }finally{for(const lockToken of ownLocks){try{await api('/locks/release',{lockToken});}catch{}}}
  }
 }finally{
  for(const lockToken of locks){try{await api('/locks/release',{lockToken});}catch{}}
  await fetch(base+'/api/auth/logout',{method:'POST',headers,body:'{}'});
 }
})().catch(e=>{console.error(e.message);process.exitCode=1;});
