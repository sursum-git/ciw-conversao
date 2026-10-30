"""Update evidence/remaining only, preserving conversion states, mappings and source history."""
from pathlib import Path
import hashlib,json,copy,shutil
R=Path(__file__).resolve().parents[2];S=R/'.runtime/ciw-completion-20261028'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
proposal=S/'readonly7-reconciliation-proposal.json';inventory=R/'integration-src/ciw-inventory/inventory-reviewed.json'
assert sha(proposal)=='078cf997a2c34db5e1e360ffbbc89a10dd1db35738d2b19f49f64ee9b9d0de6e'
p=load(proposal);assert p['success']and p['scope']=='remaining/evidence only; no automatic state or target mapping change'
assert sha(inventory)==p['inventoryBaselineSha256']
receipt=S/'readonly7-reconciliation-applied.json';assert not receipt.exists(),'Inspect existing receipt; do not replay'
for proof in p['proofs']:
 path=R/proof['path'];assert sha(path)==proof['sha256']and load(path)['success']
before=load(inventory);after=copy.deepcopy(before);changed=[]
for row in p['proposals']:
 assert not row['convertedProposed']and not row['applied']
 for proof in row['sourceProofs']:assert sha(R/proof['path'])==proof['sha256']
 original=next(e for e in before['entries']if e['name']==row['name'])
 assert hashlib.sha256(json.dumps(original,sort_keys=True,ensure_ascii=False,separators=(',',':')).encode()).hexdigest()==row['beforeEntrySha256']
 entry=next(e for e in after['entries']if e['name']==row['name'])
 assert entry['state_group']==row['stateGroupPreserved']
 entry['remaining']=row['proposedRemaining']
 entry['evidence']+=' Leitura publicada comprovada em '+row['relatedPublishedProgram']+'/'+row['relatedPublishedScreen']+'; recibos oficiais7 e correção de identidade conferidos em 28/10/2026. Equivalência integral e UI LDAP permanecem pendentes; não altera classificação nem mapeamento de origem.'
 assert set(k for k in entry if entry[k]!=original[k])=={'remaining','evidence'}
 changed.append(row['name'])
assert len(changed)==5
assert {k:v for k,v in before.items()if k!='entries'}=={k:v for k,v in after.items()if k!='entries'}
for old,new in zip(before['entries'],after['entries']):
 assert {k:v for k,v in old.items()if k not in('remaining','evidence')}=={k:v for k,v in new.items()if k not in('remaining','evidence')}
 if old['name']not in changed:assert old==new
backup=S/'inventory-before-readonly7-evidence.json';assert not backup.exists();shutil.copy2(inventory,backup)
inventory.write_text(json.dumps(after,indent=2,ensure_ascii=False)+'\n',encoding='utf-8')
assert load(inventory)==after
receipt.write_text(json.dumps(dict(success=True,scope='remaining/evidence only',origins=changed,before=p['inventoryBaselineSha256'],after=sha(inventory),proposal=sha(proposal),statesPreserved=True,targetsPreserved=True,countsPreserved=True,authorizationChanged=False),indent=2)+'\n')
print('PASS5 evidence/remaining reconciled; all states/targets/counts/access preserved')
