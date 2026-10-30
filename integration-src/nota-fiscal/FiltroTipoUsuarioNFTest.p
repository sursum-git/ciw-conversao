/* Somente fixture local. Nao executar em bancos ERP. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
DEFINE VARIABLE rNota          AS ROWID   NO-UNDO.
DEFINE VARIABLE rOutra         AS ROWID   NO-UNDO.
DEFINE VARIABLE rSemRep        AS ROWID   NO-UNDO.
DEFINE VARIABLE iChecks        AS INTEGER NO-UNDO.

IF NUM-DBS <> 1 OR INDEX(PDBNAME(1), "nota-fiscal-fixture") = 0 THEN
    RETURN ERROR "FIXTURE_DATABASE_REQUIRED".
IF CAN-FIND(FIRST espec.user-web) OR CAN-FIND(FIRST ems2med.nota-fiscal) THEN
    RETURN ERROR "FIXTURE_MUST_BE_EMPTY".

CREATE espec.user-web.
ASSIGN espec.user-web.Login      = "NFTEST_REP"
       espec.user-web.usuario    = "NFTEST_REP"
       espec.user-web.tp-usuario = 2
       espec.user-web.ativo      = TRUE.
CREATE ems2cad.repres.
ASSIGN ems2cad.repres.cod-rep = 91 ems2cad.repres.nome-abrev = "NFTEST_REP".
CREATE ems2cad.repres.
ASSIGN ems2cad.repres.cod-rep = 92 ems2cad.repres.nome-abrev = "NFTEST_FILHO".
CREATE espec.cm-ext-repres.
ASSIGN espec.cm-ext-repres.cod-rep = 91 espec.cm-ext-repres.tp-aplic-comis = 2.
CREATE espec.cm-hierarquia.
ASSIGN espec.cm-hierarquia.cod-rep = 91 espec.cm-hierarquia.cod-depend = 92.
CREATE espec.restrs_clientes_usuario.
ASSIGN espec.restrs_clientes_usuario.login = "NFTEST_REP"
       espec.restrs_clientes_usuario.restrs_clientes_usuario_id = 77
       espec.restrs_clientes_usuario.ind_segur_cli_ativo = 0.
CREATE ems2med.nota-fiscal.
ASSIGN ems2med.nota-fiscal.cod-estabel  = "NFTEST1"
       ems2med.nota-fiscal.serie        = "T"
       ems2med.nota-fiscal.nr-nota-fis  = "900001"
       ems2med.nota-fiscal.no-ab-reppri = "NFTEST_REP"
       rNota = ROWID(ems2med.nota-fiscal).
CREATE ems2med.nota-fiscal.
ASSIGN ems2med.nota-fiscal.cod-estabel  = "NFTEST2"
       ems2med.nota-fiscal.serie        = "T"
       ems2med.nota-fiscal.nr-nota-fis  = "900001"
       ems2med.nota-fiscal.no-ab-reppri = "NFTEST_FILHO"
       rOutra = ROWID(ems2med.nota-fiscal).
CREATE ems2med.nota-fiscal.
ASSIGN ems2med.nota-fiscal.cod-estabel  = "NFTEST1"
       ems2med.nota-fiscal.serie        = "T"
       ems2med.nota-fiscal.nr-nota-fis  = "900003"
       ems2med.nota-fiscal.no-ab-reppri = ""
       rSemRep = ROWID(ems2med.nota-fiscal).

RUN CheckNota("representante principal proprio sem pedido", "NFTEST_REP", rNota, FALSE).
RUN CheckNota("mesmo numero outra empresa usa ROWID", "NFTEST_REP", rOutra, TRUE).
RUN CheckNota("sem representante", "NFTEST_REP", rSemRep, TRUE).
RUN CheckNota("usuario inexistente", "NFTEST_INEXISTENTE", rNota, TRUE).
RUN CheckNota("usuario vazio", "", rNota, TRUE).
RUN CheckNota("usuario desconhecido", ?, rNota, TRUE).
RUN CheckNota("ROWID desconhecido", "NFTEST_REP", ?, TRUE).

FIND ems2med.nota-fiscal WHERE ROWID(ems2med.nota-fiscal) = rNota EXCLUSIVE-LOCK.
ems2med.nota-fiscal.no-ab-reppri = ?.
RUN CheckNota("principal desconhecido", "NFTEST_REP", rNota, TRUE).
ems2med.nota-fiscal.no-ab-reppri = "NFTEST_REP".
FIND FIRST espec.user-web EXCLUSIVE-LOCK.
espec.user-web.ativo = FALSE.
RUN CheckNota("inativo", "NFTEST_REP", rNota, TRUE).
ASSIGN espec.user-web.ativo = TRUE espec.user-web.tp-usuario = 5.
RUN CheckNota("preposto usa vinculo", "NFTEST_REP", rNota, FALSE).
espec.user-web.usuario = "NFTEST_FILHO".
RUN CheckNota("preposto nao usa login", "NFTEST_REP", rNota, TRUE).
RUN CheckNota("preposto vinculo correto", "NFTEST_REP", rOutra, FALSE).
espec.user-web.usuario = "".
RUN CheckNota("preposto sem vinculo", "NFTEST_REP", rOutra, TRUE).

espec.user-web.tp-usuario = 3.
CREATE espec.usuarios_grupos.
ASSIGN espec.usuarios_grupos.login_usuario = "NFTEST_REP" espec.usuarios_grupos.cod_grupo = 5.
RUN CheckNota("gerente dependente", "NFTEST_REP", rOutra, FALSE).
RUN CheckNota("gerente fora da hierarquia", "NFTEST_REP", rNota, TRUE).
FIND FIRST espec.cm-ext-repres EXCLUSIVE-LOCK.
espec.cm-ext-repres.tp-aplic-comis = 3.
FIND FIRST espec.usuarios_grupos EXCLUSIVE-LOCK.
espec.usuarios_grupos.cod_grupo = 6.
RUN CheckNota("diretor preserva hierarquia 3", "NFTEST_REP", rNota, TRUE).
RUN CheckNota("hierarquia 3 independe grupo 5", "NFTEST_REP", rOutra, FALSE).
FIND FIRST espec.restrs_clientes_usuario EXCLUSIVE-LOCK.
espec.restrs_clientes_usuario.ind_segur_cli_ativo = 1.
RUN CheckNota("lista do login precede ativo 1", "NFTEST_REP", rNota, TRUE).
espec.cm-ext-repres.tp-aplic-comis = 2.
RUN CheckNota("diretoria ativo 1 faixa geral", "NFTEST_REP", rNota, FALSE).
espec.restrs_clientes_usuario.ind_segur_cli_ativo = 0.
espec.usuarios_grupos.cod_grupo = 16.
espec.cm-ext-repres.tp-aplic-comis = 1.
RUN CheckNota("hierarquia 1 sem excecao 16", "NFTEST_REP", rNota, FALSE).
espec.cm-ext-repres.tp-aplic-comis = 4.
RUN CheckNota("hierarquia 4 faixa", "NFTEST_REP", rOutra, FALSE).
CREATE espec.repres_restr_cliente_usuario.
ASSIGN espec.repres_restr_cliente_usuario.restr_cliente_usuario_id = 77
       espec.repres_restr_cliente_usuario.cod_repres = 92.
espec.restrs_clientes_usuario.ind_segur_cli_ativo = 3.
RUN CheckNota("lista explicita precede hierarquia", "NFTEST_REP", rNota, TRUE).
RUN CheckNota("lista explicita permite", "NFTEST_REP", rOutra, FALSE).
espec.user-web.tp-usuario = 4.
RUN CheckNota("tipo 4 restrito", "NFTEST_REP", rNota, TRUE).
RUN CheckNota("tipo 4 permitido", "NFTEST_REP", rOutra, FALSE).
espec.restrs_clientes_usuario.ind_segur_cli_ativo = 0.
RUN CheckNota("tipo 4 sem lista", "NFTEST_REP", rSemRep, FALSE).
espec.user-web.tp-usuario = 1.
RUN CheckNota("tipo 1 sem restricao representante", "NFTEST_REP", rSemRep, FALSE).
espec.user-web.tp-usuario = 2.
RUN CheckNota("sem cache", "NFTEST_REP", rOutra, TRUE).
espec.user-web.tp-usuario = ?.
RUN CheckNota("tipo desconhecido", "NFTEST_REP", rNota, TRUE).
espec.user-web.tp-usuario = 0.
RUN CheckNota("tipo invalido", "NFTEST_REP", rNota, TRUE).
ASSIGN espec.user-web.tp-usuario = 3
       espec.cm-ext-repres.tp-aplic-comis = 2
       espec.usuarios_grupos.cod_grupo = 15.
RUN CheckNota("grupo 15 nao equivale a 5", "NFTEST_REP", rNota, FALSE).
espec.usuarios_grupos.cod_grupo = 5.
FIND FIRST espec.cm-hierarquia EXCLUSIVE-LOCK.
DELETE espec.cm-hierarquia.
RUN CheckNota("gerente sem dependentes", "NFTEST_REP", rOutra, TRUE).
FIND FIRST espec.cm-ext-repres EXCLUSIVE-LOCK.
DELETE espec.cm-ext-repres.
RUN CheckNota("gerente sem cadastro hierarquia", "NFTEST_REP", rOutra, TRUE).
FIND FIRST espec.repres_restr_cliente_usuario EXCLUSIVE-LOCK.
DELETE espec.repres_restr_cliente_usuario.
ASSIGN espec.user-web.tp-usuario = 4 espec.restrs_clientes_usuario.ind_segur_cli_ativo = 3.
RUN CheckNota("tipo 4 lista vazia segue legado", "NFTEST_REP", rSemRep, FALSE).
FIND ems2med.nota-fiscal WHERE ROWID(ems2med.nota-fiscal) = rSemRep EXCLUSIVE-LOCK.
DELETE ems2med.nota-fiscal.
RUN CheckNota("nota eliminada", "NFTEST_REP", rSemRep, TRUE).

FOR EACH ems2med.nota-fiscal EXCLUSIVE-LOCK: DELETE ems2med.nota-fiscal. END.
FOR EACH ems2cad.repres EXCLUSIVE-LOCK: DELETE ems2cad.repres. END.
FOR EACH espec.user-web EXCLUSIVE-LOCK: DELETE espec.user-web. END.
FOR EACH espec.cm-hierarquia EXCLUSIVE-LOCK: DELETE espec.cm-hierarquia. END.
FOR EACH espec.cm-ext-repres EXCLUSIVE-LOCK: DELETE espec.cm-ext-repres. END.
FOR EACH espec.restrs_clientes_usuario EXCLUSIVE-LOCK: DELETE espec.restrs_clientes_usuario. END.
FOR EACH espec.repres_restr_cliente_usuario EXCLUSIVE-LOCK: DELETE espec.repres_restr_cliente_usuario. END.
FOR EACH espec.usuarios_grupos EXCLUSIVE-LOCK: DELETE espec.usuarios_grupos. END.
OUTPUT TO VALUE("nf-tests-" + SESSION:NUMERIC-FORMAT + ".log").
PUT UNFORMATTED "OpenEdge " PROVERSION SKIP "PASS " iChecks " checks; fixture limpa" SKIP.
OUTPUT CLOSE.

PROCEDURE CheckNota:
    DEFINE INPUT PARAMETER pcCaso     AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER pcLogin    AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER prNota     AS ROWID     NO-UNDO.
    DEFINE INPUT PARAMETER plEsperado AS LOGICAL   NO-UNDO.
    DEFINE VARIABLE lObtido AS LOGICAL NO-UNDO.
    IF AVAILABLE espec.user-web THEN VALIDATE espec.user-web.
    IF AVAILABLE ems2med.nota-fiscal THEN VALIDATE ems2med.nota-fiscal.
    IF AVAILABLE ems2cad.repres THEN VALIDATE ems2cad.repres.
    IF AVAILABLE espec.cm-ext-repres THEN VALIDATE espec.cm-ext-repres.
    IF AVAILABLE espec.cm-hierarquia THEN VALIDATE espec.cm-hierarquia.
    IF AVAILABLE espec.restrs_clientes_usuario THEN VALIDATE espec.restrs_clientes_usuario.
    IF AVAILABLE espec.repres_restr_cliente_usuario THEN VALIDATE espec.repres_restr_cliente_usuario.
    IF AVAILABLE espec.usuarios_grupos THEN VALIDATE espec.usuarios_grupos.
    lObtido = ?.
    RUN FiltroTipoUsuarioNF.p (pcLogin, prNota, OUTPUT lObtido).
    IF lObtido = ? OR lObtido <> plEsperado THEN
        UNDO, THROW NEW Progress.Lang.AppError(pcCaso + ": esperado " + STRING(plEsperado) + "; obtido " + STRING(lObtido), 1).
    iChecks = iChecks + 1.
END PROCEDURE.
