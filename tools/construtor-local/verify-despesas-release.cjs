'use strict';
// Somente leitura de negócio; registra a versão efetiva consultada pela API oficial.
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const state=path.resolve(__dirname,'../../.runtime/construtor-pg'),base='http://127.0.0.1:8765';
let headers={'Content-Type':'application/json'};
async function request(url,body){
 const r=await fetch(base+url,{method:body===undefined?'GET':'POST',headers,body:body===undefined?undefined:JSON.stringify(body)}),j=await r.json();
 assert.equal(r.status,200,j.error?.code||url);return j;
}
(async()=>{
 const password=fs.readFileSync(path.join(state,'acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const s=await request('/api/auth/login',{username:'admin',password,tenantId:'default',rememberMe:false});
 headers={...headers,Authorization:'Bearer '+s.token,'X-Runtime-Auth-Token':s.token,'X-Runtime-Tenant-Id':s.tenantId,'X-Runtime-User-Id':String(s.user.id),'X-Runtime-Session-Id':s.session.sessionId};
 try{
  const counts={};
  for(const [screen,expected] of [['ciw.empresas',3],['ciw.tipos-anexo',20],['ciw.despesas',51],['ciw.empresas-despesa',50]]){
   const result=await request('/api/runtime/screens/'+screen+'/endpoints/read',{take:500});assert.equal(result.total,expected,screen);counts[screen]=result.total;
  }
  const published=[];
  for(const [code,screen] of [['cd0092','ciw.despesas'],['cd0093','ciw.empresas-despesa']]){
   const p=await request('/api/admin/program-builder/programs/'+code),v=p.versions.find(x=>x.status==='published');
   assert.ok(v);assert.equal(v.version,'1.0.1');assert.equal(v.screenId,screen);
   published.push({programCode:code,screenId:screen,versionId:v.id,version:v.version});
  }
  const link=published.find(x=>x.programCode==='cd0093');assert.equal(link.versionId,7);
  fs.writeFileSync(path.join(state,'empresas-despesa-publicacao.json'),JSON.stringify({...link,verifiedBy:'official-getProgram',recoveredArchiveRecordId:5},null,2));
  fs.writeFileSync(path.join(state,'despesas-release-evidence.json'),JSON.stringify({at:new Date().toISOString(),counts,published},null,2));
  console.log('PASS: empresas3, tipos20, despesas51, vinculos50; cd0092/cd0093 versao1.0.1 integra pela API oficial.');
 }finally{await request('/api/auth/logout',{});}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
