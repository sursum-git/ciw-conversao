'use strict';
// Root-only: exactly three program GETs and their three existing entity GETs.
const c=require('./purchase-payments-builder-common.cjs');
const helpers=require('./export-ciw-container-item-action-current.cjs');
const DIR=c.path.join(c.root,'.runtime/ciw-completion-20261028/item-navigation-after13-fresh');
const TARGETS=[
 ['op1008','ciw.container-custos-itens','container_custo_itens_progress'],
 ['op1002','ciw.container-itens','container_itens_progress'],
 ['op1014','ciw.proc-compra-itens','proc_compra_itens_progress']
];
async function collect(api){
 const documents=[],bindings=[];
 for(const [programCode,screenId,entityCode]of TARGETS){
  const program=await api('/programs/'+programCode);
  c.assert.equal(program.program.code,programCode);
  const version=helpers.published(program,screenId);
  c.assert.equal(version.builderEntityCode,entityCode,'EXACT_EXISTING_ENTITY_REQUIRED');
  const entity=await api('/entities/'+entityCode);
  c.assert.equal(entity.entity.code,entityCode);
  documents.push([programCode+'-program.json',helpers.safe(program)],[entityCode+'-entity.json',helpers.safe(entity)]);
  bindings.push({programCode,screenId,entityCode,version:version.version,versionId:version.id,sourceCode:entity.entity.apiSourceCode});
 }
 return {documents,bindings};
}
async function main(){
 c.assert.deepEqual(process.argv.slice(2),['--export-readonly']);
 c.assert.ok(!c.fs.existsSync(DIR),'EXISTING_EXPORT_PRESERVE_NO_REPLAY');
 c.fs.mkdirSync(DIR,{recursive:true});
 await c.session(async({api})=>{
  const {documents,bindings}=await collect(api),files=[];
  for(const [name,value]of documents){const file=c.path.join(DIR,name);c.fs.writeFileSync(file,JSON.stringify(value,null,2)+'\n',{flag:'wx'});files.push({path:file,sha256:c.sha(file)});}
  const proof={success:true,readOnly:true,observedAtUtc:new Date().toISOString(),toolSha256:c.sha(__filename),sanitizerSha256:c.sha(require.resolve('./export-ciw-container-item-action-current.cjs')),sessionHelperSha256:c.sha(require.resolve('./purchase-payments-builder-common.cjs')),bindings,metadataGets:6,allNestedHeadersOmitted:true,sensitivePropertiesRedacted:true,sourceAuthenticationInMemoryOnly:true,sanitizedDtoNeverAuthenticationInput:true,catalogWrites:false,runtimeCalls:false,erpCalls:false,businessWrites:false,files};
  const file=c.path.join(DIR,'export-proof.json');c.fs.writeFileSync(file,JSON.stringify(proof,null,2)+'\n',{flag:'wx'});
  console.log(JSON.stringify({success:true,path:DIR,metadataGets:6,files:files.length,proofSha256:c.sha(file),catalogWrites:false,businessWrites:false}));
 },{readOnly:true});
}
module.exports={DIR,TARGETS,collect,main};
if(require.main===module)main().catch(()=>{console.error('ITEM_NAVIGATION_READONLY_EXPORT_FAILED; preserve private folder; no automatic retry');process.exitCode=1;});
