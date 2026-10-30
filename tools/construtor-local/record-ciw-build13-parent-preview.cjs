'use strict';
// ROOT ONLY. One closed POST /preview and one parent GET. No catalog mutation.
const c=require('./purchase-payments-builder-common.cjs'),p=require('./prepare-ciw-build13-metadata.cjs');
const PLAN='6732625a6dd68f8a9c0b53c6ba6bafcd048d6e5b3ef1c6082f675d36e0cfba21';
async function main(){
 c.assert.deepEqual(process.argv.slice(2),['--record-parent-preview']);const file=c.path.join(p.dir,'plan.json');c.assert.equal(c.sha(file),PLAN);const plan=c.readJson(file);p.evidence(true);
 for(const[path,sha]of [[plan.parent.baselinePath,plan.parent.baselineSha256],[plan.parent.entityBaselinePath,plan.parent.entityBaselineSha256],[plan.parent.draftFile,plan.parent.draftSha256],[plan.nativeOwnerProof.path,plan.nativeOwnerProof.sha256]])c.assert.equal(c.sha(path),sha);
 c.assert.ok(!c.fs.existsSync(plan.parent.observedPreviewFile),'EXISTING_PREVIEW_NO_REPLAY');const before=c.readJson(plan.parent.baselinePath),draft=c.readJson(plan.parent.draftFile);
 const result=await c.session(async({api})=>{
  async function closed(url,body){c.assert.ok(url==='/programs/op1005'&&body===undefined||url==='/preview'&&body===draft,'ONLY_PARENT_GET_AND_PREVIEW_ALLOWED');return api(url,body);}
  c.assert.deepEqual(p.programContract(await closed('/programs/op1005')),p.programContract(before),'WHOLE_PARENT_BASELINE_CHANGED');const preview=await closed('/preview',draft);c.assert.ok(preview.generatedDefinition);const published=before.versions.filter(x=>x.status==='published');c.assert.equal(published.length,1);
  const old=p.safe(published[0].generatedDefinition),expected=p.safe(preview.generatedDefinition),deltas=p.differences(old,expected);
  return{success:true,readOnly:true,observedAtUtc:new Date().toISOString(),toolSha256:c.sha(__filename),planSha256:PLAN,deltaReviewed:false,wholeDefinitionCompared:true,ignoredPaths:[],builderSha256:p.BUILDER,parentBaselineSha256:plan.parent.baselineSha256,parentEntityBaselineSha256:plan.parent.entityBaselineSha256,draftSha256:plan.parent.draftSha256,build13ReleaseSha256:plan.buildRelease.sha256,expectedGeneratedDefinition:expected,rawPreview:p.safe(preview),deltas,reviewedDeltaSha256:p.digest(deltas),catalogWrites:false,businessWrites:false,governanceWrites:false};
 },{readOnly:false});
 p.writeNew(plan.parent.observedPreviewFile,result);console.log(JSON.stringify({success:true,readOnly:true,wholeDefinitionCompared:true,deltaReviewed:false,deltaCount:result.deltas.length,deltaPaths:result.deltas.map(x=>x.path),observedPreviewSha256:c.sha(plan.parent.observedPreviewFile),catalogWrites:false,businessWrites:false}));
}
module.exports={main};if(require.main===module)main().catch(()=>{console.error('BUILD13_PARENT_PREVIEW_FAILED_NO_CATALOG_MUTATION');process.exitCode=1;});
