from pathlib import Path
import json, hashlib, xml.etree.ElementTree as ET
r=Path(__file__).resolve().parents[2];b=r/'.runtime/purchase-quantity-periods-20261028'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
save=lambda p,v:p.write_text(json.dumps(v,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
for item in load(b/'baseline-manifest.json'):
 assert hashlib.sha256(Path(item['source']).read_bytes()).hexdigest()==item['sha256'],'Canonical source changed: '+item['source']
suite=ET.parse(b/'php-query-regressions.xml').getroot().find('testsuite')
assert (suite.get('tests'),suite.get('assertions'),suite.get('errors'),suite.get('failures'))==('16','68','0','0')
assert load(b/'metadata-js-validation.json')['success'] and load(b/'builder-preflight.json')['success']
network=load(b/'network-diagnosis.json');assert all(not x['available']for x in network['checks'])
state=load(b/'ACTIVE_WORK.json');state.update(status='PREPARED_AWAITING_NETWORK',humanDecisionPending=False,canonicalProductChanges=False,published=False,phpCandidatePrepared=True,metadataCandidatePrepared=True,ablRuleTestPrepared=True,ablImplementationPrepared=False,official122Compiled=False,ablTddRedObserved=False,phpTddRedObserved=True,phpTests=16,phpAssertions=68,metadataFields=21,networkRequired=True,networkQuestionPending=True,tunnelActive=False,newPermissionApproved=False,newPermissionApplied=False)
state['tunnel']['active']=False
save(b/'ACTIVE_WORK.json',state)
block=(r/'integration-src/purchase-quantity-periods/FINAL_CONTEXT_UPDATE.md').read_bytes().rstrip()+b'\n\n'
start=b'<!-- BEGIN CIW_PURCHASE_QUANTITY_PERIODS_20261028 -->';end=b'<!-- END CIW_PURCHASE_QUANTITY_PERIODS_20261028 -->'
targets=[r/'context/RETOMADA_2026-10-16.md',r/'context/PROJECT_CONTEXT.md',Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'),Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md')]
backup=b/'memory-prepared-backup';assert not backup.exists();prepared=[]
for p in targets:
 old=p.read_bytes();assert old.count(start)==1 and old.count(end)==1
 a=old.index(start);z=old.index(end)+len(end)
 while z<len(old)and old[z:z+1]in[b'\r',b'\n']:z+=1
 prepared.append((p,old,old[:a]+block+old[z:]))
backup.mkdir();receipt=[]
for i,(p,old,new)in enumerate(prepared):
 q=backup/(str(i)+'-'+p.name);q.write_bytes(old);assert p.read_bytes()==old;p.write_bytes(new);receipt.append(dict(path=str(p),sha256=hashlib.sha256(new).hexdigest(),backup=str(q)))
save(b/'memory-prepared-update.json',dict(success=True,files=receipt,canonicalProductChanges=False,businessWrites=False))
p=r/'integration-src/ciw-inventory/purchase-orders-validation.json';inventory=load(p);entry=inventory['applications']['cons_item_qt_imp_union'];entry.update(state='Preparação local — regra legado confirmada; rede interna indisponível',stateGroup='Preparado',runtimeReadValidated=False,visualValidated=False,converted=False,published=False,humanRuleDecision='Preservar exatamente a comparação atual do Scriptcase',humanRuleDecisionReference='call_77b2faee9f5b45839d2748051fa22dfb',remaining='Restabelecer rede. Executar novo RED oficial12.2; implementar coletor/regras/projeção compartilhados; revisar,compilar,publicar/validarPASOE. Metadados/PHP candidatos passaram localmente; não publicados. Não perguntar novamente pela comparação de datas. Controles final.',phpCandidateTests=16,phpCandidateAssertions=68,metadataCandidateFields=21,businessWrites=False)
save(p,inventory)
p=r/'integration-src/ciw-inventory/inventory-reviewed.json';catalog=load(p);entries=[x for x in catalog['entries']if x['name']=='cons_item_qt_imp_union'];assert len(entries)==1
entries[0].update(state=entry['state'],state_group='Preparado',remaining=entry['remaining'],evidence=entry['evidence'])
from collections import Counter
catalog['counts']['state_group']=dict(Counter(x['state_group']for x in catalog['entries']));save(p,catalog)
print('PASS PREPARED_AWAITING_NETWORK;legacy decision recorded,16PHP/68assertions,metadata21fields;4memories;8canonicals unchanged;no new publication/grants/business writes')
