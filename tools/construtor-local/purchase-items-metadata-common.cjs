const c=require('./purchase-payments-builder-common.cjs');
const state=c.path.join(c.root,'.runtime/purchase-items-20261022'),meta=c.path.join(c.root,'integration-src/purchase-items/metadata');
const save=(name,v)=>{c.fs.mkdirSync(state,{recursive:true});c.fs.writeFileSync(c.path.join(state,name),JSON.stringify(v,null,2)+'\n');};
const draft=(parent=false)=>c.readJson(c.path.join(meta,(parent?'processos-compra-med':'proc-compra-itens')+'-builder-draft.json'));
module.exports={...c,state,meta,save,draft};
