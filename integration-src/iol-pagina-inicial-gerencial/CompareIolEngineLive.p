/* Read-only differential diagnostic, real authenticated IMA scope, no HTTP route.
   Requires legacy collector in isolated staging. Never logs commercial values. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE cTables AS CHARACTER NO-UNDO INITIAL "espec.user-web,espec.usuarios_grupos,ems2cad.repres,espec.cm-hierarquia,espec.cm-ext-repres,espec.fats_repres,espec.transacoes,espec.metas_repres,espec.metas_gerencial,espec.metas_geral,espec.peds_web,ems2med.ped-venda,ems2med.ped-repre,ems2med.nota-fiscal,ems2med.natur-oper,ems2med.devol-cli,ems2med.docum-est,ems5.dia_calend_glob,espec.restrs_clientes_usuario,espec.repres_restr_cliente_usuario".
DEFINE VARIABLE hSources AS HANDLE EXTENT 20 NO-UNDO.
DEFINE VARIABLE oScope AS JsonObject NO-UNDO.
DEFINE VARIABLE oBefore AS JsonObject NO-UNDO.
DEFINE VARIABLE oAfter AS JsonObject NO-UNDO.
DEFINE VARIABLE oCheck AS JsonObject NO-UNDO.
DEFINE VARIABLE lcBefore AS LONGCHAR NO-UNDO.
DEFINE VARIABLE lcAfter AS LONGCHAR NO-UNDO.
DEFINE VARIABLE lcCheck AS LONGCHAR NO-UNDO.
DEFINE VARIABLE i AS INTEGER NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE lEqual AS LOGICAL NO-UNDO.
DEFINE VARIABLE lStable AS LOGICAL NO-UNDO.
{sursum-api/includes/parametros_ima.i}
OUTPUT TO "iol-engine-live-comparison.log".
PUT UNFORMATTED "Runtime " PROVERSION " user=tasilpar readonly legacy-v4/current-v5" SKIP.
DO ON ERROR UNDO, THROW:
 DO i=1 TO 20: CREATE BUFFER hSources[i] FOR TABLE ENTRY(i,cTables) BUFFER-NAME ("bIolCompare" + STRING(i)). END.
 RUN IolGerencialIdentityService.r("tasilpar",hSources,OUTPUT oScope).
 oScope:Add("calendar_code",buscarParametroIma("calend_global","fiscal")).
 DO n=1 TO 3:
  RUN LegacyIolGerencialCollector.r(oScope,TODAY,hSources,OUTPUT oBefore).
  RUN IolGerencialCollector.r(oScope,TODAY,hSources,OUTPUT oAfter).
  RUN LegacyIolGerencialCollector.r(oScope,TODAY,hSources,OUTPUT oCheck).
  oBefore:Write(lcBefore). oAfter:Write(lcAfter). oCheck:Write(lcCheck).
  ASSIGN lEqual=(lcBefore=lcAfter) lStable=(lcBefore=lcCheck).
  PUT UNFORMATTED "round=" n " beforeAfterEqual=" lEqual " legacyStable=" lStable SKIP.
  IF lStable AND NOT lEqual THEN UNDO, THROW NEW Progress.Lang.AppError("FAIL stable collector mismatch",1).
  DELETE OBJECT oBefore. DELETE OBJECT oAfter. DELETE OBJECT oCheck.
 END.
 IF NOT lStable OR NOT lEqual THEN UNDO, THROW NEW Progress.Lang.AppError("INCONCLUSIVE live changes",1).
 PUT UNFORMATTED "PASS live collector parity" SKIP.
 FINALLY:
  DO i=1 TO 20: IF VALID-HANDLE(hSources[i]) THEN DELETE OBJECT hSources[i]. END.
  IF VALID-OBJECT(oScope) THEN DELETE OBJECT oScope.
  OUTPUT CLOSE.
 END FINALLY.
END.
