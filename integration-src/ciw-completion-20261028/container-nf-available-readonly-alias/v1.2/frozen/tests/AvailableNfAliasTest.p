/* Direct fixed-service invocation over isolated TT buffers; no PHP boundary masks aliases. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
{AvailableNfFixture.i}
DEFINE VARIABLE request AS JsonObject NO-UNDO. DEFINE VARIABLE response AS JsonObject NO-UNDO.
DEFINE VARIABLE keyValue AS CHARACTER NO-UNDO. DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE serviceName AS CHARACTER NO-UNDO.
IF NUM-DBS<>0 THEN UNDO, THROW NEW Progress.Lang.AppError('Connected DB forbidden',1).
serviceName='sursum-api/programs/ContainersPainelFinanceReadService.r'.
CREATE ttMaster. ASSIGN ttMaster.nr-container=71 ttMaster.cod-estabel='501' ttMaster.cod-emit-forn=51.
CREATE ttDoc. ASSIGN ttDoc.nro-docto='ALIAS-ONLY' ttDoc.serie-docto='A' ttDoc.cod-emitente=51 ttDoc.nat-operacao='3101' ttDoc.cod-estabel='501' ttDoc.idi-sit-nf-eletro=3.
RUN NewRequest('read',''). RUN Invoke.
RUN Check(response:GetLogical('success') AND response:GetJsonArray('data'):Length=1,'seed read succeeds').
keyValue=response:GetJsonArray('data'):GetJsonObject(1):GetCharacter('nf_key').
RUN NewRequest('get',keyValue). request:Add('nf_key',keyValue). RUN Invoke. RUN Check(response:GetLogical('success'),'identical alias bytes succeed').
RUN NewRequest('get',keyValue). request:Add('nf_key',keyValue + ' '). RUN Invoke. RUN Expected('CONTAINER_VALIDATION','trailing alias must fail').
RUN NewRequest('get',keyValue). request:Add('nf_key',keyValue + '  '). RUN Invoke. RUN Expected('CONTAINER_VALIDATION','double trailing alias must fail').
RUN NewRequest('get',keyValue). request:Add('nf_key',keyValue + CHR(9)). RUN Invoke. RUN Expected('CONTAINER_VALIDATION','tab alias must fail').
RUN NewRequest('get',keyValue). request:Add('nf_key',' ' + keyValue). RUN Invoke. RUN Expected('CONTAINER_VALIDATION','leading alias must fail').
RUN NewRequest('get',keyValue). request:Add('nf_key','nf_' + LC(SUBSTRING(keyValue,4))). RUN Invoke. RUN Expected('CONTAINER_VALIDATION','alias hex case must fail').
RUN NewRequest('get',keyValue). request:Add('nf_key','NF_' + SUBSTRING(keyValue,4)). RUN Invoke. RUN Expected('CONTAINER_VALIDATION','alias prefix case must fail').
RUN NewRequest('get','nf_' + LC(SUBSTRING(keyValue,4))). RUN Invoke. RUN Expected('CONTAINER_VALIDATION','id hex lower already invalid').
RUN NewRequest('get','NF_' + SUBSTRING(keyValue,4)). RUN Invoke. RUN Expected('CONTAINER_VALIDATION','id prefix upper invalid').
RUN NewRequest('get',keyValue + ' '). RUN Invoke. RUN Expected('CONTAINER_VALIDATION','id trailing invalid').
RUN NewRequest('get',keyValue). request:AddNull('nf_key'). RUN Invoke. RUN Expected('CONTAINER_VALIDATION','alias null invalid').
RUN NewRequest('get',keyValue). request:Add('nf_key',1). RUN Invoke. RUN Expected('CONTAINER_VALIDATION','alias number invalid').
RUN NewRequest('get',keyValue). request:Add('nf_key',''). RUN Invoke. RUN Expected('CONTAINER_VALIDATION','alias empty invalid').
RUN NewRequest('get',keyValue). request:Add('nf_key',FILL('A',4096)). RUN Invoke. RUN Expected('CONTAINER_VALIDATION','long alias rejected before fixed allocation').
RUN NewRequest('get',keyValue). request:Add('nf_key','nf_' + FILL(CHR(193),64)). RUN Invoke. RUN Expected('CONTAINER_VALIDATION','non ASCII alias rejected before allocation').
RUN NewRequest('get',keyValue). RUN Invoke. RUN Check(response:GetLogical('success'),'canonical id without optional alias succeeds').
RUN NewRequest('get',keyValue). request:Add('nf_key',keyValue). RUN Invoke. RUN Check(response:GetLogical('success') AND response:GetJsonObject('data'):GetCharacter('nf_key')=keyValue,'identical alias still maps same row').
OUTPUT TO VALUE('alias-strict-' + SESSION:NUMERIC-FORMAT + '.log'). PUT UNFORMATTED 'PASS ' checks ' checks NUMDBS=' NUM-DBS SKIP. OUTPUT CLOSE.
PROCEDURE NewRequest:
 DEFINE INPUT PARAMETER op AS CHARACTER NO-UNDO. DEFINE INPUT PARAMETER idValue AS CHARACTER NO-UNDO.
 request=NEW JsonObject(). request:Add('resource','nfs-disponiveis'). request:Add('operation',op). request:Add('container_id',71). IF idValue<>'' THEN request:Add('id',idValue).
END PROCEDURE.
PROCEDURE Invoke:
 RUN VALUE(serviceName) (INPUT BUFFER ttMaster:HANDLE,?,?,?,?,?,?,?,INPUT BUFFER ttLink:HANDLE,INPUT BUFFER ttDoc:HANDLE,?,request,OUTPUT response).
END PROCEDURE.
PROCEDURE Check:
 DEFINE INPUT PARAMETER conditionValue AS LOGICAL NO-UNDO. DEFINE INPUT PARAMETER labelValue AS CHARACTER NO-UNDO.
 checks=checks + 1. IF conditionValue<>TRUE OR conditionValue=? THEN UNDO, THROW NEW Progress.Lang.AppError(labelValue,1).
END PROCEDURE.
PROCEDURE Expected:
 DEFINE INPUT PARAMETER codeValue AS CHARACTER NO-UNDO. DEFINE INPUT PARAMETER labelValue AS CHARACTER NO-UNDO.
 RUN Check(response:Has('error') AND response:GetJsonObject('error'):GetCharacter('code')=codeValue AND response:GetJsonObject('error'):GetInteger('status')=(IF codeValue='CONTAINER_VALIDATION' THEN 422 ELSE 503),labelValue).
END PROCEDURE.
