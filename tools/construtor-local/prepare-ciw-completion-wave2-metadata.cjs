'use strict';
const c=require('./purchase-payments-builder-common.cjs');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build5-v6');
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
async function main(){await c.session(async({api,runtime})=>{
 c.assert.ok(!c.fs.existsSync(c.path.join(state,'metadata-publication-started.json')),'PUBLICATION_ALREADY_STARTED');
 const source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;
 const safe=Object.fromEntries(['code','baseUrl','responseContract','operations'].map(k=>[k,structuredClone(source[k])]));
 c.assert.deepEqual(safe,c.readJson(c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build3/source-124-after.json')));save('source-124-before.json',safe);
 const boot=await api('/bootstrap');
 const auxDir=c.path.join(c.root,'integration-src/ciw-completion-20261028/container-version-history/frozen-aux-v1.1/metadata');
 const specs=c.fs.readdirSync(auxDir).filter(n=>n.endsWith('-builder-draft.json')).map(n=>c.readJson(c.path.join(auxDir,n)));
 const batch=c.readJson(c.path.join(c.root,'.runtime/ciw-completion-20261028/container-expense-batch/frozen-v1/metadata/despesas-lote-builder-draft.json'));
 c.assert.equal(specs.length,4);
 for(const d of [...specs,batch]){c.assert.ok(!boot.programs.some(p=>(p.programCode??p.code)===d.programDraft.programCode||p.screenId===d.programDraft.screenId));c.assert.ok(!boot.entities.some(e=>e.code===d.entityDraft.code));}
 const parents=[];
 const historyLinks=c.readJson(c.path.join(auxDir,'parent-additions.json')).operations.map(x=>x.value);
 const batchLink=c.readJson(c.path.join(c.root,'.runtime/ciw-completion-20261028/container-expense-batch/frozen-v1/patches/bridge/parent-navigation.json')).operations[0].value;
 for(const [screen,version,links]of [['ciw.container-versoes-custo','1.0.1',historyLinks],['ciw.container-despesas','1.0.2',[batchLink]]]){
  const p=boot.programs.find(p=>p.screenId===screen);c.assert.ok(p);const code=p.programCode??p.code,record=await api('/programs/'+code);save(code+'-program-before.json',record);
  const published=record.versions.filter(v=>v.status==='published').at(-1);c.assert.equal(published.builderConfig.version,version);
  const draft=structuredClone(published.builderConfig);draft.version=draft.version.replace(/(\d+)$/,n=>String(Number(n)+1));draft.rowLinks??=[];
  for(const link of links){c.assert.ok(!draft.rowLinks.some(x=>x.id===link.id));draft.rowLinks.push(link);}save(code+'-parent-draft.json',draft);
  save(screen+'-runtime-before.json',await runtime(screen));parents.push({code,screen,draftFile:code+'-parent-draft.json',addedLinks:links.length});
 }
 const expenseSource=(await api('/api-sources/motor_progress_container_despesas')).apiSource;
 c.assert.equal(expenseSource.baseUrl,source.baseUrl);c.assert.equal(expenseSource.authMode,'header_static');
 save('metadata-preflight.json',{success:true,sourceOperations:124,children:specs.map(d=>({code:d.programDraft.programCode,entity:d.entityDraft.code,screen:d.programDraft.screenId})),batchCandidate:{code:batch.programDraft.programCode,screen:batch.programDraft.screenId,positiveWriterTestPending:true},parents,businessWrites:false});
 console.log('PASS metadata preflight124ops/4newreadonlychildren/2parents; batchpositive business test remains pending');
 },{readOnly:true});}
main().catch(e=>{console.error(e.message);process.exitCode=1});
