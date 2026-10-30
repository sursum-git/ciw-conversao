BLOCK-LEVEL ON ERROR UNDO, THROW.
{esbo/boSaldoPV.i}
DEFINE VARIABLE sucesso AS LOGICAL NO-UNDO.
DEFINE VARIABLE mensagem AS CHARACTER NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE falhou AS LOGICAL NO-UNDO.
FUNCTION instanciasBo RETURNS INTEGER ():
    DEFINE VARIABLE proc AS HANDLE NO-UNDO.
    DEFINE VARIABLE total AS INTEGER NO-UNDO.
    proc = SESSION:FIRST-PROCEDURE.
    DO WHILE VALID-HANDLE(proc):
        IF INDEX(CAPS(proc:FILE-NAME), "BOSALDOPV") > 0 THEN total = total + 1.
        proc = proc:NEXT-SIBLING.
    END.
    RETURN total.
END FUNCTION.
IF NUM-DBS <> 1 OR INDEX(PDBNAME(1), "saldo-pv-fixture") = 0 THEN
    RETURN ERROR "Cliente exige fixture isolada".
OUTPUT TO VALUE("cliente-tests-" + SESSION:NUMERIC-FORMAT + ".log").
RUN checar(SEARCH("esbo/clienteSaldoPV.p") <> ?, "cliente disponivel").
IF falhou THEN DO:
    OUTPUT CLOSE.
    RETURN ERROR "Cliente ainda nao implementado".
END.
DO TRANSACTION ON ERROR UNDO, THROW:
    CREATE ems2med.item.
    ASSIGN ems2med.item.it-codigo = "TEST-CLIENTE" ems2med.item.desc-item = "TESTE CLIENTE SALDO"
        ems2med.item.fm-codigo = "CF" ems2med.item.ge-codigo = 50 ems2med.item.un = "M".
    CREATE espec.item-ext.
    ASSIGN espec.item-ext.it-codigo = "TEST-CLIENTE" espec.item-ext.gramatura = 100.
    CREATE espec.locais_estoq_portal.
    ASSIGN espec.locais_estoq_portal.cod_empresa = "5" espec.locais_estoq_portal.cod_estab = "5"
        espec.locais_estoq_portal.cod_depos = "CT" espec.locais_estoq_portal.dt_hora_inicio = NOW - 1000
        espec.locais_estoq_portal.dt_hora_fim = NOW + 1000.
    RUN fisico("A",100).
    RUN fisico("B",20).
    CREATE espec.pp-container.
    ASSIGN espec.pp-container.nr-container = 901 espec.pp-container.situacao = 1
        espec.pp-container.cod-estabel = "5" espec.pp-container.exclusivo = NO.
    RUN programado("A",50).
    RUN programado("B",100).
    RELEASE ems2med.item.
    RELEASE espec.item-ext.
    RELEASE espec.locais_estoq_portal.
    RELEASE espec.pp-container.

    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    RUN chamar.
    RUN checar(sucesso AND mensagem = "", "sucesso normal").
    FIND FIRST ttItensSaldoPV NO-ERROR.
    RUN checar(AVAILABLE ttItensSaldoPV, "retorna item").
    IF AVAILABLE ttItensSaldoPV THEN
        RUN checar(ttItensSaldoPV.qtSaldoPE = 120 AND ttItensSaldoPV.qtSaldoPI = 150, "delega saldos PE/PI").

    ASSIGN ttFiltroSaldoPV.selecaoReferenciasAtiva = YES ttFiltroSaldoPV.buscarPI = NO.
    RUN selecionar("REF","A","").
    RUN chamar.
    FIND FIRST ttItensSaldoPV NO-ERROR.
    RUN checar(AVAILABLE ttItensSaldoPV, "aceita selecao REF").
    IF AVAILABLE ttItensSaldoPV THEN
        RUN checar(ttItensSaldoPV.qtSaldoPE = 100 AND ttItensSaldoPV.qtSaldoPI = 50, "nao reproduz complemento PHP sem REF").

    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.consultaReferencias = YES ttFiltroSaldoPV.minimoMT = 100.
    RUN chamar.
    RUN checar(sucesso AND CAN-FIND(FIRST ttSaldoPV WHERE origem = "PE" AND codRefer = "A" AND qtSaldoVenda = 100)
        AND CAN-FIND(FIRST ttSaldoPV WHERE origem = "PI" AND codRefer = "B" AND qtSaldoVenda = 100)
        AND NOT CAN-FIND(FIRST ttSaldoPV WHERE origem = "PE" AND codRefer = "B"), "delega modo referencias e minimo inclusivo").

    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.soLiquidacao = YES ttFiltroSaldoPV.usarSelecoesEspeciais = YES.
    /* Sem LIQUIDACAO, PE nao qualifica; PI nao pode manter o item. */
    RUN chamar.
    RUN checar(sucesso AND NOT CAN-FIND(FIRST ttItensSaldoPV), "oportunidade normaliza elegibilidade somente PE").
    RUN checar(ttFiltroSaldoPV.buscarPI, "preserva criterios de entrada").
    RUN selecionar("LIQUIDACAO","TEST-CLIENTE","A").
    RUN chamar.
    FIND FIRST ttItensSaldoPV NO-ERROR.
    RUN checar(AVAILABLE ttItensSaldoPV, "oportunidade retorna PE autorizado").
    IF AVAILABLE ttItensSaldoPV THEN
        RUN checar(ttItensSaldoPV.qtSaldoPE = 100 AND ttItensSaldoPV.qtSaldoPI = 150, "origem elegivel PE ainda permite exibir PI conforme contrato BO").
    RUN esbo/clienteSaldoPV.p(INPUT TABLE ttFiltroSaldoPV BY-REFERENCE,
        INPUT TABLE ttSelecaoSaldoPV BY-REFERENCE, OUTPUT TABLE ttItensSaldoPV,
        OUTPUT TABLE ttSaldoPV, OUTPUT sucesso, OUTPUT mensagem) NO-ERROR.
    RUN checar(NOT ERROR-STATUS:ERROR AND sucesso, "aceita chamada por referencia").
    RUN checar(ttFiltroSaldoPV.buscarPI, "normalizacao nao altera entrada BY-REFERENCE").
    RUN checar(instanciasBo() = 0, "libera handle apos BY-REFERENCE").

    /* Tabela2 contem outro item, tabela1 contem o alvo: diferencia normalizacao. */
    CREATE espec.im-param.
    ASSIGN espec.im-param.cod-param = "buscar_preco_tb_liquida_ima" espec.im-param.val-param = "0".
    RELEASE espec.im-param.
    CREATE espec.controle_preco.
    ASSIGN espec.controle_preco.it_codigo = "TEST-CLIENTE" espec.controle_preco.tb_preco_id = 1
        espec.controle_preco.tp_preco = 3 espec.controle_preco.dt_inicial = TODAY
        espec.controle_preco.dt_final = TODAY espec.controle_preco.log_vencido = NO.
    RELEASE espec.controle_preco.
    CREATE espec.controle_preco.
    ASSIGN espec.controle_preco.it_codigo = "TEST-OUTRO" espec.controle_preco.tb_preco_id = 2
        espec.controle_preco.tp_preco = 3 espec.controle_preco.dt_inicial = TODAY
        espec.controle_preco.dt_final = TODAY espec.controle_preco.log_vencido = NO.
    RELEASE espec.controle_preco.
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.soLiquidacao = YES ttFiltroSaldoPV.tabelaPreco = 2.
    RUN chamar.
    RUN checar(sucesso AND CAN-FIND(FIRST ttItensSaldoPV WHERE itCodigo = "TEST-CLIENTE"), "oportunidade usa tabela1 apesar da entrada2").
    RUN checar(ttFiltroSaldoPV.tabelaPreco = 2, "preserva tabela original do chamador").

    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.buscarPE = NO ttFiltroSaldoPV.buscarPI = NO.
    RUN chamar.
    RUN rejeicao("nenhuma origem").
    ASSIGN ttFiltroSaldoPV.buscarPI = YES ttFiltroSaldoPV.soLiquidacao = YES.
    RUN chamar.
    RUN rejeicao("oportunidade sem PE").
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ttFiltroSaldoPV.gramaturaIni = 101.
    ttFiltroSaldoPV.gramaturaFim = 99.
    RUN chamar.
    RUN rejeicao("erro BO retorna status e limpa saida").
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ttFiltroSaldoPV.itemIni = "Z".
    ttFiltroSaldoPV.itemFim = "A".
    RUN chamar.
    RUN rejeicao("faixa de item invertida").
    EMPTY TEMP-TABLE ttFiltroSaldoPV.
    RUN chamar.
    RUN rejeicao("zero criterios").
    CREATE ttFiltroSaldoPV.
    CREATE ttFiltroSaldoPV.
    RUN chamar.
    RUN rejeicao("multiplos criterios").
    RUN parametros.
    FIND FIRST ttFiltroSaldoPV.
    ttFiltroSaldoPV.itemIni = "SEM-RESULTADO".
    ttFiltroSaldoPV.itemFim = "SEM-RESULTADO".
    RUN chamar.
    RUN checar(sucesso AND NOT CAN-FIND(FIRST ttItensSaldoPV) AND NOT CAN-FIND(FIRST ttSaldoPV), "consulta vazia valida tem sucesso").
    UNDO, LEAVE.
END.
PUT UNFORMATTED (IF falhou THEN "FAIL" ELSE "PASS") " checks=" n SKIP.
OUTPUT CLOSE.
IF falhou THEN RETURN ERROR "FAIL clienteSaldoPV".

PROCEDURE parametros:
    EMPTY TEMP-TABLE ttFiltroSaldoPV.
    EMPTY TEMP-TABLE ttSelecaoSaldoPV.
    CREATE ttFiltroSaldoPV.
    ASSIGN ttFiltroSaldoPV.itemIni = "TEST-CLIENTE" ttFiltroSaldoPV.itemFim = "TEST-CLIENTE"
        ttFiltroSaldoPV.considerarWeb = NO.
END PROCEDURE.
PROCEDURE chamar:
    EMPTY TEMP-TABLE ttItensSaldoPV.
    EMPTY TEMP-TABLE ttSaldoPV.
    CREATE ttItensSaldoPV.
    ttItensSaldoPV.itCodigo = "STALE".
    CREATE ttSaldoPV.
    ASSIGN ttSaldoPV.origem = "PE" ttSaldoPV.itCodigo = "STALE".
    RUN esbo/clienteSaldoPV.p(INPUT TABLE ttFiltroSaldoPV, INPUT TABLE ttSelecaoSaldoPV,
        OUTPUT TABLE ttItensSaldoPV, OUTPUT TABLE ttSaldoPV, OUTPUT sucesso, OUTPUT mensagem) NO-ERROR.
    RUN checar(NOT ERROR-STATUS:ERROR, "cliente retorna status sem propagar erro").
    RUN checar(NOT CAN-FIND(ttItensSaldoPV WHERE itCodigo = "STALE")
        AND NOT CAN-FIND(FIRST ttSaldoPV WHERE itCodigo = "STALE"), "saida nao conserva dados anteriores").
    RUN checar(instanciasBo() = 0, "libera handle em sucesso e erro").
END PROCEDURE.
PROCEDURE rejeicao:
    DEFINE INPUT PARAMETER rotulo AS CHARACTER NO-UNDO.
    RUN checar(NOT sucesso AND mensagem <> "" AND NOT CAN-FIND(FIRST ttItensSaldoPV)
        AND NOT CAN-FIND(FIRST ttSaldoPV), rotulo).
END PROCEDURE.
PROCEDURE selecionar:
    DEFINE INPUT PARAMETER tipo AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER cod AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER ref AS CHARACTER NO-UNDO.
    CREATE ttSelecaoSaldoPV.
    ASSIGN ttSelecaoSaldoPV.tipo = tipo ttSelecaoSaldoPV.codigo = cod ttSelecaoSaldoPV.codigo2 = ref.
END PROCEDURE.
PROCEDURE fisico:
    DEFINE INPUT PARAMETER ref AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER qt AS DECIMAL NO-UNDO.
    CREATE ems2med.saldo-estoq.
    ASSIGN ems2med.saldo-estoq.it-codigo = "TEST-CLIENTE" ems2med.saldo-estoq.cod-estabel = "5"
        ems2med.saldo-estoq.cod-depos = "CT" ems2med.saldo-estoq.cod-refer = ref
        ems2med.saldo-estoq.lote = ref ems2med.saldo-estoq.qtidade-atu = qt.
    RELEASE ems2med.saldo-estoq.
END PROCEDURE.
PROCEDURE programado:
    DEFINE INPUT PARAMETER ref AS CHARACTER NO-UNDO.
    DEFINE INPUT PARAMETER qt AS DECIMAL NO-UNDO.
    CREATE espec.pp-it-container.
    ASSIGN espec.pp-it-container.it-codigo = "TEST-CLIENTE" espec.pp-it-container.nr-container = 901
        espec.pp-it-container.cod-refer = ref espec.pp-it-container.qt-pedida = qt
        espec.pp-it-container.perc-dsp-venda = 100 espec.pp-it-container.qt-vendida = 0.
    RELEASE espec.pp-it-container.
END PROCEDURE.
PROCEDURE checar:
    DEFINE INPUT PARAMETER ok AS LOGICAL NO-UNDO.
    DEFINE INPUT PARAMETER texto AS CHARACTER NO-UNDO.
    n = n + 1.
    IF ok <> TRUE OR ok = ? THEN DO:
        falhou = TRUE.
        PUT UNFORMATTED "FAIL " texto SKIP.
    END.
END PROCEDURE.

