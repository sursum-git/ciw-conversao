from pathlib import Path
import json,hashlib

r=Path(__file__).resolve().parents[2]
b=r/'.runtime/purchase-quantities-20261027'
stage='/tmp/ciw-purchase-quantities-20261027'
load=lambda n:json.loads((b/n).read_text())
save=lambda n,v:(b/n).write_text(json.dumps(v,indent=2)+'\n')
proof=load('official-compile-verification.json');before=load('runtime-before.json')
assert proof['success'] and load('canonical-manifest.json')['success'] and load('review-final.json')['success']
assert not (b/'publication-manifest.json').exists()
targets={};uploads=[]
for f in proof['files']:
 p=r/f['source'];assert hashlib.sha256(p.read_bytes()).hexdigest()==f['sha256']
 targets[f['relative']]={**before['targets'][f['relative']],'sha256':f['sha256']}
 uploads.append(dict(local=f['source'],remote=stage+'/'+f['file']))
save('publication-manifest.json',dict(success=True,targets=targets,businessWrites=False))
for n in ['publication-manifest.json','official-compile-verification.json','review-final.json','publish-runtime.py','refresh-runtime.py']:
 uploads.append(dict(local=str((b/n).relative_to(r)),remote=stage+'/'+n))
save('publish-plan.json',dict(server='runtime',directories=[stage],uploads=uploads,commands=['python3 '+stage+'/publish-runtime.py'],downloads=[dict(local=str((b/'active-manifest.json').relative_to(r)),remote=stage+'/active-manifest.json')]))
save('refresh-plan.json',dict(server='runtime',commands=['python3 '+stage+'/refresh-runtime.py'],downloads=[dict(local=str((b/n).relative_to(r)),remote=stage+'/'+n)for n in ['jmx-inspection.json','med-session-refresh.json']]))
print('PASS publication plan10 reviewed artifacts; same sursum-api/med instance')
