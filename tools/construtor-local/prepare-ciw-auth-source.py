"""Prepara ativacao com prova publica da sessao; nao transfere bearer token."""
import json,shutil
from pathlib import Path
ROOT=Path(__file__).resolve().parents[2];PRIVATE=ROOT/'.runtime/ciw-auth-20261017';STAGE=PRIVATE/'source-enable';STAGE.mkdir(exist_ok=True)
remote='/tmp/ciw-auth-source-20261017'
proof=json.loads((PRIVATE/'verified-real-session.json').read_text())
proof.pop('sessionId',None)
active=json.loads((ROOT/'.runtime/ciw-access-20261016/publish/active-manifest.json').read_text())
(STAGE/'manifest.json').write_text(json.dumps({'proof':proof,'artifacts':active['artifacts']},indent=2))
shutil.copy2(ROOT/'tools/construtor-local/enable-ciw-auth-source.py',STAGE/'enable.py')
plan={'server':'runtime','directories':[remote],'uploads':[{'local':(STAGE/n).relative_to(ROOT).as_posix(),'remote':remote+'/'+n} for n in ['manifest.json','enable.py']],'commands':['python3 '+remote+'/enable.py'],'downloads':[{'remote':remote+'/active-manifest.json','local':(STAGE/'active-manifest.json').relative_to(ROOT).as_posix()}]}
(STAGE/'plan.json').write_text(json.dumps(plan,indent=2));print('Ativacao delimitada preparada apos prova de sessao real')
