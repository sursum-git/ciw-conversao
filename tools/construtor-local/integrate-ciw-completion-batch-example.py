"""Install reviewed native opt-in example and parity matrix, preserving baseline."""
from pathlib import Path
import hashlib,json,shutil
r=Path(__file__).resolve().parents[2];p=r/'integration-src/ciw-completion-20261028/native-batch-snapshot-example';s=r/'.runtime/ciw-completion-20261028/native-batch-snapshot-example';target=Path('D:/opencode/construtor-pg')
sha=lambda x:hashlib.sha256(x.read_bytes()).hexdigest() if x.is_file() else None
load=lambda x:json.loads(x.read_text(encoding='utf-8-sig'))
assert not(s/'canonical-manifest.json').exists();m=load(p/'manifest.json');review=load(s/'manager-review-final.json');assert review['success'] and sha(p/'manifest.json')==review['manifestSha256']
assert load(s/'verification.json')['checks']==12
items=[]
for x in m['files']:
 assert sha(p/x['path'])==x['sha256']
 if x['path'].startswith('patches/'):continue
 before=m['matrixBaseline']['sha256'] if x['path']=='docs/paridade-demo-producao.md' else None
 assert sha(target/x['path'])==before;items.append((x,before))
assert len(items)==5
backup=s/'canonical-backup';backup.mkdir()
for x,before in items:
 if before:shutil.copy2(target/x['path'],backup/Path(x['path']).name)
for x,before in items:
 dest=target/x['path'];assert sha(dest)==before;dest.parent.mkdir(parents=True,exist_ok=True);shutil.copyfile(p/x['path'],dest);assert sha(dest)==x['sha256']
out=dict(success=True,files=[dict(target=str(target/x['path']),before=before,sha256=x['sha256'])for x,before in items],sharedRenderer=True,productionMocks=False,businessWrites=False,skillMissing='construtor-pg-demo-production-parity',parityChecklistExecuted=True,commercialScenario1042Pending=True)
(s/'canonical-manifest.json').write_text(json.dumps(out,indent=2)+'\n')
print('PASS5native example/documentation files, hashes/backups/paritymatrix; no production mock or business API execution')
