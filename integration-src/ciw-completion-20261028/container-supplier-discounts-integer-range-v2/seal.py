from pathlib import Path
import json,hashlib,base64,difflib,xml.etree.ElementTree as ET,datetime
D=Path(__file__).resolve().parent;W=D.parents[2];R=W/'.runtime/ciw-completion-20261028/container-supplier-discounts-integer-range-v2';F=D/'frozen-v1'
assert not F.exists(),'Immutable freeze already exists'
sha=lambda b:hashlib.sha256(b).hexdigest()
write=lambda p,v:p.write_text(json.dumps(v,indent=2,ensure_ascii=False)+'\n',encoding='utf-8')
baselines=json.loads((D/'baselines.json').read_text())
parent=Path(baselines['predecessorManifest']);assert sha(parent.read_bytes())==baselines['predecessorManifestSha256']
original=json.loads(parent.read_text())
for row in original['files']:assert sha(Path(row['path']).read_bytes())==row['sha256'],row['path']
supplier=D.parent/'supplier-discounts-readonly/frozen-v1/manifest.json';assert sha(supplier.read_bytes())=='ad6ae7a988a532c1e3d9adab252e7e408afdeec1367173dccee6887b7361470c'
for row in json.loads(supplier.read_text())['files']:
 p=Path(row['path']);p=p if p.is_absolute() else supplier.parent/p
 assert sha(p.read_bytes())==row['sha256'],str(p)
# Documentation is a future additive patch after filterOnly, preserving CP1252 bytes.
doc='docs/paridade-demo-producao.md';docBase=parent.parent.parent/'candidate'/doc
for tree in ['baseline','candidate']:(D/tree/'docs').mkdir(exist_ok=True)
before=docBase.read_bytes();(D/'baseline'/doc).write_bytes(before)
row='\r\n| 2026-10-29 | Contexto integerRange readonly nativo; uso preparado1056 | examples/supplier-discounts-integer-range.json e cinco fontes nativas | Perfil generico readonlyCRUD/naoPK, sem opcoes remotas/arquivos/processo; Engine e helperprivado reutilizados; sem mock/frontendparalelo | preparado | Compor filterOnly + helper1056 e rebasear Action/Query13 por hunks; validar runtime real antes publicar | 31testes nativos/AJV/prototipos e FULL903/6005;278Appstage; exemplos0/-9/MIN sinteticos, sem afirmar linhas reais/DOM publicado. Skill local de paridade indisponivel, checklist seguido |\r\n'
(D/'candidate'/doc).write_bytes(before+row.encode('cp1252'))
def patch(rel,role):
 before=(D/'baseline'/rel).read_bytes();after=(D/'candidate'/rel).read_bytes();assert before!=after
 a=before.splitlines(keepends=True);b=after.splitlines(keepends=True);ao=[0];bo=[0]
 for v in a:ao.append(ao[-1]+len(v))
 for v in b:bo.append(bo[-1]+len(v))
 hunks=[];same=[]
 for tag,i,j,x,y in difflib.SequenceMatcher(None,a,b,autojunk=False).get_opcodes():
  if tag=='equal':same.append({'baselineStart':ao[i],'baselineEnd':ao[j],'candidateStart':bo[x],'candidateEnd':bo[y],'sha256':sha(before[ao[i]:ao[j]])})
  else:hunks.append({'baselineStart':ao[i],'baselineEnd':ao[j],'candidateStart':bo[x],'candidateEnd':bo[y],'beforeBase64':base64.b64encode(before[ao[i]:ao[j]]).decode(),'afterBase64':base64.b64encode(after[bo[x]:bo[y]]).decode()})
 stem=Path(rel).name;path=D/'patches'/(stem+'.bytepatch.json');path.parent.mkdir(exist_ok=True)
 value={'relative':rel,'role':role,'baselineSha256':sha(before),'candidateSha256':sha(after),'hunks':hunks,'unchangedRanges':same,'applyOnlyByExactBaseline':True}
 write(path,value)
 (D/'patches'/(stem+'.patch')).write_bytes(b''.join(difflib.diff_bytes(difflib.unified_diff,a,b,fromfile=('a/'+rel).encode(),tofile=('b/'+rel).encode())))
 return {'relative':rel,'role':role,'baselineSha256':sha(before),'candidateSha256':sha(after),'hunks':len(hunks),'bytePatch':str(path.relative_to(D)).replace('\\','/'),'roundTripExact':True}
shared=[]
for row in baselines['files']:
 rel=row['relative'];assert sha((D/'baseline'/rel).read_bytes())==row['baselineSha256']
 if (D/'baseline'/rel).read_bytes()!=(D/'candidate'/rel).read_bytes():shared.append(patch(rel,'private1056-helper' if 'RuntimeImportDiscountRead' in rel else 'generic-native-capability'))
assert len(shared)==6
docs=[patch(doc,'parity-documentation')]
full=ET.parse(R/'final-local-v1/php-full.xml').getroot()
cases=list(full.iter('testcase'))
tests=len(cases);assertions=sum(int(x.attrib.get('assertions',0))for x in cases)
assert (tests,assertions)==(903,6005)
assert not list(full.iter('error')) and not list(full.iter('failure'))
assert full.find('testsuite').attrib['tests']=='903' and full.find('testsuite').attrib['assertions']=='6005'
loader=json.loads((R/'final-local-v1/php-stage-loader-proof.json').read_text());assert loader['success'] and loader['loadedAppDefinitions']==278 and loader['outsideStage']==[]
stage=json.loads((R/'final-local-v1/php-stage-manifest.json').read_text());assert stage['srcCurrent13'] and len(stage['files'])==410 and stage['old1056ActionQueryOverlay'] is False
log=(R/'final-local-v1/native-final.log').read_text(encoding='utf-8');assert 'tests 31' in log and 'fail 0' in log
assert (D/'examples/supplier-discounts-integer-range.json').read_bytes()==(R/'final-local-v1/generated/op1056-candidate.json').read_bytes()
inputs=[]
for path in ['D:/opencode/construtor-pg/backend/src/Runtime/ApiRequestContext.php','D:/opencode/construtor-pg/src/process-engine/ProcessEngine.js','D:/opencode/construtor-pg/public/metadata/schemas/process-definition-v1.schema.json']:
 p=Path(path);inputs.append({'path':path,'sha256':sha(p.read_bytes()),'proposalChanges':False})
write(D/'evidence.json',{'success':True,'predecessor518PinsIntact':len(original['files'])==518,'supplierFreezePinsIntact':True,'unchangedInputs':inputs,'sourceProofSha256':sha((supplier.parent/'SOURCE_PROOF.json').read_bytes()),'causalProofSha256':sha((R/'causal-comparison.json').read_bytes()),'current13SrcManifestSha256':stage['canonicalManifestSha256'],'fullPhp':{'tests':tests,'assertions':assertions,'stagedSources':410,'loadedApp':278},'nativeTests':31,'exampleByteExact':True,'routing1056IntegrationProven':False,'networkExecuted':False,'businessWrites':False})
files=[]
for root in [D,R]:
 for p in sorted(root.rglob('*')):
  if not p.is_file() or F in p.parents or '__pycache__' in p.parts:continue
  files.append({'path':str(p.resolve()),'sha256':sha(p.read_bytes()),'bytes':p.stat().st_size})
F.mkdir()
manifest={'success':True,'state':'CANDIDATE_READY_LOCAL_GREEN_ROOT_REVIEW_REQUIRED','createdAtUtc':datetime.datetime.now(datetime.timezone.utc).isoformat(),'scope':'Generic native readonly CRUD integerRange plus isolated supplier1056 read-selection helper; no Grid/Form/Process/API generic changes','predecessorManifestSha256':sha(parent.read_bytes()),'supplierFreezeManifestSha256':sha(supplier.read_bytes()),'sharedFiles':shared,'documentationFiles':docs,'tests':{'php':903,'assertions':6005,'stagedSources':410,'loadedAppStaged':278,'native':31,'redPreserved':True},'gates':['Compose only on exact FUTURE filterOnly/1056 helper baselines; never apply directly to canonical205/13','1056 Action/Query integration must be rebased by hunks on current13 after review; no routing proof claimed','Runtime/native permissions/publication and actual signed-supplier corpus remain root validation; no grants or business authorized here'],'networkExecuted':False,'canonicalWrites':False,'businessWrites':False,'metadataWrites':False,'genericApiContextChanged':False,'gridFormProcessChanged':False,'files':files}
write(F/'manifest.json',manifest)
print(json.dumps({'manifest':str(F/'manifest.json'),'sha256':sha((F/'manifest.json').read_bytes()),'pins':len(files),'sharedPatches':len(shared),'documentationPatches':len(docs)}))
