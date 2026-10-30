from pathlib import Path
import hashlib,json,shutil
root=Path(__file__).resolve().parents[1];w=root.parents[2];state=w/'.runtime/ciw-completion-20261028/container-attachments-download'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest();read=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
def log(p):
 raw=p.read_bytes();return raw.decode('utf-16'if raw.startswith(b'\xff\xfe')else'utf-8-sig')
assert log(state/'suite-complete.log').startswith('PASS container attachment authenticated readonly download')
assert 'PASS expected RED container attachment reference resource absent'in log(state/'red-final.log')
assert log(state/'abl-final.log').count('PASS 21 checks NUMDBS=0')==4
assert log(state/'abl-final.log').count('PASS: 347 checks')==4
assert 'OK (78 tests, 567 assertions)'in log(state/'phpunit-final.log')
assert read(state/'native-download-result.json')['checks']==12
assert read(state/'wiring-result.json')['checks']==73
assert read(state/'normalized-source-proof.json')['operations']==11
assert read(state/'1051-registry-companion-proof.json')['correctionRequired']is False
for cp in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:assert 'PASS EXECUTE NUMDBS=0'in log(state/'local'/f'test-{cp}-{culture}.log')
baselines=[]
for entry in read(root/'patches/patch-plan.json')['textPatches']:
 target=Path(entry['target']);candidate=Path(entry['candidateRuntimePath']);assert sha(target)==entry['baselineSha256']and sha(candidate)==entry['candidateSha256']
 before=target.read_bytes();after=before
 for c in entry['changes']:
  a=bytes.fromhex(c['oldBytesHex']);b=bytes.fromhex(c['newBytesHex']);assert after.count(a)==1;after=after.replace(a,b)
 assert after==candidate.read_bytes()
 baselines.append({'target':target.as_posix(),'baselineSha256':sha(target),'candidateRuntimePath':candidate.as_posix(),'candidateSha256':sha(candidate),'patchPlan':'patches/patch-plan.json','applyMode':'byte-exact-sequential-anchors; do not normalize EOL','preservesBytesOutsideAnchors':True})
unchanged=read(state/'wiring-result.json')['unchangedStorageAndFrontend']
for e in unchanged:assert sha(Path(e['path']))==e['sha256'],'unchanged dependency moved'
evidence=[]
for name,ranges,role in [
 ('sources/scriptcase/containers/form_anexos_container/index.php',[[47,103],[421,421],[729,729]],'document root derives from existing _lib/file/doc configuration'),
 ('sources/scriptcase/containers/form_anexos_container/form_anexos_container_apl.php',[[3833,3846],[5436,5442]],'legacy upload basename persisted; writes outside this candidate'),
 ('sources/scriptcase/ciw-completion-next19c-20261028/cons_anexos_container/cons_anexos_container_grid.class.php',[[3976,4003]],'active protected attachment link; empty subdirectory'),
 ('integration-src/container-panel/schema/schema-anexos_container.json',[],'physical seven-field attachment dictionary'),
 ('integration-src/container-panel/schema/schema-tipos_anexo.json',[],'physical type lookup dictionary'),
 ('integration-src/container-panel/schema/schema-pp-container.json',[],'physical master dictionary')]:
  p=w/name;evidence.append({'path':p.as_posix(),'sha256':sha(p),'lineRanges':ranges,'role':role})
wrapper=Path('D:/opencode/motor-progress/v2/sursum-api/programs/ContainersPainelRead.p');evidence.append({'path':wrapper.as_posix(),'sha256':sha(wrapper),'role':'unchanged authenticated fixed-buffer wrapper; ABI preserved'})
for name in ['source-current.json','container-anexos-entity.json','op1004-program.json','sanitization.json']:
 p=w/'.runtime/ciw-completion-20261028/container-attachments-current'/name;evidence.append({'path':p.as_posix(),'sha256':sha(p),'role':'live sanitized metadata snapshot; never overwrite authentication from DTO'})
(root/'source-evidence.json').write_text(json.dumps(evidence,indent=2)+'\n',encoding='utf-8')
logs=['red-final.log','abl-final.log','phpunit-final.log','builder-final.log','verify-wiring.py.log','native-final.log','suite-complete.log']
verification={'success':True,'businessExecuted':False,'canonicalChanged':False,'remoteExecuted':False,'official122Compiled':False,'numDbs':0,'ablChecksPerCombination':368,'ablNewChecks':21,'ablLegacyPanelChecks':347,'combinations':4,'codepages':['UTF-8','ISO8859-1'],'cultures':['AMERICAN','EUROPEAN'],'phpTests':78,'phpAssertions':567,'nativeAjvAndKendoChecks':12,'wiringChecks':73,'sourceRealNormalizerOperations':11,'companion1051RealNormalizerOperations':134,'logs':[{'path':(state/name).as_posix(),'sha256':sha(state/name)}for name in logs]}
(state/'verification-v1.json').write_text(json.dumps(verification,indent=2)+'\n',encoding='utf-8')
manifest={'package':'container-attachments-download','version':'1','program':'op1004','entity':'container_anexos_progress','screen':'ciw.container-anexos','status':'candidate-ready-authenticated-readonly-download-review','newProgram':False,'writerEnabled':False,'uploadEnabled':False,'businessExecuted':False,'canonicalChanged':False,'testCommand':'powershell -NoProfile -ExecutionPolicy Bypass -File integration-src/ciw-completion-20261028/container-attachments-download/tests/verify-all.ps1',
 'verificationPath':(state/'verification-v1.json').as_posix(),'verificationSha256':sha(state/'verification-v1.json'),'localEvidence':verification,'sharedBaselines':baselines,'newSources':[{'source':'php/RuntimeContainerAttachmentDownload.php','target':'D:/opencode/construtor-pg/backend/src/Runtime/RuntimeContainerAttachmentDownload.php'}],'unchangedBrokerPolicyTransportAndFrontend':unchanged,
 'contract':{'source':'motor_progress_container_painel','newOperationCode':'anexos_arquivo_get','operationType':'detail','resource':'anexos-arquivo','method':'POST','operation':'get','requiredContext':['container_id'],'primaryKey':'anexo_container_id','referenceRawFields':10,'mappedFields':9,'masterRule':'cod-estabel prefix5 before child/reference lookup','lookup':'one physical unique PK constrained to requested container; no new scan/pagination','authentication':'existing fixed Progress wrapper and native runtime session/read permission','fileReference':'authoritative persisted basename only; browser path never sent to storage','fileSizeExtensionPolicy':'unchanged broker historical policy; new upload limit not applied to downloads','storageRoot':'existing configured broker root only; no arbitrary root/URL/path'},
 'metadata':{'preparedOnly':True,'liveSnapshotsUsed':True,'sourceDelta':'metadata/source-addition.json','entityDelta':'metadata/entity-delta.json','programDelta':'metadata/program-delta.json','sourceOperations':'10 unchanged plus one detail','entityFields':'8 unchanged plus one readonly file reference','auth':'nested sanitized auth omitted; operations/property deltas only; never replace DTO'},
 'knownPresentationLimit':'existing readonly file editor shows disabled picker/upload20MB hint; not an actual download limit; native frontend unchanged','gates':['independent root/manager review including inherited readonly upload hint','root readonly preflight proves configured document root/file availability for container basenames; specific legacy doc.php missing from collected source','compare live metadata hashes before native Builder mutation; preserve source authentication and all existing fields/config','root hash-guarded byte composition; never normalize mixed EOL or copy full stage over shared files','official OpenEdge12.2/.42 compile and TT four combinations before any publication','root publication/real readonly native validation only sursum-api/med; no grants/upload/business writes authorized'],
 'companion1051':{'receipt':(state/'1051-registry-companion-proof.json').as_posix(),'sha256':sha(state/'1051-registry-companion-proof.json'),'frozen1051Changed':False,'typeCorrectionRequired':False},
 'files':[{'path':p.relative_to(root).as_posix(),'sha256':sha(p)}for p in sorted(root.rglob('*'))if p.is_file()and p.name!='manifest.json'and'__pycache__'not in p.parts]}
(root/'manifest.json').write_text(json.dumps(manifest,indent=2)+'\n',encoding='utf-8')
snapshot=state/'frozen-v1';assert not snapshot.exists(),'immutable snapshot exists';shutil.copytree(root,snapshot,ignore=shutil.ignore_patterns('__pycache__'))
inputs=state/'frozen-v1-test-inputs';assert not inputs.exists();inputs.mkdir()
for name in ['local','red']:shutil.copytree(state/name,inputs/name)
for name in ['native-preview.json','native-download-result.json','normalized-source-proof.json','1051-registry-companion-proof.json','wiring-result.json']:shutil.copy2(state/name,inputs/name)
(state/'freeze-v1.json').write_text(json.dumps({'manifestSha256':sha(root/'manifest.json'),'candidateSnapshot':snapshot.as_posix(),'testInputsSnapshot':inputs.as_posix(),'verificationSha256':sha(state/'verification-v1.json'),'testInputFiles':[{'path':p.relative_to(inputs).as_posix(),'sha256':sha(p)}for p in sorted(inputs.rglob('*'))if p.is_file()]},indent=2)+'\n',encoding='utf-8')
print('PASS attachment download candidate frozen; manifest SHA256 '+sha(root/'manifest.json'))
