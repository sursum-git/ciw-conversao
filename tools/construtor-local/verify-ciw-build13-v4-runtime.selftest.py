"""Offline independent-process determinism and unchanged-vendor guards only."""
from pathlib import Path
import ast,datetime,hashlib,importlib.util,json,os,subprocess,sys
W=Path(__file__).resolve().parents[2];R=W/'.runtime/ciw-completion-20261028';D=R/'runtime-build13-v4';Q=D/'review'
assert not Q.exists(),'Preserve previous review receipts';Q.mkdir(parents=True)
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
def module(p):
 s=importlib.util.spec_from_file_location(p.stem,p);m=importlib.util.module_from_spec(s);s.loader.exec_module(m);return m
def generated(tool,seed):
 code="import importlib.util,sys; p=sys.argv[1];s=importlib.util.spec_from_file_location('r',p);m=importlib.util.module_from_spec(s);s.loader.exec_module(m);sys.stdout.buffer.write(m.publisher_script().encode())"
 env=os.environ.copy();env['PYTHONHASHSEED']=str(seed)
 p=subprocess.run([sys.executable,'-c',code,str(tool)],cwd=W,env=env,stdout=subprocess.PIPE,stderr=subprocess.PIPE,timeout=20)
 assert p.returncode==0,p.stderr.decode(errors='replace');return p.stdout
old=W/'tools/construtor-local/prepare-ciw-build13-v3-runtime.py';new=W/'tools/construtor-local/prepare-ciw-build13-v4-runtime.py'
snapshot=[old,R/'runtime-build13-v3/inspect-runtime.py',R/'runtime-build13-v3/publish-runtime.review-candidate.py']
snapshot=[p for p in snapshot if p.is_file()]
for n in ['publish-runtime.py','publication-manifest.json','publish-plan.json']:
 p=R/'runtime-build13-v3'/n
 if p.is_file():snapshot.append(p)
before={str(p.relative_to(W)):sha(p)for p in snapshot}
oldvalues=[generated(old,x)for x in [1,2]];oldhashes=[hashlib.sha256(x).hexdigest()for x in oldvalues]
assert oldhashes[0]!=oldhashes[1],'Expected reproduction of v3 set repr instability'
values=[generated(new,x)for x in [1,2]];digests=[hashlib.sha256(x).hexdigest()for x in values]
assert values[0]==values[1]and digests[0]==digests[1]
(D/'publish-runtime.review-candidate.py').write_bytes(values[0])
r=module(new);tree=ast.parse(values[0]);checks=['v3REDtwoHashSeedsDiffer','v4GREENtwoHashSeedsByteEqual']
expected=next(n.value for n in tree.body if isinstance(n,ast.Assign)and isinstance(n.targets[0],ast.Name)and n.targets[0].id=='expected')
assert isinstance(expected,ast.Call)and isinstance(expected.func,ast.Name)and expected.func.id=='set'and len(expected.args)==1
items=ast.literal_eval(expected.args[0]);assert items==sorted(r.rels())and len(items)==17;checks.append('expectedLiteralSorted17Closed')
newtext=new.read_text();oldtext=old.read_text()
changes=[("D=R/'runtime-build13-v3'","D=R/'runtime-build13-v4'"),("REMOTE='/tmp/ciw-completion-20261028-build13-v3'","REMOTE='/tmp/ciw-completion-20261028-build13-v4'"),("'expected='+repr(set(rels()))","'expected=set('+repr(sorted(rels()))+')'"),('completion-build13-v3','completion-build13-v4')]
for a,b in changes:assert a in oldtext;oldtext=oldtext.replace(a,b)
assert newtext==oldtext;checks.append('toolOnlyFreshPathsAndSortedExpected')
assert "B=R/'official-build13-v3'"in newtext and "C=R/'build13-root-companions-v3'"in newtext;checks.append('officialCanonicalReferencesRemainV3')
assert len(r.rels())==17 and len(r.baselines()[0])==17 and sum(v is None for v in r.baselines()[0].values())==9;checks.append('8Attested9AbsentNoBaselineRelaxation')
assert all(x in values[0].decode()for x in ["0<=age<=600","proof['compileCount']==69","proof['testLogs']==88","proof['totalChecks']==8020","proof['downloadCount']==269","proof['numDbsCompile']==1","proof['numDbsTests']==0"]);checks.append('allOfficialAnd600SecondGatesPreserved')
assert not any((D/n).exists()for n in ['publication-manifest.json','publish-plan.json','publish-runtime.py','runtime-before.json','publication-attempt.json']);checks.append('noActualPublicationOrInspectionReceiptFabricated')
assert before=={str(p.relative_to(W)):sha(p)for p in snapshot};checks.append('v3ArtifactsUnchanged')
for p in [new,D/'inspect-runtime.py',D/'publish-runtime.review-candidate.py']:ast.parse(p.read_bytes())
checks.append('threePythonArtifactsParse')
proof=dict(success=True,state='OFFLINE_ONLY',checks=len(checks),cases=checks,oldHashSeed1=oldhashes[0],oldHashSeed2=oldhashes[1],newHashSeed1=digests[0],newHashSeed2=digests[1],newToolSha256=sha(new),oldArtifactsUnchanged=before,networkExecuted=False,canonicalWrites=False,AvmExecuted=False,publicationGenerated=False)
(Q/'selftest-proof.json').write_text(json.dumps(proof,indent=2)+'\n',encoding='utf8')
print(json.dumps(dict(success=True,checks=len(checks),oldRedHashes=oldhashes,newIdenticalHashes=digests)))
