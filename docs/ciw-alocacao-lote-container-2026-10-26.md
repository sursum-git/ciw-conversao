# Alocação de itens de compra em lote — 26/10/2026

A conversão de `control_selec_proc_compra` e `grid_itens_proc_compra_selecao` usa a tela nativa `ciw.container-alocar-itens`, programa `op1025`, versão `1.0.0`. O painel `ciw.container-painel` foi publicado em `1.0.8`, com a aba **Alocar itens** e um link na consulta; suas 14 abas anteriores foram preservadas.

## Comportamento

O Kendo MultiSelect pesquisa por pedido, código ERP, descrição, empresa, fornecedor e saldo. Cada comando aceita de 1 a 25 IDs distintos. O servidor calcula o saldo disponível global; o navegador não informa quantidades. A seleção preserva o escopo global do Scriptcase, inclusive pedidos de empresa ou fornecedor diferentes do container. Uma alocação já existente é preservada e informada como ignorada. Para alocar parcialmente, continua disponível a manutenção individual.

O planejamento bloqueia o container e os itens de compra em ordem de ID, confere todos os saldos antes de consumir sequências e executa uma única transação. Uma falha cancela o lote inteiro. Abrir a aba somente consulta opções; processar exige permissão própria e confirmação Kendo.

## Reutilização e auditoria

- `ContainersAllocationBalance.p` é a regra única de saldo usada pela manutenção, consulta de opções e lote.
- `ContainersItensBatchService.p` chama `ContainersItensCrudService.p` como participante da transação raiz. Impostos e financeiro continuam nas rotinas existentes; suas fórmulas não foram copiadas.
- `ContainerTransactionAudit.i` consolida efeitos mantendo a primeira imagem anterior e a última atual. A imagem final física dos itens é conferida antes de confirmar a transação. O comportamento dos consumidores anteriores da include foi preservado.
- `RuntimeContainerAllocationAudit.php` valida rota, origem, operação, contexto, usuário autenticado, confirmação de commit e imagens físicas completas. A quantidade de alocados e ignorados precisa corresponder exatamente à seleção. Os logs usam as classes existentes e ficam disponíveis pelo botão **Logs** do comando e do container, respeitando o tenant. Logs Exclusão continua restrito às exclusões.
- `RuntimeProcessLookupPolicy.php` é compartilhada pelo Builder e pelo runtime: fontes de seleção precisam ser operações de leitura e usar exatamente o contexto fixo do processo. Rotular uma escrita como `list` não permite executá-la ao abrir a tela.

## Cadastro das APIs

Fonte própria `motor_progress_container_alocacao`, com quatro operações: `painel_read`, `painel_get`, `itens_alocacao_disponiveis` e `allocate`. A operação gravadora usa a rota existente `containers-itens`, recurso fixo `container-alocacoes`, operação `allocate`. A fonte anterior de itens, suas seis operações e a tela individual foram preservadas.

Metadados canônicos: `D:/opencode/construtor-pg/integrations/ciw-container-allocation/`. Fontes ABL: `D:/opencode/motor-progress/v2/sursum-api/programs/` e `sursum-api/includes/ContainerTransactionAudit.i`. Nenhuma biblioteca Kendo ou estrutura de banco foi alterada.

## Validação e implantação

Compilação oficial no `.42`, OpenEdge 12.2: 20 entradas e fixture de teste compilado separadamente. São 313 verificações em cada combinação UTF-8/ISO8859-1 e AMERICAN/EUROPEAN, em tabelas temporárias, sem conexão de banco durante os testes. Incluem lote, manutenção individual, opções, composição fiscal/financeira, pagamentos, versões e consolidação antiga de logs. A compilação usa o dicionário apenas para resolver referências estáticas.

PHP canônico: 874 testes, 5780 asserções. Teste isolado com Kendo real confirmou MultiSelect, rótulos escapados, bloqueio durante carregamento, cancelamento sem POST e IDs inteiros. Revisão independente encerrou o achado sobre opções gravadoras após os testes de regressão.

Foram integrados 26 arquivos canônicos e publicados 15 artefatos ABL na montagem `.137`, por hashes e backups. Somente as sessões MED ociosas da instância `sursum-api` foram recarregadas. Destino oficial HTTPS 9911; o túnel local 19910 aponta para 9910 da mesma instância. No PASOE real, a nova consulta retornou 81 opções e quatro lotes estruturalmente inválidos foram recusados sem commit. O Builder publicou filho e pai pelo fluxo governado; a definição nativa, opções e botão Logs foram conferidos pela sessão administrativa própria. Não foi executado lote válido em container existente.

## Cenário operacional concluído

O usuário autorizou expressamente as duas permissões e o cenário novo. Foram aplicadas somente `op1025.read` e `op1025.process` para `tadeu.parreiras`, preservando os demais acessos e quatro snapshots LDAP. A tela e o botão Logs foram conferidos na sessão LDAP.

O cenário `SC_TEST_ALOC_LOTE_20261026` criou processo `1687`, itens `3208/3209/3210` com quantidades `3/5/0` e container `2147000107`. O lote de saldo inválido foi recusado com 409 sem alocações. O lote válido criou `3285/3286`, transação **30058**, com dez eventos e usuário real **tadeu.parreiras**. A repetição, transação **30060**, ignorou os dois vínculos e não duplicou registros. Todas as imagens finais foram reconciliadas integralmente com leitura física independente no OpenEdge 12.2.

O código alfanumérico autorizado `ZTSC261026` exigiu preparação privada: a API preserva sua validação de códigos numéricos. Os três IDs foram gerados pelas APIs com código vazio; uma fixture privada 12.2 atribuiu somente esse campo nos três registros novos, após comparar suas imagens físicas e comprovar a ausência de vínculos. Nenhum cadastro mestre ERP ou estoque foi criado, e a validação da aplicação não foi alterada.

A limpeza pelas APIs removeu todos os registros novos e seus efeitos. Foram cinco despesas e quatro cabeçalhos de cálculo no total, incluindo os recálculos durante a exclusão; os limites autorizados foram respeitados. A inspeção física final zerou os onze grupos do cenário. Os 56 logs do escopo, inclusive as imagens originais dos dez eventos da transação 30058 e os eventos de exclusão, foram preservados. Triggers e registros operacionais existentes foram preservados; não houve DDL nem reset de sequências.

Estado final **COMPLETED_CLEANED**, autorizações consumidas e gates falsos. Não repetir integração, publicação, grants, cenário ou limpeza. Controles continua na pendência final.

Recibos privados em `.runtime/container-allocation-batch-20261026/`, especialmente `final-verification.json`, `authorizations-used.json`, `physical-after/probe.json`, `exercise/batch-logs-proof.json`, `exercise/physical-audit-reconciled.json` e `access/verified.json`. Evidências visuais: `ui-ldap-ready.jpg` e `ui-logs-30058.jpg`.
