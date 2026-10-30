'use strict';
const c=require('./purchase-payments-builder-common.cjs'),vm=require('node:vm');
const d=c.path.join(c.root,'.runtime/ciw-completion-20261028/build11-metadata-publication-preparation');
async function main(){
 const output=c.path.join(d,'runtime-read-proof.json');c.assert.ok(!c.fs.existsSync(output));c.assert.ok(c.readJson(c.path.join(d,'metadata-publication.json')).success);
 const scope={console,URL,URLSearchParams,window:null,jQuery:()=>{}};scope.window=scope;vm.createContext(scope);
 for(const f of ['page-engine/PageDefinitionNormalizer','crud-engine/CrudUtils','crud-engine/CrudDefinitionValidator'])vm.runInContext(c.fs.readFileSync('D:/opencode/construtor-pg/src/'+f+'.js','utf8'),scope);
 await c.session(async({runtime})=>{
  const raw=await runtime('ciw.despesas-impostos-geral'),definition=new scope.PageDefinitionNormalizer().normalize(raw);new scope.CrudDefinitionValidator().validate(definition);
  c.assert.equal(definition.program.id,'op1055');c.assert.equal(definition.program.version,'1.0.0');c.assert.deepEqual(Array.from(definition.contextFields),[]);
  const body=await runtime('ciw.despesas-impostos-geral/endpoints/read',{take:2,skip:0});c.assert.ok(Array.isArray(body.data)&&body.data.length>0&&body.total>=body.data.length);
  const row=body.data[0],keys=['despesa_id','imposto_id','empresa_id'];c.assert.equal(typeof row.record_key,'string');for(const k of keys)c.assert.equal(row[k],JSON.parse(row.record_key)[k]);
  const detail=await runtime('ciw.despesas-impostos-geral/endpoints/get',{id:row.record_key,record_key:row.record_key});const record=Object.hasOwn(detail,'record_key')?detail:detail.data;c.assert.deepEqual(record,row);
  const filtered=await runtime('ciw.despesas-impostos-geral/endpoints/read',{take:2,filters:keys.map(field=>({field,operator:'eq',value:row[field]}))});c.assert.equal(filtered.total,1);c.assert.deepEqual(filtered.data,[row]);
  const beyond=await runtime('ciw.despesas-impostos-geral/endpoints/read',{take:2,skip:2});c.assert.equal(beyond.total,body.total);for(const next of beyond.data)c.assert.ok(!body.data.some(old=>old.record_key===next.record_key));
  const bad=await runtime('ciw.despesas-impostos-geral/endpoints/get',{id:row.record_key,record_key:row.record_key+' '},422);c.assert.ok(bad.error);
  c.fs.writeFileSync(output,JSON.stringify({success:true,nativeDefinitionValidator:true,nativeRead:true,nativePositiveGet:true,nativeFilters:true,nativePaging:true,aliasRejected:true,global:true,observedTotal:body.total,program:'op1055',version:'1.0.0',businessWrites:false,humanPermissionsChanged:false,ldapUiVerified:false},null,2)+'\n');
  console.log('PASS1055 native definition/read/get/paging/filter/alias; no business or human grants');
 });
}
main().catch(e=>{console.error('BUILD11_RUNTIME_VERIFICATION_FAILED '+e.message);process.exitCode=1;});
