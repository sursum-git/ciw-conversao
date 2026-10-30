# Home após login sem aplicações autorizadas

Falha reproduzida na sessão LDAP humana: HomeHTTP200, programs=[], grupos=[], initialProgramId=painel. HomeDefinitionValidator exige programa/grupo e aborta a página. Nenhuma permissão CIW deve ser concedida para contornar o erro.

Aceitar arrays vazios de programas/grupos após filtro de acesso, mantendo rejeição de tipos inválidos e referências inexistentes. Ao iniciar Home sem programas, renderizar mensagem neutra sobre ausência de aplicações e não tentar abrir painel antigo. Fluxo com aplicações permanece igual. Não alterar autenticação, permissões, Kendo, backend ou dados de negócio.

Teste puro com classes reais: RED do validador e abertura indevida; GREEN dos cenários de vazio, tipo inválido, referência não autorizada, grupo ausente quando há programas, fluxo normal. Staging em integration-src/home-empty, aplicação por hashes nos dois JS canônicos, revisão independente e validação pela própria sessão humana no navegador. Registrar loginLDAPpositivo separadamente da disponibilidade de aplicações.


## Login LDAP positivo e Home corrigida — 20/10/2026

Login humano tadeu.parreiras confirmado: sessão244/default, provedor e tipo ldap, permissões[]. Nenhuma senha/token consultado ou persistido. Falha da Home tinha duas causas: validador recusava programs/grupos vazios após filtro e tratava currentUser.forcePasswordChange(boolean) como segredo. Corrigidos HomeDefinitionValidator.js e HomeEngine.js: arrays vazios aceitos, indicador booleano permitido SOMENTE nos caminhos currentUser/user, mensagem neutra quando não há programas sem abrir initialProgramId obsoleto. Campos de senha, indicador textual/aninhado e referências inválidas continuam recusados. Sem concessões de acesso.

Teste puro12/12PASS com RED anterior; revisão independente final sem achados. Navegador da própria sessão humana validado: Home carregada, data-render-state=ready e mensagem de ausência de aplicações. Menu técnico regressãoPASS:3grupos/13links/13definiçõesHTTP200, navegação contextual e14abas preservadas; não equivale a liberar esses links para tadeu. Conta corrente fornecedor fora; permissõesCIW seguem por último.

Fontes staging integration-src/home-empty; canônicos construtor-pg/src/home-engine e tests/frontend/home-empty-access.cjs. Aplicação guardada por hashes e backup; recibo final .runtime/home-empty-20261020/canonical-manifest-v2.json. Screenshot home-ldap-validada.png nesse diretório. Sem alteração backend/ABL/PASOE/Kendo/schema/reseed/commit/push. Assinante visual exibiu Empresa Demonstracao por estado existente; sessão autenticada continua default, esse estado visual não foi alterado.
