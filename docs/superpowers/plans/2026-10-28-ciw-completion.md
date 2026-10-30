# Conclusão de todas as conversões CIW — plano de execução contínua

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** concluir todas as aplicações CIW em escopo, conservando as entregas comprovadas e mantendo cada lacuna real na fila até sua validação.

**Architecture:** frontend existente do construtor-pg configurado por JSON; APIs Progress de recursos fixos e serviços centrais reutilizáveis. Executores preparam pacotes independentes por domínio e patches com hash-base; root revisa, integra, compila no OpenEdge12.2/.42, publica e valida exclusivamente sursum-api/med.

**Tech Stack:** JSON metadata, PHP runtime, ABL/OpenEdge12.2, testes TT, validador nativo e navegador.

**Spec:** AGENTS.md; context/RETOMADA_2026-10-16.md, topo prevalente de28/10; inventário integration-src/ciw-inventory/inventory-reviewed.json; pedido humano de concluir todas as conversões com gerente e executores.

## Global Constraints

- Não duplicar frontend, Kendo, coleta/cálculo/persistência de custos, impostos, versões ou rateios.
- IMA via parametros_ima.i direto NOLOCK e sem cache; contexto MED fixo no servidor.
- Não reaplicar publicações, permissões, testes ou limpezas já encerradas.
- Canônicos sujos preservados; candidatos em integration-src/ciw-completion-20261028/<dominio> e recibos privados em .runtime/ciw-completion-20261028.
- Nenhum commit/push, DDL, grant ou mutação operacional sem autorização específica. Leituras não geram transações comerciais fictícias.
- Controles permanece final; conta corrente fornecedor é exclusão pontual do menu ainda sem alvo provado, não exclusão automática de toda família financeira.
- Nenhum lote encerra o objetivo global. Nenhum estado histórico ou tela semelhante comprova equivalência por origem.

## Review Focus

- Fonte e destino podem ter campos iguais mas filtros/contextos diferentes: comparar eventos ativos e contratos por origem.
- Consultas de memória e versões não podem recalcular nem atualizar ao abrir: testar ausência de writers e fórmulas novas.
- Identidades compostas, NULL, filtros inválidos e aliases de GET precisam falhar fechados; não omitir contexto obrigatório.
- Catálogo/hashes mudam enquanto pacotes avançam: integrar somente com baseline conferido e preservar todas as operações anteriores.
- Históricos, alternativas e utilitários podem ter uso real: provar referências e diferenças antes de propor absorção/retirada.

## Fila e evidências executáveis

Gerar: `powershell -File tools/construtor-local/build-ciw-completion-ledger.ps1`.
Saídas: `.runtime/ciw-completion-20261028/{ledger,family-summary}.json`. As262 origens permanecem no ledger; classificação de execução é separada do inventário global. Este documento não altera contagens de conversão nem alega entrega.

### Task1: reconciliar estado prevalente e reservar trabalho

- [x] Conferir inventário262, catálogo real113 e códigos reservados sem colisão.
- [x] Classificar17 famílias, fontes disponíveis, pendências, alternativas e gates finais em ledger.
- [x] Atribuir root às cinco consultas de cadastros publicadas para comparação/fecho readonly.
- [x] Disparar dois executores: fiscal readonly e histórico de versões; sem canônicos compartilhados.
- [ ] Confrontar recibos especializados atuais de containers/pagamentos/itens/custos e preparar proposta de reconciliação por hash, sem tocar inventário global.

### Task2: histórico fiscal e memória de despesa

**Owner:** container-fiscal-readonly. **Files:** integration-src/ciw-completion-20261028/container-fiscal-readonly/**. **Sources:** cons_calcs_imp_container e cons_despesas_container_memoria_calculo.

- [ ] Provar campos, filtro de container/despesa, contexto e navegação do evento ativo; mapear API existente.
- [ ] Preparar consultas readonly e metadados nativos; novos wrappers fixos somente se leitura existente insuficiente. Códigos reservados op1033/op1034.
- [ ] Executar testes locais significativos, entregar testes oficiais para12.2, manifesto hashes e patches baseline.
- [ ] Revisão gerente → integração/build/publicação/validação root → prova runtime/UI. Gates de acesso ficam explícitos.

Checkpoint wave1: fiscalv2 revisado; histórico v1.3 revisado; build combinado oficial3 compilou26entradas e executou384checks em cada quatro combinações,1536totais/NUMDBS0. Root integrou8ABL+2PHP+6metadados por hash/backup e iniciou publicação. PHP combinado foi conferido independentemente (56routing+36readreal+5tests17assertionshistory), suíte root885/5841. Integração/publicação ainda não são equivalência integral de origem; PASOE/runtime/UI continuam gates até recibo final. Dois erros de contexto/identidade do primeiro candidato fiscal foram corrigidos por testes reais antes de integrar. Os builds1/2 foram cancelados antes de SSH por harness LONGCHAR/ISO; build3 corrige só fronteira UTF8 dos testes, sem alterar produto para fazê-los passar.

### Task3: versões históricas sem duplicar serviços

**Owner:** container-version-history. **Files:** integration-src/ciw-completion-20261028/container-version-history/**. **Sources:** cons_versoes_item_custo_container, bl_ponte_versoes_item_custo_container e form_versoes_item_custo_container para distinguir manutenção.

- [ ] Comparar ciw.container-versoes-custo já existente com campos/filtros/links reais; comprovar lacuna antes de nova tela.
- [ ] Implementar somente lacuna comprovada em consulta/detalhe; reutilizar serviços ContainersVersion*. Códigos reservados op1035/op1036.
- [ ] Se já coberto, entregar prova por origem e migrar para lacuna readonly próxima após comunicar gerente, sem declarar writer convertido por leitura.
- [ ] Testes locais, hashes, baseline patches, revisão gerente e validação real root.

### Task4: continuar até a fila ficar resolvida

- [ ] Assim que executor liberar slot, atribuir próxima unidade funcional pronta por dependência: fiscal/comandos já centrais, pagamentos/NFs contextuais, custos/distribuição, desenhos/amostras, documentos, descontos, visões operacionais e utilitários.
- [ ] Cada pacote deve terminar em produto verificável, não apenas documentação; dependência bloqueada permanece explícita e não impede frentes independentes.
- [ ] Triar34 históricos/alternativas por uso/referência/fonte; reconciliar somente com evidência.
- [ ] Executar identidade/permissões gerais ao final conforme prioridade humana; manter Controles final e exclusão pontual preservada.
- [ ] Concluir objetivo apenas quando todas as origens em escopo tenham prova atual ou exclusão/deferimento humano explícito, sem lacuna obrigatória pendente.

Fila já em produto na próxima onda: executor fiscal prepara manutenção rápida do container/op1042, seam privado de comparação14campos sob locks e extensão nativa batch opt-in para contexto/originaisreadonly; sem snapshot_json editável. Executor versões congelou v3 com op1036–1039 (quatro projeções históricas reutilizando snapshot central), e prepara lookups atuais isolados+comparações1040/1041. Novos baselines devem ser capturados após wave1; patches combinados antigos não podem sobrescrever os ramos publicados.
