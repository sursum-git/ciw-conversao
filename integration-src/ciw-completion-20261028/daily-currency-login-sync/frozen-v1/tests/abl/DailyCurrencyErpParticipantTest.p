BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
{CurrencyErpTestTables.i}
DEFINE VARIABLE response AS JsonObject NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE k AS INTEGER NO-UNDO.
DEFINE VARIABLE dayValue AS INTEGER NO-UNDO.
DEFINE VARIABLE periodValue AS CHARACTER NO-UNDO.
DEFINE VARIABLE valueInput AS DECIMAL NO-UNDO INITIAL 5.12345.
DEFINE VARIABLE dateInput AS DATE NO-UNDO.
DEFINE VARIABLE clockInput AS DATETIME NO-UNDO.
DEFINE VARIABLE names AS CHARACTER EXTENT NO-UNDO.
DEFINE VARIABLE imageValue AS JsonObject NO-UNDO.
OUTPUT TO 'currency-erp-tests.log'.
DO ON ERROR UNDO, THROW:
 RUN Check(NUM-DBS=0,'zero databases').
 ASSIGN dateInput=TODAY clockInput=NOW dayValue=DAY(TODAY) periodValue=STRING(YEAR(TODAY),'9999') + STRING(MONTH(TODAY),'99').
 RUN CallParticipant.
 RUN Check(NOT response:GetLogical('success'),'root required').
 DO TRANSACTION:
  RUN CallParticipant.
  RUN Check(response:GetJsonObject('error'):GetCharacter('code')='DAILY_CURRENCY_EMS2_INSERT_UNPROVEN','missing period is gated before effects').
  RUN Check(NOT CAN-FIND(FIRST ttEms5),'no EMS5 before unknown EMS2 insert').
 END.
 CREATE ttEms2. ASSIGN ttEms2.mo-codigo=3 ttEms2.ano-periodo=periodValue ttEms2.char-1='sentinel'.
 DO k=1 TO 31: ttEms2.cotacao[k]=k / 10. ttEms2.usuario[k]='old-user'. END.
 RELEASE ttEms2.
 rootRollback: DO TRANSACTION:
  RUN CallParticipant.
  RUN Check(response:GetLogical('success'),'existing month update succeeds').
  FIND FIRST ttEms2 NO-LOCK.
  DO k=1 TO 31:
   RUN Check(ttEms2.cotacao[k]=(IF k<dayValue THEN k / 10 ELSE 5.12345),'all slots follow source update').
   RUN Check(ttEms2.usuario[k]='old-user','EMS2 user slots preserved').
  END.
  RUN Check(ttEms2.char-1='sentinel','unrelated physical field preserved'). RELEASE ttEms2.
  FIND FIRST ttEms5 NO-LOCK.
  RUN Check(ttEms5.ind_tip_cotac_parid='venda','EMS5 insert type source').
  RUN Check(ttEms5.cod_usuar_ult_atualiz='super','EMS5 user backend').
  RUN Check(ttEms5.dat_cotac_indic_econ=TODAY AND ttEms5.val_cotac_indic_econ=5.12345,'EMS5 daily run date and amount'). RELEASE ttEms5.
  RUN Check(response:GetJsonArray('changes'):Length=2,'both physical images emitted').
  imageValue=response:GetJsonArray('changes'):GetJsonObject(1):GetJsonObject('before'). names=imageValue:GetNames().
  RUN Check(EXTENT(names)=18,'full EMS2 physical image').
  RUN Check(imageValue:GetJsonArray('cotacao'):Length=31 AND imageValue:GetJsonArray('usuario'):Length=31,'both extents full').
  imageValue=response:GetJsonArray('changes'):GetJsonObject(2):GetJsonObject('after'). EXTENT(names)=?. names=imageValue:GetNames().
  RUN Check(EXTENT(names)=20,'full EMS5 physical image').
  RUN Check(imageValue:GetCharacter('hra_ult_atualiz')=STRING(INTEGER(TRUNCATE(MTIME(clockInput) / 1000,0)),'HH:MM:SS'),'source backend time').
  response:WriteFile('erp-insert-actual.json',TRUE).
  UNDO rootRollback,LEAVE rootRollback.
 END.
 FIND FIRST ttEms2 NO-LOCK. RUN Check(ttEms2.cotacao[31]=3.1,'outer undo restores EMS2'). RELEASE ttEms2.
 RUN Check(NOT CAN-FIND(FIRST ttEms5),'outer undo removes EMS5').
 CREATE ttEms5. ASSIGN ttEms5.cod_indic_econ_base='real' ttEms5.cod_indic_econ_idx='dolar'
  ttEms5.ind_tip_cotac_parid='compra' ttEms5.dat_cotac_indic_econ=TODAY ttEms5.val_cotac_indic_econ=1 ttEms5.cod_usuar_ult_atualiz='preserved'. RELEASE ttEms5.
 CREATE ttEms5. ASSIGN ttEms5.cod_indic_econ_base='real' ttEms5.cod_indic_econ_idx='dolar'
  ttEms5.ind_tip_cotac_parid='venda' ttEms5.dat_cotac_indic_econ=TODAY ttEms5.val_cotac_indic_econ=2 ttEms5.cod_usuar_ult_atualiz='preserved'. RELEASE ttEms5.
 DO TRANSACTION:
  RUN CallParticipant.
  RUN Check(response:GetLogical('success'),'existing EMS5 set succeeds').
  RUN Check(response:GetJsonArray('changes'):Length=3,'complete PK distinguishes both types').
  RUN Check(response:GetJsonArray('changes'):GetJsonObject(2):GetJsonObject('key'):GetCharacter('ind_tip_cotac_parid')='compra','set ordered by native full PK').
  response:WriteFile('erp-update-actual.json',TRUE).
  FOR EACH ttEms5 NO-LOCK:
   RUN Check(ttEms5.val_cotac_indic_econ=5.12345,'source updates all matching types').
   RUN Check(ttEms5.cod_usuar_ult_atualiz='preserved','source update changes value only').
  END.
 END.

 /* Duplicate physical identity is rejected during preflight, before EMS2 changes. */
 FIND FIRST ttEms2. ttEms2.cotacao[31]=99. RELEASE ttEms2.
 CREATE ttEms5. ASSIGN ttEms5.cod_indic_econ_base='real' ttEms5.cod_indic_econ_idx='dolar'
  ttEms5.ind_tip_cotac_parid='venda' ttEms5.dat_cotac_indic_econ=TODAY ttEms5.val_cotac_indic_econ=42. RELEASE ttEms5.
 DO TRANSACTION:
  RUN CallParticipant.
  RUN Check(response:GetJsonObject('error'):GetCharacter('code')='DAILY_CURRENCY_ERP_AMBIGUOUS','duplicate PK4 rejected before effects').
  RUN Check(NOT response:Has('changes'),'failure has no confirmed audit').
  FIND FIRST ttEms2 NO-LOCK. RUN Check(ttEms2.cotacao[31]=99,'duplicate PK leaves EMS2 unchanged'). RELEASE ttEms2.
 END.
 FIND FIRST ttEms5 WHERE ttEms5.val_cotac_indic_econ=42. DELETE ttEms5.
 CREATE ttEms2. ASSIGN ttEms2.mo-codigo=3 ttEms2.ano-periodo=periodValue. RELEASE ttEms2.
 DO TRANSACTION:
  RUN CallParticipant.
  RUN Check(response:GetJsonObject('error'):GetCharacter('code')='DAILY_CURRENCY_ERP_AMBIGUOUS','duplicate period rejected').
  RUN Check(NOT response:Has('changes'),'duplicate period no audit').
 END.
 FIND FIRST ttEms2 WHERE ttEms2.cotacao[31]<>99. DELETE ttEms2.
 DO k=1 TO 4:
  valueInput=IF k=1 THEN 0 ELSE IF k=2 THEN -1 ELSE IF k=3 THEN ? ELSE 5.123456.
  DO TRANSACTION:
   RUN CallParticipant.
   RUN Check(response:GetJsonObject('error'):GetCharacter('code')='DAILY_CURRENCY_ERP_REQUEST','invalid quote before mutation').
   FIND FIRST ttEms2 NO-LOCK. RUN Check(ttEms2.cotacao[31]=99,'invalid quote leaves period unchanged'). RELEASE ttEms2.
  END.
 END.
 valueInput=5.12345. dateInput=TODAY - 1.
 DO TRANSACTION:
  RUN CallParticipant. RUN Check(NOT response:GetLogical('success'),'run date must be today').
  RUN Check(NOT response:Has('changes'),'date error no audit').
 END.
 dateInput=TODAY. clockInput=?.
 DO TRANSACTION:
  RUN CallParticipant. RUN Check(NOT response:GetLogical('success'),'clock must be backend complete').
  RUN Check(NOT response:Has('changes'),'clock error no audit').
 END.
 RUN Check(NUM-DBS=0,'zero databases after').
 PUT UNFORMATTED 'PASS ' checks ' checks' SKIP.
 CATCH err AS Progress.Lang.Error:
  PUT UNFORMATTED 'FAIL checks=' checks ' errorNumber=' err:GetMessageNum(1) SKIP.
 END CATCH.
END.
OUTPUT CLOSE. QUIT.
PROCEDURE CallParticipant:
 RUN VALUE('CiwDailyCurrencyErpParticipant.p')(INPUT BUFFER ttEms2:HANDLE,INPUT BUFFER ttEms5:HANDLE,
  INPUT dateInput,INPUT valueInput,INPUT clockInput,OUTPUT response).
END PROCEDURE.
PROCEDURE Check:
 DEFINE INPUT PARAMETER valueOk AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER labelValue AS CHARACTER NO-UNDO.
 checks=checks + 1.
 IF valueOk<>TRUE OR valueOk=? THEN UNDO,THROW NEW Progress.Lang.AppError(labelValue,1).
END PROCEDURE.
