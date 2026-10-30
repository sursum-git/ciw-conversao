from pathlib import Path
import sys,re,json,hashlib,difflib
root=Path(__file__).resolve().parents[1]
canonical=Path('D:/opencode/motor-progress/v2')
state=Path('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-tax-only')
red='--red' in sys.argv
stage=state/('red' if red else 'local');stage.mkdir(parents=True,exist_ok=True)
files={}
for name in ['ContainersImpostosService.p','ContainersProcessosService.p','CiwTaxAmount.p']:
 files['sursum-api/programs/'+name]=(canonical/'sursum-api/programs'/name).read_text(encoding='utf-8-sig')
if not red:
 exec((root/'tests/patches.py').read_text(encoding='utf-8'))
suite=(canonical/'tests/abl/container-panel/ContainersImpostosTest.p').read_text(encoding='utf-8-sig').replace('  RUN DistributionTests.','  RUN DistributionTests.\n  RUN TaxOnlyTests.').replace('  iExpenseCalls=iExpenseCalls + 1.','  iExpenseCalls=iExpenseCalls + 1.\n  IF iFailAt=-1 THEN STOP.')
files['ContainersImpostosTest.p']=suite+'\n'+(root/'tests/ContainersTaxOnlyTests.i').read_text(encoding='utf-8')
files['ContainersImpostosService.p']='{sursum-api/programs/ContainersImpostosService.p}\n'
process=(canonical/'tests/abl/container-panel/ContainersProcessosFiscalTest.p').read_text(encoding='utf-8-sig')
# Fixture literal conversion only, for running the original harness in ISO8859-1.
process=process.replace('DEFINE VARIABLE parser AS ObjectModelParser NO-UNDO.','DEFINE VARIABLE parser AS ObjectModelParser NO-UNDO.\nDEFINE VARIABLE testUtf8 AS LONGCHAR NO-UNDO.').replace('RUN Fixture. RUN Invoke.','FIX-CODEPAGE(testUtf8)="UTF-8".\nRUN Fixture. RUN Invoke.',1).replace('o=CAST(parser:Parse(lc),JsonObject).','testUtf8=lc. o=CAST(parser:Parse(testUtf8),JsonObject).')
files['ContainersProcessosFiscalTest.p']=process
if not red:
 process=process.replace('"sincronizar"','"calcular_impostos"').replace('OUTPUT TO VALUE("containers-processes-fiscal-tests-"','RUN TaxOnlyRootTests.\nOUTPUT TO VALUE("containers-tax-only-root-tests-"').replace('RUN Fixture. failQuotes=TRUE.','result:WriteFile("tax-only-process-success.json",TRUE).\nRUN Fixture. failQuotes=TRUE.')
 files['ContainersTaxOnlyProcessTest.p']=process+'\n'+(root/'tests/ContainersTaxOnlyProcessTests.i').read_text(encoding='utf-8')
files['ContainersProcessosService.p']='{sursum-api/programs/ContainersProcessosService.p}\n'
if not red:
 boundary=(canonical/'tests/abl/container-panel/ContainersProcessBoundaryTest.p').read_text(encoding='utf-8-sig')
 boundary=boundary.replace('policyValue=ContainerMaintenancePolicy("TT"). RUN Check(policyValue:GetInteger("despesa_distr_custo")=0,', '''requestValue=NEW JsonObject(). requestValue:Add("resource","impostos"). requestValue:Add("operation","calcular_impostos"). requestValue:Add("container_id",123).
RUN Check(ContainerProcessRequest(requestValue)=123,"new tax-only fixed operation accepted").
requestValue:Add("percentual",99). RUN RejectRequest. requestValue:Remove("percentual").
requestValue:Add("actor","forged"). RUN RejectRequest. requestValue:Remove("actor").
requestValue:Add("policy",NEW JsonObject()). RUN RejectRequest. requestValue:Remove("policy").
requestValue:Add("database","other"). RUN RejectRequest. requestValue:Remove("database").
requestValue:Add("Container_id",123). RUN RejectRequest. requestValue:Remove("Container_id").
requestValue:Set("resource","custos"). RUN RejectRequest.
policyValue=ContainerMaintenancePolicy("TT"). RUN Check(policyValue:GetInteger("despesa_distr_custo")=0,''')
 files['ContainersProcessBoundaryTest.p']=boundary
pending=list(files.items())
while pending:
 name,content=pending.pop()
 for inc in re.findall(r'\{(sursum-api/[^\s{}]+\.i)',content):
  if inc not in files: files[inc]=(canonical/inc).read_text(encoding='utf-8-sig');pending.append((inc,files[inc]))
for name,content in files.items():
 p=stage/name;p.parent.mkdir(parents=True,exist_ok=True);p.write_text(content,encoding='utf-8')
entries=[n for n in files if n.endswith('.p') and not n.endswith('/ContainersProcessos.p')]
(stage/'Compile.p').write_text('''DEFINE VARIABLE k AS INTEGER NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.
OUTPUT TO 'compile.log'. PUT UNFORMATTED 'OpenEdge ' PROVERSION ' NUM-DBS=' NUM-DBS SKIP.
DO k=1 TO NUM-ENTRIES("'''+','.join(entries)+'''"):
 COMPILE VALUE(ENTRY(k,"'''+','.join(entries)+'''")) SAVE NO-ERROR.
 PUT UNFORMATTED ENTRY(k,"'''+','.join(entries)+'''") ' COMPILER:ERROR=' COMPILER:ERROR SKIP.
 IF COMPILER:ERROR THEN DO: DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END. OUTPUT CLOSE. QUIT. END.
END.
PUT UNFORMATTED 'PASS COMPILE ALL' SKIP. OUTPUT CLOSE. QUIT.
''',encoding='utf-8')
(stage/'Execute.p').write_text('''BLOCK-LEVEL ON ERROR UNDO, THROW.
OUTPUT TO 'execution.log'.
DO ON ERROR UNDO, THROW:
 RUN ContainersImpostosTest.r.
 RUN ContainersProcessosFiscalTest.r.
 '''+('' if red else 'RUN ContainersTaxOnlyProcessTest.r. RUN ContainersProcessBoundaryTest.r.')+'''
 PUT UNFORMATTED 'PASS EXECUTE NUM-DBS=' NUM-DBS SKIP.
 CATCH e AS Progress.Lang.Error: PUT UNFORMATTED 'FAIL ' e:GetMessage(1) SKIP. END CATCH.
END.
OUTPUT CLOSE. QUIT.
''',encoding='utf-8')
print(stage)
