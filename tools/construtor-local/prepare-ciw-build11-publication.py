"""Prepare the coherent four-artifact 1055 publication after official7/384."""
from pathlib import Path
import json,hashlib
r=Path(__file__).resolve().parents[2];b=r/'.runtime/ciw-completion-20261028/official-build11';d=r/'.runtime/ciw-completion-20261028/runtime-build11'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
proof=load(b/'official-compile-verification.json');canonical=load(b/'canonical-manifest.json');before=load(d/'runtime-before.json')
assert proof['success'] and proof['version']=='12.2' and proof['totalChecks']==384 and len(proof['files'])==4
assert canonical['success'] and len(canonical['files'])==5 and before['success'] and before['mountConfirmed']
assert before['transportBean']=='OewebTransportManager' and before['medWebTransport']=={'isTransportEnabled':True} and before['imaWebTransport']=={'isTransportEnabled':True}
assert not (d/'publication-manifest.json').exists()
for row in canonical['files']:assert sha(Path(row['target']))==row['sha256']
old=load(r/'.runtime/ciw-completion-20261028/official-build8/active-manifest.json')['targets']
stage='/tmp/ciw-completion-20261028-wave8';targets={};uploads=[]
for row in proof['files']:
 rel=row['relative'];assert before['targets'][rel]['before']==old[rel]['sha256']
 assert sha(r/row['source'])==row['sha256']
 if rel.endswith('.p'):
  saved=[x for x in canonical['files']if Path(x['target']).name==row['file']];assert len(saved)==1 and saved[0]['before']==before['targets'][rel]['before']
 targets[rel]=dict(file=row['file'],sha256=row['sha256'],before=before['targets'][rel]['before']);uploads.append(dict(local=row['source'],remote=stage+'/'+row['file']))
(d/'publication-manifest.json').write_text(json.dumps(dict(success=True,targets=targets,transportBean='OewebTransportManager',medWebEnabledBefore=True,imaWebEnabledBefore=True,businessWrites=False,routesChanged=False),indent=2)+'\n')
original=r/'.runtime/ciw-completion-20261028/runtime-build9-v2/publish-runtime.py';assert sha(original)=='6943fcbbeae99aae0ee808a80bf1249aa6a06a6467c3053e15bd87b915f00b51'
script=original.read_text().replace('wave6','wave8').replace("proof['totalChecks']==1080","proof['totalChecks']==384")
script=script.replace("priority=['ContainersPainelFinanceReadService','ContainersPainelFinanceRead']","priority=['CiwErpReadService','CiwCadastrosCrud']")
script=script.replace("['ContainersPainelFinanceRead','ContainersPainelFinanceRead']","['CiwCadastrosCrud','CiwCadastrosCrud']")
assert 'ContainersPainelFinance'not in script and '1080'not in script
(d/'publish-runtime.py').write_text(script)
for name in ['publication-manifest.json','publish-runtime.py']:uploads.append(dict(local=str((d/name).relative_to(r)),remote=stage+'/'+name))
uploads.append(dict(local=str((b/'official-compile-verification.json').relative_to(r)),remote=stage+'/official-compile-verification.json'))
(d/'publish-plan.json').write_text(json.dumps(dict(server='runtime',uploads=uploads,commands=['python3 '+stage+'/publish-runtime.py'],downloads=[dict(local=str((d/name).relative_to(r)),remote=stage+'/'+name)for name in ['active-manifest.json','publication-attempt.json']]),indent=2)+'\n')
print('Prepared exactly four1055 artifacts; coherent MED pause/restore/rollback; no route or other instance changes')
