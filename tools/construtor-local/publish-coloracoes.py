"""Publica apenas a nova consulta de coloracoes, sem substituir rotas existentes."""
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
original = catalog.read_bytes()
routes = json.loads(original.decode('utf-8-sig'))
route = {'route': '/SursumPrograms/coloracoes-consulta-manual', 'method': 'POST',
         'program': 'sursum-api/programs/ConsultarColoracoesManual.p'}
if any(r.get('route') == route['route'] for r in routes['routes']):
    raise SystemExit('A rota ja existe; revisar antes de substituir.')
targets = {
    'ConsultarColoracoesManual.p': root / 'sursum-api/programs/ConsultarColoracoesManual.p',
    'ConsultarColoracoesManual.r': root / 'sursum-api/programs/ConsultarColoracoesManual.r',
    'coloracoes-api.json': root / 'sursum-conf/coloracoes-api.json',
}
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
    temporary = target.with_name(target.name + '.coloracoes-new')
    shutil.copyfile(stage / name, temporary)
    os.chmod(temporary, 0o644)
    os.replace(temporary, target)
    assert hashlib.sha256(target.read_bytes()).hexdigest() == manifest[name], name
# A rota e disponibilizada somente depois de todos os artefatos conferidos.
if catalog.read_bytes() != original:
    raise SystemExit('Catalogo alterado durante a publicacao; rota nao instalada.')
routes['routes'].append(route)
temporary_catalog = catalog.with_suffix('.json.coloracoes-new')
temporary_catalog.write_text(json.dumps(routes, ensure_ascii=False, indent=2) + '\n', encoding='utf-8')
os.chmod(temporary_catalog, catalog.stat().st_mode & 0o777)
os.replace(temporary_catalog, catalog)
assert json.loads(catalog.read_text(encoding='utf-8'))['routes'][-1] == route
print('PASS: consulta de coloracoes publicada; hashes conferidos e rotas preservadas.')
print('Backup do catalogo:', backup)
