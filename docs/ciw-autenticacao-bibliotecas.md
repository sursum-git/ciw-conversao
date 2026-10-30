# Autenticação encontrada no Scriptcase

Investigação em16/10/2026, solicitada pelo usuário para localizar o provedor nas
bibliotecas. Leitura remota de1363arquivos PHP delimitados, incluindo bibliotecas
compartilhadas e auxiliares de login;15definições relevantes identificadas. Nenhum
PHP executado, login tentado ou registro de usuário consultado. Literais não
necessários omitidos da evidência; nenhuma credencial copiada.

## Fluxos distintos

| Entrada | Verificação da credencial | Identidade/permissões |
|---|---|---|
| bl_tela_login | logar→validarLogin→getDadosUserWeb, tabela Progress espec.user-web, filtro pelo login e senha informada; exige ativo=1 | setarVarsLogin; aplicarPermissoesSC consulta usuarios_grupos/grupos_aplicacoes |
| ctrl_login_html | Contém outra versão de validarLogin, também com filtro de senha em user-web | Helpers de usuário e permissões incorporados ao PHP gerado |
| app_login | Consulta s_users e exige active=Y. Se usuario_ad vazio, compara a senha cadastrada; se preenchido, chama sc_ldap_login | Login AD construído como IMA\usuario_ad; não equivale automaticamente ao cadastro user-web |

No fluxo bl_tela_login, validarLogin não chama LDAP, md5, sha1, hash,
password_verify ou crypt: passa a senha recebida para o filtro de igualdade
da consulta. Isso descreve o código observado, sem ler a senha de qualquer usuário
ou provar o formato físico dos valores armazenados.

O app_login configura servidor LDAP **192.168.0.61**, domínio **IMA** e grupo
vazio. São parâmetros encontrados no fonte, não prova de conectividade, bind,
TLS, baseDN ou configuração correta para o construtor. O parâmetro version="1.0"
do código gerado não foi interpretado como versão de protocolo LDAP.

## Fontes e linhas

Referências relativas a sources/scriptcase/phase1:

- bl_tela_login/index.php:5139 — POST chama logar, depois aplicarPermissoesSC.
- bl_tela_login/index.php:6253 — getDadosUserWeb aponta espec/user-web.
- bl_tela_login/index.php:8630 — validarLogin; igualdade dinâmica de senha
  confirmada no arquivo remoto original, cuja cópia anterior omitia esse literal.
- bl_tela_login/index.php:8761 — logar; só prepara sessão se não houve erro.
- bl_tela_login/index.php:8796 — aplicarPermissoesSC, por grupos do login.
- ctrl_login_html/ctrl_login_html_apl.php:3688 — getReg compõe a consulta;
  :6003 — validarLogin usa a mesma origem Progress.
- app_login/app_login_apl.php:1971/1973 — servidor/domínio;
  :2042 — ramificação sem usuario_ad; :2081 — chamada LDAP;
  :7203 — função gerada sc_ldap_login.

As definições de negócio foram encontradas incorporadas aos fontes gerados das
aplicações. Nos arquivos compartilhados examinados em _lib não foi encontrada
outra definição desses helpers. getDadosUserWeb em bl_tela_login referencia
getReg global; a definição equivalente encontrada em ctrl_login_html/app_login
é um método gerado. A resolução desse símbolo global não foi executada nem
presumida a partir dessa equivalência.

Evidência sanitizada com hashes, funções, chamadas e caminhos:
integration-src/ciw-access/auth-library-evidence.json. Coleta:
tools/construtor-local/inspect-ciw-auth-libraries.py. Hashes remotos dos arquivos
de login conferidos contra o manifesto da cópia anterior, quando presentes.

## Consequência para a conversão

A dependência não deve ser descrita apenas como “falta configurar LDAP”.
Há autenticação própria Progress/user-web no fluxo de login CIW analisado e
uma entrada separada que usa s_users/AD condicionalmente.

Para preservar bl_tela_login, a proposta é um provedor dedicado no mecanismo
de autenticação existente do construtor, por exemplo ima-user-web. Ele deve
verificar a credencial por serviço ABL restrito, retornar somente a identidade
mínima e criar uma sessão pelo AuthService existente. Senha apenas em memória,
sem persistir em sessão, logs, payloads de auditoria ou resposta. Essa integração
exige desenho/testes próprios antes de ativar o provedor; não basta marcar um
login local como ima-user-web.

Depois de autenticar realmente por esse caminho, a origem confiável da sessão
pode ser explicitamente autorizada na API CIW já publicada. O serviço atual de
autorização continua somente leitura e não deve receber/validar senhas. Se houver
necessidade do fluxo app_login, a integração LDAP é independente e deve respeitar
o vínculo real de usuario_ad, sem unir IDs ou logins por suposição.

A pesquisa identifica a origem; não conclui autenticação integrada no construtor.
Allowlist publicada permanece vazia e o caso positivo real continua pendente.
