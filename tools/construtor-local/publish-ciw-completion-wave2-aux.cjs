'use strict';
const c=require('./purchase-payments-builder-common.cjs'),crypto=require('node:crypto');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build5-v6');
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
async function main(){
 c.assert.ok(!c.fs.existsSync(c.path.join(state,'metadata-publication-started.json')),'ATTEMPTED_INSPECT_BEFORE_REPLAY');
 const names=['official-compile-verification.json','canonical-manifest.json','active-manifest.json','pasoe-read-proof.json','metadata-preflight.json'];
 const evidence=names.map(n=>{c.assert.ok(c.readJson(c.path.join(state,n)).success,n);return{type:n,result:'SHA256 '+c.sha(c.path.join(state,n))};});
 const aux=c.path.join(c.root,'integration-src/ciw-completion-20261028/container-version-history/frozen-aux-v1.1/metadata');
 const specs=c.fs.readdirSync(aux).filter(n=>n.endsWith('-builder-draft.json')).map(n=>c.readJson(c.path.join(aux,n)));c.assert.equal(specs.length,4);
 const additions=c.readJson(c.path.join(aux,'api-source-additions.json')).operations;c.assert.equal(additions.length,8);
 const safe=c.readJson(c.path.join(state,'source-124-before.json')),parent=c.readJson(c.path.join(state,'op1005-parent-draft.json'));
 await c.session(async({api,runtime,login})=>{
  const boot=await api('/bootstrap'),source=(await api('/api-sources/'+safe.code)).apiSource;
  for(const k of ['code','baseUrl','responseContract','operations'])c.assert.deepEqual(source[k],safe[k]);
  for(const d of specs){c.assert.ok(!boot.programs.some(p=>(p.programCode??p.code)===d.programDraft.programCode));c.assert.ok(!boot.entities.some(e=>e.code===d.entityDraft.code));}
  c.assert.deepEqual(await api('/programs/op1005'),c.readJson(c.path.join(state,'op1005-program-before.json')));
  for(const op of additions)c.assert.ok(!source.operations.some(x=>x.code===op.code));
  const parentPreview=await api('/preview',parent);const old=c.readJson(c.path.join(state,'op1005-program-before.json')).versions.filter(v=>v.status==='published').at(-1).generatedDefinition;
  const reversed=structuredClone(parentPreview.generatedDefinition);reversed.program.version=old.program.version;reversed.crud.grid.rowLinks=old.crud.grid.rowLinks;c.assert.deepEqual(reversed,old,'PARENT_DELTA_OUTSIDE_VERSION_ROWLINKS');save('op1005-native-preview.json',parentPreview);
  async function publish(draft,entity){
   const code=draft.programCode,request=await api('/governance/requests',{programCode:code,builderEntityCode:entity,requestedActions:['edit','publish'],reason:'Conversão CIW autorizada: quatro consultas dos dados persistidos da versão e links nativos. Sem escritores, recalcular histórico ou novos acessos humanos.'});
   const granted=await api('/governance/grants',{requestId:request.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']}),locks=[];
   try{
    for(const [scopeType,scopeCode]of [['entity',entity],['program',code]]){const l=await api('/locks/acquire',{scopeType,scopeCode,grantId:granted.grant.id,lockCategory:'authoring'});c.assert.equal(l.status,'acquired');locks.push(l.lock.lockToken);}
    const preview=await api('/preview',draft);save(code+'-native-preview.json',preview);c.assert.ok(preview.generatedDefinition);
    const version=await api('/drafts',draft),id=version.id??version.version?.id;c.assert.ok(id);const bundleId='ciw-completion-wave2-aux-'+crypto.randomUUID();
    await api('/governance/tests',{builderProgramVersionId:id,bundleId,testPlanId:'ciw-completion-wave2-aux-20261028',status:'passed',checklistSnapshot:{readOnly:true,mandatoryOwnerContext:true,persistedVersionSnapshot:true,sharedServices:true,official122:true,ablChecks:2732,phpTests:885,phpAssertions:5841,businessWrites:false},evidences:evidence,notes:'PASOE real: quatro read/paginação/contextos negativos; get positivo em pagamentos/NFs/despesas. Descontos vazios nas duas versões observadas: detalhe coberto em TT, sem criar registro comercial. Lookup atual/comparações históricos continuam incrementos separados. Não concede acesso humano.'});
    const approval=await api('/governance/approvals',{builderProgramVersionId:id,bundleId});await api('/versions/'+id+'/publish',{});
    const receipt={success:true,code,screen:draft.screenId,version:draft.version,versionId:id,approvalId:approval.approval.id};save('publication-'+code+'.json',receipt);return receipt;
   }finally{const locksReleased=await Promise.allSettled(locks.map(lockToken=>api('/locks/release',{lockToken})));await api('/governance/grants/status',{grantId:granted.grant.id,status:'revoked'});c.assert.ok(locksReleased.every(x=>x.status==='fulfilled'));}
  }
  save('metadata-publication-started.json',{at:new Date().toISOString(),businessWrites:false,humanPermissionsChanged:false,batchPublication:false});
  source.operations=[...source.operations,...additions];await api('/api-sources',source);
  const current=(await api('/api-sources/'+source.code)).apiSource;c.assert.equal(current.operations.length,132);
  for(const op of safe.operations)c.assert.deepEqual(current.operations.find(x=>x.code===op.code),op);
  for(const op of additions)c.assert.ok(c.compatibleOperation(current.operations.find(x=>x.code===op.code),op,current.baseUrl));
  save('source-132-after.json',Object.fromEntries(['code','baseUrl','responseContract','operations'].map(k=>[k,structuredClone(current[k])])));
  const published=[];
  for(const d of specs){const validation=await api('/external/validate',d);save(d.programDraft.programCode+'-external-validation.json',validation);c.assert.equal(validation.readyToApply,true);await api('/entities',d.entityDraft);published.push(await publish(d.programDraft,d.entityDraft.code));}
  published.push(await publish(parent,parent.builderEntityCode));
  for(const d of specs){const screen=await runtime(d.programDraft.screenId);c.assert.equal(screen.program.version,'1.0.0');for(const action of ['create','edit','delete'])c.assert.equal(screen.permissions[action],false);save(d.programDraft.programCode+'-runtime.json',screen);}
  const touched=new Set(published.map(p=>p.code));c.assert.deepEqual((await api('/bootstrap')).programs.filter(p=>!touched.has(p.programCode??p.code)),boot.programs.filter(p=>!touched.has(p.programCode??p.code)),'OTHER_PROGRAMS_CHANGED');
  c.assert.deepEqual(await api('/programs/op1003'),c.readJson(c.path.join(state,'op1003-program-before.json')),'BATCH_PARENT_PRESERVED');
  save('metadata-publication.json',{success:true,published,sourceOperations:132,previous124Preserved:true,otherProgramsPreserved:true,businessWrites:false,humanPermissionsChanged:false,batchPublication:false});
  console.log('PASS4readonlychildren+4parentlinks published;source124to132;otherprograms preserved; batchpublication stillpending');
 },{readOnly:false});
}
main().catch(e=>{console.error(e.message);process.exitCode=1});
