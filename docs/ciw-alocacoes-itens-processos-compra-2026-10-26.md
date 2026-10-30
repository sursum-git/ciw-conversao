# Alocações dos itens dos processos de compra — MED

`cons_itens_compra_alocado` foi convertida para `ciw.proc-compra-alocacoes` (`op1026`, versão1.0.0). Acesse **Itens → Visualizar → Alocações**, ou o link **Alocações** da linha. O cadastro de itens passou para versão1.0.3, com oito abas; as sete anteriores foram preservadas. O painel principal permanece na versão1.0.6.

A consulta apresenta container, quantidade alocada, situação ERP e acompanhamento do item posicionado. O link **Painel do container** usa o contexto do container e suas permissões existentes. O código de empresa MED é resolvido no servidor; o navegador não escolhe banco, empresa, tabela ou SQL.

## Reutilização e contrato

O adaptador `PurchaseItemAllocationsApi.p` fixa seis buffers de `espec`: processos, empresas, itens de compra, alocações, containers e situações. `PurchaseItemAllocationsService.p` reutiliza `PurchaseItemContext.i` para validar processo MED e pertencimento do item, e `CiwErpReadService.p` para filtro, ordenação, paginação e detalhe. A chave é `item_container_id`; `proc_compra_id` e `item_proc_compra_id` são contextos obrigatórios.

Somente `read/get`. O detalhe aceita `id` e o alias `item_container_id` enviado pelo construtor; se o alias estiver presente, os dois devem ser inteiros positivos iguais. O alias é consumido após validação, antes de chamar o leitor compartilhado. A lista não aceita esse alias. Filtros contraditórios retornam zero registros e nunca ampliam o contexto.

Preservados o INNER JOIN original com o container e as descrições Aberto/Suspenso/Fechado. Referência de acompanhamento inexistente recebe indicação de não informada. Identidades inválidas ou duplicadas falham; projeção limitada a50mil alocações/10segundos, página até200 registros. Nenhuma fórmula, rotina de custos, cálculo fiscal ou writer foi duplicado. Não houve DDL nem mudança nas bibliotecas Kendo.

## Auditoria

Esta consulta não executa manutenção nem gera eventos de negócio fictícios. Os writers de itens, alocações, custos e pagamentos continuam com as rotinas existentes, usuário autenticado e imagens anteriores/atuais. O botão **Logs** do item continua em `recordEvents`; **Logs Exclusão** continua em `deletions`. Os dois foram comparados integralmente entre definições publicadas antes e depois. Os logs técnicos de consulta do runtime continuam funcionando normalmente.

## Publicação e validação

Fontes Scriptcase em `root@192.168.0.170:22:/var/www/clients/client1/web2/web/ciw/cons_itens_compra_alocado`, incluindo o arquivo de lookup. Cópias sanitizadas em `sources/scriptcase/purchase-pending`; manifesto `integration-src/ciw-inventory/purchase-allocations-source-manifest.json`. Candidatos em `integration-src/purchase-allocations`; metadados canônicos em `D:/opencode/construtor-pg/integrations/ciw-purchase-allocations` e draft de itens atualizado também em `integrations/ciw-purchase-items`.

Build6 oficial no `.42`, OpenEdge12.2:11entradas compiladas e83verificações em cada uma das quatro combinações UTF8/ISO8859-1×AMERICAN/EUROPEAN, sem banco conectado nos testes. São27novas e56regressões dos leitores existentes. Suite PHP:874testes/5780asserções. Validadores nativos PHP/JS e revisão independente semP1/P2 restantes.

Nove arquivos canônicos integrados por hash e backup. Oito artefatos ABL publicados no compartilhamento `.137` via `.111`; compilados de fixtures e testes não foram publicados. PASOE `sursum-api/med`, porta oficialHTTPS9911, testes pelo túnel19910→9910 da mesma instância. Recarga somente de sessões MED ociosas. Consulta/detalhe/totais/paginação/contexto e seis negativas validados no PASOE; consulta e detalhe pelo runtime nativo também passaram. Nenhum registro de negócio foi criado ou alterado.

A revisão identificou e corrigiu a entrada inicialmente ausente do dispatcher. O reteste nativo identificou a necessidade do alias da chave no detalhe; o teste adicional ficou vermelho no build5 e verde no build6. Builds anteriores não são a prova final. Primeira implantação preservada nos recibos `initial-*`; a correção usou novo stage, hashes e backups em `detail-fix`, sem repetir scripts da primeira publicação.

Evidências privadas em `.runtime/purchase-allocations-20261026`: recibos de compilação, integração/publicação, revisão, provas PASOE/runtime, `detail-fix/` e screenshots. Nenhuma credencial consta destes documentos.

## Acesso e pendências

A nova consulta exige somente `proc_compra_alocacoes_progress.read`. Após a mensagem “siga”, em resposta à solicitação específica, essa única permissão foi aplicada para `tadeu.parreiras`. A verificação independente confirmou integridade nativa, preservação dos demais acessos e atualização das quatro sessões LDAP existentes. A sessão do navegador abriu lista, detalhe e a aba contextual Alocações, sem ações de manutenção nessa consulta. Recibos em `access/{applied,verified,authorization-used}.json`; autorização consumida e gate desabilitado, sem reaplicação. Evidências `ui-ldap-detail.jpg` e `ui-ldap-tab.jpg`. As abas temporárias foram fechadas e as do usuário preservadas.

**Controles permanece como pendência final**, conforme `context/PENDENCIAS_FINAIS.md`. Fluxos independentes de sinalização e envios em lote continuam separados; não foram declarados convertidos por esta entrega.
