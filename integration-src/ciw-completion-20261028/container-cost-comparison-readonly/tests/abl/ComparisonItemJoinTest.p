BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE TEMP-TABLE ttAllocation NO-UNDO FIELD item_container_id AS INTEGER FIELD item_proc_compra_id AS INTEGER INDEX pk IS PRIMARY item_container_id.
DEFINE TEMP-TABLE ttPurchase NO-UNDO FIELD item_proc_compra_id AS INTEGER FIELD descricao AS CHARACTER FIELD codigo_erp AS CHARACTER INDEX pk IS PRIMARY item_proc_compra_id.
DEFINE VARIABLE resultValue AS JsonObject NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE reads AS INTEGER NO-UNDO.
DEFINE VARIABLE started AS INTEGER NO-UNDO.
DEFINE VARIABLE names AS CHARACTER EXTENT NO-UNDO.
OUTPUT TO 'comparison-itemjoin-tests.log'.
DO ON ERROR UNDO, THROW:
 started=ETIME.
 RUN Check(NUM-DBS=0,'zero databases').
 RUN Invoke('item_join',1).
 RUN Check(NOT resultValue:GetLogical('item_join_exists'),'missing allocation excludes source inner join').
 CREATE ttAllocation. ttAllocation.item_container_id=1. ttAllocation.item_proc_compra_id=3. RELEASE ttAllocation.
 RUN Invoke('item_join',1).
 RUN Check(NOT resultValue:GetLogical('item_join_exists'),'missing purchase item excludes source inner join').
 CREATE ttPurchase. ttPurchase.item_proc_compra_id=3. ttPurchase.descricao=?. ttPurchase.codigo_erp=?. RELEASE ttPurchase.
 RUN Invoke('item_join',1).
 RUN Check(resultValue:GetLogical('item_join_exists'),'existing join retained even both text fields NULL').
 RUN Check(resultValue:IsNull('item_descricao_atual') AND resultValue:IsNull('item_codigo_erp_atual'),'NULL text preserved').
 RUN Invoke('item',1).
 names=resultValue:GetNames(). RUN Check(EXTENT(names)=2 AND NOT resultValue:Has('item_join_exists'),'old private item kind payload unchanged').
 FIND FIRST ttPurchase. ttPurchase.descricao='Current item'. ttPurchase.codigo_erp='SYNTHETIC'. RELEASE ttPurchase.
 RUN Invoke('item_join',1).
 RUN Check(resultValue:GetLogical('item_join_exists') AND resultValue:GetCharacter('item_codigo_erp_atual')='SYNTHETIC','current source code selected').
 RUN Check(resultValue:GetCharacter('item_descricao_atual')='Current item','current source description selected').
 RUN Check(reads=9,'one shared lookup path and caller budget').
 RUN Check(NUM-DBS=0,'zero databases after').
 PUT UNFORMATTED 'PASS ' checks ' checks' SKIP.
 CATCH err AS Progress.Lang.Error: PUT UNFORMATTED 'FAIL checks=' checks ' errorNumber=' err:GetMessageNum(1) SKIP. END CATCH.
END.
OUTPUT CLOSE. QUIT.
PROCEDURE Invoke:
 DEFINE INPUT PARAMETER kindValue AS CHARACTER NO-UNDO.
 DEFINE INPUT PARAMETER idValue AS INTEGER NO-UNDO.
 RUN VALUE('ContainersVersionHistoryLabels.p')(INPUT BUFFER ttAllocation:HANDLE,INPUT BUFFER ttPurchase:HANDLE,INPUT ?,INPUT ?,INPUT kindValue,INPUT idValue,INPUT started,INPUT-OUTPUT reads,OUTPUT resultValue).
END PROCEDURE.
PROCEDURE Check:
 DEFINE INPUT PARAMETER okValue AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER labelValue AS CHARACTER NO-UNDO.
 checks=checks + 1.
 IF okValue<>TRUE OR okValue=? THEN UNDO,THROW NEW Progress.Lang.AppError(labelValue,1).
END PROCEDURE.
