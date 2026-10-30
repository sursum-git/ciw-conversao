# CIW fase1A — identidade e permissões — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Disponibilizar resolução de identidade e autorização IMA somente leitura, reutilizável pelos novos cadastros CIW, sem habilitar novas escritas de negócio.

**Architecture:** A sessão existente fornece login e origem de autenticação pelo transporte PHP confiável. Wrapper ABL autenticado mapeia recurso fechado para aplicações legadas e chama serviço central sobre user-web, usuarios_grupos e grupos_aplicacoes. A verificação combina a permissão do construtor, exigida por seus endpoints, com a autorização IMA; não concede permissão onde uma das camadas nega.

**Tech Stack:** PHP8.4/Symfony, ABL/OpenEdge12.2, PASOE sursum-api/med, JSON/Sursum, PHPUnit e testes ABL TT existentes.

**Spec:** [fase1 aprovada](../specs/2026-10-16-ciw-fase1-design.md), resposta explícita “Aprovar o desenho da primeira fase”. Este plano entrega somente1A; cadastros1B–1J serão planos próprios na sequência aprovada.

**Estado atual:** tarefas3/4 publicadas e11negativosPASOE passaram;238checks/cultura12.2. Tarefa1/origem e tarefa5/caso positivo integrado permanecem pendentes. Lista de provedores vazia nega tudo.

**Execução:** plano aprovado pelo usuário com “Aprovar e executar aqui”. Etapa2/PHP concluída; demais estados e acesso remoto em [validação](../../integracao-ciw-access-validacao.md) e no ledger privado. Não solicitar novamente aprovação deste plano.

## Global Constraints

- Reutilizar `production/app.html`, CrudEngine, modo batch, autenticação, transporte API, auditoria e Builder do construtor-pg.
- Nenhuma gravação ao abrir tela. Esta entrega1A não cria telas, dados de negócio, usuários, grupos ou concessões.
- Não converter “Conta corrente fornecedor” enquanto vigorar a exclusão do usuário.
- Não criar concessão gerencial ou privilégios IMA por correspondência implícita de números internos.
- Parâmetros IMA consumidos pela include central, NO-LOCK e sem cache. Identidade e permissões desta entrega também são verificadas por solicitação, sem cache de usuários.
- Não alterar kendo/vendor, schema, reseed, reassinatura ou definições assinadas. Não criar commit/push; preservar diffs atuais.
- Compilar no OpenEdge12.2 do192.168.0.42; publicar somente o lote pertinente e validar no PASOE real **sursum-api/med**. Não usar outra instância como fallback.
- Credenciais por entrada protegida, sem argumentos de processo, fontes ou memória de projeto.

## Review Focus

1. Header configurado ou payload tenta trocar login/origem: transporte sobrescreve identidade com sessão ativa; wrapper recusa campos extras (tarefas2/4).
2. Login local com nome igual a usuário IMA: sem origem autenticadora explicitamente autorizada, negar; coincidência de nome não autentica no IMA (tarefas2/3/4).
3. Usuário ausente/inativo, cadastro duplicado, grupo sem permissão ou flag desconhecida: negar, sem fallback administrativo (tarefas1/3).
4. Duas aplicações legadas consolidadas em uma tela: consulta e formulário conservam permissões próprias; um grant de leitura não autoriza escrita (tarefas1/3).
5. Sessão expirada/revogada ou revogação IMA entre duas chamadas: não reutilizar decisão anterior; nenhuma nova transação de negócio (tarefas2/5).

## Organização

Raízes: C=`D:/opencode/conversao-sc`, B=`D:/opencode/construtor-pg`, M=`D:/opencode/motor-progress/v2`. Ler AGENTS/contextos e preservar os checkouts com as alterações existentes. Não partir de um worktree que perca integrações não commitadas. Se houver necessidade real de isolamento, seguir using-git-worktrees antes de executar.

Ordem:1→2→3→4→5. Execução aqui aprovada pelo usuário; revisão independente final conforme skill, sem criar novos chats. Recomenda-se execução pelo agente atual porque transporte, contrato e wrapper compartilham a mesma cadeia de confiança. As tarefas incluem testes RED→GREEN e autorrevisão; revisão independente final conforme skill de execução escolhida, sem presumir autorização para criar novos chats.

### Tarefa1 — Fechar contrato físico e mapa de recursos

**Files:** C:`integration-src/ciw-access/{contract.json,legacy-reference.json,schema/}`; C:`tools/construtor-local/inspect-ciw-access-schema.py`. Ler C:`sources/scriptcase/phase1/{bl_tela_login,app_login,bl_permissoes,bl_getProgUsuario}/`; reaproveitar dicionários em `integration-src/iol-pagina-inicial-gerencial/schema/iol-schema.json`.

**Interfaces:** `contract.json` define o objeto privado `identity{login,auth_provider,session_id}`, os recursos/ações permitidos, os DTOs/erros abaixo e o mapa de aplicações. `schema/` confirma campos e índices físicos sem copiar registros de usuários. `legacy-reference.json` identifica caminho ativo, funções e linhas; diferencia origem de autenticação e resolução de identidade.

- [x] Conferir hashes dos131fontes de análise com o manifesto. Registrar hashes dos arquivos canônicos a tocar, sem gravar diffs de configurações privadas.
- [x] Confirmar dicionários/índices de `espec.user-web`, `espec.usuarios_grupos` e `espec.grupos_aplicacoes` pelo compilador12.2. Campos mínimos: Login,ativo,id,usuario,tp-usuario; login_usuario,cod_grupo; nome_aplicacao,cod_grupo,acesso_permitido,insercao_permitida,alteracao_permitida,exclusao_permitida,exportacao_permitida,impressao_permitida. Não assumir índice único só pelo nome.
- [ ] Rastrear bl_tela_login→validarLogin→getDadosUserWeb→aplicarPermissoesSC e distinguir app_login/LDAP/s_users. Registrar qual configuração autenticadora poderá ser usada na validação real; não ativar LDAP nem alterar contas nesta tarefa. Se depender de acesso indisponível, registrar o bloqueio e continuar apenas as tarefas independentes.
- [x] Fixar o recurso inicial `cadastros.coloracoes`: read→grid_pub_coloracoes, get/create/update/delete→form_pub_coloracoes; export/print→grid_pub_coloracoes. Demais recursos desta entrega recusados. O mapa é privado e versionado; request não escolhe aplicação ou tabela.
- [x] Fixar enum de ações read,get,create,update,delete,export,print; erros `CIW_IDENTITY_REQUIRED`401, `CIW_IDENTITY_NOT_LINKED`403, `CIW_IDENTITY_INACTIVE`403, `CIW_IDENTITY_AMBIGUOUS`409, `CIW_AUTH_SOURCE_DENIED`403, `CIW_ACCESS_DENIED`403, `CIW_ACCESS_INVALID_REQUEST`400 e `CIW_ACCESS_CONFIGURATION`500.
- [x] Revisar contrato contra as duas fontes legadas e dicionário. Saída não contém senha, email, lista completa de usuários ou configuração LDAP. Bloquear a implementação dependente se campos físicos ou origem ativa contradisserem o contrato; corrigir o contrato com evidência antes de prosseguir.

### Tarefa2 — Encaminhar origem de autenticação sem permitir falsificação

**Files:** B:`backend/src/Runtime/RuntimeExternalJsonClient.php`; B:`backend/tests/Runtime/RuntimeExternalJsonClientTest.php`; documentação B:`backend/docs/ciw-access-context.md`.

**Interfaces:** `RuntimeExternalJsonClient::request(string $url,string $method,array $headers,mixed $payload,int $timeoutSeconds,array $context=[]):array` mantém assinatura. Para responseContract=sursum-programs, remover variações case-insensitive de `X-Sursum-User`, `X-Session-Id`, `X-Sursum-Auth-Source`; repor apenas valores da sessão ativa. Origem vem de `RuntimeUserSession::getSessionProperties()['authentication']['provider']`; nunca do payload/context/configuração da fonte. Sem origem confiável, omitir o novo header; wrappers antigos continuam ignorando-o.

- [x] Escrever testes para headers forjados com capitalizações diferentes, sessão ausente/expirada, provider ausente e duas sessões com origens diferentes. Verificar que endpoints generic não recebem alteração de contrato e headers atuais continuam com os valores da sessão.
- [x] Rodar PHPUnit filtrando RuntimeExternalJsonClientTest; demonstrar RED para origem ainda não protegida/encaminhada.
- [x] Implementar somente a adição protegida do header, sem alterar login, provedores, permissões ou payload de negócio. Não fazer fallback de source com base no username.
- [x] Reexecutar o teste e AuthSecurityHardeningTest/PermissionResolverTest existentes. Usar `C:/php-8.4.3/php.exe backend/vendor/bin/phpunit` no checkoutB; exigir zero falhas/avisos novos.

### Tarefa3 — Serviço ABL reutilizável de identidade e autorização

**Files:** C:`integration-src/ciw-access/CiwAccessService.p`; `CiwAccessServiceTest.p`; `RunCiwAccessTests.p`; `CompileCiwAccessTests.p`; M:espelhos de produto em `sursum-api/programs/` e testes em `tests/abl/ciw-access/` após validação/guard.

**Interfaces:** serviço com INPUT handles confiáveis de user-web,usuarios_grupos,grupos_aplicacoes; INPUT JsonObject `identity`; INPUT JsonObject `policy{allowed_auth_providers,legacy_application,action}`; OUTPUT JsonObject. Handles/policy são fornecidos pelo wrapper, nunca por JSON HTTP. Retorno de sucesso `success=true,data:[{login,ima_user_id,usuario,tp_usuario,legacy_application,action,allowed:true}]`; erro usa envelope Sursum e códigos da tarefa1.

- [x] Criar fixtures TT undoable sem campos de credencial. Testar usuário existente/ativo, ausente, inativo/unknown, correspondência ambígua, origem não autorizada, ausência de identidade, múltiplos grupos e ausência de grant. Usar logins fictícios marcados para teste apenas em TT.
- [x] Testar read/get com acesso Y; escrita requer acesso Y e a flag da ação na aplicação correspondente. Grants válidos de grupos associados ao mesmo login/aplicação são combinados por OR por flag; flags ausentes/unknown/outras strings não concedem direito. priv_admin não dispensa vínculo/grant nem cria autorização por si.
- [x] Testar que grupo com grant apenas na grid não permite criar pela aplicação de formulário; export/print exigem seus flags. Nenhuma busca permite aplicar grants de outra aplicação.
- [x] Rodar o runner em staging12.2 e registrar RED antes do serviço. Não contar compilação12.8 como validação.
- [x] Implementar serviço NO-LOCK, sem cache, writes, sequências, consulta de senha ou matemática de negócio. Normalização usa a semântica do Login físico confirmada na tarefa1; não cortar caracteres silenciosamente nem retornar a primeira correspondência ambígua.
- [x] Rodar testes nas culturas AMERICAN/EUROPEAN, exigir PASS e COMPILER:ERROR=no. Contrato de snapshot de identidade por chamada não promete serializar revogações concorrentes ou impedir mudanças após a decisão; o writer futuro deve verificar autorização em sua própria entrada.

### Tarefa4 — Wrapper de leitura fechado e autenticado

**Files:** C:`integration-src/ciw-access/CiwAccessRead.p`, `CiwAccessBoundaryTest.p`, `CiwAccessRead.md`; candidato de rota `POST /SursumPrograms/ciw-access`; M:espelho após guard. Configuração pública exemplificada sem segredo; configuração real apenas privada/ignorada.

**Interfaces:** ABI INPUT/OUTPUT JsonObject. Body fechado `{operation:"authorize",resource:"cadastros.coloracoes",action:<enum>}`. Identidade obtida de `HTTP_X_SURSUM_USER`, `HTTP_X_SESSION_ID`, `HTTP_X_SURSUM_AUTH_SOURCE`, apenas após validar `X-CiwAccess-Token` contra SHA256 privado. Configuração fixa `sursum-conf/ciw-access.json` contém tokenSha256 e allowedAuthProviders; lista vazia ou inválida nega, sem padrão local/admin. Pode ser consumido internamente por wrappers posteriores usando o mesmo serviço, sem segunda cópia de regra.

- [x] Escrever boundary tests para token ausente/incorreto, campos extras login/user/provider/table/application, operation/resource/action desconhecidos, arrays em vez de objeto e falta de headers confiáveis. Esperar401/400/403 conforme contrato.
- [x] Demonstrar RED, implementar validação e mapa fechado da tarefa1; criar buffers físicos fixos e liberar handles/objetos em FINALLY. Erros de configuração não expõem conexão/caminhos/credenciais ao browser.
- [x] Não registrar entidade de usuários nem tela de permissões. Não atribuir source local à allowlist para fazer admin passar em teste. Não ativar metadados de escrita dos cadastros nesta entrega.
- [x] Executar a suíte completa do domínio em12.2 e conferir erro/status/envelope. Garantir que wrapper e serviço são readonly e não incorporam segredo ou nome de tabela controlável pelo request.

### Tarefa5 — Publicar, validar e registrar entrega1A

**Files:** C:`tools/construtor-local/{compile-ciw-access.ps1,publish-ciw-access.py,verify-ciw-access.cjs}`; C:`docs/integracao-ciw-access-validacao.md`; manifests/evidências privados em `.runtime/ciw-access-20261016/`; atualização de inventário/contextos; M:fontes/rota pertinentes, mesclados e com guards.

**Interfaces:** manifesto fonte→compilado→destino com hashes antes/depois; evidência sanitizada `authentication_context`, `cases`, `businessWrites:false`. Scripts usam entradas protegidas e known_hosts; testes de acesso não criam registros reais.

- [x] Executar skill motor-progress-publicar-pasoe. Conferir acessos ao compilador42/runtime111 por chave/sessão/entrada protegida; nunca reutilizar senha de outro host por suposição. Compilar o lote atual em staging12.2 e baixar logs/artefatos; erro/status/PASS devem ser explícitos.
- [x] Rodar PHPUnit pertinente e lint dos arquivos PHP tocados. Verificar diff/hash dos canônicos e preservar alterações anteriores. Não fazer commit/push nem atualizar assinaturas manualmente.
- [x] Preparar configuração privada e backup; publicar somente wrapper/serviço .p/.r/config pertinente e rota mesclada em sursum-api/med. Não publicar testes, fixtures ou fontes sanitizados de análise. Ativar de forma controlada sem reiniciar outras instâncias.
- [ ] Validar PASOE real: token inválido, headers ausentes/forjados, origem não autorizada, login sem vínculo, usuário autorizado e ação negada. Para caso positivo, usar sessão real do provedor IMA confirmado; se essa sessão/configuração não estiver disponível, manter caso positivo e1A pendentes, sem alegar conclusão nem ampliar permissão como fallback.
- [ ] Repetir uma autorização após revogação controlada somente em TT; validação real não modifica grupos/usuários. Confirmar sessão revogada/expirada no transporte e ausência de cache de decisão.
- [x] Conferir metadados das16telas existentes e regressões pertinentes ao transporte; nenhuma permissão/tela de escrita é habilitada pela rota de diagnóstico.
- [ ] Registrar separadamente preparado/compilado/publicado/validado e atualizar inventário. Encerrar1A somente se houver prova do caso positivo real e dos negativos; em seguida detalhar1B/Colorações conforme desenho aprovado, mantendo Conta corrente fornecedor fora da fila funcional.

## Autorrevisão e próximo passo

Plano limitado a1A: cinco tarefas com contratos e dependências definidos, cinco classes de falha vinculadas aos testes, publicação real obrigatória e acesso/identidade ausente tratados como bloqueios concretos. As etapas1B–1J não são declaradas implementadas ou planejadas em detalhe por este documento. Não houve código de produto, configuração de autenticação ou publicação nova na preparação.

O usuário aprovou este plano e escolheu o agente atual. Continuação segue pelo ledger e pelos resultados de execução; a informação externa pendente é o provedor/sessão real IMA; SSH já liberado nesta sessão. Sem nova aprovação genérica entre tarefas.
