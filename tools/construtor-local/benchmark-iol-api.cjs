'use strict';
// Read-only authenticated timings; no response values or credentials in the evidence.
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const {performance}=require('node:perf_hooks');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/iol-gerencial'),base='http://127.0.0.1:8765';
function summarize(values){const sorted=values.slice().sort((a,b)=>a-b),n=sorted.length;return {n,medianMs:n%2?sorted[(n-1)/2]:(sorted[n/2-1]+sorted[n/2])/2,p95Ms:sorted[Math.ceil(n*.95)-1],meanMs:sorted.reduce((a,b)=>a+b,0)/n,minMs:sorted[0],maxMs:sorted[n-1]};}
(async()=>{
 if(process.argv.includes('--pasoe-only')){
  const grouped=process.argv.includes('--grouped');
  const config=JSON.parse(fs.readFileSync(path.join(state,'connection.json'),'utf8'));
  const url='http://127.0.0.1:19910/med/web/SursumPrograms/iol-inicial-gerencial';
  const engineHeaders={'Content-Type':'application/json','X-Iol-Gerencial-Token':config.integrationToken,'X-Sursum-User':'tasilpar'};
  const samples=[];
  for(let i=0;i<14;i++){
   const row={round:i+1,warmup:i<2};const start=performance.now();
   for(const resource of (grouped?['painel']:['resumo','vendedores'])){
    const t=performance.now(),r=await fetch(url,{method:'POST',headers:engineHeaders,body:JSON.stringify({operation:'read',resource})}),b=await r.json();
    assert.equal(r.status,200);assert.equal(b.success,true);
    if(grouped){assert.equal(b.data.resumo.length,1);assert.ok(b.data.vendedores.length>0);}else assert.ok(b.data.length>0);
    row[resource+'Ms']=performance.now()-t;row[resource+'Rows']=grouped?{resumo:b.data.resumo.length,vendedores:b.data.vendedores.length}:b.data.length;
   }
   row.totalMs=performance.now()-start;samples.push(row);console.log('PASOE rodada '+(i+1)+(i<2?' aquecimento':'')+': '+row.totalMs.toFixed(1)+' ms');
  }
  const summary={};for(const field of (grouped?['painelMs','totalMs']:['resumoMs','vendedoresMs','totalMs']))summary[field]=summarize(samples.filter(x=>!x.warmup).map(x=>x[field]));
  fs.writeFileSync(path.join(state,grouped?'benchmark-pasoe-grouped-20261017.json':'benchmark-pasoe-20261017.json'),JSON.stringify({at:new Date().toISOString(),user:'tasilpar',identity:'cabecalho do gateway autorizado por token da integracao; resolucao real user-web, sem login de navegador',method:grouped?'Somente motor PASOE:2aquecimentos e12chamadas unificadas. Exclui PHPgateway, autenticacao, assets e render.':'Somente motor PASOE: 2aquecimentos e12pares sequenciais; exclui PHPgateway, autenticacao, assets e render. Nao representa tempo completo da tela.',topology:'Node local -> tunelSSH19910 -> PASOE sursum-api/med -> Progress',summary,samples},null,2));
  console.log(JSON.stringify(summary));return;
 }
 throw Error('Use --pasoe-only [--grouped]. A comparacao completa usa a sessao real do navegador.');
})().catch(e=>{console.error(e.message);process.exitCode=1;});
