"""Prepare remaining/evidence updates from existing receipts; never edit inventory."""
from pathlib import Path
import hashlib
import json

ROOT = Path('D:/opencode/conversao-sc')
STATE = ROOT / '.runtime/ciw-completion-20261028'
PROOF = STATE / 'cadastros-queries'
sha = lambda path: hashlib.sha256(Path(path).read_bytes()).hexdigest()
inventory = ROOT / 'integration-src/ciw-inventory/inventory-reviewed.json'
data = json.loads(inventory.read_text(encoding='utf-8-sig'))
validation = json.loads((PROOF / 'filter-validation.json').read_text())
publication = json.loads((PROOF / 'metadata-publication.json').read_text())
ui = json.loads((PROOF / 'ui-verification.json').read_text())
assert validation['success'] and publication['success'] and ui['success']
assert ui['newFiltersVisibleAllFive'] and not ui['businessWrites']
assert publication['entitiesUnchanged'] and publication['otherProgramsUnchanged']
assert publication['gridFormsWritersLogsUnchanged']
entries = []
for row in validation['screens']:
    old = next(x for x in data['entries'] if x['name'] == row['legacySource'])
    live = next(x for x in publication['screens'] if x['code'] == row['code'])
    assert live['published'] and live['version'] == row['version'] == '1.0.1'
    assert row['legacyColumnsPreserved'] and row['nativeJsValidated'] and row['get'] and row['paging']
    files = [p for p in (ROOT / 'sources/scriptcase').rglob('*.php') if p.parent.name == row['legacySource']]
    matching = [p for p in files if sha(p) == row['legacySourceSha256']]
    assert matching, row['legacySource']
    remaining = (
        f"Consulta absorvida na tela {row['screenId']}/1.0.1 publicada: colunas preservadas, "
        "read/get/paginacao e filtros textuais validados no runtime; filtro visivel na sessao LDAP. "
        "Nao repetir a correcao de filtros nem o CRUD ja comprovado. Ainda confrontar as acoes e "
        "navegacao especificas da origem e o escopo dos recursos genericos de grade/exportacao antes "
        "de declarar equivalencia integral; esta evidencia nao promove a origem para Convertido."
    )
    if row['legacySource'] == 'cons_im_param':
        remaining += " Codigo teve resultado positivo na UI; Valor teve teste negativo, sem positivo comprovado."
    entries.append({
        'application': row['legacySource'],
        'preserve': {k: old.get(k) for k in ('state_group', 'target_screen', 'target_version')},
        'remainingBefore': old['remaining'], 'remainingProposed': remaining,
        'evidenceAppendProposed': (
            'Correcao metadata-only em cinco telas1.0.1: delta apenas filtros/version; '
            'source118/entidades/outrosprogramas preservados no recibo dessa publicacao. '
            'Ver cadastros-queries/{metadata-publication,filter-validation,ui-verification}.json. '
            'Sem writer, negocio ou permissao humana nova; nao confundir contagem historica118 com sourcecadastros atual144.'
        ),
        'sourceMatched': [{'path': str(p.relative_to(ROOT)), 'sha256': sha(p)} for p in matching],
        'publishedVersionObservedInReceipt': live['version'],
    })
proposal = {
    'status': 'PROPOSAL_NOT_APPLIED', 'scope': 'remaining/evidence only',
    'inventoryBaselineSha256': sha(inventory), 'applicationCount': len(data['entries']),
    'entries': entries,
    'proofs': [{'path': str(PROOF / name), 'sha256': sha(PROOF / name)} for name in (
        'metadata-publication.json', 'filter-validation.json', 'ui-verification.json')],
    'statesTargetsCountsPreserved': True, 'convertedPromotions': 0,
    'inventoryChanged': False, 'networkExecuted': False,
}
path = STATE / 'cadastro-query-reconciliation-proposal.json'
path.write_text(json.dumps(proposal, ensure_ascii=False, indent=2) + '\n', encoding='utf-8')
print(json.dumps({'success': True, 'entries': len(entries), 'sha256': sha(path), 'inventoryChanged': False}))
