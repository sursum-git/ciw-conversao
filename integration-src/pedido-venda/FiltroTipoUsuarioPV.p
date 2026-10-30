/**********************************************************************************
Pedido de venda: TRUE = desconsiderar; FALSE = manter na consulta.
Entrada: login e ROWID de ems2med.ped-venda. Sem SQL/query dinamica.
Tipo e vinculo do usuario: espec.user-web. Nao usa excecao do grupo 16.
Nao altera buffers do chamador, bancos ou dados; todas as leituras NO-LOCK.
***********************************************************************************/
BLOCK-LEVEL ON ERROR UNDO, THROW.

DEFINE INPUT  PARAMETER pcUsuario       AS CHARACTER NO-UNDO.
DEFINE INPUT  PARAMETER prPedido        AS ROWID     NO-UNDO.
DEFINE OUTPUT PARAMETER plDesconsiderar AS LOGICAL NO-UNDO.

DEFINE BUFFER bUsuario    FOR espec.user-web.
DEFINE BUFFER bPedido     FOR ems2med.ped-venda.
DEFINE BUFFER bPedidoRep  FOR ems2med.ped-repre.
DEFINE BUFFER bRepLogin   FOR ems2cad.repres.
DEFINE BUFFER bRepNome    FOR ems2cad.repres.
DEFINE BUFFER bHierarquia FOR espec.cm-ext-repres.
DEFINE BUFFER bVinculo    FOR espec.cm-hierarquia.
DEFINE BUFFER bRestricao  FOR espec.restrs_clientes_usuario.
DEFINE BUFFER bRestrRep   FOR espec.repres_restr_cliente_usuario.
DEFINE BUFFER bGrupo      FOR espec.usuarios_grupos.

DEFINE TEMP-TABLE ttNome NO-UNDO
    FIELD nome AS CHARACTER
    INDEX pk IS PRIMARY UNIQUE nome.

DEFINE VARIABLE iHierarquia AS INTEGER   NO-UNDO.
DEFINE VARIABLE iRestrAtivo AS INTEGER   NO-UNDO.
DEFINE VARIABLE lDiretor    AS LOGICAL   NO-UNDO.
DEFINE VARIABLE lGerente    AS LOGICAL   NO-UNDO.
DEFINE VARIABLE lTemLista   AS LOGICAL   NO-UNDO.
DEFINE VARIABLE cModo       AS CHARACTER NO-UNDO INITIAL "livre".
DEFINE VARIABLE cNomeIni    AS CHARACTER NO-UNDO INITIAL "".
DEFINE VARIABLE cNomeFim    AS CHARACTER NO-UNDO INITIAL "zzzzzzzzzzzzzzzzzzzz".

plDesconsiderar = TRUE.
IF pcUsuario = ? OR TRIM(pcUsuario) = "" OR prPedido = ? THEN RETURN.
FIND FIRST bUsuario WHERE bUsuario.Login = pcUsuario NO-LOCK NO-ERROR.
IF NOT AVAILABLE bUsuario THEN RETURN.
IF bUsuario.ativo = ? OR bUsuario.ativo = FALSE THEN RETURN.
IF bUsuario.tp-usuario = ? OR bUsuario.tp-usuario < 1 OR bUsuario.tp-usuario > 5 THEN RETURN.
FIND bPedido WHERE ROWID(bPedido) = prPedido NO-LOCK NO-ERROR.
IF NOT AVAILABLE bPedido THEN RETURN.

CASE bUsuario.tp-usuario:
    WHEN 2 THEN
        ASSIGN cModo = "faixa" cNomeIni = bUsuario.Login cNomeFim = bUsuario.Login.
    WHEN 5 THEN DO:
        IF bUsuario.usuario = ? OR TRIM(bUsuario.usuario) = "" THEN RETURN.
        ASSIGN cModo = "faixa" cNomeIni = bUsuario.usuario cNomeFim = bUsuario.usuario.
    END.
    WHEN 3 THEN DO:
        FIND FIRST bRepLogin WHERE bRepLogin.nome-abrev = bUsuario.Login NO-LOCK NO-ERROR.
        IF AVAILABLE bRepLogin THEN DO:
            FIND FIRST bHierarquia WHERE bHierarquia.cod-rep = bRepLogin.cod-rep NO-LOCK NO-ERROR.
            IF AVAILABLE bHierarquia AND bHierarquia.tp-aplic-comis <> ? THEN
                iHierarquia = bHierarquia.tp-aplic-comis.
        END.
        FIND FIRST bRestricao WHERE bRestricao.login = bUsuario.Login NO-LOCK NO-ERROR.
        IF AVAILABLE bRestricao AND bRestricao.ind_segur_cli_ativo <> ? THEN
            iRestrAtivo = bRestricao.ind_segur_cli_ativo.

        /* Reconstrucao da lista que setarVarsLogin fornece ao PHP. */
        IF iHierarquia = 3 THEN DO:
            RUN CarregarGerencia.
            lTemLista = TRUE.
        END.
        IF iRestrAtivo = 3 THEN RUN CarregarRestricao (OUTPUT lTemLista).

        IF lTemLista THEN cModo = "lista".
        ELSE DO:
            ASSIGN
                lDiretor = CAN-FIND(FIRST bGrupo WHERE bGrupo.login_usuario = bUsuario.Login
                                   AND bGrupo.cod_grupo = 6 NO-LOCK)
                lGerente = CAN-FIND(FIRST bGrupo WHERE bGrupo.login_usuario = bUsuario.Login
                                   AND bGrupo.cod_grupo = 5 NO-LOCK).
            IF lDiretor AND iHierarquia <> 3 THEN iHierarquia = 1.
            IF iRestrAtivo = 1 THEN iHierarquia = 1.
            IF iHierarquia = 1 OR iHierarquia = 4 THEN cModo = "faixa".
            ELSE IF lGerente THEN DO:
                RUN CarregarGerencia.
                cModo = "lista".
            END.
        END.
    END.
    WHEN 4 THEN DO:
        FIND FIRST bRestricao WHERE bRestricao.login = bUsuario.Login NO-LOCK NO-ERROR.
        IF AVAILABLE bRestricao THEN DO:
            IF bRestricao.ind_segur_cli_ativo = 3 THEN DO:
                RUN CarregarRestricao (OUTPUT lTemLista).
                IF lTemLista THEN cModo = "lista".
            END.
        END.
    END.
END CASE.

/* Equivale ao retorno vazio da funcao original: nenhuma restricao adicional. */
IF cModo = "livre" THEN DO:
    plDesconsiderar = FALSE.
    RETURN.
END.

/* Considera somente o representante principal informado no cabecalho. */
FOR EACH bPedidoRep NO-LOCK
    WHERE bPedidoRep.nr-pedido   = bPedido.nr-pedido
      AND bPedidoRep.nome-ab-rep = bPedido.no-ab-reppri:
    IF bPedidoRep.nome-ab-rep = ? THEN NEXT.
    IF cModo = "faixa" THEN DO:
        IF bPedidoRep.nome-ab-rep >= cNomeIni AND bPedidoRep.nome-ab-rep <= cNomeFim THEN DO:
            plDesconsiderar = FALSE.
            LEAVE.
        END.
    END.
    ELSE IF CAN-FIND(FIRST ttNome WHERE ttNome.nome = bPedidoRep.nome-ab-rep) THEN DO:
        plDesconsiderar = FALSE.
        LEAVE.
    END.
END.

PROCEDURE AdicionarNome:
    DEFINE INPUT PARAMETER pcNome AS CHARACTER NO-UNDO.
    IF pcNome = ? THEN RETURN ERROR "PV_NOME_REPRESENTANTE_DESCONHECIDO".
    IF NOT CAN-FIND(FIRST ttNome WHERE ttNome.nome = pcNome) THEN DO:
        CREATE ttNome.
        ttNome.nome = pcNome.
    END.
END PROCEDURE.

PROCEDURE CarregarGerencia:
    EMPTY TEMP-TABLE ttNome.
    IF AVAILABLE bRepLogin THEN DO:
        FOR EACH bVinculo WHERE bVinculo.cod-rep = bRepLogin.cod-rep NO-LOCK:
            FIND FIRST bRepNome WHERE bRepNome.cod-rep = bVinculo.cod-depend NO-LOCK NO-ERROR.
            IF NOT AVAILABLE bRepNome THEN RETURN ERROR "PV_DEPENDENTE_NAO_ENCONTRADO".
            RUN AdicionarNome (bRepNome.nome-abrev).
        END.
    END.
    /* getListaRepresGer() devolve IN ('') quando nao ha dependentes. */
    IF NOT CAN-FIND(FIRST ttNome) THEN RUN AdicionarNome ("").
END PROCEDURE.

PROCEDURE CarregarRestricao:
    DEFINE OUTPUT PARAMETER plTemLista AS LOGICAL NO-UNDO.
    ASSIGN plTemLista = FALSE.
    EMPTY TEMP-TABLE ttNome.
    FOR EACH bRestrRep
        WHERE bRestrRep.restr_cliente_usuario_id = bRestricao.restrs_clientes_usuario_id NO-LOCK:
        FIND FIRST bRepNome WHERE bRepNome.cod-rep = bRestrRep.cod_repres NO-LOCK NO-ERROR.
        IF NOT AVAILABLE bRepNome THEN RETURN ERROR "PV_REPRESENTANTE_NAO_ENCONTRADO".
        RUN AdicionarNome (bRepNome.nome-abrev).
        plTemLista = TRUE.
    END.
END PROCEDURE.
