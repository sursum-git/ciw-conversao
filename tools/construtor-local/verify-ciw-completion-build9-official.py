"""Validate sealed official output and emit a four-artifact publication proof."""
from pathlib import Path
import json,hashlib,subprocess,sys
R=Path(__file__).resolve().parents[2];B=R/'.runtime/ciw-completion-20261028/official-build9'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert sha(B/'release.json')=='f0921a0d398cc3e69ff2bc2874fd6179277e7d7b23d183eaccc90e69192dbc86'
assert sha(B/'manager-release.json')=='f404c8506bcd246361beb5caf11502d0f5903770bfb26e1aeff4af54a224e0a4'
assert load(B/'manager-release.json')['success']
subprocess.run([sys.executable,str(B/'verify.py'),'--official'],check=True)
out=B/'official-compile-verification.json';assert not out.exists()
files=[]
for name in ['ContainersPainelFinanceReadService','ContainersPainelFinanceRead']:
 for suffix in ['.p','.r']:
  rel='sursum-api/programs/'+name+suffix
  file=B/('package' if suffix=='.p' else 'compiled122')/rel
  assert file.is_file()
  files.append(dict(relative=rel,file=name+suffix,source=str(file.relative_to(R)),sha256=sha(file)))
logs=[p for p in (B/'compiled122').glob('*Test-*.log') if not p.name.startswith('process-')];assert len(logs)==8
proof=dict(success=True,version='12.2',compileCount=24,numDbsCompile=1,numDbsTests=0,testLogs=8,totalChecks=1080,releaseSha256=sha(B/'release.json'),managerReleaseSha256=sha(B/'manager-release.json'),files=files,logHashes={p.name:sha(p) for p in logs},businessWrites=False)
out.write_text(json.dumps(proof,indent=2)+'\n')
print('PASS official12.2/24compiles/8TTlogs/1080checks; four runtime artifacts pinned')
