BLOCK-LEVEL ON ERROR UNDO, THROW.
{esapi/consulta-notas/ttFiltroDevolucoes.i}
{esbo/boConsNotaFiscal.i}
DEFINE VARIABLE iChecks AS INTEGER NO-UNDO.
DEFINE VARIABLE iTotal AS INTEGER NO-UNDO.
DEFINE VARIABLE hBo AS HANDLE NO-UNDO.
DEFINE VARIABLE cItem AS CHARACTER NO-UNDO.
IF NUM-DBS <> 1 OR INDEX(PDBNAME(1), "consulta-notas-fixture") = 0 THEN
    UNDO, THROW NEW Progress.Lang.AppError("Fixture exclusiva obrigatoria",1).

DO TRANSACTION ON ERROR UNDO, THROW:
    {tests/ConsultaNotasFixtureSetup.i}
    CREATE ttFiltroDevolucoes.
    ASSIGN ttFiltroDevolucoes.empresa="MED" ttFiltroDevolucoes.estabel-de="5" ttFiltroDevolucoes.estabel-ate="5".
    RUN Consultar(2).
    FIND FIRST tt-NF WHERE tt-NF.tipo-nota=22.
    RUN Check(tt-NF.nf="000900" AND tt-NF.vl-nota=200 AND tt-NF.vl-desconto=25 AND tt-NF.vl-bruto=225,"venda e desconto legado por item").
    RUN Check(tt-NF.cod-emitente=100 AND tt-NF.cod-rep=7 AND tt-NF.nr-pedcli="123" AND tt-NF.preposto="PREPOSTO","metadados venda").
    RUN Check(tt-NF.perc-comis=5 AND tt-NF.nf-original="" AND tt-NF.dt-emis-nota=DATE(1,10,2026),"comissao e emissao venda").
    FIND FIRST tt-NF WHERE tt-NF.tipo-nota=20.
    RUN Check(tt-NF.nf="000010" AND tt-NF.nf-original="000900" AND tt-NF.vl-nota=-100 AND tt-NF.vl-desconto=-25,"origem e valores devolucao").
    RUN Check(tt-NF.cod-emitente=100 AND tt-NF.cod-rep=7 AND tt-NF.preposto="PREPOSTO" AND tt-NF.nr-pedcli="123","metadados devolucao").
    RUN Check(tt-NF.data=DATE(1,16,2026) AND tt-NF.dt-emis-nota=DATE(1,15,2026),"emissao distinta de movimento").
    ASSIGN ttFiltroDevolucoes.emissao-de=DATE(1,15,2026) ttFiltroDevolucoes.emissao-ate=DATE(1,15,2026).
    RUN Consultar(1).
    ASSIGN ttFiltroDevolucoes.emissao-de=? ttFiltroDevolucoes.emissao-ate=?
           ttFiltroDevolucoes.nota-de="000900" ttFiltroDevolucoes.nota-ate="000900".
    RUN Consultar(1).
    devolfixture.nota-fiscal.dt-cancela=TODAY. VALIDATE devolfixture.nota-fiscal. RUN Consultar(0).
    devolfixture.nota-fiscal.dt-cancela=?. devolfixture.nota-fiscal.idi-sit-nf-eletro=4. VALIDATE devolfixture.nota-fiscal. RUN Consultar(0).
    devolfixture.nota-fiscal.idi-sit-nf-eletro=1. VALIDATE devolfixture.nota-fiscal.
    ASSIGN ttFiltroDevolucoes.nota-de="" ttFiltroDevolucoes.nota-ate="" ttFiltroDevolucoes.representante-de=8 ttFiltroDevolucoes.representante-ate=9.
    RUN Consultar(0).
    ASSIGN ttFiltroDevolucoes.representante-de=? ttFiltroDevolucoes.representante-ate=?
           ttFiltroDevolucoes.pedido-de="124" ttFiltroDevolucoes.pedido-ate="999".
    RUN Consultar(0).
    RUN esbo/boConsNotaFiscal.p PERSISTENT SET hBo.
    RUN iniciarBo IN hBo. RUN setEmpresa IN hBo("MED").
    RUN setNumeroPedido IN hBo(700). RUN setRepres IN hBo("REP TESTE").
    RUN exec IN hBo(OUTPUT TABLE tt-NF).
    RUN Check(CAN-FIND(FIRST tt-NF WHERE tt-NF.nf="000900"),"setters originais pedido interno e nome representante").
    RUN setNumeroPedido IN hBo(123). RUN exec IN hBo(OUTPUT TABLE tt-NF).
    RUN Check(NOT CAN-FIND(FIRST tt-NF),"pedido interno nao confundido com nr-pedcli").
    RUN finalizarBo IN hBo.
    RUN Check(NOT VALID-HANDLE(hBo),"BO notas liberada").
    UNDO, LEAVE.
    FINALLY: IF VALID-HANDLE(hBo) THEN DELETE PROCEDURE hBo. END FINALLY.
END.
OUTPUT TO VALUE("consulta-integration-" + SESSION:NUMERIC-FORMAT + ".log").
PUT UNFORMATTED "PASS " iChecks " checks" SKIP.
OUTPUT CLOSE.

PROCEDURE Consultar:
    DEFINE INPUT PARAMETER piTotal AS INTEGER NO-UNDO.
    RUN esapi/consulta-notas/ConsultarNotasFiscais.p(INPUT TABLE ttFiltroDevolucoes,OUTPUT TABLE tt-NF).
    iTotal=0. FOR EACH tt-NF: iTotal=iTotal + 1. END.
    RUN Check(iTotal=piTotal,"agregacao: esperado " + STRING(piTotal) + " obtido " + STRING(iTotal)).
END PROCEDURE.
PROCEDURE Check:
    DEFINE INPUT PARAMETER plOk AS LOGICAL NO-UNDO.
    DEFINE INPUT PARAMETER pcMsg AS CHARACTER NO-UNDO.
    IF plOk<>TRUE OR plOk=? THEN UNDO,THROW NEW Progress.Lang.AppError("FAIL " + pcMsg,1).
    iChecks=iChecks + 1.
END PROCEDURE.
