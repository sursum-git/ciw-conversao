'use strict';
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const state=path.resolve(__dirname,'../../.runtime/iol-gerencial');
(async()=>{
 const config=JSON.parse(fs.readFileSync(path.join(state,'connection.json'),'utf8'));
 const r=await fetch('http://127.0.0.1:19910/med/web/SursumPrograms/iol-inicial-gerencial',{method:'POST',headers:{'Content-Type':'application/json','X-Iol-Gerencial-Token':config.integrationToken,'X-Sursum-User':'tasilpar'},body:JSON.stringify({operation:'read',resource:'painel'})});
 const b=await r.json();assert.equal(r.status,200);assert.equal(b.success,true,'Recurso painel deve entregar os dois conjuntos: '+(b.error?.code||''));
 assert.equal(b.data.resumo.length,1);assert.ok(b.data.vendedores.length>0);
 assert.equal(typeof b.data.resumo[0].faturamento_liquido,'number');assert.equal(typeof b.data.vendedores[0].percentual_vendido,'number');
 const evidence={at:new Date().toISOString(),user:'tasilpar',instance:'sursum-api/med',resource:'painel',http:r.status,resumoRows:b.data.resumo.length,vendedoresRows:b.data.vendedores.length};
 fs.writeFileSync(path.join(state,'grouped-pasoe-verification.json'),JSON.stringify(evidence,null,2));console.log(JSON.stringify(evidence));
})().catch(e=>{console.error(e.message);process.exitCode=1;});
