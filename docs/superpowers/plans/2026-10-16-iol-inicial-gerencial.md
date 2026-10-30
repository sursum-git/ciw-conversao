# Página inicial gerencial IOL — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Publicar `iol.inicial-gerencial` no construtor existente, com indicadores reais equivalentes ao Scriptcase e acesso pelo mesmo login IMA.

**Architecture:** Wrapper Progress de leitura resolve identidade e delega coleta/cálculo a serviços reutilizáveis. AnalyticsEngine recebe dataset API registrado em execução live e cartões declarativos, preservando o frontend/Kendo existentes. Metadados são publicados exclusivamente pelo Builder/governança.

**Tech Stack:** ABL OpenEdge12.2, PASOE sursum-api/med, PHP8.4/Symfony, JavaScript/jQuery/Kendo locais, JSON, PHPUnit e Playwright existentes.

**Spec:** [desenho aprovado](../specs/2026-10-16-iol-inicial-gerencial-design.md), aprovado pelo usuário com “ok.” após revisão solicitada.

## Global Constraints

- Reutilizar frontend do construtor-pg por JSON; não criar frontend paralelo nem editar Kendo/vendor.
- Identidade da sessão autenticada, mesmo login IMA; ausência de vínculo ativo não concede visão geral.
- API exclusivamente de leitura/NO-LOCK; não criar dados de negócio, consumir sequências ou alterar schema.
- Parâmetros via `sursum-api/includes/parametros_ima.i`, leitura direta sem cache.
- Cálculos e coleta reutilizáveis; não repetir regras em wrapper, PHP ou frontend.
- Compilar OpenEdge12.2 no `.42`; publicar no compartilhamento137 via `.111`; validar sursum-api/med. Nunca publicar `.r`12.8 nem alternar instância.
- Segredos somente em memória/entrada oculta ou configuração privada ignorada; não copiar para fontes, argumentos, relatórios ou contexto.
- Preservar diffs anteriores e rotas existentes; não fazer commit/push/reseed/reassinatura.
- Atualizar memória distinguindo fonte preparado, compilado, publicado e validado.

## Review Focus

1. Login arbitrário, usuário inativo ou hierarquia incompleta: acesso negado, sem dados globais (tarefas1/2/4).
2. API pede cache/materialização ou há resultado de outro usuário armazenado: nunca consultar/gravar/exibir cache para dataset API (tarefa4).
3. Desconto de100%, calendário sem dias úteis ou número desconhecido: erro definido ou ausência explícita; nenhuma divisão inválida/zero inventado (tarefas1/3).
4. Requisição atrasada após refresh/falha/destroy/troca de sessão: limpar dados restritos e ignorar resposta obsoleta (tarefa6).
5. Nome com HTML ou atalho manipulado: conteúdo textual e destino fechado validado; não abrir URL fornecida por registro ou payload (tarefas5/6).

## Organização e execução

Raízes: **C**=`D:/opencode/conversao-sc`; **B**=`D:/opencode/construtor-pg`; **M**=`D:/opencode/motor-progress/v2`. Paths abaixo são relativos à raiz indicada. Reusar os checkouts que contêm integrações atuais; ler AGENTS/contextos e inspecionar diff antes de escrever. Se isolamento for necessário, ler using-git-worktrees e garantir que as dependências atuais estejam presentes; não partir de baseline que perca mudanças locais anteriores.

Dependências: 1→2→3; 4 depende dos contratos1 e independe da publicação ABL; 5 depende4; 6 depende5; 7 integra2–6; 8 publica/verifica7. Este plano não inicia delegação; método de execução será escolhido pelo usuário na revisão. Cada tarefa tem ciclo RED→GREEN e revisão de seu escopo; sem commits.

### Tarefa 1: Fechar contrato e referências de cálculo contra fontes físicos

**Files:** C:`integration-src/iol-pagina-inicial-gerencial/{contract.json,legacy-reference.json,schema/}`; C:`tools/construtor-local/inspect-iol-schema.py`; fontes existentes em C:`sources/scriptcase/iol/bl_pag_ini_ger/`.

**Interfaces:** `contract.json` define DTOs `input_snapshot`, `resumo`, `vendedores` e erros; `legacy-reference.json` registra função/linha, fonte de cada campo, joins/cardinalidade, arredondamento e casos numéricos. `schema/` contém somente dicionários físicos, sem dados de usuários. Esses artefatos são entradas das tarefas2/3/7.

- [ ] Conferir SHA-256 dos16fontes contra `source-manifest.json` e registrar baseline dos arquivos canônicos que serão tocados. Registrar acessos remoto/local disponíveis sem imprimir configurações privadas.
- [ ] Extrair a cadeia ativa: onExecute→getDadosFatsRepres/metas/getTotVendNfMes/getTotDevNfMes/getQtPeds*/diasUteisMes; registrar tipo/grupo, inicialização das listas gerenciais e regra que distingue visão geral permitida de configuração ausente. A lista global de vendedores só será usada para perfil gerencial autorizado; ausência de perfil nunca é lista geral.
- [ ] Consultar dicionário somente leitura das tabelas usadas nos fontes: user-web, usuarios_grupos, repres, cm-hierarquia, cm-ext-repres, fats_repres/transacoes, metas_repres/metas_gerencial/metas_geral, peds_web, ped-venda/ped-repre, nota-fiscal/natur-oper, devol-cli/docum-est e dia_calend_glob. Confirmar aliases espec/ems2cad/ems2med/ems5 e tipos/índices pelos ambientes existentes; não inferir chaves de NF sem estabelecimento/série.
- [ ] Escrever casos de referência com entradas e saídas exatas: faturamento1000/devolução150/meta1000→líquido850/85%; meta gerente2000→meta loja1000; total de vendas ajustado500→loja50%; vendedor(500+50−100−10)/1000→44%; calendário22dias/12passados→10restantes/ideal55%.
- [ ] Registrar sem alterar o legado: getDadosFatsRepres remove sinal negativo após soma; preservar valor absoluto por componente antes da subtração. Registrar desconto das devoluções arredondado a2casas após soma por grupo; vendas/devoluções por representante podem repetir valores por cardinalidade dos joins e não devem ser deduplicadas silenciosamente.
- [ ] Validar JSONs e referências aos arquivos/linhas; qualquer diferença entre regra e fonte deve ser resolvida no contrato antes do teste/código. Sem schemas disponíveis, avançar tarefas4–6 por contratos, mantendo coleta real como dependência aberta.

### Tarefa 2: Identidade, escopo e coleta Progress somente leitura

**Files:** C:`integration-src/iol-pagina-inicial-gerencial/{IolGerencialIdentityService.p,IolGerencialCollector.p,IolGerencialIdentityTest.p,IolGerencialCollectorTest.p,IolGerencialFixture.p}`; sincronização canônica somente após validação para M:`sursum-api/programs/` e M:`tests/abl/iol/`.

**Interfaces:** `IolGerencialIdentityService.p(INPUT pcLogin AS CHARACTER, INPUT phSources AS HANDLE EXTENT 20, OUTPUT poScope AS JsonObject)`; `phSources` é array privado construído pelo wrapper/fixture, nunca desserializado do browser. Ordem fixa: user-web, usuarios_grupos, repres, cm-hierarquia, cm-ext-repres, fats_repres, transacoes, metas_repres, metas_gerencial, metas_geral, peds_web, ped-venda, ped-repre, nota-fiscal, natur-oper, devol-cli, docum-est, dia_calend_glob, restrs_clientes_usuario, repres_restr_cliente_usuario. `IolGerencialCollector.p(INPUT poScope AS JsonObject, INPUT pdReference AS DATE, INPUT phSources AS HANDLE EXTENT 20, OUTPUT poSnapshot AS JsonObject)` produz `input_snapshot` da tarefa1. Serviços falham com AppError e código fechado, não devolvem sucesso parcial.

- [ ] Criar fixtures com temp-tables compatíveis com dicionários e casos `unknownLoginDenied`, `inactiveUserDenied`, `sellerOwnScope`, `managerHierarchyScope`, `missingHierarchyDoesNotBecomeGeneral`, `globalSellerListRequiresManager`. RED esperado: serviços ainda ausentes.
- [ ] Implementar resolução do user-web ativo, perfil, grupo2, representante e dependentes. Somente regra de perfil confiável registrada na tarefa1 concede visão geral. Manter login e campos privados fora da resposta pública.
- [ ] Criar testes do coletor: transação confirmada/competência/estabelecimento5/505; exclusões entre empresas e canceladas; join ped-repre múltiplo; devolução ligada à NF/pedido/docum-est; pedidos situação8; PE completo/PI e exclusão fulano; calendário ems5/calend_global.
- [ ] Implementar coleta com buffers privados fixos NO-LOCK, parâmetros pela include central sem cache e datas do servidor. Validar inexistência de duplicação de fórmulas; snapshot contém totais/componentes/calendário, não percentuais calculados no coletor.
- [ ] Executar fixture test runner12.2 da tarefa3 até GREEN em AMERICAN/EUROPEAN, verificando que entradas fonte e registros fora do escopo permanecem inalterados. Nenhum teste escreve no banco real.

### Tarefa 3: Calculador e fronteira HTTP Progress

**Files:** C:`integration-src/iol-pagina-inicial-gerencial/{IolGerencialCalculator.p,IolGerencialCalculatorTest.p,IolInicialGerencial.p,IolInicialGerencialBoundaryTest.p,CompileIolGerencialTests.p}`; C:`tools/construtor-local/compile-iol-gerencial.ps1`.

**Interfaces:** `IolGerencialCalculator.p(INPUT poSnapshot AS JsonObject, OUTPUT poResult AS JsonObject)` produz `{resumo:[linha],vendedores:[linhas]}`. Wrapper `IolInicialGerencial.p(INPUT poRequest AS JsonObject, OUTPUT poResponse AS JsonObject)` implementa `operation=read`, `resource=resumo|vendedores`, envelope Sursum e token `X-Iol-Gerencial-Token` validado por SHA256 em `sursum-conf/iol-gerencial-api.json` privado. Identidade pelo contexto confiável do roteador, não pelo corpo.

- [ ] Escrever testes RED dos casos numéricos da tarefa1; adicionar meta zero/negativa, desconhecido, descontos100%, calendário vazio/inconsistente, primeiro/último dia do mês, empate de vendedores e devolução superior à venda.
- [ ] Implementar cálculo puro, arredondamento equivalente ao PHP e ordenação estável por percentual decrescente/representante como desempate. Meta zero mantém percentual0 conforme legado; calendário com total0 gera `IOL_CALENDAR_INVALID`; snapshot desconhecido necessário gera `IOL_DATA_INVALID`; desconto100% no coletor gera `IOL_DISCOUNT_INVALID` antes da divisão.
- [ ] Escrever testes RED da fronteira: token ausente/incorreto, operação create/update/delete/process, recurso desconhecido, login/lista/banco/perfil extras, ausência de identidade confiável, sucesso com números/string/date tipados e somente campos públicos.
- [ ] Implementar wrapper com configuração própria, buffers fixos do contrato1, chamadas Identity→Collector→Calculator e cleanup FINALLY. Reusar o contexto/log de execução existente; não alterar roteador/auth global. Status401/403/422/500 coerentes; falha não inclui snapshot ou erro bruto de banco.
- [ ] Criar compilador restrito usando `containers-remote-task.py` e padrão de `compile-containers.ps1`, staging exclusivo `codex-iol-gerencial-20261016`, remoção apenas de logs/.r desse staging e verificação de versão12.2/COMPILER:ERROR/PASS por cultura.
- [ ] Rodar `./tools/construtor-local/compile-iol-gerencial.ps1` na raiz C, com entrada protegida quando necessária. GREEN exige testes das tarefas2/3 e .r novos com hashes; exit code isolado não basta. Guardar evidência em C:`.runtime/iol-gerencial-compiled-20261016/`.

### Tarefa 4: Dataset API live no runtime analytics

**Files:** B:`backend/src/Runtime/{RuntimeAnalyticsApiDatasetService.php,RuntimeAnalyticsService.php}`; B:`backend/tests/Runtime/{RuntimeAnalyticsApiDatasetServiceTest.php,RuntimeAnalyticsServiceTest.php,RuntimeExternalJsonClientTest.php}`. B:`backend/src/Runtime/RuntimeExternalJsonClient.php` só se testes demonstrarem falta de proteção; B:`backend/config/services.yaml` apenas se autowiring exigir.

**Interfaces:** `RuntimeAnalyticsApiDatasetService::run(string $screenId,array $dataset,array $payload,?string $tenantId):array`; fonte fechada `{type:"api",entityCode:"..."}`. Resolver entidade API e sua operação read cadastrada, chamar `RuntimeApiEntityActionService::handle($screenId,'read',['entityCode'=>...,'operation'=>'read'],$safePayload)`, validar campos declarados e produzir `{data,total,columns,datasetId,generatedAt,_runtime}` existente. Nenhuma agregação monetária nova no PHP; dados já calculados no Progress.

- [ ] Testes RED: entidade persistente indevida, fonte sem operação list/read, payload que substitui entidade/operação/login/headers/URL, campo extra da API, tipo inválido, get de banco pelo browser e permissão insuficiente. Asserção: falhar antes do HTTP.
- [ ] Implementar adaptador com entidade/colunas resolvidas no cadastro e autorização de leitura pelo PermissionResolver. Aceitar apenas skip/take/sort/filtros de apresentação declarados; passar somente recorte seguro ao serviço read. Recusar joins, measures/aggregate e pipeline/materialização para fonteAPI nesta versão.
- [ ] Testar identidade do transporte: sessãoA e sessãoB produzem respectivos `X-Sursum-User`/`X-Session-Id`; cabeçalhos configurados falsos são removidos. LocalPasswordAuthProvider usa username como getUserId (confirmado no código); não alterar IDs ou simular loginIMA no payload.
- [ ] Integrar desvio source.type=api no RuntimeAnalyticsService **antes** de findCache; forçar execução live no servidor independentemente de executionMode/forceLive do cliente. materialize rejeita antes de consultar/persistir; cacheStatus retorna bypassed sem ler cache. Teste sem registros em runtime_analytics_cache paraAPI após run/materialize recusado.
- [ ] GREEN: na raiz B/backend, `C:/php-8.4.3/php.exe vendor/bin/phpunit tests/Runtime/RuntimeAnalyticsApiDatasetServiceTest.php`, depois classes RuntimeAnalyticsServiceTest/RuntimeExternalJsonClientTest e lintPHP/container. Preservar comportamento entity/persistence/pipeline e assinatura dos construtores existentes com injeção compatível aos testes.

### Tarefa 5: Contrato declarativo e publicação Builder

**Files:** B:`public/metadata/schemas/analytics-definition-v1.schema.json`; B:`backend/src/Builder/ProgramBuilderService.php`; B:`src/program-builder/program-builder.js`; B:`backend/tests/Builder/ProgramBuilderAnalyticsApiDashboardTest.php`; B:`tests/frontend/program-builder-analytics-validator-smoke.mjs`; B:`docs/analytics-api-dashboard.md`.

**Interfaces:** `analyticsConfig` mantém opções antigas e ganha `datasets`/`dashboard` opcionais fechados. DatasetAPI usa entityCode já cadastrado; views.dashboard.tiles aceita tipos `kpi|chart|progress|list|links|group`, datasetId opcional, valueField/labelField, format, items ou children por tipo. `group` aceita collapsed boolean; links usam apenas navigationId de catálogo fechado. `analytics.navigation` mapeia id→{label,url} HTTPS sem userinfo/fragmento sensível, cadastrada e validada no servidor; não há template/JS/HTML.

- [ ] Testes RED de roundtrip importação→preview→exportação→publicação; fonteAPI preserva os dois datasets; programa analytics aceita entidadeAPI quando configurado nesse modo e continua recusando combinações não suportadas.
- [ ] Acrescentar schema/normalização de opções e validar tipo/colunas/datasetId/referências/árvore limitada a3níveis/IDs únicos. Catálogo de links não aceita javascript:, data:, URL protocol-relative, host diferente do cadastro ou substituição por query/payload. No IOL, único host autorizado imaonline.imatextil.com.br com paths da origem.
- [ ] Gerar endpoints read/schema/run com permissões usuais; materialize=false e nenhuma operação mutável paraAPI. Não editar generatedDefinition assinada; manter defaults legados quando opções novas ausentes.
- [ ] Atualizar validação do editor preservando opções no ciclo salvar/importar/exportar e referências de campos/tipos. GREEN: PHPUnit da nova classe e ProgramBuilderServicePublishFlowTest; `node tests/frontend/program-builder-analytics-validator-smoke.mjs` na raizB.

### Tarefa 6: Cartões reutilizáveis no AnalyticsEngine

**Files:** B:`src/analytics-engine/AnalyticsEngine.js`; novo B:`src/analytics-engine/AnalyticsDashboardRenderer.js` carregado pelas entradas existentes que usam AnalyticsEngine; B:`src/styles/analytics-engine.css`; B:`tests/frontend/analytics-dashboard-smoke.mjs`; B:`docs/examples/analytics-api-dashboard.json`; exemplo existente B:`examples/analytics-bi.analytics.json` e demo associada se necessário para demonstrar capacidades novas, sem trocar sua fonte real por mock na produção.

**Interfaces:** `AnalyticsDashboardRenderer(engine).render(container,view,resultsByDataset)`; `.destroy()`; reutilizar Kendo/CrudUtils existentes. Engine mantém `currentResult` para consumidores legados e novo `resultsByDataset`; dashboard consulta cada dataset requerido apenas uma vez por refresh (resumo e vendedores), com geração monotônica de requisição invalidada em destroy/erro/troca de contexto.

- [ ] Testes RED de múltiplos cartões com mesmo dataset (uma chamada), cartão list com dataset diferente, campo ausente/null versus0, lista vazia, moeda c2, contagem n0 e percentuais já em escala0–100 (44→44%, não4400%).
- [ ] Implementar progress com barra visual limitada0–100, mantendo rótulo numérico real acima100/negativo; list por nome/valor; links por navigationId; group recolhido inicialmente com KendoButton/aria-expanded. Nomes via textContent/jQuery.text. Preservar kpi/chart e opções antigas.
- [ ] Implementar resultados por dataset sem somar campos do resumo repetidos nos vendedores. Para este painel, falha em qualquer leitura restrita limpa todos os números e mostra erro Kendo; nenhum sucesso parcial aparente. Não manter números anteriores durante nova sessão.
- [ ] Testar atraso de resposta após erro/destroy e refresh concorrente; resposta obsoleta não modifica DOM/estado. Testar markup em nome, IDs/links inválidos, teclado, mostrar/ocultar sem HTTP extra, tema claro/escuro e viewport390px.
- [ ] Acrescentar opção declarativa `analytics.presentation.mode=dashboard` para ocultar seletor técnico de dataset/pivot/materialização neste painel, preservando o modo padrão nas telas atuais. Mostrar última atualização/competência.
- [ ] Ler skill canônica `construtor-pg-demo-production-parity` exigida pelo AGENTS antes de alterar exemplos/mocks; localizar por rg --files. Se não disponível, registrar dependência e não alterar demos até resolver; testes podem usar fixtures próprias. Atualizar B:`docs/paridade-demo-producao.md` quando aplicável.
- [ ] GREEN: `node tests/frontend/analytics-dashboard-smoke.mjs`, `node tests/frontend/analytics-demo-smoke.mjs`, smokes render-gate e home pertinentes; testes sem CRUD real. Não editar Kendo/vendor.

### Tarefa 7: Metadados IOL e integração dos contratos

**Files:** C:`integration-src/iol-pagina-inicial-gerencial/metadata/{api-source.json,resumo-entity.json,vendedores-entity.json,builder-draft.json}`; C:`tools/construtor-local/{publish-iol-gerencial-metadata.cjs,verify-iol-gerencial.cjs}`; B:`integrations/iol-inicial-gerencial/` recebe cópia dos metadados aprovados por fluxo oficial.

**Interfaces:** fonte `motor_progress_iol_gerencial`, operações read_resumo/read_vendedores listPOST com bodyTemplate fixo e itemsPath=data/contratoSursum; entidades `iol_gerencial_resumo_progress` e `iol_gerencial_vendedores_progress` readonly. Programa `iol.inicial-gerencial` vincula esses datasets; código/faixa de módulo obtidos do catálogo oficial, não inventados.

- [ ] Gerar metadados do resumo/vendedores exatamente da tarefa1; API sem create/update/delete/process. Token permanece em C:`.runtime/construtor-pg/iol-gerencial-connection.json`, nunca no draft exportado.
- [ ] Criar dashboard com grupoMeta recolhido (metas mensal/quinzenal, líquido e progresso), loja (vendido/ideal/dias), vendedores e demais cartões/links da origem. Destinos cadastrados na navigation: cons_ped_aprov_gerencial, cons_tb_preco_estoque, cons_tb_preco_prog_container, bl_painel_inicial_repres_ped_wp, rastreamento_pedidos_venda, bl_noticias_ativas, PAC_.rtf, RNC.rtf, bl_arquivos_estilo/bl_arquivos_estilo.php e cons_item_certificacao.
- [ ] Testar preview/geração com respostas fixture dos contratos; conferir tipos e2datasets,10destinos e nenhuma ação mutável. Usar APIs oficiais do Builder com locks/versões/governança; teste/publish somente na tarefa8 após PASOE validado.
- [ ] Implementar verificador de leitura autenticada: login do próprio usuário, comparação com referência somente leitura, escopos fixture distintos, admin sem vínculo negado; não salvar credenciais em evidências. Comparação real depende de sessãoIMA legítima, sem impersonação ad hoc no payload ou criação automática de usuário.

### Tarefa 8: Publicação restrita, prova real e continuidade

**Files:** C:`tools/construtor-local/publish-iol-gerencial.py`; C:`docs/integracao-iol-inicial-gerencial-validacao.md`; C:`context/PROJECT_CONTEXT.md`; contextos canônicosB/M; manifests privados C:`.runtime/iol-gerencial-publish-20261016/`.

**Interfaces:** publicador recebe manifesto de artefatos12.2 e hashes esperados, valida montagem do compartilhamento, prepara backup e publica somente os serviços/wrapper/config/rota desta entrega. Config remoto guarda só tokenSha256. Rota `/SursumPrograms/iol-inicial-gerencial` mesclada; rejeitar colisão sem sobrescrever.

- [ ] Ler skill motor-progress-publicar-pasoe e verificar acessos `.42`/`.111`, versão/DLC/PROPATH/aliases atuais e hashes. Credencial Scriptcase não é presumida válida nos outros hosts. Tratar falta de acesso como bloqueio da fase remota, continuando verificações locais independentes.
- [ ] Compilar lote final das tarefas2/3 em12.2, conferir logs e manifesto. Sincronizar fontes canônicos preservando diff e publicar via SFTP `.111` em `/mnt/datasul/ERP/sursum`; verificar hashes/backup antes/depois. Não reiniciar instância se novo programa carregar normalmente.
- [ ] Validar PASOE real com token ausente/incorreto, operações inválidas, identidade ausente e login legítimo; conferir competência/tipos/regras/escopo. Não usar abertura PHP sem sessão como golden nem declarar sucesso por fixture.
- [ ] Publicar metadados oficiais e abrir `http://127.0.0.1:8765/production/app.html?screenId=iol.inicial-gerencial`. Verificar dataset real, metas recolhidas/abertas,10destinos, contagens, ordenação e formatos. Não acionar programas legados que possam gravar/processar; verificar destinos declarados sem executar seus negócios.
- [ ] Rodar suítePHP e smokes pertinentes uma vez após alterações finais; lintPHP/container, integridade somente check e git diff --check dos arquivos alterados. Rever mudanças completas e corrigir achados; ampliar testes só por novas falhas/mudanças. Sem schema/reseed/resign/commit/push.
- [ ] Registrar em documentação evidências e limitações, caminho da tela, compilação/publicação/PASOE/UI separadamente. Marcar tarefas concluídas apenas com resultados observados; se faltar login autorizado, indicar validação de negócio pendente, mantendo bloqueio seguro.

## Autorrevisão do plano

- Cobertura: identidade/regras/calendário em1–3; dataset live/cache em4; Builder/links/schema em5; apresentação/teardown/mobile em6; integração em7; publicação/aceite em8.
- Nomes e DTOs: `resumo` e `vendedores` são os mesmos no wrapper, contrato, duas operações e datasets. Nenhum login/parâmetro de negócio vem do navegador.
- Testes: cada item do Review Focus tem casos nas tarefas indicadas; resultado do banco real não depende de writes de teste.
- Limites: dependência de skill de paridade/accessos remotos/sessãoIMA explícita; nenhum sucesso de implementação alegado neste plano. Não há autorização para converter destinos dos atalhos ou retomar pendências dos containers.

Estado: execucao autorizada e concluida; evidencias e desvios no relatorio de validacao.

## Execucao concluida em16/10/2026

As oito tarefas foram executadas com revisao independente e correcoes testadas. A lista acima conserva os passos originalmente planejados; os casos/contagens realmente executados e os desvios estao em `docs/integracao-iol-inicial-gerencial-validacao.md`. Identidade corrigida pelo usuario para tasilpar;20buffers privados (mais2tabelas de restricoes),10destinos reais. A coleta de gross-up fica em uma unica rotina compartilhada do coletor; percentuais ficam no calculador puro. Probe de snapshots fisicos removido apos rejeicao automatica; aceite pelo fluxo autenticado normal. Exemplos de producao no pacote de metadados, demos/mocks preservados pela ausencia da skill de paridade. Sem commits.
