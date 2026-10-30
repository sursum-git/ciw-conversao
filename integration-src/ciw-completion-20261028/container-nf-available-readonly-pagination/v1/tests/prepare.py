from pathlib import Path
import hashlib,json,re,sys
W=Path('D:/opencode/conversao-sc'); P=Path(__file__).resolve().parents[1]
S=W/'.runtime/ciw-completion-20261028/container-nf-available-readonly-pagination/v1'
M=Path('D:/opencode/motor-progress/v2'); F=Path('D:/opencode/construtor-pg')
red='--red' in sys.argv; stage=S/('red' if red else 'local'); stage.mkdir(parents=True,exist_ok=True)
targets={
 'sursum-api/programs/ContainersPainelFinanceReadService.p':M/'sursum-api/programs/ContainersPainelFinanceReadService.p',
 'sursum-api/programs/CiwErpReadService.p':M/'sursum-api/programs/CiwErpReadService.p',
 'php/RuntimeCiwErpQuery.php':F/'backend/src/Runtime/RuntimeCiwErpQuery.php',
 'php/RuntimeApiEntityActionService.php':F/'backend/src/Runtime/RuntimeApiEntityActionService.php',
 'php/RuntimeContainerNfAvailableRead.php':F/'backend/src/Runtime/RuntimeContainerNfAvailableRead.php',
 'php/ProgramBuilderService.php':F/'backend/src/Builder/ProgramBuilderService.php',
 'sursum-api/programs/ContainersPainelFinanceRead.p':M/'sursum-api/programs/ContainersPainelFinanceRead.p'}
def sha(data):return hashlib.sha256(data).hexdigest()
manifest=[]
for rel,canonical in targets.items():
 pinned=S/('baseline11'if(S/'baseline11'/rel).exists()else'baseline')/rel; pinned.parent.mkdir(parents=True,exist_ok=True)
 if not pinned.exists():pinned.write_bytes(canonical.read_bytes())
 assert pinned.read_bytes()==canonical.read_bytes(),'REBASE GATE '+canonical.name
 out=stage/rel;out.parent.mkdir(parents=True,exist_ok=True);out.write_bytes(pinned.read_bytes())
 manifest.append({'relative':rel,'canonical':str(canonical),'baselineSha256':sha(pinned.read_bytes())})
assert manifest[0]['baselineSha256']=='614795f3af80f29a51c467e8170f954540a76a8902034b9cf6186b1c328ac7b5'
(S/'baselines.json').write_text(json.dumps(manifest,indent=2)+'\n',encoding='utf8')
if not red:
 plan=json.loads((P/'patches/patch-plan.json').read_text())
 for patch in plan['textPatches']:
  dest=stage/patch['relative'];data=dest.read_bytes();assert sha(data)==patch['baselineSha256']
  for h in patch['changes']:
   a=bytes.fromhex(h['oldBytesHex']);b=bytes.fromhex(h['newBytesHex']);assert data.count(a)==1;data=data.replace(a,b,1)
  assert sha(data)==patch['candidateSha256'];dest.write_bytes(data)
pending=['sursum-api/includes/ContainerPaymentIdentity.i'];pending+=re.findall(r'\{(sursum-api/[^\s{}]+\.i)',targets['sursum-api/programs/CiwErpReadService.p'].read_text(encoding='utf8'));seen=set()
while pending:
 rel=pending.pop()
 if rel in seen:continue
 seen.add(rel);pinned=S/'baseline'/rel;pinned.parent.mkdir(parents=True,exist_ok=True)
 if not pinned.exists():pinned.write_bytes((M/rel).read_bytes())
 out=stage/rel;out.parent.mkdir(parents=True,exist_ok=True);out.write_bytes(pinned.read_bytes())
 pending+=re.findall(r'\{(sursum-api/[^\s{}]+\.i)',pinned.read_text(encoding='utf8'))
for name in ['NfAvailablePageTest.p']:(stage/name).write_bytes((P/'tests'/name).read_bytes())
old=W/'.runtime/ciw-completion-20261028/official-build10-v2/package'
for name in ['ContainersPainelFinanceReadTest.p','AvailableNfAliasTest.p','AvailableNfFixture.i']:
 (stage/name).write_bytes((old/name).read_bytes())
(stage/'ContainersPainelFinanceReadService.p').write_bytes(b'{sursum-api/programs/ContainersPainelFinanceReadService.p}\n')
(stage/'CiwErpReadService.p').write_bytes(b'{sursum-api/programs/CiwErpReadService.p}\n')
(stage/'CiwMedCompanyContext.p').write_bytes(b'{sursum-api/programs/CiwMedCompanyContext.p}\n')
context=S/'baseline/sursum-api/programs/CiwMedCompanyContext.p';context.parent.mkdir(parents=True,exist_ok=True)
if not context.exists():context.write_bytes((M/'sursum-api/programs/CiwMedCompanyContext.p').read_bytes())
(stage/'sursum-api/programs/CiwMedCompanyContext.p').write_bytes(context.read_bytes())
(stage/'CiwErpReadTest.p').write_bytes((W/'.runtime/ciw-completion-20261028/official-build8/package/CiwErpReadTest.p').read_bytes())
(stage/'ExpenseTaxRelationsReadTest.p').write_bytes((W/'integration-src/ciw-completion-20261028/expense-tax-relations-readonly/frozen-v1.1/tests/ExpenseTaxRelationsReadTest.p').read_bytes())
prior=(old/'ContainerNfAvailableTest.p').read_bytes()
a=b'RUN NewRequest("read",71,""). RUN Invoke. RUN Check(response:GetLogical("success") AND response:GetJsonArray("data"):Length=200,"200 rows boundary inclusive").'
b=b'RUN NewRequest("read",71,""). request:Add("take",200). RUN Invoke. RUN Check(response:GetLogical("success") AND response:GetJsonArray("data"):Length=200,"200 rows page boundary inclusive").'
assert prior.count(a)==1;prior=prior.replace(a,b)
a=b'RUN NewRequest("read",71,""). RUN Invoke. RUN ErrorCode("CONTAINER_NF_CANDIDATE_LIMIT",503). RUN Check(NOT response:Has("data"),"row cap never returns partial data").'
b=b'RUN NewRequest("read",71,""). request:Add("take",200). RUN Invoke. RUN Check(response:GetLogical("success") AND response:GetInteger("total")=201,"201 full total succeeds"). RUN Check(response:GetJsonArray("data"):Length=200,"201 total returns complete first page200").'
assert prior.count(a)==1;prior=prior.replace(a,b)
(stage/'ContainerNfAvailableTest.p').write_bytes(prior)
entries='sursum-api/programs/ContainersPainelFinanceReadService.p,sursum-api/programs/CiwErpReadService.p,sursum-api/programs/CiwMedCompanyContext.p,ContainersPainelFinanceReadService.p,CiwErpReadService.p,CiwMedCompanyContext.p,CiwErpReadTest.p,ExpenseTaxRelationsReadTest.p,NfAvailablePageTest.p,ContainersPainelFinanceReadTest.p,AvailableNfAliasTest.p,ContainerNfAvailableTest.p'
if not red:
 finance=(stage/'sursum-api/programs/ContainersPainelFinanceReadService.p').read_bytes()
 a=b'ASSIGN iNfStarted=ETIME iNfReads=0.\n DO STOP-AFTER 10';assert finance.count(a)==1
 fixture=finance.replace(a,b'ASSIGN iNfStarted=ETIME iNfReads=0.\n DO STOP-AFTER 1',1)
 a=b'readerPath=SEARCH("sursum-api/programs/CiwErpReadService.r").';assert fixture.count(a)==1
 fixture=fixture.replace(a,b'readerPath=SEARCH("sursum-api/programs/NfSlowReaderFixture.r").',1)
 (stage/'sursum-api/programs/NfPageBudgetFixture.p').write_bytes(fixture)
 reader=(stage/'sursum-api/programs/CiwErpReadService.p').read_bytes()
 a=b"DO ON ERROR UNDO, THROW:\r\n IF NOT VALID-HANDLE(phData)";assert reader.count(a)==1
 (stage/'sursum-api/programs/NfSlowReaderFixture.p').write_bytes(reader.replace(a,b"DO ON ERROR UNDO, THROW:\r\n IF pcResource='container_nfs_disponiveis' THEN PAUSE 2 NO-MESSAGE.\r\n IF NOT VALID-HANDLE(phData)",1))
 (stage/'NfPageBudgetTest.p').write_bytes((P/'tests/NfPageBudgetTest.p').read_bytes())
 entries+=',sursum-api/programs/NfPageBudgetFixture.p,sursum-api/programs/NfSlowReaderFixture.p,NfPageBudgetTest.p'
(stage/'Compile.p').write_text('''DEFINE VARIABLE k AS INTEGER NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.
OUTPUT TO 'compile.log'. PUT UNFORMATTED 'OpenEdge ' PROVERSION ' NUMDBS=' NUM-DBS SKIP.
IF NUM-DBS<>0 THEN DO: PUT UNFORMATTED 'FAIL databases forbidden' SKIP. OUTPUT CLOSE. QUIT. END.
DO k=1 TO NUM-ENTRIES("'''+entries+'''"):
 COMPILE VALUE(ENTRY(k,"'''+entries+'''")) SAVE NO-ERROR.
 IF COMPILER:ERROR THEN DO: DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END. OUTPUT CLOSE. QUIT. END.
END. PUT UNFORMATTED 'PASS COMPILE' SKIP. OUTPUT CLOSE. QUIT.
''',encoding='utf8')
(stage/'Execute.p').write_text("OUTPUT TO 'execution.log'. OUTPUT CLOSE. DO ON ERROR UNDO, THROW: IF NUM-DBS<>0 THEN UNDO, THROW NEW Progress.Lang.AppError('DB forbidden',1). RUN NfAvailablePageTest.r. "+(''if red else'RUN ContainersPainelFinanceReadTest.r. RUN AvailableNfAliasTest.r. RUN ContainerNfAvailableTest.r. RUN NfPageBudgetTest.r. RUN ExpenseTaxRelationsReadTest.r. ')+"OUTPUT TO 'execution.log' APPEND. PUT UNFORMATTED 'PASS EXECUTE NUMDBS=' NUM-DBS SKIP. CATCH e AS Progress.Lang.Error: OUTPUT TO 'execution.log' APPEND. PUT UNFORMATTED 'FAIL ' e:GetMessage(1) SKIP. END CATCH. END. OUTPUT CLOSE. QUIT.\n",encoding='utf8')
print(json.dumps({'stage':str(stage),'red':red,'baselines':len(manifest)}))
