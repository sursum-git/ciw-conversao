from pathlib import Path
import json,hashlib,shutil,re,xml.etree.ElementTree as ET
root=Path(__file__).resolve().parents[1];workspace=root.parents[2];state=workspace/'.runtime/ciw-completion-20261028/container-nf-available-readonly';stage=state/'local';frozen=state/'frozen-v1';packageFrozen=root/'frozen-v1';h=lambda p:hashlib.sha256(p.read_bytes()).hexdigest();read=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
assert not frozen.exists() and not packageFrozen.exists() and not (root/'manifest.json').exists(),'Never overwrite a freeze'
plan=read(root/'patches/patch-plan.json');native=read(state/'native-result.json');wiring=read(state/'wiring-result.json')
assert native['success'] and wiring['success'] and native['checks']==19
def junit(p):
 tree=ET.parse(p).getroot();cases=list(tree.iter('testcase'));tops=[tree]if tree.tag=='testsuite'else tree.findall('testsuite')
 result={'tests':len(cases),'assertions':sum(int(c.get('assertions',0))for c in cases),'errors':sum(len(c.findall('error'))for c in cases),'failures':sum(len(c.findall('failure'))for c in cases),'skipped':sum(len(c.findall('skipped'))for c in cases)}
 assert result=={k:sum(int(s.get(k,0))for s in tops)for k in result},('Top-level JUnit totals mismatch',p)
 assert result['errors']==result['failures']==result['skipped']==0,(p,result);return result
focused=junit(state/'php-focused.xml');full=junit(state/'php-canonical-full.xml');assert focused['tests']==33 and focused['assertions']==221 and full['tests']==885 and full['assertions']==5841
abl=[]
for cp in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:
  p=stage/f'test-{cp}-{culture}.log';text=p.read_text(encoding='utf-8-sig');assert 'PASS EXECUTE NUMDBS=0'in text and 'PASS 39 checks NUMDBS=0'in text and 'PASS: 231 checks'in text
  abl.append({'codepage':cp,'culture':culture,'numDbs':0,'newChecks':39,'financialRegressionChecks':231,'path':p.as_posix(),'sha256':h(p)})
sourceFiles=[{'path':p.relative_to(root).as_posix(),'sha256':h(p)}for p in sorted(root.rglob('*'))if p.is_file() and p.name!='manifest.json' and 'frozen-v1'not in p.parts and '__pycache__'not in p.parts]
candidateSources=[]
for p in plan['textPatches']:
 current=Path(p['candidateRuntimePath']);assert h(current)==p['candidateSha256'];assert h(Path(p['target']))==p['baselineSha256'];out=frozen/'candidates'/p['relative'];out.parent.mkdir(parents=True,exist_ok=True);out.write_bytes(current.read_bytes());candidateSources.append({k:p[k]for k in ['target','relative','baselineSha256','candidateSha256']}|{'frozenCandidatePath':out.as_posix(),'patchPath':(root/'patches'/(Path(p['target']).name+'.patch')).as_posix()})
testInputs=[]
for p in sorted(stage.rglob('*')):
 if p.is_file() and p.suffix.lower() in ['.p','.i','.php']:
  out=frozen/'testinputs'/p.relative_to(stage);out.parent.mkdir(parents=True,exist_ok=True);out.write_bytes(p.read_bytes());testInputs.append({'path':out.relative_to(frozen).as_posix(),'sha256':h(out)})
evidencePaths=[state/'php-focused.xml',state/'php-canonical-full.xml',state/'php-red.xml',state/'php-scalar-red.xml',state/'collation-red.log',state/'native-result.json',state/'wiring-result.json',state/'eol-proof.json',state/'action8-rebase-input.json',stage/'compile.log',workspace/'.runtime/ciw-completion-20261028/official-build8/canonical-manifest.json']
newFile=root/'php/RuntimeContainerNfAvailableRead.php'
manifest={'status':'CANDIDATE_READY_LOCAL_FROZEN_V1_AWAITING_ROOT_REVIEW','domain':'container-nf-available-readonly','programCode':'op1053','entityCode':'container_nfs_disponiveis_med_progress','scope':'MED only; available NF read/get; origin remains partial','sourceFiles':sourceFiles,'candidateSources':candidateSources,'newFiles':[{'candidatePath':newFile.as_posix(),'sha256':h(newFile),'target':'D:/opencode/construtor-pg/backend/src/Runtime/RuntimeContainerNfAvailableRead.php'}],'testInputs':testInputs,'tests':{'ablCompiler':'12.8 diagnostic only; no publishable .r','ablFourCombinations':abl,'ablTotalChecks':1080,'phpFocused':focused,'phpCanonicalFull':full,'native':native,'wiring':wiring,'command':'powershell -NoProfile -ExecutionPolicy Bypass -File integration-src/ciw-completion-20261028/container-nf-available-readonly/tests/verify-all.ps1','commandUsesPinnedInputsNoRegeneration':True},'evidence':[{'path':p.as_posix(),'sha256':h(p)}for p in evidencePaths],'limits':{'processedSourceRows':50000,'sourceRowsDefinition':'Rows processed from fixed CID links and matching ERP documents, not internal index IO; next fetched row detects excess.','stopAfterSeconds':10,'eligibleRowsExamined':200,'excess':'503 and no partial data','collation':'422 CONTAINER_NF_COLLATION_UNPROVEN on potentially ambiguous non-byteidentical comparison; no document normalization'},'metadata':{'newReadonlyProgram':'metadata/builder-draft.json','sourceAppendOnly':'metadata/source-addition.json','sourceOperationsBefore':4,'sourceOperationsAfter':6,'parentDelta':'metadata/parent-navigation-delta.json','parentProgram':'op1000','parentExpectedVersion':'1.0.2','parentCandidateVersion':'1.0.3','authenticationReplacementAllowed':False},'gates':{'independentReviewCompleted':False,'official122Compiled':False,'canonicalIntegrated':False,'runtimePublished':False,'metadataPublished':False,'realPasoeValidated':False,'newReadAccessGranted':False,'sqlOdbcExecuted':False,'originFullyConverted':False},'safety':{'canonicalEdited':False,'remoteExecuted':False,'businessWritten':False,'ddlOrSequenceCreated':False,'grantExecuted':False,'inventoryChanged':False,'otherFreezesChanged':False},'integration':'Root applies only matching byte patches, copies the one new PHP helper, compiles official12.2/.42 and publishes sursum-api/MED under its gates. Sanitized source preview never replaces stored authentication.'}
(root/'manifest.json').write_text(json.dumps(manifest,indent=2,ensure_ascii=False)+'\n',encoding='utf8');packageFrozen.mkdir()
for item in sourceFiles:
 src=root/item['path'];out=packageFrozen/item['path'];out.parent.mkdir(parents=True,exist_ok=True);out.write_bytes(src.read_bytes())
for out in [packageFrozen/'manifest.json',frozen/'manifest.json']:out.write_bytes((root/'manifest.json').read_bytes())
seal={'success':True,'manifestPath':(root/'manifest.json').as_posix(),'manifestSha256':h(root/'manifest.json'),'frozenPackagePath':packageFrozen.as_posix(),'frozenRuntimePath':frozen.as_posix(),'candidateSources':candidateSources,'sourceFiles':len(sourceFiles),'testInputs':len(testInputs),'official122Executed':False,'canonicalEdited':False}
(state/'freeze-seal.json').write_text(json.dumps(seal,indent=2)+'\n',encoding='utf8')
print(json.dumps({'candidateReady':True,'manifestSha256':seal['manifestSha256'],'sourceFiles':len(sourceFiles),'testInputs':len(testInputs),'candidates':candidateSources},indent=2))
