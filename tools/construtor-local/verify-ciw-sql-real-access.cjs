/* Expressao para CDP no mesmo origin da UI. Token fica somente no navegador.
 * Nao faz login, nao envia senha, nao exporta bearer e nao executa CRUD.
 * Modo logout encerra apenas a sessao tcassimiro verificada no mesmo callback.
 */
function build(mode='access') {
 if(!['access','logout'].includes(mode))throw new Error('invalid mode');
 return `(${async function(mode){
  const read=k=>localStorage.getItem('crudEngine.'+k)||'';
  const token=read('authToken'),sessionId=read('runtimeSessionId');
  if(!token||!sessionId)return {ready:false,reason:'LOGIN_REQUIRED'};
  const h={'Content-Type':'application/json',Authorization:'Bearer '+token,'X-Runtime-Auth-Token':token,'X-Runtime-Tenant-Id':read('runtimeTenantId')||'default','X-Runtime-Session-Id':sessionId};
  const current=await fetch('/api/auth/session',{headers:h,signal:AbortSignal.timeout(20000)});const actor=await current.json();
  if(!current.ok||!actor.authenticated||(actor.user?.username??actor.user?.id)!=='tcassimiro'||actor.tenantId!=='default'||actor.user?.source!=='ima-user-web'||actor.session?.status!=='active')return {ready:false,reason:'EXPECTED_REAL_TCASSIMIRO_SESSION_REQUIRED'};
  const out={ready:true,username:'tcassimiro',source:'ima-user-web',tenant:'default',verifiedAt:new Date().toISOString(),businessWrites:false,cases:[]};
  async function call(payload,headers=h){const r=await fetch('/api/ciw/access',{method:'POST',headers,body:JSON.stringify(payload),signal:AbortSignal.timeout(20000)});const b=await r.json();return {httpStatus:r.status,success:b.success===true,allowed:b.data?.[0]?.allowed===true,scope:b.data?.[0]?.scope??null,code:b.error?.code??null};}
  const payload={operation:'authorize',resource:'cadastros.coloracoes',action:'read'};
  if(mode==='logout'){
   const r=await fetch('/api/auth/logout',{method:'POST',headers:h,body:'{}',signal:AbortSignal.timeout(20000)});out.logoutStatus=r.status;out.afterLogout=await call(payload);out.passed=r.ok&&out.afterLogout.httpStatus===401;return out;
  }
  for(const action of ['read','get','create','update','delete','export','print']){const decision=await call({...payload,action});out.cases.push({action,...decision,passed:decision.httpStatus===200&&decision.allowed&&decision.scope==='legacy_ciw'});}
  const forged=await call({...payload,subject:'admin'});out.cases.push({action:'forged_subject',...forged,passed:forged.httpStatus===400});
  const wrongToken=await call(payload,{...h,Authorization:'Bearer '+('x'.repeat(64)),'X-Runtime-Auth-Token':'x'.repeat(64)});out.cases.push({action:'wrong_token',...wrongToken,passed:wrongToken.httpStatus===401});
  out.passed=out.cases.every(x=>x.passed);return out;
 }.toString()})(${JSON.stringify(mode)})`;
}
module.exports={build};
if(require.main===module)process.stdout.write(build(process.argv[2]||'access'));
