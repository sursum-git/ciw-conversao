"""Sincronizacao canonica limitada ao manifesto desta entrega, com baseline."""
from pathlib import Path
import json,hashlib,shutil
r=Path(__file__).resolve().parents[2];s=r/'.runtime/ciw-referencias-20261020'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
plan=json.loads((s/'canonical-plan.json').read_text(encoding='utf-8'))
allowed=[Path('D:/opencode/motor-progress/v2/sursum-api/programs'),Path('D:/opencode/motor-progress/v2/tests/abl/ciw-referencias'),Path('D:/opencode/construtor-pg/integrations/ciw-referencias')]
for item in plan:
 source=r/item['source'];target=Path(item['target'])
 assert target.parent in allowed and source.is_relative_to(r/'integration-src/ciw-referencias')
 assert sha(source)==item['sha256']
 assert (sha(target) if target.exists() else None)==item['before'],'Destino concorrente'
backup=s/'canonical-before';backup.mkdir(exist_ok=True)
for n,item in enumerate(plan):
 source=r/item['source'];target=Path(item['target']);target.parent.mkdir(parents=True,exist_ok=True)
 assert (sha(target) if target.exists() else None)==item['before'],'Destino concorrente'
 if target.exists():shutil.copy2(target,backup/(str(n)+'-'+target.name))
 if item['before'] is None:
  with target.open('xb') as f:f.write(source.read_bytes())
 else:shutil.copy2(source,target)
 assert sha(target)==item['sha256']
(s/'canonical-manifest.json').write_text(json.dumps(plan,indent=2),encoding='utf-8')
print('PASS: fontes, teste e metadados canonicos sincronizados por guarda/hash.')
