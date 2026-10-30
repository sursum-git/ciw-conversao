# CIW fase1A — estado de execução

Atualizado em17/10/2026. Plano aprovado e executado aqui. API publicada; origem
real ima-user-web comprovada e permitida. **Fase1A ainda pendente de autorização
positiva CIW e logout da sessão de teste.** Não iniciar writers dependentes.

## Estado vigente após login real

Pessoa entrou como tasilpar/default; GET /api/auth/session retornou authenticated
true e source ima-user-web. Registro ativo do servidor corresponde por hash,
provider/type ima-user-web e sem impersonação. Somente essa origem foi incluída
na allowlist privada; token, ACL e .p/.r preservados. Manifesto complementar:
.runtime/ciw-auth-20261017/source-enable/active-manifest.json.

PASOE recebeu consultas de decisão com identidade derivada dessa sessão real:
sete ações de cadastros.coloracoes negadas por CIW_ACCESS_DENIED. Probe12.2
NO-LOCK comprovou5vínculos de grupo e zero concessões para grid_pub_coloracoes
e form_pub_coloracoes. Nenhum usuário/grant alterado para produzir ALLOW.
Permissões locais de tasilpar continuam restritas ao painel IOL.

Onze negativos PASOE repetidos após ativação passaram. Falta outra conta já
existente e autorizada para provar ALLOW; pergunta enviada. Sessão atual da
pessoa preservada. Diagnóstico PASOE não equivale a autorização integrada de uma
tela de negócio no PHP. Relatório do login: docs/integracao-ciw-auth-validacao.md.

## Registro histórico da publicação inicial —16/10/2026

As seções seguintes descrevem a configuração inicial negando todas as origens,
anterior ao estado vigente acima. Não restaurar allowlist vazia por esse histórico.

## Preparado, compilado e publicado

- Transporte PHP canônico protege X-Sursum-Auth-Source exclusivamente da sessão ativa. Headers da fonte não substituem identidade/origem; sem fallback por nome.
- CiwAccessRead.p, CiwAccessBoundary.p e CiwAccessService.p, com seus .r OpenEdge12.2, publicados em /mnt/datasul/ERP/sursum/sursum-api/programs. Rota POST /SursumPrograms/ciw-access em **sursum-api/med**.
- Configuração privada sursum-conf/ciw-access.json contém hash do token novo e allowedAuthProviders=[]: todos negados. Não incluir local/admin para fabricar teste. Credencial local somente em .runtime/ciw-access-20261016/connection.json; nunca imprimir conteúdo.
- Nove arquivos novos de fontes/testes/documentação sincronizados com guards no motor-progress/v2; rota canônica mesclada preservando entradas existentes. Nenhuma configuração privada copiada.
- Dicionários confirmados diretamente no12.2: Login único, id não único; membership e grants com índices únicos compostos. Somente metadados, sem registros de usuários. Evidência mínima: integration-src/ciw-access/schema/schema12.2-*.json.

Recurso inicial cadastros.coloracoes: read/export/print usam grid_pub_coloracoes; get/create/update/delete usam form_pub_coloracoes. A API somente verifica permissão, nunca executa a ação. Contrato em integration-src/ciw-access/contract.json e CiwAccessRead.md.

## Validação executada

- PHP RED4falhas reais; GREEN15testes/32asserções; focal canônico30/72; suíte completa456testes/2467asserções. Lint/diff-check passaram. Revisão independente sem achados materiais.
- ABL RED: serviço ausente; depois fronteira ausente. Teste adicional READ revelou enum permissivo e falhou antes da correção.
- GREEN no **OpenEdge12.2/.42**: seis fontes sem erro; serviço156checks +fronteira82checks por cultura AMERICAN/EUROPEAN —238 por cultura. Inclui revogação em TT entre chamadas, ambiguidade, inatividade/unknown, flags inválidas, permissões distintas grid/form e união entre grupos.
- Revisão independente ABL sem Critical/Important/Minor; conferiu oito hashes fonte→manifesto. Não executou remotamente. Limitações CGI/roteador/filesystem foram verificadas pela publicação e testes seguintes.
- **PASOE real:11negativos passaram**: token ausente/incorreto, identidade ausente, login/tabela no payload, recurso/ação desconhecidos, array na raiz, origem local negada, origem IMA sem allowlist negada e repetição da recusa. Repetição prova repetibilidade; ausência de cache sustentada pelo código e revogação em TT.
- Catálogo atual: **19telasCIW**, todas metadadosHTTP200; painel1.0.4, 6telas com escrita habilitada nos metadados e13de leitura. Publicações existentes preservadas; esta entrega não criou telas nem habilitou escrita. Presença no catálogo não comprova conversão funcional integral.

O roteador existente usa HTTP200 para envelopes de programa, inclusive success=false; status401/403/400 ficam em error.status. Erro de parse do roteador usa HTTP400/INVALID_JSON e seu próprio envelope. Testes distinguem os dois; roteador compartilhado preservado.

## Publicação e evidências

Compilador42/tadeu.parreiras, OpenEdge12.2; runtime111, montagem //192.168.0.137/ERP confirmada por findmnt. Acessos liberados por entrada protegida, sem persistir credenciais. Seis artefatos ABL+configuração novos, hashes verificados e rota ativada por último. Sem reinício de outras instâncias. Primeira tentativa detectou catálogo alterado e parou antes de escrever; baseline relido preservou alteração concorrente IOLv3.

Evidências privadas em .runtime/ciw-access-20261016/:

- php/: testes/backups e aplicação SHA256;
- compiled-red/, boundary-red/, service-action-red/: falhas observadas;
- compiled-green/: compilação, manifesto e testes12.2 atuais;
- publish/active-manifest.json: hashes publicados/backup do catálogo;
- pasoe-negative-validation.json:11casos reais, sem dados de usuário;
- canonical-sync-manifest.json e canonical-backup/: sincronização protegida;
- progress.md: decisões e progresso.

Nenhuma escrita de negócio, sequência, usuário, grupo, concessão ou schema. Sem commit/push/reseed/reassinatura. Não publicar PHP sanitizado de análise.

## Pendência para concluir1A

Pesquisa nas bibliotecas identificou autenticação Progress/user-web em bl_tela_login e ctrl_login_html; app_login usa s_users com LDAP condicional (servidor192.168.0.61/domínioIMA). Ver docs/ciw-autenticacao-bibliotecas.md. Não depende obrigatoriamente de LDAP: falta integrar o provedor Progress real no AuthService do construtor e validar sua sessão. Nenhuma autenticação foi alterada; origem local não foi promovida artificialmente.

Após confirmar origem, configurar allowlist privada deliberadamente e validar usuário autorizado, login sem vínculo e ação negada pelo caminho real da sessão. Esses casos passaram em TT, **não com identidade real**. Sessão expirada/revogada ponta a ponta também pendente; testes de transporte não substituem prova integrada.

Tarefa2 concluída; tarefa1 com contrato físico confirmado e origem pendente; tarefas3/4 implementadas/testadas/publicadas; tarefa5 parcial. Próxima etapa funcional: Colorações, depois demais cadastros na ordem aprovada, após pré-requisitos. Conta corrente fornecedor do menu Tarefas permanece excluído por rótulo; destino técnico depende do cadastro dinâmico do menu.
