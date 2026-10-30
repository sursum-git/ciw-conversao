/* Reusable company boundary for fixed CIW API buffers. No connection or cost formula lives here. */
DEFINE VARIABLE ciwApiCompanyEnabled AS LOGICAL NO-UNDO.
DEFINE VARIABLE ciwApiCompanyId AS INTEGER NO-UNDO.
DEFINE VARIABLE ciwApiCompanyEms2 AS INTEGER NO-UNDO.
DEFINE VARIABLE ciwApiCompanyEms5 AS INTEGER NO-UNDO.
DEFINE VARIABLE ciwApiCompanyErrorCode AS CHARACTER NO-UNDO.
DEFINE VARIABLE ciwApiCompanyErrorMessage AS CHARACTER NO-UNDO.
DEFINE VARIABLE ciwApiCompanyResult AS LOGICAL NO-UNDO.
DEFINE VARIABLE ciwApiCompanyFixedBuffer AS HANDLE NO-UNDO.
DEFINE VARIABLE ciwApiCompanyCatalog AS HANDLE NO-UNDO.
DEFINE VARIABLE ciwApiCompanyCatalogBuffer AS HANDLE NO-UNDO.

FUNCTION ApiCompanyReject RETURNS LOGICAL (messageValue AS CHARACTER):
 ASSIGN ciwApiCompanyErrorCode="API_COMPANY_CONTEXT_CONFLICT" ciwApiCompanyErrorMessage=messageValue.
 UNDO, THROW NEW Progress.Lang.AppError(messageValue,1).
END FUNCTION.

FUNCTION ApiCompanyInteger RETURNS INTEGER (requestValue AS JsonObject,fieldValue AS CHARACTER):
 DEFINE VARIABLE textValue AS CHARACTER NO-UNDO.
 DEFINE VARIABLE positionValue AS INTEGER NO-UNDO.
 DEFINE VARIABLE numberValue AS DECIMAL NO-UNDO.
 IF NOT requestValue:Has(fieldValue) OR requestValue:IsNull(fieldValue) THEN RETURN INTEGER(ApiCompanyReject("Contexto de empresa incompleto.")).
 IF requestValue:GetType(fieldValue)<>JsonDataType:NUMBER THEN RETURN INTEGER(ApiCompanyReject("Codigo empresarial deve ser inteiro JSON.")).
 textValue=requestValue:GetJsonText(fieldValue).
 IF LENGTH(textValue)=0 OR LENGTH(textValue)>10 THEN RETURN INTEGER(ApiCompanyReject("Codigo empresarial invalido.")).
 DO positionValue=1 TO LENGTH(textValue):
  IF INDEX("0123456789",SUBSTRING(textValue,positionValue,1))=0 THEN RETURN INTEGER(ApiCompanyReject("Codigo empresarial invalido.")).
 END.
 numberValue=DECIMAL(textValue).
 IF numberValue<1 OR numberValue>2147483647 THEN RETURN INTEGER(ApiCompanyReject("Codigo empresarial fora do limite.")).
 RETURN INTEGER(numberValue).
END FUNCTION.

FUNCTION ApiCompanyCapture RETURNS LOGICAL (requestValue AS JsonObject):
 ASSIGN ciwApiCompanyEnabled=FALSE ciwApiCompanyId=0 ciwApiCompanyEms2=0 ciwApiCompanyEms5=0 ciwApiCompanyErrorCode="" ciwApiCompanyErrorMessage="".
 IF NOT VALID-OBJECT(requestValue) THEN RETURN FALSE.
 IF NOT requestValue:Has("api_empresa_id") AND NOT requestValue:Has("api_ems2_code") AND NOT requestValue:Has("api_ems5_code") THEN RETURN FALSE.
 ASSIGN ciwApiCompanyId=ApiCompanyInteger(requestValue,"api_empresa_id")
        ciwApiCompanyEms2=ApiCompanyInteger(requestValue,"api_ems2_code")
        ciwApiCompanyEms5=ApiCompanyInteger(requestValue,"api_ems5_code") ciwApiCompanyEnabled=TRUE.
 requestValue:Remove("api_empresa_id"). requestValue:Remove("api_ems2_code"). requestValue:Remove("api_ems5_code").
 RETURN TRUE.
END FUNCTION.

FUNCTION ApiCompanyValidate RETURNS LOGICAL (companiesValue AS HANDLE):
 DEFINE VARIABLE companyBuffer AS HANDLE NO-UNDO.
 DEFINE VARIABLE companyQuery AS HANDLE NO-UNDO.
 DEFINE VARIABLE matched AS INTEGER NO-UNDO.
 IF NOT ciwApiCompanyEnabled THEN RETURN TRUE.
 DO ON ERROR UNDO, THROW:
  IF NOT VALID-HANDLE(companiesValue) THEN RETURN ApiCompanyReject("Catalogo empresarial indisponivel.").
  CREATE BUFFER companyBuffer FOR TABLE companiesValue BUFFER-NAME "bCiwApiCompanyCheck".
  CREATE QUERY companyQuery. companyQuery:SET-BUFFERS(companyBuffer).
  IF NOT companyQuery:QUERY-PREPARE("FOR EACH " + companyBuffer:NAME + " WHERE " + companyBuffer:NAME + ".empresa_id=" + TRIM(STRING(ciwApiCompanyId)) + " NO-LOCK") THEN RETURN ApiCompanyReject("Catalogo empresarial invalido.").
  companyQuery:QUERY-OPEN(). companyQuery:GET-FIRST().
  DO WHILE NOT companyQuery:QUERY-OFF-END:
   matched = matched + 1.
   IF matched>1 THEN RETURN ApiCompanyReject("ID empresarial ambiguo.").
   IF companyBuffer:BUFFER-FIELD("cod_emp_ems2"):BUFFER-VALUE<>ciwApiCompanyEms2 OR companyBuffer:BUFFER-FIELD("cod_emp_ems5"):BUFFER-VALUE<>ciwApiCompanyEms5 THEN RETURN ApiCompanyReject("Vinculo empresarial diverge do cadastro CIW.").
   companyQuery:GET-NEXT().
  END.
  IF matched<>1 THEN RETURN ApiCompanyReject("Empresa selecionada nao existe no CIW.").
  RETURN TRUE.
  FINALLY:
   IF VALID-HANDLE(companyQuery) THEN DO: companyQuery:QUERY-CLOSE() NO-ERROR. DELETE OBJECT companyQuery NO-ERROR. END.
   IF VALID-HANDLE(companyBuffer) THEN DELETE OBJECT companyBuffer NO-ERROR.
  END FINALLY.
 END.
END FUNCTION.

FUNCTION ApiCompanyContainerWhere RETURNS CHARACTER (containerValue AS HANDLE):
 IF NOT ciwApiCompanyEnabled THEN RETURN "".
 IF ciwApiCompanyEms2>9 THEN RETURN STRING(ApiCompanyReject("Codigo EMS2 sem regra de estabelecimento autorizada.")).
 RETURN "SUBSTRING(" + containerValue:NAME + ".cod-estabel,1,1)=" + CHR(34) + TRIM(STRING(ciwApiCompanyEms2)) + CHR(34).
END FUNCTION.

FUNCTION ApiCompanyRequireContainer RETURNS LOGICAL (containerValue AS HANDLE):
 DEFINE VARIABLE establishmentValue AS CHARACTER NO-UNDO.
 IF NOT ciwApiCompanyEnabled THEN RETURN TRUE.
 IF NOT VALID-HANDLE(containerValue) OR NOT containerValue:AVAILABLE THEN RETURN ApiCompanyReject("Container empresarial indisponivel.").
 establishmentValue=containerValue:BUFFER-FIELD("cod-estabel"):BUFFER-VALUE.
 IF establishmentValue=? OR LENGTH(establishmentValue)=0 OR SUBSTRING(establishmentValue,1,1)<>TRIM(STRING(ciwApiCompanyEms2)) THEN RETURN ApiCompanyReject("Container pertence a outra empresa.").
 RETURN TRUE.
END FUNCTION.

FUNCTION ApiCompanyRequireRecordCompany RETURNS LOGICAL (recordValue AS HANDLE,fieldValue AS CHARACTER):
 IF NOT ciwApiCompanyEnabled THEN RETURN TRUE.
 IF NOT VALID-HANDLE(recordValue) OR NOT recordValue:AVAILABLE THEN RETURN ApiCompanyReject("Registro empresarial indisponivel.").
 IF recordValue:BUFFER-FIELD(fieldValue):BUFFER-VALUE=? OR recordValue:BUFFER-FIELD(fieldValue):BUFFER-VALUE<>ciwApiCompanyId THEN RETURN ApiCompanyReject("Registro pertence a outra empresa.").
 RETURN TRUE.
END FUNCTION.

FUNCTION ApiCompanyPublish RETURNS LOGICAL (requestValue AS JsonObject):
 IF NOT ciwApiCompanyEnabled THEN RETURN TRUE.
 IF requestValue:Has("api_empresa_id") THEN requestValue:Remove("api_empresa_id").
 IF requestValue:Has("api_ems2_code") THEN requestValue:Remove("api_ems2_code").
 IF requestValue:Has("api_ems5_code") THEN requestValue:Remove("api_ems5_code").
 requestValue:Add("api_empresa_id",ciwApiCompanyId). requestValue:Add("api_ems2_code",ciwApiCompanyEms2). requestValue:Add("api_ems5_code",ciwApiCompanyEms5).
 RETURN TRUE.
END FUNCTION.

FUNCTION ApiCompanyNarrowCatalog RETURNS HANDLE (companiesValue AS HANDLE):
 DEFINE VARIABLE foundValue AS LOGICAL NO-UNDO.
 IF NOT ciwApiCompanyEnabled THEN RETURN companiesValue.
 IF VALID-HANDLE(ciwApiCompanyCatalogBuffer) THEN RETURN ciwApiCompanyCatalogBuffer.
 foundValue=ApiCompanyValidate(companiesValue).
 foundValue=companiesValue:FIND-FIRST("WHERE " + companiesValue:NAME + ".empresa_id=" + TRIM(STRING(ciwApiCompanyId)),NO-LOCK) NO-ERROR.
 IF NOT foundValue THEN DO: foundValue=ApiCompanyReject("Empresa selecionada indisponivel."). RETURN ?. END.
 CREATE TEMP-TABLE ciwApiCompanyCatalog.
 IF NOT ciwApiCompanyCatalog:CREATE-LIKE(companiesValue) THEN DO: foundValue=ApiCompanyReject("Catalogo empresarial nao pode ser preparado."). RETURN ?. END.
 ciwApiCompanyCatalog:TEMP-TABLE-PREPARE("ttCiwApiCompanyScope").
 CREATE BUFFER ciwApiCompanyCatalogBuffer FOR TABLE ciwApiCompanyCatalog:DEFAULT-BUFFER-HANDLE BUFFER-NAME "bCiwApiCompanyScope".
 ciwApiCompanyCatalogBuffer:BUFFER-CREATE().
 IF NOT ciwApiCompanyCatalogBuffer:BUFFER-COPY(companiesValue) THEN DO: foundValue=ApiCompanyReject("Falha ao copiar vinculo empresarial."). RETURN ?. END.
 RETURN ciwApiCompanyCatalogBuffer.
END FUNCTION.

FUNCTION ApiCompanyRecordWhere RETURNS CHARACTER (recordValue AS HANDLE,fieldValue AS CHARACTER):
 IF NOT ciwApiCompanyEnabled THEN RETURN "".
 RETURN recordValue:NAME + "." + fieldValue + "=" + TRIM(STRING(ciwApiCompanyId)).
END FUNCTION.

FUNCTION ApiCompanyRequestId RETURNS INTEGER (requestValue AS JsonObject,fieldValue AS CHARACTER):
 DEFINE VARIABLE textValue AS CHARACTER NO-UNDO.
 DEFINE VARIABLE positionValue AS INTEGER NO-UNDO.
 DEFINE VARIABLE numberValue AS DECIMAL NO-UNDO.
 IF NOT requestValue:Has(fieldValue) OR requestValue:IsNull(fieldValue) THEN RETURN INTEGER(ApiCompanyReject("Informe o contexto do registro empresarial.")).
 CASE requestValue:GetType(fieldValue):
  WHEN JsonDataType:STRING THEN textValue=requestValue:GetCharacter(fieldValue).
  WHEN JsonDataType:NUMBER THEN textValue=requestValue:GetJsonText(fieldValue).
  OTHERWISE RETURN INTEGER(ApiCompanyReject("Contexto de registro empresarial invalido.")).
 END CASE.
 IF LENGTH(textValue)=0 OR LENGTH(textValue)>10 THEN RETURN INTEGER(ApiCompanyReject("Contexto de registro empresarial invalido.")).
 DO positionValue=1 TO LENGTH(textValue):
  IF INDEX("0123456789",SUBSTRING(textValue,positionValue,1))=0 THEN RETURN INTEGER(ApiCompanyReject("Contexto de registro empresarial invalido.")).
 END.
 numberValue=DECIMAL(textValue).
 IF numberValue<1 OR numberValue>2147483647 THEN RETURN INTEGER(ApiCompanyReject("Contexto de registro empresarial fora do limite.")).
 RETURN INTEGER(numberValue).
END FUNCTION.

FUNCTION ApiCompanyValidateFixed RETURNS LOGICAL ():
 IF NOT ciwApiCompanyEnabled THEN RETURN TRUE.
 IF NOT CONNECTED("espec") THEN RETURN ApiCompanyReject("Catalogo empresarial CIW indisponivel.").
 IF NOT VALID-HANDLE(ciwApiCompanyFixedBuffer) THEN CREATE BUFFER ciwApiCompanyFixedBuffer FOR TABLE "espec.empresas" BUFFER-NAME "bCiwApiFixedCompany".
 RETURN ApiCompanyValidate(ciwApiCompanyFixedBuffer).
END FUNCTION.

FUNCTION ApiCompanyGuardRequestContainer RETURNS LOGICAL (requestValue AS JsonObject,masterValue AS HANDLE,allowList AS LOGICAL):
 DEFINE VARIABLE idValue AS INTEGER NO-UNDO.
 DEFINE VARIABLE rowBuffer AS HANDLE NO-UNDO.
 DEFINE VARIABLE rowQuery AS HANDLE NO-UNDO.
 DEFINE VARIABLE resultValue AS LOGICAL NO-UNDO.
 IF NOT ciwApiCompanyEnabled THEN RETURN TRUE.
 IF requestValue:Has("container_id") THEN idValue=ApiCompanyRequestId(requestValue,"container_id").
 ELSE IF requestValue:Has("id") THEN idValue=ApiCompanyRequestId(requestValue,"id").
 ELSE IF allowList THEN RETURN TRUE.
 ELSE RETURN ApiCompanyReject("Informe o container da empresa selecionada.").
 DO ON ERROR UNDO, THROW:
  CREATE BUFFER rowBuffer FOR TABLE masterValue BUFFER-NAME "bCiwApiScopeMaster".
  CREATE QUERY rowQuery. rowQuery:SET-BUFFERS(rowBuffer).
  IF NOT rowQuery:QUERY-PREPARE("FOR EACH " + rowBuffer:NAME + " WHERE " + rowBuffer:NAME + ".nr-container=" + TRIM(STRING(idValue)) + " NO-LOCK") THEN RETURN ApiCompanyReject("Consulta de contexto empresarial indisponivel.").
  rowQuery:QUERY-OPEN(). rowQuery:GET-FIRST().
  IF rowQuery:QUERY-OFF-END THEN RETURN ApiCompanyReject("Container empresarial nao encontrado.").
  resultValue=ApiCompanyRequireContainer(rowBuffer).
  rowQuery:GET-NEXT().
  IF NOT rowQuery:QUERY-OFF-END THEN RETURN ApiCompanyReject("Container empresarial ambiguo.").
  RETURN TRUE.
  FINALLY:
   IF VALID-HANDLE(rowQuery) THEN DO: rowQuery:QUERY-CLOSE() NO-ERROR. DELETE OBJECT rowQuery NO-ERROR. END.
   IF VALID-HANDLE(rowBuffer) THEN DELETE OBJECT rowBuffer NO-ERROR.
  END FINALLY.
 END.
END FUNCTION.

FUNCTION ApiCompanyError RETURNS JsonObject ():
 DEFINE VARIABLE responseValue AS JsonObject NO-UNDO.
 DEFINE VARIABLE errorValue AS JsonObject NO-UNDO.
 ASSIGN responseValue=NEW JsonObject() errorValue=NEW JsonObject().
 errorValue:Add("code",ciwApiCompanyErrorCode). errorValue:Add("message",ciwApiCompanyErrorMessage). errorValue:Add("status",403).
 responseValue:Add("success",FALSE). responseValue:Add("error",errorValue).
 RETURN responseValue.
END FUNCTION.

PROCEDURE ApiCompanyRelease:
 IF VALID-HANDLE(ciwApiCompanyFixedBuffer) THEN DELETE OBJECT ciwApiCompanyFixedBuffer NO-ERROR.
 IF VALID-HANDLE(ciwApiCompanyCatalogBuffer) THEN DELETE OBJECT ciwApiCompanyCatalogBuffer NO-ERROR.
 IF VALID-HANDLE(ciwApiCompanyCatalog) THEN DELETE OBJECT ciwApiCompanyCatalog NO-ERROR.
END PROCEDURE.
