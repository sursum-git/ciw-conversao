from pathlib import Path
import difflib,hashlib,json,shutil
HERE=Path(__file__).resolve().parent
ROOT=HERE.parents[3]
FROZEN=ROOT/'integration-src/ciw-completion-20261028/container-cost-comparison-readonly/frozen-rebase11-v1'
CANON=Path('D:/opencode/motor-progress/v2')
RUNTIME=ROOT/'.runtime/ciw-completion-20261028/comparison-orphan-read-policy/v1'
sha=lambda b:hashlib.sha256(b).hexdigest()
if (HERE/'manifest.json').exists(): raise SystemExit('Snapshot sealed: do not regenerate v1; prepare a new companion version.')
for name in ['baseline-exact','candidate-exact','test-inputs']: (HERE/name).mkdir(parents=True,exist_ok=True)
origins=[]
for p in (FROZEN/'official-preparation/package').rglob('*'):
 if not p.is_file(): continue
 relative=p.relative_to(FROZEN/'official-preparation/package')
 original=CANON/relative if (CANON/relative).is_file() else p
 target=HERE/'test-inputs'/relative; target.parent.mkdir(parents=True,exist_ok=True); target.write_bytes(original.read_bytes())
 origins.append({'input':original.as_posix(),'copiedTo':target.relative_to(HERE).as_posix(),'sha256':sha(original.read_bytes())})
for name,source in [('ContainersVersionService.p',CANON/'sursum-api/programs/ContainersVersionService.p'),('ContainersVersionComparisonService.p',FROZEN/'abl/ContainersVersionComparisonService.p')]:
 for directory in ['baseline-exact','candidate-exact']: (HERE/directory/name).write_bytes(source.read_bytes())
 origins.append({'input':source.as_posix(),'copiedTo':'baseline-exact/'+name,'sha256':sha(source.read_bytes())})
# The old comparison's Reader delta is add-only. Map its exact insertion points
# through unchanged byte spans onto canonical12; never use the cumulative candidate.
plan=json.loads((FROZEN/'shared-byte-plan.json').read_bytes())
item=next(x for x in plan['files'] if x['target'].endswith('CiwErpReadService.p'))
old=(FROZEN/item['baselineFile']).read_bytes()
current=(CANON/'sursum-api/programs/CiwErpReadService.p').read_bytes()
assert sha(current).startswith('bb4d2362')
blocks=difflib.SequenceMatcher(None,old,current,autojunk=False).get_matching_blocks()
mapped=[]
for h in item['hunks']:
 assert h['oldBytesHex']==''
 offset=h['baselineStartByte']
 matches=[b for b in blocks if b.a<=offset<=b.a+b.size and b.size>=100]
 assert len(matches)==1,(offset,matches)
 block=matches[0]; target=block.b+offset-block.a
 assert current[max(0,target-30):target]==old[max(0,offset-30):offset]
 assert current[target:target+30]==old[offset:offset+30]
 mapped.append({'baselineStartByte':target,'baselineEndByteExclusive':target,'oldBytesHex':'','newBytesHex':h['newBytesHex']})
composed=current
for h in reversed(mapped): composed=composed[:h['baselineStartByte']]+bytes.fromhex(h['newBytesHex'])+composed[h['baselineStartByte']:]
(HERE/'test-inputs/sursum-api/programs/CiwErpReadService.p').write_bytes(composed)
labels=FROZEN/'candidate-exact/ContainersVersionHistoryLabels.p'
(HERE/'test-inputs/sursum-api/programs/ContainersVersionHistoryLabels.p').write_bytes(labels.read_bytes())
for n in ['ContainersVersionComparisonProjection.p','ContainersVersionComparisonMaterializer.p']:
 (HERE/'test-inputs/sursum-api/programs'/n).write_bytes((FROZEN/'abl'/n).read_bytes())
(HERE/'test-inputs/sursum-api/includes/ContainerProcessBoundary.i').write_bytes((CANON/'sursum-api/includes/ContainerProcessBoundary.i').read_bytes())
(HERE/'test-inputs/ComparisonSnapshotTestTables.i').write_bytes((FROZEN/'tests/abl/ComparisonSnapshotTestTables.i').read_bytes())
for n in ['ContainersVersionHistoryTest.p','ContainersVersionTest.p','ContainersVersionAuxHistoryTest.p','CiwErpReadTest.p','PurchaseItemsReadTest.p']:
 assert (HERE/'test-inputs'/n).is_file(),n
proof={'state':'TEST_DEPENDENCY_OVERLAY_ONLY_NOT_INTEGRATION','readerBaselineSha256':sha(current),'readerCandidateSha256':sha(composed),'readerComparisonAddOnlyHunks':mapped,'financeCanonicalPin':{'path':(CANON/'sursum-api/programs/ContainersPainelFinanceReadService.p').as_posix(),'sha256':sha((CANON/'sursum-api/programs/ContainersPainelFinanceReadService.p').read_bytes())},'labelFrozenDependency':{'path':labels.as_posix(),'sha256':sha(labels.read_bytes())},'origins':origins}
(HERE/'test-inputs-manifest.json').write_text(json.dumps(proof,indent=2)+'\n',encoding='utf8')
RUNTIME.mkdir(parents=True,exist_ok=True)
print(json.dumps({'prepared':True,'copiedFiles':len(origins),'readerAddOnlyHunks':len(mapped),'readerSha256':sha(composed),'financeSha256':proof['financeCanonicalPin']['sha256']}))
