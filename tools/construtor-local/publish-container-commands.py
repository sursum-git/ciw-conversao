"""Publish the closed container command bundle and exactly three JSON routes."""
import hashlib,json,os,re,shutil,sys
from pathlib import Path
from datetime import datetime,timezone
stage=Path(sys.argv[1]).resolve();root=Path('/mnt/datasul/ERP/sursum')
plan=json.loads((stage/'manifest.json').read_text(encoding='utf-8-sig'))
names='ContainersCabecalhoCrud,ContainersCabecalhoCrudService,ContainersCabecalhoRules,ContainersCabecalhoRuntime,ContainersCustoCalculator,ContainersCustoRead,ContainersCustoReadService,ContainersDespesasCrud,ContainersDespesasCrudService,ContainersDistribuicaoCalculator,ContainersDistribuicaoService,ContainersImpostosService,ContainersItemCustoCalculator,ContainersItemCustoCloseService,ContainersItemCustoInputsService,ContainersPagamentoTotalsService,ContainersPainelFinanceRead,ContainersPainelFinanceReadService,ContainersPainelRead,ContainersPainelReadService,ContainersProcessos,ContainersProcessosService,ContainersVersaoCostAdapter,ContainersVersionAuxSnapshotService,ContainersVersionContext,ContainersVersionRuntime,ContainersVersionService'.split(',')
expected={'sursum-api/programs/'+n+e for n in names for e in ['.p','.r']}
expected|={'sursum-api/includes/'+n for n in ['ContainerApiIdentity.i','ContainerMaintenancePolicy.i','ContainerProcessBoundary.i','ContainerTransactionAudit.i']}
expected|={'sursum-api/programs/'+n for n in ['ContainersItemCustoPhysical.i','ContainersVersionContextBody.i']}
if set(plan['targets'])!=expected:raise SystemExit('Unexpected artifact scope')
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
log=(stage/'coherent-compile.log').read_text(encoding='utf-8-sig')
if 'OpenEdge 12.2' not in log or 'PASS SUITE' not in log or re.search(r'FAIL|COMPILER:ERROR=yes',log):raise SystemExit('Coherent12.2 compilation required')
for n in names:
 if n+'.p COMPILER:ERROR=no' not in log:raise SystemExit('Current compile proof absent: '+n)
for culture in ['AMERICAN','EUROPEAN']:
 count=0
 for name in plan['tests']:
  text=(stage/(name+culture+'.log')).read_text(encoding='utf-8-sig');m=re.search(r'PASS:?\s*(\d+)\s+checks',text)
  if 'FAIL' in text or not m:raise SystemExit('Test evidence missing')
  count+=int(m.group(1))
 if count!=plan['checksPerCulture'] or count<2045 or len(plan['tests'])!=30:raise SystemExit('Current30suite proof required')
for relative,expectedHash in plan['baseline'].items():
 p=root/relative
 if expectedHash is None:
  if p.exists():raise SystemExit('New target occupied: '+relative)
 elif not p.is_file() or sha(p)!=expectedHash:raise SystemExit('Baseline changed: '+relative)
for relative,record in plan['targets'].items():
 if sha(stage/record['file'])!=record['sha256']:raise SystemExit('Staging changed: '+relative)
catalog=root/'conf-web-handler/program-routes.json';catalogBefore=catalog.read_bytes();routes=json.loads(catalogBefore.decode('utf-8-sig'))
additions=[{'route':'/SursumPrograms/'+r,'method':'POST','program':'sursum-api/programs/'+p+'.p'} for r,p in [('containers-cabecalho','ContainersCabecalhoCrud'),('containers-despesas','ContainersDespesasCrud'),('containers-processos','ContainersProcessos')]]
for addition in additions:
 if any(x.get('route')==addition['route'] for x in routes['routes']):raise SystemExit('New route occupied: '+addition['route'])
routes['routes'].extend(additions);catalogAfter=(json.dumps(routes,ensure_ascii=False,indent=2)+'\n').encode('utf-8')
backup=stage/('backup-'+datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%SZ'));backup.mkdir()
(backup/'manifest.json').write_text(json.dumps(plan,indent=2)+'\n',encoding='utf-8');(backup/'program-routes.json').write_bytes(catalogBefore)
temps={};written=[];catalogWritten=False
try:
 for relative,record in plan['targets'].items():
  target=root/relative
  if root not in target.parents:raise RuntimeError('Target outside publication root')
  if target.exists():shutil.copy2(target,backup/record['file'])
  temp=target.with_name(target.name+'.container-command-new')
  if temp.exists():raise RuntimeError('Concurrent staging file')
  shutil.copyfile(stage/record['file'],temp);os.chmod(temp,(target.stat().st_mode&0o777) if target.exists() else 0o644)
  if sha(temp)!=record['sha256']:raise RuntimeError('Staging mismatch')
  temps[relative]=temp
 for relative in sorted(plan['targets']):
  target=root/relative;before=plan['baseline'][relative]
  if (sha(target) if target.exists() else None)!=before:raise RuntimeError('Concurrent artifact change')
  os.replace(temps[relative],target);written.append(relative)
  if sha(target)!=plan['targets'][relative]['sha256']:raise RuntimeError('Published mismatch')
 if catalog.read_bytes()!=catalogBefore:raise RuntimeError('Concurrent catalog change')
 catalogTemp=catalog.with_name(catalog.name+'.container-command-new')
 if catalogTemp.exists():raise RuntimeError('Concurrent catalog staging')
 catalogTemp.write_bytes(catalogAfter);os.chmod(catalogTemp,catalog.stat().st_mode&0o777);os.replace(catalogTemp,catalog);catalogWritten=True
 if catalog.read_bytes()!=catalogAfter:raise RuntimeError('Published catalog mismatch')
except Exception:
 if catalogWritten and catalog.read_bytes()==catalogAfter:
  restore=catalog.with_name(catalog.name+'.container-command-restore');restore.write_bytes(catalogBefore);os.chmod(restore,catalog.stat().st_mode&0o777);os.replace(restore,catalog)
 for relative in reversed(written):
  target=root/relative;record=plan['targets'][relative]
  if sha(target)!=record['sha256']:continue
  if plan['baseline'][relative] is None:target.unlink()
  else:
   restore=target.with_name(target.name+'.container-command-restore')
   if restore.exists():raise RuntimeError('Concurrent restore file')
   shutil.copy2(backup/record['file'],restore);os.replace(restore,target)
 raise
finally:
 for temp in temps.values():
  if temp.exists():temp.unlink()
active={'publishedAt':datetime.now(timezone.utc).isoformat(),'instance':'sursum-api','context':'med','backup':str(backup),'artifacts':{r:v['sha256'] for r,v in plan['targets'].items()},'catalogSha256':sha(catalog),'addedRoutes':additions,'businessWrites':False,'checksPerCulture':plan['checksPerCulture']}
(stage/'active-manifest.json').write_text(json.dumps(active,indent=2)+'\n',encoding='utf-8')
print('PASS:60artifacts +3routes verified, prior routes preserved; no auth/globalPROPATH/schema changes. Backup '+str(backup))
