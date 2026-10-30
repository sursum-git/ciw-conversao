"""Publica lote IOL versionado e troca somente sua rota atomicamente."""
from pathlib import Path
from datetime import datetime,timezone
import json,hashlib,shutil,os
stage=Path('/tmp/codex-iol-gerencial-20261016')
root=Path('/mnt/datasul/ERP/sursum');catalog=root/'conf-web-handler/program-routes.json'
digest=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
manifest=json.loads((stage/'update-manifest.json').read_text())
previous=json.loads((stage/'previous-active-manifest.json').read_text())
original=catalog.read_bytes()
# Other conversions may append routes. Preserve their current bytes/entries; require our exact old route below.
for rel,sha in previous['files'].items():
 if digest(root/rel)!=sha:raise SystemExit('Artefato anterior alterado: '+rel)
names={n+'.'+e for n in ['IolInicialGerencial','IolGerencialIdentityService','IolGerencialCollector','IolGerencialCalculator'] for e in ['p','r']}|{'IolReadBuffers.i'}
if set(manifest['files'])!=names:raise SystemExit('Escopo inesperado')
log=(stage/'compile-iol.log').read_text(encoding='utf-8-sig')
if 'OpenEdge 12.2' not in log or 'FAIL' in log or 'COMPILER:ERROR=yes' in log or 'PASS IOL' not in log:raise SystemExit('Compilacao invalida')
for culture in ['AMERICAN','EUROPEAN']:
 for prefix in ['calculator','identity','boundary']:
  text=(stage/(prefix+'-'+culture+'.log')).read_text(encoding='utf-8-sig')
  if 'PASS' not in text or 'FAIL' in text:raise SystemExit('Teste falhou')
folder=root/'sursum-api/programs/iol-gerencial-20261017-v4'
if folder.exists():raise SystemExit('Lote versionado ja existe; nao sobrescrever')
for name,sha in manifest['files'].items():
 if digest(stage/name)!=sha:raise SystemExit('Hash invalido')
folder.mkdir()
for name,sha in manifest['files'].items():
 shutil.copyfile(stage/name,folder/name);os.chmod(folder/name,0o644)
 if digest(folder/name)!=sha:raise SystemExit('Hash destino invalido')
routes=json.loads(original.decode('utf-8-sig'));matches=[r for r in routes['routes'] if r.get('route')==previous['route']['route']]
if len(matches)!=1 or matches[0]!=previous['route']:raise SystemExit('Rota divergente')
matches[0]['program']='sursum-api/programs/iol-gerencial-20261017-v4/IolInicialGerencial.p'
backup=stage/('backup-'+datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%SZ'));backup.mkdir();(backup/'program-routes.json').write_bytes(original)
if catalog.read_bytes()!=original:raise SystemExit('Catalogo mudou durante staging')
tmp=catalog.with_name('program-routes.json.iol-update')
if tmp.exists():raise SystemExit('Temporario existente')
tmp.write_text(json.dumps(routes,ensure_ascii=False,indent=2)+'\n',encoding='utf-8');os.chmod(tmp,catalog.stat().st_mode&0o777);os.replace(tmp,catalog)
active={'at':datetime.now(timezone.utc).isoformat(),'instance':'sursum-api','context':'med','backup':str(backup),'route':matches[0],'files':{str((folder/name).relative_to(root)):sha for name,sha in manifest['files'].items()},'catalogSha256':digest(catalog)}
(stage/'active-manifest-v4.json').write_text(json.dumps(active,indent=2),encoding='utf-8')
print('PASS lote versionado IOL v4; rota trocada atomicamente; demais rotas preservadas.')
print('Backup: '+str(backup))
