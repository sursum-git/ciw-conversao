'use strict';
// Pure guards only: importing the harness must never read credentials or use HTTP.
const test = require('node:test');
const assert = require('node:assert/strict');
const h = require('./exercise-container-payments.cjs');
const scope = { container_id: 2147000102, proc_compra_id: 2147000300, item_proc_compra_id: 2147000301,
  tag: 'SC_TEST_PAGTOS_20261017', synthetic_erp: 'ZTSC171027' };
test('fixed scope accepts only the new payment fixture', () => {
  h.assertScope(scope);
  for (const [key, value] of Object.entries(scope)) {
    assert.throws(() => h.assertScope({ ...scope, [key]: typeof value === 'number' ? value - 1 : value + 'x' }));
  }
});
test('physical image equality ignores property order, preserves JSON type and case', () => {
  assert.equal(h.imageHash({ b: 1, a: { z: null, s: 'Ab' } }), h.imageHash({ a: { s: 'Ab', z: null }, b: 1 }));
  assert.notEqual(h.imageHash({ a: 1 }), h.imageHash({ a: '1' }));
  assert.notEqual(h.imageHash({ a: 'Ab' }), h.imageHash({ a: 'ab' }));
  assert.notEqual(h.imageHash({ a: null }), h.imageHash({}));
});
test('unordered title value rows compare by canonical contents, retaining duplicates', () => {
  assert.equal(h.rowSetHash([{ a: 1 }, { a: 2 }]), h.rowSetHash([{ a: 2 }, { a: 1 }]));
  assert.notEqual(h.rowSetHash([{ a: 1 }, { a: 1 }]), h.rowSetHash([{ a: 1 }]));
});
test('borrowed title requires global uniqueness and no prior container/order links or ledger', () => {
  const probe = { success: true, readOnly: true, title_id: 7, title_matches: 1, cod_estab: '505',
    title: { num_id_tit_ap: 7, cod_estab: '505' }, title_values: [{ vl: 5 }],
    container_links: [], order_links: [], ledger_rows: [] };
  h.assertCandidateProbe(probe);
  for (const key of ['container_links', 'order_links', 'ledger_rows']) assert.throws(() => h.assertCandidateProbe({ ...probe, [key]: [{}] }));
  assert.throws(() => h.assertCandidateProbe({ ...probe, title_matches: 2 }));
  assert.throws(() => h.assertCandidateProbe({ ...probe, readOnly: false }));
  assert.throws(() => h.assertCandidateProbe({ ...probe, title: { num_id_tit_ap: 8, cod_estab: '505' } }));
});
test('borrowed physical data remains identical across every phase', () => {
  const baseline = { title_id: 7, cod_estab: '505', title_matches: 1,
    title: { num_id_tit_ap: 7, cod_estab: '505', vl: null }, title_values: [{ id: 1, vl: 5 }] };
  h.assertBorrowedUnchanged(baseline, { ...baseline, title: { vl: null, cod_estab: '505', num_id_tit_ap: 7 } });
  assert.throws(() => h.assertBorrowedUnchanged(baseline, { ...baseline, title_values: [{ id: 1, vl: 6 }] }));
  assert.throws(() => h.assertBorrowedUnchanged(baseline, { ...baseline, title_matches: 2 }));
});

test('both approved titles and the untouched reference title stay exact in every phase', () => {
  const make=id=>({title_id:id,cod_estab:'505',title_matches:1,title:{num_id_tit_ap:id,cod_estab:'505'},title_values:[{vl:5}],container_links:[],order_links:[],ledger_rows:[]});
  const baseline={...make(7),approved_title_snapshots:[make(7),make(8)]};
  h.assertBorrowedUnchanged(baseline,structuredClone(baseline));
  for(const change of [v=>v.approved_title_snapshots[1].title_values[0].vl=6,
    v=>v.approved_title_snapshots.pop(),v=>v.approved_title_snapshots.push(make(8)),
    v=>v.approved_title_snapshots[1].ledger_rows.push({id:1}),
    v=>v.approved_title_snapshots[1].container_links.push({container_id:2147000102})]){
    const actual=structuredClone(baseline);change(actual);assert.throws(()=>h.assertBorrowedUnchanged(baseline,actual));
  }
});

test('pre-delete physical image requires exact marker, all fields and unchanged values',()=>{
  const row={item_container_id:22,container_id:scope.container_id,item_proc_compra_id:scope.item_proc_compra_id,observacao:scope.tag,qt_alocada:2};
  h.assertFixtureImage(row,{...row,descricao_item:'derived'},'allocation');
  for(const altered of [{...row,observacao:scope.tag+'x'},{...row,qt_alocada:3},{...row,item_proc_compra_id:123}])assert.throws(()=>h.assertFixtureImage(row,altered,'allocation'));
  const missing={...row};delete missing.qt_alocada;assert.throws(()=>h.assertFixtureImage(row,missing,'allocation'));
  const parent={container_id:scope.container_id,narrativa:scope.tag,cod_estabel:'505',cod_emit_forn:9};
  h.assertFixtureImage(parent,{...parent},'parent');assert.throws(()=>h.assertFixtureImage(parent,{...parent,narrativa:scope.tag+'external'},'parent'));
});
test('cleanup ownership accepts only exact new ledger rows on synthetic allocation/purchase', () => {
  const row = { cta_corren_fornec_imp_id: 901, container_id: scope.container_id, item_container_id: 22,
    item_proc_compra_id: scope.item_proc_compra_id, num_id_tit_ap: 7, cod_tipo_movto: 5, vl_lancto: -5 };
  h.assertOwnedLedger(row, 22, 7);
  for (const override of [{ container_id: 332526 }, { item_container_id: 23 }, { item_proc_compra_id: 10 },
    { num_id_tit_ap: 8 }, { cod_tipo_movto: 4 }, { cta_corren_fornec_imp_id: 0 }]) assert.throws(() => h.assertOwnedLedger({ ...row, ...override }, 22, 7));
});
test('cleanup manifest IDs and snapshots are exact, no unmatched or missing ledger allowed', () => {
  const row = { cta_corren_fornec_imp_id: 901, item_container_id: 22, item_proc_compra_id: scope.item_proc_compra_id,
    num_id_tit_ap: 7, cod_tipo_movto: 5, vl_lancto: -5 };
  h.assertExactLedger([row], [{ ...row }]);
  assert.throws(() => h.assertExactLedger([row], []));
  assert.throws(() => h.assertExactLedger([], [row]));
  assert.throws(() => h.assertExactLedger([row], [{ ...row, vl_lancto: -6 }]));
  assert.throws(() => h.assertExactLedger([row], [row, row]));
});
test('logs must identify the authenticated actor and exact opaque payment key', () => {
  const key = 'p_' + 'A'.repeat(64);
  const row = { actor_user_id: 'admin', actor_user_name: 'Administrador',
    meta: { audit: { available: true, source: 'progress-transaction', containerId: scope.container_id,
      resource: 'container_payment_links', recordId: key, paymentKey: key, operation: 'delete' } },
    before: { container_id: scope.container_id, pagamento_key: key, num_id_tit_ap: 7 }, after: {} };
  h.assertMainAudit(row, 'delete', key, 7);
  h.assertMainAudit({...row,after:[]},'delete',key,7); // PHP persists an absent associative image as []
  assert.throws(() => h.assertMainAudit({ ...row, actor_user_id: 'other' }, 'delete', key, 7));
  assert.throws(() => h.assertMainAudit({ ...row, after: { container_id: scope.container_id } }, 'delete', key, 7));
  assert.throws(() => h.assertMainAudit(row, 'delete', 'p_' + 'B'.repeat(64), 7));
});
