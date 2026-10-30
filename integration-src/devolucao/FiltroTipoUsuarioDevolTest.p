/* Somente banco sintetico local. Nunca executar no ERP. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
DEFINE VARIABLE rDevol       AS ROWID   NO-UNDO.
DEFINE VARIABLE rOutraEmp    AS ROWID   NO-UNDO.
DEFINE VARIABLE rOutraSerie  AS ROWID   NO-UNDO.
DEFINE VARIABLE rSemNota     AS ROWID   NO-UNDO.
DEFINE VARIABLE rNota        AS ROWID   NO-UNDO.
DEFINE VARIABLE iChecks      AS INTEGER NO-UNDO.
DEFINE VARIABLE i            AS INTEGER NO-UNDO.
IF NUM-DBS <> 1 OR INDEX(PDBNAME(1), "devolucao-fixture") = 0 THEN
    RETURN ERROR "FIXTURE_DATABASE_REQUIRED".
IF CAN-FIND(FIRST espec.user-web) OR CAN-FIND(FIRST ems2med.devol-cli) THEN
    RETURN ERROR "FIXTURE_MUST_BE_EMPTY".

CREATE espec.user-web.
ASSIGN espec.user-web.Login = "DEVTEST_REP" espec.user-web.usuario = "DEVTEST_FILHO"
       espec.user-web.tp-usuario = 2 espec.user-web.ativo = TRUE.
CREATE ems2cad.repres.
ASSIGN ems2cad.repres.cod-rep = 91 ems2cad.repres.nome-abrev = "DEVTEST_REP".
CREATE ems2cad.repres.
ASSIGN ems2cad.repres.cod-rep = 92 ems2cad.repres.nome-abrev = "DEVTEST_FILHO".
DO i = 1 TO 3:
    CREATE ems2med.nota-fiscal.
    ASSIGN ems2med.nota-fiscal.cod-estabel = (IF i = 2 THEN "DEVTEST2" ELSE "DEVTEST1")
           ems2med.nota-fiscal.serie       = (IF i = 3 THEN "T" ELSE "S")
           ems2med.nota-fiscal.nr-nota-fis = "900001"
           ems2med.nota-fiscal.cod-rep     = (IF i = 1 THEN 91 ELSE 92).
    IF i = 1 THEN rNota = ROWID(ems2med.nota-fiscal).
    CREATE ems2med.devol-cli.
    ASSIGN ems2med.devol-cli.cod-estabel = ems2med.nota-fiscal.cod-estabel
           ems2med.devol-cli.serie       = ems2med.nota-fiscal.serie
           ems2med.devol-cli.nr-nota-fis = ems2med.nota-fiscal.nr-nota-fis.
    CASE i:
        WHEN 1 THEN rDevol = ROWID(ems2med.devol-cli).
        WHEN 2 THEN rOutraEmp = ROWID(ems2med.devol-cli).
        WHEN 3 THEN rOutraSerie = ROWID(ems2med.devol-cli).
    END CASE.
END.
CREATE ems2med.devol-cli.
ASSIGN ems2med.devol-cli.cod-estabel = "DEVTEST1"
       ems2med.devol-cli.serie       = "S"
       ems2med.devol-cli.nr-nota-fis = "999999"
       rSemNota = ROWID(ems2med.devol-cli).

RUN CheckDevol("tipo 2 representante do login", "DEVTEST_REP", rDevol, FALSE).
RUN CheckDevol("empresa participa da chave NF", "DEVTEST_REP", rOutraEmp, TRUE).
RUN CheckDevol("serie participa da chave NF", "DEVTEST_REP", rOutraSerie, TRUE).
RUN CheckDevol("numero participa da chave NF", "DEVTEST_REP", rSemNota, TRUE).
RUN CheckDevol("usuario inexistente", "DEVTEST_INEXISTENTE", rDevol, TRUE).
RUN CheckDevol("usuario vazio", "", rDevol, TRUE).
RUN CheckDevol("usuario desconhecido", ?, rDevol, TRUE).
RUN CheckDevol("ROWID desconhecido", "DEVTEST_REP", ?, TRUE).
RUN CheckDevol("ROWID de outra tabela", "DEVTEST_REP", rNota, TRUE).
FIND FIRST espec.user-web EXCLUSIVE-LOCK.
espec.user-web.ativo = FALSE.
RUN CheckDevol("usuario inativo", "DEVTEST_REP", rDevol, TRUE).
espec.user-web.ativo = ?.
RUN CheckDevol("atividade desconhecida", "DEVTEST_REP", rDevol, TRUE).
ASSIGN espec.user-web.ativo = TRUE espec.user-web.tp-usuario = 5.
RUN CheckDevol("tipo 5 nao usa login do preposto", "DEVTEST_REP", rDevol, TRUE).
RUN CheckDevol("tipo 5 usa representante vinculado", "DEVTEST_REP", rOutraEmp, FALSE).
RUN CheckDevol("tipo 5 outra serie mesmo vinculo", "DEVTEST_REP", rOutraSerie, FALSE).
espec.user-web.usuario = "".
RUN CheckDevol("preposto sem vinculo", "DEVTEST_REP", rDevol, TRUE).
espec.user-web.usuario = "DEVTEST_INEXISTENTE".
RUN CheckDevol("representante vinculado inexistente", "DEVTEST_REP", rDevol, TRUE).
DO i = 1 TO 4:
    IF i = 2 THEN NEXT.
    espec.user-web.tp-usuario = i.
    RUN CheckDevol("tipo " + STRING(i) + " sem restricao adicional", "DEVTEST_REP", rOutraEmp, FALSE).
END.
RUN CheckDevol("tipo livre nao depende da NF", "DEVTEST_REP", rSemNota, FALSE).
espec.user-web.tp-usuario = ?.
RUN CheckDevol("tipo desconhecido", "DEVTEST_REP", rDevol, TRUE).
espec.user-web.tp-usuario = 0.
RUN CheckDevol("tipo invalido", "DEVTEST_REP", rDevol, TRUE).
espec.user-web.tp-usuario = 2.
RUN CheckDevol("tipo relido sem cache", "DEVTEST_REP", rDevol, FALSE).
FIND ems2med.nota-fiscal WHERE ROWID(ems2med.nota-fiscal) = rNota EXCLUSIVE-LOCK.
ems2med.nota-fiscal.cod-rep = 92.
RUN CheckDevol("cod-rep relido sem cache", "DEVTEST_REP", rDevol, TRUE).
ems2med.nota-fiscal.cod-rep = ?.
RUN CheckDevol("codigo representante desconhecido", "DEVTEST_REP", rDevol, TRUE).
ems2med.nota-fiscal.cod-rep = 91.
FIND FIRST ems2cad.repres WHERE ems2cad.repres.cod-rep = 91 EXCLUSIVE-LOCK.
DELETE ems2cad.repres.
RUN CheckDevol("representante do login inexistente", "DEVTEST_REP", rDevol, TRUE).
FIND ems2med.devol-cli WHERE ROWID(ems2med.devol-cli) = rDevol EXCLUSIVE-LOCK.
DELETE ems2med.devol-cli.
espec.user-web.tp-usuario = 1.
RUN CheckDevol("devolucao inexistente mesmo para tipo livre", "DEVTEST_REP", rDevol, TRUE).

FOR EACH espec.user-web EXCLUSIVE-LOCK: DELETE espec.user-web. END.
FOR EACH ems2cad.repres EXCLUSIVE-LOCK: DELETE ems2cad.repres. END.
FOR EACH ems2med.devol-cli EXCLUSIVE-LOCK: DELETE ems2med.devol-cli. END.
FOR EACH ems2med.nota-fiscal EXCLUSIVE-LOCK: DELETE ems2med.nota-fiscal. END.
OUTPUT TO VALUE("devol-tests-" + SESSION:NUMERIC-FORMAT + ".log").
PUT UNFORMATTED "OpenEdge " PROVERSION SKIP "PASS " iChecks " checks; fixture limpa" SKIP.
OUTPUT CLOSE.

PROCEDURE CheckDevol:
    DEFINE INPUT PARAMETER pcCaso      AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER pcLogin     AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER prDevolucao AS ROWID     NO-UNDO.
    DEFINE INPUT PARAMETER plEsperado  AS LOGICAL   NO-UNDO.
    DEFINE VARIABLE lObtido AS LOGICAL NO-UNDO.
    IF AVAILABLE espec.user-web THEN VALIDATE espec.user-web.
    IF AVAILABLE ems2cad.repres THEN VALIDATE ems2cad.repres.
    IF AVAILABLE ems2med.devol-cli THEN VALIDATE ems2med.devol-cli.
    IF AVAILABLE ems2med.nota-fiscal THEN VALIDATE ems2med.nota-fiscal.
    lObtido = ?.
    RUN FiltroTipoUsuarioDevol.p (pcLogin, prDevolucao, OUTPUT lObtido).
    IF lObtido = ? OR lObtido <> plEsperado THEN
        UNDO, THROW NEW Progress.Lang.AppError(pcCaso + ": esperado " + STRING(plEsperado) + "; obtido " + STRING(lObtido), 1).
    iChecks = iChecks + 1.
END PROCEDURE.
