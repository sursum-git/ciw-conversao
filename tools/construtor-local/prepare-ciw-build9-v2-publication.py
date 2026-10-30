"""Prepare coherent four-artifact deployment after official23/1080 and exact integration."""
from pathlib import Path
import json,hashlib
R=Path(__file__).resolve().parents[2];B=R/'.runtime/ciw-completion-20261028/official-build9-v2';D=R/'.runtime/ciw-completion-20261028/runtime-build9-v2'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert not (D/'publication-manifest.json').exists()
proof=load(B/'official-compile-verification.json');canonical=load(B/'canonical-manifest.json');before=load(D/'runtime-before.json')
assert proof['success'] and proof['version']=='12.2' and proof['compileCount']==23 and proof['totalChecks']==1080 and len(proof['files'])==4
assert canonical['success'] and len(canonical['files'])==4 and before['success'] and before['mountConfirmed']
assert before['transportBean']=='OewebTransportManager' and before['medWebTransport']=={'isTransportEnabled':True} and before['imaWebTransport']=={'isTransportEnabled':True}
for x in canonical['files']:assert sha(Path(x['target']))==x['sha256']
wrapper=load(R/'.runtime/container-commands-publish-20261016/active-manifest.json')['artifacts']
service=load(R/'.runtime/container-payments-publish-20261017/active-manifest.json')['artifacts']
prior={**wrapper,**service}
stage='/tmp/ciw-completion-20261028-wave6';targets={};uploads=[]
for x in proof['files']:
 assert sha(R/x['source'])==x['sha256']
 rel=x['relative'];old=before['targets'][rel]['before'];assert old==prior[rel]
 if rel.endswith('.p'):
  record=next(f for f in canonical['files'] if f['target'].replace('\\','/').endswith('/'+rel));assert old==record['before']
 targets[rel]=dict(file=x['file'],sha256=x['sha256'],before=old)
 uploads.append(dict(local=x['source'],remote=stage+'/'+x['file']))
manifest=dict(success=True,targets=targets,transportBean='OewebTransportManager',medWebEnabledBefore=True,imaWebEnabledBefore=True,businessWrites=False,routesChanged=False)
(D/'publication-manifest.json').write_text(json.dumps(manifest,indent=2)+'\n')
source=(R/'tools/construtor-local/prepare-ciw-completion-build8-publication.py').read_text()
script=source.split("script='''",1)[1].split("'''.replace('STAGE'",1)[0]
script=script.replace('STAGE',repr(stage))
script=script.replace("proof['totalChecks']==4664","proof['totalChecks']==1080")
script=script.replace('len(approved)==19','len(approved)==4').replace("'targets':19","'targets':4")
start=script.index('priority=[');end=script.index('\ndef priorityKey',start)
script=script[:start]+"priority=['ContainersPainelFinanceReadService','ContainersPainelFinanceRead']"+script[end:]
old="assert len(order)==19 and [Path(x).stem for x in order[-2:]]==['CiwCadastrosCrud','CiwCadastrosCrud']"
assert old in script
script=script.replace(old,"assert len(order)==4 and [Path(x).stem for x in order[-2:]]==['ContainersPainelFinanceRead','ContainersPainelFinanceRead']")
script=script.replace('completion-wave5-tmp','completion-wave6-tmp').replace('PASS19official','PASS4official')
assert '==19' not in script and '4664' not in script
(D/'publish-runtime.py').write_text(script)
for name in ['publication-manifest.json','publish-runtime.py']:uploads.append(dict(local=str((D/name).relative_to(R)),remote=stage+'/'+name))
uploads.append(dict(local=str((B/'official-compile-verification.json').relative_to(R)),remote=stage+'/official-compile-verification.json'))
plan=dict(server='runtime',uploads=uploads,commands=['python3 '+stage+'/publish-runtime.py'],downloads=[dict(local=str((D/name).relative_to(R)),remote=stage+'/'+name) for name in ['active-manifest.json','publication-attempt.json']])
(D/'publish-plan.json').write_text(json.dumps(plan,indent=2)+'\n')
print('Prepared four official artifacts; coherent MED pause/drain/backup/replace/refresh/restore; IMA unchanged')
