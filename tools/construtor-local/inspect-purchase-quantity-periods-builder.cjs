'use strict';
const c=require('./purchase-payments-builder-common.cjs'),state=c.path.join(c.root,'.runtime/purchase-quantity-periods-20261028');
c.session(async({api,runtime})=>{
 const bootstrap=await api('/bootstrap'),source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;
 c.assert.ok(!bootstrap.programs.some(p=>(p.programCode??p.code)==='op1030'||p.screenId==='ciw.quantidades-importadas-periodo-med'),'CANDIDATE_PROGRAM_COLLISION');
 c.assert.ok(!bootstrap.entities.some(e=>e.code==='proc_compra_quantidades_periodo_med_progress'),'CANDIDATE_ENTITY_COLLISION');
 c.assert.equal(source.operations.length,109);
 c.fs.writeFileSync(c.path.join(state,'source-registry-before.json'),JSON.stringify(source,null,2)+'\n');
 const parent=await runtime('ciw.processos-compra-med');c.assert.equal(parent.program.version,'1.0.8');
 c.fs.writeFileSync(c.path.join(state,'parent-before.json'),JSON.stringify(parent,null,2)+'\n');
 c.fs.writeFileSync(c.path.join(state,'builder-preflight.json'),JSON.stringify({success:true,candidateProgram:'op1030',candidateScreen:'ciw.quantidades-importadas-periodo-med',candidateEntity:'proc_compra_quantidades_periodo_med_progress',sourceOperations:109,parentVersion:'1.0.8',catalogWrites:false,businessWrites:false},null,2)+'\n');
 console.log('PASS native catalog preflight: op1030/free, entity/free,109source operations,parent1.0.8;no writes');
},{readOnly:true}).catch(e=>{console.error(e.message);process.exitCode=1;});
