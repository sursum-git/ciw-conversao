BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE parser AS ObjectModelParser NO-UNDO.
DEFINE VARIABLE lcValue AS LONGCHAR NO-UNDO.
DEFINE VARIABLE fixture AS JsonObject NO-UNDO.
DEFINE VARIABLE casesValue AS JsonArray NO-UNDO.
DEFINE VARIABLE rowsValue AS JsonArray NO-UNDO.
DEFINE VARIABLE caseValue AS JsonObject NO-UNDO.
DEFINE VARIABLE rowValue AS JsonObject NO-UNDO.
DEFINE VARIABLE expectedValue AS JsonObject NO-UNDO.
DEFINE VARIABLE actualValue AS JsonObject NO-UNDO.
DEFINE VARIABLE responseValue AS JsonObject NO-UNDO.
DEFINE VARIABLE names AS CHARACTER EXTENT NO-UNDO.
DEFINE VARIABLE i AS INTEGER NO-UNDO.
DEFINE VARIABLE j AS INTEGER NO-UNDO.
DEFINE VARIABLE k AS INTEGER NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE fixturePath AS CHARACTER NO-UNDO.
OUTPUT TO 'comparison-sql-observed-tests.log'.
DO ON ERROR UNDO, THROW:
 RUN Check(NUM-DBS=0,'zero databases').
 FIX-CODEPAGE(lcValue)='UTF-8'.
 fixturePath=SEARCH('sql-observed-v2.json').
 IF fixturePath=? THEN UNDO,THROW NEW Progress.Lang.AppError('Closed synthetic fixture unavailable',1).
 COPY-LOB FROM FILE fixturePath TO lcValue.
 parser=NEW ObjectModelParser(). fixture=CAST(parser:Parse(lcValue),JsonObject).
 casesValue=fixture:GetJsonArray('cases').
 DO i=1 TO casesValue:Length:
  caseValue=casesValue:GetJsonObject(i). rowsValue=caseValue:GetJsonArray('rows').
  DO j=1 TO rowsValue:Length:
   rowValue=rowsValue:GetJsonObject(j).
   RUN VALUE('ContainersVersionComparisonProjection.p')(rowValue:GetJsonObject('input'),OUTPUT responseValue).
   IF rowValue:GetLogical('success') THEN DO:
    RUN Check(responseValue:GetLogical('success'),caseValue:GetCharacter('case') + ' SQL successful case').
    expectedValue=rowValue:GetJsonObject('expected'). actualValue=responseValue:GetJsonObject('data'). names=expectedValue:GetNames().
    DO k=1 TO EXTENT(names):
     IF expectedValue:IsNull(names[k]) THEN RUN Check(actualValue:IsNull(names[k]),names[k] + ' logical NULL').
     ELSE RUN Check(NOT actualValue:IsNull(names[k]) AND ROUND(actualValue:GetDecimal(names[k]),rowValue:GetJsonObject('sqlObservedScales'):GetInteger(names[k]))=expectedValue:GetDecimal(names[k]),names[k] + ' observed SQL scale only').
    END.
   END.
   ELSE DO:
    RUN Check(NOT responseValue:GetLogical('success') AND responseValue:GetJsonObject('error'):GetCharacter('code')='COMPARISON_ZERO_DIVISOR',caseValue:GetCharacter('case') + ' rejected SQL divisor').
    RUN Check(NOT responseValue:Has('data'),'no partial financial projection').
   END.
  END.
 END.
 RUN Check(NOT TRANSACTION,'no transaction').
 PUT UNFORMATTED 'PASS ' checks ' checks' SKIP.
 CATCH err AS Progress.Lang.Error: PUT UNFORMATTED 'FAIL checks=' checks ' test=' err:GetMessage(1) SKIP. END CATCH.
END.
OUTPUT CLOSE. QUIT.
PROCEDURE Check:
 DEFINE INPUT PARAMETER okValue AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER labelValue AS CHARACTER NO-UNDO.
 checks=checks + 1. IF okValue<>TRUE OR okValue=? THEN UNDO,THROW NEW Progress.Lang.AppError(labelValue,1).
END PROCEDURE.
