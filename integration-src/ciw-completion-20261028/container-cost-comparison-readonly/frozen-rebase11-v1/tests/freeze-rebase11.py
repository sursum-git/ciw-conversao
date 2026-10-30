from pathlib import Path
import hashlib,json,shutil
ROOT=Path('D:/opencode/conversao-sc');DOMAIN=Path(__file__).resolve().parents[1];BASE=DOMAIN.parent;OUT=ROOT/'.runtime/ciw-completion-20261028/comparison-after11';PREP=ROOT/'.runtime/ciw-completion-20261028/official-build13-preparation';FROZEN=BASE/'frozen-rebase11-v1'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert not FROZEN.exists(),'Immutable snapshot may not be overwritten'
verification=json.loads((OUT/'verification.json').read_text());assert verification['success']and verification['ttChecks']==3692 and verification['fullPhpTests']==1001 and verification['fullPhpAssertions']==7807
preserved=[]
for p,expected in [(BASE/'frozen-v1/manifest.json','1649c47f1fce03cbf5d9428a3c8cb1f2118d2aa34ac6b9550182a81cb13444da'),(ROOT/'integration-src/ciw-completion-20261028/supplier-discounts-readonly/frozen-v1/manifest.json','ad6ae7a988a532c1e3d9adab252e7e408afdeec1367173dccee6887b7361470c')]:
 assert sha(p)==expected
 for row in json.loads(p.read_text(encoding='utf-8'))['files']:assert sha(p.parent/row['path'])==row['sha256']
 preserved.append({'manifest':str(p),'sha256':expected,'allFilesVerified':True})
for p in DOMAIN.rglob('*'):
 if p.is_file()and '__pycache__'not in p.parts:
  dest=FROZEN/p.relative_to(DOMAIN);dest.parent.mkdir(parents=True,exist_ok=True);shutil.copy2(p,dest)
proof_files=['verification.json','rebase-evidence.json','current-dependency-copies.json','native-real.json','native-dolar.json','native-validation.json','full-php/php-full.xml','full-php/php-full.log','full-php/php-stage-loader-proof.json','regression-local/compile-closure.log','service-local/compile-service-current.log']
for relative in proof_files:
 src=OUT/relative;dest=FROZEN/'proofs'/relative;dest.parent.mkdir(parents=True,exist_ok=True);shutil.copy2(src,dest)
for row in verification['logs']:
 src=Path(row['path']);assert sha(src)==row['sha256'];dest=FROZEN/'proofs'/src.relative_to(OUT);dest.parent.mkdir(parents=True,exist_ok=True);shutil.copy2(src,dest)
for p in PREP.rglob('*'):
 if p.is_file():
  dest=FROZEN/'official-preparation'/p.relative_to(PREP);dest.parent.mkdir(parents=True,exist_ok=True);shutil.copy2(p,dest)
generator=ROOT/'tools/construtor-local/prepare-ciw-completion-build13-comparison.py';dest=FROZEN/'official-preparation/prepare-ciw-completion-build13-comparison.py';shutil.copy2(generator,dest)
manifest={'state':'FROZEN_REBASE11_HELD_AFTER12_ORPHAN_POLICY_AND_OFFICIAL','immutableSource1649Preserved':True,'programCodes':['op1040','op1041'],'newProductionPrograms':4,'newProductionIncludes':1,'newPhpHelpers':1,'sharedFiles':5,'sharedHunks':17,'outsideHunksExact':True,'preserve1055':True,'action15IsolatedLfPreserved':True,'localUniqueCompileFiles':18,'localCompileExecutions':26,'localVersion':'12.8','numDbs':0,'testSuites':19,'testLogs':76,'ttChecks':3692,'fullPhpTests':1001,'fullPhpAssertions':7807,'loadedAppDefinitions':278,'privateBuilder205eTestOnly':True,'nativeNumericFiltersPerCurrency':12,'sourceProposal':{'before':146,'after':150,'actualSourceAndParentMustBeRechecked':True},'officialPreparation':{'state':'PREPARED_HELD_REBASE_AFTER12_AND_MANAGER_REVIEW','compileCount':39,'files':83,'compileNumDbs':1,'testNumDbs':0,'expectedChecks':3692,'expectedLogs':76,'remoteCommandsReleased':False,'sourceManifestSha256':sha(PREP/'source-manifest.json')},'gates':['Compose NF12 same-file deltas by actual hashes; never apply stale11 or10 snapshot','Orphan version source parity policy decision; current master requirement404 proved in TT; private policy proposal not implemented','Official OpenEdge12.2 physical compile and TT0DB, sameMED PASOE root only','Builder205e own release integrated before native metadata','Fresh source/parent native-owner exports and locks before additive metadata; preserve actual auth in memory','Precision overflow/ties and dynamic physical SQL optimizer cases outside existing closed synthetic evidence'],'preservedFrozenReferences':preserved,'historicalTestInputCopiesNotCompileInputs':['test-inputs/CiwCadastrosCrud.p','test-inputs/CiwErpReadService.p','test-inputs/ContainersVersionHistoryLabels.p'],'canonicalWrites':False,'networkExecuted':False,'businessWrites':False,'catalogWrites':False,'grants':False,'files':[{'path':p.relative_to(FROZEN).as_posix(),'sha256':sha(p),'bytes':p.stat().st_size}for p in sorted(FROZEN.rglob('*'))if p.is_file()]}
p=FROZEN/'manifest.json';p.write_text(json.dumps(manifest,indent=2,ensure_ascii=False)+'\n',encoding='utf-8');receipt={'success':True,'state':manifest['state'],'manifest':str(p),'sha256':sha(p),'files':len(manifest['files'])};(OUT/'freeze-rebase11-v1.json').write_text(json.dumps(receipt,indent=2)+'\n',encoding='utf-8');print(json.dumps(receipt))
