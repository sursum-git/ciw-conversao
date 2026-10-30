"""Independent immutable official6-v2 checks before bounded SSH compilation."""
from pathlib import Path
import hashlib,json
r=Path(__file__).resolve().parents[2];b=r/'.runtime/ciw-completion-20261028/official-build6-v2';load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()if p.is_file()else None
expected={'remote-plan.json':'1d21219297b48aa765c4ea2c5e7169d8b0d4f54397edb861edb6b82df8b43484','build-manifest.json':'037140bc0b5f30f0e003cabfa3a7b36ffa9c77cd8023f886c67f7c32f49b6e38','source-manifest.json':'3220f90285a3deb699bc28d99ec751aadd55577d4910a2197b12a82f8d127ffe','integration-plan.json':'83b94d5244ea99400dc85e15d903e868e300142d7599eae54d4de645faf98dd3'}
for n,digest in expected.items():assert sha(b/n)==digest,n
review=load(b/'manager-review-final.json');assert review['success'] and review['remainingP1P2']==[]
sources=load(b/'source-manifest.json');assert len(sources)==79
for x in sources:assert sha(r/x['file'])==x['sha256'],x['file']
plan=load(b/'integration-plan.json');assert len(plan['files'])==15
for x in plan['files']:
 assert sha(Path(x['candidate']))==x['candidateSha256']
 assert sha(Path(x['target']))==x['baselineSha256'],'Baseline diverged '+x['target']
manifest=load(b/'build-manifest.json');assert len(manifest['compileEntries'])==55 and len(manifest['tests'])==14 and sum(x['expectedChecks']for x in manifest['tests'])==904 and manifest['testLogs']==56 and manifest['testDatabaseConnections']==0
xml=(b/'review/php-full.xml').read_text();assert 'tests="885" assertions="5841" errors="0" failures="0" skipped="0"'in xml
runner=(b/'package/Regression.p').read_text();assert runner.count('IF NUM-DBS<>0')==2 and 'CIW_COMPILE_NETLIB'in runner
compile=(b/'package/Compile.p').read_text();assert 'NUM-DBS<>1'in compile and "PROVERSION BEGINS '12.2'"in compile
remote=load(b/'remote-plan.json');assert remote['server']=='compiler' and all('codex-ciw-completion-20261028-build6-v2'in x['remote']for x in remote['uploads'])
(b/'root-preflight.json').write_text(json.dumps(dict(success=True,hashes=expected,sources=79,canonicalCandidates=15,compileEntries=55,expectedTtChecks=3616,testsWithoutDb=True,phpTests=885,phpAssertions=5841,businessWrites=False,canonicalIntegrated=False,sshExecuted=False),indent=2)+'\n')
print('PASS independent official6-v2 preflight79sources/15baselineguards/55compiles/56TTplanned/3616checks; zero business execution')
