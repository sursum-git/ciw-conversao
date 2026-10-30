'use strict';
const c=require('./purchase-payments-builder-common.cjs');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/lookup-metadata');c.fs.mkdirSync(state,{recursive:true});
function sanitize(value){if(!value||typeof value!=='object')return value;if(Array.isArray(value))return value.map(sanitize);return Object.fromEntries(Object.entries(value).map(([key,item])=>[key,key==='authHeaders'?[]:sanitize(item)]));}
async function main(){await c.session(async({api})=>{
 for(const [program,entity]of [['op1035','container_versoes_historico_med_progress'],['op1037','container_versao_nfs_historico_med_progress'],['op1039','container_versao_despesas_historico_med_progress']]){
  for(const [kind,url]of [['program','/programs/'+program],['entity','/entities/'+entity]]){
   const value=sanitize(await api(url));c.fs.writeFileSync(c.path.join(state,program+'-'+kind+'.json'),JSON.stringify(value,null,2)+'\n');
  }
 }
 c.fs.writeFileSync(c.path.join(state,'sanitization.json'),JSON.stringify({success:true,authHeaders:'All nested authHeaders replaced with empty arrays before serialization; compare API baselines using same sanitizer; do not overwrite source authentication'},null,2)+'\n');
 console.log('PASS readonly exported current3program/3entity lookup baselines; all nested authHeaders sanitized');
 },{readOnly:true});}
main().catch(e=>{console.error(e.message);process.exitCode=1});
