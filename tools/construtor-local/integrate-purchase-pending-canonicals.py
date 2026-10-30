from pathlib import Path
import json,hashlib
r=Path(__file__).resolve().parents[2];b=r/'.runtime/purchase-pending-integration-20261028';c=r/'integration-src/purchase-pending-20261028';motor=Path('D:/opencode/motor-progress/v2');builder=Path('D:/opencode/construtor-pg')
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()if p.is_file()else None
assert not (b/'canonical-manifest.json').exists()
review=load(b/'review-final.json');assert review['openP1P2']==[]
proof=load(b/'official-compile-verification.json');assert proof['success'] and proof['testsPerCombination']==298
assert load(b/'metadata/js-validation.json')['success'] and load(b/'runtime-before.json')['success']
for x in load(r/'.runtime/purchase-pending-manager-20261028/frozen-candidate-proof.json')['files']:assert sha(Path(x['path']))==x['sha256']
baselines={str(Path(x['source'])):x['sha256'] for x in load(b/'baseline-manifest.json')};plan=[]
for x in proof['files']:
 if x['relative'].endswith('.r'):continue
 source=r/x['source'];assert sha(source)==x['sha256'];target=motor/x['relative'];plan.append((source,target,baselines.get(str(target))))
for x in load(b/'merged/php-manifest.json').values():plan.append((Path(x['candidate']),Path(x['target']),x['baselineSha256']))
for scope,folder in [('signals-global','ciw-purchase-signals-global'),('signal-config','ciw-signal-config')]:
 for source in sorted((c/scope/'metadata').glob('*.json')):plan.append((source,builder/'integrations'/folder/source.name,None))
 for source in sorted((c/scope/'tests').glob('*Test.p')):plan.append((source,motor/'tests/abl'/('purchase-signals-global'if scope=='signals-global'else'purchase-signal-config')/source.name,None))
assert len(plan)==21,len(plan)
for source,target,expected in plan:assert sha(target)==expected,'Concurrent or existing target '+str(target)
backup=b/'canonical-backup';assert not backup.exists();backup.mkdir();items=[]
for i,(source,target,expected) in enumerate(plan):
 q=None
 if expected is not None:q=backup/(str(i)+'-'+target.name);q.write_bytes(target.read_bytes())
 assert sha(target)==expected;target.parent.mkdir(parents=True,exist_ok=True);target.write_bytes(source.read_bytes());assert sha(target)==sha(source)
 items.append(dict(source=str(source),target=str(target),sha256=sha(target),beforeSha256=expected,backup=str(q)if q else None))
(b/'canonical-manifest.json').write_text(json.dumps(dict(success=True,files=items,reviewSha256=sha(b/'review-final.json'),businessWrites=False),indent=2)+'\n')
print('PASS21canonical files integrated byhash/backup;6existing preserved/extended;no business writes')
