"""Approve the complete observed parent preview with exactly two reviewed deltas."""
from pathlib import Path
import copy,hashlib,json
root=Path(__file__).resolve().parents[2]
directory=root/'.runtime/ciw-completion-20261028/build12-metadata-publication-preparation'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
plan=load(directory/'plan.json')
assert sha(directory/'plan.json')=='449faee4a3cfa2c536c474c56fd1e40ca5ab3e15ed1d162ca5955a7ee110ea6a'
observed=load(Path(plan['parent']['observedPreviewFile']))
before=load(Path(plan['parent']['baselinePath']))
versions=[x for x in before['versions'] if x['status']=='published']
assert len(versions)==1 and versions[0]['version']=='1.0.2'
expected=copy.deepcopy(versions[0]['generatedDefinition'])
assert expected['program']['version']=='1.0.2' and len(expected['crud']['grid']['rowLinks'])==1
expected['program']['version']='1.0.3'
expected['crud']['grid']['rowLinks'].append(copy.deepcopy(plan['parent']['linkOnly']))
assert expected==observed['expectedGeneratedDefinition'],'Complete generated definition must match the two explicit changes'
assert observed['deltas']==[dict(path='/program/version',before='1.0.2',after='1.0.3'),dict(path='/crud/grid/rowLinks/1',after=plan['parent']['linkOnly'])]
assert observed['builderSha256']==sha(Path(plan['builder']['path']))==plan['builder']['sha256']
assert observed['parentBaselineSha256']==sha(Path(plan['parent']['baselinePath']))==plan['parent']['baselineSha256']
assert observed['draftSha256']==sha(Path(plan['parent']['draftFile']))
assert observed['build12ReleaseSha256']==plan['buildRelease']['sha256']
proof=copy.deepcopy(observed)
compact=json.dumps(observed['deltas'],ensure_ascii=False,separators=(',',':')).encode('utf-8')
proof.update(success=True,readOnly=True,deltaReviewed=True,wholeDefinitionCompared=True,explicitRootReview=True,allDeltasReviewed=True,ignoredPaths=[],observedPreviewSha256=sha(Path(plan['parent']['observedPreviewFile'])),reviewedDeltaSha256=hashlib.sha256(compact).hexdigest(),reviewedDeltaPaths=[x['path'] for x in observed['deltas']],review='Complete definition equality after only1.0.2=>1.0.3 and append the fixed context-preserving NF link; no extra decimal filter changes in this parent')
with Path(plan['parent']['previewProofFile']).open('x',encoding='utf-8')as output:
    json.dump(proof,output,ensure_ascii=False,indent=2);output.write('\n')
print('PASS whole parent preview: exactly version and one contextual link; zero ignored paths')
