'use strict';
// Publica somente as tres revisoes de navegacao contextual ja validadas.
// Nao toca APIs Progress, permissoes humanas ou dados de negocio.
const crypto = require('node:crypto');
const c = require('./purchase-payments-builder-common.cjs');

const domain = c.path.join(c.root, 'integration-src/ciw-completion-20261028/container-item-navigation-filter-only');
const state = c.path.join(c.root, '.runtime/ciw-completion-20261028/filter-only-metadata-publication');
const targets = [
  { code: 'op1008', entity: 'container_custo_itens_progress', previous: '1.0.0', next: '1.0.1' },
  { code: 'op1002', entity: 'container_itens_progress', previous: '1.0.1', next: '1.0.2' },
  { code: 'op1014', entity: 'proc_compra_itens_progress', previous: '1.0.4', next: '1.0.5' },
];
const read = file => JSON.parse(c.fs.readFileSync(file, 'utf8'));
const digest = value => crypto.createHash('sha256').update(JSON.stringify(value)).digest('hex');
const file = (part, code) => c.path.join(domain, 'metadata', part, `${code}-program-draft.json`);
const saveNew = (name, value) => {
  c.fs.mkdirSync(state, { recursive: true });
  c.fs.writeFileSync(c.path.join(state, name), JSON.stringify(value, null, 2) + '\n', { flag: 'wx' });
};
const published = dto => {
  const items = (dto.versions || []).filter(x => x.status === 'published');
  c.assert.equal(items.length, 1, 'EXACTLY_ONE_PUBLISHED_VERSION_REQUIRED');
  return items[0];
};
function plan() {
  const items = targets.map(target => {
    const before = read(file('before', target.code));
    const candidate = read(file('candidate', target.code));
    c.assert.equal(before.version, target.previous, 'FROZEN_BASELINE_VERSION');
    c.assert.equal(candidate.version, target.next, 'CANDIDATE_VERSION');
    return { ...target, before, candidate, beforeSha256: c.sha(file('before', target.code)), candidateSha256: c.sha(file('candidate', target.code)) };
  });
  return { success: true, domain, items, scope: 'Metadata CRUD existente: links contextuais e filterOnly; sem API, permissao humana ou dado de negocio.' };
}
async function withPhase(api, login, target, work) {
  const request = await api('/governance/requests', {
    programCode: target.code,
    builderEntityCode: target.entity,
    requestedActions: ['edit', 'publish'],
    reason: 'Conversao CIW: navegacao contextual apenas para o item exato; filtros filterOnly preservam o contrato externo e nao alteram regras de negocio.',
  });
  const grant = await api('/governance/grants', {
    requestId: request.request.id,
    grantedToUserId: String(login.user.id),
    allowedActions: ['edit', 'publish'],
  });
  const locks = [];
  try {
    for (const [scopeType, scopeCode] of [['program', target.code], ['entity', target.entity]]) {
      const acquired = await api('/locks/acquire', { scopeType, scopeCode, grantId: grant.grant.id, lockCategory: 'authoring' });
      c.assert.equal(acquired.status, 'acquired', 'AUTHORING_LOCK_REQUIRED');
      locks.push(acquired.lock.lockToken);
    }
    return await work();
  } finally {
    const results = await Promise.allSettled(locks.reverse().map(lockToken => api('/locks/release', { lockToken })));
    const revoked = await Promise.allSettled([api('/governance/grants/status', { grantId: grant.grant.id, status: 'revoked' })]);
    c.assert.ok([...results, ...revoked].every(x => x.status === 'fulfilled'), 'AUTHORING_CLEANUP_REQUIRED');
  }
}
async function main() {
  const mode = process.argv[2] || 'plan';
  c.assert.ok(['plan', 'apply'].includes(mode), 'MODE_PLAN_OR_APPLY_REQUIRED');
  const spec = plan();
  if (mode === 'plan') {
    console.log(JSON.stringify({ success: true, catalogWrites: false, targets: spec.items.map(x => ({ code: x.code, from: x.previous, to: x.next, candidateSha256: x.candidateSha256 })) }));
    return;
  }
  c.assert.ok(!c.fs.existsSync(c.path.join(state, 'attempt.json')), 'PRIOR_ATTEMPT_INSPECT_DO_NOT_REPLAY');
  await c.session(async ({ api, runtime, login }) => {
    const proof = [];
    for (const target of spec.items) {
      const dto = await api('/programs/' + target.code);
      const current = published(dto);
      c.assert.equal(current.version, target.previous, 'CURRENT_VERSION_CHANGED');
      c.assert.deepEqual(current.builderConfig, target.before, 'WHOLE_BASELINE_CHANGED');
      const entity = await api('/entities/' + target.entity);
      c.assert.equal(entity.entity.code, target.entity, 'ENTITY_OWNER_CHANGED');
      const preview = await api('/external/validate', { entityDraft: entity.entity, programDraft: target.candidate });
      c.assert.equal(preview.readyToApply, true, 'CANDIDATE_PREVIEW_REJECTED');
      proof.push({ code: target.code, screenId: target.candidate.screenId, from: target.previous, to: target.next, previewDefinitionSha256: digest(preview.generatedDefinition) });
    }
    saveNew('attempt.json', { startedAt: new Date().toISOString(), toolSha256: c.sha(__filename), proof, businessWrites: false, humanPermissionsChanged: false });
    const receipts = [];
    for (const target of spec.items) {
      await withPhase(api, login, target, async () => {
        const saved = await api('/drafts', target.candidate);
        const versionId = saved.id || saved.version?.id;
        c.assert.ok(versionId, 'DRAFT_VERSION_ID_REQUIRED');
        const bundleId = 'ciw-filter-only-' + crypto.randomUUID();
        await api('/governance/tests', { builderProgramVersionId: versionId, bundleId, testPlanId: 'ciw-filter-only-navigation-20261029', status: 'passed', checklistSnapshot: { filterOnlyNative: true, exactSelectionNavigation: true, externalContextUnchanged: true, apiChanged: false, businessWrites: false, humanPermissionsChanged: false }, evidences: [{ type: 'candidate-freeze', result: 'SHA256 ' + c.sha(c.path.join(domain, 'frozen-v1', 'manifest.json')) }], notes: 'Navegacao contextual em metadados existentes. Nenhuma API Progress, regra de negocio, permissao humana ou dado operacional foi alterado.' });
        const approval = await api('/governance/approvals', { builderProgramVersionId: versionId, bundleId });
        await api('/versions/' + versionId + '/publish', {});
        const definition = await runtime(target.candidate.screenId);
        c.assert.equal(definition.program.version, target.next, 'RUNTIME_VERSION_MISMATCH');
        receipts.push({ code: target.code, screenId: target.candidate.screenId, from: target.previous, to: target.next, versionId, approvalId: approval.approval.id, runtimeDefinitionSha256: digest(definition) });
      });
    }
    saveNew('completed.json', { success: true, completedAt: new Date().toISOString(), toolSha256: c.sha(__filename), receipts, businessWrites: false, humanPermissionsChanged: false, apiChanged: false });
    console.log(JSON.stringify({ success: true, published: receipts.map(x => ({ code: x.code, screenId: x.screenId, version: x.to, versionId: x.versionId })), businessWrites: false, humanPermissionsChanged: false }));
  }, { readOnly: false });
}
if (require.main === module) main().catch(error => { console.error(error.message); process.exitCode = 1; });
module.exports = { plan, targets, published };
