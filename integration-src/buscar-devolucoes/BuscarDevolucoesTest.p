BLOCK-LEVEL ON ERROR UNDO, THROW.
{esbo/boConsNotaFiscal.i}
{esapi/consulta-notas/ttFiltroDevolucoes.i}
DEFINE VARIABLE cEstIni AS CHARACTER NO-UNDO INITIAL "5".
DEFINE VARIABLE cEstFim AS CHARACTER NO-UNDO INITIAL "5".
DEFINE VARIABLE iCliIni AS INTEGER   NO-UNDO INITIAL 100.
DEFINE VARIABLE iCliFim AS INTEGER   NO-UNDO INITIAL 100.
DEFINE VARIABLE cNfIni  AS CHARACTER NO-UNDO INITIAL "000010".
DEFINE VARIABLE cNfFim  AS CHARACTER NO-UNDO INITIAL "000010".
DEFINE VARIABLE cPedIni AS CHARACTER NO-UNDO INITIAL "123".
DEFINE VARIABLE cPedFim AS CHARACTER NO-UNDO INITIAL "123".
DEFINE VARIABLE iRepIni AS INTEGER   NO-UNDO INITIAL 7.
DEFINE VARIABLE iRepFim AS INTEGER   NO-UNDO INITIAL 7.
DEFINE VARIABLE dtIni   AS DATE      NO-UNDO.
DEFINE VARIABLE dtFim   AS DATE      NO-UNDO.
DEFINE VARIABLE cEmp    AS CHARACTER NO-UNDO INITIAL "MED".
DEFINE VARIABLE iChecks AS INTEGER   NO-UNDO.
DEFINE VARIABLE iRows   AS INTEGER   NO-UNDO.
DEFINE VARIABLE lErro   AS LOGICAL   NO-UNDO.
DEFINE VARIABLE hBo     AS HANDLE    NO-UNDO.

IF NUM-DBS <> 1 OR (INDEX(PDBNAME(1), "buscar-devolucoes-fixture") = 0
                   AND INDEX(PDBNAME(1), "consulta-notas-fixture") = 0) THEN
    UNDO, THROW NEW Progress.Lang.AppError("Banco sintetico exclusivo obrigatorio", 1).

/* Rollback integral: nunca deixar os registros entre as duas culturas. */
DO TRANSACTION ON ERROR UNDO, THROW:
    IF CAN-FIND(FIRST devolfixture.docum-est) THEN
        UNDO, THROW NEW Progress.Lang.AppError("Fixture deve estar vazia", 1).
    CREATE devolfixture.natur-oper.
    ASSIGN devolfixture.natur-oper.nat-operacao = "DEV"
           devolfixture.natur-oper.tipo-compra = 3
           devolfixture.natur-oper.tp-rec-desp = 1.
    CREATE devolfixture.docum-est.
    ASSIGN devolfixture.docum-est.cod-estabel = "5"
           devolfixture.docum-est.cod-emitente = 100
           devolfixture.docum-est.nro-docto = "000010"
           devolfixture.docum-est.serie-docto = "D"
           devolfixture.docum-est.nat-operacao = "DEV"
           devolfixture.docum-est.tot-valor = 100
           devolfixture.docum-est.esp-docto = 22
           devolfixture.docum-est.dt-emissao = DATE(1, 15, 2026)
           devolfixture.docum-est.dt-trans = DATE(2, 1, 2026)
           devolfixture.docum-est.cidade = "Teste"
           devolfixture.docum-est.uf = "SC".
    CREATE devolfixture.devol-cli.
    ASSIGN devolfixture.devol-cli.cod-estabel = "5"
           devolfixture.devol-cli.cod-emitente = 100
           devolfixture.devol-cli.nro-docto = "000010"
           devolfixture.devol-cli.serie-docto = "D"
           devolfixture.devol-cli.nat-operacao = "DEV"
           devolfixture.devol-cli.serie = "V"
           devolfixture.devol-cli.nr-nota-fis = "000900"
           devolfixture.devol-cli.codigo-rejei = 2.
    CREATE devolfixture.nota-fiscal.
    ASSIGN devolfixture.nota-fiscal.cod-estabel = "5"
           devolfixture.nota-fiscal.cod-emitente = 100
           devolfixture.nota-fiscal.serie = "V"
           devolfixture.nota-fiscal.nr-nota-fis = "000900"
           devolfixture.nota-fiscal.nr-pedcli = "123"
           devolfixture.nota-fiscal.nome-ab-cli = "CLIENTE"
           devolfixture.nota-fiscal.cod-rep = 7
           devolfixture.nota-fiscal.no-ab-reppri = "REP TESTE".
    CREATE devolfixture.ped-venda.
    ASSIGN devolfixture.ped-venda.nr-pedcli = "123"
           devolfixture.ped-venda.nome-abrev = "CLIENTE"
           devolfixture.ped-venda.nr-pedido = 700
           devolfixture.ped-venda.cod-priori = 18.
    CREATE devolfixture.ped-repre.
    devolfixture.ped-repre.nr-pedido = 700.
    CREATE devolfixture.cod-rejeicao.
    ASSIGN devolfixture.cod-rejeicao.codigo-rejei = 2
           devolfixture.cod-rejeicao.descricao = "Motivo teste".
    ASSIGN dtIni = DATE(1, 15, 2026) dtFim = dtIni.
    RUN Consultar(1).
    FIND FIRST tt-NF.
    RUN Check(tt-NF.vl-nota = -100, "valor negativo").
    RUN Check(tt-NF.vl-desconto = -25, "desconto independente -25").
    RUN Check(tt-NF.vl-bruto = -125, "bruto negativo incluindo desconto").
    RUN Check(tt-NF.perc-comis = ?, "comissao nao informada no legado").
    RUN Check(tt-NF.descr-mot-dev = "2 - Motivo teste|", "motivo formatado").
    RUN Check(tt-NF.data = DATE(2, 1, 2026), "movimentacao no retorno").
    RUN Check(tt-NF.nf = "000010" AND tt-NF.nr-Pedido = 700
              AND tt-NF.nome-abrev = "CLIENTE" AND tt-NF.nome-ab-reppri = "REP TESTE",
              "campos do contrato tt-NF e pedido interno").
    EMPTY TEMP-TABLE ttFiltroDevolucoes.
    RUN EsperarErroTabela.
    CREATE ttFiltroDevolucoes.
    ttFiltroDevolucoes.empresa = "MED".
    RUN ConsultarTabela.
    RUN Check(CAN-FIND(FIRST tt-NF), "defaults da tabela deixam faixas abertas").
    RUN Check(ttFiltroDevolucoes.cliente-de = ? AND ttFiltroDevolucoes.emissao-ate = ?, "entrada preservada").
    CREATE ttFiltroDevolucoes.
    ttFiltroDevolucoes.empresa = "IMA".
    RUN EsperarErroTabela.

    ASSIGN cEstIni = "6" cEstFim = "9". RUN Consultar(0).
    ASSIGN cEstIni = "1" cEstFim = "4". RUN Consultar(0).
    ASSIGN cEstIni = "5" cEstFim = "5" iCliIni = 101 iCliFim = 200. RUN Consultar(0).
    ASSIGN iCliIni = 1 iCliFim = 99. RUN Consultar(0).
    ASSIGN iCliIni = 100 iCliFim = 100 cNfIni = "000011" cNfFim = "000020". RUN Consultar(0).
    ASSIGN cNfIni = "000001" cNfFim = "000009". RUN Consultar(0).
    ASSIGN cNfIni = "000010" cNfFim = "000010" cPedIni = "124" cPedFim = "999". RUN Consultar(0).
    ASSIGN cPedIni = "100" cPedFim = "122". RUN Consultar(0).
    ASSIGN cPedIni = "123" cPedFim = "123" iRepIni = 8 iRepFim = 9. RUN Consultar(0).
    ASSIGN iRepIni = 1 iRepFim = 6. RUN Consultar(0).
    ASSIGN iRepIni = 7 iRepFim = 7 dtIni = DATE(1, 16, 2026) dtFim = DATE(1, 31, 2026). RUN Consultar(0).
    ASSIGN dtIni = DATE(1, 1, 2026) dtFim = DATE(1, 14, 2026). RUN Consultar(0).
    /* ? em cada limite significa aberto; CHARACTER vazio tambem. */
    ASSIGN cEstIni = "" cEstFim = "" iCliIni = ? iCliFim = ?
           cNfIni = "" cNfFim = "" cPedIni = "" cPedFim = ""
           iRepIni = ? iRepFim = ? dtIni = ? dtFim = ?.
    RUN Consultar(1).
    /* Venda vinculada deve pertencer ao mesmo estabelecimento. */
    devolfixture.nota-fiscal.cod-estabel = "505". RUN Consultar(0).
    devolfixture.nota-fiscal.cod-estabel = "5".
    devolfixture.natur-oper.tipo-compra = 2. RUN Consultar(0).
    devolfixture.natur-oper.tipo-compra = 3.
    devolfixture.natur-oper.tp-rec-desp = 2. RUN Consultar(0).
    devolfixture.natur-oper.tp-rec-desp = 1.
    DELETE devolfixture.ped-repre. RUN Consultar(0).
    CREATE devolfixture.ped-repre. devolfixture.ped-repre.nr-pedido = 700.
    /* Dois itens com o mesmo motivo nao devem duplicar texto nem linha. */
    CREATE devolfixture.devol-cli.
    ASSIGN devolfixture.devol-cli.cod-estabel = "5" devolfixture.devol-cli.cod-emitente = 100
           devolfixture.devol-cli.nro-docto = "000010" devolfixture.devol-cli.serie-docto = "D"
           devolfixture.devol-cli.nat-operacao = "DEV" devolfixture.devol-cli.serie = "V"
           devolfixture.devol-cli.nr-nota-fis = "000900" devolfixture.devol-cli.codigo-rejei = 2.
    RUN Consultar(1).
    FIND FIRST tt-NF.
    RUN Check(tt-NF.descr-mot-dev = "2 - Motivo teste|", "motivos DISTINCT").
    devolfixture.ped-venda.cod-priori = 20. RUN Consultar(1).
    FIND FIRST tt-NF.
    RUN Check(tt-NF.vl-desconto = 0, "sem desconto").
    /* Escopo de empresa, sem reutilizar filtros de outros programas. */
    devolfixture.docum-est.cod-emitente = 1. RUN Consultar(0).
    devolfixture.docum-est.cod-emitente = 100.
    ASSIGN cEmp = "IMA". RUN Consultar(0).
    ASSIGN devolfixture.docum-est.cod-estabel = "1"
           devolfixture.nota-fiscal.cod-estabel = "1".
    FOR EACH devolfixture.devol-cli: devolfixture.devol-cli.cod-estabel = "1". END.
    RUN Consultar(1).
    devolfixture.docum-est.cod-emitente = 10535. RUN Consultar(0).
    devolfixture.docum-est.cod-emitente = 100.
    /* BO recebe criterios por procedimentos; TT fica no chamador/adaptador. */
    RUN esbo/boConsDevolucoes.p PERSISTENT SET hBo.
    RUN iniciarBo IN hBo.
    RUN setEmpresa IN hBo("IMA").
    RUN setIntervalEstab IN hBo("1").
    RUN setCliente IN hBo(100).
    RUN setNumeroPedido IN hBo("123").
    RUN setNotaFiscal IN hBo("000010").
    RUN setRepres IN hBo(7).
    RUN setIntervalDtEmis IN hBo(DATE(1, 15, 2026), DATE(1, 15, 2026)).
    RUN ConsultarBo(1).
    RUN setFaixaEstab IN hBo("2", "9"). RUN ConsultarBo(0).
    RUN setIntervalEstab IN hBo("1"). RUN ConsultarBo(1).
    RUN setIntervalCliente IN hBo(101, 200). RUN ConsultarBo(0).
    RUN setCliente IN hBo(100). RUN ConsultarBo(1).
    RUN setIntervalPedido IN hBo("124", "999"). RUN ConsultarBo(0).
    RUN setNumeroPedido IN hBo("123"). RUN ConsultarBo(1).
    RUN setIntervalNotaFiscal IN hBo("000011", "000020"). RUN ConsultarBo(0).
    RUN setNotaFiscal IN hBo("000010"). RUN ConsultarBo(1).
    RUN setIntervalRepres IN hBo(8, 9). RUN ConsultarBo(0).
    RUN setRepres IN hBo(7). RUN ConsultarBo(1).
    RUN setIntervalDtEmis IN hBo(DATE(1, 16, 2026), DATE(1, 31, 2026)). RUN ConsultarBo(0).
    RUN limparContexto IN hBo.
    RUN setEmpresa IN hBo("IMA").
    RUN ConsultarBo(1).
    RUN setCliente IN hBo(999). RUN ConsultarBo(0).
    RUN iniciarBo IN hBo.
    RUN setEmpresa IN hBo("IMA"). RUN ConsultarBo(1).
    RUN finalizarBo IN hBo.
    RUN Check(NOT VALID-HANDLE(hBo), "finalizarBo libera instancia persistente").
    ASSIGN cEmp = "OUTRA". RUN EsperarErro.
    ASSIGN cEmp = "MED" iCliIni = 200 iCliFim = 100. RUN EsperarErro.
    UNDO, LEAVE.
END.
OUTPUT TO VALUE("buscar-tests-" + SESSION:NUMERIC-FORMAT + ".log").
PUT UNFORMATTED "PASS " iChecks " checks" SKIP.
OUTPUT CLOSE.

PROCEDURE Executar:
    /* Tornar os buffers criados/alterados visiveis aos buffers proprios do servico. */
    IF AVAILABLE devolfixture.docum-est THEN VALIDATE devolfixture.docum-est.
    IF AVAILABLE devolfixture.natur-oper THEN VALIDATE devolfixture.natur-oper.
    IF AVAILABLE devolfixture.devol-cli THEN VALIDATE devolfixture.devol-cli.
    IF AVAILABLE devolfixture.nota-fiscal THEN VALIDATE devolfixture.nota-fiscal.
    IF AVAILABLE devolfixture.ped-venda THEN VALIDATE devolfixture.ped-venda.
    IF AVAILABLE devolfixture.ped-repre THEN VALIDATE devolfixture.ped-repre.
    IF AVAILABLE devolfixture.cod-rejeicao THEN VALIDATE devolfixture.cod-rejeicao.
    EMPTY TEMP-TABLE ttFiltroDevolucoes.
    CREATE ttFiltroDevolucoes.
    ASSIGN ttFiltroDevolucoes.empresa = cEmp
           ttFiltroDevolucoes.estabel-de = cEstIni
           ttFiltroDevolucoes.estabel-ate = cEstFim
           ttFiltroDevolucoes.cliente-de = iCliIni
           ttFiltroDevolucoes.cliente-ate = iCliFim
           ttFiltroDevolucoes.nota-de = cNfIni
           ttFiltroDevolucoes.nota-ate = cNfFim
           ttFiltroDevolucoes.pedido-de = cPedIni
           ttFiltroDevolucoes.pedido-ate = cPedFim
           ttFiltroDevolucoes.representante-de = iRepIni
           ttFiltroDevolucoes.representante-ate = iRepFim
           ttFiltroDevolucoes.emissao-de = dtIni
           ttFiltroDevolucoes.emissao-ate = dtFim.
    RUN ConsultarTabela.
END PROCEDURE.
PROCEDURE ConsultarTabela:
    RUN esapi/consulta-notas/BuscarDevolucoes.p(INPUT TABLE ttFiltroDevolucoes, OUTPUT TABLE tt-NF).
END PROCEDURE.
PROCEDURE ConsultarBo:
    DEFINE INPUT PARAMETER piEsperado AS INTEGER NO-UNDO.
    RUN exec IN hBo(OUTPUT TABLE tt-NF).
    iRows = 0.
    FOR EACH tt-NF: iRows = iRows + 1. END.
    RUN Check(iRows = piEsperado, "BO por setters: quantidade esperada " + STRING(piEsperado)).
END PROCEDURE.
PROCEDURE EsperarErroTabela:
    lErro = FALSE.
    DO ON ERROR UNDO, THROW:
        RUN ConsultarTabela.
        CATCH e AS Progress.Lang.Error: lErro = TRUE. END CATCH.
    END.
    RUN Check(lErro, "entrada exige exatamente um filtro").
END PROCEDURE.
PROCEDURE Consultar:
    DEFINE INPUT PARAMETER piEsperado AS INTEGER NO-UNDO.
    RUN Executar.
    iRows = 0.
    FOR EACH tt-NF: iRows = iRows + 1. END.
    RUN Check(iRows = piEsperado, "check " + STRING(iChecks + 1) + ": quantidade: esperado " + STRING(piEsperado) + ", obtido " + STRING(iRows)).
END PROCEDURE.
PROCEDURE EsperarErro:
    lErro = FALSE.
    DO ON ERROR UNDO, THROW:
        RUN Executar.
        CATCH e AS Progress.Lang.Error: lErro = TRUE. END CATCH.
    END.
    RUN Check(lErro, "entrada invalida deve falhar").
END PROCEDURE.
PROCEDURE Check:
    DEFINE INPUT PARAMETER plOk  AS LOGICAL   NO-UNDO.
    DEFINE INPUT PARAMETER pcMsg AS CHARACTER NO-UNDO.
    IF plOk <> TRUE OR plOk = ? THEN
        UNDO, THROW NEW Progress.Lang.AppError("FAIL: " + pcMsg, 1).
    iChecks = iChecks + 1.
END PROCEDURE.
