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
  const response=await fetch(base+'/api/admin/program-builder/bootstrap',{headers});
  if(!response.ok)throw new Error('Bootstrap HTTP '+response.status);
  const b=await response.json();
  console.log(JSON.stringify({modules:b.modules,structureModules:b.structureModules,programs:b.programs.map(p=>({id:p.id,code:p.programCode||p.code,title:p.programTitle||p.title,screenId:p.screenId}))},null,2));
 } finally {await fetch(base+'/api/auth/logout',{method:'POST',headers});}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
