from pathlib import Path
import sys,re,json,hashlib
candidate=Path(__file__).resolve().parents[1]
canonical=Path('D:/opencode/motor-progress/v2')
stage=Path(sys.argv[1]); red=sys.argv[2]=='red'
stage.mkdir(parents=True,exist_ok=True)
files={'ContainerFiscalReadOnlyTest.p':candidate/'tests/ContainerFiscalReadOnlyTest.p'}
if not red:
 for p in (candidate/'abl').glob('*.p'): files['sursum-api/programs/'+p.name]=p
 files['CiwErpReadTest.p']=canonical/'tests/abl/ciw-erp-consultas/CiwErpReadTest.p'
 files['PurchaseItemsReadTest.p']=canonical/'tests/abl/purchase-items/PurchaseItemsReadTest.p'
 files['CiwMedCompanyContext.p']=canonical/'sursum-api/programs/CiwMedCompanyContext.p'
 shared=canonical/'sursum-api/programs/CiwErpReadService.p'
 text=shared.read_text(encoding='utf-8-sig')
 plan=json.loads((candidate/'patches/patch-plan.json').read_text(encoding='utf-8'))
 for patch in plan['textPatches']:
  if patch['target']!=str(shared).replace('\\','/'): continue
  assert hashlib.sha256(shared.read_bytes()).hexdigest()==patch['baselineSha256'],'shared baseline changed'
  for change in patch['changes']:
   assert text.count(change['old'])==1,'patch context mismatch'
   text=text.replace(change['old'],change['new'])
 target=stage/'sursum-api/programs/CiwErpReadService.p';target.parent.mkdir(parents=True,exist_ok=True);target.write_text(text,encoding='utf-8')
 for patch in plan['textPatches']:
  if not patch['target'].endswith(('/RuntimeCiwErpQuery.php','/RuntimeApiEntityActionService.php')):continue
  original=Path(patch['target']);assert hashlib.sha256(original.read_bytes()).hexdigest()==patch['baselineSha256']
  php=original.read_text(encoding='utf-8-sig')
  for change in patch['changes']:
   assert php.count(change['old'])==1;php=php.replace(change['old'],change['new'])
  (stage/Path(patch['target']).name).write_text(php,encoding='utf-8')
 (stage/'CiwErpReadService.p').write_text('''USING Progress.Json.ObjectModel.*.
DEFINE INPUT PARAMETER h AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER resourceValue AS CHARACTER NO-UNDO.
DEFINE INPUT PARAMETER companyValue AS CHARACTER NO-UNDO.
DEFINE INPUT PARAMETER requestValue AS JsonObject NO-UNDO.
DEFINE OUTPUT PARAMETER responseValue AS JsonObject NO-UNDO.
RUN sursum-api/programs/CiwErpReadService.p(h,resourceValue,companyValue,requestValue,OUTPUT responseValue).
''',encoding='utf-8')
pending=list(files.values())+[canonical/'sursum-api/programs/CiwErpReadService.p']
while pending:
 p=pending.pop()
 for include in re.findall(r'\{(sursum-api/[^\s{}]+\.i)',p.read_text(encoding='utf-8-sig')):
  if include not in files: files[include]=canonical/include;pending.append(canonical/include)
for target,p in files.items():
 q=stage/target;q.parent.mkdir(parents=True,exist_ok=True);q.write_bytes(p.read_bytes())
entries=[p for p in files if p.endswith('.p')]
if not red: entries+=['sursum-api/programs/CiwErpReadService.p','CiwErpReadService.p']
(stage/'Compile.p').write_text('''DEFINE VARIABLE entries AS CHARACTER NO-UNDO INITIAL "'''+','.join(entries)+'''".
DEFINE VARIABLE k AS INTEGER NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.
OUTPUT TO 'compile.log'. PUT UNFORMATTED 'OpenEdge ' PROVERSION ' NUM-DBS=' NUM-DBS SKIP.
DO k=1 TO NUM-ENTRIES(entries):
 COMPILE VALUE(ENTRY(k,entries)) SAVE NO-ERROR.
 PUT UNFORMATTED ENTRY(k,entries) ' COMPILER:ERROR=' COMPILER:ERROR SKIP.
 IF COMPILER:ERROR THEN DO: DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END. OUTPUT CLOSE. QUIT. END.
END.
PUT UNFORMATTED 'PASS COMPILE ALL' SKIP. OUTPUT CLOSE. QUIT.
''',encoding='utf-8')
