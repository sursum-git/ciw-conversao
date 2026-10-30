/* Somente consultas de autorizacao: allowlist inicial vazia, nenhum login IMA ficticio. */
const fs = require('node:fs');
const path = require('node:path');
const assert = require('node:assert/strict');
const root = path.resolve(__dirname, '../..');
const dir = path.join(root, '.runtime/ciw-access-20261016');
const connection = JSON.parse(fs.readFileSync(path.join(dir, 'connection.json'), 'utf8'));
const body = { operation: 'authorize', resource: 'cadastros.coloracoes', action: 'read' };
const url = connection.baseUrl + '/SursumPrograms/ciw-access';
const identity = { 'X-Sursum-User': 'CIW_TEST_NO_REAL_USER', 'X-Session-Id': 'CIW_READONLY_VALIDATION', 'X-Sursum-Auth-Source': 'local' };
const cases = [
  ['sem_token', body, {}, 401, 'CIW_IDENTITY_REQUIRED'],
  ['token_incorreto', body, { 'X-CiwAccess-Token': 'b'.repeat(64) }, 401, 'CIW_IDENTITY_REQUIRED'],
  ['sem_identidade', body, { 'X-CiwAccess-Token': connection.token }, 401, 'CIW_IDENTITY_REQUIRED'],
  ['login_no_payload', { ...body, login: 'forged' }, { 'X-CiwAccess-Token': connection.token }, 400, 'CIW_ACCESS_INVALID_REQUEST'],
  ['tabela_no_payload', { ...body, table: 'user-web' }, { 'X-CiwAccess-Token': connection.token }, 400, 'CIW_ACCESS_INVALID_REQUEST'],
  ['recurso_desconhecido', { ...body, resource: 'other' }, { 'X-CiwAccess-Token': connection.token }, 400, 'CIW_ACCESS_INVALID_REQUEST'],
  ['acao_desconhecida', { ...body, action: 'READ' }, { 'X-CiwAccess-Token': connection.token }, 400, 'CIW_ACCESS_INVALID_REQUEST'],
  ['array_raiz', [], { 'X-CiwAccess-Token': connection.token }, 400, 'INVALID_JSON'],
  ['origem_local_negada', body, { ...identity, 'X-CiwAccess-Token': connection.token }, 403, 'CIW_AUTH_SOURCE_DENIED'],
  ['origem_ima_sem_allowlist_negada', body, { ...identity, 'X-CiwAccess-Token': connection.token, 'X-Sursum-Auth-Source': 'ima-ldap' }, 403, 'CIW_AUTH_SOURCE_DENIED'],
  ['repeticao_sem_cache', body, { ...identity, 'X-CiwAccess-Token': connection.token }, 403, 'CIW_AUTH_SOURCE_DENIED'],
];
(async () => {
  const results = [];
  for (const [name, payload, headers, status, code] of cases) {
    const res = await fetch(url, { method: 'POST', headers: { 'Content-Type': 'application/json', ...headers }, body: JSON.stringify(payload), signal: AbortSignal.timeout(20000) });
    const result = await res.json();
    // Roteador existente usa HTTP200 para envelopes de programa; erros de parse sao HTTP400.
    assert.equal(res.status, name === 'array_raiz' ? 400 : 200, `${name}: status HTTP do roteador`);
    if (name !== 'array_raiz') assert.equal(result.error?.status, status, `${name}: status do dominio`);
    if (name === 'array_raiz') assert.ok(result.error && !result.data, `${name}: erro do roteador sem dados`);
    else assert.equal(result.success, false, `${name}: negacao explicita`);
    assert.equal(result.error?.code, code, `${name}: codigo de erro`);
    assert.ok(!JSON.stringify(result).includes(connection.token), `${name}: nenhum segredo na resposta`);
    results.push({ case: name, httpStatus: res.status, domainStatus: result.error?.status ?? null, code: result.error.code, passed: true });
    console.log(`PASS ${name}: HTTP${res.status} dominio${result.error?.status ?? '-'} ${code}`);
  }
  const proof = { instance: 'sursum-api', context: 'med', cases: results, businessWrites: false,
    authentication_context: 'transport_private_token_allowlist_empty',
    positiveCase: 'pending_real_ima_provider_session', phase1AComplete: false };
  fs.writeFileSync(path.join(dir, 'pasoe-negative-validation.json'), JSON.stringify(proof, null, 2) + '\n');
})().catch(error => { console.error(error.message); process.exitCode = 1; });
