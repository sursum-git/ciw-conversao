"""Prepara lote novo com prova12.2. Segredo gerado somente em .runtime ignorado."""
import hashlib
import json
import secrets
import shutil
from pathlib import Path

ROOT=Path(__file__).resolve().parents[2]
PRIVATE=ROOT/'.runtime/ciw-access-20261016'
COMPILED=PRIVATE/'compiled-green'
SOURCE=ROOT/'integration-src/ciw-access'
STAGE=PRIVATE/'publish'
REMOTE='/tmp/ciw-access-20261016'
STAGE.mkdir(exist_ok=True)

def digest(p):return hashlib.sha256(p.read_bytes()).hexdigest()
manifest=json.loads((COMPILED/'source-manifest.json').read_text(encoding='utf-8'))
for name,sha in manifest.items():
 if digest(SOURCE/name)!=sha:raise RuntimeError('Fonte mudou apos compilar: '+name)
log=(COMPILED/'compile-ciw-access.log').read_text(encoding='utf-8-sig')
if 'OpenEdge 12.2' not in log or 'COMPILER:ERROR=yes' in log or 'MISSING' in log:raise RuntimeError('Compilacao incompleta')
proofs=['compile-ciw-access.log','source-manifest.json']
for culture in ['AMERICAN','EUROPEAN']:
 for prefix in ['ciw-access-tests-','ciw-access-boundary-']:
  name=prefix+culture+'.log'
  proof=(COMPILED/name).read_text(encoding='utf-8-sig')
  if not proof.startswith('PASS ') or 'FAIL' in proof:raise RuntimeError('Suite nao passou: '+name)
  proofs.append(name)
connection=PRIVATE/'connection.json'
if not connection.exists():
 connection.write_text(json.dumps({'baseUrl':'http://127.0.0.1:19910/med/web','token':secrets.token_hex(32)},indent=2),encoding='utf-8')
token=json.loads(connection.read_text(encoding='utf-8'))['token']
(STAGE/'ciw-access.json').write_text(json.dumps({'tokenSha256':hashlib.sha256(token.encode()).hexdigest(),'allowedAuthProviders':[]},indent=2),encoding='utf-8')
targets={}
for name in ['CiwAccessService','CiwAccessBoundary','CiwAccessRead']:
 for ext in ['.p','.r']:
  filename=name+ext
  path=(SOURCE if ext=='.p' else COMPILED)/filename
  shutil.copyfile(path,STAGE/filename)
  targets['sursum-api/programs/'+filename]={'file':filename,'sha256':digest(path)}
targets['sursum-conf/ciw-access.json']={'file':'ciw-access.json','sha256':digest(STAGE/'ciw-access.json')}
for name in proofs:shutil.copyfile(COMPILED/name,STAGE/name)
shutil.copyfile(ROOT/'tools/construtor-local/publish-ciw-access.py',STAGE/'publish-ciw-access.py')
(STAGE/'manifest.json').write_text(json.dumps({'targets':targets,'catalogBeforeSha256':digest(PRIVATE/'runtime-routes-before.json')},indent=2),encoding='utf-8')
uploads=[{'local':str(p.relative_to(ROOT)).replace('\\','/'),'remote':REMOTE+'/'+p.name} for p in STAGE.iterdir() if p.is_file() and p.name!='publish-plan.json']
plan={'server':'runtime','directories':[REMOTE],'uploads':uploads,
 'commands':['python3 '+REMOTE+'/publish-ciw-access.py'],
 'downloads':[{'remote':REMOTE+'/active-manifest.json','local':'.runtime/ciw-access-20261016/publish/active-manifest.json'},
              {'remote':'/mnt/datasul/ERP/sursum/conf-web-handler/program-routes.json','local':'.runtime/ciw-access-20261016/runtime-routes-after.json'}]}
(STAGE/'publish-plan.json').write_text(json.dumps(plan,indent=2),encoding='utf-8')
print('Lote readonly preparado; configuracao sem origem autorizada. '+str(STAGE/'publish-plan.json'))
