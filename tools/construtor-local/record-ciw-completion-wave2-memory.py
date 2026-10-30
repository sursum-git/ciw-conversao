"""Persist actual build5/publication state and supersede stale running markers."""
from pathlib import Path
import hashlib,json,re,shutil
r=Path(__file__).resolve().parents[2];s=r/'.runtime/ciw-completion-20261028';b=s/'official-build5-v6'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
for name in ['official-compile-verification.json','canonical-manifest.json','active-manifest.json','pasoe-read-proof.json','metadata-publication.json','runtime-read-proof.json']:assert load(b/name)['success']
assert load(b/'metadata-publication.json')['sourceOperations']==132
backup=s/'memory-wave2-published-backup';backup.mkdir()
note='''## Wave2 publicada — build5-v6 oficial e quatro filhas históricas

**Estado prevalente:** official-build5-v6 terminou; sessão48103 ENCERRADA, não esperar/repetir. OpenEdge12.2/.42:43compiles sem erro,40TT/683porcombinação/2732checks, UTF8/ISO8859-1×AMERICAN/EUROPEAN. Compilação com1conexão somente esquema espec10012;40execuçõesTT SEMbanco, Regression assertNUMDBS0 antes/depois. Net.pl da MESMAinstalação12.2 no harness; nada de PROPATHglobal/runtime. Proof official-compile-verification.json; v5 continua diagnóstico FALHOUno29º/0TT, v1–4 canceladospréSSH.

Integrados16fontes canônicos(ABL/includes+4PHP+3JS) e1rotaaditiva com backups/hashes. Publicados somente16artefatos fonte/r/include +rota containers-despesas-lote no137, não43compiles/classes/fixtures. Catálogo operacional tinha campo response na rota streaming, preservado integralmente pela mescla REMOTA, não substituir porJSONcanônico. Active-manifest17targets/routeAdditions1; MEDrefresh132/133 ociosas concluído, mesma sursum-api/med/9911. Rotabaselineantes845bdf... difere canônico, preservada. Old history404Service1b723910... não alterado.

**Metadados AUX publicados:** op1036 pagamentos,1037NFs,1038descontos,1039despesas históricas,1.0.0. Pai ciw.container-versoes-custo/op1005 **1.0.2**,5links(1antigo+4novos). Fonte motor_progress_ciw_cadastros **124→132**,124anteriores/outrosprogramas preservados; authoringgrants revogados. Quatro consultas readonly nativas/JSvalidators/contextos obrigatórios/página GREEN; PASOE23negativas,3getpositivos. Descontosvazio nas versões2354/2357: detalhe positivo sóTT, nãoinventar registrocomercial. Fontes continuamrawpersistido: nomes atuais/comparações nãofechados. **Quatro NOVASreads AUX aguardam autorização humana** solicitada nesta retomada; NÃO conceder como extensão das três wave1, que estão consumidas/aplicadas/UIverificadas.

**1042batch:** APIpublicada, read/get14campos reais/auth401/5negativas(inklotevazio) GREEN,0businesswrites. Metadados/fonte3ops/entidade1042/pai1003AINDA NÃOpublicados. Pai1003 permanece1.0.2. Precisam cenário comercial NOVO concreto+autorização/teste/limpeza e permissões específicas; não reusar cenários antigos. Serviço central reutilizado, imagens14originais emcontextoreadonly, stale409 antesdemutação, só3camposeditáveis, lotehomogêneo1..100; fiscal/versionamento central, logsusuário+antes/depois. Extensão frontend opt-in nativa instalada; exemplos/paridade aindaemfinalização, skill local de paridade nãoencontrada e matriz prevê checklist direto.

Próximo: validarUIAUX depois4reads autorizadas; completar1042cenário/metadados/UI, rebase1043tax-only sobre Actiona01949.../pai1003baselineatual, integrarlookups separados apósbaselines1035/37/39 atuais;1047seleção e1045/46descontosgerais com executores. Gerente ativo, objetivoGLOBAL ACTIVE, ControlesFINAL. Túnel9080 mantido; zeroDDL/escrita comercial nova/grant humano novo nesta wave2. Inventário62Convertido/200nãoencerrados, sem promoção automática por lotes.

'''
detail=r/'context/CIW_COMPLETION_GOAL_2026-10-28.md';text=detail.read_text(encoding='utf-8-sig');assert '## Wave2 publicada'not in text;shutil.copy2(detail,backup/detail.name);detail.write_text(text.replace('## Acesso wave1 concluído',note+'## Acesso wave1 concluído',1),encoding='utf-8')
marker='''<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->
## Objetivo global CIW ATIVO — wave2 publicada e validada

Ler PRIMEIRO **D:/opencode/conversao-sc/context/CIW_COMPLETION_GOAL_2026-10-28.md**, seção Wave2 publicada. GoalGLOBALACTIVE, gerente/executores/ControlesFINAL. Build5-v6 ENCERRADO/OFICIALGREEN:43compiles12.2,40TT/2732checks/NUMDBS0.16fontes+rota integrados;16artefatos+rota publicados137 eMEDrefresh132/133 concluído, mesma sursum-api/med9911. Não repetir planos/48103. Catálogo streaming operacional preservado (campo response).

4AUX1036–39/1.0.0 eop1005/1.0.2(5links) PUBLICADOS/realPASOE/runtime/JSvalidatorsGREEN;fonte124→132preservadas.3getpositivos,descontosvazio2354/2357(detalheTT).4NOVASreads aguardamautorização, não inferirgrant.3reads WAVE1 jáconsumidas/UIldapverificada; NÃOreaplicar.1042APIpublicada/readget14campos/auth/negativasPASS,0businesswrites; FONTE3ops/entidade/tela/pai1003AINDApendentesdescenárionovoautorizado/teste/permissões. Pai1003permanece1.0.2. Lookupshistóricos/comparaçõesemfila, nãofamíliaconcluída.1043rebasepós5;1047seleção/1045–46descontosemexecução. Memória/receipts5-v6;inventário62Converted/200nãoencerrados. Túnel9080/19910→9910MESMAMED;sem9921fallback/segredos/commit/push.
<!-- END CIW_COMPLETION_GOAL_20261028 -->'''
paths=[r/'context/PROJECT_CONTEXT.md',r/'context/RETOMADA_2026-10-16.md',Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'),Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md')];receipts=[]
for i,p in enumerate(paths):
 raw=p.read_bytes();text=raw.decode('utf-8-sig');assert text.count('<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->')==1;shutil.copy2(p,backup/(str(i)+'-'+p.name));p.write_text(re.sub(r'<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->.*?<!-- END CIW_COMPLETION_GOAL_20261028 -->',lambda _:marker,text,count=1,flags=re.S),encoding='utf-8');receipts.append(dict(path=str(p),before=hashlib.sha256(raw).hexdigest(),after=sha(p)))
(s/'memory-wave2-published.json').write_text(json.dumps(dict(success=True,goal='ACTIVE',files=receipts),indent=2)+'\n')
active=load(s/'ROOT_ACTIVE.json');active.update(officialBuild5='OFFICIAL_GREEN43COMPILES_2732TT_CANONICAL16_RUNTIME16_ROUTE1',metadataWave2='PUBLISHED4AUX_PARENT1005v1.0.2_SOURCE132',auxHumanAccess='PENDING4READ_AUTHORIZATION',batch1042='API_READ_GET_NEGATIVES_GREEN_NO_BUSINESS_WRITES_METADATA_PENDING',next='Complete1042freshscenario and aux4access when authorized; integrate lookup/1043/1047/1045-46; broadgoalACTIVE');(s/'ROOT_ACTIVE.json').write_text(json.dumps(active,indent=2)+'\n')
print('PASS updated4memories and current globalACTIVE state; build5 no longer running')
