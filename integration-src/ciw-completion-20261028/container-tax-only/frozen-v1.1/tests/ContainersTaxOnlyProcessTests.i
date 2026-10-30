PROCEDURE TaxOnlyRootTests:
 RUN Fixture. hb[1]:FIND-FIRST(). hb[1]:BUFFER-FIELD('cod-estabel'):BUFFER-VALUE='101'.
 hb[2]:FIND-FIRST(). hb[2]:BUFFER-FIELD('cod_emp_ems2'):BUFFER-VALUE=1.
 RUN Invoke.
 RUN Check(NOT result:GetLogical('success') AND result:GetJsonObject('error'):GetCharacter('code')='CONTAINER_PROCESS_MED_REQUIRED','tax-only validates MED under root master lock').
 RUN Check(seq=1000 AND quoteCalls=0 AND logCalls=0 AND NOT result:Has('audit'),'non-MED zero quotes/IDs/logs').
 RUN Fixture.
 DO TRANSACTION ON ERROR UNDO, THROW:
  RUN Invoke.
  RUN Check(NOT result:GetLogical('success') AND result:GetJsonObject('error'):GetInteger('status')=409,'tax-only process refuses external transaction context').
  UNDO, LEAVE.
 END.
 RUN Check(seq=1000 AND quoteCalls=0 AND logCalls=0,'external transaction refused before side effects').
 RUN Fixture. failLog=TRUE. RUN Invoke.
 RUN Check(result:GetLogical('success') AND result:GetLogical('committed'),'postcommit logger failure cannot turn confirmed process into retryable failure').
END PROCEDURE.
