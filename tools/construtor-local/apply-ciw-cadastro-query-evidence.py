"""Reconcile five proven filter fixes without promoting any conversion state."""
from pathlib import Path
import json,copy,hashlib,shutil
R=Path(__file__).resolve().parents[2];S=R/'.runtime/ciw-completion-20261028';I=R/'integration-src/ciw-inventory/inventory-reviewed.json'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
proposal=S/'cadastro-query-reconciliation-proposal.json'
assert sha(proposal)=='d047245a8dccf1b7960b27cdf78f9e0ed83bcb5823f40c1fb6611314de3e3f79'
p=load(proposal);assert p['scope']=='remaining/evidence only' and p['applicationCount']==262 and p['statesTargetsCountsPreserved'] and p['convertedPromotions']==0
assert sha(I)==p['inventoryBaselineSha256']
receipt=S/'cadastro-query-reconciliation-applied.json';assert not receipt.exists()
for proof in p['proofs']:assert sha(Path(proof['path']))==proof['sha256'] and load(Path(proof['path']))['success']
before=load(I);after=copy.deepcopy(before);names=[]
for item in p['entries']:
 for source in item['sourceMatched']:assert sha(R/source['path'])==source['sha256']
 old=next(e for e in before['entries'] if e['name']==item['application']);new=next(e for e in after['entries'] if e['name']==item['application'])
 assert old['remaining']==item['remainingBefore'] and all(old[k]==v for k,v in item['preserve'].items())
 new['remaining']=item['remainingProposed'];new['evidence']+=' '+item['evidenceAppendProposed']
 assert {k for k in old if old[k]!=new[k]}=={'remaining','evidence'}
 names.append(item['application'])
assert len(names)==5
for old,new in zip(before['entries'],after['entries']):
 assert {k:v for k,v in old.items() if k not in ('remaining','evidence')}=={k:v for k,v in new.items() if k not in ('remaining','evidence')}
 if old['name'] not in names:assert old==new
assert {k:v for k,v in before.items() if k!='entries'}=={k:v for k,v in after.items() if k!='entries'}
backup=S/'inventory-before-cadastro-query-evidence.json';assert not backup.exists();shutil.copy2(I,backup)
I.write_text(json.dumps(after,indent=2,ensure_ascii=False)+'\n',encoding='utf-8');assert load(I)==after
receipt.write_text(json.dumps(dict(success=True,origins=names,scope='remaining/evidence only',before=p['inventoryBaselineSha256'],after=sha(I),statesPreserved=True,targetsPreserved=True,countsPreserved=True,businessWrites=False,permissionsChanged=False),indent=2)+'\n')
print('PASS five origins evidence/remaining only; states, targets, counts and access preserved')
