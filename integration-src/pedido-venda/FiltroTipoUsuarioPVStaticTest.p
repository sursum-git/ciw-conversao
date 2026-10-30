/* Somente banco sintetico local criado para esta suite. Nunca executar no ERP. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
DEFINE VARIABLE rPedido AS ROWID NO-UNDO.
DEFINE VARIABLE rOutro AS ROWID NO-UNDO.
DEFINE VARIABLE rSemRep AS ROWID NO-UNDO.
DEFINE VARIABLE iChecks AS INTEGER NO-UNDO.
IF NUM-DBS <> 1 OR INDEX(PDBNAME(1), "pedido-venda-fixture") = 0 THEN
    RETURN ERROR "FIXTURE_DATABASE_REQUIRED".
IF CAN-FIND(FIRST espec.user-web) OR CAN-FIND(FIRST ems2med.ped-venda) THEN
    RETURN ERROR "FIXTURE_MUST_BE_EMPTY".
DO:
    CREATE espec.user-web.
    ASSIGN espec.user-web.Login = "PVTEST_REP" espec.user-web.ativo = TRUE
           espec.user-web.tp-usuario = 2 espec.user-web.usuario = "PVTEST_REP".
    CREATE ems2cad.repres.
    ASSIGN ems2cad.repres.cod-rep = 91 ems2cad.repres.nome-abrev = "PVTEST_REP".
    CREATE ems2cad.repres.
    ASSIGN ems2cad.repres.cod-rep = 92 ems2cad.repres.nome-abrev = "PVTEST_FILHO".
    CREATE espec.cm-ext-repres.
    ASSIGN espec.cm-ext-repres.cod-rep = 91 espec.cm-ext-repres.tp-aplic-comis = 2.
    CREATE espec.cm-hierarquia.
    ASSIGN espec.cm-hierarquia.cod-rep = 91 espec.cm-hierarquia.cod-depend = 92.
    CREATE espec.restrs_clientes_usuario.
    ASSIGN espec.restrs_clientes_usuario.login = "PVTEST_REP"
           espec.restrs_clientes_usuario.restrs_clientes_usuario_id = 77
           espec.restrs_clientes_usuario.ind_segur_cli_ativo = 0.
    CREATE ems2med.ped-venda.
    ASSIGN ems2med.ped-venda.nr-pedido = 900001
           ems2med.ped-venda.no-ab-reppri = "PVTEST_REP"
           rPedido = ROWID(ems2med.ped-venda).
    CREATE ems2med.ped-repre.
    ASSIGN ems2med.ped-repre.nr-pedido = 900001 ems2med.ped-repre.nome-ab-rep = "PVTEST_OUTRO".
    CREATE ems2med.ped-repre.
    ASSIGN ems2med.ped-repre.nr-pedido = 900001 ems2med.ped-repre.nome-ab-rep = "PVTEST_REP".
    CREATE ems2med.ped-venda.
    ASSIGN ems2med.ped-venda.nr-pedido = 900002
           ems2med.ped-venda.no-ab-reppri = "PVTEST_FILHO"
           rOutro = ROWID(ems2med.ped-venda).
    CREATE ems2med.ped-repre.
    ASSIGN ems2med.ped-repre.nr-pedido = 900002 ems2med.ped-repre.nome-ab-rep = "PVTEST_FILHO".
    CREATE ems2med.ped-venda.
    ASSIGN ems2med.ped-venda.nr-pedido = 900003 rSemRep = ROWID(ems2med.ped-venda).
END.
RUN CheckPedido("varios representantes", "PVTEST_REP", rPedido, FALSE).
FIND ems2med.ped-venda WHERE ROWID(ems2med.ped-venda) = rPedido EXCLUSIVE-LOCK.
ems2med.ped-venda.no-ab-reppri = "PVTEST_OUTRO".
RUN CheckPedido("secundario permitido nao substitui principal", "PVTEST_REP", rPedido, TRUE).
ems2med.ped-venda.no-ab-reppri = ?.
RUN CheckPedido("principal desconhecido", "PVTEST_REP", rPedido, TRUE).
ems2med.ped-venda.no-ab-reppri = "PVTEST_SEM_VINCULO".
RUN CheckPedido("principal sem ped-repre correspondente", "PVTEST_REP", rPedido, TRUE).
ems2med.ped-venda.no-ab-reppri = "PVTEST_REP".
RUN CheckPedido("outro representante", "PVTEST_REP", rOutro, TRUE).
RUN CheckPedido("restrito sem ped-repre", "PVTEST_REP", rSemRep, TRUE).
RUN CheckPedido("usuario inexistente", "PVTEST_INEXISTENTE", rPedido, TRUE).
RUN CheckPedido("usuario vazio", "", rPedido, TRUE).
RUN CheckPedido("usuario desconhecido", ?, rPedido, TRUE).
RUN CheckPedido("ROWID desconhecido", "PVTEST_REP", ?, TRUE).
FIND FIRST espec.user-web EXCLUSIVE-LOCK.
espec.user-web.ativo = FALSE.
RUN CheckPedido("inativo", "PVTEST_REP", rPedido, TRUE).
ASSIGN espec.user-web.ativo = TRUE espec.user-web.tp-usuario = 5.
RUN CheckPedido("preposto usa vinculo", "PVTEST_REP", rPedido, FALSE).
espec.user-web.usuario = "PVTEST_FILHO".
RUN CheckPedido("preposto nao usa login", "PVTEST_REP", rPedido, TRUE).
RUN CheckPedido("preposto vinculo correto", "PVTEST_REP", rOutro, FALSE).
espec.user-web.tp-usuario = 3.
CREATE espec.usuarios_grupos.
ASSIGN espec.usuarios_grupos.login_usuario = "PVTEST_REP" espec.usuarios_grupos.cod_grupo = 5.
RUN CheckPedido("gerente dependente", "PVTEST_REP", rOutro, FALSE).
RUN CheckPedido("gerente fora da hierarquia", "PVTEST_REP", rPedido, TRUE).
FIND FIRST espec.cm-ext-repres EXCLUSIVE-LOCK.
espec.cm-ext-repres.tp-aplic-comis = 3.
FIND FIRST espec.usuarios_grupos EXCLUSIVE-LOCK.
espec.usuarios_grupos.cod_grupo = 6.
RUN CheckPedido("diretor preserva hierarquia 3", "PVTEST_REP", rPedido, TRUE).
RUN CheckPedido("hierarquia 3 independe grupo 5", "PVTEST_REP", rOutro, FALSE).
FIND FIRST espec.restrs_clientes_usuario EXCLUSIVE-LOCK.
espec.restrs_clientes_usuario.ind_segur_cli_ativo = 1.
RUN CheckPedido("lista do login precede ativo 1", "PVTEST_REP", rPedido, TRUE).
espec.cm-ext-repres.tp-aplic-comis = 2.
RUN CheckPedido("diretoria e ativo 1 faixa geral", "PVTEST_REP", rPedido, FALSE).
espec.restrs_clientes_usuario.ind_segur_cli_ativo = 0.
espec.usuarios_grupos.cod_grupo = 16.
espec.cm-ext-repres.tp-aplic-comis = 1.
RUN CheckPedido("hierarquia 1 sem excecao 16", "PVTEST_REP", rPedido, FALSE).
espec.cm-ext-repres.tp-aplic-comis = 4.
RUN CheckPedido("hierarquia 4 faixa", "PVTEST_REP", rOutro, FALSE).
CREATE espec.repres_restr_cliente_usuario.
ASSIGN espec.repres_restr_cliente_usuario.restr_cliente_usuario_id = 77
       espec.repres_restr_cliente_usuario.cod_repres = 92.
espec.restrs_clientes_usuario.ind_segur_cli_ativo = 3.
RUN CheckPedido("lista explicita precede hierarquia", "PVTEST_REP", rPedido, TRUE).
RUN CheckPedido("lista explicita permite", "PVTEST_REP", rOutro, FALSE).
espec.user-web.tp-usuario = 4.
RUN CheckPedido("tipo 4 restrito", "PVTEST_REP", rPedido, TRUE).
RUN CheckPedido("tipo 4 permitido", "PVTEST_REP", rOutro, FALSE).
espec.restrs_clientes_usuario.ind_segur_cli_ativo = 0.
RUN CheckPedido("tipo 4 sem lista", "PVTEST_REP", rSemRep, FALSE).
espec.user-web.tp-usuario = 1.
RUN CheckPedido("tipo 1 sem restricao de representante", "PVTEST_REP", rSemRep, FALSE).
espec.user-web.tp-usuario = 2.
RUN CheckPedido("sem cache de tipo", "PVTEST_REP", rOutro, TRUE).
espec.user-web.usuario = "".
espec.user-web.tp-usuario = 5.
RUN CheckPedido("preposto sem vinculo", "PVTEST_REP", rOutro, TRUE).
espec.user-web.tp-usuario = ?.
RUN CheckPedido("tipo desconhecido", "PVTEST_REP", rPedido, TRUE).
espec.user-web.tp-usuario = 0.
RUN CheckPedido("tipo fora do contrato", "PVTEST_REP", rPedido, TRUE).
ASSIGN espec.user-web.tp-usuario = 3
       espec.cm-ext-repres.tp-aplic-comis = 2
       espec.usuarios_grupos.cod_grupo = 15.
RUN CheckPedido("grupo 15 nao equivale ao grupo 5", "PVTEST_REP", rPedido, FALSE).
espec.usuarios_grupos.cod_grupo = 5.
FIND FIRST espec.cm-hierarquia EXCLUSIVE-LOCK.
DELETE espec.cm-hierarquia.
RUN CheckPedido("gerente sem dependentes", "PVTEST_REP", rOutro, TRUE).
FIND FIRST espec.cm-ext-repres EXCLUSIVE-LOCK.
DELETE espec.cm-ext-repres.
RUN CheckPedido("gerente sem cadastro de hierarquia", "PVTEST_REP", rOutro, TRUE).
/* Excluir uma lista explicita para conferir o fallback vazio do legado. */
FIND FIRST espec.repres_restr_cliente_usuario EXCLUSIVE-LOCK.
DELETE espec.repres_restr_cliente_usuario.
espec.user-web.tp-usuario = 4.
espec.restrs_clientes_usuario.ind_segur_cli_ativo = 3.
RUN CheckPedido("tipo 4 com restricao sem membros segue legado", "PVTEST_REP", rSemRep, FALSE).
FIND ems2med.ped-venda WHERE ROWID(ems2med.ped-venda) = rSemRep EXCLUSIVE-LOCK.
DELETE ems2med.ped-venda.
RUN CheckPedido("pedido eliminado", "PVTEST_REP", rSemRep, TRUE).
FOR EACH ems2med.ped-repre EXCLUSIVE-LOCK: DELETE ems2med.ped-repre. END.
FOR EACH ems2med.ped-venda EXCLUSIVE-LOCK: DELETE ems2med.ped-venda. END.
FOR EACH ems2cad.repres EXCLUSIVE-LOCK: DELETE ems2cad.repres. END.
FOR EACH espec.user-web EXCLUSIVE-LOCK: DELETE espec.user-web. END.
FOR EACH espec.cm-hierarquia EXCLUSIVE-LOCK: DELETE espec.cm-hierarquia. END.
FOR EACH espec.cm-ext-repres EXCLUSIVE-LOCK: DELETE espec.cm-ext-repres. END.
FOR EACH espec.restrs_clientes_usuario EXCLUSIVE-LOCK: DELETE espec.restrs_clientes_usuario. END.
FOR EACH espec.repres_restr_cliente_usuario EXCLUSIVE-LOCK: DELETE espec.repres_restr_cliente_usuario. END.
FOR EACH espec.usuarios_grupos EXCLUSIVE-LOCK: DELETE espec.usuarios_grupos. END.
OUTPUT TO VALUE("pv-static-tests-" + SESSION:NUMERIC-FORMAT + ".log").
PUT UNFORMATTED "OpenEdge " PROVERSION SKIP "PASS " iChecks " checks; fixture limpa" SKIP.
OUTPUT CLOSE.
PROCEDURE CheckPedido:
    DEFINE INPUT PARAMETER pcCaso AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER pcLogin AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER prPedido AS ROWID NO-UNDO.
    DEFINE INPUT PARAMETER plEsperado AS LOGICAL NO-UNDO.
    DEFINE VARIABLE lObtido AS LOGICAL NO-UNDO.
    /* Materializa creates/indices antes de ler por buffers independentes. */
    IF AVAILABLE espec.user-web THEN VALIDATE espec.user-web.
    IF AVAILABLE ems2med.ped-venda THEN VALIDATE ems2med.ped-venda.
    IF AVAILABLE ems2med.ped-repre THEN VALIDATE ems2med.ped-repre.
    IF AVAILABLE ems2cad.repres THEN VALIDATE ems2cad.repres.
    IF AVAILABLE espec.cm-ext-repres THEN VALIDATE espec.cm-ext-repres.
    IF AVAILABLE espec.cm-hierarquia THEN VALIDATE espec.cm-hierarquia.
    IF AVAILABLE espec.restrs_clientes_usuario THEN VALIDATE espec.restrs_clientes_usuario.
    IF AVAILABLE espec.repres_restr_cliente_usuario THEN VALIDATE espec.repres_restr_cliente_usuario.
    IF AVAILABLE espec.usuarios_grupos THEN VALIDATE espec.usuarios_grupos.
    lObtido = ?.
    RUN FiltroTipoUsuarioPV.p (pcLogin, prPedido, OUTPUT lObtido).
    IF lObtido = ? OR lObtido <> plEsperado THEN
        UNDO, THROW NEW Progress.Lang.AppError(pcCaso + ": esperado " + STRING(plEsperado) + "; obtido " + STRING(lObtido), 1).
    iChecks = iChecks + 1.
END PROCEDURE.
