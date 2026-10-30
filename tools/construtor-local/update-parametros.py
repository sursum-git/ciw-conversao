"""Atualiza somente a include IMA e seu consumidor, com verificacao da versao anterior."""
from pathlib import Path
from datetime import datetime, timezone
import hashlib
import json
import os
import shutil
import sys

stage = Path(sys.argv[1]).resolve()
root = Path('/mnt/datasul/ERP/sursum')
targets = {
    'parametros_ima.i': root / 'sursum-api/includes/parametros_ima.i',
    'VerificarParametrosIma.p': root / 'sursum-api/programs/VerificarParametrosIma.p',
    'VerificarParametrosIma.r': root / 'sursum-api/programs/VerificarParametrosIma.r',
}
manifest = json.loads((stage / 'manifest.json').read_text(encoding='utf-8-sig'))
previous = json.loads((stage / 'previous-manifest.json').read_text(encoding='utf-8-sig'))
routes = json.loads((root / 'conf-web-handler/program-routes.json').read_text(encoding='utf-8-sig'))
expected = {'route': '/SursumPrograms/parametros-ima-verificar', 'method': 'POST',
            'program': 'sursum-api/programs/VerificarParametrosIma.p'}
assert [r for r in routes['routes'] if r.get('route') == expected['route']] == [expected], 'Rota divergente'
for name, target in targets.items():
    assert hashlib.sha256(target.read_bytes()).hexdigest() == previous[name], 'Versao anterior divergente: ' + name
    assert hashlib.sha256((stage / name).read_bytes()).hexdigest() == manifest[name], 'Staging divergente: ' + name
backup = stage / ('backup-' + datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%SZ'))
backup.mkdir()
for name, target in targets.items():
    shutil.copy2(target, backup / name)
    temporary = target.with_name(target.name + '.auxiliares-new')
    shutil.copyfile(stage / name, temporary)
    os.chmod(temporary, target.stat().st_mode & 0o777)
# O .r entra por ultimo; consumidores antigos usam o bytecode anterior durante o preparo.
for name, target in targets.items():
    assert hashlib.sha256(target.read_bytes()).hexdigest() == previous[name], 'Mudanca concorrente: ' + name
    os.replace(target.with_name(target.name + '.auxiliares-new'), target)
    assert hashlib.sha256(target.read_bytes()).hexdigest() == manifest[name], 'Publicacao divergente: ' + name
print('PASS: include e consumidor atualizados; hashes conferidos; catalogo e credencial preservados.')
print('Backup:', backup)
