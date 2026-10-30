"""Prepare a fixed .111 filesystem/config readonly probe; no SSH or remote execution."""
from pathlib import Path
import hashlib,json,ast
ROOT=Path(__file__).resolve().parents[2]
OUT=ROOT/'.runtime/ciw-completion-20261028/batch1042-runtime-closure-fresh-v3'
REMOTE='/tmp/ciw-1042-runtime-closure-fresh-v3'
CANONICAL=Path('D:/opencode/motor-progress/v2')
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
load=lambda p:json.loads(p.read_text(encoding='utf-8'))
assert not OUT.exists(),'Use a fresh reviewed companion, never overwrite an attempted journal'
cleanup=ROOT/'.runtime/ciw-completion-20261028/container-expense-batch-preflight/cleanup-runtime/cleanup-runtime-proof.json'
old=load(cleanup);assert old['success']and len(old['artifactHashesVerified'])==8 and len(old['aliasesVerified'])==2
receipts=[];published={}
for build in ['official-build5-v6','official-build6-v2','official-build8']:
 p=ROOT/'.runtime/ciw-completion-20261028'/build/'active-manifest.json';d=load(p);assert d['success']and d['instance']=='sursum-api'and d['context']=='med';receipts.append({'path':str(p),'sha256':sha(p)})
 for relative,row in d['targets'].items():published[relative]={'sha256':row['sha256'],'receipt':str(p)}
# Published historical callback receipts: no compiled-only artifact is accepted.
historical=ROOT/'.runtime/ciw-completion-20261028/batch1042-runtime-closure-fresh/historical-six-candidates.json'
candidates=load(historical);assert len(candidates)==6
for row in candidates:
 receipt=ROOT/row['receipt'];assert sha(receipt)==row['receiptSha256'];value=load(receipt)
 assert value['instance']=='sursum-api'and value['context']=='med'and value['businessWrites']is False
 entries=value.get('artifacts',value.get('targets'));assert isinstance(entries,dict)
 for suffix,key in [('.p','sourceExpected'),('.r','rcodeExpected')]:
  relative='sursum-api/programs/'+row['name']+suffix
  registered=entries[relative];registered=registered['sha256']if isinstance(registered,dict)else registered
  expected=row[key];expected=expected['sha256']if isinstance(expected,dict)else expected
  assert registered.lower()==expected.lower()
  published[relative]={'sha256':registered.lower(),'receipt':str(receipt)}
 receipts.append({'path':str(receipt),'sha256':sha(receipt)})
receipts.append({'path':str(historical),'sha256':sha(historical)})
# Immediate canonical HTTP writer entrypoint, published commands16.
entry_receipt=ROOT/'.runtime/container-commands-publish-20261016/active-manifest.json';entry_value=load(entry_receipt)
assert entry_value['instance']=='sursum-api'and entry_value['context']=='med'
for suffix in ['.p','.r']:
 relative='sursum-api/programs/ContainersDespesasCrud'+suffix;entry_hash=entry_value['artifacts'][relative];assert isinstance(entry_hash,str)
 published[relative]={'sha256':entry_hash.lower(),'receipt':str(entry_receipt)}
names=['ContainersDespesasCrud','ContainersDespesasBatchApi','ContainersDespesasBatchService','ContainersDespesasCrudService','ContainersImpostosService','ContainersCabecalhoRuntime','ContainersCustoRead','ContainersCustoReadService','ContainersCustoCalculator','ContainersPagamentoTotalsService','CiwTaxAmount']
includes=['parametros_ima','ContainerCustoBoundary','ContainerMaintenancePolicy','ContainerApiIdentity','PurchaseJsonContract','ContainerExpenseBatchSnapshot','ContainerExpenseDefaultsPlan','ContainerFinancePolicy']
files=[{'relative':key,'sha256':value,'group':'cleanup-preserved','expectedEvidence':str(cleanup)}for key,value in old['artifactHashesVerified'].items()]
pins=[];missing=[]
for relative,expected_hash in old['artifactHashesVerified'].items():
 if relative.endswith('.p'):
  source=CANONICAL/relative;assert sha(source)==expected_hash;pins.append({'path':str(source),'sha256':expected_hash})
for name in names:
 for suffix in ['.p','.r']:
  relative='sursum-api/programs/'+name+suffix;known=published.get(relative)
  if suffix=='.p':
   source=CANONICAL/relative;current=sha(source);pins.append({'path':str(source),'sha256':current})
   if known:assert current==known['sha256'],'Current source differs from published receipt: '+name
   expected=current
  else:
   expected=known['sha256']if known else None
   if expected is None:missing.append(relative)
  files.append({'relative':relative,'sha256':expected,'group':'writer1042','expectedEvidence':known['receipt']if known else 'CANONICAL_SOURCE_ONLY'if suffix=='.p'else 'MISSING_PUBLISHED_OR_APPROVED_RUNTIME_BASELINE'})
for name in includes:
 relative='sursum-api/includes/'+name+'.i';source=CANONICAL/relative;current=sha(source);known=published.get(relative)
 if known:assert known['sha256']==current
 pins.append({'path':str(source),'sha256':current});files.append({'relative':relative,'sha256':current,'group':'writer-include-source','expectedEvidence':known['receipt']if known else 'CANONICAL_SOURCE_HASH_NOT_RCODE_ATTESTATION'})
assert len(files)==38 and len({x['relative']for x in files})==38
manifest={'state':'PREPARED_HELD_MISSING_CALLBACK_RCODE_BASELINE'if missing else'PREPARED_FOR_REVIEW_NOT_EXECUTED','instance':'sursum-api','context':'med','runtimeRoot':'/mnt/datasul/ERP/sursum','configPath':'/dados/pasoe/sursum-api/conf/openedge.properties','requiredMedPropathPrefix':'${CATALINA_BASE}/webapps/med/WEB-INF/openedge','maxFileBytes':67108864,'maxTotalReadBytes':67108864,'maxRuntimeSeconds':10,'files':sorted(files,key=lambda x:x['relative']),'aliases':old['aliasesVerified'],'missingExpectedRcodes':missing,'canonicalPins':pins,'evidencePins':[{'path':str(cleanup),'sha256':sha(cleanup)},*receipts],'excludedReadOnlyBranch':['CiwErpReadService: BatchService read/get returns before writer branch'],'excludedUncalledFinance12':['ContainersPainelFinanceReadService'],'compiledButNotPublishedRcodesAreNotRuntimeExpected':True,'businessWrites':False,'networkExecutedByPreparer':False}
OUT.mkdir(parents=True);expected=OUT/'expected-manifest.json';expected.write_text(json.dumps(manifest,indent=2)+'\n',encoding='utf-8')
template=r'''from pathlib import Path
import hashlib,json,os,stat,signal,time
from datetime import datetime,timezone
STAGE=Path(__STAGE__)
EXPECTED_SHA=__EXPECTED_SHA__
CLOSED_FILES=__CLOSED_FILES__
CLOSED_ALIASES=__CLOSED_ALIASES__
RUNTIME_ROOT='/mnt/datasul/ERP/sursum'
CONFIG='/dados/pasoe/sursum-api/conf/openedge.properties'
PREFIX='${CATALINA_BASE}/webapps/med/WEB-INF/openedge'
CAP=67108864
def utc():return datetime.now(timezone.utc).isoformat(timespec='microseconds')
def digest(value):return hashlib.sha256(value).hexdigest()
def validate_manifest(value):
 assert value['instance']=='sursum-api'and value['context']=='med'
 assert value['runtimeRoot']==RUNTIME_ROOT and value['configPath']==CONFIG and value['requiredMedPropathPrefix']==PREFIX
 assert value['maxFileBytes']==CAP and value['maxTotalReadBytes']==CAP and value['maxRuntimeSeconds']==10
 assert sorted(x['relative']for x in value['files'])==CLOSED_FILES and len(value['files'])==38
 assert value['aliases']==CLOSED_ALIASES
 for row in value['files']:assert row['sha256']is None or len(row['sha256'])==64 and all(c in '0123456789abcdef'for c in row['sha256'])
class NativeIO:
 def __init__(self):self.total=0;self.started=time.monotonic()
 def read(self,p):
  assert p==CONFIG or p in [RUNTIME_ROOT+'/'+x for x in CLOSED_FILES]
  if time.monotonic()-self.started>10:raise TimeoutError()
  fd=os.open(p,os.O_RDONLY|os.O_NOFOLLOW)
  try:
   info=os.fstat(fd);assert stat.S_ISREG(info.st_mode)and 0<=info.st_size<=CAP
   data=[];size=0
   while True:
    block=os.read(fd,65536)
    if not block:break
    size+=len(block);self.total+=len(block)
    if size>CAP or self.total>CAP:raise ValueError('READ_BUDGET')
    if time.monotonic()-self.started>10:raise TimeoutError()
    data.append(block)
   return b''.join(data)
  finally:os.close(fd)
 def alias(self,p):
  assert p in CLOSED_ALIASES
  path=Path(p);assert path.is_symlink()
  target=str(path.resolve(strict=True));assert target==CLOSED_ALIASES[p]
  return {'symlink':True,'resolved':target,'literalLinkSha256':digest(os.readlink(p).encode('utf-8'))}
def med_prefix(data):
 lines=[line.strip().split('=',1)[1]for line in data.decode('utf-8').splitlines()if line.strip().startswith('PROPATH=')and PREFIX in line]
 return len(lines)==1 and lines[0].split(',')[0]==PREFIX
def inspect(value,reader):
 validate_manifest(value);before=reader.read(CONFIG);aliasesBefore={p:reader.alias(p)for p in CLOSED_ALIASES};rows=[]
 for row in value['files']:
  data=reader.read(RUNTIME_ROOT+'/'+row['relative']);actual=digest(data);expected=row['sha256'];rows.append({'relative':row['relative'],'group':row['group'],'sha256':actual,'bytes':len(data),'expectedSha256':expected,'expectedPinned':expected is not None,'matchesExpected':actual==expected if expected is not None else None})
 aliases={}
 for p,target in CLOSED_ALIASES.items():
  after=reader.alias(p);relative=target[len(RUNTIME_ROOT)+1:];expected=next(x['sha256']for x in value['files']if x['relative']==relative);actual=digest(reader.read(target));aliases[p]={'resolvedExpected':after['resolved']==target,'symlink':after['symlink'],'sameAliasBeforeAfter':after==aliasesBefore[p],'resolved':target,'targetSha256':actual,'matchesExpected':actual==expected}
 after=reader.read(CONFIG);configuration={'sha256Before':digest(before),'sha256After':digest(after),'bytesUnchanged':before==after,'medPropathPrefixMatches':med_prefix(before)and med_prefix(after),'configReadOnly':True}
 ok=all(x['expectedPinned']and x['matchesExpected']for x in rows)and all(x['matchesExpected']and x['sameAliasBeforeAfter']and x['resolvedExpected']for x in aliases.values())and configuration['bytesUnchanged']and configuration['medPropathPrefixMatches']
 return {'completed':True,'success':ok,'artifactCount':len(rows),'artifacts':rows,'aliases':aliases,'configuration':configuration,'missingExpectedRcodes':value['missingExpectedRcodes'],'scope':'Filesystem/config only; no AVM SEARCH or cache attestation','businessWrites':False,'writersRun':False,'triggersRun':False,'propathChanged':False,'mbeanCalls':False,'externalProcesses':False,'readBytes':reader.total}
def main():
 script=Path(__file__);manifest=STAGE/'expected-manifest.json';data=manifest.read_bytes();assert digest(data)==EXPECTED_SHA;value=json.loads(data);validate_manifest(value)
 started=utc();scriptSha=digest(script.read_bytes());start={'state':'STARTED','startedAtUtc':started,'scriptSha256':scriptSha,'expectedManifestSha256':EXPECTED_SHA,'instance':'sursum-api','context':'med','phase':'precreate1042','runtimeExecuted':True,'businessWrites':False}
 with (STAGE/'started.json').open('x')as f:json.dump(start,f,indent=2)
 def timeout(signum,frame):raise TimeoutError()
 previous=signal.signal(signal.SIGALRM,timeout);signal.alarm(10)
 try:result=inspect(value,NativeIO())
 except BaseException as error:result={'completed':False,'success':False,'failureCode':'RUNTIME_CLOSURE_TIMEOUT'if isinstance(error,TimeoutError)else'RUNTIME_CLOSURE_CHECK_FAILED','businessWrites':False,'writersRun':False,'triggersRun':False,'propathChanged':False,'mbeanCalls':False}
 finally:signal.alarm(0);signal.signal(signal.SIGALRM,previous)
 result.update(startedAtUtc=started,completedAtUtc=utc(),scriptSha256=scriptSha,expectedManifestSha256=EXPECTED_SHA,journalStartedSha256=digest((STAGE/'started.json').read_bytes()),instance='sursum-api',context='med',phase='precreate1042',timestampSource='UTC observed on runtime host; never filemtime')
 receipt=STAGE/'runtime-closure-proof.json'
 with receipt.open('x')as f:json.dump(result,f,indent=2)
 with (STAGE/'completed.json').open('x')as f:json.dump({'startedAtUtc':started,'completedAtUtc':result['completedAtUtc'],'success':result['success'],'completed':result['completed'],'receiptSha256':digest(receipt.read_bytes()),'scriptSha256':scriptSha,'expectedManifestSha256':EXPECTED_SHA},f,indent=2)
 print('PASS runtime1042 closed file/config freshness'if result['success']else'HELD runtime1042 closure; inspect exact private receipt, no replay')
 if not result['success']:raise SystemExit(1)
if __name__=='__main__':main()
'''
script=template.replace('__STAGE__',repr(REMOTE)).replace('__EXPECTED_SHA__',repr(sha(expected))).replace('__CLOSED_FILES__',repr(sorted(x['relative']for x in files))).replace('__CLOSED_ALIASES__',repr(old['aliasesVerified']))
ast.parse(script);probe=OUT/'inspect_runtime.py';probe.write_text(script,encoding='utf-8')
plan={'state':manifest['state'],'server':'runtime','directories':[REMOTE],'uploads':[{'local':str(probe),'remote':REMOTE+'/inspect_runtime.py','sha256':sha(probe)},{'local':str(expected),'remote':REMOTE+'/expected-manifest.json','sha256':sha(expected)}],'commands':[]if missing else['python3 '+REMOTE+'/inspect_runtime.py'],'proposedCommandAfterReview':'python3 '+REMOTE+'/inspect_runtime.py','missingPublishedRcodeBaseline':missing,'downloads':[{'remote':REMOTE+'/'+n,'local':str(OUT/n)}for n in ['started.json','runtime-closure-proof.json','completed.json']],'oneAttemptNoReplay':True,'sourcePins':pins,'noAvmSqlSshByPreparer':True,'scriptSha256':sha(probe),'expectedManifestSha256':sha(expected)}
(OUT/'remote-plan.json').write_text(json.dumps(plan,indent=2)+'\n',encoding='utf-8');print(json.dumps({'prepared':True,'state':manifest['state'],'fixedArtifacts':38,'fixedAliases':2,'missingRcodePins':len(missing),'scriptSha256':sha(probe),'expectedManifestSha256':sha(expected),'remoteExecuted':False}))
