'use strict';
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/iol-gerencial'),base='http://127.0.0.1:8765',prefix='/api/admin/program-builder';
const sellerTitleCase=process.argv.includes('--seller-titlecase'),expectedVersion=sellerTitleCase?'1.0.1':'1.0.0',newVersion=sellerTitleCase?'1.0.2':'1.0.1';
let headers={'Content-Type':'application/json'};
async function api(route,body){const r=await fetch(base+route,{method:body===undefined?'GET':'POST',headers,body:body===undefined?undefined:JSON.stringify(body)});const b=await r.json();if(!r.ok||b.error)throw Error(route+' HTTP '+r.status+' '+(b.error?.message||''));return b;}
function findMeta(tiles){for(const tile of tiles||[]){if(tile.type==='group'&&tile.title==='Meta de Faturamento')return tile;const found=findMeta(tile.children);if(found)return found;}}
function findSellers(tiles){for(const tile of tiles||[]){if(tile.type==='list'&&tile.labelField==='nome_abreviado')return tile;const found=findSellers(tile.children);if(found)return found;}}
(async()=>{
 const password=fs.readFileSync(path.join(root,'.runtime/construtor-pg/acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const login=await api('/api/auth/login',{username:'admin',password,tenantId:'default',rememberMe:false});assert.equal(login.authenticated,true);
 headers={...headers,Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 let grantId;const locks=[];
 try{
  const current=await api('/api/runtime/screens/iol.inicial-gerencial');assert.equal(current.program.version,expectedVersion,'Versao alterada; revisar antes de publicar');
  const program=await api(prefix+'/programs/op1012');const version=program.versions.find(v=>v.version===current.program.version&&v.status==='published');assert.ok(version);
  const keys=['programCode','programTitle','module','pageType','builderEntityCode','screenId','subtitle','icon','permissionPrefix','allowCreate','allowUpdate','allowDelete','programOrigin','ownerScope','customizationPolicy','subscriberId','baseProgramCode','baseProgramVersionId','upgradeFrozen','frozenReason'];
  const summary=sellerTitleCase?'Nomes dos vendedores com inicial de cada palavra maiuscula; demais letras minusculas.':'Meta de Faturamento aberta inicialmente; cards com fontes menores no tema Material IMA.';
  const draft={...version.builderConfig,...Object.fromEntries(keys.map(k=>[k,version[k]])),version:newVersion,changeSummary:summary};
  const tiles=draft.analyticsConfig?.apiDashboard?.dashboard?.tiles;
  if(sellerTitleCase){const sellers=findSellers(tiles);assert.ok(sellers);assert.ok(!sellers.labelCase);sellers.labelCase='title';}
  else{const meta=findMeta(tiles);assert.ok(meta,'Configuracao declarativa ausente');assert.equal(meta.collapsed,true);meta.collapsed=false;}
  const preview=await api(prefix+'/preview',draft);const generated=preview.generatedDefinition||preview.definition||preview;
  assert.equal(findMeta(generated.analytics?.views?.flatMap(v=>v.tiles||[])).collapsed,false);
  assert.equal(generated.permissions.materialize,false);
  const previous=structuredClone(version.generatedDefinition.analytics),next=structuredClone(generated.analytics);
  if(sellerTitleCase)findSellers(previous.views.flatMap(v=>v.tiles||[])).labelCase='title';else findMeta(previous.views.flatMap(v=>v.tiles||[])).collapsed=false;
  assert.deepEqual(next,previous,'Alteracao extra no Analytics');
  fs.writeFileSync(path.join(state,'presentation-before-'+newVersion+'.json'),JSON.stringify({version,definition:current},null,2));
  const req=await api(prefix+'/governance/requests',{programCode:'op1012',builderEntityCode:draft.builderEntityCode,requestedActions:['edit','publish'],reason:'Pedido do usuario: '+summary});
  const grant=await api(prefix+'/governance/grants',{requestId:req.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']});grantId=grant.grant.id;
  for(const scope of [{type:'entity',code:draft.builderEntityCode},{type:'program',code:'op1012'}]){const result=await api(prefix+'/locks/acquire',{scopeType:scope.type,scopeCode:scope.code,grantId,lockCategory:'authoring'});assert.equal(result.status,'acquired');locks.push(result.lock.lockToken);}
  const saved=await api(prefix+'/drafts',draft),versionId=saved.id||saved.version?.id;assert.ok(versionId);
  const bundleId='iol-presentation-'+crypto.randomUUID();
  await api(prefix+'/governance/tests',{builderProgramVersionId:versionId,bundleId,testPlanId:'iol-presentation-20261017',status:'passed',checklistSnapshot:{onlyPresentationChanged:true,readonlyPreserved:true},evidences:[{type:'preview',result:'Comparacao integral do Analytics: somente a propriedade de apresentacao solicitada mudou.'},{type:'validation',result:sellerTitleCase?'Config PHP8testes/10assercoes e smoke frontend com nome acentuado/escape HTML passaram.':'Meta aberta confirmada em preview; fontes por CSS.'}],notes:'Sem mudanca de API, calculos, identidade, fontes ou permissoes.'});
  const approval=await api(prefix+'/governance/approvals',{builderProgramVersionId:versionId,bundleId});await api(prefix+'/versions/'+versionId+'/publish',{});
  const live=await api('/api/runtime/screens/iol.inicial-gerencial');assert.equal(live.program.version,newVersion);assert.equal(findMeta(live.analytics.views.flatMap(v=>v.tiles||[])).collapsed,false);
  if(sellerTitleCase)assert.equal(findSellers(live.analytics.views.flatMap(v=>v.tiles||[])).labelCase,'title');
  fs.writeFileSync(path.join(state,'presentation-publication-'+newVersion+'.json'),JSON.stringify({versionId,approvalId:approval.approval.id,version:newVersion,screenId:live.screenId,at:new Date().toISOString()},null,2));
  const file=path.join(root,'integration-src/iol-pagina-inicial-gerencial/metadata/builder-draft.json');const metadata=JSON.parse(fs.readFileSync(file,'utf8'));metadata.programDraft=draft;fs.writeFileSync(file,JSON.stringify(metadata,null,2)+'\n');
  console.log('Publicado IOL'+newVersion+': '+summary+' Outras configuracoes preservadas.');
 }finally{for(const lockToken of locks)await api(prefix+'/locks/release',{lockToken});if(grantId)await api(prefix+'/governance/grants/status',{grantId,status:'revoked'});await api('/api/auth/logout',{});}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
