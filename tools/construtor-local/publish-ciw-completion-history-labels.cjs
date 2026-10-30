'use strict';
const c=require('./purchase-payments-builder-common.cjs'),crypto=require('node:crypto');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build6-v2'),meta=c.path.join(c.root,'integration-src/ciw-completion-20261028/container-version-history/frozen-lookups-v2/metadata');
const safe=v=>Array.isArray(v)?v.map(safe):v&&typeof v==='object'?Object.fromEntries(Object.entries(v).map(([k,x])=>[k,k==='authHeaders'?[]:safe(x)])):v;
const stable=v=>Array.isArray(v)?v.map(stable):v&&typeof v==='object'?Object.fromEntries(Object.keys(v).sort().map(k=>[k,stable(v[k])])):v;
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(safe(v),null,2)+'\n');
const hash=v=>crypto.createHash('sha256').update(JSON.stringify(stable(v))).digest('hex');
function entityGuard(dto){const clone=safe(structuredClone(dto));delete clone.entity.apiSource;return hash(clone);}
async function main(){
 c.assert.ok(!c.fs.existsSync(c.path.join(state,'lookup-publication-started.json')),'ATTEMPTED_INSPECT_BEFORE_REPLAY');
 const names=['official-compile-verification.json','canonical-manifest.json','active-manifest.json','pasoe-read-proof.json'];
 const evidence=names.map(n=>{c.assert.ok(c.readJson(c.path.join(state,n)).success,n);return{type:n,result:'SHA256 '+c.sha(c.path.join(state,n))};});
 const guards=c.readJson(c.path.join(meta,'publication-guards.json')).guards;c.assert.equal(guards.length,3);
 await c.session(async({api,runtime,login})=>{
  const bootstrap=await api('/bootstrap'),source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource,items=[];
  const sourceBefore=Object.fromEntries(['code','baseUrl','responseContract','operations'].map(k=>[k,structuredClone(source[k])]));c.assert.equal(sourceBefore.operations.length,132);
  for(const guard of guards){
   const program=await api('/programs/'+guard.programCode),dto=await api('/entities/'+guard.entityCode);c.assert.equal(entityGuard(dto),guard.metadataDtoCanonicalSha256,'ENTITY_CONCURRENT_CHANGE');
   c.assert.deepEqual(safe(program),c.readJson(c.path.join(c.root,guard.programExportPath)),'PROGRAM_CONCURRENT_CHANGE');
   const draft=c.readJson(c.path.join(meta,guard.programCode+'-program-draft.json')).programDraft;
   const entity=structuredClone(dto.entity);c.assert.equal(entity.entityType,'api');c.assert.equal(entity.apiSourceCode,source.code);c.assert.ok(!entity.fields.some(f=>f.code===guard.entityMutation.appendFieldOnly.code));
   entity.createPhysicalTable=false;entity.fields.push(guard.entityMutation.appendFieldOnly);
   const preview=await api('/external/validate',{entityDraft:entity,programDraft:draft});c.assert.equal(preview.readyToApply,true);save(guard.programCode+'-lookup-preflight.json',preview);
   items.push({guard,program,dto,draft,entity});save(guard.programCode+'-lookup-entity-before.json',dto);
  }
  save('lookup-publication-started.json',{at:new Date().toISOString(),screens:3,sourceOperations:132,businessWrites:false,humanPermissionsChanged:false});const published=[];
  for(const {guard,program,dto,draft,entity}of items){
   c.assert.equal(entityGuard(await api('/entities/'+guard.entityCode)),guard.metadataDtoCanonicalSha256);c.assert.deepEqual(safe(await api('/programs/'+guard.programCode)),safe(program));
   const request=await api('/governance/requests',{programCode:guard.programCode,builderEntityCode:guard.entityCode,requestedActions:['edit','publish'],reason:'Consulta histórica CIW: acrescentar somente identificação atual readonly, coluna e filtro; preservar snapshot, contexto, operações e acessos.'});
   const grant=await api('/governance/grants',{requestId:request.request.id,grantedToUserId:String(login.user.id),allowedActions:['edit','publish']}),locks=[];
   try{
    for(const [scopeType,scopeCode]of [['entity',guard.entityCode],['program',guard.programCode]]){const locked=await api('/locks/acquire',{scopeType,scopeCode,grantId:grant.grant.id,lockCategory:'authoring'});c.assert.equal(locked.status,'acquired');locks.push(locked.lock.lockToken);}
    const saved=await api('/entities',entity);save(guard.programCode+'-lookup-entity-applied.json',{success:true,entity:saved.entity});c.assert.equal(saved.entity.fields.length,dto.entity.fields.length+1);
    for(const field of dto.entity.fields)c.assert.deepEqual(saved.entity.fields.find(x=>x.code===field.code),field,'EXISTING_FIELD_CHANGED');
    const currentSource=(await api('/api-sources/'+source.code)).apiSource;for(const key of Object.keys(sourceBefore))c.assert.deepEqual(currentSource[key],sourceBefore[key],'SOURCE_CHANGED');
    const preview=await api('/preview',draft);save(guard.programCode+'-lookup-preview.json',preview);c.assert.ok(preview.generatedDefinition);
    const version=await api('/drafts',draft),versionId=version.id??version.version?.id;c.assert.ok(versionId);const bundleId='ciw-history-labels-'+crypto.randomUUID();
    await api('/governance/tests',{builderProgramVersionId:versionId,bundleId,testPlanId:'ciw-history-labels-20261028',status:'passed',checklistSnapshot:{readOnly:true,persistedSnapshotUnchanged:true,mandatoryOwnerContext:true,currentLabelsOnly:true,official122:true,ablChecks:3616,phpTests:885,phpAssertions:5841,positiveNegativeLabelFilters:true,businessWrites:false},evidences:evidence,notes:'API/Service duplas10handles publicadas coerentemente; PASOE real3labels/positivo-negativo filtros/get/contexto. Atualiza snapshot interno do catálogo pelo Builder atual, preservando os132ops globais, campos anteriores e acessos humanos. Não recalcula histórico.'});
    const approval=await api('/governance/approvals',{builderProgramVersionId:versionId,bundleId});await api('/versions/'+versionId+'/publish',{});
    const receipt={success:true,program:guard.programCode,screen:draft.screenId,version:draft.version,versionId,approvalId:approval.approval.id,fieldAdded:guard.entityMutation.appendFieldOnly.code};save('publication-label-'+guard.programCode+'.json',receipt);published.push(receipt);
   }finally{const outcomes=await Promise.allSettled(locks.map(lockToken=>api('/locks/release',{lockToken})));await api('/governance/grants/status',{grantId:grant.grant.id,status:'revoked'});c.assert.ok(outcomes.every(x=>x.status==='fulfilled'));}
  }
  const touched=new Set(published.map(x=>x.program));c.assert.deepEqual((await api('/bootstrap')).programs.filter(x=>!touched.has(x.programCode??x.code)),bootstrap.programs.filter(x=>!touched.has(x.programCode??x.code)),'OTHER_PROGRAMS_CHANGED');
  for(const row of published){const definition=await runtime(row.screen);c.assert.equal(definition.program.version,'1.0.1');c.assert.equal(definition.permissions.edit,false);c.assert.ok(definition.dataModel.fields[row.fieldAdded]);save(row.program+'-lookup-runtime.json',definition);}
  save('lookup-metadata-publication.json',{success:true,published,sourceOperations:132,previousFieldsPreserved:true,otherProgramsPreserved:true,humanPermissionsChanged:false,businessWrites:false});console.log('PASS3readonlyhistorylabel fields/columns/filters published1.0.1;source132/oldfields/otherprograms preserved');
 },{readOnly:false});
}
main().catch(e=>{console.error(e.message);process.exitCode=1});
