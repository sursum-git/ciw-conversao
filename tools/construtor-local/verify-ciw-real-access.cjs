/* Consulta apenas decisoes de autorizacao. Nao executa CRUD de negocio. */
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/ciw-auth-20261017');
const session=JSON.parse(fs.readFileSync(path.join(state,'verified-real-session.json'),'utf8'));
const cfg=JSON.parse(fs.readFileSync(path.join(root,'.runtime/ciw-access-20261016/connection.json'),'utf8'));
assert.equal(session.username,'tasilpar');assert.equal(session.provider,'ima-user-web');assert.equal(session.realBrowserSessionVerified,true);
assert.equal(session.status,'active');assert.ok(Date.now()-Date.parse(session.verifiedAt)<60000,'revalidate actual server session immediately before this diagnostic');
(async()=>{
 const cases=[];
 for(const action of ['read','get','create','update','delete','export','print']){
  const r=await fetch(cfg.baseUrl+'/SursumPrograms/ciw-access',{method:'POST',headers:{'Content-Type':'application/json','X-CiwAccess-Token':cfg.token,'X-Sursum-User':session.username,'X-Session-Id':session.sessionId,'X-Sursum-Auth-Source':session.provider},body:JSON.stringify({operation:'authorize',resource:'cadastros.coloracoes',action}),signal:AbortSignal.timeout(20000)});
  const d=await r.json();assert.equal(r.status,200);
  if(d.success){assert.equal(d.data?.[0]?.login.toLowerCase(),'tasilpar');assert.equal(d.data[0].allowed,true);assert.equal(d.data[0].action,action);}
  else assert.ok(['CIW_ACCESS_DENIED','CIW_IDENTITY_NOT_LINKED','CIW_IDENTITY_INACTIVE','CIW_IDENTITY_AMBIGUOUS'].includes(d.error?.code));
  cases.push({action,allowed:d.success===true,code:d.error?.code??null});
  console.log(action+': '+(d.success?'ALLOW':d.error.code));
 }
 const evidence={username:'tasilpar',provider:session.provider,realBrowserSessionVerified:true,transport:'PASOE CGI identity derived from verified real PHP session; no bearer token exported',businessActionsExecuted:false,cases};
 fs.writeFileSync(path.join(state,'real-access-decisions.json'),JSON.stringify(evidence,null,2));
})().catch(e=>{console.error(e.message);process.exitCode=1;});
