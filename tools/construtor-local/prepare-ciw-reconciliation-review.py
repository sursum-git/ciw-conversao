"""Prepare a guarded five-origin proposal. This tool cannot apply the global inventory."""
import copy
import hashlib
import json
from collections import Counter
from pathlib import Path

ROOT = Path('D:/opencode/conversao-sc')
STATE = ROOT / '.runtime/ciw-completion-20261028'
INVENTORY = ROOT / 'integration-src/ciw-inventory/inventory-reviewed.json'
read = lambda p: json.loads(p.read_text(encoding='utf-8-sig'))
sha = lambda p: hashlib.sha256(p.read_bytes()).hexdigest()
proposal = read(STATE / 'reconciliation-proposal.json')
before = read(INVENTORY)
assert sha(INVENTORY) == proposal['inventoryBaselineSha256'], 'Global inventory changed; re-review required'
assert proposal['proposalCount'] == len(proposal['proposals']) == 5
assert len(before['entries']) == len({e['name'] for e in before['entries']}) == 262
after = copy.deepcopy(before)
entries = {e['name']: e for e in after['entries']}
expected = {'bl_sincronizar_impostos', 'cons_tit_ap_associados_container', 'cons_tit_ap_associar_container', 'cons_tit_ap_associar_container_apos_di', 'grid_itens_container'}
assert {p['application'] for p in proposal['proposals']} == expected
checks = []
for p in proposal['proposals']:
    entry = entries[p['application']]
    assert (entry['state_group'], entry['remaining']) == (p['baselineState'], p['baselineRemaining'])
    for evidence in p['evidence']:
        path = ROOT / evidence['path']
        assert evidence['exists'] and path.is_file() and sha(path) == evidence['sha256'], evidence['path']
    entry['remaining'] = p['proposedRemaining']
    if p['application'] == 'bl_sincronizar_impostos':
        catalog = p['catalog']
        assert len(catalog) == 1 and catalog[0]['code'] == 'op1017' and catalog[0]['publishedVersion'] == '1.0.0'
        assert entry['state_group'] == 'Preparado'
        entry.update(state='Convertido — comando fiscal central publicado e validado', state_group='Convertido',
                     target_screen='ciw.container-sincronizar-impostos', target_version='1.0.0',
                     evidence='docs/painel-container-comandos.md; fonte ativa sincronizarImpostos e menu_container; op1017/1.0.0 publicado. Recibos privados referenciados em .runtime/ciw-completion-20261028/reconciliation-proposal.json; cenário16/10 concluído e limpo, sem reexecução.')
    checks.append({'application': p['application'], 'evidenceFilesChecked': len(p['evidence']), 'rootSemanticReviewStillRequired': True})
after['counts']['state_group'] = dict(Counter(e['state_group'] for e in after['entries']))

def changes(a, b, path=''):
    if a == b:
        return []
    if isinstance(a, dict) and isinstance(b, dict):
        assert a.keys() == b.keys(), path
        return sum((changes(a[k], b[k], path + '/' + k) for k in a), [])
    if isinstance(a, list) and isinstance(b, list):
        assert len(a) == len(b), path
        return sum((changes(x, y, path + '/' + str(i)) for i, (x, y) in enumerate(zip(a, b))), [])
    return [{'path': path, 'before': a, 'after': b}]

delta = changes(before, after)
changed_origins = set()
for op in delta:
    parts = op['path'].split('/')
    if parts[1] == 'counts':
        assert parts[2:] in (['state_group', 'Convertido'], ['state_group', 'Preparado'])
        continue
    assert parts[1] == 'entries' and len(parts) == 4
    name = before['entries'][int(parts[2])]['name']
    changed_origins.add(name)
    assert name in expected
    allowed = {'state', 'state_group', 'remaining', 'target_screen', 'target_version', 'evidence'} if name == 'bl_sincronizar_impostos' else {'remaining'}
    assert parts[3] in allowed
assert changed_origins == expected
assert after['counts']['state_group']['Convertido'] == 62 and after['counts']['state_group']['Preparado'] == 8
assert before['execution_scope'] == after['execution_scope'] and after['functional_audit_complete'] is False
candidate = STATE / 'inventory-reconciliation-5-candidate.json'
candidate.write_text(json.dumps(after, ensure_ascii=False, indent=2) + '\n', encoding='utf-8')
guard = {'success': True, 'status': 'PREPARED_ROOT_REVIEW_REQUIRED_NOT_APPLIED',
         'inventoryBaselineSha256': sha(INVENTORY), 'proposalSha256': sha(STATE / 'reconciliation-proposal.json'),
         'candidatePath': str(candidate), 'candidateSha256': sha(candidate),
         'allowedChangedOrigins': sorted(expected), 'unchangedOrigins': 257, 'delta': delta, 'evidenceChecks': checks,
         'countsProposed': after['counts']['state_group'], 'fourRemainingOnlyStateGroupsPreserved': True,
         'globalInventoryChanged': False, 'completionClaim': False,
         'rootGates': ['Conferir semanticamente evento ativo sincronizarImpostos, recibos16/10 e op1017 no catalogo atual antes de aplicar.',
                       'Reconferir baseline e candidate SHA imediatamente antes da escrita feita pelo root.',
                       'Preservar lacunas de lote/aposDI/acoes proprias nos quatro remaining corrigidos.',
                       'Nao executar negocio, grants, compilacao ou publicacao para repetir provas historicas.']}
(STATE / 'inventory-reconciliation-5-guard.json').write_text(json.dumps(guard, ensure_ascii=False, indent=2) + '\n', encoding='utf-8')
assert sha(INVENTORY) == proposal['inventoryBaselineSha256']
print(json.dumps({'success': True, 'candidateSha256': sha(candidate), 'changedOrigins': 5, 'unchangedOrigins': 257, 'deltaPaths': len(delta), 'rootReviewPending': True, 'applied': False}))
