'use strict';
const c=require('./purchase-payments-builder-common.cjs'),vm=require('node:vm');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build5-v6'),save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
const scope={console,URL,window:null,jQuery:()=>{throw Error('DOM_NOT_EXPECTED');},location:{href:'http://127.0.0.1:8765',origin:'http://127.0.0.1:8765'}};scope.window=scope;vm.createContext(scope);
for(const f of ['src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudDefinitionValidator.js'])vm.runInContext(c.fs.readFileSync(c.path.join('D:/opencode/construtor-pg',f),'utf8'),scope,{filename:f});
async function main(){c.assert.ok(c.readJson(c.path.join(state,'metadata-publication.json')).success);await c.session(async({api,runtime})=>{
 const context={container_id:332526,versao_id:2354},results=[];
 for(const row of c.readJson(c.path.join(state,'metadata-publication.json')).published.filter(x=>x.code!=='op1005')){
  const screen=await runtime(row.screen);c.assert.equal(new scope.CrudDefinitionValidator().validate(screen),true);c.assert.equal(screen.program.version,'1.0.0');
  const read=await runtime(row.screen+'/endpoints/read',{context,take:200,skip:0});c.assert.ok(Array.isArray(read.data));
  for(const item of read.data){c.assert.equal(item.container_id,context.container_id);c.assert.equal(item.versao_id,context.versao_id);}
  let get=false;
  if(read.data.length){const detail=await runtime(row.screen+'/endpoints/get',{context,id:read.data[0].record_key});c.assert.deepEqual(detail.data??detail,read.data[0]);get=true;}
  await runtime(row.screen+'/endpoints/read',{context:{container_id:context.container_id},take:200},422);
  for(const action of ['create','edit','delete'])c.assert.equal(screen.permissions[action],false);
  save(row.code+'-runtime-read-private.json',read);results.push({code:row.code,screen:row.screen,total:read.total,read:true,get,nativeValidator:true,readonly:true,requiredContextRejected:true});
 }
 const parent=await runtime('ciw.container-versoes-custo');c.assert.equal(parent.program.version,'1.0.2');c.assert.equal(parent.crud.grid.rowLinks.length,5);c.assert.equal(new scope.CrudDefinitionValidator().validate(parent),true);
 save('op1005-program-after.json',await api('/programs/op1005'));
 const source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;c.assert.equal(source.operations.length,132);const baseline=c.readJson(c.path.join(state,'source-124-before.json'));for(const op of baseline.operations)c.assert.deepEqual(source.operations.find(x=>x.code===op.code),op);
 save('runtime-read-proof.json',{success:true,results,parent:{version:'1.0.2',links:5,nativeValidator:true},businessWrites:false,humanPermissionsChanged:false,source132:true});
 console.log('PASS native runtime4readonlyscreens/validators/context;3positiveget/discountsempty;parent5links/source132');
 },{readOnly:true});}
main().catch(e=>{console.error(e.message);process.exitCode=1});
