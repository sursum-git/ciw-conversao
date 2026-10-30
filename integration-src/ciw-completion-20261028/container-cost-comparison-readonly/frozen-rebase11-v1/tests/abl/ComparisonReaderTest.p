BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
{ContainersVersionComparisonTable.i}
DEFINE VARIABLE requestValue AS JsonObject NO-UNDO.
DEFINE VARIABLE responseValue AS JsonObject NO-UNDO.
DEFINE VARIABLE filterValue AS JsonObject NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE keyValue AS CHARACTER NO-UNDO.
OUTPUT TO 'comparison-reader-tests.log'.
DO ON ERROR UNDO, THROW:
 RUN Check(NUM-DBS=0,'zero databases').
 DO n=1 TO 205:
  CREATE ttVersionComparison. ASSIGN ttVersionComparison.container_id=123 ttVersionComparison.versao_id=7
   ttVersionComparison.item_container_custo_id=1000 + n ttVersionComparison.item_container_id=42
   ttVersionComparison.codigo_erp=IF n=205 THEN 'BAD' ELSE 'SYNTHETIC' ttVersionComparison.vl_unit_prev=12.
  RELEASE ttVersionComparison.
 END.
 RUN Request('read'). requestValue:Add('take',200). RUN Invoke.
 RUN Check(responseValue:GetLogical('success'),'new reader resource supported').
 RUN Check(responseValue:GetInteger('total')=205 AND responseValue:GetJsonArray('data'):Length=200,'page200 and full total').
 keyValue=responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('record_key').
 RUN Check(NOT responseValue:GetJsonArray('data'):GetJsonObject(1):Has('projection_error'),'private error never exposed').
 responseValue:WriteFile('comparison-reader-actual.json',TRUE).
 RUN Request('get'). requestValue:Add('id',keyValue). requestValue:Add('record_key',keyValue). RUN Invoke.
 RUN Check(responseValue:GetLogical('success'),'get exact opaque key').
 requestValue:Set('record_key',keyValue + ' '). RUN Invoke.
 RUN Check(NOT responseValue:GetLogical('success'),'get alias raw exact').
 FIND ttVersionComparison WHERE ttVersionComparison.item_container_custo_id=1205.
 ASSIGN ttVersionComparison.projection_error='COMPARISON_ZERO_DIVISOR' ttVersionComparison.vl_unit_sem_distr_custo=?. RELEASE ttVersionComparison.
 RUN Request('read'). requestValue:Add('take',1). RUN Invoke.
 RUN Check(responseValue:GetJsonObject('error'):GetCharacter('code')='COMPARISON_ZERO_DIVISOR','matching error after page still refuses entire query').
 RUN Check(NOT responseValue:Has('data'),'error no partial page').
 RUN Request('read'). filterValue=NEW JsonObject(). filterValue:Add('field','codigo_erp'). filterValue:Add('operator','neq'). filterValue:Add('value','BAD'). requestValue:Add('filter',filterValue). RUN Invoke.
 RUN Check(responseValue:GetLogical('success') AND responseValue:GetInteger('total')=204,'raw filter excludes bad row before projection refusal').
 RUN Request('get'). requestValue:Add('id',keyValue). RUN Invoke.
 RUN Check(responseValue:GetLogical('success'),'get good row excludes unrelated zero divisor').
 RUN Request('read'). filterValue=NEW JsonObject(). filterValue:Add('field','vl_unit_sem_distr_custo'). filterValue:Add('operator','isnotnull'). requestValue:Add('filter',filterValue). RUN Invoke.
 RUN Check(NOT responseValue:GetLogical('success') AND responseValue:GetJsonObject('error'):GetCharacter('code')='COMPARISON_DERIVED_FILTER_UNPROVEN','derived predicate cannot hide deferred error as NULL').
 RUN Check(NOT responseValue:Has('data'),'derived ambiguity no partial data').
 RUN Check(NUM-DBS=0,'zero databases after').
 PUT UNFORMATTED 'PASS ' checks ' checks' SKIP.
 CATCH err AS Progress.Lang.Error: PUT UNFORMATTED 'FAIL checks=' checks ' errorNumber=' err:GetMessageNum(1) SKIP. END CATCH.
END.
OUTPUT CLOSE. QUIT.
PROCEDURE Request:
 DEFINE INPUT PARAMETER opValue AS CHARACTER NO-UNDO.
 requestValue=NEW JsonObject(). requestValue:Add('operation',opValue).
END PROCEDURE.
PROCEDURE Invoke:
 RUN VALUE('CiwErpReadService.p')(INPUT BUFFER ttVersionComparison:HANDLE,INPUT 'container_custos_comparacao_real',INPUT '',INPUT requestValue,OUTPUT responseValue).
END PROCEDURE.
PROCEDURE Check:
 DEFINE INPUT PARAMETER okValue AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER labelValue AS CHARACTER NO-UNDO.
 checks=checks + 1.
 IF okValue<>TRUE OR okValue=? THEN UNDO,THROW NEW Progress.Lang.AppError(labelValue,1).
END PROCEDURE.
