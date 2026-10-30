from pathlib import Path
from collections import Counter
from datetime import datetime, timezone
import hashlib, json, xml.etree.ElementTree as ET

r=Path(__file__).resolve().parents[2]
b=r/'.runtime/purchase-quantity-periods-20261028'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
save=lambda p,v:p.write_text(json.dumps(v,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
canonical=load(b/'canonical-manifest.json')
assert canonical['success'] and len(canonical['files'])==17
for item in canonical['files']:
 assert sha(Path(item['target']))==item['sha256'],item['target']
compile=load(b/'official-compile-verification.json')
assert compile['success'] and compile['build']==9 and compile['version']=='12.2'
assert (compile['compileEntries'],compile['testsPerCombination'],compile['combinations'])==(19,231,4)
assert compile['testsWithoutDatabase'] and not compile['businessWrites']
published=load(b/'active-manifest.json')
assert published['success'] and len(published['targets'])==18
assert load(b/'review-final.json')['status']=='reviewed_no_open_confirmed_P1_P2'
for name in ['metadata-publication.json','pasoe-read-proof.json','native-read-proof.json']:
 assert load(b/name)['success'],name
suite=ET.parse(b/'php-full.xml').getroot().find('testsuite')
assert tuple(suite.get(x) for x in ['tests','assertions','errors','failures'])==('885','5841','0','0')
gate=load(b/'access/authorization.json')
assert gate['authorized'] is False and not (b/'access/applied.json').exists()
assert load(b/'access/plan.json')['permissionsToAdd']==['proc_compra_quantidades_periodo_med_progress.read']
assert (b/'ui-access-pending.jpg').exists()

backup=b/'memory-published-backup'
assert not backup.exists(),'One-time context integration already performed'
block=(r/'integration-src/purchase-quantity-periods/PUBLISHED_CONTEXT.md').read_bytes().rstrip()+b'\n\n'
start=b'<!-- BEGIN CIW_PURCHASE_QUANTITY_PERIODS_20261028 -->'
end=b'<!-- END CIW_PURCHASE_QUANTITY_PERIODS_20261028 -->'
targets=[r/'context/RETOMADA_2026-10-16.md',r/'context/PROJECT_CONTEXT.md',Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'),Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md')]
prepared=[]
for p in targets:
 old=p.read_bytes();assert old.count(start)==1 and old.count(end)==1
 a=old.index(start);z=old.index(end)+len(end)
 while z<len(old) and old[z:z+1] in [b'\r',b'\n']:z+=1
 prepared.append((p,old,old[:a]+block+old[z:]))
backup.mkdir();receipt=[]
for i,(p,old,new) in enumerate(prepared):
 q=backup/(str(i)+'-'+p.name);q.write_bytes(old);assert p.read_bytes()==old;p.write_bytes(new)
 receipt.append(dict(path=str(p),sha256=sha(p),backup=str(q)))
doc=r/'docs/ciw-quantidades-por-periodo-2026-10-28.md'
(backup/'prepared-documentation.md').write_bytes(doc.read_bytes())
doc.write_bytes((r/'docs/ciw-quantidades-por-periodo-publicada-2026-10-28.md').read_bytes())
(r/'docs/ciw-quantidades-por-periodo-publicada-2026-10-28.md').unlink()
final=r/'integration-src/purchase-quantity-periods/FINAL_CONTEXT_UPDATE.md'
(backup/'prepared-FINAL_CONTEXT_UPDATE.md').write_bytes(final.read_bytes())
final.write_bytes(block.rstrip()+b'\n')
(r/'integration-src/purchase-quantity-periods/PUBLISHED_CONTEXT.md').unlink()
save(b/'memory-published-update.json',dict(success=True,files=receipt,businessWrites=False,humanPermissionsChanged=False))

state=load(b/'ACTIVE_WORK.json')
state.update(status='PUBLISHED_AWAITING_READ_ACCESS',published=True,canonicalProductChanges=True,official122Compiled=True,reviewInProgress=False,reviewPassed=True,phpTests=885,phpAssertions=5841,newPermissionApproved=False,newPermissionApplied=False,nativeRuntimeValidated=True,visualDataValidated=False,newPermissionQuestionPending=True,networkRequired=False,networkQuestionPending=False,fourMemoriesUpdated=True)
state['remaining']='Await exact-one-read approval; apply guarded grant, verify snapshots/other access, validate UI. Controles final. Do not repeat publication.'
save(b/'ACTIVE_WORK.json',state)
p=r/'integration-src/ciw-inventory/purchase-orders-validation.json';inventory=load(p);entry=inventory['applications']['cons_item_qt_imp_union']
entry.update(state='Publicado — PASOE/runtime validados; acesso humano de consulta pendente',stateGroup='Parcial',runtimeReadValidated=True,visualValidated=False,converted=True,published=True,screenId='ciw.quantidades-importadas-periodo-med',programCode='op1030',version='1.0.0',entityCode='proc_compra_quantidades_periodo_med_progress',businessWrites=False,remaining=state['remaining'],evidence='docs/ciw-quantidades-por-periodo-2026-10-28.md; build9 OE12.2 231checks x4; PHP885/5841; PASOE/read/get/3periodos/11negativas; native read/get/skip200/Between; UI refused only missing read grant. UNION collation differences not directly proven against legacy SQL.')
inventory['quantityPeriodsReadonlyValidation']=dict(date='2026-10-28',published=True,ablChecksPerCombination=231,combinations=4,phpTests=885,phpAssertions=5841,pasoe=True,nativeRuntime=True,uiData=False,humanReadGranted=False,businessWrites=False,controlesFinal=True)
save(p,inventory)
p=r/'integration-src/ciw-inventory/inventory-reviewed.json';catalog=load(p);entries=[x for x in catalog['entries'] if x['name']=='cons_item_qt_imp_union'];assert len(entries)==1
entries[0].update(state=entry['state'],state_group='Parcial',remaining=entry['remaining'],evidence=entry['evidence'])
catalog['counts']['state_group']=dict(Counter(x['state_group'] for x in catalog['entries']));save(p,catalog)
now=datetime.now(timezone.utc).isoformat()
save(b/'ui-verification.json',dict(success=False,expectedAccessDenied=True,screenId=entry['screenId'],dataVisualizationValidated=False,reason='Exact new read grant awaiting human approval',screenshot='ui-access-pending.jpg',businessWrites=False))
save(b/'final-verification.json',dict(at=now,status=state['status'],canonicalFiles=17,canonicalHashesMatch=True,publishedArtifacts=18,officialVersion='12.2',officialChecksPerCombination=231,combinations=4,phpTests=885,phpAssertions=5841,pasoeValidated=True,nativeValidated=True,reviewNoOpenConfirmedP1P2=True,memoriesUpdated=4,permissionApplied=False,businessWrites=False,schemaApplied=False,uiDataValidated=False,knownLimit='Legacy SQL UNION case/padding equality not directly proven; no guessed normalization',remaining=state['remaining']))
(b/'progress.md').write_text('# Entrega28/10\n\nRede restaurada sem alterar rotas. Build9 OE12.2:231checks em cada uma de4combinações; PHP885/5841.17canônicos/18artefatos publicados, revisão final semP1/P2 confirmadas abertas. PASOE e runtime nativo read/get/períodos/paginação validados. Parâmetro ausente usa fallback60. Fonte111/pai1.0.8 preservados. Somente nova read solicitada após prova concreta; gate false, UI de dados pendente. Quatro memórias e inventário atualizados. Sem escrita operacional ou DDL. Controles final.\n',encoding='utf-8')
print('PASS:17 canonical hashes,18 published artifacts,231x4/885PHP,4 memories; PUBLISHED_AWAITING_READ_ACCESS; no business writes/grants/DDL')
