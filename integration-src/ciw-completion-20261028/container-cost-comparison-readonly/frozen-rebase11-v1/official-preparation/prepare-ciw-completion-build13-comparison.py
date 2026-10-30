"""Offline comparison-only official13 proposal. Never SSH/compile/publish/write canonicals."""
from pathlib import Path
import hashlib,json,shutil,re,xml.etree.ElementTree as ET
ROOT=Path(__file__).resolve().parents[2]
DOMAIN=ROOT/'integration-src/ciw-completion-20261028/container-cost-comparison-readonly/rebase-after11'
LOCAL=ROOT/'.runtime/ciw-completion-20261028/comparison-after11'
OUT=ROOT/'.runtime/ciw-completion-20261028/official-build13-preparation'
REMOTE='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison'
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
def load(p):return json.loads(p.read_text(encoding='utf-8'))
assert not OUT.exists(),'Prepare into a fresh directory; do not overwrite a reviewed stage'
baselines=load(DOMAIN/'baselines.json')
for x in baselines['files']:assert sha(Path(x['target']))==x['baselineSha256'],'Canonical changed: rebase after12 before preparing again'
assert sha(DOMAIN/'test-inputs/ProgramBuilderService205e.php')=='205ebd14329f8e8896d07c07716939db8a12d58345fecf76cab5252f4e0694a7'
tree=ET.parse(LOCAL/'full-php/php-full.xml');cases=tree.findall('.//testcase');assert len(cases)==1001 and sum(int(x.attrib['assertions'])for x in cases)==7807;assert not tree.findall('.//failure')and not tree.findall('.//error')
loader=load(LOCAL/'full-php/php-stage-loader-proof.json');assert loader['success']and not loader['outsideStage']
source=LOCAL/'regression-local/package';pkg=OUT/'package';pkg.mkdir(parents=True)
production=[Path(x).name for x in re.findall(r"COMPILE '([^']+)'",(LOCAL/'regression-local/CompileClosure.p').read_text())]
production.append('ContainersCustoCalculator.p')
compiles=[]
for name in production:
 src=source/'sursum-api/programs'/name;dest=pkg/'sursum-api/programs'/name;dest.parent.mkdir(parents=True,exist_ok=True);shutil.copy2(src,dest);compiles.append(dest.relative_to(pkg).as_posix())
regressions=load(DOMAIN/'tests/regression-list.json')
new=[('ComparisonProjectionTest.p','comparison-projection-tests.log',26),('ComparisonRoundingEvidenceTest.p','comparison-rounding-tests.log',21),('ComparisonItemJoinTest.p','comparison-itemjoin-tests.log',10),('ComparisonMaterializerTest.p','comparison-materializer-tests.log',14),('ComparisonReaderTest.p','comparison-reader-tests.log',13),('ComparisonSqlObservedTest.p','comparison-sql-observed-tests.log',274),('ComparisonServiceTest.p','comparison-service-tests.log',21)]
suites=[]
for name,log,count in new:
 src=DOMAIN/'tests/abl'/name;shutil.copy2(src,pkg/name);suites.append({'file':name,'sha256':sha(src),'output':log,'checks':count,'kind':'new'})
for row in regressions:
 src=source/row['name'];assert sha(src)==row['sourceSha256'];shutil.copy2(src,pkg/src.name);suites.append({'file':src.name,'sha256':sha(src),'output':row['output'],'checks':row['expectedChecks'],'kind':'regression'})
assert len(suites)==19 and sum(x['checks']for x in suites)==923
for row in suites:compiles.append(row['file'])
fixture=source/'ContainersVersionFixture.p';assert fixture.exists();shutil.copy2(fixture,pkg/fixture.name);compiles.append(fixture.name)
for src in source.rglob('*'):
 if src.is_file()and src.suffix in ['.i','.cls']:
  dest=pkg/src.relative_to(source);dest.parent.mkdir(parents=True,exist_ok=True);shutil.copy2(src,dest)
for src in (DOMAIN/'tests/abl').glob('*.i'):shutil.copy2(src,pkg/src.name)
assert len(compiles)==39 and len(set(compiles))==39
(OUT/'test-list.json').write_text(json.dumps(suites,indent=2)+'\n',encoding='utf-8')
compile_lines=['DEFINE VARIABLE n AS INTEGER NO-UNDO.','DEFINE VARIABLE failed AS LOGICAL NO-UNDO.',f"PROPATH='{REMOTE},{REMOTE}/sursum-api/programs,' + OS-GETENV('CIW_COMPILE_NETLIB') + ',' + PROPATH.","OUTPUT TO 'compile.log'.","PUT UNFORMATTED 'OpenEdge ' PROVERSION ' NUM-DBS=' NUM-DBS SKIP.","IF NUM-DBS<>1 OR NOT (PROVERSION BEGINS '12.2') THEN DO: PUT UNFORMATTED 'FAIL ENVIRONMENT' SKIP. OUTPUT CLOSE. QUIT. END."]
for relative in compiles:
 folder=(Path(REMOTE)/Path(relative).parent).as_posix();compile_lines += [f"COMPILE '{REMOTE}/{relative}' SAVE INTO '{folder}' NO-ERROR.",f"PUT UNFORMATTED '{relative} ERROR=' COMPILER:ERROR SKIP.","IF COMPILER:ERROR THEN failed=TRUE.","DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END."]
compile_lines += ["IF failed THEN PUT UNFORMATTED 'FAIL COMPILE' SKIP. ELSE PUT UNFORMATTED 'PASS COMPILE ALL 39' SKIP.","OUTPUT CLOSE. QUIT."]
(pkg/'Compile.p').write_text('\n'.join(compile_lines)+'\n',encoding='utf-8')
(pkg/'Regression.p').write_text(f"PROPATH='{REMOTE},{REMOTE}/sursum-api/programs,' + OS-GETENV('CIW_COMPILE_NETLIB') + ',' + PROPATH.\nIF NUM-DBS<>0 THEN QUIT.\nSESSION:NUMERIC-FORMAT=ENTRY(1,SESSION:PARAMETER).\nRUN VALUE(ENTRY(2,SESSION:PARAMETER)).\nQUIT.\n",encoding='utf-8')
files=[{'relative':p.relative_to(pkg).as_posix(),'sha256':sha(p),'bytes':p.stat().st_size}for p in sorted(pkg.rglob('*'))if p.is_file()]
manifest={'state':'PREPARED_HELD_REBASE_AFTER12_AND_MANAGER_REVIEW','sourceBaseline':'official11; candidate only, must compose NF12 delta before final official13 release','canonicalWrites':False,'networkExecuted':False,'businessWrites':False,'programCodes':['op1040','op1041'],'compiles':compiles,'expectedCompileCount':39,'compileNumDbs':1,'testNumDbs':0,'suites':19,'checksPerCombination':923,'combinations':4,'expectedChecks':3692,'expectedLogs':76,'builder205ePrivateTestOnly':True,'builderCanonicalIntegrationRequiredBeforeMetadata':True,'orphanMaster404Gate':True,'files':files}
(OUT/'source-manifest.json').write_text(json.dumps(manifest,indent=2)+'\n',encoding='utf-8')
plan={'state':manifest['state'],'server':'compiler','compiler':'C:/Progress_12/OE/bin/_progres.exe','remoteDirectory':REMOTE,'compileSchema':{'logicalDb':'espec','numDbs':1,'host':'192.168.0.111','port':10012,'network':'TCP','credentialsInFiles':False},'netLibrary':'C:/Progress_12/OE/gui/netlib/OpenEdge.Net.pl','netLibraryFallback':False,'uploads':[{'local':str(pkg/x['relative']),'remote':REMOTE+'/'+x['relative'],'sha256':x['sha256']}for x in files],'commands':[],'commandsHeldReason':'Parent/root must review current12 canonical hashes and compose the NF12 hunks before an executable official13 plan. No stale11 execution plan is released.','futureCompileArguments':['-b','-db','espec','-H','192.168.0.111','-S','10012','-N','TCP','-ld','espec','-cpinternal','UTF-8','-cpstream','UTF-8','-p','Compile.p'],'futureTestArguments':['-b','-cpinternal','UTF-8|ISO8859-1','-cpstream','UTF-8','-param','AMERICAN|EUROPEAN,<closed test-list file>','-p','Regression.p'],'downloadsPlanned':['compile.log']+[x['output']for x in suites]+[x.replace('.p','.r')for x in compiles],'requiredBeforeExecution':['Manager review and release','Rebase/compose after official12 current canonical hashes','Source-manifest and test-list hash guards','Same physical espec schema1 for compile, TT0DB for every test'],'catalogMetadataHeld':['Orphan master source parity policy decision','Private Builder205e integrated by its own release before metadata','Fresh actual source/parent locks and additive metadata only'],'sourceManifestSha256':sha(OUT/'source-manifest.json')}
(OUT/'remote-plan.json').write_text(json.dumps(plan,indent=2)+'\n',encoding='utf-8')
print(json.dumps({'state':manifest['state'],'files':len(files),'compiles':39,'suites':19,'checks':3692,'logs':76,'networkExecuted':False,'manifestSha256':sha(OUT/'source-manifest.json')}))
