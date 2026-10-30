BLOCK-LEVEL ON ERROR UNDO, THROW.
{ImportDiscountSourceFixtures.i}
{sursum-api/includes/ImportDiscountsReadTables.i}
DEFINE TEMP-TABLE brokenLedger NO-UNDO FIELD unrelated AS INTEGER.
DEFINE VARIABLE collectorPath AS CHARACTER NO-UNDO.
DEFINE VARIABLE selectedId AS INTEGER NO-UNDO.
DEFINE VARIABLE started AS INTEGER NO-UNDO.
DEFINE VARIABLE maxRows AS INTEGER NO-UNDO INITIAL 50000.
DEFINE VARIABLE rowsRead AS INTEGER NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE i AS INTEGER NO-UNDO.
DEFINE VARIABLE failed AS LOGICAL NO-UNDO.
DEFINE VARIABLE ledgerHandle AS HANDLE NO-UNDO.
collectorPath=SEARCH('sursum-api/programs/ImportDiscountsCollector.r').
RUN Check(collectorPath<>?,'new unique discount collector is available').
DO i=1 TO 4:
 CREATE discountSource. ASSIGN discountSource.desconto_importacao_id=i discountSource.item_container_id=100 + i discountSource.fornecedor_id=700 + i discountSource.motivo_desconto_id=8 discountSource.log_credito=IF i=1 THEN TRUE ELSE ? discountSource.descricao=' RAW DESCRIPTION ' discountSource.vl_real=? discountSource.dt_autorizacao=DATE(10,28,2026) discountSource.vl_dolar_autorizado=IF i=1 THEN 100 ELSE IF i=2 THEN 50 ELSE IF i=3 THEN ? ELSE 20. RELEASE discountSource.
END.
DO i=1 TO 6:
 CREATE ledgerSource. ASSIGN ledgerSource.cta_corren_desconto_id=1000 + i ledgerSource.desconto_importacao_id=IF i<=3 THEN 1 ELSE IF i=4 THEN 3 ELSE IF i=5 THEN 4 ELSE 999 ledgerSource.container_id=200 + i ledgerSource.valor_utilizado=IF i=1 THEN 30 ELSE IF i=2 THEN 20 ELSE IF i=5 THEN -5 ELSE ? ledgerSource.data=DATE(1,2,2025) ledgerSource.cod_usuario=DATE(2,3,2024). RELEASE ledgerSource.
END.
ledgerHandle=BUFFER ledgerSource:HANDLE. started=ETIME. selectedId=?. RUN Invoke.
RUN Check(rowsRead=9,'global budget counts four parents plus five matching physical ledger rows').
FIND ttImportDiscountsRead WHERE ttImportDiscountsRead.desconto_importacao_id=1.
RUN Check(ttImportDiscountsRead.vl_utiliz=50 AND ttImportDiscountsRead.vl_utiliz_detalhe=50 AND ttImportDiscountsRead.vl_saldo=50,'same unique aggregate feeds general detail and balance').
RUN Check(ttImportDiscountsRead.descricao=' RAW DESCRIPTION ' AND ttImportDiscountsRead.vl_real=?,'raw header text and unknown amounts survive').
FIND ttImportDiscountsRead WHERE ttImportDiscountsRead.desconto_importacao_id=2.
RUN Check(ttImportDiscountsRead.vl_utiliz=0 AND ttImportDiscountsRead.vl_utiliz_detalhe=? AND ttImportDiscountsRead.vl_saldo=50,'empty sum zero in general unknown in detail known balance').
FIND ttImportDiscountsRead WHERE ttImportDiscountsRead.desconto_importacao_id=3.
RUN Check(ttImportDiscountsRead.vl_utiliz=0 AND ttImportDiscountsRead.vl_utiliz_detalhe=? AND ttImportDiscountsRead.vl_saldo=?,'all unknown sum and unknown authorized do not invent values').
FIND ttImportDiscountsRead WHERE ttImportDiscountsRead.desconto_importacao_id=4.
RUN Check(ttImportDiscountsRead.vl_utiliz=-5 AND ttImportDiscountsRead.vl_saldo=25,'negative ledger values are preserved without clamping').
RUN Check(NOT CAN-FIND(FIRST ttImportDiscountLedgerRead WHERE ttImportDiscountLedgerRead.desconto_importacao_id=999),'orphan ledger is outside source parent subquery').
FIND ttImportDiscountLedgerRead WHERE ttImportDiscountLedgerRead.cta_corren_desconto_id=1001.
RUN Check(ttImportDiscountLedgerRead.cod_usuario=DATE(2,3,2024) AND ttImportDiscountLedgerRead.data=DATE(1,2,2025),'cod_usuario remains the physical DATE and is never an actor').
RUN Check(ttImportDiscountLedgerRead.container_id=201,'ledger container ID is preserved without invented MED filter').
selectedId=1. rowsRead=0. RUN Invoke.
RUN Check(rowsRead=4 AND NOT CAN-FIND(FIRST ttImportDiscountsRead WHERE ttImportDiscountsRead.desconto_importacao_id<>1),'selected discount restricts parent and shared aggregate').
RUN Check(NOT CAN-FIND(FIRST ttImportDiscountLedgerRead WHERE ttImportDiscountLedgerRead.desconto_importacao_id<>1),'ledger ownership is selected discount only').
selectedId=777. rowsRead=0. RUN Invoke.
RUN Check(NOT CAN-FIND(FIRST ttImportDiscountsRead) AND NOT CAN-FIND(FIRST ttImportDiscountLedgerRead),'missing selected parent returns empty private collector tables').
selectedId=?. rowsRead=0. maxRows=8. failed=FALSE.
DO ON ERROR UNDO, LEAVE: RUN Invoke. CATCH e AS Progress.Lang.Error: failed=TRUE. END CATCH. END.
RUN Check(failed,'global aggregate budget is shared across parents and ledger').
RUN Check(NOT CAN-FIND(FIRST ttImportDiscountsRead) AND NOT CAN-FIND(FIRST ttImportDiscountLedgerRead),'budget failure returns no partial collector rows').
maxRows=50000. rowsRead=0. started=ETIME - 10001. failed=FALSE.
DO ON ERROR UNDO, LEAVE: RUN Invoke. CATCH e AS Progress.Lang.Error: failed=TRUE. END CATCH. END.
RUN Check(failed AND rowsRead=0,'global clock is checked before any row even in empty calls').
started=ETIME. selectedId=1. ledgerHandle=BUFFER brokenLedger:HANDLE. failed=FALSE.
DO ON ERROR UNDO, LEAVE: RUN Invoke. CATCH e AS Progress.Lang.Error: failed=TRUE. END CATCH. END.
RUN Check(failed AND NOT CAN-FIND(FIRST ttImportDiscountsRead) AND NOT CAN-FIND(FIRST ttImportDiscountLedgerRead),'real query configuration failure clears partial output').
RUN Check(NUM-DBS=0 AND NOT TRANSACTION,'only TT fixtures no business transaction').
OUTPUT TO 'collector-tests.log'. PUT UNFORMATTED 'PASS ' checks ' NUMDBS=' NUM-DBS SKIP. OUTPUT CLOSE.
PROCEDURE Invoke:
 RUN VALUE(collectorPath)(INPUT BUFFER discountSource:HANDLE,ledgerHandle,selectedId,started,maxRows,INPUT-OUTPUT rowsRead,OUTPUT TABLE ttImportDiscountsRead,OUTPUT TABLE ttImportDiscountLedgerRead).
END PROCEDURE.
PROCEDURE Check:
 DEFINE INPUT PARAMETER checkedValue AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER messageValue AS CHARACTER NO-UNDO.
 IF checkedValue<>TRUE THEN UNDO, THROW NEW Progress.Lang.AppError(messageValue,1).
 checks=checks + 1.
END PROCEDURE.
