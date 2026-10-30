// Somente definições e endpoints read/get/options. Nunca associa/desvincula.
const c=require('./purchase-payments-builder-common.cjs'),vm=require('node:vm');
async function main(){return c.session(async({api,runtime})=>{
 const context={console,URL,window:null,location:{href:c.base,origin:c.base}};context.window=context;vm.createContext(context);
 for(const file of ['src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudDefinitionValidator.js'])vm.runInContext(c.fs.readFileSync(c.path.join('D:/opencode/construtor-pg',file),'utf8'),context,{filename:file});
 const proof={success:false,businessWrites:false,catalogWrites:false,origin:'MED',checks:[]};
 const ds=c.drafts(),definitions=[];
 for(const draft of ds){
  const screen=draft.programDraft.screenId,def=await runtime(screen);c.assert.equal(def.program.id,draft.programDraft.programCode);c.assert.equal(def.program.version,draft.programDraft.version);c.assert.equal(new context.CrudDefinitionValidator().validate(def),true);c.assert.ok(def.program.title.includes('MED'));c.assert.equal(def.permissions.edit,false);c.save('runtime-definition-'+draft.slug+'.json',def);
  definitions.push(def);
 }
 const parent=ds[0].programDraft.screenId,linked=ds[1].programDraft.screenId;
 const parentSort=definitions[0].crud?.query?.defaultSort??definitions[0].query?.defaultSort??[{field:'proc_compra_id',dir:'desc'}];
 const page=await runtime(parent+'/endpoints/read',{skip:0,take:2,pageSize:2,page:1,sort:parentSort});c.assert.ok(Array.isArray(page.data));c.assert.ok(Number.isInteger(page.total));c.assert.ok(page.data.length<=2);
 const requested=process.argv.find(x=>x.startsWith('--fixture='));const id=requested?Number(requested.slice(10)):page.data[0]?.proc_compra_id;
 proof.checks.push({screenId:parent,nativeValidator:true,list:true,total:page.total});
 if(id!==undefined){
  c.assert.ok(Number.isSafeInteger(id)&&id>0);
  const rowResponse=await runtime(parent+'/endpoints/get',{id}),row=rowResponse.data??rowResponse;c.assert.equal(row.proc_compra_id,id);
  const ctx={proc_compra_id:id};
  const payments=await runtime(linked+'/endpoints/read',{context:ctx,skip:0,take:2,pageSize:2,page:1});c.assert.ok(Array.isArray(payments.data));c.assert.ok(payments.data.every(x=>x.proc_compra_id===id));
  const options=await runtime(linked+'/endpoints/options.titulos',{context:ctx});const available=options.data??options.options??options;c.assert.ok(Array.isArray(available));
  if(payments.data.length){const payment=payments.data[0];c.assert.match(payment.pagamento_key,/^p_[0-9a-f]{64}$/i);const detail=await runtime(linked+'/endpoints/get',{id:payment.pagamento_key,context:ctx});c.assert.equal((detail.data??detail).pagamento_key,payment.pagamento_key);c.assert.deepEqual((detail.data??detail).titulos,[payment.num_id_tit_ap]);}
  proof.checks.push({screenId:linked,nativeValidator:true,contextRead:true,optionsRead:true,detailChecked:payments.data.length>0,paymentCount:payments.total??payments.data.length,availableTitleCount:available.length});
 }
 for(const [endpoint,payload] of [['read',{}],['options.titulos',{}],['read',{context:{proc_compra_id:0}}],['options.titulos',{context:{proc_compra_id:'1 OR TRUE'}}]]){const rejected=await runtime(linked+'/endpoints/'+endpoint,payload,422);c.assert.ok(rejected.error?.code);}
 proof.negativeContextChecks=4;
 const home=await runtime('home');const parentLinks=home.programs.filter(x=>x.screenId===parent);c.assert.equal(parentLinks.length,1);c.assert.equal(home.programs.filter(x=>x.screenId===linked).length,0);c.assert.ok(home.navigation.groups.find(x=>x.id==='ciw-consultas')?.items.some(x=>x.programId===parentLinks[0].id));
 proof.homeOnlyParent=true;proof.success=true;proof.at=new Date().toISOString();c.save('builder-runtime-verification.json',proof);console.log(JSON.stringify(proof));
});}
if(require.main===module)main().catch(e=>{console.error(e.message);process.exitCode=1;});
