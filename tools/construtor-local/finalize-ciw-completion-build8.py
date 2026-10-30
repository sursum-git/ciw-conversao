"""Finish only local build8 metadata/test/closure plans. Does not run any remote command."""
from pathlib import Path
import json,hashlib,shutil,re
R=Path('D:/opencode/conversao-sc');F=Path('D:/opencode/construtor-pg');S=R/'.runtime/ciw-completion-20261028';B=S/'official-build8';P=B/'package';BACK=B/'backend-stage';OLD=S/'official-build7'
SEL=S/'container-expense-default-selection/frozen-v1.2';MAN=S/'item-cost-manual/frozen-v1';SAMPLE=R/'integration-src/ciw-completion-20261028/sample-container-items-readonly/frozen-v1';TYPE=SAMPLE.parent/'operation-type-fix/frozen-v1';REV=S/'container-version-history/review1047v1.2';KEY=R/'integration-src/ciw-completion-20261028/cost-distribution-readonly/ledger-item/key-order-fix/frozen-v1'
read=lambda p:json.loads(Path(p).read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(Path(p).read_bytes()).hexdigest()
def save(p,v):p.parent.mkdir(parents=True,exist_ok=True);p.write_text(json.dumps(v,indent=2,ensure_ascii=False)+'\n',encoding='utf-8')
assert read(B/'build-manifest.json')['state']=='PREPARED_NOT_EXECUTED_REQUIRES_MANAGER_REVIEW'
assert not (B/'remote-plan.json').exists(),'Finalized inputs exist; no regeneration'
# Current dependencies are copied exactly, except shared modified candidates already staged.
deps=[]
for rel in ['Runtime/RuntimeContainerAudit.php','Runtime/RuntimeContainerTaxAudit.php','Runtime/RuntimeContainerExpenseBatch.php','Runtime/RuntimeProgressAuditSchema.php','Runtime/RuntimeImportDiscountRead.php','Runtime/RuntimeCostDistributionRead.php','Runtime/RuntimeCostDistributionLedgerRead.php','Builder/ProgramBuilderService.php']:
 src=F/'backend/src'/rel;dest=BACK/'backend/src'/rel
 if not dest.exists():dest.parent.mkdir(parents=True,exist_ok=True);dest.write_bytes(src.read_bytes());deps.append({'target':str(src),'sha256':sha(src),'stage':str(dest)})
assert sha(BACK/'backend/src/Runtime/RuntimeCostDistributionLedgerRead.php')=='f2273437e55865d3ba66ea5fbea0e96d7aa01ea2bd7c6e0bc2bde906ae7e457c'
save(B/'dependency-snapshots.json',deps)
shutil.copytree(OLD/'php-tests',B/'php-tests')
def tests(pkg,key,names,metadata=True,rewrite=None):
 dest=B/'php-tests'/key;(dest/'tests').mkdir(parents=True,exist_ok=True)
 if metadata and (pkg/'metadata').exists():shutil.copytree(pkg/'metadata',dest/'metadata')
 for name in names:
  data=(pkg/'tests'/name).read_bytes()
  if rewrite:data=data.replace(rewrite[0].encode(),rewrite[1].encode())
  (dest/'tests'/name).write_bytes(data)
 return dest
selinput=S/'container-expense-default-selection/frozen-v1.2-test-inputs/local';fixture=B/'test-inputs/selection/local';fixture.mkdir(parents=True)
for f in selinput.glob('*.json'):shutil.copyfile(f,fixture/f.name)
tests(SEL,'selection',['RuntimeExpenseSelectionTest.php','NativeLookupParametersTest.php','NativeLookupPageTypeGuardTest.php'],rewrite=(str(S/'container-expense-default-selection').replace('\\','/'),str(B/'test-inputs/selection').replace('\\','/')))
selectionPreview=(SEL/'tests/preview-native.php').read_text(encoding='utf-8').replace(str(S/'container-expense-default-selection/native/backend/src/Builder/ProgramBuilderService.php').replace('\\','/'),str(BACK/'backend/src/Builder/ProgramBuilderService.php').replace('\\','/')).replace(str(S/'container-expense-default-selection').replace('\\','/'),str(B/'test-inputs/selection').replace('\\','/'));selectionPreview=selectionPreview.replace('$root=dirname(__DIR__);',"$root='"+str(B/'php-tests/selection').replace('\\','/')+"';")
(B/'php-tests/selection/tests/preview-native.php').write_text(selectionPreview,encoding='utf-8')
manualtest=tests(MAN,'manual',['RuntimeItemCostManualReadTest.php'],rewrite=('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/item-cost-manual/local',str(S/'item-cost-manual/frozen-v1-test-inputs/local').replace('\\','/')))
(manualtest/'php').mkdir();shutil.copyfile(MAN/'php/RuntimeItemCostManualSchema.php',manualtest/'php/RuntimeItemCostManualSchema.php')
tests(SAMPLE,'sample',['RuntimeSampleContainerItemsReadIntegrationTest.php']);shutil.copyfile(TYPE/'metadata/api-source-additions.json',B/'php-tests/sample/metadata/api-source-additions.json')
tests(KEY,'keyfix',['RuntimeCostDistributionLedgerKeyOrderIntegrationTest.php'],metadata=False);shutil.copyfile(KEY/'tests/reader-row.json',B/'php-tests/keyfix/tests/reader-row.json')
tests(TYPE,'types',['ApiOperationTypeRegistryTest.php']);shutil.copytree(TYPE/'baseline-exact',B/'php-tests/types/baseline-exact')
bootstrap="<?php\nrequire 'D:/opencode/construtor-pg/backend/vendor/autoload.php';\nspl_autoload_register(static function(string $class):void { if(str_starts_with($class,'App\\\\')) { $file='"+str(BACK/'backend/src').replace('\\','/')+"/'.str_replace('\\\\','/',substr($class,4)).'.php';if(is_file($file))require $file;} },true,true);\n"
(B/'php-bootstrap.php').write_text(bootstrap,encoding='utf-8')
# Read current metadata only in memory. Save additions/guards; never copy authentication DTO.
sourcePath=OLD/'metadata-source-after.json';source=read(sourcePath);assert source['code']=='motor_progress_ciw_cadastros' and len(source['operations'])==140
manualops=[x['value']for x in read(MAN/'metadata/source-addition.json')['operations']];sampleops=read(TYPE/'metadata/api-source-additions.json')['operations'];ops=manualops+sampleops
assert len(ops)==4 and len({x['code']for x in ops})==4;assert [x['type']for x in ops]==['list','detail','list','detail'];assert not {x['code']for x in ops}&{x['code']for x in source['operations']}
save(B/'metadata/cadastros-source-additions.json',{'sourceCode':source['code'],'baselinePath':str(sourcePath),'baselineSha256':sha(sourcePath),'before':140,'after':144,'preserveActualAuthentication':True,'replaceFromSanitizedDTO':False,'operations':[{'op':'add','path':'/operations/-','value':x}for x in ops]})
processPlan=read(SEL/'metadata/source-addition.json');processSource=read(processPlan['target']);assert sha(processPlan['target'])==processPlan['baselineSha256'] and len(processSource['operations'])==6
save(B/'metadata/process-source-additions.json',processPlan)
for pkg,pattern in [(SEL,'selection-builder-draft.json'),(MAN,'*builder-draft.json'),(SAMPLE,'*builder-draft.json')]:
 for p in (pkg/'metadata').glob(pattern):shutil.copyfile(p,B/'metadata'/p.name)
for name in ['parent-navigation.json','parent-builderConfig-preview.json']:shutil.copyfile(SEL/'metadata'/name,B/'metadata'/name)
parent=read(SEL/'metadata/parent-navigation.json');assert sha(parent['target'])==parent['baselineSha256'];assert parent['baselineVersion']=='1.0.3'
# Example5-file integration is explicitly separate from core build/remote uploads.
exmaps=read(REV/'example-exact-maps.json');example=[]
for x in exmaps['shared']:
 assert sha(x['target'])==x['baselineSha256'];src=Path(x['candidatePath']);assert sha(src)==x['candidateSha256'];dest=B/'example-stage'/Path(x['target']).relative_to(F);dest.parent.mkdir(parents=True,exist_ok=True);shutil.copyfile(src,dest);example.append({'target':x['target'],'baselineSha256':x['baselineSha256'],'candidate':str(dest),'candidateSha256':sha(dest)})
for x in exmaps['newSources']:
 src=Path(x['sourcePath']);assert sha(src)==x['sha256'];assert not Path(x['target']).exists();dest=B/'example-stage'/Path(x['target']).relative_to(F);dest.parent.mkdir(parents=True,exist_ok=True);shutil.copyfile(src,dest);example.append({'target':x['target'],'baselineSha256':None,'candidate':str(dest),'candidateSha256':sha(dest)})
save(B/'example-integration-plan.json',{'separateFromCoreIntegration':True,'requires1047NativeExtension':True,'files':example,'canonicalWrites':False,'browserCanonicalBlockedPathAccessed':False})
# Static include closure, resolving the same root/program/include PROPATH as official7.
closure=[];missing=[];include=re.compile(r'(?<!~)\{\s*([^\s{}\"\']+\.(?:i|p|cls))(?=[\s}])',re.I)
for file in sorted(P.rglob('*')):
 if file.suffix.lower()not in ['.p','.i','.cls']:continue
 text=file.read_text(encoding='utf-8-sig')
 for ref in include.findall(text):
  candidates=[P/ref,P/'sursum-api/programs'/ref,P/'sursum-api/includes'/ref,P/'sursum-api/sursum'/ref];found=next((p for p in candidates if p.is_file()),None)
  if found:closure.append({'source':str(file.relative_to(P)),'include':ref,'resolved':str(found.relative_to(P)),'sha256':sha(found)})
  else:missing.append({'source':str(file.relative_to(P)),'include':ref})
assert not missing,missing;save(B/'include-closure.json',{'success':True,'resolved':closure,'missing':missing,'canonicalPropathFallback':False})
bm=read(B/'build-manifest.json');remote='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build8';uploads=[{'local':str(p.relative_to(R)),'remote':remote+'/'+p.relative_to(P).as_posix()}for p in sorted(P.rglob('*'))if p.is_file()];logs=[t['name'][:-2]+'-'+cp+'-'+culture+'.log'for t in bm['tests']for cp in ['UTF-8','ISO8859-1']for culture in ['AMERICAN','EUROPEAN']]
downloads=['compile.log','compile-process.log','net-library.txt']+[str(Path(n).with_suffix('.r')).replace('\\','/')for n in bm['compileEntries']]+logs
save(B/'remote-plan.json',{'server':'compiler','directories':[remote]+[remote+'/'+p.relative_to(P).as_posix()for p in sorted(P.rglob('*'))if p.is_dir()],'uploads':uploads,'commands':['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/compile122.ps1'],'downloads':[{'local':str((B/'compiled122'/n).relative_to(R)),'remote':remote+'/'+n,'optional':True}for n in downloads]})
save(B/'source-manifest.json',[{'file':u['local'],'sha256':sha(R/u['local'])}for u in uploads]);bm.update({'sourceFiles':len(uploads),'includeReferencesResolved':len(closure),'integrationFiles':len(read(B/'integration-plan.json')['files']),'separateExampleFiles':5,'metadata':{'cadastros':[140,144],'process':[6,8],'parent1003Baseline':'1.0.3','preserveActualAuthentication':True,'grants':0},'sourceManifestSha256':sha(B/'source-manifest.json'),'remotePlanSha256':sha(B/'remote-plan.json'),'integrationPlanSha256':sha(B/'integration-plan.json'),'compositionProofSha256':sha(B/'composition-proof.json')});save(B/'build-manifest.json',bm)
print(json.dumps({'state':'PREPARED_NOT_EXECUTED_REQUIRES_MANAGER_REVIEW','sources':len(uploads),'compiles':len(bm['compileEntries']),'suites':len(bm['tests']),'checksPerCombination':1166,'logs':84,'includeReferencesResolved':len(closure),'exampleSeparate':5,'network':False}))
