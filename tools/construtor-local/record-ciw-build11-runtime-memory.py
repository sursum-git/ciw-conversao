"""Record the completed 1055 API publication separately from pending metadata."""
from pathlib import Path
import json,hashlib,shutil,re
r=Path(__file__).resolve().parents[2];s=r/'.runtime/ciw-completion-20261028';b=s/'official-build11';d=s/'runtime-build11'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
official=load(b/'official-compile-verification.json');active=load(d/'active-manifest.json');pasoe=load(b/'pasoe-read-proof.json')
assert official['success'] and official['totalChecks']==384 and active['success'] and active['medWebRestored'] and active['imaWebUnchanged'] and len(active['targets'])==4
assert pasoe['success'] and pasoe['checks']==17 and pasoe['positiveGet']
for row in load(b/'canonical-manifest.json')['files']:assert sha(Path(row['target']))==row['sha256']
for name in ['active-manifest.json','publication-attempt.json']:
 assert not(b/name).exists();shutil.copy2(d/name,b/name);assert sha(b/name)==sha(d/name)
backup=s/'memory-build11-runtime-backup';backup.mkdir()
note='''## Checkpoint11 — API de relações despesa/imposto publicada e validada

Estado prevalente: oficial11 sessão45391 CONCLUÍDA/exit0, sete compilações OpenEdge12.2/.42, oito logs TT/384verificações/NUMDBS0; FULLPHP986/7023 com277classesApp100%stage/413fontes. Cinco arquivos canônicos integrados por hashes/backups: doisABL, doisPHPcompartilhados e helperPHPnovo. Release4a51bdd4.../managerd6240865.... NÃOrepetircompile/integração. Publicação97061 CONCLUÍDA: somente CiwErpReadService/CiwCadastrosCrud p+r, quatro artefatos no share137/PASOEsursum-api/MED9911; MED restaurado8,797s, sessões147/148 refreshsamepid3856625, estado IMA preservado. PASOE17checksPASS: listagem GLOBAL, PK3nullable, GETpositivo/paging/filtros/aliases/campos/contextos inválidos/token. Total12éobservação, nãoinvariante. Semgravaçãocomercial/processo/rotas/auth/DDL. Provas official-build11/{official-compile-verification,canonical-manifest,active-manifest,publication-attempt,pasoe-read-proof}.json; active/attempt cópias EXATASde runtime-build11.

Metadados1055 ainda NÃOpublicados: gerente/executor preparam singlechildop1055/ciw.despesas-impostos-geral e fontecadastros144→146, preservando operações/auth. Não conceder acesso nem dizertela publicadaporAPI. Inventário não promoveorigem/form porsemelhança. FinanceService614795do10 permanece inalterado. Nova1053NFs temaliascorrigido/PASOEpass,masquatrocontainers atingemlimite200candidatos; companionpaginaçãoemTT reutilizaCiwErpReadService, ainda candidato/retido. Runtime10nãoépararepetir. Comparações1040/41 recepcionarammetadadosSQL15expressõesBRL/USD viaPREPARE/DESCRIBESEMexecute; candidato congelado1649...aguardarevisão/oficial, nãoalegarparidade publicada.1056descontosfornecedoremdescoberta precisaeventualcompanionintegerRange;semcanonical. Builderfiltrosdecimal-v2 é candidato205ebd.../release418666.../2tests26+24regressões48+16native metadata checks, NÃOintegrado; preservarBuilder72c6atévalidar11/1042, não regenerarautomaticamentetelas.

Oito permissões novas AUX4+descontos/distribuição4 JÁAPLICADAS/VERIFICADAS, gatesconsumidos;não repetir.1042 recebeu autorizaçãoEXATA para trêspermissõesread/edit/delete e cenário2147000110/duasdefs4e5/até22despesas4memórias/limpezacanônicalogspreservados, aindaSEMconcessão/SEMnegócio executado. Preflight1042/wholeparentpreview sóversion1.0.4→1.0.5+link/owner nativoop1003v120verde em batch1042-metadata; gerente preparapublisher/exercise. Rootgrant3ferramentasprontas, gateaguardametadata. InspectorRO13tabelas doCID: primeirocompile55631FALHOU porsintaxe deexpressões compactas, NÃOexecutouDB. V2freshprepared/source422a4010... syntax12.8SEM-SAVEPASS, aguardarevisão/compilaçãooficial122. Não usar.r12.8. Replay600/collector/closurelimpezajáprovados; testesoperacionaisprecisamguardsfrescos, semrepetir mutaçõesdesconhecidas.

1054SEARCHv3compilou12.2/NUMDBS0 e executou diagnósticoquatrotriggers4.rpresentes/0.p; guardPROPATHexato falhou porqueAVMexpandeDLC, resultadojárecuperado15088. Não repetirAVMnemexecutartriggers; efeitosfísicosdeERP continuamretidos/semhooklogin. Anexoscontainers cons_anexos_container/form_anexos_container:146referências comarquivosausentes, aguardacaminho/backup; usuárioperguntouquaisappsfaltam,nãoinformouacervo. Lista completaem integration-src/ciw-completion-20261028/remaining-applications/PENDENCIAS_ATUAIS.md.262origens/62registradasConvertido/200nãoencerradas NÃOsignifica200telasporimplementar. GLOBALACTIVE/ControlesFINAL. Semsenhas/commit/push.

'''
paths=[r/'context/PROJECT_CONTEXT.md',r/'context/RETOMADA_2026-10-16.md',Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'),Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md')];receipts=[]
marker='<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->\n\n'+note+'<!-- END CIW_COMPLETION_GOAL_20261028 -->'
for i,p in enumerate(paths):
 raw=p.read_bytes();text=raw.decode('utf-8-sig');assert text.count('<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->')==1
 shutil.copy2(p,backup/(str(i)+'-'+p.name));p.write_text(re.sub(r'<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->.*?<!-- END CIW_COMPLETION_GOAL_20261028 -->',lambda _:marker,text,count=1,flags=re.S),encoding='utf-8');receipts.append(dict(path=str(p),before=hashlib.sha256(raw).hexdigest(),after=sha(p)))
p=r/'context/CIW_COMPLETION_GOAL_2026-10-28.md';raw=p.read_text(encoding='utf-8-sig');assert '## Checkpoint11 — API'not in raw;shutil.copy2(p,backup/p.name);first,rest=raw.split('\n',1);p.write_text(first+'\n\n'+note+rest,encoding='utf-8')
work=load(s/'ROOT_ACTIVE.json');work.update(officialBuild11='OFFICIAL45391_7_384_CANONICAL5_RUNTIME4_97061_MEDRESTORED8.797S_PASOE17GREEN',metadata11='PREPARING_NOT_PUBLISHED_NO_HUMAN_GRANTS',batchFixtureInspector='V1COMPILE55631FAILED_NO_DB_V2LOCALSYNTAX_GREEN_OFFICIAL_PENDING');(s/'ROOT_ACTIVE.json').write_text(json.dumps(work,indent=2)+'\n')
(s/'memory-build11-runtime.json').write_text(json.dumps(dict(success=True,goal='ACTIVE',files=receipts),indent=2)+'\n')
print('PASS11 API published/validated memory saved; metadata/scenario explicitly pending; global ACTIVE')
