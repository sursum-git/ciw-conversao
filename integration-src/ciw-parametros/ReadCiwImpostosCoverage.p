/* Diagnostico somente leitura; nao publicar no ERP. Saida apenas contagens. */
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE totalRows AS INTEGER NO-UNDO.
DEFINE VARIABLE orphanRows AS INTEGER NO-UNDO.
DEFINE VARIABLE invalidTaxRows AS INTEGER NO-UNDO.
DEFINE VARIABLE invalidBaseRows AS INTEGER NO-UNDO.
DEFINE VARIABLE invalidCompanyRows AS INTEGER NO-UNDO.
DEFINE VARIABLE resultValue AS JsonObject NO-UNDO.
FOR EACH espec.despesas_impostos NO-LOCK:
 totalRows=totalRows + 1.
 IF NOT CAN-FIND(FIRST espec.empresas_despesa WHERE espec.empresas_despesa.despesa_id=espec.despesas_impostos.despesa_id AND espec.empresas_despesa.empresa_id=espec.despesas_impostos.empresa_id) THEN orphanRows=orphanRows + 1.
 IF NOT CAN-FIND(FIRST espec.despesas WHERE espec.despesas.despesa_id=espec.despesas_impostos.imposto_id AND espec.despesas.log_imposto=1) THEN invalidTaxRows=invalidTaxRows + 1.
 IF NOT CAN-FIND(FIRST espec.despesas WHERE espec.despesas.despesa_id=espec.despesas_impostos.despesa_id) THEN invalidBaseRows=invalidBaseRows + 1.
 IF NOT CAN-FIND(FIRST espec.empresas WHERE espec.empresas.empresa_id=espec.despesas_impostos.empresa_id) THEN invalidCompanyRows=invalidCompanyRows + 1.
END.
resultValue=NEW JsonObject(). resultValue:Add("total",totalRows). resultValue:Add("withoutParent",orphanRows).
resultValue:Add("invalidTaxReference",invalidTaxRows). resultValue:Add("missingBase",invalidBaseRows). resultValue:Add("missingCompany",invalidCompanyRows).
resultValue:Add("readOnly",TRUE). resultValue:WriteFile("impostos-coverage.json",TRUE).
QUIT.
