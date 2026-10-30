"""Prepare fresh bounded descending-PK companion; never execute prior probe."""
from pathlib import Path
import hashlib
import json

ROOT=Path(__file__).resolve().parents[1]
OLD=ROOT/'.runtime/ciw-completion-20261028/attachment-identity-readonly-probe'
OUT=OLD/'recent-v1.1'
OUT.mkdir(exist_ok=False)
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert sha(OLD/'manifest.json')=='90b81c2b9a8a2d553ab0915e22d5c8bb34061236449ec4578c309b86ab667d84'
oldmanifest=json.loads((OLD/'manifest.json').read_text())
for entry in oldmanifest['files']:assert sha(OLD/entry['path'])==entry['sha256']
source=(OLD/'AttachmentIdentityReadonlyProbe.p').read_bytes()
old=b'FOR EACH bLedger FIELDS(container_id anexo_container_id caminho_arquivo) NO-LOCK:'
new=b'FOR EACH bLedger FIELDS(container_id anexo_container_id caminho_arquivo) NO-LOCK BY bLedger.anexo_container_id DESCENDING:'
assert source.count(old)==1
(OUT/'AttachmentIdentityReadonlyProbe.p').write_bytes(source.replace(old,new,1))
(OUT/'Compile.p').write_bytes((OLD/'Compile.p').read_bytes())
oldremote='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-attachment-identity-ro-v1'
remote='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-attachment-identity-recent-ro-v1_1'
ps=(OLD/'RunProbe122.ps1').read_bytes()
assert ps.count(oldremote.encode())==1
(OUT/'RunProbe122.ps1').write_bytes(ps.replace(oldremote.encode(),remote.encode(),1))
plan=json.loads((OLD/'remote-execution-plan.json').read_text())
plan['directories']=[remote]
local=OUT.relative_to(ROOT).as_posix()
for entry in plan['uploads']:
    name=entry['remote'].rsplit('/',1)[1];entry.update(local=local+'/'+name,remote=remote+'/'+name)
for entry in plan['downloads']:
    name=entry['remote'].rsplit('/',1)[1];entry.update(local=local+'/results/'+name,remote=remote+'/'+name)
plan['commands']=[plan['commands'][0].replace(oldremote,remote)]
(OUT/'remote-execution-plan.json').write_text(json.dumps(plan,indent=2)+'\n',encoding='utf-8')
manifest={**oldmanifest,'status':'PREPARED_RECENT_COMPANION_NOT_EXECUTED',
          'previousProbe':'Original49935 completed5oldreferences; all5physical files absent, rootmatchtrue; preserved.',
          'delta':'Only descending physical attachment PK order; Compile.p byteidentical; PowerShell freshstaging guard only.',
          'order':'anexo_container_id DESCENDING', 'maximumPairs':5,'scanCap':50000,'timeoutSeconds':10,
          'sourceBaselineSha256':sha(OLD/'AttachmentIdentityReadonlyProbe.p'),
          'files':[{'path':name,'sha256':sha(OUT/name)} for name in ['AttachmentIdentityReadonlyProbe.p','Compile.p','RunProbe122.ps1','remote-execution-plan.json']]}
(OUT/'manifest.json').write_text(json.dumps(manifest,indent=2)+'\n',encoding='utf-8')
assert (OUT/'AttachmentIdentityReadonlyProbe.p').read_bytes().replace(new,old,1)==source
print(json.dumps({'prepared':True,'manifestSha256':sha(OUT/'manifest.json'),'remotePlanSha256':sha(OUT/'remote-execution-plan.json'),'sourceSha256':sha(OUT/'AttachmentIdentityReadonlyProbe.p')}))
