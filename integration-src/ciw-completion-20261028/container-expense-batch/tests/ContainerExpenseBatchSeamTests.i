/* Included only in the staged existing central TT suite; uses its real callbacks/fiscal. */
PROCEDURE BatchSeamTests:
 DEFINE VARIABLE expected AS JsonObject NO-UNDO. DEFINE VARIABLE a AS JsonObject NO-UNDO. DEFINE VARIABLE b AS JsonObject NO-UNDO.
 DEFINE VARIABLE changed AS JsonObject NO-UNDO. DEFINE VARIABLE seqBefore AS INTEGER NO-UNDO. DEFINE VARIABLE quotesBefore AS INTEGER NO-UNDO.
 DEFINE VARIABLE logsBefore AS INTEGER NO-UNDO. DEFINE VARIABLE fieldName AS CHARACTER NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.
 RUN AutomaticFixture.
 RUN Seed(6,'~{"despesa_id":2,"log_imposto":0,"log_calculada":false}').
 RUN Seed(7,'~{"empresa_despesa_id":2,"empresa_id":1,"despesa_id":2,"log_ativo":1}').
 RUN Seed(11,'~{"despesa_container_id":1002,"container_id":123,"despesa_id":2,"item_container_id":0,"vl_prev":51,"vl_base_imp":0,"log_manual":true}').
 hb[11]:FIND-FIRST('WHERE fx11.despesa_container_id=1002',NO-LOCK). hb[11]:BUFFER-FIELD('memoria_calculo'):BUFFER-VALUE='AbC '. hb[11]:BUFFER-RELEASE().
 RUN Request('~{"operation":"get","container_id":123,"id":1001}'). RUN Invoke. a=CAST(result:GetJsonObject('data'):Clone(),JsonObject).
 RUN Request('~{"operation":"get","container_id":123,"id":1002}'). RUN Invoke. b=CAST(result:GetJsonObject('data'):Clone(),JsonObject).
 policy:Add('batch_expected_before',NEW JsonObject()).
 DO j=1 TO 14:
  changed=CAST(b:Clone(),JsonObject). fieldName=ENTRY(j,'despesa_container_id,despesa_id,vl_prev,container_id,calc_imp_container_id,vl_base_imp,vl_negociado,vl_proforma,cta_corren_custo_distr_id,log_utilizado,log_manual,perc_calc,memoria_calculo,item_container_id').
  IF changed:IsNull(fieldName) THEN DO:
   IF fieldName='memoria_calculo' THEN changed:Set(fieldName,'changed').
   ELSE IF fieldName='log_utilizado' OR fieldName='log_manual' THEN changed:Set(fieldName,TRUE).
   ELSE changed:Set(fieldName,1).
  END.
  ELSE CASE changed:GetType(fieldName):
   WHEN JsonDataType:STRING THEN changed:Set(fieldName,changed:GetCharacter(fieldName) + 'x').
   WHEN JsonDataType:BOOLEAN THEN changed:Set(fieldName,NOT changed:GetLogical(fieldName)).
   WHEN JsonDataType:NUMBER THEN changed:Set(fieldName,changed:GetDecimal(fieldName) + 1).
  END CASE.
  expected=NEW JsonObject(). expected:Add('1001',CAST(a:Clone(),JsonObject)). expected:Add('1002',changed). policy:Set('batch_expected_before',expected).
  RUN Request('~{"operation":"batch_update","container_id":123,"rows":[~{"id":1001,"values":~{"vl_prev":901}},~{"id":1002,"values":~{"vl_prev":902}}]}').
  ASSIGN seqBefore=seq quotesBefore=quoteCalls logsBefore=logCalls. RUN Invoke.
  RUN Check(NOT result:GetLogical('success') AND NOT result:Has('audit'),'stale/malformed ' + fieldName + ' never confirms business audit').
  RUN Check(result:GetJsonObject('error'):GetInteger('status')=(IF fieldName='despesa_container_id' OR fieldName='container_id' THEN 422 ELSE 409),'typed complete snapshot gate ' + fieldName).
  RUN Check(seq=seqBefore AND quoteCalls=quotesBefore AND logCalls=logsBefore,'all snapshots validated before sequence/fiscal/log callback ' + fieldName).
  RUN Check(hb[11]:FIND-FIRST('WHERE fx11.despesa_container_id=1001',NO-LOCK) AND hb[11]:BUFFER-FIELD('vl_prev'):BUFFER-VALUE=a:GetDecimal('vl_prev'),'first valid line unchanged when second stale ' + fieldName).
 END.
 DO j=1 TO 2:
  changed=CAST(b:Clone(),JsonObject). changed:Set('memoria_calculo',IF j=1 THEN 'abc' ELSE 'Ab C').
  expected=NEW JsonObject(). expected:Add('1001',CAST(a:Clone(),JsonObject)). expected:Add('1002',changed). policy:Set('batch_expected_before',expected).
  RUN Request('~{"operation":"batch_delete","container_id":123,"rows":[~{"id":1001},~{"id":1002}]}'). quotesBefore=quoteCalls. seqBefore=seq. RUN Invoke.
  RUN Check(NOT result:GetLogical('success') AND result:GetJsonObject('error'):GetInteger('status')=409,'RAW strings preserve case and whitespace').
  RUN Check(seq=seqBefore AND quoteCalls=quotesBefore AND hb[11]:FIND-FIRST('WHERE fx11.despesa_container_id=1001',NO-LOCK),'RAW stale delete never mutates first row or calls fiscal').
 END.
 expected=NEW JsonObject(). expected:Add('1001',CAST(a:Clone(),JsonObject)). policy:Set('batch_expected_before',expected).
 RUN Request('~{"operation":"batch_delete","container_id":123,"rows":[~{"id":1001},~{"id":1002}]}'). RUN Invoke.
 RUN Check(NOT result:GetLogical('success') AND result:GetJsonObject('error'):GetInteger('status')=422,'missing expected row rejected').
 expected:Add('9999',CAST(b:Clone(),JsonObject)). RUN Invoke.
 RUN Check(NOT result:GetLogical('success') AND result:GetJsonObject('error'):GetInteger('status')=422,'extra expected identity rejected').
 expected=NEW JsonObject(). expected:Add('1001',CAST(a:Clone(),JsonObject)). changed=CAST(b:Clone(),JsonObject). changed:Remove('vl_proforma'). expected:Add('1002',changed). policy:Set('batch_expected_before',expected). RUN Invoke.
 RUN Check(NOT result:GetLogical('success') AND result:GetJsonObject('error'):GetInteger('status')=422,'incomplete physical original rejected').
 expected=NEW JsonObject(). expected:Add('1001',CAST(a:Clone(),JsonObject)). changed=CAST(b:Clone(),JsonObject). changed:Remove('vl_prev'). changed:Add('VL_PREV',51). expected:Add('1002',changed). policy:Set('batch_expected_before',expected). RUN Invoke.
 RUN Check(NOT result:GetLogical('success') AND result:GetJsonObject('error'):GetInteger('status')=422,'physical original names are RAW case-sensitive').
 expected=NEW JsonObject(). expected:Add('1001',CAST(a:Clone(),JsonObject)). expected:Add('1002',CAST(b:Clone(),JsonObject)). policy:Set('batch_expected_before',expected).
 hb[1]:FIND-FIRST('WHERE fx1.nr-container=123',NO-LOCK). hb[1]:BUFFER-FIELD('cod-estabel'):BUFFER-VALUE='101'. hb[1]:BUFFER-RELEASE().
 hb[2]:FIND-FIRST('WHERE fx2.empresa_id=1',NO-LOCK). hb[2]:BUFFER-FIELD('cod_emp_ems2'):BUFFER-VALUE=1. hb[2]:BUFFER-RELEASE().
 quotesBefore=quoteCalls. seqBefore=seq. RUN Invoke.
 RUN Check(NOT result:GetLogical('success') AND result:GetJsonObject('error'):GetInteger('status')=422,'opt-in MED ownership checked under actual master lock').
 RUN Check(quoteCalls=quotesBefore AND seq=seqBefore AND hb[11]:FIND-FIRST('WHERE fx11.despesa_container_id=1001',NO-LOCK),'changed master owner never mutates first row or invokes fiscal').
 policy:Remove('batch_expected_before'). RUN Request('~{"operation":"batch_update","container_id":123,"rows":[~{"id":1001,"values":~{"vl_prev":100}}]}'). RUN Invoke.
 RUN Check(result:GetLogical('success'),'old internal batch remains allowed on company1 without new opt-in').
 hb[1]:FIND-FIRST('WHERE fx1.nr-container=123',NO-LOCK). hb[1]:BUFFER-FIELD('cod-estabel'):BUFFER-VALUE='501'. hb[1]:BUFFER-RELEASE().
 hb[2]:FIND-FIRST('WHERE fx2.empresa_id=1',NO-LOCK). hb[2]:BUFFER-FIELD('cod_emp_ems2'):BUFFER-VALUE=5. hb[2]:BUFFER-RELEASE().
 policy:Add('batch_expected_before',expected).
 expected=NEW JsonObject(). expected:Add('1001',CAST(a:Clone(),JsonObject)). expected:Add('1002',CAST(b:Clone(),JsonObject)). policy:Set('batch_expected_before',expected).
 RUN Request('~{"operation":"batch_update","container_id":123,"rows":[~{"id":1001,"values":~{"vl_prev":301}},~{"id":1002,"values":~{"vl_prev":302}}]}'). RUN Invoke.
 RUN Check(result:GetLogical('success'),'complete fresh originals delegate to central batch update').
 RUN Check(hb[11]:FIND-FIRST('WHERE fx11.despesa_container_id=40',NO-LOCK) AND hb[11]:BUFFER-FIELD('vl_prev'):BUFFER-VALUE=10,'batch update never invokes calculated expense phase').
 policy:Remove('batch_expected_before').
 RUN Request('~{"operation":"batch_delete","container_id":123,"rows":[~{"id":1001},~{"id":1002}]}'). seqBefore=seq. quotesBefore=quoteCalls. RUN Invoke.
 RUN Check(result:GetLogical('success') AND seq=seqBefore AND quoteCalls=quotesBefore,'old internal batch delete remains optional seam and stale only').
END PROCEDURE.
