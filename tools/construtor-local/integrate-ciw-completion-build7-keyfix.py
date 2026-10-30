"""Apply one reviewed PHP key-set correction, preserving original build7 receipt."""
from pathlib import Path
import hashlib,json,shutil
root=Path(__file__).resolve().parents[2];state=root/'.runtime/ciw-completion-20261028/official-build7'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
release=state/'manager-keyfix-release.json'
assert sha(release)=='57cec68c21de0abfcde62c126cc2bfcbc3150fa1d0ceec5a5095d0ff57e4cb57'
review=load(release);assert review['success']and review['findingsP1']==review['findingsP2']==0
package=root/'integration-src/ciw-completion-20261028/cost-distribution-readonly/ledger-item/key-order-fix/frozen-v1'
assert sha(package/'manifest.json')==review['manifestSha256']
for entry in load(package/'manifest.json')['files']:assert sha(package/entry['path'])==entry['sha256']
target=Path(review['target']);candidate=root/review['candidate']
assert sha(target)==review['baselineSha256'];assert sha(candidate)==review['candidateSha256']
assert 'tests="917" assertions="6018" errors="0" failures="0" skipped="0"'in(state/'manager-keyfix-full.xml').read_text()
receipt=state/'canonical-keyfix-manifest.json';assert not receipt.exists()
backup=state/'canonical-keyfix-backup.php';assert not backup.exists();shutil.copy2(target,backup)
shutil.copyfile(candidate,target);assert sha(target)==review['candidateSha256']
receipt.write_text(json.dumps(dict(success=True,target=str(target),before=review['baselineSha256'],sha256=review['candidateSha256'],backup=str(backup),phpTests=917,phpAssertions=6018,ablChanged=False,originalBuild7ReceiptPreserved=True,businessWrites=False,humanPermissionsChanged=False),indent=2)+'\n')
print('PASS singlePHP key-set fix integrated/hash/backup;917tests6018assertions;no ABL or business change')
