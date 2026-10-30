/* Diagnostic only: dictionary plus four named non-secret cost parameters.
   Never publish as HTTP route; never reads credential parameters. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE result AS JsonObject NO-UNDO.
DEFINE VARIABLE rows AS JsonArray NO-UNDO.
DEFINE VARIABLE row AS JsonObject NO-UNDO.
DEFINE VARIABLE fieldNames AS JsonArray NO-UNDO.
DEFINE VARIABLE tableBuffer AS HANDLE NO-UNDO.
DEFINE VARIABLE keyName AS CHARACTER NO-UNDO.
DEFINE VARIABLE k AS INTEGER NO-UNDO.
DEFINE VARIABLE found AS LOGICAL NO-UNDO.
DEFINE VARIABLE parameterNames AS CHARACTER NO-UNDO INITIAL "nat_operacao_nf_mae,cod_despesa_pis,cod_despesa_cofins,despesa_distr_custo,NAT-OPERACAO-IMP,nats_operacao_dados_imp_obs".
DEFINE VARIABLE sequenceNames AS CHARACTER NO-UNDO INITIAL "seq_versao_item_container_custo,seq_item_container_custos,seq_item_custos,seq_cta_corren_custo_distr".
result=NEW JsonObject(). rows=NEW JsonArray().
result:Add("logicalDatabase",LDBNAME("espec")). result:Add("physicalDatabase",PDBNAME("espec")).
FOR EACH espec._File NO-LOCK WHERE espec._File._File-Name="im-param" OR espec._File._File-Name="im_param":
 row=NEW JsonObject(). fieldNames=NEW JsonArray(). row:Add("table",espec._File._File-Name).
 FOR EACH espec._Field NO-LOCK WHERE espec._Field._File-recid=RECID(espec._File) BY espec._Field._Order: fieldNames:Add(espec._Field._Field-Name). END.
 row:Add("fields",fieldNames). rows:Add(row).
 IF espec._File._File-Name<>"im-param" THEN NEXT.
 CREATE BUFFER tableBuffer FOR TABLE "espec.im-param" BUFFER-NAME "bCostParameterProbe".
 DO k=1 TO NUM-ENTRIES(parameterNames):
  keyName=ENTRY(k,parameterNames). row=NEW JsonObject(). row:Add("parameter",keyName).
  found=tableBuffer:FIND-FIRST("WHERE bCostParameterProbe.cod-param=" + QUOTER(keyName),NO-LOCK) NO-ERROR.
  row:Add("found",found).
  IF found THEN row:Add("value",STRING(tableBuffer:BUFFER-FIELD("val-param"):BUFFER-VALUE)). ELSE row:AddNull("value").
  rows:Add(row).
 END.
 DELETE OBJECT tableBuffer.
END.
/* Return only codes of broader candidates, never values of unknown settings. */
FOR EACH espec.im-param NO-LOCK WHERE INDEX(LC(espec.im-param.cod-param),"nat")>0 OR INDEX(LC(espec.im-param.cod-param),"mae")>0 OR INDEX(LC(espec.im-param.cod-param),"nota")>0:
 row=NEW JsonObject(). row:Add("relatedParameter",espec.im-param.cod-param).
 rows:Add(row).
END.
DO k=1 TO NUM-ENTRIES(sequenceNames):
 keyName=ENTRY(k,sequenceNames). row=NEW JsonObject(). row:Add("sequence",keyName).
 row:Add("found",CAN-FIND(FIRST espec._Sequence WHERE espec._Sequence._Seq-Name=keyName)).
 rows:Add(row).
END.
result:Add("results",rows). result:WriteFile("container-cost-parameters-probe.json",TRUE).
QUIT.
