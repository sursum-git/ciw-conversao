"""Check private TT replay immutable files and exact official6 r-code dependencies."""
from pathlib import Path
import hashlib,json
r=Path(__file__).resolve().parents[2];b=r/'.runtime/ciw-completion-20261028/container-expense-batch-preflight/replay-after6-v1';load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
review=load(b/'manager-review-final.json');assert review['success']
assert sha(b/'manifest.json')==review['manifestSha256']=='72bec405213eece6053aacf97f646a6494c9c1bfe71559170b53962d4bc80ed0'
assert sha(b/'remote-plan.json')==review['remotePlanSha256']=='7ff5a6a22c3cc3e30d115f19f936db8b0d2938744ad7e5b8acc2ce504b2ee305'
assert sha(r/'.runtime/ciw-completion-20261028/official-build6-v2/official-compile-verification.json')==review['official6ProofSha256']
m=load(b/'manifest.json');assert m['databaseConnections']==0 and m['oneCompile']=='Replay.p'
for x in m['productionRcodeReusedFromOfficial6']:assert sha(r/x['local'])==x['sha256']
plan=load(b/'remote-plan.json');assert len(plan['uploads'])==5 and plan['server']=='compiler'
for x in m['sourceInputs']:assert sha(r/x['file'])==x['sha256']
assert (b/'package/Execute.p').read_text().count('NUM-DBS<>0')==2
(b/'root-preflight.json').write_text(json.dumps(dict(success=True,privateReplayOnly=True,officialRcode=55,compileEntries=1,expectedChecks=600,databaseConnections=0,published=False,businessWrites=False),indent=2)+'\n')
print('PASS private replay preflight1compile/55pinned12.2rcode/600TTchecks planned/NUMDBS0;never publish')
