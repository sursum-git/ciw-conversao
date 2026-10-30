from pathlib import Path
import json,hashlib,base64,difflib,datetime,xml.etree.ElementTree as ET
D=Path(__file__).resolve().parent;W=D.parents[2];R=W/'.runtime/ciw-completion-20261028/container-item-navigation-filter-only';FINAL=R/'final-local-v1';F=D/'frozen-v1'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert not F.exists(),'Freeze already exists; never reseal'
baselines=json.loads((D/'baselines.json').read_text());P=D/'patches';P.mkdir(exist_ok=True);changes=[]
for row in baselines['files']:
 rel=row['relative'];before=(D/'baseline'/rel).read_bytes();after=(D/'candidate'/rel).read_bytes();assert sha(Path(row['canonical']))==row['baselineSha256'];assert hashlib.sha256(before).hexdigest()==row['baselineSha256']
 oldlines=before.splitlines(keepends=True);newlines=after.splitlines(keepends=True);oldoffset=[0];newoffset=[0]
 for line in oldlines:oldoffset.append(oldoffset[-1]+len(line))
 for line in newlines:newoffset.append(newoffset[-1]+len(line))
 edits=[];same=[]
 for tag,a,b,c,e in difflib.SequenceMatcher(None,oldlines,newlines,autojunk=False).get_opcodes():
  x,y=oldoffset[a],oldoffset[b];u,v=newoffset[c],newoffset[e]
  if tag=='equal':assert before[x:y]==after[u:v];same.append({'baselineStart':x,'candidateStart':u,'bytes':y-x,'sha256':hashlib.sha256(before[x:y]).hexdigest()})
  else:edits.append({'start':x,'end':y,'beforeBase64':base64.b64encode(before[x:y]).decode(),'afterBase64':base64.b64encode(after[u:v]).decode()})
 rebuilt=before
 for edit in reversed(edits):assert rebuilt[edit['start']:edit['end']]==base64.b64decode(edit['beforeBase64']);rebuilt=rebuilt[:edit['start']]+base64.b64decode(edit['afterBase64'])+rebuilt[edit['end']:]
 assert rebuilt==after
 delta={'canonical':row['canonical'],'relative':rel,'baselineSha256':row['baselineSha256'],'candidateSha256':hashlib.sha256(after).hexdigest(),'edits':edits,'unchangedByteRanges':same,'roundTripExact':True,'role':row.get('role','native-runtime-capability')};stem=rel.replace('/','__');(P/(stem+'.bytepatch.json')).write_text(json.dumps(delta,indent=2)+'\n');patch=b''.join(difflib.diff_bytes(difflib.unified_diff,oldlines,newlines,fromfile=('baseline/'+rel).encode(),tofile=('candidate/'+rel).encode()));(P/(stem+'.patch')).write_bytes(patch);changes.append({k:v for k,v in delta.items()if k not in ['edits','unchangedByteRanges']})
root=ET.parse(FINAL/'php-full.xml').getroot();cases=list(root.iter('testcase'));assert len(cases)==892;assert sum(int(x.attrib['assertions'])for x in cases)==5916;assert not list(root.iter('failure'))and not list(root.iter('error'))
loader=json.loads((FINAL/'php-stage-loader-proof.json').read_text());assert loader['success']and loader['loadedAppDefinitions']==277 and loader['outsideStage']==[]
assert 'tests 22' in (FINAL/'native.log').read_text(encoding='utf-8') and 'fail 0' in (FINAL/'native.log').read_text(encoding='utf-8')
assert (D/'examples/ciw-container-itens-filter-only.json').read_bytes()==(FINAL/'generated/op1002-candidate.json').read_bytes()
unchanged=[Path('D:/opencode/construtor-pg/backend/src/Runtime/ApiRequestContext.php'),Path('D:/opencode/construtor-pg/backend/src/Runtime/RuntimePurchaseItemAudit.php')]
expected=['8f788e9627204786fba769c083d2845fe1ff5bdd4561607727fb853e95b23918','7469b045e0219b9a7de69d317b28e98c8863278e59845fbd8b6a49a97b9497fd'];assert [sha(p)for p in unchanged]==expected
stage=json.loads((R/'php-stage-manifest.json').read_text());assert len(stage['files'])==409;assert sum(bool(x['candidate'])for x in stage['files'])==1
for x in stage['files']:assert sha(Path(x['staged']))==x['stagedSha256']
paths=[p for p in D.rglob('*')if p.is_file()and 'frozen-v1'not in p.parts]
paths += [p for p in R.rglob('*')if p.is_file()and p.suffix not in ['.r','.pyc']]
exportProof=W/'.runtime/ciw-completion-20261028/container-item-action-native/current/export-proof.json';assert sha(exportProof)==baselines['exportsProofSha256'];paths.append(exportProof)
for x in json.loads(exportProof.read_text())['files']:assert sha(Path(x['path']))==x['sha256'];paths.append(Path(x['path']))
paths+=unchanged
files=[{'path':str(p.resolve()),'sha256':sha(p)}for p in sorted(set(paths),key=lambda x:str(x).lower())]
manifest={'success':True,'state':'CANDIDATE_READY_LOCAL_GREEN_ROOT_REVIEW_REQUIRED','createdAtUtc':datetime.datetime.now(datetime.timezone.utc).isoformat(),'scope':'Native CRUD filterOnly navigation for existing1008/1002/1014; no API ABI/audit relaxation','baselineExportProofSha256':baselines['exportsProofSha256'],'sharedFiles':changes,'sourceFiles':6,'documentationFiles':1,'tests':{'fullPhpTests':892,'fullPhpAssertions':5916,'loadedAppDefinitions':277,'allLoadedAppStaged':True,'phpStagedSourceFiles':409,'nativePrototypeAndAjvTests':22,'runtimeBoundaryTests':2,'runtimeBoundaryAssertions':19},'metadata':{'programs':['op1008','op1002','op1014'],'wholeCompared':True,'ignoredPaths':[],'wholeDeltaCounts':{'op1008':3,'op1002':3,'op1014':12},'extraRegeneration205Deltas':10,'extraDecimalFields':['vl_custo_dolar','vl_negociado','qt_comprada','qt_alocada','qt_saldo'],'rootFreshWholePreviewRequired':True,'rootExplicitExtraDeltaReviewRequired':True},'providedEmptyFilterOnlyRejected':True,'externalApiContextUnchanged':'parent-only','permissionsChanged':False,'sourceOperationsChanged':False,'businessWrites':False,'networkExecuted':False,'canonicalWrites':False,'grants':False,'ddl':False,'oldFreezesTouched':False,'limits':['No published screen/LDAP/DOM/business proof claimed','Export existing take>=1000 may fail ERP200; fixed PK retained; no new export guarantee','USD/BRL, visibility and descriptions remain separate','Root must rebase by exact current hashes, integrate and publish after review'],'files':files}
F.mkdir();file=F/'manifest.json';file.write_text(json.dumps(manifest,ensure_ascii=False,indent=2)+'\n',encoding='utf-8');print(json.dumps({'manifest':str(file),'sha256':sha(file),'pins':len(files),'sharedFiles':len(changes),'php':[892,5916],'native':22}))
