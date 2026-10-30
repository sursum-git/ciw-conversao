"""Bounded compatible collector update; never publishes routes or write helpers."""
import hashlib,json,os,re,shutil,sys
from pathlib import Path
from datetime import datetime,timezone
stage=Path(sys.argv[1]).resolve();root=Path('/mnt/datasul/ERP/sursum')
plan=json.loads((stage/'manifest.json').read_text(encoding='utf-8-sig'))
allowed={'sursum-api/programs/ContainersCustoReadService'+ext for ext in ['.p','.r']}
if set(plan['targets'])!=allowed:raise SystemExit('Unexpected publication scope')
def digest(p):return hashlib.sha256(p.read_bytes()).hexdigest()
compilelog=(stage/'coherent-compile.log').read_text(encoding='utf-8-sig')
if 'OpenEdge 12.2' not in compilelog or 'PASS SUITE' not in compilelog or re.search('FAIL|COMPILER:ERROR=yes',compilelog):raise SystemExit('Current coherent12.2 required')
if 'ContainersCustoReadService.p COMPILER:ERROR=no' not in compilelog:raise SystemExit('Collector compilation required')
for prefix,count in [('containers-custo-read-tests-',175),('containers-version-missing-actual-tests-',7),('containers-custo-tests-',87)]:
 for culture in ['AMERICAN','EUROPEAN']:
  log=(stage/(prefix+culture+'.log')).read_text(encoding='utf-8-sig')
  if 'FAIL' in log or not re.search(r'PASS:?\s*'+str(count)+r'\s+checks',log):raise SystemExit('Regression proof absent')
for relative,sha in plan['baseline'].items():
 if digest(root/relative)!=sha:raise SystemExit('Baseline changed: '+relative)
for relative,entry in plan['targets'].items():
 if digest(stage/entry['file'])!=entry['sha256']:raise SystemExit('Staging changed')
catalog=root/'conf-web-handler/program-routes.json';catalog_before=catalog.read_bytes()
backup=stage/('backup-'+datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%SZ'));backup.mkdir()
(backup/'manifest.json').write_text(json.dumps(plan,indent=2)+'\n',encoding='utf-8')
temps={};written=[]
try:
 for relative,entry in plan['targets'].items():
  target=root/relative;shutil.copy2(target,backup/entry['file'])
  temp=target.with_name(target.name+'.null-history-new')
  if temp.exists():raise RuntimeError('Concurrent staging')
  shutil.copyfile(stage/entry['file'],temp);os.chmod(temp,target.stat().st_mode&0o777)
  if digest(temp)!=entry['sha256']:raise RuntimeError('Staging mismatch')
  temps[relative]=temp
 for relative in sorted(plan['targets']):
  if digest(root/relative)!=plan['baseline'][relative]:raise RuntimeError('Concurrent change')
  os.replace(temps[relative],root/relative);written.append(relative)
  if digest(root/relative)!=plan['targets'][relative]['sha256']:raise RuntimeError('Published mismatch')
 if catalog.read_bytes()!=catalog_before:raise RuntimeError('Concurrent catalog change')
except Exception:
 for relative in reversed(written):
  entry=plan['targets'][relative];target=root/relative
  if digest(target)!=entry['sha256']:continue
  temp=target.with_name(target.name+'.null-history-restore')
  if temp.exists():raise RuntimeError('Concurrent restore')
  shutil.copy2(backup/entry['file'],temp);os.replace(temp,target)
 raise
finally:
 for temp in temps.values():
  if temp.exists():temp.unlink()
active={'publishedAt':datetime.now(timezone.utc).isoformat(),'instance':'sursum-api','context':'med','backup':str(backup),'artifacts':dict(plan['baseline']),'catalogSha256':hashlib.sha256(catalog_before).hexdigest(),'businessWrites':False}
active['artifacts'].update({r:e['sha256'] for r,e in plan['targets'].items()})
(stage/'active-manifest.json').write_text(json.dumps(active,indent=2)+'\n',encoding='utf-8')
print('PASS:2collector artifacts verified; compatible ABI, routes/auth/config unchanged; backup '+str(backup))
