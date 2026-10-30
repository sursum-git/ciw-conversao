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
DEFINE TEMP-TABLE orderSource NO-UNDO
 FIELD proc_compra_id AS INTEGER
 FIELD empresa_id AS INTEGER
 FIELD qt_container AS INTEGER
 FIELD cod_situacao AS INTEGER
 FIELD cod_proc_fornec AS CHARACTER
 FIELD qt_dias_translado AS INTEGER
 FIELD cotacao_prevista AS DECIMAL DECIMALS 2
 FIELD observacao AS CHARACTER
 FIELD dt_registro AS DATE
 FIELD fornecedor_id AS INTEGER
 FIELD dt_limite AS DATE
 FIELD log_facilid_contato_fornec AS LOGICAL
 FIELD log_considerar_previsao AS LOGICAL
 FIELD nr_container_original AS CHARACTER
 INDEX pk IS UNIQUE PRIMARY proc_compra_id.
DEFINE TEMP-TABLE emitterSource NO-UNDO
 FIELD cod-emitente AS INTEGER
 FIELD nome-abrev AS CHARACTER
 FIELD cgc AS CHARACTER
 FIELD identific AS INTEGER
 FIELD natureza AS INTEGER
 FIELD nome-emit AS CHARACTER
 FIELD endereco AS CHARACTER
 FIELD bairro AS CHARACTER
 FIELD cidade AS CHARACTER
 FIELD estado AS CHARACTER
 FIELD cep AS CHARACTER
 FIELD caixa-postal AS CHARACTER
 FIELD pais AS CHARACTER
 FIELD ins-estadual AS CHARACTER
 FIELD cod-cond-pag AS INTEGER
 FIELD taxa-financ AS DECIMAL DECIMALS 2
 FIELD data-taxa AS DATE
 FIELD cod-transp AS INTEGER
 FIELD cod-gr-forn AS INTEGER
 FIELD linha-produt AS CHARACTER
 FIELD atividade AS CHARACTER
 FIELD contato AS CHARACTER EXTENT 2
 FIELD telefone AS CHARACTER EXTENT 2
 FIELD ramal AS CHARACTER EXTENT 2
 FIELD telefax AS CHARACTER
 FIELD ramal-fax AS CHARACTER
 FIELD telex AS CHARACTER
 FIELD data-implant AS DATE
 FIELD compr-period AS DECIMAL DECIMALS 2
 FIELD end-cobranca AS INTEGER
 FIELD cod-rep AS INTEGER
 FIELD categoria AS CHARACTER
 FIELD bonificacao AS DECIMAL DECIMALS 3
 FIELD istr AS INTEGER
 FIELD cod-gr-cli AS INTEGER
 FIELD lim-credito AS DECIMAL DECIMALS 2
 FIELD dt-lim-cred AS DATE
 FIELD perc-fat-ped AS INTEGER
 FIELD portador AS INTEGER
 FIELD modalidade AS INTEGER
 FIELD ind-fat-par AS LOGICAL
 FIELD ind-cre-cli AS INTEGER
 FIELD ind-apr-cred AS LOGICAL
 FIELD nat-operacao AS CHARACTER
 FIELD observacoes AS CHARACTER
 FIELD per-minfat AS DECIMAL DECIMALS 2
 FIELD emissao-ped AS INTEGER
 FIELD nome-matriz AS CHARACTER
 FIELD telef-modem AS CHARACTER
 FIELD ramal-modem AS CHARACTER
 FIELD telef-fac AS CHARACTER
 FIELD ramal-fac AS CHARACTER
 FIELD agencia AS CHARACTER
 FIELD nr-titulo AS INTEGER
 FIELD nr-dias AS INTEGER
 FIELD per-max-canc AS DECIMAL DECIMALS 2
 FIELD dt-ult-venda AS DATE
 FIELD emite-bloq AS LOGICAL
 FIELD emite-etiq AS LOGICAL
 FIELD tr-ar-valor AS INTEGER
 FIELD gera-ad AS LOGICAL
 FIELD port-prefer AS INTEGER
 FIELD mod-prefer AS INTEGER
 FIELD bx-acatada AS INTEGER
 FIELD conta-corren AS CHARACTER
 FIELD nr-copias-ped AS INTEGER
 FIELD cod-suframa AS CHARACTER
 FIELD cod-cacex AS CHARACTER
 FIELD gera-difer AS INTEGER
 FIELD nr-tabpre AS CHARACTER
 FIELD ind-aval AS INTEGER
 FIELD user-libcre AS CHARACTER
 FIELD ins-banc AS INTEGER EXTENT 2
 FIELD ven-feriado AS INTEGER
 FIELD ven-domingo AS INTEGER
 FIELD ven-sabado AS INTEGER
 FIELD cgc-cob AS CHARACTER
 FIELD cep-cob AS CHARACTER
 FIELD estado-cob AS CHARACTER
 FIELD cidade-cob AS CHARACTER
 FIELD bairro-cob AS CHARACTER
 FIELD endereco-cob AS CHARACTER
 FIELD cx-post-cob AS CHARACTER
 FIELD ins-est-cob AS CHARACTER
 FIELD nome-mic-reg AS CHARACTER
 FIELD tip-cob-desp AS INTEGER
 FIELD nome-tr-red AS CHARACTER
 FIELD nat-ope-ext AS CHARACTER
 FIELD cod-banco AS INTEGER
 FIELD prox-ad AS INTEGER
 FIELD lim-adicional AS DECIMAL DECIMALS 2
 FIELD dt-fim-cred AS DATE
 FIELD obs-entrega AS CHARACTER
 FIELD cod-tip-ent AS INTEGER
 FIELD ins-municipal AS CHARACTER
 FIELD nr-peratr AS INTEGER
 FIELD nr-mesina AS INTEGER
 FIELD insc-subs-trib AS CHARACTER
 FIELD cod-mensagem AS INTEGER
 FIELD nr-dias-taxa AS INTEGER
 FIELD tp-desp-padrao AS INTEGER
 FIELD tp-rec-padrao AS INTEGER
 FIELD inf-complementar AS CHARACTER
 FIELD zip-code AS CHARACTER
 FIELD tp-inspecao AS INTEGER
 FIELD forn-exp AS LOGICAL
 FIELD tp-qt-prg AS INTEGER
 FIELD ind-atraso AS INTEGER
 FIELD ind-div-atraso AS INTEGER
 FIELD ind-dif-atrs-1 AS INTEGER
 FIELD ind-dif-atrs-2 AS INTEGER
 FIELD esp-pd-venda AS INTEGER
 FIELD ind-lib-estoque AS LOGICAL
 FIELD ind-moeda-tit AS INTEGER
 FIELD ind-rendiment AS LOGICAL
 FIELD tp-pagto AS INTEGER
 FIELD vl-min-ad AS DECIMAL DECIMALS 2
 FIELD zip-cob-code AS CHARACTER
 FIELD hora-ini AS INTEGER
 FIELD hora-fim AS INTEGER
 FIELD pais-cob AS CHARACTER
 FIELD resumo-mp AS INTEGER
 FIELD ind-cred-abat AS LOGICAL
 FIELD contrib-icms AS LOGICAL
 FIELD e-mail AS CHARACTER
 FIELD home-page AS CHARACTER
 FIELD ind-licenciador AS LOGICAL
 FIELD endereco2 AS CHARACTER
 FIELD ind-aval-embarque AS INTEGER
 FIELD ind-abrange-aval AS INTEGER
 FIELD cod-tax AS INTEGER
 FIELD cn-codigo AS CHARACTER
 FIELD cod-entrega AS CHARACTER
 FIELD cod-isencao AS INTEGER
 FIELD dias-comp AS INTEGER
 FIELD estoque AS INTEGER
 FIELD flag-pag AS INTEGER
 FIELD item-cli AS LOGICAL
 FIELD moeda-libcre AS INTEGER
 FIELD nr-dias-atraso AS INTEGER
 FIELD valor-minimo AS DECIMAL DECIMALS 2
 FIELD cod-parceiro-edi AS INTEGER
 FIELD agente-retencao AS LOGICAL
 FIELD percepcao AS LOGICAL
 FIELD char-1 AS CHARACTER
 FIELD char-2 AS CHARACTER
 FIELD dec-1 AS DECIMAL DECIMALS 8
 FIELD dec-2 AS DECIMAL DECIMALS 8
 FIELD int-1 AS INTEGER
 FIELD int-2 AS INTEGER
 FIELD log-1 AS LOGICAL
 FIELD log-2 AS LOGICAL
 FIELD data-1 AS DATE
 FIELD data-2 AS DATE
 FIELD cod-canal-venda AS INTEGER
 FIELD ind-sit-emitente AS INTEGER
 FIELD ind-emit-retencao AS INTEGER
 FIELD calcula-multa AS LOGICAL
 FIELD prog-emit AS LOGICAL
 FIELD nr-tab-progr AS INTEGER
 FIELD recebe-inf-sci AS LOGICAL
 FIELD cod-classif-fornec AS INTEGER
 FIELD cod-classif-cliente AS INTEGER
 FIELD nr-cheque-devol AS INTEGER
 FIELD periodo-devol AS INTEGER
 FIELD vl-max-devol AS DECIMAL DECIMALS 2
 FIELD check-sum AS CHARACTER
 FIELD val-quota-media AS DECIMAL DECIMALS 4
 FIELD cod-repres-imp AS INTEGER
 FIELD vencto-dia-nao-util AS LOGICAL
 FIELD rend-tribut AS DECIMAL DECIMALS 2
 FIELD utiliza-verba AS LOGICAL
 FIELD percent-verba AS DECIMAL DECIMALS 2
 FIELD endereco_text AS CHARACTER
 FIELD endereco-cob-text AS CHARACTER
 FIELD short-name AS CHARACTER
 FIELD log-controla-val-max-inss AS LOGICAL
 FIELD cod-inscr-inss AS CHARACTER
 FIELD cod-pulmao AS CHARACTER
 FIELD idi-tributac-cofins AS INTEGER
 FIELD idi-tributac-pis AS INTEGER
 FIELD log-calcula-pis-cofins-unid AS LOGICAL
 FIELD log-optan-suspens-ipi AS LOGICAL
 FIELD log-optan-cr-presmdo-subst AS LOGICAL
 FIELD retem-pagto AS LOGICAL
 FIELD portador-ap AS INTEGER
 FIELD modalidade-ap AS INTEGER
 FIELD log-contribt-subst-interm AS LOGICAL
 FIELD dat-valid-suframa AS DATE
 FIELD nom-fantasia AS CHARACTER
 FIELD log-possui-nf-eletro AS LOGICAL
 FIELD log-nf-eletro AS LOGICAL
 FIELD dt-atualiza AS DATE
 FIELD hra-atualiz AS CHARACTER
 FIELD cod-email-nfe AS CHARACTER
 FIELD log-integr-totvs-colab-vendas AS LOGICAL
 FIELD cdn-atraso-max AS INTEGER
 FIELD dat-nasc AS DATE
 FIELD log-beneficiario AS LOGICAL
 FIELD log-isenta-anexo AS LOGICAL
 INDEX pk IS UNIQUE PRIMARY cod-emitente.
