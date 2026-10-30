from pathlib import Path
import json,hashlib,re,difflib,sys
root=Path(__file__).resolve().parents[1];w=root.parents[2];canonical=Path('D:/opencode/motor-progress/v2')
predecessor=w/'.runtime/ciw-completion-20261028/container-tax-only/frozen-v1'
state=w/'.runtime/ciw-completion-20261028/container-expense-default-selection';red='--red'in sys.argv;stage=state/('red'if red else'local');stage.mkdir(parents=True,exist_ok=True)
pre=json.loads((predecessor/'patches/abl-plan.json').read_text(encoding='utf-8'));files={};predecessorHashes=[];physicalBaselines={};integrated={}
prior=json.loads((root/'patches/core-plan.json').read_text(encoding='utf-8'))
expected={e['target']:e['expectedFutureBaselineSha256']for e in prior['predecessorBaselines']}
for entry in pre['textPatches']:
 target=Path(entry['target']);raw=target.read_bytes();current=hashlib.sha256(raw).hexdigest()
 text=raw.decode('utf-8-sig').replace('\r\n','\n')
 is_integrated=hashlib.sha256(text.encode()).hexdigest()==expected[target.as_posix()]
 if not is_integrated:
  assert current==entry['baselineSha256'],f'Canonical changed: explicit root rebase required {target}'
  for c in entry['changes']:
   assert text.count(c['old'])==1,(target,c['old']);text=text.replace(c['old'],c['new'])
 name=target.relative_to(canonical).as_posix();files[name]=text;physicalBaselines[name]=current;integrated[name]=is_integrated
 predecessorHashes.append({'target':target.as_posix(),'canonicalBaselineSha256':current,'predecessorManifest':(predecessor/'manifest.json').as_posix(),'predecessorAlreadyIntegrated':is_integrated,'expectedFutureBaselineSha256':hashlib.sha256(text.encode()).hexdigest()})
if not red:exec((root/'tests/patches.py').read_text(encoding='utf-8'))
files['sursum-api/programs/CiwTaxAmount.p']=(canonical/'sursum-api/programs/CiwTaxAmount.p').read_text(encoding='utf-8-sig')
suite=(canonical/'tests/abl/container-panel/ContainersImpostosTest.p').read_text(encoding='utf-8-sig').replace('  RUN DistributionTests.','  RUN DistributionTests.\n  RUN TaxOnlyTests.\n  RUN SelectedDefaultTests.').replace('  iExpenseCalls=iExpenseCalls + 1.','  iExpenseCalls=iExpenseCalls + 1.\n  IF iFailAt=-1 THEN STOP.')
files['ContainersImpostosTest.p']=suite+'\n'+(predecessor/'tests/ContainersTaxOnlyTests.i').read_text(encoding='utf-8')+'\n'+(root/'tests/SelectedExpenseDefaultsTests.i').read_text(encoding='utf-8')
files['ContainersImpostosService.p']='{sursum-api/programs/ContainersImpostosService.p}\n'
if not red:
 process=(canonical/'tests/abl/container-panel/ContainersProcessosFiscalTest.p').read_text(encoding='utf-8-sig')
 process=process.replace('DEFINE VARIABLE parser AS ObjectModelParser NO-UNDO.','DEFINE VARIABLE parser AS ObjectModelParser NO-UNDO.\nDEFINE VARIABLE testUtf8 AS LONGCHAR NO-UNDO.\nDEFINE VARIABLE selectionLookup AS LOGICAL NO-UNDO.').replace('RUN Fixture. RUN Invoke.','FIX-CODEPAGE(testUtf8)="UTF-8".\nRUN Fixture. RUN Invoke.',1).replace('o=CAST(parser:Parse(lc),JsonObject).','testUtf8=lc. o=CAST(parser:Parse(testUtf8),JsonObject).')
 process=process.replace('"sincronizar"','"selecionar_despesas"').replace('OUTPUT TO VALUE("containers-processes-fiscal-tests-"','RUN SelectionRootTests.\nOUTPUT TO VALUE("containers-selection-root-tests-"').replace('RUN Fixture. failQuotes=TRUE.','result:WriteFile("selection-process-success.json",TRUE).\nRUN Fixture. failQuotes=TRUE.')
 process=process.replace('req:Add("container_id",123).','req:Add("container_id",123).\n IF selectionLookup THEN DO: req:Set("resource","despesas-selecao"). req:Set("operation","options"). END.\n ELSE DO: result=NEW JsonObject(). result:Add("ids",NEW JsonArray()). result:GetJsonArray("ids"):Add(40). req:Add("despesa_ids",result:GetJsonArray("ids")). END.\n req:Add("ordem_campo","ordem"). req:Add("ordem_direcao","asc").')
 files['ContainersSelectionRootTest.p']=process+'\n'+(root/'tests/SelectionRootTests.i').read_text(encoding='utf-8')
 files['ContainersProcessosService.p']='{sursum-api/programs/ContainersProcessosService.p}\n'
pending=list(files.items())
while pending:
 name,text=pending.pop()
 for inc in re.findall(r'\{(sursum-api/[^\s{}]+\.i)',text):
  if inc not in files:files[inc]=(canonical/inc).read_text(encoding='utf-8-sig');pending.append((inc,files[inc]))
for name,text in files.items():p=stage/name;p.parent.mkdir(parents=True,exist_ok=True);p.write_text(text,encoding='utf-8')
(stage/'Execute.p').write_text("BLOCK-LEVEL ON ERROR UNDO, THROW.\nOUTPUT TO 'execution.log'.\nDO ON ERROR UNDO, THROW:\n RUN ContainersImpostosTest.r.\n"+(''if red else 'RUN ContainersSelectionRootTest.r.\n')+" PUT UNFORMATTED 'PASS EXECUTE NUM-DBS=' NUM-DBS SKIP.\n CATCH e AS Progress.Lang.Error: PUT UNFORMATTED 'FAIL ' e:GetMessage(1) SKIP. END CATCH.\nEND. OUTPUT CLOSE. QUIT.\n",encoding='utf-8')
entries=[n for n in files if n.endswith('.p') and not n.endswith('/ContainersProcessos.p')]
(stage/'Compile.p').write_text('''DEFINE VARIABLE k AS INTEGER NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.
OUTPUT TO 'compile.log'. PUT UNFORMATTED 'OpenEdge ' PROVERSION ' NUM-DBS=' NUM-DBS SKIP.
DO k=1 TO NUM-ENTRIES("'''+','.join(entries)+'''"):
 COMPILE VALUE(ENTRY(k,"'''+','.join(entries)+'''")) SAVE NO-ERROR.
 PUT UNFORMATTED ENTRY(k,"'''+','.join(entries)+'''") ' COMPILER:ERROR=' COMPILER:ERROR SKIP.
 IF COMPILER:ERROR THEN DO: DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END. OUTPUT CLOSE. QUIT. END.
END. PUT UNFORMATTED 'PASS COMPILE ALL' SKIP. OUTPUT CLOSE. QUIT.
''',encoding='utf-8')
print(stage)
