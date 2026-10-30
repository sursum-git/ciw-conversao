"""Fresh harness-only retry. Does not run suites, AVM, SSH or canonical writes."""
from pathlib import Path
import ast,hashlib,json,shutil,subprocess,sys
W=Path(__file__).resolve().parents[2];R=W/'.runtime/ciw-completion-20261028'
OLD=R/'official-build13-v2';B=R/'official-build13-v3'
RELEASE='83299fdcaccc6df119e119d1f7698602ae49d515f02292de2ae5567cd5705c4c'
MANAGER='b17b8fb9a84945021d470f08fbef39c978fbadaa0078b37bddbb158fb2ad69be'
REM='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-v3'
DROP={'PasoeRuntimeIdentity.cls','PasoeExecutionContext.cls'}
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
def load(p):return json.loads(p.read_bytes())
def out(p,v):p.parent.mkdir(parents=True,exist_ok=True);p.write_bytes((json.dumps(v,ensure_ascii=False,indent=2)+'\n').encode())
assert not B.exists(),'Fresh stage only'
assert sha(OLD/'release.json')==RELEASE and sha(OLD/'manager-release.json')==MANAGER
oldrelease=load(OLD/'release.json')
for x in oldrelease['files']:assert sha(OLD/x['path'])==x['sha256'],x['path']
failure=R/'official-build13-v2-failure-recovery'
log=(failure/'compile.log').read_text()
assert 'OpenEdge 12.2 NUM-DBS=1'in log and 'FAIL class source not resolved'in log and 'COMPILER:ERROR='not in log
assert load(failure/'terminal-state.json')['ttExecuted']is False
B.mkdir()
for x in oldrelease['files']:
 rel=Path(x['path'])
 if rel.as_posix()in {'package/'+n for n in DROP}:continue
 dst=B/rel;dst.parent.mkdir(parents=True,exist_ok=True);shutil.copyfile(OLD/rel,dst)
# No changed production source. Only three harnesses receive the fresh path.
changed=[]
for n in ['Compile.p','Regression.p','compile122.ps1']:
 p=B/'package'/n;old=p.read_bytes();new=old.replace(b'20261028-build13-v2',b'20261028-build13-v3')
 assert old!=new;p.write_bytes(new);changed.append(dict(path='package/'+n,before=sha(OLD/'package'/n),after=sha(p),change='fresh isolated path only'))
sources=[dict(relative=p.relative_to(B/'package').as_posix(),sha256=sha(p),bytes=p.stat().st_size)for p in sorted((B/'package').rglob('*'))if p.is_file()and p.name!='input-hashes.json']
out(B/'package/input-hashes.json',sources)
sources.append(dict(relative='input-hashes.json',sha256=sha(B/'package/input-hashes.json'),bytes=(B/'package/input-hashes.json').stat().st_size))
assert len(sources)==130;out(B/'source-manifest.json',sources)
plan=load(OLD/'remote-plan.json')
def paths(v):
 if isinstance(v,str):return v.replace('build13-v2','build13-v3')
 if isinstance(v,list):return[paths(x)for x in v]
 if isinstance(v,dict):return{k:paths(x)for k,x in v.items()}
 return v
plan=paths(plan)
plan['uploads']=[x for x in plan['uploads']if x['remote'].rsplit('/',1)[-1]not in DROP or '/sursum-api/sursum/'in x['remote']]
assert len(plan['uploads'])==130
by={x['relative']:x['sha256']for x in sources}
for x in plan['uploads']:x['sha256']=by[x['remote'][len(REM)+1:]]
plan['directories']=[REM,REM+'/sursum-api',REM+'/sursum-api/includes',REM+'/sursum-api/programs',REM+'/sursum-api/sursum']
for d in plan['directories'][1:]:assert str(Path(d).parent).replace('\\','/')in plan['directories']
assert len(plan['downloads'])==269
out(B/'remote-plan.json',plan)
integration=paths(load(OLD/'integration-plan.json'));out(B/'integration-plan.json',integration)
build=load(B/'build-manifest.json');assert len(build['compileEntries'])==69 and build['productionTargets']==17 and build['testSuites']==22 and build['expectedChecks']==8020
build['state']='HARNESS_ONLY_RETRY_LOCAL_PROOFS_REUSED';build['previousReleaseSha256']=RELEASE;out(B/'build-manifest.json',build)
for n in DROP:
 assert not(B/'package'/n).exists()
 assert sha(B/'package/sursum-api/sursum'/n)==sha(OLD/'package'/n)
# Offline focused RED/GREEN: fixed PROPATH candidate resolution, same guard.
def guard(package):
 classdir=package/'sursum-api/sursum';dirs=[package,package/'sursum-api/programs',package/'sursum-api/includes',classdir]
 return all(next((d/n for d in dirs if(d/n).is_file()),None)==classdir/n for n in sorted(DROP))
assert guard(OLD/'package')is False and guard(B/'package')is True
unchanged=[]
allowed={'Compile.p','Regression.p','compile122.ps1','input-hashes.json'}
for x in sources:
 rel=x['relative']
 if rel in allowed:continue
 assert sha(B/'package'/rel)==sha(OLD/'package'/rel)
 unchanged.append(dict(relative=rel,sha256=x['sha256']))
assert len(unchanged)==126
assert load(B/'test-list.json')==load(OLD/'test-list.json')and load(B/'runtime-targets.json')==load(OLD/'runtime-targets.json')
for x in integration['files']:assert sha(Path(x['source'])if Path(x['source']).is_absolute()else W/x['source'])==x['candidateSha256']
proof=dict(success=True,state='OFFLINE_FOCUSED_ONLY_NO_AVM',oldRootFirstGuard=False,newRootFirstGuard=True,removedRootCopies=sorted(DROP),nestedClassHashes={n:sha(B/'package/sursum-api/sursum'/n)for n in sorted(DROP)},unchangedPackageInputs=unchanged,harnessChanges=changed,previousReleaseSha256=RELEASE,previousManagerReleaseSha256=MANAGER,official13v2FailureEvidence=[dict(path=str(p.relative_to(W)),sha256=sha(p))for p in sorted(failure.iterdir())if p.is_file()],priorLocalProofsReused=dict(PHPtests=1005,PHPassertions=7903,AppStaged=278,TTchecks=8020,TTlogs=88,precisionDiagnosticChecks=112),noSuitesRerun=True,noAvmExecuted=True,noNetworkExecuted=True,noCanonicalWrites=True)
out(B/'harness-delta-proof.json',proof)
# Verifier remains read-only; old proof paths intentionally pinned as dependencies.
v=(OLD/'verify.py').read_bytes().replace(b'len(sources)==132',b'len(sources)==130').replace(b"'packageFiles':132",b"'packageFiles':130")
(B/'verify.py').write_bytes(v)
ast.parse(v)
(B/'REVIEW-v3.md').write_text('Harness-only13-v3: removidas somente duas classes redundantes da raiz; fontes reais e69entries/22TT/17targets preservados. Paths remotos novos e ancestor sursum-api explícito. Provas PHP1005/7903/278, TT8020/88 e precisão112 reutilizadas do release13-v2 pinado; nenhuma suíte/AVM repetida. Microprova é resolução estática determinística, não execução AVM.68212 falhou antes do primeiro COMPILE;8794 foi falha anterior de transporte.269downloads aguardam execução fresca12.2 pelo root. Não confundir preparação com compilação/publicação.\n',encoding='utf8')
shutil.copyfile(Path(__file__),B/'prepare-v3.py')
subprocess.run([sys.executable,str(B/'verify.py')],check=True)
release={k:v for k,v in oldrelease.items()if k!='files'}
release.update(state='FROZEN_HARNESS_ONLY_RETRY_MANAGER_REVIEW_REQUIRED',packageUploads=130,sourceManifestSha256=sha(B/'source-manifest.json'),remotePlanSha256=sha(B/'remote-plan.json'),buildManifestSha256=sha(B/'build-manifest.json'),integrationPlanSha256=sha(B/'integration-plan.json'),reviewSha256=sha(B/'REVIEW-v3.md'),previousReleaseSha256=RELEASE,previousManagerReleaseSha256=MANAGER,harnessDeltaProofSha256=sha(B/'harness-delta-proof.json'),newAvmExecuted=False,localProofsReused=True)
release['files']=[dict(path=p.relative_to(B).as_posix(),sha256=sha(p),bytes=p.stat().st_size)for p in sorted(B.rglob('*'))if p.is_file()]
out(B/'release.json',release)
subprocess.run([sys.executable,str(B/'verify.py')],check=True)
print(json.dumps(dict(directory=str(B),releaseSha256=sha(B/'release.json'),pins=len(release['files']),uploads=130,downloads=269,compiles=69,TT=8020,logs=88,production=17)))
