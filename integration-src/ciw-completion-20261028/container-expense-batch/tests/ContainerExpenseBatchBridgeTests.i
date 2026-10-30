PROCEDURE BatchBridgeInvoke:
 RUN sursum-api/programs/ContainersDespesasBatchService.p(hb[1],hb[2],hb[3],hb[4],hb[5],hb[6],hb[7],hb[8],hb[9],hb[10],hb[11],THIS-PROCEDURE,policy,req,OUTPUT result).
END PROCEDURE.
PROCEDURE BatchBridgeTests:
 DEFINE VARIABLE beforeValue AS JsonObject NO-UNDO. DEFINE VARIABLE changeValue AS JsonObject NO-UNDO.
 DEFINE VARIABLE changesValue AS JsonArray NO-UNDO. DEFINE VARIABLE v AS JsonObject NO-UNDO.
 DEFINE VARIABLE sequenceBefore AS INTEGER NO-UNDO. DEFINE VARIABLE quotesBefore AS INTEGER NO-UNDO.
 RUN AutomaticFixture.
 hb[1]:FIND-FIRST('WHERE fx1.nr-container=123',NO-LOCK). hb[1]:BUFFER-FIELD('cod-estabel'):BUFFER-VALUE='501'. hb[1]:BUFFER-RELEASE().
 hb[2]:FIND-FIRST('WHERE fx2.empresa_id=1',NO-LOCK). hb[2]:BUFFER-FIELD('cod_emp_ems2'):BUFFER-VALUE=5. hb[2]:BUFFER-RELEASE().
 RUN Request('~{"resource":"container-despesas-lote","operation":"read","container_id":123,"take":200}'). RUN BatchBridgeInvoke.
 RUN Check(result:GetLogical('success') AND result:GetInteger('total')>=3,'native read delegates bounded shared reader').
 RUN Check(result:GetJsonArray('data'):GetJsonObject(1):Has('memoria_calculo') AND NOT result:GetJsonArray('data'):GetJsonObject(1):Has('record_key'),'physical14 projection without invented key').
 RUN Request('~{"resource":"container-despesas-lote","operation":"get","container_id":123,"id":"1001","despesa_container_id":1001}'). RUN BatchBridgeInvoke.
 RUN Check(result:GetLogical('success'),'native get equal alias'). beforeValue=CAST(result:GetJsonObject('data'):Clone(),JsonObject).
 RUN Check(ExpenseTestImageComplete(beforeValue),'get gives complete physical14 original').
 RUN Request('~{"resource":"container-despesas-lote","operation":"get","container_id":123,"id":1001,"despesa_container_id":40}'). RUN BatchBridgeInvoke. RUN Check(NOT result:GetLogical('success') AND result:GetJsonObject('error'):GetInteger('status')=422,'get conflicting aliases').
 RUN Request('~{"resource":"container-despesas-lote","operation":"read","container_id":123,"take":201}'). RUN BatchBridgeInvoke. RUN Check(NOT result:GetLogical('success'),'read bound200').
 RUN Request('~{"resource":"container-despesas-lote","operation":"get","container_id":124,"id":1001}'). RUN BatchBridgeInvoke. RUN Check(NOT result:GetLogical('success') AND result:GetJsonObject('error'):GetInteger('status')=404,'read owner absent').
 RUN Request('~{"resource":"container-despesas-lote","operation":"update","container_id":123,"id":1001}'). RUN BatchBridgeInvoke. RUN Check(NOT result:GetLogical('success') AND result:GetJsonObject('error'):GetInteger('status')=405,'individual writer unavailable in batch bridge').
 RUN Request('~{"resource":"container-despesas-lote","operation":"batch","container_id":123}'). changesValue=NEW JsonArray(). changeValue=NEW JsonObject().
 changeValue:Add('operation','update'). changeValue:Add('clientId','row-1'). changeValue:Add('id',1001). changeValue:Add('original',beforeValue).
 v=NEW JsonObject(). v:Add('vl_prev',321). v:Add('vl_base_imp',5). v:Add('log_manual',TRUE). changeValue:Add('data',v). changesValue:Add(changeValue). req:Add('changes',changesValue).
 RUN BatchBridgeInvoke. RUN Check(result:GetLogical('success') AND result:GetLogical('committed'),'native homogeneous update reaches real central core').
 result:WriteFile('bridge-update.json',TRUE).
 RUN Check(result:GetJsonArray('results'):GetJsonObject(1):GetCharacter('clientId')='row-1' AND result:GetJsonObject('audit'):GetCharacter('operation')='batch_update','client result and original core audit preserved').
 RUN Check(hb[11]:FIND-FIRST('WHERE fx11.despesa_container_id=40',NO-LOCK) AND hb[11]:BUFFER-FIELD('vl_prev'):BUFFER-VALUE=10,'bridge update excludes calculated phase').
 sequenceBefore=seq. quotesBefore=quoteCalls. RUN BatchBridgeInvoke.
 RUN Check(NOT result:GetLogical('success') AND result:GetJsonObject('error'):GetInteger('status')=409 AND seq=sequenceBefore AND quoteCalls=quotesBefore,'native repeated stale snapshot refused before effects').
 changeValue:GetJsonObject('data'):Add('despesa_id',2). RUN BatchBridgeInvoke. RUN Check(NOT result:GetLogical('success') AND result:GetJsonObject('error'):GetInteger('status')=422,'definition immutable in data'). changeValue:GetJsonObject('data'):Remove('despesa_id').
 req:Add('actor','caller'). RUN BatchBridgeInvoke. RUN Check(NOT result:GetLogical('success') AND result:GetJsonObject('error'):GetInteger('status')=422,'caller actor rejected'). req:Remove('actor').
 changesValue:Add(CAST(changeValue:Clone(),JsonObject)). RUN BatchBridgeInvoke. RUN Check(NOT result:GetLogical('success') AND result:GetJsonObject('error'):GetInteger('status')=422,'duplicate IDs rejected before mutation'). changesValue:Remove(2).
 changeValue:GetJsonObject('original'):Remove('memoria_calculo'). RUN BatchBridgeInvoke. RUN Check(NOT result:GetLogical('success') AND result:GetJsonObject('error'):GetInteger('status')=422,'complete14 mandatory').
 RUN Request('~{"resource":"container-despesas-lote","operation":"get","container_id":123,"id":1001}'). RUN BatchBridgeInvoke. beforeValue=CAST(result:GetJsonObject('data'):Clone(),JsonObject).
 RUN Request('~{"resource":"container-despesas-lote","operation":"batch","container_id":123}'). changesValue=NEW JsonArray(). changeValue=NEW JsonObject(). changeValue:Add('operation','delete'). changeValue:Add('clientId','row-delete'). changeValue:Add('id',1001). changeValue:Add('original',beforeValue). changesValue:Add(changeValue). req:Add('changes',changesValue).
 sequenceBefore=seq. quotesBefore=quoteCalls. RUN BatchBridgeInvoke.
 RUN Check(result:GetLogical('success') AND seq=sequenceBefore AND quoteCalls=quotesBefore,'native delete only stale no fiscal/sequence').
 result:WriteFile('bridge-delete.json',TRUE).
 RUN Check(result:GetJsonObject('audit'):GetJsonArray('changes'):GetJsonObject(1):GetJsonObject('before'):GetInteger('despesa_container_id')=1001,'delete preserves complete before image').
 RUN Check(NUM-DBS=0,'bridge tests TT only').
END PROCEDURE.
FUNCTION ExpenseTestImageComplete RETURNS LOGICAL(o AS JsonObject):
 DEFINE VARIABLE ns AS CHARACTER EXTENT NO-UNDO.
 ns=o:GetNames(). RETURN EXTENT(ns)=14 AND o:Has('despesa_id') AND o:Has('memoria_calculo') AND o:Has('item_container_id').
END FUNCTION.
