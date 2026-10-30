"""Publica somente a nova API de leitura do painel de containers, com rota por último."""
import hashlib
import json
import os
from pathlib import Path
import re
import shutil
import sys
from datetime import datetime, timezone

stage = Path(sys.argv[1]).resolve()
root = Path('/mnt/datasul/ERP/sursum')
catalog = root / 'conf-web-handler/program-routes.json'
if not (root / 'sursum-conf/containers-api.json').is_file():
    raise SystemExit('Configuracao autenticada de containers ausente')
original = catalog.read_bytes()
routes = json.loads(original.decode('utf-8-sig'))
route = {'route': '/SursumPrograms/containers-painel', 'method': 'POST',
         'program': 'sursum-api/programs/ContainersPainelRead.p'}
if any(r.get('route') == route['route'] for r in routes['routes']):
    raise SystemExit('Rota de containers ja existe; revisar o manifesto antes de substituir.')
targets = {
    'ContainersPainelRead.p': root / 'sursum-api/programs/ContainersPainelRead.p',
    'ContainersPainelRead.r': root / 'sursum-api/programs/ContainersPainelRead.r',
    'ContainersPainelReadService.p': root / 'sursum-api/programs/ContainersPainelReadService.p',
    'ContainersPainelReadService.r': root / 'sursum-api/programs/ContainersPainelReadService.r',
}
manifest = json.loads((stage / 'manifest.json').read_text(encoding='utf-8-sig'))
for name, target in targets.items():
    if target.exists():
        raise SystemExit('Destino ja existe: ' + name)
    if hashlib.sha256((stage / name).read_bytes()).hexdigest() != manifest[name]:
        raise SystemExit('Hash divergente: ' + name)
compile_log = (stage / 'compile-container-panel-read.log').read_text(encoding='utf-8-sig')
if any(name + ' COMPILER:ERROR=no' not in compile_log for name in ['ContainersPainelRead.p','ContainersPainelReadService.p','ContainersPainelReadTest.p']) or '12.2' not in compile_log or 'COMPILER:ERROR=yes' in compile_log or 'FAIL:' in compile_log:
    raise SystemExit('Evidencia de compilacao 12.2 invalida')
for culture in ['AMERICAN', 'EUROPEAN']:
    checks = (stage / ('container-panel-read-tests-' + culture + '.log')).read_text(encoding='utf-8-sig')
    if not re.search(r'^PASS: [1-9][0-9]* checks NUMERIC-FORMAT=' + culture + r'\s*$', checks, re.M) or 'FAIL' in checks:
        raise SystemExit('Testes ABL ausentes/falhos: ' + culture)
backup = stage / ('backup-' + datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%SZ'))
backup.mkdir()
(backup / catalog.name).write_bytes(original)
written = []
try:
    for name, target in targets.items():
        temporary = target.with_name(target.name + '.containers-new')
        if temporary.exists():
            raise RuntimeError('Arquivo temporario ja existe: ' + name)
        shutil.copyfile(stage / name, temporary)
        os.chmod(temporary, 0o644)
        if target.exists():
            raise RuntimeError('Destino criado concorrentemente: ' + name)
        os.replace(temporary, target)
        written.append((name, target))
        assert hashlib.sha256(target.read_bytes()).hexdigest() == manifest[name], name
    if catalog.read_bytes() != original:
        raise RuntimeError('Catalogo alterado durante a publicacao; rota nao instalada.')
    routes['routes'].append(route)
    temporary_catalog = catalog.with_suffix('.json.containers-new')
    if temporary_catalog.exists():
        raise RuntimeError('Catalogo temporario ja existe')
    temporary_catalog.write_text(json.dumps(routes, ensure_ascii=False, indent=2) + '\n', encoding='utf-8')
    os.chmod(temporary_catalog, catalog.stat().st_mode & 0o777)
    os.replace(temporary_catalog, catalog)
except Exception:
    # Rota ausente: remover somente os novos artefatos que ainda sao nossos.
    current = json.loads(catalog.read_text(encoding='utf-8-sig'))
    if not any(r.get('route') == route['route'] for r in current['routes']):
        for name, target in written:
            if hashlib.sha256(target.read_bytes()).hexdigest() == manifest[name]:
                target.unlink()
    raise
active = {'publishedAt': datetime.now(timezone.utc).isoformat(), 'backup': str(backup),
          'instance': 'sursum-api', 'context': 'med', 'route': route,
          'artifacts': {str(target.relative_to(root)): manifest[name] for name, target in targets.items()},
          'catalogSha256': hashlib.sha256(catalog.read_bytes()).hexdigest()}
(stage / 'active-manifest.json').write_text(json.dumps(active, indent=2) + '\n', encoding='utf-8')
print('PASS: leitura do painel de containers publicada, hashes conferidos, catalogo preservado.')
print('Backup: ' + str(backup))
