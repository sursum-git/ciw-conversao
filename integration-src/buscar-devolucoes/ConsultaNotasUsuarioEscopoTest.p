BLOCK-LEVEL ON ERROR UNDO, THROW.
{esapi/consulta-notas/ttFiltroDevolucoes.i}
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE failed AS LOGICAL NO-UNDO.
IF NUM-DBS <> 1 OR (INDEX(PDBNAME(1),"api-wp-escopo-20261020/scfixture") = 0
 AND INDEX(PDBNAME(1),"consulta-notas-fixture") = 0) THEN
 UNDO, THROW NEW Progress.Lang.AppError("Somente fixture isolada de escopo/consulta",0).
IF CAN-FIND(FIRST espec.user-web) OR CAN-FIND(FIRST ems2cad.repres) THEN
 UNDO, THROW NEW Progress.Lang.AppError("Fixture de escopo deve iniciar vazia",0).
/* Toda escrita e somente de teste e sera desfeita no final. */
DO TRANSACTION ON ERROR UNDO, THROW:
 CREATE ttFiltroDevolucoes.
 ASSIGN ttFiltroDevolucoes.representante-de = 11 ttFiltroDevolucoes.representante-ate = 99.
 RUN esapi/consulta-notas/ConsultaNotasUsuarioEscopo.p("NAO-CADASTRADO",INPUT-OUTPUT TABLE ttFiltroDevolucoes).
 FIND FIRST ttFiltroDevolucoes.
 RUN assert(ttFiltroDevolucoes.representante-de = 11 AND ttFiltroDevolucoes.representante-ate = 99,"usuario ausente preserva faixa").
 CREATE espec.user-web.
 ASSIGN espec.user-web.Login = "OUTRO" espec.user-web.tp-usuario = 3 espec.user-web.nome-ab-cli = "REP".
 VALIDATE espec.user-web.
 RUN esapi/consulta-notas/ConsultaNotasUsuarioEscopo.p("OUTRO",INPUT-OUTPUT TABLE ttFiltroDevolucoes).
 FIND FIRST ttFiltroDevolucoes.
 RUN assert(ttFiltroDevolucoes.representante-de = 11 AND ttFiltroDevolucoes.representante-ate = 99,"outros tipos preservam faixa").
 CREATE espec.user-web.
 ASSIGN espec.user-web.Login = "LOGIN-REP" espec.user-web.tp-usuario = 2 espec.user-web.nome-ab-cli = " REP ".
 CREATE ems2cad.repres.
 ASSIGN ems2cad.repres.nome-abrev = "REP" ems2cad.repres.cod-rep = 7.
 VALIDATE espec.user-web. VALIDATE ems2cad.repres.
 RUN esapi/consulta-notas/ConsultaNotasUsuarioEscopo.p(" LOGIN-REP ",INPUT-OUTPUT TABLE ttFiltroDevolucoes).
 FIND FIRST ttFiltroDevolucoes.
 RUN assert(ttFiltroDevolucoes.representante-de = 7 AND ttFiltroDevolucoes.representante-ate = 7,"tipo2 nome-ab-cli forca ambos limites").
 CREATE espec.user-web.
 ASSIGN espec.user-web.Login = "FALLBACK" espec.user-web.tp-usuario = 2 espec.user-web.nome-ab-cli = "".
 CREATE ems2cad.repres.
 ASSIGN ems2cad.repres.nome-abrev = "FALLBACK" ems2cad.repres.cod-rep = 8.
 VALIDATE espec.user-web. VALIDATE ems2cad.repres.
 RUN esapi/consulta-notas/ConsultaNotasUsuarioEscopo.p("FALLBACK",INPUT-OUTPUT TABLE ttFiltroDevolucoes).
 FIND FIRST ttFiltroDevolucoes.
 RUN assert(ttFiltroDevolucoes.representante-de = 8 AND ttFiltroDevolucoes.representante-ate = 8,"tipo2 fallback Login").
 CREATE espec.user-web.
 ASSIGN espec.user-web.Login = "SEM-REP" espec.user-web.tp-usuario = 2 espec.user-web.nome-ab-cli = "INEXISTENTE".
 VALIDATE espec.user-web.
 RUN esapi/consulta-notas/ConsultaNotasUsuarioEscopo.p("SEM-REP",INPUT-OUTPUT TABLE ttFiltroDevolucoes) NO-ERROR.
 failed = ERROR-STATUS:ERROR.
 RUN assert(failed,"tipo2 sem representante falha").
 FIND FIRST ttFiltroDevolucoes.
 RUN assert(ttFiltroDevolucoes.representante-de = 8 AND ttFiltroDevolucoes.representante-ate = 8,"falha nao altera filtros").
 UNDO, LEAVE.
END.
RUN assert(NOT CAN-FIND(FIRST espec.user-web) AND NOT CAN-FIND(FIRST ems2cad.repres),"rollback fixture limpa").
PUT UNFORMATTED "PASS escopo checks=" checks SKIP.
PROCEDURE assert:
 DEFINE INPUT PARAMETER ok AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER msg AS CHARACTER NO-UNDO.
 IF ok <> TRUE OR ok = ? THEN UNDO, THROW NEW Progress.Lang.AppError(msg,0).
 checks = checks + 1.
END PROCEDURE.
