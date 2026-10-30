const c=require('./purchase-payments-builder-common.cjs');
const state=c.path.join(c.root,'.runtime/purchase-attachments-20261022'),meta=c.path.join(c.root,'integration-src/purchase-attachments/metadata');
const save=(name,value)=>{c.fs.mkdirSync(state,{recursive:true});c.fs.writeFileSync(c.path.join(state,name),JSON.stringify(value,null,2)+'\n');};
const draft=(item=false)=>c.readJson(c.path.join(meta,(item?'proc-compra-itens':'proc-compra-anexos')+'-builder-draft.json'));
module.exports={...c,state,meta,save,draft};
