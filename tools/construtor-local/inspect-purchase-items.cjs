// Somente catálogo/metadados; sessão própria sem gravação de negócio.
const c=require('./purchase-payments-builder-common.cjs');
const state=c.path.join(c.root,'.runtime/purchase-items-20261022');
const save=(name,v)=>{c.fs.mkdirSync(state,{recursive:true});c.fs.writeFileSync(c.path.join(state,name),JSON.stringify(v,null,2)+'\n');};
c.session(async({api,runtime})=>{
 const bootstrap=await api('/bootstrap'),source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;
 const parent=await runtime('ciw.processos-compra-med'),payments=await runtime('ciw.proc-compra-pagamentos');
 const occupied=new Set((bootstrap.programs??[]).map(x=>x.programCode??x.code));
 save('catalog-snapshot.json',{bootstrap,source,parent,payments});
 const result={success:true,businessWrites:false,catalogWrites:false,sourceOperations:source.operations.length,op1014Available:!occupied.has('op1014'),parentScreen:parent.screenId??parent.definition?.screenId,existingChild:(bootstrap.programs??[]).filter(x=>x.screenId==='ciw.proc-compra-itens').map(x=>({code:x.programCode??x.code,screenId:x.screenId}))};
 save('preflight.json',result);console.log(JSON.stringify(result));
}).catch(e=>{console.error(e.message);process.exitCode=1;});
