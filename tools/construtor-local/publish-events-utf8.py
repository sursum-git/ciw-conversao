"""Publica somente o par do handler, recusando baseline concorrente."""
import hashlib, json, os, shutil, sys
from pathlib import Path
from datetime import datetime, timezone

stage = Path(sys.argv[1]).resolve()
root = Path('/mnt/datasul/ERP/sursum')
manifest = json.loads((stage / 'manifest.json').read_text(encoding='utf-8-sig'))
names = ['DynamicQueryWebHandler.cls', 'DynamicQueryWebHandler.r']
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
    target = root / (name + '.events-utf8-new')
    shutil.copyfile(stage / name, target)
    os.chmod(target, (root / name).stat().st_mode & 0o777)
for name in names:
    os.replace(root / (name + '.events-utf8-new'), root / name)
for name in names:
    if digest(root / name) != manifest['new'][name]:
        raise SystemExit('Hash publicado divergente: ' + name)
print('PASS: somente DynamicQueryWebHandler.cls/.r publicados; hashes conferidos.')
print('Backup:', backup)
