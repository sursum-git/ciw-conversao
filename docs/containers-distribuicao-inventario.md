# Distribuição central de custo — inventário e contrato

Estado em 16/10/2026: implementação isolada e testes TT auxiliares; não publicada e sem execução de escrita em banco real. O usuário decidiu usar a **empresa do container**. O provider de produção injeta `company_policy=container_company`; a opção literal2 permanece apenas explícita no núcleo para comparar a origem e testar a divergência, sem escolha pelo cliente.

## Fontes e fórmulas comprovadas

- `sources/scriptcase/containers/bl_item_custos/index.php:15968–16102`: durante a versão, calcula o rateio das despesas gerais, soma despesas exclusivas e subtrai **todos** os valores históricos de `item_container_custos.vl_custo_distribuido` do item. O snapshot recebe o valor sem ROUND2; o lançamento recebe ROUND2. Só cria lançamento se esse arredondamento for diferente de zero.
- `sources/scriptcase/containers/bl_distribuir_custo_contr/index.php:9564`: `getVlDespADistribuir` seleciona vínculo de despesa na empresa **2**, sem filtro de atividade; soma `vl_negociado - vl_prev` somente para `log_custo=1`, negociado diferente de zero e superior ao previsto. Despesa geral tem `item_container_id=0`; exclusiva tem o ID do item.
- Mesmo arquivo, `:10233`: `getVlDistrContainer` exige as flags de container/situação e `ind_distr_custo` diferente de zero. Usa produtos de valor × quantidade confirmada; se o produto tributado confirmado é zero, usa os produtos com quantidade alocada. Peso é `MAX(negociado - tributado, 0)`.
- Mesmo arquivo, `:6648`: habilitação automática exige ambas as flags, no container e na situação. A flag global IMA `gerar_distr_custo` é distinta.
- Mesmo arquivo, `:16627`: acumulado anterior vem de snapshots de **todas** as versões do item, não da conta corrente nem só da última versão.
- Mesmo arquivo, `:9956–10043`: conta corrente usa `seq_cta_corren_custo_distr`, data corrente, login autenticado, tipo 3 automático ou 4 retorno. A flag global desligada zera o valor mas mantém a inclusão e a memória dessa condição. Despesa é inclusão própria com `seq_despesas_container`, parâmetro `despesa_distr_custo`, `vl_prev` igual ao movimento, `vl_negociado=0`, `log_manual=true`, vínculo no campo `cta_corren_custo_distr_id`.
- Mesmo arquivo, `:5480–5501`, e `grid_itens_container_comparacao/grid_itens_container_comparacao_grid.class.php:11543–11576`: retorno próprio usa o total tipo 3 do item e cria tipo 4 com sinal negativo. A quantidade recebida do navegador não será aceita; o total será consultado no banco. A conversão USD seguida de multiplicação pela mesma cotação não muda o valor canônico em reais.

Fórmula automática por item: `pool × peso_item / soma_pesos + exclusivo_item - distribuido_historico`. Pool não positivo dispensa divisão. Pool positivo sem soma de pesos válida gera erro explícito. Nenhum cálculo geral de custo é copiado: versão e simulação reutilizam o adaptador/coletor e os calculadores centrais existentes. Conferência posterior do dicionário confirmou DECIMALS2 no campo físico do snapshot: plano/memória conservam o bruto10, persistência respeita2, com aviso estruturado. A passagem sem ROUND no PHP não significa que o banco consiga armazenar dez casas.

## Correções explícitas e pontos de integração

- A variável `logNovaVersao` é sobrescrita em cada item no PHP. O novo plano usa OR de todos os movimentos necessários, inclusive quando o último item é zero.
- O PHP deriva o container da conta corrente pelo campo de item direto, mas o lançamento automático tipo 3 grava esse campo como zero. O serviço passa o container já validado explicitamente à despesa e informa a correção na origem.
- A geração automática antiga pode chamar novamente a si mesma e consulta última versão global. O fluxo novo é acíclico, limitado à versão inicial e no máximo uma versão adicional do mesmo container; um novo delta na segunda etapa causa `UNSTABLE_DISTRIBUTION` e desfaz tudo.
- `criarDespesaDistrCusto` inclui uma despesa por movimento, inclusive repetindo despesa/item com contas correntes distintas. O fiscal central foi estendido e testado para reconhecer exclusivamente esses vínculos gerenciados com prova física do runtime. Duplicatas comuns e bases FIRST ambíguas continuam recusadas. Não transformar inclusões em upsert ou apagar o histórico.
- Companhia é política privada obrigatória: `legacy_company_2` preserva o literal2; `container_company` usa a empresa do container. Não existe default e o navegador não escolhe. Ambas têm testes; a decisão humana de16/10 fixou **container_company na produção**.

## ABI e efeitos

Calculador puro `ContainersDistribuicaoCalculator.p`: INPUT/OUTPUT `JsonObject`; dados confirmados e nomes físicos explicitados em sua documentação. Não possui handles, SQL, HTTP ou escrita. Mesmo plano atende simulação e execução; mantém delta de snapshot com precisão decimal 10 e valor de lançamento com ROUND2.

Serviço proposto/aprovado: INPUT HANDLE em ordem `phContainer, phEmpresas, phSituacoes, phItems, phPurchaseItems, phCompanyExpenses, phExpenseDefs, phLedger, phVersionItems, phVersions, phExpenses`, seguido por `phRuntime`, `poPolicy`, `poRequest`, OUTPUT `poResponse`. Política inclui ator autenticado, `company_policy`, `gerar_distr_custo`, `despesa_distr_custo` e permissão privada de composição. Dicionários correspondentes já existem em `integration-src/container-panel/schema`; não faltam tabelas conhecidas para esse escopo.

Callbacks de runtime: `NextDistribuicaoId(OUTPUT INTEGER)`, `NextDespesaId(OUTPUT INTEGER)`, `LogRule(INPUT CHARACTER level, INPUT CHARACTER message)`, `GenerateFollowupVersion(INPUT HANDLE master, INPUT JsonObject context, OUTPUT JsonObject result)`. Contexto da geração contém `expected_latest_version_id` e `reason`.

Operações privadas `version` e `version_check` recebem `container_id, version_id, item_mappings, snapshot`. Mappings pareiam `item_container_id` e `item_container_custo_id` criados pelo mesmo VersionService. `version_check` coleta e avalia o mesmo núcleo sem alterar snapshots, conta corrente, despesas ou mestre; retorna plano e `requiredNewSnapshot`. O runtime exige false na segunda versão. Operações de usuário têm contrato próprio fechado; nunca permitem selecionar companhia, perfil, composição ou valores financeiros.

Escritas usam mestre exclusivo como unidade de serialização, verificam a versão esperada antes de mutar e respeitam os locks dos filhos. Dentro de transação externa retornam apenas `committed=false`, `pendingChanges` e memória; o ancestral confirma e registra o audit após commit próprio. Falhas desfazem integralmente os efeitos. Snapshots incluem alterações de itens, novos movimentos/despesas e mestre; não há audit antecipado nem flush dentro de transação.
