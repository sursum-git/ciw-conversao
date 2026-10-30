"""Delta delimitado de encoding; exige hash ativo e prova nas duas codepages."""
from pathlib import Path
import hashlib,json,os,shutil
ROOT=Path('/mnt/datasul/ERP/sursum');STAGE=Path('/tmp/ciw-cadastros-20261020')
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
active=json.loads((STAGE/'active-manifest.json').read_text())
assert active['instance']=='sursum-api' and active['context']=='med'
for cp in ['UTF-8','ISO8859-1']:
 assert (STAGE/('ciw-cadastro-definition-'+cp+'.log')).read_text().strip()=='PASS 8 checks '+cp
compileLog=(STAGE/'compile-ciw-cadastros.log').read_text(encoding='utf-8-sig')
assert 'OpenEdge 12.2' in compileLog and 'COMPILER:ERROR=yes' not in compileLog
assert 'CiwCadastroDefinition.p COMPILER:ERROR=no' in compileLog
for culture in ['AMERICAN','EUROPEAN']:
 assert (STAGE/('ciw-cadastro-tests-'+culture+'.log')).read_text().strip()=='PASS 60 checks '+culture
manifest=json.loads((STAGE/'encoding-manifest.json').read_text())
expected={'sursum-api/programs/CiwCadastroDefinition'+ext for ext in ['.p','.r']}
assert set(manifest)==expected
for rel,entry in manifest.items():
 assert sha(ROOT/rel)==active['artifacts'][rel],'Destino concorrente'
 assert sha(STAGE/entry['file'])==entry['sha256'],'Staging divergente'
backup=STAGE/'backup-encoding';backup.mkdir()
for rel in expected:shutil.copy2(ROOT/rel,backup/Path(rel).name)
written=[]
try:
 for rel,entry in manifest.items():
  target=ROOT/rel;temp=target.with_name(target.name+'.ciw-encoding')
  with temp.open('xb') as f:f.write((STAGE/entry['file']).read_bytes())
  shutil.copystat(target,temp);st=target.stat();os.chown(temp,st.st_uid,st.st_gid)
  assert sha(target)==active['artifacts'][rel],'Destino concorrente'
  os.replace(temp,target);written.append(rel)
 for rel,entry in manifest.items():assert sha(ROOT/rel)==entry['sha256']
except Exception:
 for rel in reversed(written):
  if sha(ROOT/rel)==manifest[rel]['sha256']:shutil.copy2(backup/Path(rel).name,ROOT/rel)
 raise
for rel,entry in manifest.items():active['artifacts'][rel]=entry['sha256']
active['encodingBackup']=str(backup);active['runtimeValidation']='pending'
(STAGE/'active-manifest.json').write_text(json.dumps(active,indent=2))
print('PASS: delta UTF-8 .p/.r12.2 com hashes/backup; sem escrita de negocio.')
