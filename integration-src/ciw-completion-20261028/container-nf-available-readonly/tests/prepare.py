from pathlib import Path
import hashlib,json,sys,re
root=Path(__file__).resolve().parents[1]; workspace=root.parents[2]
state=workspace/'.runtime/ciw-completion-20261028/container-nf-available-readonly'
motor=Path('D:/opencode/motor-progress/v2'); front=Path('D:/opencode/construtor-pg')
red='--red' in sys.argv; stage=state/('red' if red else 'local'); stage.mkdir(parents=True,exist_ok=True)
sources={'sursum-api/programs/ContainersPainelFinanceRead.p':motor/'sursum-api/programs/ContainersPainelFinanceRead.p','sursum-api/programs/ContainersPainelFinanceReadService.p':motor/'sursum-api/programs/ContainersPainelFinanceReadService.p','php/RuntimeApiEntityActionService.php':front/'backend/src/Runtime/RuntimeApiEntityActionService.php'}
baseline=state/'baseline'; baseline.mkdir(exist_ok=True)
for rel,source in sources.items():
 target=baseline/rel; target.parent.mkdir(parents=True,exist_ok=True)
 if not target.exists():target.write_bytes(source.read_bytes())
 if target.read_bytes()!=source.read_bytes():print('REBASE GATE: canonical changed; isolated tests retain pinned baseline: '+source.name)
 out=stage/rel;out.parent.mkdir(parents=True,exist_ok=True);out.write_bytes(target.read_bytes())
builder=baseline/'php/ProgramBuilderService.php'
if not builder.exists():builder.write_bytes((front/'backend/src/Builder/ProgramBuilderService.php').read_bytes())
assert hashlib.sha256(builder.read_bytes()).hexdigest()=='72c6dafbfa0e93196b443ec45cd6d7c743fddd6415719febd70a0965d1fe18ee','Expected released Builder8'
(stage/'php/ProgramBuilderService.php').write_bytes(builder.read_bytes())
if not red:
 plan=json.loads((root/'patches/patch-plan.json').read_text(encoding='utf8'))
 for p in plan['textPatches']:
  out=stage/p['relative'];data=out.read_bytes();assert hashlib.sha256(data).hexdigest()==p['baselineSha256']
  for change in p['changes']:
   old=bytes.fromhex(change['oldBytesHex']);new=bytes.fromhex(change['newBytesHex']);assert data.count(old)==1;data=data.replace(old,new)
  assert hashlib.sha256(data).hexdigest()==p['candidateSha256'];out.write_bytes(data)
for file in ['ContainerNfAvailableTest.p']:(stage/file).write_bytes((root/'tests'/file).read_bytes())
(stage/'ContainersPainelFinanceReadService.p').write_text('{sursum-api/programs/ContainersPainelFinanceReadService.p}\n',encoding='utf8')
financialFixture=baseline/'ContainersPainelFinanceReadTest.p'
if not financialFixture.exists():financialFixture.write_bytes((motor/'tests/abl/container-panel/ContainersPainelFinanceReadTest.p').read_bytes())
(stage/'ContainersPainelFinanceReadTest.p').write_bytes(financialFixture.read_bytes())
pending=['sursum-api/includes/ContainerPaymentIdentity.i','sursum-api/includes/parametros_ima.i','sursum-api/includes/ContainerFinancePolicy.i'];seen=set()
while pending:
 name=pending.pop()
 if name in seen:continue
 seen.add(name);pinned=baseline/name;pinned.parent.mkdir(parents=True,exist_ok=True)
 if not pinned.exists():pinned.write_bytes((motor/name).read_bytes())
 data=pinned.read_bytes();out=stage/name;out.parent.mkdir(parents=True,exist_ok=True);out.write_bytes(data)
 pending.extend(re.findall(r'\{(sursum-api/[^\s{}]+\.i)',data.decode('utf8')))
wrapper=(stage/'sursum-api/programs/ContainersPainelFinanceRead.p').read_bytes();anchor=b'DEFINE INPUT PARAMETER poRequest AS JsonObject NO-UNDO.';assert wrapper.count(anchor)==1
(stage/'WrapperCompileFixture.p').write_bytes(wrapper.replace(anchor,b'DEFINE TEMP-TABLE ttParam NO-UNDO FIELD cod-param AS CHARACTER FIELD val-param AS CHARACTER INDEX pk IS PRIMARY UNIQUE cod-param.\n&SCOPED-DEFINE SURSUM_PARAMETROS_IMA_TABELA ttParam\n'+anchor))
(stage/'Compile.p').write_text('''DEFINE VARIABLE k AS INTEGER NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.
OUTPUT TO 'compile.log'. PUT UNFORMATTED 'OpenEdge ' PROVERSION ' NUMDBS=' NUM-DBS SKIP.
DO k=1 TO NUM-ENTRIES("sursum-api/programs/ContainersPainelFinanceReadService.p,ContainersPainelFinanceReadService.p,ContainerNfAvailableTest.p,ContainersPainelFinanceReadTest.p,WrapperCompileFixture.p"):
 COMPILE VALUE(ENTRY(k,"sursum-api/programs/ContainersPainelFinanceReadService.p,ContainersPainelFinanceReadService.p,ContainerNfAvailableTest.p,ContainersPainelFinanceReadTest.p,WrapperCompileFixture.p")) SAVE NO-ERROR.
 IF COMPILER:ERROR THEN DO: DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END. OUTPUT CLOSE. QUIT. END.
END. PUT UNFORMATTED 'PASS COMPILE' SKIP. OUTPUT CLOSE. QUIT.
''',encoding='utf8')
(stage/'Execute.p').write_text("OUTPUT TO 'execution.log'. DO ON ERROR UNDO, THROW: RUN ContainerNfAvailableTest.r. "+(''if red else'RUN ContainersPainelFinanceReadTest.r. ')+"PUT UNFORMATTED 'PASS EXECUTE NUMDBS=' NUM-DBS SKIP. CATCH e AS Progress.Lang.Error: PUT UNFORMATTED 'FAIL ' e:GetMessage(1) SKIP. END CATCH. END. OUTPUT CLOSE. QUIT.\n",encoding='utf8')
print('Prepared isolated '+('RED'if red else'GREEN')+'; canonical bytes preserved; no databases')
