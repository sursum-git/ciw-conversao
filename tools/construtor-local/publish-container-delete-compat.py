"""Closed6file header delta + unchanged legacy trigger and2Linux filename aliases."""
import json,hashlib,os,shutil,sys,re
from pathlib import Path
from datetime import datetime,timezone
stage=Path(sys.argv[1]);root=Path('/mnt/datasul/ERP/sursum');plan=json.loads((stage/'manifest.json').read_text())
aliasRoot=Path('/dados/pasoe/sursum-api/webapps/med/WEB-INF/openedge')
assert aliasRoot.is_dir() and aliasRoot.stat().st_dev!=root.stat().st_dev,'Aliases require the existing local med PROPATH directory, outside CIFS'
names=['ContainersCabecalhoCrud','ContainersCabecalhoCrudService','ContainersCabecalhoRules']
expected={'sursum-api/programs/'+n+e for n in names for e in ['.p','.r']}|{'sursum-api/legacy-triggers/tdpp001.p','sursum-api/legacy-triggers/tdpp001.r'}
assert set(plan['targets'])==expected
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
log=(stage/'coherent-compile.log').read_text();assert 'OpenEdge 12.2' in log and 'PASS SUITE' in log and not re.search('FAIL|COMPILER:ERROR=yes',log)
assert 'tdpp001.p COMPILER:ERROR=no' in log
for culture in ['AMERICAN','EUROPEAN']:
 logs=list(stage.glob('*-'+culture+'.log'));assert len(logs)==30
 assert sum(int(re.search(r'PASS:?\s*(\d+)\s+checks',p.read_text()).group(1)) for p in logs)==2167
aliases={'estrg\\tdpp001'+ext:'sursum-api/legacy-triggers/tdpp001'+ext for ext in ['.p','.r']}
for rel,row in plan['targets'].items():
 target=root/rel;before=plan['baseline'][rel]
 assert (sha(target) if target.exists() else None)==before,'Concurrent target: '+rel
 assert sha(stage/row['file'])==row['sha256']
for name in aliases:assert not os.path.lexists(aliasRoot/name),'Compatibility alias occupied'
legacy=Path('/mnt/datasul/ERP/especificos/ems2/ima/estrg/tdpp001.p')
assert sha(legacy)==plan['legacyOriginalSha256'],'Legacy source changed'
assert legacy.read_bytes().decode('cp1252').replace('\r','')==(stage/'tdpp001.p').read_bytes().decode('utf-8').replace('\r',''),'Legacy code must be unchanged except encoding/CR normalization'
catalog=root/'conf-web-handler/program-routes.json';catalogSha=sha(catalog)
backup=stage/('backup-'+datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%SZ'));backup.mkdir();written=[];links=[]
try:
 for rel,row in plan['targets'].items():
  target=root/rel;target.parent.mkdir(exist_ok=True)
  if target.exists():shutil.copy2(target,backup/row['file'])
  tmp=target.with_name(target.name+'.delete-compat-new');assert not tmp.exists();shutil.copyfile(stage/row['file'],tmp);os.chmod(tmp,(target.stat().st_mode&0o777) if target.exists() else 0o644)
  assert (sha(target) if target.exists() else None)==plan['baseline'][rel]
  os.replace(tmp,target);written.append(rel);assert sha(target)==row['sha256']
 for name,dest in aliases.items():os.symlink(str(root/dest),aliasRoot/name);links.append(name);assert sha(aliasRoot/name)==sha(root/dest)
 assert sha(catalog)==catalogSha,'Unrelated catalog mutation'
except Exception:
 for name in links:
  if (aliasRoot/name).is_symlink() and os.readlink(aliasRoot/name)==str(root/aliases[name]):(aliasRoot/name).unlink()
 for rel in reversed(written):
  target=root/rel;row=plan['targets'][rel]
  if sha(target)!=row['sha256']:continue
  if plan['baseline'][rel] is None:target.unlink()
  else:shutil.copy2(backup/row['file'],target)
 raise
result={'publishedAt':datetime.now(timezone.utc).isoformat(),'backup':str(backup),'artifacts':{r:v['sha256'] for r,v in plan['targets'].items()},'aliases':{str(aliasRoot/n):str(root/d) for n,d in aliases.items()},'legacyOriginalSha256':plan['legacyOriginalSha256'],'catalogUnchanged':catalogSha,'instance':'sursum-api','context':'med','checksPerCulture':2167,'schemaOrTriggerDefinitionChanged':False}
(stage/'active-manifest.json').write_text(json.dumps(result,indent=2));print('PASS:6header artifacts, original trigger12.2 and2Linux aliases; schema/PROPATH/trigger definition unchanged.')
