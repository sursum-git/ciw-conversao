'use strict';
// Existing published reader only. References stay in ignored private state.
const c=require('./purchase-payments-builder-common.cjs');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/container-attachments-download');
async function main(){
 const destination=c.path.join(state,'references-preflight-private.json');c.assert.ok(!c.fs.existsSync(destination),'Inspect prior receipt before replay');
 await c.session(async({runtime})=>{
  const r=await runtime('ciw.container-anexos/endpoints/read',{context:{container_id:332526},skip:0,take:20});
  c.assert.ok(Array.isArray(r.data)&&Number.isInteger(r.total));
  const references=[];
  for(const row of r.data){
   c.assert.equal(row.container_id,332526);
   const reference=row.caminho_arquivo;
   if(typeof reference==='string'&&reference.trim()!==''&&!references.some(x=>x.reference===reference)){
    c.assert.ok(reference.length<=255&&!/[\\/\x00-\x1f]/.test(reference)&&!['.','..'].includes(reference));
    references.push({id:row.anexo_container_id,container_id:332526,reference});if(references.length===5)break;
   }
  }
  c.fs.writeFileSync(destination,JSON.stringify({success:true,readOnly:true,observedRows:r.data.length,total:r.total,references},null,2)+'\n');
  console.log('PASS existing attachment reader; private basename references='+references.length+'; no download or business write');
 },{readOnly:true});
}
main().catch(e=>{console.error(e.message);process.exitCode=1});
