const assert = require('node:assert/strict');
const fs = require('node:fs');
const path = require('node:path');

const root = path.resolve(__dirname, '..', '..');
const inventory = JSON.parse(fs.readFileSync(path.join(root, 'integration-src', 'ciw-inventory', 'inventory-reviewed.json'), 'utf8'));
const legacy = fs.readFileSync(path.join(root, 'sources', 'scriptcase', 'ciw-completion-next20-20261028', 'cons_tit_ap_associados_pedido', 'cons_tit_ap_associados_pedido_grid.class.php'), 'utf8');
const legacyAvailable = fs.readFileSync(path.join(root, 'sources', 'scriptcase', 'ciw-completion-next20-20261028', 'cons_tit_ap_associar_pedido', 'cons_tit_ap_associar_pedido_grid.class.php'), 'utf8');
const service = fs.readFileSync('D:/opencode/motor-progress/v2/sursum-api/programs/PurchasePaymentsService.p', 'utf8');
const entry = inventory.entries.find(({ name }) => name === 'cons_tit_ap_associados_pedido');
const availableEntry = inventory.entries.find(({ name }) => name === 'cons_tit_ap_associar_pedido');

assert.ok(entry, 'origem legada ausente do inventário');
assert.match(legacy, /log_tit_ap_estordo\s*=\s*0/i, 'legado deve restringir títulos não estornados');
assert.match(legacy, /substr\(ind_tip_espec_docto,1,8\)\s*=\s*'antecipa'/i, 'legado deve restringir títulos antecipados');
assert.match(service, /log_tit_ap_estordo=FALSE/i, 'serviço publicado deve recusar título estornado');
assert.match(service, /SUBSTRING\(ind_tip_espec_docto,1,8\).*'antecipa'/i, 'serviço publicado deve restringir títulos antecipados');
assert.equal(entry.state_group, 'Convertido', 'inventário deve registrar o fluxo absorvido como convertido');
assert.equal(entry.target_screen, 'ciw.proc-compra-pagamentos', 'inventário deve apontar para a tela publicada de pagamentos');
assert.ok(availableEntry, 'seletor legado ausente do inventário');
assert.match(legacyAvailable, /num_id_tit_ap not in/i, 'seletor legado deve excluir títulos já vinculados');
assert.match(legacyAvailable, /log_tit_ap_estordo\s*=\s*0/i, 'seletor legado deve restringir títulos não estornados');
assert.match(service, /NOT Found\(phLinks.*num_id_tit_ap/i, 'serviço publicado deve excluir título já vinculado');
assert.equal(availableEntry.state_group, 'Convertido', 'inventário deve registrar o seletor absorvido como convertido');
assert.equal(availableEntry.target_screen, 'ciw.proc-compra-pagamentos', 'seletor deve apontar para a tela publicada de pagamentos');
console.log('PASS: cons_tit_ap_associados_pedido está coberta pela tela publicada de pagamentos.');
