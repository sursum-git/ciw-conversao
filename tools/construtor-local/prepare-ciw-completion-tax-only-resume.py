"""Freeze a bounded resume from source6; keep previous attempted publishers intact."""
from pathlib import Path
import hashlib
root=Path(__file__).resolve().parents[2]
original=root/'tools/construtor-local/publish-ciw-completion-tax-only-metadata.cjs'
assert hashlib.sha256(original.read_bytes()).hexdigest()=='c676f74b1f978dcb57bfd4b3a0f506628cc70c17e4cee76d9bcb99f99361d527'
text=original.read_text(encoding='utf-8')
text=text.replace("c.assert.ok(!c.fs.existsSync(c.path.join(dir,'publication-started.json')),'INSPECT_PARTIAL_BEFORE_REPLAY');", "c.assert.ok(c.fs.existsSync(c.path.join(dir,'publication-started.json'))&&!c.fs.existsSync(c.path.join(dir,'resume-started.json'))&&!c.fs.existsSync(c.path.join(dir,'metadata-publication.json')),'INSPECT_PARTIAL_BEFORE_REPLAY');")
text=text.replace("c.readJson(c.path.join(dir,'source-five-before.json')));c.assert.equal(source.operations.length,5);", "c.readJson(c.path.join(dir,'source-six-after.json')));c.assert.equal(source.operations.length,6);\n  const baselineFive=c.readJson(c.path.join(dir,'source-five-before.json'));for(const op of baselineFive.operations)c.assert.deepEqual(source.operations.find(x=>x.code===op.code),op);c.assert.ok(c.compatibleOperation(source.operations.find(x=>x.code===addition.code),addition,source.baseUrl));")
start=text.index('  try{\n   const ownerGrant=')
end=text.index('   for(const [screen,before]',start)
replacement=r'''  async function phase(programCode,entityCode,run){
   const grantIndex=grants.length,lockIndex=locks.length;
   try{const grantId=await authorize(programCode,entityCode);await lock('program',programCode,grantId);await lock('entity',entityCode,grantId);return await run();}
   finally{const unlocked=await Promise.allSettled(locks.splice(lockIndex).reverse().map(lockToken=>api('/locks/release',{lockToken})));const revoked=await Promise.allSettled(grants.splice(grantIndex).reverse().map(grantId=>api('/governance/grants/status',{grantId,status:'revoked'})));c.assert.ok([...unlocked,...revoked].every(x=>x.status==='fulfilled'),'PHASE_GOVERNANCE_CLEANUP_REQUIRED');}
  }
  try{
   const ownerProof=c.readJson(c.path.join(dir,'native-governance-owners.json'));c.assert.ok(ownerProof.success&&ownerProof.readOnly);c.assert.equal(ownerProof.owners.container_processos_progress.programCode,'op1016');c.assert.equal(ownerProof.owners.container_despesas_progress.programCode,'op1003');
   save('resume-started.json',{at:new Date().toISOString(),alreadyAppliedSourceOperations:6,skipSourceMutation:true,businessWrites:false,humanPermissionsChanged:false,positiveOperationalTestPending:true});
   await phase('op1016',oldEntity.code,async()=>{
    c.assert.deepEqual(safe((await api('/api-sources/'+source.code)).apiSource),safe(oldSource));c.assert.deepEqual(safe(await api('/entities/'+oldEntity.code)),safe(entityDto));
    const entityPayload=structuredClone(oldEntity);entityPayload.createPhysicalTable=false;const saved=await api('/entities',entityPayload);save('entity-refreshed.json',saved);
    c.assert.deepEqual(saved.entity.fields,oldEntity.fields,'ENTITY_FIELDS_CHANGED');
    const withoutSnapshot=x=>{const y=safe(structuredClone(x));delete y.apiSource;if(y.metadata)delete y.metadata.apiSource;delete y.updatedAt;return y;};c.assert.deepEqual(withoutSnapshot(saved.entity),withoutSnapshot(oldEntity),'ENTITY_OUTSIDE_API_SNAPSHOT_CHANGED');
   });
   const published=[];
   published.push(await phase(draft.programCode,oldEntity.code,()=>publish(draft)));
   published.push(await phase(parentDraft.programCode,parentDraft.builderEntityCode,async()=>{c.assert.deepEqual(programContract(await api('/programs/op1003')),programContract(c.readJson(c.path.join(dir,'op1003-before.json'))));return publish(parentDraft);}));
'''
text=text[:start]+replacement+text[end:]
assert 'source.operations=[...oldOperations,addition]'not in text
assert "phase('op1016',oldEntity.code"in text
out=root/'tools/construtor-local/resume-ciw-completion-tax-only-metadata.cjs'
assert not out.exists();out.write_text(text,encoding='utf-8')
print('Prepared bounded source6 resume; source mutation skipped; three separate native authoring phases')
