/* CRUD real somente em registros novos CODEx; sempre remove os proprios ao final. */
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/ciw-cadastros-20261020'),base='http://127.0.0.1:8765';
const resources=['coloracoes','situacoes_container','tipos_versao_custo','motivos_desconto'];
(async()=>{
 const cfg=JSON.parse(fs.readFileSync(path.join(state,'private/connection.json'),'utf8'));
 async function raw(body,h={}){const r=await fetch(cfg.baseUrl+'/SursumPrograms/ciw-cadastros',{method:'POST',headers:{'Content-Type':'application/json',...h},body:JSON.stringify(body),signal:AbortSignal.timeout(25000)});return {status:r.status,data:await r.json()};}
 for(const h of [{},{'X-Ciw-Cadastros-Token':'x'.repeat(64)}]){const r=await raw({resource:'coloracoes',operation:'read'},h);assert.equal(r.data.error.code,'CIW_CADASTRO_AUTH_REQUIRED');}
 const denied=await raw({resource:'coloracoes',operation:'create',descricao:'NOT_CREATED'},{'X-Ciw-Cadastros-Token':cfg.integrationToken});assert.equal(denied.data.error.code,'CIW_CADASTRO_IDENTITY_REQUIRED');
 let password=fs.readFileSync(path.join(root,'.runtime/construtor-pg/acesso-local.txt'),'utf8').split(/\r?\n/).find(x=>x.startsWith('Senha inicial=')).slice(14);
 const lr=await fetch(base+'/api/auth/login',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({username:'admin',password,tenantId:'default',remember:false})});password=undefined;
 const login=await lr.json();assert.ok(login.authenticated,'ADMIN_LOGIN_FAILED');
 const headers={'Content-Type':'application/json',Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),'X-Runtime-Session-Id':login.session.sessionId,'X-Sursum-User':'forged-browser-user'};
 async function json(url,body,status=200){const r=await fetch(base+url,{method:body===undefined?'GET':'POST',headers,...(body===undefined?{}:{body:JSON.stringify(body)}),signal:AbortSignal.timeout(40000)});const d=await r.json();assert.equal(r.status,status,d.error?.code||url);return d;}
 const evidence={at:new Date().toISOString(),technicalNegatives:true,resources:[]};
 try{
  for(const resource of resources){
   const draft=JSON.parse(fs.readFileSync(path.join(root,'integration-src/ciw-cadastros/metadata',resource+'-builder-draft.json'),'utf8'));const screen=draft.programDraft.screenId,pk=draft.entityDraft.fields.find(f=>f.primaryKey).code;
   const fieldNames=draft.entityDraft.fields.filter(x=>!x.primaryKey).map(x=>x.code),defaults=Object.fromEntries(draft.entityDraft.fields.filter(x=>!x.primaryKey).map(x=>[x.code,x.options.defaultValue]));
   const marker='CODEx-20-'+Date.now().toString(36)+'-'+crypto.randomUUID().slice(0,6)+'-';
   const read=async()=>{const r=await json('/api/runtime/screens/'+screen+'/endpoints/read',{take:10000});return r.data;};
   const batch=async(changes,status=200)=>json('/api/runtime/screens/'+screen+'/endpoints/batch',{changes},status);
   const original=row=>Object.fromEntries(fieldNames.map(k=>[k,row[k]]));let before;
   const view=await json('/api/runtime/screens/'+screen);assert.equal(view.crud.grid.editing.mode,'batch');assert.equal(view.dataSource.api.batch.endpointId,'batch');assert.equal(view.dataModel.fields[pk].editable,false);
   try{
    before=await read();assert.ok(Array.isArray(before));
    let b=await batch([{operation:'create',clientId:'a',data:{...defaults,descricao:marker+'Ação'}},{operation:'create',clientId:'b',data:{...defaults,descricao:marker+'B'}}]);assert.equal(b.results.length,2);
    const a=b.results.find(x=>x.clientId==='a').id,bb=b.results.find(x=>x.clientId==='b').id;assert.ok(Number.isInteger(a)&&Number.isInteger(bb)&&a!==bb);
    let rows=await read();const rowA=rows.find(x=>x[pk]===a),rowB=rows.find(x=>x[pk]===bb);assert.equal(rowA.descricao,marker+'Ação');
    b=await batch([{operation:'update',clientId:'u',id:a,original:original(rowA),data:{descricao:marker+'Alterado'}},{operation:'delete',clientId:'d',id:bb,original:original(rowB)},{operation:'create',clientId:'c',data:{...defaults,descricao:marker+'C'}}]);assert.equal(b.results.length,3);
    rows=await read();const updated=rows.find(x=>x[pk]===a);assert.equal(updated.descricao,marker+'Alterado');assert.ok(!rows.some(x=>x[pk]===bb));
    const stale=await batch([{operation:'update',clientId:'stale',id:a,original:original(rowA),data:{descricao:marker+'NAO'}}],409);assert.equal(stale.error.code,'CIW_CADASTRO_CHANGED');
    let missing=2147483647;while(rows.some(x=>x[pk]===missing))missing--;
    const failed=await batch([{operation:'update',clientId:'first',id:a,original:original(updated),data:{descricao:marker+'ROLLBACK'}},{operation:'create',clientId:'second',data:{...defaults,descricao:marker+'NAO_CRIAR'}},{operation:'delete',clientId:'third',id:missing,original:original(updated)}],404);assert.equal(failed.error.code,'CIW_CADASTRO_NOT_FOUND');
    rows=await read();assert.equal(rows.find(x=>x[pk]===a).descricao,marker+'Alterado');assert.ok(!rows.some(x=>x.descricao===marker+'NAO_CRIAR'));
    await batch([{operation:'create',clientId:'extra',data:{...defaults,descricao:marker+'BAD',unknown:'x'}}],422);
    evidence.resources.push({resource,screenId:screen,originalCount:before.length,batchCrud:true,unicode:true,optimisticConflict:true,fullRollback:true,strictFields:true,marker,cleaned:false});
   }finally{
    const rows=await read();const own=rows.filter(x=>typeof x.descricao==='string'&&x.descricao.startsWith(marker));
    if(own.length)await batch(own.map((x,i)=>({operation:'delete',clientId:'cleanup-'+i,id:x[pk],original:original(x)})));
    const after=await read();assert.ok(!after.some(x=>typeof x.descricao==='string'&&x.descricao.startsWith(marker)));
    if(before)assert.deepEqual(after.slice().sort((a,b)=>a[pk]-b[pk]),before.slice().sort((a,b)=>a[pk]-b[pk]),'Registros anteriores devem permanecer intactos');
    const proof=evidence.resources.find(x=>x.resource===resource);if(proof)proof.cleaned=true;
    fs.writeFileSync(path.join(state,'real-crud-evidence.json'),JSON.stringify(evidence,null,2));
   }
   console.log('PASS '+screen+': CRUD/lote misto/conflito/rollback/limpeza; registros anteriores preservados.');
  }
 }finally{await fetch(base+'/api/auth/logout',{method:'POST',headers,body:'{}'});}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
