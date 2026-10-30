# Conversão CIW parcial e preparada — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Concluir as 13 origens parciais e publicar/validar as oito preparadas no escopo do menu CIW, sem duplicar regras de negócio.

**Architecture:** O construtor continua sendo o frontend JSON/Kendo. Operações e leitura passam por PHP/PASOE para serviços ABL reutilizáveis no `sursum-api/MED`; publicação de metadados preserva fontes/operações existentes. Os comandos com escrita são separados das consultas e exigem cenário novo autorizado.

**Tech Stack:** Scriptcase legado como referência, JSON do construtor-pg, PHP, OpenEdge 12.2, PASOE `sursum-api/MED`, Kendo UI local.

**Spec:** `docs/superpowers/specs/2026-10-29-ciw-parciais-preparadas-design.md`

## Global Constraints

- Não alterar `kendo/` nem criar frontend paralelo.
- Compilar ABL no OpenEdge 12.2 do `.42` e publicar apenas em `sursum-api/MED`.
- Reusar coleta/cálculo/persistência de custo, versão, imposto e distribuição; não copiar fórmulas entre handlers.
- Logs transacionais devem manter usuário, transação e imagens anterior/atual.
- Sem escrita operacional ou autorização de acesso humano nova sem autorização explícita.
- Anexos sem acervo físico confirmado não recebem download fictício.

## Review Focus

- Contexto de container ou processo ausente deve ser recusado no servidor; validar em cada nova operação contextual.
- Registro alterado entre leitura e escrita deve devolver conflito sem efeito parcial; testar nos comandos em lote.
- Filtros técnicos não podem vazar para payload de formulário/salvamento; validar nas navegações entre itens e custos.
- A ausência de arquivo físico deve retornar indisponibilidade controlada, nunca conteúdo vazio ou arquivo substituto.
- Um comando de custo/distribuição repetido não pode duplicar lançamentos; testar com cenário novo antes de promover a origem.

---

### Task 1: Consolidar matriz de equivalência das 13 origens parciais

**Files:**
- Modify: `integration-src/ciw-inventory/menu-scope/menu-scope.json`
- Modify: `integration-src/ciw-inventory/menu-scope/MENU_E_CHAMADAS.md`
- Create: `integration-src/ciw-completion-20261028/partial-prepared/matriz-equivalencia.json`

**Interfaces:**
- Consumes: origens `Parcial` do escopo de menu e as definições publicadas do construtor.
- Produces: uma linha por origem com ações do Scriptcase, operação/API equivalente, estado de publicação, prova necessária e bloqueio.

- [ ] **Step 1: Extrair as ações e chamadas de cada origem parcial dos fontes Scriptcase sem executá-los.**
- [ ] **Step 2: Registrar uma matriz que compare cada ação com o programa/entidade/operação do construtor, declarando explicitamente os gaps.**
- [ ] **Step 3: Testar o validador da matriz com uma origem publicada, uma parcial e uma sem arquivo físico.**
- [ ] **Step 4: Atualizar o inventário apenas quando uma origem tiver evidência completa; manter os demais estados.**

### Task 2: Fechar leitura e navegação das parciais sem efeitos de negócio

**Files:**
- Modify: metadados JSON específicos de `ciw.cotacoes-bc`, `ciw.containers`, `ciw.container-painel`, `ciw.container-itens`, `ciw.container-despesas`, `ciw.container-pagamentos`, `ciw.container-nfs`, `ciw.container-versoes-custo` e `ciw.titulos-pagar-med` após exportação fresca.
- Test: validadores nativos de metadata e APIs de leitura correspondentes.

**Interfaces:**
- Consumes: matriz aprovada da Task 1 e APIs de leitura já publicadas.
- Produces: links/contextos declarativos e telas que exibem somente ações já implementadas.

- [ ] **Step 1: Criar testes de metadata que rejeitem link sem contexto obrigatório ou ação sem operação publicada.**
- [ ] **Step 2: Fazer o menor ajuste JSON para cada gap de navegação confirmado, preservando operações e permissões existentes.**
- [ ] **Step 3: Executar preview integral, validação nativa de read/get/contexto e teste de navegação no navegador para cada tela alterada.**
- [ ] **Step 4: Publicar somente as definições revisadas e gravar recibos/versões no inventário.**

### Task 3: Tratar anexos e autenticação como bloqueios explícitos

**Files:**
- Modify: contrato/API de anexos de container somente se a localização física for confirmada.
- Modify: matriz e inventário para `form_anexos_container` e `bl_tela_login`.
- Test: testes de indisponibilidade de arquivo e de sessão/permissão.

**Interfaces:**
- Consumes: localização validada do acervo, quando fornecida; autenticação existente.
- Produces: bloqueio explícito ou fluxo validado, sem simular download/login humano.

- [ ] **Step 1: Testar retorno controlado para referência de anexo sem arquivo físico.**
- [ ] **Step 2: Manter `form_anexos_container` parcial até confirmação do acervo; não publicar download substituto.**
- [ ] **Step 3: Validar login/logout integrado somente com credencial e autorização humana apropriadas; caso contrário, registrar o bloqueio.**

### Task 4: Publicar geração de versões por serviço central

**Files:**
- Modify: serviços Progress reutilizáveis de versão/custo já existentes em `D:/opencode/motor-progress/v2`.
- Modify: source/metadata de `form_versoes_item_custo_container` e `bl_item_custos` no construtor.
- Test: testes ABL de coleta/cálculo/persistência e validação PASOE read/process.

**Interfaces:**
- Consumes: `VersionService` e serviços de coleta/cálculo existentes.
- Produces: operação process protegida por contexto, logs antes/depois e metadata contextual publicada.

- [ ] **Step 1: Escrever teste ABL que prove uso único do serviço de versão e recuse contexto/estado inválido.**
- [ ] **Step 2: Implementar a adaptação mínima do handler para chamar o serviço central, sem repetir fórmulas.**
- [ ] **Step 3: Compilar em OE 12.2, publicar em MED e executar regressões read/process sem banco de negócio.**
- [ ] **Step 4: Solicitar cenário novo autorizado antes do primeiro teste gravador real; registrar e limpar por manifesto.**

### Task 5: Publicar despesas em lote e distribuição centralizada

**Files:**
- Modify: operações reutilizáveis de despesas/distribuição no motor Progress.
- Modify: metadata de `form_despesas_container_multi_reg`, `bl_distribuir_custo_contr` e `ctrl_simul_distr_custo`.
- Test: concorrência, idempotência e logs anterior/atual.

**Interfaces:**
- Consumes: regras centrais de despesas, empresa do container e log/transação.
- Produces: manutenção em lote e simulação/distribuição protegidas por versão/estado do registro.

- [ ] **Step 1: Criar testes que rejeitem despesas desatualizadas, empresa divergente e repetição que gere duplicidade.**
- [ ] **Step 2: Implementar comandos finos que encaminhem a regras centrais e gravem uma transação auditável.**
- [ ] **Step 3: Compilar/publicar/validar somente contratos de leitura/processo sem dados operacionais.**
- [ ] **Step 4: Solicitar cenário de teste novo para cada comando gravador antes de sua validação real e limpar registros próprios depois.**

### Task 6: Publicar simulação e fechamento de custo

**Files:**
- Modify: serviços centrais de custo/fechamento e handlers de `contr_item_custos`, `cons_itens_container_simul_calc` e `bl_item_custos_gravacao`.
- Modify: metadata contextual correspondente.
- Test: simulação sem escrita, fechamento idempotente, bloqueios e logs.

**Interfaces:**
- Consumes: resultado de custo central e versão persistida.
- Produces: simulação readonly e fechamento explicitamente confirmado.

- [ ] **Step 1: Escrever testes que diferenciem simulação de fechamento e garantam zero escrita no primeiro caso.**
- [ ] **Step 2: Conectar handlers ao mesmo coletor/cálculo/persistência de versões usado pelas demais APIs.**
- [ ] **Step 3: Compilar em OE 12.2, publicar em MED e validar payloads/erros no PASOE.**
- [ ] **Step 4: Antes de fechamento real, solicitar autorização de cenário novo e executar teste/limpeza por manifesto.**

### Task 7: Fechamento do lote e inventário

**Files:**
- Modify: `integration-src/ciw-inventory/menu-scope/menu-scope.json`
- Modify: `integration-src/ciw-inventory/menu-scope/MENU_E_CHAMADAS.md`
- Modify: `context/PROJECT_CONTEXT.md`
- Test: verificador do inventário e recibos de publicação.

**Interfaces:**
- Consumes: provas de Tasks 2–6.
- Produces: estados finais por origem, pendências reais e memória de retomada.

- [ ] **Step 1: Validar que cada promoção a `Convertido` possui API, metadata, publicação e prova compatíveis.**
- [ ] **Step 2: Atualizar o inventário e contexto, mantendo bloqueios de anexos/login/autorizações quando aplicáveis.**
- [ ] **Step 3: Executar testes de consistência do inventário e revisão final de diferenças, sem reexecutar cenários já limpos.**

## Self-review

- Cobertura: Tasks 1–3 abrangem as 13 parciais; Tasks 4–6 abrangem as oito preparadas; Task 7 impede promoção sem prova.
- Interfaces: toda escrita passa pelos serviços Progress existentes e logs transacionais; metadata não cria regras de negócio.
- Review focus: os cinco riscos acima são exercitados nas Tasks 2–6.
- Proporção: o plano decide sequência, responsabilidades e verificações, sem copiar a implementação dos serviços.
