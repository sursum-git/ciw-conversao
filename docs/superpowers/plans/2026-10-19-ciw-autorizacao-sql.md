# CIW — autorização SQL de Colorações — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:executing-plans para executar aqui, conforme escolha já fornecida. Steps use checkbox (- [ ]) syntax for tracking.

**Goal:** Autorizar Colorações pela origem SQL real, mantendo login Progress e vínculo explícito tcassimiro → thiago.cassimiro.

**Architecture:** O backend PHP resolve a sessão e o vínculo íntegro do assinante, confirma a identidade ativa no PASOE e consulta concessões SQL somente leitura. O leitor usa PDO_ODBC sobre túnel SSH até o próprio host SQL. A autorização legada não substitui permissões locais de negócio.

**Tech Stack:** PHP8.4/Symfony/Doctrine/PHPUnit, PDO_ODBC/ODBC Driver17, SSH/Paramiko, ABL/OpenEdge12.2, PASOE sursum-api/med.

**Spec:** [adendo aprovado em19/10/2026](../specs/2026-10-19-ciw-autorizacao-sql-design.md). Execução aqui preservada. Plano aprovado pelo usuário ("faça"); executado aqui. Publicado/validado tecnicamente; login humano e logout integrados pendentes.

## Global Constraints

- Conta do construtor e identidade Progress: `tcassimiro`, provedor `ima-user-web`.
- Sujeito de autorização CIW: `thiago.cassimiro`, sistema fixo 18; assinante Principal/default.
- Vínculo armazenado em `AuthUserSubscriber.metadata`, protegido pela integridade normal do cadastro e auditado.
- As decisões são lidas a cada chamada, sem copiar concessões para a sessão ou criar cache de permissões.
- Nenhuma conta/grant Progress ou SQL será criado/alterado. Não atribuir grupos/permissões locais por conveniência.
- Não modificar tasilpar/admin, frontend/Kendo, metadados de telas, schema, dados de negócio, outros provedores ou outras instâncias.
- Compilar no OpenEdge12.2/.42; publicar no compartilhamento137; validar exclusivamente sursum-api/med no111/9911. Nunca publicar .r12.8.
- Nenhuma nova chave ou senha SSH deve ser instalada ou persistida. Credenciais técnicas SQL somente em arquivo privado ignorado fora do webroot; nunca imprimir valores.
- Sem fallback permissivo, cache de grants ou bypass de priv_admin. Conta corrente fornecedor continua excluído.
- C=`D:/opencode/conversao-sc`; B=`D:/opencode/construtor-pg`; M=`D:/opencode/motor-progress/v2`. Preservar diffs concorrentes; sem commit/push neste lote, como nas etapas anteriores. C não é repositório Git.

## Review Focus

1. Resolver de token sozinho não garante expiração: tarefa3 testa sessão expirada/revogada e exige o fluxo de sessão atual do AuthService antes de qualquer leitura externa.
2. Login de origem e assinante podem diferir do tenant corrente: tarefa3 testa vínculo de outro assinante/tenant e origem forjada, sem selecionar metadados pelo request.
3. Flags divergentes entre grupos e linhas duplicadas: tarefa1 testa ordem invertida e composição independente de acesso/ação; decisão determinística sem depender de TOP1.
4. Queda/reconexão do túnel ou endpoint local ocupado: tarefa4 testa perda de transporte e processo alheio; falhar fechado, sem reconectar SQL diretamente ou encerrar processo de outro trabalho.
5. Ativação repetida ou conta preexistente incompatível: tarefa5 testa idempotência exata e conflito sem sobrescrever conta/vínculo ou deixar cadastro parcial.

## Organização e sequência

Dependências: 1 e2 →3; 1–3 →4 →5. Executar sequencialmente nesta sessão.
Preparar fontes ABL em C/integration-src/ciw-access e sincronizar somente os arquivos
pertinentes em M por hash/backup. PHP pertence a B; registrar candidatos/manifestos
em C/.runtime/ciw-authz-sql-20261019. Diagnósticos descartáveis anteriores não viram
dependências do produto.

Antes de editar B, ler CONTEXTO_PROJETO.md e docs/{arquitetura-crud-engine,padroes-ui-kendo,continuidade-codex}.md.
Antes de editar M, ler context/PROJECT_CONTEXT.md e aplicar motor-progress-publicar-pasoe.
Recolher baseline dos arquivos deste plano e somente dos recursos de configuração afetados.

## Tarefa1 — Leitura SQL e política de Colorações

**Arquivos B novos:** backend/src/Ciw/{CiwSqlConnectionConfiguration,CiwSqlGrantReaderInterface,PdoCiwSqlGrantReader,CiwColoracoesPolicy}.php.
**Testes novos:** backend/tests/Ciw/{CiwSqlConnectionConfiguration,PdoCiwSqlGrantReader,CiwColoracoesPolicy}Test.php; fixture sintética ciw-grants.php na mesma pasta.
**Modificar:** backend/config/services.yaml, apenas serviços/aliases novos.

**Interfaces:**
- `CiwSqlConnectionConfiguration::resolve(): array` retorna somente configuração validada de PDO_ODBC loopback, banco ticontrole, driver17 e timeout de1–10s. Caminho vem de `CIW_SQL_CONNECTION_FILE`, nunca de request.
- `CiwSqlGrantReaderInterface::read(string $subject, string $application): array` retorna `{active:bool, grants:list<array{access:string,insert:string,update:string,delete:string,export:string,print:string}>}`; conta ausente/inativa => active=false; ambiguidade => erro fechado. PDO não recebe sistema/tabela/SQL do chamador.
- `CiwColoracoesPolicy::applicationFor(string $action): string` e `allows(string $action, array $grants): bool` aceitam somente read,get,create,update,delete,export,print.

- [x] Escrever testes: read/export/print→grid_pub_coloracoes; get/create/update/delete→form_pub_coloracoes; read/get exigem acessoY; demais exigem acessoY e flagY correspondente. Flags null, vazio, N ou valores desconhecidos negam; ações extras geram400.
- [x] Testar união por flag entre grupos, duplicatas e ordem invertida: acessoY de um grupo e updateY de outro permitem update; só updateY sem acessoY nega. No helper legado linhas divergentes sobrescrevem flags sem ORDER BY; união determinística é a regra deste adendo, não alegar paridade com essa indeterminação. As linhas reais consultadas são todasY.
- [x] Rodar `C:/php-8.4.3/php.exe vendor/bin/phpunit tests/Ciw` em B/backend; preservar RED por classes ausentes, depois implementar política e configuração mínima.
- [x] Implementar leitor com duas consultas fixas parametrizadas: conta única ativa em s_users; concessões por s_users_groups.group_id→s_groups_apps.cod_programa→programas.cod_modulo→modulos, m.cod_sistema=18 e p.codigo correspondente. Não consultar pswd, usuario_ad ou priv_admin. Usar EXISTS para grupos evitando multiplicação por vínculos duplicados.
- [ ] Testar parâmetros separados do SQL, conta ativa Y, conta ambígua, sistema18 fixo, nenhum UPDATE/INSERT/DELETE, exceção PDO sanitizada503, timeout503, driver ausente503. Acrescentar teste de conexão real somente SELECT como verificação separada, sem fixture no banco real.
- [x] Repetir testes até GREEN. Config aceita exclusivamente loopback no túnel gerenciado; rejeita URL remota, host arbitrário, credencial em DSN fornecido pelo cliente, arquivo acima8KiB/ilegível e banco diferente. Não expor config em mensagem/trace serializado.

## Tarefa2 — Identidade Progress reutilizável

**Arquivos C novos:** integration-src/ciw-access/{CiwIdentityService,CiwIdentityBoundary,CiwIdentityRead,CiwIdentityServiceTest,CiwIdentityBoundaryTest}.p.
**Modificar C:** CiwAccessService.p, RunCiwAccessTests.p, CompileCiwAccessTests.p; testes existentes de acesso permanecem como regressão.
**Destinos M:** sursum-api/programs para os três fontes de produto; tests/abl/ciw-access para testes/runner/compilador.

**Interfaces:**
- `RUN CiwIdentityService.p(INPUT phUser AS HANDLE, INPUT poIdentity AS JsonObject, INPUT poPolicy AS JsonObject, OUTPUT poResponse AS JsonObject)`; identity={login,session_id,auth_provider}; policy={allowed_auth_providers}; sucesso={success:true,data:[{login,ima_user_id,usuario,tp_usuario}]}.
- `RUN CiwIdentityBoundary.p(INPUT poRequest AS JsonObject, INPUT poHeaders AS JsonObject, INPUT poConfig AS JsonObject, OUTPUT poIdentity AS JsonObject, OUTPUT poPolicy AS JsonObject, OUTPUT poResponse AS JsonObject)` valida token/config/headers internos e corpo fechado `{operation:"identify"}`. Somente ima-user-web autorizado na configuração aprovada.
- `CiwIdentityRead.p` tem assinatura JsonProgram `(INPUT poRequest AS JsonObject, OUTPUT poResponse AS JsonObject)` e será registrado como `ciw-identity`, sem senha e com token CIW interno existente.

- [x] Escrever TT para identidade ativa única, ausente, inativa/unknown, ambígua, origem local/admin, sessão vazia e schema incompatível. Testar preservação dos atributos opcionais atuais e ausência de credencial na resposta.
- [x] Rodar RED em12.2 antes de implementar; manter buffers clonados/NO-LOCK/limpezaFINALLY e comparação de login atuais. Extrair o bloco de identidade do CiwAccessService para o novo serviço; CiwAccessService passa a consumi-lo antes das concessões Progress, sem alterar contrato antigo.
- [x] Testar fronteira: token incorreto/ausente401, origem não permitida403, campos extras/array/tipos400, configuração500, identidade do corpo rejeitada. Criar wrapper com buffers físicos somente espec.user-web e destinos/config fixos, sem callback ao PHP.
- [x] Rodar runner em AMERICAN/EUROPEAN no12.2; exigir COMPILER:ERROR=no e todos os testes novos e regressões de acesso/autenticação PASS. Nenhum .r de compilador local publicável.

## Tarefa3 — Orquestrador autenticado PHP

**Arquivos B novos em backend/src/Ciw:** CiwSubjectResolver.php, CiwProgressIdentityClientInterface.php, CiwProgressIdentityClient.php, CiwAccessService.php.
**Novo:** backend/src/Controller/CiwAccessController.php.
**Testes:** backend/tests/Ciw/{CiwSubjectResolver,CiwProgressIdentityClient,CiwAccessService}Test.php; backend/tests/Controller/CiwAccessControllerTest.php.
**Modificar:** backend/config/services.yaml para aliases dos dois clientes e configuração privada.

**Interfaces:**
- `CiwSubjectResolver::resolve(RuntimeUserSession $session): string` devolve sujeito SQL a partir da conta ativa e do vínculo habilitado do assinante atual; assertAuthUserSubscriber e assertAuthSubscriber antes de ler metadata. Chave exata `ciwAuthorization={version:1,subject:"thiago.cassimiro",system:18}` no vínculo proposto.
- `CiwProgressIdentityClientInterface::assertActive(RuntimeUserSession $session): void` usa URL/config privada allowlisted da rota ciw-identity, token CIW e headers construídos da sessão. Não usa headers recebidos, redirect ou TLS sem validação. Resposta negativa/ambígua propaga recusa; falha externa503.
- `CiwAccessService::authorize(Request $request, array $payload): array` valida AuthService::currentSession($request), resolve a mesma sessão autenticada, vínculo, identidade Progress e concessões SQL. Sem fallback de sessão anônima do RuntimeSessionGuard.
- `CiwAccessController::authorize(Request $request): JsonResponse` em POST /api/ciw/access: aceita somente objeto operation=authorize,resource=cadastros.coloracoes,action permitida, limite16KiB; 400 inválido,401 sessão,403 recusa,503 indisponível. Sucesso `{success:true,data:[{resource:"cadastros.coloracoes",action:string,allowed:true,scope:"legacy_ciw"}]}`. Cache-Control:no-store.

- [x] Escrever testes RED com Progress tcassimiro e SQL thiago.cassimiro; conta local/admin negada mesmo com SQLpriv_adminY; sujeito, origem ou sistema forjados negados/ignorados antes da consulta; conta/vínculo desabilitado, assinatura inválida e assinante trocado negam.
- [ ] Testar sessão ausente, expirada, revogada e token de outra sessão: nenhuma chamada SQL/PASOE. Recarregar conta e vínculo a cada autorização; metadata da sessão não substitui vínculo persistido. Não presumir que resolver de token avalia status/expiração.
- [x] Implementar as interfaces acima reutilizando AuthService/currentSession, AuthenticatedSessionResolver, repositórios e StructuralIntegrityService. Cliente PASOE pode usar RuntimeExternalJsonClient com contexto servidor e sem dados secretos no payload; URL/token vêm somente da configuração privada existente estendida por validação allowlisted.
- [ ] Testar invocação sem self-HTTP PHP, código erro presente em envelope HTTP200 PASOE, timeout, logout, corpo extra/inválido e resposta sem token/credencial/sujeito SQL. Nenhum direito local de negócio acrescentado.
- [x] Rodar testes Ciw/Controller/Auth pertinentes e `bin/console lint:container`; exigir PASS e serviços resolvidos. Registrar RED/GREEN e hashes sem conteúdo de conexão.

## Tarefa4 — Transporte gerenciado e publicação técnica

**Arquivos C novos:** tools/construtor-local/ciw-sql-tunnel.py, configure-ciw-sql-environment.py, prepare-ciw-identity-runtime.py.
**Modificar C:** tools/construtor-local/restart-backend.ps1, sincronizador CIW delimitado para os novos artefatos.
**Estado privado novo:** .runtime/ciw-authz-sql-20261019/{sql-connection.json,identity-connection.json,compile,publish,transport-evidence.json}; segredos não versionados e não servidos via HTTP.

- [x] Criar testes sem rede para validação de destino fixo, hostkey obrigatória, bind somente127.0.0.1, falha de bind/queda e fechamento de canais/threads em finally. RED antes do gerenciador; reutilizar comportamento do mecanismo de túnel/prova, sem depender dos scripts descartáveis em produção.
- [x] Implementar túnel SSH ao170 com destino no próprio170:1433 e porta local fixa19933, timeout de conexão15s/keepalive30s; getpass protegido ou chave já autorizada, sem gravar senha humana. Confirmar dono da porta; conflito aborta sem matar processo. Estado público do processo contém PID/porta/host, nenhum segredo.
- [x] Preparar conexão SQL técnica a partir da configuração existente por leitura remota protegida; validar destino/base antes de salvar somente no arquivo privado aprovado. Restringir ACL do arquivo ao usuário do backend. Nunca imprimir resposta bruta ou secret em argv/env/log. Configuração fica indisponível se a ACL não puder ser aplicada.
- [x] Ajustar reinício guardado do backend para carregar `php_pdo_odbc.dll` somente no processo, preservando todas opções atuais. Detectar extensão já carregada para não duplicar. Verificar PID/porta/router antes de parar; regressão com processo alheio deve abortar sem encerrá-lo.
- [x] Compilar12.2/publicar os três fontes de identidade e CiwAccessService refatorado com .r coerentes. Cadastrar somente a nova rota ciw-identity pelo mecanismo de registro existente, com backup/guard, sem substituir configuração geral. Seguir skill PASOE, recarga apenas necessária e restrita a med.
- [x] Configurar URLs/token por caminho privado no backend, validar DI e SELECT real com o túnel ativo. Exigir negativas PASOE token/origem/corpo e regressões do antigo ciw-access; verificar manifests/hashes dos artefatos carregados. Não alterar configuração global do PHP/truststore/PASOE.

## Tarefa5 — Cadastro governado, ativação e validação real

**Arquivos B novos:** backend/src/Ciw/CiwIdentityRegistration.php; backend/src/Command/ConfigureCiwIdentityCommand.php; backend/tests/Ciw/CiwIdentityRegistrationTest.php; backend/tests/Command/ConfigureCiwIdentityCommandTest.php.
**C novos:** tools/construtor-local/verify-ciw-sql-real-access.cjs; docs/integracao-ciw-autorizacao-sql-validacao.md.
**Atualizar:** spec/estado deste plano, docs/integracao-ciw-auth-validacao.md, context/PROJECT_CONTEXT.md, context/RETOMADA_2026-10-16.md; contextos canônicos pertinentes preservando histórico concorrente.

**Interfaces:** `CiwIdentityRegistration::register(): array` cria exclusivamente a combinação aprovada, sem parâmetros que aceitem outra conta; comando `app:auth:configure-ciw-identity --apply` usa serviço. Sem --apply, mostra somente plano sanitizado e não escreve. Resultado contém username/subscriber/created/unchanged, nenhum segredo.

- [x] Escrever RED: conta ausente cria AuthUser tcassimiro/default ativa, auth_source ima-user-web, passwordHash=null, groups=[],permissions=[] e AuthUserSubscriber default habilitado/defaultSubscriber=true com metadata da tarefa3. Normalização via setters de AuthUser; tenant/subscriber ativos e provedor íntegro obrigatórios.
- [ ] Testar idempotência exata; qualquer conta existente incompatível, outro vínculo/default ou metadata concorrente aborta409, sem sobrescrever. Falha de assinatura/auditoria desfaz transação inteira; testar duas ativações concorrentes com unicidade normal. Não usar reflexão, SQL direto, reseed ou regravar assinaturas antigas.
- [x] Implementar cadastro via EntityManager::wrapInTransaction, RuntimeTransactionService e StructuralIntegrityService::signAuthUserSubscriber para o vínculo novo; auditoria operacional mínima antes/depois. AuthUser não possui método signAuthUser: preservar o contrato atual, sem inventar assinatura/reflexão. O comando deve confirmar previamente identidade Progress ativa e sujeito SQL ativo com concessão real antes de gravar.
- [x] Rodar GREEN e suíte PHP completa uma vez; repetir somente se houver alteração/falha nova. Aplicar comando governado já coberto pelo desenho, guardar recibo sanitizado. Não atribuir permissões locais adicionais para tornar a tela visível.
- [ ] Disponibilizar o login existente para entrada humana de tcassimiro, sem senha no chat. Após autenticação, confirmar ator e assinante por API, executar authorize/read e demais ações somente como consultas de decisão; capturar ALLOW real e negativas sem escrever negócio.
- [ ] Executar logout da própria sessão de teste e comprovar401 no mesmo endpoint. Indisponibilidade/tampering/sem vínculo negativos cobertos sem alterar contas do usuário. Se não houver entrada humana, registrar implementação/publicação e positivo/logout pendentes; não concluir1A.
- [x] Atualizar memória e relatório distinguindo compilado/publicado/validado, consulta legada versus acesso de negócio, e concessões Progress versus SQL. Registrar reversão com desativação somente do novo vínculo, encerramento do túnel próprio e restauração guardada dos artefatos deste lote. Preservar outros trabalhos e sessões.

## Revisão interna e condição de encerramento

Cobertura conferida contra o adendo: origem SQL, vínculo explícito, identidade ativa,
transporte protegido, integridade, sessão, ausência de cache/bypass, testes reais e
reversão possuem tarefas. União entre grupos é decisão explícita e testada;
nenhuma paridade indefinida com ordenação incidental é prometida. As cinco classes
do Review Focus estão vinculadas a testes. Não há frontend, escrita comercial ou
concessão local de negócio neste lote. Fase1A só encerra com positivo real e logout
comprovados, mantendo a cadeia de permissões de negócio como obrigação dos endpoints.
