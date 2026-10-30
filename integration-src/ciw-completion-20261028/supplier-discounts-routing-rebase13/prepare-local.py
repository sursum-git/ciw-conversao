from pathlib import Path
import json,hashlib,shutil
D=Path(__file__).resolve().parent;W=D.parents[2];R=W/'.runtime/ciw-completion-20261028/supplier-discounts-routing-rebase13';C=Path('D:/opencode/construtor-pg/backend/src');M=Path('D:/opencode/motor-progress/v2');I=D.parent/'container-supplier-discounts-integer-range-v2';F=D.parent/'supplier-discounts-readonly/frozen-v1'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert not (R/'full-stage-v1').exists() and not (R/'abl-local-v1').exists(),'Do not overwrite local receipts'
base=json.loads((D/'baselines.json').read_text());root=Path(base['canonical13Manifest']);assert json.loads(root.read_text())['success']
for row in json.loads(root.read_text())['files']:assert sha(Path(row['target']))==row['sha256'],row['target']
P=R/'full-stage-v1';S=P/'php-stage';S.mkdir(parents=True);files=[]
overlays={'Builder/ProgramBuilderService.php':I/'candidate/backend/src/Builder/ProgramBuilderService.php'}
for name in ['RuntimeApiEntityActionService.php','RuntimeCiwErpQuery.php','RuntimeImportDiscountRead.php']:overlays['Runtime/'+name]=D/'candidate/backend/src/Runtime'/name
for p in sorted(C.rglob('*.php')):
 rel=p.relative_to(C).as_posix();target=S/rel;target.parent.mkdir(parents=True,exist_ok=True);src=overlays.get(rel,p);shutil.copyfile(src,target);files.append({'relative':rel,'canonicalSha256':sha(p),'stageSha256':sha(target),'overlay':rel in overlays,'source':str(src)})
assert len(files)==410 and sha(S/'Builder/ProgramBuilderService.php')==base['futureBuilderSha256'] and sha(S/'Runtime/RuntimeImportDiscountRead.php')==base['helperCandidateSha256']
(P/'stage-manifest.json').write_text(json.dumps({'success':True,'allCurrent13':True,'canonicalManifestSha256':sha(root),'files':files,'overlays':list(overlays)},indent=2)+'\n')
# Copy stable13 fixtures and redirect every old13-local output to this new tree.
old=W/'.runtime/ciw-completion-20261028/official-build13-v2';new=P/'legacy13';new.mkdir()
for rel in ['php-tests','test-inputs','tests/php','metadata','relations-state','local']:shutil.copytree(old/rel,new/rel)
shutil.copyfile(old/'native-calls.json',new/'native-calls.json')
rewrites=[]
for p in new.rglob('*'):
 if not p.is_file() or p.suffix not in ['.php','.json','.xml']:continue
 before=p.read_bytes();body=before
 for a,b in [(old.as_posix(),new.as_posix()),(str(old),str(new)),(str(old).replace('\\','\\\\'),str(new).replace('\\','\\\\'))]:body=body.replace(a.encode(),b.encode())
 if body!=before:p.write_bytes(body);rewrites.append({'path':str(p.relative_to(P)),'beforeSha256':hashlib.sha256(before).hexdigest(),'afterSha256':sha(p),'delta':'local13 input/output paths only'})
(P/'legacy-fixtures-provenance.json').write_text(json.dumps({'originalRoot':str(old),'newRoot':str(new),'testLogicChanged':False,'pathOnlyRewrites':rewrites,'oldReceiptsWritten':False},indent=2)+'\n')
bootstrap=(I.parents[2]/'.runtime/ciw-completion-20261028/container-supplier-discounts-integer-range-v2/final-local-v1/php-stage-bootstrap.php').read_bytes();(P/'php-bootstrap.php').write_bytes(bootstrap)
cfg=f'''<?xml version="1.0" encoding="UTF-8"?><phpunit bootstrap="{P.as_posix()}/php-bootstrap.php" cacheResult="false"><testsuites><testsuite name="SupplierRoutingFullCurrent13"><directory>D:/opencode/construtor-pg/backend/tests</directory><directory>{new.as_posix()}/php-tests</directory><exclude>{new.as_posix()}/php-tests/nf/tests/RuntimeContainerNfAvailableReadTest.php</exclude><directory>{new.as_posix()}/tests/php</directory><directory>{I.as_posix()}/tests</directory><directory>{D.as_posix()}/tests/php</directory></testsuite></testsuites></phpunit>''';(P/'phpunit.xml').write_text(cfg)
A=R/'abl-local-v1';pkg=A/'package';programs=pkg/'sursum-api/programs';includes=pkg/'sursum-api/includes';programs.mkdir(parents=True);includes.mkdir()
for p in (D/'candidate/programs').glob('*.p'):shutil.copyfile(p,programs/p.name)
for p in (D/'candidate/includes').glob('*.i'):shutil.copyfile(p,includes/p.name)
for p in (F/'test-inputs/sursum-api/includes').glob('*.i'):shutil.copyfile(p,includes/p.name)
shutil.copyfile(M/'sursum-api/programs/ContainersVersionHistoryLabels.p',programs/'ContainersVersionHistoryLabels.p')
sources=['CiwCadastrosCrud.p','CiwErpReadService.p','ImportDiscountsCollector.p','ImportDiscountsReadApi.p','ImportDiscountsReadService.p','ImportDiscountsSupplierCollector.p','ContainersVersionHistoryLabels.p']
text=f"DEFINE VARIABLE n AS INTEGER NO-UNDO.\nPROPATH='{pkg.as_posix()},{(D/'tests/abl').as_posix()},C:/Progress/OpenEdge/gui/netlib/OpenEdge.Net.pl,' + PROPATH.\nOUTPUT TO 'compile.log'.\nPUT UNFORMATTED 'NUMDBS=' NUM-DBS SKIP.\nIF NUM-DBS<>0 THEN QUIT.\n"
for name in sources:text+=f"COMPILE '{(programs/name).as_posix()}' SAVE INTO '{programs.as_posix()}' NO-ERROR.\nPUT UNFORMATTED '{name} ERROR=' COMPILER:ERROR SKIP.\nDO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-NUMBER(n) ' ' ERROR-STATUS:GET-MESSAGE(n) SKIP. END.\n"
text+='OUTPUT CLOSE. QUIT.\n';(A/'Compile.p').write_text(text)
(A/'source-manifest.json').write_text(json.dumps({'diagnosticVersion':'12.8','numDbs':0,'sources':[{'path':str(p),'sha256':sha(p)}for p in pkg.rglob('*')if p.is_file()],'old13ProductsCopiedExactly':True,'productionFilesPublished':False},indent=2)+'\n')
print(json.dumps({'phpSources':len(files),'phpOverlays':len(overlays),'localAblCompiles':len(sources),'localSuites':4,'fullStage':str(P),'networkExecuted':False}))
