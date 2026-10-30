'use strict';
// Native boundary verification only. Never submits a batch or another mutation.
const c=require('./purchase-payments-builder-common.cjs'),vm=require('node:vm');
const s=c.path.join(c.root,'.runtime/ciw-completion-20261028/batch1042-metadata');
const fields=['despesa_container_id','despesa_id','vl_prev','container_id','calc_imp_container_id','vl_base_imp','vl_negociado','vl_proforma','cta_corren_custo_distr_id','log_utilizado','log_manual','perc_calc','memoria_calculo','item_container_id'];
async function main(){
 const output=c.path.join(s,'native-read-proof.json');c.assert.ok(!c.fs.existsSync(output));c.assert.ok(c.readJson(c.path.join(s,'metadata-publication.json')).success);
 const scope={console,URL,URLSearchParams,window:null,jQuery:()=>{}};scope.window=scope;vm.createContext(scope);
 for(const f of ['page-engine/PageDefinitionNormalizer','crud-engine/CrudUtils','crud-engine/CrudDefinitionValidator'])vm.runInContext(c.fs.readFileSync('D:/opencode/construtor-pg/src/'+f+'.js','utf8'),scope);
 await c.session(async({runtime})=>{
  const raw=await runtime('ciw.container-despesas-lote'),definition=new scope.PageDefinitionNormalizer().normalize(raw);new scope.CrudDefinitionValidator().validate(definition);
  c.assert.equal(definition.program.id,'op1042');c.assert.equal(definition.program.version,'1.0.0');c.assert.equal(definition.grid.editing.mode,'batch');c.assert.deepEqual(Array.from(definition.grid.editing.snapshot.originalFields),fields);c.assert.deepEqual(Array.from(definition.grid.editing.snapshot.contextFields),['container_id']);c.assert.equal(definition.permissions.create,false);
  const context={container_id:332526},body=await runtime('ciw.container-despesas-lote/endpoints/read',{context,take:2,skip:0});c.assert.ok(Array.isArray(body.data)&&body.data.length>0);
  const row=body.data[0];c.assert.equal(row.container_id,context.container_id);c.assert.deepEqual(Object.keys(row).sort(),[...fields].sort());
  const detail=await runtime('ciw.container-despesas-lote/endpoints/get',{context,id:row.despesa_container_id});const record=Object.hasOwn(detail,'despesa_container_id')?detail:detail.data;c.assert.deepEqual(record,row);
  const missing=await runtime('ciw.container-despesas-lote/endpoints/read',{take:2},422);c.assert.ok(missing.error);
  c.fs.writeFileSync(output,JSON.stringify({success:true,program:'op1042',nativeDefinitionValidator:true,nativeRead:true,nativePositiveGet:true,fullOriginalFields:14,missingContextRejected:true,allowCreate:false,sourceAuthenticationWorks:true,businessWrites:false,batchesExecuted:0,humanGrantsVerifiedSeparately:true},null,2)+'\n');
  console.log('PASS1042 native definition/read/get/full14/context; no batch or business write');
 });
}
main().catch(e=>{console.error('1042_NATIVE_READ_FAILED '+e.message);process.exitCode=1;});
