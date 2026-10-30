from pathlib import Path
import json,hashlib,sys,re
W=Path('D:/opencode/conversao-sc');ROOT=Path(__file__).resolve().parents[1]
STATE=W/'.runtime/ciw-completion-20261028/expense-tax-relations-readonly';M=Path('D:/opencode/motor-progress/v2')
red='--red' in sys.argv;stage=STATE/('red'if red else'local');stage.mkdir(parents=True,exist_ok=True)
def cp(a,b):b.parent.mkdir(parents=True,exist_ok=True);b.write_bytes(a.read_bytes())
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
refs=['sursum-api/programs/CiwErpReadService.p','sursum-api/programs/CiwCadastrosCrud.p','sursum-api/programs/CiwMedCompanyContext.p','sursum-api/includes/PurchaseOrderSnapshot.i','sursum-api/includes/PurchaseItemSnapshot.i','sursum-api/includes/PurchaseItemValueRules.i']
for rel in refs:
 pinned=STATE/'baseline'/rel
 if not pinned.exists():cp(M/rel,pinned)
 cp(pinned,stage/rel)
if not red:
 for patch in json.loads((ROOT/'patches/patch-plan.json').read_text())['textPatches']:
  if not patch['relative'].startswith('sursum-api/'):continue
  dest=stage/patch['relative'];data=dest.read_bytes();assert sha(dest)==patch['baselineSha256']
  for h in patch['changes']:
   a=bytes.fromhex(h['oldBytesHex']);b=bytes.fromhex(h['newBytesHex']);assert data.count(a)==1;data=data.replace(a,b,1)
  assert hashlib.sha256(data).hexdigest()==patch['candidateSha256'];dest.write_bytes(data)
cp(ROOT/'tests/ExpenseTaxRelationsReadTest.p',stage/'ExpenseTaxRelationsReadTest.p')
baseline_test=STATE/'baseline/CiwErpReadTest.p'
if not baseline_test.exists():cp(W/'.runtime/ciw-completion-20261028/official-build8/package/CiwErpReadTest.p',baseline_test)
cp(baseline_test,stage/'CiwErpReadTest.p')
(stage/'CiwErpReadService.p').write_bytes(b'{sursum-api/programs/CiwErpReadService.p}\n')
(stage/'CiwMedCompanyContext.p').write_bytes(b'{sursum-api/programs/CiwMedCompanyContext.p}\n')
entries='sursum-api/programs/CiwErpReadService.p,sursum-api/programs/CiwMedCompanyContext.p,CiwErpReadService.p,CiwMedCompanyContext.p,ExpenseTaxRelationsReadTest.p,CiwErpReadTest.p'
(stage/'Compile.p').write_text('''DEFINE VARIABLE n AS INTEGER NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.
OUTPUT TO 'compile.log'. PUT UNFORMATTED 'OpenEdge ' PROVERSION ' NUMDBS=' NUM-DBS SKIP.
IF NUM-DBS<>0 THEN DO: PUT UNFORMATTED 'FAIL connected DB forbidden' SKIP. OUTPUT CLOSE. QUIT. END.
DO n=1 TO NUM-ENTRIES("'''+entries+'''"):
 COMPILE VALUE(ENTRY(n,"'''+entries+'''")) SAVE NO-ERROR.
 IF COMPILER:ERROR THEN DO: DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END. OUTPUT CLOSE. QUIT. END.
END. PUT UNFORMATTED 'PASS COMPILE' SKIP. OUTPUT CLOSE. QUIT.
''',encoding='utf-8')
(stage/'Execute.p').write_text("OUTPUT TO 'execution.log'. DO ON ERROR UNDO, THROW: IF NUM-DBS<>0 THEN UNDO, THROW NEW Progress.Lang.AppError('DB forbidden',1). RUN ExpenseTaxRelationsReadTest.r. PUT UNFORMATTED 'PASS EXECUTE NUMDBS=' NUM-DBS SKIP. CATCH e AS Progress.Lang.Error: PUT UNFORMATTED 'FAIL ' e:GetMessage(1) SKIP. END CATCH. END. OUTPUT CLOSE. QUIT.\n",encoding='utf-8')
(stage/'LegacyExecute.p').write_text("IF NUM-DBS<>0 THEN UNDO, THROW NEW Progress.Lang.AppError('DB forbidden',1). RUN CiwErpReadTest.r. QUIT.\n",encoding='utf-8')
print(json.dumps({'stage':str(stage),'red':red,'readerSha256':sha(stage/refs[0])}))
