# LDAP habilitado na porta389 —20/10/2026

**Estado prevalente:** usuário autorizou explicitamente usar LDAP389 semTLS após o esclarecimento sobre transporte da senha. Provedor `ldap` habilitado em192.168.0.61, baseDN `DC=ima,DC=com,DC=br`, atributo `sAMAccountName`, padrão `IMA\{username}`. A expiração do certificado LDAPS não interfere nessa configuração autorizada. Não foi desabilitada validação de certificado: este modo não usaTLS.

Criada somente a conta `tadeu.parreiras`, no assinante Principal/default, com authSource=ldap, sem senha local, sem grupos/permissões CIW adicionados. Vínculo de assinante com overrides vazios; outros usuários/provedores/vínculos/grants preservados por hash. Configuração e vínculo assinados pelo serviço nativo de integridade em transação. Admin/local e ima-user-web continuam funcionando.

Verificações: RootDSE anônimo pelo mesmo PHP em389 passou; chamada ao login com senha vazia provou seleção do provedorLDAP e recusa anterior ao bind, sem tentativa de senha AD. Login técnico local e13linksCIW continuaram válidos. A leitura positiva do servidor e a ativação não substituem o **login humano real**, ainda pendente. Usuário instruído a entrar em production/login.html como tadeu.parreiras com sua senha de rede, sem enviá-la ao chat. Não reutilizar credenciaisSSH.

Configuração semsegredos efetiva em `integration-src/ciw-ldap/provider-active.json`; arquivo `provider-candidate.json` é histórico LDAPS não aplicado. Recibos privados `.runtime/ciw-ldap-20261020/{activation-before.json,activation.json,readiness.json}`. Ferramenta `tools/construtor-local/enable-ciw-ldap.php` recusa reaplicação/substituição de conta existente. Extensão LDAP permanece carregada somente no processo PHP do backend pelo launcher. Nenhum ABL/PASOE/schema/reseed/frontend/Kendo alterado. Permissões CIW por último e Conta corrente fornecedor excluído.

## Histórico do diagnóstico anterior à autorização

# LDAP — preparação e impedimento de ativação

Usuário solicitou habilitar LDAP e indicou a conta de rede **tadeu.parreiras**. Não solicitar novamente o nome nem reutilizar senhas SSH como senha LDAP.

O Scriptcase aponta para192.168.0.61/domínioIMA. Diagnóstico sem credenciais confirmou:

- LDAP389 eLDAPS636 acessíveis no principal.
- RootDSE anônimo pela biblioteca Windows: dnsHostName=IMA-SRV-AD1.ima.com.br, defaultNamingContext=DC=ima,DC=com,DC=br.
- Certificado públicoLDAPS do principal: CN=IMA-SRV-AD1.ima.com.br, validade30/07/2018–30/07/2019, cadeia com PartialChain eNotTimeValid. Não se desabilitou verificação de nome, validade ou cadeia; o callback de inspeção recusou a conexão inválida.
- DNS autoritativo do próprio domínio anuncia também ima-srv-ad2.ima.com.br/192.168.0.62; esse secundário não respondeu na portaLDAPS636 no prazo delimitado.
- O nome interno do principal não resolveu pelo DNS padrão desta máquina; resolveu/foi identificado por consulta ao DNS192.168.0.61. Isso também deve estar correto na ativação.

## Estado efetivo

A DLL LDAP já estava disponível no PHP8.4.3. O launcher local `tools/construtor-local/start.ps1` agora detecta a extensão e, quando ela não está carregada pelo ini, acrescenta `-d extension=ldap` somente ao backend. A disponibilidade é validada antes de iniciar. Não foi alterado php.ini global. Backend próprio da porta8000 reiniciado com guarda de PID/caminho/porta; frontend e sessões persistidas preservados.

Prova: flag LDAP no processo novo, extensão disponível com o mesmo argumento, health positivo, configuração de login respondendo, login técnico local e validação dos13linksCIW aprovados. As primeiras sondas usaram caminhos inexistentes /api/health e/api/auth/config e retornaram404; conferidos os controllers, os endpoints corretos /health na porta8000 e/api/auth/providers passaram. Não houve alteração de rotas para corrigir o teste.

**O provedor LDAP continua desabilitado e sem conta vinculada.** A conta tadeu.parreiras não existia no construtor e não foi criada durante esta preparação. Admin/local e ima-user-web permanecem habilitados. Não houve tentativa de senha LDAP, consulta de senha, alteração de permissões ou relaxamento TLS.

Configuração candidata sem segredos: `integration-src/ciw-ldap/provider-candidate.json`, inativa. Usa LDAPS, sAMAccountName, padrão IMA\{username} e o baseDN confirmado. Não é configuração já aplicada ao banco. Evidências privadas em `.runtime/ciw-ldap-20261020/`.

## Continuidade necessária

Renovar o certificado do principal e disponibilizar a cadeia da CA confiável, ou indicar controlador corporativo com certificado válido. Ajustar a resolução do nome interno para o processo local. Então configurar/habilitar o provedor e provisionar/vincular somente tadeu.parreiras conforme autorização recebida, sem concessões CIW artificiais ou migração das outras contas, e validar login humano protegido sem receber senha no chat.

Integração de permissões CIW continua para o final; Conta corrente fornecedor permanece excluído. Esta preparação não deve ser descrita como login LDAP funcionando.


### LDAP: esclarecimento do modo legado —20/10/2026

Usuário esclareceu que esses ADs são usados atualmente independentemente da validade do certificado. A expiração impede LDAPS com validação; não impede todo acesso LDAP. Fonte app_login_apl.php::sc_ldap_login confirma porta padrão389 e chamada sem configurar SSL/StartTLS explicitamente. Não alegar que renovar certificado é a única forma de reproduzir o legado. Antes de habilitar login por bind simples semTLS no novo construtor, confirmar explicitamente que o usuário autoriza esse modo que transmite a senha sem criptografia. Até essa escolha, provedor segue inativo e nenhuma senhaLDAP foi tentada. Conta já escolhida:tadeu.parreiras. Não perguntar novamente usuário/controlador como se fossem desconhecidos.


## Login LDAP positivo e Home corrigida — 20/10/2026

Login humano tadeu.parreiras confirmado: sessão244/default, provedor e tipo ldap, permissões[]. Nenhuma senha/token consultado ou persistido. Falha da Home tinha duas causas: validador recusava programs/grupos vazios após filtro e tratava currentUser.forcePasswordChange(boolean) como segredo. Corrigidos HomeDefinitionValidator.js e HomeEngine.js: arrays vazios aceitos, indicador booleano permitido SOMENTE nos caminhos currentUser/user, mensagem neutra quando não há programas sem abrir initialProgramId obsoleto. Campos de senha, indicador textual/aninhado e referências inválidas continuam recusados. Sem concessões de acesso.

Teste puro12/12PASS com RED anterior; revisão independente final sem achados. Navegador da própria sessão humana validado: Home carregada, data-render-state=ready e mensagem de ausência de aplicações. Menu técnico regressãoPASS:3grupos/13links/13definiçõesHTTP200, navegação contextual e14abas preservadas; não equivale a liberar esses links para tadeu. Conta corrente fornecedor fora; permissõesCIW seguem por último.

Fontes staging integration-src/home-empty; canônicos construtor-pg/src/home-engine e tests/frontend/home-empty-access.cjs. Aplicação guardada por hashes e backup; recibo final .runtime/home-empty-20261020/canonical-manifest-v2.json. Screenshot home-ldap-validada.png nesse diretório. Sem alteração backend/ABL/PASOE/Kendo/schema/reseed/commit/push. Assinante visual exibiu Empresa Demonstracao por estado existente; sessão autenticada continua default, esse estado visual não foi alterado.
