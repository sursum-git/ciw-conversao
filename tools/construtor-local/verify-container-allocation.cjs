'use strict';
const c=require('./purchase-payments-builder-common.cjs');
const state=c.path.join(c.root,'.runtime/container-allocation-batch-20261026');
async function main(){
  const mode=process.argv[2]??'pasoe';c.assert.ok(['pasoe','published'].includes(mode));
  if(mode==='published'){
    await c.session(async({runtime})=>{
      const screen=await runtime('ciw.container-alocar-itens');
      c.assert.equal(screen.program.version,'1.0.0');c.assert.equal(screen.logs.enabled,true);
      c.assert.equal(screen.logs.screenId,'ciw.container-painel');
      const options=await runtime('ciw.container-alocar-itens/endpoints/options.item_ids',{context:{container_id:332526}});
      c.assert.ok(Array.isArray(options.data));c.assert.ok(options.data.every(x=>Number.isInteger(x.value)&&typeof x.text==='string'));
      const parent=await runtime('ciw.container-painel');c.assert.equal(parent.crud.form.tabs.length,15);
      c.fs.writeFileSync(c.path.join(state,'native-read-proof.json'),JSON.stringify({success:true,screenId:'ciw.container-alocar-itens',options:options.data.length,logs:true,parentTabs:15,runNotCalled:true,businessWrites:false},null,2));
      console.log('PASS published native definition/options/Logs/parent15 tabs; run not called');
    },{readOnly:true});return;
  }
  let token=c.readJson(c.path.join(c.root,'.runtime/construtor-pg/containers-connection.json')).integrationToken;
  const post=async body=>{
    const invalidBatch=body.operation==='allocate'&&['[]','[0]','[11,11]','[1.5]'].includes(JSON.stringify(body.item_ids));
    c.assert.ok(body.operation==='read'||invalidBatch,'READ_OR_INVALID_ONLY');
    const response=await fetch('http://127.0.0.1:19910/med/web/SursumPrograms/containers-itens',{method:'POST',headers:{'Content-Type':'application/json','X-Containers-Token':token,'X-Sursum-User':'admin'},body:JSON.stringify(body),signal:AbortSignal.timeout(120000)});
    return {status:response.status,body:await response.json()};
  };
  const options=await post({resource:'itens-alocacao-disponiveis',operation:'read',container_id:332526});
  c.assert.equal(options.body.success,true,'NEW_OPTIONS_ROUTE');c.assert.ok(Array.isArray(options.body.data));
  c.assert.equal(new Set(options.body.data.map(x=>x.item_proc_compra_id)).size,options.body.data.length);
  const checks=[];
  for(const ids of [[],[0],[11,11],[1.5]]){
    const result=await post({resource:'container-alocacoes',operation:'allocate',container_id:332526,item_ids:ids});
    c.assert.equal(result.body.success,false);c.assert.equal(result.body.committed,false);
    c.assert.equal(result.body.error.code,'CONTAINER_ALLOCATION_VALIDATION');c.assert.ok(!result.body.audit);
    checks.push({ids,status:result.status,code:result.body.error.code,committed:false});
  }
  token=undefined;
  c.fs.writeFileSync(c.path.join(state,'pasoe-read-proof.json'),JSON.stringify({success:true,instance:'sursum-api',context:'med',officialPort:9911,tunnel:'19910 -> 9910 same instance',options:options.body.data.length,newCompiledDispatch:true,negativeChecks:checks,businessWrites:false},null,2));
  console.log('PASS real PASOE new options and4 invalid batches; no valid business command');
}
if(require.main===module)main().catch(e=>{console.error(e.message);process.exitCode=1;});
