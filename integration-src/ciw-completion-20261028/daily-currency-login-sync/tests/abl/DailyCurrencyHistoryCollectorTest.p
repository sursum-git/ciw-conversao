BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE TEMP-TABLE ttHist FIELD hist_cotacao_bc_id AS INTEGER FIELD data AS DATE
 FIELD serie AS INTEGER FIELD valor AS DECIMAL DECIMALS 5
 FIELD log_ok AS LOGICAL FIELD log_manual AS LOGICAL
 INDEX pk IS PRIMARY hist_cotacao_bc_id.
DEFINE TEMP-TABLE ttWrong FIELD hist_cotacao_bc_id AS INTEGER FIELD data AS DATE
 FIELD serie AS INTEGER FIELD valor AS CHARACTER FIELD log_ok AS LOGICAL FIELD log_manual AS LOGICAL.
DEFINE VARIABLE result AS JsonObject NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE rowLimit AS INTEGER NO-UNDO INITIAL 50000.
DEFINE VARIABLE runDate AS DATE NO-UNDO INITIAL 10/28/2026.
OUTPUT TO 'daily-history-tests.log'.
DO ON ERROR UNDO, THROW:
 RUN Check(NUM-DBS=0,'zero databases').
 RUN Collect.
 RUN Check(result:GetLogical('success'),'empty success').
 RUN Check(result:GetLogical('completed'),'complete status').
 RUN Check(result:IsNull('history'),'empty has no invented row').
 RUN Check(NOT result:GetLogical('erp_ready'),'physical ERP remains gated').
 RUN AddRow(2,runDate,1,5.12345,FALSE,TRUE).
 RUN AddRow(99,runDate - 1,1,9,TRUE,FALSE).
 RUN AddRow(100,runDate,2,8,TRUE,FALSE).
 RUN AddRow(101,runDate,1,7,FALSE,FALSE).
 RUN Collect.
 RUN Check(result:GetJsonObject('history'):GetInteger('hist_cotacao_bc_id')=2,'today approved/manual only').
 RUN Check(result:GetJsonObject('history'):GetDecimal('valor')=5.12345,'precision unchanged').
 RUN Check(result:GetJsonObject('history'):GetLogical('log_manual'),'manual today retained').
 RUN AddRow(3,runDate,1,0,TRUE,FALSE). RUN Collect.
 RUN Check(result:GetJsonObject('history'):GetInteger('hist_cotacao_bc_id')=3,'latest ID wins even zero').
 RUN Check(result:GetJsonObject('history'):GetDecimal('valor')=0,'zero is not previous manual quote').
 RUN AddRow(4,runDate,1,?,TRUE,?). RUN Collect.
 RUN Check(result:GetJsonObject('history'):IsNull('valor'),'NULL distinct from zero').
 RUN Check(result:GetJsonObject('history'):IsNull('log_manual'),'nullable flag preserved').
 RUN AddRow(5,runDate,1,6,?,TRUE). RUN Collect.
 RUN Check(result:GetJsonObject('history'):GetInteger('hist_cotacao_bc_id')=5,'true OR NULL qualifies').
 RUN AddRow(6,runDate,1,7,?,FALSE). RUN Collect.
 RUN Check(result:GetJsonObject('history'):GetInteger('hist_cotacao_bc_id')=5,'NULL OR false not approved').
 RUN AddRow(5,runDate,1,8,TRUE,FALSE). RUN Collect.
 RUN Check(NOT result:GetLogical('success'),'duplicate key rejected').
 RUN Check(result:GetJsonObject('error'):GetCharacter('code')='DAILY_CURRENCY_STATUS_AMBIGUOUS','identity ambiguity exact').
 RUN Check(NOT result:Has('history'),'failure contains no selected partial row').
 EMPTY TEMP-TABLE ttHist.
 RUN AddRow(1,runDate,1,1,TRUE,FALSE). RUN AddRow(2,runDate,1,2,TRUE,FALSE).
 rowLimit=1. RUN Collect.
 RUN Check(NOT result:GetLogical('success'),'global row budget closes').
 RUN Check(result:GetJsonObject('error'):GetCharacter('code')='DAILY_CURRENCY_STATUS_LIMIT','limit exact').
 RUN Check(NOT result:Has('history'),'budget has no partial row').
 rowLimit=50000.
 RUN VALUE('CiwDailyCurrencyHistoryCollector.p')(INPUT BUFFER ttWrong:HANDLE,INPUT runDate,INPUT 50000,INPUT 10000,OUTPUT result).
 RUN Check(NOT result:GetLogical('success'),'physical type mismatch closed').
 RUN VALUE('CiwDailyCurrencyHistoryCollector.p')(INPUT BUFFER ttHist:HANDLE,INPUT ?,INPUT 50000,INPUT 10000,OUTPUT result).
 RUN Check(NOT result:GetLogical('success'),'unknown run date rejected').
 RUN VALUE('CiwDailyCurrencyHistoryCollector.p')(INPUT BUFFER ttHist:HANDLE,INPUT runDate,INPUT 50001,INPUT 10000,OUTPUT result).
 RUN Check(NOT result:GetLogical('success'),'caller cannot raise row cap').
 RUN VALUE('CiwDailyCurrencyHistoryCollector.p')(INPUT BUFFER ttHist:HANDLE,INPUT runDate,INPUT 50000,INPUT 10001,OUTPUT result).
 RUN Check(NOT result:GetLogical('success'),'caller cannot raise time cap').
 RUN Check(NUM-DBS=0,'zero databases after').
 PUT UNFORMATTED 'PASS ' checks ' checks' SKIP.
 CATCH err AS Progress.Lang.Error:
  PUT UNFORMATTED 'FAIL checks=' checks ' errorNumber=' err:GetMessageNum(1) SKIP.
 END CATCH.
END.
OUTPUT CLOSE. QUIT.
PROCEDURE Collect:
 RUN VALUE('CiwDailyCurrencyHistoryCollector.p')(INPUT BUFFER ttHist:HANDLE,INPUT runDate,INPUT rowLimit,INPUT 10000,OUTPUT result).
END PROCEDURE.
PROCEDURE AddRow:
 DEFINE INPUT PARAMETER identityValue AS INTEGER NO-UNDO.
 DEFINE INPUT PARAMETER dateValue AS DATE NO-UNDO.
 DEFINE INPUT PARAMETER seriesValue AS INTEGER NO-UNDO.
 DEFINE INPUT PARAMETER amountValue AS DECIMAL NO-UNDO.
 DEFINE INPUT PARAMETER okValue AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER manualValue AS LOGICAL NO-UNDO.
 CREATE ttHist. ASSIGN ttHist.hist_cotacao_bc_id=identityValue ttHist.data=dateValue ttHist.serie=seriesValue ttHist.valor=amountValue ttHist.log_ok=okValue ttHist.log_manual=manualValue. RELEASE ttHist.
END PROCEDURE.
PROCEDURE Check:
 DEFINE INPUT PARAMETER validValue AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER labelValue AS CHARACTER NO-UNDO.
 checks=checks + 1.
 IF validValue<>TRUE OR validValue=? THEN UNDO, THROW NEW Progress.Lang.AppError(labelValue,1).
END PROCEDURE.
