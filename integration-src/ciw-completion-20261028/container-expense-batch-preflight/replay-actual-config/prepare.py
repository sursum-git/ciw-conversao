from pathlib import Path
import hashlib,json,re

root=Path(__file__).resolve().parent
w=root.parents[3]
canonical=Path('D:/opencode/motor-progress/v2')
state=w/'.runtime/ciw-completion-20261028/container-expense-batch-preflight/replay-actual-config'
stage=state/'local';stage.mkdir(parents=True,exist_ok=True)
capture=w/'.runtime/ciw-completion-20261028/container-expense-batch-preflight/official-v1.1/compiled122/expense-batch-preflight.json'
raw=capture.read_bytes();config=json.loads(raw.decode('utf-8-sig'))
assert config['completed'] is True and config['company_id']==2
assert config['preferred_pair_for_readonly_review']==[4,5]
assert {4,5}.issubset({x['despesa_id'] for x in config['safe_definition_candidates']})
# Only capture copies in ignored runtime. Never print the configuration.
(stage/'captured-config.json').write_bytes(raw)
suite=(canonical/'tests/abl/container-panel/ContainersDespesasCrudTest.p').read_text(encoding='utf-8-sig')
declarations=suite[:suite.index('RUN Fixture.')]
procedures=suite[suite.index('FUNCTION CountRows RETURNS INTEGER (hIndex AS INTEGER):'):]
procedures=procedures.replace('"FAIL " + c + " result=" + STRING(result:GetJsonText())','"FAIL " + c')
procedures=procedures.replace('o:Add("dolar_di",5). o:Add("dolar_compra",5).','o:Add("dolar_di",fixtureQuote). o:Add("dolar_compra",fixtureQuote).')
procedures=procedures.replace('req=CAST(parser:Parse(lc),JsonObject).','testUtf8=lc. req=CAST(parser:Parse(testUtf8),JsonObject).').replace('o=CAST(parser:Parse(lc),JsonObject).','testUtf8=lc. o=CAST(parser:Parse(testUtf8),JsonObject).')
files={'Replay.p':declarations+(root/'ReplayTests.i').read_text(encoding='utf-8')+'\n'+procedures}
for name in ['ContainersDespesasCrudService.p','ContainersDespesasBatchService.p','ContainersImpostosService.p','CiwTaxAmount.p','CiwErpReadService.p']:
 files['sursum-api/programs/'+name]=(canonical/'sursum-api/programs'/name).read_text(encoding='utf-8-sig')
files['ContainersDespesasCrudService.p']='{sursum-api/programs/ContainersDespesasCrudService.p}\n'
pending=list(files.items())
while pending:
 name,text=pending.pop()
 for inc in re.findall(r'\{(sursum-api/[^\s{}]+\.i)',text):
  if inc not in files:files[inc]=(canonical/inc).read_text(encoding='utf-8-sig');pending.append((inc,files[inc]))
for name,text in files.items():
 p=stage/name;p.parent.mkdir(parents=True,exist_ok=True);p.write_text(text,encoding='utf-8')
entries=[n for n in files if n.endswith('.p')]
(stage/'Compile.p').write_text('''DEFINE VARIABLE k AS INTEGER NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.
OUTPUT TO 'compile.log'. PUT UNFORMATTED 'OpenEdge ' PROVERSION ' NUM-DBS=' NUM-DBS SKIP.
DO k=1 TO NUM-ENTRIES("'''+','.join(entries)+'''"):
 COMPILE VALUE(ENTRY(k,"'''+','.join(entries)+'''")) SAVE NO-ERROR.
 IF COMPILER:ERROR THEN DO: DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END. OUTPUT CLOSE. QUIT. END.
END. PUT UNFORMATTED 'PASS COMPILE ALL' SKIP. OUTPUT CLOSE. QUIT.
''',encoding='utf-8')
(stage/'Execute.p').write_text("BLOCK-LEVEL ON ERROR UNDO, THROW.\nOUTPUT TO 'execution.log'.\nDO ON ERROR UNDO, THROW:\n RUN Replay.r.\n PUT UNFORMATTED 'PASS EXECUTE NUM-DBS=' NUM-DBS SKIP.\n CATCH e AS Progress.Lang.Error: PUT UNFORMATTED 'FAIL ' e:GetMessage(1) SKIP. END CATCH.\nEND. OUTPUT CLOSE. QUIT.\n",encoding='utf-8')
baselines=[{'path':(canonical/n).as_posix(),'sha256':hashlib.sha256((canonical/n).read_bytes()).hexdigest()}for n in files if n.startswith('sursum-api/')]
baselines.append({'path':(canonical/'tests/abl/container-panel/ContainersDespesasCrudTest.p').as_posix(),'sha256':hashlib.sha256((canonical/'tests/abl/container-panel/ContainersDespesasCrudTest.p').read_bytes()).hexdigest()})
(state/'inputs.json').write_text(json.dumps({'capturePath':capture.as_posix(),'captureSha256':hashlib.sha256(raw).hexdigest(),'baselines':baselines,'configurationRows':config['scanned_configuration_rows'],'companyId':2,'definitionIds':[4,5],'businessExecuted':False,'configurationPublic':False},indent=2)+'\n',encoding='utf-8')
print('PASS staged central TT replay; private capture validated; no configuration emitted')
