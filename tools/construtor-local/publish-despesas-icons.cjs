'use strict';
// Publicacao oficial do Builder: somente exibicao do link Empresas em cd0092.
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/row-link-icons-20261020'),base='http://127.0.0.1:8765',prefix='/api/admin/program-builder';
const json=p=>JSON.parse(fs.readFileSync(p,'utf8').replace(/^\uFEFF/,''));let headers={'Content-Type':'application/json'};
async function api(route,body,method=body===undefined?'GET':'POST'){
 const r=await fetch(base+route,{method,headers,body:body===undefined?undefined:JSON.stringify(body),signal:AbortSignal.timeout(45000)}),j=await r.json();
 if(!r.ok||j.error)throw Error(route+' HTTP'+r.status+' '+(j.error?.message||''));return j;
}
(async()=>{
 const mode=process.argv[2]||'prepare';assert.ok(['prepare','publish','verify'].includes(mode));
 let password=fs.readFileSync(path.join(root,'.runtime/construtor-pg/acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const login=await api('/api/auth/login',{username:'admin',password,tenantId:'default',remember:false});password=undefined;assert.ok(login.authenticated);
 headers={...headers,Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 let grantId;const locks=[];
 try{
  const current=await api('/api/runtime/screens/ciw.despesas'),program=await api(prefix+'/programs/cd0092');
  const published=program.versions.filter(x=>x.status==='published');assert.equal(published.length,1);
  if(mode==='verify'){
   const currentCrud=current.crud||current;
   assert.equal(current.program.version,'1.0.2');assert.equal(currentCrud.grid.rowLinks[0].icon,'buildings-outline');assert.equal(currentCrud.grid.rowLinks[0].iconOnly,true);
   assert.equal(current.permissions.edit,true);assert.equal(current.permissions.delete,true);
   console.log('PASS: Despesas1.0.2 publicada, icone/contexto e Alterar/Excluir preservados.');return;
  }
  assert.equal(current.program.version,'1.0.1');assert.equal(published[0].version,'1.0.1');
  const draft=json('D:/opencode/construtor-pg/integrations/ciw-despesas/builder-draft.json');
  assert.equal(draft.programDraft.version,'1.0.2');assert.equal(draft.programDraft.programCode,'cd0092');
  const preview=await api(prefix+'/external/validate',draft),d=preview.generatedDefinition;
  const currentCrud=current.crud||current, generatedCrud=d.crud||d;
  assert.deepEqual(generatedCrud.grid.rowLinks,[{...currentCrud.grid.rowLinks[0],icon:'buildings-outline',iconOnly:true}]);
  // Preview e runtime diferem nos booleanos resolvidos; preservar contrato de acoes/campos.
  assert.equal(d.program.id,current.program.id);assert.deepEqual(generatedCrud.dataModel,currentCrud.dataModel);
  const rawPrevious=published[0].generatedDefinition;
  const expectedCrud=structuredClone(rawPrevious.crud||rawPrevious);expectedCrud.grid.rowLinks=generatedCrud.grid.rowLinks;
  if(!Object.hasOwn(expectedCrud.grid,'groupable')&&generatedCrud.grid.groupable===false)expectedCrud.grid.groupable=false;
  assert.deepEqual(generatedCrud,expectedCrud,'Mudanca CRUD fora do icone/default groupable=false');
  const previewProof={currentVersionId:published[0].id,currentVersion:'1.0.1',nextVersion:'1.0.2',rowLinks:generatedCrud.grid.rowLinks,previewKeys:Object.keys(preview),publishedKeys:Object.keys(published[0])};
  fs.writeFileSync(path.join(state,'preview.json'),JSON.stringify(previewProof,null,2));
  if(mode==='prepare'){console.log('PASS preflight oficial: Despesas1.0.1→1.0.2, icone apenas, contexto e campos preservados.');return;}
  assert.ok(!fs.existsSync(path.join(state,'published.json')),'Publicacao ja registrada');
  const evidence=fs.readFileSync(path.join(state,'tests.log'),'utf8');assert.ok(evidence.includes('10/10 PASS')&&evidence.includes('135 tests, 509 assertions'));
  const req=await api(prefix+'/governance/requests',{programCode:'cd0092',builderEntityCode:'despesas_progress',requestedActions:['edit','publish'],reason:'Icone de predios no link Empresas de Despesas aprovado pelo usuario; sem alteracao de negocio.'});
  const grant=await api(prefix+'/governance/grants',{requestId:req.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']});grantId=grant.grant.id;
  for(const scope of [{type:'entity',code:'despesas_progress'},{type:'program',code:'cd0092'}]){const lock=await api(prefix+'/locks/acquire',{scopeType:scope.type,scopeCode:scope.code,grantId,lockCategory:'authoring'});assert.equal(lock.status,'acquired');locks.push(lock.lock.lockToken);}
  assert.equal((await api('/api/runtime/screens/ciw.despesas')).program.version,'1.0.1');
  const version=await api(prefix+'/drafts',draft.programDraft),versionId=version.id||version.version?.id;assert.ok(versionId);
  const bundleId='despesas-icons-'+crypto.randomUUID();
  await api(prefix+'/governance/tests',{builderProgramVersionId:versionId,bundleId,testPlanId:'despesas-row-link-icons',status:'passed',checklistSnapshot:{frontend:true,backend:true,contextPreserved:true,noBusinessWrites:true},evidences:[{type:'unit-tests',result:evidence}],notes:'135 testes Builder/509assertivas e10testes frontend; ABL inalterado. Visual depois de publicar.'});
  const approval=await api(prefix+'/governance/approvals',{builderProgramVersionId:versionId,bundleId});await api(prefix+'/versions/'+versionId+'/publish',{});
  fs.writeFileSync(path.join(state,'published.json'),JSON.stringify({screenId:'ciw.despesas',programCode:'cd0092',version:'1.0.2',versionId,approvalId:approval.approval.id,businessWritesExecuted:false},null,2));
  console.log('PASS: Despesas1.0.2 publicada pelo Builder oficial.');
 }finally{
  for(const lockToken of locks)await api(prefix+'/locks/release',{lockToken});
  if(grantId)await api(prefix+'/governance/grants/status',{grantId,status:'revoked'});
  await api('/api/auth/logout',{});
 }
})().catch(e=>{console.error(e.message);process.exitCode=1;});
