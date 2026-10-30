"""Persist consumed eight-read grants and the pending exact 1042 scenario."""
from pathlib import Path
import json,hashlib,shutil
r=Path(__file__).resolve().parents[2];s=r/'.runtime/ciw-completion-20261028'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
for folder in ['wave2-aux-access','build7-readonly-access']:
 proof=load(s/folder/'verified.json');gate=load(s/folder/'authorization.json')
 assert proof['success'] and len(proof['addedOnly'])==4 and proof['authorizationConsumed'] and gate['consumed'] and not gate['authorized']
a=load(s/'container-expense-batch-preflight/human-authorization-20261028.json');assert a['containerId']==2147000110 and a['consumed'] is False
b=s/'memory-new-authorizations-backup';b.mkdir()
note='''**Autorizações novas recebidas e estado prevalente dos acessos:** call_613997... autorizou quatro consultas AUX do histórico e call_9b23eee... quatro consultas de descontos/distribuição. Oito concessões APLICADAS e VERIFICADAS, integridade nativa/snapshots LDAP/demais acessos preservados; gates consumidos. Provas wave2-aux-access e build7-readonly-access/{authorization,applied,verified}.json. Não conceder nem executar novamente. call_bc3aa... autorizou somente container_despesas_lote_progress.read/.edit/.delete e cenário CIW-1042-VALIDACAO-20261028-2147000110: container novo2147000110, despesasdefinições4/5, até22despesas e4memórias, limpeza canônica/logs preservados, sem outrosregistros existentes. AUTORIZADO mas ainda NÃOconcedido/executado; human-authorization-20261028.json no preflight1042. Continuar publicação dos metadados/preflight atual antes do cenário; antigas TT600/collector/cleanupclosure jáprovadas não precisam repetição automática.

Usuário perguntou quais aplicações faltam, sem informar caminho do acervo. Relatório completo em integration-src/ciw-completion-20261028/remaining-applications/PENDENCIAS_ATUAIS.md;262origens/62registradasConvertido/200nãoencerradas não equivalem a200telas sem implementação. Pergunta dos anexos refere-se a cons_anexos_container/form_anexos_container;146arquivos ausentes, não146aplicações. ControlesFINAL e GLOBALACTIVE mantidos. Candidatoisolado Builder filtrosdecimal-v2:2testes26+24regressões48+16checagensmetadata/AJV/rendererprototype, aindaNÃOintegrado/publicado; dataModelnumber/normalizeFieldType/Kendo preservados. release418666e2... em builder-decimal-filters-v2, aguardareview. DiagnósticoSEARCH1054 v3 compilou12.2, executou NUMDBS0 e achou quatro.r/zerofontes.p, semRUNtriggers, mas guardPROPATHexato falhou porque AVM expande bibliotecasDLC; resultado privado recuperado15088, não repetirAVM. Efeitos dos triggers ainda não comprovados.

'''
paths=[r/'context/PROJECT_CONTEXT.md',r/'context/RETOMADA_2026-10-16.md',Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'),Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md'),r/'context/CIW_COMPLETION_GOAL_2026-10-28.md']
receipts=[]
for i,p in enumerate(paths):
 raw=p.read_bytes();text=raw.decode('utf-8-sig');assert note not in text
 shutil.copy2(p,b/(str(i)+'-'+p.name))
 if i<4:
  marker='<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->';assert text.count(marker)==1;text=text.replace(marker,marker+'\n\n'+note,1)
 else:
  first,rest=text.split('\n',1);text=first+'\n\n'+note+rest
 p.write_text(text,encoding='utf-8');receipts.append(dict(path=str(p),before=hashlib.sha256(raw).hexdigest(),after=hashlib.sha256(p.read_bytes()).hexdigest()))
work=load(s/'ROOT_ACTIVE.json');work.update(auxHumanAccess='EXACT4_APPLIED_VERIFIED_CONSUMED_613997',build7HumanAccess='EXACT4_APPLIED_VERIFIED_CONSUMED_9B23',batchScenario='AUTHORIZED_EXACT2147000110_NOT_EXECUTED',batchFunctionalAccess='AUTHORIZED3_NOT_GRANTED_METADATA_HELD',dailyTriggerSearch='V3_COMPILE122_EXECUTED_NUMDBS0_4RCODEFOUND_0SOURCE_PROPATHGUARDFAIL_NO_REPLAY',decimalFilters='V2CANDIDATE_2_26_REG24_48_NATIVE16_REVIEW_PENDING_NO_CANONICAL')
(s/'ROOT_ACTIVE.json').write_text(json.dumps(work,indent=2)+'\n')
(s/'memory-new-authorizations.json').write_text(json.dumps(dict(success=True,files=receipts,goal='ACTIVE'),indent=2)+'\n')
print('PASS memories:8reads consumed/1042 authorized not executed/remaining-applications report; global ACTIVE')
