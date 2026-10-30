DEFINE TEMP-TABLE currentAllocation NO-UNDO FIELD item_container_id AS INTEGER FIELD item_proc_compra_id AS INTEGER INDEX pk IS UNIQUE PRIMARY item_container_id.
DEFINE TEMP-TABLE currentPurchaseItem NO-UNDO FIELD item_proc_compra_id AS INTEGER FIELD descricao AS CHARACTER FIELD codigo_erp AS CHARACTER INDEX pk IS UNIQUE PRIMARY item_proc_compra_id.
DEFINE TEMP-TABLE currentEmitter NO-UNDO FIELD cod-emitente AS INTEGER FIELD nome-abrev AS CHARACTER FIELD identific AS INTEGER INDEX pk IS UNIQUE PRIMARY cod-emitente.
DEFINE TEMP-TABLE currentReason NO-UNDO FIELD motivo_desconto_id AS INTEGER FIELD descricao AS CHARACTER FIELD log_considerar_custo AS INTEGER INDEX pk IS UNIQUE PRIMARY motivo_desconto_id.
