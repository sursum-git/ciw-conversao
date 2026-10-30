'use strict';
const c=require('./purchase-payments-builder-common.cjs');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/cadastros-queries');
const meta=c.path.join(c.root,'integration-src/ciw-completion-20261028/cadastro-query-filters');
const codes=['cd0094','cd0095','cd0096','cd0097','cd0098'];
const save=(p,v)=>c.fs.writeFileSync(p,JSON.stringify(v,null,2)+'\n');
async function main(){
 c.fs.mkdirSync(meta,{recursive:true});
 await c.session(async({api})=>{
  const results=[];
  for(const code of codes){
   const old=c.readJson(c.path.join(state,code+'-program-before.json'));
   const published=old.versions.filter(v=>v.status==='published');c.assert.equal(published.length,1);
   const v=published[0];c.assert.deepEqual(await api('/programs/'+code),old,'PROGRAM_CHANGED');
   const previous=c.readJson(c.path.join(state,v.screenId+'.json')).definition;
   const filterFields=previous.crud.filter.fields.map(f=>f.field);
   const textFields=code==='cd0098'?['codigo','val_param']:['descricao'];
   for(const field of textFields)c.assert.ok(previous.dataModel.fields[field]&&!filterFields.includes(field));
   const draft=structuredClone(v.builderConfig);c.assert.equal(draft.version,'1.0.0');
   draft.version='1.0.1';draft.crudOptions={...(draft.crudOptions??{}),filterFields:[...filterFields,...textFields]};
   const restored=structuredClone(draft);restored.version=v.builderConfig.version;restored.crudOptions=v.builderConfig.crudOptions;c.assert.deepEqual(restored,v.builderConfig);
   save(c.path.join(meta,code+'-program-draft.json'),draft);
   const preview=await api('/preview',draft);save(c.path.join(state,code+'-preview.json'),preview);
   results.push({code,screenId:v.screenId,fields:[...filterFields,...textFields],added:textFields,draftSha256:c.sha(c.path.join(meta,code+'-program-draft.json')),previewKeys:Object.keys(preview),entityUnchanged:true,writerUnchanged:true});
  }
  save(c.path.join(state,'filter-candidates.json'),{success:true,screens:results,businessWrites:false,humanPermissionsChanged:false});
  console.log(JSON.stringify(results));
 },{readOnly:false});
}
main().catch(e=>{console.error(e.message);process.exitCode=1});
