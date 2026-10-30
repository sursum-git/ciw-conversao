DEFINE TEMP-TABLE allocationSource NO-UNDO
 FIELD item_container_id AS INTEGER
 FIELD container_id AS INTEGER
 FIELD item_proc_compra_id AS INTEGER
 FIELD qt_alocada AS DECIMAL DECIMALS 2
 FIELD qt_confirm_emb AS DECIMAL DECIMALS 2
 FIELD qt_recbto_fisico AS DECIMAL DECIMALS 2
 FIELD log_rec_doc_prazo_emb AS LOGICAL
 FIELD observacao AS CHARACTER
 FIELD cod_tipo_calculo AS INTEGER
 FIELD perc_custo AS DECIMAL DECIMALS 2
 FIELD log_calc_icms AS LOGICAL
 FIELD log_calc_ipi AS LOGICAL
 FIELD perc_icms AS DECIMAL DECIMALS 2
 FIELD perc_ipi AS DECIMAL DECIMALS 2
 FIELD preco_liquida_ima AS DECIMAL DECIMALS 2
 INDEX pk IS UNIQUE PRIMARY item_container_id.
DEFINE TEMP-TABLE containerSource NO-UNDO
 FIELD cod-estabel AS CHARACTER
 FIELD nr-container AS INTEGER
 FIELD num-pedido AS INTEGER
 FIELD nome-ab-forn AS CHARACTER
 FIELD cod-emit-forn AS INTEGER
 FIELD comprador AS CHARACTER
 FIELD narrativa AS CHARACTER
 FIELD usuario AS CHARACTER
 FIELD dt-compra AS DATE
 FIELD dt-prev-chegada AS DATE
 FIELD dt-recebimento AS DATE
 FIELD situacao AS INTEGER
 FIELD char-1 AS CHARACTER
 FIELD dec-1 AS DECIMAL DECIMALS 8
 FIELD int-1 AS INTEGER
 FIELD log-1 AS LOGICAL
 FIELD data-1 AS DATE
 FIELD vlr-frete AS DECIMAL DECIMALS 2
 FIELD vlr-seguro AS DECIMAL DECIMALS 2
 FIELD vlr-despesas AS DECIMAL DECIMALS 2
 FIELD exclusivo AS LOGICAL
 FIELD vl-dolar-venda AS DECIMAL DECIMALS 5
 FIELD vl-dolar-compra AS DECIMAL DECIMALS 5
 FIELD log_liberar_custo_realizado AS LOGICAL
 FIELD medidas_container AS CHARACTER
 FIELD dt_prev_embarque AS DATE
 FIELD dt_real_embarque AS DATE
 FIELD ind_dt_embarque AS INTEGER
 FIELD situacao_container_id AS INTEGER
 FIELD ind_dt_prev_chegada AS INTEGER
 FIELD log_pagto_final AS LOGICAL
 FIELD cod_agente_cargas AS INTEGER
 FIELD cod_armador AS INTEGER
 FIELD cod_tipo_calculo AS INTEGER
 FIELD perc_custo AS DECIMAL DECIMALS 2
 FIELD vl_dolar_di AS DECIMAL DECIMALS 5
 FIELD log_gerar_saldo_a_pagar AS LOGICAL
 FIELD log_gerar_distr_custo AS LOGICAL
 FIELD ordem_busca_dolar_compra AS CHARACTER
 FIELD ordem_busca_dolar_di AS CHARACTER
 FIELD cod_tipo_proj_dolar AS INTEGER
 FIELD vl_proj_dolar AS DECIMAL DECIMALS 5
 FIELD log_versao_custo_desatualizada AS LOGICAL
 FIELD dt_hr_ult_alt_versao_custo AS DATETIME
 FIELD ptax AS DECIMAL DECIMALS 5
 FIELD cod-depos AS CHARACTER
 FIELD dt_prev_chegada_loja AS DATE
 FIELD estacao AS INTEGER
 FIELD num_origem AS INTEGER
 FIELD log_rota_indefinida AS LOGICAL
 INDEX pk IS UNIQUE PRIMARY nr-container.
DEFINE TEMP-TABLE purchaseSource NO-UNDO
 FIELD item_proc_compra_id AS INTEGER
 FIELD descricao AS CHARACTER
 FIELD codigo_erp AS CHARACTER
 FIELD qt_dias_producao AS INTEGER
 FIELD vl_base_tributacao AS DECIMAL DECIMALS 5
 FIELD unid_medida AS CHARACTER
 FIELD proc_compra_id AS INTEGER
 FIELD qt_comprada AS DECIMAL DECIMALS 2
 FIELD vl_custo_dolar AS DECIMAL DECIMALS 10
 FIELD composicao AS CHARACTER
 FIELD peso AS CHARACTER
 FIELD largura AS CHARACTER
 FIELD rolo AS CHARACTER
 FIELD dt_prev_envio_desenhos AS DATE
 FIELD dt_real_envio_desenhos AS DATE
 FIELD log_aprov_so_ld AS LOGICAL
 FIELD dt_prev_recbto_so_ld AS DATE
 FIELD dt_prev_aprov_so_ld AS DATE
 FIELD dt_real_aprov_so_ld AS DATE
 FIELD coloracao_id AS INTEGER
 FIELD dt_maxima_producao AS DATE
 FIELD dt_mostruario AS DATE
 FIELD log_mostruario AS LOGICAL
 FIELD formato_amostra_id AS INTEGER
 FIELD ind_producao_no_prazo AS INTEGER
 FIELD ind_relat_semanal_producao AS INTEGER
 FIELD ind_qualid_emb AS INTEGER
 FIELD ind_laudo_antes_embarque AS INTEGER
 FIELD ind_prod_conf_pi AS INTEGER
 FIELD ind_rec_amostra_antes_emb AS INTEGER
 FIELD ind_qt_conf_proforma AS INTEGER
 FIELD ind_tamanho_pecas_correto AS INTEGER
 FIELD observacao AS CHARACTER
 FIELD dt_cheg_amostras_emb AS DATE
 FIELD dt_termino_producao AS DATE
 FIELD vl_cubagem AS DECIMAL DECIMALS 2
 FIELD dt_recbto_laudo AS DATE
 FIELD dt_recbto_embalagem AS DATE
 FIELD dt_real_recbto_so_ld AS DATE
 FIELD dt_prev_termino_producao AS DATE
 FIELD qt_dias_calc_so_ld AS INTEGER
 FIELD shrinkage AS CHARACTER
 FIELD ind_distr_custo AS INTEGER
 FIELD vl_negociado AS DECIMAL DECIMALS 5
 FIELD item_estacao AS INTEGER
 FIELD dt_item_certificacao AS DATE
 INDEX pk IS UNIQUE PRIMARY item_proc_compra_id.
