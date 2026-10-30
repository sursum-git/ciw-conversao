/* Public ABI unchanged. Existing callers always require their own root. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE INPUT PARAMETER phData AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phContainer AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phIds AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER poRequest AS JsonObject NO-UNDO.
DEFINE OUTPUT PARAMETER poResponse AS JsonObject NO-UNDO.
DEFINE VARIABLE servicePath AS CHARACTER NO-UNDO.
DEFINE VARIABLE errorInfo AS JsonObject NO-UNDO.
DO ON ERROR UNDO, THROW:
 servicePath=SEARCH('sursum-api/programs/CiwCotacaoHistoryParticipant.r').
 IF servicePath=? THEN servicePath=SEARCH('CiwCotacaoHistoryParticipant.r').
 IF servicePath=? THEN servicePath=SEARCH('sursum-api/programs/CiwCotacaoHistoryParticipant.p').
 IF servicePath=? THEN servicePath=SEARCH('CiwCotacaoHistoryParticipant.p').
 IF servicePath=? THEN UNDO, THROW NEW Progress.Lang.AppError('CIW_COTACAO_CONFIGURATION',1).
 RUN VALUE(servicePath)(INPUT phData,INPUT phContainer,INPUT phIds,INPUT TRUE,INPUT poRequest,OUTPUT poResponse).
 CATCH err AS Progress.Lang.Error:
  poResponse=NEW JsonObject(). errorInfo=NEW JsonObject(). errorInfo:Add('code','CIW_COTACAO_CONFIGURATION'). errorInfo:Add('status',503). errorInfo:Add('message','Cotacao indisponivel.'). poResponse:Add('success',FALSE). poResponse:Add('error',errorInfo).
 END CATCH.
END.
