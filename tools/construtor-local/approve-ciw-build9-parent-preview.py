"""Approve exactly the observed version and row-link addition; compare whole definition."""
from pathlib import Path
import json
R=Path(__file__).resolve().parents[2];B=R/'.runtime/ciw-completion-20261028/build9-v2-metadata-publication-preparation'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
plan=load(B/'plan.json');observed=load(B/'parent-preview-observed.json')
assert observed['success'] and observed['readOnly'] and observed['wholeDefinitionCompared'] and not observed['deltaReviewed']
assert observed['deltas']==[dict(path='/program/version',before='1.0.2',after='1.0.3'),dict(path='/crud/grid/rowLinks/1',after=plan['parent']['linkOnly'])]
assert observed['parentBaselineSha256']==plan['parent']['baselineSha256'] and observed['draftSha256']==plan['parent']['draftSha256']
owner=load(B/'native-governance-owners.json');assert owner['owners']['containers_progress']['programCode']=='op1000'
target=B/'parent-preview-proof.json';assert not target.exists()
observed['deltaReviewed']=True;observed['reviewScope']='Whole generated definition: exactly version and one appended contextual rowLink; no ignored paths'
target.write_text(json.dumps(observed,indent=2,ensure_ascii=False)+'\n',encoding='utf-8')
print('PASS full native preview has exactly two approved deltas; owner op1000 observed')
