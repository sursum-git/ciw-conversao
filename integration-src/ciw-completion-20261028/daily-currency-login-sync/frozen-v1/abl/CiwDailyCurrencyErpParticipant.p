/* Private typed participant. Caller owns root transaction and all commit claims.
   EMS2 INSERT is deliberately gated pending literal SQL-array proof. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE INPUT PARAMETER phEms2 AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phEms5 AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER pdRunDate AS DATE NO-UNDO.
DEFINE INPUT PARAMETER pdValue AS DECIMAL NO-UNDO.
DEFINE INPUT PARAMETER pdtUpdatedAt AS DATETIME NO-UNDO.
DEFINE OUTPUT PARAMETER poResponse AS JsonObject NO-UNDO.
DEFINE VARIABLE e2 AS HANDLE NO-UNDO.
DEFINE VARIABLE e5 AS HANDLE NO-UNDO.
DEFINE VARIABLE query2 AS HANDLE NO-UNDO.
DEFINE VARIABLE query5 AS HANDLE NO-UNDO.
DEFINE VARIABLE periodValue AS CHARACTER NO-UNDO.
DEFINE VARIABLE chosen2 AS ROWID NO-UNDO.
DEFINE VARIABLE reads AS INTEGER NO-UNDO.
DEFINE VARIABLE startMs AS INTEGER NO-UNDO.
DEFINE VARIABLE slotValue AS INTEGER NO-UNDO.
DEFINE TEMP-TABLE ttSeen NO-UNDO FIELD kindValue AS CHARACTER INDEX pk IS UNIQUE kindValue.
DEFINE VARIABLE completed AS LOGICAL NO-UNDO.
DEFINE VARIABLE beforeValue AS JsonObject NO-UNDO.
DEFINE VARIABLE afterValue AS JsonObject NO-UNDO.
DEFINE VARIABLE changes AS JsonArray NO-UNDO.
DEFINE VARIABLE errorInfo AS JsonObject NO-UNDO.
DEFINE VARIABLE errorCode AS CHARACTER NO-UNDO.
FUNCTION Failed RETURNS LOGICAL ():
 DEFINE VARIABLE messageIndex AS INTEGER NO-UNDO.
 DO messageIndex=1 TO ERROR-STATUS:NUM-MESSAGES:
  IF ERROR-STATUS:GET-NUMBER(messageIndex)<>565 THEN RETURN TRUE.
 END.
 RETURN FALSE.
END FUNCTION.
FUNCTION Snapshot RETURNS JsonObject (bufferValue AS HANDLE):
 DEFINE VARIABLE resultValue AS JsonObject NO-UNDO.
 DEFINE VARIABLE arrayValue AS JsonArray NO-UNDO.
 DEFINE VARIABLE fieldValue AS HANDLE NO-UNDO.
 DEFINE VARIABLE fieldIndex AS INTEGER NO-UNDO.
 DEFINE VARIABLE extentIndex AS INTEGER NO-UNDO.
 DEFINE VARIABLE fieldName AS CHARACTER NO-UNDO.
 resultValue=NEW JsonObject().
 DO fieldIndex=1 TO bufferValue:NUM-FIELDS:
  fieldValue=bufferValue:BUFFER-FIELD(fieldIndex). fieldName=fieldValue:NAME.
  IF fieldValue:EXTENT>0 THEN DO:
   arrayValue=NEW JsonArray().
   DO extentIndex=1 TO fieldValue:EXTENT:
    IF fieldValue:BUFFER-VALUE(extentIndex)=? THEN arrayValue:AddNull().
    ELSE CASE fieldValue:DATA-TYPE:
     WHEN 'DECIMAL' THEN arrayValue:Add(DECIMAL(fieldValue:BUFFER-VALUE(extentIndex))).
     WHEN 'CHARACTER' THEN arrayValue:Add(STRING(fieldValue:BUFFER-VALUE(extentIndex))).
     OTHERWISE RUN Fail('DAILY_CURRENCY_ERP_SHAPE',503).
    END CASE.
   END.
   resultValue:Add(fieldName,arrayValue).
  END.
  ELSE IF fieldValue:BUFFER-VALUE=? THEN resultValue:AddNull(fieldName).
  ELSE CASE fieldValue:DATA-TYPE:
   WHEN 'INTEGER' THEN resultValue:Add(fieldName,INTEGER(fieldValue:BUFFER-VALUE)).
   WHEN 'DECIMAL' THEN resultValue:Add(fieldName,DECIMAL(fieldValue:BUFFER-VALUE)).
   WHEN 'CHARACTER' THEN resultValue:Add(fieldName,STRING(fieldValue:BUFFER-VALUE)).
   WHEN 'LOGICAL' THEN resultValue:Add(fieldName,LOGICAL(fieldValue:BUFFER-VALUE)).
   WHEN 'DATE' THEN resultValue:Add(fieldName,ISO-DATE(DATE(fieldValue:BUFFER-VALUE))).
   OTHERWISE RUN Fail('DAILY_CURRENCY_ERP_SHAPE',503).
  END CASE.
 END.
 RETURN resultValue.
END FUNCTION.
PROCEDURE AddChange:
 DEFINE INPUT PARAMETER resourceValue AS CHARACTER NO-UNDO.
 DEFINE INPUT PARAMETER operationValue AS CHARACTER NO-UNDO.
 DEFINE VARIABLE changeValue AS JsonObject NO-UNDO.
 DEFINE VARIABLE keyValue AS JsonObject NO-UNDO.
 keyValue=NEW JsonObject().
 IF resourceValue='comum.cotacao' THEN DO:
  keyValue:Add('mo-codigo',3). keyValue:Add('ano-periodo',periodValue).
 END.
 ELSE DO:
  keyValue:Add('cod_indic_econ_base','real'). keyValue:Add('cod_indic_econ_idx','dolar').
  keyValue:Add('ind_tip_cotac_parid',e5:BUFFER-FIELD('ind_tip_cotac_parid'):BUFFER-VALUE).
  keyValue:Add('dat_cotac_indic_econ',ISO-DATE(pdRunDate)).
 END.
 changeValue=NEW JsonObject(). changeValue:Add('resource',resourceValue). changeValue:Add('operation',operationValue).
 changeValue:Add('key',keyValue). changeValue:Add('before',beforeValue). changeValue:Add('after',afterValue). changes:Add(changeValue).
END PROCEDURE.
DO ON ERROR UNDO, THROW:
 IF NOT TRANSACTION THEN RUN Fail('DAILY_CURRENCY_ROOT_TRANSACTION_REQUIRED',409).
 IF pdRunDate=? OR pdRunDate<>TODAY OR pdValue=? OR pdValue<=0 OR ROUND(pdValue,5)<>pdValue
  OR pdtUpdatedAt=? OR DATE(pdtUpdatedAt)<>pdRunDate THEN RUN Fail('DAILY_CURRENCY_ERP_REQUEST',422).
 RUN Shape(INPUT phEms2,INPUT 18).
 RUN FieldShape(INPUT phEms2,INPUT 'mo-codigo',INPUT 'INTEGER',INPUT 0).
 RUN FieldShape(INPUT phEms2,INPUT 'ano-periodo',INPUT 'CHARACTER',INPUT 0).
 RUN FieldShape(INPUT phEms2,INPUT 'cotacao',INPUT 'DECIMAL',INPUT 31).
 RUN FieldShape(INPUT phEms2,INPUT 'cota-mensal',INPUT 'DECIMAL',INPUT 0).
 RUN FieldShape(INPUT phEms2,INPUT 'cota-media',INPUT 'DECIMAL',INPUT 0).
 RUN FieldShape(INPUT phEms2,INPUT 'usuario',INPUT 'CHARACTER',INPUT 31).
 RUN FieldShape(INPUT phEms2,INPUT 'char-1',INPUT 'CHARACTER',INPUT 0).
 RUN FieldShape(INPUT phEms2,INPUT 'char-2',INPUT 'CHARACTER',INPUT 0).
 RUN FieldShape(INPUT phEms2,INPUT 'dec-1',INPUT 'DECIMAL',INPUT 0).
 RUN FieldShape(INPUT phEms2,INPUT 'dec-2',INPUT 'DECIMAL',INPUT 0).
 RUN FieldShape(INPUT phEms2,INPUT 'int-1',INPUT 'INTEGER',INPUT 0).
 RUN FieldShape(INPUT phEms2,INPUT 'int-2',INPUT 'INTEGER',INPUT 0).
 RUN FieldShape(INPUT phEms2,INPUT 'log-1',INPUT 'LOGICAL',INPUT 0).
 RUN FieldShape(INPUT phEms2,INPUT 'log-2',INPUT 'LOGICAL',INPUT 0).
 RUN FieldShape(INPUT phEms2,INPUT 'data-1',INPUT 'DATE',INPUT 0).
 RUN FieldShape(INPUT phEms2,INPUT 'data-2',INPUT 'DATE',INPUT 0).
 RUN FieldShape(INPUT phEms2,INPUT 'var-periodo',INPUT 'DECIMAL',INPUT 0).
 RUN FieldShape(INPUT phEms2,INPUT 'check-sum',INPUT 'CHARACTER',INPUT 0).
 RUN Shape(INPUT phEms5,INPUT 20).
 RUN FieldShape(INPUT phEms5,INPUT 'cod_indic_econ_base',INPUT 'CHARACTER',INPUT 0).
 RUN FieldShape(INPUT phEms5,INPUT 'cod_indic_econ_idx',INPUT 'CHARACTER',INPUT 0).
 RUN FieldShape(INPUT phEms5,INPUT 'dat_cotac_indic_econ',INPUT 'DATE',INPUT 0).
 RUN FieldShape(INPUT phEms5,INPUT 'val_cotac_indic_econ',INPUT 'DECIMAL',INPUT 0).
 RUN FieldShape(INPUT phEms5,INPUT 'ind_tip_cotac_parid',INPUT 'CHARACTER',INPUT 0).
 RUN FieldShape(INPUT phEms5,INPUT 'log_cotac_gerad_autom',INPUT 'LOGICAL',INPUT 0).
 RUN FieldShape(INPUT phEms5,INPUT 'cod_usuar_ult_atualiz',INPUT 'CHARACTER',INPUT 0).
 RUN FieldShape(INPUT phEms5,INPUT 'dat_ult_atualiz',INPUT 'DATE',INPUT 0).
 RUN FieldShape(INPUT phEms5,INPUT 'hra_ult_atualiz',INPUT 'CHARACTER',INPUT 0).
 RUN FieldShape(INPUT phEms5,INPUT 'cod_livre_1',INPUT 'CHARACTER',INPUT 0).
 RUN FieldShape(INPUT phEms5,INPUT 'cod_livre_2',INPUT 'CHARACTER',INPUT 0).
 RUN FieldShape(INPUT phEms5,INPUT 'dat_livre_1',INPUT 'DATE',INPUT 0).
 RUN FieldShape(INPUT phEms5,INPUT 'dat_livre_2',INPUT 'DATE',INPUT 0).
 RUN FieldShape(INPUT phEms5,INPUT 'log_livre_1',INPUT 'LOGICAL',INPUT 0).
 RUN FieldShape(INPUT phEms5,INPUT 'log_livre_2',INPUT 'LOGICAL',INPUT 0).
 RUN FieldShape(INPUT phEms5,INPUT 'num_livre_1',INPUT 'INTEGER',INPUT 0).
 RUN FieldShape(INPUT phEms5,INPUT 'num_livre_2',INPUT 'INTEGER',INPUT 0).
 RUN FieldShape(INPUT phEms5,INPUT 'val_livre_1',INPUT 'DECIMAL',INPUT 0).
 RUN FieldShape(INPUT phEms5,INPUT 'val_livre_2',INPUT 'DECIMAL',INPUT 0).
 RUN FieldShape(INPUT phEms5,INPUT 'cdd_version',INPUT 'DECIMAL',INPUT 0).
 ASSIGN startMs=ETIME(FALSE) periodValue=STRING(YEAR(pdRunDate),'9999') + STRING(MONTH(pdRunDate),'99') changes=NEW JsonArray().
 CREATE BUFFER e2 FOR TABLE phEms2 BUFFER-NAME 'dailyEms2'.
 CREATE BUFFER e5 FOR TABLE phEms5 BUFFER-NAME 'dailyEms5'.
 CREATE QUERY query2. query2:SET-BUFFERS(e2).
 CREATE QUERY query5. query5:SET-BUFFERS(e5).
 applyWork: DO TRANSACTION STOP-AFTER 10 ON STOP UNDO, LEAVE ON ERROR UNDO, THROW:
  IF NOT query2:QUERY-PREPARE('FOR EACH ' + e2:NAME + ' WHERE ' + e2:NAME + '.mo-codigo=3 AND ' + e2:NAME + '.ano-periodo=' + QUOTER(periodValue) + ' EXCLUSIVE-LOCK') THEN RUN Fail('DAILY_CURRENCY_ERP_SHAPE',503).
  query2:QUERY-OPEN(). query2:GET-FIRST(). RUN Budget.
  IF query2:QUERY-OFF-END THEN RUN Fail('DAILY_CURRENCY_EMS2_INSERT_UNPROVEN',503).
  chosen2=e2:ROWID.
  query2:GET-NEXT(). RUN Budget.
  IF NOT query2:QUERY-OFF-END THEN RUN Fail('DAILY_CURRENCY_ERP_AMBIGUOUS',409).
  query2:QUERY-CLOSE().
  e2:FIND-BY-ROWID(chosen2,EXCLUSIVE-LOCK) NO-ERROR.
  IF Failed() OR NOT e2:AVAILABLE THEN RUN Fail('DAILY_CURRENCY_ERP_CHANGED',409).
  IF NOT query5:QUERY-PREPARE('FOR EACH ' + e5:NAME + ' WHERE ' + e5:NAME + '.cod_indic_econ_base=' + QUOTER('real') + ' AND ' + e5:NAME + '.cod_indic_econ_idx=' + QUOTER('dolar') + ' AND ' + e5:NAME + '.dat_cotac_indic_econ=DATE(' + STRING(MONTH(pdRunDate)) + ',' + STRING(DAY(pdRunDate)) + ',' + STRING(YEAR(pdRunDate)) + ') EXCLUSIVE-LOCK BY ' + e5:NAME + '.cod_indic_econ_base BY ' + e5:NAME + '.cod_indic_econ_idx BY ' + e5:NAME + '.ind_tip_cotac_parid BY ' + e5:NAME + '.dat_cotac_indic_econ') THEN RUN Fail('DAILY_CURRENCY_ERP_SHAPE',503).
  query5:QUERY-OPEN(). query5:GET-FIRST(). RUN Budget.
  /* Source UPDATE addresses base+idx+date, not only type venda. Lock and
     validate the complete set before the first update; physical PK has type. */
  DO WHILE NOT query5:QUERY-OFF-END:
   IF e5:BUFFER-FIELD('ind_tip_cotac_parid'):BUFFER-VALUE=? THEN RUN Fail('DAILY_CURRENCY_ERP_AMBIGUOUS',409).
   FIND FIRST ttSeen WHERE ttSeen.kindValue=STRING(e5:BUFFER-FIELD('ind_tip_cotac_parid'):BUFFER-VALUE) NO-ERROR.
   IF AVAILABLE ttSeen THEN RUN Fail('DAILY_CURRENCY_ERP_AMBIGUOUS',409).
   CREATE ttSeen. ttSeen.kindValue=STRING(e5:BUFFER-FIELD('ind_tip_cotac_parid'):BUFFER-VALUE). RELEASE ttSeen.
   query5:GET-NEXT(). RUN Budget.
  END.
  query5:GET-FIRST(). RUN Budget.
  beforeValue=Snapshot(e2).
  DO slotValue=DAY(pdRunDate) TO 31: e2:BUFFER-FIELD('cotacao'):BUFFER-VALUE(slotValue)=pdValue. END.
  afterValue=Snapshot(e2). RUN AddChange('comum.cotacao','update').
  IF query5:QUERY-OFF-END THEN DO:
   beforeValue=NEW JsonObject().
   IF NOT e5:BUFFER-CREATE() THEN RUN Fail('DAILY_CURRENCY_ERP_REJECTED',409).
   ASSIGN e5:BUFFER-FIELD('cod_indic_econ_base'):BUFFER-VALUE='real'
    e5:BUFFER-FIELD('cod_indic_econ_idx'):BUFFER-VALUE='dolar'
    e5:BUFFER-FIELD('dat_cotac_indic_econ'):BUFFER-VALUE=pdRunDate
    e5:BUFFER-FIELD('ind_tip_cotac_parid'):BUFFER-VALUE='venda'
    e5:BUFFER-FIELD('val_cotac_indic_econ'):BUFFER-VALUE=pdValue
    e5:BUFFER-FIELD('cod_usuar_ult_atualiz'):BUFFER-VALUE='super'
    e5:BUFFER-FIELD('dat_ult_atualiz'):BUFFER-VALUE=DATE(pdtUpdatedAt)
    e5:BUFFER-FIELD('hra_ult_atualiz'):BUFFER-VALUE=STRING(INTEGER(TRUNCATE(MTIME(pdtUpdatedAt) / 1000,0)),'HH:MM:SS').
   afterValue=Snapshot(e5). RUN AddChange('ems5.cotac_parid','create').
  END.
  ELSE DO WHILE NOT query5:QUERY-OFF-END:
   beforeValue=Snapshot(e5).
   e5:BUFFER-FIELD('val_cotac_indic_econ'):BUFFER-VALUE=pdValue.
   afterValue=Snapshot(e5). RUN AddChange('ems5.cotac_parid','update').
   query5:GET-NEXT(). RUN Budget.
  END.
  completed=TRUE.
 END.
 IF NOT completed THEN RUN Fail('DAILY_CURRENCY_ERP_BUDGET',503).
 poResponse=NEW JsonObject(). poResponse:Add('success',TRUE). poResponse:Add('changes',changes).
 CATCH err AS Progress.Lang.Error:
  errorCode=err:GetMessage(1).
  IF LOOKUP(errorCode,'DAILY_CURRENCY_ROOT_TRANSACTION_REQUIRED,DAILY_CURRENCY_ERP_REQUEST,DAILY_CURRENCY_ERP_SHAPE,DAILY_CURRENCY_EMS2_INSERT_UNPROVEN,DAILY_CURRENCY_ERP_AMBIGUOUS,DAILY_CURRENCY_ERP_CHANGED,DAILY_CURRENCY_EMS_USER_REQUIRED,DAILY_CURRENCY_ERP_REJECTED,DAILY_CURRENCY_ERP_BUDGET')=0 THEN errorCode='DAILY_CURRENCY_ERP_REJECTED'.
  errorInfo=NEW JsonObject(). errorInfo:Add('code',errorCode). errorInfo:Add('status',IF errorCode='DAILY_CURRENCY_ERP_REQUEST' THEN 422 ELSE IF LOOKUP(errorCode,'DAILY_CURRENCY_ROOT_TRANSACTION_REQUIRED,DAILY_CURRENCY_ERP_AMBIGUOUS,DAILY_CURRENCY_ERP_CHANGED,DAILY_CURRENCY_ERP_REJECTED')>0 THEN 409 ELSE 503).
  poResponse=NEW JsonObject(). poResponse:Add('success',FALSE). poResponse:Add('error',errorInfo).
 END CATCH.
 FINALLY:
  IF VALID-HANDLE(query2) THEN DO: IF query2:IS-OPEN THEN query2:QUERY-CLOSE(). DELETE OBJECT query2. END.
  IF VALID-HANDLE(query5) THEN DO: IF query5:IS-OPEN THEN query5:QUERY-CLOSE(). DELETE OBJECT query5. END.
  IF VALID-HANDLE(e2) THEN DELETE OBJECT e2.
  IF VALID-HANDLE(e5) THEN DELETE OBJECT e5.
 END FINALLY.
END.
PROCEDURE Budget:
 reads=reads + 1.
 IF reads>50000 OR ETIME(FALSE) - startMs>10000 THEN RUN Fail('DAILY_CURRENCY_ERP_BUDGET',503).
END PROCEDURE.
PROCEDURE Shape:
 DEFINE INPUT PARAMETER valueBuffer AS HANDLE NO-UNDO.
 DEFINE INPUT PARAMETER fieldCount AS INTEGER NO-UNDO.
 IF NOT VALID-HANDLE(valueBuffer) THEN RUN Fail('DAILY_CURRENCY_ERP_SHAPE',503).
 IF valueBuffer:TYPE<>'BUFFER' OR valueBuffer:NUM-FIELDS<>fieldCount THEN RUN Fail('DAILY_CURRENCY_ERP_SHAPE',503).
END PROCEDURE.
PROCEDURE FieldShape:
 DEFINE INPUT PARAMETER valueBuffer AS HANDLE NO-UNDO.
 DEFINE INPUT PARAMETER fieldName AS CHARACTER NO-UNDO.
 DEFINE INPUT PARAMETER typeValue AS CHARACTER NO-UNDO.
 DEFINE INPUT PARAMETER extentValue AS INTEGER NO-UNDO.
 DEFINE VARIABLE fieldValue AS HANDLE NO-UNDO.
 fieldValue=valueBuffer:BUFFER-FIELD(fieldName) NO-ERROR.
 IF ERROR-STATUS:ERROR OR NOT VALID-HANDLE(fieldValue) THEN RUN Fail('DAILY_CURRENCY_ERP_SHAPE',503).
 IF fieldValue:DATA-TYPE<>typeValue OR fieldValue:EXTENT<>extentValue THEN RUN Fail('DAILY_CURRENCY_ERP_SHAPE',503).
END PROCEDURE.
PROCEDURE Fail:
 DEFINE INPUT PARAMETER codeValue AS CHARACTER NO-UNDO.
 DEFINE INPUT PARAMETER statusValue AS INTEGER NO-UNDO.
 UNDO, THROW NEW Progress.Lang.AppError(codeValue,statusValue).
END PROCEDURE.
