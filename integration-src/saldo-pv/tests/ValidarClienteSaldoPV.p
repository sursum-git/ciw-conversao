DEFINE VARIABLE i AS INTEGER NO-UNDO.
DEFINE VARIABLE j AS INTEGER NO-UNDO.
DEFINE VARIABLE failed AS LOGICAL NO-UNDO.
IF NUM-DBS <> 1 OR INDEX(PDBNAME(1), "saldo-pv-fixture") = 0 THEN QUIT.
CREATE ALIAS ems2med FOR DATABASE saldofixture.
CREATE ALIAS espec FOR DATABASE saldofixture.
OUTPUT TO "cliente-validation.log".
PUT UNFORMATTED "OpenEdge " PROVERSION SKIP.
COMPILE tests/TestClienteSaldoPV.p NO-ERROR.
PUT UNFORMATTED "Test COMPILER:ERROR=" COMPILER:ERROR SKIP.
DO j = 1 TO ERROR-STATUS:NUM-MESSAGES:
    PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP.
END.
failed = COMPILER:ERROR.
OUTPUT CLOSE.
IF NOT failed THEN DO i = 1 TO 2:
    SESSION:NUMERIC-FORMAT = ENTRY(i, "AMERICAN,EUROPEAN").
    RUN tests/TestClienteSaldoPV.p NO-ERROR.
    OUTPUT TO "cliente-validation.log" APPEND.
    IF ERROR-STATUS:ERROR THEN DO:
        failed = TRUE.
        DO j = 1 TO ERROR-STATUS:NUM-MESSAGES:
            PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP.
        END.
    END.
    IF CAN-FIND(FIRST ems2med.item) OR CAN-FIND(FIRST espec.item-ext)
    OR CAN-FIND(FIRST ems2med.saldo-estoq) OR CAN-FIND(FIRST ems2med.ped-venda)
    OR CAN-FIND(FIRST ems2med.ped-item) OR CAN-FIND(FIRST ems2med.nota-fiscal)
    OR CAN-FIND(FIRST ems2med.it-nota-fisc) OR CAN-FIND(FIRST ems2med.natur-oper)
    OR CAN-FIND(FIRST espec.peds_web) OR CAN-FIND(FIRST espec.itens_ped_web)
    OR CAN-FIND(FIRST espec.pp-container) OR CAN-FIND(FIRST espec.pp-it-container)
    OR CAN-FIND(FIRST espec.locais_estoq_portal) OR CAN-FIND(FIRST espec.pp_container_permissao)
    OR CAN-FIND(FIRST espec.controle_preco) OR CAN-FIND(FIRST espec.liquida-ima)
    OR CAN-FIND(FIRST espec.usuarios_grupos) OR CAN-FIND(FIRST espec.im-param) THEN DO:
        failed = TRUE.
        PUT UNFORMATTED "FAIL fixture com dados restantes" SKIP.
    END.
    ELSE PUT UNFORMATTED "CLEAN: 18 tabelas vazias apos " SESSION:NUMERIC-FORMAT SKIP.
    OUTPUT CLOSE.
    IF failed THEN LEAVE.
END.
OUTPUT TO "cliente-validation.log" APPEND.
PUT UNFORMATTED (IF failed THEN "FAIL" ELSE "PASS") SKIP.
OUTPUT CLOSE.
QUIT.

