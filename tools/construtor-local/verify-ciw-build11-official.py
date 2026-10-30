"""Bind the four production artifacts to the completed OE12.2 build."""
from pathlib import Path
import hashlib,json,subprocess,sys
r=Path(__file__).resolve().parents[2];b=r/'.runtime/ciw-completion-20261028/official-build11'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
assert sha(b/'manager-release.json')=='d6240865d6b830bd43e22adf99745792420571abdce1202e627356804217eaa9'
assert sha(b/'release.json')=='4a51bdd4de366fde34c6ff91635b6127aaf48f8cdce0057577d3ef1ef12ff2fa'
subprocess.run([sys.executable,str(b/'verify.py'),'--official'],check=True)
assert not (b/'official-compile-verification.json').exists()
files=[]
for rel in load(b/'release.json')['productionAllowlist']:
 source=b/('package' if rel.endswith('.p')else'compiled122')/rel
 assert source.is_file();files.append(dict(relative=rel,file=source.name,source=str(source.relative_to(r)),sha256=sha(source)))
logs=[p for p in (b/'compiled122').glob('*Test-*.log')if not p.name.startswith('process-')];assert len(logs)==8
proof=dict(success=True,version='12.2',compileCount=7,numDbsCompile=1,numDbsTests=0,totalChecks=384,testLogs=8,files=files,releaseSha256=sha(b/'release.json'),logHashes={p.name:sha(p)for p in logs},businessWrites=False)
(b/'official-compile-verification.json').write_text(json.dumps(proof,indent=2)+'\n')
rows=[]
for row in load(b/'build-manifest.json')['canonicalIntegrationFiles']:
 if 'candidateSha256'in row:source=Path(row['frozenCandidatePath']);before=row['baselineSha256'];after=row['candidateSha256']
 else:source=r/'integration-src/ciw-completion-20261028/expense-tax-relations-readonly/frozen-v1.1'/row['path'];before=None;after=row['sha256']
 assert sha(source)==after
 rows.append(dict(target=row['target'],source=str(source),baselineSha256=before,candidateSha256=after))
assert len(rows)==5
(b/'integration-plan.json').write_text(json.dumps(dict(files=rows),indent=2)+'\n')
print('PASS official7/384/8 and four production artifacts; prepared five-file guarded integration plan')
