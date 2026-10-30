"""Remote publisher: one coherent versioned IOL batch, only its existing route.
Consumes only approved OE12.2 artifacts. OE12.8 source is prepared, never executable.
"""
from pathlib import Path
from datetime import datetime,timezone
import json,hashlib,shutil,os
stage=Path('/tmp/codex-iol-engine-20261019')
root=Path('/mnt/datasul/ERP/sursum');catalog=root/'conf-web-handler/program-routes.json'
digest=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
manifest=json.loads((stage/'manifest.json').read_text())
previous=json.loads((stage/'previous-active-manifest.json').read_text())
original=catalog.read_bytes()
for rel,sha in previous['files'].items():
 if digest(root/rel)!=sha:raise SystemExit('Previous artifact changed: '+rel)
names={n+'.'+e for n in ['IolInicialGerencial','IolGerencialIdentityService','IolGerencialCollector','IolGerencialCalculator','IolGerencialEnginePolicy'] for e in ['p','r']}
names|={'IolReadBuffers.i','IolGerencialAggregate128.p','CompileIolGerencial128.p'}
if set(manifest['files'])!=names:raise SystemExit('Unexpected file set; no OE12.8 executable allowed')
log=(stage/'compile-iol.log').read_text(encoding='utf-8-sig')
if 'OpenEdge 12.2' not in log or 'FAIL' in log or 'COMPILER:ERROR=yes' in log or 'PASS IOL' not in log:raise SystemExit('OE12.2 compile not proven')
for culture in ['AMERICAN','EUROPEAN']:
 for prefix in ['calculator','identity','boundary','engine-policy']:
  text=(stage/(prefix+'-'+culture+'.log')).read_text(encoding='utf-8-sig')
  if 'PASS' not in text or 'FAIL' in text:raise SystemExit('Tests failed: '+prefix+' '+culture)
parameter_receipt=(stage/'iol-engine-parameter-install.log').read_text(encoding='utf-8-sig')
if 'PASS parameter=iol_gerencial_engine value=12.2' not in parameter_receipt:raise SystemExit('Parameter install not proven')
folder=root/'sursum-api/programs/iol-gerencial-20261019-v5'
if folder.exists():raise SystemExit('Versioned batch already exists; do not overwrite')
for name,sha in manifest['files'].items():
 if digest(stage/name)!=sha:raise SystemExit('Invalid source hash: '+name)
routes=json.loads(original.decode('utf-8-sig'));matches=[r for r in routes['routes'] if r.get('route')==previous['route']['route']]
if len(matches)!=1 or matches[0]!=previous['route']:raise SystemExit('IOL route changed')
folder.mkdir()
for name,sha in manifest['files'].items():
 shutil.copyfile(stage/name,folder/name);os.chmod(folder/name,0o644)
 if digest(folder/name)!=sha:raise SystemExit('Destination hash mismatch')
matches[0]['program']='sursum-api/programs/iol-gerencial-20261019-v5/IolInicialGerencial.p'
backup=stage/('backup-'+datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%SZ'));backup.mkdir();(backup/'program-routes.json').write_bytes(original)
if catalog.read_bytes()!=original:raise SystemExit('Catalog changed during staging; route untouched')
tmp=catalog.with_name('program-routes.json.iol-engine-v5')
if tmp.exists():raise SystemExit('Temporary catalog already exists')
tmp.write_text(json.dumps(routes,ensure_ascii=False,indent=2)+'\n',encoding='utf-8');os.chmod(tmp,catalog.stat().st_mode&0o777);os.replace(tmp,catalog)
active={'at':datetime.now(timezone.utc).isoformat(),'instance':'sursum-api','context':'med','backup':str(backup),'route':matches[0],
 'files':{str((folder/name).relative_to(root)):sha for name,sha in manifest['files'].items()},'catalogSha256':digest(catalog),
 'engine':'12.2','prepared128':True,'executable128':False}
(stage/'active-manifest-v5.json').write_text(json.dumps(active,indent=2),encoding='utf-8')
print('PASS IOL v5 published; engine12.2; OE12.8 source only. Backup: '+str(backup))
