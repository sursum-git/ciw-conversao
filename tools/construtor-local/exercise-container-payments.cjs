'use strict';
// PREPARED ONLY. No command runs on import. Root reviews the private plan and runs
// one phase at a time; no retry, DB connection, sequence or EMS5 mutation here.
const fs = require('node:fs');
const path = require('node:path');
const assert = require('node:assert/strict');
const crypto = require('node:crypto');
const SCOPE = Object.freeze({ container_id: 2147000102, proc_compra_id: 2147000300,
  item_proc_compra_id: 2147000301, tag: 'SC_TEST_PAGTOS_20261017', synthetic_erp: 'ZTSC171027' });
const object = value => value !== null && typeof value === 'object' && !Array.isArray(value);
const positiveId = value => Number.isSafeInteger(value) && value > 0 && value <= 2147483647;
const paymentKey = value => typeof value === 'string' && /^p_[0-9A-F]{64}$/.test(value);
function assertAbsentImage(value){assert.ok((object(value)&&Object.keys(value).length===0)||(Array.isArray(value)&&value.length===0),'Absent image must be empty {} or PHP associative []');}
function assertScope(value) { for (const [key, expected] of Object.entries(SCOPE)) assert.equal(value[key], expected, 'Fixed fixture scope: ' + key); }
function canonical(value) {
  if (Array.isArray(value)) return value.map(canonical);
  if (object(value)) return Object.fromEntries(Object.keys(value).sort().map(key => [key, canonical(value[key])]));
  assert.ok(value === null || ['string', 'number', 'boolean'].includes(typeof value));
  if (typeof value === 'number') assert.ok(Number.isFinite(value));
  return value;
}
const hash = text => crypto.createHash('sha256').update(text, 'utf8').digest('hex');
const imageHash = value => hash(JSON.stringify(canonical(value)));
const rowSetHash = rows => { assert.ok(Array.isArray(rows)); return imageHash(rows.map(canonical).map(JSON.stringify).sort()); };
function assertBorrowedUnchanged(baseline, observed) {
  assert.equal(observed.title_matches, 1); assert.equal(observed.title_id, baseline.title_id); assert.equal(observed.cod_estab, baseline.cod_estab);
  assert.equal(imageHash(observed.title), imageHash(baseline.title), 'Borrowed EMS5 title changed: stop, preserve evidence');
  assert.equal(rowSetHash(observed.title_values), rowSetHash(baseline.title_values), 'Borrowed EMS5 values changed: stop, preserve evidence');
  if (baseline.approved_title_snapshots !== undefined) {
    const before=baseline.approved_title_snapshots,after=observed.approved_title_snapshots;
    assert.ok(Array.isArray(before)&&before.length===2&&Array.isArray(after)&&after.length===2,'Both approved title snapshots required');
    assert.equal(new Set(before.map(r=>r.title_id)).size,2);assert.equal(new Set(after.map(r=>r.title_id)).size,2);
    for(const old of before){
      const current=after.find(r=>r.title_id===old.title_id&&r.cod_estab===old.cod_estab);assert.ok(current,'Approved title set changed');
      assertBorrowedUnchanged(old,current);
      if(old.title_id!==baseline.title_id)for(const key of ['container_links','order_links','ledger_rows'])assert.deepEqual(current[key],[],'Untouched reference title gained '+key);
      else {assert.equal(imageHash(current.title),imageHash(observed.title));assert.equal(rowSetHash(current.title_values),rowSetHash(observed.title_values));}
    }
  }
}
function assertFixtureImage(expected, observed, kind) {
  assert.ok(['allocation','parent'].includes(kind));assert.ok(object(expected)&&object(observed));
  assert.equal(expected.container_id,SCOPE.container_id);assert.equal(observed.container_id,SCOPE.container_id);
  if(kind==='allocation'){assert.equal(expected.item_proc_compra_id,SCOPE.item_proc_compra_id);assert.equal(expected.observacao,SCOPE.tag);assert.equal(observed.observacao,SCOPE.tag);}
  else {assert.equal(expected.narrativa,SCOPE.tag);assert.equal(observed.narrativa,SCOPE.tag);}
  const actual={};for(const key of Object.keys(expected)){assert.ok(Object.hasOwn(observed,key),'Missing physical fixture field '+key);actual[key]=observed[key];}
  assert.equal(imageHash(expected),imageHash(actual),'Fixture changed after reviewed own image; stop before DELETE');
}
function assertCandidateProbe(probe) {
  assert.equal(probe.success, true); assert.equal(probe.readOnly, true); assert.equal(probe.title_matches, 1);
  assert.ok(positiveId(probe.title_id)); assert.ok(typeof probe.cod_estab === 'string' && probe.cod_estab.length > 0);
  assert.equal(probe.title.num_id_tit_ap, probe.title_id); assert.equal(probe.title.cod_estab, probe.cod_estab);
  assert.ok(Array.isArray(probe.title_values) && probe.title_values.length > 0);
  for (const key of ['container_links', 'order_links', 'ledger_rows']) assert.deepEqual(probe[key], [], 'Candidate must have zero GLOBAL ' + key);
}
function assertOwnedLedger(row, itemId, titleId) {
  assert.ok(positiveId(row.cta_corren_fornec_imp_id)); assert.equal(row.container_id, SCOPE.container_id);
  assert.equal(row.item_container_id, itemId); assert.equal(row.item_proc_compra_id, SCOPE.item_proc_compra_id);
  assert.equal(row.num_id_tit_ap, titleId); assert.equal(row.cod_tipo_movto, 5);
}
function physicalLedger(row) { const copy = { ...row }; delete copy.container_id; return copy; }
function assertExactLedger(expected, physical) {
  const ids = rows => rows.map(row => row.cta_corren_fornec_imp_id);
  for (const rows of [expected, physical]) assert.equal(new Set(ids(rows)).size, rows.length, 'Duplicate ledger identity');
  assert.equal(rowSetHash(expected.map(physicalLedger)), rowSetHash(physical.map(physicalLedger)), 'Exact ledger set/image mismatch');
}
function assertMainAudit(row, operation, key, titleId) {
  const audit = row.meta?.audit;
  assert.equal(row.actor_user_id, 'admin'); assert.equal(row.actor_user_name, 'Administrador');
  assert.equal(audit?.source, 'progress-transaction'); assert.equal(audit.available, true);
  assert.equal(audit.containerId, SCOPE.container_id); assert.equal(audit.resource, 'container_payment_links');
  assert.equal(audit.operation, operation); assert.equal(audit.recordId, key); assert.equal(audit.paymentKey, key);
  const absent = operation === 'create' ? row.before : row.after;
  const present = operation === 'create' ? row.after : row.before;
  assertAbsentImage(absent);assert.ok(object(present));
  assert.equal(present.container_id, SCOPE.container_id); assert.equal(present.num_id_tit_ap, titleId); assert.equal(present.pagamento_key, key);
}
module.exports = { SCOPE, assertScope, imageHash, rowSetHash, assertCandidateProbe, assertBorrowedUnchanged,
  assertOwnedLedger, assertExactLedger, assertMainAudit,assertFixtureImage,assertAbsentImage };

async function main() {
  const mode = process.argv[2];
  assert.ok(['inspect', 'associate', 'verify-associated', 'reject-duplicate', 'verify-duplicate',
    'disassociate', 'verify-disassociated', 'cleanup-manifest', 'verify-clean'].includes(mode), 'One explicit phase required');
  assert.equal(process.argv[3], '--execute-reviewed-plan', 'Prepared harness: explicit reviewed-plan flag required');
  const root = path.resolve(__dirname, '../..');
  const folder = path.join(root, '.runtime/container-payments-20261017');
  const state = path.join(root, '.runtime/construtor-pg');
  const read = file => fs.readFileSync(file, 'utf8').replace(/^\uFEFF/, '');
  const load = name => JSON.parse(read(path.join(folder, name)));
  const save = (name, value) => fs.writeFileSync(path.join(folder, name), JSON.stringify(value, null, 2) + '\n');
  const plan = load('payments-real-plan.json'); assertScope(plan); assert.equal(plan.execution_authorized, true);
  const probe = load('payments-candidate-probe.json'); assertCandidateProbe(probe);
  assert.equal(probe.approved_title_snapshots?.length,2,'Both authorized original titles must have full baseline snapshots');
  assertBorrowedUnchanged(probe,probe);
  assert.equal(imageHash(probe), plan.candidate_probe_sha256, 'Reviewed candidate probe hash required');
  assert.equal(plan.num_id_tit_ap, probe.title_id); assert.equal(plan.cod_estab, probe.cod_estab);
  assert.ok(paymentKey(plan.pagamento_key));
  const setup = load('payments-fixture-setup.json'); assertScope(setup); assert.equal(setup.success, true);
  assert.equal(setup.fixture_created_new, true); assert.ok(positiveId(setup.item_container_id));
  const setupPayload = { ...SCOPE, order: setup.order, purchase_item: setup.purchase_item, allocation: setup.allocation };
  assert.equal(imageHash(setupPayload), setup.setup_guard_sha256); assert.equal(setup.setup_guard_sha256, plan.setup_guard_sha256);
  assert.equal(setup.order.proc_compra_id, SCOPE.proc_compra_id); assert.equal(setup.order.cod_proc_fornec, SCOPE.tag);
  assert.equal(setup.purchase_item.item_proc_compra_id, SCOPE.item_proc_compra_id); assert.equal(setup.purchase_item.proc_compra_id, SCOPE.proc_compra_id);
  assert.equal(setup.purchase_item.codigo_erp, SCOPE.synthetic_erp);
  assert.equal(setup.allocation.item_container_id, setup.item_container_id); assert.equal(setup.allocation.container_id, SCOPE.container_id);
  assert.equal(setup.allocation.item_proc_compra_id, SCOPE.item_proc_compra_id);
  assert.deepEqual(setup.order_links, [], 'This bounded scenario creates no order-payment links');
  for (const stage of ['create', 'delete']) {
    assert.ok(Array.isArray(plan.expected_ledger[stage]) && plan.expected_ledger[stage].length === 1, 'One reviewed nonzero type5 per stage');
    const row = plan.expected_ledger[stage][0]; assert.equal(row.cod_tipo_movto, 5);
    assert.equal(row.cod_acao, stage === 'create' ? 1 : 3);
    assert.ok(typeof row.vl_lancto === 'number' && (stage === 'create' ? row.vl_lancto < 0 : row.vl_lancto > 0));
  }
  const evidence = { at: new Date().toISOString(), mode, ...SCOPE, title_id: probe.title_id, checks: [], timings: [] };
  let headers = { 'Content-Type': 'application/json' };
  function receipt(name, phase) {
    const value = load(name); assertScope(value); assert.equal(value.success, true); assert.equal(value.readOnly, true);
    assert.equal(value.phase, phase); assert.ok(!Number.isNaN(Date.parse(value.at)), 'RO capture timestamp required');
    assertBorrowedUnchanged(probe, value); assert.deepEqual(value.order_links, []);
    assert.ok(Array.isArray(value.container_links)); assert.ok(Array.isArray(value.ledger_rows));
    return value;
  }
  function expectedLinks(value, present) {
    if (!present) assert.deepEqual(value.container_links, []);
    else { assert.equal(value.container_links.length, 1); assert.equal(value.container_links[0].container_id, SCOPE.container_id); assert.equal(value.container_links[0].num_id_tit_ap, probe.title_id); }
  }
  async function transport(route, body, expected = 200) {
    const started = Date.now(); let response; let result;
    try { response = await fetch('http://127.0.0.1:8765' + route, { method: body === undefined ? 'GET' : 'POST', headers,
      body: body === undefined ? undefined : JSON.stringify(body), signal: AbortSignal.timeout(120000) }); result = await response.json(); }
    catch { throw new Error('Uncertain transport outcome: do not retry mutation'); }
    if (!route.startsWith('/api/auth/')) evidence.timings.push({ route, status: response.status, elapsedMs: Date.now() - started });
    if (expected !== null) assert.equal(response.status, expected, 'Unexpected HTTP status; inspect state before retry');
    return { status: response.status, body: result };
  }
  const endpoint = operation => '/api/runtime/screens/ciw.container-pagamentos/endpoints/' + operation;
  const context = { container_id: SCOPE.container_id };
  const runtime = async (operation, body, status = 200) => (await transport(endpoint(operation), { ...body, context }, status)).body;
  const record = value => object(value?.data) ? value.data : value;
  async function once(name, invoke, expected = 200) {
    const file = path.join(folder, 'payments-real-attempt-' + name + '.json');
    const fd = fs.openSync(file, 'wx'); const attempt = { at: new Date().toISOString(), ...SCOPE, title_id: probe.title_id, outcome: 'unknown-do-not-retry' };
    fs.writeFileSync(fd, JSON.stringify(attempt, null, 2) + '\n'); fs.closeSync(fd);
    const response = await invoke(); save('payments-real-response-' + name + '.json', response);
    save('payments-real-attempt-' + name + '.json', { ...attempt, receivedAt: new Date().toISOString(), outcome: 'response-received-verify-physical-and-audit', httpStatus: response.status });
    assert.equal(response.status, expected, 'Unexpected mutation status; raw response preserved, never replay');
    return response;
  }
  async function readPayments(present) {
    const rows = await runtime('read', { take: 500 }); assert.ok(Array.isArray(rows.data));
    assert.equal(rows.data.length, present ? 1 : 0);
    if (present) {
      const row = rows.data[0]; assert.equal(row.pagamento_key, plan.pagamento_key); assert.equal(row.num_id_tit_ap, probe.title_id); assert.equal(row.container_id, SCOPE.container_id);
      const detail = record(await runtime('get', { id: plan.pagamento_key })); assert.deepEqual(detail, row);
      assert.equal(row.valor_real, plan.expected_payment.valor_real); assert.equal(row.valor_dolar, plan.expected_payment.valor_dolar);
      assert.equal(row.cod_estab, probe.cod_estab); return row;
    }
    await runtime('get', { id: plan.pagamento_key }, 404); return null;
  }
  const decode = row => ({ ...row, meta: typeof row.metadata === 'string' ? JSON.parse(row.metadata) : row.metadata,
    before: typeof row.before_data === 'string' ? JSON.parse(row.before_data) : row.before_data,
    after: typeof row.after_data === 'string' ? JSON.parse(row.after_data) : row.after_data });
  async function logs(operation) {
    const filters = [{ field: 'audit_screen_id', operator: 'eq', value: 'ciw.container-pagamentos' },
      { field: 'audit_record_id', operator: 'eq', value: plan.pagamento_key }];
    if (operation) filters.push({ field: 'audit_operation', operator: 'eq', value: operation });
    let rows = []; let skip = 0;
    do { const result = (await transport('/api/runtime/screens/admin.logs-transacoes/endpoints/read', { take: 500, skip, filters, sort: [{ field: 'id', dir: 'asc' }] })).body;
      assert.ok(Array.isArray(result.data)); rows.push(...result.data); skip += result.data.length;
      assert.ok(skip <= 5000, 'Bounded fixture logs'); if (skip >= Number(result.total ?? skip) || result.data.length === 0) break;
    } while (true);
    return rows.map(decode);
  }
  async function confirmed(operation) {
    // Record scope includes child creations from BOTH operations. Audit operation
    // filter is reserved for native Logs Exclusao and would hide ledger CREATEs.
    const rows = await logs(); save('payments-real-' + operation + '-logs.json', rows);
    const confirmedEvents = rows.filter(row => row.meta?.audit?.source === 'progress-transaction' && row.meta.audit.available === true);
    const main = confirmedEvents.filter(row => row.meta.audit.resource === 'container_payment_links' && row.meta.audit.operation === operation);
    assert.equal(main.length, 1, 'Exactly one main committed event for this operation'); assertMainAudit(main[0], operation, plan.pagamento_key, probe.title_id);
    assert.ok(positiveId(Number(main[0].transaction_id)), 'Main transaction identity required');
    const events = confirmedEvents.filter(row => String(row.transaction_id) === String(main[0].transaction_id));
    for (const row of events) { assert.equal(row.actor_user_id, 'admin'); assert.equal(row.actor_user_name, 'Administrador'); assert.equal(row.meta.audit.containerId, SCOPE.container_id); assert.equal(row.meta.audit.paymentKey, plan.pagamento_key); }
    if (operation === 'delete') {
      const deletionRows = await logs('delete');
      assert.ok(deletionRows.some(row => String(row.id) === String(main[0].id)), 'Native Logs Exclusao record scope must contain exact deletion');
      save('payments-real-deletion-scope-logs.json', deletionRows);
    }
    const ledgers = events.filter(row => row.meta.audit.resource === 'cta_corren_fornec_imp');
    for (const row of ledgers) {
      assert.equal(row.meta.audit.operation, 'create'); assertAbsentImage(row.before); assertOwnedLedger(row.after, setup.item_container_id, probe.title_id);
      assert.equal(row.after.login, 'admin'); assert.equal(row.after.transacao_id, 0);
    }
    const expected = plan.expected_ledger[operation]; assert.equal(ledgers.length, expected.length);
    const actual = ledgers.map(row => ({ cod_tipo_movto: row.after.cod_tipo_movto, cod_acao: row.after.cod_acao, vl_lancto: row.after.vl_lancto }));
    assert.equal(rowSetHash(actual), rowSetHash(expected), 'Financial values/signs from reviewed central calculation evidence');
    return { main: main[0], ledgers: ledgers.map(row => row.after) };
  }
  async function verifyParent() {
    const screen = (await transport('/api/runtime/screens/ciw.container-pagamentos')).body;
    assert.equal(screen.program.version, '1.0.2'); assert.equal(screen.program.logs.mode, 'deletions'); assert.equal(screen.program.logs.screenId, 'ciw.container-pagamentos');
    const parent = record((await transport('/api/runtime/screens/ciw.container-painel/endpoints/get', { id: SCOPE.container_id, context })).body);
    assert.ok(typeof parent.narrativa === 'string' && parent.narrativa.startsWith(SCOPE.tag));
  }
  // Read credentials only after all local scope/probe/setup/plan gates pass.
  const passwordLine = read(path.join(state, 'acesso-local.txt')).split(/\r?\n/).find(line => line.startsWith('Senha inicial=')); assert.ok(passwordLine);
  const session = (await transport('/api/auth/login', { username: 'admin', password: passwordLine.slice(14), tenantId: 'default', rememberMe: false })).body;
  assert.equal(session.authenticated, true);
  headers = { ...headers, Authorization: 'Bearer ' + session.token, 'X-Runtime-Auth-Token': session.token,
    'X-Runtime-Tenant-Id': session.tenantId, 'X-Runtime-User-Id': String(session.user.id), 'X-Runtime-Session-Id': session.session.sessionId };
  try {
    if (mode !== 'verify-clean') await verifyParent();
    if (mode === 'associate') {
      const before = receipt('payments-physical-before-create.json', 'before-create'); expectedLinks(before, false); assert.deepEqual(before.ledger_rows, []);
      await readPayments(false); const options = await runtime('options.num_id_tit_ap', {});
      assert.ok(options.data.some(row => row.value === probe.title_id), 'Strict candidate must appear in contextual options');
      const result = await once('associate', () => transport(endpoint('create'), { record: { num_id_tit_ap: probe.title_id }, context }, null));
      const row = record(result.body); assert.equal(row.pagamento_key, plan.pagamento_key); assert.equal(row.container_id, SCOPE.container_id); await readPayments(true);
    } else if (mode === 'verify-associated') {
      const physical = receipt('payments-physical-after-create.json', 'after-create'); expectedLinks(physical, true);
      await readPayments(true); const audit = await confirmed('create'); assertExactLedger(audit.ledgers, physical.ledger_rows);
      save('payments-associated-verified.json', { ...SCOPE, success: true, title_id: probe.title_id, pagamento_key: plan.pagamento_key, physical_sha256: imageHash(physical), ledger_rows: audit.ledgers });
    } else if (mode === 'reject-duplicate') {
      const verified = load('payments-associated-verified.json'); assertScope(verified); assert.equal(verified.success, true);
      const physical = receipt('payments-physical-after-create.json', 'after-create'); assert.equal(imageHash(physical), verified.physical_sha256); expectedLinks(physical, true); await readPayments(true);
      const result = await once('reject-duplicate', () => transport(endpoint('create'), { record: { num_id_tit_ap: probe.title_id }, context }, null), 409);
      assert.equal(result.body.error?.code, 'CONTAINER_PAYMENT_EXISTS'); await readPayments(true);
    } else if (mode === 'verify-duplicate') {
      const rejected = load('payments-real-response-reject-duplicate.json'); assert.equal(rejected.status, 409); assert.equal(rejected.body.error?.code, 'CONTAINER_PAYMENT_EXISTS');
      const before = receipt('payments-physical-after-create.json', 'after-create'); const after = receipt('payments-physical-after-duplicate.json', 'after-duplicate');
      expectedLinks(after, true); assert.equal(rowSetHash(after.container_links), rowSetHash(before.container_links)); assertExactLedger(before.ledger_rows, after.ledger_rows);
      await readPayments(true); await confirmed('create'); save('payments-duplicate-verified.json', { ...SCOPE, success: true, physical_sha256: imageHash(after) });
    } else if (mode === 'disassociate') {
      const verified = load('payments-duplicate-verified.json'); assertScope(verified); assert.equal(verified.success, true);
      const before = receipt('payments-physical-after-duplicate.json', 'after-duplicate'); assert.equal(imageHash(before), verified.physical_sha256); expectedLinks(before, true); await readPayments(true);
      await once('disassociate', () => transport(endpoint('delete'), { id: plan.pagamento_key, context }, null)); await readPayments(false);
    } else if (mode === 'verify-disassociated' || mode === 'cleanup-manifest') {
      const after = receipt('payments-physical-after-delete.json', 'after-delete'); expectedLinks(after, false); await readPayments(false);
      const created = await confirmed('create'); const deleted = await confirmed('delete');
      assert.equal(imageHash(created.main.after), imageHash(deleted.main.before), 'Delete snapshot equals created physical link');
      const rows = [...created.ledgers, ...deleted.ledgers]; assertExactLedger(rows, after.ledger_rows);
      const proof = { ...SCOPE, success: true, title_id: probe.title_id, pagamento_key: plan.pagamento_key, physical_sha256: imageHash(after), ledger_rows: rows };
      save('payments-disassociated-verified.json', proof);
      if (mode === 'cleanup-manifest') save('payments-fixture-owned.json', { ...SCOPE, setup_guard_sha256: setup.setup_guard_sha256,
        candidate_probe_sha256: imageHash(probe), item_container_ids: [setup.item_container_id], ledger_rows: rows,
        order_payment_links: [], payment_links: [], verified_after_delete_sha256: imageHash(after), prepared_only: true,
        cleanup_rules: 'Only exact IDs/images; require item API deletion first; never delete or update EMS5 title/value rows; no global title delete' });
    } else if (mode === 'verify-clean') {
      const final = receipt('payments-physical-final.json', 'final-clean'); expectedLinks(final, false); assert.deepEqual(final.ledger_rows, []);
      const zero = ['parent', 'order', 'purchase_item', 'allocation', 'order_payment', 'container_payment', 'ledger_by_purchase',
        'ledger_by_owned_items', 'expense', 'tax_calculation', 'version', 'item_cost_snapshot', 'discount', 'commercial', 'synthetic_cost'];
      for (const key of zero) assert.equal(final.counts[key], 0, 'Residual synthetic data: ' + key);
      const cleanup = load('payments-fixture-cleanup.json'); assertScope(cleanup); assert.equal(cleanup.success, true); assert.equal(cleanup.exact_manifest_cleanup, true);
      const parent = await transport('/api/runtime/screens/ciw.container-painel/endpoints/get', { id: SCOPE.container_id, context }, 404); assert.ok(parent);
      save('payments-final-cleanup-verification.json', { ...SCOPE, readOnly: true, success: true, titleUnchanged: true,
        title_sha256: imageHash(final.title), title_values_sha256: rowSetHash(final.title_values), counts: final.counts, at: new Date().toISOString() });
    } else {
      evidence.current = await runtime('read', { take: 500 }); evidence.logs = await logs();
      evidence.attemptFiles = fs.readdirSync(folder).filter(name => name.startsWith('payments-real-attempt-'));
    }
    evidence.checks.push('reviewed fixed scope; borrowed title unchanged where physical receipt required; no automatic mutation replay');
    save('payments-real-' + mode + '-evidence.json', evidence);
    console.log('PASS prepared payment phase ' + mode + '; private evidence saved.');
  } finally {
    try { await transport('/api/auth/logout', {}); } catch { save('payments-real-logout-unconfirmed.json', { at: new Date().toISOString(), noBusinessRetry: true }); }
    headers = { 'Content-Type': 'application/json' };
  }
}
if (require.main === module) main().catch(error => {
  const mode=/^[a-z-]+$/.test(process.argv[2]||'')?process.argv[2]:'invalid-mode';
  fs.writeFileSync(path.resolve(__dirname,'../../.runtime/container-payments-20261017/payments-real-failure-'+mode+'.json'),JSON.stringify({at:new Date().toISOString(),message:error.message,stack:error.stack,noBusinessRetry:true},null,2)+'\n');
  console.error('FAIL: inspect private receipts/state. Never retry an uncertain mutation. No secrets logged.'); process.exitCode = 1;
});
