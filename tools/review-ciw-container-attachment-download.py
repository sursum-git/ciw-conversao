"""Read-only independent review of frozen attachment candidate bytes/hashes."""
import hashlib
import json
from pathlib import Path
import xml.etree.ElementTree as ET

ROOT = Path(__file__).resolve().parents[1]
DOMAIN = ROOT / 'integration-src/ciw-completion-20261028/container-attachments-download'
STATE = ROOT / '.runtime/ciw-completion-20261028/container-attachments-download'
sha = lambda data: hashlib.sha256(data).hexdigest()
manifest_path = DOMAIN / 'manifest.json'
manifest = json.loads(manifest_path.read_text(encoding='utf-8-sig'))
assert sha(manifest_path.read_bytes()) == 'e64108d15e24b1692c2d9ad31555cbeb4e960a6fd660a551cbe17e922d6522df'
for entry in manifest['files']:
    assert sha((DOMAIN / entry['path']).read_bytes()) == entry['sha256'], entry['path']
for entry in manifest['unchangedBrokerPolicyTransportAndFrontend']:
    assert sha(Path(entry['path']).read_bytes()) == entry['sha256'], entry['path']
plans = json.loads((DOMAIN / 'patches/patch-plan.json').read_text(encoding='utf-8-sig'))
reviews = []
for entry in plans['textPatches']:
    original = Path(entry['target']).read_bytes()
    assert sha(original) == entry['baselineSha256'], entry['target']
    current = original
    for change in entry['changes']:
        old, new = bytes.fromhex(change['oldBytesHex']), bytes.fromhex(change['newBytesHex'])
        assert current.count(old) == 1, entry['target']
        current = current.replace(old, new, 1)
    assert sha(current) == entry['candidateSha256'], entry['target']
    assert current == Path(entry['candidateRuntimePath']).read_bytes()
    for change in reversed(entry['changes']):
        old, new = bytes.fromhex(change['oldBytesHex']), bytes.fromhex(change['newBytesHex'])
        assert current.count(new) == 1, entry['target']
        current = current.replace(new, old, 1)
    assert current == original, entry['target']
    reviews.append({'target': entry['target'], 'baselineSha256': entry['baselineSha256'],
                    'candidateSha256': entry['candidateSha256'], 'byteReverseProven': True,
                    'anchors': len(entry['changes'])})
xml_path = STATE / 'manager-php.xml'
xml = ET.parse(xml_path).getroot()
suites = xml.findall('.//testsuite')
assert any(s.attrib.get('tests') == '78' and s.attrib.get('assertions') == '567' for s in suites)
assert not xml.findall('.//failure') and not xml.findall('.//error')
result = {'status': 'REVIEWED_CANDIDATE_NOT_PUBLISHED', 'p1': 0, 'p2': 0,
          'manifestSha256': sha(manifest_path.read_bytes()), 'frozenFilesChecked': len(manifest['files']),
          'sharedBytes': reviews, 'independentPhp': {'tests': 78, 'assertions': 567,
          'junit': str(xml_path), 'junitSha256': sha(xml_path.read_bytes())},
          'presentationLimitAcceptedForCandidate': 'Native readonly file control retains upload wording; historical download size/extension policy unchanged.',
          'gates': manifest['gates'], 'canonicalChanged': False, 'remoteExecuted': False,
          'businessExecuted': False, 'permissionsChanged': False}
out = STATE / 'manager-review.json'
out.write_text(json.dumps(result, ensure_ascii=False, indent=2) + '\n', encoding='utf-8')
print(json.dumps({'success': True, 'files': len(manifest['files']), 'sharedBytes': len(reviews),
                  'phpTests': 78, 'phpAssertions': 567, 'reviewSha256': sha(out.read_bytes())}))
