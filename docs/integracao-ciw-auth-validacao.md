# CIW — autenticação Progress de bl_tela_login

Atualizado em17/10/2026. Desenho/plano aprovados e execução aqui.

## Estado atual

Serviço e handler compilados em OpenEdge12.2 e publicados em sursum-api/med.
Provedor PHP ima-user-web cadastrado e habilitado pelo comando governado.
Usuário indicou explicitamente tasilpar; somente auth_source dessa conta/default
foi alterado pelo CRUD administrativo. Grupos e permissões preservados.
Login positivo pela UI confirmado pela pessoa e pelo GET /api/auth/session:
tasilpar/default, origem ima-user-web. Registro ativo no servidor correlacionado
por hash do identificador da sessão; provider/type ima-user-web, sem impersonação.
Após essa prova, allowlist CIW passou a conter somente ima-user-web.
Autorização positiva de Colorações ainda pendente; não concluir a fase1A.

## Testes já executados

- RED ABL: serviço ausente; depois classe de fronteira ausente.
- GREEN OpenEdge12.2/.42: seis fontes sem erro,108checks de serviço e31de
  fronteira por cultura AMERICAN/EUROPEAN. Probe somente de dicionário confirmou
  Login/senha CHARACTER e ativo LOGICAL, sem valores de usuários.
- RED PHP: classes novas ausentes e supportedTypes sem ima-user-web.
- GREEN isolado14testes/85asserções; canônicoAuth26/116.
- Suíte PHP completa491testes/2846asserções, sem falhas/avisos.
- Cache Symfony local atualizado; comando app:auth:configure-ima-user-web
  reconhecido; lint do container atual passou.
- Teste adicional encontrou conversão indevida de senha Unicode em ISO8859-1:
  RED reproduzido no12.2; correção GetLongchar UTF8/comparação integral de bytes.
  GREEN: três casos em UTF8 e três em ISO8859-1, incluindo limite1024bytes.
  Banco espec usa ISO8859-1, confirmado por DBCODEPAGE sem ler senhas.
- Onze negativos passaram no PASOE após o delta corrigido, com statusHTTP,
  envelope, no-store, ausência de CORS e sem eco de credenciais.
- Probe restrito à rota /CiwAuthentication: zero execuções no repositório de
  payloads; nenhum payload lido, nenhuma escrita de negócio.
- Regressão de autorização no12.2:156checks de serviço+82de fronteira em
  cada cultura; onze negativos de autorização PASOE passaram. Catálogo atual:
  19telas CIW, zero erros de metadados; sem chamada de negócio nessa conferência.
- Sessão real: autenticadaHTTP200 no navegador; mesma sessão confirmada no PG,
  sem exportar bearer token. Permissões locais continuam somente IOL.
- PASOE, identidade derivada dessa sessão verificada: read/get/create/update/
  delete/export/print de Colorações retornaram CIW_ACCESS_DENIED. São consultas
  de decisão; nenhuma dessas ações de negócio foi executada.
- Probe12.2 NO-LOCK restrito a tasilpar:5 vínculos de grupo, zero concessões
  para grid_pub_coloracoes e form_pub_coloracoes. A recusa corresponde ao
  cadastro real. Não criar grants/contas nem ampliar permissões para fabricar ALLOW.
- Onze negativos de autorização repetidos após ativação: local/origens não
  permitidas continuam recusados. Logout/revogação dessa sessão real não foi
  executado; preservado o acesso atual da pessoa enquanto falta conta para ALLOW.

Lote PHP aplicado com guardSHA256 e backup em16arquivos. Baseline/diffs existentes
preservados; alterações antigas do AuthService/admin e dos outros módulos mantidas.

## Comportamento

Login normal resolve auth_source de uma conta local ativa no tenant. O novo
ImaUserWebAuthProvider só atende vínculo explícito ima-user-web. A credencial é
verificada no Progress por CiwAuthenticationService, sem SQL e sem escrita;
login normalizado ambíguo/inativo/unknown ou senha incorreta negam.
Senha é LONGCHAR UTF8 opaco, comparado byte a byte via MEMPTR NO-CONVERT com
o valor armazenado convertido para UTF8, sem trim ou alteração da entrada.

Handler dedicado CiwAuthenticationWebHandler, entrada /CiwAuthentication, não
usa JsonProgramRouter, ApiExecutionRepository, logs de payload ou CORS de browser.
Não depende de redação posterior: credencial não entra no armazenamento de
execução. HTTP retorna o status correspondente ao envelope, Cache-Control:no-store.
Nenhum erro inclui corpo, token ou senha.

Cliente PHP usa cURL com endpoint privado fixo, sem redirects/profiler, TLS
verificado, timeout e limite de resposta. URL/token vêm do arquivo ignorado
.runtime/ciw-auth-20261017/connection.json, indicado por CIW_AUTH_CONNECTION_FILE.
Não imprimir esse arquivo. Token distinto da API CIW; servidor guarda só hash.

Cadastro do provedor é específico e desabilitado por padrão; comando não migra
contas nem importa priv_admin/grupos IMA para PostgreSQL. Grupos/permissões locais
e validação IMA continuam separados. Admin permanece local. tasilpar foi indicado
pelo usuário e vinculado; nenhuma conta ou senha Progress foi criada/alterada.

O metadado compartilhado auth_user continha só os campos de admin.permissoes.
Acrescentado auth_source por saveEntity oficial, mantendo campos anteriores e
modo de isolamento none; normalizador registrou os padrões administrativos
atuais e globalTable=true para a tabela técnica já compartilhada. Nenhum schema,
reseed ou assinatura manual. Backup/retorno em auth-user-entity-{before,after}.json.

## Evidências e pendências

Em .runtime/ciw-auth-20261017/: service-red/,service-green/,boundary-red/,
boundary-green/,php/,final-green/,encoding-{red,green,publish}/,no-payload/,
ROOT.handlers.before,publish/,account-binding.json,provider-registration.json,
browser-session-proof.json,verified-real-session.json,real-access-decisions.json,
grants-inspection/ e source-enable/active-manifest.json.
O diretório contém configuração privada: mencionar caminhos, nunca conteúdo.

Revisão independente única concluída sem Critical/Important confirmados; lacuna
de encoding foi investigada e corrigida com RED/GREEN antes do vínculo. Dois
minors adiados: registro já habilitado retorna antes de revalidar arquivo e
rollback do cadastro não conserva evento de falha (erro sanitizado permanece).

Manifesto principal publish/active-manifest.json; delta encoding-publish prevalece
no serviço .p/.r. source-enable/active-manifest.json prevalece no arquivo privado
CIW de autorização (token preservado, somente allowlist mudou). Classes/mapping preservados. ROOT.handlers foi ativado
pelo tcman jmx refreshWeb -appname med -webappname med; refreshAgent isolado não
atualiza o mapeamento. Delta carregado por refreshAgent de sessões med ociosas,
sem reiniciar instância. Não repetir recarga por rotina.

Autenticação real de tasilpar concluída. Falta conta já existente no construtor
e autorizada a Colorações no CIW para validar ALLOW sem modificar concessões;
pergunta enviada. Depois validar logout/revogação da sessão de teste e a cadeia
integrada da API de negócio. O diagnóstico atual consulta PASOE com identidade
derivada da sessão real; não equivale a uma tela CIW autorizada no construtor.
Não habilitar writers com base apenas em TT, login e recusas.

## Conta candidata em19/10/2026

thiago.cassimiro foi indicado pelo usuario. Nao encontrado no construtor
(default ou demais assinantes) nem como Login de espec.user-web na base usada
pela integracao; probe12.2 confirmou zero vinculos/grants de Coloracoes. Nenhuma
conta/grant criado. Pendente confirmar login exato do CIW/bl_tela_login. Evidencias
em .runtime/ciw-auth-thiago-20261019/. Nao equivale a testar sua senha ou login.

## Correcao para tcassimiro e revisao do mapeamento —19/10/2026

Usuario informou tcassimiro: encontrado ativo no Progress,12vinculos de grupo;
nao cadastrado no construtor. Nada criado ou alterado. Probe restrito confirmou
que grid_pub_coloracoes e form_pub_coloracoes nao possuem registros em
espec.grupos_aplicacoes para NENHUM grupo; nenhum nome contendo COLOR retornou.
Assim, a dificuldade do teste positivo nao pode ser atribuida so ao usuario;
nao pedir mais contas ou criar grants para forcar ALLOW. Verificar a regra
ativa de Coloracoes no CIW antes de modificar a politica. Pergunta ao usuario:
tcassimiro abre Coloracoes no legado? Helper getProgUsuario usa outra fonte,
mas sua participacao nesse fluxo ainda nao foi confirmada. Evidencias em
.runtime/ciw-auth-tcassimiro-20261019/. Politica/runtime permanecem inalterados.


## CIW: origem SQL comprovada —19/10/2026

O usuario confirmou que tcassimiro abre Coloracoes no CIW atual. A investigacao
somente leitura comprovou: tcassimiro existe ativo no Progress (12 vinculos),
mas as concessoes de Coloracoes do caminho ativo estao no SQL Server ticontrole,
conexao ticontrole2, para thiago.cassimiro, sistema18. Ambos os programas possuem
concessoes explicitas Y. A ausencia global anterior se refere APENAS a
espec.grupos_aplicacoes, nao ao SQL. Nao pedir outra conta nem fabricar grants.

A raiz HTTPS CIW redireciona a ctrl_login_html: evento ativo autentica s_users
(SQL, LDAP quando usuario_ad preenchido) e aplica programas/modulos/
s_groups_apps/s_users_groups. bl_tela_login e outro fluxo Progress e permanece
a referencia escolhida para o login ima-user-web ja publicado/validado tasilpar.
Encontrar helpers Progress no arquivo nao comprova uso pelo evento ativo.

Proposta para revisao: manter autenticacao Progress tcassimiro e consultar as
concessoes SQL via backend existente, com vinculo administrativo explicito ao
sujeito thiago.cassimiro/default/sistema18. Nao inferir aliases por nome/ID.
Nao existe conta local tcassimiro; nada foi criado/vinculado. Prova PHP PDO_ODBC
Driver17 sobre tunel SSH com hostkey verificada funcionou somente SELECT.
Tunel temporario encerrado; nenhuma configuracao de produto alterada. Nao usar
conexao direta SQL com validacao TLS desabilitada nem exportar credenciais.

Desenho preparado: docs/superpowers/specs/2026-10-19-ciw-autorizacao-sql-design.md,
ainda para revisao. Evidencias privadas em .runtime/ciw-auth-tcassimiro-20261019/:
sql-authorization-evidence.json, ssh-sql-transport-proof.json,
source-path-manifest.json e grants-inspection/result.json. Fase1A PARCIAL:
correcao de autorizacao nao implementada/publicada; ALLOW integrado/logout
reais pendentes. Escritas CIW dependentes continuam sem habilitacao por esta etapa.


## Atualizacao de autorizacao SQL —19/10/2026

A hipotese de ACL somente Progress foi substituida pelo adendo aprovado.
Cadastro tcassimiro/default e vinculoSQL thiago.cassimiro/sistema18 aplicados
sempermissoes locais de negocio. Publicacao/testes e pendencia deloginhumano
estao em docs/integracao-ciw-autorizacao-sql-validacao.md. Fase1A permaneceparcial.
