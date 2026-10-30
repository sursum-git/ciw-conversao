"""Install exactly reviewed build5-v6 sources; hash guarded, recoverable backups."""
from pathlib import Path
import hashlib,json,shutil
r=Path(__file__).resolve().parents[2];b=r/'.runtime/ciw-completion-20261028/official-build5-v6'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest() if p.is_file() else None
assert not(b/'canonical-manifest.json').exists(),'Already integrated; inspect before replay'
proof=load(b/'official-compile-verification.json');assert proof['success'] and proof['totalChecks']==2732
review=load(b/'manager-review-final.json');assert review['success']
assert sha(b/'integration-plan.json')==review['integrationPlanSha256']
assert sha(b/'build-manifest.json')==review['buildManifestSha256']
xml=(r/'.runtime/ciw-completion-20261028/official-build5-v5/root-review/php-full.xml').read_text()
assert 'tests="885" assertions="5841"' in xml and 'failures="0"' in xml and 'errors="0"' in xml
plan=load(b/'integration-plan.json');assert len(plan['files'])==16
for x in plan['files']:
 assert sha(Path(x['candidate']))==x['candidateSha256']
 assert sha(Path(x['target']))==x['baselineSha256'],'Concurrent canonical change '+x['target']
history=Path('D:/opencode/motor-progress/v2/sursum-api/programs/ContainersVersionHistoryService.p')
assert sha(history)==load(b/'build-manifest.json')['preservedHistoryParentFixSha256']
route=plan['onlyRouteAddition'];target=Path(route['target']);assert sha(target)==route['baselineSha256']
routes=load(target);addition=route['operations'][0]['value'];assert not any(x['route']==addition['route'] for x in routes['routes'])
routes['routes'].append(addition)
route_candidate=b/'program-routes-with-batch.json';route_candidate.write_text(json.dumps(routes,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
items=plan['files']+[dict(target=str(target),candidate=str(route_candidate),baselineSha256=route['baselineSha256'],candidateSha256=sha(route_candidate))]
backup=b/'canonical-backup';backup.mkdir();written=[]
for i,x in enumerate(items):
 if x['baselineSha256'] is not None:shutil.copy2(Path(x['target']),backup/(str(i)+'-'+Path(x['target']).name))
try:
 for x in items:
  p=Path(x['target']);assert sha(p)==x['baselineSha256'];p.parent.mkdir(parents=True,exist_ok=True)
  shutil.copyfile(Path(x['candidate']),p);assert sha(p)==x['candidateSha256'];written.append(x)
except Exception:
 for x in reversed(written):
  p=Path(x['target'])
  if sha(p)==x['candidateSha256']:
   if x['baselineSha256'] is None:p.unlink()
   else:shutil.copy2(backup/(str(items.index(x))+'-'+p.name),p)
 raise
assert sha(history)==load(b/'build-manifest.json')['preservedHistoryParentFixSha256']
out=dict(success=True,files=[dict(target=x['target'],before=x['baselineSha256'],sha256=x['candidateSha256'],source=x['candidate']) for x in items],sourceFiles=16,routeAdditions=1,businessWrites=False,runtimePublished=False,metadataPublished=False)
(b/'canonical-manifest.json').write_text(json.dumps(out,indent=2)+'\n')
print('PASS16 reviewed canonical sources and one additive route; backups/hashes verified; runtime pending')
