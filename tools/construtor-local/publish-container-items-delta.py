"""Guarded DB-buffer compatibility delta; no route or business mutation."""
from pathlib import Path
from datetime import datetime,timezone
import hashlib,json,os,re,shutil,sys
stage=Path(sys.argv[1]).resolve();root=Path('/mnt/datasul/ERP/sursum')
if stage.name!='codex-container-items-db-buffer-20261017':raise SystemExit('Unexpected staging directory')
plan=json.loads((stage/'manifest.json').read_text(encoding='utf-8-sig'))
expected={'sursum-api/programs/'+n+e for n in ['ContainersItensCrudService','ContainersItensRuntime'] for e in ['.p','.r']}|{'sursum-api/includes/ContainerBufferSibling.i'}
if set(plan['targets'])!=expected or set(plan['baseline'])!=expected:raise SystemExit('Unexpected delta scope')
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
proof=(stage/'coherent-compile.log').read_text(encoding='utf-8-sig')
if 'OpenEdge 12.2' not in proof or 'PASS SUITE' not in proof or re.search(r'FAIL|COMPILER:ERROR=yes',proof):raise SystemExit('Fresh coherent12.2 proof required')
if 'PASS ContainersItensCrudDbBootstrapTest.p AMERICAN' not in proof or 'PASS ContainersItensCrudDbBootstrapTest.p EUROPEAN' not in proof:raise SystemExit('Connected DB buffer regression required')
for relative,entry in plan['targets'].items():
 if Path(entry['file']).name!=entry['file'] or sha(stage/entry['file'])!=entry['sha256']:raise SystemExit('Staging mismatch')
 target=root/relative;actual=sha(target) if target.is_file() else None
 if actual!=plan['baseline'][relative]:raise SystemExit('Concurrent target change: '+relative)
catalog=json.loads((root/'conf-web-handler/program-routes.json').read_text(encoding='utf-8-sig'))
if [r for r in catalog['routes'] if r.get('route')=='/SursumPrograms/containers-itens']!=[{'route':'/SursumPrograms/containers-itens','method':'POST','program':'sursum-api/programs/ContainersItensCrud.p'}]:raise SystemExit('Current item route changed')
backup=stage/('backup-'+datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%SZ'));backup.mkdir();shutil.copy2(stage/'manifest.json',backup/'manifest.json')
temps={};written=[]
try:
 for relative,entry in plan['targets'].items():
  target=root/relative
  if target.exists():shutil.copy2(target,backup/entry['file'])
  temp=target.with_name(target.name+'.container-items-delta')
  if temp.exists():raise RuntimeError('Concurrent staging')
  shutil.copyfile(stage/entry['file'],temp);os.chmod(temp,(target.stat().st_mode&0o777) if target.exists() else 0o644)
  if sha(temp)!=entry['sha256']:raise RuntimeError('Transfer mismatch')
  temps[relative]=temp
 for relative in sorted(plan['targets']):
  target=root/relative
  if (sha(target) if target.exists() else None)!=plan['baseline'][relative]:raise RuntimeError('Concurrent publication')
  os.replace(temps[relative],target);written.append(relative)
  if sha(target)!=plan['targets'][relative]['sha256']:raise RuntimeError('Published mismatch')
except Exception:
 for relative in reversed(written):
  target=root/relative;entry=plan['targets'][relative]
  if not target.exists() or sha(target)!=entry['sha256']:continue
  if plan['baseline'][relative] is None:target.unlink()
  else:
   restore=target.with_name(target.name+'.container-items-restore');shutil.copy2(backup/entry['file'],restore);os.replace(restore,target)
 raise
finally:
 for temp in temps.values():
  if temp.exists():temp.unlink()
active={'publishedAt':datetime.now(timezone.utc).isoformat(),'instance':'sursum-api','context':'med','backup':str(backup),'artifacts':{r:e['sha256'] for r,e in plan['targets'].items()},'routesChanged':False,'businessWrites':False,'checksPerCulture':plan['checksPerCulture']}
(stage/'active-manifest.json').write_text(json.dumps(active,indent=2)+'\n',encoding='utf-8')
print('PASS:5 guarded compatibility artifacts; route, trigger, auth and prior programs preserved.')
