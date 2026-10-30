// Sessão administrativa própria. Nunca persiste nem imprime senha/token.
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/purchase-payments-20261022'),meta=path.join(root,'integration-src/purchase-payments/metadata'),base='http://127.0.0.1:8765';
const slugs=['processos-compra-financeiro-med','proc-compra-pagamentos'];
const readJson=file=>JSON.parse(fs.readFileSync(file,'utf8'));
const save=(name,value)=>{fs.mkdirSync(state,{recursive:true});fs.writeFileSync(path.join(state,name),JSON.stringify(value,null,2)+'\n');};
const sha=file=>crypto.createHash('sha256').update(fs.readFileSync(file)).digest('hex');
const drafts=()=>slugs.map(slug=>({slug,...readJson(path.join(meta,slug+'-builder-draft.json'))}));
function operationPath(baseUrl,operationPath){
 assert.equal(typeof operationPath,'string','API_OPERATION_PATH_REQUIRED');
 return /^https?:\/\//i.test(operationPath)?operationPath:baseUrl.replace(/\/+$/,'')+'/'+operationPath.replace(/^\/+/, '');
}
function compatibleOperation(actual,expected,baseUrl){
 return actual.type===expected.type&&actual.method===expected.method&&operationPath(baseUrl,actual.path)===operationPath(baseUrl,expected.path)&&JSON.stringify(actual.bodyTemplate)===JSON.stringify(expected.bodyTemplate)&&JSON.stringify(actual.requestContextFields??[])===JSON.stringify(expected.requestContextFields??[]);
}
async function session(run,{readOnly=true}={}){
 let password=fs.readFileSync(path.join(root,'.runtime/construtor-pg/acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial='))?.slice(14);assert.ok(password,'PRIVATE_ADMIN_PASSWORD_MISSING');
 const response=await fetch(base+'/api/auth/login',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({username:'admin',password,tenantId:'default',remember:false}),signal:AbortSignal.timeout(30000)});password=undefined;
 const login=await response.json();assert.ok(response.ok&&login.authenticated&&login.token,'ADMIN_LOGIN_FAILED');
 const headers={'Content-Type':'application/json',Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId};
 async function request(prefix,url,body,method=body===undefined?'GET':'POST',expected=200){
  const readPost=prefix==='/api/runtime/screens/'&&method==='POST'&&/\/endpoints\/(?:read|get|options\.[A-Za-z_][A-Za-z0-9_]*)$/.test(url);
  assert.ok(!readOnly||method==='GET'||readPost,'READ_ONLY_SESSION_REJECTED_WRITE');
  const r=await fetch(base+prefix+url,{method,headers,...(body===undefined?{}:{body:JSON.stringify(body)}),signal:AbortSignal.timeout(45000)});let d;try{d=await r.json();}catch{throw Error('JSON_REQUIRED HTTP'+r.status);}
  assert.equal(r.status,expected,url+' HTTP'+r.status+' '+(d.error?.code??''));if(r.ok&&d.error)throw Error(url+' '+(d.error.code??'REMOTE_ERROR'));return d;
 }
 try{return await run({api:(url,body,method,expected)=>request('/api/admin/program-builder',url,body,method,expected),runtime:(url,body,expected=200)=>request('/api/runtime/screens/',url,body,body===undefined?'GET':'POST',expected),login});}
 finally{await fetch(base+'/api/auth/logout',{method:'POST',headers,body:'{}',signal:AbortSignal.timeout(15000)});}
}
async function inspect(api){
 const bootstrap=await api('/bootstrap'),ds=drafts(),source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;
 assert.equal(source.code,'motor_progress_ciw_cadastros');assert.equal(source.responseContract,'sursum-programs');assert.equal(source.baseUrl,'http://127.0.0.1:19910/med/web');
 const candidates=readJson(path.join(meta,'api-source-additions.json')).operations;
 const results=ds.map(d=>{const programs=(bootstrap.programs??[]).filter(x=>(x.programCode??x.code)===d.programDraft.programCode);const entities=(bootstrap.entities??[]).filter(x=>x.code===d.entityDraft.code);return {screenId:d.programDraft.screenId,programCode:d.programDraft.programCode,programMatches:programs.map(x=>({code:x.programCode??x.code,screenId:x.screenId??null})),entityCode:d.entityDraft.code,entityMatches:entities.map(x=>({code:x.code,id:x.id})),ownedReceipt:fs.existsSync(path.join(state,'publication-'+d.slug+'.json'))};});
 const operationResults=candidates.map(op=>{const found=source.operations.filter(x=>x.code===op.code);return {code:op.code,matches:found.length,compatible:found.length===0||found.length===1&&compatibleOperation(found[0],op,source.baseUrl)};});
 const occupied=new Set((bootstrap.programs??[]).map(x=>x.programCode??x.code));
 const receipt={success:true,at:new Date().toISOString(),catalogWrites:false,businessWrites:false,source:{code:source.code,operationCount:source.operations.length,responseContract:source.responseContract,origin:'MED'},candidates:results,operations:operationResults,availableOperationalCodes:Array.from({length:40},(_,i)=>'op'+(1000+i)).filter(code=>!occupied.has(code)).slice(0,10)};
 receipt.collisions=results.filter(x=>!x.ownedReceipt&&(x.programMatches.length||x.entityMatches.length)).map(x=>x.programCode);receipt.operationConflicts=operationResults.filter(x=>!x.compatible).map(x=>x.code);
 save('builder-preflight.json',receipt);return {receipt,source,bootstrap};
}
module.exports={fs,path,assert,root,state,meta,base,slugs,readJson,save,sha,drafts,session,inspect,operationPath,compatibleOperation};
