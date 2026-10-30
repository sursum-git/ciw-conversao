'use strict';
const c=require('./purchase-payments-builder-common.cjs');
const state=c.path.join(c.root,'.runtime/purchase-signals-20261027'),save=(n,v)=>c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n',{flag:'wx'});
c.session(async({api,runtime})=>{
 const bootstrap=await api('/bootstrap'),parent=await runtime('ciw.processos-compra-med'),source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;
 const occupied=new Set(bootstrap.programs.map(x=>x.programCode??x.code));const code=Array.from({length:60},(_,i)=>'op'+(1027+i)).find(x=>!occupied.has(x));c.assert.ok(code);c.assert.ok(!bootstrap.entities.some(x=>x.code==='proc_compra_alertas_progress'));c.assert.ok(!bootstrap.programs.some(x=>x.screenId==='ciw.proc-compra-alertas'));
 c.assert.equal(parent.program.version,'1.0.6');c.assert.equal(parent.crud.form.tabs.length,9);c.assert.equal(source.code,'motor_progress_ciw_cadastros');c.assert.equal(source.operations.length,103);
 save('preflight.json',{success:true,programCode:code,sourceOperations:source.operations.length,parent,catalogWrites:false,businessWrites:false});save('source-registry-before.json',source);console.log('PASS readonly native preflight; '+code+' free; parent1.0.6/9tabs; source103');
},{readOnly:true}).catch(e=>{console.error(e.message);process.exitCode=1;});
