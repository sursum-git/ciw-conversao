'use strict';

const textFields = { documento: 60, serie: 20, estab: 20, nat_operacao: 60 };

function buildNfSelection(containerId, linkedNotesResponse, selection) {
    if (!Number.isInteger(containerId) || containerId < 1 || containerId > 2147483647) {
        throw new Error('Container inválido.');
    }
    const stamp = linkedNotesResponse?.nf_stamp;
    if (typeof stamp !== 'string' || !/^[a-f0-9]{64}$/i.test(stamp)) {
        throw new Error('Atualize a consulta de NFs vinculadas antes de continuar.');
    }
    if (!Array.isArray(selection) || selection.length < 1 || selection.length > 100) {
        throw new Error('Selecione de 1 a 100 notas fiscais.');
    }

    const seen = new Set();
    const nfs = selection.map((row) => {
        if (!row || (row.container_id !== undefined && Number(row.container_id) !== containerId)) {
            throw new Error('A seleção não corresponde ao container atual.');
        }
        const key = {};
        for (const [field, maximum] of Object.entries(textFields)) {
            const value = row[field];
            if (typeof value !== 'string' || !value.trim() || [...value].length > maximum ||
                /[\x00-\x1f\x7f]/.test(value)) {
                throw new Error('Chave incompleta ou inválida: ' + field);
            }
            key[field] = value;
        }
        if (!Number.isInteger(row.cod_emitente) || row.cod_emitente < 1 || row.cod_emitente > 2147483647) {
            throw new Error('Emitente da nota inválido.');
        }
        key.cod_emitente = row.cod_emitente;
        const identity = JSON.stringify(Object.values(key));
        if (seen.has(identity)) {
            throw new Error('A seleção contém uma nota repetida.');
        }
        seen.add(identity);
        return key;
    });

    return { context: { container_id: containerId }, parameters: { nfs, expected_nf_stamp: stamp } };
}

module.exports = { buildNfSelection };
