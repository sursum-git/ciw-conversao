'use strict';
const c=require('./purchase-payments-builder-common.cjs'),state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build3');
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
async function main(){c.assert.equal(c.readJson(c.path.join(state,'metadata-publication.json')).success,true);await c.session(async({api,runtime})=>{
 const cid=332526,parentRows=c.readJson(c.path.join(state,'parent-rows-private.json')),expense=parentRows.expenses.data.find(x=>x.calc_imp_container_id>0),vid=parentRows.versions.data[0].versao_id;
 const items=[{screen:'ciw.container-calculos-impostos-med',context:{container_id:cid,calc_imp_container_id:expense.calc_imp_container_id},id:expense.calc_imp_container_id},{screen:'ciw.container-despesa-memoria-med',context:{container_id:cid,despesa_container_id:expense.despesa_container_id},id:expense.despesa_container_id},{screen:'ciw.container-versao-itens-historico',context:{container_id:cid,versao_id:vid}}],proof=[];
 for(const x of items){
  const definition=await runtime(x.screen),read=await runtime(x.screen+'/endpoints/read',{context:x.context,take:200,skip:0});c.assert.ok(read.data.length>0);for(const row of read.data)for(const [k,v]of Object.entries(x.context))c.assert.equal(row[k],v);
  const id=x.id??read.data[0].record_key,detail=await runtime(x.screen+'/endpoints/get',{context:x.context,id});c.assert.ok(JSON.stringify(detail.data??detail)===JSON.stringify(read.data[0]),'NATIVE_GET_RECORD_DIFFERS');
  await runtime(x.screen+'/endpoints/read',{context:{container_id:cid},take:200},422);
  for(const op of ['create','edit','delete'])c.assert.equal(definition.permissions[op],false);
  save(x.screen+'-rows-runtime-private.json',read);proof.push({screen:x.screen,readGet:true,requiredContextRejected:true,totalObserved:read.total,readonly:true});
 }
 const parents=[];
 for(const screen of ['ciw.container-despesas','ciw.container-versoes-custo']){const d=await runtime(screen);c.assert.equal(d.program.version,screen==='ciw.container-despesas'?'1.0.2':'1.0.1');c.assert.equal(d.crud.grid.rowLinks.length,1);parents.push({screen,version:d.program.version,rowLink:d.crud.grid.rowLinks[0]});save(d.program.id+'-program-after.json',await api('/programs/'+d.program.id));}
 const source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;c.assert.equal(source.operations.length,124);save('source-124-after.json',Object.fromEntries(['code','baseUrl','responseContract','operations'].map(k=>[k,source[k]])));
 save('runtime-read-proof.json',{success:true,children:proof,parents,businessWrites:false,humanPermissionsChanged:false});console.log('PASS native runtime:3read/get/mandatory context,2parentlinks andversions,source124sanitized');
 },{readOnly:true});}
main().catch(e=>{console.error(e.message);process.exitCode=1});
