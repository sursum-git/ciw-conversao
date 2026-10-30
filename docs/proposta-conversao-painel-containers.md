# Proposta de conversão do painel de containers

Data: 16/10/2026. **Somente análise estática e proposta. Nenhum painel, aba, processo ou API descrito aqui foi implementado, cadastrado ou publicado por este documento.** A entrega da consulta principal é independente. Esta análise não abriu aplicações Scriptcase, não consultou bancos e não executou ações de negócio.

## Escopo e critério de evidência

O alvo é o primeiro botão da linha de `grid_pp_container`, campo `painel`, da consulta Container's. `cons_pp_container_filtro_fornecedor` confirma uma ligação equivalente, mas sua conversão fica fora deste escopo. Os caminhos abaixo são relativos a `D:/opencode/conversao-sc/`, salvo quando começam por `D:/opencode/construtor-pg/`.

Foram lidos os `index.php` e os arquivos de aplicação/grade locais dos programas indicados nas evidências. Um `UPDATE` encontrado dentro de uma função replicada não demonstra execução na abertura. As conclusões abaixo distinguem entrada/evento ativo, dependência alcançável e programa cujo fonte ainda não foi baixado. Schema físico, precisão, índices, triggers, permissões efetivas e resultados de cálculo ainda exigem validação própria.

## Caminho efetivamente chamado

```text
grid_pp_container.painel
  → bl_ponte_painel_container
      → menu_container
          → form_pp_container (entrada padrão: Dados)
          → demais botões de navegação/processamento
```

O botão envia `container_id_corrente` e `container_corrente`, ambos com `sc_field_10`/número do container, além do parâmetro técnico `nmgp_lig_edit_lapis=S`. Evidência: `sources/scriptcase/containers/grid_pp_container/grid_pp_container_grid.class.php:5700`, `:5715` e `:5717`. A consulta por fornecedor possui o mesmo destino em `sources/scriptcase/containers/cons_pp_container_filtro_fornecedor/cons_pp_container_filtro_fornecedor_grid.class.php:4680`.

A ponte busca descrição, fornecedor, data de registro e empresas EMS2/EMS5, repõe as variáveis de sessão e **redireciona diretamente para `menu_container`, passando `desccontainer`**. Evidência: `sources/scriptcase/containers/bl_ponte_painel_container/index.php:4923`, `:4932`, `:4936`, `:4940`, `:4944`, `:4949` e `:4957`.

`bl_painel_container` também contém uma entrada que prepara contexto e redireciona ao menu (`sources/scriptcase/containers/bl_painel_container/index.php:5111` e `:5145`). **Não é um elo intermediário do primeiro botão analisado**: a ponte não o chama. Não convém criar duas telas novas apenas porque existem esses dois nomes legados.

O menu mostra `desccontainer` no cabeçalho (`sources/scriptcase/containers/menu_container/index.php:1855`) e abre `form_pp_container` por padrão (`:2639` e `:2642`). `form_containers` é outro programa; seu fonte não substitui a análise de `form_pp_container`.

## Contexto a transportar

| Dado legado | Origem e uso evidenciados | Proposta |
|---|---|---|
| `container_id_corrente`, `container_corrente` | Número selecionado; ponte `index.php:4925` | Uma chave pública `container_id`, obrigatória, validada no servidor e vinculada à PK real `nr-container` |
| `desccontainer` | Ponte `index.php:4957`; menu `index.php:1855` | Descrição retornada pela API, somente apresentação |
| `fornecedor_container_corrente` | Ponte `index.php:4932`; busca `:7046` | Derivar do container autorizado, sem confiar no valor do navegador |
| `dt_reg_container_corrente` | Ponte `index.php:4936`; busca `:7105` | Retornar data calculada e explicitar ausência; decidir sobre os defaults históricos de 2015/2005 |
| `empresa_container_corrente_ems2/ems5` | Ponte `index.php:4940`, `:4944`; mapeamento `:7129` | Derivar estabelecimento/empresa no backend; não aceitar nomes de conexão como parâmetro |
| Moeda | Wrapper Itens `index.php:2713` a `:2729` | Enumeração explícita `real`/`dolar`; valor inicial definido, sem dependência de sessão anterior |
| Rastro do dólar | Grade Itens `grid_itens_container_grid.class.php:578`, `:599`; Comparativos `:585`, `:588` | Recalcular por container/requisição; não reutilizar HTML global de uma aba anterior |

As referências abreviadas desta tabela pertencem às respectivas pastas em `sources/scriptcase/containers/`.

## Abas e botões do menu

Os itens são botões da toolbar legada; a conversão pode apresentá-los em abas e ações nativas, preservando a finalidade. Todos usam o contexto do container preparado pela ponte, sem passagem explícita de parâmetros de negócio na URL do menu.

| Botão legado | Destino e evidência em `sources/scriptcase/containers/menu_container/index.php` | Conversão proposta |
|---|---|---|
| Dados | `form_pp_container`, `:2884` | Formulário CRUD do container, inicialmente somente leitura; edição em fase posterior |
| Resumo | `bl_resumo_container`, `:2889` | Consulta de indicadores calculados; página/relatório nativo com valores e avisos |
| Itens | `bl_chama_grid_itens_container`, `:2894` | Página CRUD filha vinculada por `container_id`; wrapper vira contrato explícito de moeda/contexto |
| Despesas | `grid_despesas_container`, `:2899` | Página CRUD filha, filtrada pelo container e pela empresa derivada |
| Pagtos | `cons_tit_ap_associados_container`, `:2904` | Consulta dos títulos associados, separando associação/desassociação em ações autorizadas |
| NFs | `bl_selecionado_nf`, `:2909` | Consulta das NFs vinculadas; associação como processo próprio |
| Anexos | `form_anexos_container`, `:2914` | Cadastro de metadados e serviço de arquivos; avaliar suporte de attachments antes de prometer paridade |
| Versões Custo | `bl_ponte_versoes_item_custo_container`, `:2919` | Consulta de versões; geração/fechamento em processo explícito |
| Atualizar Cálculo Imposto | `bl_sincronizar_impostos`, `:2924` | **ProcessEngine**, com execução intencional, permissão, transação e resultado confirmado |
| Comparativos Custo | `grid_itens_container_comparacao`, `:2929` | Consulta/relatório comparativo; distribuição e simulação como ações separadas |
| Rastro Dólar Médio | `bl_rastreabilidade_dolar`, `:2934`, abre `_blank` | Relatório estruturado do cálculo corrente, com origem/valores, por container |
| Voltar | `bl_voltar_selecao_container`, `:2939` | Navegação para a consulta, mantendo filtros de origem |

### O que os wrappers realmente fazem

- **Itens:** normaliza moeda para real quando `moeda_param != 'dolar'` e chama `grid_itens_container` passando `container_param=container_corrente`. Evidência: `sources/scriptcase/containers/bl_chama_grid_itens_container/index.php:2713` e `:2729`. Há inicialização anterior de `moeda_param` com vazio; o teste `isset` posterior não garante que o default dolar seja aplicado. Definir o default no contrato novo.
- **NFs:** lê `nfs_container`, monta condição pelas chaves documento/série/estabelecimento e guarda `acao_associacao_nf='associar'`, chamando `cons_docum_est_importacao`. Não executa uma associação apenas por esse nome de variável. Evidência: `sources/scriptcase/containers/bl_selecionado_nf/index.php:5294`, `:5296`, `:5302`, `:5326`. O fonte do destino não foi baixado.
- **Versões:** copia `container_corrente` para `filtro_versao_item_custo_container` e chama `cons_versoes_item_custo_container`. Evidência: `sources/scriptcase/containers/bl_ponte_versoes_item_custo_container/index.php:2711` e `:2718`. O fonte da consulta de versões não foi baixado.
- **Rastro:** apenas apresenta `log_dolar_medio_corrente` já calculado em sessão. Evidência: `sources/scriptcase/containers/bl_rastreabilidade_dolar/index.php:2707` e `:2725`. Portanto, abrir esse botão isoladamente pode usar conteúdo anterior; propor contrato novo com cálculo/identidade do container na resposta.
- **Voltar:** redireciona para `grid_pp_container` em `_parent`. Evidência: `sources/scriptcase/containers/bl_voltar_selecao_container/index.php:2705`.

## Escritas ativas e limites da abertura

**Abrir Dados já pode escrever auditoria legada.** `form_pp_container.nm_proc_onload` chama `preencherIDLog` (`sources/scriptcase/containers/form_pp_container/form_pp_container_apl.php:7292`). Essa função consulta logs `insert/update/delete` sem `id_chave`, filtrados pela aplicação (`:18254`), interpreta a descrição e executa `update sc_log set id_chave=...` na conexão `log_imp_mysql` (`:18291` e `:18296`). O filtro não é limitado ao container atual. Não transportar essa reparação de históricos para uma API de leitura; usar a auditoria nativa confirmada por transação.

A ponte possui log de acesso condicional (`sources/scriptcase/containers/bl_ponte_painel_container/index.php:4843`); o menu chama o log de acesso em `sources/scriptcase/containers/menu_container/index.php:1557`. São escritas técnicas em `sc_log`, distintas das tabelas de negócio.

**Abrir Atualizar Cálculo Imposto executa a ação.** A entrada chama `zerarLogDb()` e `sincronizarImpostos(container)` antes de montar a mensagem HTML (`sources/scriptcase/containers/bl_sincronizar_impostos/index.php:5469` e `:5471`). O caminho ativo cria cálculo, calcula impostos, gera despesas, registra auditoria e sincroniza IPI por item (`:10431` a `:10436`). Há escrita em `calcs_imp_container` (`:10103`), atualização da memória (`:10152`) e inserção/atualização de `despesas_container` (`:9668`, `:9932`). Isso não deve ser carregado como uma aba de leitura, nem ser executado em prefetch.

**Salvar Dados tem efeitos além do cabeçalho.** No evento de update há chamadas a `sincronizarImpostos` e `atuDespsCalcContainer` (`sources/scriptcase/containers/form_pp_container/form_pp_container_apl.php:9111`, `:9123`, `:9124`). Se os parâmetros de dólar diferem, marca a versão de custo desatualizada (`:9151` a `:9153`; SQL em `:19626`). Há, ainda, alterações de estado de apresentação no onLoad (`local_exibir_cps_dolar`, `:9956`), incluindo atribuição de projeção padrão; distinguir rascunho exibido de dado persistido. CRUD genérico do cabeçalho sem essas regras não equivale ao original.

**Pagtos inicia logging configurável.** A abertura da grade chama `zerarLogDb` (`sources/scriptcase/containers/cons_tit_ap_associados_container/cons_tit_ap_associados_container_grid.class.php:562`); a implementação pode chamar `iniciarLogDb` conforme configuração do usuário (`:14612` a `:14620`), que insere em `logs` (`:14437`). Não inferir exclusão de logs pelo verbo “zerar”.

**Resumo:** as chamadas ativas partem de `buscarVlCustoTotalContainer`, `buscarVendasContainer` e `buscarCotacaoVendaContainer` (`sources/scriptcase/containers/bl_resumo_container/index.php:5473`, `:5490`, `:5494`). O corpo de `inserirLogSQL` está vazio (`:9739`). Não foi evidenciada escrita de negócio no caminho local dessas chamadas. Não atribuir ao Resumo as rotinas de sincronização, pagamentos ou versões apenas porque suas definições estão no mesmo arquivo.

## Dependências de dados evidenciadas

Não é um inventário físico completo nem uma afirmação de FK. São relações consultadas no PHP ou escritas pelo caminho descrito.

| Domínio | Tabelas/conexões evidenciadas | Evidência |
|---|---|---|
| Contexto do container | `espec.pp-container`, `itens_container`, `itens_proc_compra`, `procs_compra`, `empresas` | Ponte `index.php:6816`, `:7111`, `:7143` |
| Itens | `espec.itens_container`; quantidade alocada/embarcada/recebida e item do processo | `sources/scriptcase/containers/grid_itens_container/index.php:1325`; grade `:1101` |
| Despesas | `empresas_despesa`, `despesas_container`, `despesas`; filtro empresa derivada | `sources/scriptcase/containers/grid_despesas_container/index.php:1302`; grade `:492`, `:743` |
| Títulos | `tit_ap`, `val_tit_ap` em EMS5; vínculo `espec.pagtos_container` | `sources/scriptcase/containers/cons_tit_ap_associados_container/index.php:1275`; Resumo `index.php:9134`, `:16945` |
| Notas | `espec.nfs_container`, `item-doc-est` na conexão derivada | Resumo `index.php:16522`, `:16684`, `:16702` |
| Vendas | `espec.ped-venda-ext` com `ima/med.ped-venda` e `ped-item`, conforme prefixo estabelecimento | Resumo `index.php:13869` a `:13888` |
| Custo/abatimentos | `cta_corren_custo_distr`, `descontos_importacao`, `motivos_desconto`, `cta_corren_desconto` | Resumo `index.php:8043`, `:16314`, `:16348` |
| Cotações | `hist_cotacoes_bc` para última cotação e configuração no container | Resumo `index.php:6030`, `:6052`, `:14707`, `:14713` |
| Parâmetros | `espec.im-param`; espécies de adiantamento/título e natureza da nota mãe | Resumo `index.php:9164`, `:9179`, `:14240`, `:14658` |
| Anexos | `espec.anexos_container`, `tipos_anexo`; caminho de arquivo e data/hora | `sources/scriptcase/containers/form_anexos_container/index.php:5623`, `:6293`; aplicação `:4612` |
| Auditoria legada | `sc_log`, `logs`, `itens_log`, conforme conexão da aplicação | Dados aplicação `:18259`, `:18296`; Pagtos grade `:14437`, `:14519` |

As referências “Ponte” e “Resumo” nesta tabela significam `sources/scriptcase/containers/bl_ponte_painel_container/` e `sources/scriptcase/containers/bl_resumo_container/`. Não copiar o roteamento SQL dinâmico do legado. Para APIs novas, usar buffers fixos e vínculos de empresa/estabelecimento autorizados no servidor. Parâmetros IMA devem usar **`sursum-api/includes/parametros_ima.i`, consulta direta NO-LOCK a `espec.im-param`, sem cache**, conforme instrução atual do projeto. O cache de sessão presente no PHP (`Resumo index.php:14244` e `:14259`) não deve ser reproduzido.

## Ações descendentes já visíveis e fontes faltantes

| Origem | Ação/destino evidenciado | Situação |
|---|---|---|
| Itens | Buscar Itens Pedidos de Importação → `control_selec_proc_compra`; Calcular Custo item → `bl_item_custos` | `sources/scriptcase/containers/grid_itens_container/grid_itens_container_grid.class.php:6610`, `:6638`; fontes dos destinos não baixadas |
| Despesas | Gerar Despesas Container → `cons_selec_despesas`; Manutenção Rápida → `form_despesas_container_multi_reg` | `sources/scriptcase/containers/grid_despesas_container/grid_despesas_container_grid.class.php:5484`, `:5532`; fontes dos destinos não baixadas |
| Despesas/valor previsto | Cálculo → `cons_calcs_imp_container`; memória → `cons_despesas_container_memoria_calculo` | Mesma grade `:3973`, `:3988`; fontes não baixadas |
| Pagtos | Buscar Adiantamentos → `cons_tit_ap_associar_container`; Buscar Títulos Após NF → `cons_tit_ap_associar_container_apos_di` | `sources/scriptcase/containers/cons_tit_ap_associados_container/cons_tit_ap_associados_container_grid.class.php:5402`, `:5418`; fontes não baixadas |
| Comparativos | Simulação → `ctrl_simul_distr_custo`; distribuição → `bl_distribuir_custo_contr`; Calcular Custo item → `bl_item_custos` | `sources/scriptcase/containers/grid_itens_container_comparacao/grid_itens_container_comparacao_grid.class.php:4334`, `:4361`, `:6609`; fontes não baixadas |
| NFs / Versões | `cons_docum_est_importacao` / `cons_versoes_item_custo_container` | Wrappers descritos acima; fontes dos destinos não baixadas |

Esses destinos são pendências de análise, não regras deduzidas pelos nomes. A existência de funções de gravação replicadas nas grades não demonstra que cada botão as executa. Antes de converter exclusões, associações, custos, distribuição e versões, rastrear o evento concreto e a aplicação destino completa.

## Como reutilizar o construtor

1. **Consulta CRUD separada do formulário.** O primeiro botão abre uma tela por `screenId`/chave do registro. Usar o contrato nativo; manter a consulta principal independente do painel. Referência: `D:/opencode/construtor-pg/docs/contrato-motor-progress.md:319` e `:321`.
2. **Abas independentes com `linkedPage`.** Dados mestre e consultas filhas podem evoluir separadamente. As abas devem instanciar páginas por `screenId`, com vínculo `container_id=nr_container`, contexto declarado e autorização no endpoint. O recurso atual injeta páginas CRUD no DOM. Não pressupor que aceite embutir ProcessEngine/report. Referência: `D:/opencode/construtor-pg/docs/arquitetura-crud-engine.md:77`, `:87`, `:101`.
3. **`master_detail` quando o formulário for um conjunto de manutenção.** É alternativa para mestre/filhos com ciclo de edição definido. Antes, confirmar suporte à persistência externa Progress de todas as operações e ao commit único do grafo; não presumir que o handler transacional local faça transação entre APIs remotas. Começar com container persistido e filhas independentes, se isso atender a regra. Referência: `D:/opencode/construtor-pg/docs/continuidade-codex.md:30` e `:33`.
4. **ProcessEngine para efeitos de negócio.** Sincronizar impostos, calcular custo, gerar despesas, associar pagamentos/NFs e distribuir custo devem ter operações específicas, payload fechado, permissões e estado de execução. A abertura da tela de processo deve consultar/preparar; a execução é ação explícita. Referência: `D:/opencode/construtor-pg/docs/arquitetura-crud-engine.md:12`, `:784`, `:978`.
5. **Report para comparação/rastro/exportação.** Resultados tabulares e memória estruturada podem usar `pageType=report` com endpoints `run/export`. Resumo de indicadores pode usar página nativa adequada após confirmar contrato; não transportar HTML PHP como template JSON. Referência: `D:/opencode/construtor-pg/docs/contrato-motor-progress.md:806` e `:836`.
6. **Attachments: gap a confirmar.** Metadados de `anexos_container` cabem em CRUD filho; arquivos exigem upload/download autenticado, armazenamento, limites e compatibilidade com anexos legados. Não foi encontrado contrato `attachments` de negócio nos módulos/documentos de CRUD inspecionados. A integração de fonte API documenta ausência de upload em `D:/opencode/construtor-pg/docs/arquitetura-crud-engine.md:375`. Portanto, não declarar que apenas um JSON já entrega upload para Progress. Verificar recurso reutilizável existente ou estender o mecanismo genérico, sem frontend paralelo.

## Gaps e decisões antes da implementação do painel

- **Contrato real das APIs filhas:** escolher PKs, campos, tipos, paginação, escala, null/unknown, datas, locks, permissão e vínculo container/empresa a partir do dicionário e fontes completas.
- **Atomicidade:** salvar Dados dispara impostos/despesas e marca versão. Definir uma transação ABL que confirme o conjunto e devolva snapshots auditáveis; não anunciar sucesso antes do commit. Revisar procedimentos externos, erros parciais e efeitos em outras bases.
- **Resumo com assinatura divergente:** a chamada `buscarVlCustoTotalContainer($container,'','','real')` (`Resumo index.php:5473`) fornece quatro argumentos, mas a definição declara apenas `($containerId,$moeda)` (`:10958`). O quarto argumento não é o segundo parâmetro `moeda`; validar os valores esperados antes de portar a regra.
- **Cálculos e cantos legados:** testar dólar zero/ausente, paridade 1, prioridade/projeção, natureza da nota mãe, divisão por zero, custo liberado, descontos, situação de pedidos e moeda. O Resumo agrupa previstas nas situações 1/2/4/7 e reais em 3 (`Resumo index.php:5519`); conversão de moeda em `:5535`; aviso da cotação em `:5538`. Paridade 1 real não deve ser confundida automaticamente com falta de cotação.
- **Escopo de sessão:** substituir variáveis globais por contexto por página e validação no servidor, para duas abas de containers não contaminarem fornecedor, empresa, moeda ou rastro uma da outra.
- **Históricos:** auditoria nativa registra nova execução e autoria; não reescrever logs legados durante leitura, nem atribuir autoria histórica à sessão atual.
- **Fontes descendentes:** obter as aplicações faltantes listadas acima antes de habilitar suas ações. Esta proposta não cobre regras ainda não observadas.
- **Arquivos:** comprovar onde os arquivos antigos estão e como o usuário pode acessá-los; nenhum caminho do cliente ou JSON deve liberar leitura arbitrária do servidor.

## Fases propostas e critérios de aceite

| Fase | Entrega proposta | Aceite antes da próxima |
|---|---|---|
| 1 — Consulta | Consulta real de `grid_pp_container`; este documento acompanha a entrega | API somente leitura, filtros e colunas reais, nenhuma execução implícita do painel |
| 2 — Contexto e leitura | Dados em visualização, Itens, Despesas, Pagtos, NFs e versões existentes por container; telas filhas publicadas e depois vinculadas | Abrir/atualizar/alternar abas sem escrita de negócio; contexto fixo sobrevivendo a Limpar filtros; duas páginas sem mistura |
| 3 — Resumo e relatórios | Indicadores, comparativos e rastro com regras confirmadas | Comparação com casos reais autorizados, cálculo/referência/data transparentes e exportação por mecanismo nativo |
| 4 — Edição do container | Campos permitidos e efeitos de salvar implementados em serviço ABL transacional | Validação de concorrência/locks/rollback, snapshot anterior/atual confirmado e preservação dos demais registros |
| 5 — Processos | Impostos, custos, despesas, pagamentos/NFs, distribuição e versões conforme fontes completas | Execução intencional, permissão própria, repetição segura, sucesso confirmado e falha auditável |
| 6 — Anexos | Metadados e arquivos autenticados, compatibilidade com acervo | Limites/tipos/armazenamento/remoção definidos, vínculo e permissão comprovados |

Em cada fase futura com ABL executável: compilar no OpenEdge 12.2 do `.42`, publicar somente os artefatos pertinentes e validar em **sursum-api/med**, conforme a skill `motor-progress-publicar-pasoe`. Testes de escrita somente com registros novos identificados e removidos ao final. Atualizar a memória com a distinção entre proposta, exemplo preparado, fonte cadastrada e tela efetivamente publicada. Este documento, por si, não muda o estado de nenhum desses itens.
