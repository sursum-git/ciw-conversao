"""Publica somente a nova API; executar no PASOE com staging explicito."""
import hashlib
import json
import os
from pathlib import Path
import shutil
import sys
from datetime import datetime, timezone

stage = Path(sys.argv[1]).resolve()
root = Path('/mnt/datasul/ERP/sursum')
catalog = root / 'conf-web-handler/program-routes.json'
routes = json.loads(catalog.read_text(encoding='utf-8-sig'))
new_route = {'route': '/SursumPrograms/tipos-anexo', 'method': 'POST',
             'program': 'sursum-api/programs/TiposAnexoCrud.p'}
matching = [r for r in routes['routes'] if r.get('route') == new_route['route']]
replace = (stage / 'previous-manifest.json').exists()
if matching and (not replace or matching != [new_route]):
    raise SystemExit('Rota ja existe: revisar antes de substituir.')
names = ['TiposAnexoCrud.p', 'TiposAnexoCrud.r', 'TiposAnexoCrudService.p', 'TiposAnexoCrudService.r']
manifest = json.loads((stage / 'manifest.json').read_text(encoding='utf-8-sig'))
for name in names + ['tipos-anexo-api.json']:
    if hashlib.sha256((stage / name).read_bytes()).hexdigest() != manifest[name]:
        raise SystemExit('Hash divergente: ' + name)
previous = json.loads((stage / 'previous-manifest.json').read_text(encoding='utf-8-sig')) if replace else {}
for name in names:
    target = root / 'sursum-api/programs' / name
    if replace and hashlib.sha256(target.read_bytes()).hexdigest() != previous[name]:
        raise SystemExit('Artefato alterado desde a publicacao anterior: ' + name)
    if target.exists() and not replace:
        raise SystemExit('Artefato ja existe: ' + name)
secret_target = root / 'sursum-conf/tipos-anexo-api.json'
if replace and hashlib.sha256(secret_target.read_bytes()).hexdigest() != previous['tipos-anexo-api.json']:
    raise SystemExit('Configuracao alterada desde a publicacao anterior.')
if secret_target.exists() and not replace:
    raise SystemExit('Configuracao ja existe: revisar antes de substituir.')
backup = stage / ('backup-' + datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%SZ'))
backup.mkdir()
shutil.copy2(catalog, backup / catalog.name)
if replace:
    for name in names:
        shutil.copy2(root / 'sursum-api/programs' / name, backup / name)
    shutil.copy2(secret_target, backup / secret_target.name)
# A rota entra por ultimo: nenhum consumidor enxerga uma API parcialmente preparada.
for name in names:
    target = root / 'sursum-api/programs' / name
    temp = target.with_name(name + '.tipos-new')
    shutil.copyfile(stage / name, temp)
    os.chmod(temp, 0o644)
    os.replace(temp, target)
secret_target.parent.mkdir(exist_ok=True)
secret_tmp = secret_target.with_suffix('.json.tipos-new')
shutil.copyfile(stage / 'tipos-anexo-api.json', secret_tmp)
os.chmod(secret_tmp, 0o644)  # somente hash SHA-256, nunca a credencial
os.replace(secret_tmp, secret_target)
if not matching:
    routes['routes'].append(new_route)
temp_catalog = catalog.with_suffix('.json.tipos-new')
temp_catalog.write_text(json.dumps(routes, ensure_ascii=False, indent=2) + '\n', encoding='utf-8')
os.chmod(temp_catalog, catalog.stat().st_mode & 0o777)
os.replace(temp_catalog, catalog)
for name in names:
    target = root / 'sursum-api/programs' / name
    assert hashlib.sha256(target.read_bytes()).hexdigest() == manifest[name], name
print('PASS: 4 artefatos publicados com hashes conferidos; rotas existentes preservadas.')
print('Backup do catalogo:', backup)
