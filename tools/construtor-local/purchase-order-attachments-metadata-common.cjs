const c=require('./purchase-payments-builder-common.cjs');
const state=c.path.join(c.root,'.runtime/purchase-order-attachments-20261023'),meta=c.path.join(c.root,'integration-src/purchase-order-attachments/metadata');
const save=(name,value)=>{c.fs.mkdirSync(state,{recursive:true});c.fs.writeFileSync(c.path.join(state,name),JSON.stringify(value,null,2)+'\n');};
const draft=(parent=false)=>c.readJson(c.path.join(meta,(parent?'processos-compra-med':'proc-compra-documentos')+'-builder-draft.json'));
module.exports={...c,state,meta,save,draft};
