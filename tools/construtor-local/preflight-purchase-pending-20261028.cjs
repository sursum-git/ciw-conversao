'use strict';
const c=require('./purchase-payments-builder-common.cjs');
const state=c.path.join(c.root,'.runtime/purchase-pending-integration-20261028');
c.fs.mkdirSync(state,{recursive:true});
const save=(n,v)=>{const p=c.path.join(state,n);c.assert.ok(!c.fs.existsSync(p),'Preflight already recorded: '+n);c.fs.writeFileSync(p,JSON.stringify(v,null,2)+'\n');};
c.session(async({api,runtime})=>{
 const bootstrap=await api('/bootstrap'),source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource,parent=await runtime('ciw.processos-compra-med');
 c.assert.equal(source.code,'motor_progress_ciw_cadastros');c.assert.equal(source.baseUrl,'http://127.0.0.1:19910/med/web');
 c.assert.equal(source.operations.length,111);c.assert.equal(parent.program.version,'1.0.8');c.assert.equal(parent.crud.form.tabs.length,11);
 const completed=await runtime('ciw.quantidades-importadas-periodo-med/endpoints/read',{take:1,skip:0});c.assert.ok(completed.total>0&&completed.data.length===1);
 save('source-before.json',source);save('parent-before.json',parent);
 const programs=(bootstrap.programs??[]).map(p=>({code:p.programCode??p.code,screenId:p.screenId??null}));const entities=(bootstrap.entities??[]).map(e=>({code:e.code,id:e.id}));
 save('catalog-before.json',{programs,entities});save('preflight.json',{success:true,sourceOperations:111,parentVersion:'1.0.8',parentTabs:11,newestQueryAvailable:true,observedTotal:completed.total,businessWrites:false,securityGrants:false});
 console.log('PASS infra/preflight: MED active;111 operations;parent1.0.8/11tabs;catalog snapshot saved');
},{readOnly:true}).catch(e=>{console.error(e.message);process.exitCode=1;});
