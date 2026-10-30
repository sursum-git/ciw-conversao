"""Prepara prova/hash do lote. Token novo somente em .runtime ignorado."""
import hashlib,json,secrets,shutil
from pathlib import Path
ROOT=Path(__file__).resolve().parents[2]
PRIVATE=ROOT/'.runtime/ciw-auth-20261017'
COMPILED=PRIVATE/'boundary-green';SOURCE=ROOT/'integration-src/ciw-auth'
STAGE=PRIVATE/'publish';STAGE.mkdir(exist_ok=True)
REMOTE='/tmp/ciw-auth-20261017'
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
sources=json.loads((COMPILED/'source-manifest.json').read_text())
for n,h in sources.items():
 if sha(SOURCE/n)!=h:raise RuntimeError('Fonte mudou: '+n)
log=(COMPILED/'ciw-auth-compile.log').read_text(encoding='utf-8-sig')
if 'OpenEdge 12.2' not in log or 'COMPILER:ERROR=yes' in log or 'MISSING' in log:raise RuntimeError('Compilacao incompleta')
proofs=['ciw-auth-compile.log','source-manifest.json']+[p+c+'.log' for c in ['AMERICAN','EUROPEAN'] for p in ['ciw-auth-service-','ciw-auth-boundary-']]
for f in proofs:
 if f.endswith('.log') and f!='ciw-auth-compile.log':
  text=(COMPILED/f).read_text()
  if not text.startswith('PASS ') or 'FAIL' in text:raise RuntimeError('Prova ausente')
 shutil.copyfile(COMPILED/f,STAGE/f)
connection=PRIVATE/'connection.json'
if not connection.exists():
 connection.write_text(json.dumps({'url':'http://127.0.0.1:19910/med/web/CiwAuthentication','token':secrets.token_hex(32),'timeoutSeconds':10},indent=2),encoding='utf-8')
token=json.loads(connection.read_text())['token']
(STAGE/'ciw-authentication.json').write_text(json.dumps({'tokenSha256':hashlib.sha256(token.encode()).hexdigest()},indent=2),encoding='utf-8')
targets={}
for name,ext,prefix in [('CiwAuthenticationService','.p','sursum-api/programs/'),('CiwAuthenticationBoundary','.cls',''),('CiwAuthenticationWebHandler','.cls','')]:
 for suffix in [ext,'.r']:
  f=name+suffix;src=(SOURCE if suffix!='.r' else COMPILED)/f
  shutil.copyfile(src,STAGE/f)
  targets[prefix+f]={'file':f,'sha256':sha(src)}
targets['sursum-conf/ciw-authentication.json']={'file':'ciw-authentication.json','sha256':sha(STAGE/'ciw-authentication.json')}
shutil.copyfile(ROOT/'tools/construtor-local/publish-ciw-auth.py',STAGE/'publish-ciw-auth.py')
(STAGE/'manifest.json').write_text(json.dumps({'targets':targets,'handlersBeforeSha256':sha(PRIVATE/'ROOT.handlers.before')},indent=2),encoding='utf-8')
uploads=[{'local':str(p.relative_to(ROOT)).replace('\\','/'),'remote':REMOTE+'/'+p.name} for p in STAGE.iterdir() if p.is_file() and p.name not in ['publish-plan.json','active-manifest.json']]
plan={'server':'runtime','directories':[REMOTE],'uploads':uploads,'commands':['python3 '+REMOTE+'/publish-ciw-auth.py'],'downloads':[{'remote':REMOTE+'/active-manifest.json','local':'.runtime/ciw-auth-20261017/publish/active-manifest.json'},{'remote':'/dados/pasoe/sursum-api/webapps/med/WEB-INF/adapters/web/ROOT/ROOT.handlers','local':'.runtime/ciw-auth-20261017/ROOT.handlers.after'}]}
(STAGE/'publish-plan.json').write_text(json.dumps(plan,indent=2),encoding='utf-8')
print('Lote6artefatos+config preparado; token somente privado, nenhuma conta alterada')
