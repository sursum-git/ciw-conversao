# op1047 — seleção ativa de despesas do container

Pacote isolado autorizado pelo root. Origem ativa: grid_despesas_container_grid.class.php5477–5484 → cons_selec_despesas/index.php, SC_btn_0/onFinish7413–7416. Não é o helper ALLdefaults1044 em backup, nem o lote1042.

Ordem: sincronizar TODOS os defaults ativos não impostos da empresa, inclusive não selecionados/excluídos do lookup; marcar log_utilizado TRUE somente nas definições selecionadas (todas as linhas do container para a definição, inclusive itens); calcular subset selecionado de definições calculadas; subset vazio, inclusive seleção só não calculada, usa fallback todas não manuais; sincronizar impostos e IPI. Não limpar marcações anteriores. UPDATE de defaults preserva log_manual; INSERT o deriva do percentual zero. Campos não escritos preservam tipos/NULL.

Reuso escolhido: operação selecionar_despesas e lookup opcoes_despesas_selecao dentro de ContainersImpostosService, com ABI existente. DefaultsPlan privado novo usa UpsertPlan/PersistPlan centrais. LoadCompany/LoadCatalog são extrações únicas da coleta existente para lookup e escrita. CalculatedPlan recebe subset e política privada ordenada SOMENTE1047, no mesmo planner/fórmula/persistência. Topologia de todos os comandos antigos permanece intacta. O TT AdepB prova resultado observável0,30 em A→B e1,00 em B→A; o comando antigo mantém0,50 topológico com seu estado original.

Patches incrementais sobre1043, agora conferidos com os baselines físicos estáveis da wave6 que incorporou1043: ContainersImpostosService.p, ContainerProcessBoundary.i, ContainersProcessosService.p, ContainersProcessos.p, RuntimeContainerAudit.php, RuntimeApiEntityActionService.php e ScreenDefinitionService.php. Novos ContainerExpenseDefaultsPlan.i e RuntimeContainerExpenseDefaultsAudit.php. A extensão opt-in nativa altera apenas candidatos de ProgramBuilderService, ProcessEngine, ProcessDefinitionValidator e dois JSONSchemas, todos por patch/hash. Root integra; nenhum canônico é sobrescrito por stage.

ProcessEngine nativo com integer[] despesa_ids OBRIGATÓRIO1..100, fiel ao botão que recusa seleção vazia. O fallback vazio pertence somente ao subset de calculadas. Confirmação explícita de sobrescrita de não selecionadas e lookup fixo MED. Entidade própria container_despesas_selecao_progress, fonte de processos aditiva; sem frontend/Kendo paralelo. Lookup mostra somente ativos não impostos, exclui distribuição e destinos não recuperáveis. Native options não pagina; cap200 falha fechado sem truncar, coleta50mil/10s.

Ordenação: dois enums fechados ordem_campo/ordem_direcao, padrão ordem/asc. Options e writer usam a MESMA projeção ordenada central; a ordem de cliques do MultiSelect não controla cálculo. Dependências opt-in optionsSource.parameterFields enviam apenas os dois enums assinados com contexto readonly. Generation counter descarta sucesso/erro obsoleto; execução fica bloqueada durante carregamento, erro e mudança durante confirmação; enum inválido não lança erro de página/não envia transporte. Sem flag, payload antigo continua apenascontexto. Descrição/NULL cuja equivalência SQL não foi provada recusam explicitamente; ID desempata empates como extensão declarada, sem paridade visual literal.

- [x] RED novo comando ausente sobre predecessor1043; contrato defaults/subset auditado.
- [x] GREEN core real: defaults ALL/update/create/manual/NULL/marcações/subset/fallback/ordem; validação antes IDs; rollback/stale/limites;222core+15driver×4.
- [x] Driver/lookup MED e transação; Runtime process/options reais com ator/imagens completas; PHP161/1264 inclui regressões1043/collections/opções/lotes.
- [x] Builder real, JSONSchema completo AJV2020, seleção/confirmação/UI19 e três regressões nativas antigas.
- [ ] Manifesto/freeze com rebase de source/parent sobre snapshots publicados vigentes; review root e compilação12.2.

Sem publicação, DDL, grants, negócio real, sequência nova ou alteração dos freezes1042/fiscal/1043. OE12.2/.42 e PASOE sursum-api/med são gates do root.
