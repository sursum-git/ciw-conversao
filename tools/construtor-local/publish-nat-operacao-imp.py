"""Publish the corrected shared getter and its four existing consumers only."""
import hashlib,json,os,re,shutil,sys
from pathlib import Path
from datetime import datetime,timezone
stage=Path(sys.argv[1]).resolve()
root=Path('/mnt/datasul/ERP/sursum')
plan=json.loads((stage/'manifest.json').read_text(encoding='utf-8-sig'))
programs=['ContainersCustoRead','ContainersCustoReadService','ContainersPainelFinanceRead','TiposAnexoCrud','VerificarParametrosIma']
allowed={'sursum-api/programs/'+name+ext for name in programs for ext in ['.p','.r']}|{'sursum-api/includes/parametros_ima.i'}
if set(plan['targets'])!=allowed: raise SystemExit('Unexpected target scope')
catalog=root/'conf-web-handler/program-routes.json'
catalog_before=catalog.read_bytes()
routes=json.loads(catalog_before.decode('utf-8-sig'))['routes']
for route,program in [('containers-custos','ContainersCustoRead'),('containers-financeiro','ContainersPainelFinanceRead'),('tipos-anexo','TiposAnexoCrud'),('parametros-ima-verificar','VerificarParametrosIma')]:
 expected={'route':'/SursumPrograms/'+route,'method':'POST','program':'sursum-api/programs/'+program+'.p'}
 if [r for r in routes if r.get('route')==expected['route']]!=[expected]: raise SystemExit('Existing route changed: '+route)
log=(stage/'compile-container-panel-integration.log').read_text(encoding='utf-8-sig')
if 'OpenEdge 12.2' not in log or 'PASS PANEL INTEGRATION' not in log or re.search('FAIL|COMPILER:ERROR=yes',log): raise SystemExit('Current12.2 compile required')
for name in programs:
 if name+'.p COMPILER:ERROR=no' not in log: raise SystemExit('Compile evidence missing: '+name)
for file,expected in plan['testLogs'].items():
 text=(stage/file).read_text(encoding='utf-8-sig')
 if 'FAIL' in text or not re.search(r'PASS:?\s*'+str(expected)+r'\s+(checks|verificacoes)',text): raise SystemExit('Test evidence missing: '+file)
def digest(file):return hashlib.sha256(file.read_bytes()).hexdigest()
for relative,expected in plan['baseline'].items():
 if digest(root/relative)!=expected: raise SystemExit('Live baseline changed: '+relative)
for relative,record in plan['targets'].items():
 if digest(stage/record['file'])!=record['sha256']: raise SystemExit('Staging hash changed: '+relative)
backup=stage/('backup-'+datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%SZ'));backup.mkdir()
(backup/'manifest.json').write_text(json.dumps(plan,indent=2)+'\n',encoding='utf-8')
temporary={};written=[]
try:
 for relative,record in plan['targets'].items():
  target=root/relative;shutil.copy2(target,backup/record['file'])
  temp=target.with_name(target.name+'.nat-operacao-new')
  if temp.exists():raise RuntimeError('Concurrent staging file: '+relative)
  shutil.copyfile(stage/record['file'],temp);os.chmod(temp,target.stat().st_mode & 0o777)
  if digest(temp)!=record['sha256']:raise RuntimeError('Staging verify failed: '+relative)
  temporary[relative]=temp
 # API ABI is unchanged. Only the cost entrypoint uses this getter; install its
 # recompiled bytecode last, after the shared include and diagnostic dependents.
 order=sorted(plan['targets'],key=lambda p:p.endswith('ContainersCustoRead.r'))
 for relative in order:
  target=root/relative
  if digest(target)!=plan['baseline'][relative]:raise RuntimeError('Concurrent target change: '+relative)
  os.replace(temporary[relative],target);written.append(relative)
  if digest(target)!=plan['targets'][relative]['sha256']:raise RuntimeError('Published hash failed: '+relative)
 if catalog.read_bytes()!=catalog_before:raise RuntimeError('Catalog changed concurrently')
except Exception:
 for relative in reversed(written):
  target=root/relative;record=plan['targets'][relative]
  if digest(target)!=record['sha256']:continue
  temp=target.with_name(target.name+'.nat-operacao-restore')
  if temp.exists():raise RuntimeError('Existing restore file: '+relative)
  shutil.copy2(backup/record['file'],temp);os.replace(temp,target)
 raise
finally:
 for temp in temporary.values():
  if temp.exists():temp.unlink()
active={'publishedAt':datetime.now(timezone.utc).isoformat(),'instance':'sursum-api','context':'med','backup':str(backup),'artifacts':dict(plan['baseline']),'catalogSha256':hashlib.sha256(catalog_before).hexdigest(),'businessWrites':False}
active['artifacts'].update({path:entry['sha256'] for path,entry in plan['targets'].items()})
(stage/'active-manifest.json').write_text(json.dumps(active,indent=2)+'\n',encoding='utf-8')
for domain in ['cost','finance']:
 previous=json.loads((stage/(domain+'-previous.json')).read_text(encoding='utf-8-sig'))
 previous.update(publishedAt=active['publishedAt'],backup=str(backup),catalogSha256=active['catalogSha256'])
 previous['artifacts']={path:active['artifacts'][path] for path in previous['artifacts']}
 previous['artifacts']['sursum-api/includes/parametros_ima.i']=active['artifacts']['sursum-api/includes/parametros_ima.i']
 (stage/(domain+'-active-manifest.json')).write_text(json.dumps(previous,indent=2)+'\n',encoding='utf-8')
print('PASS:11 artifacts verified; routes/auth/config unchanged. Backup: '+str(backup))
