PROCEDURE SelectionRootTests:
 RUN Fixture. selectionLookup=TRUE. RUN Invoke.
 RUN Check(result:GetLogical('success') AND NOT result:Has('audit') AND NOT result:Has('committed'),'selection lookup produces only read result').
 RUN Check(quoteCalls=0 AND seq=1000 AND logCalls=0,'selection lookup consumes no quote/ID/business log').
 result:WriteFile('selection-root-options.json',TRUE).
 RUN Fixture. selectionLookup=FALSE. hb[1]:FIND-FIRST(). hb[1]:BUFFER-FIELD('cod-estabel'):BUFFER-VALUE='101'.
 hb[2]:FIND-FIRST(). hb[2]:BUFFER-FIELD('cod_emp_ems2'):BUFFER-VALUE=1. RUN Invoke.
 RUN Check(NOT result:GetLogical('success') AND result:GetJsonObject('error'):GetCharacter('code')='CONTAINER_PROCESS_MED_REQUIRED','selection root revalidates MED under lock').
 RUN Check(quoteCalls=0 AND seq=1000 AND logCalls=0,'wrong MED ownership has no effects').
END PROCEDURE.
