"""Replace exactly one reviewed service source with guard and backup."""
from pathlib import Path
import json,hashlib,os
R=Path(__file__).resolve().parents[2];B=R/'.runtime/ciw-completion-20261028/official-build10'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
proof=json.loads((B/'official-compile-verification.json').read_text());assert proof['success'] and proof['totalChecks']==1160 and proof['compileCount']==8
target=Path('D:/opencode/motor-progress/v2/sursum-api/programs/ContainersPainelFinanceReadService.p');source=B/'package/sursum-api/programs/ContainersPainelFinanceReadService.p'
before='09678e8fabe46c2fd35ea3bf814e587765490135533a034822236da2ed5c37cf';after='d7990991fd7e1d7675927c8cc4a0ecde7a4ffa8e2368e08b04b3f8361d1d238a'
assert sha(target)==before and sha(source)==after and not target.is_symlink()
receipt=B/'canonical-manifest.json';backup=B/'canonical-before-service.p';attempt=B/'canonical-attempt.json'
assert not receipt.exists() and not backup.exists() and not attempt.exists()
backup.write_bytes(target.read_bytes());attempt.write_text(json.dumps(dict(state='STARTED',target=str(target),before=before,after=after),indent=2)+'\n')
temp=target.with_name(target.name+'.ciw-build10-tmp');assert not temp.exists()
with temp.open('xb') as stream:stream.write(source.read_bytes())
assert sha(temp)==after and sha(target)==before;os.replace(temp,target);assert sha(target)==after
receipt.write_text(json.dumps(dict(success=True,files=[dict(target=str(target),before=before,sha256=after,source=str(source),backup=str(backup))],officialProofSha256=sha(B/'official-compile-verification.json'),businessWrites=False,metadataPublished=False),indent=2)+'\n')
attempt.write_text(json.dumps(dict(state='COMPLETED',target=str(target)),indent=2)+'\n')
print('PASS one canonical Service source integrated with exact baseline and backup')
