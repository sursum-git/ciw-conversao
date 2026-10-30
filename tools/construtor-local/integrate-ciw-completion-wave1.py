"""Install reviewed wave1 sources with exact hash guards and backups."""
from pathlib import Path
import hashlib,json,shutil
r=Path(__file__).resolve().parents[2];b=r/'.runtime/ciw-completion-20261028/official-build3';php=r/'.runtime/ciw-completion-20261028/backend-package5'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest() if p.is_file() else None
assert not(b/'canonical-manifest.json').exists(),'Already integrated; inspect before replay'
proof=load(b/'official-compile-verification.json');assert proof['success'] and proof['totalChecks']==1536
assert 'tests="885" assertions="5841"' in (php/'php-full.xml').read_text() and 'failures="0"' in (php/'php-full.xml').read_text()
for path in [r/'.runtime/ciw-completion-20261028/container-fiscal-readonly/manager-review-final.json',r/'.runtime/ciw-completion-20261028/container-version-history/manager-review-final-v1.3.json']:assert load(path)['remainingP1P2']==[]
items=[];baselines={x['target'].replace('\\','/'):x['sha256'] for x in load(b/'build-manifest.json')['baselines']}
for f in proof['files']:
 if f['relative'].endswith('.r'):continue
 target=Path('D:/opencode/motor-progress/v2')/f['relative']
 items.append(dict(source=r/f['source'],target=target,before=baselines.get(str(target).replace('\\','/')),after=f['sha256']))
for f in load(php/'manifest.json')['files']:
 items.append(dict(source=Path(f['candidate']),target=Path(f['target']),before=f['baselineSha256'],after=f['candidateSha256']))
meta=Path('D:/opencode/construtor-pg/integrations/ciw-completion-20261028-wave1')
for pkg,folder,names in [('container-fiscal-readonly','fiscal',['op1033-builder-draft.json','op1034-builder-draft.json','api-source-additions.json']),('container-version-history/frozen-v1.3','history',['history-builder-draft.json','api-source-additions.json','parent-patch.json'])]:
 for name in names:
  source=r/'integration-src/ciw-completion-20261028'/pkg/'metadata'/name
  items.append(dict(source=source,target=meta/folder/name,before=None,after=sha(source)))
for f in items:assert sha(f['source'])==f['after'] and sha(f['target'])==f['before'],'Source/baseline diverged '+str(f['target'])
backup=b/'canonical-backup';backup.mkdir();receipts=[]
for i,f in enumerate(items):
 if f['before'] is not None:shutil.copy2(f['target'],backup/(str(i)+'-'+f['target'].name))
for f in items:
 assert sha(f['target'])==f['before'];f['target'].parent.mkdir(parents=True,exist_ok=True);shutil.copyfile(f['source'],f['target']);assert sha(f['target'])==f['after']
 receipts.append(dict(target=str(f['target']),before=f['before'],sha256=f['after'],source=str(f['source'])))
(b/'canonical-manifest.json').write_text(json.dumps(dict(success=True,files=receipts,businessWrites=False,metadataPublished=False,runtimePublished=False),indent=2)+'\n')
print('PASS canonical integration:8ABL/include+2PHP+6metadata; backups and hashes verified; runtime publication pending')
