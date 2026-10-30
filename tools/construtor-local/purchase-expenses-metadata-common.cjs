const c=require('./purchase-payments-builder-common.cjs');
const state=c.path.join(c.root,'.runtime/purchase-expenses-20261023'),meta=c.path.join(c.root,'integration-src/purchase-expenses/metadata');
const save=(n,v)=>{c.fs.mkdirSync(state,{recursive:true});c.fs.writeFileSync(c.path.join(state,n),JSON.stringify(v,null,2)+'\n');};
const draft=slug=>c.readJson(c.path.join(meta,slug+'-builder-draft.json'));
module.exports={...c,state,meta,save,draft};
