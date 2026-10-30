'use strict';
const fs = require('node:fs');
const path = require('node:path');
const assert = require('node:assert/strict');
const state = path.resolve(__dirname, '../../.runtime/construtor-pg');
const base = 'http://127.0.0.1:8765';
const password = fs.readFileSync(path.join(state, 'acesso-local.txt'), 'utf8').split(/\r?\n/)
  .find(x => x.startsWith('Senha inicial=')).slice('Senha inicial='.length);
const marker = 'CODEx ' + Date.now() + ' São José';
let headers = {'Content-Type':'application/json'};
let definition;
const owned = new Map();
const evidence = [];
async function request(url, body, expected=200) {
  const response = await fetch(base + url, {method:body===undefined?'GET':'POST',headers,
    body:body===undefined?undefined:JSON.stringify(body)});
  const json=await response.json();
  assert.equal(response.status,expected,url+' '+JSON.stringify(json.error||{}));
  return json;
}
async function action(name,body={},expected=200) {
  const endpoint=definition.dataSource.api[name];
  assert.ok(endpoint, 'Endpoint '+name);
  const response=await fetch(base+'/api/runtime/screens/ciw.empresas/endpoints/'+endpoint.endpointId,{method:endpoint.method||'POST',headers,body:JSON.stringify(body)});
  const json=await response.json();
  assert.equal(response.status,expected,name+' '+JSON.stringify(json.error||{}));
  return json;
}
(async()=>{
  const login=await request('/api/auth/login',{username:'admin',password,tenantId:'default',rememberMe:false});
  assert.ok(login.authenticated);
  headers={...headers,Authorization:'Bearer '+login.token,'X-Runtime-Auth-Token':login.token,
    'X-Runtime-Tenant-Id':login.tenantId,'X-Runtime-User-Id':String(login.user.id),
    'X-Runtime-Session-Id':login.session.sessionId};
  try {
    definition=await request('/api/runtime/screens/ciw.empresas');
    fs.writeFileSync(path.join(state,'empresas-definition.json'),JSON.stringify(definition,null,2));
    assert.ok(!JSON.stringify(definition).includes('_integrationToken'),'Tela não recebe credencial');
    console.log('Endpoints:',Object.keys(definition.dataSource.api).join(', '));
    const initial=await action('read',{take:1,skip:0});
    assert.ok(Array.isArray(initial.data));
    assert.ok(initial.data.length<=1);assert.ok(initial.total>=initial.data.length);
    evidence.push('Leitura real e paginação PHP');
    const created=await action('create',{record:{nome:marker,cod_emp_ems2:0,cod_emp_ems5:0}});
    const row=created.data && !Array.isArray(created.data)?created.data:created;
    assert.ok(Number.isInteger(row.empresa_id),'ID gerado');
    owned.set(row.empresa_id,marker);
    assert.equal(row.nome,marker);
    const detail=await action('get',{id:row.empresa_id});
    assert.equal((detail.data||detail).nome,marker);
    const filtered=await action('read',{filter:{logic:'and',filters:[{field:'nome',operator:'eq',value:marker}]},take:20});
    assert.equal(filtered.total,1);assert.equal(filtered.data[0].empresa_id,row.empresa_id);
    const changed=await action('update',{record:{empresa_id:row.empresa_id,nome:marker+' Edit',cod_emp_ems2:7,cod_emp_ems5:-8}});
    assert.equal((changed.data||changed).cod_emp_ems5,-8);
    owned.set(row.empresa_id,marker+' Edit');
    await action('update',{record:{empresa_id:row.empresa_id,nome:'x'.repeat(51)}},422);
    await action('update',{record:{empresa_id:row.empresa_id,cod_emp_ems2:1.5}},422);
    await action('get',{id:2147483647},404);
    const afterError=await action('get',{id:row.empresa_id});
    assert.equal((afterError.data||afterError).nome,marker+' Edit');
    evidence.push('CRUD real em registro marcado; UTF-8; filtro; validações 422/404 sem falso sucesso');
  } finally {
    for (const [id,name] of owned) {
      const detail=await action('get',{id});
      assert.equal((detail.data||detail).nome,name,'Limpeza restrita ao registro de teste');
      await action('delete',{id});
      await action('get',{id},404);
    }
    await request('/api/auth/logout',{});
  }
  fs.writeFileSync(path.join(state,'empresas-http-evidence.json'),JSON.stringify({at:new Date().toISOString(),evidence,cleanup:true},null,2));
  console.log('PASS: '+evidence.join('; ')+'; registro de teste removido.');
})().catch(error=>{console.error(error.message);process.exitCode=1;});
