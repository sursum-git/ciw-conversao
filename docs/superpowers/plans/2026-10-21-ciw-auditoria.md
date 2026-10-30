# Auditoria CIW — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking. Execução aqui já escolhida pelo usuário; não solicitar essa escolha novamente.

**Goal:** Exibir as transações e eventos autorizados do CIW para tadeu.parreiras sem conceder grupo administrador.

**Architecture:** Uma política central resolve o alcance de auditoria a partir da sessão e dos programas publicados. Ela restringe a consulta no servidor, inclusive detalhe e total, e controla a decoração dos botões nativos. A entrega funciona antes do contexto de empresa API; a segunda entrega acrescenta a autorização por empresa aos eventos novos.

**Tech Stack:** PHP 8.4, Symfony, Doctrine DBAL/ORM, PostgreSQL, PHPUnit e frontend existente Kendo/jQuery.

**Spec:** `D:/opencode/conversao-sc/docs/superpowers/specs/2026-10-20-ciw-auditoria-empresa-api-design.md`, aprovado pelo usuário em 21/10/2026.

## Global Constraints

- Reutilizar frontend, formulários, menu, seletor e renderizadores do construtor por metadados. Não criar frontend paralelo nem alterar Kendo.
- Conta corrente fornecedor permanece fora. Nenhuma nova permissão de execução de processos é concedida por este desenho.
- Não criar eventos antigos nem sugerir que o histórico Scriptcase foi migrado.
- Testes de negócio autorizados usam somente registros novos marcados para teste e removidos ao terminar.
- C = `D:/opencode/conversao-sc`; B = `D:/opencode/construtor-pg`. Caminhos abaixo relativos a B, salvo indicação C.
- Antes de editar B, ler seus AGENTS/contextos/arquitetura/UI e preservar alterações existentes com hashes e backups privados. Skill de paridade nomeada por B não foi localizada na sessão anterior: procurar novamente na execução e seguir a matriz documentada se continuar ausente.
- Não fazer commit/push, reseed ou migração de schema nesta entrega. C não é repositório Git. Registrar recibos privados sem tokens/senhas.
- Plano preparado; implementação aguarda revisão do plano. Não reaplicar o grant CRUD existente de 65 permissões.

## Review Focus

1. Consulta direta de evento/transação fora do CIW: detalhe deve ser negado antes de retornar campos; tarefa 1.
2. Total/exportação com OR, paginação ou filtros ausentes: nenhum dado ou contagem fora do conjunto permitido; tarefa 1.
3. Tela cujo nome começa por ciw mas pertence a outro módulo, ou tela CIW sem read: ambas excluídas; tarefa 1.
4. Revogação de acesso e sessão ativa: a próxima requisição não conserva alcance antigo por cache; tarefa 2.
5. Históricos vazios e pagamentos com identificador opaco: controles funcionam sem inventar eventos ou converter IDs; tarefa 2.

## Tarefa 1 — Política obrigatória de leitura da auditoria

**Files:** Create `backend/src/Runtime/RuntimeAuditAccessPolicy.php`, `backend/src/Runtime/RuntimeAuditAccessScope.php`, `backend/tests/Runtime/RuntimeAuditAccessPolicyTest.php`; Modify `backend/src/Runtime/RuntimeEntityActionService.php`; Extend `backend/tests/Runtime/RuntimeAuditLogScopeTest.php`, `backend/tests/Runtime/RuntimeEntityActionServiceSubscriberIsolationTest.php`.

**Interfaces:**
- `RuntimeAuditAccessPolicy::resolve(): RuntimeAuditAccessScope` usa PermissionResolver, vínculo vigente assinado e programas/telas publicados. Retorna escopo imutável com `tenantId:string`, `unrestricted:bool`, `screenIds:list<string>`; lista vazia é deny-all, não ausência de restrição.
- `RuntimeAuditAccessPolicy::apply(QueryBuilder $query, array $definition, RuntimeAuditAccessScope $scope, string $alias = 't'): void` aplica predicado obrigatório às entidades `runtime_transaction` e `runtime_transaction_log`. Para eventos, associação à transação pai inclui assinante e ID, sem confiar em filtros do cliente.
- `RuntimeAuditAccessPolicy::canViewScreen(string $sourceScreenId): bool` resolve a tela publicada e seu módulo real.
- `RuntimeAuditAccessScope` também terá desde esta etapa espaço tipado opcional `allowedCompanyKeys:list<string>|null` para extensão pela entrega API; `null` significa política empresarial ainda não ativada. Não expor esse objeto na resposta pública.

- [ ] Registrar baseline dos arquivos envolvidos e conferir o caminho de leitura/exportação das duas telas publicadas. Qualquer consumidor de auditoria que não passe por RuntimeEntityActionService deve receber a mesma política antes de liberar as telas.
- [ ] Escrever testes parametrizados: administrador conserva comportamento; usuário com `ciw.audit.read` lê apenas duas telas CIW com read no tenant atual; transação de outro módulo/tenant e tela CIW sem read não entram na lista nem no total; `ciw.falsa` em outro módulo não entra. Sem permissão e conjunto vazio resultam em zero registros ou acesso negado, nunca consulta irrestrita.
- [ ] Escrever testes de detalhe/evento por ID, filtro OR incluindo outro módulo, filtros ausentes, sort/group e exportação. Fixtures de eventos devem incluir transação pai de outro assinante e ID igual dentro de outro tenant, garantindo join com isolamento.
- [ ] Rodar `C:/php-8.4.3/php.exe bin/phpunit tests/Runtime/RuntimeAuditAccessPolicyTest.php` em B/backend; confirmar RED por ausência da política ou exposição detectada.
- [ ] Implementar as interfaces acima. Inserir aplicação da política antes dos filtros de usuário em read, antes do clone usado no total e na busca por ID. Não mudar findRow para permitir writes de auditoria; telas continuam somente leitura. Contexto `_auditLogScope` enviado pelo cliente continua sem autoridade.
- [ ] Executar os três arquivos de teste citados. Esperado PASS de isolamento/lista/total/detalhe e preservação dos filtros reservados existentes. Usar fixtures sintéticas, não histórico operacional como massa destrutiva.

## Tarefa 2 — Acesso às telas e controles nativos

**Files:** Modify `backend/src/Runtime/PermissionResolver.php`, `backend/src/Runtime/ScreenDefinitionService.php`; Create `backend/tests/Runtime/RuntimeCiwAuditVisibilityTest.php`; Extend `backend/tests/Runtime/PermissionResolverTest.php`.

**Interfaces:**
- PermissionResolver permite leitura das duas telas nativas de auditoria por `ciw.audit.read` somente por regra explícita dessas telas, preservando todo o restante das restrições. Reutilizar `RuntimeAuditAccessPolicy::canViewScreen` para origem. Não introduzir operador OR genérico novo em todos os metadados.
- ScreenDefinitionService verifica origem + destino ao decorar Logs/Logs Exclusão. Campos e documentIds nativos continuam os mesmos; alterar apenas a decisão de acesso.

- [ ] Escrever teste RED: permissão específica mostra controles em `ciw.despesas`, `ciw.empresas-despesa`, cadastro em lote e processo já acessível; não mostra para outra tela sem read. Usuário não vira admin e segue sem ler configuração administrativa.
- [ ] Acrescentar testes de revogação do vínculo/read entre duas resoluções, histórico vazio, ID opaco de pagamentos e histórico de registro excluído. Não manter cache de alcance entre requisições.
- [ ] Rodar `C:/php-8.4.3/php.exe bin/phpunit tests/Runtime/RuntimeCiwAuditVisibilityTest.php` e confirmar RED.
- [ ] Implementar a regra específica nas duas classes, sem alterar o requisito de grupos de outras telas. Evitar dependência circular: a política resolve read das telas de origem, sem voltar a resolver as telas de auditoria.
- [ ] Rodar os testes desta tarefa e `tests/Runtime/RuntimeAuditLogScopeTest.php`, `tests/Runtime/RuntimeContainerPaymentsAuditTest.php`, `tests/Runtime/RuntimeCiwCadastroAuditTest.php`. Esperado PASS e nenhum grant de execução de processo.

## Tarefa 3 — Publicação local, grant e prova visível

**Files:** Create C:`tools/construtor-local/enable-ciw-audit-access.php`, C:`docs/ciw-auditoria-validacao.md`; Update C:`context/PROJECT_CONTEXT.md`, C:`context/RETOMADA_2026-10-16.md`, B:`CONTEXTO_PROJETO.md`, B:`docs/continuidade-codex.md`, B:`docs/arquitetura-crud-engine.md`.

**Interfaces:** ferramenta `prepare` somente leitura; `apply` concede exclusivamente `ciw.audit.read` no vínculo assinado tadeu.parreiras/default, com backup, lock e recibo de execução única. Atualiza snapshots das sessões LDAP ativas pelo padrão nativo já validado. Resultado esperado: 66 permissões, sem grupo administrador; não confiar nesse número caso o usuário tenha feito mudança independente — recalcular delta e preservar estado atual.

- [ ] Executar regressão dirigida dos arquivos anteriores e `C:/php-8.4.3/php.exe bin/phpunit tests/Runtime/PermissionResolverTest.php`. Não executar scripts de reseed para publicar ajuste de acesso.
- [ ] Preparar dry-run do grant, comparar mapa corrente e aplicar delta assinado após código de escopo obrigatório estar ativo. Não ler/reutilizar tokens humanos. Verificar assinatura e snapshots em processo novo; registrar delta exato, não conteúdo privado de sessões.
- [ ] Na sessão humana pelo CUA, recarregar Home, abrir Despesas/Empresas por Despesa/um lote e os históricos. Comprovar transações e eventos existentes ou estado vazio correto; tentar acesso negado a histórico fora do escopo usando sessão técnica de teste apropriada, sem impersonar usuário humano.
- [ ] Salvar captura com controles e histórico em C:`.runtime/ciw-audit-20261021/`. Nenhuma exclusão de registro real para demonstrar Logs Exclusão. Se teste de escrita for necessário, criar e remover somente registro novo marcado, preservando toda massa anterior.
- [ ] Revisão independente conforme requesting-code-review, corrigir achados e repetir somente checks afetados. Atualizar documentação com resultado real e limites: esta etapa não significa que empresa API já funciona.

## Saída e rollback

Entregar acesso visível e restrito à auditoria CIW, recibo de grant e evidência de isolamento. Reverter código somente pelos arquivos/hashes próprios; retirar exclusivamente o delta de permissão assinado, preservando mudanças posteriores. Não remover histórico de negócio para rollback.

Depois desta entrega, executar o plano de empresa API aprovado na mesma revisão: `2026-10-21-ciw-empresa-api.md`.
