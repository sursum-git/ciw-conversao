USING Progress.Json.ObjectModel.*.
BLOCK-LEVEL ON ERROR UNDO,THROW.
DEFINE VARIABLE q AS JsonObject NO-UNDO.
DEFINE VARIABLE r AS JsonObject NO-UNDO.
DEFINE VARIABLE cWp AS CHARACTER NO-UNDO.
DEFINE VARIABLE iChecks AS INTEGER NO-UNDO.
DEFINE VARIABLE iCount AS INTEGER NO-UNDO.
DEFINE BUFFER bWp FOR espec.wp.
DEFINE BUFFER bRow FOR espec.wp_nota_fiscal.
IF NUM-DBS<>1 OR INDEX(PDBNAME(1),"consulta-notas-fixture")=0 THEN
    UNDO,THROW NEW Progress.Lang.AppError("Fixture exclusiva obrigatoria",1).
DO ON ERROR UNDO,THROW:
    RUN tests/ConsultaNotasFixtureSetup.p.
    RUN Sentinel.
    q=NEW JsonObject(). q:Add("login","SC_TEST_API_NF"). q:Add("empresa","MED").
    q:Add("estabIni","5"). q:Add("estabFim","5").
    q:Add("represIni",8). q:Add("represFim",8).
    RUN http-api/api_cons_nota_fiscal_wp.p(q,OUTPUT r).
    RUN Check(r:GetLogical("success"),"API com chamador real").
    RUN Check(r:GetInteger("total")=2 AND r:GetInteger("inserted")=2,"nota e devolucao persistidas com escopo tipo2 sobrepondo faixa informada").
    cWp=r:GetCharacter("codWp").
    FIND FIRST bWp NO-LOCK WHERE bWp.cod_wp=cWp.
    RUN Check(bWp.login="SC_TEST_API_NF" AND bWp.tabela="wp_nota_fiscal","cabecalho e autoria informada").
    FIND FIRST bRow NO-LOCK WHERE bRow.cod_wp=cWp AND bRow.tipo_nota=22.
    RUN Check(bRow.nr_nota_fis="000900" AND bRow.cod_emitente=100 AND bRow.cod_repres=7
              AND bRow.vl_nota=200 AND bRow.vl_desconto=25 AND bRow.vl_bruto=225,"venda no WP").
    RUN Check(bRow.nr_pedcli="123" AND bRow.preposto="PREPOSTO" AND bRow.dt_emis_nota=DATE(1,10,2026),"contexto venda no WP").
    FIND FIRST bRow NO-LOCK WHERE bRow.cod_wp=cWp AND bRow.tipo_nota=20.
    RUN Check(bRow.nr_nota_fis="000010" AND bRow.nr_nota_fis_original=900 AND bRow.vl_nota=-100
              AND bRow.vl_desconto=-25 AND bRow.vl_bruto=-125,"devolucao no WP").
    RUN Check(bRow.dt_emis_nota=DATE(1,15,2026) AND bRow.preposto="PREPOSTO" AND bRow.cod_emitente=100,"emissao da devolucao persistida").
    RUN Preservado.
    /* Numero fracionario e rejeitado antes da persistencia. */
    q:Remove("represIni"). q:Add("represIni",7.2).
    RUN http-api/api_cons_nota_fiscal_wp.p(q,OUTPUT r).
    RUN Check(NOT r:GetLogical("success") AND NOT r:Has("codWp"),"parametro invalido nao produz pesquisa").
    q:Remove("represIni").
    RUN Contagens(2,3).
    /* Campo original CHAR do ERP nao representavel no INT fisico: rollback. */
    RUN OriginalAlfanumerica.
    RUN http-api/api_cons_nota_fiscal_wp.p(q,OUTPUT r).
    RUN Check(NOT r:GetLogical("success") AND NOT r:Has("codWp") AND INDEX(r:GetCharacter("error"),"nf-original")>0,"rollback real apos linha anterior valida").
    RUN Contagens(2,3).
    RUN Preservado.
    FINALLY:
        RELEASE bWp. RELEASE bRow.
        RUN Limpar.
    END FINALLY.
END.
OUTPUT TO VALUE("consulta-api-real-" + SESSION:NUMERIC-FORMAT + ".log").
PUT UNFORMATTED "PASS " iChecks " checks" SKIP.
OUTPUT CLOSE.

PROCEDURE Sentinel:
    DO TRANSACTION:
        CREATE espec.wp. ASSIGN espec.wp.cod_wp="SC_TEST_EXISTING_NF" espec.wp.login="OUTRO" espec.wp.tabela="SENTINEL".
        CREATE espec.wp_nota_fiscal. ASSIGN espec.wp_nota_fiscal.cod_wp="SC_TEST_EXISTING_NF"
            espec.wp_nota_fiscal.tipo_nota=22 espec.wp_nota_fiscal.nr_nota_fis="PRESERVAR" espec.wp_nota_fiscal.vl_nota=111.
    END.
END PROCEDURE.
PROCEDURE Preservado:
    RUN Check(CAN-FIND(FIRST bWp WHERE bWp.cod_wp="SC_TEST_EXISTING_NF" AND bWp.login="OUTRO" AND bWp.tabela="SENTINEL"),"cabecalho anterior preservado").
    RUN Check(CAN-FIND(FIRST bRow WHERE bRow.cod_wp="SC_TEST_EXISTING_NF" AND bRow.nr_nota_fis="PRESERVAR" AND bRow.vl_nota=111),"linha anterior preservada").
END PROCEDURE.
PROCEDURE Contagens:
    DEFINE INPUT PARAMETER piWp AS INTEGER NO-UNDO.
    DEFINE INPUT PARAMETER piLinhas AS INTEGER NO-UNDO.
    iCount=0. FOR EACH bWp NO-LOCK: iCount=iCount + 1. END.
    RUN Check(iCount=piWp,"cabecalhos apos erro").
    iCount=0. FOR EACH bRow NO-LOCK: iCount=iCount + 1. END.
    RUN Check(iCount=piLinhas,"linhas apos erro").
END PROCEDURE.
PROCEDURE OriginalAlfanumerica:
    DO TRANSACTION:
        FIND FIRST devolfixture.nota-fiscal EXCLUSIVE-LOCK.
        devolfixture.nota-fiscal.nr-nota-fis="ORIGINAL-A".
        FIND FIRST devolfixture.devol-cli EXCLUSIVE-LOCK.
        devolfixture.devol-cli.nr-nota-fis="ORIGINAL-A".
    END.
END PROCEDURE.
PROCEDURE Limpar:
    /* Exclusivo do banco sintetico guardado no inicio; nunca publicar este teste. */
    DO TRANSACTION:
        FOR EACH espec.wp_nota_fiscal EXCLUSIVE-LOCK: DELETE espec.wp_nota_fiscal. END.
        FOR EACH espec.wp EXCLUSIVE-LOCK: DELETE espec.wp. END.
        FOR EACH devolfixture.it-nota-fisc EXCLUSIVE-LOCK: DELETE devolfixture.it-nota-fisc. END.
        FOR EACH devolfixture.nota-fiscal EXCLUSIVE-LOCK: DELETE devolfixture.nota-fiscal. END.
        FOR EACH devolfixture.docum-est EXCLUSIVE-LOCK: DELETE devolfixture.docum-est. END.
        FOR EACH devolfixture.devol-cli EXCLUSIVE-LOCK: DELETE devolfixture.devol-cli. END.
        FOR EACH devolfixture.ped-repre EXCLUSIVE-LOCK: DELETE devolfixture.ped-repre. END.
        FOR EACH devolfixture.ped-venda EXCLUSIVE-LOCK: DELETE devolfixture.ped-venda. END.
        FOR EACH devolfixture.ped-venda-ext EXCLUSIVE-LOCK: DELETE devolfixture.ped-venda-ext. END.
        FOR EACH devolfixture.natur-oper EXCLUSIVE-LOCK: DELETE devolfixture.natur-oper. END.
        FOR EACH devolfixture.user-web EXCLUSIVE-LOCK: DELETE devolfixture.user-web. END.
        FOR EACH devolfixture.repres EXCLUSIVE-LOCK: DELETE devolfixture.repres. END.
        FOR EACH devolfixture.cod-rejeicao EXCLUSIVE-LOCK: DELETE devolfixture.cod-rejeicao. END.
    END.
END PROCEDURE.
PROCEDURE Check:
    DEFINE INPUT PARAMETER plOk AS LOGICAL NO-UNDO.
    DEFINE INPUT PARAMETER pcMsg AS CHARACTER NO-UNDO.
    IF plOk<>TRUE OR plOk=? THEN UNDO,THROW NEW Progress.Lang.AppError("FAIL " + pcMsg,1).
    iChecks=iChecks + 1.
END PROCEDURE.
