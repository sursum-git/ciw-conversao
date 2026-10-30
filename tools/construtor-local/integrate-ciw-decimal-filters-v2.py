"""Integrate one reviewed byte patch and prepare tests against the actual canonical."""
from pathlib import Path
import hashlib,json,os,shutil,sys
root=Path(__file__).resolve().parents[2]
package=root/'integration-src/ciw-completion-20261028/builder-decimal-filters-v2'
state=root/'.runtime/ciw-completion-20261028/builder-decimal-filters-v2'
out=state/'canonical-integration'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
release=load(package/'release.json')
assert sha(package/'release.json')=='418666e214de1c56359f185da1c17928fcb1be61965f75a8e0532e73909b9dd0'
for x in release['files']:assert sha(package/x['path'])==x['sha256']
review=state/'manager-review/review.json'
assert sha(review)=='12486cd5ab0b0babf545ec01dbd373f435fc00ee275da66c15f0e95eb85dab4b'
assert load(review)['success'] and load(review)['findingsP2']==0
patch=load(package/'byte-patch.json');target=Path(patch['target'])
assert target==Path('D:/opencode/construtor-pg/backend/src/Builder/ProgramBuilderService.php')
assert not target.is_symlink() and sha(target)==patch['before']
before=target.read_bytes();candidate=before
for change in patch['changes']:
    old=bytes.fromhex(change['oldBytesHex']);new=bytes.fromhex(change['newBytesHex'])
    assert candidate.count(old)==1
    candidate=candidate.replace(old,new,1)
assert candidate==(package/'ProgramBuilderService.php').read_bytes()
reverse=candidate
for change in reversed(patch['changes']):
    reverse=reverse.replace(bytes.fromhex(change['newBytesHex']),bytes.fromhex(change['oldBytesHex']),1)
assert reverse==before and hashlib.sha256(candidate).hexdigest()==patch['after']
assert sys.argv[1:]==['--apply-reviewed-one-file']
out.mkdir()
(out/'ProgramBuilderService-before.php').write_bytes(before)
receipt=dict(state='STARTED',target=str(target),before=patch['before'],after=patch['after'],reviewSha256=sha(review),releaseSha256=sha(package/'release.json'),metadataRegenerated=False,kendoChanged=False)
(out/'attempt.json').write_text(json.dumps(receipt,indent=2)+'\n')
temp=target.with_name(target.name+'.ciw-decimal-v2-tmp')
assert not temp.exists()
with temp.open('xb')as f:f.write(candidate);f.flush();os.fsync(f.fileno())
assert sha(temp)==patch['after'] and sha(target)==patch['before']
os.replace(temp,target)
assert sha(target)==patch['after']
receipt.update(state='COMPLETED',success=True)
(out/'canonical-manifest.json').write_text(json.dumps(receipt,indent=2)+'\n')
(out/'attempt.json').write_text(json.dumps(receipt,indent=2)+'\n')
test=(package/'DecimalFilterGenerationTest.php').read_text()
old='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/builder-decimal-filters-v2/'
assert test.count(old)==1
(out/'DecimalFilterGenerationTest.php').write_text(test.replace(old,out.as_posix()+'/'))
bootstrap="<?php\nrequire 'D:/opencode/construtor-pg/backend/vendor/autoload.php';\nrequire 'D:/opencode/construtor-pg/backend/src/Builder/ProgramBuilderService.php';\nif (hash_file('sha256',(new ReflectionClass(App\\Builder\\ProgramBuilderService::class))->getFileName()) !== '"+patch['after']+"') throw new RuntimeException('Canonical Builder205e required');\n"
(out/'bootstrap.php').write_text(bootstrap)
for mode in ['default','explicit']:
    shutil.copy2(state/('baseline-'+mode+'.json'),out/('baseline-'+mode+'.json'))
native=(package/'verify-native.cjs').read_text()
assert native.count("state='"+state.as_posix()+"'")==1
native=native.replace("state='"+state.as_posix()+"'","state='"+out.as_posix()+"'")
native=native.replace('canonicalChanged:false,published:false','canonicalChanged:true,published:true')
(out/'verify-native.cjs').write_text(native)
print('PASS one reviewed Builder byte patch integrated; actual-canonical tests prepared; no metadata regenerated')
