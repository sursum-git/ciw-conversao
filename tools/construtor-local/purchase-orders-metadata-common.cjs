// Reutiliza autenticação/HTTP e normalização de operações já existentes.
const shared=require('./purchase-payments-builder-common.cjs');
const state=shared.path.join(shared.root,'.runtime/purchase-orders-20261022'),meta=shared.path.join(shared.root,'integration-src/purchase-orders/metadata');
const save=(name,value)=>{shared.fs.mkdirSync(state,{recursive:true});shared.fs.writeFileSync(shared.path.join(state,name),JSON.stringify(value,null,2)+'\n');};
const draft=()=>shared.readJson(shared.path.join(meta,'processos-compra-med-builder-draft.json'));
async function inspect(api,runtime){
 const d=draft(),bootstrap=await api('/bootstrap'),source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource,home=await runtime('home');
 shared.assert.equal(source.responseContract,'sursum-programs');shared.assert.equal(source.baseUrl,'http://127.0.0.1:19910/med/web');
 const existingProgram=(bootstrap.programs??[]).filter(x=>(x.programCode??x.code)===d.programDraft.programCode),existingEntity=(bootstrap.entities??[]).filter(x=>x.code===d.entityDraft.code),operations=shared.readJson(shared.path.join(meta,'api-source-additions.json')).operations;
 const operationState=operations.map(op=>{const found=source.operations.filter(x=>x.code===op.code);return {code:op.code,matches:found.length,compatible:found.length===0||found.length===1&&shared.compatibleOperation(found[0],op,source.baseUrl)};});
 const navigation=shared.readJson(shared.path.join(meta,'navigation-proposal.json'));
 const receipt={success:true,at:new Date().toISOString(),catalogWrites:false,businessWrites:false,programCode:d.programDraft.programCode,programMatches:existingProgram.map(x=>({code:x.programCode??x.code,screenId:x.screenId})),entityMatches:existingEntity.map(x=>({code:x.code,id:x.id})),sourceCode:source.code,sourceOperationCount:source.operations.length,operations:operationState,homeGroups:(home.navigation?.groups??[]).filter(x=>x.moduleId==='ciw').map(x=>({id:x.id,title:x.title})),homeExistingLinks:home.programs.filter(x=>x.screenId===d.programDraft.screenId).length,financialQueryLinks:home.programs.filter(x=>x.screenId==='ciw.processos-compra-financeiro-med').length,paymentsPublished:(bootstrap.programs??[]).some(x=>x.screenId==='ciw.proc-compra-pagamentos'),proposedHomeGroupExists:(home.navigation?.groups??[]).some(x=>x.id===navigation.homeGroupId)};
 receipt.collisions=existingProgram.length+existingEntity.length;receipt.operationConflicts=operationState.filter(x=>!x.compatible).map(x=>x.code);save('metadata-preflight.json',receipt);return {receipt,source,home,bootstrap};
}
module.exports={...shared,state,meta,save,draft,inspect};
