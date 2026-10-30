BLOCK-LEVEL ON ERROR UNDO, THROW.
{esbo/boSaldoPV.i}
DEFINE VARIABLE hBo AS HANDLE NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE cLog AS CHARACTER NO-UNDO.
DEFINE VARIABLE lFalhou AS LOGICAL NO-UNDO.
DEFINE VARIABLE linhasDetalhe AS INTEGER NO-UNDO.
IF NUM-DBS <> 1 OR INDEX(PDBNAME(1), "saldo-pv-fixture") = 0 THEN
    RETURN ERROR "Testes exigem banco sintetico saldo-pv-fixture".
cLog = "saldo-tests-" + SESSION:NUMERIC-FORMAT + ".log".
OUTPUT TO VALUE(cLog).
IF SEARCH("esbo/boSaldoPV.p") = ? THEN DO:
    RUN checar(FALSE, "BO persistente disponivel").
    OUTPUT CLOSE.
    RETURN ERROR "FAIL: boSaldoPV ausente".
END.
RUN esbo/boSaldoPV.p PERSISTENT SET hBo NO-ERROR.
RUN checar(VALID-HANDLE(hBo), "BO persistente disponivel").
IF NOT VALID-HANDLE(hBo) THEN DO:
    OUTPUT CLOSE.
    RETURN ERROR "FAIL: boSaldoPV ausente".
END.
/* Cada fixture usa somente o banco isolado e e desfeita. */
DO TRANSACTION ON ERROR UNDO, THROW:
    CREATE ems2med.item.
    ASSIGN ems2med.item.it-codigo = "TEST-KG"
        ems2med.item.desc-item = "Item teste" ems2med.item.fm-codigo = "F1"
        ems2med.item.un = "KG" ems2med.item.peso-liquido = 2 ems2med.item.ge-codigo = 50.
    CREATE espec.item-ext.
    ASSIGN espec.item-ext.it-codigo = "TEST-KG" espec.item-ext.gramatura = 150.
    CREATE ems2med.item.
    ASSIGN ems2med.item.it-codigo = "TEST-MT" ems2med.item.fm-codigo = "F2"
        ems2med.item.un = "MT" ems2med.item.peso-liquido = 4 ems2med.item.ge-codigo = 60.
    CREATE espec.item-ext.
    ASSIGN espec.item-ext.it-codigo = "TEST-MT" espec.item-ext.gramatura = 180.
    CREATE espec.pp-container.
    ASSIGN espec.pp-container.nr-container = 77 espec.pp-container.situacao = 1
        espec.pp-container.cod-estabel = "5" espec.pp-container.exclusivo = NO.
    CREATE espec.pp-it-container.
    ASSIGN espec.pp-it-container.nr-container = 77
        espec.pp-it-container.it-codigo = "TEST-KG" espec.pp-it-container.cod-refer = "A"
        espec.pp-it-container.qt-pedida = 100 espec.pp-it-container.perc-dsp-venda = 50
        espec.pp-it-container.qt-vendida = 7 espec.pp-it-container.cod_estab_definido = "99".
    RUN saldoFisico("5", "ARM", "TEST-KG", "A", 100).
    RUN saldoFisico("5", "OUT", "TEST-KG", "A", 90).
    RUN saldoFisico("5", "ARM", "TEST-KG", "B", -20).
    RUN saldoFisico("6", "ARM", "TEST-KG", "A", 40).
    RUN saldoFisico("5", "ARM", "TEST-MT", "A", 30).
    CREATE espec.locais_estoq_portal.
    ASSIGN espec.locais_estoq_portal.cod_empresa = "5"
        espec.locais_estoq_portal.cod_estab = "5" espec.locais_estoq_portal.cod_depos = "ARM"
        espec.locais_estoq_portal.dt_hora_inicio = NOW - 1000
        espec.locais_estoq_portal.dt_hora_fim = NOW + 1000.
    /* Mesmo local duplicado nao duplica quantidade. */
    CREATE espec.locais_estoq_portal.
    ASSIGN espec.locais_estoq_portal.cod_empresa = "5"
        espec.locais_estoq_portal.cod_estab = "5" espec.locais_estoq_portal.cod_depos = "ARM"
        espec.locais_estoq_portal.dt_hora_inicio = NOW - 1000
        espec.locais_estoq_portal.dt_hora_fim = NOW + 1000.
    CREATE ems2med.ped-venda.
    ASSIGN ems2med.ped-venda.cod-estabel = "5" ems2med.ped-venda.tp-pedido = "PE"
        ems2med.ped-venda.nome-abrev = "CLIENTE" ems2med.ped-venda.nr-pedcli = "T1"
        ems2med.ped-venda.cod-sit-ped = 2.
    CREATE ems2med.ped-item.
    ASSIGN ems2med.ped-item.nome-abrev = "CLIENTE" ems2med.ped-item.nr-pedcli = "T1"
        ems2med.ped-item.it-codigo = "TEST-KG" ems2med.ped-item.cod-refer = "A"
        ems2med.ped-item.cod-sit-item = 4 ems2med.ped-item.qt-pedida = 10.
    CREATE ems2med.nota-fiscal.
    ASSIGN ems2med.nota-fiscal.cod-estabel = "5" ems2med.nota-fiscal.serie = "T"
        ems2med.nota-fiscal.nr-nota-fis = "1" ems2med.nota-fiscal.dt-cancela = ?
        ems2med.nota-fiscal.dt-confirma = ? ems2med.nota-fiscal.nat-operacao = "VENDA".
    CREATE ems2med.it-nota-fisc.
    ASSIGN ems2med.it-nota-fisc.cod-estabel = "5" ems2med.it-nota-fisc.serie = "T"
        ems2med.it-nota-fisc.nr-nota-fis = "1" ems2med.it-nota-fisc.it-codigo = "TEST-KG"
        ems2med.it-nota-fisc.cod-refer = "A" ems2med.it-nota-fisc.qt-faturada[1] = 3.
    RUN web(1, 1, "5", 0, "TEST-KG", "A", "EU", 4).
    RUN web(2, 2, "5", 0, "TEST-KG", "A", "OUTRO", 5).
    RUN web(3, 6, "5", 0, "TEST-KG", "A", "OUTRO", 999).
    /* Flush dos buffers CREATE para leitura por buffers proprios da BO. */
    RELEASE ems2med.item.
    RELEASE espec.item-ext.
    RELEASE espec.pp-container.
    RELEASE espec.pp-it-container.
    RELEASE espec.locais_estoq_portal.
    RELEASE ems2med.ped-venda.
    RELEASE ems2med.ped-item.
    RELEASE ems2med.nota-fiscal.
    RELEASE ems2med.it-nota-fisc.
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.itemContem = "KG" ttFiltroSaldoPV.gramaturaIni = 150
        ttFiltroSaldoPV.gramaturaFim = 150 ttFiltroSaldoPV.minimoKG = 78.
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-KG"), "etapa1 inclui limite gramatura").
    RUN checar(NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-MT"), "etapa1 propriedades excluem outro item").
    RUN preencherSaldos IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    FIND ttSaldoPV WHERE origem = "PE" NO-ERROR.
    RUN checar(AVAILABLE ttSaldoPV, "etapa2 PE encontrado").
    IF AVAILABLE ttSaldoPV THEN DO:
        RUN checar(ttSaldoPV.qtFisica = 100, "fisico positivo e local sem duplicidade").
        RUN checar(ttSaldoPV.qtPedidos = 10, "pedido item4 sem restricao adicional de cabecalho").
        RUN checar(ttSaldoPV.qtNFAberta = 3, "NF aberta[1]").
        RUN checar(ttSaldoPV.qtCarrinho = 4 AND ttSaldoPV.qtCarrinhoLogin = 4, "carrinho/login separados").
        RUN checar(ttSaldoPV.qtNaoIntegrada = 5, "web usa quantidade propria e exclui estado6").
        RUN checar(ttSaldoPV.qtSaldoVenda = 78, "PE liquido 100-10-3-4-5").
    END.
    FIND ttSaldoPV WHERE origem = "PI" NO-ERROR.
    RUN checar(AVAILABLE ttSaldoPV, "etapa2 PI encontrado").
    IF AVAILABLE ttSaldoPV THEN
        RUN checar(ttSaldoPV.qtDisponibilizada = 50 AND ttSaldoPV.qtSaldoVenda = 43,
            "PI divide percentual por100 e desconta vendido").
    RUN filtrarSaldos IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    RUN checar(CAN-FIND(ttSaldoPV WHERE origem = "PE"), "minimo inclusivo mantem PE").
    RUN checar(NOT CAN-FIND(ttSaldoPV WHERE origem = "PI"), "PI isolado nao atinge minimo").
    /* Modo pagina: origem selecionada decide elegibilidade, ambas sao exibidas. */
    RUN parametros.
    ASSIGN ttFiltroSaldoPV.exibirAmbosSaldos = YES ttFiltroSaldoPV.buscarPI = NO
        ttFiltroSaldoPV.itemIni = "TEST-KG" ttFiltroSaldoPV.itemFim = "TEST-KG".
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    FIND ttItensSaldoPV WHERE ttItensSaldoPV.itCodigo = "TEST-KG".
    RUN checar(ttItensSaldoPV.qtSaldoPE = 78 AND ttItensSaldoPV.qtSaldoPI = 43,
        "pagina somentePE devolve tambemPI sem mudar calculo").
    ttFiltroSaldoPV.minimoKG = 79.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(NOT CAN-FIND(FIRST ttItensSaldoPV), "pagina PI nao selecionado nao salva PE reprovado").
    ASSIGN ttFiltroSaldoPV.buscarPE = NO ttFiltroSaldoPV.buscarPI = YES ttFiltroSaldoPV.minimoKG = 0.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    FIND ttItensSaldoPV WHERE ttItensSaldoPV.itCodigo = "TEST-KG".
    RUN checar(ttItensSaldoPV.qtSaldoPE = 78 AND ttItensSaldoPV.qtSaldoPI = 43,
        "pagina somentePI devolve tambemPE").
    ASSIGN ttFiltroSaldoPV.buscarPE = YES ttFiltroSaldoPV.minimoKG = 50.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    FIND ttItensSaldoPV WHERE ttItensSaldoPV.itCodigo = "TEST-KG".
    RUN checar(ttItensSaldoPV.qtSaldoPE = 78 AND ttItensSaldoPV.qtSaldoPI = 43,
        "pagina mostra saldoPI bruto mesmo abaixo do minimo se PE aprova").
    ttFiltroSaldoPV.buscarPE = NO.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(NOT CAN-FIND(FIRST ttItensSaldoPV), "pagina PE nao selecionado nao salva PI reprovado").
    ASSIGN ttFiltroSaldoPV.buscarPE = NO ttFiltroSaldoPV.buscarPI = NO.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(NOT CAN-FIND(FIRST ttItensSaldoPV), "pagina sem origem selecionada nao retorna itens").
    /* Repeticao completa nao conserva totais ou filtros do processamento anterior. */
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.buscarPI = NO ttFiltroSaldoPV.minimoKG = 79
        ttFiltroSaldoPV.itemIni = "TEST-KG" ttFiltroSaldoPV.itemFim = "TEST-KG".
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(NOT CAN-FIND(FIRST ttItensSaldoPV), "minimo79 exclui78 sem compensar comPI").
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.selecaoItensAtiva = YES.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(NOT CAN-FIND(FIRST ttItensSaldoPV), "selecao ativa vazia nunca abre consulta").
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ttFiltroSaldoPV.situacoesCarrinho = "1, 9".
    RUN configurar.
    RUN exec IN hBo NO-ERROR.
    RUN checar(ERROR-STATUS:ERROR, "estados com espaco rejeitados").
    /* Falha em etapa publica precisa invalidar TTs NO-UNDO e totais. */
    FIND FIRST espec.pp-it-container.
    espec.pp-it-container.qt-vendida = ?.
    RELEASE espec.pp-it-container.
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.itemIni = "TEST-KG" ttFiltroSaldoPV.itemFim = "TEST-KG"
        ttFiltroSaldoPV.minimoKG = 79.
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN preencherSaldos IN hBo.
    RUN filtrarSaldos IN hBo NO-ERROR.
    RUN checar(ERROR-STATUS:ERROR, "quantidade PI desconhecida gera erro").
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    RUN checar(NOT CAN-FIND(FIRST ttItensSaldoPV) AND NOT CAN-FIND(FIRST ttSaldoPV),
        "falha em etapa publica nao expoe resultado parcial").
    FIND FIRST espec.pp-it-container.
    espec.pp-it-container.qt-vendida = 7.
    RELEASE espec.pp-it-container.
    /* Selecao de estabelecimento substitui deposito configurado. */
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.buscarPI = NO ttFiltroSaldoPV.considerarWeb = NO
        ttFiltroSaldoPV.itemIni = "TEST-KG" ttFiltroSaldoPV.itemFim = "TEST-KG"
        ttFiltroSaldoPV.selecaoEstabsAtiva = YES.
    RUN selecao("ESTAB", "5", "", 0).
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    FIND FIRST ttSaldoPV NO-ERROR.
    RUN checar(AVAILABLE ttSaldoPV, "estabelecimento explicito retorna PE").
    IF AVAILABLE ttSaldoPV THEN RUN checar(ttSaldoPV.qtFisica = 190,
        "estabelecimento explicito inclui todos os depositos").
    /* Maximo nao pode compensar com a outra origem. */
    ttFiltroSaldoPV.maximoKG = 176.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(NOT CAN-FIND(FIRST ttItensSaldoPV), "maximo aplicado apos descontos").
    /* Unidade MT usa limite MT, nao KG. */
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.buscarPI = NO ttFiltroSaldoPV.considerarWeb = NO
        ttFiltroSaldoPV.unidade = "MT" ttFiltroSaldoPV.minimoMT = 30
        ttFiltroSaldoPV.minimoKG = 999.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-MT"), "MT limite inclusivo independente de KG").
    /* Selecao esparsa e assimetria PHP no nivel item: web A+B, fisico apenas A. */
    RUN web(4, 1, "5", 0, "TEST-KG", "B", "OUTRO", 6).
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.buscarPI = NO ttFiltroSaldoPV.selecaoReferenciasAtiva = YES
        ttFiltroSaldoPV.itemIni = "TEST-KG" ttFiltroSaldoPV.itemFim = "TEST-KG".
    RUN selecao("REF", "A", "", 0).
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    FIND FIRST ttSaldoPV NO-ERROR.
    IF AVAILABLE ttSaldoPV THEN DO:
        RUN checar(ttSaldoPV.codRefer = "", "sem minimo agrega por item").
        RUN checar(ttSaldoPV.qtCarrinho = 10, "web nivel item considera refs fora da selecao como PHP").
    END.
    /* PI web por container, com duas reservas separadas. */
    RUN web(5, 1, "5", 77, "TEST-KG", "A", "EU", 2).
    RUN web(6, 2, "5", 77, "TEST-KG", "A", "OUTRO", 3).
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.buscarPE = NO ttFiltroSaldoPV.porReferencia = YES.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    FIND FIRST ttSaldoPV NO-ERROR.
    RUN checar(AVAILABLE ttSaldoPV, "PI com web retorna linha").
    IF AVAILABLE ttSaldoPV THEN RUN checar(ttSaldoPV.qtSaldoVenda = 38
        AND ttSaldoPV.qtCarrinhoLogin = 2, "PI 50-7-2-3 sem misturar container0").
    FIND FIRST espec.pp-container.
    espec.pp-container.exclusivo = YES.
    RELEASE espec.pp-container.
    ttFiltroSaldoPV.representante = 11.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    RUN checar(NOT CAN-FIND(FIRST ttSaldoPV), "exclusivo com representante sem permissao nao libera").
    CREATE espec.pp_container_permissao.
    ASSIGN espec.pp_container_permissao.nr_container = 77 espec.pp_container_permissao.cod_repres = 10.
    RELEASE espec.pp_container_permissao.
    ttFiltroSaldoPV.representante = 10.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    RUN checar(CAN-FIND(FIRST ttSaldoPV), "permissao explicita libera container").
    ttFiltroSaldoPV.selecaoContainersAtiva = YES.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    RUN checar(NOT CAN-FIND(FIRST ttSaldoPV), "selecao containers ativa vazia exclui PI").
    /* Precificacao/liquidacao: somente conjuntos explicitamente resolvidos. */
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.buscarPI = NO ttFiltroSaldoPV.considerarWeb = NO
        ttFiltroSaldoPV.filtroTabelaPreco = YES ttFiltroSaldoPV.soLiquidacao = YES
        ttFiltroSaldoPV.usarSelecoesEspeciais = YES.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(NOT CAN-FIND(FIRST ttItensSaldoPV), "filtro preco sem elegiveis nao abre consulta").
    RUN selecao("PRECO", "TEST-KG", "", 0).
    RUN selecao("LIQUIDACAO", "TEST-KG", "A", 0).
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-KG"), "elegibilidade preco/liquidacao aplicada").
    /* Exclusao fiscal, sem alterar documentos de outra filial. */
    FIND FIRST ems2med.nota-fiscal.
    ems2med.nota-fiscal.dt-confirma = TODAY.
    RELEASE ems2med.nota-fiscal.
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.buscarPI = NO ttFiltroSaldoPV.considerarWeb = NO
        ttFiltroSaldoPV.itemIni = "TEST-KG" ttFiltroSaldoPV.itemFim = "TEST-KG".
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    FIND FIRST ttSaldoPV.
    RUN checar(ttSaldoPV.qtNFAberta = 0, "NF confirmada nao desconta").
    FIND FIRST ems2med.nota-fiscal.
    ASSIGN ems2med.nota-fiscal.dt-confirma = ? ems2med.nota-fiscal.dt-cancela = TODAY.
    RELEASE ems2med.nota-fiscal.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    FIND FIRST ttSaldoPV.
    RUN checar(ttSaldoPV.qtNFAberta = 0, "NF cancelada nao desconta").
    FIND FIRST ems2med.nota-fiscal.
    ems2med.nota-fiscal.dt-cancela = ?.
    RELEASE ems2med.nota-fiscal.
    CREATE ems2med.natur-oper.
    ASSIGN ems2med.natur-oper.nat-operacao = "MAE" ems2med.natur-oper.nat-vinculada = "VENDA".
    RELEASE ems2med.natur-oper.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    FIND FIRST ttSaldoPV.
    RUN checar(ttSaldoPV.qtNFAberta = 0, "natureza vinculada nao desconta").
    /* Regras comprovadas nos helpers IOL, coletados somente leitura. */
    CREATE ems2med.item.
    ASSIGN ems2med.item.it-codigo = "TEST-NOEXT" ems2med.item.un = "KG"
        ems2med.item.ge-codigo = 50.
    RELEASE ems2med.item.
    CREATE ems2med.item.
    ASSIGN ems2med.item.it-codigo = "TEST-GE49" ems2med.item.un = "KG"
        ems2med.item.ge-codigo = 49.
    RELEASE ems2med.item.
    CREATE espec.item-ext.
    ASSIGN espec.item-ext.it-codigo = "TEST-GE49" espec.item-ext.gramatura = 150.
    RELEASE espec.item-ext.
    RUN parametros.
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-NOEXT"), "PHP exige extensao mesmo sem gramatura").
    RUN checar(NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-GE49"), "PHP restringe grupos50a60").
    FIND FIRST espec.pp-container.
    ASSIGN espec.pp-container.log_rota_indefinida = YES espec.pp-container.num_origem = 1.
    RELEASE espec.pp-container.
    CREATE espec.pp-container.
    ASSIGN espec.pp-container.nr-container = 78 espec.pp-container.situacao = 1
        espec.pp-container.cod-estabel = "5" espec.pp-container.exclusivo = NO
        espec.pp-container.num_origem = 1 espec.pp-container.log_rota_indefinida = NO.
    RELEASE espec.pp-container.
    CREATE espec.pp-it-container.
    ASSIGN espec.pp-it-container.nr-container = 78 espec.pp-it-container.it-codigo = "TEST-KG"
        espec.pp-it-container.cod-refer = "A" espec.pp-it-container.qt-pedida = 30
        espec.pp-it-container.perc-dsp-venda = 100 espec.pp-it-container.qt-vendida = 0
        espec.pp-it-container.cod_estab_definido = "99".
    RELEASE espec.pp-it-container.
    RUN web(7, 8, "6", 78, "TEST-KG", "A", "OUTRO", 4).
    RUN web(8, 5, "6", 78, "TEST-KG", "A", "OUTRO", 1).
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.buscarPE = NO ttFiltroSaldoPV.representante = 10.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    FIND FIRST ttSaldoPV NO-ERROR.
    RUN checar(AVAILABLE ttSaldoPV, "PI agrupado retorna linha").
    IF AVAILABLE ttSaldoPV THEN DO:
        RUN checar(ttSaldoPV.codEstab = "5", "PI usa estabelecimento do cabecalho").
        RUN checar(ttSaldoPV.nrContainer = 0 AND ttSaldoPV.qtDisponibilizada = 80,
            "PI nivel item agrega containers por estabelecimento").
        RUN checar(ttSaldoPV.qtCarrinho = 6 AND ttSaldoPV.qtNaoIntegrada = 4,
            "PI estados8e5 e reservas sem filtro estabelecimento como helper").
        RUN checar(ttSaldoPV.qtSaldoVenda = 63, "PI agregado liquido 80-7-6-4").
    END.
    ttFiltroSaldoPV.containerADefinir = 1.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    RUN checar(NOT CAN-FIND(ttSaldoPV WHERE origem = "PE"), "container a definir suprime PE").
    RUN checar(CAN-FIND(FIRST ttSaldoPV), "container a definir resolvido sem TT externa").
    ttFiltroSaldoPV.containerADefinir = 0.
    ttFiltroSaldoPV.estabADefinir = 1.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    RUN checar(CAN-FIND(ttSaldoPV WHERE nrContainer = 77)
        AND NOT CAN-FIND(ttSaldoPV WHERE nrContainer = 78), "a definir usa rota indefinida e nao campo do item").
    /* Precos e liquidacao agora resolvidos internamente por tabelas/parametros. */
    CREATE espec.controle_preco.
    ASSIGN espec.controle_preco.it_codigo = "TEST-KG" espec.controle_preco.tb_preco_id = 2
        espec.controle_preco.tp_preco = 1 espec.controle_preco.dt_inicial = TODAY
        espec.controle_preco.dt_final = TODAY espec.controle_preco.log_vencido = NO.
    RELEASE espec.controle_preco.
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.buscarPI = NO ttFiltroSaldoPV.considerarWeb = NO
        ttFiltroSaldoPV.filtroTabelaPreco = YES ttFiltroSaldoPV.tabelaPreco = 2.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-KG")
        AND NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-MT"), "preco ativo seleciona item internamente").
    CREATE espec.liquida-ima.
    ASSIGN espec.liquida-ima.it-codigo = "TEST-MT" espec.liquida-ima.dt-inicio = TODAY
        espec.liquida-ima.dt-final = ?.
    RELEASE espec.liquida-ima.
    ttFiltroSaldoPV.filtroTabelaPreco = NO.
    ttFiltroSaldoPV.soLiquidacao = YES.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-MT")
        AND NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-KG"), "liquidacao vigente com fim aberto resolvida internamente").
    /* O PHP usa locais por empresa sem filtrar datas/grupo/login. */
    CREATE espec.locais_estoq_portal.
    ASSIGN espec.locais_estoq_portal.cod_empresa = "5" espec.locais_estoq_portal.cod_estab = "5"
        espec.locais_estoq_portal.cod_depos = "OUT" espec.locais_estoq_portal.cod_usuario = "OUTRO"
        espec.locais_estoq_portal.cod_grupo_usuario = "9"
        espec.locais_estoq_portal.dt_hora_inicio = NOW - 2000
        espec.locais_estoq_portal.dt_hora_fim = NOW - 1000.
    RELEASE espec.locais_estoq_portal.
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.buscarPI = NO ttFiltroSaldoPV.considerarWeb = NO
        ttFiltroSaldoPV.itemIni = "TEST-KG" ttFiltroSaldoPV.itemFim = "TEST-KG".
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    FIND FIRST ttSaldoPV.
    RUN checar(ttSaldoPV.qtFisica = 190, "locais seguem filtro empresa do PHP sem filtros inventados").
    /* Tipo3/4 ignora minimo e mantem linhas do item; total usa qualificadas. */
    ttFiltroSaldoPV.minimoKG = 200.
    ttFiltroSaldoPV.tipoUsuario = 3.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(FIRST ttItensSaldoPV), "tipo3 acesso geral ignora minimo").
    /* Resultado do filtrarPorQt: conserva detalhe e repete total por item. */
    RUN saldoFisico("5", "ARM", "TEST-KG", "C", 20).
    ttFiltroSaldoPV.minimoKG = 100.
    ttFiltroSaldoPV.tipoUsuario = 0.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    FIND ttSaldoPV WHERE codRefer = "C" NO-ERROR.
    RUN checar(AVAILABLE ttSaldoPV, "minimo conserva referencia baixa de item com linha aprovada").
    IF AVAILABLE ttSaldoPV THEN RUN checar(NOT ttSaldoPV.aprovadoQuantidade
        AND ttSaldoPV.qtSaldoVenda = 20 AND ttSaldoPV.qtSaldoItem = 180,
        "linha bruta20 e total legado180 em campos separados").
    FIND ttItensSaldoPV WHERE ttItensSaldoPV.itCodigo = "TEST-KG".
    RUN checar(ttItensSaldoPV.qtSaldoPE = 180, "total do item nao multiplica valor repetido nem inclui linha reprovada").
    /* Parametro IMA muda selecao imediatamente na MESMA instancia persistente. */
    CREATE espec.im-param.
    ASSIGN espec.im-param.cod-param = "buscar_preco_tb_liquida_ima" espec.im-param.val-param = "0".
    RELEASE espec.im-param.
    CREATE espec.controle_preco.
    ASSIGN espec.controle_preco.it_codigo = "TEST-KG" espec.controle_preco.tb_preco_id = 2
        espec.controle_preco.tp_preco = 3 espec.controle_preco.dt_inicial = TODAY
        espec.controle_preco.dt_final = TODAY espec.controle_preco.log_vencido = NO.
    RELEASE espec.controle_preco.
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.buscarPI = NO ttFiltroSaldoPV.considerarWeb = NO
        ttFiltroSaldoPV.soLiquidacao = YES ttFiltroSaldoPV.tabelaPreco = 2.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-KG")
        AND NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-MT"), "liquidacao usa controle_preco quando parametro0").
    FIND espec.im-param WHERE espec.im-param.cod-param = "buscar_preco_tb_liquida_ima".
    espec.im-param.val-param = "1".
    RELEASE espec.im-param.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-MT")
        AND NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-KG"), "parametro1 sem cache troca para liquida-ima").
    /* O helper de precoERP sempre retorna array, inclusive quando log_achou=0. */
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.buscarPI = NO ttFiltroSaldoPV.considerarWeb = NO
        ttFiltroSaldoPV.filtroTabelaPreco = YES ttFiltroSaldoPV.tabelaPreco = 1.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-KG")
        AND CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-MT"), "tabela1 ERP preserva is_array do helper mesmo sem preco").
    CREATE espec.im-param.
    ASSIGN espec.im-param.cod-param = "buscar_preco_tb_erp" espec.im-param.val-param = "0".
    RELEASE espec.im-param.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(NOT CAN-FIND(FIRST ttItensSaldoPV), "parametroERP0 consulta controle_preco e nao inventa elegibilidade").
    /* Bloqueio gerencial e excecao dos containers considerados a definir. */
    CREATE espec.usuarios_grupos.
    ASSIGN espec.usuarios_grupos.login_usuario = "EU" espec.usuarios_grupos.cod_grupo = 5.
    RELEASE espec.usuarios_grupos.
    FIND espec.pp-container WHERE espec.pp-container.nr-container = 77.
    espec.pp-container.log-1 = YES.
    RELEASE espec.pp-container.
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.buscarPE = NO ttFiltroSaldoPV.tipoUsuario = 3 ttFiltroSaldoPV.representante = 10.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    FIND FIRST ttSaldoPV.
    RUN checar(ttSaldoPV.qtDisponibilizada = 30, "grupo5/tipo3 exclui container log1").
    ttFiltroSaldoPV.containerADefinir = 1.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    FIND FIRST ttSaldoPV.
    RUN checar(ttSaldoPV.qtDisponibilizada = 50, "containers considerados removem somente bloqueio gerencial").
    /* Unidades conforme getQtMinimaItem: M e MT; MTS cai no default0. */
    FIND ems2med.item WHERE ems2med.item.it-codigo = "TEST-MT".
    ems2med.item.un = "M".
    RELEASE ems2med.item.
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.buscarPI = NO ttFiltroSaldoPV.considerarWeb = NO
        ttFiltroSaldoPV.itemIni = "TEST-MT" ttFiltroSaldoPV.itemFim = "TEST-MT" ttFiltroSaldoPV.minimoMT = 31.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(NOT CAN-FIND(FIRST ttItensSaldoPV), "unidadeM aplica minimoMT").
    FIND ems2med.item WHERE ems2med.item.it-codigo = "TEST-MT".
    ems2med.item.un = "MTS".
    RELEASE ems2med.item.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(FIRST ttItensSaldoPV), "unidadeMTS preserva default0 do helper").
    /* Selecao de tabela de preco e tabela de liquidacao sao parametros distintos. */
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.buscarPI = NO ttFiltroSaldoPV.considerarWeb = NO
        ttFiltroSaldoPV.filtroTabelaPreco = YES ttFiltroSaldoPV.tabelaPreco = 3
        ttFiltroSaldoPV.tabelaPrecoFiltro = 2.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-KG"), "tabelaFiltro2 independe tabelaSelecionada3").
    /* PI nivel referencia nao agrega linhas fisicas de mesma chave. */
    CREATE espec.pp-it-container.
    ASSIGN espec.pp-it-container.nr-container = 78 espec.pp-it-container.it-codigo = "TEST-KG"
        espec.pp-it-container.cod-refer = "A" espec.pp-it-container.qt-pedida = 30
        espec.pp-it-container.perc-dsp-venda = 100 espec.pp-it-container.qt-vendida = 0.
    RELEASE espec.pp-it-container.
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.buscarPE = NO ttFiltroSaldoPV.considerarWeb = NO
        ttFiltroSaldoPV.selecaoContainersAtiva = YES ttFiltroSaldoPV.minimoKG = 40.
    RUN selecao("CONTAINER", "", "", 78).
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(NOT CAN-FIND(FIRST ttItensSaldoPV), "PI duas linhas30 nao viram60 antes de minimo40").
    /* Pesquisa pagina: codigos exatos, listas e descricao em palavras. */
    FIND ems2med.item WHERE ems2med.item.it-codigo = "TEST-KG".
    ems2med.item.desc-item = "CAMBRAIA TESTE BRANCO".
    RELEASE ems2med.item.
    FIND ems2med.item WHERE ems2med.item.it-codigo = "TEST-MT".
    ems2med.item.desc-item = "CAMBRAIA TESTE PRETO".
    RELEASE ems2med.item.
    RUN parametros.
    ttFiltroSaldoPV.pesquisaItem = "CAMBRAIA".
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-KG")
        AND CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-MT"), "pesquisa descricao inclui ambos itens").
    ttFiltroSaldoPV.pesquisaItem = "BRANCO CAMBRAIA".
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-KG")
        AND NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-MT"), "palavras descricao em qualquer ordem comAND").
    ttFiltroSaldoPV.pesquisaItem = "CAMBR_IA BRAN%".
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-KG")
        AND NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-MT"), "pesquisa preserva curingas LIKE do PHP").
    CREATE ems2med.item.
    ASSIGN ems2med.item.it-codigo = "123" ems2med.item.fm-codigo = "F1" ems2med.item.ge-codigo = 50.
    CREATE espec.item-ext.
    espec.item-ext.it-codigo = "123".
    CREATE ems2med.item.
    ASSIGN ems2med.item.it-codigo = "00123" ems2med.item.fm-codigo = "F1" ems2med.item.ge-codigo = 50.
    CREATE espec.item-ext.
    espec.item-ext.it-codigo = "00123".
    RELEASE ems2med.item.
    RELEASE espec.item-ext.
    ttFiltroSaldoPV.pesquisaItem = "123".
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "123")
        AND NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "00123"), "codigo numerico exato sem remover zeros").
    ttFiltroSaldoPV.pesquisaItem = " 00123 , CAMBRAIA PRETO ".
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "00123")
        AND CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-MT")
        AND NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "123"), "lista mistura codigo e descricao comOR").
    ttFiltroSaldoPV.pesquisaItem = "123,00123,123".
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "123")
        AND CAN-FIND(ttItensSaldoPV WHERE itCodigo = "00123")
        AND NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-KG"), "lista numerica sem duplicidade e sem residuos de texto").
    RUN parametros.
    ASSIGN ttFiltroSaldoPV.pesquisaItem = "CAMBRAIA" ttFiltroSaldoPV.familiaIni = "F2" ttFiltroSaldoPV.familiaFim = "F2".
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-MT")
        AND NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-KG"), "pesquisa preserva outros filtros de propriedades").
    /* De/para somente na etapa1 vazia, todas as palavras de uma vez. */
    CREATE espec.estoque_termo_busca.
    ASSIGN espec.estoque_termo_busca.termo_digitado = "CAMBRAYA"
        espec.estoque_termo_busca.termo_pesquisa = "CAMBRAIA" espec.estoque_termo_busca.ativo = YES.
    CREATE espec.estoque_termo_busca.
    ASSIGN espec.estoque_termo_busca.termo_digitado = "CAIMAN"
        espec.estoque_termo_busca.termo_pesquisa = "CAYMAN" espec.estoque_termo_busca.ativo = YES.
    CREATE espec.estoque_termo_busca.
    ASSIGN espec.estoque_termo_busca.termo_digitado = "ELASTANO"
        espec.estoque_termo_busca.termo_pesquisa = "ELAST." espec.estoque_termo_busca.ativo = YES.
    RELEASE espec.estoque_termo_busca.
    FIND ems2med.item WHERE ems2med.item.it-codigo = "TEST-MT".
    ems2med.item.desc-item = "CAMBRAIA CAYMAN ELAST. TESTE PRETO".
    RELEASE ems2med.item.
    FIND ems2med.item WHERE ems2med.item.it-codigo = "TEST-KG".
    /* Se o ponto de ELAST. virar curinga, este item seria incluido por engano. */
    ems2med.item.desc-item = "CAMBRAIA CAYMAN ELASTX TESTE BRANCO".
    RELEASE ems2med.item.
    RUN parametros.
    ttFiltroSaldoPV.pesquisaItem = "cambraya caiman elastano".
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-MT")
        AND NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-KG"), "depara tres palavras simultaneas").
    RUN checar(ttFiltroSaldoPV.pesquisaItem = "cambraya caiman elastano", "preserva texto do chamador").
    FIND ems2med.item WHERE ems2med.item.it-codigo = "TEST-KG".
    ems2med.item.desc-item = "CAMBRAYA CAIMAN ELASTANO".
    RELEASE ems2med.item.
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-KG")
        AND NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-MT"), "resultado normal impede depara").
    /* Regra invalida comprova que o cadastro nem e lido quando ha candidato. */
    CREATE espec.estoque_termo_busca.
    ASSIGN espec.estoque_termo_busca.termo_digitado = "SC-INVALIDA"
        espec.estoque_termo_busca.termo_pesquisa = "" espec.estoque_termo_busca.ativo = YES.
    RELEASE espec.estoque_termo_busca.
    /* Selecionado original e excluido somente na etapa3: nao buscar corrigido. */
    ttFiltroSaldoPV.minimoKG = 999999.
    ttFiltroSaldoPV.minimoMT = 999999.
    RUN configurar.
    RUN exec IN hBo NO-ERROR.
    RUN checar(NOT ERROR-STATUS:ERROR, "cadastro nao lido se etapa1 encontra candidato mesmo com minimo posterior").
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(NOT CAN-FIND(FIRST ttItensSaldoPV), "minimo posterior nao reabre pesquisa").
    FIND espec.estoque_termo_busca WHERE termo_digitado = "SC-INVALIDA".
    DELETE espec.estoque_termo_busca.
    FIND ems2med.item WHERE ems2med.item.it-codigo = "TEST-KG".
    ems2med.item.desc-item = "CAMBRAIA TESTE BRANCO".
    RELEASE ems2med.item.
    RUN parametros.
    ttFiltroSaldoPV.pesquisaItem = "CAMBRAYA PRETO".
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-MT"), "corrige uma palavra e preserva outra").
    ttFiltroSaldoPV.pesquisaItem = "CAIMAN ELASTANO".
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-MT"), "corrige duas palavras").
    FIND espec.estoque_termo_busca WHERE termo_digitado = "CAIMAN".
    espec.estoque_termo_busca.ativo = NO.
    RELEASE espec.estoque_termo_busca.
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(NOT CAN-FIND(FIRST ttItensSaldoPV), "regra inativa nao participa").
    FIND ems2med.item WHERE ems2med.item.it-codigo = "TEST-MT".
    ems2med.item.desc-item = "CAMBRAIA TESTE PRETO".
    RELEASE ems2med.item.
    FOR EACH espec.estoque_termo_busca: DELETE espec.estoque_termo_busca. END.
    /* Entradas e ordem das fases. */
    EMPTY TEMP-TABLE ttFiltroSaldoPV.
    CREATE ttFiltroSaldoPV.
    RUN checar(ttFiltroSaldoPV.exibirAmbosSaldos, "modo pagina ambos saldos e o padrao").
    RUN parametros.
    RUN checar(ttFiltroSaldoPV.itemIni = "" AND ttFiltroSaldoPV.itemFim = "zzzzzzzzzzzzzz"
        AND ttFiltroSaldoPV.familiaIni = "" AND ttFiltroSaldoPV.familiaFim = "zzzzzzzzzzzzzz",
        "defaults item/familia de vazio a14z").
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-KG")
        AND CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-MT"), "faixas padrao incluem ambos itens").
    RUN parametros.
    ASSIGN ttFiltroSaldoPV.itemIni = "TEST-MT" ttFiltroSaldoPV.itemFim = ""
        ttFiltroSaldoPV.familiaFim = "".
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-MT")
        AND NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-KG"), "fim vazio normaliza e inicio item e inclusivo").
    RUN parametros.
    ttFiltroSaldoPV.familiaFim = "F1".
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-KG")
        AND NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-MT"), "fim familia inclusivo").
    RUN parametros.
    ASSIGN ttFiltroSaldoPV.familiaIni = "F2" ttFiltroSaldoPV.familiaFim = "".
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-MT")
        AND NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-KG"), "fim familia vazio e inicio inclusivo").
    /* Limite real de14z: nao e um infinito textual. */
    CREATE ems2med.item.
    ASSIGN ems2med.item.it-codigo = "zzzzzzzzzzzzzz" ems2med.item.fm-codigo = "F1"
        ems2med.item.ge-codigo = 50.
    CREATE espec.item-ext.
    espec.item-ext.it-codigo = "zzzzzzzzzzzzzz".
    CREATE ems2med.item.
    ASSIGN ems2med.item.it-codigo = "zzzzzzzzzzzzzzz" ems2med.item.fm-codigo = "F1"
        ems2med.item.ge-codigo = 50.
    CREATE espec.item-ext.
    espec.item-ext.it-codigo = "zzzzzzzzzzzzzzz".
    CREATE ems2med.item.
    ASSIGN ems2med.item.it-codigo = "TEST-LIM-FAMILIA" ems2med.item.fm-codigo = "zzzzzzzzzzzzzzz"
        ems2med.item.ge-codigo = 50.
    CREATE espec.item-ext.
    espec.item-ext.it-codigo = "TEST-LIM-FAMILIA".
    RELEASE ems2med.item.
    RELEASE espec.item-ext.
    RUN parametros.
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "zzzzzzzzzzzzzz"), "14z e incluido no limite superior").
    RUN checar(NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "zzzzzzzzzzzzzzz"), "item acima14z excluido por padrao").
    RUN checar(NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-LIM-FAMILIA"), "familia acima14z excluida por padrao").
    RUN parametros.
    ASSIGN ttFiltroSaldoPV.itemFim = "zzzzzzzzzzzzzzz"
        ttFiltroSaldoPV.familiaFim = "zzzzzzzzzzzzzzz".
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "zzzzzzzzzzzzzzz")
        AND CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-LIM-FAMILIA"), "fim explicito pode ultrapassar padrao14z").
    RUN parametros.
    ASSIGN ttFiltroSaldoPV.itemIni = "TEST-KG" ttFiltroSaldoPV.itemFim = "TEST-KG"
        ttFiltroSaldoPV.familiaIni = "F2" ttFiltroSaldoPV.familiaFim = "F2".
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(NOT CAN-FIND(FIRST ttItensSaldoPV), "caminho item preserva intersecao de familia").
    RUN parametros.
    ASSIGN ttFiltroSaldoPV.unidade = "MTS" ttFiltroSaldoPV.pesoLiquidoIni = 4
        ttFiltroSaldoPV.pesoLiquidoFim = 4.
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-MT")
        AND NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "TEST-KG"), "caminho grupo preserva unidade e peso inclusivo").
    RUN parametros.
    ASSIGN ttFiltroSaldoPV.familiaIni = "F2" ttFiltroSaldoPV.familiaFim = "F2"
        ttFiltroSaldoPV.pesoLiquidoFim = 2.
    RUN configurar.
    RUN selecionarItens IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(NOT CAN-FIND(FIRST ttItensSaldoPV), "caminho familia preserva peso maximo").
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    /* Fluxo interno: minimo por linha, sem excecao de usuario. */
    FIND ems2med.item WHERE ems2med.item.it-codigo = "TEST-MT".
    ems2med.item.un = "M".
    RELEASE ems2med.item.
    RUN saldoFisico("5", "ARM", "TEST-MT", "DET-NEG", 1).
    RUN web(901, 1, "5", 0, "TEST-MT", "DET-NEG", "EU", 2).
    ASSIGN ttFiltroSaldoPV.itemIni = "TEST-MT" ttFiltroSaldoPV.itemFim = "TEST-MT"
        ttFiltroSaldoPV.consultaReferencias = YES ttFiltroSaldoPV.tipoUsuario = 4
        ttFiltroSaldoPV.exibirAmbosSaldos = YES ttFiltroSaldoPV.buscarPI = NO
        ttFiltroSaldoPV.minimoMT = 2.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    RUN checar(CAN-FIND(FIRST ttSaldoPV WHERE codRefer = "A" AND qtSaldoVenda = 30), "detalhe mantem referencia acima do minimo").
    RUN checar(NOT CAN-FIND(FIRST ttSaldoPV WHERE codRefer = "DET-NEG"), "detalhe minimo exclui negativo mesmo tipo4").
    RUN checar(NOT CAN-FIND(FIRST ttSaldoPV WHERE origem = "PI"), "detalhe somente origem selecionada").
    ttFiltroSaldoPV.minimoMT = 0.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    RUN checar(CAN-FIND(FIRST ttSaldoPV WHERE codRefer = "DET-NEG" AND qtSaldoVenda = -1 AND qtSaldoItem = -1), "detalhe minimo zero preserva negativo e saldo individual").
    ASSIGN ttFiltroSaldoPV.minimoMT = 31.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(NOT CAN-FIND(FIRST ttItensSaldoPV), "detalhe remove item sem referencia aprovada tipo4").
    ASSIGN ttFiltroSaldoPV.minimoMT = 0 ttFiltroSaldoPV.selecaoReferenciasAtiva = YES.
    RUN selecao("REF", "DET-NEG", "", 0).
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    RUN checar(CAN-FIND(FIRST ttSaldoPV WHERE codRefer = "DET-NEG")
        AND NOT CAN-FIND(FIRST ttSaldoPV WHERE codRefer = "A"), "detalhe aceita filtro interno de referencia").
    ASSIGN ttFiltroSaldoPV.maximoMT = 0 ttFiltroSaldoPV.selecaoReferenciasAtiva = NO.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    RUN checar(CAN-FIND(FIRST ttSaldoPV WHERE codRefer = "DET-NEG")
        AND NOT CAN-FIND(FIRST ttSaldoPV WHERE codRefer = "A"), "detalhe maximo aplicado por linha").
    RUN parametros.
    ASSIGN ttFiltroSaldoPV.consultaReferencias = YES ttFiltroSaldoPV.tipoUsuario = 4
        ttFiltroSaldoPV.exibirAmbosSaldos = YES ttFiltroSaldoPV.buscarPE = NO
        ttFiltroSaldoPV.considerarWeb = NO ttFiltroSaldoPV.minimoKG = 31
        ttFiltroSaldoPV.selecaoContainersAtiva = YES.
    RUN selecao("CONTAINER", "", "", 78).
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    RUN checar(NOT CAN-FIND(FIRST ttSaldoPV), "detalhe PI duas linhas30 nao somam60 para minimo31 tipo4").
    ttFiltroSaldoPV.minimoKG = 30.
    RUN configurar.
    RUN exec IN hBo.
    RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
    linhasDetalhe = 0.
    FOR EACH ttSaldoPV WHERE origem = "PI" AND codRefer = "A" AND qtSaldoVenda = 30:
        linhasDetalhe = linhasDetalhe + 1.
    END.
    RUN checar(linhasDetalhe = 2, "detalhe PI preserva linhas fisicas e igualdade ao minimo").
    RUN checar(NOT CAN-FIND(FIRST ttSaldoPV WHERE origem = "PE"), "detalhe somentePI nao exibe PE").
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ttFiltroSaldoPV.situacoesNaoIntegradas = "1,2".
    RUN configurar.
    RUN exec IN hBo NO-ERROR.
    RUN checar(ERROR-STATUS:ERROR, "sobreposicao de estados rejeitada").
    EMPTY TEMP-TABLE ttFiltroSaldoPV.
    RUN configurar.
    RUN exec IN hBo NO-ERROR.
    RUN checar(ERROR-STATUS:ERROR, "zero criterios rejeitado").
    CREATE ttFiltroSaldoPV.
    CREATE ttFiltroSaldoPV.
    RUN configurar.
    RUN exec IN hBo NO-ERROR.
    RUN checar(ERROR-STATUS:ERROR, "multiplos criterios rejeitados").
    RUN parametros.
    RUN configurar.
    RUN preencherSaldos IN hBo NO-ERROR.
    RUN checar(ERROR-STATUS:ERROR, "etapa2 sem etapa1 rejeitada").
    RUN filtrarSaldos IN hBo NO-ERROR.
    RUN checar(ERROR-STATUS:ERROR, "etapa3 sem etapa2 rejeitada").
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.itemIni = "Z" ttFiltroSaldoPV.itemFim = "A".
    RUN configurar.
    RUN exec IN hBo NO-ERROR.
    RUN checar(ERROR-STATUS:ERROR, "faixa invertida rejeitada").
    RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
    RUN checar(NOT CAN-FIND(FIRST ttItensSaldoPV), "erro nao expoe resultado anterior").
    UNDO, LEAVE.
END.
IF VALID-HANDLE(hBo) THEN DELETE PROCEDURE hBo.
PUT UNFORMATTED (IF lFalhou THEN "FAIL" ELSE "PASS") " checks=" n SKIP.
OUTPUT CLOSE.
IF lFalhou THEN RETURN ERROR "FAIL BoSaldoPV".

PROCEDURE checar:
    DEFINE INPUT PARAMETER ok AS LOGICAL NO-UNDO.
    DEFINE INPUT PARAMETER rotulo AS CHARACTER NO-UNDO.
    n = n + 1.
    IF ok <> TRUE OR ok = ? THEN DO:
        lFalhou = TRUE.
        PUT UNFORMATTED "FAIL " rotulo SKIP.
    END.
END PROCEDURE.
PROCEDURE selecao:
    DEFINE INPUT PARAMETER tipo AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER cod AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER ref AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER num AS INTEGER NO-UNDO.
    CREATE ttSelecaoSaldoPV.
    ASSIGN ttSelecaoSaldoPV.tipo = tipo ttSelecaoSaldoPV.codigo = cod
        ttSelecaoSaldoPV.codigo2 = ref ttSelecaoSaldoPV.numero = num.
    RELEASE ttSelecaoSaldoPV.
END PROCEDURE.
PROCEDURE parametros:
    EMPTY TEMP-TABLE ttFiltroSaldoPV.
    EMPTY TEMP-TABLE ttSelecaoSaldoPV.
    CREATE ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.login = "EU" ttFiltroSaldoPV.exibirAmbosSaldos = NO.
END PROCEDURE.
PROCEDURE configurar:
    RUN setParametros IN hBo(INPUT TABLE ttFiltroSaldoPV).
    RUN setSelecoes IN hBo(INPUT TABLE ttSelecaoSaldoPV).
END PROCEDURE.
PROCEDURE saldoFisico:
    DEFINE INPUT PARAMETER est AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER dep AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER item AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER ref AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER qt AS DECIMAL NO-UNDO.
    CREATE ems2med.saldo-estoq.
    ASSIGN ems2med.saldo-estoq.cod-estabel = est ems2med.saldo-estoq.cod-depos = dep
        ems2med.saldo-estoq.it-codigo = item ems2med.saldo-estoq.cod-refer = ref
        ems2med.saldo-estoq.lote = ref ems2med.saldo-estoq.qtidade-atu = qt.
    RELEASE ems2med.saldo-estoq.
END PROCEDURE.
PROCEDURE web:
    DEFINE INPUT PARAMETER id AS INTEGER NO-UNDO.
    DEFINE INPUT PARAMETER sit AS INTEGER NO-UNDO.
    DEFINE INPUT PARAMETER est AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER cont AS INTEGER NO-UNDO.
    DEFINE INPUT PARAMETER item AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER ref AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER login AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER qt AS DECIMAL NO-UNDO.
    CREATE espec.peds_web.
    ASSIGN espec.peds_web.ped_web_id = id espec.peds_web.ind_sit_ped_web = sit
        espec.peds_web.cod_estabel = est espec.peds_web.nr_container = cont
        espec.peds_web.login = login.
    CREATE espec.itens_ped_web.
    ASSIGN espec.itens_ped_web.ped_web_id = id espec.itens_ped_web.it_codigo = item
        espec.itens_ped_web.cod_refer = ref espec.itens_ped_web.qt_pedida = qt.
    RELEASE espec.peds_web.
    RELEASE espec.itens_ped_web.
END PROCEDURE.

