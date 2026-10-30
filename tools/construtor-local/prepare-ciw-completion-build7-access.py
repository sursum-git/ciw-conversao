"""Prepare four independent read grants. Never opens DB, executes PHP or grants access."""
from pathlib import Path
import json,hashlib
R=Path(__file__).resolve().parents[2];T=R/'tools/construtor-local';S=R/'.runtime/ciw-completion-20261028/build7-readonly-access'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert not(S/'authorization.json').exists(),'Do not reset an existing authorization gate'
receipt=R/'.runtime/ciw-completion-20261028/official-build7/metadata-publication.json';pub=load(receipt)
assert pub['success'] and pub['sourceOperations']==140 and pub['humanPermissionsChanged'] is False
rows=pub['published'];assert [x['program'] for x in rows]==['op1045','op1046','op1049','op1050']
oldPermissions=['container_versao_pagtos_historico_med_progress.read','container_versao_nfs_historico_med_progress.read','container_versao_descontos_historico_med_progress.read','container_versao_despesas_historico_med_progress.read']
oldScreens=['ciw.container-versao-pagamentos-historico','ciw.container-versao-nfs-historico','ciw.container-versao-descontos-historico','ciw.container-versao-despesas-historico']
permissions=[x['entity']+'.read' for x in rows];screens=[x['screen'] for x in rows]
S.mkdir()
for kind,source,dest in [('enable','enable-ciw-completion-wave2-aux-reads.php','enable-ciw-completion-build7-reads.php'),('verify','verify-ciw-completion-wave2-aux-access.php','verify-ciw-completion-build7-access.php')]:
    text=(T/source).read_text(encoding='utf-8-sig')
    for old,new in zip(oldPermissions,permissions):assert text.count(old)==1;text=text.replace(old,new)
    if kind=='enable':
        for old,new in zip(oldScreens,screens):assert text.count(old)==1;text=text.replace(old,new)
    text=text.replace('wave2-aux-access','build7-readonly-access').replace('explicit-ciw-completion-wave2-aux-reads','explicit-ciw-completion-build7-readonly-reads')
    text=text.replace('Tela de auditoria ausente','Consulta readonly ausente').replace('Leitura de auditoria indisponivel','Leitura readonly indisponivel')
    (T/dest).write_text(text,encoding='utf-8')
gate={'authorized':False,'consumed':False,'user':'tadeu.parreiras','permissions':permissions,'humanApprovalReference':None,'status':'PENDING_HUMAN_RESPONSE','scope':'Four new readonly queries only; separate from consumed wave1 and pending wave2 AUX grants','metadataPublicationSha256':sha(receipt),'writers':False,'businessScenarioAuthorized':False}
(S/'authorization.json').write_text(json.dumps(gate,indent=2)+'\n',encoding='utf-8')
result={'success':True,'preparedOnly':True,'executedPhp':False,'databaseAccess':False,'permissionsChanged':False,'user':gate['user'],'permissions':permissions,'screens':screens,'authorized':False,'consumed':False,'inputReceiptSha256':sha(receipt),'tools':[{'path':str((T/n).relative_to(R)),'sha256':sha(T/n)}for n in ['enable-ciw-completion-build7-reads.php','verify-ciw-completion-build7-access.php']]}
(S/'preparation.json').write_text(json.dumps(result,indent=2)+'\n',encoding='utf-8')
print('Prepared exactly4 new read grants; gatefalse/consumedfalse; no DB/PHP execution/permission mutation')
