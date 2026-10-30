from pathlib import Path
import hashlib, json

root = Path(__file__).resolve().parents[2]
base = root / '.runtime/purchase-quantities-20261027/paging-fix'
digest = lambda data: hashlib.sha256(data).hexdigest()
assert json.loads((base / 'review-final.json').read_text())['success']
plan = json.loads((base / 'canonical-plan.json').read_text())['files']
test = root / 'integration-src/purchase-quantities/tests/RuntimePurchaseQuantitiesQueryTest.php'
target = Path('D:/opencode/construtor-pg/backend/tests/Runtime/RuntimePurchaseQuantitiesQueryTest.php')
plan.append(dict(source=str(test), target=str(target), beforeSha256=None, sha256=digest(test.read_bytes())))
backup = base / 'applied-backup'
assert not backup.exists() and not (base / 'applied.json').exists()
for item in plan:
    source, target = Path(item['source']), Path(item['target'])
    assert target.is_relative_to(Path('D:/opencode/construtor-pg/backend'))
    assert digest(source.read_bytes()) == item['sha256']
    assert (digest(target.read_bytes()) if target.exists() else None) == item['beforeSha256']
backup.mkdir()
for i, item in enumerate(plan):
    source, target = Path(item['source']), Path(item['target'])
    old = target.read_bytes() if target.exists() else None
    assert (digest(old) if old is not None else None) == item['beforeSha256']
    if old is not None:
        saved = backup / (str(i) + '-' + target.name)
        saved.write_bytes(old)
        item['backup'] = str(saved)
    else:
        item['backup'] = None
    target.write_bytes(source.read_bytes())
    assert digest(target.read_bytes()) == item['sha256']
(base / 'applied.json').write_text(json.dumps(dict(success=True, files=plan, businessWrites=False, grants=False), indent=2) + '\n')
print('PASS exact two PHP transport files and one regression test; prior bytes backed up and hashes verified')
