from pathlib import Path
import hashlib,json,datetime,shutil
root=Path(__file__).resolve().parents[1];w=root.parents[2];state=w/'.runtime/ciw-completion-20261028/container-tax-only'
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
def rel(p):return p.relative_to(w).as_posix()
baselines=[]
for name in ['patches/abl-plan.json','patches/php-plan.json','metadata/source-addition.json','metadata/parent-navigation.json']:
 data=json.loads((root/name).read_text(encoding='utf-8'))
 for entry in data.get('textPatches',[data]):
  target=Path(entry['target']);assert sha(target)==entry['baselineSha256'],str(target)
  baselines.append({'plan':name,'target':target.as_posix(),'baselineSha256':sha(target)})
evidence=[]
for name in ['abl-final.log','wiring-final.log','phpunit-final.log','builder-final.log','process-native-final.log','process-regression-final.log','local/compile.log','red/test-UTF-8-AMERICAN.log']:
 p=state/name;content=p.read_text(encoding='utf-16'if p.read_bytes().startswith(b'\xff\xfe')else'utf-8-sig')
 assert ('PASS' in content or 'OK (53 tests, 364 assertions)' in content or 'FAIL' in content and name.startswith('red/')),name
 evidence.append({'path':rel(p),'sha256':sha(p)})
freeze_refs=[]
for package,digest in [('container-expense-batch','75b0f1351d95e648516ffccdd9c4d85bb1cf20a22e3b966783aea4ab323ff8f5'),('container-fiscal-readonly','b847a16ad4406c6703490bb2fb7809dfea3fce5dc6012bc94e52e2fca7643173')]:
 p=w/f'integration-src/ciw-completion-20261028/{package}/manifest.json';assert sha(p)==digest,package;freeze_refs.append({'path':rel(p),'sha256':digest})
inputs=[w/'sources/scriptcase/ciw-completion-helpers-20261028/bl_calcular_impostos_container/index.php',w/'.runtime/ciw-completion-20261028/schema/schema-despesas_container.json',w/'.runtime/ciw-completion-20261028/schema/schema-calcs_imp_container.json']
files=[{'path':p.relative_to(root).as_posix(),'sha256':sha(p),'bytes':p.stat().st_size}for p in sorted(root.rglob('*'))if p.is_file() and p.name!='manifest.json' and '__pycache__'not in p.parts]
m={'package':'container-tax-only','version':1,'status':'candidate-ready-local','createdAt':datetime.datetime.now(datetime.timezone.utc).isoformat(),'program':'op1043','entity':'container_processos_progress','newEntity':False,'source':'motor_progress_container_processos','operation':'calcular_impostos','resource':'impostos','route':'/SursumPrograms/containers-processos','abiPreserved':True,'officialCompile':False,'integrated':False,'published':False,'businessExecuted':False,'sharedApplied':False,'files':files,'baselines':baselines,'auditedInputs':[{'path':rel(p),'sha256':sha(p)}for p in inputs],'preservedFreezes':freeze_refs,'evidence':evidence,'command':'powershell -NoProfile -ExecutionPolicy Bypass -File integration-src/ciw-completion-20261028/container-tax-only/tests/verify-all.ps1','results':{'localOpenEdge':'12.8 NUM-DBS=0','localCompileEntries':9,'checksPerCombination':219,'core':160,'existingSync':11,'taxOnlyRoot':16,'boundaryIma':32,'combinations':['UTF-8/AMERICAN','UTF-8/EUROPEAN','ISO8859-1/AMERICAN','ISO8859-1/EUROPEAN'],'phpUnitTests':53,'phpUnitAssertions':364,'newProcessTests':5,'newProcessAssertions':87,'nativeProcessChecks':13,'publicWiringSourceParentChecks':12,'existingProcessFrontend':'PASS'},'limits':{'collectedRows':50000,'stopAfterSeconds':10,'scope':'new operation only','context':'container MED mandatory','clientParameters':[]},'newFiles':{'php/RuntimeContainerTaxAudit.php':'D:/opencode/construtor-pg/backend/src/Runtime/RuntimeContainerTaxAudit.php'},'gatesReference':'REVIEW.md','sourceOperationCountBefore':5,'sourceOperationCountAfter':6,'sourcePreviewMustNotReplaceAuthentication':True}
p=root/'manifest.json';p.write_text(json.dumps(m,indent=2,ensure_ascii=False)+'\n',encoding='utf-8');digest=sha(p)
snapshot=state/'frozen-v1';assert not snapshot.exists();shutil.copytree(root,snapshot)
receipt={'status':'candidate-ready','version':1,'manifest':rel(p),'manifestSha256':digest,'snapshot':rel(snapshot),'officialCompile':False,'integrated':False,'published':False,'businessExecuted':False}
(state/'candidate-ready.json').write_text(json.dumps(receipt,indent=2)+'\n',encoding='utf-8');print(json.dumps(receipt,indent=2))
