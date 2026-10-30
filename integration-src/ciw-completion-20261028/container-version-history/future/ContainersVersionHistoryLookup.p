/* Current display lookup shared by historical item and comparison projections.
   No historical values are calculated or replaced by these current labels. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE INPUT PARAMETER phAllocations AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phPurchaseItems AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER piContainer AS INTEGER NO-UNDO.
DEFINE INPUT PARAMETER piItem AS INTEGER NO-UNDO.
DEFINE OUTPUT PARAMETER poLookup AS JsonObject NO-UNDO.
DEFINE VARIABLE procItem AS INTEGER NO-UNDO.
poLookup=NEW JsonObject(). poLookup:AddNull('item_descricao_atual'). poLookup:AddNull('codigo_erp_atual'). poLookup:Add('current_join_complete',FALSE).
DO ON ERROR UNDO, THROW:
 IF NOT VALID-HANDLE(phAllocations) OR NOT VALID-HANDLE(phPurchaseItems) OR piContainer=? OR piContainer<1 OR piItem=? OR piItem<1 THEN RETURN.
 IF NOT phAllocations:FIND-FIRST('WHERE ' + phAllocations:NAME + '.item_container_id=' + TRIM(STRING(piItem,'->>>>>>>>>9')) + ' AND ' + phAllocations:NAME + '.container_id=' + TRIM(STRING(piContainer,'->>>>>>>>>9')),NO-LOCK) THEN RETURN.
 procItem=phAllocations:BUFFER-FIELD('item_proc_compra_id'):BUFFER-VALUE.
 IF procItem=? OR procItem<1 THEN RETURN.
 IF NOT phPurchaseItems:FIND-FIRST('WHERE ' + phPurchaseItems:NAME + '.item_proc_compra_id=' + TRIM(STRING(procItem,'->>>>>>>>>9')),NO-LOCK) THEN RETURN.
 IF phPurchaseItems:BUFFER-FIELD('descricao'):BUFFER-VALUE<>? THEN poLookup:Set('item_descricao_atual',STRING(phPurchaseItems:BUFFER-FIELD('descricao'):BUFFER-VALUE)).
 IF phPurchaseItems:BUFFER-FIELD('codigo_erp'):BUFFER-VALUE<>? THEN poLookup:Set('codigo_erp_atual',STRING(phPurchaseItems:BUFFER-FIELD('codigo_erp'):BUFFER-VALUE)).
 poLookup:Set('current_join_complete',TRUE).
 FINALLY:
  IF VALID-HANDLE(phAllocations) THEN phAllocations:BUFFER-RELEASE() NO-ERROR.
  IF VALID-HANDLE(phPurchaseItems) THEN phPurchaseItems:BUFFER-RELEASE() NO-ERROR.
 END FINALLY.
END.
