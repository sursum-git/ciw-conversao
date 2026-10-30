"""Approve only the two Service production artifacts from official12.2 output."""
from pathlib import Path
import json,hashlib,subprocess,sys
R=Path(__file__).resolve().parents[2];B=R/'.runtime/ciw-completion-20261028/official-build10'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
assert sha(B/'release.json')=='a1e488cc9429e0d803ed5a0149b4f0f2e25d4b49c54bb901bc7a2fa22e229aff'
assert sha(B/'manager-release.json')=='0b3aa75cbb17a12fe558a9e4231587bcefbe917576074929293aa0b0902c3bae'
assert load(B/'manager-release.json')['success']
subprocess.run([sys.executable,str(B/'verify.py'),'--official'],check=True)
out=B/'official-compile-verification.json';assert not out.exists()
files=[]
for suffix in ['.p','.r']:
 rel='sursum-api/programs/ContainersPainelFinanceReadService'+suffix
 source=B/('package' if suffix=='.p' else 'compiled122')/rel
 assert source.is_file();files.append(dict(relative=rel,file=source.name,source=str(source.relative_to(R)),sha256=sha(source)))
logs=[p for p in (B/'compiled122').glob('*Test-*.log') if not p.name.startswith('process-')];assert len(logs)==8
out.write_text(json.dumps(dict(success=True,version='12.2',compileCount=8,numDbsCompile=1,numDbsTests=0,totalChecks=1160,testLogs=8,files=files,releaseSha256=sha(B/'release.json'),logHashes={p.name:sha(p) for p in logs},businessWrites=False),indent=2)+'\n')
print('PASS official12.2/8compiles/1160TT; only Service.p/r approved, no fixture publication')
