"""Integrate19 reviewed sources with exact baselines and backups; no business writes."""
from pathlib import Path
import hashlib,json,shutil
root=Path(__file__).resolve().parents[2];build=root/'.runtime/ciw-completion-20261028/official-build7'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()if p.is_file()else None
assert not(build/'canonical-manifest.json').exists(),'Inspect previous integration before replay'
assert sha(build/'manager-release.json')=='808eb7c78d84e675da77d4dd700f983784676401379660ae082fe762345fc6b1'
review=load(build/'manager-release.json');assert review['success']and review['findingsP1']==review['findingsP2']==0
for item in review['pinned']:assert sha(build/item['path'])==item['sha256']
proof=load(build/'official-compile-verification.json');assert proof['success']and proof['totalChecks']==4120
items=load(build/'integration-plan.json')['files'];assert len(items)==19
for item in items:
 assert sha(Path(item['candidate']))==item['candidateSha256']
 assert sha(Path(item['target']))==item['baselineSha256'],'Concurrent change: '+item['target']
backup=build/'canonical-backup';backup.mkdir();written=[]
for i,item in enumerate(items):
 if item['baselineSha256']is not None:shutil.copy2(Path(item['target']),backup/(str(i)+'-'+Path(item['target']).name))
try:
 for item in items:
  target=Path(item['target']);assert sha(target)==item['baselineSha256']
  target.parent.mkdir(parents=True,exist_ok=True);shutil.copyfile(Path(item['candidate']),target)
  assert sha(target)==item['candidateSha256'];written.append(item)
except Exception:
 for item in reversed(written):
  target=Path(item['target'])
  if sha(target)==item['candidateSha256']:
   if item['baselineSha256']is None:target.unlink()
   else:shutil.copy2(backup/(str(items.index(item))+'-'+target.name),target)
 raise
(build/'canonical-manifest.json').write_text(json.dumps(dict(success=True,files=[dict(target=item['target'],before=item['baselineSha256'],sha256=item['candidateSha256'],source=item['candidate'])for item in items],businessWrites=False,runtimePublished=False,metadataPublished=False),indent=2)+'\n')
print('PASS19canonical sources integrated/hash/backups;runtime25 and readonly metadata pending')
