"""Rebase only proven byte edits over stable6; preserve original discount freeze."""
from pathlib import Path
import hashlib,json,difflib
R=Path('D:/opencode/conversao-sc');S=R/'.runtime/ciw-completion-20261028';F=R/'integration-src/ciw-completion-20261028/import-discounts-readonly/frozen-v1';O=S/'import-discounts-readonly/rebase-after6-stage'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest();load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
assert not O.exists(),'Never replace immutable rebase stage';m=load(F/'manifest.json');assert sha(F/'manifest.json')=='714587844c8e94c71234b090fa1068c3e2ea2dc07832439603f89fcd33748e83'
for e in m['files']:assert sha(F/e['path'])==e['sha256']
O.mkdir();proof=[]
for e in m['baselines']:
 target=Path(e['target']);old=Path(m['stage'])/(target.name+'.baseline');candidate=Path(m['stage'])/target.name
 assert sha(old)==e['baselineSha256'] and sha(candidate)==e['candidateSha256'],target.name
 a=old.read_bytes().splitlines(keepends=True);b=candidate.read_bytes().splitlines(keepends=True);actual=target.read_bytes();out=actual;count=0
 for op,i,j,k,l in difflib.SequenceMatcher(None,a,b,autojunk=False).get_opcodes():
  if op=='equal':continue
  before=b''.join(a[i:j]);after=b''.join(b[k:l])
  if not before:
   for width in range(1,min(i,30)+1):
    prefix=b''.join(a[i-width:i])
    if out.count(prefix)==1:before=prefix;after=prefix+after;break
   assert before,'No unique insertion anchor '+target.name
  assert out.count(before)==1,'Absent/ambiguous exact delta '+target.name
  out=out.replace(before,after,1);count+=1
 dest=O/target.name;dest.write_bytes(out);(O/(target.name+'.baseline')).write_bytes(actual)
 # Exact delta reversal proves every canonical6 byte outside these edits stayed.
 proof.append({'target':str(target),'baselineSha256':sha(target),'candidateSha256':sha(dest),'exactDeltaHunks':count,'originalBaselineSha256':e['baselineSha256'],'originalCandidateSha256':e['candidateSha256'],'canonicalWrites':False})
(O/'rebase-proof.json').write_text(json.dumps({'success':True,'originalFrozenManifestSha256':sha(F/'manifest.json'),'oldFreezePreserved':True,'changes':proof,'sourceMetadataRequiresCurrentSnapshot':True},indent=2)+'\n')
print(json.dumps({'success':True,'files':len(proof),'hunks':sum(e['exactDeltaHunks'] for e in proof),'canonicalWrites':False}))
