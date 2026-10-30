/* Synthetic only. No business database is connected or mutated. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE TEMP-TABLE ttCompany NO-UNDO FIELD empresa_id AS INTEGER FIELD cod_emp_ems2 AS INTEGER FIELD cod_emp_ems5 AS INTEGER.
DEFINE TEMP-TABLE ttContainer NO-UNDO FIELD nr-container AS INTEGER FIELD cod-estabel AS CHARACTER.
DEFINE TEMP-TABLE ttLink NO-UNDO FIELD empresa_id AS INTEGER.
DEFINE VARIABLE requestJson AS JsonObject NO-UNDO.
DEFINE VARIABLE scopeBuffer AS HANDLE NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE rejected AS LOGICAL NO-UNDO.
DEFINE VARIABLE resultValue AS LOGICAL NO-UNDO.
DEFINE VARIABLE queryHandle AS HANDLE NO-UNDO.
{sursum-api/includes/ApiCompanyBoundary.i}
CREATE ttCompany. ASSIGN ttCompany.empresa_id=1 ttCompany.cod_emp_ems2=1 ttCompany.cod_emp_ems5=100.
CREATE ttCompany. ASSIGN ttCompany.empresa_id=2 ttCompany.cod_emp_ems2=5 ttCompany.cod_emp_ems5=500.
/* Preserve a user's separate company with the same ERP prefix. Never infer ownership from its label. */
CREATE ttCompany. ASSIGN ttCompany.empresa_id=3 ttCompany.cod_emp_ems2=1 ttCompany.cod_emp_ems5=1.
CREATE ttContainer. ASSIGN ttContainer.nr-container=7 ttContainer.cod-estabel="101".
CREATE ttContainer. ASSIGN ttContainer.nr-container=8 ttContainer.cod-estabel="501".
requestJson=NEW JsonObject(). requestJson:Add("operation","read").
RUN Check(NOT ApiCompanyCapture(requestJson),"Legacy request stays unscoped").
RUN Check(ApiCompanyContainerWhere(BUFFER ttContainer:HANDLE)="","Legacy query unchanged").
requestJson:Add("api_empresa_id",1). requestJson:Add("api_ems2_code",1). requestJson:Add("api_ems5_code",100).
RUN Check(ApiCompanyCapture(requestJson),"Explicit context captured").
RUN Check(NOT requestJson:Has("api_empresa_id"),"Transport context removed before old closed envelope").
RUN Check(ApiCompanyValidate(BUFFER ttCompany:HANDLE),"Exact company identifiers validated").
CREATE QUERY queryHandle. queryHandle:SET-BUFFERS(BUFFER ttContainer:HANDLE).
RUN Check(queryHandle:QUERY-PREPARE("FOR EACH ttContainer WHERE " + ApiCompanyContainerWhere(BUFFER ttContainer:HANDLE) + " NO-LOCK"),"Scoped container query prepares").
queryHandle:QUERY-OPEN(). queryHandle:GET-FIRST().
RUN Check(ttContainer.nr-container=7,"Scoped query reads company A only").
queryHandle:GET-NEXT(). RUN Check(queryHandle:QUERY-OFF-END,"Scoped query excludes company B").
queryHandle:QUERY-CLOSE(). DELETE OBJECT queryHandle.
requestJson:Add("container_id",7). RUN Check(ApiCompanyGuardRequestContainer(requestJson,BUFFER ttContainer:HANDLE,FALSE),"Request parent validated before service").
requestJson:Remove("container_id"). requestJson:Add("container_id",8). rejected=FALSE.
DO ON ERROR UNDO, THROW:
 resultValue=ApiCompanyGuardRequestContainer(requestJson,BUFFER ttContainer:HANDLE,FALSE).
 CATCH errorObject AS Progress.Lang.Error: rejected=TRUE. END CATCH.
END.
RUN Check(rejected,"Request of company B rejected before composed calls"). requestJson:Remove("container_id").
scopeBuffer=ApiCompanyNarrowCatalog(BUFFER ttCompany:HANDLE).
RUN Check(scopeBuffer:FIND-FIRST("",NO-LOCK),"Scoped company catalog available").
RUN Check(scopeBuffer:BUFFER-FIELD("empresa_id"):BUFFER-VALUE=1,"Selected ID wins over duplicate ERP prefix").
CREATE QUERY queryHandle. queryHandle:SET-BUFFERS(scopeBuffer).
queryHandle:QUERY-PREPARE("FOR EACH " + scopeBuffer:NAME + " NO-LOCK"). queryHandle:QUERY-OPEN(). queryHandle:GET-FIRST(). queryHandle:GET-NEXT().
RUN Check(queryHandle:QUERY-OFF-END,"No company B or user test in scoped catalog").
queryHandle:QUERY-CLOSE(). DELETE OBJECT queryHandle.
FIND ttContainer WHERE ttContainer.nr-container=7 NO-LOCK. RUN Check(ApiCompanyRequireContainer(BUFFER ttContainer:HANDLE),"Container of company A allowed").
rejected=FALSE.
DO ON ERROR UNDO, THROW:
 FIND ttContainer WHERE ttContainer.nr-container=8 NO-LOCK.
 resultValue=ApiCompanyRequireContainer(BUFFER ttContainer:HANDLE).
 CATCH errorObject AS Progress.Lang.Error: rejected=TRUE. END CATCH.
END.
RUN Check(rejected,"Container of company B refused").
CREATE ttLink. ttLink.empresa_id=2. rejected=FALSE.
DO ON ERROR UNDO, THROW:
 resultValue=ApiCompanyRequireRecordCompany(BUFFER ttLink:HANDLE,"empresa_id").
 CATCH errorObject AS Progress.Lang.Error: rejected=TRUE. END CATCH.
END.
RUN Check(rejected,"Persisted relation of other company refused").
resultValue=ApiCompanyPublish(requestJson).
RUN Check(requestJson:GetInteger("api_empresa_id")=1,"Pinned context republished for private composition").
DELETE OBJECT requestJson. requestJson=NEW JsonObject(). requestJson:Add("api_empresa_id",1). rejected=FALSE.
DO ON ERROR UNDO, THROW:
 resultValue=ApiCompanyCapture(requestJson).
 CATCH errorObject AS Progress.Lang.Error: rejected=TRUE. END CATCH.
END.
RUN Check(rejected,"Incomplete context never becomes legacy").
DELETE OBJECT requestJson. requestJson=NEW JsonObject(). requestJson:Add("api_empresa_id","1"). requestJson:Add("api_ems2_code",1). requestJson:Add("api_ems5_code",100). rejected=FALSE.
DO ON ERROR UNDO, THROW:
 resultValue=ApiCompanyCapture(requestJson).
 CATCH errorObject AS Progress.Lang.Error: rejected=TRUE. END CATCH.
END.
RUN Check(rejected,"Text company identifiers refused").
IF VALID-HANDLE(scopeBuffer) THEN DELETE OBJECT scopeBuffer.
RUN ApiCompanyRelease.
EMPTY TEMP-TABLE ttCompany. EMPTY TEMP-TABLE ttContainer. EMPTY TEMP-TABLE ttLink.
PUT UNFORMATTED "PASS ApiCompanyBoundary " checks " checks; synthetic tables cleaned." SKIP.
PROCEDURE Check:
 DEFINE INPUT PARAMETER conditionValue AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER labelValue AS CHARACTER NO-UNDO.
 IF conditionValue<>TRUE OR conditionValue=? THEN UNDO, THROW NEW Progress.Lang.AppError("FAIL " + labelValue,1).
 checks = checks + 1.
END PROCEDURE.
