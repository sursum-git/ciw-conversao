from pathlib import Path
import hashlib,json,shutil
P=Path(__file__).resolve().parents[1];W=Path('D:/opencode/conversao-sc')
S=W/'.runtime/ciw-completion-20261028/container-nf-available-readonly-pagination/v1'
F=P/'frozen-v1';R=S/'frozen-v1';assert not F.exists() and not R.exists(),'immutable freeze already exists'
proof=json.loads((S/'verification.json').read_text());assert proof['success'] and proof['ablChecksTotal']==5704 and proof['phpTests']==990 and proof['phpAssertions']==7119
plan=json.loads((P/'patches/patch-plan.json').read_text())
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
def cp(a,b):b.parent.mkdir(parents=True,exist_ok=True);b.write_bytes(a.read_bytes())
source=[]
for file in sorted(P.rglob('*')):
 if not file.is_file() or '__pycache__'in file.parts:continue
 rel=file.relative_to(P);cp(file,F/rel);source.append({'path':rel.as_posix(),'sha256':sha(file)})
for patch in plan['textPatches']:
 rel=patch['relative'];assert sha(S/'candidates'/rel)==patch['candidateSha256'];cp(S/'candidates'/rel,R/'candidates'/rel)
 base=S/('baseline11'if(S/'baseline11'/rel).exists()else'baseline')/rel;assert sha(base)==patch['baselineSha256'];cp(base,R/'baseline'/rel)
for file in (S/'local').rglob('*'):
 if file.is_file() and file.suffix in ['.p','.i','.json']:cp(file,R/'testinputs'/file.relative_to(S/'local'))
for file in S.glob('*.json'):cp(file,R/'evidence'/file.name)
for file in S.glob('*.xml'):cp(file,R/'evidence'/file.name)
for file in S.glob('*red.log'):cp(file,R/'evidence'/file.name)
for file in (S/'local').glob('*.log'):cp(file,R/'evidence/abl'/file.name)
for file in (S/'full-stage').rglob('*'):
 if file.is_file():cp(file,R/'full-stage'/file.relative_to(S/'full-stage'))
# Pin canonical test inputs too; future test edits must not alter this receipt.
tests=Path('D:/opencode/construtor-pg/backend/tests')
for file in tests.rglob('*'):
 if file.is_file():cp(file,R/'testinputs/canonical-php-tests'/file.relative_to(tests))
runtime=[{'path':file.relative_to(R).as_posix(),'sha256':sha(file)}for file in sorted(R.rglob('*'))if file.is_file()]
candidates=[{'relative':x['relative'],'baselineSha256':x['baselineSha256'],'candidateSha256':x['candidateSha256'],'hunks':len(x['changes']),'frozenCandidatePath':str(R/'candidates'/x['relative'])}for x in plan['textPatches']]
manifest={'status':'CANDIDATE_READY_LOCAL_FROZEN_ROOT_REVIEW_PENDING','domain':'container-nf-available-readonly-pagination','programCode':'op1053','resource':'nfs-disponiveis','internalReadResource':'container_nfs_disponiveis','scope':'MED readonly server paging of bounded complete selection; no writes/export-allRows','runtimeRoot':str(R),'sourceFiles':source,'runtimeFiles':runtime,'candidates':candidates,'proof':proof,'gates':{'rootIndependentReview':False,'official122':False,'canonicalIntegration':False,'runtimePublished':False,'fiveContainerPagedPasoeProof':False,'metadataReady':False,'newAccess':False},'preservePredecessorFreezes':True,'rootOnlyNetworkAndPublication':True}
(F/'manifest.json').write_text(json.dumps(manifest,ensure_ascii=False,indent=2)+'\n',encoding='utf8')
(S/'freeze-seal.json').write_text(json.dumps({'manifestPath':str(F/'manifest.json'),'sha256':sha(F/'manifest.json'),'sourceFiles':len(source),'runtimeFiles':len(runtime)},indent=2)+'\n',encoding='utf8')
print(json.dumps({'candidateReady':True,'manifestSha256':sha(F/'manifest.json'),'sourceFiles':len(source),'runtimeFiles':len(runtime),'productionFiles':len(candidates),'official122':False,'published':False}))
