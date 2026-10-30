from pathlib import Path
import hashlib,json,shutil
root=Path(__file__).resolve().parents[1];w=root.parents[2]
state=w/'.runtime/ciw-completion-20261028/container-expense-default-selection'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
read=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
def log(p):
 raw=p.read_bytes();return raw.decode('utf-16'if raw.startswith(b'\xff\xfe')else'utf-8-sig')
preserved=[]
for version in ['v1','v1.1']:
 freeze=read(state/f'freeze-{version}.json');snapshot=Path(freeze['candidateSnapshot']);manifest=read(snapshot/'manifest.json')
 assert sha(snapshot/'manifest.json')==freeze['manifestSha256']
 for file in manifest['files']:assert sha(snapshot/file['path'])==file['sha256'],('immutable candidate changed',version,file['path'])
 for file in freeze['testInputFiles']:assert sha(Path(freeze['testInputsSnapshot'])/file['path'])==file['sha256'],('immutable test input changed',version,file['path'])
 preserved.append({'version':version,'manifestSha256':freeze['manifestSha256'],'candidateFilesVerified':len(manifest['files']),'testInputFilesVerified':len(freeze['testInputFiles'])})
old=read(state/'frozen-v1.1/manifest.json');reused=[]
for entry in read(root/'patches/core-plan.json')['textPatches']:
 relative=Path(entry['target']).relative_to(Path('D:/opencode/motor-progress/v2'))
 candidate=state/'local'/relative;frozen=state/'frozen-v1.1-test-inputs/local'/relative
 assert sha(candidate)==sha(frozen),'ABL implementation changed; rerun TT required'
 reused.append({'path':relative.as_posix(),'sha256':sha(candidate)})
for name in ['abl/ContainerExpenseDefaultsPlan.i','tests/SelectedExpenseDefaultsTests.i','tests/SelectionRootTests.i']:
 assert sha(root/name)==sha(state/'frozen-v1.1'/name),'ABL test/source changed; rerun TT required'
assert log(state/'rebase-v1.2-complete.log').startswith('PASS selection1047 integrated7 rebase')
assert 'OK (167 tests, 1313 assertions)'in log(state/'phpunit-final.log')
assert 'checks=19'in log(state/'process-native-final.log')
assert read(state/'schema-ajv-result.json')['checks']==18
assert read(state/'wiring-result.json')['checks']==114
baselines=[]
for name in ['core-plan.json','php-plan.json','native-lookup-parameters/patch-plan.json']:
 for entry in read(root/'patches'/name)['textPatches']:
  target=Path(entry['target']);assert sha(target)==entry['baselineSha256']
  if 'motor-progress'in target.parts:stage=state/'local'/target.relative_to(Path('D:/opencode/motor-progress/v2'))
  elif name.startswith('native'):stage=state/'native'/target.relative_to(Path('D:/opencode/construtor-pg'))
  else:stage=state/'php'/target.name
  baselines.append({'target':target.as_posix(),'baselineSha256':sha(target),'patchPlan':(root/'patches'/name).relative_to(root).as_posix(),'candidateRuntimePath':stage.as_posix(),'candidateSha256':sha(stage)})
for entry in read(root/'patches/native-lookup-parameters/schema-patch-plan.json')['jsonPatches']:
 target=Path(entry['target']);assert sha(target)==entry['baselineSha256'];stage=state/'native/public/metadata/schemas'/target.name
 assert sha(stage)==entry['candidateSha256'];baselines.append({'target':target.as_posix(),'baselineSha256':sha(target),'patchPlan':'patches/native-lookup-parameters/schema-patch-plan.json','candidateRuntimePath':stage.as_posix(),'candidateSha256':sha(stage)})
logs=['phpunit-final.log','builder-final.log','wiring-final.log','schema-ajv-final.log','process-native-final.log','api-process-context-smoke.mjs.log','container-process-logs-smoke.mjs.log','process-session-flag-smoke.mjs.log','rebase-v1.2-complete.log']
verification={'success':True,'businessExecuted':False,'canonicalFilesChanged':False,'official122Compiled':False,'ablReexecuted':False,'ablReuse':{'verificationPath':(state/'verification-v1.1.json').as_posix(),'verificationSha256':sha(state/'verification-v1.1.json'),'checksPerCombination':237,'combinations':4,'numDbs':0,'reason':'all four shared ABL candidates and fixture/include source byte-identical to frozen-v1.1','candidates':reused},'phpTests':167,'phpAssertions':1313,'nativeSelectionChecks':19,'jsonSchemaAjvChecks':18,'wiringChecks':114,'legacyFrontendSuites':3,'oldFreezesVerified':preserved,'logs':[{'path':(state/name).as_posix(),'sha256':sha(state/name)}for name in logs]}
(state/'verification-v1.2.json').write_text(json.dumps(verification,indent=2)+'\n',encoding='utf-8')
manifest=dict(old);manifest.update({'version':'1.2','status':'candidate-ready-rebased7-review','testCommand':'powershell -NoProfile -ExecutionPolicy Bypass -File integration-src/ciw-completion-20261028/container-expense-default-selection/tests/verify-rebase-v1.2.ps1','verificationPath':(state/'verification-v1.2.json').as_posix(),'verificationSha256':sha(state/'verification-v1.2.json'),'localEvidence':verification,'sharedBaselines':baselines,
 'incrementalRebase':{'predecessorManifestSha256':preserved[1]['manifestSha256'],'changedProductSource':'RuntimeApiEntityActionService.php hunks only rebased onto integrated7, without changing1047 policy','metadata':'published process source6 and parent1003/1.0.3','priorFreezePreserved':True},
 'metadataStatus':{'preparedOnly':True,'sourcePreview':'actual published6 plus two fixed additive operations; six originals preserved exactly; auth omitted and must remain unchanged','parentPreview':'actual published1.0.3 builderConfig with only additive Gerar despesas link; memory/tax links preserved','publicationBlockedUntilRootLiveHashCompare':True,'sourceAddition':'metadata/source-addition.json','parentPatch':'metadata/parent-navigation.json'},
 'gates':['root review no P1/P2','live source/parent compare against exported baseline hashes before append publication','official OE12.2/.42 compile and TT four combinations','native opt-in example/parity matrix candidate to be reviewed separately before extension integration','root integrates only hash-guarded patches; never copy mutable stage over shared sources','root publication/real native validation only in sursum-api/med; business tests require separate concrete authorization'],
 'files':[{'path':p.relative_to(root).as_posix(),'sha256':sha(p)}for p in sorted(root.rglob('*'))if p.is_file()and p.name!='manifest.json'and'__pycache__'not in p.parts]})
(root/'manifest.json').write_text(json.dumps(manifest,indent=2)+'\n',encoding='utf-8')
snapshot=state/'frozen-v1.2';assert not snapshot.exists(),'immutable snapshot exists';shutil.copytree(root,snapshot,ignore=shutil.ignore_patterns('__pycache__'))
inputs=state/'frozen-v1.2-test-inputs';assert not inputs.exists();inputs.mkdir()
for name in ['local','php','native','regressions']:shutil.copytree(state/name,inputs/name)
(state/'freeze-v1.2.json').write_text(json.dumps({'manifestSha256':sha(root/'manifest.json'),'candidateSnapshot':snapshot.as_posix(),'testInputsSnapshot':inputs.as_posix(),'testInputFiles':[{'path':p.relative_to(inputs).as_posix(),'sha256':sha(p)}for p in sorted(inputs.rglob('*'))if p.is_file()],'verificationSha256':sha(state/'verification-v1.2.json'),'oldFreezesVerified':preserved},indent=2)+'\n',encoding='utf-8')
print('PASS selection1047 rebase frozen-v1.2; manifest SHA256 '+sha(root/'manifest.json'))
