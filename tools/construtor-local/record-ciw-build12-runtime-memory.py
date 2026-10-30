"""Record completed pagination publication and the still pending operational scenario."""
from pathlib import Path
import hashlib
import json
import re
import shutil

root=Path(__file__).resolve().parents[2]
state=root/'.runtime/ciw-completion-20261028'
build=state/'official-build12-v3'
runtime=state/'runtime-build12'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
official=load(build/'official-compile-verification.json')
active=load(runtime/'active-manifest.json')
pasoe=load(runtime/'pasoe-paged-five-container-proof.json')
assert official['success'] and official['compileCount']==42 and official['totalChecks']==5704
assert active['success'] and active['medWebRestored'] and active['imaWebUnchanged'] and len(active['targets'])==4
assert pasoe['success'] and pasoe['checks']==43 and pasoe['metadataReady'] and len(pasoe['containers'])==5
assert all(x['positiveGet'] for x in pasoe['containers']) and any(x['total']>200 for x in pasoe['containers'])
for x in load(build/'canonical-manifest.json')['files']:
    assert sha(Path(x['target']))==x['sha256']
for name in ['active-manifest.json','publication-attempt.json','pasoe-paged-five-container-proof.json']:
    assert not (build/name).exists()
    shutil.copy2(runtime/name,build/name)
    assert sha(build/name)==sha(runtime/name)
backup=state/'memory-build12-runtime-backup'
backup.mkdir()
note='''## Checkpoint13 — paginação de notas fiscais publicada e validada no PASOE

O lote12-v3 está concluído na camada de código: sessão49932 finalizada com exit0 e118 downloads;42 compilações OpenEdge12.2/.42,28 logs TT/5.704 verificações com NUMDBS0 e16 comparações JSON aprovadas. FULLPHP990 testes/7.119 asserções,277 classes App100%staged e23 checks nativos locais. Cinco arquivos canônicos integrados por hashes e backups; release409a6bb3..., manager3e922a9f.... NÃO repetir compilação ou integração. As tentativas12 e12-v2 falharam apenas na preparação da compilação (closureOO ausente; depois namespace12629), foram encerradas e recuperadas em modo download-only. Nenhum produto foi modificado para contornar essas falhas;12-v3 usa classes canônicas reais, nomes simples resolvidos por SEARCH e SAVE INTO explícito. Não publicar os rcode de testes/classes auxiliares.

Publicação41130 concluída: somente CiwErpReadService.p/r e ContainersPainelFinanceReadService.p/r no share137 e sursum-api/MED9911. Transporte MED restaurado em12,542s; sessões149/150 recarregadas mantendo pid3856625; estado IMA preservado. Sessão97036 validou43 chamadas reais somente read/get nos containers332526/331126/200019/333426/1525: total completo, primeira/segunda/última página, página após o fim vazia, detalhe positivo, filtro de identidade e ordenação, aliases inválidos e token ausente recusados. Total acima do antigo teto200 foi comprovado em dados reais. Contrato mantém até200 por página, orçamento10s e50mil leituras de origem; usa o coletor e leitor comuns, sem duplicar mapeamento ou chave. Metadados1053 AINDA NÃO publicados nesta etapa: gerente prepara companion com a prova12, preservando os hashes e previews históricos. Não afirmar tela disponível apenas porque a API passou.

Baselines canônicos atuais para o próximo lote: FinanceService ca3a9a4a..., Reader bb4d2362..., RuntimeCiwErpQuery a444ca24..., RuntimeContainerNfAvailableRead19602f88..., RuntimeApiEntityActionService c19eb95e.... Preservar o recurso1055 e todos os demais. Provas em `.runtime/ciw-completion-20261028/official-build12-v3` e `runtime-build12`; cópias de active-manifest/publication-attempt/PASOEproof são byte exatas, não reconstruídas. Não executar novamente verify.py --official após a integração, pois seus baselines são anteriores; usar a prova oficial já salva.

Entregas anteriores mantidas:1055/`ciw.despesas-impostos-geral`1.0.0 publicado e validado no runtime nativo, fonte cadastros146; nenhuma permissão funcional1055 nova foi concedida.1042/`ciw.container-despesas-lote`1.0.0 e pai1003/`ciw.container-despesas`1.0.5 publicados, read/get/contexto/14campos validados. As três permissões1042 e oito consultas AUX/descontos/distribuição autorizadas foram aplicadas/verificadas e seus gates consumidos. NÃO repetir concessões/publicadores.

Cenário1042 continua AUTORIZADO e NÃO EXECUTADO: somente container novo2147000110, marcador CIW-1042-VALIDACAO-20261028-2147000110, definições4/5, até22 despesas e4 memórias novas, edição/exclusão em lote, conflito desatualizado e limpeza canônica, preservando logs/triggers. Sem itens/títulos/pagamentos/notas/estoque/custos/versões ou alterações de registros existentes. Harness fixo de9 passos está em revisão final, ainda sem manager-exercise-release. Propriedade vem somente de auditorias completas confirmadas; GET/IDs/contagens sozinhos não autorizam adotar ou apagar registros. Antes de cada write, conferir header, despesas e conjunto completo de IDs/imagens das memórias contra o manifesto próprio. Resultado incerto: preservar resposta/journal, sem retry.

Inspector privado1042-v4 oficialmente compilado em12.2, sessão51573/NUMDBS0, fonte67c4bbf1... e rcode e8903fb8.... Acrescenta6campos tipados de cada memória ao inspector12tabelas/CID fixo/zeroitens/junção indireta vazia; nunca conta globalmente o ledger nem inventa campo físico container_id em cta_corren_fornec_imp. Nove planos RO frescos por passo preparados em `batch1042-exercise/inspections`, ainda NÃO executados. Cada um gera receipts UTC reais com hashes de artefato e resultado, mais captura atual da configuração via rcode oficial existente. UI de produção foi aberta legitimamente em IAB tab36 para o CID de teste; mostra indisponibilidade esperada porque o pai não existe. Nenhum cancelamento real foi alegado ainda. CDP de diagnóstico está documentado para observar requisições no teste futuro, sem injetar scripts; não repetir nem contornar o bloqueio anterior de arquivo file://.

Próximas frentes: metadados1053, cenário1042 e sua limpeza; comparar1040/41 após compor com Reader12 e resolver fidelidade de órfãos;1056 aguarda contexto signedint32; Builder decimal-v2 candidato205e continua revisado, NÃO integrado, canônico72c6 preservado enquanto houver pins1042.1054 cotação diária retida pelos efeitos físicos/triggers, sem hooklogin. Anexos de containers:146 referências sem arquivo no acervo verificado; aguardam caminho/backup. Lista completa em `integration-src/ciw-completion-20261028/remaining-applications/PENDENCIAS_ATUAIS.md`:262 origens/62 registradas Convertido/200 não encerradas não significa200 telas sem implementação. Controles permanece FINAL. Objetivo global ATIVO; nenhum commit/push ou credencial em fontes/memória.

'''
marker='<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->\n\n'+note+'<!-- END CIW_COMPLETION_GOAL_20261028 -->'
paths=[root/'context/PROJECT_CONTEXT.md',root/'context/RETOMADA_2026-10-16.md',Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'),Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md')]
receipts=[]
for i,p in enumerate(paths):
    before=p.read_bytes();text=before.decode('utf-8-sig')
    assert text.count('<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->')==1
    shutil.copy2(p,backup/(str(i)+'-'+p.name))
    p.write_text(re.sub(r'<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->.*?<!-- END CIW_COMPLETION_GOAL_20261028 -->',lambda _:marker,text,count=1,flags=re.S),encoding='utf-8')
    receipts.append(dict(path=str(p),before=hashlib.sha256(before).hexdigest(),after=sha(p)))
p=root/'context/CIW_COMPLETION_GOAL_2026-10-28.md';text=p.read_text(encoding='utf-8-sig')
assert '## Checkpoint13 — paginação' not in text
shutil.copy2(p,backup/p.name);first,rest=text.split('\n',1);p.write_text(first+'\n\n'+note+rest,encoding='utf-8')
work=load(state/'ROOT_ACTIVE.json')
work.update(officialBuild12='V3OFFICIAL49932_42_5704_CANONICAL5_RUNTIME4_41130_MEDRESTORED12.542S_PASOE43_5CID_GREEN',metadata9='HELD_WAIT_MANAGER_COMPANION_BINDING_BUILD12_PAGED_PROOF',batchFixtureInspector='V4OFFICIAL122_51573_NUMDBS0_RCODEE890_FRESH9PLANS_PREPARED_NOT_EXECUTED',batchScenario='AUTHORIZED_EXACT2147000110_HARNESS_FINAL_REVIEW_NO_BUSINESS_EXECUTED',next='METADATA1053_COMPANION;1042_FINAL_REVIEW_FRESH_GUARDS_SCENARIO;GLOBALACTIVE')
(state/'ROOT_ACTIVE.json').write_text(json.dumps(work,indent=2)+'\n')
(state/'memory-build12-runtime.json').write_text(json.dumps(dict(success=True,goal='ACTIVE',files=receipts),indent=2)+'\n')
print('PASS checkpoint13: official12/runtime/PASOE43 confirmed; metadata1053 and scenario1042 pending')
