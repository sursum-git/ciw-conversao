BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE TEMP-TABLE ttMaster FIELD nr-container AS INTEGER FIELD cod-estabel AS CHARACTER INDEX pk IS PRIMARY UNIQUE nr-container.
DEFINE TEMP-TABLE ttAttachment FIELD anexo_container_id AS INTEGER FIELD container_id AS INTEGER FIELD item_container_id AS INTEGER FIELD descricao AS CHARACTER FIELD tipos_anexo_id AS INTEGER FIELD caminho_arquivo AS CHARACTER FIELD dt_hr_arquivo AS DATETIME INDEX pk IS PRIMARY UNIQUE anexo_container_id.
DEFINE TEMP-TABLE ttType FIELD tipo_anexo_id AS INTEGER FIELD descricao AS CHARACTER INDEX pk IS PRIMARY UNIQUE tipo_anexo_id.
DEFINE VARIABLE request AS JsonObject NO-UNDO. DEFINE VARIABLE response AS JsonObject NO-UNDO. DEFINE VARIABLE row AS JsonObject NO-UNDO. DEFINE VARIABLE checks AS INTEGER NO-UNDO. DEFINE VARIABLE names AS CHARACTER EXTENT NO-UNDO.
RUN NewRequest(71,5). RUN Invoke. RUN Check(response:Has("error") AND response:GetJsonObject("error"):GetCharacter("code")="CONTAINER_NOT_FOUND","reference resource exists").
CREATE ttMaster. ASSIGN nr-container=71 cod-estabel="501".
CREATE ttMaster. ASSIGN nr-container=72 cod-estabel="101".
CREATE ttAttachment. ASSIGN anexo_container_id=5 container_id=71 item_container_id=? ttAttachment.descricao="  Memoria Sao Jose  " tipos_anexo_id=2 caminho_arquivo="historico.exe" dt_hr_arquivo=DATETIME(10,28,2026,12,13,14).
CREATE ttAttachment. ASSIGN anexo_container_id=6 container_id=72 caminho_arquivo="other.pdf".
CREATE ttType. ASSIGN tipo_anexo_id=2 ttType.descricao="Pro-Forma".
RUN NewRequest(71,5). request:Add("anexo_container_id",5). RUN Invoke. RUN Check(response:GetLogical("success"),"matching aliases"). row=response:GetJsonObject("data"). names=row:GetNames(). RUN Check(EXTENT(names)=10,"closed reference row10").
RUN Check(row:GetCharacter("caminho_arquivo")="historico.exe" AND row:GetCharacter("cod_estabel")="501","raw historical reference and MED proof").
RUN Check(row:IsNull("item_container_id") AND row:GetCharacter("descricao")="  Memoria Sao Jose  ","NULL and raw spaces").
RUN Check(row:GetLogical("tem_arquivo") AND row:GetCharacter("tipo_anexo_descricao")="Pro-Forma","shared extras"). response:WriteFile("attachment-reference-actual.json",TRUE).
RUN NewRequest(71,6). RUN Invoke. RUN ErrorCode("CONTAINER_CHILD_NOT_FOUND",404).
RUN NewRequest(72,6). RUN Invoke. RUN ErrorCode("CONTAINER_ATTACHMENT_MED_REQUIRED",422).
RUN VALUE("sursum-api/programs/ContainersPainelReadService.r") (INPUT BUFFER ttMaster:HANDLE,?,?,INPUT BUFFER ttType:HANDLE,?,?,?,?,?,?,?,request,OUTPUT response).
RUN ErrorCode("CONTAINER_ATTACHMENT_MED_REQUIRED",422).
FIND ttMaster WHERE nr-container=71. cod-estabel=?. RUN NewRequest(71,5). RUN Invoke. RUN ErrorCode("CONTAINER_ATTACHMENT_MED_REQUIRED",422). cod-estabel="501".
RUN NewRequest(71,5). request:Add("anexo_container_id",6). RUN Invoke. RUN ErrorCode("CONTAINER_VALIDATION",422).
RUN NewRequest(71,5). request:Set("id","5"). RUN Invoke. RUN ErrorCode("CONTAINER_VALIDATION",422).
RUN NewRequest(71,5). request:Set("container_id","71"). RUN Invoke. RUN ErrorCode("CONTAINER_VALIDATION",422).
RUN NewRequest(71,5). request:Add("caminho_arquivo","forged.pdf"). RUN Invoke. RUN ErrorCode("CONTAINER_VALIDATION",422).
RUN NewRequest(71,5). request:Add("actor","forged"). RUN Invoke. RUN ErrorCode("CONTAINER_VALIDATION",422).
RUN NewRequest(71,5). request:Set("operation","read"). RUN Invoke. RUN ErrorCode("CONTAINER_ATTACHMENT_READ_ONLY",405).
RUN NewRequest(71,5). request:Remove("container_id"). RUN Invoke. RUN ErrorCode("CONTAINER_VALIDATION",422).
RUN NewRequest(71,5). request:Set("id",0). RUN Invoke. RUN ErrorCode("CONTAINER_VALIDATION",422).
FIND ttAttachment WHERE anexo_container_id=5. caminho_arquivo=?. RUN NewRequest(71,5). RUN Invoke. row=response:GetJsonObject("data"). RUN Check(row:IsNull("caminho_arquivo") AND NOT row:GetLogical("tem_arquivo"),"NULL reference preserved").
caminho_arquivo="". RUN Invoke. row=response:GetJsonObject("data"). RUN Check(row:GetCharacter("caminho_arquivo")="" AND NOT row:GetLogical("tem_arquivo"),"empty reference preserved").
caminho_arquivo="   ". RUN Invoke. row=response:GetJsonObject("data"). RUN Check(row:GetCharacter("caminho_arquivo")="   " AND NOT row:GetLogical("tem_arquivo"),"space reference preserved").
OUTPUT TO VALUE("attachment-reference-" + SESSION:NUMERIC-FORMAT + ".log"). PUT UNFORMATTED "PASS " checks " checks NUMDBS=" NUM-DBS SKIP. OUTPUT CLOSE.
PROCEDURE NewRequest:
 DEFINE INPUT PARAMETER cid AS INTEGER NO-UNDO. DEFINE INPUT PARAMETER aid AS INTEGER NO-UNDO.
 request=NEW JsonObject(). request:Add("resource","anexos-arquivo"). request:Add("operation","get"). request:Add("container_id",cid). request:Add("id",aid).
END PROCEDURE.
PROCEDURE Invoke:
 RUN VALUE("sursum-api/programs/ContainersPainelReadService.r") (INPUT BUFFER ttMaster:HANDLE,?,INPUT BUFFER ttAttachment:HANDLE,INPUT BUFFER ttType:HANDLE,?,?,?,?,?,?,?,request,OUTPUT response).
END PROCEDURE.
PROCEDURE Check:
 DEFINE INPUT PARAMETER ok AS LOGICAL NO-UNDO. DEFINE INPUT PARAMETER labelValue AS CHARACTER NO-UNDO.
 IF ok<>TRUE OR ok=? THEN UNDO,THROW NEW Progress.Lang.AppError(labelValue,1). checks=checks + 1.
END PROCEDURE.
PROCEDURE ErrorCode:
 DEFINE INPUT PARAMETER codeValue AS CHARACTER NO-UNDO. DEFINE INPUT PARAMETER statusValue AS INTEGER NO-UNDO.
 RUN Check(response:Has("error") AND response:GetJsonObject("error"):GetCharacter("code")=codeValue AND response:GetJsonObject("error"):GetInteger("status")=statusValue,codeValue).
END PROCEDURE.
