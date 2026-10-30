/* Typed from official12.2 dictionary; undoable TTs only, no DB binding. */
DEFINE TEMP-TABLE ttEms2
 FIELD mo-codigo AS INTEGER
 FIELD ano-periodo AS CHARACTER
 FIELD cotacao AS DECIMAL EXTENT 31 DECIMALS 10
 FIELD cota-mensal AS DECIMAL DECIMALS 10
 FIELD cota-media AS DECIMAL DECIMALS 10
 FIELD usuario AS CHARACTER EXTENT 31
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
 FIELD var-periodo AS DECIMAL DECIMALS 8
 FIELD check-sum AS CHARACTER
 INDEX pk IS PRIMARY mo-codigo ano-periodo.
DEFINE TEMP-TABLE ttEms5
 FIELD cod_indic_econ_base AS CHARACTER
 FIELD cod_indic_econ_idx AS CHARACTER
 FIELD dat_cotac_indic_econ AS DATE
 FIELD val_cotac_indic_econ AS DECIMAL DECIMALS 10
 FIELD ind_tip_cotac_parid AS CHARACTER
 FIELD log_cotac_gerad_autom AS LOGICAL
 FIELD cod_usuar_ult_atualiz AS CHARACTER
 FIELD dat_ult_atualiz AS DATE
 FIELD hra_ult_atualiz AS CHARACTER
 FIELD cod_livre_1 AS CHARACTER
 FIELD cod_livre_2 AS CHARACTER
 FIELD dat_livre_1 AS DATE
 FIELD dat_livre_2 AS DATE
 FIELD log_livre_1 AS LOGICAL
 FIELD log_livre_2 AS LOGICAL
 FIELD num_livre_1 AS INTEGER
 FIELD num_livre_2 AS INTEGER
 FIELD val_livre_1 AS DECIMAL DECIMALS 4
 FIELD val_livre_2 AS DECIMAL DECIMALS 4
 FIELD cdd_version AS DECIMAL DECIMALS 0
 INDEX pk IS PRIMARY cod_indic_econ_base cod_indic_econ_idx ind_tip_cotac_parid dat_cotac_indic_econ.
