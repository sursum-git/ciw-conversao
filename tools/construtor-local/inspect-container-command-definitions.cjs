'use strict';
const fs=require('node:fs'),path=require('node:path');
const state=path.resolve(__dirname,'../../.runtime/construtor-pg');
const base='http://127.0.0.1:8765';
(async()=>{
 const password=fs.readFileSync(path.join(state,'acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const login=await fetch(base+'/api/auth/login',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({username:'admin',password,tenantId:'default',rememberMe:false})}).then(r=>r.json());
 if(!login.authenticated)throw new Error('Login local não concluído');
 const headers={Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 try {
  for(const screen of ['ciw.container-gerar-versao','ciw.container-fechar-custos','ciw.container-sincronizar-impostos']){
   const response=await fetch(base+'/api/runtime/screens/'+screen,{headers}); const definition=await response.json();
   fs.writeFileSync(path.join(state,'definition-'+screen+'.json'),JSON.stringify(definition,null,2));
   console.log(JSON.stringify({screen,status:response.status,process:definition.process,contextFields:definition.contextFields},null,2));
  } } finally {await fetch(base+'/api/auth/logout',{method:'POST',headers});}
})().catch(e=>{console.error(e.message);process.exitCode=1;});

