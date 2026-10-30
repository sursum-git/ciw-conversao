from pathlib import Path
import hashlib,json,re,shutil
root=Path(__file__).resolve().parents[1];w=root.parents[2]
state=w/'.runtime/ciw-completion-20261028/container-expense-default-selection'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
read=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
def log(p):
 raw=p.read_bytes();return raw.decode('utf-16'if raw.startswith(b'\xff\xfe')else'utf-8-sig')
assert log(state/'suite-complete.log').startswith('PASS selection1047 candidate')
assert'OK (167 tests, 1313 assertions)'in log(state/'phpunit-final.log')
assert'CRUD with dependent options was accepted'in log(state/'guard-red-v1.1.log')
assert'OK (5 tests, 17 assertions)'in log(state/'guard-green-v1.1.log')
assert read(state/'wiring-result.json')['success']is True and read(state/'schema-ajv-result.json')['checks']==18
for cp in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:
  text=(state/'local'/f'test-{cp}-{culture}.log').read_text()
  assert'PASS EXECUTE NUM-DBS=0'in text and'PASS: 222 checks'in text
assert log(state/'abl-final.log').count('PASS 15 checks; actual fiscal TT only.')==4
assert'checks=19'in log(state/'process-native-final.log')
for name in ['api-process-context-smoke.mjs','container-process-logs-smoke.mjs','process-session-flag-smoke.mjs']:assert log(state/(name+'.log')).startswith('PASS')
baselines=[]
for name in ['core-plan.json','php-plan.json','native-lookup-parameters/patch-plan.json']:
 for entry in read(root/'patches'/name)['textPatches']:
  target=Path(entry['target']);assert sha(target)==entry['baselineSha256'],'canonical moved '+str(target)
  if 'motor-progress'in target.parts:stage=state/'local'/target.relative_to(Path('D:/opencode/motor-progress/v2'))
  elif name.startswith('native'):stage=state/'native'/target.relative_to(Path('D:/opencode/construtor-pg'))
  else:stage=state/'php'/target.name
  baselines.append({'target':target.as_posix(),'baselineSha256':entry['baselineSha256'],'patchPlan':(root/'patches'/name).relative_to(root).as_posix(),'candidateRuntimePath':stage.as_posix(),'candidateSha256':sha(stage)})
for entry in read(root/'patches/native-lookup-parameters/schema-patch-plan.json')['jsonPatches']:
 target=Path(entry['target']);assert sha(target)==entry['baselineSha256'];baselines.append({'target':target.as_posix(),'baselineSha256':entry['baselineSha256'],'patchPlan':'patches/native-lookup-parameters/schema-patch-plan.json','candidateRuntimePath':(state/'native/public/metadata/schemas'/target.name).as_posix(),'candidateSha256':entry['candidateSha256']})
source_specs=[('sources/scriptcase/containers/grid_despesas_container/grid_despesas_container_grid.class.php',[[5477,5484]],'active caller'),('sources/scriptcase/containers/cons_selec_despesas/index.php',[[7359,7416]],'NM_index_reg direct selected order and onFinish sequence'),('sources/scriptcase/containers/cons_selec_despesas/cons_selec_despesas_grid.class.php',[[838,913],[5549,5565],[10705,10800],[11192,11240]],'query/order, checked DOM order, ALLdefaults/mark-used and sync'),('docs/containers-despesas-crud-inventario.md',[],'legacy inventory')]
evidence=[]
for name,ranges,role in source_specs:
 p=w/name;assert p.is_file();evidence.append({'path':p.as_posix(),'sha256':sha(p),'lineRanges':ranges,'role':role})
(root/'source-evidence.json').write_text(json.dumps(evidence,indent=2)+'\n',encoding='utf-8')
logs=['abl-final.log','phpunit-final.log','builder-final.log','wiring-final.log','schema-ajv-final.log','process-native-final.log','api-process-context-smoke.mjs.log','container-process-logs-smoke.mjs.log','process-session-flag-smoke.mjs.log','suite-complete.log','guard-red-v1.1.log','guard-green-v1.1.log']
verification={'success':True,'businessExecuted':False,'canonicalFilesChanged':False,'official122Compiled':False,'numDbs':0,'ablCoreChecks':222,'ablRootChecks':15,'combinations':4,'codepages':['UTF-8','ISO8859-1'],'cultures':['AMERICAN','EUROPEAN'],'phpTests':167,'phpAssertions':1313,'nativeSelectionChecks':19,'jsonSchemaAjvChecks':18,'wiringChecks':read(state/'wiring-result.json')['checks'],'logs':[{'path':(state/name).as_posix(),'sha256':sha(state/name)}for name in logs]}
(state/'verification-v1.1.json').write_text(json.dumps(verification,indent=2)+'\n',encoding='utf-8')
manifest={'package':'container-expense-default-selection','version':'1.1','program':'op1047','entity':'container_despesas_selecao_progress','status':'candidate-ready-code-review-metadata-rebase-gated','rootAuthorizedScope':'candidate preparation only; no business/grants/DDL/publication','businessExecuted':False,'canonicalFilesChanged':False,
 'testCommand':'powershell -NoProfile -ExecutionPolicy Bypass -File integration-src/ciw-completion-20261028/container-expense-default-selection/tests/verify-all.ps1','verificationPath':(state/'verification-v1.1.json').as_posix(),'verificationSha256':sha(state/'verification-v1.1.json'),
 'incrementalReviewFix':{'predecessorManifestSha256':'8a730403d05653fc692d7a593f01665534e23e34eff93046ae516b5de8dedea2','finding':'dependent lookup accepted on CRUD although transport supports process only','delta':'Builder process-only guard in normalization and publication before persistence/archive; intermediate generateCrudDefinition allowed','priorFreezePreserved':True},
 'localEvidence':verification,'sharedBaselines':baselines,'newSources':['abl/ContainerExpenseDefaultsPlan.i','php/RuntimeContainerExpenseDefaultsAudit.php'],
 'metadataStatus':{'preparedOnly':True,'sourcePreview':'frozen1043 six operations plus two additive operations; must rebase to live sanitized post6 source before publication','parentPreview':'real op1003/1.0.2 historical snapshot; must rebase to live post1042/post1043 parent preserving all links; never apply historical builderConfig','publicationBlockedUntilRootRebase':True},
 'limits':{'readerRows':50000,'readerMilliseconds':10000,'options':200,'selectionMinimum':1,'selectionMaximum':100,'unknownActiveOrTaxExcluded':True,'publicEmptySelectionRejected':True,'emptyCalculatedSubsetFallback':'all nonmanual','UIOrderFields':['ordem','despesa_id','log_calculada','perc_calculo'],'directions':['asc','desc'],'defaultOrder':['ordem','asc'],'textOrder':'not offered in UI; direct request rejected422 pending SQL collation proof','orderedNull':'relevant NULL rejects422 pending SQL ordering proof','tieOrder':'ascending ID for numeric ties is explicit new deterministic extension, not literal legacy parity'},
 'gates':['root review no P1/P2','live source/parent metadata rebase by exact hash','official OE12.2/.42 compile and TT four combinations','root integrates only hash-guarded patches; never copy mutable stage over shared sources','root publication/real native validation only in sursum-api/med; business tests require separate concrete authorization'],
 'freezesPreserved':['container-fiscal-readonly v2','container-expense-batch v1','container-tax-only v1','container-expense-batch-preflight v1.1','replay-actual-config v1/v1.1'],
 'files':[{'path':p.relative_to(root).as_posix(),'sha256':sha(p)}for p in sorted(root.rglob('*'))if p.is_file()and p.name!='manifest.json'and'__pycache__'not in p.parts]}
(root/'manifest.json').write_text(json.dumps(manifest,indent=2)+'\n',encoding='utf-8')
snapshot=state/'frozen-v1.1';assert not snapshot.exists(),'immutable snapshot exists'
shutil.copytree(root,snapshot,ignore=shutil.ignore_patterns('__pycache__'))
stage_snapshot=state/'frozen-v1.1-test-inputs';assert not stage_snapshot.exists();stage_snapshot.mkdir()
for name in ['local','php','native','regressions']:shutil.copytree(state/name,stage_snapshot/name)
staged=[{'path':p.relative_to(stage_snapshot).as_posix(),'sha256':sha(p)}for p in sorted(stage_snapshot.rglob('*'))if p.is_file()]
(state/'freeze-v1.1.json').write_text(json.dumps({'manifestSha256':sha(root/'manifest.json'),'candidateSnapshot':snapshot.as_posix(),'testInputsSnapshot':stage_snapshot.as_posix(),'testInputFiles':staged,'verificationSha256':sha(state/'verification-v1.1.json')},indent=2)+'\n',encoding='utf-8')
print('PASS code candidate frozen; live metadata rebase gate retained; manifest SHA256 '+sha(root/'manifest.json'))
