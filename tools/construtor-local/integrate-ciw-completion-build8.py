"""Hash-guarded canonical byte copies after official12.2 verification; exact backups."""
from pathlib import Path
import hashlib,json,shutil,os
R=Path(__file__).resolve().parents[2];B=R/'.runtime/ciw-completion-20261028/official-build8'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
releaseSha='8ec63cbce134d78555896dda56522140e0d781d6418b0ba92dfff5831a9b0a85'
assert sha(B/'manager-release.json')==releaseSha
proof=load(B/'official-compile-verification.json');assert proof['success']and proof['managerReleaseSha256']==releaseSha and proof['compileEntries']==74 and proof['testLogs']==84 and proof['totalChecks']==4664
for entry in load(B/'manager-release.json')['pinned']:assert sha(B/entry['path'])==entry['sha256']
plans=[('canonical','integration-plan.json'),('example','example-integration-plan.json')]
rows=[(kind,item)for kind,name in plans for item in load(B/name)['files']]
assert len(rows)==29
receipt=B/'canonical-manifest.json';assert not receipt.exists()and not(B/'canonical-attempt.json').exists(),'Inspect partial or completed integration; no replay'
for kind,item in rows:
 target=Path(item['target']);assert any(target.is_relative_to(Path(p))for p in ['D:/opencode/motor-progress/v2','D:/opencode/construtor-pg'])
 assert not any(part in('.git','kendo')for part in target.parts)
 assert sha(Path(item['candidate']))==item['candidateSha256']
 if item['baselineSha256']is None:assert not target.exists()
 else:assert sha(target)==item['baselineSha256']
backup=B/'canonical-backup';backup.mkdir()
(B/'canonical-attempt.json').write_text(json.dumps(dict(started=True,managerReleaseSha256=releaseSha,targets=29,officialProofSha256=sha(B/'official-compile-verification.json')),indent=2)+'\n')
done=[]
for index,(kind,item)in enumerate(rows):
 target=Path(item['target']);old=item['baselineSha256'];assert (not target.exists())if old is None else sha(target)==old
 if old is not None:shutil.copy2(target,backup/(str(index)+'-'+target.name))
 target.parent.mkdir(parents=True,exist_ok=True)
 temp=target.with_name(target.name+'.ciw-build8-tmp');assert not temp.exists();temp.write_bytes(Path(item['candidate']).read_bytes());assert sha(temp)==item['candidateSha256'];os.replace(temp,target)
 assert sha(target)==item['candidateSha256']
 done.append(dict(kind=kind,target=str(target),before=old,sha256=sha(target),source=item['candidate']))
 receipt.write_text(json.dumps(dict(success=False,managerReleaseSha256=releaseSha,files=done),indent=2)+'\n')
receipt.write_text(json.dumps(dict(success=True,managerReleaseSha256=releaseSha,productionSourceFiles=24,separateExampleFiles=5,files=done,businessWrites=False,humanGrants=False,runtimePublished=False),indent=2)+'\n')
print('PASS integrated24canonical+5examples with exacthashes/backups; runtime not yet published')
