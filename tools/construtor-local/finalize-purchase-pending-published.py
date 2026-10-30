from pathlib import Path
from datetime import datetime,timezone
import json,hashlib,xml.etree.ElementTree as ET
r=Path(__file__).resolve().parents[2];b=r/'.runtime/purchase-pending-integration-20261028';c=r/'integration-src/purchase-pending-20261028'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
save=lambda p,v:p.write_text(json.dumps(v,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
for name in ['official-compile-verification.json','canonical-manifest.json','active-manifest.json','pasoe-read-proof.json','native-read-proof.json','metadata-publication.json']:assert load(b/name)['success'],name
assert load(b/'review-final.json')['openP1P2']==[]
assert load(b/'native-read-proof.json')['pagingAfter200']
assert load(r/'.runtime/purchase-pending-manager-20261028/inventory-reconciliation.json')['success']
suite=ET.parse(b/'php-full.xml').getroot().find('testsuite');assert (suite.get('tests'),suite.get('assertions'),suite.get('errors'),suite.get('failures'))==('885','5841','0','0')
for x in load(b/'canonical-manifest.json')['files']:assert sha(Path(x['target']))==x['sha256']
assert load(b/'access/authorization.json')['authorized'] is False and not(b/'access/applied.json').exists()
assert (b/'ui-access-pending.jpg').exists()
blockFile=c/'FINAL_CONTEXT_UPDATE.md';block=blockFile.read_text(encoding='utf-8')
assert 'PUBLISHED_AWAITING_ACCESS' in block and 'runtime nativo read/get/contexto/contagens das três telas GREEN' in block
block=block.replace('Runtime preservou fonte118/111 anteriores e pai1.0.8/onze abas idênticos;','Runtime confirmou paginação real após200 com dados/totais iguais ao PASOE, Logs enabledtrue/transactions e preservou fonte118/111 anteriores e pai1.0.8/onze abas idênticos;')
block=block.replace('Root continuará acesso/UI e atualizará este bloco nas quatro memórias;','Aba temporária27 confirmou403 na sessão LDAP, screenshotui-access-pending.jpg; fechada27/preservadasabasusuário1/2/26. Quatro memórias atualizadas; acesso/UI continuam pendentes. Recibos access/plan.json preparedOnly/authorization.json false, final-verification.json e memory-published-update.json. Não repetir antes de resposta humana;')
targets=[r/'context/RETOMADA_2026-10-16.md',r/'context/PROJECT_CONTEXT.md',Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'),Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md')]
start=b'<!-- BEGIN CIW_PURCHASE_PENDING_20261028 -->';end=b'<!-- END CIW_PURCHASE_PENDING_20261028 -->';backup=b/'memory-published-backup';assert not backup.exists();prepared=[]
for p in targets:
 old=p.read_bytes();assert old.count(start)==0 and old.count(end)==0
 prefix=b'\xef\xbb\xbf'if old.startswith(b'\xef\xbb\xbf')else b''
 prepared.append((p,old,prefix+block.rstrip().encode('utf-8')+b'\n\n'+old[len(prefix):]))
backup.mkdir();receipt=[]
for i,(p,old,new)in enumerate(prepared):
 q=backup/(str(i)+'-'+p.name);q.write_bytes(old);assert p.read_bytes()==old;p.write_bytes(new);receipt.append(dict(path=str(p),sha256=sha(p),backup=str(q)))
(backup/'context-draft.md').write_bytes(blockFile.read_bytes());blockFile.write_text(block,encoding='utf-8')
save(b/'memory-published-update.json',dict(success=True,files=receipt,businessWrites=False,humanPermissionsChanged=False))
p=b/'ACTIVE_WORK.json';v=load(p);v.update(status='PUBLISHED_AWAITING_ACCESS',canonicalChanges=True,published=True,metadataPublished=True,nativeValidated=True,pagingAfter200Validated=True,configurationLogsEnabled=True,humanPermissionsApplied=False,newAccessQuestionPending=True,visualDataValidated=False,fourMemoriesUpdated=True,remaining='Await explicit authorization for three read grants and config edit; UI LDAP validation. Controles final, batch sample write absent in legacy, other companies out of MED scope. No replay compile/publish.');save(p,v)
save(b/'ui-verification.json',dict(success=False,expectedAccessDenied=True,reason='New exact permissions awaiting human response',screenshot='ui-access-pending.jpg',dataVisualizationValidated=False,temporaryAgentTabClosed=True,userTabsPreserved=['1','2','26'],businessWrites=False))
save(b/'final-verification.json',dict(at=datetime.now(timezone.utc).isoformat(),status=v['status'],managerAndExecutors=True,canonicalFiles=21,canonicalHashesMatch=True,officialVersion='12.2',build=3,compileEntries=28,checksPerCombination=298,combinations=4,passedTestLogs=36,phpTests=885,phpAssertions=5841,phpAuditChecks=25,phpQueryChecks=33,reviewNoOpenP1P2=True,runtimeArtifacts=19,screens=3,sourceOperations=118,previous111Preserved=True,parentUnchanged='1.0.8',parentTabs=11,pasoeValidated=True,nativeValidated=True,pagingAfter200=True,configurationLogsEnabled=True,configurationWriteTest='temp-tables only,40checks x4',configurationOperationalUpdatesExecuted=False,businessWrites=False,ddl=False,humanPermissionsApplied=False,requiredPermissions=load(b/'access/plan.json')['permissionsToAdd'],userApprovalPending=True,uiDataValidated=False,memoriesUpdated=4,inventoryReconciled=True,userTabsPreserved=['1','2','26'],tunnelSessionRetained=89611,remaining=v['remaining']))
(b/'progress.md').write_text('# Entrega28/10 — gerente e executores\n\nGerente e2executores+revisãofinalindependente. Build1canceladopreauth. Build2faltouincludenoharness; build3oficialGREEN28compiles298checksx4/36logs/NUMDBS0. PHP885/5841+audit25/query33.21canônicos/19artefatospublicados. MEDrecargaociosas123/124/125. PASOE13negativas/5regras/read-get/config; runtime3telas/páginaapós200/Logs; source111→118/pai1.0.8preservado. Nenhumaescritaprodutiva/DDL/granthumano. Metadados3telaspublicados; nova4perguntasdepermissãoaguardaresposta. UI LDAP403esperado, temporária27fechada/abas1-2-26preservadas.4memóriasatualizadas. Controlesfinal/loteamostrassemcódigocomprovado/multiempresaforaMEDdocumentados.\n',encoding='utf-8')
for x in receipt:assert sha(Path(x['path']))==x['sha256']
print('PASS published truth saved:4memories,21canonical hashes,19runtime,3screens,298x4/885PHP; human access pending;no business writes')
