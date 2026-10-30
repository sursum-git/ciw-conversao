"""Prepare coherent25artifact deployment with vendor WEB MED pause/drain/restore."""
from pathlib import Path
import json,hashlib
r=Path(__file__).resolve().parents[2];b=r/'.runtime/ciw-completion-20261028/official-build7';stage='/tmp/ciw-completion-20261028-wave4';load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert not(b/'publication-manifest.json').exists();proof=load(b/'official-compile-verification.json');before=load(b/'runtime-before.json');canonical=load(b/'canonical-manifest.json')
assert proof['success']and proof['totalChecks']==4120 and canonical['success']and before['success']and before['transportBean']=='OewebTransportManager'
assert before['medWebTransport']=={'isTransportEnabled':True}and before['imaWebTransport']=={'isTransportEnabled':True}
for x in canonical['files']:assert sha(Path(x['target']))==x['sha256']
# The only replaced r-code files are pinned to the last actual publication.
priorReceipts={}
for folder in ['official-build5-v6','official-build6-v2']:
 receipt=load(b.parent/folder/'active-manifest.json');assert receipt['success'] and receipt.get('instance','sursum-api')=='sursum-api' and receipt.get('context','med')=='med'
 priorReceipts.update(receipt['targets'])
targets={};uploads=[]
for x in proof['files']:
 assert sha(r/x['source'])==x['sha256'];prior=before['targets'][x['relative']]['before']
 if not x['relative'].endswith('.r'):
  old=next(f for f in canonical['files']if f['target'].replace('\\','/').endswith('/'+x['relative']));assert prior==old['before']
 else:
  sourceRel=x['relative'][:-2]+'.p'
  sourceEntry=next(f for f in canonical['files']if f['target'].replace('\\','/').endswith('/'+sourceRel))
  if sourceEntry['before'] is None:assert prior is None,'New r-code already exists '+x['relative']
  else:assert prior==priorReceipts[x['relative']]['sha256'],'Prior published r-code diverged '+x['relative']
 targets[x['relative']]=dict(file=x['file'],sha256=x['sha256'],before=prior);uploads.append(dict(local=x['source'],remote=stage+'/'+x['file']))
manifest=dict(success=True,targets=targets,transportBean='OewebTransportManager',medWebEnabledBefore=True,imaWebEnabledBefore=True,businessWrites=False,routesChanged=False)
(b/'publication-manifest.json').write_text(json.dumps(manifest,indent=2)+'\n')
script='''from pathlib import Path
import json,hashlib,shutil,os,subprocess,time
root=Path('/mnt/datasul/ERP/sursum');stage=Path(STAGE);instance=Path('/dados/pasoe/sursum-api')
assert '192.168.0.137'in subprocess.check_output(['findmnt','-n','-o','SOURCE','-T',str(root)],universal_newlines=True)
assert not(stage/'active-manifest.json').exists()and not(stage/'publication-attempt.json').exists(),'Attempted before; inspect real state'
load=lambda p:json.loads(p.read_text());sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()if p.is_file()else None
m=load(stage/'publication-manifest.json');proof=load(stage/'official-compile-verification.json');assert proof['success']and proof['version']=='12.2'and proof['totalChecks']==4120
approved={x['relative']:x for x in proof['files']};assert set(approved)==set(m['targets'])and len(approved)==25
for rel,x in m['targets'].items():
 assert not(root/rel).is_symlink() and (not(root/rel).exists()or(root/rel).is_file()),'Non-regular target '+rel
 assert approved[rel]['sha256']==x['sha256']==sha(stage/x['file'])and sha(root/rel)==x['before'],'Hash/baseline diverged '+rel
def query(bean,method,*args):
 result=subprocess.run(['bash',str(instance/'bin/oejmx.sh'),'-Q',json.dumps({'O':'PASOE:type=OEManager,name='+bean,'M':[method,*args]},separators=(',',':'))],cwd=instance,stdout=subprocess.PIPE,stderr=subprocess.PIPE,universal_newlines=True,timeout=30)
 if result.returncode:raise RuntimeError('Vendor operation failed '+method)
 for line in result.stdout.splitlines():
  if line.strip().startswith('{'):return json.loads(line)
 raise RuntimeError('Vendor JSON absent '+method)
bean=m['transportBean'];assert bean=='OewebTransportManager'
def enabled(app):return query(bean,'isTransportEnabled',app,app).get('isTransportEnabled')
assert enabled('med')is True and enabled('ima')is True
agents=query('AgentManager','getAgents','med')['getAgents']['agents'];assert len(agents)==1 and agents[0]['state']=='AVAILABLE';agent=agents[0]
assert str((Path('/proc')/str(agent['pid'])/'cwd').resolve())=='/dados/pasoe/sursum-api/work'
def sessions():return query('AgentManager','getSessionMetrics',agent['agentId'])['getSessionMetrics']['AgentSession']
def idle(rows):return all(s.get('SessionState')=='IDLE'and s.get('ThreadId')==-1 for s in rows)
assert idle(sessions()),'MED request active; no transport/runtime changed'
backup=stage/'backup-before';backup.mkdir()
for rel,x in m['targets'].items():
 if x['before']is not None:shutil.copy2(root/rel,backup/Path(rel).name)
priority=['ImportDiscountsReadTables','CostDistributionEligibleTable','CostDistributionLedgerTable','ImportDiscountsCollector','CostDistributionEligibleCollector','CostDistributionLedgerCollector','ImportDiscountsReadService','CostDistributionEligibleReadService','CostDistributionLedgerReadService','ImportDiscountsReadApi','CostDistributionEligibleReadApi','CostDistributionLedgerReadApi','CiwErpReadService','CiwCadastrosCrud']
def priorityKey(rel):
 name=Path(rel).stem;assert name in priority,'Unreviewed artifact '+rel
 return(priority.index(name),{'.i':0,'.p':1,'.r':2}[Path(rel).suffix])
order=sorted(m['targets'],key=priorityKey)
assert len(order)==25 and [Path(x).stem for x in order[-2:]]==['CiwCadastrosCrud','CiwCadastrosCrud']
attempt={'instance':'sursum-api','context':'med','targets':25,'transportChanged':False,'written':[],'businessWrites':False,'routesChanged':False}
(stage/'publication-attempt.json').write_text(json.dumps(attempt,indent=2));written=[];pauseAttempted=False;success=False;failure=None;started=time.monotonic()
try:
 pauseAttempted=True;attempt['disableResponse']=query(bean,'disableTransport','med','med');assert enabled('med')is False;attempt['transportChanged']=True
 deadline=time.monotonic()+15
 while True:
  rows=sessions()
  if idle(rows):break
  assert time.monotonic()<deadline,'Drain timeout: no artifact replacement';time.sleep(.25)
 attempt['drainedSessionIds']=[s['SessionId']for s in rows]
 for rel in order:
  x=m['targets'][rel];target=root/rel;temp=target.with_name(target.name+'.completion-wave4-tmp')
  with temp.open('xb')as f:f.write((stage/x['file']).read_bytes())
  if target.exists():
   shutil.copystat(target,temp);st=target.stat();os.chown(temp,st.st_uid,st.st_gid)
  else:os.chmod(temp,0o644)
  assert sha(target)==x['before'];os.replace(temp,target);written.append(rel)
 for rel,x in m['targets'].items():assert sha(root/rel)==x['sha256']
 refreshed=query('AgentManager','refreshAgent',agent['agentId']);attempt['vendorRefresh']=refreshed
 returned=refreshed.get('refreshAgent',{}).get('agent',{});assert str(returned.get('pid'))==str(agent['pid'])
 outcomes=returned.get('sessions',[]);assert{s.get('sessionId')for s in outcomes}==set(attempt['drainedSessionIds'])and all(s.get('terminateResult')=='success'for s in outcomes)
 success=True
except Exception as error:
 failure=type(error).__name__+': '+str(error)
 for rel in reversed(written):
  x=m['targets'][rel]
  if sha(root/rel)==x['sha256']:
   if x['before']is None:(root/rel).unlink()
   else:shutil.copy2(backup/Path(rel).name,root/rel)
 if written:
  try:attempt['rollbackRefresh']=query('AgentManager','refreshAgent',agent['agentId'])
  except Exception:attempt['rollbackRefreshUnconfirmed']=True
finally:
 if pauseAttempted:
  try:
   attempt['enableResponse']=query(bean,'enableTransport','med','med');attempt['medWebRestored']=enabled('med')is True
  except Exception:attempt['medWebRestored']=False
 attempt['imaWebUnchanged']=enabled('ima')is True;attempt['durationSeconds']=round(time.monotonic()-started,3);attempt['written']=written;attempt['success']=success;attempt['failure']=failure
 (stage/'publication-attempt.json').write_text(json.dumps(attempt,indent=2))
assert attempt.get('medWebRestored')is True and attempt['imaWebUnchanged'],'Inspect transport restore outcome immediately'
if failure:raise RuntimeError(failure)
assert success
(stage/'active-manifest.json').write_text(json.dumps(dict(success=True,instance='sursum-api',context='med',targets=m['targets'],businessWrites=False,routesChanged=False,coherentWebMedPause=True,medWebRestored=True,imaWebUnchanged=True,refresh=attempt['vendorRefresh'],pauseDurationSeconds=attempt['durationSeconds']),indent=2))
print('PASS25official12.2 artifacts coherently published;MEDWEB restored;IMA unchanged; idle sessions refreshed; no business writes')
'''.replace('STAGE',repr(stage))
(b/'publish-runtime.py').write_text(script)
for name in ['publication-manifest.json','official-compile-verification.json','publish-runtime.py']:uploads.append(dict(local=str((b/name).relative_to(r)),remote=stage+'/'+name))
plan=dict(server='runtime',uploads=uploads,commands=['python3 '+stage+'/publish-runtime.py'],downloads=[dict(local=str((b/name).relative_to(r)),remote=stage+'/'+name)for name in ['active-manifest.json','publication-attempt.json']]);(b/'publish-plan.json').write_text(json.dumps(plan,indent=2)+'\n')
print('Prepared25reviewed artifacts; coherent vendor WEB MED pause/drain/refresh/restore; no IMA or config changes')
