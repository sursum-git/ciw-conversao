"""Install reviewed official6-v2 sources only, with exact baselines/backups."""
from pathlib import Path
import hashlib,json,shutil
r=Path(__file__).resolve().parents[2];b=r/'.runtime/ciw-completion-20261028/official-build6-v2';load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()if p.is_file()else None
assert not(b/'canonical-manifest.json').exists(),'Already integrated; inspect before replay'
proof=load(b/'official-compile-verification.json');assert proof['success']and proof['totalChecks']==3616
review=load(b/'manager-review-final.json');assert review['success']and review['remainingP1P2']==[]and sha(b/'integration-plan.json')==review['integrationPlanSha256']
xml=(b/'review/php-full.xml').read_text();assert 'tests="885" assertions="5841" errors="0" failures="0" skipped="0"'in xml
items=load(b/'integration-plan.json')['files'];assert len(items)==15
for x in items:
 assert sha(Path(x['candidate']))==x['candidateSha256'];assert sha(Path(x['target']))==x['baselineSha256'],'Concurrent change '+x['target']
backup=b/'canonical-backup';backup.mkdir();written=[]
for i,x in enumerate(items):
 if x['baselineSha256']is not None:shutil.copy2(Path(x['target']),backup/(str(i)+'-'+Path(x['target']).name))
try:
 for x in items:
  p=Path(x['target']);assert sha(p)==x['baselineSha256'];p.parent.mkdir(parents=True,exist_ok=True);shutil.copyfile(Path(x['candidate']),p);assert sha(p)==x['candidateSha256'];written.append(x)
except Exception:
 for x in reversed(written):
  p=Path(x['target'])
  if sha(p)==x['candidateSha256']:
   if x['baselineSha256']is None:p.unlink()
   else:shutil.copy2(backup/(str(items.index(x))+'-'+p.name),p)
 raise
(b/'canonical-manifest.json').write_text(json.dumps(dict(success=True,files=[dict(target=x['target'],before=x['baselineSha256'],sha256=x['candidateSha256'],source=x['candidate'])for x in items],businessWrites=False,runtimePublished=False,metadataPublished=False),indent=2)+'\n')
print('PASS15reviewed canonical sources integrated/hash/backups; coherent runtime publication pending')
