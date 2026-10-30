"""Conservative3-origin evidence update; never promotes state or changes target mappings."""
from pathlib import Path
import json,copy,hashlib,shutil
R=Path(__file__).resolve().parents[2];S=R/'.runtime/ciw-completion-20261028';I=R/'integration-src/ciw-inventory/inventory-reviewed.json'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
proposal=S/'build8-reconciliation-proposal.json';assert sha(proposal)=='9f1e3f5485644f0677d672d679dec54e08696a3ab8fd53f5bb242e8c50e83b5a'
p=load(proposal);assert p['scope']=='remaining/evidence only'and p['applicationCount']==262 and p['statesPreserved']and p['countsPreserved']
assert sha(I)==p['inventoryBaselineSha256'];receipt=S/'build8-reconciliation-applied.json';assert not receipt.exists()
for proof in p['proofs']:assert sha(Path(proof['path']))==proof['sha256']and load(Path(proof['path']))['success']
before=load(I);after=copy.deepcopy(before);names=[]
for item in p['entries']:
 assert not item['promoteConverted']
 for file in item['sourceFiles']:assert sha(R/file['path'])==file['sha256']
 old=next(e for e in before['entries']if e['name']==item['application']);new=next(e for e in after['entries']if e['name']==item['application'])
 assert old['remaining']==item['remainingBefore']and all(old[k]==v for k,v in item['preserve'].items())
 new['remaining']=item['remainingProposed'];new['evidence']+=' '+item['evidenceAppendProposed'];assert set(k for k in old if old[k]!=new[k])=={'remaining','evidence'};names.append(item['application'])
assert len(names)==3
for old,new in zip(before['entries'],after['entries']):
 assert {k:v for k,v in old.items()if k not in('remaining','evidence')}=={k:v for k,v in new.items()if k not in('remaining','evidence')}
 if old['name']not in names:assert old==new
assert {k:v for k,v in before.items()if k!='entries'}=={k:v for k,v in after.items()if k!='entries'}
backup=S/'inventory-before-build8-evidence.json';assert not backup.exists();shutil.copy2(I,backup)
I.write_text(json.dumps(after,indent=2,ensure_ascii=False)+'\n',encoding='utf-8');assert load(I)==after
receipt.write_text(json.dumps(dict(success=True,origins=names,scope='remaining/evidence only',before=p['inventoryBaselineSha256'],after=sha(I),statesPreserved=True,targetsPreserved=True,countsPreserved=True,businessWrites=False,permissionsChanged=False),indent=2)+'\n')
print('PASS3originsevidence/remainingonly; all262states/targets/counts/access preserved')
