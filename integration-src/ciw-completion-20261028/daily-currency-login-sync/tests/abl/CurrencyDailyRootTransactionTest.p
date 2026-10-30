BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE TEMP-TABLE ttHist FIELD hist_cotacao_bc_id AS INTEGER FIELD data AS DATE FIELD serie AS INTEGER
 FIELD valor AS DECIMAL DECIMALS 5 FIELD dt_hr_busca AS DATETIME FIELD nome_serie AS CHARACTER
 FIELD log_ok AS LOGICAL FIELD log_manual AS LOGICAL INDEX pk IS PRIMARY hist_cotacao_bc_id.
DEFINE TEMP-TABLE ttContainer FIELD nr-container AS INTEGER FIELD situacao AS INTEGER
 FIELD ordem_busca_dolar_compra AS CHARACTER FIELD log_versao_custo_desatualizada AS LOGICAL
 FIELD dt_hr_ult_alt_versao_custo AS DATETIME INDEX pk IS PRIMARY nr-container.
{CurrencyErpTestTables.i}
DEFINE VARIABLE erpResponse AS JsonObject NO-UNDO.
DEFINE VARIABLE k AS INTEGER NO-UNDO.
DEFINE VARIABLE periodValue AS CHARACTER NO-UNDO.
DEFINE VARIABLE request AS JsonObject NO-UNDO.
DEFINE VARIABLE response AS JsonObject NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE nextId AS INTEGER NO-UNDO INITIAL 100.
DEFINE VARIABLE lastId AS INTEGER NO-UNDO.
OUTPUT TO 'currency-root-tests.log'.
DO ON ERROR UNDO, THROW:
 RUN Check(NUM-DBS=0,'root TT zero databases').
 periodValue=STRING(YEAR(TODAY),'9999') + STRING(MONTH(TODAY),'99').
 CREATE ttEms2. ASSIGN ttEms2.mo-codigo=3 ttEms2.ano-periodo=periodValue.
 DO k=1 TO 31: ttEms2.cotacao[k]=1. END. RELEASE ttEms2.
 RUN NewRequest.
 rootRollback: DO TRANSACTION ON ERROR UNDO, THROW:
  RUN Participant(FALSE).
  RUN Check(response:GetLogical('success'),'history first in same root').
  lastId=response:GetJsonObject('audit'):GetInteger('recordId').
  RUN ErpParticipant.
  RUN Check(erpResponse:GetLogical('success'),'both actual ERP participants in root').
  RUN Check(CAN-FIND(FIRST ttHist WHERE ttHist.hist_cotacao_bc_id=lastId),'history visible inside root').
  RUN Check(CAN-FIND(FIRST ttEms5),'EMS5 visible inside root').
  FIND FIRST ttEms2 NO-LOCK. RUN Check(ttEms2.cotacao[31]=5.12345,'EMS2 updated inside root'). RELEASE ttEms2.
  UNDO rootRollback,LEAVE rootRollback.
 END.
 RUN Check(NOT CAN-FIND(FIRST ttHist),'outer rollback removes history').
 RUN Check(NOT CAN-FIND(FIRST ttEms5),'outer rollback removes EMS5').
 FIND FIRST ttEms2 NO-LOCK. RUN Check(ttEms2.cotacao[31]=1,'outer rollback restores EMS2'). RELEASE ttEms2.
 RUN Check(nextId=101,'synthetic consumed ID not falsely rolled back').
 FIND FIRST ttEms2. DELETE ttEms2.
 failedRoot: DO TRANSACTION ON ERROR UNDO, THROW:
  RUN Participant(FALSE). RUN Check(response:GetLogical('success'),'history created before simulated ERP gate').
  RUN ErpParticipant.
  RUN Check(NOT erpResponse:GetLogical('success'),'missing EMS2 rejects ERP').
  UNDO failedRoot,LEAVE failedRoot.
 END.
 RUN Check(NOT CAN-FIND(FIRST ttHist),'caller must undo root on participant failure').
 RUN Check(NOT CAN-FIND(FIRST ttEms5),'failure no EMS5 residue').
 RUN Check(NUM-DBS=0,'zero databases after root TT').
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

PROCEDURE ErpParticipant:
 RUN VALUE('CiwDailyCurrencyErpParticipant.p')(INPUT BUFFER ttEms2:HANDLE,INPUT BUFFER ttEms5:HANDLE,
  INPUT TODAY,INPUT 5.12345,INPUT NOW,OUTPUT erpResponse).
END PROCEDURE.
