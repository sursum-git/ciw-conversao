'use strict';
const c=require('./purchase-payments-builder-common.cjs');
const dir=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build6-v2/tax-only-metadata');
const safe=v=>Array.isArray(v)?v.map(safe):v&&typeof v==='object'?Object.fromEntries(Object.entries(v).map(([k,x])=>[k,k==='authHeaders'?[]:safe(x)])):v;
const save=(n,v)=>c.fs.writeFileSync(c.path.join(dir,n),JSON.stringify(safe(v),null,2)+'\n');
async function main(){
 c.fs.mkdirSync(dir,{recursive:true});
 await c.session(async({api,runtime})=>{
  const boot=await api('/bootstrap'),source=(await api('/api-sources/motor_progress_container_processos')).apiSource;
  c.assert.equal(source.operations.length,5);c.assert.ok(!source.operations.some(x=>x.code==='calcular_impostos'));
  const old=c.readJson(c.path.join(c.root,'.runtime/ciw-completion-20261028/container-processes-source-before.json'));
  for(const key of ['code','baseUrl','responseContract','operations'])c.assert.deepEqual(source[key],old[key]);
  c.assert.ok(!boot.programs.some(x=>(x.programCode??x.code)==='op1043'));
  const entity=await api('/entities/container_processos_progress'),parent=await api('/programs/op1003');
  c.assert.deepEqual(parent,c.readJson(c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build3/op1003-program-after.json')));
  save('source-five-before.json',source);save('entity-before.json',entity);save('op1003-before.json',parent);
  const owners=boot.programs.filter(p=>p.builderEntityCode==='container_processos_progress');save('entity-owners.json',owners);
  const parentVersion=parent.versions.find(v=>v.status==='published');c.assert.equal(parentVersion.version,'1.0.2');
  const draft=structuredClone(parentVersion.builderConfig);c.assert.equal(draft.programCode,'op1003');draft.version='1.0.3';
  const navigation=c.readJson(c.path.join(c.root,'integration-src/ciw-completion-20261028/container-tax-only/frozen-v1.1/metadata/parent-navigation.json')).operations[0].value;
  c.assert.ok(!(draft.rowLinks??[]).some(x=>x.id===navigation.id));draft.rowLinks=[...(draft.rowLinks??[]),navigation];draft.changeSummary='Acrescenta acesso contextual ao cálculo separado de impostos do container; preserva manutenção e demais links.';
  const preview=await api('/preview',draft);const reverse=structuredClone(preview.generatedDefinition);reverse.program.version=parentVersion.generatedDefinition.program.version;reverse.crud.grid.rowLinks=parentVersion.generatedDefinition.crud.grid.rowLinks;c.assert.deepEqual(reverse,parentVersion.generatedDefinition,'PARENT_ONLY_LINK_VERSION_ALLOWED');
  save('op1003-parent-draft.json',draft);save('op1003-parent-preview.json',preview);
  save('preflight.json',{success:true,sourceOperations:5,parentVersion:'1.0.2',targetVersion:'1.0.3',sourcePreserved:true,parentDeltaOnlyLinkAndVersion:true,newProgramAvailable:true,entityFieldsPreserved:true,businessWrites:false,humanPermissionsChanged:false});
  console.log('PASS readonlymetadata preflight;source5/new1043available/parentonlylink1.0.3;sanitizedexports saved');
 },{readOnly:false}); // Only GET plus nonpersisting /preview; no catalog/business mutation.
}
main().catch(e=>{console.error(e.message);process.exitCode=1});
