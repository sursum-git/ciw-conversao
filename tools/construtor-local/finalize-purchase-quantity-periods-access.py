from pathlib import Path
from collections import Counter
from datetime import datetime, timezone
import json, hashlib

r=Path(__file__).resolve().parents[2];b=r/'.runtime/purchase-quantity-periods-20261028'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
save=lambda p,v:p.write_text(json.dumps(v,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
access=load(b/'access/verified.json');gate=load(b/'access/authorization.json')
assert access['success'] and access['addedOnly']==['proc_compra_quantidades_periodo_med_progress.read']
assert access['otherPermissionsPreserved'] and access['nativeIntegrity'] and access['sessionsVerified']==4
assert gate['authorized'] is False and gate['consumed'] is True
assert gate['humanApprovalReference']=='call_96b46971b9a24e2083b3dd4d0a7704fa'
images=['ui-ldap-period-filter.jpg','ui-ldap-period-detail.jpg','ui-ldap-period-final.jpg']
for image in images:assert (b/image).exists()
save(b/'ui-verification.json',dict(success=True,user='tadeu.parreiras',provider='ldap',screenId='ciw.quantidades-importadas-periodo-med',readOnly=True,list=True,forecastBetween={'start':'2026-11-01','end':'2026-11-30','observedTotal':60},menuVisualizar=True,detailOrigin=True,detailQuantitiesAndValues=True,businessWrites=False,screenshots=images,temporaryAgentTabClosed=True,userTabsPreserved=['1','2'],tunnelSessionRetained=89611))
backup=b/'memory-access-final-backup';assert not backup.exists(),'One-time access finalization already executed'
final=r/'integration-src/purchase-quantity-periods/FINAL_CONTEXT_UPDATE.md'
block=final.read_text(encoding='utf-8').replace('PUBLISHED_AWAITING_READ_ACCESS','COMPLETED_READONLY')
a=block.index('**Acesso pendente:**');z=block.index('**Rede restaurada:**',a)
block=block[:a]+'''**Acesso autorizado, aplicado e concluído:** resposta humana call_96b46971b9a24e2083b3dd4d0a7704fa autorizou SOMENTE `proc_compra_quantidades_periodo_med_progress.read` para `tadeu.parreiras`. Aplicada exatamente uma concessão pelo mecanismo nativo; integridade, quatro snapshots LDAP244/246/249/368 e demais acessos conferidos. Recibos access/{applied,verified}.json; authorization.json authorized=false/consumed=true. NÃO reaplicar. Sessão LDAP real abriu lista com2912projeções observadas, filtro Previsão Entre01/11/2026–30/11/2026 com60linhas, menuVisualizar e abas Origem/Quantidades e valores do detalhe somente leitura. Imagens ui-ldap-period-{filter,detail,final}.jpg; ui-verification.json confirma validação. Temporária25 encerrada; abas do usuário1/2 preservadas. Nenhuma escrita de negócio/DDL. Sem trabalho obrigatório restante neste recorte readonly; limite de comparação SQL acima continua registrado. Não repetir concessões, compilação ou publicação. Controles permanece pendência final.

'''+block[z:]
block=block.replace('ui-access-pending.jpg,final-verification.json,memory-published-update.json','ui-access-pending.jpg,ui-verification.json,final-verification.json,memory-published-update.json,memory-access-final-update.json')
start=b'<!-- BEGIN CIW_PURCHASE_QUANTITY_PERIODS_20261028 -->';end=b'<!-- END CIW_PURCHASE_QUANTITY_PERIODS_20261028 -->'
targets=[r/'context/RETOMADA_2026-10-16.md',r/'context/PROJECT_CONTEXT.md',Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'),Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md')]
prepared=[]
for p in targets:
 old=p.read_bytes();assert old.count(start)==1 and old.count(end)==1
 a=old.index(start);z=old.index(end)+len(end)
 while z<len(old) and old[z:z+1] in [b'\r',b'\n']:z+=1
 prepared.append((p,old,old[:a]+block.rstrip().encode('utf-8')+b'\n\n'+old[z:]))
backup.mkdir();receipt=[]
for i,(p,old,new) in enumerate(prepared):
 q=backup/(str(i)+'-'+p.name);q.write_bytes(old);assert p.read_bytes()==old;p.write_bytes(new)
 receipt.append(dict(path=str(p),sha256=sha(p),backup=str(q)))
(backup/'FINAL_CONTEXT_UPDATE.md').write_bytes(final.read_bytes());final.write_text(block,encoding='utf-8')
save(b/'memory-access-final-update.json',dict(success=True,files=receipt,businessWrites=False,permissionAddedOnly=access['addedOnly']))

p=r/'docs/ciw-quantidades-por-periodo-2026-10-28.md';doc=p.read_text(encoding='utf-8');(backup/'documentation.md').write_text(doc,encoding='utf-8')
a=doc.index('Estado em28/10/2026:');z=doc.index('\n\n',a)
doc=doc[:a]+'Estado em28/10/2026: COMPLETED_READONLY. API e tela publicadas e validadas no PASOE, no runtime e na sessão LDAP de `tadeu.parreiras`. Consulta, filtro de datas e detalhe conferidos. Controles permanece pendência final.'+doc[z:]
a=doc.index('Plano preparado para somente');z=doc.index('\n\nRecibos privados',a)
doc=doc[:a]+'''A resposta humana `call_96b46971b9a24e2083b3dd4d0a7704fa` autorizou somente `proc_compra_quantidades_periodo_med_progress.read` para `tadeu.parreiras`. Aplicada uma única concessão; integridade nativa, demais permissões e quatro snapshots LDAP244/246/249/368 conferidos. Autorização consumida, gate fechado; não reaplicar.

Na sessão LDAP real, a lista carregou2912projeções observadas. O filtro Previsão de chegada Entre01/11/2026–30/11/2026 retornou60linhas. Menu Visualizar e abas Origem/Quantidades e valores do detalhe somente leitura foram conferidos. Evidências privadas `ui-verification.json` e `ui-ldap-period-{filter,detail,final}.jpg`. Aba temporária25 fechada; abas do usuário1/2 preservadas. Sem trabalho obrigatório restante neste recorte, sem escrita operacional ou DDL. Não repetir compilação/publicação/concessão. Controles permanece pendência final.'''+doc[z:]
doc=doc.replace('`access/plan.json`, `ui-access-pending.jpg`','`access/applied.json`, `access/verified.json`, `ui-verification.json`, `ui-ldap-period-final.jpg`, `memory-access-final-update.json`');p.write_text(doc,encoding='utf-8')
p=r/'docs/superpowers/plans/2026-10-28-ciw-purchase-quantity-periods.md';plan=p.read_text(encoding='utf-8');plan=plan.replace('- [ ] Validar UI, atualizar quatro memórias/inventário e solicitar somente nova read, se necessária.','- [x] Validar UI, atualizar quatro memórias/inventário e aplicar somente nova read expressamente autorizada.');p.write_text(plan,encoding='utf-8')
p=r/'integration-src/ciw-inventory/purchase-orders-validation.json';inventory=load(p);entry=inventory['applications']['cons_item_qt_imp_union'];entry.update(state='Convertido — consulta MED publicada, acesso autorizado e UI validada',stateGroup='Convertido',visualValidated=True,remaining='Sem trabalho obrigatório neste recorte readonly. Limite de collation SQL documentado. Controles permanece pendência final.',readAccessGranted=True)
entry['evidence']+='; exact-one-read authorized/applied/verified; LDAP UI list/Between60/detail two tabs passed; access gate consumed.'
inventory['quantityPeriodsReadonlyValidation'].update(uiData=True,humanReadGranted=True,status='COMPLETED_READONLY');save(p,inventory)
p=r/'integration-src/ciw-inventory/inventory-reviewed.json';catalog=load(p);entries=[x for x in catalog['entries'] if x['name']=='cons_item_qt_imp_union'];assert len(entries)==1;entries[0].update(state=entry['state'],state_group='Convertido',remaining=entry['remaining'],evidence=entry['evidence']);catalog['counts']['state_group']=dict(Counter(x['state_group'] for x in catalog['entries']));save(p,catalog)
p=b/'ACTIVE_WORK.json';state=load(p);state.update(status='COMPLETED_READONLY',newPermissionApproved=True,newPermissionApplied=True,newPermissionQuestionPending=False,visualDataValidated=True,remaining='No required work in this readonly scope. Known legacy SQL collation validation limit documented. Controles final.');save(p,state)
p=b/'final-verification.json';v=load(p);v.update(at=datetime.now(timezone.utc).isoformat(),status='COMPLETED_READONLY',permissionApplied=True,permissionAddedOnly=access['addedOnly'],permissionIntegrityVerified=True,ldapSessionsVerified=4,authorizationConsumed=True,uiDataValidated=True,remaining=state['remaining']);save(p,v)
with (b/'progress.md').open('a',encoding='utf-8') as f:f.write('\nAcesso final: autorização humana específica aplicada uma vez; somente read nova, integridade e quatro snapshots conferidos. UI LDAP lista/filtroEntre60/menuVisualizar/detalhe2abas passaram; temporária25 fechada/abas1e2preservadas. Quatro memórias atualizadas. COMPLETED_READONLY. Controles final.\n')
for item in load(b/'canonical-manifest.json')['files']:assert sha(Path(item['target']))==item['sha256']
for item in receipt:assert sha(Path(item['path']))==item['sha256']
print('PASS COMPLETED_READONLY:1 exact read/4LDAP snapshots/UI list/filter/detail/4memories;17canonical hashes unchanged; no business writes/DDL')
