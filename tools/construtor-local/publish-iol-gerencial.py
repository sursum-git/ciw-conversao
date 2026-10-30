"""Publicador remoto restrito a novos artefatos readonly IOL e uma rota."""
from pathlib import Path
from datetime import datetime,timezone
import sys,json,hashlib,os,shutil
stage=Path(sys.argv[1]).resolve()
if stage!=Path('/tmp/codex-iol-gerencial-20261016'):raise SystemExit('Staging inesperado')
root=Path('/mnt/datasul/ERP/sursum');catalog=root/'conf-web-handler/program-routes.json'
digest=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
manifest=json.loads((stage/'manifest.json').read_text())
original=catalog.read_bytes()
if hashlib.sha256(original).hexdigest()!=manifest['catalogBefore']:raise SystemExit('Catalogo alterado; nenhuma gravacao realizada')
routes=json.loads(original.decode('utf-8-sig'))
route={'route':'/SursumPrograms/iol-inicial-gerencial','method':'POST','program':'sursum-api/programs/IolInicialGerencial.p'}
if any(x.get('route')==route['route'] for x in routes['routes']):raise SystemExit('Rota IOL ja existe; nao sobrescrever')
expected={name+'.'+ext for name in ['IolInicialGerencial','IolGerencialIdentityService','IolGerencialCollector','IolGerencialCalculator'] for ext in ['p','r']}|{'IolReadBuffers.i','iol-gerencial-api.json'}
if set(manifest['files'])!=expected:raise SystemExit('Artefatos fora do escopo')
targets={name:root/('sursum-conf' if name=='iol-gerencial-api.json' else 'sursum-api/programs')/name for name in expected}
for name,target in targets.items():
 if target.exists():raise SystemExit('Destino ja existe: '+name)
 if digest(stage/name)!=manifest['files'][name]:raise SystemExit('Hash invalido: '+name)
log=(stage/'compile-iol.log').read_text(encoding='utf-8-sig')
if 'OpenEdge 12.2' not in log or 'COMPILER:ERROR=yes' in log or 'FAIL' in log or 'PASS IOL' not in log:raise SystemExit('Compilacao12.2 nao comprovada')
for culture in ['AMERICAN','EUROPEAN']:
 for prefix in ['calculator','identity','boundary']:
  log=(stage/(prefix+'-'+culture+'.log')).read_text(encoding='utf-8-sig')
  if 'PASS' not in log or 'FAIL' in log:raise SystemExit('Teste ausente/falho: '+prefix+' '+culture)
backup=stage/('backup-'+datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%SZ'));backup.mkdir()
(backup/'program-routes.json').write_bytes(original)
written=[]
try:
 for name,target in targets.items():
  tmp=target.with_name(target.name+'.iol-new')
  if tmp.exists():raise RuntimeError('Staging de destino existente')
  shutil.copyfile(stage/name,tmp);os.chmod(tmp,0o640 if name=='iol-gerencial-api.json' else 0o644)
  if target.exists():raise RuntimeError('Destino criado concorrentemente')
  os.replace(tmp,target);written.append((name,target))
  if digest(target)!=manifest['files'][name]:raise RuntimeError('Hash de destino divergente')
 if catalog.read_bytes()!=original:raise RuntimeError('Catalogo alterado durante publicacao')
 routes['routes'].append(route)
 tmp=catalog.with_name(catalog.name+'.iol-new')
 if tmp.exists():raise RuntimeError('Catalogo temporario existente')
 tmp.write_text(json.dumps(routes,ensure_ascii=False,indent=2)+'\n',encoding='utf-8');os.chmod(tmp,catalog.stat().st_mode&0o777);os.replace(tmp,catalog)
except Exception:
 current=json.loads(catalog.read_text(encoding='utf-8-sig'))
 if not any(x.get('route')==route['route'] for x in current['routes']):
  for name,target in written:
   if digest(target)==manifest['files'][name]:target.unlink()
 raise
active={'at':datetime.now(timezone.utc).isoformat(),'instance':'sursum-api','context':'med','backup':str(backup),'route':route,'files':{str(p.relative_to(root)):manifest['files'][n] for n,p in targets.items()},'catalogSha256':digest(catalog)}
(stage/'active-manifest.json').write_text(json.dumps(active,indent=2),encoding='utf-8')
print('PASS IOL readonly publicado; hashes e rotas anteriores preservados.')
print('Backup: '+str(backup))
