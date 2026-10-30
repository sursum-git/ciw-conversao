# Complemento CIW1A — autenticação pelo fluxo bl_tela_login

Estado: desenho aprovado pelo usuário em17/10/2026, resposta “Aprovar o desenho complementar”; não implementado ou habilitado.
Origem selecionada pelo usuário em17/10/2026: **bl_tela_login**.
Complementa a fase1 aprovada e a autorização CIW1A já publicada; não reabre
o inventário, as conversões existentes ou a exclusão de Conta corrente fornecedor.

## Objetivo e limite

Permitir que o login normal do construtor confira a credencial no cadastro
Progress espec.user-web, conforme a origem de bl_tela_login, e produza uma
sessão real cuja authentication.provider seja ima-user-web.

Reutilizar formulário de login, AuthService, sessão, tenant, assinante, expiração,
logout, permissões e frontend existentes. Autenticar não cria concessões IMA:
cada operação protegida continua exigindo permissão do construtor E os grants
relidos pelo CiwAccessService. Não usar a entrada app_login/s_users/LDAP neste lote.

Não copiar senhas do Progress para PostgreSQL, sessões ou metadados; não alterar
senha, usuário, grupo, concessão ou schema no Progress. Não migrar contas locais
existentes automaticamente. Nenhum commit/push/reseed/reassinatura de cadastros
ou telas existentes. Não ativar cadastros CIW com escrita nesta extensão.

## Evidência e encaixe existentes

- bl_tela_login/index.php:8630 valida credencial por user-web; :6253 resolve a
  tabela; :8761 prepara sessão; :8796 aplica permissões por grupos.
- A pesquisa remota sanitizada está em integration-src/ciw-access/auth-library-evidence.json;
  interpretação em docs/ciw-autenticacao-bibliotecas.md.
- AuthProviderInterface já oferece supports(config) e authenticate(config,credentials).
  AuthProviderRegistry seleciona a implementação pelo tipo configurado.
- AuthService::resolveCredentialProviderCode usa auth_source da conta local;
  se não há conta/configuração, atualmente resolve local. O cliente não deve
  ganhar escolha arbitrária de provedor por enviar um campo provider.
- AuthService::completeAuthenticatedLogin/createRuntimeSession já monta a sessão
  e fixa authentication.provider/type no servidor. Não criar sessão paralela.
- AdminCrudDefinitionFactory::authUserFields tem enum de origens; precisa
  reconhecer a nova origem para permitir vínculo pelo cadastro administrativo.
- JsonProgramWebHandler registra lcBody em ApiExecutionRepository::updateExecutionPayloads;
  o repositório grava dados_envio_json diretamente. Não enviar senha por essa
  rota enquanto esse contrato for o atual.

## Alternativas e decisão proposta

1. **Provedor no construtor + entrada PASOE dedicada a credenciais — recomendado.**
   Preserva a extensão de autenticação existente e mantém a senha fora do fluxo
   genérico de payloads de negócio. Exige um novo handler pequeno no PASOE.
2. Provedor + nova rota SursumPrograms com redação anterior à auditoria.
   Exigiria alterar o handler compartilhado que atende todos os programas e
   provar a redação em cada caminho de erro; amplia o alcance desta extensão.
3. Copiar senha para o login local ou reutilizar sessão PHP Scriptcase.
   Não atende ao contrato: duplica credencial ou acopla duas sessões/infraestruturas.

## Fluxo proposto

1. Pessoa informa usuário e senha no login normal do construtor.
2. Backend resolve uma conta do tenant, ativa, explicitamente vinculada à origem
   ima-user-web. Sem vínculo, não experimentar automaticamente credencial em
   outros provedores. Contas local/admin mantêm o comportamento atual.
3. ImaUserWebAuthProvider usa cliente interno dedicado para a entrada fixa
   POST /CiwAuthentication no contexto sursum-api/med.
4. Handler verifica token privado de integração, método, corpo fechado e limites.
   Só então chama CiwAuthenticationService sobre buffer fixo espec.user-web.
5. Serviço resolve um único Login, exige ativo=TRUE e verifica a senha no Progress.
   Nenhum cadastro é modificado; apenas leitura NO-LOCK e nenhuma sequência.
6. Provedor exige que a identidade retornada corresponda ao vínculo solicitado
   no tenant; monta AuthenticatedUser com grupos/permissões locais já existentes.
   Não importar priv_admin ou conceder grupos PG por números IMA.
7. AuthService cria a sessão normal e registra a origem ima-user-web. Só essa
   sessão pode produzir o header confiável para a API de autorização CIW.

A conta local é o vínculo administrativo/tenant/permissões; o Progress verifica
a senha. ID inteiro de user-web não substitui o identificador de conta PG.
Não haverá provisionamento automático ou troca automática de auth_source.

## Contratos e proteção da credencial

Requisição interna fechada:
operation=authenticate, username e password, todos com tipos/limites explícitos.
Tenant, banco, tabela, SQL, grupo, provedor, aplicação e permissões não são aceitos.
Endpoint e token vêm de configuração privada fixa no servidor, nunca de metadado
editável por um usuário de tela ou do corpo enviado ao backend.

Token de autenticação separado do token CIW de autorização; no PASOE guardar
somente SHA256. A nova entrada não exige uma sessão que ainda não existe.
Aceita somente o transporte do backend autenticado por esse token.

Usar HTTPS com certificado verificado, ou o túnel SSH privado em loopback já
documentado no ambiente local. Não desabilitar verificação TLS nem aceitar
redirecionamento para outro destino. Timeout/indisponibilidade negam login.

Senha é transitória em memória. Não usar o RuntimeExternalJsonClient de fontes
de negócio para esse POST, nem registrar credenciais no profiler, mensagens,
exceções, diagnóstico HTTP, arquivo, histórico ou auditoria.
Auditoria de login pode conter horário, correlação, resultado e ator mínimo,
com corpo omitido; jamais o request original, mesmo se JSON inválido.
Resposta não ecoa request, senha ou token. Não usar base64/hash como substituto
de transporte protegido ou como credencial reutilizável.

O handler dedicado pode reutilizar contexto/repositório de execução apenas com
metadados previamente escolhidos, sem updateExecutionPayloads do corpo original.
Nenhuma alteração genérica na persistência de payloads dos programas atuais.

## Semântica de identidade e senha

Login segue a normalização confirmada da origem: remoção dos acentos simples
do helper legado e resolução sem distinção de caixa, sem truncamento.
Colisões dessa normalização devem negar por ambiguidade. A mesma identidade
canônica validada alimenta a sessão e a autorização posterior.

O legado monta SQL e remove apóstrofos da entrada. Isso não será reproduzido:
o novo serviço usa buffers fixos e comparação de valores, sem concatenar senha
em consultas. A senha será comparada integralmente, sem trim, remoção de acentos,
remoção de apóstrofos ou conversão de caixa. Essa é uma mudança deliberada em
relação ao tratamento textual inseguro legado; testar apóstrofo, Unicode,
espaços e caixa. Confirmar tipo/extent do campo senha pelo dicionário antes de
implementar o leitor; não inspecionar ou exportar seus valores em produção.

DTO interno de sucesso contém somente login canônico e identificação mínima
necessária à sessão. Ausência, senha inválida, inatividade ou ambiguidade
retornam o mesmo erro público INVALID_CREDENTIALS. Falha de transporte/configuração
tem mensagem genérica, sem detalhes de conexão ou dados do cadastro.

Não incluir flags/grants IMA no snapshot local como autorização permanente.
CiwAccessService continua lendo grants por chamada. Mudança de senha/ativo
no Progress é verificada a cada novo login; sessões já emitidas seguem expiração
e revogação existentes, sem promessa de revogação instantânea da senha.

## Cadastro, ativação e publicação

Novo tipo/código ima-user-web no registro de provedores e enum administrativo.
Cadastro de configuração e vínculo de conta devem passar pelo serviço/fluxo
administrativo governado, com integridade normal de registro novo; não por SQL,
reseed ou reassinatura manual. Se não existir operação oficial para cadastrar
provedor, o plano deve criar uma operação de domínio delimitada, auditada e
idempotente somente para esse cadastro novo, sem regravar os provedores atuais.

Preparar provedor desabilitado. Só ativar após testes, compilação12.2 e publicação
da entrada PASOE sem credenciais em logs. Não alterar o admin ou o login tasilpar
existentes para escolher uma conta de teste por conveniência.

A conta a vincular deve ser indicada no ato de ativação ou já estar vinculada
por configuração administrativa autorizada. A senha real deve ser informada
pela própria pessoa no login normal/entrada protegida; nunca no chat ou arquivo.
Sem essa entrada, registrar implementação/publicação e caso positivo pendente.

Após a prova de autenticação real, acrescentar somente ima-user-web à allowlist
CIW e invalidar eventuais sessões antigas da conta vinculada quando isso fizer
parte da operação administrativa autorizada. Local/admin continuam fora.
Persistir autorizações próprias do construtor e IMA como verificações distintas.

Compilar ABL/handler no OpenEdge12.2/.42, publicar no compartilhamento137 e
configuração pertinente apenas em sursum-api/med no111, com baseline/hash/backup.
Mapeamento do novo handler sem substituir ROOT.handlers nem alterar outras
instâncias. Recarga apenas se necessária e limitada ao alvo.
Sincronizar canônicos preservando diffs concorrentes.

## Aceite e testes exigidos

- PHP: seleção pelo vínculo do tenant, origem forjada ignorada, conta inativa,
  conta local preservada, credencial inválida, timeout/configuração inválida,
  erro sanitizado, endpoint não controlável pelo cliente e nenhuma senha em sessão.
- ABL TT: sucesso, inexistente/inativo/unknown/ambíguo, senha incorreta, vazia,
  apóstrofo, acento/Unicode, espaços e caixa; nenhuma alteração em fixtures.
- Handler: token ausente/incorreto, métodos/campos extras, corpo inválido,
  limites/tipos, erro sem credencial; entradas com marcadores sintéticos não
  aparecem no armazenamento de execução, inclusive nos caminhos de erro.
- Sessão real: login normal, origem ima-user-web fixada no servidor, tenant e
  assinante corretos, logout/expiração/revogação impedindo chamadas protegidas.
- API CIW real: autorização válida, ação negada, login sem vínculo e provedor
  local recusado. Não criar/alterar usuários ou grants Progress para forçar prova.
- Regressões PHP/auth, autorização156+fronteira82checks/cultura, testes do handler
  e autenticação novos no12.2, e metadados das telas existentes preservados.
- Evidências sanitizadas; distinguir preparado/compilado/publicado/validado.
  Somente encerrar CIW1A após caso positivo real integrado e negativos.

## Revisão deste adendo

Interfaces existentes preservadas; extensão não depende de LDAP nem importa
sessão Scriptcase. Sem contas/credenciais/grants criados ou alterados nesta
preparação. A implementação deste complemento ainda exige plano próprio;
a aprovação anterior de CIW1A continua válida para o que já foi entregue.
