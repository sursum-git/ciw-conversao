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
IF NUM-DBS<>0 THEN UNDO, THROW NEW Progress.Lang.AppError("TT fixture requires NUMDBS0",1).
RUN NewRequest("read",71,""). RUN Invoke. RUN Check(response:Has("error") AND response:GetJsonObject("error"):GetCharacter("code")="CONTAINER_NOT_FOUND","available NF resource exists").
CREATE ttMaster. ASSIGN ttMaster.nr-container=71 ttMaster.cod-estabel="501" ttMaster.cod-emit-forn=51.
CREATE ttMaster. ASSIGN ttMaster.nr-container=72 ttMaster.cod-estabel="501" ttMaster.cod-emit-forn=51.
CREATE ttMaster. ASSIGN ttMaster.nr-container=73 ttMaster.cod-estabel="101" ttMaster.cod-emit-forn=51.
RUN Doc("000001","A",51,"3101","501",3).
FIND ttDoc WHERE ttDoc.nro-docto="000001" AND ttDoc.serie-docto="A".
ASSIGN ttDoc.tot-valor=123.456789 ttDoc.valor-seguro=? ttDoc.dt-emissao=DATE(10,28,2026) ttDoc.dt-trans=? ttDoc.valor-outras=0.
RUN Doc("000001","B",51,"3102","501",3).
RUN Doc("OUTRO~'~~","  ",51,"3101","501",3).
RUN Doc("WRONG-SUPPLIER","A",52,"3101","501",3).
RUN Doc("WRONG-ESTAB","A",51,"3101","502",3).
RUN Doc("WRONG-NATURE","A",51,"1101","501",3).
RUN Doc("WRONG-STATUS","A",51,"3101","501",2).
RUN Doc("NULL-STATUS","A",51,"3101","501",?).
RUN NewRequest("read",71,""). RUN Invoke. RUN Check(response:GetLogical("success"),"new resource needs no payment/company buffers"). rows=response:GetJsonArray("data"). RUN Check(rows:Length=3,"supplier establishment nature and status filters").
row=rows:GetJsonObject(1). keyValue=row:GetCharacter("nf_key"). names=row:GetNames(). RUN Check(EXTENT(names)=18,"same closed NF18 projection").
RUN Check(row:GetCharacter("documento")="000001" AND row:GetCharacter("serie")="A" AND row:GetLogical("documento_localizado"),"shared located NF mapper").
RUN Check(row:GetDecimal("tot_valor")=123.456789 AND row:IsNull("valor_seguro") AND row:IsNull("dt_trans"),"decimal and NULL preserved").
RUN Check(LENGTH(keyValue)=67 AND keyValue BEGINS "nf_","same opaque NF key").
row=rows:GetJsonObject(2). otherKey=row:GetCharacter("nf_key"). RUN Check(keyValue<>otherKey,"series distinguish opaque identities").
response:WriteFile("nf-available-actual.json",TRUE).
RUN NewRequest("get",71,keyValue). request:Add("nf_key",keyValue). RUN Invoke. RUN Check(response:GetLogical("success") AND response:GetJsonObject("data"):GetCharacter("nf_key")=keyValue,"get matching aliases").
RUN NewRequest("get",72,keyValue). RUN Invoke. RUN ErrorCode("CONTAINER_CHILD_NOT_FOUND",404).
CREATE ttCompany. ASSIGN ttCompany.empresa_id=1 ttCompany.cod_emp_ems2=5 ttCompany.cod_emp_ems5=9.
CREATE ttLink. ASSIGN ttLink.documento="000001" ttLink.serie="A" ttLink.estab="501" ttLink.nat_operacao="3101" ttLink.cod_emitente=51 ttLink.container_id=71. RELEASE ttLink.
RUN NewRequest("get",71,keyValue). request:Set("resource","nfs"). RUN Invoke. RUN Check(response:GetLogical("success") AND response:GetJsonObject("data"):GetCharacter("nf_key")=keyValue,"linked and available NF use the same opaque key and mapper").
EMPTY TEMP-TABLE ttLink.
/* The legacy exclusion is DOCUMENT ONLY, even when all other link values differ. */
CREATE ttLink. ASSIGN ttLink.documento="000001" ttLink.serie="DIFFERENT" ttLink.estab="999" ttLink.nat_operacao="9999" ttLink.cod_emitente=999 ttLink.container_id=71.
RUN NewRequest("read",71,""). RUN Invoke. rows=response:GetJsonArray("data"). RUN Check(rows:Length=1 AND rows:GetJsonObject(1):GetCharacter("documento")="OUTRO~'~~","document-only excludes both series and ignores other link fields").
RUN NewRequest("get",71,keyValue). RUN Invoke. RUN ErrorCode("CONTAINER_CHILD_NOT_FOUND",404).
RUN NewRequest("get",71,otherKey). RUN Invoke. RUN ErrorCode("CONTAINER_CHILD_NOT_FOUND",404).
FIND ttLink WHERE ttLink.container_id=71. ttLink.container_id=72.
RUN NewRequest("read",71,""). RUN Invoke. RUN Check(response:GetJsonArray("data"):Length=3,"other container link does not exclude").
RUN NewRequest("read",73,""). RUN Invoke. RUN ErrorCode("CONTAINER_NF_MED_REQUIRED",422).
FIND ttMaster WHERE ttMaster.nr-container=71. ttMaster.cod-estabel=?. RUN NewRequest("read",71,""). RUN Invoke. RUN ErrorCode("CONTAINER_NF_MED_REQUIRED",422). ttMaster.cod-estabel="501".
ttMaster.cod-emit-forn=?. RUN NewRequest("read",71,""). RUN Invoke. RUN ErrorCode("CONTAINER_NF_SUPPLIER_REQUIRED",422). ttMaster.cod-emit-forn=51.
RUN NewRequest("read",71,""). request:Remove("container_id"). RUN Invoke. RUN ErrorCode("CONTAINER_VALIDATION",422).
RUN NewRequest("read",71,""). request:Add("id",keyValue). RUN Invoke. RUN ErrorCode("CONTAINER_VALIDATION",422).
RUN NewRequest("get",71,keyValue). request:Add("nf_key",otherKey). RUN Invoke. RUN ErrorCode("CONTAINER_VALIDATION",422).
RUN NewRequest("get",71,keyValue). request:Add("NF_KEY",keyValue). RUN Invoke. RUN ErrorCode("CONTAINER_VALIDATION",422).
RUN NewRequest("get",71,LC(keyValue)). RUN Invoke. RUN ErrorCode("CONTAINER_VALIDATION",422).
RUN NewRequest("read",71,""). request:Add("cod_emitente",999). RUN Invoke. RUN ErrorCode("CONTAINER_VALIDATION",422).
RUN NewRequest("read",71,""). request:Add("database","ems2ima"). RUN Invoke. RUN ErrorCode("CONTAINER_VALIDATION",422).
RUN NewRequest("delete",71,""). RUN Invoke. RUN ErrorCode("CONTAINER_OPERATION_INVALID",422).
/* PHP interpolates a nullable associated document as an empty string, without TRIM. */
EMPTY TEMP-TABLE ttLink. EMPTY TEMP-TABLE ttDoc.
CREATE ttLink. ASSIGN ttLink.documento=? ttLink.container_id=71. RELEASE ttLink.
RUN Doc("","A",51,"3101","501",3). RUN Doc("SAFE","A",51,"3101","501",3).
RUN NewRequest("read",71,""). RUN Invoke. rows=response:GetJsonArray("data"). RUN Check(rows:Length=1 AND rows:GetJsonObject(1):GetCharacter("documento")="SAFE","nullable link interpolates empty and excludes empty document " + response:GetJsonText()).
/* No SQL collation equivalence is claimed: bytes differing under ABL matching refuse. */
EMPTY TEMP-TABLE ttLink. EMPTY TEMP-TABLE ttDoc.
CREATE ttLink. ASSIGN ttLink.documento="Case" ttLink.container_id=71. RELEASE ttLink.
RUN Doc("case","A",51,"3101","501",3).
RUN NewRequest("read",71,""). RUN Invoke. RUN ErrorCode("CONTAINER_NF_COLLATION_UNPROVEN",422).
FIND ttDoc WHERE ttDoc.nro-docto="case". ttDoc.nro-docto="Case". RELEASE ttDoc.
RUN NewRequest("read",71,""). RUN Invoke. RUN Check(response:GetLogical("success") AND response:GetJsonArray("data"):Length=0,"identical bytes exclude without collation assumptions").
EMPTY TEMP-TABLE ttLink. EMPTY TEMP-TABLE ttDoc.
CREATE ttLink. ASSIGN ttLink.documento="DOC " ttLink.container_id=71. RELEASE ttLink.
RUN Doc("DOC","A",51,"3101","501",3).
RUN NewRequest("read",71,""). RUN Invoke. RUN ErrorCode("CONTAINER_NF_COLLATION_UNPROVEN",422).
EMPTY TEMP-TABLE ttLink. EMPTY TEMP-TABLE ttDoc.
CREATE ttLink. ASSIGN ttLink.documento="ACAO-Á" ttLink.container_id=71. RELEASE ttLink.
RUN Doc("SAFE","A",51,"3101","501",3).
RUN NewRequest("read",71,""). RUN Invoke. RUN ErrorCode("CONTAINER_NF_COLLATION_UNPROVEN",422).
EMPTY TEMP-TABLE ttLink. EMPTY TEMP-TABLE ttDoc.
RUN Doc(?,"A",51,"3101","501",3).
RUN NewRequest("read",71,""). RUN Invoke. RUN Check(response:GetLogical("success") AND response:GetJsonArray("data"):GetJsonObject(1):IsNull("documento"),"NULL candidate preserved without document inequality").
CREATE ttLink. ASSIGN ttLink.documento="OTHER" ttLink.container_id=71. RELEASE ttLink.
RUN NewRequest("read",71,""). RUN Invoke. RUN Check(response:GetLogical("success") AND response:GetJsonArray("data"):Length=0,"SQL unknown candidate inequality does not pass WHERE").
EMPTY TEMP-TABLE ttLink. EMPTY TEMP-TABLE ttDoc.
DO n=1 TO 200: RUN Doc(STRING(n,"999999"),"A",51,"3101","501",3). END.
RUN NewRequest("read",71,""). RUN Invoke. RUN Check(response:GetLogical("success") AND response:GetJsonArray("data"):Length=200,"200 rows boundary inclusive").
RUN Doc("000201","A",51,"3101","501",3).
RUN NewRequest("read",71,""). RUN Invoke. RUN ErrorCode("CONTAINER_NF_QUERY_LIMIT",503). RUN Check(NOT response:Has("data"),"row cap never returns partial data").
EMPTY TEMP-TABLE ttDoc.
DO n=1 TO 50000: CREATE ttLink. ASSIGN ttLink.documento=STRING(n,"999999") ttLink.container_id=71. END.
RUN NewRequest("read",71,""). RUN Invoke. RUN Check(response:GetLogical("success") AND response:GetJsonArray("data"):Length=0,"50000 source rows inclusive boundary").
CREATE ttLink. ASSIGN ttLink.documento="050001" ttLink.container_id=71. RELEASE ttLink.
RUN NewRequest("read",71,""). RUN Invoke. RUN ErrorCode("CONTAINER_NF_QUERY_LIMIT",503). RUN Check(NOT response:Has("data"),"physical scan cap never returns partial data").
OUTPUT TO VALUE("nf-available-" + SESSION:NUMERIC-FORMAT + ".log"). PUT UNFORMATTED "PASS " checks " checks NUMDBS=" NUM-DBS SKIP. OUTPUT CLOSE.
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
