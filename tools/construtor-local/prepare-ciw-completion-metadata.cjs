'use strict';
const c=require('./purchase-payments-builder-common.cjs');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build3');
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
async function main(){await c.session(async({api,runtime})=>{
 const source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;
 const safe=Object.fromEntries(['code','baseUrl','responseContract','operations'].map(k=>[k,source[k]]));
 c.assert.deepEqual(safe,c.readJson(c.path.join(c.root,'.runtime/ciw-completion-20261028/source-118-before.json')));
 const boot=await api('/bootstrap');
 const dirs=['container-fiscal-readonly/metadata/op1033-builder-draft.json','container-fiscal-readonly/metadata/op1034-builder-draft.json','container-version-history/frozen-v1.3/metadata/history-builder-draft.json'];
 const children=dirs.map(p=>c.readJson(c.path.join(c.root,'integration-src/ciw-completion-20261028',p)));
 for(const d of children){c.assert.ok(!boot.programs.some(p=>(p.programCode??p.code)===d.programDraft.programCode||p.screenId===d.programDraft.screenId));c.assert.ok(!boot.entities.some(e=>e.code===d.entityDraft.code));}
 const parents=[];
 for(const [screen,link]of [
 ['ciw.container-despesas',c.readJson(c.path.join(c.root,'integration-src/ciw-completion-20261028/container-fiscal-readonly/patches/parent-navigation.json')).patches[0].operations[0].value],
 ['ciw.container-versoes-custo',c.readJson(c.path.join(c.root,'integration-src/ciw-completion-20261028/container-version-history/frozen-v1.3/metadata/parent-patch.json')).operations.find(x=>x.op==='add').value]]){
  const program=boot.programs.find(p=>p.screenId===screen);c.assert.ok(program,'PARENT_SCREEN_NOT_FOUND '+screen);
  const code=program.programCode??program.code,record=await api('/programs/'+code);save(code+'-program-before.json',record);
  const published=record.versions.filter(v=>v.status==='published').at(-1);c.assert.ok(published);
  const draft=structuredClone(published.builderConfig);
  c.assert.ok(draft,'CONFIG_NOT_FOUND');c.assert.equal(draft.screenId,screen);
  draft.version=draft.version.replace(/(\d+)$/,x=>String(Number(x)+1));draft.rowLinks??=[];c.assert.ok(!draft.rowLinks.some(x=>x.id===link.id));draft.rowLinks.push(link);
  save(code+'-parent-draft.json',draft);save(screen+'-runtime-before.json',await runtime(screen));parents.push({code,screen,draftFile:code+'-parent-draft.json'});
 }
 save('metadata-preflight.json',{success:true,sourceOperations:source.operations.length,children:children.map(d=>({code:d.programDraft.programCode,entity:d.entityDraft.code,screen:d.programDraft.screenId})),parents,businessWrites:false});
 console.log('PASS metadata preflight:3new readonly children,2parent link deltas,118source operations preserved');
 },{readOnly:true});}
main().catch(e=>{console.error(e.message);process.exitCode=1});
