from pathlib import Path
import hashlib,json,datetime

root=Path(__file__).resolve().parents[1]
workspace=root.parents[2]
state=workspace/'.runtime/ciw-completion-20261028/container-expense-batch'
def sha(p): return hashlib.sha256(p.read_bytes()).hexdigest()
def relative(p): return p.relative_to(workspace).as_posix()
plans=[root/'patches/seam-plan.json',root/'patches/bridge/patch-plan.json',root/'patches/native-batch-context/patch-plan.json',root/'patches/bridge/route-addition.json',root/'patches/bridge/parent-navigation.json']
baselines=[]
for plan in plans:
    data=json.loads(plan.read_text(encoding='utf-8'))
    for entry in data.get('textPatches',[data]):
        target=Path(entry['target'])
        assert sha(target)==entry['baselineSha256'],f'Baseline changed: {target}'
        baselines.append({'plan':plan.relative_to(root).as_posix(),'target':target.as_posix(),'baselineSha256':sha(target)})
logs=['public-wiring-final.log','abl-final.log','runtime-boundary-final.log','builder-final.log','native-batch-final.log','kendo-final.log','legacy-batch-final.log','phpunit-existing-batch-final.log']
evidence=[]
for name in logs:
    p=state/name
    content=p.read_text(encoding='utf-16' if p.read_bytes().startswith(b'\xff\xfe') else 'utf-8-sig')
    assert 'PASS' in content or 'OK (28 tests, 478 assertions)' in content,name
    evidence.append({'path':relative(p),'sha256':sha(p)})
compilelog=state/'local/compile.log'
assert 'PASS COMPILE ALL' in compilelog.read_text()
evidence.append({'path':relative(compilelog),'sha256':sha(compilelog)})
inputs=[workspace/'sources/scriptcase/containers/form_despesas_container_multi_reg/form_despesas_container_multi_reg_apl.php',workspace/'docs/containers-despesas-crud-inventario.md',workspace/'.runtime/ciw-completion-20261028/schema/schema-despesas_container.json']
files=[{'path':p.relative_to(root).as_posix(),'sha256':sha(p),'bytes':p.stat().st_size} for p in sorted(root.rglob('*')) if p.is_file() and p.name!='manifest.json' and '__pycache__' not in p.parts]
manifest={'package':'container-expense-batch','version':1,'status':'candidate-ready-local','program':'op1042','entity':'container_despesas_lote_progress','createdAt':datetime.datetime.now(datetime.timezone.utc).isoformat(),'sourceCode':'motor_progress_container_despesas_lote','sourceOperations':3,'officialCompile':False,'integrated':False,'published':False,'businessExecuted':False,'sharedApplied':False,'files':files,'baselines':baselines,'auditedInputs':[{'path':relative(p),'sha256':sha(p)}for p in inputs],'evidence':evidence,'command':'powershell -NoProfile -ExecutionPolicy Bypass -File integration-src/ciw-completion-20261028/container-expense-batch/tests/verify-all.ps1','results':{'localOpenEdge':'12.8 NUM-DBS=0','localCompileEntries':7,'ablChecksPerCombination':271,'combinations':['UTF-8/AMERICAN','UTF-8/EUROPEAN','ISO8859-1/AMERICAN','ISO8859-1/EUROPEAN'],'realRuntimeBoundaryChecks':42,'publicWiringParentChecks':12,'nativeJsChecks':16,'realKendoChecks':8,'existingKendoBatch':'PASS','existingPhpUnitTests':28,'existingPhpUnitAssertions':478},'destinations':{'abl/ContainerExpenseBatchSnapshot.i':'D:/opencode/motor-progress/v2/sursum-api/includes/ContainerExpenseBatchSnapshot.i','abl/ContainersDespesasBatchService.p':'D:/opencode/motor-progress/v2/sursum-api/programs/ContainersDespesasBatchService.p','abl/ContainersDespesasBatchApi.p':'D:/opencode/motor-progress/v2/sursum-api/programs/ContainersDespesasBatchApi.p','php/RuntimeContainerExpenseBatch.php':'D:/opencode/construtor-pg/backend/src/Runtime/RuntimeContainerExpenseBatch.php'},'limits':{'readMaximumRows':50000,'readStopAfterSeconds':10,'pageMaximum':200,'batchMaximum':100,'batchOperations':['update','delete'],'mixedBatch':False,'physicalOriginalFields':14,'editableFields':['vl_prev','vl_base_imp','log_manual']},'gatesReference':'REVIEW.md','fiscalV2Preserved':True}
p=root/'manifest.json';p.write_text(json.dumps(manifest,indent=2,ensure_ascii=False)+'\n',encoding='utf-8')
digest=sha(p)
frozen=state/'frozen-v1'
assert not frozen.exists(),'Do not replace existing freeze'
import shutil
shutil.copytree(root,frozen)
receipt={'status':'candidate-ready','version':1,'manifest':relative(p),'manifestSha256':digest,'snapshot':relative(frozen),'officialCompile':False,'integrated':False,'published':False,'businessExecuted':False}
(state/'candidate-ready.json').write_text(json.dumps(receipt,indent=2)+'\n',encoding='utf-8')
print(json.dumps(receipt,indent=2))
