DEFINE TEMP-TABLE ledgerSource NO-UNDO
 FIELD cta_corren_custo_distr_id AS INTEGER
 FIELD data AS DATE
 FIELD item_container_custo_id AS INTEGER
 FIELD item_container_id AS INTEGER
 FIELD historico AS CHARACTER
 FIELD cod_tipo_movto AS INTEGER
 FIELD vl_lancto AS DECIMAL DECIMALS 2
 FIELD despesa_container_id AS INTEGER
 FIELD login AS CHARACTER
 INDEX pk IS UNIQUE PRIMARY cta_corren_custo_distr_id.
