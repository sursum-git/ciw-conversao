"""Aplicacao canonica limitada ao manifesto, com preservacao de alteracoes concorrentes."""
from pathlib import Path
import hashlib,json,shutil
root=Path(__file__).resolve().parents[2]
state=root/'.runtime/ciw-cotacoes-20261021'
plan=json.loads((state/'canonical-plan.json').read_text(encoding='utf-8'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
allowed=[Path('D:/opencode/motor-progress/v2/sursum-api/programs'),Path('D:/opencode/motor-progress/v2/tests/abl/ciw-cotacoes'),Path('D:/opencode/construtor-pg/backend/src/Runtime'),Path('D:/opencode/construtor-pg/backend/tests/Runtime'),Path('D:/opencode/construtor-pg/integrations/ciw-cotacoes')]
assert not (state/'canonical-manifest.json').exists(),'Ja aplicado; nao repetir'
assert json.loads((state/'compiled122-verification.json').read_text())['success']
for item in plan:
 source=root/item['source'];target=Path(item['target'])
 assert source.is_relative_to(root/'integration-src/ciw-cotacoes') and target.parent in allowed
 assert sha(source)==item['sha256']
 assert (sha(target) if target.exists() else None)==item['before'],'Destino concorrente: '+str(target)
backup=state/'canonical-before';backup.mkdir(exist_ok=True)
for n,item in enumerate(plan):
 source=root/item['source'];target=Path(item['target']);target.parent.mkdir(parents=True,exist_ok=True)
 assert (sha(target) if target.exists() else None)==item['before'],'Destino concorrente'
 if target.exists():shutil.copy2(target,backup/(str(n)+'-'+target.name))
 if item['before'] is None:
  with target.open('xb') as stream:stream.write(source.read_bytes())
 else:shutil.copy2(source,target)
 assert sha(target)==item['sha256']
(state/'canonical-manifest.json').write_text(json.dumps(plan,indent=2),encoding='utf-8')
print('PASS: nove arquivos canonicos aplicados com baseline/hash/backup; demais arquivos preservados.')
