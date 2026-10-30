"""Root-only preparation/apply boundary for five exact build12-v3 canonicals.
Default --prepare writes workspace plans only. No SSH/network is implemented.
"""
from pathlib import Path
import argparse,hashlib,json,os,subprocess,sys
W=Path(__file__).resolve().parents[2]; R=W/'.runtime/ciw-completion-20261028'
B=R/'official-build12-v3'; D=R/'runtime-build12'
RELEASE='409a6bb3aca9dffac9412b7f90816acf62308f52d89ed651ec4720b86f562a7b'
EXPECTED={
 'CiwErpReadService.p':'D:/opencode/motor-progress/v2/sursum-api/programs/CiwErpReadService.p',
 'ContainersPainelFinanceReadService.p':'D:/opencode/motor-progress/v2/sursum-api/programs/ContainersPainelFinanceReadService.p',
 'RuntimeCiwErpQuery.php':'D:/opencode/construtor-pg/backend/src/Runtime/RuntimeCiwErpQuery.php',
 'RuntimeContainerNfAvailableRead.php':'D:/opencode/construtor-pg/backend/src/Runtime/RuntimeContainerNfAvailableRead.php',
 'RuntimeApiEntityActionService.php':'D:/opencode/construtor-pg/backend/src/Runtime/RuntimeApiEntityActionService.php'}
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()if p.is_file()else None
def load(p):return json.loads(p.read_text(encoding='utf-8-sig'))
def write_once(p,value):
 data=(json.dumps(value,ensure_ascii=False,indent=2)+'\n').encode('utf8');p.parent.mkdir(parents=True,exist_ok=True)
 if p.exists():assert p.read_bytes()==data,'Existing artifact differs; preserve it: '+str(p)
 else:
  with p.open('xb')as f:f.write(data)
def release():
 assert sha(B/'release.json')==RELEASE,'Build12-v2 release pin changed'
 r=load(B/'release.json')
 for x in r['files']:assert sha(B/x['path'])==x['sha256'],x['path']
 return r
def rows():
 release();plan=load(B/'integration-plan.json');result=[]
 assert len(plan['files'])==5
 for x in plan['files']:
  name=Path(x['target']).name;assert name in EXPECTED and Path(x['target']).resolve()==Path(EXPECTED[name]).resolve()
  source=B/'package'/x['relative']if name.endswith('.p')else B/'backend-stage/backend/src/Runtime'/name
  assert sha(source)==x['candidateSha256']==sha(Path(x['frozenCandidatePath']))
  result.append(dict(target=str(Path(EXPECTED[name])),source=str(source),baselineSha256=x['baselineSha256'],candidateSha256=x['candidateSha256']))
 assert{Path(x['target']).name for x in result}==set(EXPECTED)
 return result
def prepare():
 selected=rows()
 for x in selected:assert not Path(x['target']).is_symlink()and sha(Path(x['target']))==x['baselineSha256'],'Canonical baseline changed'
 write_once(D/'integration-prepared.json',dict(success=True,releaseSha256=RELEASE,files=selected,rootApplyRequired=True,officialProofRequired=True,businessWrites=False,canonicalWrites=False))
 return selected
def check_manager_release():
 manager=load(B/'manager-release.json')
 assert manager['success']and manager['childReleaseSha256']==RELEASE
 for x in manager['pinned']:assert sha(Path(x['path']))==x['sha256'],x['path']
def prepare_official_proof():
 release();check_manager_release()
 subprocess.run([sys.executable,str(B/'verify.py'),'--official'],check=True)
 m=load(B/'build-manifest.json');files=[]
 for rel in m['productionAllowlist']:
  src=B/('package'if rel.endswith('.p')else'compiled122')/rel
  assert src.is_file()and src.stat().st_size>0
  files.append(dict(relative=rel,file=src.name,source=str(src.relative_to(W)),sha256=sha(src)))
 assert len(files)==4
 logs=[p for p in(B/'compiled122').glob('*Test-*.log')if not p.name.startswith('process-')];assert len(logs)==28
 evidence=[p for p in(B/'compiled122').rglob('*')if p.is_file()and p.stat().st_size>0]
 proof=dict(success=True,version='12.2',compileCount=42,numDbsCompile=1,numDbsTests=0,totalChecks=5704,testLogs=28,files=files,releaseSha256=RELEASE,managerReleaseSha256=sha(B/'manager-release.json'),verifierSha256=sha(B/'verify.py'),logHashes={p.name:sha(p)for p in logs},evidence=[dict(path=p.relative_to(B).as_posix(),sha256=sha(p))for p in sorted(evidence)],businessWrites=False)
 write_once(B/'official-compile-verification.json',proof)
 return proof
def verify_proof():
 release();p=load(B/'official-compile-verification.json')
 assert p['success']and p['version']=='12.2'and p['releaseSha256']==RELEASE and p['compileCount']==42 and p['testLogs']==28 and p['totalChecks']==5704
 assert p['numDbsCompile']==1 and p['numDbsTests']==0 and p['businessWrites']is False
 assert p['managerReleaseSha256']==sha(B/'manager-release.json')and p['verifierSha256']==sha(B/'verify.py')
 assert len(p['files'])==4 and{x['relative']for x in p['files']}==set(load(B/'build-manifest.json')['productionAllowlist'])
 for x in p['files']:assert sha(W/x['source'])==x['sha256']and(W/x['source']).stat().st_size>0
 for x in p['evidence']:assert sha(B/x['path'])==x['sha256']
 assert len(p['logHashes'])==28
 for name,digest in p['logHashes'].items():assert sha(B/'compiled122'/name)==digest
 return p
def apply_root_only():
 selected=prepare();check_manager_release();verify_proof()
 attempt=B/'canonical-attempt.json';receipt=B/'canonical-manifest.json';backup=B/'canonical-before'
 assert not attempt.exists()and not receipt.exists()and not backup.exists(),'Prior attempt; inspect, never retry automatically'
 backup.mkdir();files=[]
 for i,x in enumerate(selected):
  target=Path(x['target']);saved=backup/str(i);saved.write_bytes(target.read_bytes());assert sha(saved)==x['baselineSha256']
  files.append(dict(target=x['target'],before=x['baselineSha256'],sha256=x['candidateSha256'],source=x['source'],backup=str(saved)))
 state=dict(state='STARTED',files=files,businessWrites=False);write_once(attempt,state);written=[]
 order={'RuntimeContainerNfAvailableRead.php':0,'RuntimeCiwErpQuery.php':1,'CiwErpReadService.p':2,'ContainersPainelFinanceReadService.p':3,'RuntimeApiEntityActionService.php':4}
 try:
  for x in sorted(files,key=lambda x:order[Path(x['target']).name]):
   target=Path(x['target']);tmp=target.with_name(target.name+'.ciw-build12-v3-tmp')
   assert not tmp.exists()and not target.is_symlink()and sha(target)==x['before']
   with tmp.open('xb')as f:f.write(Path(x['source']).read_bytes());f.flush();os.fsync(f.fileno())
   assert sha(tmp)==x['sha256'];os.replace(tmp,target);written.append(x)
  for x in files:assert sha(Path(x['target']))==x['sha256']
 except BaseException:
  rollback=[]
  for x in reversed(written):
   target=Path(x['target'])
   if sha(target)!=x['sha256']:rollback.append(dict(target=x['target'],restored=False,reason='concurrent-change-preserved'));continue
   tmp=target.with_name(target.name+'.ciw-build12-v3-rollback-tmp')
   with tmp.open('xb')as f:f.write(Path(x['backup']).read_bytes())
   assert sha(tmp)==x['before'];os.replace(tmp,target);rollback.append(dict(target=x['target'],restored=True))
  attempt.write_text(json.dumps(dict(state='FAILED_INSPECT_NO_RETRY',files=files,rollback=rollback),indent=2)+'\n',encoding='utf8');raise
 write_once(receipt,dict(success=True,files=files,releaseSha256=RELEASE,officialProofSha256=sha(B/'official-compile-verification.json'),businessWrites=False,metadataPublished=False,runtimePublished=False))
 attempt.write_text(json.dumps(dict(state='COMPLETED',files=files),indent=2)+'\n',encoding='utf8')
def main():
 parser=argparse.ArgumentParser();parser.add_argument('--prepare-official-proof',action='store_true');parser.add_argument('--apply-root-only',action='store_true');args=parser.parse_args()
 assert not(args.prepare_official_proof and args.apply_root_only)
 if args.prepare_official_proof:prepare_official_proof();print('PASS official12.2 evidence bound; no canonical/runtime writes')
 elif args.apply_root_only:apply_root_only();print('PASS five exact canonical files with backups; runtime publication remains separate')
 else:prepare();print('PASS prepared five-file guarded integration; no canonical/runtime/network writes')
if __name__=='__main__':main()
