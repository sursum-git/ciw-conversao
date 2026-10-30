'use strict';
// Prepared verification only. Root runs boundaries after ABL publication and
// runtime-read after official Builder publication. No business mutation cases.
const fs = require('node:fs');
const path = require('node:path');
const assert = require('node:assert/strict');

const root = path.resolve(__dirname, '../..');
const folder = path.join(root, '.runtime/container-payments-20261017');
const state = path.join(root, '.runtime/construtor-pg');
const cid = 332526;
const siblingCid = 331126;
const read = file => fs.readFileSync(file, 'utf8').replace(/^\uFEFF/, '');
const json = file => JSON.parse(read(file));
const opaqueKey = value => typeof value === 'string' && /^p_[0-9A-F]{64}$/.test(value);
let headers = { 'Content-Type': 'application/json' };
let integrationToken;
let evidence;

function assertRejectedMutationOnly(body) {
  if (!['create', 'update', 'delete'].includes(body.operation)) return;
  // Even if a validation regression occurs, no valid parent/title/key is sent.
  assert.equal(body.container_id, 0, 'Mutation probes require invalid CID zero');
  assert.ok(!opaqueKey(body.id), 'A real association key is forbidden');
  assert.ok(!opaqueKey(body.pagamento_key), 'A real association alias is forbidden');
  if (body.values?.num_id_tit_ap !== undefined) {
    assert.equal(body.values.num_id_tit_ap, 0, 'Mutation probes require invalid title zero');
  }
}

function save(name) {
  fs.mkdirSync(folder, { recursive: true });
  fs.writeFileSync(path.join(folder, name), JSON.stringify(evidence, null, 2) + '\n');
}

async function api(route, body, expected = 200) {
  const response = await fetch('http://127.0.0.1:8765' + route, {
    method: body === undefined ? 'GET' : 'POST', headers,
    body: body === undefined ? undefined : JSON.stringify(body),
    signal: AbortSignal.timeout(60000),
  });
  const result = await response.json();
  assert.equal(response.status, expected, route + ': unexpected local API status');
  return result;
}

async function pasoe(body, expected, overrides = {}, route = 'containers-pagamentos') {
  assert.ok(['containers-pagamentos', 'containers-financeiro'].includes(route));
  assertRejectedMutationOnly(body);
  const requestHeaders = {
    'Content-Type': 'application/json', 'X-Containers-Token': integrationToken,
    'X-Sursum-User': 'admin', ...overrides,
  };
  for (const key of Object.keys(requestHeaders)) if (requestHeaders[key] === null) delete requestHeaders[key];
  const start = Date.now();
  const response = await fetch('http://127.0.0.1:19910/med/web/SursumPrograms/' + route, {
    method: 'POST', headers: requestHeaders, body: JSON.stringify(body),
    signal: AbortSignal.timeout(60000),
  });
  const result = await response.json();
  assert.equal(result.success, expected === 200, route + ': unexpected Sursum success flag');
  if (expected !== 200) assert.equal(result.error?.status, expected, route + ': unexpected Sursum error status');
  evidence.checks.push({
    route, resource: body.resource, operation: body.operation,
    httpStatus: response.status, contractStatus: expected,
    code: result.error?.code || null, elapsedMs: Date.now() - start,
  });
  return result;
}

function summarizeOptions(rows) {
  assert.ok(Array.isArray(rows) && rows.length <= 5000, 'Bounded option array required');
  const ids = new Set();
  const modalities = {};
  for (const row of rows) {
    assert.equal(row.container_id, cid);
    assert.ok(Number.isInteger(row.value) && row.value > 0);
    assert.equal(row.value, row.num_id_tit_ap);
    assert.ok(!ids.has(row.value), 'Options must have unique numeric identities'); ids.add(row.value);
    assert.ok(opaqueKey(row.pagamento_key));
    assert.ok(typeof row.label === 'string' && row.label.length > 0);
    assert.ok(['adiantamento', 'apos_di'].includes(row.modalidade));
    modalities[row.modalidade] = (modalities[row.modalidade] || 0) + 1;
  }
  // These business references stay only in ignored .runtime evidence.
  return {
    count: rows.length, modalities,
    samples: rows.slice(0, 20).map(row => ({
      value: row.value, pagamento_key: row.pagamento_key,
      modalidade: row.modalidade, label: row.label,
    })),
  };
}

async function boundaries() {
  for (const token of [null, 'invalid-payment-verification-token-'.repeat(2)]) {
    await pasoe({ resource: 'container-pagamentos', operation: 'create', container_id: 0 }, 401, { 'X-Containers-Token': token });
    await pasoe({ resource: 'pagamentos-disponiveis', operation: 'read', container_id: cid }, 401, { 'X-Containers-Token': token });
  }
  await pasoe({ resource: 'pagamentos-disponiveis', operation: 'read', container_id: cid }, 401, { 'X-Sursum-User': null });
  await pasoe({ resource: 'wrong', operation: 'read', container_id: 0 }, 422);
  await pasoe({ resource: 'container-pagamentos', operation: 'read', container_id: 0 }, 422);
  await pasoe({ resource: 'container-pagamentos', operation: 'get', container_id: 0 }, 422);
  await pasoe({ resource: 'container-pagamentos', operation: 'update', container_id: 0 }, 422);
  for (const fields of [
    {}, { container_id: 0 }, { container_id: cid, policy: {} },
    { container_id: cid, actor: 'forged' }, { container_id: cid, modalidade: 'adiantamento' },
  ]) {
    await pasoe({ resource: 'pagamentos-disponiveis', operation: 'read', ...fields }, 422);
  }
  // Public options expose only read; get is a private command eligibility proof.
  await pasoe({ resource: 'pagamentos-disponiveis', operation: 'get', container_id: cid, id: 0 }, 422);
  for (const fields of [
    {}, { values: {} }, { values: { num_id_tit_ap: 0 } },
    { values: { num_id_tit_ap: 0, vl_pago_em_real: 999 } },
    { values: { num_id_tit_ap: 0 }, actor: 'forged' },
  ]) {
    await pasoe({ resource: 'container-pagamentos', operation: 'create', container_id: 0, ...fields }, 422);
  }
  await pasoe({ resource: 'container-pagamentos', operation: 'delete', container_id: 0, id: 'not-a-key' }, 422);
  await pasoe({ resource: 'container-pagamentos', operation: 'delete', container_id: 0 }, 422);
  const options = await pasoe({ resource: 'pagamentos-disponiveis', operation: 'read', container_id: cid }, 200);
  evidence.options = summarizeOptions(options.data);
  const payments = await pasoe({ resource: 'pagamentos', operation: 'read', container_id: cid }, 200, {}, 'containers-financeiro');
  assert.ok(Array.isArray(payments.data) && payments.data.length > 0, 'Real readonly payment sample required');
  for (const row of payments.data) { assert.equal(row.container_id, cid); assert.ok(opaqueKey(row.pagamento_key)); }
  const row = payments.data[0];
  const detail = await pasoe({ resource: 'pagamentos', operation: 'get', container_id: cid, id: row.pagamento_key }, 200, {}, 'containers-financeiro');
  assert.deepEqual(detail.data, row, 'Legacy financial detail matches its scoped row');
  await pasoe({ resource: 'pagamentos', operation: 'get', container_id: siblingCid, id: row.pagamento_key }, 404, {}, 'containers-financeiro');
  evidence.payments = { count: payments.data.length, sampleKey: row.pagamento_key, context: cid, rejectedContext: siblingCid };
  save('pasoe-boundaries.json');
}

async function runtimeRead() {
  const credentialLine = read(path.join(state, 'acesso-local.txt')).split(/\r?\n/).find(line => line.startsWith('Senha inicial='));
  assert.ok(credentialLine, 'Private local admin credential record required');
  const session = await api('/api/auth/login', { username: 'admin', password: credentialLine.slice(14), tenantId: 'default', rememberMe: false });
  assert.equal(session.authenticated, true);
  headers = {
    ...headers, Authorization: 'Bearer ' + session.token, 'X-Runtime-Auth-Token': session.token,
    'X-Runtime-Tenant-Id': session.tenantId, 'X-Runtime-User-Id': String(session.user.id),
    'X-Runtime-Session-Id': session.session.sessionId,
  };
  try {
    const screen = await api('/api/runtime/screens/ciw.container-pagamentos');
    const panel = await api('/api/runtime/screens/ciw.container-painel');
    assert.equal(screen.program.id, 'op1006'); assert.equal(screen.program.version, '1.0.2');
    assert.equal(panel.program.id, 'op1001'); assert.equal(panel.program.version, '1.0.7');
    assert.equal(screen.permissions.create, true); assert.equal(screen.permissions.delete, true); assert.equal(screen.permissions.edit, false);
    assert.equal(screen.dataModel.primaryKey, 'pagamento_key');
    assert.equal(screen.contextFields.find(field => field.field === 'container_id').required, true);
    const visibleHeaders = panel.crud.form.tabs.filter(tab => tab.linkedPage?.hideHeader === false).map(tab => tab.id).sort();
    assert.equal(panel.crud.form.tabs.length, 14); assert.deepEqual(visibleHeaders, ['itens', 'pagamentos']);
    assert.equal(screen.program.logs.mode, 'deletions'); assert.equal(screen.program.logs.screenId, 'ciw.container-pagamentos');
    const serialized = JSON.stringify(screen);
    assert.ok(!serialized.includes(integrationToken), 'Published metadata must not expose integration token');
    const field = screen.dataModel.fields.num_id_tit_ap;
    assert.ok(field, 'Title field metadata required');
    // Builder exposes the registered endpoint, keeping operation/source details server side.
    assert.equal(field.optionsSource?.endpointId, 'options.num_id_tit_ap');
    assert.equal(field.editor, 'dropdown');
    assert.equal(field.readonlyOnEdit, true);
    const endpoint = '/api/runtime/screens/ciw.container-pagamentos/endpoints/';
    await api(endpoint + 'options.num_id_tit_ap', {}, 422);
    await api(endpoint + 'options.num_id_tit_ap', { context: { container_id: cid }, container_id: siblingCid }, 422);
    const options = await api(endpoint + 'options.num_id_tit_ap', { context: { container_id: cid } });
    assert.ok(Array.isArray(options.data));
    const rows = await api(endpoint + 'read', { take: 500, context: { container_id: cid } });
    assert.ok(Array.isArray(rows.data) && rows.data.length > 0);
    for (const row of rows.data) { assert.equal(row.container_id, cid); assert.ok(opaqueKey(row.pagamento_key)); }
    const row = rows.data[0];
    const detail = await api(endpoint + 'get', { id: row.pagamento_key, context: { container_id: cid } });
    assert.equal(detail.pagamento_key, row.pagamento_key); assert.equal(detail.container_id, cid);
    await api(endpoint + 'get', { id: row.pagamento_key, context: { container_id: siblingCid } }, 404);
    evidence.options = { count: options.data.length };
    evidence.payments = { count: rows.data.length, sampleKey: row.pagamento_key, context: cid, rejectedContext: siblingCid };
    evidence.checks = [
      'official op1006/1.0.2 and panel1.0.7/14tabs', 'two native child headers',
      'create/delete permissions, no edit', 'opaque payment PK and required context',
      'native payment deletion logs', 'registered contextual title options',
      'missing/conflicting options context rejected by PHP', 'real payment read/get and sibling isolation',
    ];
    save('runtime-read-evidence.json');
  } finally {
    await api('/api/auth/logout', {});
    headers = { 'Content-Type': 'application/json' };
  }
}

async function main() {
  const mode = process.argv[2];
  assert.ok(['boundaries', 'runtime-read'].includes(mode), 'Explicit mode: boundaries or runtime-read');
  // Local publication receipt only; no speculative call before the new route exists.
  const receipt = json(path.join(root, '.runtime/container-payments-publish-20261017/active-manifest.json'));
  assert.equal(receipt.instance, 'sursum-api'); assert.equal(receipt.context, 'med');
  assert.ok(receipt.addedRoutes.some(route => route.route === '/SursumPrograms/containers-pagamentos'));
  integrationToken = json(path.join(state, 'containers-connection.json')).integrationToken;
  assert.ok(typeof integrationToken === 'string' && integrationToken.length >= 32, 'Private integration token required');
  evidence = { at: new Date().toISOString(), mode, businessWrites: false, newBusinessFixtures: false, checks: [] };
  if (mode === 'boundaries') await boundaries(); else await runtimeRead();
  console.log('PASS: payment ' + mode + '; rejected requests and reads only, no business writes.');
}

if (require.main === module) main().catch(() => { console.error('FAIL: payment verification; inspect guards and private evidence. No secrets logged.'); process.exitCode = 1; });
