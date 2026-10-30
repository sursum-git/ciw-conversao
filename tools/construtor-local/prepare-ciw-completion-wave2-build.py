"""Immutable build5: aux RO + expense batch, local composition only; no network."""
from pathlib import Path
import hashlib,json,re,shutil,difflib,sys

ROOT=Path(__file__).resolve().parents[2]
MOTOR=Path('D:/opencode/motor-progress/v2'); FRONT=Path('D:/opencode/construtor-pg')
STATE=ROOT/'.runtime/ciw-completion-20261028'; LABEL=sys.argv[1] if len(sys.argv)>1 else '5-v6'; BUILD=STATE/('official-build'+LABEL); PACKAGE=BUILD/'package'; BACKEND=BUILD/'backend-stage'
AUX=ROOT/'integration-src/ciw-completion-20261028/container-version-history/frozen-aux-v1.1'
BATCH=STATE/'container-expense-batch/frozen-v1'
ASTAGE=STATE/'container-version-history/incremental-aux-stage'
assert not BUILD.exists(),'Immutable build already exists'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
digest=lambda b:hashlib.sha256(b).hexdigest()
def save(p,v):p.parent.mkdir(parents=True,exist_ok=True);p.write_text(json.dumps(v,indent=2,ensure_ascii=False)+'\n',encoding='utf-8')
def verify(d,expected):
 assert sha(d/'manifest.json')==expected
 m=load(d/'manifest.json')
 for e in m['files']:assert sha(d/e['path'])==e['sha256'],e['path']
 for e in m.get('receipts',m.get('evidence',[])):assert sha(ROOT/e['path'])==e['sha256'],e['path']
 return m
am=verify(AUX,'0289b8761d04bb579bee337acdf7680118e5a2518986255fadc0707e16636a0e')
bm=verify(BATCH,'75b0f1351d95e648516ffccdd9c4d85bb1cf20a22e3b966783aea4ab323ff8f5')
for e in bm['baselines']:assert sha(Path(e['target']))==e['baselineSha256'],e['target']
for e in am['metadataBaselines']:assert sha(ROOT/e['path'])==e['sha256']
assert sha(MOTOR/'sursum-api/programs/ContainersVersionHistoryService.p')=='1b72391027820a110e3041ea60d33fe701ef04f63b749753d96f6f88df5c3407'

# Keep exact CRLF/mixed bytes from the hash-pinned auxiliary candidates. No Git
# diff reconstruction: its normalized line endings are not the candidate bytes.
composed={};baseline={};steps=[]
for e in am['baselines']:
 target=Path(e['target']);assert sha(target)==e['baselineSha256']
 exact=ASTAGE/target.name;assert sha(exact)==e['candidateSha256'],str(exact)
 composed[str(target)]=exact.read_bytes();baseline[str(target)]=e['baselineSha256']
 steps.append(dict(target=str(target),kind='exact auxiliary candidate',beforeSha256=e['baselineSha256'],afterSha256=sha(exact)))

def anchor(value,old,new):
 # Text must be uniquely present. Only the selected byte range changes.
 a,b=old.encode(),new.encode()
 if value.count(a)!=1 and value.count(a.replace(b'\n',b'\r\n'))==1:
  a=a.replace(b'\n',b'\r\n');b=b.replace(b'\n',b'\r\n')
 assert value.count(a)==1,'Absent/ambiguous composition anchor: '+old[:90]
 return value.replace(a,b,1)

plans=[load(BATCH/'patches/seam-plan.json')]+load(BATCH/'patches/bridge/patch-plan.json')['textPatches']+load(BATCH/'patches/native-batch-context/patch-plan.json')['textPatches']
for e in plans:
 target=Path(e['target']);key=str(target);assert sha(target)==e['baselineSha256'],key
 value=composed.get(key,target.read_bytes());before=digest(value)
 for change in e['changes']:value=anchor(value,change['old'],change['new'])
 composed[key]=value;baseline[key]=e['baselineSha256']
 steps.append(dict(target=key,kind='batch exact anchors preserving outside bytes',beforeSha256=before,afterSha256=digest(value),anchorCount=len(e['changes'])))

PACKAGE.mkdir(parents=True);BACKEND.mkdir()
for p in (STATE/'official-build3/package').rglob('*'):
 if p.is_file() and p.suffix.lower() in ['.p','.i'] and p.name not in ['Compile.p','Regression.p']:
  dest=PACKAGE/p.relative_to(STATE/'official-build3/package');dest.parent.mkdir(parents=True,exist_ok=True);dest.write_bytes(p.read_bytes())
# Preserve the official parent404 correction and its precise regression.
history=ROOT/'integration-src/ciw-completion-20261028/container-version-history/frozen-v1.4'
for a,b in [('abl/ContainersVersionHistoryService.p','sursum-api/programs/ContainersVersionHistoryService.p'),('tests/abl/ContainersVersionHistoryTest.p','ContainersVersionHistoryTest.p')]:
 (PACKAGE/b).write_bytes((history/a).read_bytes())
prod=[];integration=[]
for target_s,value in composed.items():
 target=Path(target_s)
 if target.is_relative_to(MOTOR):dest=PACKAGE/target.relative_to(MOTOR)
 else:dest=BACKEND/target.relative_to(FRONT)
 dest.parent.mkdir(parents=True,exist_ok=True);dest.write_bytes(value)
 integration.append(dict(target=target_s,baselineSha256=baseline[target_s],candidate=str(dest),candidateSha256=sha(dest)))
 if target.suffix=='.p':prod.append(target.relative_to(MOTOR).as_posix())
for d in [AUX,BATCH]:
 for p in (d/'abl').glob('*'):
  if p.suffix not in ['.p','.i']:continue
  rel=('sursum-api/programs/' if p.suffix=='.p' else 'sursum-api/includes/')+p.name
  dest=PACKAGE/rel;dest.parent.mkdir(parents=True,exist_ok=True);dest.write_bytes(p.read_bytes());prod.append(rel)
  integration.append(dict(target=str(MOTOR/rel),baselineSha256=None,candidate=str(dest),candidateSha256=sha(dest)))
 for p in (d/'includes').glob('*.i'):
  dest=PACKAGE/'sursum-api/includes'/p.name;dest.parent.mkdir(parents=True,exist_ok=True);dest.write_bytes(p.read_bytes());prod.append(dest.relative_to(PACKAGE).as_posix())
  integration.append(dict(target=str(MOTOR/dest.relative_to(PACKAGE)),baselineSha256=None,candidate=str(dest),candidateSha256=sha(dest)))
dest=BACKEND/'backend/src/Runtime/RuntimeContainerExpenseBatch.php';dest.parent.mkdir(parents=True,exist_ok=True);dest.write_bytes((BATCH/'php/RuntimeContainerExpenseBatch.php').read_bytes())
integration.append(dict(target=str(FRONT/'backend/src/Runtime'/dest.name),baselineSha256=None,candidate=str(dest),candidateSha256=sha(dest)))

# Build the exact reviewed TT suite deterministically from the current canonical
# test plus frozen additions. UTF8 changes are test-parser boundaries only.
original=MOTOR/'tests/abl/container-panel/ContainersDespesasCrudTest.p'
suite=original.read_text(encoding='utf-8-sig')
repairs=[('RUN DerivedEchoTests.','RUN DerivedEchoTests.\nRUN BatchSeamTests.\nRUN BatchBridgeTests.'),('FUNCTION CountRows RETURNS INTEGER (hIndex AS INTEGER) FORWARD.','FUNCTION CountRows RETURNS INTEGER (hIndex AS INTEGER) FORWARD.\nFUNCTION ExpenseTestImageComplete RETURNS LOGICAL(o AS JsonObject) FORWARD.'),('DEFINE VARIABLE parser AS ObjectModelParser NO-UNDO.','DEFINE VARIABLE parser AS ObjectModelParser NO-UNDO.\nDEFINE VARIABLE testUtf8 AS LONGCHAR NO-UNDO.'),('RUN Fixture.','FIX-CODEPAGE(testUtf8)="UTF-8".\nRUN Fixture.'),('req=CAST(parser:Parse(lc),JsonObject).','testUtf8=lc. req=CAST(parser:Parse(testUtf8),JsonObject).'),('o=CAST(parser:Parse(lc),JsonObject).','testUtf8=lc. o=CAST(parser:Parse(testUtf8),JsonObject).')]
for old,new in repairs:
 assert old in suite,old
 suite=suite.replace(old,new,1 if old=='RUN Fixture.' else -1)
suite+='\n'+(BATCH/'tests/ContainerExpenseBatchSeamTests.i').read_text(encoding='utf-8')+'\n'+(BATCH/'tests/ContainerExpenseBatchBridgeTests.i').read_text(encoding='utf-8')
assert suite==(STATE/'container-expense-batch/local/ContainersDespesasCrudTest.p').read_text(encoding='utf-8-sig'),'Frozen deterministic TT assembly differs from reviewed local suite'
(PACKAGE/'ContainersDespesasCrudTest.p').write_text(suite,encoding='utf-8')
(PACKAGE/'ContainersDespesasCrudService.p').write_text('{sursum-api/programs/ContainersDespesasCrudService.p}\n',encoding='utf-8')
(PACKAGE/'ContainersVersionAuxHistoryTest.p').write_bytes((AUX/'tests/abl/ContainersVersionAuxHistoryTest.p').read_bytes())
(PACKAGE/'ContainersVersionHistoryTestTables.i').write_bytes((AUX/'tests/abl/ContainersVersionHistoryTestTables.i').read_bytes())

# Resolve the transitive fixed source/include closure in the isolated package.
search=[MOTOR/'sursum-api/programs',MOTOR/'sursum-api/includes',MOTOR/'tests/abl/container-panel',MOTOR/'tests/abl/ciw-erp-consultas',MOTOR/'tests/abl/purchase-items']
processed=set()
while True:
 pending=[p for p in PACKAGE.rglob('*') if p.suffix in ['.p','.i'] and p.relative_to(PACKAGE).as_posix() not in processed]
 if not pending:break
 for p in pending:
  processed.add(p.relative_to(PACKAGE).as_posix());value=p.read_text(encoding='utf-8-sig');refs=re.findall(r'\{([^\s{}]+\.i)',value)
  if p.name!='CiwCadastrosCrud.p':
   refs+=re.findall(r'''["'](sursum-api/(?:programs|includes)/[^"'\r\n]+\.[pir])["']''',value)
   refs+=['sursum-api/programs/'+n+'.p' for n in re.findall(r'''Compiled\(["']([A-Za-z][A-Za-z0-9_]+)["']\)''',value)]
  refs+=re.findall(r'''\bRUN\s+([A-Za-z][A-Za-z0-9_]+\.[pr])\b''',value,re.I)
  for ref in refs:
   ref=ref.replace('\\','/');ref=ref[:-2]+'.p' if ref.endswith('.r') else ref
   if (PACKAGE/ref).exists():continue
   if ref.startswith('sursum-api/'):source=MOTOR/ref;assert source.exists(),ref;rel=ref
   else:
    matches=[d/ref for d in search if (d/ref).exists()];assert matches,ref;assert len({sha(s) for s in matches})==1,ref
    source=matches[0];rel=source.relative_to(MOTOR).as_posix() if source.is_relative_to(MOTOR/'sursum-api') else ref
   target=PACKAGE/rel
   if not target.exists():target.parent.mkdir(parents=True,exist_ok=True);target.write_bytes(source.read_bytes())

tests=[('ContainerFiscalReadOnlyTest.p','fiscal-tests.log',41),('ContainersVersionHistoryTest.p','container-version-history-tests.log',32),('ContainersVersionTest.p','containers-version-tests-{culture}.log',189),('ContainersVersionCompositionTest.p','containers-version-composition-tests-{culture}.log',34),('ContainersVersionContextTest.p','containers-version-context-tests-{culture}.log',11),('ContainersProcessBoundaryTest.p','containers-process-boundary-tests-{culture}.log',25),('CiwErpReadTest.p','erp-read-{culture}.log',47),('PurchaseItemsReadTest.p','purchase-item-read-{culture}.log',9),('ContainersDespesasCrudTest.p','containers-despesas-crud-tests-{culture}.log',271),('ContainersVersionAuxHistoryTest.p','container-version-aux-history-tests.log',24)]
class_sources={p.stem:p for p in (MOTOR/'sursum-api/sursum').glob('*.cls')}
classes=[];seen_classes=set()
def include_class(name):
 if name in seen_classes:return
 seen_classes.add(name);source=class_sources[name];value=source.read_text(encoding='utf-8-sig')
 for dependency in sorted(set(re.findall(r'\b[A-Z][A-Za-z0-9_]*\b',value)) & class_sources.keys()):
  if dependency!=name:include_class(dependency)
 dest=PACKAGE/source.name;dest.write_bytes(source.read_bytes());classes.append(source.name)
for name in ['PasoeExecutionContext','ApiExecutionRepository']:include_class(name)
remote='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build'+LABEL
propath=remote+','+remote+'/sursum-api/programs,'+remote+'/sursum-api/includes,'+remote+'/sursum-api/sursum,'
entries=classes+sorted(p.relative_to(PACKAGE).as_posix() for p in PACKAGE.rglob('*.p'))
(PACKAGE/'Compile.p').write_text('''BLOCK-LEVEL ON ERROR UNDO, THROW.
DEFINE VARIABLE entries AS CHARACTER NO-UNDO INITIAL "'''+','.join(entries)+'''".
DEFINE VARIABLE n AS INTEGER NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.
DEFINE VARIABLE netLibrary AS CHARACTER NO-UNDO.
netLibrary=OS-GETENV('CIW_COMPILE_NETLIB').
IF netLibrary=? OR netLibrary='' OR SEARCH(netLibrary)=? THEN UNDO, THROW NEW Progress.Lang.AppError('Compile Net library unavailable',1).
PROPATH="'''+propath+'''" + netLibrary + ',' + PROPATH.
OUTPUT TO 'compile.log'. PUT UNFORMATTED 'OpenEdge ' PROVERSION ' NUM-DBS=' NUM-DBS SKIP.
IF NOT PROVERSION BEGINS '12.2' THEN DO: PUT UNFORMATTED 'FAIL expected OpenEdge12.2' SKIP. OUTPUT CLOSE. QUIT. END.
IF NUM-DBS<>1 THEN DO: PUT UNFORMATTED 'FAIL expected one schema connection for static IMA binding' SKIP. OUTPUT CLOSE. QUIT. END.
DO n=1 TO NUM-ENTRIES(entries): COMPILE VALUE(ENTRY(n,entries)) SAVE NO-ERROR.
 PUT UNFORMATTED ENTRY(n,entries) ' COMPILER:ERROR=' COMPILER:ERROR SKIP.
 IF COMPILER:ERROR OR ERROR-STATUS:ERROR THEN DO:
  DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END.
  PUT UNFORMATTED 'FAIL COMPILE' SKIP. OUTPUT CLOSE. QUIT.
 END.
END. PUT UNFORMATTED 'PASS COMPILE ALL' SKIP. OUTPUT CLOSE. QUIT.
''',encoding='utf-8')
(PACKAGE/'Regression.p').write_text('''BLOCK-LEVEL ON ERROR UNDO, THROW.
DEFINE VARIABLE netLibrary AS CHARACTER NO-UNDO.
netLibrary=OS-GETENV('CIW_COMPILE_NETLIB').
IF netLibrary=? OR netLibrary='' OR SEARCH(netLibrary)=? THEN UNDO, THROW NEW Progress.Lang.AppError('Test Net library unavailable',1).
PROPATH="'''+propath+'''" + netLibrary + ',' + PROPATH.
IF NUM-DBS<>0 THEN UNDO, THROW NEW Progress.Lang.AppError('Connected DB forbidden',1).
SESSION:NUMERIC-FORMAT=ENTRY(1,SESSION:PARAMETER).
RUN VALUE(ENTRY(2,SESSION:PARAMETER)).
IF NUM-DBS<>0 THEN UNDO, THROW NEW Progress.Lang.AppError('Connected DB forbidden',1).
QUIT.
''',encoding='utf-8')
model=(STATE/'official-build3/package/compile122.ps1').read_text(encoding='utf-8-sig')
ps=model.split("Run-Avm @('-b'")[0].replace('codex-ciw-completion-20261028-build3','codex-ciw-completion-20261028-build'+LABEL)
ps=ps.replace("$info.RedirectStandardOutput=$true;", "$info.EnvironmentVariables['CIW_COMPILE_NETLIB']=$netLibrary\n $info.RedirectStandardOutput=$true;")
ps+="$netLibrary=@('C:/Progress_12/OE/gui/netlib/OpenEdge.Net.pl','C:/Progress_12/OE/tty/netlib/OpenEdge.Net.pl') | Where-Object {Test-Path -LiteralPath $_} | Select-Object -First 1\nif(!$netLibrary){throw 'Official OpenEdge.Net.pl not found'}\n[IO.File]::WriteAllText((Join-Path $PSScriptRoot 'net-library.txt'),$netLibrary,[Text.UTF8Encoding]::new($false))\n"
ps+="Run-Avm @('-b','-db','espec','-H','192.168.0.111','-S','10012','-N','TCP','-ld','espec','-cpinternal','UTF-8','-cpstream','UTF-8','-p','Compile.p','-T',$PWD.Path) 'compile-process.log'\n$compiled=Get-Content compile.log -Raw;if($compiled -notmatch 'OpenEdge 12[.]2' -or $compiled -notmatch 'NUM-DBS=1' -or $compiled -notmatch 'PASS COMPILE ALL' -or $compiled -match 'FAIL '){throw 'Compilation unconfirmed'}\nforeach($cp in @('UTF-8','ISO8859-1')){foreach($culture in @('AMERICAN','EUROPEAN')){\n"
logs=[]
for name,out,count in tests:
 ps+="Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-param',($culture+',"+name+"'),'-p','Regression.p','-T',$PWD.Path) ('process-"+name+"-'+$cp+'-'+$culture+'.log')\n"
 origin="('"+out.replace('{culture}',"'+$culture+'")+"')"
 ps+="$proof=Get-Content -LiteralPath "+origin+" -Raw;if($proof -notmatch 'PASS' -or $proof -match 'FAIL'){throw 'Assertion proof failed: "+name+"'}\nCopy-Item -LiteralPath "+origin+" -Destination ('"+name[:-2]+"-'+$cp+'-'+$culture+'.log')\n"
 logs += [name[:-2]+'-'+cp+'-'+culture+'.log' for cp in ['UTF-8','ISO8859-1'] for culture in ['AMERICAN','EUROPEAN']]
ps+="}}\nWrite-Output 'Official12.2 wave2 tests executed; inspect hashes/compiler/assertions'\n} catch {Write-Output $_.Exception.Message;if(Test-Path compile.log){Get-Content compile.log -Raw};exit 1}\n"
(PACKAGE/'compile122.ps1').write_text(ps,encoding='utf-8')
uploads=[{'local':str(p.relative_to(ROOT)),'remote':remote+'/'+p.relative_to(PACKAGE).as_posix()} for p in sorted(PACKAGE.rglob('*')) if p.is_file()]
downloads=['compile.log','compile-process.log','net-library.txt']+[str(Path(n).with_suffix('.r')).replace('\\','/') for n in entries]+logs
save(BUILD/'remote-plan.json',{'server':'compiler','directories':[remote]+[remote+'/'+p.relative_to(PACKAGE).as_posix() for p in sorted(PACKAGE.rglob('*')) if p.is_dir()],'uploads':uploads,'commands':['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/compile122.ps1'],'downloads':[{'local':str((BUILD/'compiled122'/n).relative_to(ROOT)),'remote':remote+'/'+n,'optional':True} for n in downloads]})
save(BUILD/'source-manifest.json',[{'file':u['local'],'sha256':sha(ROOT/u['local'])} for u in uploads])
route=load(BATCH/'patches/bridge/route-addition.json');assert len(route['operations'])==1
assert route['operations'][0]['value']=={'route':'/SursumPrograms/containers-despesas-lote','method':'POST','program':'sursum-api/programs/ContainersDespesasBatchApi.p'}
save(BUILD/'integration-plan.json',{'success':True,'files':integration,'compositionSteps':steps,'onlyRouteAddition':route,'metadataPackages':[str(AUX/'metadata'),str(BATCH/'metadata')],'canonicalWrites':False,'businessWrites':False})
save(BUILD/'build-manifest.json',{'state':'PREPARED_NOT_EXECUTED','packageManifests':{'aux':sha(AUX/'manifest.json'),'batch':sha(BATCH/'manifest.json')},'compileEntries':entries,'productionDelta':sorted(set(prod)),'tests':[{'name':n,'output':out,'expectedChecks':cnt} for n,out,cnt in tests],'checksPerCombination':sum(t[2] for t in tests),'testLogs':len(logs),'compileDatabaseConnections':1,'compileConnection':'espec .111 TCP10012 alias espec, schema binding only; never execute production','testDatabaseConnections':0,'baselines':baseline,'preservedHistoryParentFixSha256':sha(PACKAGE/'sursum-api/programs/ContainersVersionHistoryService.p'),'remotePlanSha256':sha(BUILD/'remote-plan.json'),'integrationPlanSha256':sha(BUILD/'integration-plan.json'),'publicationAllowed':False,'note':'Root only official12.2/compiler/integration/publication. No local r-code/test fixtures publication. Wrapper authenticated read/get and actor/audit operational gates remain; no business writes authorized.'})
print(json.dumps({'prepared':str(BUILD),'compileEntries':len(entries),'sourceFiles':len(uploads),'testLogs':len(logs),'checksPerCombination':sum(t[2] for t in tests),'remotePlanSha256':sha(BUILD/'remote-plan.json'),'executedRemote':False}))
