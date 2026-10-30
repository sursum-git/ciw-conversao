"""Verify official12.2 outputs and choose only reviewed production artifacts."""
from pathlib import Path
import hashlib,json,re
root=Path(__file__).resolve().parents[2];build=root/'.runtime/ciw-completion-20261028/official-build7'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
release=load(build/'manager-release.json')
assert sha(build/'manager-release.json')=='808eb7c78d84e675da77d4dd700f983784676401379660ae082fe762345fc6b1'
for row in release['pinned']:assert sha(build/row['path'])==row['sha256']
manifest=load(build/'build-manifest.json')
for row in load(build/'source-manifest.json'):assert sha(root/row['file'])==row['sha256']
log=(build/'compiled122/compile.log').read_text(encoding='utf-8-sig')
assert log.startswith('OpenEdge 12.2 NUM-DBS=1')and log.rstrip().endswith('PASS COMPILE ALL')
assert log.count('COMPILER:ERROR=no')==len(manifest['compileEntries'])==68
assert 'FAIL'not in log and'COMPILER:ERROR=yes'not in log
assert not(build/'compiled122/compile-process.log').read_text(encoding='utf-8-sig').strip()
for name in manifest['compileEntries']:
 assert name+' COMPILER:ERROR=no'in log
 compiled=build/'compiled122'/Path(name).with_suffix('.r');assert compiled.is_file()and compiled.stat().st_size>0
net=(build/'compiled122/net-library.txt').read_text(encoding='utf-8-sig').strip()
assert net.startswith('C:/Progress_12/OE/')and net.endswith('/OpenEdge.Net.pl')
checks=[]
for cp in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:
  total=0
  for test in manifest['tests']:
   path=build/'compiled122'/f"{Path(test['name']).stem}-{cp}-{culture}.log"
   text=path.read_text(encoding='utf-8-sig').strip();assert re.match(r'^PASS:?\s',text)and'FAIL'not in text,(path,text)
   match=re.search(r'checks=(\d+)',text)or re.search(r'PASS:?\s+(\d+)',text)
   assert match and int(match.group(1))==test['expectedChecks'],(path,text)
   total+=int(match.group(1));checks.append(dict(file=str(path.relative_to(root)),sha256=sha(path),checks=int(match.group(1))))
  assert total==1030
assert len(checks)==72
production=[]
for row in load(build/'integration-plan.json')['files']:
 target=Path(row['target'])
 if not target.is_relative_to(Path('D:/opencode/motor-progress/v2')):continue
 relative=target.relative_to(Path('D:/opencode/motor-progress/v2'))
 paths=[(relative,Path(row['candidate']))]
 if target.suffix=='.p':paths.append((relative.with_suffix('.r'),build/'compiled122'/relative.with_suffix('.r')))
 for rel,path in paths:
  assert path.is_file()and path.stat().st_size>0
  production.append(dict(relative=str(rel).replace('\\','/'),source=str(path.relative_to(root)),file=path.name,sha256=sha(path)))
assert len(production)==25 and len({x['relative']for x in production})==25
result=dict(success=True,version='12.2',compileEntries=68,compileDatabaseConnections=1,testDatabaseConnections=0,testsPerCombination=1030,totalChecks=4120,testLogs=72,netLibrary=net,files=production,checks=checks,businessWrites=False,runtimePublished=False)
(build/'official-compile-verification.json').write_text(json.dumps(result,indent=2)+'\n')
print('PASS official12.2/68compiles/72TTlogs/4120checks/NUMDBS0;25production artifacts selected;not yet published')
