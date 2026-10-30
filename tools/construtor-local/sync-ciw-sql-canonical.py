"""Sincronizacao delimitada CIW, com guards e backup; nunca toca Kendo/metadados."""
from pathlib import Path
import hashlib,json
ROOT=Path(__file__).resolve().parents[2]
PRIVATE=ROOT/'.runtime/ciw-authz-sql-20261019';B=Path('D:/opencode/construtor-pg')
MANIFEST=PRIVATE/'canonical-manifest.json'
sha=lambda b:hashlib.sha256(b).hexdigest()
state=json.loads(MANIFEST.read_text()) if MANIFEST.exists() else {}
sources=ROOT/'integration-src/ciw-sql/backend'
pairs=[(p,B/'backend'/p.relative_to(sources)) for p in sources.rglob('*.php') if p.relative_to(sources).as_posix()!='tests/bootstrap.php']
service=B/'backend/config/services.yaml';key=str(service);original=service.read_bytes()
alias=b"\n    App\\Ciw\\CiwSqlGrantReaderInterface: '@App\\Ciw\\PdoCiwSqlGrantReader'\n    App\\Ciw\\CiwProgressIdentityClientInterface: '@App\\Ciw\\CiwProgressIdentityClient'\n"
if key not in state:
    candidate=PRIVATE/'services.yaml.candidate';candidate.write_bytes(original+alias)
    baseline=PRIVATE/'services.yaml.before';baseline.write_bytes(original)
    state[key]={'baseline':sha(original),'sha256':sha(original)}
else:
    candidate=PRIVATE/'services.yaml.candidate'
    candidate.write_bytes((PRIVATE/'services.yaml.before').read_bytes()+alias)
pairs.append((candidate,service))
# Conferir TODOS os destinos antes da primeira copia.
for source,target in pairs:
    key=str(target);actual=sha(target.read_bytes()) if target.exists() else None
    expected=state.get(key,{}).get('sha256')
    if actual!=expected:raise RuntimeError('Guard recusou alteracao concorrente: '+key)
for source,target in pairs:
    key=str(target);target.parent.mkdir(parents=True,exist_ok=True)
    content=source.read_bytes();target.write_bytes(content)
    state[key]={'baseline':state.get(key,{}).get('baseline'),'sha256':sha(content)}
MANIFEST.write_text(json.dumps(state,indent=2)+'\n')
print('Sincronizados '+str(len(pairs))+' arquivos delimitados; guards/hash confirmados.')
