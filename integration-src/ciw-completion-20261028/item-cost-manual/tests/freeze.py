from pathlib import Path
import hashlib,json,shutil

root=Path(__file__).resolve().parents[1];w=root.parents[2]
state=w/'.runtime/ciw-completion-20261028/item-cost-manual'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
read=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
def log(p):
 raw=p.read_bytes();return raw.decode('utf-16'if raw.startswith(b'\xff\xfe')else'utf-8-sig')
assert log(state/'suite-complete.log').startswith('PASS op1051 readonly candidate')
assert 'OK (31 tests, 147 assertions)'in log(state/'phpunit-final.log')
assert log(state/'abl-final.log').count('PASS 24 checks NUMDBS=0')==4
assert log(state/'abl-final.log').count('PASS 47 checks ')==4
assert log(state/'abl-final.log').count('PASS 9 checks ')==4
for cp in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:
  assert 'PASS EXECUTE NUMDBS=0'in log(state/'local'/f'test-{cp}-{culture}.log')
assert read(state/'wiring-result.json')['checks']==31
assert read(state/'native-validation.json')['checks']==32
assert read(state/'browser-result.json')=={'success':True,'checks':13,'readonly':True,'writes':0}
official=w/'.runtime/ciw-completion-20261028/official-build7/canonical-manifest.json'
integrated={Path(e['target']).as_posix():e['sha256']for e in read(official)['files']}
baselines=[]
for entry in read(root/'patches/patch-plan.json')['textPatches']:
 target=Path(entry['target']);assert sha(target)==entry['baselineSha256']==integrated[target.as_posix()]
 text=target.read_text(encoding='utf-8-sig')
 for change in entry['changes']:
  assert text.count(change['old'])==1;text=text.replace(change['old'],change['new'])
 candidate=Path(entry['candidateRuntimePath']);assert candidate.read_text(encoding='utf-8-sig')==text
 baselines.append({'target':target.as_posix(),'baselineSha256':sha(target),'candidateRuntimePath':candidate.as_posix(),'candidateSha256':sha(candidate),'patchPlan':'patches/patch-plan.json'})
evidence=[]
sources=w/'sources/scriptcase/ciw-completion-next20b-20261028'
for app in ['cons_item_custos','form_item_custos_manual','form_item_custos','bl_seleciona_form_item_custos']:
 for p in sorted((sources/app).glob('*.php')):
  evidence.append({'path':p.as_posix(),'sha256':sha(p),'role':'sanitized active source; event/SQL ranges described in AUDIT.md'})
schema_root=w/'integration-src/container-panel/schema'
for name in ['espec/schema-item_custos.json','ems2ima/schema-saldo-estoq.json','ems2med/schema-saldo-estoq.json','espec/schema-locais_estoq_portal.json']:
 p=schema_root/name;evidence.append({'path':p.as_posix(),'sha256':sha(p),'role':'local physical dictionary; no new schema inferred'})
motor=Path('D:/opencode/motor-progress/v2')
for name in ['ContainersItemCustoInputsService.p','ContainersItemCustoCalculator.p','ContainersItemCustoCloseService.p','ContainersVersionRuntime.p']:
 p=motor/'sursum-api/programs'/name
 if not p.exists():
  found=list(motor.rglob(name));assert len(found)==1,(name,found);p=found[0]
 evidence.append({'path':p.as_posix(),'sha256':sha(p),'role':'existing central implementation audited; unchanged'})
(root/'source-evidence.json').write_text(json.dumps(evidence,indent=2)+'\n',encoding='utf-8')
logs=['abl-final.log','phpunit-final.log','builder-final.log','verify-wiring.py.log','native-final.log','browser-final.log','suite-complete.log']
verification={'success':True,'businessExecuted':False,'canonicalFilesChanged':False,'official122Compiled':False,'numDbs':0,'ablChecksPerCombination':80,'ablNewChecks':24,'ablExistingReaderChecks':47,'ablExistingPurchaseChecks':9,'combinations':4,'codepages':['UTF-8','ISO8859-1'],'cultures':['AMERICAN','EUROPEAN'],'phpTests':31,'phpAssertions':147,'nativeSchemaChecks':32,'nativeBrowserChecks':13,'wiringChecks':31,'logs':[{'path':(state/name).as_posix(),'sha256':sha(state/name)}for name in logs]}
(state/'verification-v1.json').write_text(json.dumps(verification,indent=2)+'\n',encoding='utf-8')
manifest={'package':'item-cost-manual','version':'1','program':'op1051','entity':'item_custos_manual_progress','screen':'ciw.item-custos-manuais','status':'candidate-ready-readonly-partial-origin','originStatus':'form_item_custos_manual and form_item_custos remain Partial; query gives access to global type1 subset of cons_item_custos','writerEnabled':False,'businessExecuted':False,'canonicalFilesChanged':False,
 'testCommand':'powershell -NoProfile -ExecutionPolicy Bypass -File integration-src/ciw-completion-20261028/item-cost-manual/tests/verify-all.ps1','verificationPath':(state/'verification-v1.json').as_posix(),'verificationSha256':sha(state/'verification-v1.json'),'localEvidence':verification,
 'sharedBaselines':baselines,'officialPredecessor':{'path':official.as_posix(),'sha256':sha(official),'wave':7,'allFourBaselinesMatchIntegratedManifest':True,'oldResourcesPreservedByExactAdditiveHunks':True},
 'newSources':[{'source':'php/RuntimeItemCostManualRead.php','target':'D:/opencode/construtor-pg/backend/src/Runtime/RuntimeItemCostManualRead.php'},{'source':'php/RuntimeItemCostManualSchema.php','target':'D:/opencode/construtor-pg/backend/src/Runtime/RuntimeItemCostManualSchema.php'}],
 'metadataStatus':{'preparedOnly':True,'sourcePreview':'132 existing operations preserved plus read/get; compose alongside other pending additions against live snapshot, never replace auth','parentLink':'none; global query has no invented container context','sourceAddition':'metadata/source-addition.json'},
 'limits':{'rows':50000,'milliseconds':10000,'pageSizeMaximum':200,'physicalFields':23,'syntheticIdentity':'record_key','fixedType':1,'scope':'global/shared; physical table has no company/container owner','datetimeFilter':'not offered; datetime values serialized as ISO and preserved','defaultSort':'item_custo_id desc is a new UI choice, not literal session parity'},
 'gates':['root review no P1/P2','live source append composition and permission/native navigation decisions','official OpenEdge12.2/.42 compile and TT four combinations; local12.8 is diagnostic only','root hash-guarded integration/publication and real readonly validation in sursum-api/med','write rules remain undecided: effective stock/selection defaults, central sequence adoption, scalar-array legacy delete divergence, generic/manual permissions and attachments'],
 'forbiddenActionsExecuted':[],'freezesPreserved':['fiscal readonly v2','batch1042 v1','tax-only1043 v1','selection1047 v1/v1.1'],
 'files':[{'path':p.relative_to(root).as_posix(),'sha256':sha(p)}for p in sorted(root.rglob('*'))if p.is_file()and p.name!='manifest.json'and'__pycache__'not in p.parts]}
(root/'manifest.json').write_text(json.dumps(manifest,indent=2)+'\n',encoding='utf-8')
snapshot=state/'frozen-v1';assert not snapshot.exists(),'immutable snapshot exists'
shutil.copytree(root,snapshot,ignore=shutil.ignore_patterns('__pycache__'))
inputs=state/'frozen-v1-test-inputs';assert not inputs.exists();inputs.mkdir()
for name in ['local','red']:shutil.copytree(state/name,inputs/name)
for name in ['native-preview.json','native-validation.json','browser-result.json','wiring-result.json']:shutil.copy2(state/name,inputs/name)
(state/'freeze-v1.json').write_text(json.dumps({'manifestSha256':sha(root/'manifest.json'),'candidateSnapshot':snapshot.as_posix(),'testInputsSnapshot':inputs.as_posix(),'testInputFiles':[{'path':p.relative_to(inputs).as_posix(),'sha256':sha(p)}for p in sorted(inputs.rglob('*'))if p.is_file()],'verificationSha256':sha(state/'verification-v1.json')},indent=2)+'\n',encoding='utf-8')
print('PASS op1051 readonly candidate frozen on integrated7; manifest SHA256 '+sha(root/'manifest.json'))
