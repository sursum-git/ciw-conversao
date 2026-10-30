"""Verify downloaded official6-v2 compilation and all56 TT logs; no canonical writes."""
from pathlib import Path
import hashlib,json,re
r=Path(__file__).resolve().parents[2];b=r/'.runtime/ciw-completion-20261028/official-build6-v2'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
m=load(b/'build-manifest.json');review=load(b/'manager-review-final.json');assert review['success'] and review['remainingP1P2']==[]
for name,key in [('build-manifest.json','buildManifestSha256'),('source-manifest.json','sourceManifestSha256'),('integration-plan.json','integrationPlanSha256'),('remote-plan.json','remotePlanSha256')]:assert sha(b/name)==review[key]
for f in load(b/'source-manifest.json'):assert sha(r/f['file'])==f['sha256']
log=(b/'compiled122/compile.log').read_text(encoding='utf-8-sig');assert log.startswith('OpenEdge 12.2 NUM-DBS=1') and log.rstrip().endswith('PASS COMPILE ALL')
assert log.count('COMPILER:ERROR=no')==len(m['compileEntries'])==55 and 'FAIL'not in log and 'COMPILER:ERROR=yes'not in log
assert not(b/'compiled122/compile-process.log').read_text(encoding='utf-8-sig').strip()
for name in m['compileEntries']:
 assert name+' COMPILER:ERROR=no'in log;p=b/'compiled122'/Path(name).with_suffix('.r');assert p.is_file() and p.stat().st_size>0
runner=(b/'package/Regression.p').read_text();assert runner.count('IF NUM-DBS<>0')==2
net=(b/'compiled122/net-library.txt').read_text(encoding='utf-8-sig').strip();assert net.startswith('C:/Progress_12/OE/') and net.endswith('/OpenEdge.Net.pl')
checks=[]
for cp in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:
  total=0
  for t in m['tests']:
   p=b/'compiled122'/f"{Path(t['name']).stem}-{cp}-{culture}.log";s=p.read_text(encoding='utf-8-sig').strip();assert re.match(r'^PASS:? ',s)and'FAIL'not in s,(p,s)
   n=re.search(r'checks=(\d+)',s)or re.search(r'PASS:? (\d+)',s);assert n and int(n.group(1))==t['expectedChecks'],(p,s)
   total+=int(n.group(1));checks.append(dict(file=str(p.relative_to(r)),sha256=sha(p),checks=int(n.group(1))))
  assert total==904
files=[]
for target in m['productionDelta']:
 rel=str(Path(target).relative_to(Path('D:/opencode/motor-progress/v2'))).replace('\\','/')
 for p in [b/'package'/rel]+([b/'compiled122'/Path(rel).with_suffix('.r')]if rel.endswith('.p')else[]):
  relative=rel if p.suffix!='.r'else str(Path(rel).with_suffix('.r')).replace('\\','/');assert p.is_file()and p.stat().st_size>0
  files.append(dict(relative=relative,file=p.name,source=str(p.relative_to(r)),sha256=sha(p)))
assert len(files)==21 and len(checks)==56 and len({x['file']for x in files})==21
out=dict(success=True,version='12.2',compileEntries=55,compileDatabaseConnections=1,testDatabaseConnections=0,testsPerCombination=904,totalChecks=3616,testLogs=56,netLibrary=net,files=files,checks=checks,businessWrites=False,runtimePublished=False)
(b/'official-compile-verification.json').write_text(json.dumps(out,indent=2)+'\n')
print('PASS official12.2:55compiles/56TTlogs/3616checks/NUMDBS0;21production artifacts approved;no business writes')
