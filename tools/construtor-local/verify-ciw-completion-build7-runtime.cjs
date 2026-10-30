'use strict';
const c=require('./purchase-payments-builder-common.cjs'),vm=require('node:vm');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build7');
const scope={console,URL,window:null,jQuery:()=>{throw Error('DOM_NOT_EXPECTED');},location:{href:c.base,origin:c.base}};scope.window=scope;vm.createContext(scope);
for(const file of ['src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudDefinitionValidator.js'])vm.runInContext(c.fs.readFileSync(c.path.join('D:/opencode/construtor-pg',file),'utf8'),scope,{filename:file});
const saved=resource=>c.readJson(c.path.join(state,resource+'-rows-private.json'));
async function main(){const receipt=c.readJson(c.path.join(state,'metadata-publication.json'));c.assert.ok(receipt.success);await c.session(async({api,runtime})=>{
 const results=[];
 for(const row of receipt.published){
  const spec=c.fs.readdirSync(c.path.join(state,'metadata')).filter(x=>x.endsWith('-builder-draft.json')).map(x=>c.readJson(c.path.join(state,'metadata',x))).find(x=>x.programDraft.programCode===row.program);c.assert.ok(spec);
  const screen=await runtime(row.screen);c.assert.equal(new scope.CrudDefinitionValidator().validate(screen),true);c.assert.equal(screen.program.version,'1.0.0');for(const action of ['create','edit','delete'])c.assert.equal(screen.permissions[action],false);
  const resource=spec.entityDraft.apiListOperationCode.replace(/_read$/,'');let context={},canRead=true;
  for(const owner of spec.programDraft.contextFields??[]){
   const rowsFile=c.path.join(state,resource+'-rows-private.json');const own=c.fs.existsSync(rowsFile)?saved(resource).data[0]:null;
   const parent=owner.field==='desconto_importacao_id'?saved('import_descontos_geral').data[0]:saved('custo_distribuicao_itens_aptos').data[0];
   const id=own?.[owner.field]??(owner.field==='desconto_importacao_id'?parent?.desconto_importacao_id:parent?.item_container);
   if(!Number.isInteger(id)||id<=0)canRead=false;else context[owner.field]=id;
  }
  const entry={program:row.program,screen:row.screen,nativeValidator:true,readonly:true,read:false,get:false,contextRequired:(spec.programDraft.contextFields??[]).length>0};
  if(canRead){const read=await runtime(row.screen+'/endpoints/read',{context,take:200,skip:0});c.assert.ok(Array.isArray(read.data));entry.read=true;entry.total=read.total;
   for(const item of read.data)for(const [key,value]of Object.entries(context))c.assert.equal(item[key],value);
   if(read.data.length){const detail=await runtime(row.screen+'/endpoints/get',{context,id:read.data[0].record_key});const record=Object.hasOwn(detail,'record_key')?detail:detail.data;c.assert.deepEqual(record,read.data[0]);entry.get=true;}
  }else entry.skipped='No positive owner observed by source API; no invented context';
  if(entry.contextRequired){await runtime(row.screen+'/endpoints/read',{context:{},take:200},422);entry.missingContextRejected=true;}
  if(row.program==='op1049'){const link=screen.crud.grid.rowLinks.find(x=>x.screenId==='ciw.custo-distribuicao-lancamentos-item');c.assert.ok(link,'LEDGER_LINK_REQUIRED');entry.ledgerContextLink=true;}
  results.push(entry);
 }
 const source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;c.assert.equal(source.operations.length,140);
 const old=c.readJson(c.path.join(state,'metadata-source-before.json'));for(const op of old.operations)c.assert.deepEqual(source.operations.find(x=>x.code===op.code),op);
 c.fs.writeFileSync(c.path.join(state,'runtime-read-proof.json'),JSON.stringify({success:true,results,source140:true,previous132Preserved:true,businessWrites:false,humanPermissionsChanged:false},null,2)+'\n');
 console.log('PASS4native readonly definitions/validators/read/get/context and newledgerlink;source140/previous132 preserved');
 },{readOnly:true});}
main().catch(e=>{console.error(e.message);process.exitCode=1});
