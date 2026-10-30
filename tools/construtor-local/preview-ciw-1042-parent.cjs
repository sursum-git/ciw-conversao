'use strict';
// Native preview only: no source, entity, draft, approval or publication writes.
const c=require('./purchase-payments-builder-common.cjs');
const s=c.path.join(c.root,'.runtime/ciw-completion-20261028/batch1042-metadata');
const safe=v=>Array.isArray(v)?v.map(safe):v&&typeof v==='object'?Object.fromEntries(Object.entries(v).map(([k,x])=>[k,k==='authHeaders'?[]:safe(x)])):v;
async function main(){
 const path=c.path.join(s,'parent-preview-proof.json');c.assert.ok(!c.fs.existsSync(path));
 const before=c.readJson(c.path.join(s,'parent-before.json')),v=before.versions.find(x=>x.status==='published');
 const config=structuredClone(v.builderConfig);c.assert.equal(config.version,'1.0.4');config.version='1.0.5';
 const link={id:'manutencao_lote',label:'Manutencao rapida',screenId:'ciw.container-despesas-lote',parameters:[{field:'container_id',sourceField:'container_id'}],position:'end'};
 c.assert.ok(!config.rowLinks.some(x=>x.id===link.id));config.rowLinks.push(link);
 await c.session(async({api})=>{
  c.assert.deepEqual(safe(await api('/programs/op1003')),before,'Parent changed after preflight');
  const preview=await api('/preview',config),expected=structuredClone(v.generatedDefinition);
  expected.program.version='1.0.5';expected.crud.grid.rowLinks.push(link);
  c.assert.deepEqual(safe(preview.generatedDefinition),safe(expected),'Unexpected native parent delta');
  c.fs.writeFileSync(c.path.join(s,'parent-draft.json'),JSON.stringify(config,null,2)+'\n');
  c.fs.writeFileSync(path,JSON.stringify({success:true,readOnly:true,deltaReviewed:true,parentBeforeSha256:c.sha(c.path.join(s,'parent-before.json')),parentDraftSha256:c.sha(c.path.join(s,'parent-draft.json')),onlyVersionAndLink:true,ignoredPaths:[],expectedGeneratedDefinition:safe(expected),catalogWrites:false,businessWrites:false},null,2)+'\n');
  console.log('PASS1042 parent native whole-preview exactly version+one link; no catalog write');
 },{readOnly:false});
}
main().catch(e=>{console.error('1042_PARENT_PREVIEW_FAILED '+e.message);process.exitCode=1;});
