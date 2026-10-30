"""Record actual compilation/publication and the outstanding parent404 fix."""
from pathlib import Path
import hashlib,json,re,shutil
r=Path(__file__).resolve().parents[2];state=r/'.runtime/ciw-completion-20261028';backup=state/'memory-stage2-backup';backup.mkdir()
detail=r/'context/CIW_COMPLETION_GOAL_2026-10-28.md'
text=detail.read_text(encoding='utf-8-sig')
note='''## Atualização prevalente — integração e publicação ABL wave1

Objetivo global **ACTIVE**. Build1 e build2 cancelados antes de SSH; **build3 oficial executado no .42** e conferido: OpenEdge12.2,26compiles sem erro,32logs/384checks por combinação/1.536total/NUMDBS0, UTF8/ISO8859-1×AMERICAN/EUROPEAN. `official-build3/official-compile-verification.json`. Harness recebeu correções UTF8 apenas nos testes/provedor; fontes de produção não mudaram por elas. Sessão de compilação96442 terminou, não repetir.

Integrados por hash/backup **8fontes ABL/include +2PHP +6JSON** nos canônicos. PHP composto em backend-package5, hashes exatos congelados antes de mesclar fiscal; fiscal56/REAL36/history5tests17assertions e regressão completa885tests5841assertions passaram. Revisão independente semP1/P2 em backend-package5/manager-review.json. As tentativas1–4 de compositor falharam isoladas, sem gravar canônicos; não usar seus arquivos parciais. Originais preservados em official-build3/canonical-backup; `canonical-manifest.json` tem hashes atuais.

**15artefatos fonte/r/include publicados** no compartilhamento137 por111, backup/hashes confirmados, sem fixture/rota/DDL/escrita comercial. `official-build3/active-manifest.json`; MED teve três sessões ociosas126/127/128 recarregadas pela API oficial, mesma instância sursum-api, sem outro PASOE. Publicação e recarga concluídas; não repetir os planos wave1. PHP canônico em uso pelo servidor local.

**Metadados das três novas telas AINDA NÃO PUBLICADOS**. Preflight somente leitura em official-build3/metadata-preflight.json: op1033/34/35 livres; pais REAIS `ciw.container-despesas/op1003` e `ciw.container-versoes-custo/op1005`. Drafts incrementais preservam builderConfig publicado e acrescentam só versão/rowLink. Fonte continua118operações; a proposta acrescenta6→124, sem permissão humana nova. Publicador preparado `publish-ciw-completion-wave1-metadata.cjs` exige gate de correção abaixo, não executar antes de GREEN.

PASOE real: duas consultas fiscais read/get e dez negativos PASS; histórico **READ, GET, página e aliases PASS**. ÚNICA falha isolada é negativo com container_id=1 inexistente: history retorna503VERSION_HISTORY_CONFIGURATION em vez de404. `pasoe-attempts-private.json` registra etapas/sem headers. NÃO dizer que consulta normal falhou. Causa: FIND-FIRST dinâmico de parent sem NO-ERROR levanta565 antes do ramo404; fiscal trata565 corretamente. Gerente/executor produzindo freezev1.4 mínimo Service+regressões, ABI preservado. Diagnóstico privado `.42` em history-diagnostic1 confirmou o mesmo read físico em UTF8 e ISO; nenhuma instrumentação foi publicada. Corrigir, compilar12.2, publicar somente delta pertinente e validar antes de publicar metadados.

Schema auxiliar oficial12.2 somente dicionário GREEN: aux-schema/*,4tabelas históricas presentes. PKs pgtos versao/título; NFs versao/documento/serie/estab/nat_operacao/cod_emitente; descontos versao/desconto; despesas versao/despesa (GROUPSUM singleton). Probe literal SQL pelo perfil legado ems206espPRO NÃO CONECTOU; sql-literal-arithmetic.json connected=false/unclassified/checks vazio. Não inventar resultado de divisão por zero/NULL para comparações1040/41.

Extraídos e sanitizados os11helpers em sources/scriptcase/ciw-completion-helpers-20261028,22arquivos/180literaisomitidos, manifesto correspondente em integration-src/ciw-inventory. Gerente analisa paridade/fila. Op1042 em preparação: optar por suporte nativo explícito opt-in de original/contexto readonly no batch; não fabricar snapshotJSON editável. Próximos freezes devem rebasear os novos hashes canônicos; op1036–41 permanecem candidatos, não publicados. ControlesFINAL. Túnel9080 vigente; os demais processos citados de coleta/probe/publicação já terminaram.

Próximo: receber/revisar freezev1.4, executar compilação oficial delta, publicar2artefatos se apenasService mudar, refreshMEDidle, concluir PASOE negativo404; depois publicar3telas+2links e validar runtime/UI; seguir fila ampla com gerente/executores. Goal não encerrado por lote.

'''
assert 'Atualização prevalente — integração e publicação ABL wave1' not in text
shutil.copy2(detail,backup/'CIW_COMPLETION_GOAL_2026-10-28.md');detail.write_text(text.replace('## Publicado nesta retomada',note+'## Publicado nesta retomada',1),encoding='utf-8')
paths=[r/'context/PROJECT_CONTEXT.md',r/'context/RETOMADA_2026-10-16.md',Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'),Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md')]
marker='''<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->
## Objetivo global CIW ATIVO — atualização wave1 em28/10

Ler primeiro **D:/opencode/conversao-sc/context/CIW_COMPLETION_GOAL_2026-10-28.md**, seção atualização prevalente. Todas as conversões faltantes continuam no escopo, com gerente/executores e goal; não encerrar ao terminar um lote. Cinco filtros cd0094–98 publicados1.0.1/UI; broadinventory262/17famílias em auditoria, ControlesFINAL.

**Build3OFICIAL12.2 concluído**:26compiles/1536checks; PHPcombined885tests5841assertions e revisão semP1/P2. Integração canônica8ABL/include+2PHP+6JSON concluída, backups/hashes official-build3/canonical-manifest.json;15artefatos publicados137/111,3sessões MEDociosas recarregadas. NÃO repetir publicação/compilebuild3. Três novas telas op1033–35 aindaSEMmetadata publicado, fonte continua118. PASOE fiscal2read/get+negativosPASS; históricoREAD/GET/páginaPASS. Único erro: parent inexistente retorna503 em vez404, causaFIND-FIRST565; gerente preparafreezev1.4Service+regressão. Corrigir/compilar/publicardelta/validar antes de publicar3telas+2links. Paiversõesreal ciw.container-versoes-custo/op1005, despesasop1003. Nenhumaescritacomercial/DDL/granthumano nesta wave1.

Schemaauxiliar4tabelas oficialGREEN; SQLliterallegadonãoconectou, semresultadosdiv0/NULL.11helpersScriptcase extraídos/sanitizados parafila. Próximos1036–42candidatos, rebasearnovoshashes. Túnelvigente9080/19910→9910MESMAsursum-api/med, nunca9921fallback. Sinalizadores4permissões humanasanteriores jáconsumidas, não reaplicar. Semcommit/push/segredos.
<!-- END CIW_COMPLETION_GOAL_20261028 -->'''
receipts=[]
for i,p in enumerate(paths):
 raw=p.read_bytes();before=hashlib.sha256(raw).hexdigest();s=raw.decode('utf-8-sig');assert s.count('<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->')==1
 shutil.copy2(p,backup/(str(i)+'-'+p.name));s=re.sub(r'<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->.*?<!-- END CIW_COMPLETION_GOAL_20261028 -->',lambda _:marker,s,count=1,flags=re.S);p.write_text(s,encoding='utf-8')
 receipts.append(dict(path=str(p),before=before,after=hashlib.sha256(p.read_bytes()).hexdigest()))
(state/'memory-stage2.json').write_text(json.dumps(dict(success=True,goal='ACTIVE',files=receipts),indent=2)+'\n')
active=json.loads((state/'ROOT_ACTIVE.json').read_text());active.update(next='Minimal parent404 fix official12.2 delta then metadata3+parentlinks/UI; broader queue remains',officialBuild3='COMPILED_INTEGRATED_PUBLISHED15_ABL',metadataWave1='NOT_PUBLISHED',pasoeRemaining='Only missing parent503 instead404; normal read/get/paging passed');(state/'ROOT_ACTIVE.json').write_text(json.dumps(active,indent=2)+'\n')
print('PASS memory updated4contexts+goal detail; goalACTIVE; publication vs pending distinguished')
