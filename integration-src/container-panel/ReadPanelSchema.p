BLOCK-LEVEL ON ERROR UNDO, THROW.
/* Probe de schema: apenas leitura do dicionario das tabelas de despesas; nenhuma escrita de negocio. */
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE cTable AS CHARACTER NO-UNDO.
DEFINE VARIABLE iTable AS INTEGER NO-UNDO.
DEFINE VARIABLE joResult AS JsonObject NO-UNDO.
DEFINE VARIABLE jaFields AS JsonArray NO-UNDO.
DEFINE VARIABLE jaIndexes AS JsonArray NO-UNDO.
DEFINE VARIABLE jaTriggers AS JsonArray NO-UNDO.
DEFINE VARIABLE joItem AS JsonObject NO-UNDO.
DEFINE VARIABLE jaIndexFields AS JsonArray NO-UNDO.
DEFINE VARIABLE jaReferences AS JsonArray NO-UNDO.
DEFINE VARIABLE jaFieldTriggers AS JsonArray NO-UNDO.
DEFINE VARIABLE joTrigger AS JsonObject NO-UNDO.

DO iTable = 1 TO NUM-ENTRIES("pp-container,situacoes_container,itens_container,itens_proc_compra,procs_compra,empresas,empresas_despesa,despesas,despesas_container,pagtos_container,nfs_container,anexos_container,tipos_anexo,versoes_item_custo_container,itens_container_custo,calcs_imp_container,descontos_importacao,motivos_desconto,cta_corren_custo_distr,cta_corren_desconto,cta_corren_fornec_imp,pp-it-container,pp_container_permissao,saldo_repres,im-param,hist_cotacoes_bc"):
cTable = ENTRY(iTable,"pp-container,situacoes_container,itens_container,itens_proc_compra,procs_compra,empresas,empresas_despesa,despesas,despesas_container,pagtos_container,nfs_container,anexos_container,tipos_anexo,versoes_item_custo_container,itens_container_custo,calcs_imp_container,descontos_importacao,motivos_desconto,cta_corren_custo_distr,cta_corren_desconto,cta_corren_fornec_imp,pp-it-container,pp_container_permissao,saldo_repres,im-param,hist_cotacoes_bc").
joResult = NEW JsonObject().
jaFields = NEW JsonArray().
jaIndexes = NEW JsonArray().
jaTriggers = NEW JsonArray().
FIND FIRST espec._File WHERE espec._File._File-Name = cTable NO-LOCK NO-ERROR.
IF NOT AVAILABLE espec._File THEN NEXT.
joResult:Add("database", "espec").
joResult:Add("table", espec._File._File-Name).
FOR EACH espec._Field WHERE espec._Field._File-recid = RECID(espec._File) NO-LOCK BY espec._Field._Order:
  joItem = NEW JsonObject().
  joItem:Add("name", espec._Field._Field-Name).
  joItem:Add("type", espec._Field._Data-Type).
  joItem:Add("format", espec._Field._Format).
  joItem:Add("decimals", espec._Field._Decimals).
  joItem:Add("initial", espec._Field._Initial).
  joItem:Add("mandatory", espec._Field._Mandatory).
  joItem:Add("extent", espec._Field._Extent).
  joItem:Add("validation", espec._Field._Valexp).
  jaFieldTriggers = NEW JsonArray().
  FOR EACH espec._Field-trig WHERE espec._Field-trig._Field-recid = RECID(espec._Field) NO-LOCK:
    joTrigger = NEW JsonObject().
    joTrigger:Add("event", espec._Field-trig._Event).
    joTrigger:Add("procedure", espec._Field-trig._Proc-Name).
    jaFieldTriggers:Add(joTrigger).
  END.
  joItem:Add("triggers", jaFieldTriggers).
  jaFields:Add(joItem).
END.
FOR EACH espec._Index WHERE espec._Index._File-recid = RECID(espec._File) NO-LOCK:
  joItem = NEW JsonObject().
  jaIndexFields = NEW JsonArray().
  joItem:Add("name", espec._Index._Index-Name).
  joItem:Add("unique", espec._Index._Unique).
  joItem:Add("primary", RECID(espec._Index) = espec._File._Prime-Index).
  FOR EACH espec._Index-field WHERE espec._Index-field._Index-recid = RECID(espec._Index) NO-LOCK BY espec._Index-field._Index-Seq:
    FIND espec._Field WHERE RECID(espec._Field) = espec._Index-field._Field-recid NO-LOCK.
    jaIndexFields:Add(espec._Field._Field-Name).
  END.
  joItem:Add("fields", jaIndexFields).
  jaIndexes:Add(joItem).
END.
FOR EACH espec._File-trig WHERE espec._File-trig._File-recid = RECID(espec._File) NO-LOCK:
  joItem = NEW JsonObject().
  joItem:Add("event", espec._File-trig._Event).
  joItem:Add("procedure", espec._File-trig._Proc-Name).
  jaTriggers:Add(joItem).
END.
joResult:Add("fields", jaFields).
joResult:Add("indexes", jaIndexes).
joResult:Add("triggers", jaTriggers).
joResult:WriteFile("schema-" + cTable + ".json", TRUE).
END.
QUIT.

