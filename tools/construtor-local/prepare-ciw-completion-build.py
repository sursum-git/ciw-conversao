"""Freeze a combined official 12.2 build. Local staging only; never connects."""
from pathlib import Path
import difflib, hashlib, json, re, sys

ROOT = Path(__file__).resolve().parents[2]
MOTOR = Path('D:/opencode/motor-progress/v2')
PACKAGES = ROOT / 'integration-src/ciw-completion-20261028'
FISCAL = PACKAGES / 'container-fiscal-readonly'
HISTORY = PACKAGES / 'container-version-history/frozen-v1.3'
BUILD = ROOT / f'.runtime/ciw-completion-20261028/official-build{int(sys.argv[1])}'
PACKAGE = BUILD / 'package'
assert not BUILD.exists(), 'Refuse to replace an existing build'

def load(path): return json.loads(path.read_text(encoding='utf-8-sig'))
def sha(path): return hashlib.sha256(path.read_bytes()).hexdigest()
def text(path): return path.read_text(encoding='utf-8-sig')
def verify_manifest(directory):
    manifest = load(directory / 'manifest.json')
    for item in manifest['files']:
        assert sha(directory / item['path']) == item['sha256'], str(directory / item['path'])
    return sha(directory / 'manifest.json')

manifest_hashes = {'fiscal': verify_manifest(FISCAL), 'history-v1.3': verify_manifest(HISTORY)}
assert manifest_hashes['fiscal'] == 'b847a16ad4406c6703490bb2fb7809dfea3fce5dc6012bc94e52e2fca7643173'
assert manifest_hashes['history-v1.3'] == 'ccf6e6fa74af52d37ef71d58853c2eba03b35f02d67669242caa19cccf826bb2'
original_history = PACKAGES / 'container-version-history/frozen-v1'
for subdir in ['abl','includes','metadata']:
    for source in (HISTORY / subdir).glob('*'):
        assert sha(source) == sha(original_history / subdir / source.name), 'Production/history metadata changed since v1'

def apply_unified(value, patch):
    """Apply exact unique old hunks; never trust line numbers or fuzzy offsets."""
    lines = patch.splitlines(keepends=True)
    i = 0
    while i < len(lines):
        if not lines[i].startswith('@@ '): i += 1; continue
        i += 1; old = []; new = []
        while i < len(lines) and not lines[i].startswith('@@ '):
            line = lines[i]
            if line.startswith(('diff ', '--- ', '+++ ')): break
            if line.startswith(' '): old.append(line[1:]); new.append(line[1:])
            elif line.startswith('-'): old.append(line[1:])
            elif line.startswith('+'): new.append(line[1:])
            elif line.startswith('\\ No newline'): pass
            else: raise AssertionError('Unexpected unified diff line: ' + line)
            i += 1
        old_text = ''.join(old); new_text = ''.join(new)
        assert old_text and value.count(old_text) == 1, 'Hunk absent or ambiguous'
        value = value.replace(old_text, new_text, 1)
    return value

shared_names = ['ContainersVersionService.p', 'CiwErpReadService.p', 'CiwCadastrosCrud.p']
shared = {}
baselines = []
history_baselines = load(HISTORY / 'baselines.json')['baselines']
for name in shared_names:
    target = MOTOR / 'sursum-api/programs' / name
    baseline = next(x for x in history_baselines if x['target'].endswith('/' + name))
    assert sha(target) == baseline['baselineSha256'], 'History baseline changed: ' + name
    shared[name] = apply_unified(text(target), text(HISTORY / baseline['patch']))
    preserved = shared[name].replace('\n', '\r\n') if b'\r\n' in target.read_bytes() else shared[name]
    assert hashlib.sha256(preserved.encode()).hexdigest() == baseline['candidateSha256'], name
    baselines.append({'target': str(target), 'sha256': sha(target)})
fiscal_plan = load(FISCAL / 'patches/patch-plan.json')
for patch in fiscal_plan['textPatches']:
    name = Path(patch['target']).name
    if name not in shared_names: continue
    target = Path(patch['target'])
    assert sha(target) == patch['baselineSha256'], 'Fiscal baseline changed: ' + name
    for change in patch['changes']:
        assert shared[name].count(change['old']) == 1, 'Combined patch collision: ' + name
        shared[name] = shared[name].replace(change['old'], change['new'], 1)

files = {}
production_candidates = []
for directory in [FISCAL, HISTORY]:
    for source in (directory / 'abl').glob('*.p'):
        key = 'sursum-api/programs/' + source.name
        assert key not in files
        files[key] = source
        production_candidates.append(key)
    for source in (directory / 'includes').glob('*.i'):
        key = 'sursum-api/includes/' + source.name
        files[key] = source
        production_candidates.append(key)
for name in shared_names:
    key = 'sursum-api/programs/' + name
    files[key] = MOTOR / key
    production_candidates.append(key)

# Every test executes in its own AVM with no -db option. Fixtures use TT only.
container_tests = MOTOR / 'tests/abl/container-panel'
tests = [
    ('ContainerFiscalReadOnlyTest.p', FISCAL / 'tests/ContainerFiscalReadOnlyTest.p', 'fiscal-tests.log'),
    ('ContainersVersionHistoryTest.p', HISTORY / 'tests/abl/ContainersVersionHistoryTest.p', 'container-version-history-tests.log'),
    ('ContainersVersionTest.p', container_tests / 'ContainersVersionTest.p', 'containers-version-tests-{culture}.log'),
    ('ContainersVersionCompositionTest.p', container_tests / 'ContainersVersionCompositionTest.p', 'containers-version-composition-tests-{culture}.log'),
    ('ContainersVersionContextTest.p', container_tests / 'ContainersVersionContextTest.p', 'containers-version-context-tests-{culture}.log'),
    ('ContainersProcessBoundaryTest.p', container_tests / 'ContainersProcessBoundaryTest.p', 'containers-process-boundary-tests-{culture}.log'),
    ('CiwErpReadTest.p', MOTOR / 'tests/abl/ciw-erp-consultas/CiwErpReadTest.p', 'erp-read-{culture}.log'),
    ('PurchaseItemsReadTest.p', MOTOR / 'tests/abl/purchase-items/PurchaseItemsReadTest.p', 'purchase-item-read-{culture}.log'),
]
for name, source, _ in tests: files[name] = source
files['ContainersVersionHistoryTestTables.i'] = HISTORY / 'tests/abl/ContainersVersionHistoryTestTables.i'

# Resolve only dependencies named by source/include paths or fixed program literals.
search_roots = [MOTOR / 'sursum-api/programs', MOTOR / 'sursum-api/includes', container_tests,
                MOTOR / 'tests/abl/ciw-erp-consultas', MOTOR / 'tests/abl/purchase-items']
processed = set()
while True:
    pending = [(rel, src) for rel, src in files.items() if rel not in processed]
    if not pending: break
    for rel, source in pending:
        processed.add(rel)
        value = shared.get(source.name, text(source))
        refs = re.findall(r'\{([^\s{}]+\.i)', value)
        # Dispatcher dynamic branches are compiled but never invoked by TT suites;
        # copying every unrelated registered resource would broaden the build.
        if source.name != 'CiwCadastrosCrud.p':
            refs += re.findall(r'''["'](sursum-api/(?:programs|includes)/[^"'\r\n]+\.[pir])["']''', value)
            refs += ['sursum-api/programs/' + n + '.p' for n in re.findall(r'''Compiled\(["']([A-Za-z][A-Za-z0-9_]+)["']\)''', value)]
        refs += re.findall(r'''\bRUN\s+([A-Za-z][A-Za-z0-9_]+\.[pr])\b''', value, re.I)
        for ref in refs:
            ref = ref.replace('\\', '/')
            if ref.endswith('.r'): ref = ref[:-2] + '.p'
            if ref in files: continue
            if ref.startswith('sursum-api/'):
                target = MOTOR / ref
                assert target.exists(), 'Missing fixed dependency ' + ref
                files[ref] = target
            else:
                if ref == 'CiwErpReadService.p': continue  # Root wrapper is created below.
                matches = [p / ref for p in search_roots if (p / ref).exists()]
                assert matches, 'Unresolved fixed include/program ' + ref
                assert len({sha(p) for p in matches}) == 1, 'Ambiguous fixed dependency ' + ref
                match = matches[0]
                key = match.relative_to(MOTOR).as_posix() if match.is_relative_to(MOTOR / 'sursum-api') else ref
                files[key] = match

PACKAGE.mkdir(parents=True)
for rel, source in files.items():
    target = PACKAGE / rel; target.parent.mkdir(parents=True, exist_ok=True)
    if source.name in shared:
        value = shared[source.name]
        if b'\r\n' in source.read_bytes(): value = value.replace('\n', '\r\n')
        target.write_bytes(value.encode('utf-8'))
    else: target.write_bytes(source.read_bytes())

# Existing regressions had only been run UTF8. Preserve the ISO session and all
# assertions; adapt only their JSON input harness to the real UTF8 parser boundary.
harness_patches = []
repairs = {
    'ContainersVersionTest.p': [('parser=NEW ObjectModelParser(). objectValue=CAST(parser:Parse(jsonValue),JsonObject). DELETE OBJECT parser.',
        "DEFINE VARIABLE utf8Input AS LONGCHAR NO-UNDO.\n FIX-CODEPAGE(utf8Input)='UTF-8'. utf8Input=jsonValue.\n parser=NEW ObjectModelParser(). objectValue=CAST(parser:Parse(utf8Input),JsonObject). DELETE OBJECT parser.")],
    'ContainersVersionRuntimeFixture.i': [('DEFINE INPUT PARAMETER lc AS LONGCHAR NO-UNDO.',
        'DEFINE INPUT PARAMETER lc AS LONGCHAR NO-UNDO.\n DEFINE VARIABLE utf8Input AS LONGCHAR NO-UNDO.'),
        ('p=NEW ObjectModelParser(). o=CAST(p:Parse(lc),JsonObject). names=o:GetNames().',
        "FIX-CODEPAGE(utf8Input)='UTF-8'. utf8Input=lc.\n p=NEW ObjectModelParser(). o=CAST(p:Parse(utf8Input),JsonObject). names=o:GetNames().")]
}
(BUILD / 'harness-patches').mkdir()
for rel, changes in repairs.items():
    target = PACKAGE / rel
    before_hash = sha(target); before = text(target); after = before
    for old, new in changes:
        assert after.count(old) == 1, 'Harness source changed: ' + rel
        after = after.replace(old, new, 1)
    ending = '\r\n' if b'\r\n' in target.read_bytes() else '\n'
    target.write_bytes(after.replace('\n', ending).encode('utf-8'))
    patch_path = BUILD / 'harness-patches' / (rel + '.patch')
    patch_path.write_text(''.join(difflib.unified_diff(before.splitlines(True),after.splitlines(True),fromfile='original/'+rel,tofile='stage/'+rel)),encoding='utf-8')
    harness_patches.append({'path':rel,'beforeSha256':before_hash,'afterSha256':sha(target),
                           'patch':str(patch_path.relative_to(BUILD)), 'patchSha256':sha(patch_path),
                           'kind':'test/provider only: explicit UTF8 copy before LONGCHAR JSON parser','productionChanged':False})

# No remote PROPATH contains a local checkout or production directory.
(PACKAGE / 'CiwErpReadService.p').write_text('''USING Progress.Json.ObjectModel.*.
DEFINE INPUT PARAMETER h AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER resourceValue AS CHARACTER NO-UNDO.
DEFINE INPUT PARAMETER companyValue AS CHARACTER NO-UNDO.
DEFINE INPUT PARAMETER requestValue AS JsonObject NO-UNDO.
DEFINE OUTPUT PARAMETER responseValue AS JsonObject NO-UNDO.
RUN sursum-api/programs/CiwErpReadService.p(h,resourceValue,companyValue,requestValue,OUTPUT responseValue).
''', encoding='utf-8')
remote = 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build' + sys.argv[1]
propath = remote + ',' + remote + '/sursum-api/programs,' + remote + '/sursum-api/includes,'
entries = sorted(p.relative_to(PACKAGE).as_posix() for p in PACKAGE.rglob('*.p'))
(PACKAGE / 'Compile.p').write_text('''BLOCK-LEVEL ON ERROR UNDO, THROW.
DEFINE VARIABLE entries AS CHARACTER NO-UNDO INITIAL "''' + ','.join(entries) + '''".
DEFINE VARIABLE n AS INTEGER NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.
PROPATH="''' + propath + '''" + PROPATH.
OUTPUT TO 'compile.log'. PUT UNFORMATTED 'OpenEdge ' PROVERSION ' NUM-DBS=' NUM-DBS SKIP.
IF NUM-DBS<>0 THEN DO: PUT UNFORMATTED 'FAIL connected database' SKIP. OUTPUT CLOSE. QUIT. END.
DO n=1 TO NUM-ENTRIES(entries):
 COMPILE VALUE(ENTRY(n,entries)) SAVE NO-ERROR.
 PUT UNFORMATTED ENTRY(n,entries) ' COMPILER:ERROR=' COMPILER:ERROR SKIP.
 IF COMPILER:ERROR OR ERROR-STATUS:ERROR THEN DO:
  DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END.
  PUT UNFORMATTED 'FAIL COMPILE' SKIP. OUTPUT CLOSE. QUIT.
 END.
END. PUT UNFORMATTED 'PASS COMPILE ALL' SKIP. OUTPUT CLOSE. QUIT.
''', encoding='utf-8')
(PACKAGE / 'Regression.p').write_text('''BLOCK-LEVEL ON ERROR UNDO, THROW.
PROPATH="''' + propath + '''" + PROPATH.
IF NUM-DBS<>0 THEN UNDO, THROW NEW Progress.Lang.AppError('Connected DB forbidden',1).
SESSION:NUMERIC-FORMAT=ENTRY(1,SESSION:PARAMETER).
RUN VALUE(ENTRY(2,SESSION:PARAMETER)).
IF NUM-DBS<>0 THEN UNDO, THROW NEW Progress.Lang.AppError('Connected DB forbidden',1).
QUIT.
''', encoding='utf-8')

model = text(ROOT / '.runtime/purchase-pending-integration-20261028/build3/package/compile122.ps1')
ps = model.split("Run-Avm @('-b'")[0].replace('C:/Users/tadeu.parreiras/codex-purchase-pending-20261028-build3', remote)
ps += "Run-Avm @('-b','-cpinternal','UTF-8','-cpstream','UTF-8','-p','Compile.p','-T',$PWD.Path) 'compile-process.log'\n"
ps += "$compiled=Get-Content -LiteralPath compile.log -Raw; if($compiled -notmatch 'OpenEdge 12[.]2' -or $compiled -notmatch 'NUM-DBS=0' -or $compiled -notmatch 'PASS COMPILE ALL' -or $compiled -match 'FAIL '){throw 'Compilation unconfirmed'}\n"
ps += "foreach($cp in @('UTF-8','ISO8859-1')){foreach($culture in @('AMERICAN','EUROPEAN')){\n"
test_logs = []
for name, _, output in tests:
    ps += "Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-param',($culture+'," + name + "'),'-p','Regression.p','-T',$PWD.Path) ('process-" + name + "-'+$cp+'-'+$culture+'.log')\n"
    origin = "('" + output.replace('{culture}', "'+$culture+'") + "')"
    ps += "$proof=Get-Content -LiteralPath " + origin + " -Raw; if($proof -notmatch 'PASS' -or $proof -match 'FAIL'){throw 'Assertion proof failed: " + name + "'}\n"
    ps += "Copy-Item -LiteralPath " + origin + " -Destination ('" + name[:-2] + "-'+$cp+'-'+$culture+'.log')\n"
    test_logs += [name[:-2] + '-' + cp + '-' + culture + '.log' for cp in ['UTF-8','ISO8859-1'] for culture in ['AMERICAN','EUROPEAN']]
ps += "}}\nWrite-Output 'Official12.2 combined tests executed; inspect hashes/compiler/assertions'\n} catch {Write-Output $_.Exception.Message; if(Test-Path compile.log){Get-Content compile.log -Raw};exit 1}\n"
(PACKAGE / 'compile122.ps1').write_text(ps, encoding='utf-8')

downloads = ['compile.log','compile-process.log'] + [x[:-2] + '.r' for x in entries] + test_logs
uploads = [{'local': str(p.relative_to(ROOT)), 'remote': remote + '/' + p.relative_to(PACKAGE).as_posix()} for p in sorted(PACKAGE.rglob('*')) if p.is_file()]
plan = {'server':'compiler', 'directories':[remote] + [remote + '/' + p.relative_to(PACKAGE).as_posix() for p in sorted(PACKAGE.rglob('*')) if p.is_dir()],
        'uploads':uploads, 'commands':['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File ' + remote + '/compile122.ps1'],
        'downloads':[{'local':str((BUILD / 'compiled122' / x).relative_to(ROOT)), 'remote':remote + '/' + x, 'optional':True} for x in downloads]}
(BUILD / 'remote-plan.json').write_text(json.dumps(plan,indent=2)+'\n')
(BUILD / 'source-manifest.json').write_text(json.dumps([{'file':u['local'],'sha256':sha(ROOT/u['local'])} for u in uploads],indent=2)+'\n')
(BUILD / 'build-manifest.json').write_text(json.dumps({'state':'PREPARED_NOT_EXECUTED','packageManifests':manifest_hashes,'baselines':baselines,'compileEntries':entries,'tests':[{'name':n,'output':out} for n,_,out in tests],
 'productionDelta':production_candidates,'harnessPatches':harness_patches,'testLogs':len(test_logs),'databaseConnections':0,'remotePlanSha256':sha(BUILD/'remote-plan.json'),'publicationAllowed':False,'note':'Only root may execute official compiler and integrate/publish after review. Never publish fixtures, tests, wrappers or local12.8 artifacts.'},indent=2)+'\n')
print(json.dumps({'prepared':str(BUILD),'compileEntries':len(entries),'sourceFiles':len(uploads),'testLogs':len(test_logs),'remotePlanSha256':sha(BUILD/'remote-plan.json'),'executedRemote':False}))
