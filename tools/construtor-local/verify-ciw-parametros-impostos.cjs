/* Negocio real: somente novos registros CODEx, com limpeza dos proprios em finally. */
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/ciw-keyed-20261020'),base='http://127.0.0.1:8765';
const marker='CODEx-20-'+Date.now().toString(36)+'-'+crypto.randomUUID().slice(0,6),code=marker+"-a'ção",value=marker+'-valor';
const proof={marker,parameterCode:code,parametros:false,impostos:false,cleanup:false},ownedExpenses=new Set(),ownedLinks=new Set();let paramOwned=false,headers={};
const unwrap=x=>x.data&&!Array.isArray(x.data)?x.data:x;
async function request(url,body,status=200){const r=await fetch(base+url,{method:body===undefined?'GET':'POST',headers,...(body===undefined?{}:{body:JSON.stringify(body)}),signal:AbortSignal.timeout(40000)});const d=await r.json();assert.equal(r.status,status,d.error?.code||url);return d;}
const api=(screen,op,body,status)=>request('/api/runtime/screens/'+screen+'/endpoints/'+op,body,status);
const journal=()=>fs.writeFileSync(path.join(state,'test-ownership.json'),JSON.stringify({marker,code,paramOwned,expenses:[...ownedExpenses],links:[...ownedLinks]},null,2));
(async()=>{
 let password=fs.readFileSync(path.join(root,'.runtime/construtor-pg/acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const login=await fetch(base+'/api/auth/login',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({username:'admin',password,tenantId:'default',remember:false})}).then(x=>x.json());password=undefined;assert.ok(login.authenticated);
 headers={'Content-Type':'application/json',Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId,'X-Sursum-User':'forged-browser-user'};
 let baseId,taxId;
 try{
  const view=await request('/api/runtime/screens/ciw.parametros-ima');assert.equal(view.dataModel.primaryKey,'cod_param');assert.equal(view.dataModel.fields.codigo.readonlyOnEdit,true);assert.ok(!view.crud.form.fields.some(x=>x.field==='row_stamp'));
  await api('ciw.parametros-ima','get',{id:code},404);
  let row=unwrap(await api('ciw.parametros-ima','create',{record:{codigo:code,val_param:value,tp_param:1}}));paramOwned=true;journal();assert.equal(row.cod_param,code);assert.equal(row.codigo,code);assert.equal(row.val_param,value);assert.match(row.row_stamp,/^[A-F0-9]{64}$/);
  const old={...row};row=unwrap(await api('ciw.parametros-ima','update',{record:{...row,val_param:value+'-novo',tp_param:2}}));assert.notEqual(row.row_stamp,old.row_stamp);
  const stale=await api('ciw.parametros-ima','update',{record:{...old,val_param:'NAO_CONFIRMAR'}},409);assert.equal(stale.error.code,'CIW_PARAM_CHANGED');
  await api('ciw.parametros-ima','update',{record:{...row,codigo:marker+'-outra'}},422);
  await api('ciw.parametros-ima','update',{record:{...row,val_param:'x'.repeat(501)}},422);
  await api('ciw.parametros-ima','delete',{id:code,record:old},409);
  const current=unwrap(await api('ciw.parametros-ima','get',{id:code}));assert.equal(current.val_param,value+'-novo');proof.parametros=true;
  // A lista de empresas e somente referencia; nenhum cadastro anterior e alterado.
  const companies=(await api('ciw.empresas','read',{take:500})).data;assert.ok(companies.length>=2,'Duas empresas de referencia necessarias');
  for(const [suffix,tax]of [['Base',0],['Tax',1]]){
   const e=unwrap(await api('ciw.despesas','create',{record:{descricao:marker+'-'+suffix,ordem:0,log_calculada:false,perc_calculo:0,log_imposto:tax,ind_imposto:0,md_relacs_desp:[]}}));ownedExpenses.add(e.despesa_id);if(tax)taxId=e.despesa_id;else baseId=e.despesa_id;journal();
  }
  for(const company of companies.slice(0,2)){
   const row=unwrap(await api('ciw.empresas-despesa','create',{context:{despesa_id:baseId},record:{despesa_id:baseId,empresa_id:company.empresa_id,impostos:[taxId]}}));ownedLinks.add(row.empresa_despesa_id);journal();assert.deepEqual(row.impostos,[taxId]);
  }
  const [first,second]=[...ownedLinks];
  let changed=unwrap(await api('ciw.empresas-despesa','update',{context:{despesa_id:baseId},record:{empresa_despesa_id:first,impostos:[]}}));assert.deepEqual(changed.impostos,[]);
  const other=unwrap(await api('ciw.empresas-despesa','get',{context:{despesa_id:baseId},id:second}));assert.deepEqual(other.impostos,[taxId]);
  await api('ciw.empresas-despesa','update',{context:{despesa_id:baseId},record:{empresa_despesa_id:first,impostos:[taxId,2147483647]}},422);
  changed=unwrap(await api('ciw.empresas-despesa','get',{context:{despesa_id:baseId},id:first}));assert.deepEqual(changed.impostos,[]);proof.impostos=true;
  // Auditoria da propria sessao: valores de parametros nao podem aparecer no journal.
  const txs=(await api('admin.transacoes','read',{take:500,filters:[{field:'screen_id',operator:'eq',value:'ciw.parametros-ima'},{field:'session_id',operator:'eq',value:login.session.sessionId}]})).data;
  assert.ok(!JSON.stringify(txs).includes(value),'PARAMETER_VALUE_IN_TRANSACTION');let confirmed=0;
  for(const tx of txs){const events=(await api('admin.logs-transacoes','read',{take:100,filters:[{field:'transaction_id',operator:'eq',value:tx.id}]})).data;assert.ok(!JSON.stringify(events).includes(value),'PARAMETER_VALUE_IN_JOURNAL');
   for(const e of events){const m=typeof e.metadata==='string'?JSON.parse(e.metadata):e.metadata;if(/^im_param_progress\.api\.(create|update)$/.test(e.event_type)){assert.equal(m.audit.available,true);assert.equal(m.audit.recordId,code);assert.equal(m.actor.source,'authenticated-session');assert.equal(String(m.actor.userId),String(login.user.id));confirmed++;}}
  }
  assert.equal(confirmed,2);proof.parameterAudit=true;proof.noParameterValuesInJournal=true;
  for(const screen of ['ciw.coloracoes','ciw.situacoes-container','ciw.tipos-versao-custo','ciw.motivos-desconto'])await api(screen,'read',{take:1});proof.previousCadastrosRead=true;
 }finally{
  const cleanupErrors=[];
  if(paramOwned){try{const row=unwrap(await api('ciw.parametros-ima','get',{id:code}));await api('ciw.parametros-ima','delete',{id:code,record:row});paramOwned=false;}catch(e){cleanupErrors.push('parametro:'+e.message);}}
  for(const id of [...ownedLinks]){try{await api('ciw.empresas-despesa','delete',{id,context:{despesa_id:baseId}});ownedLinks.delete(id);}catch(e){cleanupErrors.push('vinculo:'+e.message);}}
  for(const id of [...ownedExpenses]){try{await api('ciw.despesas','delete',{id});ownedExpenses.delete(id);}catch(e){cleanupErrors.push('despesa:'+e.message);}}
  journal();proof.cleanup=!paramOwned&&ownedLinks.size===0&&ownedExpenses.size===0;fs.writeFileSync(path.join(state,'real-validation.json'),JSON.stringify(proof,null,2));
  await fetch(base+'/api/auth/logout',{method:'POST',headers,body:'{}'});assert.equal(cleanupErrors.length,0,cleanupErrors.join(';'));
 }
 assert.ok(proof.cleanup&&proof.parametros&&proof.impostos&&proof.parameterAudit);console.log('PASS: parametros CRUD/conflito/chave textual/auditoria sem valores; impostos chave tripla/isolamento/rollback; todos os registros CODEx removidos.');
})().catch(e=>{console.error(e.message);process.exitCode=1;});
