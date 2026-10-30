DEFINE TEMP-TABLE discountSource NO-UNDO
 FIELD desconto_importacao_id AS INTEGER
 FIELD motivo_desconto_id AS INTEGER
 FIELD descricao AS CHARACTER
 FIELD log_credito AS LOGICAL
 FIELD vl_dolar AS DECIMAL DECIMALS 2
 FIELD vl_real AS DECIMAL DECIMALS 2
 FIELD vl_cotacao_dolar AS DECIMAL DECIMALS 2
 FIELD item_container_id AS INTEGER
 FIELD cod_tipo AS INTEGER
 FIELD fornecedor_id AS INTEGER
 FIELD vl_real_autorizado AS DECIMAL DECIMALS 2
 FIELD vl_dolar_autorizado AS DECIMAL DECIMALS 2
 FIELD dt_autorizacao AS DATE
 FIELD arquivo AS CHARACTER
 INDEX pk IS UNIQUE PRIMARY desconto_importacao_id.
DEFINE TEMP-TABLE ledgerSource NO-UNDO
 FIELD cta_corren_desconto_id AS INTEGER
 FIELD desconto_importacao_id AS INTEGER
 FIELD container_id AS INTEGER
 FIELD valor_utilizado AS DECIMAL DECIMALS 2
 FIELD data AS DATE
 FIELD cod_usuario AS DATE
 INDEX pk IS UNIQUE PRIMARY cta_corren_desconto_id.
