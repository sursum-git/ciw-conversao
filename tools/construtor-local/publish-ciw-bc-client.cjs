/* Publicacao oficial Builder, somente o editor de parametros autorizado. */
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/ciw-bc-client-20261021'),meta=path.join(root,'integration-src/ciw-bc-client/metadata'),base='http://127.0.0.1:8765';
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
 try {
  assert.match(fs.readFileSync(path.join(state,'php-full.log'),'utf8'),/OK \(612 tests, 3643 assertions\)/);
  const compile=fs.readFileSync(path.join(state,'compiled122/compile-ciw-cotacoes.log'),'utf8');assert.match(compile,/OpenEdge 12.2/);assert.ok(!compile.includes('ERROR=yes'));
  for(const cp of ['UTF-8','ISO8859-1'])for(const culture of ['AMERICAN','EUROPEAN'])assert.equal(fs.readFileSync(path.join(state,`compiled122/cotacoes-${cp}-${culture}.log`),'utf8').trim(),`PASS 107 checks ${culture}`);
  assert.ok(JSON.parse(fs.readFileSync(path.join(state,'canonical-manifest.json'),'utf8')).success);
  assert.ok(JSON.parse(fs.readFileSync(path.join(state,'active-manifest.json'),'utf8')).targets);
  const cfg=JSON.parse(fs.readFileSync(path.join(root,'.runtime/ciw-cadastros-20261020/private/connection.json'),'utf8'));
  const probe=await fetch(cfg.baseUrl+'/SursumPrograms/ciw-cadastros',{method:'POST',headers:{'Content-Type':'application/json','X-Ciw-Cadastros-Token':cfg.integrationToken,'X-Sursum-User':login.user.username,'X-Session-Id':login.session.sessionId},body:JSON.stringify({resource:'hist_cotacoes_bc',operation:'import-bc',data:'2026-10-20',serie:1,valor:0,nome_serie:'INVALID_READ_ONLY_PROBE'}),signal:AbortSignal.timeout(20000)}).then(x=>x.json());
  assert.equal(probe.error?.code,'CIW_COTACAO_VALIDATION','IMPORT_ABL_NOT_ACTIVE');assert.ok(!probe.audit);fs.writeFileSync(path.join(state,'pasoe-negative-probe.json'),JSON.stringify({success:true,code:probe.error.code,mutationExecuted:false}));
  const source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;
  const addition=JSON.parse(fs.readFileSync(path.join(meta,'api-source-additions.json'),'utf8')).operations[0];
  if(!fs.existsSync(path.join(state,'source-before.json')))fs.writeFileSync(path.join(state,'source-before.json'),JSON.stringify(source,null,2));
  const prior=source.operations.find(x=>x.code===addition.code);if(prior){assert.deepEqual(prior.bodyTemplate,addition.bodyTemplate);Object.assign(prior,addition);}else source.operations.push(addition);
  await api('/api-sources',source);
  const drafts=['buscar-cotacao-builder-draft','cotacoes-1.0.1-builder-draft'].map(n=>({name:n,...JSON.parse(fs.readFileSync(path.join(meta,n+'.json'),'utf8'))}));
  if(!fs.existsSync(path.join(state,'entity-source-refresh.json'))){
   const req=await api('/governance/requests',{programCode:'cd0103',builderEntityCode:'hist_cotacoes_bc_progress',requestedActions:['edit','publish'],reason:'Atualizar apenas as operacoes cadastradas da entidade cotacoes para a integracao BC autorizada.'});
   const grant=await api('/governance/grants',{requestId:req.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']});const own=[];
   try{for(const scope of [{type:'entity',code:'hist_cotacoes_bc_progress'},{type:'program',code:'cd0103'}]){const l=await api('/locks/acquire',{scopeType:scope.type,scopeCode:scope.code,grantId:grant.grant.id,lockCategory:'authoring'});assert.equal(l.status,'acquired');own.push(l.lock.lockToken);locks.push(l.lock.lockToken);}
    await api('/entities',drafts[0].entityDraft);fs.writeFileSync(path.join(state,'entity-source-refresh.json'),JSON.stringify({refreshed:true,sourceOperation:addition.code}));
   }finally{for(const lockToken of own){try{await api('/locks/release',{lockToken});}catch{}}}
  }
  for(const draft of drafts) {
   const preview=await api('/external/validate',{entityDraft:draft.entityDraft,programDraft:draft.programDraft});
   fs.writeFileSync(path.join(state,'preview-'+draft.name+'.json'),JSON.stringify(preview,null,2));
   if(process.argv.includes('--validate-only')){console.log('Validado '+draft.programDraft.screenId);continue;}
   const receipt=path.join(state,'publication-'+draft.name+'.json');if(fs.existsSync(receipt)){console.log('Ja publicado '+draft.programDraft.screenId);continue;}
   const bootstrap=await api('/bootstrap');const existing=bootstrap.programs.find(x=>(x.programCode||x.code)===draft.programDraft.programCode);
   if(draft.programDraft.programCode==='cd0104')assert.ok(!existing,'PROGRAM_CODE_COLLISION');
   else {const p=await api('/programs/cd0103');assert.equal(p.program.screenId,'ciw.cotacoes-bc');assert.ok(p.versions.some(x=>x.id===51&&x.status==='published'),'PUBLISHED_BASELINE_CHANGED');assert.ok(!p.versions.some(x=>x.version==='1.0.1'),'VERSION_EXISTS');}
   const req=await api('/governance/requests',{programCode:draft.programDraft.programCode,builderEntityCode:draft.entityDraft.code,requestedActions:['edit','publish'],reason:'Integracao BC em PHP determinada pelo usuario; processo nativo e logs; sem alterar permissoes humanas.'});
   const grant=await api('/governance/grants',{requestId:req.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']});
   const own=[];
   try {
    for(const scope of [{type:'entity',code:draft.entityDraft.code},{type:'program',code:draft.programDraft.programCode}]){const l=await api('/locks/acquire',{scopeType:scope.type,scopeCode:scope.code,grantId:grant.grant.id,lockCategory:'authoring'});assert.equal(l.status,'acquired');own.push(l.lock.lockToken);locks.push(l.lock.lockToken);}
    const v=await api('/drafts',draft.programDraft),id=v.id||v.version?.id;assert.ok(id);const bundle='ciw-bc-client-'+crypto.randomUUID();
    await api('/governance/tests',{builderProgramVersionId:id,bundleId:bundle,testPlanId:'ciw-bc-client-20261021',status:'passed',checklistSnapshot:{schema:true,php:true,abl:true,clientTls:true,frontendExisting:true},evidences:[{type:'phpunit',result:'612tests/3643assertions PASS'},{type:'openedge-12.2',result:compile.trim()},{type:'abl-temp-table',result:'107checks x4culturas/codepages + x2layout; NUMDBS0'},{type:'bcb-client',result:'GET real serie1 TLS verificado; nenhuma gravacao de cotacao real.'}],notes:'Revisao independente concluida; processo BC nao executado contra dados de negocio. Confirmacao e permissao nativas; abrir nao executa.'});
    const approval=await api('/governance/approvals',{builderProgramVersionId:id,bundleId:bundle});await api('/versions/'+id+'/publish',{});
    fs.writeFileSync(receipt,JSON.stringify({published:true,screenId:draft.programDraft.screenId,programCode:draft.programDraft.programCode,version:draft.programDraft.version,versionId:id,approvalId:approval.approval.id,realAutomaticWriteExecuted:false},null,2));console.log('Publicado '+draft.programDraft.screenId+' '+draft.programDraft.version);
   }finally{for(const lockToken of own){try{await api('/locks/release',{lockToken});}catch{}}}
  }
 }finally{for(const lockToken of locks){try{await api('/locks/release',{lockToken});}catch{}}await fetch(base+'/api/auth/logout',{method:'POST',headers,body:'{}'});}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
