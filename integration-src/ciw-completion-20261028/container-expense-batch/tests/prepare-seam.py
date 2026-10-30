from pathlib import Path
import json,hashlib,difflib,re,sys
root=Path(__file__).resolve().parents[1];canonical=Path('D:/opencode/motor-progress/v2');stage=Path('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-expense-batch')/('red'if '--red'in sys.argv else'local')
stage.mkdir(parents=True,exist_ok=True);red='--red'in sys.argv
shared=canonical/'sursum-api/programs/ContainersDespesasCrudService.p';before=shared.read_text(encoding='utf-8-sig');after=before
changes=[dict(old='DEFINE TEMP-TABLE ttRow NO-UNDO',new='DEFINE VARIABLE oBatchExpected AS JsonObject NO-UNDO.\n{sursum-api/includes/ContainerExpenseBatchSnapshot.i}\nDEFINE TEMP-TABLE ttRow NO-UNDO'),dict(old='  oMasterBefore=Snapshot(phContainer). cPrefix=phContainer:BUFFER-FIELD("cod-estabel"):BUFFER-VALUE.',new='''  oMasterBefore=Snapshot(phContainer). cPrefix=phContainer:BUFFER-FIELD("cod-estabel"):BUFFER-VALUE.
  IF VALID-OBJECT(oBatchExpected) THEN DO:
   cFailure="CONTAINER_EXPENSE_COMPANY".
   IF cPrefix=? OR NOT cPrefix BEGINS "5" THEN UNDO, THROW NEW Progress.Lang.AppError("Native expense batch requires locked MED owner.",1).
  END.'''),dict(old=' cFailure="CONTAINER_EXPENSE_CONFIGURATION".\n IF NOT VALID-HANDLE(phContainer)',new=''' IF VALID-OBJECT(poPolicy) THEN IF poPolicy:Has("batch_expected_before") THEN DO:
  IF NOT lBatch OR poPolicy:GetType("batch_expected_before")<>JsonDataType:OBJECT THEN UNDO, THROW NEW Progress.Lang.AppError("Expected images require private batch opt-in.",1).
  oBatchExpected=poPolicy:GetJsonObject("batch_expected_before"). EXTENT(cNames)=?. cNames=oBatchExpected:GetNames().
  IF EXTENT(cNames)<>oRows:Length THEN UNDO, THROW NEW Progress.Lang.AppError("Complete batch expected images required.",1).
  FOR EACH ttRow:
   cField=TRIM(STRING(ttRow.id,"->>>>>>>>>9")).
   IF NOT oBatchExpected:Has(cField) OR oBatchExpected:GetType(cField)<>JsonDataType:OBJECT THEN UNDO, THROW NEW Progress.Lang.AppError("Expected row missing.",1).
   oRow=oBatchExpected:GetJsonObject(cField).
   IF NOT ExpenseBatchImageValid(oRow) THEN UNDO, THROW NEW Progress.Lang.AppError("Invalid physical expected image.",1).
   IF oRow:GetInteger("despesa_container_id")<>ttRow.id OR oRow:GetInteger("container_id")<>iContainer THEN UNDO, THROW NEW Progress.Lang.AppError("Expected identity differs.",1).
  END.
 END.
 cFailure="CONTAINER_EXPENSE_CONFIGURATION".
 IF NOT VALID-HANDLE(phContainer)'''),dict(old='   oBeforeRows[ttRow.ordinal]=oBefore.',new='''   IF VALID-OBJECT(oBatchExpected) THEN DO:
    cFailure="CONTAINER_EXPENSE_CHANGED".
    IF NOT ExpenseBatchImageSame(oBefore,oBatchExpected:GetJsonObject(TRIM(STRING(ttRow.id,"->>>>>>>>>9")))) THEN UNDO, THROW NEW Progress.Lang.AppError("Despesa alterada; recarregue o lote.",1).
   END.
   oBeforeRows[ttRow.ordinal]=oBefore.'''),dict(old='"CONTAINER_BUSY,CONTAINER_EXPENSE_PERSISTENCE,CONTAINER_TRANSACTION_CONTEXT"',new='"CONTAINER_BUSY,CONTAINER_EXPENSE_PERSISTENCE,CONTAINER_TRANSACTION_CONTEXT,CONTAINER_EXPENSE_CHANGED"')]
for c in changes:assert after.count(c['old'])==1;after=after.replace(c['old'],c['new'])
p=root/'patches';p.mkdir(parents=True,exist_ok=True)
(p/'ContainersDespesasCrudService.p.patch').write_text(''.join(difflib.unified_diff(before.splitlines(True),after.splitlines(True),fromfile=str(shared),tofile=str(shared))),encoding='utf-8')
(p/'seam-plan.json').write_text(json.dumps(dict(target=str(shared).replace('\\','/'),baselineSha256=hashlib.sha256(shared.read_bytes()).hexdigest(),changes=changes),indent=2),encoding='utf-8')
suite=(canonical/'tests/abl/container-panel/ContainersDespesasCrudTest.p').read_text(encoding='utf-8-sig').replace('RUN DerivedEchoTests.','RUN DerivedEchoTests.\nRUN BatchSeamTests.\nRUN BatchBridgeTests.').replace('FUNCTION CountRows RETURNS INTEGER (hIndex AS INTEGER) FORWARD.','FUNCTION CountRows RETURNS INTEGER (hIndex AS INTEGER) FORWARD.\nFUNCTION ExpenseTestImageComplete RETURNS LOGICAL(o AS JsonObject) FORWARD.')
# Existing fixture parser accepts UTF encodings only. Convert literals in the
# staged test harness; production/core sources are untouched by this harness fix.
suite=suite.replace('DEFINE VARIABLE parser AS ObjectModelParser NO-UNDO.','DEFINE VARIABLE parser AS ObjectModelParser NO-UNDO.\nDEFINE VARIABLE testUtf8 AS LONGCHAR NO-UNDO.').replace('RUN Fixture.','FIX-CODEPAGE(testUtf8)="UTF-8".\nRUN Fixture.',1).replace('req=CAST(parser:Parse(lc),JsonObject).','testUtf8=lc. req=CAST(parser:Parse(testUtf8),JsonObject).').replace('o=CAST(parser:Parse(lc),JsonObject).','testUtf8=lc. o=CAST(parser:Parse(testUtf8),JsonObject).')
files={'sursum-api/programs/ContainersDespesasCrudService.p':after if not red else before,'sursum-api/includes/ContainerExpenseBatchSnapshot.i':(root/'abl/ContainerExpenseBatchSnapshot.i').read_text(encoding='utf-8'),'ContainersDespesasCrudService.p':'{sursum-api/programs/ContainersDespesasCrudService.p}\n','ContainersDespesasCrudTest.p':suite+'\n'+(root/'tests/ContainerExpenseBatchSeamTests.i').read_text(encoding='utf-8')+'\n'+(root/'tests/ContainerExpenseBatchBridgeTests.i').read_text(encoding='utf-8'),'sursum-api/programs/ContainersDespesasBatchService.p':(root/'abl/ContainersDespesasBatchService.p').read_text(encoding='utf-8')}
reader=Path('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-expense-batch/bridge/CiwErpReadService.p')
files['sursum-api/programs/CiwErpReadService.p']=reader.read_text(encoding='utf-8')
for name in ['ContainersImpostosService.p','CiwTaxAmount.p']:
 p=canonical/'sursum-api/programs'/name
 if p.exists():files['sursum-api/programs/'+name]=p.read_text(encoding='utf-8-sig')
pending=list(files.items())
while pending:
 name,text=pending.pop()
 for inc in re.findall(r'\{(sursum-api/[^\s{}]+\.i)',text):
  if inc not in files:files[inc]=(canonical/inc).read_text(encoding='utf-8-sig');pending.append((inc,files[inc]))
for name,text in files.items():p=stage/name;p.parent.mkdir(parents=True,exist_ok=True);p.write_text(text,encoding='utf-8')
(stage/'Execute.p').write_text('''BLOCK-LEVEL ON ERROR UNDO, THROW.
OUTPUT TO 'execution.log'.
DO ON ERROR UNDO, THROW:
 RUN ContainersDespesasCrudTest.r.
 PUT UNFORMATTED 'PASS EXECUTE NUM-DBS=' NUM-DBS SKIP.
 CATCH e AS Progress.Lang.Error: PUT UNFORMATTED 'FAIL ' e:GetMessage(1) SKIP. END CATCH.
END.
OUTPUT CLOSE. QUIT.
''',encoding='utf-8')
entries=[n for n in files if n.endswith('.p')]
(stage/'Compile.p').write_text('''DEFINE VARIABLE k AS INTEGER NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.
OUTPUT TO 'compile.log'. PUT UNFORMATTED 'OpenEdge ' PROVERSION ' NUM-DBS=' NUM-DBS SKIP.
DO k=1 TO NUM-ENTRIES("'''+','.join(entries)+'''"):
 COMPILE VALUE(ENTRY(k,"'''+','.join(entries)+'''")) SAVE NO-ERROR.
 PUT UNFORMATTED ENTRY(k,"'''+','.join(entries)+'''") ' COMPILER:ERROR=' COMPILER:ERROR SKIP.
 IF COMPILER:ERROR THEN DO:
  DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END.
  OUTPUT CLOSE. QUIT.
 END.
END.
PUT UNFORMATTED 'PASS COMPILE ALL' SKIP. OUTPUT CLOSE. QUIT.
''',encoding='utf-8')
print(stage)
