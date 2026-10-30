"""Manager review of immutable op1053 bytes and isolated local evidence; no network."""
from pathlib import Path
import difflib
import hashlib
import json
import xml.etree.ElementTree as ET

ROOT = Path('D:/opencode/conversao-sc')
PKG = ROOT / 'integration-src/ciw-completion-20261028/container-nf-available-readonly'
STATE = ROOT / '.runtime/ciw-completion-20261028/container-nf-available-readonly'
OUT = STATE / 'manager-review'
sha = lambda path: hashlib.sha256(Path(path).read_bytes()).hexdigest()
manifest = json.loads((PKG / 'manifest.json').read_text())
assert sha(PKG / 'manifest.json') == '60aa0eefd598d7bbb0d9e3da07deef060283367c164612f7bf09d3243a3851ff'
checked = 0
for item in manifest['sourceFiles']:
    for base in (PKG, PKG / 'frozen-v1'):
        assert sha(base / item['path']) == item['sha256'], item['path']
        checked += 1
for item in manifest['evidence']:
    assert sha(item['path']) == item['sha256'], item['path']
    checked += 1
for item in manifest['testInputs']:
    assert sha(STATE / 'frozen-v1' / item['path']) == item['sha256']
    checked += 1
plan = json.loads((PKG / 'patches/patch-plan.json').read_text())
for item in plan['textPatches']:
    before = Path(item['target']).read_bytes()
    assert hashlib.sha256(before).hexdigest() == item['baselineSha256']
    after = before
    for step in item['changes']:
        old, new = bytes.fromhex(step['oldBytesHex']), bytes.fromhex(step['newBytesHex'])
        assert after.count(old) == 1
        after = after.replace(old, new)
    assert hashlib.sha256(after).hexdigest() == item['candidateSha256']
    candidate = next(x for x in manifest['candidateSources'] if x['target'] == item['target'])
    assert Path(candidate['frozenCandidatePath']).read_bytes() == after
    reverse = after
    for step in reversed(item['changes']):
        old, new = bytes.fromhex(step['oldBytesHex']), bytes.fromhex(step['newBytesHex'])
        assert reverse.count(new) == 1
        reverse = reverse.replace(new, old)
    assert reverse == before
    a, b = before.splitlines(True), after.splitlines(True)
    ending = lambda line: line[len(line.rstrip(b'\r\n')):]
    for block in difflib.SequenceMatcher(a=[x.rstrip(b'\r\n') for x in a], b=[x.rstrip(b'\r\n') for x in b], autojunk=False).get_matching_blocks():
        for k in range(block.size):
            assert ending(a[block.a + k]) == ending(b[block.b + k])
    checked += 1
for item in manifest['newFiles']:
    assert sha(item['candidatePath']) == item['sha256']
    assert not Path(item['target']).exists(), 'New helper already present; inspect before proceeding'
    checked += 1
xml = ET.parse(OUT / 'focused.xml')
cases = xml.findall('.//testcase')
assert len(cases) == 33 and sum(int(c.get('assertions', '0')) for c in cases) == 221
assert not xml.findall('.//failure') and not xml.findall('.//error')
native = json.loads((OUT / 'native-result.json').read_text())
assert native['success'] and native['checks'] == 19 and native['network'] == 0 and native['writes'] == 0
logs = []
for cp in ('UTF-8', 'ISO8859-1'):
    for culture in ('AMERICAN', 'EUROPEAN'):
        path = OUT / 'abl' / f'test-{cp}-{culture}.log'
        text = path.read_text()
        assert 'PASS EXECUTE NUMDBS=0' in text and 'PASS 39 checks NUMDBS=0' in text
        assert f'PASS: 231 checks NUMERIC-FORMAT={culture}' in text
        logs.append({'path': str(path), 'sha256': sha(path)})
review = {
    'success': True, 'manifestSha256': sha(PKG / 'manifest.json'), 'filesChecked': checked,
    'findingsP1P2': [], 'bytePatchForwardAndReverse': True, 'unchangedLineEndingsPreserved': True,
    'phpIndependent': {'tests': 33, 'assertions': 221}, 'nativeIndependentChecks': 19,
    'ablIndependent12_8DiagnosticChecks': 1080, 'ablNumDbs': 0, 'ablLogs': logs,
    'reviewedSource': 'bl_selecao_nf exclusion DOCUMENT ONLY plus parent supplier/establishment/status3; query nature BEGINS3; MED partial scope explicit',
    'sharedMappers': 'NfRow/NfKey/AddField/AcceptRow unchanged; wrapper/service10handles unchanged',
    'minorDocumentationErratum': 'Frozen REVIEW.md says32/218; immutable manifest and independently executed focused suite prove33/221.',
    'gates': ['Official12.2 production wrapper/schema compilation and TT runs', 'Full composed PHP stage regression', 'Real PASOE read/get/filter/context checks', 'Native governed metadata publication', 'Functional access final; no inferred grant'],
    'limitations': ['MED readonly only; IMA and association/unassociation not converted', 'No legacy SQL/ODBC execution proof; explicit ambiguity refusal gate', 'Deterministic native ordering not claimed equivalent to unordered legacy query'],
    'canonicalChanged': False, 'networkExecuted': False, 'businessWrites': False, 'inventoryChanged': False,
}
(OUT / 'manager-review.json').write_text(json.dumps(review, indent=2) + '\n')
print(json.dumps({'success': True, 'filesChecked': checked, 'independentPhp': '33/221', 'independentNative': 19, 'independentAbl12_8': 1080, 'reviewSha256': sha(OUT / 'manager-review.json')}))
