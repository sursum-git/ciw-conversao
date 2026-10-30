"""Bind the actually observed CUA/CDP cancel to before/after native read receipts."""
from pathlib import Path
import json,hashlib
root=Path(__file__).resolve().parents[2]
directory=root/'.runtime/ciw-completion-20261028/batch1042-exercise'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
before=load(directory/'ui-before.json');after=load(directory/'ui-after.json')
assert before['success'] and after['success'] and before['rows']==after['rows']
assert before['ownedStateSha256']==after['ownedStateSha256']==sha(directory/'state.json')
state=load(directory/'state.json')
assert state['steps']==['create-header','create-A','create-B'] and state['pending'] is None
assert state['selected']['A']==44043 and state['selected']['B']==44049
assert len(before['rows'])==7 and all(len(x)==14 for x in before['rows'])
network=dict(startCursor=52,endCursor=62,truncated=False,drainClosed=True,requests=[],businessWriteRequests=0,otherMutatingRequests=0,startedAt='2026-10-29T01:43:30.085Z',completedAt='2026-10-29T01:44:48.125Z',mechanism='Documented CUA CDP Network.requestWillBeSent; enabled before edit, cursor captured, all interval events drained after cancellation, then Network.disable',headersOrBodiesPersisted=False)
with (directory/'ui-cancel-network-proof.json').open('x',encoding='utf-8')as output:
    json.dump(network,output,indent=2);output.write('\n')
proof=dict(success=True,screen='ciw.container-despesas-lote',containerId=2147000110,programVersion='1.0.0',businessWriteRequests=0,userCanceledNativeGrid=True,performedBy='agent using actual published production UI through CUA',ownedStateSha256=sha(directory/'state.json'),observedAt=network['completedAt'],snapshots14Equal=True,truncated=False,drainClosed=True,tabId='36',url='http://127.0.0.1:8765/production/app.html?screenId=ciw.container-despesas-lote&context__container_id=2147000110',observedUiActions=['Clicked Valor previsto for own expense44043/definition4','Set numeric editor from1,00 to1,50 and pressedTab; UI showed1,50','Clicked Cancelar lote and confirmed Descartar alteracoes in Kendo dialog','UI returned1,00; Salvar lote and Cancelar lote disabled; seven rows retained'],saveClicked=False,networkProofSha256=sha(directory/'ui-cancel-network-proof.json'),beforeReadProofSha256=sha(directory/'ui-before.json'),afterReadProofSha256=sha(directory/'ui-after.json'),visualEvidence='CUA screenshot emitted after cancellation showing original1,00 and2,00, seven test rows and disabled save/cancel controls; no screenshot file path claimed',businessWrites=False)
with (directory/'ui-cancel-proof.json').open('x',encoding='utf-8')as output:
    json.dump(proof,output,ensure_ascii=False,indent=2);output.write('\n')
print('PASS real UI cancel and CDP0requests bound to unchanged7rows/full14/state aftercreateB')
