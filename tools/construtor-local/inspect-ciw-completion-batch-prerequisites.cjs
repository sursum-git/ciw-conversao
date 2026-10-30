'use strict';
// Read-only prerequisites. This tool cannot prepare/write a fixture or grant access.
const c=require('./purchase-payments-builder-common.cjs');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build5-v6/batch-prerequisites');c.fs.mkdirSync(state,{recursive:true});
const save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');
async function main(){await c.session(async({runtime})=>{
 const master=await runtime('ciw.container-painel/endpoints/get',{id:332526,context:{container_id:332526}});const row=master.data??master;
 c.assert.equal(row.container_id,332526);c.assert.ok(String(row.cod_estabel).startsWith('5'));
 const all={};
 for(const screen of ['ciw.empresas','ciw.despesas','ciw.empresas-despesa']){
  const rows=[];let total;
  do{const page=await runtime(screen+'/endpoints/read',{take:100,skip:rows.length});c.assert.ok(Array.isArray(page.data));total=page.total;rows.push(...page.data);if(!page.data.length)break;}while(rows.length<total&&rows.length<10000);
  c.assert.equal(rows.length,total);all[screen]=rows;save(screen+'-rows-private.json',{data:rows,total});
 }
 const companies=all['ciw.empresas'].filter(x=>Number(x.cod_emp_ems2)===Number(String(row.cod_estabel).slice(0,1)));c.assert.equal(companies.length,1);const company=companies[0];
 const links=all['ciw.empresas-despesa'].filter(x=>x.empresa_id===company.empresa_id);const ids=new Set(links.map(x=>x.despesa_id));
 const defs=all['ciw.despesas'].filter(x=>ids.has(x.despesa_id));
 const cfg=c.readJson(c.path.join(c.root,'.runtime/construtor-pg/containers-connection.json'));
 const candidates=[];
 for(const cid of [2147000110]){
  const response=await fetch('http://127.0.0.1:19910/med/web/SursumPrograms/containers-painel',{method:'POST',headers:{'Content-Type':'application/json','X-Containers-Token':cfg.integrationToken,'X-Sursum-User':'admin'},body:JSON.stringify({resource:'painel',operation:'get',container_id:cid,id:cid}),signal:AbortSignal.timeout(45000)});
  c.assert.equal(response.status,200);const result=await response.json();c.assert.equal(result.success,false);c.assert.equal(result.error.status,404);candidates.push({containerId:cid,absent:true});
 }
 const header={cod_estabel:row.cod_estabel,cod_emit_forn:row.cod_emit_forn,situacao_container_id:row.situacao_container_id,ordem_busca_dolar_compra:'2',ordem_busca_dolar_di:'4',cod_tipo_proj_dolar:1,vl_dolar_compra:5,vl_dolar_di:5,vl_proj_dolar:0,vl_dolar_venda:5,log_gerar_saldo_a_pagar:false,log_gerar_distr_custo:false,log_liberar_custo_realizado:false};
 save('prerequisites-private.json',{success:true,company,header,candidateIds:candidates,definitions:defs,links,sourceContainerId:332526,sourceContainerUnchanged:true,proposedMarker:'SC_TEST_CONTAINER_DESP_LOTE_20261028',configRelationsStillPending:true,cleanupTriggerStillPending:true,authorized:false,businessWrites:false});
 console.log('PASS readonly MED company/header/definitions/links and candidate2147000110 absent; config/cleanup proof stillpending');
 },{readOnly:true});}
main().catch(e=>{console.error(e.message);process.exitCode=1});
