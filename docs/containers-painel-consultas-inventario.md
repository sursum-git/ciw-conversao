# Painel de Container — inventário das consultas filhas

Análise estática em 16/10/2026, seguida de implementação parcial de leitura em fontes e testes com temp-tables. Não executa PHP nem consulta/escreve registros de negócio. O inventário funcional propõe contratos; o estado concreto da implementação parcial aparece ao final. Não comprova cadastro de fonte ou publicação de tela. Caminhos de evidência abaixo são relativos a `sources/scriptcase/containers/`. Ler também `docs/proposta-conversao-painel-containers.md` e `context/PROJECT_CONTEXT.md`.

## Contexto e limites comuns

- O mestre é `espec.pp-container`, chave funcional `nr-container`. As filhas usam `container_id` com esse valor. Não confundir com a aplicação antiga `form_containers`/tabela `containers`.
- Toda consulta recebe `container_id` obrigatório, inteiro positivo int32. O servidor busca o mestre NO-LOCK, verifica acesso e deriva estabelecimento, empresa e fornecedores. Esses valores não podem vir como autoridade do navegador.
- O vínculo mestre é condição fixa do endpoint; filtros opcionais e Limpar filtros nunca o removem. Requisições simultâneas não dependem de `$_SESSION['container_corrente']`.
- Os tipos, índices únicos, extents, formatos e tamanho físico das tabelas filhas ainda precisam de dicionário Progress. Campos abaixo são comprovados no PHP; não representam FKs físicas automaticamente.
- Leituras novas usam buffers fixos NO-LOCK. Parâmetros IMA usam `sursum-api/includes/parametros_ima.i`, consulta direta a `espec.im-param`, sem cache. O roteamento entre bases usa enumeração fechada no servidor.
- Reutilizar autenticação, envelope e padrão de tratamento de erros de `integration-src/containers/ContainersConsulta.p`/`ContainersConsultaService.p`; nunca aceitar tabela, conexão ou SQL em JSON.

## Itens

Evidências: `grid_itens_container/index.php:1325` (tabela), `:6644` (WHERE); `grid_itens_container_grid.class.php:1101` (SELECT), `:564` (cálculo), `:4469` (campos apresentados).

```sql
SELECT item_container_id, item_proc_compra_id, qt_alocada,
       qt_confirm_emb, qt_recbto_fisico, container_id
FROM pub.itens_container
WHERE container_id = :container_id
```

Identidade da linha: `item_container_id`; vínculo do pedido: `item_proc_compra_id`. O SELECT é insuficiente para equivalência visual: a grade chama `calcularCustoGeralItem(container,'','',moeda,'tributado',true,false)` ao iniciar. Busca descrição/código ERP do item de compra e descrição ERP. A descrição HTML deve tornar-se texto/campos separados.

Saída calculada efetivamente atribuída: `vl_merc_prev`, `vl_desp_prev`, `vl_total_prev`, `vl_unit_prev`, `vl_merc_real`, `vl_desp_real`, `vl_desc_item`, `vl_desc_container`, `vl_total_real`, `vl_unit_real`, `qt_saldo`. A liberação de custo controla apresentação dos realizados (`:560`); não retornar dados restritos apenas ocultando a coluna.

O default legado oscila entre `Dolar`, `dolar` e wrapper que normaliza outras entradas para real. Contrato novo deve usar enum case-sensitive `dolar|real`, default `dolar`, explicitamente. Valores financeiros ausentes não devem ganhar zero silenciosamente sem registrar origem/estado do cálculo.

Ações separadas: Buscar Itens Pedidos de Importação → `control_selec_proc_compra`; Calcular Custo item → `bl_item_custos`. Não executar em leitura/prefetch.

## Despesas

Evidências: `grid_despesas_container/index.php:1302`, `:5930`; `grid_despesas_container_grid.class.php:492` (empresa), `:932` (SELECT), `:3970` (memória), `:4000` (saldo a distribuir).

```sql
SELECT cad_desp.ordem, desp.despesa_id, desp.vl_prev, desp.vl_base_imp,
       desp.vl_negociado, desp.cta_corren_custo_distr_id,
       desp.despesa_container_id, desp.calc_imp_container_id,
       emp_desp.log_custo, desp.memoria_calculo,
       desp.vl_prev - desp.vl_negociado AS vl_distr,
       desp.item_container_id
FROM pub.empresas_despesa emp_desp, pub.despesas_container desp,
     pub.despesas cad_desp
WHERE emp_desp.despesa_id = desp.despesa_id
  AND cad_desp.despesa_id = desp.despesa_id
  AND desp.container_id = :container_id
  AND emp_desp.empresa_id = :empresa_derivada
```

Identidade: `despesa_container_id`. A empresa é derivada de `pp-container.cod-estabel` (primeiro caractere), mapeado em `empresas.cod_emp_ems2` → `empresa_id`; evidência compartilhada `bl_resumo_container/index.php:14872`. Não retornar uma despesa duplicada por cada empresa do cadastro.

`vl_distr` é expressão do SELECT. `vl_a_distr` é calculado em memória como `vl_negociado-vl_prev` somente se `log_custo=1` e negociado não zero, limitado a zero quando negativo. O link por `calc_imp_container_id` usa `cons_calcs_imp_container`; memória textual existente usa `cons_despesas_container_memoria_calculo` (segundo link sobrescreve o primeiro). Esses links são leitura de memória, distintos de recalcular.

Ações separadas: `cons_selec_despesas` e `form_despesas_container_multi_reg`; não transportar seus botões para uma fonte readonly com escrita genérica.

## Pagtos

Evidências: `cons_tit_ap_associados_container/index.php:1275`, `:6790`; `cons_tit_ap_associados_container_grid.class.php:562`, `:564`, `:974`, `:21405`; `bl_resumo_container/index.php:16940`, `:9117`.

Primeiro lê `espec.pagtos_container.num_id_tit_ap WHERE container_id=:container_id ORDER BY num_id_tit_ap`. Com lista vazia, retorna lista vazia. Depois consulta `ems5.tit_ap`:

```sql
SELECT cod_estab, cod_espec_docto, cod_ser_docto, cdn_fornecedor,
       cod_tit_ap, cod_parcela, dat_emis_docto, dat_vencto_tit_ap,
       cod_indic_econ, val_origin_tit_ap, num_id_tit_ap, cod_empresa
FROM pub.tit_ap
WHERE log_tit_ap_estordo = 0
  AND num_id_tit_ap IN (:ids_vinculados)
  -- restrições adicionais montadas em preencherCondPagtoContainer:
  AND cdn_fornecedor IN (:fornecedores_dos_itens)
  AND cod_empresa = :empresa_container_ems5
  AND dat_emis_docto >= :data_registro_container
```

Os três últimos filtros são condicionais no PHP: fornecedor usa lista dos itens ou fallback do fornecedor corrente; empresa e data só entram se disponíveis. A API deve derivar todos do container, sem sessão. Definir erro claro caso o vínculo não possa ser determinado, em vez de ampliar inadvertidamente a consulta.

Chave de resposta proposta: `pagamento_key` formada no servidor por `cod_estab` e `num_id_tit_ap`, pois `val_tit_ap` e `tit_ap` são unidos pelos dois campos. Confirmar índice do dicionário antes de usar como PK de manutenção. `cod_empresa` permanece na resposta e no filtro; não presumir unicidade global de um ID EMS5.

Valores real/dólar exibidos não são simples conversão de `val_origin_tit_ap`: `buscarVlMoeda` lê `val_tit_ap` por `cod_finalid_econ='corrente'|'dolar'`, ID e opcional estabelecimento, unido a `tit_ap`. Espécies de adiantamento usam valor original e espécies de título usam valor pago; fallback usa pago e depois original quando zero. Parâmetros: `especs_adiant_importacao` (default `'AF'`) e `especs_tit_importacao` (default `'DI'`). Não reproduzir substring como comparação de pertença sem teste de equivalência.

A abertura legada chama `zerarLogDb`, podendo iniciar logging em `logs`: não portar isso como escrita de negócio da leitura. Ações associar adiantamentos/títulos após NF e desassociar são operações específicas, com fonte/evento próprio.

## NFs

Fontes baixadas durante a análise: `cons_docum_est_importacao`. Evidências: `bl_selecionado_nf/index.php:5296`, `:5302`; `cons_docum_est_importacao/index.php:1287`, `:5887`; `cons_docum_est_importacao_grid.class.php:584`, `:998`.

Vínculos: `espec.nfs_container WHERE container_id=:container_id`, campos comprovados `documento,serie,estab,nat_operacao,cod_emitente` (`bl_resumo_container/index.php:16522`). A ponte constrói correspondência por documento/série/estabelecimento e abre `docum-est`; a string `acao_associacao_nf='associar'` só altera botões, não grava por si.

```sql
SELECT "cod-estabel", "nro-docto", "esp-docto", "serie-docto",
       "cod-emitente", "dt-emissao", "dt-trans", "nat-operacao",
       "tot-valor", "despesa-nota", "valor-embal", "valor-frete",
       "valor-mercad", "valor-outras", "valor-seguro"
FROM pub."docum-est"
WHERE substr("nat-operacao",1,1)='3'
  AND (("nro-docto"=:documento AND "serie-docto"=:serie
        AND "cod-estabel"=:estab) OR (...))
```

Agrupar todos os ORs; não concatenar condições do cliente. O wrapper antigo não coloca parênteses externos na lista inteira. A consulta filha usa conexão de aplicação dinâmica: confirmar a base EMS2 autorizada por estabelecimento no runtime; não concluir que `docum-est` pertence a espec por o vínculo estar lá.

Retornar também vínculos sem documento correspondente, com `documento_localizado=false`, para não esconder inconsistência operacional. `nf_key` de resposta proposto por composição codificada de estabelecimento/série/documento/espécie/emitente; confirmar índice real. Não prometer CRUD por essa composição sem dicionário.

## Versões

Fontes baixadas durante a análise: `cons_versoes_item_custo_container`. Evidências: `index.php:1196`; `cons_versoes_item_custo_container_grid.class.php:533`, `:950`; lookup `:23`, `:48`.

```sql
SELECT versao_id, tipo_versao_id, dt_hr_versao, cod_usuario,
       descricao, ind_sit_versao, container_id
FROM pub.versoes_item_custo_container
WHERE container_id = :container_id
```

Identidade: `versao_id`; lookup `tipos_versao_custo.tipo_versao_custo_id` → `descricao`. Situação 1=Incompleto, 2=Completo. Não omitir filtro quando container inválido/vazio como permite o PHP legado. Ordenação nova proposta `versao_id DESC`.

Detalhe de versão deve verificar ambos `versao_id` e `container_id`. `bl_resumo_container/index.php:16112` prova itens da última versão em `item_container_custos`, campos `item_custo_id,vl_unit_prev,vl_unit_realiz,qt_confirm_emb,qt_alocada,qt_recebto_fisico,item_container_custo_id,vl_custo_distribuido,vl_negociado`, com `versao_id=max` filtrado pelo container e opcional `item_container_id`. Note a grafia **qt_recebto_fisico** nessa tabela, distinta de **qt_recbto_fisico** em itens_container. Produzir uma versão é ação de escrita distinta de consultá-la.

## Resumo e cálculos compartilhados

Entrada ativa: `bl_resumo_container/index.php:5473`, `:5490`, `:5494`. Não executar todas as funções incluídas no arquivo.

O custo é soma da saída de `calcularCustoGeralItem`, não uma coluna pronta: despesas/custos previstos e reais (`:10958`–`:10988`). Há divergência real: chamada fornece quatro argumentos e definição recebe dois; moeda é o segundo argumento vazio, não o quarto `'real'`. Preservar o comportamento observado exige comparação autorizada, não apenas copiar a assinatura.

Consultas e vínculos adicionais comprovados:

| Finalidade | Tabelas / condição / campos | Evidência em `bl_resumo_container/index.php` |
|---|---|---|
| Itens do cálculo | itens_container por container; quantidades e item_proc_compra_id | `:10699`, `:11036` |
| Despesas custo | despesas_container + empresas_despesa + empresas + despesas + pp-container; soma vl_prev, log_custo=1, empresa derivada | `:13041` |
| Desconto do item | descontos_importacao + itens_container + motivos_desconto; container, log_credito=0 e log_considerar_custo=1; soma vl_dolar/vl_real | `:16307` |
| Crédito utilizado | cta_corren_desconto + descontos_importacao; container, log_credito=1; soma valor_utilizado e valor_utilizado*vl_cotacao_dolar | `:16343` |
| Distribuído para item | cta_corren_custo_distr; item_container_id e cod_tipo_movto=4; soma vl_lancto | `:8038` |
| Distribuído por item | cta_corren_custo_distr + item_container_custos por item_container_custo_id; cod_tipo_movto=3 e item_container_id | `:8055` |
| Realizado | rateio dos pagamentos e valores de itens das NFs associadas, agrupado por código ERP; natureza nota mãe por parâmetro | `:10865` |
| Vendas | espec.ped-venda-ext + ima/med.ped-venda + ped-item; vínculos nome-abrev/nr-pedcli, nr-pedido/cod-estabel, nr-container; exclui situação6; agrupa situação/moeda | `:13863` |
| Cotação venda | pp-container.vl-dolar-venda; se zero usa hist_cotacoes_bc última data, depois paridade1 | `:14700`, `:6030` |

Vendas previstas usam situações 1/2/4/7; realizadas 3. Soma valor e desconto e converte moeda3 por cotação venda, moeda0 permanece real (`:5519`–`:5536`). O aviso legado considera cotação1 como ausente; API deve retornar origem explícita para distinguir paridade configurada de fallback.

`calcularCustoGeralItem` aplica quantidade confirmada quando não zero, senão alocada; rateia despesas pelo custo do item / custo total em dólar, acrescenta despesa específica e efeitos de distribuição; converte para real pelo dólar médio ou despesas para dólar por divisão (`:11094`–`:11154`). Saldo de quantidade é recebida-alocada, ou confirmada-alocada quando recebida zero (`:11208`). Há divisões sem proteção de denominador e variáveis de retorno inicializadas fora do loop: revisar com casos pequenos reproduzíveis antes de alegar paridade.

## Comparativos e Rastro

Evidências: `grid_itens_container_comparacao/index.php:1316`, `:6310`; grade `:551`, `:579`, `:585`, `:1097`, `:4250`.

Comparativos consulta os mesmos seis campos de itens, em ordem diferente. Exige `pp-container.log_versao_custo_desatualizada=0`; se ausente/desatualizada o PHP interrompe sem linhas. Deve virar erro estruturado `CONTAINER_COST_VERSION_STALE` com container e timestamp (`dt_hr_ult_alt_versao_custo`), sem gerar nova versão automaticamente.

Usa `calcularCustoGeralItem(...,'negociado',false,false)`, percentual de custo do container, totais distribuídos para/por item e dólar médio com saldo negociado. Mostra cenários com/sem distribuição e percentual, unitários arredondados a2 casas e diferenças; não substituir por custo tributado da aba Itens. `vl_rat_desp_perc=vl_merc_prev*perc_container/100`; unitário usa quantidade confirmada positiva senão alocada (proteger zero).

Rastro legado (`bl_rastreabilidade_dolar/index.php:2707`, `:2725`) só imprime HTML de `log_dolar_medio_corrente` deixado em sessão por Comparativos. API proposta recalcula e retorna componentes estruturados por container; não devolve HTML nem texto de outra sessão.

Fórmula comprovada no comparativo (`grid_itens_container_comparacao_grid.class.php:18578`–`:18758`): custo previsto dólar, pagamentos real/dólar, créditos/descontos utilizados, cotação do saldo; saldo dólar=custo previsto-créditos-descontos-pago. Saldo positivo é multiplicado pela cotação saldo e somado aos pagamentos/descontos em real. Quando saldo negativo ajusta o denominador do custo. Dólar médio=round(total real/custo dólar ajustado,5); fallback1. O parâmetro booleano `logSaldoNeg` é tratado como flag; outras cópias chamam com strings `'proforma'|'negociado'` (`Resumo :11045`). Essas cópias não podem ser presumidas semanticamente idênticas.

Simulação/distribuição/geração de versão permanecem processos separados: leitura pode calcular em memória, mas nunca criar `item_container_custos`, `versoes_item_custo_container`, lançamentos ou despesas.

## Contratos propostos para implementação

Endpoint novo proposto POST `/SursumPrograms/containers-painel`, mesmo ABI INPUT/OUTPUT JsonObject e credencial server-side dos containers. Operações somente leitura, distintas das operações de processo. Request mínimo fechado:

```json
{"operation":"itens","container_id":123,"moeda":"dolar"}
```

`container_id` obrigatório em todas; `moeda` aceita somente `itens|comparativos`, enum `real|dolar`, default dolar. Sem `filter` SQL, empresa, banco ou fornecedor fornecidos pelo cliente. Ordenação/paginação inicial pode continuar no PHP construtor sobre a lista completa, como a fonte atual, desde que o universo esteja sempre limitado pelo container.

Envelope comum: `{"success":true,"data":[...]}`; cada linha inclui `container_id`; em erro `{"success":false,"error":{"code":"...","message":"...","status":400}}`. Operação desconhecida/campos desconhecidos/ID não inteiro falham400; container inexistente404; contexto sem autorização403; banco necessário ausente500. Lista sem filhos retorna `data:[]`. Unknown Progress torna-se JSON null. Valores numéricos são JSON number; datas `YYYY-MM-DD`, datetime em ISO8601 com zona declarada; strings não contêm marcação HTML.

| operation | Campos do objeto em data (proposta exata) | Identidade UI |
|---|---|---|
| itens | container_id,item_container_id,item_proc_compra_id,qt_alocada,qt_confirm_emb,qt_recbto_fisico,descricao_item,codigo_erp,descricao_erp,moeda,vl_merc_prev,vl_desp_prev,vl_total_prev,vl_unit_prev,vl_merc_real,vl_desp_real,vl_desc_item,vl_desc_container,vl_total_real,vl_unit_real,qt_saldo | item_container_id |
| despesas | container_id,despesa_container_id,despesa_id,descricao,ordem,empresa_id,item_container_id,vl_prev,vl_base_imp,vl_negociado,cta_corren_custo_distr_id,calc_imp_container_id,log_custo,memoria_calculo,vl_distr,vl_a_distr | despesa_container_id |
| pagamentos | container_id,pagamento_key,cod_estab,cod_empresa,num_id_tit_ap,cod_espec_docto,cod_ser_docto,cdn_fornecedor,cod_tit_ap,cod_parcela,dat_emis_docto,dat_vencto_tit_ap,cod_indic_econ,val_origin_tit_ap,valor_real,valor_dolar | pagamento_key |
| nfs | container_id,nf_key,estab,documento,serie,especie,cod_emitente,nat_operacao,dt_emissao,dt_trans,tot_valor,despesa_nota,valor_embal,valor_frete,valor_mercad,valor_outras,valor_seguro,documento_localizado | nf_key |
| versoes | container_id,versao_id,tipo_versao_id,tipo_versao_descricao,dt_hr_versao,cod_usuario,descricao,ind_sit_versao,situacao_descricao | versao_id |
| resumo | container_id,moeda,custo_previsto,custo_realizado,vendas_previstas,vendas_realizadas,cotacao_venda,cotacao_venda_data,cotacao_venda_origem,calculado_em,avisos | container_id (um objeto) |
| comparativos | container_id,item_container_id,item_proc_compra_id,descricao_item,qt_alocada,qt_confirm_emb,qt_recbto_fisico,moeda,perc_container,vl_merc_prev,vl_desp_prev,vl_desp_prev_sem_distr_custo,vl_total_prev,vl_total_prev_sem_distr_custo,vl_unit_prev,vl_unit_prev_sem_distr_custo,vl_rat_desp_perc,vl_custo_final_perc,vl_unitario_previsto_perc,perc_desp_prod,perc_desp_prod_sem_dc,vl_dif_perc,vl_distr,vl_contr_distr_custo | item_container_id |
| rastro_dolar | container_id,custo_previsto_dolar,pago_dolar,pago_real,credito_utilizado_dolar,credito_utilizado_real,desconto_utilizado_dolar,desconto_utilizado_real,saldo_dolar,saldo_real,total_real,custo_dolar_ajustado,cotacao_saldo,cotacao_origem,dolar_medio,calculado_em,avisos | container_id (um objeto) |

Esses campos são um contrato alvo, não promessa de que todo cálculo foi validado. Publicar apenas campos cuja origem/dicionário/regra estejam implementados. Uma grade com seis campos base é consulta parcial explícita, não conversão completa da aba Itens. Resumo/Comparativos/Rastro exigem os testes financeiros descritos na proposta aprovada.

## Descendentes e pendências

Na primeira inspeção faltavam12 descendentes. Durante a coleta foram disponibilizados `cons_docum_est_importacao`, `cons_versoes_item_custo_container`, `control_selec_proc_compra`, `bl_item_custos`, `cons_selec_despesas`, `form_despesas_container_multi_reg`, `cons_calcs_imp_container`, `cons_despesas_container_memoria_calculo`, `cons_tit_ap_associar_container`, `cons_tit_ap_associar_container_apos_di`, `ctrl_simul_distr_custo`. A cópia de `bl_distribuir_custo_contr` deve ser conferida pela tarefa principal; ações de escrita pertencem a inventário separado. Obter descendentes transitivos revelados pelos destinos antes de habilitar botões.

Antes de implementar leitura real: extrair dicionário das filhas e bases EMS5/EMS2 necessárias; confirmar conexões PASOE, chaves de pagamento/NF, origem de descrição de despesas e permissões de realizado; portar cálculos com fixtures pequenas e comparação autorizada somente leitura. Nenhuma escrita de negócio é necessária para validar consultas sobre containers existentes autorizados.

## Implementação parcial concreta — fontes preparadas

Implementado `integration-src/container-panel/ContainersPainelReadService.p`. Dicionários reais das tabelas iniciais foram extraídos pela tarefa principal e estão em `integration-src/container-panel/schema/`. O serviço expõe dados persistidos; os campos de custos calculados, Resumo, Comparativos e Rastro acima continuam pendentes de implementação/paridade. Não há custo financeiro inventado a partir de preço isolado.

Assinatura fixa, na ordem: INPUT HANDLE `phContainer,phVersoes,phAnexos,phTiposAnexo,phDespesasContainer,phEmpresasDespesa,phDespesas,phEmpresas,phItensContainer,phItensProcCompra,phProcsCompra`; INPUT JsonObject request; OUTPUT JsonObject response. Apenas o wrapper autenticado fornece handles. O cliente não escolhe tabelas.

Request implementado: `{"operation":"read| get","resource":"painel|versoes|anexos|despesas|itens","container_id":123,"id":456}` (valores são enumerações sem espaços; `id` só em get). `read` devolve `data:[]`; `get` devolve `data:{}`. `get` de filho exige ID e vínculo ao container; `get painel` aceita ausência de id, ou id igual container_id. O alias da PK específica enviado pelo mecanismo nativo é aceito em get somente se igual id. Toda leitura exige container_id positivo e pai existente antes das filhas.

Erros implementados: `CONTAINER_OPERATION_INVALID`, `CONTAINER_RESOURCE_INVALID`, `CONTAINER_VALIDATION`422; `CONTAINER_NOT_FOUND` e `CONTAINER_CHILD_NOT_FOUND`404; `CONTAINER_COMPANY_CONTEXT`422 quando mapeamento ausente/ambíguo; `CONTAINER_CONFIGURATION`/`CONTAINER_INTERNAL`500. O envelope usa error aninhado e não inclui data em falhas.

Campos físicos: allowlists explícitas no serviço e nos testes. Painel50campos; versões22campos mais situacao_descricao; anexos6campos mais tem_arquivo/tipo_anexo_descricao (sem caminho_arquivo); despesas14campos mais descricao/ordem/empresa_id/log_custo/vl_distr/vl_a_distr; itens15campos mais descricao_item/codigo_erp/unid_medida/proc_compra_id/cod_proc_fornec/fornecedor_id/empresa_pedido_id. Normalização `-`→`_`, `nr-container`→`container_id`. As versões nesta primeira entrega não têm lookup de tipos_versao_custo (handle não está na assinatura aprovada); o ID é preservado.

Despesas aplicam ambos os INNER JOINs do legado e a empresa derivada do primeiro caractere de cod-estabel. Aceita prefixo0–9 com mapeamento real único de empresas.cod_emp_ems2; não presume empresa_id igual código ERP. Configuração repetida empresa/despesa falha explicitamente para não duplicar a identidade UI. Campos `log_custo` são INTEGER no dicionário, não JSON boolean.

Validação auxiliar local OpenEdge12.8: serviço e teste compilaram com `COMPILER:ERROR=no`,347verificações passaram em cada formato AMERICAN/EUROPEAN. Teste RED observado antes de criar o serviço (arquivo ausente293), depois GREEN. Evidências privadas em `.runtime/container-panel-read-local/`; runner `CompileContainersPainelReadTests.p`, teste `ContainersPainelReadTest.p`. Exercita escopo mestre, get de filho de outro container, aliases, entrada inválida/injeção textual, campos fechados, Unicode, precisão/null, datetime/TZ, falta de lookup, mapeamento empresa0 e ambiguidade. Fixtures exclusivamente temp-table, sem conexão a banco. Compilação12.2/publicação/PASOE ainda são responsabilidade da tarefa principal; nenhum `.r`12.8 deve ser publicado.

Consultas financeiras de Pagamentos/NFs e helper privado de totais foram implementados em etapa seguinte. Contratos concretos, correções intencionais das ambiguidades legadas e evidências auxiliares estão em [containers-painel-financeiro-read.md](containers-painel-financeiro-read.md). Distinguir a grade de pagamentos dos totais usados pelo custo: suas seleções não são equivalentes.
