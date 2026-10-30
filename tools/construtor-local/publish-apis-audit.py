"""Publica somente os dois servicos auditados, com baseline e backup."""
import hashlib, json, os, shutil, sys
from datetime import datetime, timezone
from pathlib import Path
stage=Path(sys.argv[1]).resolve()
root=Path('/mnt/datasul/ERP/sursum')
names=['EmpresasCrudService.p','EmpresasCrudService.r','TiposAnexoCrudService.p','TiposAnexoCrudService.r']
baseline=json.loads((stage/'baseline.json').read_text(encoding='utf-8-sig'))
new=json.loads((stage/'manifest.json').read_text(encoding='utf-8-sig'))
if set(new)!=set(names): raise SystemExit('Manifesto fora do escopo')
def digest(p): return hashlib.sha256(p.read_bytes()).hexdigest()
def target(name):
    if name=='program-routes.json': return root/'conf-web-handler'/name
    if name.endswith('.json'): return root/'sursum-conf'/name
    return root/'sursum-api/programs'/name
for name,expected in baseline['hashes'].items():
    if digest(target(name))!=expected: raise SystemExit('Baseline alterado: '+name)
for name in names:
    if digest(stage/name)!=new[name]: raise SystemExit('Staging divergente: '+name)
backup=stage/('backup-'+datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%SZ'))
backup.mkdir()
for name in names:
    shutil.copy2(target(name),backup/name)
    temporary=target(name).with_name(name+'.audit-new')
    shutil.copyfile(stage/name,temporary)
    os.chmod(temporary,target(name).stat().st_mode & 0o777)
for name in names: os.replace(target(name).with_name(name+'.audit-new'),target(name))
for name in names:
    if digest(target(name))!=new[name]: raise SystemExit('Hash publicado divergente: '+name)
result={**baseline,'hashes':{**baseline['hashes'],**new},'backup':str(backup),'published':names,
        'at':datetime.now(timezone.utc).isoformat()}
(stage/'active-manifest.json').write_text(json.dumps(result,indent=2)+'\n',encoding='utf-8')
print(json.dumps(result,indent=2))
