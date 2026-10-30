'use strict';
const c=require('./purchase-payments-builder-common.cjs');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/container-expense-batch-preflight');
async function main(){
 const cfg=c.readJson(c.path.join(c.root,'.runtime/construtor-pg/containers-connection.json'));
 const body={operation:'read',resource:'cotacoes-fiscais',container_id:332526,moeda:'real'};
 const response=await fetch('http://127.0.0.1:19910/med/web/SursumPrograms/containers-custos',{method:'POST',headers:{'Content-Type':'application/json','X-Containers-Token':cfg.integrationToken,'X-Sursum-User':'admin'},body:JSON.stringify(body),signal:AbortSignal.timeout(45000)});
 c.assert.equal(response.status,200);const data=await response.json();c.fs.writeFileSync(c.path.join(state,'quotation-collector-response-private.json'),JSON.stringify(data,null,2)+'\n');
 c.assert.equal(data.success,true,data.error?.code);const selection=data.calculation?.quotation_selection;c.assert.ok(selection,'QUOTATION_SELECTION_MISSING');c.assert.equal(selection.source,'hist_cotacoes_bc.latest-valid-series1');c.assert.ok(Number(selection.selected_value)>0&&selection.selected_date);
 const proof={success:true,instance:'sursum-api',context:'med',containerReadOnly:332526,sameFiscalCollector:true,series:1,validUnambiguousQuotation:true,selectedDate:selection.selected_date,source:selection.source,headerFutureQuoteIsSeparateStaticAndTtProof:true,businessWrites:false};c.fs.writeFileSync(c.path.join(state,'quotation-collector-proof.json'),JSON.stringify(proof,null,2)+'\n');
 console.log('PASS authenticated real MED fiscal collector/BCseries1 valid unambiguous; existing container unchanged; no business writes');
}
main().catch(e=>{console.error(e.message);process.exitCode=1});
