"""Independently pin build7 before private official compilation; no business execution."""
from pathlib import Path
import hashlib,json,re
root=Path(__file__).resolve().parents[2];build=root/'.runtime/ciw-completion-20261028/official-build7'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()if p.is_file()else None
assert sha(build/'manager-release.json')=='808eb7c78d84e675da77d4dd700f983784676401379660ae082fe762345fc6b1'
review=load(build/'manager-release.json');assert review['success']and review['findingsP1']==review['findingsP2']==0
for entry in review['pinned']:assert sha(build/entry['path'])==entry['sha256'],entry['path']
sources=load(build/'source-manifest.json');assert len(sources)==99
for row in sources:assert sha(root/row['file'])==row['sha256'],row['file']
integration=load(build/'integration-plan.json');assert len(integration['files'])==19
for row in integration['files']:
 assert sha(Path(row['candidate']))==row['candidateSha256']
 assert sha(Path(row['target']))==row['baselineSha256'],'Concurrent canonical change: '+row['target']
manifest=load(build/'build-manifest.json')
assert len(manifest['compileEntries'])==68 and len(manifest['tests'])==18
assert sum(x['expectedChecks']for x in manifest['tests'])==1030
assert manifest['testLogs']==72 and manifest['compileDatabaseConnections']==1 and manifest['testDatabaseConnections']==0
xml=(build/'manager-php-full.xml').read_text(encoding='utf-8')
assert re.search(r'tests="910" assertions="5974" errors="0" failures="0" skipped="0"',xml)
assert 'IF NUM-DBS<>1'in(build/'package/Compile.p').read_text()
runner=(build/'package/Regression.p').read_text();assert runner.count('IF NUM-DBS<>0')==2
remote=load(build/'remote-plan.json');assert remote['server']=='compiler'and len(remote['uploads'])==99
assert all('codex-ciw-completion-20261028-build7'in row['remote']for row in remote['uploads'])
assert not(build/'compiled122/compile.log').exists(),'Official outputs already exist; inspect before replay'
(build/'root-preflight.json').write_text(json.dumps(dict(success=True,managerReleaseSha256=sha(build/'manager-release.json'),sources=99,canonicalCandidates=19,compileEntries=68,ttLogs=72,ttChecks=4120,testsWithoutDatabase=True,phpTests=910,phpAssertions=5974,canonicalIntegrated=False,businessWrites=False,sshExecuted=False),indent=2)+'\n')
print('PASS rootbuild7 hashes/99sources/19baselines/68compiles/72TTplanned/4120checks;no business execution')
