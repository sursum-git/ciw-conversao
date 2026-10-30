"""Apply only independently reviewed four-byte-anchor Builder companion to local8."""
from pathlib import Path
import json,hashlib,difflib,sys
R=Path('D:/opencode/conversao-sc');B=R/'.runtime/ciw-completion-20261028/official-build8'
C=R/'integration-src/ciw-completion-20261028/native-process-options-normalization-companion'
read=lambda p:json.loads(Path(p).read_text(encoding='utf-8-sig'))
digest=lambda b:hashlib.sha256(b).hexdigest()
sha=lambda p:digest(Path(p).read_bytes())
def save(p,v):p.write_text(json.dumps(v,indent=2,ensure_ascii=False)+'\n',encoding='utf-8')
assert '--manager-reviewed' in sys.argv,'Manager review is required before local composition'
assert not (B/'local-review-manifest.json').exists(),'Immutable local8 freeze exists'
assert not (B/'normalization-companion-proof.json').exists(),'Companion already composed'
assert sha(C/'manifest.json')=='62f57a0f5f1982e69a9d56322d02af3155388872e12bf7ccf6c2af61f2c27135'
manifest=read(C/'manifest.json')
for file in manifest['files']:assert sha(C/file['path'])==file['sha256'],file['path']
plan=read(C/manifest['patchPlan']);target=Path(plan['baselineOrigin']);before=target.read_bytes()
assert digest(before)==plan['baselineSha256'];candidate=before;anchors=[]
for change in plan['changes']:
    old,new=bytes.fromhex(change['oldBytesHex']),bytes.fromhex(change['newBytesHex'])
    assert candidate.count(old)==1,'Unique exact byte anchor required'
    position=candidate.index(old);anchors.append({'sequentialByteStart':position,'oldByteLength':len(old),'newByteLength':len(new),'oldSha256':digest(old),'newSha256':digest(new)})
    candidate=candidate.replace(old,new,1)
assert digest(candidate)==plan['candidateSha256']==sha(plan['candidateRuntimePath'])
reverse=candidate
for change in reversed(plan['changes']):
    old,new=bytes.fromhex(change['oldBytesHex']),bytes.fromhex(change['newBytesHex'])
    assert reverse.count(new)==1;reverse=reverse.replace(new,old,1)
assert reverse==before,'All bytes outside reviewed anchors must be preserved'
integration=read(B/'integration-plan.json');entry=next(x for x in integration['files'] if Path(x['candidate'])==target)
assert sha(entry['target'])==entry['baselineSha256'] and entry['candidateSha256']==digest(before)
base=Path(entry['target']).read_bytes();oldLines=base.splitlines(keepends=True);newLines=candidate.splitlines(keepends=True)
proof=read(B/'composition-proof.json');originalProofSha=sha(B/'composition-proof.json')
proof['hunks']=[h for h in proof['hunks'] if h['file']!=target.name]
for op,i,j,x,y in difflib.SequenceMatcher(None,oldLines,newLines,autojunk=False).get_opcodes():
    if op=='equal':continue
    old,new=b''.join(oldLines[i:j]),b''.join(newLines[x:y])
    assert old.replace(b'\r\n',b'\n')!=new.replace(b'\r\n',b'\n'),'No EOL-only differences authorized'
    proof['hunks'].append({'file':target.name,'baseLineStart':i+1,'baseLineEndExclusive':j+1,'domains':['1047','normalizer-companion'],'kind':'reviewed selection and exact four-anchor companion','oldSha256':digest(old),'newSha256':digest(new)})
entry['candidateSha256']=digest(candidate)
backup=B/'pre-normalization-companion';backup.mkdir()
for name in ['composition-proof.json','integration-plan.json','metadata-builder.xml','php-full.xml']:(backup/name).write_bytes((B/name).read_bytes())
(backup/'ProgramBuilderService.php').write_bytes(before)
target.write_bytes(candidate);save(B/'composition-proof.json',proof);save(B/'integration-plan.json',integration)
tests=B/'php-tests/normalization/tests';tests.mkdir(parents=True)
test=(C/'tests/NormalizedDependentOptionsTest.php').read_bytes()
test=test.replace(b'D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-expense-default-selection/frozen-v1.2/metadata/',str(B/'php-tests/selection/metadata/').replace('\\','/').encode()+b'/')
(tests/'NormalizedDependentOptionsTest.php').write_bytes(test)
save(B/'normalization-companion-proof.json',{'manifestPath':str(C/'manifest.json'),'manifestSha256':sha(C/'manifest.json'),'baselineStageSha256':digest(before),'candidateStageSha256':digest(candidate),'originalCompositionProofSha256':originalProofSha,'exactAnchors':anchors,'reverseReconstructsStageExactly':True,'canonicalWrites':False,'ablChanged':False,'newTests':8,'newAssertions':78,'stagedTestSha256':sha(tests/'NormalizedDependentOptionsTest.php')})
bm=read(B/'build-manifest.json');bm['packages'].append({'path':str(C),'manifestSha256':sha(C/'manifest.json')});bm['integrationPlanSha256']=sha(B/'integration-plan.json');bm['compositionProofSha256']=sha(B/'composition-proof.json');bm['normalizationCompanionProofSha256']=sha(B/'normalization-companion-proof.json');save(B/'build-manifest.json',bm)
print(json.dumps({'state':'PREPARED_REQUIRES_COMPOSED_PHP_METADATA_RECHECK','candidateSha256':digest(candidate),'newTests':8,'newAssertions':78,'ablChanged':False,'canonicalWrites':False}))
