/* Only isolated temp tables; no database or business writer. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE TEMP-TABLE ttMaster NO-UNDO FIELD nr-container AS INTEGER FIELD cod-estabel AS CHARACTER FIELD cod-emit-forn AS INTEGER INDEX pk IS PRIMARY UNIQUE nr-container.
DEFINE TEMP-TABLE ttCompany NO-UNDO FIELD empresa_id AS INTEGER FIELD cod_emp_ems2 AS INTEGER FIELD cod_emp_ems5 AS INTEGER INDEX pk IS PRIMARY UNIQUE empresa_id.
DEFINE TEMP-TABLE ttLink NO-UNDO FIELD documento AS CHARACTER FIELD serie AS CHARACTER FIELD estab AS CHARACTER FIELD nat_operacao AS CHARACTER FIELD cod_emitente AS INTEGER FIELD container_id AS INTEGER INDEX pk IS PRIMARY UNIQUE documento serie estab nat_operacao cod_emitente container_id.
DEFINE TEMP-TABLE ttDoc NO-UNDO FIELD cod-estabel AS CHARACTER FIELD nro-docto AS CHARACTER FIELD esp-docto AS INTEGER FIELD serie-docto AS CHARACTER FIELD cod-emitente AS INTEGER FIELD dt-emissao AS DATE FIELD dt-trans AS DATE FIELD nat-operacao AS CHARACTER FIELD idi-sit-nf-eletro AS INTEGER FIELD tot-valor AS DECIMAL DECIMALS 10 FIELD despesa-nota AS DECIMAL DECIMALS 10 FIELD valor-embal AS DECIMAL DECIMALS 10 FIELD valor-frete AS DECIMAL DECIMALS 10 FIELD valor-mercad AS DECIMAL DECIMALS 10 FIELD valor-outras AS DECIMAL DECIMALS 10 FIELD valor-seguro AS DECIMAL DECIMALS 10 INDEX pk IS PRIMARY UNIQUE serie-docto nro-docto cod-emitente nat-operacao.
DEFINE VARIABLE request AS JsonObject NO-UNDO. DEFINE VARIABLE response AS JsonObject NO-UNDO. DEFINE VARIABLE row AS JsonObject NO-UNDO. DEFINE VARIABLE rows AS JsonArray NO-UNDO. DEFINE VARIABLE names AS CHARACTER EXTENT NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO. DEFINE VARIABLE n AS INTEGER NO-UNDO. DEFINE VARIABLE keyValue AS CHARACTER NO-UNDO. DEFINE VARIABLE otherKey AS CHARACTER NO-UNDO.
DEFINE VARIABLE companyHandle AS HANDLE NO-UNDO.
DEFINE VARIABLE filterValue AS JsonObject NO-UNDO. DEFINE VARIABLE sorting AS JsonArray NO-UNDO.
DEFINE VARIABLE sortItem AS JsonObject NO-UNDO. DEFINE VARIABLE totalSeen AS INTEGER NO-UNDO.
DEFINE VARIABLE canonicalRow AS LONGCHAR NO-UNDO. DEFINE VARIABLE pageRow AS LONGCHAR NO-UNDO.
DEFINE TEMP-TABLE ttKeys NO-UNDO FIELD keyValue AS CHARACTER CASE-SENSITIVE INDEX pk IS PRIMARY UNIQUE keyValue.
IF NUM-DBS<>0 THEN UNDO, THROW NEW Progress.Lang.AppError("TT fixture requires NUMDBS0",1).
CREATE ttMaster. ASSIGN ttMaster.nr-container=71 ttMaster.cod-estabel="501" ttMaster.cod-emit-forn=51. RELEASE ttMaster.
DO n=1 TO 401: RUN Doc(STRING(n,"999999"),"A",51,"3101","501",3). END.
RUN NewRequest("read",71,""). RUN Invoke.
RUN Check(response:GetLogical("success"),"401 candidates must page successfully instead of candidate cap: " + response:GetJsonText()).
RUN Check(response:GetInteger("total")=401 AND response:GetJsonArray("data"):Length=50,"default page50 total401").
RUN NewRequest("read",71,""). request:Add("skip",200). request:Add("take",200). RUN Invoke.
RUN Check(response:GetLogical("success") AND response:GetInteger("total")=401 AND response:GetJsonArray("data"):Length=200,"second page200 total401").
RUN Check(response:GetJsonArray("data"):GetJsonObject(1):GetCharacter("documento")="000201","page2 follows default document order").
RUN NewRequest("read",71,""). request:Add("skip",400). request:Add("take",200). RUN Invoke.
RUN Check(response:GetLogical("success") AND response:GetInteger("total")=401 AND response:GetJsonArray("data"):Length=1,"last page has one of401").
keyValue=response:GetJsonArray("data"):GetJsonObject(1):GetCharacter("nf_key").
RUN NewRequest("get",71,keyValue). request:Add("nf_key",keyValue). RUN Invoke.
RUN Check(response:GetLogical("success") AND response:GetJsonObject("data"):GetCharacter("documento")="000401","GET after200 candidates").
RUN NewRequest("read",71,""). request:Add("skip",600). request:Add("take",200). RUN Invoke.
RUN Check(response:GetLogical("success") AND response:GetInteger("total")=401 AND response:GetJsonArray("data"):Length=0,"beyond total empty page retains total").
/* Complete traversal, including candidates beyond the old full-set cap. */
DO n=402 TO 1001: RUN Doc(STRING(n,"999999"),"A",51,"3101","501",3). END.
DO n=0 TO 1000 BY 200:
 RUN NewRequest("read",71,""). request:Add("skip",n). request:Add("take",200). RUN Invoke.
 RUN Check(response:GetLogical("success") AND response:GetInteger("total")=1001,"all six pages report the complete total").
 rows=response:GetJsonArray("data").
 DO totalSeen=1 TO rows:Length:
  keyValue=rows:GetJsonObject(totalSeen):GetCharacter("nf_key").
  RUN Check(NOT CAN-FIND(ttKeys WHERE ttKeys.keyValue=keyValue),"no key repeated across stable pages").
  CREATE ttKeys. ttKeys.keyValue=keyValue. RELEASE ttKeys.
 END.
END.
totalSeen=0. FOR EACH ttKeys: totalSeen=totalSeen + 1. END.
RUN Check(totalSeen=1001,"all1001 identities returned without truncation").
RUN NewRequest("read",71,""). request:Add("take",30). request:Add("skip",0). RUN Invoke. response:WriteFile("nf-page-native-first.json",TRUE).
RUN NewRequest("read",71,""). request:Add("take",30). request:Add("skip",30). RUN Invoke. response:WriteFile("nf-page-native-second.json",TRUE).
RUN NewRequest("read",71,""). request:Add("take",200).
filterValue=NEW JsonObject(). filterValue:Add("field","documento"). filterValue:Add("operator","startswith"). filterValue:Add("value","0009"). request:Add("filter",filterValue).
RUN Invoke. RUN Check(response:GetLogical("success") AND response:GetInteger("total")=100 AND response:GetJsonArray("data"):Length=100,"shared filter precedes total and paging").
request:Set("take",30). RUN Invoke. response:WriteFile("nf-page-native-filtered.json",TRUE).
RUN NewRequest("read",71,""). request:Add("take",1).
sorting=NEW JsonArray(). sortItem=NEW JsonObject(). sortItem:Add("field","documento"). sortItem:Add("dir","desc"). sorting:Add(sortItem). request:Add("sort",sorting).
RUN Invoke. RUN Check(response:GetLogical("success") AND response:GetInteger("total")=1001 AND response:GetJsonArray("data"):GetJsonObject(1):GetCharacter("documento")="001001","shared descending order includes the last source document").
request:Set("take",30). RUN Invoke. response:WriteFile("nf-page-native-desc.json",TRUE).
RUN NewRequest("read",71,""). request:Add("take",201). RUN Invoke. RUN ErrorCode("CIW_ERP_VALUE_INVALID",422). RUN Check(NOT response:Has("data"),"oversized page refuses without partial data").
RUN NewRequest("read",71,""). request:Add("skip",-1). RUN Invoke. RUN ErrorCode("CIW_ERP_VALUE_INVALID",422).
RUN NewRequest("read",71,""). request:Add("take",1000). RUN Invoke. RUN ErrorCode("CIW_ERP_VALUE_INVALID",422).
RUN NewRequest("read",71,""). filterValue=NEW JsonObject(). filterValue:Add("field","nf_original_json"). filterValue:Add("operator","contains"). filterValue:Add("value","secret"). request:Add("filter",filterValue).
RUN Invoke. RUN ErrorCode("CIW_ERP_FIELD_INVALID",422).
RUN NewRequest("read",71,""). filterValue=NEW JsonObject(). filterValue:Add("field","DOCUMENTO"). filterValue:Add("operator","eq"). filterValue:Add("value","x"). request:Add("filter",filterValue).
RUN Invoke. RUN Check(response:Has("error"),"strict NF query alias rejects uppercase physical name"). RUN ErrorCode("CIW_ERP_FIELD_INVALID",422).
RUN NewRequest("read",71,""). filterValue=NEW JsonObject(). filterValue:Add("field","documento "). filterValue:Add("operator","eq"). filterValue:Add("value","x"). request:Add("filter",filterValue).
RUN Invoke. RUN Check(response:Has("error"),"strict NF query alias rejects trailing whitespace"). RUN ErrorCode("CIW_ERP_FIELD_INVALID",422).
/* Raw mapper output is retained, including NULL/date/10 decimal places/spacing. */
EMPTY TEMP-TABLE ttDoc.
RUN Doc("  ACAO-Á'~~  ","  A  ",51,"3101","501",3).
FIND FIRST ttDoc. ASSIGN ttDoc.dt-emissao=DATE(12,31,2026) ttDoc.dt-trans=? ttDoc.valor-seguro=? ttDoc.tot-valor=12345.1234567891. RELEASE ttDoc.
RUN NewRequest("read",71,""). RUN Invoke. RUN Check(response:GetLogical("success") AND response:GetInteger("total")=1,"projection preserves source Unicode without exclusions").
row=response:GetJsonArray("data"):GetJsonObject(1). keyValue=row:GetCharacter("nf_key"). row:Write(pageRow,FALSE).
RUN NewRequest("read",71,""). filterValue=NEW JsonObject(). filterValue:Add("field","documento"). filterValue:Add("operator","eq"). filterValue:Add("value",row:GetCharacter("documento")). request:Add("filter",filterValue).
RUN Invoke. RUN Check(response:GetLogical("success") AND response:GetInteger("total")=1,"common literal parser preserves quote tilde and leading spaces exactly: " + response:GetJsonText()).
RUN NewRequest("get",71,keyValue). request:Add("nf_key",keyValue). RUN Invoke. RUN Check(response:GetLogical("success"),"GET matches projected opaque identity").
response:GetJsonObject("data"):Write(canonicalRow,FALSE).
RUN Check(COMPARE(STRING(pageRow),"=",STRING(canonicalRow),"RAW"),"paged row is byte-identical to original NfRow GET mapper").
RUN Check(response:GetJsonObject("data"):GetDecimal("tot_valor")=12345.1234567891 AND response:GetJsonObject("data"):IsNull("dt_trans") AND response:GetJsonObject("data"):IsNull("valor_seguro"),"typed projection preserves exact decimal and NULL").
RUN NewRequest("get",71,keyValue). request:Add("nf_key",keyValue + " "). RUN Invoke. RUN ErrorCode("CONTAINER_VALIDATION",422).
RUN NewRequest("get",71,LC(keyValue)). RUN Invoke. RUN ErrorCode("CONTAINER_VALIDATION",422).
EMPTY TEMP-TABLE ttDoc.
RUN Doc("TIE","A",51,"3102","501",3). RUN Doc("TIE","A",51,"3101","501",3).
RUN NewRequest("read",71,""). request:Add("take",1). request:Add("skip",0). RUN Invoke.
RUN Check(response:GetInteger("total")=2 AND response:GetJsonArray("data"):GetJsonObject(1):GetCharacter("nat_operacao")="3101","default order includes nature before opaque tie").
RUN NewRequest("read",71,""). request:Add("take",1). request:Add("skip",1). RUN Invoke.
RUN Check(response:GetInteger("total")=2 AND response:GetJsonArray("data"):GetJsonObject(1):GetCharacter("nat_operacao")="3102","default order page2 preserves nature order").
RUN NewRequest("read",71,""). request:Add("take",2). sorting=NEW JsonArray(). sortItem=NEW JsonObject(). sortItem:Add("field","documento"). sortItem:Add("dir","asc"). sorting:Add(sortItem). request:Add("sort",sorting). RUN Invoke.
RUN Check(response:GetInteger("total")=2 AND response:GetJsonArray("data"):Length=2,"equal user sort preserves both identities").
keyValue=response:GetJsonArray("data"):GetJsonObject(1):GetCharacter("nf_key"). otherKey=response:GetJsonArray("data"):GetJsonObject(2):GetCharacter("nf_key").
RUN Check(keyValue<otherKey,"opaque key is the deterministic final tie breaker").
/* Full source bound stays global and fails after the requested page is full. */
EMPTY TEMP-TABLE ttDoc. EMPTY TEMP-TABLE ttLink.
DO n=1 TO 50000: CREATE ttLink. ASSIGN ttLink.documento=STRING(n,"999999") ttLink.container_id=71. END. RELEASE ttLink.
RUN NewRequest("read",71,""). request:Add("skip",200). request:Add("take",200). RUN Invoke.
RUN Check(response:GetLogical("success") AND response:GetInteger("total")=0 AND response:GetJsonArray("data"):Length=0,"source50000 inclusive completes empty page and total").
CREATE ttLink. ASSIGN ttLink.documento="050001" ttLink.container_id=71. RELEASE ttLink.
RUN NewRequest("read",71,""). request:Add("skip",200). request:Add("take",200). RUN Invoke. RUN ErrorCode("CONTAINER_NF_SOURCE_LIMIT",503).
RUN Check(NOT response:Has("data") AND NOT response:Has("total"),"source50001 never exposes page or total").
OUTPUT TO VALUE("nf-page-" + SESSION:NUMERIC-FORMAT + ".log"). PUT UNFORMATTED "PASS " checks " checks NUMDBS=" NUM-DBS SKIP. OUTPUT CLOSE.
PROCEDURE Doc:
 DEFINE INPUT PARAMETER docValue AS CHARACTER NO-UNDO. DEFINE INPUT PARAMETER seriesValue AS CHARACTER NO-UNDO. DEFINE INPUT PARAMETER supplierValue AS INTEGER NO-UNDO. DEFINE INPUT PARAMETER natureValue AS CHARACTER NO-UNDO. DEFINE INPUT PARAMETER estabValue AS CHARACTER NO-UNDO. DEFINE INPUT PARAMETER statusValue AS INTEGER NO-UNDO.
 CREATE ttDoc. ASSIGN ttDoc.nro-docto=docValue ttDoc.serie-docto=seriesValue ttDoc.cod-emitente=supplierValue ttDoc.nat-operacao=natureValue ttDoc.cod-estabel=estabValue ttDoc.idi-sit-nf-eletro=statusValue.
END PROCEDURE.
PROCEDURE NewRequest:
 DEFINE INPUT PARAMETER operationValue AS CHARACTER NO-UNDO. DEFINE INPUT PARAMETER cid AS INTEGER NO-UNDO. DEFINE INPUT PARAMETER idValue AS CHARACTER NO-UNDO.
 request=NEW JsonObject(). request:Add("resource","nfs-disponiveis"). request:Add("operation",operationValue). request:Add("container_id",cid). IF idValue<>"" THEN request:Add("id",idValue).
END PROCEDURE.
PROCEDURE Invoke:
 companyHandle=IF request:GetCharacter("resource")="nfs" THEN BUFFER ttCompany:HANDLE ELSE ?.
 RUN VALUE("sursum-api/programs/ContainersPainelFinanceReadService.r") (INPUT BUFFER ttMaster:HANDLE,companyHandle,?,?,?,?,?,?,INPUT BUFFER ttLink:HANDLE,INPUT BUFFER ttDoc:HANDLE,?,request,OUTPUT response).
END PROCEDURE.
PROCEDURE Check:
 DEFINE INPUT PARAMETER ok AS LOGICAL NO-UNDO. DEFINE INPUT PARAMETER labelValue AS CHARACTER NO-UNDO.
 IF ok<>TRUE OR ok=? THEN UNDO,THROW NEW Progress.Lang.AppError(labelValue,1). checks=checks + 1.
END PROCEDURE.
PROCEDURE ErrorCode:
 DEFINE INPUT PARAMETER codeValue AS CHARACTER NO-UNDO. DEFINE INPUT PARAMETER statusValue AS INTEGER NO-UNDO.
 RUN Check(response:Has("error") AND response:GetJsonObject("error"):GetCharacter("code")=codeValue AND response:GetJsonObject("error"):GetInteger("status")=statusValue,codeValue + " at check " + STRING(checks) + " actual=" + response:GetJsonText()).
END PROCEDURE.
