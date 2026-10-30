BLOCK-LEVEL ON ERROR UNDO, THROW.
{esbo/boConsNotaFiscal.i}
DEFINE VARIABLE c AS CHARACTER NO-UNDO.
DEFINE VARIABLE keepCode AS CHARACTER NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE failed AS LOGICAL NO-UNDO.
DEFINE VARIABLE totalBefore AS INTEGER NO-UNDO.
DEFINE VARIABLE totalAfter AS INTEGER NO-UNDO.
IF NUM-DBS <> 1 OR (INDEX(PDBNAME(1),"api-wp-notas-20261020/wpfixture") = 0
 AND INDEX(PDBNAME(1),"consulta-notas-fixture") = 0) THEN
 UNDO, THROW NEW Progress.Lang.AppError("Somente fixture isolada",0).
IF CAN-FIND(FIRST espec.wp) OR CAN-FIND(FIRST espec.wp_nota_fiscal) THEN
 UNDO, THROW NEW Progress.Lang.AppError("Fixture deve iniciar vazia",0).
CREATE tt-NF.
ASSIGN tt-NF.tipo-nota = 912 tt-NF.cod-emitente = 345 tt-NF.cod-rep = 78
 tt-NF.nf = "000ABC" tt-NF.serie = "T" tt-NF.cod-estabel = "Z"
 tt-NF.nome-ab-reppri = "REP" tt-NF.dt-emis-nota = DATE(2,29,2024)
 tt-NF.data = DATE(3,1,2024) tt-NF.vl-nota = -12.34 tt-NF.vl-bruto = -15
 tt-NF.vl-desconto = -2.66 tt-NF.nf-original = "000123"
 tt-NF.nr-pedcli = "ABC-9" tt-NF.preposto = "PRE" tt-NF.cidade = "Cidade"
 tt-NF.estado = "SC" tt-NF.descr-mot-dev = "Motivo".
RUN esapi/consulta-notas/ConsultaNotasWpWriter.p(INPUT TABLE tt-NF,"TEST-WP","pagina","filtro",OUTPUT c,OUTPUT n).
keepCode = c.
RUN assert(n = 1 AND LENGTH(c) = 36,"commit and uuid").
FIND FIRST espec.wp WHERE espec.wp.cod_wp = c NO-LOCK.
RUN assert(espec.wp.login = "TEST-WP" AND espec.wp.tabela = "wp_nota_fiscal", "header").
FIND FIRST espec.wp_nota_fiscal WHERE espec.wp_nota_fiscal.cod_wp = c NO-LOCK.
RUN assert(espec.wp_nota_fiscal.tipo_nota = 912 AND espec.wp_nota_fiscal.cod_emitente = 345 AND espec.wp_nota_fiscal.cod_repres = 78,"ids copied").
RUN assert(espec.wp_nota_fiscal.dt_emis_nota = DATE(2,29,2024) AND espec.wp_nota_fiscal.vl_nota = -12.34,"explicit emission and signed amount").
RUN assert(espec.wp_nota_fiscal.nr_nota_fis_original = 123 AND espec.wp_nota_fiscal.nr_pedcli = "ABC-9","original strict int and customer order").
RUN assert(espec.wp_nota_fiscal.nr_nota_fis = "000ABC" AND espec.wp_nota_fiscal.serie = "T" AND espec.wp_nota_fiscal.cod_estabel = "Z" AND espec.wp_nota_fiscal.no_ab_reppri = "REP", "document mapping").
RUN assert(espec.wp_nota_fiscal.preposto = "PRE" AND espec.wp_nota_fiscal.cidade = "Cidade" AND espec.wp_nota_fiscal.estado = "SC" AND espec.wp_nota_fiscal.desc_devol = "Motivo" AND espec.wp_nota_fiscal.vl_bruto = -15 AND espec.wp_nota_fiscal.vl_desconto = -2.66,"remaining physical fields").
RELEASE espec.wp.
RELEASE espec.wp_nota_fiscal.
CREATE tt-NF.
ASSIGN tt-NF.tipo-nota = 913 tt-NF.nf-original = "123.7".
RUN rejected.
RUN assert(CAN-FIND(FIRST espec.wp WHERE espec.wp.cod_wp = keepCode),"preserve prior search").
FIND LAST tt-NF.
tt-NF.nf-original = "A123".
RUN rejected.
tt-NF.nf-original = "2147483648".
RUN rejected.
tt-NF.nf-original = "".
tt-NF.tipo-nota = ?.
RUN rejected.
/* A writer must refuse participation in a caller transaction. */
DO TRANSACTION:
 RUN esapi/consulta-notas/ConsultaNotasWpWriter.p(INPUT TABLE tt-NF,"TEST-WP","pagina","filtro",OUTPUT c,OUTPUT n) NO-ERROR.
 RUN assert(ERROR-STATUS:ERROR,"nested transaction refused").
END.
EMPTY TEMP-TABLE tt-NF.
RUN esapi/consulta-notas/ConsultaNotasWpWriter.p(INPUT TABLE tt-NF,"TEST-WP","pagina","filtro",OUTPUT c,OUTPUT n).
RUN assert(n = 0 AND c <> keepCode AND CAN-FIND(FIRST espec.wp WHERE espec.wp.cod_wp = c),"zero rows commits distinct header").
RUN assert(NOT CAN-FIND(FIRST espec.wp_nota_fiscal WHERE espec.wp_nota_fiscal.cod_wp = c),"zero rows creates no children").
DO TRANSACTION:
 FOR EACH espec.wp WHERE espec.wp.cod_wp = c EXCLUSIVE-LOCK: DELETE espec.wp. END.
END.
CREATE tt-NF.
ASSIGN tt-NF.tipo-nota = 914 tt-NF.nf-original = "".
RUN esapi/consulta-notas/ConsultaNotasWpWriter.p(INPUT TABLE tt-NF,"TEST-WP","pagina","filtro",OUTPUT c,OUTPUT n).
RUN assert(n = 1 AND CAN-FIND(FIRST espec.wp_nota_fiscal WHERE espec.wp_nota_fiscal.cod_wp = c AND espec.wp_nota_fiscal.nr_nota_fis_original = 0),"empty original maps to zero").
DO TRANSACTION:
 FOR EACH espec.wp_nota_fiscal WHERE espec.wp_nota_fiscal.cod_wp = c EXCLUSIVE-LOCK: DELETE espec.wp_nota_fiscal. END.
 FOR EACH espec.wp WHERE espec.wp.cod_wp = c EXCLUSIVE-LOCK: DELETE espec.wp. END.
END.
/* Only test-owned key; never cleanup by login/table or wipe other searches. */
DO TRANSACTION:
 FOR EACH espec.wp_nota_fiscal WHERE espec.wp_nota_fiscal.cod_wp = keepCode EXCLUSIVE-LOCK: DELETE espec.wp_nota_fiscal. END.
 FOR EACH espec.wp WHERE espec.wp.cod_wp = keepCode EXCLUSIVE-LOCK: DELETE espec.wp. END.
END.
RUN assert(NOT CAN-FIND(FIRST espec.wp) AND NOT CAN-FIND(FIRST espec.wp_nota_fiscal),"clean fixture").
PUT UNFORMATTED "PASS writer checks=" checks SKIP.
PROCEDURE rejected:
 totalBefore = 0.
 FOR EACH espec.wp NO-LOCK: totalBefore = totalBefore + 1. END.
 RUN esapi/consulta-notas/ConsultaNotasWpWriter.p(INPUT TABLE tt-NF,"TEST-WP","pagina","filtro",OUTPUT c,OUTPUT n) NO-ERROR.
 failed = ERROR-STATUS:ERROR.
 totalAfter = 0.
 FOR EACH espec.wp NO-LOCK: totalAfter = totalAfter + 1. END.
 RUN assert(failed AND totalAfter = totalBefore,"rollback entire search").
 totalAfter = 0.
 FOR EACH espec.wp_nota_fiscal NO-LOCK: totalAfter = totalAfter + 1. END.
 RUN assert(totalAfter = 1,"rollback all newly written rows").
END PROCEDURE.
PROCEDURE assert:
 DEFINE INPUT PARAMETER ok AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER msg AS CHARACTER NO-UNDO.
 IF ok <> TRUE OR ok = ? THEN UNDO, THROW NEW Progress.Lang.AppError(msg,0).
 checks = checks + 1.
END PROCEDURE.

