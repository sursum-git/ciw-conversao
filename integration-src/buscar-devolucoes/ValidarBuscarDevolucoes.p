DEFINE VARIABLE i AS INTEGER NO-UNDO.
DEFINE VARIABLE j AS INTEGER NO-UNDO.
DEFINE VARIABLE lFailed AS LOGICAL NO-UNDO.
DEFINE VARIABLE cFile AS CHARACTER NO-UNDO.
IF NUM-DBS <> 1 OR INDEX(PDBNAME(1), "buscar-devolucoes-fixture") = 0 THEN QUIT.
CREATE ALIAS ems2med FOR DATABASE devolfixture.
CREATE ALIAS ems2ima FOR DATABASE devolfixture.
CREATE ALIAS espec FOR DATABASE devolfixture.
OUTPUT TO "buscar-validation.log".
PUT UNFORMATTED "OpenEdge " PROVERSION SKIP.
DO i = 1 TO 5:
    cFile = ENTRY(i, "BuscarDevolucoes.p,BuscarDevolucoesMED.p,BuscarDevolucoesIMA.p,boConsDevolucoes.p,BuscarDevolucoesTest.p").
    COMPILE VALUE(cFile) NO-ERROR.
    PUT UNFORMATTED cFile " COMPILER:ERROR=" COMPILER:ERROR SKIP.
    IF COMPILER:ERROR OR ERROR-STATUS:ERROR THEN lFailed = TRUE.
    DO j = 1 TO ERROR-STATUS:NUM-MESSAGES:
        PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP.
    END.
END.
OUTPUT CLOSE.
IF NOT lFailed THEN DO i = 1 TO 2:
    SESSION:NUMERIC-FORMAT = ENTRY(i, "AMERICAN,EUROPEAN").
    RUN BuscarDevolucoesTest.p NO-ERROR.
    OUTPUT TO "buscar-validation.log" APPEND.
    IF ERROR-STATUS:ERROR THEN DO:
        lFailed = TRUE.
        DO j = 1 TO ERROR-STATUS:NUM-MESSAGES:
            PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP.
        END.
    END.
    IF CAN-FIND(FIRST devolfixture.docum-est)
    OR CAN-FIND(FIRST devolfixture.natur-oper)
    OR CAN-FIND(FIRST devolfixture.devol-cli)
    OR CAN-FIND(FIRST devolfixture.nota-fiscal)
    OR CAN-FIND(FIRST devolfixture.ped-venda)
    OR CAN-FIND(FIRST devolfixture.ped-repre)
    OR CAN-FIND(FIRST devolfixture.ped-venda-ext)
    OR CAN-FIND(FIRST devolfixture.cod-rejeicao) THEN DO:
        lFailed = TRUE.
        PUT UNFORMATTED "FAIL: fixture nao foi limpa" SKIP.
    END.
    ELSE PUT UNFORMATTED "CLEAN: 8 tabelas vazias apos " SESSION:NUMERIC-FORMAT SKIP.
    OUTPUT CLOSE.
    IF lFailed THEN LEAVE.
END.
OUTPUT TO "buscar-validation.log" APPEND.
PUT UNFORMATTED (IF lFailed THEN "FAIL" ELSE "PASS") SKIP.
OUTPUT CLOSE.
QUIT.
