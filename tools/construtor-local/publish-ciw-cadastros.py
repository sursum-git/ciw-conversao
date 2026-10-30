"""Publicador remoto delimitado do lote CIW; somente arquivos novos compilados12.2."""
from pathlib import Path
import hashlib,json,os,shutil
ROOT=Path('/mnt/datasul/ERP/sursum');STAGE=Path('/tmp/ciw-cadastros-20261020')
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
plan=json.loads((STAGE/'manifest.json').read_text())
expected={'sursum-api/programs/'+name+ext for name in ['CiwCadastroCrudService','CiwCadastroDefinition','CiwCadastrosCrud'] for ext in ['.p','.r']}|{'sursum-conf/ciw-cadastros-api.json'}
assert set(plan['targets'])==expected,'Escopo invalido'
compileLog=(STAGE/'compile-ciw-cadastros.log').read_text(encoding='utf-8-sig')
assert 'OpenEdge 12.2' in compileLog and 'COMPILER:ERROR=yes' not in compileLog
for name in ['CiwCadastroCrudService','CiwCadastroDefinition','CiwCadastrosCrud']:
 assert name+'.p COMPILER:ERROR=no' in compileLog,'Fonte sem prova de compilacao'
for culture in ['AMERICAN','EUROPEAN']:
 log=(STAGE/('ciw-cadastro-tests-'+culture+'.log')).read_text(encoding='utf-8-sig');assert log.startswith('PASS 60 checks ') and 'FAIL' not in log
for relative,entry in plan['targets'].items():
 assert not (ROOT/relative).exists(),'Arquivo existente requer revisao'
 assert sha(STAGE/entry['file'])==entry['sha256'],'Staging divergente'
catalogPath=ROOT/'conf-web-handler/program-routes.json';baseline=sha(catalogPath);catalog=json.loads(catalogPath.read_text(encoding='utf-8-sig'))
route={'route':'/SursumPrograms/ciw-cadastros','method':'POST','program':'sursum-api/programs/CiwCadastrosCrud.p'}
assert not any(r.get('route')==route['route'] for r in catalog['routes']),'Rota existente'
catalog['routes'].append(route);catalogBytes=(json.dumps(catalog,ensure_ascii=False,indent=2)+'\n').encode()
backup=STAGE/'backup-before';backup.mkdir();shutil.copy2(catalogPath,backup/'program-routes.json')
written=[];temps=[];catalogWritten=False
try:
 for relative,entry in plan['targets'].items():
  target=ROOT/relative;temp=target.with_name(target.name+'.ciw-cadastros-new');temps.append(temp)
  with temp.open('xb') as f:f.write((STAGE/entry['file']).read_bytes())
  template=ROOT/('sursum-conf/ciw-access.json' if relative.endswith('.json') else 'sursum-api/programs/TiposAnexoCrud'+target.suffix)
  stat=template.stat();os.chmod(temp,stat.st_mode&0o777);os.chown(temp,stat.st_uid,stat.st_gid)
  assert sha(temp)==entry['sha256'];os.link(temp,target);written.append(target);temp.unlink()
 assert sha(catalogPath)==baseline,'Catalogo concorrente'
 temp=catalogPath.with_name(catalogPath.name+'.ciw-cadastros-new');temps.append(temp)
 with temp.open('xb') as f:f.write(catalogBytes)
 shutil.copystat(catalogPath,temp);stat=catalogPath.stat();os.chown(temp,stat.st_uid,stat.st_gid)
 assert sha(catalogPath)==baseline,'Catalogo concorrente'
 os.replace(temp,catalogPath);catalogWritten=True
 for relative,entry in plan['targets'].items():assert sha(ROOT/relative)==entry['sha256']
except Exception:
 if catalogWritten and sha(catalogPath)==hashlib.sha256(catalogBytes).hexdigest():shutil.copy2(backup/'program-routes.json',catalogPath)
 for target in reversed(written):
  rel=str(target.relative_to(ROOT))
  if target.exists() and sha(target)==plan['targets'][rel]['sha256']:target.unlink()
 raise
finally:
 for t in temps:
  if t.exists():t.unlink()
active={'instance':'sursum-api','context':'med','businessWritesDuringPublication':False,'artifacts':{k:v['sha256'] for k,v in plan['targets'].items()},'catalogSha256':sha(catalogPath),'backup':str(backup),'runtimeValidation':'pending'}
(STAGE/'active-manifest.json').write_text(json.dumps(active,indent=2));print('PASS:7artefatos12.2/config e rota CIW publicados com guard/backup; sem escrita de negocio.')
