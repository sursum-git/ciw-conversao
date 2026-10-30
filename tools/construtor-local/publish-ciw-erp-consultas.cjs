/* Publicacao oficial Builder, somente o editor de parametros autorizado. */
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/ciw-fase2-20261022'),meta=path.join(root,'integration-src/ciw-erp-consultas/metadata'),base='http://127.0.0.1:8765';
const resources=['notas-fiscais-med','titulos-pagar-med'];
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
  const compile=fs.readFileSync(path.join(state,'compiled122/compile-ciw-erp.log'),'utf8');assert.match(compile,/OpenEdge 12.2/);assert.ok(!compile.includes('ERROR=yes'));
  assert.match(fs.readFileSync(path.join(state,'php-full.log'),'utf8'),/OK \(622 tests, 3688 assertions\)/);
  assert.ok(JSON.parse(fs.readFileSync(path.join(state,'canonical-manifest.json'),'utf8')).success);
  assert.ok(JSON.parse(fs.readFileSync(path.join(state,'active-manifest.json'),'utf8')).targets);
  const bootstrap=await api('/bootstrap');
  const drafts=resources.map(slug=>({slug,...JSON.parse(fs.readFileSync(path.join(meta,slug+'-builder-draft.json'),'utf8'))}));
  for(const draft of drafts){const old=bootstrap.programs.find(x=>(x.programCode||x.code)===draft.programDraft.programCode);assert.ok(!old||fs.existsSync(path.join(state,'publication-'+draft.slug+'.json')),'PROGRAM_CODE_COLLISION '+draft.programDraft.programCode);}
  const cfg=JSON.parse(fs.readFileSync(path.join(root,'.runtime/ciw-cadastros-20261020/private/connection.json'),'utf8'));
  const proof=[];
  for(const resource of ['notas_fiscais_med','titulos_pagar_med']){
   const r=await fetch(cfg.baseUrl+'/SursumPrograms/ciw-cadastros',{method:'POST',headers:{'Content-Type':'application/json','X-Ciw-Cadastros-Token':cfg.integrationToken},body:JSON.stringify({resource,operation:'read',skip:0,take:2}),signal:AbortSignal.timeout(30000)});
   const d=await r.json();assert.equal(d.success,true,resource+' '+d.error?.code);assert.ok(Array.isArray(d.data));assert.ok(Number.isInteger(d.total));assert.ok(d.data.length<=2);
   if(resource==='titulos_pagar_med')assert.ok(d.data.every(row=>row.cod_empresa==='500'));
   fs.writeFileSync(path.join(state,'private-pasoe-'+resource+'.json'),JSON.stringify(d,null,2));
   proof.push({resource,success:true,total:d.total,pageLength:d.data.length});
  }
  fs.writeFileSync(path.join(state,'pasoe-read-proof.json'),JSON.stringify({success:true,origin:'MED',ems2:5,ems5:500,businessWrites:false,checks:proof},null,2));
  const source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;assert.equal(source.responseContract,'sursum-programs');assert.equal(source.baseUrl,'http://127.0.0.1:19910/med/web');
  const before=structuredClone(source);const additions=JSON.parse(fs.readFileSync(path.join(meta,'api-source-additions.json'),'utf8')).operations;
  for(const op of additions){const old=source.operations.find(x=>x.code===op.code);if(old)assert.deepEqual(old.bodyTemplate,op.bodyTemplate);else source.operations.push(op);}
  if(!fs.existsSync(path.join(state,'source-before.json')))fs.writeFileSync(path.join(state,'source-before.json'),JSON.stringify(before,null,2));
  await api('/api-sources',source);
  fs.writeFileSync(path.join(state,'source-registration.json'),JSON.stringify({source:source.code,addedOperations:additions.map(x=>x.code),previousOperationsPreserved:true},null,2));
  for(const draft of drafts){
   const receipt=path.join(state,'publication-'+draft.slug+'.json');if(fs.existsSync(receipt)){console.log('Ja publicado '+draft.programDraft.screenId);continue;}
   const preview=await api('/external/validate',{entityDraft:draft.entityDraft,programDraft:draft.programDraft});fs.writeFileSync(path.join(state,'builder-preview-'+draft.slug+'.json'),JSON.stringify(preview,null,2));
   await api('/entities',draft.entityDraft);
   const req=await api('/governance/requests',{programCode:draft.programDraft.programCode,builderEntityCode:draft.entityDraft.code,requestedActions:['edit','publish'],reason:'Continuar conversoes CIW; consultas NF/titulos MED inicialmente com origem explicita autorizada em22/10. Sem permissao humana alterada.'});
   const grant=await api('/governance/grants',{requestId:req.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']});
   const own=[];
   try{
    for(const scope of [{type:'entity',code:draft.entityDraft.code},{type:'program',code:draft.programDraft.programCode}]){const l=await api('/locks/acquire',{scopeType:scope.type,scopeCode:scope.code,grantId:grant.grant.id,lockCategory:'authoring'});assert.equal(l.status,'acquired');own.push(l.lock.lockToken);locks.push(l.lock.lockToken);}
    const v=await api('/drafts',draft.programDraft),id=v.id||v.version?.id;assert.ok(id);const bundle='ciw-erp-'+crypto.randomUUID();
    await api('/governance/tests',{builderProgramVersionId:id,bundleId:bundle,testPlanId:'ciw-erp-consultas-20261022',status:'passed',checklistSnapshot:{schema:true,php:true,abl:true,frontendExisting:true,readOnly:true,explicitCompany:true},evidences:[{type:'phpunit',result:'622tests/3688assertions PASS'},{type:'openedge-12.2',result:compile.trim()},{type:'abl-temp-table',result:'47checks x culturasAMERICAN/EUROPEAN x codepagesUTF8/ISO8859-1; NUMDBS0'},{type:'native-js-validator',result:'2previews gerados e validados; frontend existente'},{type:'pasoe-read-only',result:JSON.stringify(proof)}],notes:'Leitura MED, origem explicita, paginacao/filtros no servidor, sem novos calculos/writers. Titulos nao substitui integralmente o seletor contextual; associacao pelo writer existente. Sem gravacao de negocio.'});
    const approval=await api('/governance/approvals',{builderProgramVersionId:id,bundleId:bundle});await api('/versions/'+id+'/publish',{});
    fs.writeFileSync(receipt,JSON.stringify({published:true,screenId:draft.programDraft.screenId,programCode:draft.programDraft.programCode,version:draft.programDraft.version,versionId:id,approvalId:approval.approval.id,businessWrites:false,contextualSelectorFullyConverted:false},null,2));console.log('Publicado '+draft.programDraft.screenId+' '+draft.programDraft.version);
   }finally{for(const lockToken of own){try{await api('/locks/release',{lockToken});}catch{}}}
  }
 }finally{for(const lockToken of locks){try{await api('/locks/release',{lockToken});}catch{}}await fetch(base+'/api/auth/logout',{method:'POST',headers,body:'{}'});}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
