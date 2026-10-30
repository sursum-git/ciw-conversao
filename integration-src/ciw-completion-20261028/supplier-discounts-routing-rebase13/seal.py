from pathlib import Path
import json,hashlib,base64,difflib,datetime,xml.etree.ElementTree as ET
D=Path(__file__).resolve().parent;W=D.parents[2];R=W/'.runtime/ciw-completion-20261028/supplier-discounts-routing-rebase13';F=D/'frozen-v1';assert not F.exists(),'Immutable freeze exists'
sha=lambda b:hashlib.sha256(b).hexdigest()
write=lambda p,v:p.write_text(json.dumps(v,indent=2,ensure_ascii=False)+'\n',encoding='utf-8')
base=json.loads((D/'baselines.json').read_text());current=Path(base['canonical13Manifest']);official=json.loads(current.read_text());assert official['success']
for row in official['files']:assert sha(Path(row['target']).read_bytes())==row['sha256'],row['target']
integer=D.parent/'container-supplier-discounts-integer-range-v2/frozen-v1/manifest.json';old=json.loads(integer.read_text());assert sha(integer.read_bytes())==base['integerRangeFreezeSha256']
for row in old['files']:assert sha(Path(row['path']).read_bytes())==row['sha256'],row['path']
shared=[];(D/'patches').mkdir(exist_ok=True)
for row in base['files']:
 rel=row['relative'];before=(D/'baseline'/rel).read_bytes();after=(D/'candidate'/rel).read_bytes();assert sha(before)==row['baselineSha256'];assert before!=after
 a=before.splitlines(keepends=True);b=after.splitlines(keepends=True);ao=[0];bo=[0]
 for x in a:ao.append(ao[-1]+len(x))
 for x in b:bo.append(bo[-1]+len(x))
 hunks=[];same=[]
 for tag,i,j,x,y in difflib.SequenceMatcher(None,a,b,autojunk=False).get_opcodes():
  if tag=='equal':same.append({'baselineStart':ao[i],'baselineEnd':ao[j],'candidateStart':bo[x],'candidateEnd':bo[y],'sha256':sha(before[ao[i]:ao[j]])})
  else:hunks.append({'baselineStart':ao[i],'baselineEnd':ao[j],'candidateStart':bo[x],'candidateEnd':bo[y],'beforeBase64':base64.b64encode(before[ao[i]:ao[j]]).decode(),'afterBase64':base64.b64encode(after[bo[x]:bo[y]]).decode()})
 out=b'';cursor=0
 for h in hunks:out+=before[cursor:h['baselineStart']]+base64.b64decode(h['afterBase64']);cursor=h['baselineEnd']
 out+=before[cursor:];assert out==after
 patch=D/'patches'/(Path(rel).name+'.bytepatch.json');write(patch,{'relative':rel,'canonical':row['canonical'],'baselineSha256':sha(before),'candidateSha256':sha(after),'hunks':hunks,'unchangedRanges':same,'applyOnlyByExactBaseline':True})
 (D/'patches'/(Path(rel).name+'.patch')).write_bytes(b''.join(difflib.diff_bytes(difflib.unified_diff,a,b,fromfile=('a/'+rel).encode(),tofile=('b/'+rel).encode())))
 shared.append({'relative':rel,'canonical':row['canonical'],'baselineSha256':sha(before),'candidateSha256':sha(after),'hunks':len(hunks),'bytePatch':patch.relative_to(D).as_posix(),'roundTripExact':True})
assert len(shared)==9
new=[]
for rel in ['programs/ImportDiscountsSupplierCollector.p','includes/ImportDiscountsCollectorBody.i']:new.append({'relative':rel,'sha256':sha((D/'candidate'/rel).read_bytes()),'sourceOriginalFrozenByteEqual':True})
full=ET.parse(R/'full-stage-v2/php-full.xml').getroot();cases=list(full.iter('testcase'));assert len(cases)==1043 and sum(int(x.attrib.get('assertions',0))for x in cases)==8524 and not list(full.iter('failure')) and not list(full.iter('error'))
loader=json.loads((R/'full-stage-v2/php-stage-loader-proof.json').read_text());assert loader['success'] and loader['loadedAppDefinitions']==278 and loader['outsideStage']==[]
abl=json.loads((R/'abl-local-v1/proof.json').read_text());assert abl['success'] and abl['compileCount']==7 and abl['checks']==444 and abl['numDbs']==0
assert sha((D/'candidate/backend/src/Runtime/RuntimeImportDiscountRead.php').read_bytes())=='d89428668214f8901cd02a32176200afa3433f645fddd3cf42cd749e8545893a'
files=[]
for root in [D,R]:
 for p in sorted(root.rglob('*')):
  if p.is_file() and F not in p.parents and '__pycache__'not in p.parts:files.append({'path':str(p.resolve()),'sha256':sha(p.read_bytes()),'bytes':p.stat().st_size})
F.mkdir();manifest={'success':True,'state':'CANDIDATE_COMPOSED_LOCAL_GREEN_ROOT_REVIEW_AND_OFFICIAL_REQUIRED','createdAtUtc':datetime.datetime.now(datetime.timezone.utc).isoformat(),'scope':'1056 supplier-discounts readonly routing composed on canonical13; no new frontend or formula','canonical13ManifestSha256':sha(current.read_bytes()),'integerRangePredecessorManifestSha256':sha(integer.read_bytes()),'sharedFiles':shared,'newProductionFiles':new,'futureBuilderClosureOnlySha256':base['futureBuilderSha256'],'helperExactSha256':base['helperCandidateSha256'],'tests':{'focused':20,'focusedAssertions':457,'fullPhp':1043,'fullAssertions':8524,'stagedSources':410,'loadedApp':278,'localAblVersion':'12.8 diagnostic only','localAblCompiles':7,'localTtChecks':444,'localTtLogs':16,'numDbs':0},'internalTtAbiChanged':True,'publicFacadeAbiChanged':False,'newReadContradictoryErrorGuard':'supplier-only;502CIW_ERP_RESPONSE_INVALID;null means absent like existingGET','old13RegistryEntriesPreserved':True,'official14Generated':False,'canonicalWrites':False,'networkExecuted':False,'businessWrites':False,'metadataWrites':False,'grants':False,'gates':['Independent manager review and official closure decision','Compile physical12.2 plus syntheticTT0DB; do not publish local12.8rcode','Root integration/publication/read-get-negative PASOE proof','Fresh current source export and additive metadata1056; actual auth in memory only'],'files':files};write(F/'manifest.json',manifest)
print(json.dumps({'manifest':str(F/'manifest.json'),'sha256':sha((F/'manifest.json').read_bytes()),'pins':len(files),'shared':len(shared),'newAbl':len(new)}))
