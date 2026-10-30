from pathlib import Path
import hashlib,json,re
root=Path(__file__).resolve().parents[1];w=root.parents[2];state=w/'.runtime/ciw-completion-20261028/native-process-options-normalization-companion';read=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest();checks=0
def check(v,label):
 global checks
 checks+=1;assert v,label
plan=read(root/'patches/patch-plan.json');origin=Path(plan['baselineOrigin']);before=(state/'baseline-ProgramBuilderService.php').read_bytes();check(sha(origin)==plan['baselineSha256']==hashlib.sha256(before).hexdigest(),'baseline8 changed');after=before
for c in plan['changes']:
 a=bytes.fromhex(c['oldBytesHex']);b=bytes.fromhex(c['newBytesHex']);check(after.count(a)==1,'unique byte anchor');after=after.replace(a,b)
candidate=Path(plan['candidateRuntimePath']);check(after==candidate.read_bytes()and sha(candidate)==plan['candidateSha256'],'candidate byte result');restored=after
for c in reversed(plan['changes']):
 a=bytes.fromhex(c['oldBytesHex']);b=bytes.fromhex(c['newBytesHex']);check(restored.count(b)==1,'unique reverse anchor');restored=restored.replace(b,a)
check(restored==before,'untouched bytes changed')
def method(text,name):return re.search(rb'^    private function '+name.encode()+rb'\(.*?^    \}',text,re.M|re.S).group()
check(method(before,'normalizeOptionItems')==method(after,'normalizeOptionItems'),'global legacy normalizer changed')
check(method(before,'assertApiOptionsPageType')==method(after,'assertApiOptionsPageType'),'process-only guard changed')
check(after.count(b'private function normalizeApiOptionsParameterItems(')==1,'helper duplicated')
check(after.count(b'$this->normalizeApiOptionsParameterItems(')==2,'normalizer and validator not using same helper')
check(b"if ($entityType === 'api')"in after and b"array_key_exists('parameterFields', $lookup)"in after,'opt-in reference gate lost')
check(b"isset($dependentOptionParameters[$fieldCode]) && $dataType === 'string' && ($options['editor'] ?? null) === 'dropdown'"in after,'scope widened beyond referenced string dropdown')
preserved=[]
for name,version in [('container-expense-default-selection','v1.2'),('native-process-dependent-options-example','v1'),('container-attachments-download','v1'),('item-cost-manual','v1')]:
 private=w/'.runtime/ciw-completion-20261028'/name;freeze=read(private/f'freeze-{version}.json');snapshot=Path(freeze['candidateSnapshot']);check(sha(snapshot/'manifest.json')==freeze['manifestSha256'],'freeze manifest changed '+name)
 for e in read(snapshot/'manifest.json')['files']:assert sha(snapshot/e['path'])==e['sha256'],('frozen file changed',name,e['path'])
 preserved.append({'package':name,'version':version,'manifestSha256':freeze['manifestSha256'],'verified':True})
result={'success':True,'checks':checks,'builder8BaselineSha256':plan['baselineSha256'],'candidateSha256':sha(candidate),'canonicalChanged':False,'stage8Changed':False,'legacyNormalizerByteIdentical':True,'processOnlyGuardByteIdentical':True,'sameHelperBoundary':True,'bytesOutsideAnchorsPreserved':True,'oldFreezesVerified':preserved};(state/'wiring-proof.json').write_text(json.dumps(result,indent=2)+'\n',encoding='utf-8');print('PASS companion bytes/exact scope/global normalizer/guard/freezes checks='+str(checks))
