"""Update only compatible cost helpers; add a private adapter, never HTTP routes."""
import hashlib
import json
import os
from pathlib import Path
import re
import shutil
import sys
from datetime import datetime, timezone

stage=Path(sys.argv[1]).resolve()
root=Path('/mnt/datasul/ERP/sursum')
old=json.loads((stage/'previous-manifest.json').read_text(encoding='utf-8-sig'))
new=json.loads((stage/'manifest.json').read_text(encoding='utf-8-sig'))
names=[name+ext for name in ['ContainersCustoCalculator','ContainersPagamentoTotalsService','ContainersCustoReadService','ContainersVersaoCostAdapter'] for ext in ['.p','.r']]
catalog=root/'conf-web-handler/program-routes.json'
catalog_before=catalog.read_bytes()
route=old['route']
if route not in json.loads(catalog_before.decode('utf-8-sig'))['routes']:
    raise SystemExit('Existing cost route changed')
if set(new)!=set(names): raise SystemExit('Unexpected artifact scope')
compile_text=(stage/'compile-container-panel-integration.log').read_text(encoding='utf-8-sig')
if 'OpenEdge 12.2' not in compile_text or 'PASS PANEL INTEGRATION' not in compile_text or re.search('FAIL|COMPILER:ERROR=yes',compile_text):
    raise SystemExit('Successful current12.2 compilation required')
for name in names:
    if name.endswith('.p') and name+' COMPILER:ERROR=no' not in compile_text:
        raise SystemExit('Missing compilation: '+name)
for prefix,count in [('container-panel-finance-tests-',139),('container-payment-totals-tests-',36),('containers-custo-tests-',87),('containers-custo-read-tests-',164),('container-finance-policy-tests-',10),('container-custo-boundary-tests-',52),('containers-versao-cost-adapter-tests-',39)]:
    for culture in ['AMERICAN','EUROPEAN']:
        log=stage/(prefix+culture+'.log')
        text=log.read_text(encoding='utf-8-sig')
        if 'FAIL' in text or not re.search(r'^PASS:?\s*'+str(count)+r' checks NUMERIC-FORMAT='+culture+r'\s*$',text,re.M):
            raise SystemExit('Unexpected test evidence: '+log.name)
def digest(file): return hashlib.sha256(file.read_bytes()).hexdigest()
targets={name:root/'sursum-api/programs'/name for name in names}
for name,target in targets.items():
    relative=str(target.relative_to(root))
    if digest(stage/name)!=new[name]: raise SystemExit('Input hash changed: '+name)
    if relative in old['artifacts']:
        if not target.is_file() or digest(target)!=old['artifacts'][relative]: raise SystemExit('Live baseline changed: '+name)
    elif target.exists(): raise SystemExit('New private adapter already exists: '+name)
backup=stage/('backup-'+datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%SZ'))
backup.mkdir()
(backup/'previous-manifest.json').write_text(json.dumps(old,indent=2)+'\n',encoding='utf-8')
for name,target in targets.items():
    if target.exists(): shutil.copyfile(target,backup/name)
temporary={}
written=[]
try:
    for name,target in targets.items():
        temp=target.with_name(target.name+'.container-profile-new')
        if temp.exists(): raise RuntimeError('Existing staging artifact: '+name)
        shutil.copyfile(stage/name,temp);os.chmod(temp,0o644)
        if digest(temp)!=new[name]: raise RuntimeError('Staging hash failed: '+name)
        temporary[name]=temp
    # Public defaults are compatible in both generations. Adapter has no route and
    # is installed last, after its only private dependencies. No fiscal execution.
    for name,target in targets.items():
        relative=str(target.relative_to(root))
        if relative in old['artifacts']:
            if digest(target)!=old['artifacts'][relative]: raise RuntimeError('Concurrent target change: '+name)
        elif target.exists(): raise RuntimeError('Concurrent adapter creation: '+name)
        os.replace(temporary[name],target);written.append(name)
        if digest(target)!=new[name]: raise RuntimeError('Published hash failed: '+name)
    if catalog.read_bytes()!=catalog_before: raise RuntimeError('Catalog changed concurrently; inspect before finalizing')
except Exception:
    for name in reversed(written):
        target=targets[name]
        if digest(target)!=new[name]: continue
        if (backup/name).exists():
            restore=target.with_name(target.name+'.container-profile-restore')
            if restore.exists(): raise RuntimeError('Existing restore artifact: '+name)
            shutil.copyfile(backup/name,restore);os.chmod(restore,0o644);os.replace(restore,target)
        else: target.unlink()
    raise
finally:
    for temp in temporary.values():
        if temp.exists(): temp.unlink()
active=dict(old)
active.update(publishedAt=datetime.now(timezone.utc).isoformat(),backup=str(backup),privateVersionAdapter=True)
active['artifacts']=dict(old['artifacts'])
active['artifacts'].update({str(target.relative_to(root)):new[name] for name,target in targets.items()})
active['catalogSha256']=hashlib.sha256(catalog_before).hexdigest()
(stage/'active-manifest.json').write_text(json.dumps(active,indent=2)+'\n',encoding='utf-8')
print('PASS:8 cost helper artifacts, compatible defaults, no route or config changes. Backup: '+str(backup))
