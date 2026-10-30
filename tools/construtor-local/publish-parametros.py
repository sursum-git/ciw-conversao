"""Publicacao inicial da include e do diagnostico protegido de parametros IMA."""
import hashlib
import json
import os
from pathlib import Path
import sys
from datetime import datetime, timezone

stage = Path(sys.argv[1]).resolve()
root = Path('/mnt/datasul/ERP/sursum')
catalog = root / 'conf-web-handler/program-routes.json'
original = catalog.read_bytes()
routes = json.loads(original.decode('utf-8-sig'))
route = {'route': '/SursumPrograms/parametros-ima-verificar', 'method': 'POST',
         'program': 'sursum-api/programs/VerificarParametrosIma.p'}
targets = {
    'parametros_ima.i': root / 'sursum-api/includes/parametros_ima.i',
    'VerificarParametrosIma.p': root / 'sursum-api/programs/VerificarParametrosIma.p',
    'VerificarParametrosIma.r': root / 'sursum-api/programs/VerificarParametrosIma.r',
    'parametros-ima-api.json': root / 'sursum-conf/parametros-ima-api.json',
}
if any(r.get('route') == route['route'] for r in routes['routes']):
    raise SystemExit('Rota ja existe; revisar antes de substituir.')
manifest = json.loads((stage / 'manifest.json').read_text(encoding='utf-8-sig'))
for name, target in targets.items():
    if target.exists():
        raise SystemExit('Destino ja existe: ' + name)
    if hashlib.sha256((stage / name).read_bytes()).hexdigest() != manifest[name]:
        raise SystemExit('Hash divergente: ' + name)
backup = stage / ('backup-' + datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%SZ'))
backup.mkdir()
(backup / catalog.name).write_bytes(original)
for name, target in targets.items():
    target.parent.mkdir(exist_ok=True)
    temporary = target.with_name(target.name + '.parametros-new')
    temporary.write_bytes((stage / name).read_bytes())
    os.chmod(temporary, 0o644)
    os.replace(temporary, target)
    assert hashlib.sha256(target.read_bytes()).hexdigest() == manifest[name], name
if catalog.read_bytes() != original:
    raise SystemExit('Catalogo modificado durante a publicacao; rota nao instalada.')
routes['routes'].append(route)
temporary = catalog.with_suffix('.json.parametros-new')
temporary.write_text(json.dumps(routes, ensure_ascii=False, indent=2) + '\n', encoding='utf-8')
os.chmod(temporary, catalog.stat().st_mode & 0o777)
os.replace(temporary, catalog)
print('PASS: include, consumidor e configuracao publicados; hashes conferidos e rotas preservadas.')
print('Backup:', backup)
