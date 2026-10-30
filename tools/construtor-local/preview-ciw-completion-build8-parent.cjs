'use strict';
// Pure native preview. A reviewer must inspect EVERY generated delta before sealing.
const c=require('./purchase-payments-builder-common.cjs'),prep=require('./prepare-ciw-completion-build8-metadata.cjs');
const dir=c.path.join(c.root,'.runtime/ciw-completion-20261028/build8-metadata-publication-preparation');
const safe=v=>Array.isArray(v)?v.map(safe):v&&typeof v==='object'?Object.fromEntries(Object.entries(v).map(([k,x])=>[k,k==='authHeaders'?[]:safe(x)])):v;
function differences(a,b,path=''){
 if(JSON.stringify(a)===JSON.stringify(b))return[];
 if(a&&b&&typeof a==='object'&&typeof b==='object'&&Array.isArray(a)===Array.isArray(b)){
  return[...new Set([...Object.keys(a),...Object.keys(b)])].flatMap(key=>differences(a[key],b[key],path+'/'+key));
 }
 return[{path,before:a,after:b}];
}
async function main(){
 const plan=c.readJson(c.path.join(dir,'execution-plan-v1.2.json')),file=c.path.join(dir,'parent-preview-observed.json');c.assert.ok(!c.fs.existsSync(file),'Inspect existing preview instead of replay');
 c.assert.equal(c.sha(plan.parent.baselinePath),plan.parent.baselineSha256);c.assert.equal(c.sha(plan.parent.draftFile),plan.parent.draftSha256);
 const before=c.readJson(plan.parent.baselinePath),draft=c.readJson(plan.parent.draftFile);c.assert.equal(draft.version,'1.0.4');
 await c.session(async({api})=>{
  const current=await api('/programs/op1003');c.assert.deepEqual(prep.programContract(safe(current)),prep.programContract(safe(before)));
  const preview=await api('/preview',draft);c.assert.ok(preview.generatedDefinition);
  const published=before.versions.filter(x=>x.status==='published');c.assert.equal(published.length,1);
  const deltas=differences(safe(published[0].generatedDefinition),safe(preview.generatedDefinition));
  c.fs.writeFileSync(file,JSON.stringify({success:true,readOnly:true,deltaReviewed:false,parentBaselineSha256:plan.parent.baselineSha256,draftSha256:plan.parent.draftSha256,build8ReleaseSha256:plan.release.build8ReleaseSha256,expectedGeneratedDefinition:safe(preview.generatedDefinition),deltas,catalogWrites:false,businessWrites:false},null,2)+'\n');
  console.log(JSON.stringify({success:true,readOnly:true,deltaReviewed:false,deltas}));
 },{readOnly:false});
}
main().catch(e=>{console.error(e.message);process.exitCode=1});
