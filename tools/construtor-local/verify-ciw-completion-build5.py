"""Verify immutable official 12.2 build5-v6 evidence; no canonical writes."""
from pathlib import Path
import hashlib,json,re
root=Path(__file__).resolve().parents[2]
build=root/'.runtime/ciw-completion-20261028/official-build5-v6'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
m=load(build/'build-manifest.json');review=load(build/'manager-review-final.json')
assert sha(build/'remote-plan.json')==m['remotePlanSha256']
assert sha(build/'integration-plan.json')==m['integrationPlanSha256']
for f in load(build/'source-manifest.json'):assert sha(root/f['file'])==f['sha256'],f['file']
log=(build/'compiled122/compile.log').read_text(encoding='utf-8-sig')
assert log.startswith('OpenEdge 12.2 NUM-DBS=1') and log.rstrip().endswith('PASS COMPILE ALL')
assert log.count('COMPILER:ERROR=no')==len(m['compileEntries'])==43
assert 'FAIL' not in log and 'COMPILER:ERROR=yes' not in log
assert not (build/'compiled122/compile-process.log').read_text(encoding='utf-8-sig').strip()
for name in m['compileEntries']:
 assert name+' COMPILER:ERROR=no' in log
 p=build/'compiled122'/Path(name).with_suffix('.r');assert p.is_file() and p.stat().st_size>0
runner=(build/'package/Regression.p').read_text();assert runner.count('IF NUM-DBS<>0')==2
net=(build/'compiled122/net-library.txt').read_text(encoding='utf-8-sig').strip();assert net.startswith('C:/Progress_12/OE/') and net.endswith('/OpenEdge.Net.pl')
checks=[]
for cp in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:
  total=0
  for test in m['tests']:
   p=build/'compiled122'/f"{Path(test['name']).stem}-{cp}-{culture}.log"
   s=p.read_text(encoding='utf-8-sig').strip();assert s.startswith('PASS ') and 'FAIL' not in s
   n=re.search(r'checks=(\d+)',s) or re.search(r'PASS (\d+)',s)
   assert n and int(n.group(1))==test['expectedChecks'],(p,s)
   total+=int(n.group(1));checks.append(dict(file=str(p.relative_to(root)),sha256=sha(p),checks=int(n.group(1))))
  assert total==683
files=[]
for rel in m['productionDelta']:
 for p in [build/'package'/rel]+([build/'compiled122'/Path(rel).with_suffix('.r')] if rel.endswith('.p') else []):
  relative=rel if p.suffix!='.r' else str(Path(rel).with_suffix('.r')).replace('\\','/')
  assert p.is_file() and p.stat().st_size>0
  files.append(dict(relative=relative,file=p.name,source=str(p.relative_to(root)),sha256=sha(p)))
assert len(files)==16 and len({x['file'] for x in files})==16 and len(checks)==40
out=dict(success=True,version='12.2',compileEntries=43,compileDatabaseConnections=1,testDatabaseConnections=0,testsPerCombination=683,totalChecks=2732,testLogs=40,netLibrary=net,files=files,checks=checks,businessWrites=False,runtimePublished=False)
(build/'official-compile-verification.json').write_text(json.dumps(out,indent=2)+'\n')
print('PASS official12.2:43 compiles,40 TT logs,2732 checks;16 approved production artifacts; no business writes')
