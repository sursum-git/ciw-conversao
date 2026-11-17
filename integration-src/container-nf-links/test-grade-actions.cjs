'use strict';

const assert = require('node:assert/strict');
const fs = require('node:fs');
const path = require('node:path');
const vm = require('node:vm');

const filename = process.argv[2] || path.resolve(__dirname, '../../../construtor-pg/src/crud-engine/CrudEngine.js');
const messages = [];
const window = {
    CrudUtils: {
        getDefinitionScreenId: (definition) => definition.screenId,
        confirm: async () => true,
        showMessage: (message, type) => messages.push({ message, type }),
        unwrapError: (error) => error,
    },
};
vm.runInNewContext(fs.readFileSync(filename, 'utf8'), { window, jQuery: {} }, { filename });

const note = { documento: '0000123', serie: '01', estab: '505', nat_operacao: '31201', cod_emitente: 26715 };
const stamp = 'A'.repeat(64);

async function checkAction(screenId, actionId) {
    const requests = [];
    const engine = Object.create(window.CrudEngine.prototype);
    engine.definition = { screenId };
    engine.contextValues = { container_id: 123 };
    let refreshes = 0;
    engine.gridRenderer = {
        getSelectedDataItems: () => [{ toJSON: () => ({ ...note, descricao: 'Not part of the key' }) }],
        clearSelection: () => {},
        refresh: () => refreshes++,
    };
    engine.resolveActionEndpoint = (action) => ({ url: typeof action === 'string' ? action : action.id, method: 'POST' });
    engine.getBulkActionConfirmMessage = () => 'Confirmar';
    engine.updateLastUpdated = () => {};
    engine.handleBackendValidation = () => false;
    engine.httpClient = { request: async (request) => {
        requests.push(request);
        return request.url === 'nfLinkSnapshot' ? { nf_stamp: stamp, data: [] } : { ok: true, audit: { available: true } };
    } };
    await engine.executeBulkAction({ id: actionId });
    assert.equal(requests.length, 2);
    assert.equal(requests[0].url, 'nfLinkSnapshot');
    const payload = JSON.parse(JSON.stringify(requests[1].data));
    assert.deepEqual(payload.context, { container_id: 123 });
    assert.deepEqual(payload.parameters.nfs, [note]);
    assert.equal(payload.parameters.expected_nf_stamp, stamp);
    assert.equal(refreshes, 1);
    assert.equal(engine.nfBulkActionPending, false);

    requests.length = 0;
    engine.nfBulkActionPending = true;
    await engine.executeBulkAction({ id: actionId });
    assert.equal(requests.length, 0, 'concurrent click must not send another write');
    engine.nfBulkActionPending = false;
    engine.httpClient.request = async (request) => {
        requests.push(request);
        return { data: [] };
    };
    await engine.executeBulkAction({ id: actionId });
    assert.equal(requests.length, 1, 'missing stamp must stop before write');
}

(async () => {
    await checkAction('ciw.container-nfs-disponiveis-med', 'associar_nfs');
    await checkAction('ciw.container-nfs', 'desassociar_nfs');
    assert.equal(messages.filter((message) => message.type === 'success').length, 2);
    assert.equal(messages.filter((message) => message.type === 'error').length, 2);
    console.log('PASS: both grid actions preserve the full key and stamp, block concurrent submission and reject missing stamps.');
})().catch((error) => {
    console.error(error);
    process.exitCode = 1;
});
