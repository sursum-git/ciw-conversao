"""Closed additive item-maintenance publication. Run on the authorized runtime."""
from pathlib import Path
from datetime import datetime,timezone
import hashlib,json,os,re,shutil,sys
stage=Path(sys.argv[1]).resolve();root=Path('/mnt/datasul/ERP/sursum')
if stage.name!='codex-container-items-20261017':raise SystemExit('Unexpected staging directory')
plan=json.loads((stage/'manifest.json').read_text(encoding='utf-8-sig'))
names=['ContainersItensCrud','ContainersItensCrudService','ContainersItensRuntime','ContainersItensFinanceiroService','ContainersItensOptionsService']
expected={'sursum-api/programs/'+n+e for n in names for e in ['.p','.r']}
if set(plan['targets'])!=expected or plan['scope']!='container-items-20261017':raise SystemExit('Unexpected artifact scope')
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
compile_log=(stage/'coherent-compile.log').read_text(encoding='utf-8-sig')
if 'OpenEdge 12.2' not in compile_log or 'PASS SUITE' not in compile_log or re.search(r'FAIL|COMPILER:ERROR=yes',compile_log):raise SystemExit('Fresh12.2 compile required')
for n in names:
 if n+'.p COMPILER:ERROR=no' not in compile_log:raise SystemExit('Missing compile proof: '+n)
for culture in ['AMERICAN','EUROPEAN']:
 checks=0
 if len(plan['tests'])<4:raise SystemExit('Missing item test suites')
 for prefix in plan['tests']:
  if not re.fullmatch(r'containers-itens-[a-z-]+-',prefix):raise SystemExit('Unexpected test path')
  proof=(stage/(prefix+culture+'.log')).read_text(encoding='utf-8-sig');match=re.search(r'PASS:?\s*(\d+)\s+checks',proof)
  if 'FAIL' in proof or not match:raise SystemExit('Test proof invalid: '+prefix+culture)
  checks+=int(match.group(1))
 if checks!=plan['checksPerCulture'] or checks<50:raise SystemExit('Item suite checks mismatch')
for relative,entry in plan['targets'].items():
 if not re.fullmatch(r'ContainersItens[A-Za-z]+\.[pr]',entry['file']) or sha(stage/entry['file'])!=entry['sha256']:raise SystemExit('Staging artifact mismatch')
 if (root/relative).exists():raise SystemExit('Additive target already occupied: '+relative)
catalog=root/'conf-web-handler/program-routes.json';before=catalog.read_bytes();routes=json.loads(before.decode('utf-8-sig'))
addition={'route':'/SursumPrograms/containers-itens','method':'POST','program':'sursum-api/programs/ContainersItensCrud.p'}
if any(x.get('route')==addition['route'] for x in routes['routes']):raise SystemExit('Item route already occupied')
routes['routes'].append(addition);after=(json.dumps(routes,ensure_ascii=False,indent=2)+'\n').encode('utf-8')
backup=stage/('backup-'+datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%SZ'));backup.mkdir()
(backup/'program-routes.json').write_bytes(before);shutil.copy2(stage/'manifest.json',backup/'manifest.json')
temps={};written=[];catalog_written=False
try:
 for relative,entry in plan['targets'].items():
  target=root/relative
  if root not in target.parents:raise RuntimeError('Target outside publication root')
  temp=target.with_name(target.name+'.container-items-new')
  if temp.exists():raise RuntimeError('Concurrent staged artifact')
  shutil.copyfile(stage/entry['file'],temp);os.chmod(temp,0o644)
  if sha(temp)!=entry['sha256']:raise RuntimeError('Transfer mismatch')
  temps[relative]=temp
 for relative in sorted(plan['targets']):
  target=root/relative
  if target.exists():raise RuntimeError('Concurrent target occupation')
  os.replace(temps[relative],target);written.append(relative)
  if sha(target)!=plan['targets'][relative]['sha256']:raise RuntimeError('Published mismatch')
 if catalog.read_bytes()!=before:raise RuntimeError('Concurrent route catalog change')
 temp=catalog.with_name(catalog.name+'.container-items-new')
 if temp.exists():raise RuntimeError('Concurrent catalog staging')
 temp.write_bytes(after);os.chmod(temp,catalog.stat().st_mode&0o777);os.replace(temp,catalog);catalog_written=True
 if catalog.read_bytes()!=after:raise RuntimeError('Route catalog mismatch')
except Exception:
 if catalog_written and catalog.read_bytes()==after:
  restore=catalog.with_name(catalog.name+'.container-items-restore');restore.write_bytes(before);os.chmod(restore,catalog.stat().st_mode&0o777);os.replace(restore,catalog)
 for relative in reversed(written):
  target=root/relative
  if target.is_file() and sha(target)==plan['targets'][relative]['sha256']:target.unlink()
 raise
finally:
 for temp in temps.values():
  if temp.exists():temp.unlink()
active={'publishedAt':datetime.now(timezone.utc).isoformat(),'instance':'sursum-api','context':'med','backup':str(backup),'artifacts':{r:e['sha256'] for r,e in plan['targets'].items()},'catalogSha256':sha(catalog),'addedRoutes':[addition],'businessWrites':False,'checksPerCulture':plan['checksPerCulture']}
(stage/'active-manifest.json').write_text(json.dumps(active,indent=2)+'\n',encoding='utf-8')
print('PASS:10 new artifacts +1route, verified hashes; prior routes/files preserved. Backup '+str(backup))
