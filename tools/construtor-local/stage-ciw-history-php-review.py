"""Independent exact-byte review stage for frozen history PHP, no canonical edits."""
from pathlib import Path
import hashlib, json
root=Path('D:/opencode/conversao-sc')
candidate=root/'integration-src/ciw-completion-20261028/container-version-history/frozen-v1.3'
stage=root/'.runtime/ciw-completion-20261028/history-php-review-v1.3'
stage.mkdir(exist_ok=False)
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
manifest=json.loads((candidate/'manifest.json').read_text(encoding='utf-8-sig'))
for item in manifest['files']: assert sha(candidate/item['path'])==item['sha256']
proof=[]
for baseline in json.loads((candidate/'baselines.json').read_text())['baselines']:
    if not baseline['target'].endswith('.php'): continue
    source=Path(baseline['target']); assert sha(source)==baseline['baselineSha256']
    value=source.read_bytes().decode('utf-8-sig')
    lines=(candidate/baseline['patch']).read_bytes().decode('utf-8-sig').splitlines(keepends=True)
    n=0
    while n<len(lines):
        if not lines[n].startswith('@@ '): n+=1;continue
        n+=1;old=[];new=[]
        while n<len(lines) and not lines[n].startswith('@@ '):
            line=lines[n]
            if line.startswith(' '): old.append(line[1:]);new.append(line[1:])
            elif line.startswith('-'): old.append(line[1:])
            elif line.startswith('+'): new.append(line[1:])
            elif line.startswith('\\ No newline'): pass
            else: raise AssertionError('unexpected patch line '+repr(line))
            n+=1
        before=''.join(old);after=''.join(new)
        assert value.count(before)==1,source.name
        value=value.replace(before,after,1)
    target=stage/source.name;target.write_bytes(value.encode('utf-8'))
    assert sha(target)==baseline['candidateSha256'],source.name
    proof.append({'file':source.name,'candidateSha256':sha(target),'baselineVerified':True})
(stage/'verification.json').write_text(json.dumps({'state':'EXACT_FROZEN_PHP_RECONSTRUCTED','files':proof,'canonicalChanged':False},indent=2)+'\n')
print(json.dumps({'stage':str(stage),'files':len(proof)}))
