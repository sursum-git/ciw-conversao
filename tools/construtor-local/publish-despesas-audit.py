"""Substitui somente serviço .p/.r após verificar baseline e staging."""
import hashlib, json, os, shutil, sys
from pathlib import Path
from datetime import datetime, timezone
stage = Path(sys.argv[1]).resolve()
root = Path('/mnt/datasul/ERP/sursum/sursum-api/programs')
manifest = json.loads((stage / 'manifest.json').read_text(encoding='utf-8-sig'))
names = ['DespesasCrudService.p', 'DespesasCrudService.r']
def digest(path):
    return hashlib.sha256(path.read_bytes()).hexdigest()
for name in names:
    if digest(root / name) != manifest['previous'][name]:
        raise SystemExit('Baseline alterado: ' + name)
    if digest(stage / name) != manifest['new'][name]:
        raise SystemExit('Staging divergente: ' + name)
backup = stage / ('backup-' + datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%SZ'))
backup.mkdir()
for name in names:
    shutil.copy2(root / name, backup / name)
    target = root / (name + '.audit-new')
    shutil.copyfile(stage / name, target)
    os.chmod(target, (root / name).stat().st_mode & 0o777)
for name in names:
    os.replace(root / (name + '.audit-new'), root / name)
for name in names:
    if digest(root / name) != manifest['new'][name]:
        raise SystemExit('Hash publicado divergente: ' + name)
print('PASS: somente servico despesas .p/.r publicado; hashes conferidos.')
print('Backup:', backup)
