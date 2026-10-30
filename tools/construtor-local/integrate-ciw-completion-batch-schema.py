"""Install only the reviewed closed editing.snapshot JSON schema contract."""
from pathlib import Path
import hashlib,json,shutil
r=Path(__file__).resolve().parents[2];p=r/'integration-src/ciw-completion-20261028/native-batch-snapshot-schema';s=r/'.runtime/ciw-completion-20261028/native-batch-snapshot-schema'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert not(s/'canonical-manifest.json').exists();m=load(p/'manifest.json');target=Path(m['target']);assert sha(p/'manifest.json')=='c8a4caedec3d809d427f698546d6fb0850ac88d36fb880fa4594de804c5f0a98'
for f in m['files']:assert sha(p/f['path'])==f['sha256']
assert load(s/'verification.json')['checks']==14 and load(s/'manager-review-final.json')['success']
assert sha(target)==m['baselineSha256'] and sha(p/'crud-definition-v1.schema.json')==m['candidateSha256']
before=load(target);after=load(p/'crud-definition-v1.schema.json');restored=json.loads(json.dumps(after));restored['$defs']['grid']['properties']['editing']=before['$defs']['grid']['properties']['editing'];assert restored==before,'Unrelated schema change'
shutil.copy2(target,s/'canonical-schema-before.json');shutil.copyfile(p/'crud-definition-v1.schema.json',target);assert sha(target)==m['candidateSha256']
(s/'canonical-manifest.json').write_text(json.dumps(dict(success=True,target=str(target),before=m['baselineSha256'],sha256=sha(target),onlyEditingSnapshotChanged=True,ajvChecks=14,businessWrites=False,examplesUnchanged=True),indent=2)+'\n')
print('PASS closed snapshot JSONSchema integrated;14AJVchecks;only editing schema changed; no business writes')
