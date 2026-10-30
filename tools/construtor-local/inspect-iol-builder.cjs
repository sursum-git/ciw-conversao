'use strict';
const fs=require('node:fs'),path=require('node:path');
const root=path.resolve(__dirname,'../..'),base='http://127.0.0.1:8765';
(async()=>{
 const password=fs.readFileSync(path.join(root,'.runtime/construtor-pg/acesso-local.txt'),'utf8').split(/\r?\n/).find(l=>l.startsWith('Senha inicial=')).slice(14);
 const login=await fetch(base+'/api/auth/login',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({username:'admin',password,tenantId:'default',rememberMe:false})}).then(r=>r.json());
 if(!login.authenticated)throw Error('Login administrativo indisponivel');
 const headers={Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 try{
  const response=await fetch(base+'/api/admin/program-builder/bootstrap',{headers});if(!response.ok)throw Error('Bootstrap '+response.status);
  const b=await response.json();const used=new Set(b.programs.map(p=>p.programCode||p.code));
  let next=1000;while(used.has('op'+next))next++;
  const selection={programCode:'op'+next,number:next,module:'operacional',existing:b.programs.some(p=>p.screenId==='iol.inicial-gerencial')};
  fs.writeFileSync(path.join(root,'.runtime/iol-gerencial/program-selection.json'),JSON.stringify(selection,null,2));
  console.log(JSON.stringify(selection));
 }finally{await fetch(base+'/api/auth/logout',{method:'POST',headers});}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
