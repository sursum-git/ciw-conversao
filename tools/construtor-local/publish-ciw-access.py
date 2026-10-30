"""Executado no runtime: publica somente o lote novo CIW readonly, com guards."""
import hashlib
import json
import os
import shutil
from pathlib import Path

ROOT = Path('/mnt/datasul/ERP/sursum')
STAGE = Path('/tmp/ciw-access-20261016')
CATALOG = ROOT / 'conf-web-handler/program-routes.json'
plan = json.loads((STAGE / 'manifest.json').read_text(encoding='utf-8'))
names = ['CiwAccessService', 'CiwAccessBoundary', 'CiwAccessRead']
expected = {'sursum-api/programs/' + n + e for n in names for e in ('.p', '.r')}
expected.add('sursum-conf/ciw-access.json')
if set(plan['targets']) != expected:
    raise RuntimeError('Escopo de publicacao invalido')

def digest(path):
    return hashlib.sha256(path.read_bytes()).hexdigest()

log = (STAGE / 'compile-ciw-access.log').read_text(encoding='utf-8-sig')
if 'OpenEdge 12.2' not in log or 'COMPILER:ERROR=yes' in log or 'MISSING' in log:
    raise RuntimeError('Compilacao12.2 incompleta')
for name in names:
    if name + '.p COMPILER:ERROR=no' not in log:
        raise RuntimeError('Compilacao de produto ausente')
for culture in ['AMERICAN', 'EUROPEAN']:
    for prefix in ['ciw-access-tests-', 'ciw-access-boundary-']:
        proof = (STAGE / (prefix + culture + '.log')).read_text(encoding='utf-8-sig')
        if not proof.startswith('PASS ') or 'FAIL' in proof:
            raise RuntimeError('Prova de teste ausente')
if digest(CATALOG) != plan['catalogBeforeSha256']:
    raise RuntimeError('Catalogo alterado desde o levantamento')
for relative, entry in plan['targets'].items():
    if (ROOT / relative).exists():
        raise RuntimeError('Artefato ja existe; revisar em vez de substituir: ' + relative)
    if digest(STAGE / entry['file']) != entry['sha256']:
        raise RuntimeError('Hash do staging divergente')
config = json.loads((STAGE / 'ciw-access.json').read_text(encoding='utf-8'))
if config.get('allowedAuthProviders') != []:
    raise RuntimeError('Primeira publicacao exige allowlist vazia ate origem real confirmada')
catalog = json.loads(CATALOG.read_text(encoding='utf-8-sig'))
route = {'route': '/SursumPrograms/ciw-access', 'method': 'POST',
         'program': 'sursum-api/programs/CiwAccessRead.p'}
if any(r.get('route') == route['route'] for r in catalog['routes']):
    raise RuntimeError('Rota CIW existente requer revisao')
catalog['routes'].append(route)
catalog_bytes = (json.dumps(catalog, ensure_ascii=False, indent=2) + '\n').encode('utf-8')
backup = STAGE / 'backup-before'
backup.mkdir()  # Nao substituir evidencias de uma execucao anterior.
shutil.copy2(CATALOG, backup / 'program-routes.json')
written = []
temps = []
catalog_written = False
try:
    for relative, entry in sorted(plan['targets'].items()):
        target = ROOT / relative
        temp = target.with_name(target.name + '.ciw-access-new')
        with temp.open('xb') as out:
            out.write((STAGE / entry['file']).read_bytes())
        temps.append(temp)
        template = ROOT / ('sursum-conf/containers-api.json' if relative.endswith('.json')
                           else 'sursum-api/programs/ContainersPainelRead' + target.suffix)
        stat = template.stat()
        os.chmod(temp, stat.st_mode & 0o777)
        os.chown(temp, stat.st_uid, stat.st_gid)
        if digest(temp) != entry['sha256']:
            raise RuntimeError('Transferencia incompleta')
        # link cria o nome final somente se ausente; nenhum overwrite concorrente.
        os.link(str(temp), str(target))
        written.append(relative)
        temp.unlink()
    if digest(CATALOG) != plan['catalogBeforeSha256']:
        raise RuntimeError('Catalogo alterado durante staging')
    temp = CATALOG.with_name(CATALOG.name + '.ciw-access-new')
    with temp.open('xb') as out:
        out.write(catalog_bytes)
    temps.append(temp)
    shutil.copystat(CATALOG, temp)
    stat = CATALOG.stat()
    os.chown(temp, stat.st_uid, stat.st_gid)
    if digest(CATALOG) != plan['catalogBeforeSha256']:
        raise RuntimeError('Catalogo concorrente')
    os.replace(str(temp), str(CATALOG))  # Rota por ultimo: dependencias completas.
    catalog_written = True
    for relative, entry in plan['targets'].items():
        if digest(ROOT / relative) != entry['sha256']:
            raise RuntimeError('Hash publicado divergente')
except Exception:
    if catalog_written and digest(CATALOG) == hashlib.sha256(catalog_bytes).hexdigest():
        restore = CATALOG.with_name(CATALOG.name + '.ciw-access-restore')
        shutil.copy2(backup / 'program-routes.json', restore)
        os.replace(str(restore), str(CATALOG))
    for relative in reversed(written):
        target = ROOT / relative
        if target.exists() and digest(target) == plan['targets'][relative]['sha256']:
            target.unlink()
    raise
finally:
    for temp in temps:
        if temp.exists():
            temp.unlink()
active = {'instance': 'sursum-api', 'context': 'med', 'businessWrites': False,
          'allowedAuthProviders': [], 'positiveCase': 'pending_real_provider_session',
          'artifacts': {p: e['sha256'] for p, e in plan['targets'].items()},
          'catalogSha256': digest(CATALOG), 'backup': str(backup)}
(STAGE / 'active-manifest.json').write_text(json.dumps(active, indent=2), encoding='utf-8')
print('PASS: 6 artefatos ABL12.2, configuracao negando por padrao e rota mesclada; sem escrita de negocio')
