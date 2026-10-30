# Empresa operacional nas entidades API — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking. Execução aqui já escolhida pelo usuário.

**Goal:** Vincular empresas do construtor à empresa efetivamente usada pelas APIs, somente em módulos com entidades API, com contexto autorizado e auditável.

**Architecture:** Vínculos explícitos ficam nos metadados assinados de empresas/assinantes; a seleção operacional é independente do tenant autenticado e fica na sessão por módulo. Um resolvedor central e um adaptador fechado são usados pelo transporte API. Fontes sem configuração nova e entidades locais conservam o contrato atual.

**Tech Stack:** Symfony/PHP, Doctrine, PostgreSQL, frontend JSON/Kendo/jQuery existente, ABL OpenEdge 12.2 e PASOE sursum-api/med quando houver alteração Progress.

**Spec:** `D:/opencode/conversao-sc/docs/superpowers/specs/2026-10-20-ciw-auditoria-empresa-api-design.md`, aprovado em 21/10/2026. Dependência: política de auditoria definida em `2026-10-21-ciw-auditoria.md`.

## Global Constraints

- Detectar entidades API por `entityType=api` nas entidades vinculadas aos programas publicados do módulo. Não usar nome de tela ou prefixo como prova do tipo.
- Módulo sem entidade API mantém seu comportamento atual de empresa/assinante, operações locais e auditoria.
- Módulo misto disponibiliza o contexto de empresa API, mas apenas suas chamadas de entidades API recebem o novo contexto.
- O PASOE continua em `sursum-api/med`. Código de empresa não equivale a troca de conexão/banco.
- Reutilizar frontend e biblioteca Kendo existentes. Não ativar `subscriber.enabled` globalmente. Não enviar credenciais de integração ao navegador.
- Conta corrente fornecedor permanece fora. Parâmetros IMA continuam usando `sursum-api/includes/parametros_ima.i`, leitura direta NO-LOCK sem cache nas APIs.
- Custos/versões continuam reutilizando suas rotinas; não duplicar cálculo ou persistência para implementar empresa.
- C = `D:/opencode/conversao-sc`; B = `D:/opencode/construtor-pg`; M = `D:/opencode/motor-progress/v2`. Caminhos abaixo relativos a B salvo prefixo.
- Ler AGENTS/contextos canônicos antes de modificar B/M e preservar mudanças existentes. Não fazer commit/push/reseed. Vínculos usam JSON existente, sem migração implícita de schema.
- Não alterar todas as APIs como se fossem por empresa. Ativar somente operações com contrato comprovado; indisponibilidade externa fica explicitamente registrada.
- Testes de escrita usam registros novos marcados e removidos ao terminar. Nunca remover testes preexistentes do usuário.

## Review Focus

1. Módulo misto/entidade reclassificada ou publicação revogada: tipo e pertencimento reais prevalecem sobre módulo enviado pelo navegador; tarefas 1/3.
2. Duas abas e resposta tardia após troca: revisão de seleção impede salvar/apresentar dados da empresa anterior; tarefas 2/4.
3. Vínculo/permissão revogados com sessão ativa: próxima chamada falha antes do HTTP externo; tarefas 2/3.
4. Empresa escolhida, mas ID pertence a outra: API verifica alcance antes de consulta ou write, inclusive exclusão e lote; tarefas 3/6.
5. Falta de conexão IMA e erro dentro de HTTP 200: não usar MED como fallback nem produzir log de sucesso; tarefas 5/6.

## Contratos internos escolhidos

Metadados de `AuthSubscriber.metadata.apiCompanyBindings` contêm lista de vínculos com `key` (identificador estável), `ownerTenantId`, `moduleId`, `apiSourceCode`, `externalCompanyId` inteiro positivo, `ems2Code`, `ems5Code` inteiros não negativos, `revision` inteiro positivo e `enabled` booleano. O registro AuthSubscriber é referência empresarial; `ownerTenantId` delimita o tenant que pode usar o vínculo e não troca o tenant autenticado. Códigos zero só são aceitos quando o adaptador não os exige. Validação impede chave duplicada e vínculo incoerente. Não usar rótulo/nome para mapear empresa.

Permissão por vínculo: `api.company.<moduleId>.<key>.use`, com tokens validados `[a-z0-9_-]{1,64}`; se códigos canônicos não satisfizerem isso, usar chave estável validada e tabela explícita de correspondência, sem normalização que gere colisão. Não derivar permissão de nome livre. Vínculos e permissões precisam estar ativos e assinados.

`BuilderApiSource.metadata.companyContext` define versão1 e mapeamento de destinos fechados. Metadados de entidade API definem `apiCompanyContext` com modos por operação `shared`, `company` ou `record`, referenciando apenas adaptadores cadastrados. Sem configuração: caminho legado. Nenhum modo novo pode ser ativado com operação sem contrato classificado.

Seleção em `RuntimeUserSession.sessionProperties.apiCompanies[moduleId]`: `key`, `bindingRevision`, `selectionRevision`. Não guardar códigos/credenciais enviados pelo cliente. Resolver novamente no servidor em cada chamada. Contexto público contém somente `key`, `label`, `selectionRevision`; a revisão é precondição, não autorização.

## Tarefa 1 — Cadastro governado e validação dos vínculos

**Files:** Create `backend/src/Runtime/ApiCompanyBindingRegistry.php`, `backend/src/Builder/ApiCompanyContextValidator.php`, `backend/tests/Builder/ApiCompanyContextValidatorTest.php`; Modify `backend/src/Builder/ProgramBuilderService.php`, `backend/src/Runtime/StructuralIntegrityService.php`, `src/program-builder/program-builder-properties.js`; Create `examples/api-company-context.fragment.json`.

**Interfaces:**
- `ApiCompanyContextValidator::validateBinding(array $binding): array` e `validateEntityConfig(array $config, string $entityType): array` normalizam estritamente os contratos acima e rejeitam desconhecidos/conflitos.
- `ApiCompanyBindingRegistry::findEnabled(string $tenantId, string $moduleId, string $key): array` devolve vínculo validado da empresa assinada; ausência gera `API_COMPANY_UNAVAILABLE`.
- `ApiCompanyBindingRegistry::moduleUsesApi(string $tenantId, string $moduleId): bool` usa entidades e programas efetivamente publicados; nenhuma inferência pelo nome.

- [ ] Registrar baseline e escrever testes RED com entidade local contendo configuração API (rejeitada), módulo misto, módulo sem API, duplicação de key, revisão zero, tipos não inteiros e empresa referenciada inexistente. Conferir que vínculos/fonte/entidade entram na assinatura estrutural; estender payload de integridade somente se o campo não estiver já coberto.
- [ ] Executar em B/backend `C:/php-8.4.3/php.exe bin/phpunit tests/Builder/ApiCompanyContextValidatorTest.php`; confirmar RED.
- [ ] Implementar validador/registry e integrar validação à gravação/geração/publicação do Builder. Expor configuração estruturada no editor de propriedades existente; não textarea de headers/expressão livre. Reutilizar gestão nativa de AuthSubscriber para edição governada dos metadados de vínculos, sem expor esses metadados aos usuários operacionais.
- [ ] Testar round-trip editor → draft → publicação → runtime e rejeição de adulteração da assinatura; configuração ausente reproduz definição legada. Rodar teste novo e suíte Builder dirigida. Atualizar exemplo sem dados reais/credenciais e `docs/paridade-demo-producao.md` conforme regra do projeto.

## Tarefa 2 — Seleção autorizada na sessão por módulo

**Files:** Create `backend/src/Runtime/ApiCompanyContextResolver.php`, `backend/src/Runtime/ApiCompanyContext.php`, `backend/src/Controller/ApiCompanyContextController.php`, `backend/tests/Runtime/ApiCompanyContextResolverTest.php`; Modify `backend/src/Runtime/RuntimeSessionGuard.php` somente se necessário para preservar seleção no refresh.

**Interfaces:**
- `ApiCompanyContextResolver::options(string $moduleId): array` retorna `{enabled:bool,items:list<{key:string,label:string}>,selected:?{key:string,label:string,selectionRevision:int}}` da sessão atual.
- `ApiCompanyContextResolver::select(string $moduleId, string $key, int $expectedSelectionRevision): array` revalida assinatura/owner/permissão, persiste somente a seção do módulo e incrementa revisão. Revisão inicial0, primeira seleção1. Conflito retorna HTTP409 `API_COMPANY_CONTEXT_CHANGED`.
- `ApiCompanyContextResolver::forOperation(string $screenId, string $entityCode, string $operation, ?int $expectedSelectionRevision): ?ApiCompanyContext` resolve programa/módulo/entidade reais. Retorna null para legado/shared; exige contexto para company/record configurados. Objeto imutável contém vínculo e revisões confiáveis, não é serializado livremente para UI.
- Rotas autenticadas: GET `/api/runtime/api-companies/{moduleId}` lista opções; POST no mesmo caminho aceita somente `{key,expectedSelectionRevision}`. Resolver sessão nativa/CSRF conforme padrão dos controllers existentes; não criar autenticação paralela.

- [ ] Escrever testes RED de seleção autorizada, mesma key em módulos distintos, dois tenants, empresa inativa, permissão revogada, assinatura inválida e moduleId adulterado. Assert: tenant/grupos/permissões locais invariantes.
- [ ] Acrescentar teste de concorrência: duas seleções com revisão0 → somente uma efetiva; outra409. Refresh, logout/relogin e remember não restauram seleção revogada ou copiar contexto entre sessões.
- [ ] Executar `C:/php-8.4.3/php.exe bin/phpunit tests/Runtime/ApiCompanyContextResolverTest.php`; confirmar RED; implementar resolvedor/objeto/controller com lock/transação curta da sessão e comparação da revisão. Não atualizar toda a sessão com payload do cliente.
- [ ] Rodar teste novo e `tests/Runtime/RuntimeSessionGuardTest.php`, `tests/Auth/AuthSubscriberPermissionsTest.php`. Esperado PASS sem necessidade de ativar assinantes globalmente.

## Tarefa 3 — Transporte API único e prevenção de conflitos

**Files:** Create `backend/src/Runtime/ApiCompanyRequestAdapter.php`, `backend/tests/Runtime/RuntimeApiCompanyContextTest.php`; Modify `backend/src/Runtime/RuntimeApiEntityActionService.php`, `backend/src/Runtime/ApiRequestContext.php` e validação de envelope compartilhada identificada no dispatch atual, mantendo whitelist fechada.

**Interfaces:** `ApiCompanyRequestAdapter::apply(ApiCompanyContext $context, array $mapping, array $endpoint, array $request): array` produz URL/headers/query/corpo apenas nos destinos cadastrados. Mapeamento referencia valores fechados `externalCompanyId`, `ems2Code`, `ems5Code`; nunca URL/DB/propath fornecidos pelo navegador. Registrar revisão de seleção como precondição separada do contexto de registro, sem aceitá-la como código de empresa.

- [ ] Escrever testes RED parametrizados para read/get/create/update/delete/batch/options/processo suportado. Fixtures duas empresas retornam IDs diferentes. Sem configuração e entidade local produzem request legado idêntico. Mesmo screenId/recordId com empresa divergente falha; adulteração de empresa em registro, contexto, filtro ou linha de lote não substitui valor do servidor.
- [ ] Testar `selectionRevision` antiga, vínculo revogado e field reservado em header/query/bodyTemplate: conflito explícito antes de chamar cliente HTTP, com contador de chamadas zero. Empresa externa jamais é derivada do payload.
- [ ] Rodar `C:/php-8.4.3/php.exe bin/phpunit tests/Runtime/RuntimeApiCompanyContextTest.php`; confirmar RED.
- [ ] Resolver contexto uma vez por operação, antes de before-snapshot e dos HTTPs auxiliares. Encaminhar o mesmo contexto imutável a todos os calls, inclusive options e snapshots. Aplicar o adaptador no caminho central requestEndpoint; não repetir injeção em cada método CRUD. Garantir que a API valide alcance de IDs, não só filtro PHP após resposta.
- [ ] Rodar novo teste e regressões `RuntimeApiEntityActionServiceTest.php`, `RuntimeApiEntityBatchTest.php`, `RuntimeApiRequestContextTest.php`, `RuntimeApiProcessTest.php`, `RuntimeApiOptionsContextTest.php`, `RuntimeApiAuditSnapshotTest.php`. Preservar erro de negócio em HTTP200 e IDs opacos.

## Tarefa 4 — Seletor Empresa API e invalidação no frontend existente

**Files:** Create `src/home-engine/ApiCompanySelection.js`, `tests/frontend/api-company-selection.cjs`; Modify `src/home-engine/HomeEngine.js`, `src/home-engine/HomeDefinitionValidator.js`, `src/bootstrap/production-home.js`, `src/crud-engine/CrudEngine.js`, `src/styles/home-engine.css`; incluir o novo script nas entradas que já carregam HomeEngine. Não carregar script em páginas sem dependência.

**Interfaces:** `ApiCompanySelection.load(moduleId): Promise<void>` consulta opções; `select(key): Promise<void>` trata edições pelo diálogo nativo e solicita troca com revisão. Notifica HomeEngine com `{moduleId,key,selectionRevision}`. CrudEngine expõe `hasPendingChanges(): boolean` usando estado existente e `applyApiCompanySelection(selection): Promise<void>` invalida somente programas API afetados. Não gravar escolha em currentSubscriber/localStorage como autoridade.

- [ ] Testes frontend RED: módulo sem API não cria seletor; misto muda apenas programas API; contexto de outro módulo não é reutilizado; recusar troca mantém formulário; confirmar troca não salva dados automaticamente.
- [ ] Testar duas promises: resposta A iniciada antes da troca B é descartada; formulário aberto com revisão1 recebe409 ao tentar salvar após revisão2, sem retry automático de write. Lote pendente não é enviado à empresa nova. Confirmar que abas independentes detectam a revisão obsoleta no backend.
- [ ] Executar Node do runtime disponível com `tests/frontend/api-company-selection.cjs`; confirmar RED; implementar seletor com rótulo exato Empresa API e opções públicas do endpoint. Preservar o seletor de assinante atual. Propagar revisão também em aberturas standalone pela inicialização autenticada, sem confiar em querystring.
- [ ] Rodar teste novo e regressões frontend Home/CRUD afetadas. Atualizar exemplos de módulo API/misto/sem API e checklist de paridade; validar desktop e tela estreita via CUA, sem alterar Kendo.

## Tarefa 5 — Empresa efetiva nas transações e no alcance de auditoria

**Files:** Modify `backend/src/Runtime/RuntimeTransactionService.php`, `backend/src/Runtime/RuntimeApiEntityActionService.php`, `backend/src/Runtime/RuntimeAuditAccessPolicy.php`; Create `backend/tests/Runtime/RuntimeApiCompanyAuditTest.php`.

**Interfaces:** `RuntimeTransactionService::attachApiCompanyContext(ApiCompanyContext $context): void` acrescenta em request_context a chave `apiCompany` versão1 com referência empresarial, módulo, fonte, empresa externa, códigos utilizados e revisões. Copiar somente esses campos permitidos para eventos relacionados. Shared registra modo sem empresa falsa. Política da entrega1 usa as chaves autorizadas para transações novas que possuam esse contexto; legado permanece sem empresa atribuída.

- [ ] Teste RED: usuário que pode ler tela e empresaA não vê transações/eventos de empresaB, nem por ID/total/exportação; legado do mesmo CIW continua visível pela política anterior. Nenhum token/header/corpo de login entra no registro.
- [ ] Testar troca durante execução: log conserva contexto imutável da operação, não seleção atual ao finalizar. Erro externo HTTP200 não vira sucesso; vínculo revogado antes da chamada impede execução.
- [ ] Rodar `C:/php-8.4.3/php.exe bin/phpunit tests/Runtime/RuntimeApiCompanyAuditTest.php`; implementar anexação confiável antes do primeiro evento e extensão da política obrigatória. Não copiar apiCompany arbitrário de payload ou metadado do cliente.
- [ ] Rodar teste novo e regressões de auditoria/ator/snapshots da entrega1. Sem alterar eventos antigos ou inferir empresa pelo rótulo do cabeçalho.

## Tarefa 6 — Matriz CIW, contratos externos e ativação comprovada

**Files:** Create C:`docs/ciw-empresa-api-matriz.md`, C:`tools/construtor-local/prepare-ciw-company-bindings.php`, C:`docs/ciw-empresa-api-validacao.md`; Update C:`integration-src/abl/EmpresasCrudService.p`, C:`integration-src/container-panel/ContainersCabecalhoCrudService.p` e serviços de cada linha da matriz somente quando sua classificação exigir; canônicos M correspondentes são obtidos do mapeamento real de publicação, não adivinhados. Update fontes JSON de cada integração CIW efetivamente alterada e suas cópias B:`integrations/`.

**Interfaces:** matriz deve conter cada entidadeAPI publicada, operação, fonte, modo shared/company/record, campo de empresa no banco, regra para ID, artefato ABL canônico e probe de validação. Nenhuma célula não classificada permite ativar companyContext. Ferramenta prepare somente lê; apply futuro é guardado, assinado e altera exclusivamente vínculos/grants necessários após preflight.

- [ ] Exportar inventário técnico publicado sem credenciais. Inspecionar fontes por operação para preencher a matriz; distinguir domínio espec compartilhado de empresaERP e empresa do container. Conferir quantas entidades existem no momento, sem fixar total histórico28 como autoridade.
- [ ] Comprovar identificadores das empresas reais e conectividade efetiva pela mesma instância sursum-api/med. Opção sem domínio disponível fica desabilitada com causa registrada; completar toda parte independente, sem anunciar troca funcional dessa opção.
- [ ] Para cada API cujo contrato precise mudar, escrever probe RED de consulta/ID de outra empresa, gravação fora da empresa e lote misto; usar registros novos marcados para writes. Implementar validação reutilizável em include/rotina própria no motor-progress e referenciar pelos serviços, preservando cálculos e includes existentes.
- [ ] Ler skill motor-progress-publicar-pasoe e AGENTS/contextos M. Compilar no .42/OpenEdge12.2, publicar apenas fontes/rcode necessários na rota correta e validar PASOE real. Não trocar de instância. Erros desconhecidos/empresa ausente são falhas de negócio explícitas, não sucesso vazio como fallback.
- [ ] Cadastrar vínculos assinados e grants de uso por empresa comprovada para tadeu.parreiras, conservando permissões existentes. Configurar/classificar fontes e entidades via Builder oficial e publicar com recibos e backups; não liberar execução de processo antes não autorizado.
- [ ] Fazer teste integrado A/B nas operações suportadas: seleção/UI → contexto servidor → empresa aplicada no Progress → resultado e log. Usar leitura nos registros reais; writes só em massa nova identificada, com limpeza. Provar que cadastro local de módulo misto e módulo semAPI não mudam.
- [ ] Revisão independente final conforme requesting-code-review. Atualizar C/B/M contextos pertinentes com preparado/publicado/validado, matriz, hashes, limitações e recibos privados. Diferenciar opção suportada/testada de opção indisponível por ambiente.

## Saída e rollback

Concluir somente com prova da empresa aplicada no backend externo, além do rótulo visual. Se houver impedimento de conectividade, relatar exatamente opções verificadas e trabalho restante. Para rollback, desabilitar somente os novos vínculos/configurações e grants próprios, restaurar artefatos pelos hashes/backup e invalidar seleção operacional da sessão; preservar assinante, cadastros, histórico e alterações independentes.

## Revisão do plano

Cobertura: tipoAPI/módulo misto (tarefas1/3/4), vínculos/seleção (1/2), propagação/IDs/lotes (3/6), UI e concorrência (2/4), auditoria por empresa (5), publicaçãoProgress e matriz (6). Nenhuma implantação foi executada na preparação deste plano. Revisão deste documento e do plano de auditoria precede implementação.

## Correção prevalente de responsabilidade —21/10/2026
Usuário determinou que o construtor passe a empresa para a API, e a própria API trate tabelas/bancos. Não classificar tabelas nem operações como requisito do construtor. Contrato simplificado por entidade API: version/moduleId/adapter, um único adaptador para todas chamadas registradas. Configuração antiga operations somente compatibilidade. Ver docs/ciw-empresa-api-responsabilidades.md. A matriz histórica mantém o inventário, mas os modos planejados não devem ser ativados como exigência do construtor. Protótipo ABL ApiCompanyBoundary preparado/TT-compilado não publicado; suspender sua integração generalizada como dependência. Algumas rotas convertidas ainda têm parâmetros fechados/buffer fixo MED: confirmar contrato real antes de ativar e não alegar troca de empresa provada.
