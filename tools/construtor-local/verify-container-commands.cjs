'use strict';
// Only the fixed marked test container and synthetic ERP fixture may be written.
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const root=path.resolve(__dirname,'../..'),privateState=path.join(root,'.runtime/construtor-pg'),folder=path.join(root,'.runtime/container-commands-20261016');
const cid=2147000100,tag='SC_TEST_CMD_20261016_A',erp='ZTSC161026',mode=process.argv[2];
assert.ok(['inspect','inspect-test','create','maintain','maintain-recover','exercise','logs','delete','delete-compat'].includes(mode));
const read=p=>fs.readFileSync(p,'utf8').replace(/^\uFEFF/,''),load=p=>JSON.parse(read(p)),save=(name,v)=>fs.writeFileSync(path.join(folder,name),JSON.stringify(v,null,2)+'\n');
let headers={'Content-Type':'application/json'};const evidence={at:new Date().toISOString(),mode,container_id:cid,checks:[]};
async function api(route,body,status=200){const r=await fetch('http://127.0.0.1:8765'+route,{method:body===undefined?'GET':'POST',headers,body:body===undefined?undefined:JSON.stringify(body),signal:AbortSignal.timeout(120000)}),j=await r.json();assert.equal(r.status,status,JSON.stringify(j.error||j));return j;}
async function pasoe(route,body){const token=load(path.join(privateState,'containers-connection.json')).integrationToken;const r=await fetch('http://127.0.0.1:19910/med/web/SursumPrograms/'+route,{method:'POST',headers:{'Content-Type':'application/json','X-Containers-Token':token,'X-Sursum-User':'admin'},body:JSON.stringify(body),signal:AbortSignal.timeout(120000)});return await r.json();}
async function once(name,fn){const file=path.join(folder,'attempt-'+name+'.json');assert.ok(!fs.existsSync(file),'Attempt exists; inspect committed state before replaying '+name);save('attempt-'+name+'.json',{startedAt:new Date().toISOString(),container_id:cid});const result=await fn();save('response-'+name+'.json',result);return result;}
const endpoint=(screen,operation)=>'/api/runtime/screens/'+screen+'/endpoints/'+operation;
async function getParent(){const response=await pasoe('containers-painel',{resource:'painel',operation:'get',container_id:cid,id:cid});assert.equal(response.success,true,JSON.stringify(response));assert.ok(response.data.narrativa.startsWith(tag),'Test parent ownership');return response.data;}
async function runtime(screen,operation,payload){return await api(endpoint(screen,operation),payload);}
async function processRun(screen,parameters,name){const result=await once(name,()=>runtime(screen,'run',{context:{container_id:cid},parameters}));assert.equal(result.ok,true,JSON.stringify(result));assert.equal(result.status,'succeeded');evidence.checks.push(name);return result;}
async function logs(){return await runtime('admin.logs-transacoes','read',{take:500,filters:[{field:'audit_screen_id',operator:'eq',value:'ciw.container-painel'},{field:'audit_record_id',operator:'eq',value:String(cid)}]});}
(async()=>{
 const password=read(path.join(privateState,'acesso-local.txt')).split(/\r?\n/).find(l=>l.startsWith('Senha inicial=')).slice(14);
 const login=await api('/api/auth/login',{username:'admin',password,tenantId:'default',rememberMe:false});assert.equal(login.authenticated,true);
 headers={...headers,Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 try{
  if(mode==='inspect'){
   const master=await runtime('ciw.container-painel','get',{id:332526,context:{container_id:332526}});
   const companies=await runtime('ciw.empresas','read',{take:100});
   const companyMatches=companies.data.filter(x=>Number(x.cod_emp_ems2)===Number(String(master.cod_estabel).slice(0,1)));assert.equal(companyMatches.length,1,'Unique establishment/company mapping');const companyId=companyMatches[0].empresa_id;
   const expenses=await runtime('ciw.despesas','read',{take:1000});
   const links=await runtime('ciw.empresas-despesa','read',{take:1000,filter:{logic:'and',filters:[{field:'empresa_id',operator:'eq',value:companyId}]}});
   save('lookup-summary.json',{company:companyId,expenseColumns:Object.keys(expenses.data[0]||{}),linkColumns:Object.keys(links.data[0]||{}),linked:links.data.slice(0,8).map(x=>({empresa_id:x.empresa_id,despesa_id:x.despesa_id})),expenses:expenses.data.slice(0,8).map(x=>({despesa_id:x.despesa_id,log_calculada:x.log_calculada}))});
   const current=await runtime('ciw.container-despesas','read',{take:1000,context:{container_id:cid}});
   const existingExpenseIds=new Set(current.data.map(x=>x.despesa_id));
   const candidate=links.data.map(link=>expenses.data.find(e=>e.despesa_id===link.despesa_id)).find(e=>e&&!existingExpenseIds.has(e.despesa_id)&&e.despesa_id!==999&&(e.log_calculada===false||e.log_calculada===0));
   assert.ok(candidate,'No uncalculated linked expense; inspect before any business fixture');
   save('http-prerequisites.json',{containerCompanyId:companyId,manualExpenseId:candidate.despesa_id,sourceContainerPreserved:332526,syntheticERP:erp});
   evidence.checks.push('read-only company and expense prerequisites');
  }else if(mode==='inspect-test'){
   const master=await getParent(),expenses=await runtime('ciw.container-despesas','read',{take:1000,context:{container_id:cid}});
   save('test-state.json',{master,expenses});console.log(JSON.stringify({narrativa:master.narrativa,expenses:expenses.data}));
  }else if(mode==='create'){
   const missing=await pasoe('containers-painel',{resource:'painel',operation:'get',container_id:cid,id:cid});assert.equal(missing.success,false);assert.equal(missing.error.status,404);
   const result=await once('create-parent-typed',()=>pasoe('containers-cabecalho',{resource:'containers',operation:'create',container_id:cid,values:{narrativa:tag,cod_estabel:'505',cod_emit_forn:26715,situacao_container_id:7,ordem_busca_dolar_compra:'2',ordem_busca_dolar_di:'4',cod_tipo_proj_dolar:1,vl_dolar_compra:5,vl_dolar_di:5,vl_proj_dolar:0,vl_dolar_venda:5,log_gerar_saldo_a_pagar:false,log_gerar_distr_custo:false,log_liberar_custo_realizado:false}}));
   assert.equal(result.success,true,JSON.stringify(result));assert.equal(result.audit.source,'progress-transaction');assert.equal(result.audit.recordId,cid);assert.deepEqual(result.audit.before,{});await getParent();
   save('command-fixture-owned-costs.json',{container_id:cid,tag,synthetic_erp:erp,item_custo_ids:[2147000101]});evidence.checks.push('new marked parent created with confirmed audit');
  }else if(mode==='maintain'){
   await getParent();const prereq=load(path.join(folder,'http-prerequisites.json'));
   await once('header-update',()=>runtime('ciw.container-painel','update',{id:cid,record:{narrativa:tag+' atualizado'},context:{container_id:cid}}));
   evidence.checks.push('header update');
   const created=await once('expense-create',()=>runtime('ciw.container-despesas','create',{record:{despesa_id:prereq.manualExpenseId,vl_prev:1,vl_base_imp:0,vl_negociado:1,perc_calc:0},context:{container_id:cid}}));
   const expenseId=created.despesa_container_id||created.data?.despesa_container_id;assert.ok(Number.isInteger(expenseId));
   await once('expense-update',()=>runtime('ciw.container-despesas','update',{id:expenseId,record:{vl_prev:2},context:{container_id:cid}}));
   await once('expense-delete',()=>runtime('ciw.container-despesas','delete',{id:expenseId,context:{container_id:cid}}));evidence.checks.push('expense create/update/delete');
  }else if(mode==='maintain-recover'){
   const master=await getParent();assert.equal(master.narrativa,tag+' atualizado');
   assert.equal(load(path.join(folder,'response-create-parent-typed.json')).success,true);
   const prereq=load(path.join(folder,'http-prerequisites.json'));
   const created=await once('expense-create-unmanaged',()=>runtime('ciw.container-despesas','create',{record:{despesa_id:prereq.manualExpenseId,vl_prev:1,vl_base_imp:0,vl_negociado:1,perc_calc:0},context:{container_id:cid}}));
   const expenseId=created.despesa_container_id||created.data?.despesa_container_id;assert.ok(Number.isInteger(expenseId));
   await once('expense-update',()=>runtime('ciw.container-despesas','update',{id:expenseId,record:{vl_prev:2},context:{container_id:cid}}));
   await once('expense-delete',()=>runtime('ciw.container-despesas','delete',{id:expenseId,context:{container_id:cid}}));
   evidence.checks.push('header confirmed; separate unmanaged expense create/update/delete validated');save('http-maintain-evidence.json',evidence);
  }else if(mode==='exercise'){
   await getParent();
   assert.ok(fs.existsSync(path.join(folder,'http-maintain-evidence.json')),'Maintenance must be validated separately first');
   await processRun('ciw.container-sincronizar-impostos',{},'tax-sync');
   await processRun('ciw.container-gerar-versao',{tipo_versao_id:1,descricao:tag,expected_latest_version_id:0},'generate-version');
   const versions=await runtime('ciw.container-versoes-custo','read',{take:100,filters:[{field:'container_id',operator:'eq',value:cid}]});assert.equal(versions.data.length,1);const versionId=versions.data[0].versao_id;
   const before=await logs();save('logs-before-close.json',before);
   await processRun('ciw.container-fechar-custos',{versao_id:versionId,expected_latest_version_id:versionId,log_priorizar_custo_previsto:true},'close-costs');
   const after=await logs();save('logs-after-close.json',after);assert.ok(after.data.length>before.data.length);
   const owned=load(path.join(folder,'command-fixture-owned-costs.json'));
   for(const event of after.data){
    let a=event.after_data;if(typeof a==='string'){try{a=JSON.parse(a);}catch{continue;}}
    if(a&&a.it_codigo===erp&&Number.isInteger(a.item_custo_id)&&a.item_custo_id>0&&!owned.item_custo_ids.includes(a.item_custo_id))owned.item_custo_ids.push(a.item_custo_id);
   }
   assert.ok(owned.item_custo_ids.length>1,'Confirmed synthetic new cost must appear in logs before cleanup');save('command-fixture-owned-costs.json',owned);
   const blocked=await pasoe('containers-cabecalho',{resource:'containers',operation:'delete',container_id:cid,id:cid});assert.equal(blocked.success,false);evidence.checks.push('master delete blocked by item-cost dependencies');
   await getParent();evidence.version_id=versionId;evidence.ownedCostIds=owned.item_custo_ids;
  }else if(mode==='logs'){
   const result=await logs();assert.ok(result.data.length>0);save('logs-final.json',result);
   assert.ok(result.data.some(row=>row.actor_user_name||row.actor_user_id));
   assert.ok(result.data.some(row=>row.before_data&&row.after_data&&row.diff_data));
   const events=result.data.map(row=>({...row,meta:JSON.parse(row.metadata),before:JSON.parse(row.before_data),after:JSON.parse(row.after_data),diff:JSON.parse(row.diff_data)})).filter(row=>row.meta.audit?.source==='progress-transaction');
   assert.ok(events.length>0);for(const row of events){assert.equal(row.meta.audit.containerId,cid);assert.equal(row.actor_user_id,'admin');assert.equal(row.actor_user_name,'Administrador');}
   assert.ok(events.some(row=>row.meta.audit.resource==='despesas_container'&&row.diff.vl_prev?.before===1&&row.diff.vl_prev?.after===2),'Expense before1/after2 must be visible');
   if(fs.existsSync(path.join(folder,'http-exercise-evidence.json'))){
    const run=load(path.join(folder,'http-exercise-evidence.json'));
    assert.ok(events.some(row=>row.meta.audit.resource==='container_versions'&&row.meta.audit.recordId===run.version_id));
    assert.ok(events.some(row=>row.meta.audit.resource==='item_custos'&&run.ownedCostIds.includes(row.meta.audit.recordId)&&row.after.it_codigo===erp));
    for(const screen of ['ciw.container-sincronizar-impostos','ciw.container-gerar-versao','ciw.container-fechar-custos'])assert.ok(events.some(row=>row.meta.screenId===screen),'Missing committed process audit '+screen);
   }
   evidence.confirmedEvents=events.length;evidence.checks.push('scoped logs include authenticated actor, same-container master/children, expense1→2 and committed process/cost snapshots');
  }else{
   const cleanup=load(path.join(folder,'command-fixture-cleanup.json'));assert.equal(cleanup.success,true);assert.equal(cleanup.syntheticRecordsRemoved,true);await getParent();
   await once(mode==='delete-compat'?'parent-delete-compat':'parent-delete',()=>runtime('ciw.container-painel','delete',{id:cid,context:{container_id:cid}}));
   const missing=await pasoe('containers-painel',{resource:'painel',operation:'get',container_id:cid,id:cid});assert.equal(missing.success,false);assert.equal(missing.error.status,404);evidence.checks.push('marked test parent removed; deletion logs retained');
  }
  save('http-'+mode+'-evidence.json',evidence);console.log('PASS:'+mode+' '+JSON.stringify(evidence.checks));
 }finally{await api('/api/auth/logout',{});}
})().catch(error=>{console.error(error.message);process.exitCode=1;});

