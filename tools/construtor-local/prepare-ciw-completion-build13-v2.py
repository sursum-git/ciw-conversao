"""Compose comparisons + approved orphan policy on canonical12. Offline only."""
from pathlib import Path
import hashlib,json,re,shutil,difflib,bisect
W=Path(__file__).resolve().parents[2];R=W/'.runtime/ciw-completion-20261028'
F=W/'integration-src/ciw-completion-20261028/container-cost-comparison-readonly/frozen-rebase11-v1'
O=W/'integration-src/ciw-completion-20261028/comparison-orphan-read-policy/v1'
PREVIOUS=R/'official-build12-v3';B=R/'official-build13-v2';P=B/'package'
M=Path('D:/opencode/motor-progress/v2');C=Path('D:/opencode/construtor-pg')
REMOTE='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-v2'
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
def js(p):return json.loads(p.read_bytes())
def out(p,v):p.parent.mkdir(parents=True,exist_ok=True);p.write_text(json.dumps(v,ensure_ascii=False,indent=2)+'\n',encoding='utf8')
def cp(a,b):b.parent.mkdir(parents=True,exist_ok=True);shutil.copyfile(a,b)
assert not B.exists(),'Fresh stage only; never regenerate reviewed snapshots'
assert sha(F/'manifest.json')=='17acb3059051f6eb87f3aef20ba1f7c79aae6de05c52d208dd8748a350a2d6e0'
assert sha(O/'manifest.json')=='ca40b1c460498c54f60afe38d585b0fd77bcc6e8be8c7a0fe624b38efc2585ed'
assert sha(C/'backend/src/Builder/ProgramBuilderService.php')=='205ebd14329f8e8896d07c07716939db8a12d58345fecf76cab5252f4e0694a7'
for x in js(O/'manifest.json')['files']:assert sha(O/x['path'])==x['sha256']
P.mkdir(parents=True)
# Frozen tests/includes, current canonical code. Never copy a cumulative candidate.
for source in [F/'official-preparation/package',PREVIOUS/'package']:
 for f in source.rglob('*'):
  if not f.is_file()or f.suffix not in ['.p','.i','.cls']:continue
  rel=f.relative_to(source)
  if rel.as_posix()in ['Compile.p','Regression.p']:continue
  origin=M/rel if rel.parts[0]=='sursum-api' and(M/rel).is_file()else f
  cp(origin,P/rel)
shared=[]
def byte_hunks(old,new):
 a=old.splitlines(keepends=True);b=new.splitlines(keepends=True);aa=[0];bb=[0]
 for v in a:aa.append(aa[-1]+len(v))
 for v in b:bb.append(bb[-1]+len(v))
 return[{'baselineStartByte':aa[x],'baselineEndByteExclusive':aa[y],'oldBytesHex':old[aa[x]:aa[y]].hex(),'newBytesHex':new[bb[u]:bb[v]].hex()}for tag,x,y,u,v in difflib.SequenceMatcher(None,a,b,autojunk=False).get_opcodes()if tag!='equal']
def add_shared(target,old,new,origin):
 name=target.name;cp(target,B/'baseline-exact'/name);(B/'candidate-exact').mkdir(exist_ok=True);(B/'candidate-exact'/name).write_bytes(new)
 h=byte_hunks(old,new);actual=old
 for x in reversed(h):
  s=x['baselineStartByte'];e=x['baselineEndByteExclusive'];assert actual[s:e]==bytes.fromhex(x['oldBytesHex']);actual=actual[:s]+bytes.fromhex(x['newBytesHex'])+actual[e:]
 assert actual==new
 shared.append({'target':target.as_posix(),'baselineSha256':hashlib.sha256(old).hexdigest(),'candidateSha256':hashlib.sha256(new).hexdigest(),'baselineFile':'baseline-exact/'+name,'candidateFile':'candidate-exact/'+name,'origin':origin,'hunks':h})
def insertion_offset(old,current,offset):
 # Exact anchors; existing semantic additions are never normalized or discarded.
 right=old[offset:offset+180]
 if len(right)>30 and current.count(right)==1:return current.index(right)
 left=old[max(0,offset-180):offset]
 if len(left)>30 and current.count(left)==1:return current.index(left)+len(left)
 a=old.splitlines(keepends=True);b=current.splitlines(keepends=True);aa=[0];bb=[0]
 for v in a:aa.append(aa[-1]+len(v))
 for v in b:bb.append(bb[-1]+len(v))
 line=bisect.bisect_right(aa,offset)-1;column=offset-aa[line]
 choices=[bb[v.b+line-v.a]+column for v in difflib.SequenceMatcher(None,a,b,autojunk=False).get_matching_blocks()if v.a<=line<v.a+v.size]
 assert len(choices)==1,('unmapped insertion',offset)
 return choices[0]
for row in js(F/'shared-byte-plan.json')['files']:
 target=Path(row['target']);old=target.read_bytes();baseline=(F/row['baselineFile']).read_bytes();name=target.name;new=old
 if name=='RuntimeCiwErpQuery.php':
  # Keep NF12 first, then add the two comparison resources, not a stale map line.
  anchor=b"'despesas_impostos_geral_progress'=>'despesas_impostos_geral',"
  addition=b"'container_custos_comparacao_real_progress'=>'container_custos_comparacao_real','container_custos_comparacao_dolar_progress'=>'container_custos_comparacao_dolar',"
  assert new.count(anchor)==1;new=new.replace(anchor,anchor+addition)
  anchor=b"        } elseif (RuntimeSampleContainerItemsRead::supports($d)) {\r\n"
  assert new.count(anchor)==1
  branch=b"        } elseif (RuntimeCiwComparisonRead::supports($d)) {\r\n            $context=RuntimeCiwComparisonRead::resolveContext($d,$endpoint,$payload,'read');\r\n            unset($payload['context']);\r\n"
  new=new.replace(anchor,branch+anchor)
  assert new.index(b'if ($nfAvailable)')<new.index(b'RuntimeCiwComparisonRead::supports($d)')
 else:
  replacements=[]
  for h in row['hunks']:
   before=bytes.fromhex(h['oldBytesHex']);after=bytes.fromhex(h['newBytesHex'])
   if before:assert old.count(before)==1;start=old.index(before)
   else:start=insertion_offset(baseline,old,h['baselineStartByte'])
   replacements.append((start,start+len(before),before,after))
  for start,end,before,after in sorted(replacements,reverse=True):assert new[start:end]==before;new=new[:start]+after+new[end:]
 if name=='RuntimeApiEntityActionService.php':
  assert old.count(b'\n')-old.count(b'\r\n')==new.count(b'\n')-new.count(b'\r\n')==16
 add_shared(target,old,new,'comparison17ac; semantic exact-byte rebase onto canonical12')
 if name.endswith('.p'):(P/'sursum-api/programs'/name).write_bytes(new)
 else:cp(B/'candidate-exact'/name,B/'backend-stage/backend/src/Runtime'/name)
# Approved central policy overlay; comparison new service follows its own approved baseline.
for name in ['ContainersVersionService.p','ContainersVersionComparisonService.p']:
 row=next(x for x in js(O/'byte-plan.json')['files']if x['target']==name)
 if name=='ContainersVersionService.p':
  target=M/'sursum-api/programs'/name;assert sha(target)==row['baselineSha256'];add_shared(target,target.read_bytes(),(O/row['candidateFile']).read_bytes(),'orphan companion ca40, manager review3cd94')
 cp(O/row['candidateFile'],P/'sursum-api/programs'/name)
for name in ['ContainersVersionComparisonApi.p','ContainersVersionComparisonProjection.p','ContainersVersionComparisonMaterializer.p']:cp(F/'abl'/name,P/'sursum-api/programs'/name)
cp(F/'includes/ContainersVersionComparisonTable.i',P/'sursum-api/includes/ContainersVersionComparisonTable.i')
cp(M/'sursum-api/includes/ContainerProcessBoundary.i',P/'sursum-api/includes/ContainerProcessBoundary.i')
# Every duplicated root adapter used by TT must be the same staged implementation.
for name in ['CiwErpReadService.p','ContainersPainelFinanceReadService.p','CiwMedCompanyContext.p']:
 cp(P/'sursum-api/programs'/name,P/name)
out(B/'shared-byte-plan.json',{'files':shared,'noCanonicalWrites':True,'actionBareLfPreserved':16,'historical15PlusOneNf12Lf':True})
# Test list approved by manager: no duplicated source/testname.
tests=[]
new=[('ComparisonProjectionTest.p','comparison-projection-tests.log',26),('ComparisonRoundingEvidenceTest.p','comparison-rounding-tests.log',21),('ComparisonItemJoinTest.p','comparison-itemjoin-tests.log',10),('ComparisonMaterializerTest.p','comparison-materializer-tests.log',14),('ComparisonReaderTest.p','comparison-reader-tests.log',13),('ComparisonSqlObservedTest.p','comparison-sql-observed-tests.log',274)]
for name,log,count in new:cp(F/'tests/abl'/name,P/name);tests.append({'file':name,'output':log,'checks':count,'kind':'comparison'})
for name,log,count in [('ComparisonOrphanServiceTest.p','comparison-service-tests.log',29),('OrphanVersionReadPolicyTest.p','orphan-read-policy-tests.log',32)]:cp(O/'tests'/name,P/name);tests.append({'file':name,'output':log,'checks':count,'kind':'approved orphan policy'})
for row in js(F/'tests/regression-list.json'):
 name=row['name'];assert sha(F/'official-preparation/package'/name)==row['sourceSha256'];cp(F/'official-preparation/package'/name,P/name);tests.append({'file':name,'output':row['output'],'checks':row['expectedChecks'],'kind':'unchanged regression'})
for name,log,count in [('NfAvailablePageTest.p','nf-page-{culture}.log',1040),('NfPageBudgetTest.p','nf-page-budget-{culture}.log',2)]:cp(PREVIOUS/'package'/name,P/name);tests.append({'file':name,'output':log,'checks':count,'kind':'Reader12 regression'})
for x in tests:x['sha256']=sha(P/x['file'])
assert len(tests)==len({x['file']for x in tests})==22 and sum(x['checks']for x in tests)==2005
out(B/'test-list.json',tests)
cp(F/'tests/fixtures/sql-observed-v2.json',P/'sql-observed-v2.json')
# Full real App stage + existing suite overlays from the latest reviewed12.
for f in(C/'backend/src').rglob('*.php'):cp(f,B/'backend-stage/backend/src'/f.relative_to(C/'backend/src'))
for row in shared:
 if row['target'].endswith('.php'):cp(B/row['candidateFile'],B/'backend-stage/backend/src/Runtime'/Path(row['target']).name)
cp(F/'php/RuntimeCiwComparisonRead.php',B/'backend-stage/backend/src/Runtime/RuntimeCiwComparisonRead.php')
for tree in ['php-tests','test-inputs','relations-state']:
 for f in(PREVIOUS/tree).rglob('*'):
  if not f.is_file():continue
  target=B/tree/f.relative_to(PREVIOUS/tree);target.parent.mkdir(parents=True,exist_ok=True);data=f.read_bytes()
  if f.suffix=='.php':data=data.replace(PREVIOUS.as_posix().encode(),B.as_posix().encode())
  target.write_bytes(data)
for f in(F/'tests/php').iterdir():
 if not f.is_file():continue
 target=B/'tests/php'/f.name;target.parent.mkdir(parents=True,exist_ok=True);data=f.read_bytes().replace(b'D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/comparison-after11',B.as_posix().encode()+b'/local')
 target.write_bytes(data)
for f in(F/'metadata').iterdir():
 if f.is_file():cp(f,B/'metadata'/f.name)
cp(PREVIOUS/'php-bootstrap.php',B/'php-bootstrap.php')
config=f'''<?xml version="1.0" encoding="UTF-8"?><phpunit bootstrap="{B.as_posix()}/php-bootstrap.php" cacheResult="false"><testsuites><testsuite name="Official13V2AllActualApp"><directory>{C.as_posix()}/backend/tests</directory><directory>{B.as_posix()}/php-tests</directory><exclude>{B.as_posix()}/php-tests/nf/tests/RuntimeContainerNfAvailableReadTest.php</exclude><directory>{B.as_posix()}/tests/php</directory></testsuite></testsuites></phpunit>'''
(B/'phpunit.xml').write_text(config,encoding='utf8')
(B/'local').mkdir(exist_ok=True)
cp(F/'tests/native-preview.cjs',B/'native-preview.cjs')
(B/'native-preview.cjs').write_bytes((B/'native-preview.cjs').read_bytes().replace(b'D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/comparison-after11',B.as_posix().encode()+b'/local'))
# Explicit compile closure: latest12 direct consumers, comparison participants,
# fixtures and tests. Class namespace/source handling is the proved12-v3 pattern.
m12=js(PREVIOUS/'build-manifest.json')
classes=['PasoeRuntimeIdentity.cls','PasoeExecutionContext.cls']
prod=[x for x in m12['compileEntries']if x.startswith('sursum-api/programs/')and not Path(x).name.endswith('Fixture.p')]
for name in ['ContainersVersionService.p','ContainersVersionHistoryLabels.p','ContainersVersionComparisonApi.p','ContainersVersionComparisonService.p','ContainersVersionComparisonProjection.p','ContainersVersionComparisonMaterializer.p','ContainersCustoCalculator.p','ImportDiscountsCollector.p','CostDistributionEligibleCollector.p','CostDistributionLedgerCollector.p','SampleContainerItemsCollector.p']:
 rel='sursum-api/programs/'+name
 if rel not in prod:prod.append(rel)
fixtures=['ContainersVersionFixture.p','sursum-api/programs/NfPageBudgetFixture.p','sursum-api/programs/NfSlowReaderFixture.p']
entries=classes+prod+fixtures+[x['file']for x in tests]
entries+=['CiwErpReadService.p','ContainersPainelFinanceReadService.p','CiwMedCompanyContext.p']
assert len(entries)==len(set(entries));assert all((P/('sursum-api/sursum/'+x if x in classes else x)).exists()for x in entries)
compiler=(PREVIOUS/'package/Compile.p').read_text().replace('20261028-build12-v3','20261028-build13-v2')
compiler,n=re.subn(r'INITIAL "[^"]+"','INITIAL "'+','.join(entries)+'"',compiler,count=1);assert n==1
(P/'Compile.p').write_text(compiler,encoding='utf8')
(P/'Regression.p').write_bytes((PREVIOUS/'package/Regression.p').read_bytes().replace(b'20261028-build12-v3',b'20261028-build13-v2'))
# Closed production publication allowlist; compile consumers/tests are not targets.
publicationPrograms=['ContainersVersionService.p','ContainersVersionHistoryLabels.p','ContainersVersionComparisonProjection.p','ContainersVersionComparisonMaterializer.p','ContainersVersionComparisonService.p','ContainersVersionComparisonApi.p','CiwErpReadService.p','CiwCadastrosCrud.p']
targets=[{'relative':'sursum-api/includes/ContainersVersionComparisonTable.i','kind':'new include'}]
for n in publicationPrograms:
 for ext in ['.p','.r']:targets.append({'relative':'sursum-api/programs/'+n.replace('.p',ext),'kind':'production only'})
out(B/'runtime-targets.json',{'state':'PROPOSAL_NOT_PUBLISHED','targets':targets,'order':'include, central/labels/projection/materializer/service/API, Reader, Dispatcher last','noTestClassOrFixtureRcode':True})
sources=[{'relative':f.relative_to(P).as_posix(),'sha256':sha(f),'bytes':f.stat().st_size}for f in sorted(P.rglob('*'))if f.is_file()]
out(B/'source-manifest.json',sources)
out(B/'build-manifest.json',{'state':'PREPARED_LOCAL_CHECKS_PENDING','canonicalBaseline':'official12-v3 integrated','comparisonFreezeSha256':sha(F/'manifest.json'),'orphanCompanionSha256':sha(O/'manifest.json'),'compileEntries':entries,'expectedCompileCount':len(entries),'compileNumDbs':1,'testNumDbs':0,'testSuites':22,'expectedLogs':88,'expectedChecks':8020,'checksPerCombination':2005,'combinations':4,'classRcodeMapping':{x:'sursum-api/sursum/'+x.replace('.cls','.r')for x in classes},'productionTargets':len(targets),'sharedFiles':len(shared),'builder205CanonicalDependency':{'path':(C/'backend/src/Builder/ProgramBuilderService.php').as_posix(),'sha256':sha(C/'backend/src/Builder/ProgramBuilderService.php')},'sourceAppend':{'assumedBefore':146,'after':150,'freshActualSourceBeforePublicationRequired':True,'noSanitizedAuthOverwrite':True},'canonicalWrites':False,'networkExecuted':False,'businessExecuted':False,'officialExecuted':False})
cp(Path(__file__),B/'prepare.py')
print(json.dumps({'prepared':B.as_posix(),'sources':len(sources),'compiles':len(entries),'suites':22,'checks':8020,'logs':88,'runtimeTargets':len(targets),'sharedFiles':len(shared),'noCanonicalWrites':True}))
