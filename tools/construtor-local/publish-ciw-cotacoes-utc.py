"""Delta unico da conversao UTC; fonte/r compilado12.2, sem tocar outros servicos."""
from pathlib import Path
import json,hashlib,shutil,os
root=Path('/mnt/datasul/ERP/sursum');stage=Path('/tmp/ciw-cotacoes-utc-20261021')
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
m=json.loads((stage/'manifest.json').read_text())
expected={'sursum-api/programs/CiwCotacoesService.p','sursum-api/programs/CiwCotacoesService.r'}
assert set(m['targets'])==expected
log=(stage/'compile-ciw-cotacoes.log').read_text(encoding='utf-8-sig')
assert 'OpenEdge 12.2' in log and 'COMPILER:ERROR=yes' not in log
for n in ['CiwCotacoesService','ContainerCostInvalidation','CiwCadastrosCrud','CiwCotacoesTest']:assert n+'.p COMPILER:ERROR=no' in log
for cp in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:assert (stage/f'cotacoes-{cp}-{culture}.log').read_text(encoding='utf-8-sig').strip()=='PASS 81 checks '+culture
for rel,item in m['targets'].items():
 assert sha(stage/item['file'])==item['sha256']
 assert sha(root/rel)==item['before'],'Mudanca concorrente'
backup=stage/'backup-before';backup.mkdir();written=[]
for rel,item in m['targets'].items():shutil.copy2(root/rel,backup/Path(rel).name)
try:
 for rel,item in sorted(m['targets'].items()):
  target=root/rel;temp=target.with_name(target.name+'.ciw-utc')
  with temp.open('xb') as stream:stream.write((stage/item['file']).read_bytes())
  shutil.copystat(target,temp);st=target.stat();os.chown(temp,st.st_uid,st.st_gid)
  assert sha(target)==item['before']
  os.replace(temp,target);written.append(rel)
 for rel,item in m['targets'].items():assert sha(root/rel)==item['sha256']
except Exception:
 for rel in reversed(written):
  if sha(root/rel)==m['targets'][rel]['sha256']:shutil.copy2(backup/Path(rel).name,root/rel)
 raise
(stage/'active-manifest.json').write_text(json.dumps({'instance':'sursum-api','context':'med','targets':m['targets'],'routesChanged':False,'runtimeValidation':'pending'},indent=2))
print('PASS: delta UTC p/r12.2 publicado; demais artefatos preservados.')
