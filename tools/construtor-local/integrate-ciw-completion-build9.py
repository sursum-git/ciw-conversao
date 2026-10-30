"""Guarded four-file integration, new helper before shared caller, exact backups."""
from pathlib import Path
import json,hashlib,os
R=Path(__file__).resolve().parents[2];B=R/'.runtime/ciw-completion-20261028/official-build9'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest() if p.is_file() else None
assert sha(B/'release.json')=='f0921a0d398cc3e69ff2bc2874fd6179277e7d7b23d183eaccc90e69192dbc86'
assert sha(B/'integration-plan.json')=='bc69edbbed5fd6a5b462567347719312bcf79d033e57751a4cf4a7d116107ccf'
proof=load(B/'official-compile-verification.json');assert proof['success'] and proof['version']=='12.2' and proof['totalChecks']==1080
for row in proof['files']:assert sha(R/row['source'])==row['sha256']
plan=load(B/'integration-plan.json');assert len(plan['files'])==4
attempt=B/'canonical-attempt.json';receipt=B/'canonical-manifest.json'
assert not attempt.exists() and not receipt.exists()
for row in plan['files']:
 target=Path(row['target']);source=Path(row['source'])
 assert not target.is_symlink() and sha(target)==row['baselineSha256'] and sha(source)==row['candidateSha256']
 assert str(target).replace('\\','/').startswith(('D:/opencode/motor-progress/v2/sursum-api/programs/','D:/opencode/construtor-pg/backend/src/Runtime/'))
backup=B/'canonical-before';assert not backup.exists();backup.mkdir()
files=[]
for i,row in enumerate(plan['files']):
 target=Path(row['target']);saved=backup/str(i)
 if target.exists():saved.write_bytes(target.read_bytes())
 files.append(dict(target=str(target),before=row['baselineSha256'],sha256=row['candidateSha256'],source=row['source'],backup=str(saved) if saved.exists() else None))
attempt.write_text(json.dumps(dict(state='STARTED',files=files),indent=2)+'\n')
written=[]
try:
 ordered=sorted(files,key=lambda f: 0 if f['before'] is None else 2 if Path(f['target']).name=='RuntimeApiEntityActionService.php' else 1)
 for row in ordered:
  target=Path(row['target']);temp=target.with_name(target.name+'.ciw-build9-tmp')
  assert not temp.exists() and sha(target)==row['before']
  with temp.open('xb') as stream:stream.write(Path(row['source']).read_bytes())
  assert sha(temp)==row['sha256'];os.replace(temp,target);written.append(row)
 for row in files:assert sha(Path(row['target']))==row['sha256']
except Exception:
 for row in reversed(written):
  target=Path(row['target'])
  if sha(target)==row['sha256']:
   if row['backup'] is None:target.unlink()
   else:target.write_bytes(Path(row['backup']).read_bytes())
 raise
receipt.write_text(json.dumps(dict(success=True,files=files,officialProofSha256=sha(B/'official-compile-verification.json'),businessWrites=False,metadataPublished=False),indent=2)+'\n')
attempt.write_text(json.dumps(dict(state='COMPLETED',files=files),indent=2)+'\n')
print('PASS four canonical exact copies with backups; metadata/runtime publication separate')
