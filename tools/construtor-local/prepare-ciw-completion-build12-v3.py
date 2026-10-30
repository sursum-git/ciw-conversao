"""Fresh official12-v3: basename CLASS compile, explicit output, no network."""
from pathlib import Path
import hashlib,json,re
W=Path('D:/opencode/conversao-sc');R=W/'.runtime/ciw-completion-20261028'
OLD=R/'official-build12-v2';B=R/'official-build12-v3';P=B/'package';DIAG=R/'official-build12-v3-class-diagnostic'
REMOTE='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build12-v3'
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
def load(p):return json.loads(p.read_text(encoding='utf-8-sig'))
def out(p,v):p.parent.mkdir(parents=True,exist_ok=True);p.write_text(json.dumps(v,ensure_ascii=False,indent=2)+'\n',encoding='utf8')
def cp(a,b):b.parent.mkdir(parents=True,exist_ok=True);b.write_bytes(a.read_bytes())
assert not B.exists(),'Fresh stage only'
assert sha(OLD/'release.json')=='24e4267e24fd1efd40fd14efe168d334d904927ecb1b69ddd228117c7c951d0f'
for x in load(OLD/'release.json')['files']:assert sha(OLD/x['path'])==x['sha256']
m=load(OLD/'build-manifest.json');assert len(m['compileEntries'])==42
for x in m['canonicalIntegrationFiles']:assert sha(Path(x['target']))==x['baselineSha256']
for x in m['localClassSources']:assert sha(Path(x['canonicalPath']))==x['sha256']
log=(DIAG/'diagnostic-v3.log').read_text();assert'END errors=0 NUMDBS=0'in log and'OE=12.8'in log and log.count('ERROR=yes')==2 and log.count('ERROR=no')==2 and log.count('RED 12629')==2
assert not list(DIAG.rglob('*.r')),'Diagnostic must not SAVE'
for tree in ['package','backend-stage','php-tests','test-inputs','relations-state','metadata','local']:
 for p in (OLD/tree).rglob('*'):
  if not p.is_file():continue
  dst=B/tree/p.relative_to(OLD/tree);dst.parent.mkdir(parents=True,exist_ok=True);data=p.read_bytes()
  if tree in ['php-tests','test-inputs','relations-state']and p.suffix=='.php':data=data.replace(OLD.as_posix().encode(),B.as_posix().encode())
  dst.write_bytes(data)
for name in ['php-bootstrap.php','phpunit.xml','native-pages.cjs']:(B/name).write_bytes((OLD/name).read_bytes().replace(OLD.as_posix().encode(),B.as_posix().encode()).replace(b'Official12V2FullStage',b'Official12V3FullStage'))
for name in ['native-preview.json','native-calls.json','php-source-manifest.json','canonical-test-manifest.json','integration-plan.json']:cp(OLD/name,B/name)
for p in sorted(DIAG.rglob('*')):
 if p.is_file():cp(p,B/'class-diagnostic'/p.relative_to(DIAG))
simple=['PasoeRuntimeIdentity.cls','PasoeExecutionContext.cls'];entries=simple+m['compileEntries'][2:]
rcodes={name:'sursum-api/sursum/'+name.replace('.cls','.r')for name in simple}
source=(OLD/'package/Compile.p').read_text().replace('20261028-build12-v2','20261028-build12-v3')
source,n=re.subn(r'INITIAL "[^"]+"','INITIAL "'+','.join(entries)+'"',source,count=1);assert n==1
source=source.replace('DEFINE VARIABLE netLibrary AS CHARACTER NO-UNDO.','DEFINE VARIABLE netLibrary AS CHARACTER NO-UNDO.\nDEFINE VARIABLE compileEntry AS CHARACTER NO-UNDO.\nDEFINE VARIABLE classDir AS CHARACTER NO-UNDO INITIAL "'+REMOTE+'/sursum-api/sursum".\nDEFINE VARIABLE classSource AS CHARACTER NO-UNDO.\nDEFINE VARIABLE classRcode AS CHARACTER NO-UNDO.')
start=source.index('DO n=1 TO NUM-ENTRIES(entries):')
source=source[:start]+'''DO n=1 TO NUM-ENTRIES(entries):
 compileEntry = ENTRY(n,entries).
 IF compileEntry MATCHES '*.cls' THEN DO:
  IF LOOKUP(compileEntry,'PasoeRuntimeIdentity.cls,PasoeExecutionContext.cls') = 0 THEN DO:
   PUT UNFORMATTED 'FAIL unreviewed class entry' SKIP. OUTPUT CLOSE. QUIT.
  END.
  classSource = SEARCH(compileEntry).
  IF classSource = ? OR LC(REPLACE(classSource,CHR(92),'/')) <> LC(classDir + '/' + compileEntry) THEN DO:
   PUT UNFORMATTED 'FAIL class source not resolved from staged classfolder: ' compileEntry SKIP. OUTPUT CLOSE. QUIT.
  END.
  PUT UNFORMATTED 'CLASS SEARCH=' classSource SKIP.
  COMPILE VALUE(compileEntry) SAVE INTO VALUE(classDir) NO-ERROR.
 END.
 ELSE COMPILE VALUE(compileEntry) SAVE NO-ERROR.
 PUT UNFORMATTED compileEntry ' COMPILER:ERROR=' COMPILER:ERROR SKIP.
 IF COMPILER:ERROR OR ERROR-STATUS:ERROR THEN DO:
  DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END.
  PUT UNFORMATTED 'FAIL COMPILE' SKIP. OUTPUT CLOSE. QUIT.
 END.
 IF compileEntry MATCHES '*.cls' THEN DO:
  classRcode = classDir + '/' + REPLACE(compileEntry,'.cls','.r').
  FILE-INFO:FILE-NAME = classRcode.
  IF FILE-INFO:FULL-PATHNAME = ? OR FILE-INFO:FILE-SIZE <= 0 THEN DO:
   PUT UNFORMATTED 'FAIL missing class rcode in explicit SAVE INTO destination: ' classRcode SKIP. OUTPUT CLOSE. QUIT.
  END.
  PUT UNFORMATTED 'CLASS RCODE=' classRcode ' BYTES=' FILE-INFO:FILE-SIZE SKIP.
 END.
END. PUT UNFORMATTED 'PASS COMPILE ALL' SKIP. OUTPUT CLOSE. QUIT.
'''
(P/'Compile.p').write_text(source,encoding='utf8')
for name in ['Regression.p','compile122.ps1']:(P/name).write_bytes((OLD/'package'/name).read_bytes().replace(b'20261028-build12-v2',b'20261028-build12-v3').replace(b'official-build12-v2',b'official-build12-v3'))
uploads=[{'local':str(p.relative_to(W)),'remote':REMOTE+'/'+p.relative_to(P).as_posix()}for p in sorted(P.rglob('*'))if p.is_file()];assert len(uploads)==73
plan=load(OLD/'remote-plan.json');plan['uploads']=uploads;plan['directories']=[x.replace('20261028-build12-v2','20261028-build12-v3')for x in plan['directories']];plan['commands']=[x.replace('20261028-build12-v2','20261028-build12-v3')for x in plan['commands']]
for x in plan['downloads']:x['remote']=x['remote'].replace('20261028-build12-v2','20261028-build12-v3');x['local']=x['local'].replace('official-build12-v2','official-build12-v3')
assert len(plan['downloads'])==118
out(B/'remote-plan.json',plan);out(B/'source-manifest.json',[{'file':x['local'],'remote':x['remote'],'sha256':sha(W/x['local'])}for x in uploads])
closure=load(OLD/'closure-manifest.json');closure.update({'predecessorClosureSha256':sha(OLD/'closure-manifest.json'),'additionalExplicitCompileEntries':simple,'classRcodeMapping':rcodes,'classCompilePolicy':'Simple basenames only; SEARCH must resolve to the exact staged classfolder; SAVE INTO that explicit folder; require nonempty rcode there.','noSaveDiagnosticSha256':sha(DIAG/'diagnostic-v3.log'),'namespaceRedGreenProvedLocal128Only':True,'canonicalClassDeclarationsUnchanged':True})
out(B/'closure-manifest.json',closure)
proof=[]
for p in sorted((OLD/'package').rglob('*')):
 if not p.is_file():continue
 rel=p.relative_to(OLD/'package').as_posix();changed=rel in ['Compile.p','Regression.p','compile122.ps1'];assert changed or sha(p)==sha(P/rel)
 proof.append(dict(relative=rel,oldSha256=sha(p),newSha256=sha(P/rel),harnessPathChange=changed))
for x in m['canonicalIntegrationFiles']:
 src=P/x['relative']if x['relative'].startswith('sursum-api/')else B/'backend-stage/backend/src/Runtime'/Path(x['relative']).name
 assert sha(src)==x['candidateSha256']
out(B/'delta-proof.json',dict(oldReleaseSha256=sha(OLD/'release.json'),fiveProductsByteIdentical=True,oldPackageFiles=proof,onlyNewPackageFiles=[],phpSourcesByteIdentical=all(sha(p)==sha(OLD/'backend-stage'/p.relative_to(B/'backend-stage'))for p in (B/'backend-stage').rglob('*')if p.is_file()),businessExecuted=False,networkExecuted=False,sourceClassBytesUnchanged=True))
m.update(state='PREPARED_OFFLINE_REVIEW_PENDING',predecessorReleaseSha256=sha(OLD/'release.json'),compileEntries=entries,classRcodeMapping=rcodes,compileDependencyManifestSha256=sha(B/'closure-manifest.json'),remotePlanSha256=sha(B/'remote-plan.json'),sourceManifestSha256=sha(B/'source-manifest.json'))
out(B/'build-manifest.json',m)
v=(OLD/'verify.py').read_text();v=v.replace("{'sursum-api/sursum/PasoeRuntimeIdentity.cls','sursum-api/sursum/PasoeExecutionContext.cls'}","{'PasoeRuntimeIdentity.cls','PasoeExecutionContext.cls'}").replace("['sursum-api/sursum/PasoeRuntimeIdentity.cls','sursum-api/sursum/PasoeExecutionContext.cls']","['PasoeRuntimeIdentity.cls','PasoeExecutionContext.cls']")
v=v.replace("p=d/Path(entry).with_suffix('.r');","p=d/(m['classRcodeMapping'][entry] if entry.endswith('.cls') else Path(entry).with_suffix('.r'));")
v=v.replace("assert 'JsonProgramWebHandler.cls'not in (B/'package/Compile.p').read_text()","assert 'JsonProgramWebHandler.cls'not in (B/'package/Compile.p').read_text()\ncompiler=(B/'package/Compile.p').read_text();assert 'SAVE INTO VALUE(classDir)'in compiler and 'classSource = SEARCH(compileEntry)'in compiler and 'CLASS RCODE='in compiler\ndiag=(B/'class-diagnostic/diagnostic-v3.log').read_text();assert 'END errors=0 NUMDBS=0'in diag and diag.count('RED 12629')==2 and diag.count('ERROR=no')==2\nassert not list((B/'class-diagnostic').rglob('*.r'))")
(B/'verify.py').write_text(v,encoding='utf8');cp(Path(__file__),B/'prepare.py');out(B/'preparer.json',dict(path=str(Path(__file__)),sha256=sha(Path(__file__)),copySha256=sha(B/'prepare.py'),executedOnlyOfflinePreparation=True))
print(json.dumps(dict(prepared=str(B),compiles=42,uploads=73,downloads=118,testLogs=28,checks=5704,productsIdentical=5,classesUnchanged=True,localDiagnostic='12.8 NUMDBS0 NOSAVE RED/GREEN',officialExecuted=False)))
