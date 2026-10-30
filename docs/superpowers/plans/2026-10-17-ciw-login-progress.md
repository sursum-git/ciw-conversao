# CIW — login Progress de bl_tela_login — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:executing-plans para implementar aqui, conforme preferência já fornecida. Steps use checkbox (- [ ]) syntax for tracking.

**Goal:** Conferir a credencial em espec.user-web e emitir a sessão normal do construtor com origem ima-user-web, sem persistir senha.

**Architecture:** Provedor estende AuthProviderInterface e usa cliente interno dedicado. Handler PASOE /CiwAuthentication chama serviço ABL somente leitura, sem enviar credenciais ao roteador/auditoria genéricos. Autorização posterior permanece no CiwAccessService.

**Tech Stack:** PHP8.4/Symfony/cURL/PHPUnit; ABL/OpenEdge12.2; PASOE sursum-api/med.

**Spec:** [desenho complementar aprovado](../specs/2026-10-17-ciw-login-progress-design.md). Resposta: “Aprovar o desenho complementar”. Execução aqui já escolhida; aguardar somente revisão deste plano, sem pedir novamente o método.

## Global Constraints

- Entrada escolhida: bl_tela_login. Não integrar app_login/s_users/LDAP neste lote.
- Reutilizar AuthService, login, sessão/tenant/assinante, expiração e logout atuais.
- Não copiar senha para PostgreSQL, sessão, logs, metadados, arquivos ou respostas.
- Não alterar usuários/senhas/grupos/grants/schema Progress. Não provisionar contas.
- Conta local ativa precisa de vínculo explícito; não migrar admin/tasilpar ou outras contas automaticamente. Browser não escolhe provedor.
- Endpoint/token apenas privados no servidor; token distinto da API CIW e PASOE com somente SHA256. Sem redirect ou TLS sem verificação.
- Nenhum frontend paralelo, Kendo/vendor, schema, reseed, commit/push ou reassinatura manual/em massa. Cadastro novo pelo serviço governado.
- Compilar no12.2/.42, publicar somente sursum-api/med no111/compartilhamento137.
- Preservar diffs concorrentes. C=conversao-sc, B=construtor-pg, M=motor-progress/v2, todos em D:/opencode; ler seus AGENTS/contextos.
- Sem testes que escrevam negócio ou criem/alterem contas/grants Progress. Conta corrente fornecedor permanece excluído.

## Review Focus

1. JSON inválido/exceção com senha nunca grava corpo original ou segredo (tarefas2/3/5).
2. Conta local/admin ou tenant trocado não vira identidade IMA por nome/provider do request (tarefas3/4).
3. Normalização de acento com colisão nega; senha com caixa, apóstrofo, Unicode e espaços preserva todos os bytes (tarefa1).
4. Configuração/URL alterada, redirect ou timeout negam sem fallback local/outro host (tarefas3/4).
5. Token de integração não é sessão; origem vem de autenticação efetiva, e logout/expiração impedem autorização (tarefas3/5).

## Organização dos arquivos

C: fontes preparados em integration-src/ciw-auth/; evidências ignoradas em .runtime/ciw-auth-20261017/. Dependências:1→2→3→4;1–4→5.

M novos: sursum-api/programs/CiwAuthenticationService.p; sursum-api/sursum/CiwAuthenticationBoundary.cls; sursum-api/rest/CiwAuthenticationWebHandler.cls. Testes em tests/abl/ciw-auth/: CiwAuthenticationServiceTest.p, CiwAuthenticationBoundaryTest.p, RunCiwAuthenticationTests.p, CompileCiwAuthentication.p, ReadCiwAuthenticationSchema.p.

B novos em backend/src/Auth/: ImaUserWebAuthProvider.php, ImaUserWebClient.php, ImaUserWebClientInterface.php, ImaUserWebProviderConfiguration.php, ImaUserWebProviderRegistration.php. Novo backend/src/Command/ConfigureImaUserWebProviderCommand.php. Testes em backend/tests/Auth/: ImaUserWebAuthProviderTest.php, ImaUserWebClientTest.php, ImaUserWebProviderConfigurationTest.php, ImaUserWebProviderRegistrationTest.php e fixtures/ima-user-web.php.

B alterações delimitadas: backend/config/services.yaml; backend/src/Auth/AuthService.php (supportedTypes somente); backend/src/Admin/AdminCrudDefinitionFactory.php (opção de origem); testes auth/admin pertinentes. Não mudar resolveCredentialProviderCode para aceitar provider do payload.

## Tarefa1 — Serviço ABL e contrato físico

**Interfaces:** RUN CiwAuthenticationService.p(INPUT phUser AS HANDLE, INPUT poCredentials AS JsonObject, OUTPUT poResponse AS JsonObject).
Entrada fechada: {operation:"authenticate",username:string,password:string}.
Sucesso: {success:true,data:[{login:string}]}. Credencial inválida/ausência/inatividade/ambiguidade: INVALID_CREDENTIALS/401 com mensagem genérica. Configuração indisponível: AUTH_PROVIDER_UNAVAILABLE/503; entrada/tipos/limites inválidos: AUTH_INVALID_REQUEST/400.

- [x] Criar probe somente de dicionário de Login,senha,ativo em espec.user-web; executar no12.2 sem valores/usuários. Expected: CHARACTER/CHARACTER/LOGICAL escalares e índice de Login confirmados. Discrepância bloqueia código dependente.
- [x] Escrever testes TT: activeUserAuthenticates retorna só login; invalidCases exige401 uniforme para ausente/inativo/unknown/duplicado/senha errada; passwordExactBytes cobre a/A, apóstrofo, acento, espaços e vazio; normalizedLoginCollision nega duas correspondências.
- [x] Compilar/executar runner antes do serviço. Expected RED: FAIL por serviço ausente com testes sintaticamente válidos; preservar evidência.
- [x] Implementar handles privados clonados, query NO-LOCK e normalização somente do login pelo mapa explícito retirarAcentoSimples da fonte. Comparação sem caixa sobre login normalizado, uma única correspondência; senha inteira por RAW+tamanho, sem SQL/trim/remoção de apóstrofo/acento/caixa.
- [x] Limites: username1–160caracteres, password1–1024bytesUTF8, sem truncamento. FINALLY limpa objetos/handles, nenhuma mensagem ecoa credencial.
- [x] Rodar nas culturas AMERICAN/EUROPEAN no12.2. Expected: todas fontes COMPILER:ERROR=no, PASS e contagens TT preservadas.

## Tarefa2 — Fronteira e handler sem corpo em logs

**Interfaces:** CiwAuthenticationBoundary:authenticate(INPUT pcMethod AS CHARACTER, INPUT pcToken AS CHARACTER, INPUT pcBody AS LONGCHAR, INPUT poConfig AS JsonObject, INPUT phUser AS HANDLE, OUTPUT piStatus AS INTEGER) RETURNS JsonObject. Config privada {tokenSha256:string}. Handler IWebHandler com HandleRequest() RETURNS INTEGER; somente POST /CiwAuthentication.

- [x] Escrever BoundaryTest: token ausente/incorreto401; GET/OPTIONS405; JSON inválido/array/campos extras/tipos/limites400; configuração503; resposta sem password/token/request.
- [x] Executar RED no12.2, depois implementar validação e chamada à interface da tarefa1. Expected: falha por componente ausente antes de implementar, depois PASS.
- [x] Implementar handlerUTF8 via memptr, limite16KiB antes do parse, token CGI HTTP_X_CIW_AUTH_TOKEN, arquivo fixo sursum-conf/ciw-authentication.json, Cache-Control:no-store. Não oferecer CORS para browser.
- [x] Não usar JsonProgramRouter/WebHandler genéricos, que gravam request. Não registrar corpo, querystring, headers ou exceção bruta; ator ainda não autenticado não vem de username/user/provider do cliente.
- [x] Se usar auditoria de execução, passar somente tipo authenticate, correlação criada no servidor, duração e sucesso/falha. Spy de auditoria recusa marcador de senha em qualquer persistência, em sucesso, parse inválido ou exceção. Expected: somente campos permitidos, nenhum request original.
- [x] Compilar classes/serviço/testes com PROPATH explícito/OpenEdge.Net.pl12.2 e executar duas culturas. Expected: COMPILER:ERROR=no e PASS, handler/roteador genéricos preservados.

## Tarefa3 — Cliente privado e provedor PHP

**Interfaces:** ImaUserWebClientInterface::authenticate(string $username,string $password): string retorna login canônico. ImaUserWebClient implementa via cURL sem cliente de fontes/profiler.
ImaUserWebAuthProvider implementa AuthProviderInterface, supports somente type ima-user-web.
ImaUserWebProviderConfiguration::resolve(): array retorna {url,token,timeoutSeconds} do arquivo privado indicado pela variável do servidor CIW_AUTH_CONNECTION_FILE, preparado em C/.runtime/ciw-auth-20261017/connection.json. Variável/caminho não são aceitos do request.

- [x] Escrever PHPUnit/fixtureHTTP com senhas sintéticas: clientMapsMinimalResponse; clientDeniesRedirectAndMalformedReply; clientTimeoutSanitized; clientRejectsUnexpectedOrigin. Assert só login, nenhum segredo no erro e nenhuma segunda chamada após302. Executar RED por classes ausentes.
- [x] Implementar POST fixo/JSON fechado, header X-Ciw-Auth-Token, resposta≤16KiB, connectTimeout3s/total10s, followlocation=false, verifyPeer/verifyHost ativos. Config produtiva aceita somente https://192.168.0.111:9911/med/web/CiwAuthentication ou http://127.0.0.1:19910/med/web/CiwAuthentication pelo túnelSSH documentado; sem query/fragment/userinfo/outros destinos. Fixture de teste usa transporte isolado, sem abrir essa permissão na produção.
- [x] providerRequiresExistingActiveBoundAccount exige conta ativa do tenant com auth_source=ima-user-web. Mesmo nome local, provider forjado, outro tenant e identidade divergente negam. Grupos/permissões vêm da conta local; sem priv_admin/grupos/IDs numéricos IMA→PG.
- [x] Implementar provedor com AuthUserRepository e cliente; verificar login canônico contra vínculo, montar AuthenticatedUser/source=config.code. Não atualizar auth_source/password_hash nem criar conta no authenticate.
- [x] Teste de identidade: conta ciw_test e retorno CIW_TEST correspondem sem distinção de caixa; conta other_test nega. Preservar username da conta para referências PG/assinante, exigindo equivalência exata sem caixa ao login canônico IMA. Não criar aliases implícitos de logins distintos.
- [x] Integrar tag app.auth_provider em services.yaml, supportedTypes em AuthService e enum administrativo. Testes loginServiceIgnoresPayloadProvider e sessionProviderComesFromVerifiedLogin atravessam AuthService com repositórios controlados, sem fabricar sessão como prova de autenticação.
- [x] Rodar phpunit --do-not-cache-result nos testes novos, AuthSecurityHardeningTest, transporte e permissões; depois suítePHP completa e lint canônicos. Expected: zero falhas/avisos, nenhuma senha em AuthenticatedUser/sessionProperties ou mensagens.

## Tarefa4 — Cadastro governado, inicialmente desabilitado

**Interfaces:** comando app:auth:configure-ima-user-web chama ImaUserWebProviderRegistration::register(bool $enable=false): AuthProviderConfig. Usar AuthProviderConfigRepository, EntityManager e StructuralIntegrityService para cadastro/alteração normal desse registro novo, sem reseed ou reassinatura de outros cadastros. Auditoria pelo RuntimeTransactionService::beginOperational/log/success/fail registra somente código, tipo e enabled anterior/atual, com origem CLI declarada, sem se apresentar como sessão de usuário. URL/token continuam no arquivo privado.

- [x] Escrever testes registerCreatesOnlyDisabledProvider: code/type ima-user-web, name "IMA — usuário Progress", enabled=false e config sem segredo; registerIdempotentWithoutChanges não regrava; registerConflictingTypeDenied não substitui outro provedor.
- [x] Executar RED e implementar register/comando. Apenas --enable explícito permite habilitar, após dependências publicadas/testadas; saída só informa estado público. Teste prova que nenhum usuário, grupo, permissão, assinante ou password_hash é alterado pelo cadastro.
- [x] Vínculo de conta passa pelo CRUD administrativo existente, após indicação explícita da conta pelo usuário. Não escolher admin/tasilpar ou criar conta/grants Progress para forçar prova.
- [x] Preparar provedor desabilitado; não executar --enable nem alterar conta sem condições de ativação. Expected: extensão pronta para teste, login local atual preservado.

## Tarefa5 — Revisão, publicação e prova real

**Files C:** tools/construtor-local/prepare-ciw-auth-compile.py, publish-ciw-auth.py, verify-ciw-auth.cjs; docs/integracao-ciw-auth-validacao.md; manifests/evidências privados em .runtime/ciw-auth-20261017/.

- [x] Revisão independente única fresh-context do lote conforme executing-plans; implementação aqui. Achados materiais corrigidos por RED→GREEN, regressões pertinentes repetidas. Sem commit/push.
- [x] Gerar token novo somente em memória/arquivo ignorado; compilar lote atual12.2/.42 e comprovar hashes fonte→.r→destino, PASS nas culturas. Seguir skill motor-progress-publicar-pasoe; nunca publicar .r12.8 ou fixtures.
- [x] Backup/hash e publicação delimitada de serviço/classes/config; mesclar apenas /CiwAuthentication no ROOT.handlers de sursum-api/med. Resolver PROPATH e ativar mapeamento por último. Preservar alterações concorrentes/outras instâncias; recarga somente se necessária.
- [x] PASOE real sem senha de pessoa: token inválido, campos extras, JSON inválido, conta fictícia/credencial sintética incorreta, método inválido. Verificar auditoria apenas pelas correlações próprias e ausência dos marcadores sintéticos; não ler payloads alheios. Expected: recusas e nenhum marcador persistido, sem negócio escrito.
- [x] Sincronizar canônicos B/M com guards e preservar diffs. Executar regressões PHP/auth, testes do handler/serviço e autorização156+fronteira82checks/cultura. Conferir catálogo/metadados atuais, sem recriar telas.
- [x] Cadastrar provedor desabilitado pelo comando governado. Usuário indica conta local existente e informa a própria credencial IMA pela UI/entrada protegida, nunca chat/arquivo. Não reutilizar senhaSSH. Se faltarem esses dados, concluir trabalho independente e registrar caso positivo/ativação/CIW1A pendentes.
- [x] Com vínculo autorizado, habilitar ima-user-web e provar login normal, tenant/assinante/permissões preservados e origem real da sessão. Acrescentar somente ima-user-web à allowlistCIW após essa prova.
- [ ] Validar autorização positiva, ação negada, login sem vínculo, origem local recusada; logout/expiração/revogação da sessão de teste impedem nova chamada. Sem alterar usuários/grants Progress para produzir cenários.
- [ ] Atualizar inventário/contextos e estados preparado/compilado/publicado/validado. Expected: evidências reais sem credencial em logs/respostas/sessão. Encerrar1A apenas após positivos e negativos; próximo funcional continua Colorações.

## Autorrevisão

Desenho coberto: leitor/normalização(1), fronteira/handler sem payload(2), cliente/provedor/sessão(3), cadastro governado sem migração(4), revisão/publicação/ativação/prova(5). As cinco classes de Review Focus têm testes responsáveis. Assinaturas/DTO/código de origem são consistentes; senha não usa roteador com logging de corpo nem cria vínculo por ID IMA. Sem placeholders ou alteração de produto nesta preparação. Execução aqui preservada; falta revisar este plano antes da implementação.

## Estado da execução em17/10/2026

Tarefas1–4 concluídas; tarefa5 publicada/negativos/regressões/canônicos prontos. Provedor habilitado e tasilpar/default vinculado pelo CRUD, permissões preservadas. Login real da pessoa e origem ima-user-web comprovados, allowlist ativada somente para esse provedor. Falta ALLOW de conta já autorizada e logout/revogação da sessão de teste; tasilpar tem5grupos e zero concessões de Colorações,7ações negadas corretamente. Detalhes em docs/integracao-ciw-auth-validacao.md. Não concluir1A com base apenas nos negativos.

