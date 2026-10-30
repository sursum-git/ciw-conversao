/* Executar somente em banco sintetico exclusivo. Nunca publicar este runner. */
DEFINE VARIABLE i AS INTEGER NO-UNDO.
DEFINE VARIABLE j AS INTEGER NO-UNDO.
DEFINE VARIABLE k AS INTEGER NO-UNDO.
DEFINE VARIABLE c AS CHARACTER NO-UNDO.
DEFINE VARIABLE failed AS LOGICAL NO-UNDO.
DEFINE VARIABLE programs AS CHARACTER NO-UNDO INITIAL
 "esapi/consulta-notas/BuscarDevolucoes.p,esapi/consulta-notas/BuscarDevolucoesIMA.p,esapi/consulta-notas/BuscarDevolucoesMED.p,esbo/boConsDevolucoes.p,esbo/boConsNotaFiscal.p,esapi/consulta-notas/BuscarNotasFiscaisIMA.p,esapi/consulta-notas/BuscarNotasFiscaisMED.p,esapi/consulta-notas/ConsultarNotasFiscais.p,esapi/consulta-notas/ConsultaNotasJsonParser.p,esapi/consulta-notas/ConsultaNotasWpWriter.p,esapi/consulta-notas/ConsultaNotasUsuarioEscopo.p,http-api/api_cons_nota_fiscal_wp.p,BuscarDevolucoesTest.p,ConsultaNotasIntegrationTest.p,ConsultaNotasApiRealTest.p,ConsultaNotasJsonParserTest.p,ConsultaNotasWpWriterTest.p,ConsultaNotasUsuarioEscopoTest.p,tests/ConsultaNotasFixtureSetup.p".
DEFINE VARIABLE suites AS CHARACTER NO-UNDO INITIAL
 "BuscarDevolucoesTest.p,ConsultaNotasIntegrationTest.p,ConsultaNotasJsonParserTest.p,ConsultaNotasWpWriterTest.p,ConsultaNotasUsuarioEscopoTest.p,ConsultaNotasApiRealTest.p".
IF NUM-DBS<>1 OR INDEX(PDBNAME(1),"consulta-notas-fixture")=0 THEN QUIT.
CREATE ALIAS ems2med FOR DATABASE devolfixture.
CREATE ALIAS ems2ima FOR DATABASE devolfixture.
CREATE ALIAS espec FOR DATABASE devolfixture.
CREATE ALIAS ems2cad FOR DATABASE devolfixture.
OUTPUT TO "validation.log".
PUT UNFORMATTED "OpenEdge " PROVERSION SKIP.
DO i=1 TO NUM-ENTRIES(programs):
 c=ENTRY(i,programs).
 COMPILE VALUE(c) NO-ERROR.
 PUT UNFORMATTED c " COMPILER:ERROR=" COMPILER:ERROR SKIP.
 IF COMPILER:ERROR OR ERROR-STATUS:ERROR THEN failed=TRUE.
 DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END.
END.
IF NOT failed THEN DO k=1 TO 2:
 SESSION:NUMERIC-FORMAT=ENTRY(k,"AMERICAN,EUROPEAN").
 PUT UNFORMATTED "CULTURE " SESSION:NUMERIC-FORMAT SKIP.
 DO i=1 TO NUM-ENTRIES(suites):
  c=ENTRY(i,suites).
  RUN VALUE(c) NO-ERROR.
  PUT UNFORMATTED "SUITE " c " ERROR=" ERROR-STATUS:ERROR SKIP.
  IF ERROR-STATUS:ERROR THEN failed=TRUE.
  DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END.
  IF failed THEN LEAVE.
 END.
 IF CAN-FIND(FIRST devolfixture.docum-est) OR CAN-FIND(FIRST devolfixture.nota-fiscal)
 OR CAN-FIND(FIRST devolfixture.devol-cli) OR CAN-FIND(FIRST devolfixture.ped-venda)
 OR CAN-FIND(FIRST devolfixture.ped-repre) OR CAN-FIND(FIRST devolfixture.ped-venda-ext)
 OR CAN-FIND(FIRST devolfixture.natur-oper) OR CAN-FIND(FIRST devolfixture.cod-rejeicao)
 OR CAN-FIND(FIRST devolfixture.it-nota-fisc) OR CAN-FIND(FIRST devolfixture.user-web)
 OR CAN-FIND(FIRST devolfixture.repres)
 OR CAN-FIND(FIRST devolfixture.wp) OR CAN-FIND(FIRST devolfixture.wp_nota_fiscal) THEN DO:
  failed=TRUE. PUT UNFORMATTED "FAIL fixture residue" SKIP.
 END.
 ELSE PUT UNFORMATTED "CLEAN 13tables " SESSION:NUMERIC-FORMAT SKIP.
 IF failed THEN LEAVE.
END.
PUT UNFORMATTED (IF failed THEN "FAIL" ELSE "PASS") SKIP.
OUTPUT CLOSE.
QUIT.
