"""Publica apenas a nova consulta financeira; instala a rota por ultimo."""
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
original = catalog.read_bytes()
routes = json.loads(original.decode('utf-8-sig'))
route = {'route': '/SursumPrograms/containers-financeiro', 'method': 'POST',
         'program': 'sursum-api/programs/ContainersPainelFinanceRead.p'}
if not (root / 'sursum-conf/containers-api.json').is_file():
    raise SystemExit('Configuracao autenticada existente ausente')
if any(r.get('route') == route['route'] for r in routes['routes']):
    raise SystemExit('Rota ja existe: revisar manifesto antes de atualizar')
targets = {name: root / 'sursum-api/programs' / name for name in [
    'ContainersPainelFinanceRead.p', 'ContainersPainelFinanceRead.r',
    'ContainersPainelFinanceReadService.p', 'ContainersPainelFinanceReadService.r']}
targets['ContainerFinancePolicy.i'] = root / 'sursum-api/includes/ContainerFinancePolicy.i'
manifest = json.loads((stage / 'manifest.json').read_text(encoding='utf-8-sig'))
for name, target in targets.items():
    if target.exists():
        raise SystemExit('Destino novo ja existe: ' + str(target))
    if hashlib.sha256((stage / name).read_bytes()).hexdigest() != manifest[name]:
        raise SystemExit('Hash divergente: ' + name)
compile_log = (stage / 'compile-container-panel-integration.log').read_text(encoding='utf-8-sig')
for name in ['ContainersPainelFinanceRead.p', 'ContainersPainelFinanceReadService.p', 'ContainersPainelFinanceReadTest.p', 'ContainerFinancePolicyTest.p']:
    if name + ' COMPILER:ERROR=no' not in compile_log:
        raise SystemExit('Compilacao nao confirmada: ' + name)
if '12.2' not in compile_log or 'COMPILER:ERROR=yes' in compile_log or 'FAIL' in compile_log:
    raise SystemExit('Compilacao12.2 invalida')
for prefix in ['container-panel-finance-tests-', 'container-finance-policy-tests-']:
    for culture in ['AMERICAN', 'EUROPEAN']:
        checks = (stage / (prefix + culture + '.log')).read_text(encoding='utf-8-sig')
        if not re.search(r'^PASS: [1-9][0-9]* checks NUMERIC-FORMAT=' + culture + r'\s*$', checks, re.M) or 'FAIL' in checks:
            raise SystemExit('Teste ausente/falho: ' + prefix + culture)
backup = stage / ('backup-' + datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%SZ'))
backup.mkdir()
(backup / catalog.name).write_bytes(original)
written = []
try:
    for name, target in targets.items():
        temporary = target.with_name(target.name + '.container-finance-new')
        if temporary.exists() or target.exists():
            raise RuntimeError('Destino concorrente: ' + name)
        shutil.copyfile(stage / name, temporary)
        os.chmod(temporary, 0o644)
        os.replace(temporary, target)
        written.append((name, target))
        assert hashlib.sha256(target.read_bytes()).hexdigest() == manifest[name]
    if catalog.read_bytes() != original:
        raise RuntimeError('Catalogo modificado concorrentemente')
    routes['routes'].append(route)
    temporary = catalog.with_suffix('.json.container-finance-new')
    if temporary.exists():
        raise RuntimeError('Catalogo temporario ja existe')
    temporary.write_text(json.dumps(routes, ensure_ascii=False, indent=2) + '\n', encoding='utf-8')
    os.chmod(temporary, catalog.stat().st_mode & 0o777)
    os.replace(temporary, catalog)
except Exception:
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
print('PASS: nova consulta financeira publicada com hashes conferidos. Backup: ' + str(backup))
