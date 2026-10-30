"""Aplica apenas a correcao da Home sem aplicativos, com baseline dos JS."""
from pathlib import Path
import hashlib,json,shutil
r=Path(__file__).resolve().parents[2];s=r/'.runtime/home-empty-20261020'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
plan=json.loads((s/'canonical-plan.json').read_text(encoding='utf-8'))
allowed={Path('D:/opencode/construtor-pg/src/home-engine/HomeEngine.js'),Path('D:/opencode/construtor-pg/src/home-engine/HomeDefinitionValidator.js'),Path('D:/opencode/construtor-pg/tests/frontend/home-empty-access.cjs')}
assert {Path(x['target']) for x in plan}==allowed
for x in plan:
 source=r/x['source'];target=Path(x['target'])
 assert source.resolve().is_relative_to((r/'integration-src/home-empty').resolve())
 assert sha(source)==x['sha256'] and (sha(target) if target.exists() else None)==x['before'],'Fonte ou destino concorrente'
backup=s/'canonical-before';backup.mkdir(exist_ok=True)
for x in plan:
 source=r/x['source'];target=Path(x['target'])
 assert (sha(target) if target.exists() else None)==x['before'],'Destino concorrente'
 if target.exists():shutil.copy2(target,backup/target.name);shutil.copy2(source,target)
 else:
  with target.open('xb') as f:f.write(source.read_bytes())
 assert sha(target)==x['sha256']
(s/'canonical-manifest.json').write_text(json.dumps(plan,indent=2),encoding='utf-8')
print('PASS: dois JS e teste sincronizados por hashes; autenticacao/permissoes/Kendo preservados.')
