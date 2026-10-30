import hashlib,json,os,shutil,sys
from pathlib import Path
from datetime import datetime,timezone
stage=Path(sys.argv[1]).resolve()
root=Path('/mnt/datasul/ERP/sursum')
monitor=Path('/dados/pasoe/sursum-api/webapps/med/pasoe-request-monitor/app.js')
manifest=json.loads((stage/'manifest.json').read_text(encoding='utf-8-sig'))
for name,expected in manifest['previous'].items():
    if hashlib.sha256((root/name).read_bytes()).hexdigest()!=expected:
        raise SystemExit('Arquivo publicado alterado desde o preflight: '+name)
for name,expected in manifest['new'].items():
    if hashlib.sha256((stage/name).read_bytes()).hexdigest()!=expected:
        raise SystemExit('Hash de staging divergente: '+name)
for name in ['PasoeRuntimeIdentity.cls','PasoeRuntimeIdentity.r']:
    if (root/name).exists(): raise SystemExit('Dependencia ja existe: '+name)
if hashlib.sha256(monitor.read_bytes()).hexdigest()!=manifest['monitor']['previous']:
    raise SystemExit('Monitor alterado desde o preflight.')
if hashlib.sha256((stage/'monitor-app.js').read_bytes()).hexdigest()!=manifest['monitor']['new']:
    raise SystemExit('Hash do monitor em staging divergente.')
backup=stage/('backup-'+datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%SZ'))
backup.mkdir()
for name in manifest['previous']: shutil.copy2(root/name,backup/name)
shutil.copy2(monitor,backup/'monitor-app.js')
# Preparar todos os arquivos antes de trocar o contexto consumidor por ultimo.
order=['PasoeRuntimeIdentity.cls','PasoeRuntimeIdentity.r','PasoeExecutionContext.cls','PasoeExecutionContext.r']
for name in order:
    temp=root/(name+'.identity-new')
    shutil.copyfile(stage/name,temp);os.chmod(temp,0o644)
for name in order: os.replace(root/(name+'.identity-new'),root/name)
temp_monitor=monitor.with_suffix('.js.identity-new')
shutil.copyfile(stage/'monitor-app.js',temp_monitor);os.chmod(temp_monitor,0o644)
os.replace(temp_monitor,monitor)
for name,expected in manifest['new'].items():
    assert hashlib.sha256((root/name).read_bytes()).hexdigest()==expected,name
print('PASS: contexto e dependencia publicados com hashes verificados.')
assert hashlib.sha256(monitor.read_bytes()).hexdigest()==manifest['monitor']['new']
print('PASS: monitor mostra agente e instancia.')
print('Backup:',backup)
