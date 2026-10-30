from pathlib import Path
import hashlib, json
root = Path(__file__).resolve().parents[2]
base = root / '.runtime/purchase-quantity-periods-20261028'
load = lambda p: json.loads(p.read_text(encoding='utf-8-sig'))
save = lambda p, v: p.write_text(json.dumps(v, ensure_ascii=False, indent=2) + '\n', encoding='utf-8')
proof = load(root / '.runtime/purchase-quantities-20261027/paging-fix/after-native-paging.json')
assert proof['success'] and all(row['equal'] for row in proof['checks'])
save(base / 'existing-query-read-verification.json', proof)
backup = base / 'memory-backup'
assert not backup.exists()
backup.mkdir()
block = (root / 'integration-src/purchase-quantity-periods/CONTEXT_UPDATE.md').read_bytes().rstrip() + b'\n\n'
marker = b'<!-- BEGIN CIW_PURCHASE_QUANTITY_PERIODS_20261028 -->'
targets = [root / 'context/RETOMADA_2026-10-16.md', root / 'context/PROJECT_CONTEXT.md', Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'), Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md')]
prepared = []
for path in targets:
    old = path.read_bytes()
    assert marker not in old
    prepared.append((path, old, block + old))
receipt = []
for index, (path, old, new) in enumerate(prepared):
    saved = backup / (str(index) + '-' + path.name)
    saved.write_bytes(old)
    assert path.read_bytes() == old
    path.write_bytes(new)
    receipt.append(dict(path=str(path), sha256=hashlib.sha256(new).hexdigest(), backup=str(saved)))

path = root / 'integration-src/ciw-inventory/purchase-orders-validation.json'
inventory = load(path)
assert 'cons_item_qt_imp_union' not in inventory['applications']
inventory['applications']['cons_item_qt_imp_union'] = dict(state='Analisado — decisão sobre limite final da previsão pendente', stateGroup='Pendente', runtimeReadValidated=False, visualValidated=False, converted=False, businessWrites=False, sourceFilterProducerFound=True, sourceFilterProducer='cons_item_qt_imp_union_grid.class.php:590-643', remaining='Aguardar escolha sobre prazo também no limite final do período; preservar UNION e fallback de exibição distinto. Depois adaptar coleta compartilhada, testar, compilar12.2 e publicar. Controles permanece final.', evidence='docs/ciw-quantidades-por-periodo-2026-10-28.md')
save(path, inventory)
path = root / 'integration-src/ciw-inventory/inventory-reviewed.json'
catalog = load(path)
entries = [item for item in catalog['entries'] if item['name'] == 'cons_item_qt_imp_union']
assert len(entries) == 1
entry = entries[0]
entry['state'] = inventory['applications']['cons_item_qt_imp_union']['state']
entry['remaining'] = inventory['applications']['cons_item_qt_imp_union']['remaining']
entry['evidence'] = inventory['applications']['cons_item_qt_imp_union']['evidence']
assert entry['state_group'] == 'Pendente'
save(path, catalog)
state = load(base / 'ACTIVE_WORK.json')
state['fourMemoriesUpdated'] = True
state['existingQueryRevalidated'] = True
state['humanDecisionPending'] = True
save(base / 'ACTIVE_WORK.json', state)
save(base / 'memory-update.json', dict(success=True, files=receipt, productSourcesChanged=False, permissionsChanged=False, businessWrites=False))
print('PASS four memories/inventory: analysis only, date rule pending; existing queries revalidated; no new publication, grants or business writes')
