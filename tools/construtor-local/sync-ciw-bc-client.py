"""Sincroniza apenas os candidatos revisados; recusa mudancas concorrentes."""
from pathlib import Path
import hashlib, json, shutil, os
root = Path(__file__).resolve().parents[2]
state = root / '.runtime/ciw-bc-client-20261021'
sha = lambda p: hashlib.sha256(p.read_bytes()).hexdigest()
plan = json.loads((state/'canonical-plan.json').read_text())
assert 10 <= len(plan) <= 15
for item in plan:
    source = root/item['source']; target = Path(item['target'])
    assert source.resolve().is_relative_to(root/'integration-src/ciw-bc-client')
    assert any(target.resolve().is_relative_to(Path(p)) for p in ['D:/opencode/construtor-pg/backend', 'D:/opencode/construtor-pg/integrations/ciw-bc-client', 'D:/opencode/motor-progress/v2/sursum-api/programs', 'D:/opencode/motor-progress/v2/tests/abl/ciw-cotacoes'])
    assert sha(source) == item['sha256']
    assert (sha(target) if target.exists() else None) == item['before'], 'Mudanca concorrente: '+str(target)
backup = state/'canonical-before'; backup.mkdir()
for index,item in enumerate(plan):
    source = root/item['source']; target = Path(item['target'])
    if target.exists(): shutil.copy2(target, backup/(str(index)+'-'+target.name))
    target.parent.mkdir(parents=True, exist_ok=True)
    temp = target.with_name(target.name+'.ciw-bc-client')
    with temp.open('xb') as stream: stream.write(source.read_bytes())
    assert (sha(target) if target.exists() else None) == item['before']
    os.replace(temp,target)
    assert sha(target) == item['sha256']
(state/'canonical-manifest.json').write_text(json.dumps({'success':True,'files':plan},indent=2))
print('PASS: '+str(len(plan))+' arquivos canonicos sincronizados com baseline e backup.')
