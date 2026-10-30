"""Offline current13 PHP composition; one candidate Builder, no canonical writes."""
from pathlib import Path
import hashlib,json,shutil
W=Path(__file__).resolve().parents[2];R=W/'.runtime/ciw-completion-20261028'
D=R/'filter-only-after13-composition';F=W/'integration-src/ciw-completion-20261028/container-item-navigation-filter-only';OLD=R/'official-build13-v3';C=Path('D:/opencode/construtor-pg')
FREEZE='e2787dfe2f59cb5fd393c75f6db00fab308b93874c2a11317acb188d97bb3b8a'
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
def read(p):return json.loads(p.read_bytes())
def out(p,v):p.parent.mkdir(parents=True,exist_ok=True);p.write_text(json.dumps(v,ensure_ascii=False,indent=2)+'\n',encoding='utf8')
def cp(a,b):b.parent.mkdir(parents=True,exist_ok=True);shutil.copyfile(a,b)
assert not D.exists(),'Fresh composition only';D.mkdir()
out(D/'state.json',dict(state='PREPARING_CURRENT13_FIXTURES_BEFORE_SINGLE_FULL',canonicalWrites=False,networkExecuted=False))
assert sha(F/'frozen-v1/manifest.json')==FREEZE;m=read(F/'frozen-v1/manifest.json')
for x in m['files']:assert sha(Path(x['path']))==x['sha256'],x['path']
pins=[]
for x in m['sharedFiles']:
 canonical=Path(x['canonical']);candidate=F/'candidate'/x['relative'];assert sha(canonical)==x['baselineSha256'];assert sha(candidate)==x['candidateSha256']
 cp(candidate,D/'filter-only/candidate'/x['relative']);cp(F/'baseline'/x['relative'],D/'filter-only/baseline'/x['relative']);pins.append(dict(**x,candidate=str(D/'filter-only/candidate'/x['relative'])))
assert len(pins)==7 and next(x for x in pins if x['relative'].endswith('ProgramBuilderService.php'))['candidateSha256']=='a58a98b85127c85377b1592c2f6bde38b0a8bf78ce86d343bed239cf084e0401'
canonical=read(R/'build13-root-companions-v3/canonical-manifest.json');assert canonical['success']and len(canonical['files'])==12
for x in canonical['files']:assert sha(Path(x['target']))==x['sha256']
sources=[]
for p in sorted((C/'backend/src').rglob('*.php')):
 rel=p.relative_to(C/'backend/src');candidate=F/'candidate/backend/src'/rel;src=candidate if candidate.is_file()else p;target=D/'php-stage'/rel;cp(src,target);sources.append(dict(canonical=str(p),canonicalSha256=sha(p),staged=str(target),stagedSha256=sha(target),candidate=candidate.is_file()))
assert sum(x['candidate']for x in sources)==1
for name in ['RuntimeCiwComparisonRead.php','RuntimeCiwErpQuery.php','RuntimeApiEntityActionService.php']:
 p=C/'backend/src/Runtime'/name;assert sha(p)==sha(D/'php-stage/Runtime'/name)
# Copy only immutable test/JSON fixtures from13, never a prior PHP source stage.
old2=R/'official-build13-v2';old3=OLD;changes=[]
def copy_input(a,b):
 body=a.read_bytes();new=body
 if a.suffix in ['.php','.json','.cjs','.xml','.html']:
  for prior in [old2,old3]:new=new.replace(prior.as_posix().encode(),D.as_posix().encode()).replace(str(prior).encode(),str(D).encode())
 b.parent.mkdir(parents=True,exist_ok=True);b.write_bytes(new)
 if body!=new:changes.append(dict(source=str(a),sourceSha256=sha(a),target=str(b),targetSha256=sha(b),reason='Isolated fixture/output paths only'))
for tree in ['php-tests','test-inputs','relations-state','tests/php','metadata']:
 for p in(OLD/tree).rglob('*'):
  if p.is_file():copy_input(p,D/tree/p.relative_to(OLD/tree))
for p in(OLD/'local').glob('*.json'):copy_input(p,D/'local'/p.name)
for name in ['native-calls.json','native-preview.json']:copy_input(OLD/name,D/name)
copy_input(OLD/'native-calls.json',D/'local/native-calls.json')
for tree in ['metadata','tests']:
 for p in(F/tree).rglob('*'):
  if not p.is_file():continue
  body=p.read_bytes()
  # Mutable outputs go only to this fresh composition; immutable baseline205
  # comparison files and current metadata exports remain pinned read inputs.
  if p.suffix in ['.php','.cjs']:
   body=body.replace(b"(getenv('NAV_RECEIPTS')?:'D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-item-navigation-filter-only')",("(getenv('NAV_RECEIPTS')?:'"+(D/'receipts').as_posix()+"')").encode())
   body=body.replace(b"path.resolve(domain,'../../../.runtime/ciw-completion-20261028/container-item-action-native/current/op1014-program.json')",b"path.resolve('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-item-action-native/current/op1014-program.json')")
  dst=D/'filter-only'/tree/p.relative_to(F/tree);dst.parent.mkdir(parents=True,exist_ok=True);dst.write_bytes(body)
# JS PHP boundary uses the same staged real App loader, not canonical fallback.
(D/'filter-only/tests/check-context.php').write_bytes((D/'filter-only/tests/check-context.php').read_bytes().replace(b"require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';",("require '"+(D/'php-bootstrap.php').as_posix()+"';").encode()))
for rel in ['src/crud-engine/CrudUtils.js','src/crud-engine/CrudKendoGridRenderer.js']:
 cp(C/rel,D/'filter-only/candidate'/rel)
cp(OLD/'php-bootstrap.php',D/'php-bootstrap.php')
bootstrap=(D/'php-bootstrap.php').read_bytes().replace(b"__DIR__.'/backend-stage/backend/src/'",b"__DIR__.'/php-stage/'")
(D/'php-bootstrap.php').write_bytes(bootstrap)
config=f'''<?xml version="1.0" encoding="UTF-8"?><phpunit bootstrap="{(D/'php-bootstrap.php').as_posix()}" cacheResult="false"><testsuites><testsuite name="FilterOnlyCurrent13Full"><directory>{(C/'backend/tests').as_posix()}</directory><directory>{(D/'php-tests').as_posix()}</directory><exclude>{(D/'php-tests/nf/tests/RuntimeContainerNfAvailableReadTest.php').as_posix()}</exclude><directory>{(D/'tests/php').as_posix()}</directory><directory>{(D/'filter-only/tests').as_posix()}</directory></testsuite></testsuites></phpunit>'''
(D/'phpunit-full.xml').write_text(config,encoding='utf8')
focus=f'''<?xml version="1.0" encoding="UTF-8"?><phpunit bootstrap="{(D/'php-bootstrap.php').as_posix()}" cacheResult="false"><testsuites><testsuite name="FilterOnlyFocus"><directory>{(D/'filter-only/tests').as_posix()}</directory></testsuite></testsuites></phpunit>'''
(D/'phpunit-focus.xml').write_text(focus,encoding='utf8');(D/'receipts').mkdir()
for rel in ['tests/php/reader-row.json','local/nf-page-native-first.json','local/native-calls.json','php-tests/nf-pagination/tests/RuntimeContainerNfAvailablePageTest.php']:
 assert(D/rel).is_file(),rel
# Pin all reads that were inherited from13, including corrected fixtures/exclude.
out(D/'source-map.json',dict(files=sources,sourceCount=len(sources),allSourceCanonical13=True,onlyCandidate='Builder/ProgramBuilderService.php',currentComparisonHelper=True,canonicalReceiptSha256=sha(R/'build13-root-companions-v3/canonical-manifest.json')))
out(D/'test-path-rebases.json',changes)
inputs=[dict(path=str(F/'frozen-v1/manifest.json'),sha256=FREEZE),dict(path=str(OLD/'release.json'),sha256=sha(OLD/'release.json')),dict(path=str(OLD/'phpunit.xml'),sha256=sha(OLD/'phpunit.xml')),dict(path=str(OLD/'php-bootstrap.php'),sha256=sha(OLD/'php-bootstrap.php'))]
out(D/'plan.json',dict(state='PREPARED_FOCUS_THEN_SINGLE_FULL',freezeSha256=FREEZE,productPins=len(m['files']),inputs=inputs,sharedFiles=pins,canonicalPhpSources=len(sources),fullExpectedTests=1012,fullExpectedAssertions=7978,expectedLoadedAppDefinitions=278,focusExpectedTests=7,focusExpectedAssertions=75,jsExpectedTests=22,testsDirectories=['backend/tests','php-tests13','tests/php13','filter-only/tests'],exclude='Exact13 NF pre-pagination11cases replaced by13page13cases',integerRangeIncluded=False,ABLIncluded=False,canonicalWrites=False,networkExecuted=False))
print(json.dumps(dict(stage=str(D),phpSources=len(sources),frozenPins=len(m['files']),shared=7,AppExpected=278,focus='7/75',full='1012/7978',js=22)))
