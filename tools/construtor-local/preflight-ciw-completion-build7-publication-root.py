"""Verify released coherent deployment against official files and current canonical state."""
from pathlib import Path
import hashlib,json
root=Path(__file__).resolve().parents[2];build=root/'.runtime/ciw-completion-20261028/official-build7'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
release=build/'manager-runtime-publication-release.json'
assert sha(release)=='ef7b911113c5626e272d570838e194637a2a9e12fe8118975fd638ae2840b499'
review=load(release);assert review['success']and review['findingsP1']==review['findingsP2']==0
for row in review['pins']:
 path=build/row['file']
 if not path.is_file():path=root/row['file']
 assert sha(path)==row['sha256'],row['file']
proof=load(build/'official-compile-verification.json');manifest=load(build/'publication-manifest.json')
assert proof['success']and proof['totalChecks']==4120 and len(proof['files'])==25
assert len(manifest['targets'])==25
for row in proof['files']:
 assert sha(root/row['source'])==row['sha256']==manifest['targets'][row['relative']]['sha256']
for row in load(build/'canonical-manifest.json')['files']:assert sha(Path(row['target']))==row['sha256']
assert not(build/'active-manifest.json').exists()and not(build/'publication-attempt.json').exists()
(build/'root-publication-preflight.json').write_text(json.dumps(dict(success=True,artifacts=25,officialChecks=4120,hashesVerified=True,canonicalPreserved=True,businessWrites=False,runtimePublished=False),indent=2)+'\n')
print('PASS25official artifacts/currentcanonical/release pins;coherent MED publication ready')
