"""Prepare bounded read-only remote hashes for approved build5 artifacts and route."""
from pathlib import Path
import json
r=Path(__file__).resolve().parents[2];b=r/'.runtime/ciw-completion-20261028/official-build5-v6';stage='/tmp/ciw-completion-20261028-wave2'
m=json.loads((b/'official-compile-verification.json').read_text());assert m['success'] and len(m['files'])==16
rels=[x['relative'] for x in m['files']]+['conf-web-handler/program-routes.json']
script='''from pathlib import Path
import json,hashlib,subprocess
root=Path('/mnt/datasul/ERP/sursum');stage=Path(STAGE)
mount=subprocess.check_output(['findmnt','-n','-o','SOURCE','-T',str(root)],universal_newlines=True).strip()
assert '192.168.0.137' in mount
rels=RELS
targets={rel:{'before':hashlib.sha256((root/rel).read_bytes()).hexdigest() if (root/rel).is_file() else None}for rel in rels}
routes=json.loads((root/'conf-web-handler/program-routes.json').read_text())
assert isinstance(routes.get('routes'),list)
assert not any(x['route']=='/SursumPrograms/containers-despesas-lote' for x in routes['routes'])
(stage/'runtime-before.json').write_text(json.dumps({'success':True,'mountConfirmed':True,'targets':targets},indent=2))
(stage/'runtime-routes-before.json').write_text(json.dumps({'topKeys':sorted(routes),'routes':[{'keys':sorted(x),'route':x.get('route'),'method':x.get('method'),'program':x.get('program')}for x in routes['routes']]},indent=2))
print('PASS inspected16runtimeartifacts and additive route baseline; no runtime mutation')
'''.replace('STAGE',repr(stage)).replace('RELS',repr(rels))
(b/'inspect-runtime.py').write_text(script)
plan=dict(server='runtime',directories=[stage],uploads=[dict(local=str((b/'inspect-runtime.py').relative_to(r)),remote=stage+'/inspect-runtime.py')],commands=['python3 '+stage+'/inspect-runtime.py'],downloads=[dict(local=str((b/n).relative_to(r)),remote=stage+'/'+n)for n in ['runtime-before.json','runtime-routes-before.json']])
(b/'inspect-runtime-plan.json').write_text(json.dumps(plan,indent=2)+'\n')
print('Prepared bounded runtime read-only inspection')
