"""Fresh build12-v2: close local OO compile dependencies; no network or business."""
from pathlib import Path
import hashlib,json,re

W=Path('D:/opencode/conversao-sc'); R=W/'.runtime/ciw-completion-20261028'
OLD=R/'official-build12'; B=R/'official-build12-v2'; P=B/'package'
M=Path('D:/opencode/motor-progress/v2')
REMOTE='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build12-v2'
def sha(p): return hashlib.sha256(p.read_bytes()).hexdigest()
def load(p): return json.loads(p.read_text(encoding='utf-8-sig'))
def out(p,d):
 p.parent.mkdir(parents=True,exist_ok=True);p.write_text(json.dumps(d,ensure_ascii=False,indent=2)+'\n',encoding='utf8')
def cp(a,b): b.parent.mkdir(parents=True,exist_ok=True);b.write_bytes(a.read_bytes())
def text(p):
 try:return p.read_bytes().decode('utf-8-sig')
 except UnicodeDecodeError:return p.read_bytes().decode('latin1')
def no_strings_or_comments(t):
 # Preserve token boundaries; nested ABL comments and tilde-escaped strings.
 result=[];i=0;depth=0;quote=None
 while i<len(t):
  if depth:
   if t[i:i+2]=='/*':depth+=1;i+=2
   elif t[i:i+2]=='*/':depth-=1;i+=2
   else:i+=1
   result.append(' ');continue
  if quote:
   if t[i]=='~':i+=2
   elif t[i]==quote:quote=None;i+=1
   else:i+=1
   result.append(' ');continue
  if t[i:i+2]=='/*':depth=1;i+=2;result.append(' ');continue
  if t[i] in ['"',"'"]:quote=t[i];i+=1;result.append(' ');continue
  result.append(t[i]);i+=1
 return ''.join(result)

assert not B.exists(),'Fresh stage only; never regenerate a delivered stage'
assert sha(OLD/'release.json')=='58f1c908f64d2b854d0aff158df32f2de85bf0797f19b0a27823d1c3f2cc91a4'
for row in load(OLD/'release.json')['files']:assert sha(OLD/row['path'])==row['sha256'],row['path']
old=load(OLD/'build-manifest.json')
assert len(old['compileEntries'])==40 and old['checks']==5704
for row in old['canonicalIntegrationFiles']:assert sha(Path(row['target']))==row['baselineSha256'],row['target']
for row in old['includes']:assert sha(Path(row['canonicalPath']))==row['sha256'],row['relative']

# Preserve all package bytes except the three fresh-path harness files.
for p in (OLD/'package').rglob('*'):
 if p.is_file():cp(p,P/p.relative_to(OLD/'package'))
for tree in ['backend-stage','php-tests','test-inputs','relations-state','metadata','local']:
 for p in (OLD/tree).rglob('*'):
  if not p.is_file():continue
  dst=B/tree/p.relative_to(OLD/tree);dst.parent.mkdir(parents=True,exist_ok=True)
  data=p.read_bytes()
  if tree in ['php-tests','test-inputs','relations-state'] and p.suffix=='.php':data=data.replace(OLD.as_posix().encode(),B.as_posix().encode())
  dst.write_bytes(data)
for name in ['php-bootstrap.php','phpunit.xml','native-pages.cjs']:
 data=(OLD/name).read_bytes().replace(OLD.as_posix().encode(),B.as_posix().encode()).replace(b'Official12FullStage',b'Official12V2FullStage')
 (B/name).write_bytes(data)
for name in ['native-preview.json','native-calls.json','php-source-manifest.json','canonical-test-manifest.json','integration-plan.json']:
 cp(OLD/name,B/name)

# Index the real local class declarations, then traverse every stage source and
# every newly discovered include/class. Built-in namespaces stay in OE/Net.pl.
index={};indexed=[]
for p in sorted((M/'sursum-api').rglob('*.cls')):
 match=re.search(r'(?im)^\s*(?:abstract\s+|final\s+)?class\s+([A-Za-z0-9_.]+)',no_strings_or_comments(text(p)))
 if not match:continue
 name=match.group(1);index.setdefault(name.split('.')[-1].lower(),[]).append(p)
 indexed.append({'class':name,'relative':p.relative_to(M).as_posix(),'sha256':sha(p)})
todo=sorted(p for p in P.rglob('*')if p.suffix.lower()in ['.p','.i','.cls'])
visited=set();edges=[];classes={};includes={};imports=set()
while todo:
 src=todo.pop(0);rel=src.relative_to(P).as_posix()
 if rel in visited:continue
 visited.add(rel);raw=text(src);code=no_strings_or_comments(raw)
 for imp in re.findall(r'(?im)^\s*USING\s+([A-Za-z0-9_.*]+)\s*\.',code):imports.add(imp)
 for inc in re.findall(r'\{\s*([A-Za-z0-9_./\\-]+\.(?:i|p))(?=\s|\})',code,re.I):
  inc=inc.replace('\\','/');dst=P/inc
  if not dst.is_file():
   actual=M/inc;assert actual.is_file(),('unresolved-include',rel,inc);cp(actual,dst)
  actual=M/inc
  if actual.is_file():
   candidate=next((x for x in old['canonicalIntegrationFiles']if x['relative']==inc),None)
   assert sha(dst)==(candidate['candidateSha256']if candidate else sha(actual)),('include-baseline-diff',inc)
   includes[inc]={'relative':inc,'canonicalPath':str(actual),'baselineSha256':sha(actual),'stageSha256':sha(dst),'candidateOverlay':candidate is not None}
  edges.append({'from':rel,'kind':'include','to':inc});todo.append(dst)
 for name,paths in index.items():
  if not re.search(r'(?i)(?<![A-Za-z0-9_])'+re.escape(name)+r'(?![A-Za-z0-9_])',code):continue
  assert len(paths)==1,('ambiguous-local-class',rel,name)
  actual=paths[0];cl=actual.relative_to(M).as_posix();dst=P/cl
  if not dst.is_file():cp(actual,dst)
  assert sha(dst)==sha(actual)
  classes[cl]={'relative':cl,'canonicalPath':str(actual),'sha256':sha(actual)}
  if cl!=rel:edges.append({'from':rel,'kind':'local-class','to':cl})
  todo.append(dst)
assert set(classes)=={'sursum-api/sursum/PasoeRuntimeIdentity.cls','sursum-api/sursum/PasoeExecutionContext.cls'}
assert all(i.startswith(('Progress.','OpenEdge.Net.'))for i in imports),imports
class_entries=['sursum-api/sursum/PasoeRuntimeIdentity.cls','sursum-api/sursum/PasoeExecutionContext.cls']
entries=class_entries+old['compileEntries'];assert len(entries)==42
for name in ['Compile.p','Regression.p','compile122.ps1']:
 data=(P/name).read_bytes().replace(b'20261028-build12',b'20261028-build12-v2')
 if name=='Compile.p':
  data,n=re.subn(br'INITIAL "[^"]+"',('INITIAL "'+','.join(entries)+'"').encode(),data,count=1);assert n==1
 if name=='compile122.ps1':data=data.replace(b'40 compiles',b'42 compiles')
 (P/name).write_bytes(data)

uploads=[{'local':str(p.relative_to(W)),'remote':REMOTE+'/'+p.relative_to(P).as_posix()}for p in sorted(P.rglob('*'))if p.is_file()]
dirs={REMOTE}
for u in uploads:
 parent=u['remote'].rsplit('/',1)[0]
 while len(parent)>len(REMOTE):dirs.add(parent);parent=parent.rsplit('/',1)[0]
oldplan=load(OLD/'remote-plan.json')
downloads=[{'remote':x['remote'].replace('20261028-build12','20261028-build12-v2'),'local':x['local'].replace('official-build12','official-build12-v2'),'optional':True}for x in oldplan['downloads']]
for cl in class_entries:
 rcode=str(Path(cl).with_suffix('.r')).replace('\\','/')
 downloads.append({'remote':REMOTE+'/'+rcode,'local':str((B/'compiled122'/rcode).relative_to(W)),'optional':True})
assert len(uploads)==73 and len(downloads)==118
out(B/'remote-plan.json',{'server':'compiler','directories':sorted(dirs),'uploads':uploads,'commands':['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+REMOTE+'/compile122.ps1'],'downloads':downloads})
out(B/'source-manifest.json',[{'file':u['local'],'remote':u['remote'],'sha256':sha(W/u['local'])}for u in uploads])
closure=load(OLD/'closure-manifest.json')
closure.update({'localClassIndex':indexed,'externalImports':sorted(imports),'scannedStageSources':sorted(visited),'compileDependencyEdges':edges,'localClassSources':list(classes.values()),'allLocalClassReferencesResolved':True,'allLiteralIncludesResolved':True,'additionalExplicitCompileEntries':class_entries,'noProductSourceChanges':True,'originFailureLogSha256':sha(OLD/'failure-recovery/compile.log'),'cause':'Previous prepare traversal scanned .i includes but omitted local .cls references in includes. ContainerApiIdentity.i:27 requires PasoeExecutionContext; its transitive local dependency is PasoeRuntimeIdentity. Existing PROPATH already contains sursum-api/sursum; no source import or product change needed.'})
out(B/'closure-manifest.json',closure)
proof=[]
for p in sorted((OLD/'package').rglob('*')):
 if not p.is_file():continue
 rel=p.relative_to(OLD/'package').as_posix();changed=rel in ['Compile.p','Regression.p','compile122.ps1']
 assert changed or sha(p)==sha(P/rel),rel
 proof.append({'relative':rel,'oldSha256':sha(p),'newSha256':sha(P/rel),'harnessPathChange':changed})
for row in old['canonicalIntegrationFiles']:
 stage=B/'backend-stage/backend/src/Runtime'/Path(row['relative']).name if row['relative'].startswith('php/')else P/row['relative']
 assert sha(stage)==row['candidateSha256'],row['relative']
out(B/'delta-proof.json',{'oldReleaseSha256':sha(OLD/'release.json'),'oldBuildManifestSha256':sha(OLD/'build-manifest.json'),'fiveProductsByteIdentical':True,'oldPackageFiles':proof,'onlyNewPackageFiles':class_entries,'phpSourcesByteIdentical':all(sha(p)==sha(OLD/'backend-stage'/p.relative_to(B/'backend-stage'))for p in (B/'backend-stage').rglob('*')if p.is_file()),'businessExecuted':False,'networkExecuted':False})
manifest=dict(old);manifest.update({'state':'PREPARED_OFFLINE_REVIEW_PENDING','predecessorReleaseSha256':sha(OLD/'release.json'),'compileEntries':entries,'sourceFiles':len(uploads),'localClassSources':list(classes.values()),'compileDependencyManifestSha256':sha(B/'closure-manifest.json'),'remotePlanSha256':sha(B/'remote-plan.json'),'sourceManifestSha256':sha(B/'source-manifest.json'),'integrationPlanSha256':sha(B/'integration-plan.json'),'expectedCompileCount':42,'uploads':73,'downloads':118,'fiveProductsByteIdentical':True})
out(B/'build-manifest.json',manifest)
verify=(OLD/'verify.py').read_bytes().replace(b'==40',b'==42').replace(b'==71',b'==73').replace(b'==116',b'==118').replace(b"'compiles':40",b"'compiles':42").replace(b"'uploads':71",b"'uploads':73").replace(b"'downloads':116",b"'downloads':118")
verify=verify.replace(b"for row in m['includes']:",b"for row in m['localClassSources']:assert sha(Path(row['canonicalPath']))==row['sha256'] and sha(B/'package'/row['relative'])==row['sha256']\nfor row in m['includes']:")
(B/'verify.py').write_bytes(verify)
cp(Path(__file__),B/'prepare.py');out(B/'preparer.json',{'path':str(Path(__file__)),'sha256':sha(Path(__file__)),'copySha256':sha(B/'prepare.py'),'executedOnlyOfflinePreparation':True})
print(json.dumps({'prepared':str(B),'uploads':73,'compiles':42,'testLogs':28,'checks':5704,'downloads':118,'classes':class_entries,'productsIdentical':5,'networkExecuted':False}))
