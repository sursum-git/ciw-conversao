"""Pin immutable 1051 inputs and prepare independent combined PHP review."""
from pathlib import Path
import json,hashlib,shutil
R=Path('D:/opencode/conversao-sc');S=R/'.runtime/ciw-completion-20261028/item-cost-manual';P=S/'frozen-v1';I=S/'frozen-v1-test-inputs';O=S/'manager-reviewed';O.mkdir(exist_ok=True)
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest();load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
assert sha(P/'manifest.json')=='5cabfe5a1464ebbc242f0bd580daa0c4017fda40999e33a959e2e5f04d0c352d'
m=load(P/'manifest.json');freeze=load(S/'freeze-v1.json')
for f in m['files']:assert sha(P/f['path'])==f['sha256']
for f in freeze['testInputFiles']:assert sha(I/f['path'])==f['sha256']
exact=[]
for e in m['sharedBaselines']:
    assert sha(Path(e['target']))==e['baselineSha256']
    relative=Path(e['candidateRuntimePath']).relative_to(S)
    source=I/relative;assert sha(source)==e['candidateSha256']
    dest=O/'exact'/Path(e['target']).name;dest.parent.mkdir(exist_ok=True);shutil.copyfile(source,dest)
    exact.append({**e,'exactCandidate':str(dest)})
for folder in ['php','tests']:(O/folder).mkdir(exist_ok=True)
for p in (P/'php').glob('*.php'):shutil.copyfile(p,O/'php'/p.name)
test=(P/'tests/RuntimeItemCostManualReadTest.php').read_text();old=str(S/'local').replace('\\','/');new=str(I/'local').replace('\\','/');assert old in test
(O/'tests/RuntimeItemCostManualReadTest.php').write_text(test.replace(old,new),encoding='utf-8')
bootstrap="<?php\nrequire 'D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/official-build7/php-bootstrap.php';\n"
for n in ['RuntimeCiwErpQuery.php','RuntimeApiEntityActionService.php']:bootstrap+="require '"+str(O/'exact'/n).replace('\\','/')+"';\n"
bootstrap+="require '"+str(O/'php/RuntimeItemCostManualRead.php').replace('\\','/')+"';\n"
(O/'bootstrap.php').write_text(bootstrap,encoding='utf-8')
(O/'review-inputs.json').write_text(json.dumps({'success':True,'exactSharedCandidates':exact,'candidateFiles':len(m['files']),'testInputFiles':len(freeze['testInputFiles']),'productionChanged':False,'testOnlyPathRewrite':{'old':old,'new':new}},indent=2)+'\n')
print('PASS all frozen candidate/test hashes, current7 baselines and exact shared copies; independent bootstrap prepared')
