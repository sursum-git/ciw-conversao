"""Guarded16artifact delta + one additive runtime route; never replace operational catalog."""
from pathlib import Path
import json,hashlib
r=Path(__file__).resolve().parents[2];b=r/'.runtime/ciw-completion-20261028/official-build5-v6';stage='/tmp/ciw-completion-20261028-wave2'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
proof=load(b/'official-compile-verification.json');before=load(b/'runtime-before.json');canonical=load(b/'canonical-manifest.json');review=load(b/'manager-review-final.json')
assert proof['success'] and proof['totalChecks']==2732 and canonical['success'] and review['remainingP1P2']==[]
assert not(b/'publication-manifest.json').exists()
for x in canonical['files']:assert sha(Path(x['target']))==x['sha256']
targets={};uploads=[]
old_active=load(r/'.runtime/ciw-completion-20261028/official-build3/active-manifest.json')['targets']
for x in proof['files']:
 assert sha(r/x['source'])==x['sha256'];prior=before['targets'][x['relative']]['before']
 if x['relative'] in old_active:assert prior==old_active[x['relative']]['sha256']
 if not x['relative'].endswith('.r'):
  c=next(v for v in canonical['files'] if v['target'].replace('\\','/').endswith('/'+x['relative']));assert prior==c['before']
 targets[x['relative']]=dict(file=x['file'],sha256=x['sha256'],before=prior)
 uploads.append(dict(local=x['source'],remote=stage+'/'+x['file']))
manifest=dict(success=True,targets=targets,routeBefore=before['targets']['conf-web-handler/program-routes.json']['before'],routeAddition=load(b/'integration-plan.json')['onlyRouteAddition']['operations'][0]['value'],businessWrites=False)
(b/'publication-manifest.json').write_text(json.dumps(manifest,indent=2)+'\n')
script='''from pathlib import Path
import json,hashlib,shutil,os,subprocess
root=Path('/mnt/datasul/ERP/sursum');stage=Path(STAGE)
assert '192.168.0.137' in subprocess.check_output(['findmnt','-n','-o','SOURCE','-T',str(root)],universal_newlines=True)
assert not(stage/'active-manifest.json').exists(),'Already published; inspect state before replay'
load=lambda p:json.loads(p.read_text());sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest() if p.is_file() else None
m=load(stage/'publication-manifest.json');proof=load(stage/'official-compile-verification.json')
assert proof['success'] and proof['version']=='12.2' and proof['totalChecks']==2732
approved={x['relative']:x for x in proof['files']};assert set(approved)==set(m['targets']) and len(approved)==16
for rel,x in m['targets'].items():
 assert approved[rel]['sha256']==x['sha256']==sha(stage/x['file'])
 assert sha(root/rel)==x['before'],'Concurrent runtime change '+rel
route='conf-web-handler/program-routes.json';assert sha(root/route)==m['routeBefore']
old=load(root/route);addition=m['routeAddition'];assert not any(x['route']==addition['route'] for x in old['routes'])
new=json.loads(json.dumps(old));new['routes'].append(addition);assert new['routes'][:-1]==old['routes']
route_stage=stage/'routes-merged-runtime.json';route_stage.write_text(json.dumps(new,ensure_ascii=False,indent=2)+'\\n',encoding='utf-8')
entries=dict(m['targets']);entries[route]=dict(file=route_stage.name,before=m['routeBefore'],sha256=sha(route_stage))
backup=stage/'backup-before';backup.mkdir();written=[]
for rel,x in entries.items():
 if x['before'] is not None:shutil.copy2(root/rel,backup/Path(rel).name)
priority=['ContainerExpenseBatchSnapshot','ContainersVersionAuxHistoryTables','ContainersDespesasCrudService','ContainersDespesasBatchService','ContainersVersionAuxHistoryService','ContainersDespesasBatchApi','ContainersVersionAuxHistoryApi','CiwErpReadService','CiwCadastrosCrud','program-routes']
order=sorted(entries,key=lambda rel:next(i for i,n in enumerate(priority) if n in rel))
try:
 for rel in order:
  x=entries[rel];target=root/rel;temp=target.with_name(target.name+'.completion-wave2-tmp')
  with temp.open('xb')as f:f.write((stage/x['file']).read_bytes())
  if target.exists():
   shutil.copystat(target,temp);st=target.stat();os.chown(temp,st.st_uid,st.st_gid)
  else:os.chmod(temp,0o644)
  assert sha(target)==x['before'];os.replace(temp,target);written.append(rel)
 for rel,x in entries.items():assert sha(root/rel)==x['sha256']
 assert load(root/route)['routes'][:-1]==old['routes']
except Exception:
 for rel in reversed(written):
  x=entries[rel]
  if sha(root/rel)==x['sha256']:
   if x['before'] is None:(root/rel).unlink()
   else:shutil.copy2(backup/Path(rel).name,root/rel)
 raise
(stage/'active-manifest.json').write_text(json.dumps(dict(success=True,instance='sursum-api',context='med',targets=entries,businessWrites=False,routesChanged=True,routeAdditions=1,previousRoutesPreserved=True),indent=2))
print('PASS16official12.2 artifacts +1additive route published; existing streaming response configuration preserved')
'''.replace('STAGE',repr(stage))
(b/'publish-runtime.py').write_text(script)
(b/'refresh-runtime.py').write_text((r/'.runtime/ciw-completion-20261028/official-build3/refresh-runtime.py').read_text().replace('ciw-completion-20261028-wave1','ciw-completion-20261028-wave2'))
for n in ['publication-manifest.json','official-compile-verification.json','publish-runtime.py','refresh-runtime.py']:uploads.append(dict(local=str((b/n).relative_to(r)),remote=stage+'/'+n))
for kind,commands,names in [('publish',['python3 '+stage+'/publish-runtime.py'],['active-manifest.json']),('refresh',['python3 '+stage+'/refresh-runtime.py'],['jmx-inspection.json','med-session-refresh.json'])]:
 plan=dict(server='runtime',uploads=uploads if kind=='publish' else [],commands=commands,downloads=[dict(local=str((b/n).relative_to(r)),remote=stage+'/'+n)for n in names]);(b/(kind+'-plan.json')).write_text(json.dumps(plan,indent=2)+'\n')
print('PASS publication prepared16approved artifacts and one runtime-adaptive route addition; no catalog replacement')
