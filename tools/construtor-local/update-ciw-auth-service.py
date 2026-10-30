"""Delta restrito do servico CIW: baseline, provas12.2 e troca atomica por arquivo."""
import hashlib,json,os,shutil
from pathlib import Path
ROOT=Path('/mnt/datasul/ERP/sursum')
STAGE=Path('/tmp/ciw-auth-20261017-encoding')
HANDLERS=Path('/dados/pasoe/sursum-api/webapps/med/WEB-INF/adapters/web/ROOT/ROOT.handlers')
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
plan=json.loads((STAGE/'delta.json').read_text())
expected={'sursum-api/programs/CiwAuthenticationService'+e for e in ['.p','.r']}
if set(plan['targets'])!=expected:raise RuntimeError('Escopo inesperado')
log=(STAGE/'ciw-auth-compile.log').read_text(encoding='utf-8-sig')
if 'OpenEdge 12.2' not in log or 'CiwAuthenticationService.p COMPILER:ERROR=no' not in log or 'COMPILER:ERROR=yes' in log or 'MISSING' in log:raise RuntimeError('Compilacao incompleta')
for name in plan['proofs']:
 proof=(STAGE/name).read_text(encoding='utf-8-sig')
 if not proof.startswith('PASS ') or 'FAIL' in proof:raise RuntimeError('Prova ausente')
for rel,h in plan['unchanged'].items():
 if sha(ROOT/rel)!=h:raise RuntimeError('Dependencia concorrente: '+rel)
if sha(HANDLERS)!=plan['handlersSha256']:raise RuntimeError('Mapping concorrente')
for rel,e in plan['targets'].items():
 if sha(ROOT/rel)!=e['before'] or sha(STAGE/e['file'])!=e['after']:raise RuntimeError('Baseline/hash divergente')
backup=STAGE/'backup-before';backup.mkdir()
done=[]
try:
 for rel,e in plan['targets'].items():
  target=ROOT/rel;shutil.copy2(target,backup/target.name)
  tmp=target.with_name(target.name+'.ciw-encoding-new')
  with tmp.open('xb') as stream:stream.write((STAGE/e['file']).read_bytes())
  shutil.copystat(target,tmp);st=target.stat();os.chown(tmp,st.st_uid,st.st_gid)
  if sha(target)!=e['before'] or sha(tmp)!=e['after']:raise RuntimeError('Baseline concorrente')
  os.replace(str(tmp),str(target));done.append(rel)
 for rel,e in plan['targets'].items():
  if sha(ROOT/rel)!=e['after']:raise RuntimeError('Publicado divergente')
except Exception:
 for rel in reversed(done):
  target=ROOT/rel
  if sha(target)==plan['targets'][rel]['after']:
   tmp=target.with_name(target.name+'.ciw-encoding-restore');shutil.copy2(backup/target.name,tmp);os.replace(str(tmp),str(target))
 raise
active={'instance':'sursum-api','context':'med','artifacts':{r:e['after'] for r,e in plan['targets'].items()},'supersedes':'ciw-auth-20261017/publish/active-manifest.json','handlersSha256':sha(HANDLERS),'backup':str(backup),'businessWrites':False}
(STAGE/'active-manifest.json').write_text(json.dumps(active,indent=2))
print('PASS: delta de dois arquivos do servico publicado; dependencias e mapping preservados')
