"""Prepare only Service.p/r after official1160; preserve wrapper and every other file."""
from pathlib import Path
import json,hashlib
R=Path(__file__).resolve().parents[2];B=R/'.runtime/ciw-completion-20261028/official-build10-v2';D=R/'.runtime/ciw-completion-20261028/runtime-build10'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
proof=load(B/'official-compile-verification.json');canonical=load(B/'canonical-manifest.json');before=load(D/'runtime-before.json')
assert proof['success'] and proof['version']=='12.2' and proof['compileCount']==8 and proof['totalChecks']==1160 and len(proof['files'])==2
assert canonical['success'] and len(canonical['files'])==1 and before['success'] and before['mountConfirmed']
assert before['transportBean']=='OewebTransportManager' and before['medWebTransport']=={'isTransportEnabled':True} and before['imaWebTransport']=={'isTransportEnabled':True}
assert not (D/'publication-manifest.json').exists()
for row in canonical['files']:assert sha(Path(row['target']))==row['sha256']
prior=load(R/'.runtime/ciw-completion-20261028/runtime-build9-v2/active-manifest.json')['targets']
stage='/tmp/ciw-completion-20261028-wave7';targets={};uploads=[]
for row in proof['files']:
 rel=row['relative'];assert rel in ['sursum-api/programs/ContainersPainelFinanceReadService.p','sursum-api/programs/ContainersPainelFinanceReadService.r']
 assert sha(R/row['source'])==row['sha256'] and before['targets'][rel]['before']==prior[rel]['sha256']
 if rel.endswith('.p'):assert before['targets'][rel]['before']==canonical['files'][0]['before']
 targets[rel]=dict(file=row['file'],sha256=row['sha256'],before=before['targets'][rel]['before']);uploads.append(dict(local=row['source'],remote=stage+'/'+row['file']))
(D/'publication-manifest.json').write_text(json.dumps(dict(success=True,targets=targets,transportBean='OewebTransportManager',medWebEnabledBefore=True,imaWebEnabledBefore=True,businessWrites=False,routesChanged=False),indent=2)+'\n')
original=R/'.runtime/ciw-completion-20261028/runtime-build9-v2/publish-runtime.py';assert sha(original)=='6943fcbbeae99aae0ee808a80bf1249aa6a06a6467c3053e15bd87b915f00b51'
script=original.read_text().replace('wave6','wave7').replace("proof['totalChecks']==1080","proof['totalChecks']==1160").replace('len(approved)==4','len(approved)==2').replace("'targets':4","'targets':2")
script=script.replace("priority=['ContainersPainelFinanceReadService','ContainersPainelFinanceRead']","priority=['ContainersPainelFinanceReadService']")
script=script.replace("assert len(order)==4 and [Path(x).stem for x in order[-2:]]==['ContainersPainelFinanceRead','ContainersPainelFinanceRead']","assert len(order)==2 and [Path(x).stem for x in order]==['ContainersPainelFinanceReadService','ContainersPainelFinanceReadService']")
script=script.replace('PASS4official','PASS2official')
assert 'len(approved)==4' not in script and '1080' not in script
(D/'publish-runtime.py').write_text(script)
for name in ['publication-manifest.json','publish-runtime.py']:uploads.append(dict(local=str((D/name).relative_to(R)),remote=stage+'/'+name))
uploads.append(dict(local=str((B/'official-compile-verification.json').relative_to(R)),remote=stage+'/official-compile-verification.json'))
(D/'publish-plan.json').write_text(json.dumps(dict(server='runtime',uploads=uploads,commands=['python3 '+stage+'/publish-runtime.py'],downloads=[dict(local=str((D/name).relative_to(R)),remote=stage+'/'+name) for name in ['active-manifest.json','publication-attempt.json']]),indent=2)+'\n')
print('Prepared exactly Service.p/r; MED coherent pause/restore and rollback, no other program/config')
