"""Root-only offline69/88/8020 verifier and exact12-file integration boundary.
Default writes plans only. Root must explicitly select proof/apply; no SSH is implemented.
"""
from pathlib import Path
import argparse,datetime,hashlib,json,os,subprocess,sys
W=Path(__file__).resolve().parents[2];R=W/'.runtime/ciw-completion-20261028'
B=R/'official-build13-v3';D=R/'build13-root-companions-v3'
RELEASE='7694b83727c554f9503cbafff4294f33c6da2f02bf2770dc4cc217d219cab9e9'
MANAGER='ae932cc8b6b95435bed8b580ddcd6191d49d8ab3ce349bc53c44d6f3a408de92'
M=Path('D:/opencode/motor-progress/v2');C=Path('D:/opencode/construtor-pg/backend/src/Runtime')
EXPECTED={n:(M/'sursum-api/programs'/n)for n in ['ContainersVersionService.p','ContainersVersionHistoryLabels.p','ContainersVersionComparisonApi.p','ContainersVersionComparisonService.p','ContainersVersionComparisonProjection.p','ContainersVersionComparisonMaterializer.p','CiwErpReadService.p','CiwCadastrosCrud.p']}
EXPECTED.update({n:C/n for n in ['RuntimeCiwComparisonRead.php','RuntimeCiwErpQuery.php','RuntimeApiEntityActionService.php']})
EXPECTED['ContainersVersionComparisonTable.i']=M/'sursum-api/includes/ContainersVersionComparisonTable.i'
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()if p.is_file()else None
def load(p):return json.loads(p.read_bytes())
def utc():return datetime.datetime.now(datetime.timezone.utc).isoformat()
def write_once(p,v):
 data=(json.dumps(v,ensure_ascii=False,indent=2)+'\n').encode();p.parent.mkdir(parents=True,exist_ok=True)
 if p.exists():assert p.read_bytes()==data,'Preserve previous output '+str(p)
 else:
  with p.open('xb')as f:f.write(data)
def persist(p,v):
 with p.open('w',encoding='utf8',newline='\n')as f:json.dump(v,f,ensure_ascii=False,indent=2);f.write('\n');f.flush();os.fsync(f.fileno())
def release():
 assert sha(B/'release.json')==RELEASE
 r=load(B/'release.json')
 for x in r['files']:assert sha(B/x['path'])==x['sha256'],x['path']
 assert sha(B/'manager-release.json')==MANAGER
 manager=load(B/'manager-release.json');assert manager['success']and manager['releaseSha256']==RELEASE
 for x in manager['pinned']:assert sha(Path(x['path']))==x['sha256'],x['path']
 return r
def rows():
 release();p=load(B/'integration-plan.json');assert len(p['files'])==12;result=[]
 for x in p['files']:
  name=Path(x['target']).name;assert name in EXPECTED and Path(x['target']).resolve()==EXPECTED[name].resolve()
  source=W/x['source'];assert source.is_file()and sha(source)==x['candidateSha256']
  result.append(dict(target=str(EXPECTED[name]),source=str(source),baselineSha256=x['baselineSha256'],candidateSha256=x['candidateSha256']))
 assert{Path(x['target']).name for x in result}==set(EXPECTED)
 for x in load(B/'shared-byte-plan.json')['files']:
  old=(B/x['baselineFile']).read_bytes();new=old
  assert hashlib.sha256(old).hexdigest()==x['baselineSha256']
  for h in reversed(x['hunks']):
   start=h['baselineStartByte'];end=h['baselineEndByteExclusive'];assert new[start:end]==bytes.fromhex(h['oldBytesHex']);new=new[:start]+bytes.fromhex(h['newBytesHex'])+new[end:]
  assert hashlib.sha256(new).hexdigest()==x['candidateSha256']
  row=next(y for y in result if Path(y['target']).name==Path(x['target']).name);assert new==Path(row['source']).read_bytes()
 return result
def prepare():
 selected=rows()
 for x in selected:
  target=Path(x['target']);assert not target.is_symlink()and(not target.exists()or target.is_file())and sha(target)==x['baselineSha256'],'Canonical changed/nonregular '+x['target']
 write_once(D/'integration-prepared.json',dict(state='PREPARED_NO_CANONICAL_WRITE',releaseSha256=RELEASE,managerReleaseSha256=MANAGER,files=selected,sharedBytePlanSha256=sha(B/'shared-byte-plan.json'),officialProofRequired=True,noReplay=True,businessWrites=False,canonicalWrites=False))
 return selected
def prepare_official_proof():
 release();assert not(D/'official-proof-attempt.json').exists()and not(D/'official-compile-verification.json').exists(),'Prior proof attempt; inspect, no replay'
 # This companion never executes a compiler. The frozen verifier consumes downloads.
 state=dict(state='STARTED',startedAtUtc=utc(),releaseSha256=RELEASE,managerReleaseSha256=MANAGER,compilerExecutedByCompanion=False)
 write_once(D/'official-proof-attempt.json',state)
 try:
  subprocess.run([sys.executable,str(B/'verify.py'),'--official'],check=True)
  plan=load(B/'remote-plan.json');downloads=plan['downloads'];assert len(downloads)==269
  evidence=[]
  for x in downloads:
   p=W/x['local'];assert p.resolve().is_relative_to((B/'official').resolve())and p.is_file(),x['local']
   evidence.append(dict(path=str(p.relative_to(W)),sha256=sha(p),bytes=p.stat().st_size))
  assert len({x['path']for x in evidence})==269
  tests=load(B/'test-list.json');logs=[]
  for cp in ['UTF-8','ISO8859-1']:
   for culture in ['AMERICAN','EUROPEAN']:
    for x in tests:
     name=x['file'].removesuffix('.p')+'-'+cp+'-'+culture
     process=B/'official'/('process-'+name+'.log');text=process.read_text(encoding='utf-8-sig')
     assert 'START TT NUMDBS=0 CP='+cp in text,'TT database/codepage proof missing '+name
     logs.append(dict(path=str((B/'official'/(name+'.log')).relative_to(W)),sha256=sha(B/'official'/(name+'.log'))))
  assert len(logs)==88
  files=[]
  for x in load(B/'runtime-targets.json')['targets']:
   rel=x['relative'];src=B/('official'if rel.endswith('.r')else'package')/rel
   assert src.is_file()and src.stat().st_size>0
   files.append(dict(relative=rel,file=src.name,source=str(src.relative_to(W)),sha256=sha(src)))
  assert len(files)==17
  proof=dict(success=True,version='12.2',compileCount=69,numDbsCompile=1,numDbsTests=0,totalChecks=8020,testLogs=88,downloadCount=269,files=files,releaseSha256=RELEASE,managerReleaseSha256=MANAGER,verifierSha256=sha(B/'verify.py'),evidence=evidence,testLogHashes=logs,startedAtUtc=state['startedAtUtc'],completedAtUtc=utc(),businessWrites=False,compilerExecutedByCompanion=False,priorAttempts=dict(attempt8794='TRANSPORT_FAILURE_BEFORE_UPLOAD_COMMAND_AVM',attempt68212='CLASS_SEARCH_GUARD_BEFORE_FIRST_COMPILE_OR_TT'))
  write_once(D/'official-compile-verification.json',proof);state.update(state='COMPLETED',completedAtUtc=utc(),proofSha256=sha(D/'official-compile-verification.json'));persist(D/'official-proof-attempt.json',state)
  return proof
 except BaseException as e:
  state.update(state='FAILED_INSPECT_NO_REPLAY',completedAtUtc=utc(),errorType=type(e).__name__);persist(D/'official-proof-attempt.json',state);raise
def verify_proof():
 release();p=load(D/'official-compile-verification.json')
 assert p['success']and p['version']=='12.2'and p['releaseSha256']==RELEASE and p['managerReleaseSha256']==MANAGER
 assert(p['compileCount'],p['testLogs'],p['totalChecks'],p['downloadCount'],p['numDbsCompile'],p['numDbsTests'])==(69,88,8020,269,1,0)
 assert p['verifierSha256']==sha(B/'verify.py')and p['businessWrites']is False and len(p['evidence'])==269 and len(p['testLogHashes'])==88
 assert{x['relative']for x in p['files']}=={x['relative']for x in load(B/'runtime-targets.json')['targets']}and len(p['files'])==17
 for x in p['files']:assert sha(W/x['source'])==x['sha256']and(W/x['source']).stat().st_size>0
 for x in p['evidence']+p['testLogHashes']:assert sha(W/x['path'])==x['sha256']
 return p
def apply_root_only():
 selected=prepare();verify_proof();attempt=D/'canonical-attempt.json';receipt=D/'canonical-manifest.json';backup=D/'canonical-before'
 assert not any(p.exists()for p in [attempt,receipt,backup]),'Prior attempt; inspect observed state, no replay'
 state=dict(state='STARTED',startedAtUtc=utc(),releaseSha256=RELEASE,officialProofSha256=sha(D/'official-compile-verification.json'),files=[],written=[],businessWrites=False)
 write_once(attempt,state);written=[];backup.mkdir()
 priority=['ContainersVersionComparisonTable.i','RuntimeCiwComparisonRead.php','ContainersVersionComparisonProjection.p','ContainersVersionComparisonMaterializer.p','ContainersVersionComparisonService.p','ContainersVersionComparisonApi.p','ContainersVersionHistoryLabels.p','ContainersVersionService.p','CiwErpReadService.p','RuntimeCiwErpQuery.php','CiwCadastrosCrud.p','RuntimeApiEntityActionService.php']
 try:
  for i,x in enumerate(selected):
   target=Path(x['target']);assert not target.is_symlink()and(not target.exists()or target.is_file())and sha(target)==x['baselineSha256']
   saved=backup/str(i)
   if x['baselineSha256']is not None:saved.write_bytes(target.read_bytes());assert sha(saved)==x['baselineSha256']
   state['files'].append(dict(target=x['target'],source=x['source'],before=x['baselineSha256'],sha256=x['candidateSha256'],backup=str(saved)if saved.exists()else None))
  write_once(D/'canonical-rollback-plan.json',dict(state='ROOT_RECOVERY_ONLY_NOT_EXECUTED',files=state['files'],policy='Reverse only own writes whose current hash equals candidate; delete only newly-created exact candidate, restore old exact backup; preserve concurrent changes; no automatic replay'))
  persist(attempt,state)
  for x in sorted(state['files'],key=lambda y:priority.index(Path(y['target']).name)):
   target=Path(x['target']);tmp=target.with_name(target.name+'.ciw-build13-v3-tmp')
   assert not tmp.exists()and not target.is_symlink()and sha(target)==x['before']
   with tmp.open('xb')as f:f.write(Path(x['source']).read_bytes());f.flush();os.fsync(f.fileno())
   assert sha(tmp)==x['sha256'];os.replace(tmp,target);written.append(x);state['written']=[v['target']for v in written];persist(attempt,state)
  for x in state['files']:assert sha(Path(x['target']))==x['sha256']
 except BaseException as e:
  rollback=[]
  for x in reversed(written):
   target=Path(x['target'])
   try:
    assert not target.is_symlink()and sha(target)==x['sha256'],'Concurrent change preserved'
    if x['before']is None:target.unlink()
    else:
     saved=Path(x['backup']);assert sha(saved)==x['before'];tmp=target.with_name(target.name+'.ciw-build13-v3-rollback-tmp')
     with tmp.open('xb')as f:f.write(saved.read_bytes());f.flush();os.fsync(f.fileno())
     assert sha(tmp)==x['before'];os.replace(tmp,target)
    rollback.append(dict(target=x['target'],restored=sha(target)==x['before']))
   except BaseException as re:rollback.append(dict(target=x['target'],restored=False,errorType=type(re).__name__))
  state.update(state='FAILED_INSPECT_NO_REPLAY',completedAtUtc=utc(),errorType=type(e).__name__,rollback=rollback);persist(attempt,state);raise
 write_once(receipt,dict(success=True,files=state['files'],releaseSha256=RELEASE,managerReleaseSha256=MANAGER,officialProofSha256=sha(D/'official-compile-verification.json'),completedAtUtc=utc(),businessWrites=False,metadataPublished=False,runtimePublished=False))
 state.update(state='COMPLETED',completedAtUtc=utc(),canonicalReceiptSha256=sha(receipt));persist(attempt,state)
if __name__=='__main__':
 p=argparse.ArgumentParser();g=p.add_mutually_exclusive_group();g.add_argument('--prepare-official-proof',action='store_true');g.add_argument('--apply-root-only',action='store_true');a=p.parse_args()
 if a.prepare_official_proof:prepare_official_proof();print('PASS verified downloaded69/88/8020/269/17; no compilation/canonical/runtime writes')
 elif a.apply_root_only:apply_root_only();print('PASS root-only12 exact canonicals; runtime and metadata remain separate')
 else:prepare();print('PASS prepared12 exact-file integration; no canonical/runtime/network writes')
