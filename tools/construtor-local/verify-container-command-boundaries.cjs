'use strict';
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const root=path.resolve(__dirname,'../..');
const token=JSON.parse(fs.readFileSync(path.join(root,'.runtime/construtor-pg/containers-connection.json'),'utf8').replace(/^\uFEFF/,'')).integrationToken;
const evidence={at:new Date().toISOString(),businessWrites:false,checks:[]};
async function call(route,body,auth=true,identity=true){
 const r=await fetch('http://127.0.0.1:19910/med/web/SursumPrograms/'+route,{method:'POST',headers:{'Content-Type':'application/json',...(auth?{'X-Containers-Token':token}:{}),...(identity?{'X-Sursum-User':'admin'}:{})},body:JSON.stringify(body),signal:AbortSignal.timeout(30000)});return r.json();
}
(async()=>{
 for(const route of ['containers-cabecalho','containers-despesas','containers-processos']){
  for(const [auth,identity,status] of [[false,true,401],[true,false,401],[true,true,422]]){
   const j=await call(route,{},auth,identity);assert.equal(j.success,false,JSON.stringify(j));assert.equal(j.error.status,status,JSON.stringify(j));evidence.checks.push(route+' auth='+auth+' identity='+identity+' denied '+status);
  }
 }
 for(const [route,body] of [
  ['containers-cabecalho',{resource:'containers',operation:'get',container_id:2147000099,id:2147000099}],
  ['containers-processos',{resource:'versoes',operation:'gerar',container_id:2147000099,tipo_versao_id:1,descricao:'unreachable',expected_latest_version_id:0}],
  ['containers-processos',{resource:'custos',operation:'fechar',container_id:2147000099,versao_id:1,expected_latest_version_id:1,log_priorizar_custo_previsto:true}],
  ['containers-processos',{resource:'impostos',operation:'sincronizar',container_id:2147000099}],
 ]){
  const j=await call(route,body);assert.equal(j.success,false,JSON.stringify(j));assert.equal(j.error.status,404,JSON.stringify(j));evidence.checks.push(route+' nonexistent parent rejected before writes');
 }
 fs.writeFileSync(path.join(root,'.runtime/container-commands-20261016/pasoe-boundaries.json'),JSON.stringify(evidence,null,2)+'\n');console.log('PASS: '+evidence.checks.length+' real PASOE boundary checks; no business writes.');
})().catch(e=>{console.error(e.message);process.exitCode=1;});
