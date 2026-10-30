"""Fresh diagnostic stage, spacing the three OE character expressions explicitly."""
from pathlib import Path
import json
r=Path(__file__).resolve().parents[2];old=r/'.runtime/ciw-completion-20261028/batch1042-fixture-inspector';new=old.with_name('batch1042-fixture-inspector-v2');new.mkdir()
changes=[('outputName="fixture-"+phaseName+".json".','outputName = "fixture-" + phaseName + ".json".'),('("espec."+ENTRY(n,tableNames)) BUFFER-NAME ("b1042fixed"+STRING(n))','("espec." + ENTRY(n,tableNames)) BUFFER-NAME ("b1042fixed" + STRING(n))'),('"FOR EACH "+h:NAME+" WHERE "+h:NAME+"."+f:NAME+"=2147000110 NO-LOCK"','"FOR EACH " + h:NAME + " WHERE " + h:NAME + "." + f:NAME + "=2147000110 NO-LOCK"')]
for name in ['FixtureInspector.p','Compile.p','Compile.ps1']:
 text=(old/name).read_text()
 if name=='FixtureInspector.p':
  for a,b in changes:assert text.count(a)==1;text=text.replace(a,b)
 text=text.replace('countRows=countRows+1 totalRows=totalRows+1','countRows = countRows + 1 totalRows = totalRows + 1').replace('ETIME-started','ETIME - started')
 text=text.replace('inspector-v1','inspector-v2');(new/name).write_text(text)
plan=json.loads((old/'compile-plan.json').read_text())
def adapt(x):
 if isinstance(x,str):return x.replace('batch1042-fixture-inspector','batch1042-fixture-inspector-v2').replace('codex-ciw-1042-fixture-inspector-v1','codex-ciw-1042-fixture-inspector-v2')
 if isinstance(x,list):return[adapt(v)for v in x]
 if isinstance(x,dict):return{k:adapt(v)for k,v in x.items()}
 return x
(new/'compile-plan.json').write_text(json.dumps(adapt(plan),indent=2)+'\n')
driver='''DEFINE VARIABLE i AS INTEGER NO-UNDO.
OUTPUT TO "local-syntax.log".
COMPILE FixtureInspector.p NO-ERROR.
PUT UNFORMATTED "Compiler " PROVERSION " ERROR=" COMPILER:ERROR SKIP.
DO i=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(i) SKIP. END.
OUTPUT CLOSE.
QUIT.
'''
(new/'SyntaxOnly.p').write_text(driver)
print('Prepared fresh v2 of fixed13table read-only inspector; local syntax check has no SAVE or DB')
