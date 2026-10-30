from pathlib import Path
from collections import Counter
import hashlib, json, xml.etree.ElementTree as ET

root = Path(__file__).resolve().parents[2]
base = root / '.runtime/purchase-quantities-20261027'
read = lambda path: json.loads(path.read_text(encoding='utf-8-sig'))
save = lambda path, value: path.write_text(json.dumps(value, ensure_ascii=False, indent=2) + '\n', encoding='utf-8')
sha = lambda path: hashlib.sha256(path.read_bytes()).hexdigest()
ui = read(base / 'ui-verification.json')
access = read(base / 'access/verified.json')
gate = read(base / 'access/authorization.json')
paging = read(base / 'paging-fix/after-native-paging.json')
assert ui['success'] and ui['embeddedQuantities'] and ui['agentTabClosed'] == 23
assert access['success'] and access['otherPermissionsPreserved'] and access['sessionsVerified'] == 4
assert gate['consumed'] and not gate['authorized']
assert paging['success'] and all(item['equal'] for item in paging['checks'])
assert read(base / 'native-read-proof.json')['success']
assert read(base / 'pasoe-read-proof.json')['success']
assert read(base / 'paging-fix/review-final.json')['success']
tests = ET.parse(base / 'paging-fix/php-full.xml').getroot().find('testsuite')
assert tests.attrib['tests'] == '882' and tests.attrib['assertions'] == '5821'
assert tests.attrib['errors'] == '0' and tests.attrib['failures'] == '0'
for name in ui['screenshots']:
    assert (base / name).stat().st_size > 1000

manifest = read(base / 'canonical-manifest.json')
applied = read(base / 'paging-fix/applied.json')
assert len(manifest['files']) == 11 and len(applied['files']) == 3
for item in manifest['files'] + applied['files']:
    assert sha(Path(item['target'])) == item['sha256'], item['target']
snapshot = base / 'before-paging-canonical-manifest.json'
assert not snapshot.exists()
snapshot.write_bytes((base / 'canonical-manifest.json').read_bytes())
manifest['files'].extend(applied['files'])
manifest['pagingCorrectionReceipt'] = 'paging-fix/applied.json'
manifest['finalCanonicalFiles'] = 14
assert len({item['target'] for item in manifest['files']}) == 14
save(base / 'canonical-manifest.json', manifest)

inventory_path = root / 'integration-src/ciw-inventory/purchase-orders-validation.json'
inventory = read(inventory_path)
entry = inventory['applications']['cons_item_qt_imp']
entry.update(visualValidated=True, state='Convertido e validado readonly — geral MED e contextual', stateGroup='Convertido', remaining='Recorte concluído. Variante union separada; Controles permanece pendência final.')
entry['evidence'] = 'docs/ciw-quantidades-importadas-2026-10-27.md; acesso exato2reads, UI LDAP, paginação/filtro/sort no servidor, PHP882/5821, ABL150x4.'
validation = inventory['importQuantitiesReadonlyValidation']
validation.update(status='COMPLETED_READONLY', phpTests=882, phpAssertions=5821, humanPermissionsApplied=True, uiAccessPending=False, visualValidated=True, readAuthorizationConsumed=True, serverPagingValidated=True, canonicalFinalFiles=14)
validation['appliedReadPermissions'] = access['addedOnly']
save(inventory_path, inventory)

catalog_path = root / 'integration-src/ciw-inventory/inventory-reviewed.json'
catalog = read(catalog_path)
entries = [item for item in catalog['entries'] if item['name'] == 'cons_item_qt_imp']
assert len(entries) == 1
entries[0].update(state=entry['state'], state_group='Convertido', remaining=entry['remaining'], evidence=entry['evidence'])
catalog['counts']['state_group'] = dict(Counter(item['state_group'] for item in catalog['entries']))
save(catalog_path, catalog)

plan_path = root / 'docs/superpowers/plans/2026-10-27-ciw-purchase-quantities.md'
plan = plan_path.read_text(encoding='utf-8')
plan = plan.replace('- [ ] Aplicar acesso somente se autorizado, validar UI e fechar abas temporárias.', '- [x] Aplicar somente as duas consultas autorizadas, validar UI e fechar abas temporárias.')
old_status = plan.index('Estado27/10:')
plan = plan[:old_status] + ('Estado27/10: COMPLETED_READONLY. Duas leituras autorizadas pela resposta humana call_6d07d6bfc8cd4ad9881727e7711fba2f e aplicadas somente para tadeu.parreiras; quatro sessões LDAP/integridade/demais acessos conferidos, gate consumido. UI geral/contextual/detalhe/aba/links validada; abas usuário1/2 preservadas e agente23 encerrada. Correção adicional de transporte PHP registra as duas entidades no leitor tipado e valida contexto das linhas: paginação/filtro/sort reproduzidos RED e aprovados depois contra PASOE; revisão semP1/P2, PHP882/5821. Quatorze canônicos finais porhash/backup. Metadados e ABL não republicados durante correção. Quatro memórias/inventário atualizados. Não repetir concessões/publicadores/compilação. Union permanece separado; Controles pendência final.\n')
plan_path.write_text(plan, encoding='utf-8')

block = (root / 'integration-src/purchase-quantities/FINAL_CONTEXT_UPDATE.md').read_bytes().rstrip() + b'\n\n'
start = b'<!-- BEGIN CIW_PURCHASE_QUANTITIES_20261027 -->'
end = b'<!-- END CIW_PURCHASE_QUANTITIES_20261027 -->'
targets = [root / 'context/RETOMADA_2026-10-16.md', root / 'context/PROJECT_CONTEXT.md', Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'), Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md')]
backup = base / 'memory-final-backup'
assert not backup.exists()
prepared = []
for path in targets:
    old = path.read_bytes()
    assert old.count(start) == 1 and old.count(end) == 1
    a, z = old.index(start), old.index(end) + len(end)
    while z < len(old) and old[z:z+1] in (b'\r', b'\n'):
        z += 1
    prepared.append((path, old, old[:a] + block + old[z:]))
backup.mkdir()
receipts = []
for i, (path, old, new) in enumerate(prepared):
    saved = backup / (str(i) + '-' + path.name)
    saved.write_bytes(old)
    assert path.read_bytes() == old
    path.write_bytes(new)
    receipts.append(dict(path=str(path), sha256=sha(path), backup=str(saved)))
save(base / 'memory-final-update.json', dict(success=True, files=receipts))

for name in ['ACTIVE_WORK.json', 'final-verification.json']:
    path = base / name
    value = read(path)
    saved = base / ('before-final-' + name)
    assert not saved.exists()
    saved.write_bytes(path.read_bytes())
    value.update(status='COMPLETED_READONLY', phpTests=882, phpAssertions=5821, canonicalFiles=14, canonicalFinalFiles=14, humanPermissionsApplied=True, permissionsApplied=True, uiAccessPending=False, uiChildAccessPending=False, pagingFixPending=False, serverPagingValidated=True, readAuthorizationConsumed=True, uiGlobalVisible=True, uiParentValidated=True, uiContextValidated=True, agentTabClosed=True, originalUserTabsPreserved=[1,2], requiredAuthorizations=[], fourMemoriesUpdated=True, businessWrites=False, schemaApplied=False)
    value['appliedReadPermissions'] = access['addedOnly']
    save(path, value)
with (base / 'progress.md').open('a', encoding='utf-8') as stream:
    stream.write('\nCOMPLETED_READONLY: exact2read humanapproval call_6d07d6bfc8cd4ad9881727e7711fba2f applied and verified4LDAPsessions, otheraccess preserved, gate consumed. UI global/context/detail/parent11thtab/items/allocations GREEN, agent23closed user1/2preserved. Found serverpagination enrollment missing in PHP; RED 3real cases, fixed2closed registrations+contextassert, reviewednoP1/P2, PHP882/5821, native3comparisons/data+total GREEN, noABL/metapublish replay. Final14canonicalhashes,4memories andinventory updated. No business/schemawrites. Controlesfinal,unionseparate.\n')
print('PASS COMPLETED_READONLY:14 canonical hashes,882/5821 PHP,2 exact reads verified,UI verified,four memories updated; no business writes')
