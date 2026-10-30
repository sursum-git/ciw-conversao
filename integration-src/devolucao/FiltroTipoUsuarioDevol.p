/**********************************************************************************
Devolucao: TRUE = desconsiderar; FALSE = manter na consulta.
Entrada: login e ROWID de ems2med.devol-cli. Consultas estaticas NO-LOCK.
Regra original: tipos 2 e 5 validam venda.cod-rep = codRepIni.
O alias venda do PHP corresponde a nota-fiscal; devol-cli nao tem cod-rep.
Nao altera buffers do chamador, tabelas fisicas ou configuracoes.
***********************************************************************************/
BLOCK-LEVEL ON ERROR UNDO, THROW.

DEFINE INPUT  PARAMETER pcUsuario       AS CHARACTER NO-UNDO.
DEFINE INPUT  PARAMETER prDevolucao     AS ROWID     NO-UNDO.
DEFINE OUTPUT PARAMETER plDesconsiderar AS LOGICAL   NO-UNDO.

DEFINE BUFFER bUsuario   FOR espec.user-web.
DEFINE BUFFER bDevolucao FOR ems2med.devol-cli.
DEFINE BUFFER bNota      FOR ems2med.nota-fiscal.
DEFINE BUFFER bRepres    FOR ems2cad.repres.

DEFINE VARIABLE cNomeRepres AS CHARACTER NO-UNDO.

plDesconsiderar = TRUE.
IF pcUsuario = ? OR TRIM(pcUsuario) = "" OR prDevolucao = ? THEN RETURN.

FIND FIRST bUsuario WHERE bUsuario.Login = pcUsuario NO-LOCK NO-ERROR.
IF NOT AVAILABLE bUsuario THEN RETURN.
IF bUsuario.ativo = ? OR bUsuario.ativo = FALSE THEN RETURN.
IF bUsuario.tp-usuario = ? OR bUsuario.tp-usuario < 1 OR bUsuario.tp-usuario > 5 THEN RETURN.

FIND bDevolucao WHERE ROWID(bDevolucao) = prDevolucao NO-LOCK NO-ERROR.
IF NOT AVAILABLE bDevolucao THEN RETURN.

CASE bUsuario.tp-usuario:
    WHEN 2 THEN cNomeRepres = bUsuario.Login.
    WHEN 5 THEN cNomeRepres = bUsuario.usuario.
    OTHERWISE DO:
        /* A funcao original nao restringe devolucao nos tipos 1, 3 e 4. */
        plDesconsiderar = FALSE.
        RETURN.
    END.
END CASE.

IF cNomeRepres = ? OR TRIM(cNomeRepres) = "" THEN RETURN.
FIND FIRST bRepres WHERE bRepres.nome-abrev = cNomeRepres NO-LOCK NO-ERROR.
IF NOT AVAILABLE bRepres THEN RETURN.
IF bRepres.cod-rep = ? THEN RETURN.

/* Mesma juncao do legado: estabelecimento, serie e numero da NF de venda. */
FIND FIRST bNota NO-LOCK
    WHERE bNota.cod-estabel = bDevolucao.cod-estabel
      AND bNota.serie       = bDevolucao.serie
      AND bNota.nr-nota-fis = bDevolucao.nr-nota-fis
    NO-ERROR.
IF NOT AVAILABLE bNota THEN RETURN.
IF bNota.cod-rep = ? THEN RETURN.

plDesconsiderar = (bNota.cod-rep <> bRepres.cod-rep).
