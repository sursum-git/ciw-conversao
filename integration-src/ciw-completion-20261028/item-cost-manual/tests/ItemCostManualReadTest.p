BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE TEMP-TABLE ttCosts /* PHYSICAL_SCHEMA */ .
DEFINE VARIABLE req AS JsonObject NO-UNDO. DEFINE VARIABLE result AS JsonObject NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO. DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE keyValue AS CHARACTER NO-UNDO. DEFINE VARIABLE rowValue AS JsonObject NO-UNDO.
DEFINE VARIABLE names AS CHARACTER EXTENT NO-UNDO.
DEFINE VARIABLE filtersValue AS JsonObject NO-UNDO. DEFINE VARIABLE leavesValue AS JsonArray NO-UNDO. DEFINE VARIABLE leafValue AS JsonObject NO-UNDO.
RUN Check(NUM-DBS=0,'NUMDBS0').
DO TRANSACTION:
 CREATE ttCosts. ASSIGN ttCosts.item_custo_id=1 ttCosts.cod_tipo_custo=1 ttCosts.it_codigo='MANUAL-A' ttCosts.vl_unit_novo=12.34 ttCosts.dt_hr_custo=DATETIME(10,28,2026,12,34,56,789) ttCosts.dt_referencia=DATE(10,28,2026) ttCosts.memoria_calculo='  <raw>  ' ttCosts.caminho_arquivo=? ttCosts.qt_estoque=? ttCosts.qt_etiq_branco=? .
 CREATE ttCosts. ASSIGN ttCosts.item_custo_id=2 ttCosts.cod_tipo_custo=2.
 CREATE ttCosts. ASSIGN ttCosts.item_custo_id=3 ttCosts.cod_tipo_custo=3.
 CREATE ttCosts. ASSIGN ttCosts.item_custo_id=4 ttCosts.cod_tipo_custo=?.
 CREATE ttCosts. ASSIGN ttCosts.item_custo_id=5 ttCosts.cod_tipo_custo=1 ttCosts.it_codigo='MANUAL-B' ttCosts.dt_hr_custo=? ttCosts.dt_referencia=? ttCosts.memoria_calculo=? .
END.
req=NEW JsonObject(). req:Add('operation','read'). RUN Invoke.
RUN Check(result:GetLogical('success'),'manual readonly resource exists').
RUN Check(result:GetInteger('total')=2 AND result:GetJsonArray('data'):Length=2,'only exact type1, excludes2/3/NULL').
result:WriteFile('manual-read-actual.json',TRUE).
rowValue=result:GetJsonArray('data'):GetJsonObject(1).
names=rowValue:GetNames(). RUN Check(EXTENT(names)=24,'all23 physical plus derived identity').
RUN Check(rowValue:GetCharacter('dt_hr_custo')='2026-10-28T12:34:56.789','physical datetime ISO preserved').
RUN Check(rowValue:GetDecimal('vl_unit_novo')=12.34 AND rowValue:GetCharacter('memoria_calculo')='  <raw>  ','decimal/raw memory preserved').
RUN Check(rowValue:IsNull('caminho_arquivo') AND rowValue:IsNull('qt_estoque') AND rowValue:IsNull('qt_etiq_branco'),'nullable fields preserved').
keyValue=rowValue:GetCharacter('record_key').
req=NEW JsonObject(). req:Add('operation','get'). req:Add('id',keyValue). req:Add('record_key',keyValue). RUN Invoke.
RUN Check(result:GetLogical('success') AND result:GetJsonObject('data'):GetInteger('item_custo_id')=1,'get canonical aliases').
req:Set('record_key','~{"item_custo_id":5}'). RUN Invoke. RUN Code('CIW_ERP_KEY_INVALID').
req=NEW JsonObject(). req:Add('operation','get'). req:Add('id','~{"item_custo_id":2}'). RUN Invoke. RUN Code('CIW_ERP_NOT_FOUND').
req:Set('id','~{"item_custo_id":5}'). RUN Invoke.
RUN Check(result:GetLogical('success') AND result:GetJsonObject('data'):IsNull('dt_hr_custo'),'get nullable date/time').
req:Set('id','~{"item_custo_id":1,"other":1}'). RUN Invoke. RUN Code('CIW_ERP_KEY_INVALID').
req=NEW JsonObject(). req:Add('operation','update'). RUN Invoke. RUN Code('CIW_ERP_READ_ONLY').
req=NEW JsonObject(). req:Add('operation','read'). req:Add('take',201). RUN Invoke. RUN Code('CIW_ERP_VALUE_INVALID').
req:Set('take',1). req:Add('skip',1). RUN Invoke.
RUN Check(result:GetLogical('success') AND result:GetInteger('total')=2 AND result:GetJsonArray('data'):GetJsonObject(1):GetInteger('item_custo_id')=5,'paging central').
req:Add('query','SELECT *'). RUN Invoke. RUN Code('CIW_ERP_REQUEST_INVALID').
req=NEW JsonObject(). req:Add('operation','read'). filtersValue=NEW JsonObject(). leavesValue=NEW JsonArray().
filtersValue:Add('logic','or'). leafValue=NEW JsonObject(). leafValue:Add('field','cod_tipo_custo'). leafValue:Add('operator','eq'). leafValue:Add('value',2). leavesValue:Add(leafValue).
leafValue=NEW JsonObject(). leafValue:Add('field','item_custo_id'). leafValue:Add('operator','eq'). leafValue:Add('value',1). leavesValue:Add(leafValue). filtersValue:Add('filters',leavesValue). req:Add('filter',filtersValue). RUN Invoke.
RUN Check(result:GetLogical('success') AND result:GetInteger('total')=1 AND result:GetJsonArray('data'):GetJsonObject(1):GetInteger('item_custo_id')=1,'user OR filter cannot widen fixed type1 scope').
filtersValue=NEW JsonObject(). filtersValue:Add('field','vl_unit_novo'). filtersValue:Add('operator','eq'). filtersValue:Add('value',12.34). req:Set('filter',filtersValue). RUN Invoke.
RUN Check(result:GetLogical('success') AND result:GetInteger('total')=1,'decimal filter independent of numeric culture').
filtersValue:Set('field','dt_referencia'). filtersValue:Set('value','2026-10-28'). req:Set('filter',filtersValue). RUN Invoke.
RUN Check(result:GetLogical('success') AND result:GetInteger('total')=1,'date filter uses canonical ISO').
filtersValue:Set('field','qt_estoque'). filtersValue:Set('operator','isnull'). filtersValue:Remove('value'). req:Set('filter',filtersValue). RUN Invoke.
RUN Check(result:GetLogical('success') AND result:GetInteger('total')=1,'SQL-like NULL filter retains raw unknown').
req=NEW JsonObject(). req:Add('operation','get'). req:Add('id','~{"item_custo_id":"1"}'). RUN Invoke. RUN Code('CIW_ERP_VALUE_INVALID').
req=NEW JsonObject(). req:Add('operation','get'). req:Add('record_key',keyValue). RUN Invoke. RUN Code('CIW_ERP_KEY_INVALID').
DO TRANSACTION: DO n=6 TO 50004: CREATE ttCosts. ASSIGN ttCosts.item_custo_id=n ttCosts.cod_tipo_custo=1. END. END.
req=NEW JsonObject(). req:Add('operation','read'). req:Add('take',1). RUN Invoke. RUN Code('CIW_ERP_QUERY_LIMIT').
RUN Check(NOT result:Has('data'),'no partial data over50k').
OUTPUT TO VALUE('item-manual-' + SESSION:NUMERIC-FORMAT + '.log'). PUT UNFORMATTED 'PASS ' checks ' checks NUMDBS=' NUM-DBS SKIP. OUTPUT CLOSE.
PROCEDURE Invoke:
 RUN sursum-api/programs/CiwErpReadService.r(INPUT BUFFER ttCosts:HANDLE,INPUT 'item_custos_manual',INPUT '',INPUT req,OUTPUT result).
END PROCEDURE.
PROCEDURE Check:
 DEFINE INPUT PARAMETER conditionValue AS LOGICAL NO-UNDO. DEFINE INPUT PARAMETER labelValue AS CHARACTER NO-UNDO.
 checks=checks + 1. IF conditionValue<>TRUE THEN UNDO, THROW NEW Progress.Lang.AppError('FAIL ' + labelValue,1).
END PROCEDURE.
PROCEDURE Code:
 DEFINE INPUT PARAMETER codeValue AS CHARACTER NO-UNDO.
 RUN Check(NOT result:GetLogical('success') AND result:GetJsonObject('error'):GetCharacter('code')=codeValue,'expected ' + codeValue).
END PROCEDURE.
