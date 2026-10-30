BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE TEMP-TABLE ttHist FIELD hist_cotacao_bc_id AS INTEGER FIELD data AS DATE FIELD serie AS INTEGER
 FIELD valor AS DECIMAL DECIMALS 5 FIELD dt_hr_busca AS DATETIME FIELD nome_serie AS CHARACTER
 FIELD log_ok AS LOGICAL FIELD log_manual AS LOGICAL INDEX pk IS PRIMARY hist_cotacao_bc_id.
DEFINE TEMP-TABLE ttContainer FIELD nr-container AS INTEGER FIELD situacao AS INTEGER
 FIELD ordem_busca_dolar_compra AS CHARACTER FIELD log_versao_custo_desatualizada AS LOGICAL
 FIELD dt_hr_ult_alt_versao_custo AS DATETIME INDEX pk IS PRIMARY nr-container.
DEFINE TEMP-TABLE ttEms FIELD stage_id AS INTEGER FIELD amount_value AS DECIMAL DECIMALS 5.
DEFINE VARIABLE request AS JsonObject NO-UNDO.
DEFINE VARIABLE response AS JsonObject NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE nextId AS INTEGER NO-UNDO INITIAL 100.
DEFINE VARIABLE lastId AS INTEGER NO-UNDO.
OUTPUT TO 'currency-participant-tests.log'.
DO ON ERROR UNDO, THROW:
 RUN Check(NUM-DBS=0,'zero databases').
 RUN NewRequest.
 RUN Participant(FALSE).
 RUN Check(NOT response:GetLogical('success'),'private participant needs active root').
 RUN Check(response:GetJsonObject('error'):GetCharacter('code')='CIW_COTACAO_ROOT_TRANSACTION_REQUIRED','root policy retained').
 RUN Check(nextId=100,'no private ID consumed before root').
 rootRollback: DO TRANSACTION ON ERROR UNDO, THROW:
  RUN Participant(FALSE).
  RUN Check(response:GetLogical('success'),'coordinated import inside root').
  lastId=response:GetJsonObject('audit'):GetInteger('recordId').
  RUN Check(response:GetJsonObject('audit'):GetJsonObject('after'):GetCharacter('data')=ISO-DATE(TODAY),'daily uses run date').
  RUN Check(NOT response:GetJsonObject('audit'):GetJsonObject('after'):GetLogical('log_manual'),'daily automatic not manual').
  RUN Check(response:GetJsonObject('audit'):GetJsonObject('after'):GetLogical('log_ok'),'daily approved').
  RUN Check(response:GetJsonObject('audit'):GetJsonObject('after'):GetCharacter('nome_serie')='','daily empty source name preserved').
  response:GetJsonObject('audit'):WriteFile('history-actual.json',TRUE).
  CREATE ttEms. ASSIGN ttEms.stage_id=2 ttEms.amount_value=5.12345. RELEASE ttEms.
  CREATE ttEms. ASSIGN ttEms.stage_id=5 ttEms.amount_value=5.12345. RELEASE ttEms.
  UNDO rootRollback,LEAVE rootRollback.
 END.
 RUN Check(NOT CAN-FIND(FIRST ttHist WHERE ttHist.hist_cotacao_bc_id=lastId),'outer rollback removes history').
 RUN Check(NOT CAN-FIND(FIRST ttEms),'outer rollback removes both synthetic participants').
 RUN Check(nextId=101,'private synthetic ID is not claimed rollbackable').
 DO TRANSACTION:
  RUN Participant(TRUE).
  RUN Check(NOT response:GetLogical('success'),'old public root policy still rejects active root').
  RUN Check(nextId=101,'public rejection before ID').
 END.
 RUN NewRequest. request:Remove('nome_serie'). request:Add('nome_serie','BC canonical name').
 RUN Participant(TRUE).
 RUN Check(response:GetLogical('success'),'standalone import remains available').
 RUN Check(response:GetJsonObject('audit'):GetJsonObject('after'):GetCharacter('nome_serie')='BC canonical name','standalone name unchanged').
 RUN NewRequest. RUN Participant(TRUE).
 RUN Check(NOT response:GetLogical('success'),'standalone empty name still rejected').
 RUN Check(NUM-DBS=0,'zero databases after').
 PUT UNFORMATTED 'PASS ' checks ' checks' SKIP.
 CATCH err AS Progress.Lang.Error:
  PUT UNFORMATTED 'FAIL checks=' checks ' errorNumber=' err:GetMessageNum(1) SKIP.
 END CATCH.
END.
OUTPUT CLOSE. QUIT.
PROCEDURE NewRequest:
 request=NEW JsonObject(). request:Add('operation','import-bc'). request:Add('serie',1).
 request:Add('data',ISO-DATE(TODAY)). request:Add('valor',5.12345). request:Add('nome_serie','').
END PROCEDURE.
PROCEDURE Participant:
 DEFINE INPUT PARAMETER ownRoot AS LOGICAL NO-UNDO.
 RUN VALUE('CiwCotacaoHistoryParticipant.p')(INPUT BUFFER ttHist:HANDLE,INPUT BUFFER ttContainer:HANDLE,INPUT THIS-PROCEDURE,INPUT ownRoot,INPUT request,OUTPUT response).
END PROCEDURE.
PROCEDURE NextCotacaoId:
 DEFINE OUTPUT PARAMETER valueId AS INTEGER NO-UNDO.
 nextId=nextId + 1. valueId=nextId.
END PROCEDURE.
PROCEDURE Check:
 DEFINE INPUT PARAMETER valueOk AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER labelValue AS CHARACTER NO-UNDO.
 checks=checks + 1.
 IF valueOk<>TRUE OR valueOk=? THEN UNDO, THROW NEW Progress.Lang.AppError(labelValue,1).
END PROCEDURE.
