"""Publicacao limitada de tres classes e fixture temporaria de verificacao."""
import hashlib,json,os,shutil,sys
from pathlib import Path
from datetime import datetime,timezone
stage=Path(sys.argv[1]).resolve()
action=sys.argv[2] if len(sys.argv)>2 else 'publish'
root=Path('/mnt/datasul/ERP/sursum')
catalog=root/'conf-web-handler/program-routes.json'
manifest=json.loads((stage/'manifest.json').read_text(encoding='utf-8-sig'))
route={'route':'/SursumPrograms/program-log-verificar','method':'POST','program':'sursum-api/programs/ProgramLogProbe.p'}
names=['PasoeExecutionContext.cls','PasoeExecutionContext.r','ApiExecutionRepository.cls','ApiExecutionRepository.r','JsonProgramWebHandler.cls','JsonProgramWebHandler.r']
probe=['sursum-api/programs/ProgramLogProbe.p','sursum-api/programs/ProgramLogProbe.r']
routes=json.loads(catalog.read_text(encoding='utf-8-sig'))
matches=[r for r in routes['routes'] if r.get('route')==route['route']]
def digest(p):return hashlib.sha256(p.read_bytes()).hexdigest()
if action=='remove-probe':
    if matches != [route]:raise SystemExit('Fixture/rota alterada; nao remover')
    for name in probe:
        if digest(root/name)!=manifest['new'][name]:raise SystemExit('Fixture alterada: '+name)
    routes['routes']=[r for r in routes['routes'] if r!=route]
    temp=catalog.with_suffix('.json.program-log-new')
    temp.write_text(json.dumps(routes,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
    os.chmod(temp,catalog.stat().st_mode & 0o777);os.replace(temp,catalog)
    for name in probe:(root/name).unlink()
    print('PASS: somente fixture e rota temporarias removidas; suporte de log mantido.')
    raise SystemExit(0)
if action!='publish':raise SystemExit('Acao desconhecida')
if matches or any((root/p).exists() for p in probe):raise SystemExit('Fixture ja existe: revisar')
for name in names:
    if digest(root/name)!=manifest['previous'][name]:raise SystemExit('Baseline alterado: '+name)
for name in names+probe:
    if digest(stage/name)!=manifest['new'][name]:raise SystemExit('Staging divergente: '+name)
backup=stage/('backup-'+datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%SZ'));backup.mkdir()
shutil.copy2(catalog,backup/catalog.name)
for name in names:shutil.copy2(root/name,backup/name)
# Preparar todos antes de carregar consumidor novo; interfaces antigas preservadas.
for name in names+probe:
    temp=(root/name).with_name(Path(name).name+'.program-log-new')
    shutil.copyfile(stage/name,temp);os.chmod(temp,0o644)
for name in names+probe:
    temp=(root/name).with_name(Path(name).name+'.program-log-new')
    os.replace(temp,root/name)
routes['routes'].append(route)
temp=catalog.with_suffix('.json.program-log-new')
temp.write_text(json.dumps(routes,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
os.chmod(temp,catalog.stat().st_mode & 0o777);os.replace(temp,catalog)
for name in names+probe:
    if digest(root/name)!=manifest['new'][name]:raise SystemExit('Hash publicado divergente: '+name)
print('PASS: tres classes publicadas com hashes; fixture temporaria protegida adicionada.')
print('Backup:',backup)
