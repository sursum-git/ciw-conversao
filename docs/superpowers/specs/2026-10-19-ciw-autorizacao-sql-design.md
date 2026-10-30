# CIW: correção da origem de autorização de Colorações

Data: 19/10/2026. Estado: desenho aprovado pelo usuário ("aprovado"); plano aprovado e implementado/publicado. Validação humana integrada pendente; ver docs/integracao-ciw-autorizacao-sql-validacao.md.

## Objetivo e alcance

Concluir a validação de identidade e permissões da fase 1A usando a regra efetiva
do CIW. Preservar o login Progress aprovado (`ima-user-web`), a sessão existente
do construtor e o frontend por metadados. A etapa se limita a Colorações e ao
vínculo explícito da conta indicada pelo usuário. Os próximos cadastros seguem
o inventário aprovado; Conta corrente fornecedor continua fora do escopo inicial.

Este adendo substitui a hipótese de que `espec.grupos_aplicacoes` seja a fonte
de autorização de Colorações. Não substitui o mecanismo de autenticação já
publicado nem autoriza migrar automaticamente outras contas.

## Evidências e diagnóstico

O usuário confirmou que consegue abrir Colorações no CIW atual.

| Camada | Evidência obtida |
| --- | --- |
| Progress | `tcassimiro` ativo, com 12 vínculos de grupo; não há concessões globais para os dois programas de Colorações em `espec.grupos_aplicacoes`. |
| Entrada CIW | A raiz HTTPS redireciona para `ctrl_login_html`. Seu fluxo ativo consulta `s_users` no SQL Server e usa LDAP quando `usuario_ad` está preenchido. |
| Permissões CIW | `ctrl_login_html` aplica o sistema 18 consultando `s_users_groups`, `s_groups_apps`, `programas` e `modulos`, pela conexão `ticontrole2`, banco `ticontrole`. |
| Conta SQL | `thiago.cassimiro` está ativo e tem concessões explícitas com todas as flags Y para `grid_pub_coloracoes` e `form_pub_coloracoes`, sistema 18. Não foi localizada a conta SQL `tcassimiro`. |
| Construtor | `tcassimiro` ainda não possui conta local; nenhuma conta ou concessão foi criada nesta investigação. |

`bl_tela_login` representa outro fluxo: autentica no Progress e aplica
`grupos_aplicacoes`. Foi a referência escolhida e já validada para o novo login.
Encontrar helpers Progress em um arquivo não prova que o evento ativo os use.
O diagnóstico do caminho SQL corrige essa interpretação anterior.

Os dois nomes foram informados pelo usuário, mas a correspondência entre eles
não deve ser inferida por semelhança, código numérico ou condição de administrador.
O vínculo abaixo é uma decisão administrativa explícita proposta neste desenho.

Evidências sanitizadas em `.runtime/ciw-auth-tcassimiro-20261019/`:
`grants-inspection/result.json`, `source-path-manifest.json`,
`sql-authorization-evidence.json` e `ssh-sql-transport-proof.json`.
Fontes de análise em `sources/scriptcase/auth-path-20261019/`.
Não executar essas cópias como aplicações.

## Alternativas e escolha

1. **Recomendação: leitor SQL no backend PHP existente.** Consultar as concessões
   atuais por PDO_ODBC sobre túnel SSH autenticado. Reutiliza componentes
   instalados e evita criar outro serviço remoto. Exige conexão técnica privada
   e gerenciamento do túnel no ambiente local.
2. **Gateway remoto de leitura no servidor CIW.** Poderia reutilizar a conexão
   Scriptcase, mas acrescentaria endpoint, autenticação e publicação remota.
   Não é necessário para o transporte já comprovado.
3. **Copiar concessões para Progress.** Criaria duas fontes de verdade e uma
   sincronização nova. Descartado: não reproduz a origem atual de Colorações.

## Identidades e vínculo governado

Proposta específica para o assinante Principal/default:

- Conta do construtor e identidade Progress: `tcassimiro`, provedor `ima-user-web`.
- Sujeito de autorização CIW: `thiago.cassimiro`, sistema fixo 18.
- Vínculo armazenado em `AuthUserSubscriber.metadata`, protegido pela integridade
  normal do cadastro e auditado. Não utilizar atributos enviados no login ou em
  uma chamada de negócio para escolher o sujeito SQL.

Criar a conta e o vínculo por operação de domínio delimitada, com validação de
unicidade, vínculo ao assinante e auditoria. Não atribuir grupos ou permissões
locais de negócio por conveniência. Não modificar `tasilpar`, administradores
ou contas preexistentes. Não criar usuários ou concessões no Progress ou SQL.
Não armazenar senha humana no cadastro, configuração, log ou evidência.

## Fluxo de autorização

O backend do construtor recebe a consulta de autorização em uma entrada
autenticada própria (`POST /api/ciw/access`), usando o mesmo resolvedor de sessão.
O corpo conserva somente `operation: "authorize"`, `resource` e `action`, conforme
o contrato de consulta existente; identidade, assinante, sistema e sujeito SQL são resolvidos
no servidor. Nenhum desses valores pode ser substituído por headers do cliente.

1. Exigir sessão válida, conta ativa e origem `ima-user-web` permitida.
2. Resolver o vínculo íntegro e exato do assinante corrente.
3. Confirmar a identidade Progress ativa por um serviço de leitura reutilizável
   no PASOE, protegido pelo transporte e token internos existentes. Separar essa
   verificação da consulta antiga de concessões Progress, preservando suas regras
   de identidade. Não transportar a senha do login para essa etapa.
4. Consultar no SQL a conta ativa, os grupos e as concessões do sistema 18 para
   o programa fixo correspondente. Usar consultas parametrizadas e tabelas fixas.
5. Combinar flags Y dos grupos conforme a regra do legado. Não usar `priv_admin`
   como atalho. Ausência de vínculo, ambiguidade, inatividade ou concessão ausente
   negam. Indisponibilidade produz erro de serviço e nunca autorização positiva.

Mapeamento preservado: leitura/exportação/impressão usam `grid_pub_coloracoes`;
obter/incluir/alterar/excluir usam `form_pub_coloracoes`. As condições de acesso
e as flags da ação devem reproduzir o helper ativo, incluindo suas combinações
entre grupos. Fixar a tabela de decisão em testes antes da implementação.
Não aceitar nomes de programas, SQL, conexão ou número do sistema do cliente.

As decisões são lidas a cada chamada, sem copiar concessões para a sessão ou
criar cache de permissões. Não há retorno automático às concessões Progress
quando a fonte SQL falha ou nega.

O endpoint PASOE antigo `ciw-access` continua com seu contrato Progress para
compatibilidade; não passa a conceder Colorações por conta própria. O novo
orquestrador PHP não chama o próprio servidor PHP por HTTP. A nova verificação
de identidade PASOE deve ser restrita ao backend, sem senha e sem concessões SQL.

A resposta dessa consulta representa somente a decisão legada CIW. Endpoints de
negócio continuam exigindo também as permissões locais do construtor. Este adendo
não habilita writers ou concede acesso a dados apenas por autenticar com sucesso.

## Transporte e configuração

Prova de viabilidade concluída: PHP local, PDO_ODBC e ODBC Driver 17 consultaram
o SQL Server através de túnel SSH com chave do host verificada. O túnel termina
no próprio servidor SQL `192.168.0.170`, destino `192.168.0.170:1433` nesse host;
o listener local é loopback. Não há trecho externo de SQL em texto aberto.
O túnel temporário do diagnóstico já foi encerrado.

A tentativa direta com TLS e validação de certificado falhou. Não desabilitar
essa validação numa conexão direta. A solução proposta usa a proteção SSH de
ponta a ponta até o host SQL, conforme a prova, sem alterar o truststore global.

Ativar a extensão PDO_ODBC já disponível apenas no processo PHP do construtor
e usar o mecanismo gerenciado de túnel existente, com ciclo de vida, timeout
e fechamento controlados. Nenhuma nova chave ou senha SSH deve ser instalada
ou persistida. Configuração técnica SQL fica em arquivo privado ignorado,
fora do webroot, referenciado por caminho; erros e logs omitem seus valores.
As credenciais existentes não foram comprovadas como restritas a SELECT pelo
servidor: o componente deve executar exclusivamente as consultas fixas de leitura.

## Entrega, testes e aceite

- PHP: sessão real, assinante correto, vínculo íntegro, duas identidades distintas,
  cliente tentando forjar sujeito/origem, conta inativa, vínculo ausente ou ambíguo,
  programa/sistema incorretos, flags negadas, união entre grupos e indisponibilidade.
- Regressão de autenticação Progress e das recusas locais/admin; nenhum bypass
  baseado em privilégio administrativo SQL. Verificar ausência de segredos em erros.
- Novo ABL executável: compilar no OpenEdge 12.2/.42, publicar exclusivamente em
  `sursum-api/med` com hashes e backup, validar no PASOE real. Não usar .r 12.8.
- Validar consultas reais somente leitura e, após ativação governada, solicitar
  o login de `tcassimiro` na interface existente com senha digitada pela pessoa.
  Comprovar ator, vínculo, autorização positiva real e recusas; testar logout.
- Registrar separadamente preparado, compilado, publicado e validado. Só concluir
  a fase 1A após a cadeia integrada real; nenhum teste escreve dados de negócio.

Reversão: desativar o novo vínculo/entrada sem transformar recusa SQL em permissão
Progress, encerrar o túnel próprio e restaurar somente artefatos modificados com
seus backups. Preservar login e sessões das outras contas e mudanças concorrentes.

## Revisão do desenho

Revisão interna: origem e identidades diferenciadas; fonte única por decisão;
nenhuma sincronização de concessões; transporte comprovado; permissão de negócio
distinta da consulta legada; escopo limitado. O plano de implementação detalhará
arquivos, consultas e sequência de ativação após a revisão deste adendo.
