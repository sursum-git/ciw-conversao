/* Development probe, compiler host only. Read IDs of existing records; no API route. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE result AS JsonObject NO-UNDO.
DEFINE VARIABLE rows AS JsonArray NO-UNDO.
DEFINE VARIABLE item AS JsonObject NO-UNDO.
DEFINE VARIABLE countRows AS INTEGER NO-UNDO.
result=NEW JsonObject().
rows=NEW JsonArray().
FOR EACH espec.itens_container NO-LOCK BY espec.itens_container.item_container_id DESCENDING:
 IF NOT CAN-FIND(FIRST espec.pp-container WHERE espec.pp-container.nr-container=espec.itens_container.container_id) THEN NEXT.
 item=NEW JsonObject(). item:Add('container_id',espec.itens_container.container_id). item:Add('id',espec.itens_container.item_container_id). rows:Add(item).
 countRows = countRows + 1. IF countRows=8 THEN LEAVE.
END.
result:Add('itens',rows).
rows=NEW JsonArray(). countRows=0.
FOR EACH espec.versoes_item_custo_container NO-LOCK BY espec.versoes_item_custo_container.versao_id DESCENDING:
 IF NOT CAN-FIND(FIRST espec.pp-container WHERE espec.pp-container.nr-container=espec.versoes_item_custo_container.container_id) THEN NEXT.
 item=NEW JsonObject(). item:Add('container_id',espec.versoes_item_custo_container.container_id). item:Add('id',espec.versoes_item_custo_container.versao_id). rows:Add(item).
 countRows = countRows + 1. IF countRows=8 THEN LEAVE.
END.
result:Add('versoes',rows).
rows=NEW JsonArray(). countRows=0.
FOR EACH espec.anexos_container NO-LOCK BY espec.anexos_container.anexo_container_id DESCENDING:
 IF NOT CAN-FIND(FIRST espec.pp-container WHERE espec.pp-container.nr-container=espec.anexos_container.container_id) THEN NEXT.
 item=NEW JsonObject(). item:Add('container_id',espec.anexos_container.container_id). item:Add('id',espec.anexos_container.anexo_container_id). rows:Add(item).
 countRows = countRows + 1. IF countRows=8 THEN LEAVE.
END.
result:Add('anexos',rows).
rows=NEW JsonArray(). countRows=0.
FOR EACH espec.pagtos_container NO-LOCK BY espec.pagtos_container.container_id DESCENDING:
 IF NOT CAN-FIND(FIRST espec.pp-container WHERE espec.pp-container.nr-container=espec.pagtos_container.container_id) THEN NEXT.
 item=NEW JsonObject(). item:Add('container_id',espec.pagtos_container.container_id). item:Add('id',espec.pagtos_container.num_id_tit_ap). rows:Add(item).
 countRows = countRows + 1. IF countRows=8 THEN LEAVE.
END.
result:Add('pagamentos',rows).
rows=NEW JsonArray(). countRows=0.
FOR EACH espec.nfs_container NO-LOCK BY espec.nfs_container.container_id DESCENDING:
 IF NOT CAN-FIND(FIRST espec.pp-container WHERE espec.pp-container.nr-container=espec.nfs_container.container_id) THEN NEXT.
 item=NEW JsonObject(). item:Add('container_id',espec.nfs_container.container_id). rows:Add(item).
 countRows = countRows + 1. IF countRows=8 THEN LEAVE.
END.
result:Add('nfs',rows).
result:WriteFile('container-panel-samples.json',TRUE).
QUIT.
