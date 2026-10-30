BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE TEMP-TABLE allocation NO-UNDO FIELD item_container_id AS INTEGER FIELD container_id AS INTEGER FIELD item_proc_compra_id AS INTEGER INDEX pk IS UNIQUE PRIMARY item_container_id.
DEFINE TEMP-TABLE purchaseItem NO-UNDO FIELD item_proc_compra_id AS INTEGER FIELD descricao AS CHARACTER FIELD codigo_erp AS CHARACTER INDEX pk IS UNIQUE PRIMARY item_proc_compra_id.
DEFINE TEMP-TABLE emitter NO-UNDO FIELD cod-emitente AS INTEGER FIELD nome-abrev AS CHARACTER INDEX pk IS UNIQUE PRIMARY cod-emitente.
DEFINE TEMP-TABLE expense NO-UNDO FIELD despesa_id AS INTEGER FIELD descricao AS CHARACTER INDEX pk IS UNIQUE PRIMARY despesa_id.
DEFINE TEMP-TABLE wrongEmitter NO-UNDO FIELD unrelated AS INTEGER.
DEFINE TEMP-TABLE reason NO-UNDO FIELD motivo_desconto_id AS INTEGER FIELD descricao AS CHARACTER INDEX pk IS UNIQUE PRIMARY motivo_desconto_id.
DEFINE VARIABLE labels AS JsonObject NO-UNDO.
DEFINE VARIABLE started AS INTEGER NO-UNDO.
DEFINE VARIABLE rowsRead AS INTEGER NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE failed AS LOGICAL NO-UNDO.
DEFINE VARIABLE kindValue AS CHARACTER CASE-SENSITIVE NO-UNDO.
DEFINE VARIABLE idValue AS INTEGER NO-UNDO.
CREATE allocation. ASSIGN allocation.item_container_id=1 allocation.container_id=777 allocation.item_proc_compra_id=2. RELEASE allocation.
CREATE purchaseItem. ASSIGN purchaseItem.item_proc_compra_id=2 purchaseItem.descricao='CURRENT ITEM' purchaseItem.codigo_erp='CURRENT-CODE'. RELEASE purchaseItem.
CREATE emitter. ASSIGN emitter.cod-emitente=3 emitter.nome-abrev='CURRENT EMITTER'. RELEASE emitter.
CREATE expense. ASSIGN expense.despesa_id=4 expense.descricao='CURRENT EXPENSE'. RELEASE expense.
started=ETIME.
kindValue='item'. idValue=1. RUN Invoke.
RUN Check(labels:GetCharacter('item_descricao_atual')='CURRENT ITEM' AND rowsRead=2,'item lookup uses current join exactly, no invented parent condition').
RUN Check(labels:Has('item_codigo_erp_atual'),'new current ERP code shares existing item lookup').
RUN Check(labels:GetCharacter('item_codigo_erp_atual')='CURRENT-CODE' AND rowsRead=2,'current ERP code adds no second physical query').
kindValue='emitente'. idValue=3. RUN Invoke.
RUN Check(labels:GetCharacter('emitente_nome_abrev_atual')='CURRENT EMITTER' AND rowsRead=3,'emitter direct dictionary source, no supplier filter').
kindValue='despesa'. idValue=4. RUN Invoke.
RUN Check(labels:GetCharacter('despesa_descricao_atual')='CURRENT EXPENSE' AND rowsRead=4,'expense direct current label').
kindValue='item'. idValue=999. RUN Invoke.
RUN Check(labels:IsNull('item_descricao_atual') AND rowsRead=5,'deleted allocation remains null, one budget unit').
FIND allocation WHERE allocation.item_container_id=1. allocation.item_proc_compra_id=999. RELEASE allocation.
idValue=1. RUN Invoke.
RUN Check(labels:IsNull('item_descricao_atual') AND rowsRead=7,'orphan current item remains null, no invented historical description').
kindValue='emitente'. idValue=?. RUN Invoke.
RUN Check(labels:IsNull('emitente_nome_abrev_atual') AND rowsRead=7,'unknown historical reference unchanged').
FIND emitter WHERE emitter.cod-emitente=3. emitter.nome-abrev='CHANGED CURRENT'. RELEASE emitter.
kindValue='emitente'. idValue=3. RUN Invoke.
RUN Check(labels:GetCharacter('emitente_nome_abrev_atual')='CHANGED CURRENT','current name is read again without cached enrichment').
FIND emitter WHERE emitter.cod-emitente=3. emitter.nome-abrev=?. RELEASE emitter. RUN Invoke.
RUN Check(labels:IsNull('emitente_nome_abrev_atual'),'unknown current description remains null').
failed=FALSE.
DO ON ERROR UNDO, LEAVE:
 RUN sursum-api/programs/ContainersVersionHistoryLabels.r(INPUT BUFFER allocation:HANDLE,INPUT BUFFER purchaseItem:HANDLE,INPUT BUFFER wrongEmitter:HANDLE,INPUT BUFFER expense:HANDLE,'emitente',3,started,INPUT-OUTPUT rowsRead,OUTPUT labels).
 CATCH e AS Progress.Lang.Error: failed=TRUE. END CATCH.
END.
RUN Check(failed,'real lookup query errors are not treated as missing records').
kindValue='EMITENTE'. failed=FALSE.
DO ON ERROR UNDO, LEAVE: RUN Invoke. CATCH e AS Progress.Lang.Error: failed=TRUE. END CATCH. END.
RUN Check(failed,'label kind is closed and case sensitive').
kindValue='emitente'.
rowsRead=50000. idValue=3. failed=FALSE.
DO ON ERROR UNDO, LEAVE: RUN Invoke. CATCH e AS Progress.Lang.Error: failed=TRUE. END CATCH. END.
RUN Check(failed AND rowsRead=50000,'shared aggregate ceiling never reset per row').
rowsRead=0. started=ETIME - 10001. failed=FALSE.
DO ON ERROR UNDO, LEAVE: RUN Invoke. CATCH e AS Progress.Lang.Error: failed=TRUE. END CATCH. END.
RUN Check(failed AND rowsRead=0,'shared wall clock ceiling never reset per lookup').
CREATE reason. ASSIGN reason.motivo_desconto_id=8 reason.descricao='CURRENT REASON'. RELEASE reason.
rowsRead=0. started=ETIME.
RUN sursum-api/programs/ContainersVersionHistoryLabels.r(?,?,?,INPUT BUFFER reason:HANDLE,'motivo',8,started,INPUT-OUTPUT rowsRead,OUTPUT labels).
RUN Check(labels:GetCharacter('motivo_descricao_atual')='CURRENT REASON' AND rowsRead=1,'reason is a fixed current dictionary lookup with shared budget').
RUN sursum-api/programs/ContainersVersionHistoryLabels.r(?,?,?,INPUT BUFFER reason:HANDLE,'motivo',999,started,INPUT-OUTPUT rowsRead,OUTPUT labels).
RUN Check(labels:IsNull('motivo_descricao_atual') AND rowsRead=2,'deleted reason label is unknown without inventing text').
RUN Check(NUM-DBS=0 AND NOT TRANSACTION,'TT only').
OUTPUT TO 'discount-labels-tests.log'. PUT UNFORMATTED 'PASS ' checks ' NUMDBS=' NUM-DBS SKIP. OUTPUT CLOSE.
RETURN.
PROCEDURE Invoke:
 RUN sursum-api/programs/ContainersVersionHistoryLabels.r(INPUT BUFFER allocation:HANDLE,INPUT BUFFER purchaseItem:HANDLE,INPUT BUFFER emitter:HANDLE,INPUT BUFFER expense:HANDLE,kindValue,idValue,started,INPUT-OUTPUT rowsRead,OUTPUT labels).
END PROCEDURE.
PROCEDURE Check:
 DEFINE INPUT PARAMETER conditionValue AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER descriptionValue AS CHARACTER NO-UNDO.
 IF conditionValue<>TRUE THEN UNDO, THROW NEW Progress.Lang.AppError(descriptionValue,1).
 checks=checks + 1.
END PROCEDURE.
