'use strict';
const c=require('./purchase-payments-builder-common.cjs');
const dir=c.path.join(c.root,'.runtime/ciw-completion-20261028/expense-tax-current');
const safe=v=>Array.isArray(v)?v.map(safe):v&&typeof v==='object'?Object.fromEntries(Object.entries(v).map(([k,x])=>[k,k==='authHeaders'?[]:/^(password|secret|token)$/i.test(k)?'[omitted]':safe(x)])):v;
async function main(){
 c.assert.ok(!c.fs.existsSync(dir),'Inspect prior export before replay');
 await c.session(async({api})=>{
  const bootstrap=await api('/bootstrap');
  const matches=(bootstrap.programs??[]).filter(x=>x.screenId==='ciw.empresas-despesa');
  c.assert.equal(matches.length,1,'One existing expense-company program required');
  const code=matches[0].programCode??matches[0].code;c.assert.match(code,/^[a-z]{2}\d+$/);
  const program=await api('/programs/'+code);
  const entities=(bootstrap.entities??[]).filter(x=>/despesa|imposto/i.test(x.code??''));
  const sources=new Map();const detailEntities=[];
  for(const row of entities){
   c.assert.match(row.code,/^[a-z0-9_]+$/);
   const data=await api('/entities/'+row.code);detailEntities.push(data);
   const source=data.entity.apiSourceCode;
   if(typeof source==='string'&&/^motor_progress_[a-z_]+$/.test(source)&&!sources.has(source))sources.set(source,await api('/api-sources/'+source));
  }
  const catalog={programs:(bootstrap.programs??[]).map(p=>({code:p.programCode??p.code,screenId:p.screenId??null,name:p.name??null})),entities:(bootstrap.entities??[]).map(e=>({code:e.code,name:e.name??null}))};
  c.fs.mkdirSync(dir);
  for(const[name,data]of[['catalog-current.json',catalog],['expense-company-program.json',program],['expense-tax-entities.json',detailEntities],['sources-current.json',Array.from(sources.values())]])c.fs.writeFileSync(c.path.join(dir,name),JSON.stringify(safe(data),null,2)+'\n');
  c.fs.writeFileSync(c.path.join(dir,'sanitization.json'),JSON.stringify({success:true,allNestedAuthHeadersOmitted:true,programCode:code,screenId:'ciw.empresas-despesa',entities:entities.map(e=>e.code),catalogWrites:false,businessWrites:false,doNotReplaceActualAuthenticationFromSanitizedDto:true},null,2)+'\n');
  console.log('PASS current catalog and expense/tax metadata exported read-only; authentication omitted');
 },{readOnly:true});
}
main().catch(e=>{console.error(e.message);process.exitCode=1});
