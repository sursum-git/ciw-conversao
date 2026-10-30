'use strict';
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const state=path.resolve(__dirname,'../../.runtime/iol-gerencial');
(async()=>{
 const config=JSON.parse(fs.readFileSync(path.join(state,'connection.json'),'utf8'));
 const url='http://127.0.0.1:19910/med/web/SursumPrograms/iol-inicial-gerencial';
 const token=config.integrationToken,valid={'Content-Type':'application/json','X-Iol-Gerencial-Token':token,'X-Sursum-User':'tasilpar'};
 const tests=[
  ['token-ausente',{'Content-Type':'application/json'},{operation:'read',resource:'resumo'},401],
  ['token-incorreto',{...valid,'X-Iol-Gerencial-Token':'0'.repeat(64)},{operation:'read',resource:'resumo'},401],
  ['identidade-ausente',{'Content-Type':'application/json','X-Iol-Gerencial-Token':token},{operation:'read',resource:'resumo'},403],
  ['operacao-bloqueada',valid,{operation:'update',resource:'resumo'},405],
  ['identidade-no-corpo',valid,{operation:'read',resource:'resumo',login:'other'},422],
  ['recurso-invalido',valid,{operation:'read',resource:'other'},422],
 ];
 const evidence=[];
 for(const [name,headers,body,expected] of tests){const r=await fetch(url,{method:'POST',headers,body:JSON.stringify(body)}),b=await r.json();assert.equal(b.success,false);assert.equal(b.error.status,expected,name);evidence.push({name,status:b.error.status});console.log('PASS '+name+' '+expected);}
 fs.writeFileSync(path.join(state,'boundary-verification.json'),JSON.stringify({at:new Date().toISOString(),instance:'sursum-api/med',tests:evidence},null,2));
})().catch(e=>{console.error(e.message);process.exitCode=1;});
