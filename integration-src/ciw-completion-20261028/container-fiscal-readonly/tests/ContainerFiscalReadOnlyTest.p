BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE TEMP-TABLE containers FIELD nr-container AS INTEGER FIELD cod-estabel AS CHARACTER INDEX pk IS PRIMARY UNIQUE nr-container.
DEFINE TEMP-TABLE calcs FIELD calc_imp_container_id AS INTEGER FIELD container_id AS INTEGER FIELD dt_hr_calculo AS DATETIME FIELD usuario_id AS INTEGER FIELD memoria_calculo AS INTEGER FIELD desc_memoria_calc AS CHARACTER INDEX pk IS PRIMARY UNIQUE calc_imp_container_id.
DEFINE TEMP-TABLE expenses FIELD despesa_container_id AS INTEGER FIELD container_id AS INTEGER FIELD calc_imp_container_id AS INTEGER FIELD memoria_calculo AS CHARACTER INDEX pk IS PRIMARY UNIQUE despesa_container_id.
DEFINE VARIABLE req AS JsonObject NO-UNDO. DEFINE VARIABLE res AS JsonObject NO-UNDO. DEFINE VARIABLE rowValue AS JsonObject NO-UNDO.
DEFINE VARIABLE f AS JsonObject NO-UNDO. DEFINE VARIABLE checks AS INTEGER NO-UNDO. DEFINE VARIABLE k AS INTEGER NO-UNDO.
DEFINE VARIABLE fiscal AS CHARACTER NO-UNDO INITIAL 'container_calculos_impostos_med'.
DEFINE VARIABLE memory AS CHARACTER NO-UNDO INITIAL 'container_despesa_memoria_med'.
OUTPUT TO 'fiscal-tests.log'.
DO ON ERROR UNDO, THROW:
 CREATE containers. ASSIGN containers.nr-container=100 containers.cod-estabel='501'.
 CREATE containers. ASSIGN containers.nr-container=200 containers.cod-estabel='101'.
 CREATE calcs. ASSIGN calcs.calc_imp_container_id=11 calcs.container_id=100 calcs.dt_hr_calculo=DATETIME(10,28,2026,14,30,12,123) calcs.usuario_id=? calcs.memoria_calculo=7 calcs.desc_memoria_calc='Persistido <texto> & sem recalculo'.
 CREATE calcs. ASSIGN calcs.calc_imp_container_id=12 calcs.container_id=100 calcs.dt_hr_calculo=? calcs.usuario_id=0 calcs.memoria_calculo=? calcs.desc_memoria_calc=?.
 CREATE calcs. ASSIGN calcs.calc_imp_container_id=13 calcs.container_id=200 calcs.desc_memoria_calc='outra empresa'.
 DO k=21 TO 27:
  CREATE expenses. ASSIGN expenses.despesa_container_id=k expenses.container_id=IF k=23 THEN 200 ELSE 100 expenses.calc_imp_container_id=IF k=22 THEN ? ELSE IF k=27 THEN 999 ELSE 11
   expenses.memoria_calculo=IF k=21 THEN 'Memoria propria' ELSE IF k=22 OR k=25 THEN ? ELSE IF k=26 THEN '   ' ELSE ''.
 END.
 RUN Request(fiscal,'read',100,11). RUN Invoke.
 RUN Check(VALID-OBJECT(res),'service missing'). RUN Check(res:GetLogical('success') AND res:GetInteger('total')=1,'only selected calculation').
 rowValue=res:GetJsonArray('data'):GetJsonObject(1).
 RUN Check(rowValue:GetInteger('calc_imp_container_id')=11 AND rowValue:GetInteger('memoria_calculo')=7,'physical integer fields').
 RUN Check(rowValue:GetCharacter('dt_hr_calculo')='2026-10-28T14:30:12.123' AND rowValue:GetCharacter('data_calculo')='2026-10-28','exact datetime and civil date').
 RUN Check(rowValue:IsNull('usuario_id') AND rowValue:GetCharacter('desc_memoria_calc')='Persistido <texto> & sem recalculo','NULL and text preserved').
 RUN Request(fiscal,'read',100,12). RUN Invoke. rowValue=res:GetJsonArray('data'):GetJsonObject(1).
 RUN Check(rowValue:IsNull('dt_hr_calculo') AND rowValue:IsNull('data_calculo') AND rowValue:IsNull('memoria_calculo') AND rowValue:IsNull('desc_memoria_calc'),'NULL not empty or zero').
 RUN Request(fiscal,'get',100,11). req:Add('id','11'). RUN Invoke. RUN Check(res:GetLogical('success'),'native equal alias consumed').
 RUN Request(fiscal,'get',100,11). req:Add('id',12). RUN Invoke. RUN Status(422,'get identity conflict').
 RUN Request(fiscal,'get',100,11). RUN Invoke. RUN Status(422,'alias alone').
 RUN Request(fiscal,'get',100,11). req:Add('id','011'). RUN Invoke. RUN Status(422,'leading zero').
 RUN Request(fiscal,'get',100,13). req:Add('id',13). RUN Invoke. RUN Status(404,'cross owner get').
 RUN Request(fiscal,'read',100,13). RUN Invoke. RUN Status(404,'cross owner read').
 RUN Request(fiscal,'read',200,13). RUN Invoke. RUN Status(404,'non MED parent').
 RUN Request(fiscal,'read',999,11). RUN Invoke. RUN Status(404,'absent parent').
 RUN Request(fiscal,'read',100,11). req:Remove('container_id'). RUN Invoke. RUN Status(422,'mandatory container').
 RUN Request(fiscal,'read',100,11). req:Remove('calc_imp_container_id'). RUN Invoke. RUN Status(422,'mandatory selected calc').
 RUN Request(fiscal,'read',100,11). req:Set('calc_imp_container_id','11e0'). RUN Invoke. RUN Status(422,'strict context alias').
 RUN Request(fiscal,'read',100,11). req:Add('id',11). RUN Invoke. RUN Status(422,'read rejects id').
 RUN Request(fiscal,'read',100,11). req:Add('sql','FOR EACH other'). RUN Invoke. RUN Status(422,'closed contract').
 RUN Request(fiscal,'create',100,11). RUN Invoke. RUN Status(405,'no writer').
 RUN Request(fiscal,'read',100,11). req:Add('take',201). RUN Invoke. RUN Status(422,'page capped 200').
 RUN Request(fiscal,'read',100,11). req:Add('skip',1). req:Add('take',1). RUN Invoke.
 RUN Check(res:GetLogical('success') AND res:GetInteger('total')=1 AND res:GetJsonArray('data'):Length=0,'server paging').
 RUN Request(fiscal,'read',100,11). f=NEW JsonObject(). f:Add('field','data_calculo'). f:Add('operator','gte'). f:Add('value','2026-10-28'). req:Add('filter',f). RUN Invoke.
 RUN Check(res:GetLogical('success') AND res:GetInteger('total')=1,'native date filter').
 RUN Request(fiscal,'read',100,11). f=NEW JsonObject(). f:Add('field','calc_imp_container_id'). f:Add('operator','eq'). f:Add('value',12). req:Add('filter',f). RUN Invoke.
 RUN Check(res:GetLogical('success') AND res:GetInteger('total')=0,'filter cannot widen selected identity').
 RUN Request(memory,'get',100,21). req:Add('id',21). RUN Invoke. rowValue=res:GetJsonObject('data').
 RUN Check(res:GetLogical('success') AND rowValue:GetCharacter('memoria_calculo')='Memoria propria' AND rowValue:IsNull('link_calculo_id'),'own memory prevails').
 RUN Request(memory,'get',100,22). req:Add('id',22). RUN Invoke. rowValue=res:GetJsonObject('data').
 RUN Check(res:GetLogical('success') AND rowValue:IsNull('memoria_calculo') AND rowValue:IsNull('calc_imp_container_id') AND rowValue:IsNull('link_calculo_id'),'expense NULL preserved').
 RUN Request(memory,'read',100,24). RUN Invoke. RUN Check(res:GetJsonArray('data'):GetJsonObject(1):GetInteger('link_calculo_id')=11,'empty memory fiscal fallback').
 RUN Request(memory,'read',100,25). RUN Invoke. RUN Check(res:GetJsonArray('data'):GetJsonObject(1):GetInteger('link_calculo_id')=11,'NULL own memory fiscal fallback').
 RUN Request(memory,'read',100,26). RUN Invoke. rowValue=res:GetJsonArray('data'):GetJsonObject(1).
 RUN Check(rowValue:IsNull('link_calculo_id') AND LENGTH(rowValue:GetCharacter('memoria_calculo'))=3,'spaces own memory without TRIM').
 RUN Request(memory,'read',100,27). RUN Invoke. RUN Check(res:GetJsonArray('data'):GetJsonObject(1):GetInteger('link_calculo_id')=999,'orphan reference preserved').
 RUN Request(fiscal,'read',100,999). RUN Invoke. RUN Status(404,'orphan calc fails closed').
 RUN Request(memory,'get',100,23). req:Add('id',23). RUN Invoke. RUN Status(404,'expense cross owner').
 RUN Request(memory,'get',100,21). req:Add('id',22). RUN Invoke. RUN Status(422,'expense alias conflict').
 RUN Request(memory,'get',100,21). req:Add('id',21). req:Remove('container_id'). RUN Invoke. RUN Status(422,'expense get mandatory container').
 RUN Request(memory,'get',100,21). req:Add('id',21). req:Remove('despesa_container_id'). RUN Invoke. RUN Status(422,'expense get mandatory selected context').
 RUN Request(fiscal,'get',100,11). req:Add('id',11). req:Remove('container_id'). RUN Invoke. RUN Status(422,'fiscal get mandatory container').
 RUN Request('other','read',100,11). RUN Invoke. RUN Status(422,'closed resource').
 RUN Request(memory,'delete',100,21). RUN Invoke. RUN Status(405,'expense no writer').
 DO k=1000 TO 51000: CREATE calcs. ASSIGN calcs.calc_imp_container_id=k calcs.container_id=100. END.
 RUN Request(fiscal,'read',100,11). RUN Invoke. RUN Check(res:GetLogical('success') AND res:GetInteger('total')=1,'51000 unrelated rows do not widen selected query').
 RUN Check(NUM-DBS=0 AND CAN-FIND(FIRST calcs WHERE calcs.calc_imp_container_id=11 AND calcs.memoria_calculo=7) AND CAN-FIND(FIRST expenses WHERE expenses.despesa_container_id=21 AND expenses.memoria_calculo='Memoria propria'),'TT only values unchanged').
 RUN Check(NOT res:Has('audit') AND NOT res:Has('committed'),'no invented event').
 PUT UNFORMATTED 'PASS fiscal checks=' checks ' NUM-DBS=' NUM-DBS ' culture=' SESSION:NUMERIC-FORMAT SKIP.
 CATCH e AS Progress.Lang.Error: PUT UNFORMATTED 'FAIL ' e:GetMessage(1) SKIP. END CATCH.
END.
OUTPUT CLOSE. QUIT.
PROCEDURE Request:
 DEFINE INPUT PARAMETER resourceValue AS CHARACTER NO-UNDO. DEFINE INPUT PARAMETER operationValue AS CHARACTER NO-UNDO. DEFINE INPUT PARAMETER ownerValue AS INTEGER NO-UNDO. DEFINE INPUT PARAMETER selectedValue AS INTEGER NO-UNDO.
 req=NEW JsonObject(). req:Add('resource',resourceValue). req:Add('operation',operationValue). req:Add('container_id',ownerValue).
 req:Add(IF resourceValue='container_despesa_memoria_med' THEN 'despesa_container_id' ELSE 'calc_imp_container_id',selectedValue).
END PROCEDURE.
PROCEDURE Invoke:
 res=?. IF SEARCH('sursum-api/programs/ContainerFiscalReadOnlyService.p')=? THEN RETURN.
 RUN sursum-api/programs/ContainerFiscalReadOnlyService.p(INPUT BUFFER containers:HANDLE,INPUT BUFFER calcs:HANDLE,INPUT BUFFER expenses:HANDLE,req,OUTPUT res).
END PROCEDURE.
PROCEDURE Check:
 DEFINE INPUT PARAMETER ok AS LOGICAL NO-UNDO. DEFINE INPUT PARAMETER msg AS CHARACTER NO-UNDO.
 checks=checks + 1. IF ok<>TRUE OR ok=? THEN UNDO, THROW NEW Progress.Lang.AppError(msg,1).
END PROCEDURE.
PROCEDURE Status:
 DEFINE INPUT PARAMETER statusValue AS INTEGER NO-UNDO. DEFINE INPUT PARAMETER msg AS CHARACTER NO-UNDO.
 RUN Check(NOT res:GetLogical('success') AND res:GetJsonObject('error'):GetInteger('status')=statusValue,msg).
END PROCEDURE.
