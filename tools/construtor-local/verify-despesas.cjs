'use strict';
// Somente cria/edita/exclui dados novos com marcador exclusivo deste teste.
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const state=path.resolve(__dirname,'../../.runtime/construtor-pg'),base='http://127.0.0.1:8765';
const marker='CODEx-DESP-'+Date.now()+'-',owned=new Set();
let headers={'Content-Type':'application/json'},before,companyId;
const unwrap=x=>x.data&&!Array.isArray(x.data)?x.data:x;
async function request(url,body,status=200){
 const r=await fetch(base+url,{method:body===undefined?'GET':'POST',headers,body:body===undefined?undefined:JSON.stringify(body)}),j=await r.json();
 assert.equal(r.status,status,(j.error?.code||url)+' '+(j.error?.message||''));return j;
}
const endpoint=(kind,op,body,status)=>request('/api/runtime/screens/ciw.'+kind+'/endpoints/'+op,body,status);
async function all(kind){
 const rows=[];let result;
 do{result=await endpoint(kind,'read',{take:500,skip:rows.length});rows.push(...result.data);}while(rows.length<result.total&&result.data.length);
 return rows;
}
const create=async record=>{
 const row=unwrap(await endpoint('despesas','create',{record}));owned.add(row.despesa_id);
 fs.writeFileSync(path.join(state,'despesas-test-ownership.json'),JSON.stringify({marker,ids:[...owned],cleanup:false},null,2));return row;
};
(async()=>{
 const pw=fs.readFileSync(path.join(state,'acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const login=await request('/api/auth/login',{username:'admin',password:pw,tenantId:'default',rememberMe:false});
 headers={...headers,Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,
  'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId,'X-Sursum-User':'forged-test-user'};
 try{
  const d=await request('/api/runtime/screens/ciw.despesas'),v=await request('/api/runtime/screens/ciw.empresas-despesa');
  const token=JSON.parse(fs.readFileSync(path.join(state,'despesas-connection.json'),'utf8').replace(/^\uFEFF/,'')).integrationToken;
  assert.ok(!JSON.stringify([d,v]).includes(token));
  assert.equal(d.crud.grid.rowLinks[0].screenId,'ciw.empresas-despesa');
  assert.equal(d.dataModel.fields.md_relacs_desp.type,'array');assert.equal(d.dataModel.fields.perc_calculo.decimals,2);
  assert.equal(v.dataModel.fields.percentual.decimals,2);assert.equal(v.dataModel.fields.impostos.type,'array');assert.equal(v.dataModel.fields.percentual_custo.decimals,4);
  before=await all('despesas');
  const companies=await endpoint('empresas-despesa','options.empresa_id',{});
  assert.ok(companies.data.length,'Empresa preexistente para referenciar sem alterar seu cadastro');companyId=companies.data[0].value;
  assert.ok(Number.isInteger(companyId));
  const baseRow=await create({descricao:marker+'Base ação',log_imposto:0,md_relacs_desp:[]});
  const tax=await create({descricao:marker+'Imposto',log_imposto:1,ind_imposto:1,md_relacs_desp:[]});
  const calc=await create({descricao:marker+'Calculada',log_imposto:0,log_calculada:true,perc_calculo:12.34,md_relacs_desp:[baseRow.despesa_id,tax.despesa_id]});
  assert.equal(calc.perc_calculo,12.34);assert.deepEqual(calc.md_relacs_desp.slice().sort((a,b)=>a-b),[baseRow.despesa_id,tax.despesa_id].sort((a,b)=>a-b));
  await endpoint('despesas','update',{record:{despesa_id:calc.despesa_id,perc_calculo:12.3456}},422);
  assert.equal(unwrap(await endpoint('despesas','get',{id:calc.despesa_id})).perc_calculo,12.34);
  let row=unwrap(await endpoint('despesas','update',{record:{despesa_id:calc.despesa_id,md_relacs_desp:[baseRow.despesa_id]}}));
  assert.deepEqual(row.md_relacs_desp,[baseRow.despesa_id]);
  await endpoint('despesas','delete',{id:baseRow.despesa_id},409);
  await endpoint('despesas','update',{record:{despesa_id:calc.despesa_id,descricao:marker+'NAO PERSISTIR',md_relacs_desp:[2147483647]}},422);
  row=unwrap(await endpoint('despesas','get',{id:calc.despesa_id}));assert.equal(row.descricao,marker+'Calculada');assert.deepEqual(row.md_relacs_desp,[baseRow.despesa_id]);
  row=unwrap(await endpoint('despesas','update',{record:{despesa_id:calc.despesa_id,md_relacs_desp:[]}}));assert.deepEqual(row.md_relacs_desp,[]);
  await endpoint('despesas','update',{record:{despesa_id:calc.despesa_id,md_relacs_desp:[calc.despesa_id]}},422);
  await endpoint('despesas','update',{record:{despesa_id:calc.despesa_id,md_relacs_desp:[baseRow.despesa_id,baseRow.despesa_id]}},422);
  const linkage={despesa_id:calc.despesa_id,empresa_id:companyId,codigo_desp_erp:10,log_ativo:1,vl_padrao:12.34,percentual:0,cod_nat_operacao:'',log_custo:1,percentual_custo:0,despesa_custo_id:0,impostos:[tax.despesa_id]};
  let link=unwrap(await endpoint('empresas-despesa','create',{record:linkage}));
  assert.equal(link.vl_padrao,12.34);assert.equal(link.eh_imposto,false);assert.deepEqual(link.impostos,[tax.despesa_id]);assert.ok(link.empresa_nome);
  await endpoint('empresas-despesa','create',{record:linkage},409);
  await endpoint('despesas','delete',{id:calc.despesa_id},409);
  await endpoint('despesas','delete',{id:tax.despesa_id},409);
  await endpoint('empresas-despesa','update',{record:{empresa_despesa_id:link.empresa_despesa_id,despesa_id:baseRow.despesa_id}},422);
  await endpoint('empresas-despesa','update',{record:{empresa_despesa_id:link.empresa_despesa_id,cod_nat_operacao:'x'.repeat(13),impostos:[]}},422);
  link=unwrap(await endpoint('empresas-despesa','get',{id:link.empresa_despesa_id}));assert.deepEqual(link.impostos,[tax.despesa_id]);
  link=unwrap(await endpoint('empresas-despesa','update',{record:{empresa_despesa_id:link.empresa_despesa_id,vl_padrao:21.43,impostos:[]}}));
  assert.deepEqual(link.impostos,[]);assert.equal(link.vl_padrao,21.43);
  const taxLink=unwrap(await endpoint('empresas-despesa','create',{record:{...linkage,despesa_id:tax.despesa_id,vl_padrao:0,percentual:5.12,percentual_custo:1.2345,despesa_custo_id:baseRow.despesa_id,impostos:[]}}));
  assert.equal(taxLink.eh_imposto,true);assert.equal(taxLink.percentual,5.12);assert.equal(taxLink.percentual_custo,1.2345);
  await endpoint('empresas-despesa','update',{record:{empresa_despesa_id:taxLink.empresa_despesa_id,percentual:5.1234}},422);
  assert.equal(unwrap(await endpoint('empresas-despesa','get',{id:taxLink.empresa_despesa_id})).percentual,5.12);
  await endpoint('empresas-despesa','update',{record:{empresa_despesa_id:taxLink.empresa_despesa_id,despesa_custo_id:0,percentual_custo:1.2345}},422);
  const reread=unwrap(await endpoint('empresas-despesa','get',{id:taxLink.empresa_despesa_id}));assert.equal(reread.despesa_custo_id,baseRow.despesa_id);assert.equal(reread.percentual_custo,1.2345);
  fs.writeFileSync(path.join(state,'despesas-http-evidence.json'),JSON.stringify({at:new Date().toISOString(),originalCount:before.length,
   headerSecretPrivate:true,metadataLinksCollections:true,expenseCrudRelations:true,arrayClear:true,missingReferenceRollback:true,
   duplicateLinkBlocked:true,immutableParent:true,taxRelationSync:true,costValidation:true,decimalStoragePrecision:true,dependencyDeletesBlocked:true},null,2));
  console.log('PASS: despesas/vinculos CRUD, colecoes, dependencias, rollback, unique, contexto imutavel e precisao decimal do dicionario.');
 }finally{
  try{
   // Descobrir apenas IDs que possuem o marcador desta execução cobre resposta perdida.
   for(const x of await all('despesas'))if(x.descricao?.startsWith(marker))owned.add(x.despesa_id);
   for(const link of await all('empresas-despesa'))if(owned.has(link.despesa_id))await endpoint('empresas-despesa','delete',{id:link.empresa_despesa_id});
   for(const id of owned)await endpoint('despesas','update',{record:{despesa_id:id,md_relacs_desp:[]}});
   for(const id of owned)await endpoint('despesas','delete',{id});
   const after=await all('despesas');assert.ok(!after.some(x=>x.descricao?.startsWith(marker)));
   if(before)assert.deepEqual(after.slice().sort((a,b)=>a.despesa_id-b.despesa_id),before.slice().sort((a,b)=>a.despesa_id-b.despesa_id));
   console.log('PASS: dados proprios removidos; despesas originais preservadas.');
   fs.writeFileSync(path.join(state,'despesas-test-ownership.json'),JSON.stringify({marker,ids:[...owned],cleanup:true},null,2));
  }finally{await request('/api/auth/logout',{});}
 }
})().catch(e=>{console.error(e.message);process.exitCode=1;});



