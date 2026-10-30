"""Record verified deployment and metadata without consuming pending authorizations."""
from pathlib import Path
import hashlib,json,re,shutil

root=Path(__file__).resolve().parents[2]
state=root/'.runtime/ciw-completion-20261028'
build=state/'official-build6-v2'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert load(build/'active-manifest.json')['success']
deployment=load(build/'publication-attempt.json')
assert deployment['success'] and deployment['medWebRestored'] and deployment['imaWebUnchanged']
assert load(build/'pasoe-read-proof.json')['success']
assert load(build/'lookup-metadata-publication.json')['success']
assert load(build/'lookup-runtime-proof.json')['success']
assert load(state/'container-expense-batch-preflight/replay-after6-v1/official-verification.json')['totalChecks']==600
backup=state/'memory-build6-published-backup'
backup.mkdir()
note='''## Build6 publicado e validado — históricos atualizados

Estado prevalente: **publicação concluída**, corrigindo a seção histórica abaixo que dizia execução em andamento. OpenEdge 12.2 no .42: 55 compilações, 56 execuções TT, 3.616 verificações nas quatro combinações de encoding/formato numérico; TT sem conexão com banco. Os 15 arquivos canônicos foram integrados por hash e backup. Publicados 21 artefatos em sursum-api/MED: transporte WEB MED pausado, sessões ociosas recarregadas e transporte restaurado em 10,193 segundos. Estado WEB IMA preservado; arquivos compartilhados podem ser lidos por outras instâncias. Não repetir publicação. Recibos: official-build6-v2/{active-manifest,publication-attempt,official-compile-verification,canonical-manifest}.json.

PASOE real: cinco históricos consultados, quatro detalhes positivos, contextos inválidos rejeitados; três identificações atuais e seus filtros positivos/negativos validados. Os campos históricos persistidos permanecem exatamente iguais aos recibos anteriores; nenhuma rotina de recálculo executada. Metadados op1035, op1037 e op1039 publicados em **1.0.1**, somente acrescentando campo, coluna e filtro readonly: descrição atual do item, nome abreviado atual do emitente e descrição atual da despesa. Validação no runtime nativo das três telas passou com lista, detalhe, filtros e contexto obrigatório. Fonte cadastros permanece com 132 operações. Outros programas e permissões preservados. Recibos lookup-metadata-publication.json e lookup-runtime-proof.json. As outras telas AUX permanecem 1.0.0; pai op1005 mantém 1.0.2/cinco links, pai op1003 mantém 1.0.2.

As três consultas autorizadas em call_5111d629eb42427c81f8fccf247bd988 já foram concedidas, verificadas e consumidas no wave1-access; não reaplicar. **Quatro NOVAS consultas AUX aguardam resposta humana**; wave2-aux-access/authorization.json permanece false. Não confundir com as três anteriores.

**1042 lote de despesas:** código compilado e API publicada, consultas e rejeições validadas; metadados, três acessos read/edit/delete e cenário operacional ainda pendentes. O pedido assíncrono já foi apresentado ao usuário, sem resposta até esta gravação. Cenário exclusivo CIW-1042-VALIDACAO-20261028-2147000110: container novo 2147000110, despesas manuais novas 4/5, no máximo 22 despesas e quatro memórias novas, com limpeza canônica e logs preservados. Proposta privada v1.1 SHA a74be1b238e7ce0911512f7ac3127dd7405543962c77f2f846d8117d7aca86d3. Não executar antes de autorização específica; ela não inclui teste positivo 1043/1047. Replay central oficial pós6 passou 600 verificações TT/NUMDBS0; coletor BC real somente leitura passou. O trigger e seus oito artefatos/dois aliases MED estão disponíveis e preservados. Não desabilitar nem contornar triggers.

**1043 cálculo de impostos separado:** executável integrado/compilado/publicado; somente rejeição por contexto ausente foi testada no PASOE. Fonte de processos 5→6, nova tela e link do pai ainda NÃO publicados. Teste positivo e novos acessos também não autorizados. Não apresentar como conversão operacional encerrada.

Próximo lote readonly em preparação: descontos 1045/1046, aptos globais 1049 e extrato de distribuição do item 1050. **1047 seleção de despesas retido por P2 encontrado antes de integração**: optionsSource.parameterFields precisa ser restrito ao processo, preservando a geração intermediária existente; gerente coordena correção e RED→GREEN. Fonte manual de custos 1051 tem bugs legados de escalar versus array e saldo indefinido; não presumir regra MAX para exclusão nem corrigir cálculo silenciosamente. Comparações 1040/1041 e extrato 1048 ainda dependem de evidência SQL NULL/UNION/divisão; probes anteriores não conectaram e não provam semântica.

Frontend nativo e rotinas centrais reutilizados; nenhum frontend paralelo, edição de biblioteca Kendo, DDL ou escrita comercial neste lote. Exemplo batch e schema fechados integrados; teste adicional file:// bloqueado pela política do browser, sem contorno. Novos fontes Scriptcase 20b sanitizados disponíveis: 20 aplicações/79 arquivos/319 literais omitidos. Inventário 262 origens: 62 convertidas, 200 não encerradas, 62 sem fonte local; não tratar todos como novos cadastros. **Controles permanece pendência FINAL. Objetivo global ACTIVE.** Túnel sessão9080/19910→9910 da mesma sursum-api/MED9911, sem fallback9921. Não gravar segredos, commit ou push.

'''
detail=root/'context/CIW_COMPLETION_GOAL_2026-10-28.md'
text=detail.read_text(encoding='utf-8-sig')
assert '## Build6 publicado e validado' not in text
shutil.copy2(detail,backup/detail.name)
text=text.replace('## Build6 oficial integrado',note+'## Build6 oficial integrado',1)
detail.write_text(text,encoding='utf-8')
marker='''<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->
## Objetivo global CIW ATIVO — build6 publicado e históricos validados

Ler PRIMEIRO **D:/opencode/conversao-sc/context/CIW_COMPLETION_GOAL_2026-10-28.md**, seção **Build6 publicado e validado**. Official6-v2: 55 compilações/56TT/3.616 verificações/NUMDBS0,15 canônicos integrados,21 artefatos publicados. WEB MED restaurado após10,193s; estado IMA preservado. PASOE cinco históricos/contextos/identificações atuais passou. op1035/37/39 em1.0.1: campo+coluna+filtro readonly; runtime nativo três telas lista/detalhe/filtros/contexto passou. Fonte132/pais1005e1003v1.0.2 preservados. Não repetir publicações concluídas.

Três reads WAVE1 autorizadas já consumidas e UI verificadas. **Quatro novas reads AUX aguardam resposta**, sem concessão. **1042:** API publicada/RO validada; metadados, três permissões e cenário novo2147000110 aguardam autorização já solicitada. Replay oficial pós6:600TT sem banco; coletor BC real RO e disponibilidade dos triggers MED confirmados. Não executar negócio nem desabilitar trigger. **1043:** executável publicado, metadados e teste positivo pendentes; não presumir autorização do1042.

Gerente prepara1045/46+1049+1050 readonly.1047 retido por P2 do Builder antes de integração;1051 regras legadas ambíguas em análise. Fonte132 sanitizada já exportada. Inventário262/62convertidas/200não encerradas/62sem fonte local; ControlesFINAL. Memória detalha provas, candidatos e gates. Túnel9080/19910→9910 mesma sursum-api/MED9911. Sem segredos/commit/push. Objetivo GLOBAL ACTIVE, não encerrar por lote.
<!-- END CIW_COMPLETION_GOAL_20261028 -->'''
paths=[root/'context/PROJECT_CONTEXT.md',root/'context/RETOMADA_2026-10-16.md',Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'),Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md')]
receipts=[]
for i,p in enumerate(paths):
 raw=p.read_bytes();text=raw.decode('utf-8-sig')
 assert text.count('<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->')==1
 shutil.copy2(p,backup/(str(i)+'-'+p.name))
 p.write_text(re.sub(r'<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->.*?<!-- END CIW_COMPLETION_GOAL_20261028 -->',lambda _:marker,text,count=1,flags=re.S),encoding='utf-8')
 receipts.append(dict(path=str(p),before=hashlib.sha256(raw).hexdigest(),after=sha(p)))
active=load(state/'ROOT_ACTIVE.json')
active.update(officialBuild6='OFFICIAL_GREEN55_3616_CANONICAL15_RUNTIME21_VERIFIED',metadataHistoryLabels='PUBLISHED_OP1035_1037_1039_V1.0.1_NATIVE_RO_VERIFIED',next='Publish1043 reviewed metadata without executing; prepare readonly7; await1042/AUX exact authorizations; globalgoalACTIVE',batchScenario='PENDING_HUMAN_RESPONSE_2147000110_ONLY')
(state/'ROOT_ACTIVE.json').write_text(json.dumps(active,indent=2)+'\n')
(state/'memory-build6-published.json').write_text(json.dumps(dict(success=True,goal='ACTIVE',files=receipts,businessWrites=False,pendingAuthorizationsPreserved=True),indent=2)+'\n')
print('PASS4memory markers/detail updated;6runtime21/3metadata labels verified;1042/AUX gates preserved;goalACTIVE')
