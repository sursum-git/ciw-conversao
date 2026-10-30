/* Physical PK3 isolated fixture; no connected database, writer, sequence or formula. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE TEMP-TABLE ttRelation NO-UNDO
 FIELD despesa_id AS INTEGER FIELD imposto_id AS INTEGER FIELD empresa_id AS INTEGER
 INDEX pk IS PRIMARY UNIQUE despesa_id imposto_id empresa_id.
DEFINE VARIABLE req AS JsonObject NO-UNDO. DEFINE VARIABLE result AS JsonObject NO-UNDO.
DEFINE VARIABLE rowValue AS JsonObject NO-UNDO. DEFINE VARIABLE keyValue AS CHARACTER NO-UNDO.
DEFINE VARIABLE rows AS JsonArray NO-UNDO. DEFINE VARIABLE sortValue AS JsonArray NO-UNDO.
DEFINE VARIABLE obj AS JsonObject NO-UNDO. DEFINE VARIABLE names AS CHARACTER EXTENT NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO. DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE duplicateRow AS ROWID NO-UNDO.
RUN Check(NUM-DBS=0,'NUMDBS0').
RUN AddRow(7,9,1). RUN AddRow(7,9,2). RUN AddRow(0,0,0).
RUN AddRow(?,9,1). RUN AddRow(7,?,1). RUN AddRow(7,9,?). RUN AddRow(?,?,?).
RUN AddRow(-2147483648,2147483647,-1).
RUN NewRead. RUN Invoke. RUN Check(result:GetLogical('success'),'global relation resource exists').
RUN Check(result:GetInteger('total')=8 AND result:GetJsonArray('data'):Length=8,'all physical rows no company filter or pair dedup').
rows=result:GetJsonArray('data'). result:WriteFile('expense-tax-relations-actual.json',TRUE).
DO n=1 TO rows:Length:
 rowValue=rows:GetJsonObject(n). names=rowValue:GetNames(). RUN Check(EXTENT(names)=4,'three physical fields and hidden identity').
 keyValue=rowValue:GetCharacter('record_key'). req=NEW JsonObject(). req:Add('operation','get'). req:Add('id',keyValue). req:Add('record_key',keyValue). RUN Invoke.
 RUN Check(result:GetLogical('success') AND result:GetJsonObject('data'):GetCharacter('record_key')=keyValue,'each complete nullable physical key get matches').
END.
req=NEW JsonObject(). req:Add('operation','get'). req:Add('id','~{"despesa_id":0,"imposto_id":0,"empresa_id":0}'). RUN Invoke.
RUN Check(result:GetLogical('success') AND result:GetJsonObject('data'):GetInteger('despesa_id')=0,'zero physical key is not invented FK positive').
req:Set('id','~{"despesa_id":7,"imposto_id":9,"empresa_id":2}'). RUN Invoke.
RUN Check(result:GetLogical('success') AND result:GetJsonObject('data'):GetInteger('empresa_id')=2,'third PK part selects second physical row').
req:Set('id','~{"despesa_id":7,"imposto_id":9}'). RUN Invoke. RUN Code('CIW_ERP_KEY_INVALID').
req:Set('id','~{"despesa_id":7,"imposto_id":9,"empresa_id":1,"extra":1}'). RUN Invoke. RUN Code('CIW_ERP_KEY_INVALID').
req:Set('id','~{"despesa_id":"7","imposto_id":9,"empresa_id":1}'). RUN Invoke. RUN Code('CIW_ERP_VALUE_INVALID').
req:Set('id','~{"despesa_id":7.5,"imposto_id":9,"empresa_id":1}'). RUN Invoke. RUN Code('CIW_ERP_VALUE_INVALID').
req:Set('id','~{"despesa_id":2147483648,"imposto_id":9,"empresa_id":1}'). RUN Invoke. RUN Code('CIW_ERP_VALUE_INVALID').
req:Set('id','~{"despesa_id":77,"imposto_id":9,"empresa_id":1}'). RUN Invoke. RUN Code('CIW_ERP_NOT_FOUND').
req:Add('record_key','~{"despesa_id":7,"imposto_id":9,"empresa_id":1}'). RUN Invoke. RUN Code('CIW_ERP_KEY_INVALID').
req=NEW JsonObject(). req:Add('operation','get'). req:Add('id',keyValue). req:Add('record_key',keyValue + ' '). RUN Invoke. RUN Code('CIW_ERP_KEY_INVALID').
RUN NewRead. req:Add('take',1). req:Add('skip',1). RUN Invoke.
RUN Check(result:GetLogical('success') AND result:GetInteger('total')=8 AND result:GetJsonArray('data'):Length=1,'real server paging retains total8').
req:Set('take',201). RUN Invoke. RUN Code('CIW_ERP_VALUE_INVALID').
RUN NewRead. obj=NEW JsonObject(). obj:Add('field','empresa_id'). obj:Add('operator','isnull'). req:Add('filter',obj). RUN Invoke.
RUN Check(result:GetLogical('success') AND result:GetInteger('total')=2,'NULL filter includes physical unknown company').
obj:Set('operator','eq'). obj:Add('value',2). req:Set('filter',obj). RUN Invoke.
RUN Check(result:GetLogical('success') AND result:GetInteger('total')=1,'company optional user filter only').
obj:Set('field','Empresa_id'). RUN Invoke. RUN Code('CIW_ERP_FIELD_INVALID').
RUN NewRead. sortValue=NEW JsonArray(). obj=NEW JsonObject(). obj:Add('field','empresa_id'). obj:Add('dir','desc'). sortValue:Add(obj). req:Add('sort',sortValue). RUN Invoke.
RUN Check(result:GetLogical('success') AND result:GetInteger('total')=8,'native sort retained with physical PK tie breakers').
RUN NewRead. req:Add('sql','SELECT *'). RUN Invoke. RUN Code('CIW_ERP_REQUEST_INVALID').
RUN NewRead. req:Add('empresa_id',1). RUN Invoke. RUN Code('CIW_ERP_REQUEST_INVALID').
DO n=1 TO 5:
 req=NEW JsonObject(). req:Add('operation',ENTRY(n,'create,update,delete,batch,options')). RUN Invoke. RUN Code('CIW_ERP_READ_ONLY').
END.
RUN NewRead. req:Add('take',1). RUN Invoke. RUN Check(result:GetLogical('success') AND NOT result:GetJsonArray('data'):GetJsonObject(1):IsNull('despesa_id'),'control first page outside unknown tuple').
CREATE ttRelation. ASSIGN ttRelation.despesa_id=? ttRelation.imposto_id=? ttRelation.empresa_id=? duplicateRow=ROWID(ttRelation). RELEASE ttRelation.
RUN NewRead. req:Add('take',1). RUN Invoke. RUN Check(result:Has('error'),'duplicate NULL PK outside page1 must refuse'). RUN Code('CIW_ERP_KEY_AMBIGUOUS').
req=NEW JsonObject(). req:Add('operation','get'). req:Add('id','~{"despesa_id":null,"imposto_id":null,"empresa_id":null}'). RUN Invoke. RUN Code('CIW_ERP_KEY_AMBIGUOUS').
FIND ttRelation WHERE ROWID(ttRelation)=duplicateRow. DELETE ttRelation.
RUN NewRead. req:Add('take',1). RUN Invoke. RUN Check(result:GetLogical('success') AND result:GetInteger('total')=8,'unique corpus restored including zero negative nullable keys').
DO TRANSACTION: DO n=1 TO 49993: CREATE ttRelation. ASSIGN ttRelation.despesa_id=n ttRelation.imposto_id=100 ttRelation.empresa_id=100. END. END.
RUN NewRead. req:Add('take',1). RUN Invoke. RUN Code('CIW_ERP_QUERY_LIMIT'). RUN Check(NOT result:Has('data'),'no partial over50k').
OUTPUT TO VALUE('expense-tax-relations-' + SESSION:NUMERIC-FORMAT + '.log'). PUT UNFORMATTED 'PASS ' checks ' checks NUMDBS=' NUM-DBS SKIP. OUTPUT CLOSE.
PROCEDURE AddRow:
 DEFINE INPUT PARAMETER d AS INTEGER NO-UNDO. DEFINE INPUT PARAMETER t AS INTEGER NO-UNDO. DEFINE INPUT PARAMETER e AS INTEGER NO-UNDO.
 CREATE ttRelation. ASSIGN ttRelation.despesa_id=d ttRelation.imposto_id=t ttRelation.empresa_id=e.
END PROCEDURE.
PROCEDURE NewRead: req=NEW JsonObject(). req:Add('operation','read'). END PROCEDURE.
PROCEDURE Invoke: RUN sursum-api/programs/CiwErpReadService.r (INPUT BUFFER ttRelation:HANDLE,INPUT 'despesas_impostos_geral',INPUT '',INPUT req,OUTPUT result). END PROCEDURE.
PROCEDURE Check:
 DEFINE INPUT PARAMETER conditionValue AS LOGICAL NO-UNDO. DEFINE INPUT PARAMETER labelValue AS CHARACTER NO-UNDO.
 checks=checks + 1. IF conditionValue<>TRUE THEN UNDO, THROW NEW Progress.Lang.AppError('FAIL ' + labelValue,1).
END PROCEDURE.
PROCEDURE Code:
 DEFINE INPUT PARAMETER expected AS CHARACTER NO-UNDO.
 RUN Check(NOT result:GetLogical('success') AND result:GetJsonObject('error'):GetCharacter('code')=expected,'expected ' + expected).
END PROCEDURE.
