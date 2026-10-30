from pathlib import Path
import hashlib,json
r=Path(__file__).resolve().parents[2];s=r/'.runtime/purchase-quantity-periods-20261028'
load=lambda n:json.loads((s/n).read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert load('official-compile-verification.json')['success']
review=load('review-final.json');assert review['status']=='reviewed_no_open_confirmed_P1_P2' and all(x['status']=='corrected_verified'for x in review['findings'])
files=load('canonical-plan.json')['files'];assert len(files)==17
backup=s/'canonical-backup';assert not backup.exists()and not(s/'canonical-manifest.json').exists()
allowed=[Path('D:/opencode/motor-progress/v2'),Path('D:/opencode/construtor-pg')]
for f in files:
 source=Path(f['source']);target=Path(f['target']);assert any(target.is_relative_to(a)for a in allowed)
 assert sha(source)==f['sha256'] and(sha(target)if target.exists()else None)==f['beforeSha256']
backup.mkdir()
for i,f in enumerate(files):
 p=Path(f['target']);old=p.read_bytes()if p.exists()else None
 assert(hashlib.sha256(old).hexdigest()if old is not None else None)==f['beforeSha256']
 saved=backup/(str(i)+'-'+p.name)
 if old is not None:saved.write_bytes(old)
 f['backup']=str(saved)if old is not None else None
 p.parent.mkdir(parents=True,exist_ok=True);p.write_bytes(Path(f['source']).read_bytes());assert sha(p)==f['sha256']
(s/'canonical-manifest.json').write_text(json.dumps(dict(success=True,files=files,businessWrites=False),indent=2)+'\n')
print('PASS17 reviewed canonicals integrated with exact before hashes/backups;no business writes')
