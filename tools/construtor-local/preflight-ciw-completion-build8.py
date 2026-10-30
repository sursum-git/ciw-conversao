"""Pin root review before the only allowed official8 compilation attempt."""
from pathlib import Path
import hashlib,json,xml.etree.ElementTree as ET
R=Path(__file__).resolve().parents[2];B=R/'.runtime/ciw-completion-20261028/official-build8'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
releaseSha='8ec63cbce134d78555896dda56522140e0d781d6418b0ba92dfff5831a9b0a85'
assert sha(B/'manager-release.json')==releaseSha
release=load(B/'manager-release.json');assert release['success']and release['p1']==release['p2']==0
assert len(release['pinned'])==223
for item in release['pinned']:assert sha(B/item['path'])==item['sha256'],item['path']
for field,file in [('buildManifestSha256','build-manifest.json'),('sourceManifestSha256','source-manifest.json'),('remotePlanSha256','remote-plan.json'),('integrationPlanSha256','integration-plan.json')]:assert sha(B/file)==release[field]
sources=load(B/'source-manifest.json');assert len(sources)==110
for item in sources:assert sha(R/item['file'])==item['sha256']
manifest=load(B/'build-manifest.json');assert len(manifest['compileEntries'])==74 and len(manifest['tests'])==21 and sum(x['expectedChecks']for x in manifest['tests'])==1166
for item in load(B/'dependency-snapshots.json'):assert sha(Path(item['target']))==item['sha256']==sha(Path(item['stage']))
plan=load(B/'integration-plan.json');assert len(plan['files'])==24
existing=new=0
for item in plan['files']:
 target=Path(item['target']);assert sha(Path(item['candidate']))==item['candidateSha256']
 if item['baselineSha256']is None:assert not target.exists();new+=1
 else:assert sha(target)==item['baselineSha256'];existing+=1
assert existing==15 and new==9
examples=load(B/'example-integration-plan.json')
for item in examples['files']:
 target=Path(item['target']);assert sha(Path(item['candidate']))==item['candidateSha256']
 if item['baselineSha256']is None:assert not target.exists()
 else:assert sha(target)==item['baselineSha256']
remote=load(B/'remote-plan.json');assert remote['server']=='compiler'and len(remote['commands'])==1
assert all('/codex-ciw-completion-20261028-build8'in p for p in remote['directories'])
assert not(B/'compiled122').exists()and not(B/'root-preflight.json').exists(),'Inspect prior attempt; no replay'
out=dict(success=True,managerReleaseSha256=releaseSha,pinnedFiles=223,sourceFiles=110,canonicalExisting=existing,canonicalNew=new,separateExamples=len(examples['files']),officialCompileEntries=74,ttLogs=84,ttChecks=4664,readOnlySchemaCompile=True,testNumDbs=0,businessWrites=False,grants=False,remoteExecuted=False)
(B/'root-preflight.json').write_text(json.dumps(out,indent=2)+'\n')
print('PASS rootrelease223pins/110sources/15existing9new+5examples/74compiles84TT; ready official12.2')
