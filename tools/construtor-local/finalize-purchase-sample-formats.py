from pathlib import Path
import json,hashlib,datetime
r=Path(__file__).resolve().parents[2];b=r/'.runtime/purchase-sample-formats-20261027'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert load(b/'operational-review.json')['success']
final=load(b/'exercise/confirmed-final.json');assert final['success'] and final['record']['cleaned'] and final['record']['logsPreserved']
for f in load(b/'canonical-manifest.json')['files']:assert sha(Path(f['target']))==f['sha256']
auth=load(b/'authorizations.json');assert all(not auth[k]['authorized']and auth[k]['consumed']for k in ['sequence','permissions','scenario'])
for n in ['ui-final-seven-originals.jpg','ui-update-65036.jpg','ui-deletion-65083.jpg']:assert (b/n).stat().st_size>5000
start=b'<!-- BEGIN CIW_PURCHASE_SAMPLE_FORMATS_20261027 -->';end=b'<!-- END CIW_PURCHASE_SAMPLE_FORMATS_20261027 -->'
block=(r/'integration-src/purchase-sample-formats/FINAL_CONTEXT_UPDATE.md').read_bytes().rstrip()+b'\n\n'
targets=[r/'context/RETOMADA_2026-10-16.md',r/'context/PROJECT_CONTEXT.md',Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'),Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md')]
backup=b/'memory-final-backup';assert not backup.exists();backup.mkdir();mem=[]
for i,p in enumerate(targets):
 old=p.read_bytes();assert old.count(start)==1 and old.count(end)==1
 first=old.index(start);last=old.index(end)+len(end)
 while last<len(old)and old[last:last+1]in [b'\r',b'\n']:last+=1
 replacement=old[:first]+block+old[last:];copy=backup/(str(i)+'-'+p.name);copy.write_bytes(old);assert p.read_bytes()==old,'Concurrent memory change';p.write_bytes(replacement);mem.append(dict(path=str(p),beforeSha256=hashlib.sha256(old).hexdigest(),afterSha256=sha(p),backup=str(copy)))
(b/'memory-final-update.json').write_text(json.dumps(dict(success=True,files=mem),indent=2)+'\n')
v=load(b/'ACTIVE_WORK.json');v.update(status='COMPLETED_CLEANED',businessCrudAuditValidated=True,cleanupVerified=True,logsPreserved=True,next='Scope completed; no required pending work. Continue another genuinely pending application only on subsequent request; Controles stays final.');(b/'ACTIVE_WORK.json').write_text(json.dumps(v,indent=2)+'\n')
p=r/'integration-src/ciw-inventory/purchase-orders-validation.json';v=load(p)
for name in ['grid_pub_formatos_amostra','form_pub_formatos_amostra']:
 x=v['applications'][name];x.update(state='Convertido — grade compartilhada, sequência, acesso, CRUD/auditoria e limpeza validados',stateGroup='Convertido',visualValidated=True,runtimeCrudOperationalValidated=True,auditValidated=True,remaining='Recorte concluído. Controles continua como pendência final.');x['evidence']+=' Operacional27/10:SC_TEST_PROC_FORMATOS_20261027/pai1688,item3211,formatos82/83/84,14eventos9formatos,atorLDAP,concorrência/dependência/rollback/IDsemreuso e limpeza física completa. Gates consumidos.'
v['sampleFormatsReadonlyValidation'].update(status='COMPLETED_CLEANED',businessWrites=True,ddlApplied=True,humanPermissionsApplied=True,cleanupVerified=True,businessEvents=14,formatEvents=9,actor='tadeu.parreiras',sequenceCurrent=84)
p.write_text(json.dumps(v,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
p=r/'docs/superpowers/plans/2026-10-27-ciw-purchase-sample-formats.md';s=p.read_text(encoding='utf-8').replace('- [ ]','- [x]');s+='\nConclusão27/10: três autorizações recebidas e consumidas; sequência81→84,quatro permissões,noveeventosformatos/14negócio com usuário/imagens físicas. Cenário COMPLETED_CLEANED; UI Logs/LogsExclusão e quatro memórias finais atualizadas; revisão operacional independente semP1/P2. Nenhuma publicação de produção repetida nem código alterado durante teste.\n';p.write_text(s,encoding='utf-8')
prev=b/'final-verification.json';(b/'readonly-final-verification.json').write_bytes(prev.read_bytes());v=load(prev);v.update(status='COMPLETED_CLEANED',uiCrudAccessPending=False,humanPermissionsApplied=True,schemaApplied=True,businessWrites=True,businessCrudAuditValidated=True,cleanupVerified=True,logsPreserved=True,businessEvents=14,formatEvents=9,actor='tadeu.parreiras',sequenceCurrent=84,requiredAuthorizations=[],authorizationsConsumed=True,operationalReview=True,fourMemoriesUpdated=True,finalizedAt=datetime.datetime.now(datetime.timezone.utc).isoformat());prev.write_text(json.dumps(v,indent=2)+'\n')
with (b/'progress.md').open('a',encoding='utf-8')as f:f.write('\nCOMPLETED_CLEANED:cenário1688/3211/82/83/84limpo;5gruposfísicoszero,7formatosoriginaisidênticos,sequência84semreset,14eventos9formatos preservados/LDAP. Revisãooperacional independente semP1/P2. LogsUIupdate65036/tx30169 e delete65083/tx30182 com usuário/imagens; LogsExclusão somente3deletes. Gatesfalse/consumidos. Quatromemórias/inventário/docs finais atualizados. Não repetirDDL/grants/cenário/publicação.\n')
print('PASS completed/cleaned final evidence, inventory and4memories; consumed scopes not reusable')
