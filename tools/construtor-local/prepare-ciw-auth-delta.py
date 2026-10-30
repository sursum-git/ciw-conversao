"""Prepara delta corrigido; nao acessa tokens ou credenciais."""
import hashlib,json,shutil
from pathlib import Path
ROOT=Path(__file__).resolve().parents[2]
PRIVATE=ROOT/'.runtime/ciw-auth-20261017';STAGE=PRIVATE/'encoding-publish';STAGE.mkdir(exist_ok=True)
REMOTE='/tmp/ciw-auth-20261017-encoding'
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
before=json.loads((PRIVATE/'publish/active-manifest.json').read_text())
sources=json.loads((PRIVATE/'final-green/source-manifest.json').read_text())
targets={}
for ext in ['.p','.r']:
 name='CiwAuthenticationService'+ext;rel='sursum-api/programs/'+name
 source=(ROOT/'integration-src/ciw-auth' if ext=='.p' else PRIVATE/'final-green')/name
 if ext=='.p' and sha(source)!=sources[name]:raise RuntimeError('Fonte mudou apos compilacao')
 shutil.copy2(source,STAGE/name);targets[rel]={'file':name,'before':before['artifacts'][rel],'after':sha(source)}
proofs=[]
for folder,names in [('final-green',[p+c+'.log' for c in ['AMERICAN','EUROPEAN'] for p in ['ciw-auth-service-','ciw-auth-boundary-']]),('encoding-green',['ciw-auth-encoding-'+cp+'.log' for cp in ['UTF-8','ISO8859-1']])]:
 for n in names:
  proof=(PRIVATE/folder/n).read_text(encoding='utf-8-sig')
  if not proof.startswith('PASS ') or 'FAIL' in proof:raise RuntimeError('Sem prova verde: '+n)
  shutil.copy2(PRIVATE/folder/n,STAGE/n);proofs.append(n)
shutil.copy2(PRIVATE/'final-green/ciw-auth-compile.log',STAGE/'ciw-auth-compile.log')
shutil.copy2(ROOT/'tools/construtor-local/update-ciw-auth-service.py',STAGE/'update-ciw-auth-service.py')
shutil.copy2(PRIVATE/'refresh-med.py',STAGE/'refresh-med.py')
(STAGE/'delta.json').write_text(json.dumps({'targets':targets,'unchanged':{r:h for r,h in before['artifacts'].items() if r not in targets},'handlersSha256':before['handlersSha256'],'proofs':proofs},indent=2))
files=[p for p in STAGE.iterdir() if p.is_file() and p.name not in ['plan.json','active-manifest.json']]
plan={'server':'runtime','directories':[REMOTE],'uploads':[{'local':p.relative_to(ROOT).as_posix(),'remote':REMOTE+'/'+p.name} for p in files],'commands':['python3 '+REMOTE+'/update-ciw-auth-service.py','python3 '+REMOTE+'/refresh-med.py'],'downloads':[{'remote':REMOTE+'/active-manifest.json','local':(STAGE/'active-manifest.json').relative_to(ROOT).as_posix()},{'remote':'/tmp/ciw-auth-20261017/med-session-refresh.json','local':(STAGE/'med-session-refresh.json').relative_to(ROOT).as_posix()}]}
(STAGE/'plan.json').write_text(json.dumps(plan,indent=2))
print('Delta preparado com seis provas verdes e baseline exato')
