"""Prepare inspector now; publication artifacts only after official/integration/fresh RO gates.
No network, SSH, vendor operation, canonical write or publication is performed locally.
"""
from pathlib import Path
import argparse,ast,datetime,hashlib,importlib.util,json,re
W=Path(__file__).resolve().parents[2];R=W/'.runtime/ciw-completion-20261028';B=R/'official-build12-v3';D=R/'runtime-build12'
REMOTE='/tmp/ciw-completion-20261028-build12';RELEASE='409a6bb3aca9dffac9412b7f90816acf62308f52d89ed651ec4720b86f562a7b'
RELS=['sursum-api/programs/'+name+suffix for name in ['CiwErpReadService','ContainersPainelFinanceReadService']for suffix in ['.p','.r']]
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()if p.is_file()else None
def load(p):return json.loads(p.read_text(encoding='utf-8-sig'))
def write_once(p,value):
 data=value.encode('utf8')if isinstance(value,str)else(json.dumps(value,ensure_ascii=False,indent=2)+'\n').encode('utf8');p.parent.mkdir(parents=True,exist_ok=True)
 if p.exists():assert p.read_bytes()==data,'Existing output differs; preserve it: '+str(p)
 else:
  with p.open('xb')as f:f.write(data)
def baselines():
 paths=[R/'runtime-build11/active-manifest.json',R/'runtime-build10/active-manifest.json']
 assert sha(paths[0])=='26f74418c5fe81ce4526aaa4a3b60564462daba856bca3c6e52242aff375afad'
 assert sha(paths[1])=='02872fa779b36ba5cf0600b49c21b3c1b5ca3030a5c13c62fe823b6204fec257'
 result={}
 for p in paths:
  m=load(p);assert m['success']and m['instance']=='sursum-api'and m['context']=='med'
  for rel in RELS:
   if rel in m['targets']:result[rel]=m['targets'][rel]['sha256']
 assert set(result)==set(RELS);return result
def abi_proof():
 rows=[]
 for name in ['CiwErpReadService','ContainersPainelFinanceReadService']:
  old=Path('D:/opencode/motor-progress/v2/sursum-api/programs')/(name+'.p');new=B/'package/sursum-api/programs'/(name+'.p')
  def signature(p):
   t=re.sub(r'/\*.*?\*/','',p.read_text(encoding='utf-8-sig'),flags=re.S);t=re.split(r'(?im)^\s*(?:FUNCTION|PROCEDURE)\b',t)[0]
   return[re.sub(r'\s+',' ',x).strip()for x in re.findall(r'(?im)^DEFINE\s+(?:INPUT-OUTPUT|INPUT|OUTPUT)\s+PARAMETER\b[^.]*\.',t)]
  a=signature(old);z=signature(new);assert a==z and len(a)==(5 if name=='CiwErpReadService'else 13)
  if name=='ContainersPainelFinanceReadService':assert sum(' AS HANDLE 'in x for x in a)==10
  rows.append(dict(name=name,beforeSha256=sha(old),candidateSha256=sha(new),parameters=a,abiUnchanged=True))
 wrapper=Path('D:/opencode/motor-progress/v2/sursum-api/programs/ContainersPainelFinanceRead.p')
 assert sha(wrapper)==sha(B/'package/sursum-api/programs/ContainersPainelFinanceRead.p')
 return dict(success=True,services=rows,wrapper=dict(path=str(wrapper),sha256=sha(wrapper),changed=False,publish=False),publishArtifacts=RELS,unmodifiedDependentsNotRepublished=True,refreshScope='Existing MED agent/session rcode cache only; no IMA refresh/restart, routes or PROPATH change',businessWrites=False)

INSPECTOR=r'''from pathlib import Path
import json,hashlib,subprocess,re,datetime,uuid
root=Path('/mnt/datasul/ERP/sursum');stage=Path('__REMOTE__');instance=Path('/dados/pasoe/sursum-api')
expected=__EXPECTED__
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
observed=datetime.datetime.now(datetime.timezone.utc).isoformat()
assert '192.168.0.137'in subprocess.check_output(['findmnt','-n','-o','SOURCE','-T',str(root)],universal_newlines=True)
targets={}
for rel,digest in expected.items():
 target=root/rel;assert not target.is_symlink()and target.is_file()and target.resolve().parent==(root/'sursum-api/programs').resolve(),'Nonregular/outside target'
 value=sha(target);assert value==digest,'Runtime baseline changed '+rel
 targets[rel]={'before':value}
def query(bean,method,*args):
 p=subprocess.run(['bash',str(instance/'bin/oejmx.sh'),'-Q',json.dumps({'O':'PASOE:type=OEManager,name='+bean,'M':[method,*args]},separators=(',',':'))],cwd=instance,stdout=subprocess.PIPE,stderr=subprocess.PIPE,universal_newlines=True,timeout=45)
 assert p.returncode==0,'Vendor inspection failed '+method
 for line in p.stdout.splitlines():
  if line.strip().startswith('{'):return json.loads(line)
 raise RuntimeError('Vendor JSON absent '+method)
bean='OewebTransportManager'
med=query(bean,'isTransportEnabled','med','med');ima=query(bean,'isTransportEnabled','ima','ima')
assert med=={'isTransportEnabled':True}and ima=={'isTransportEnabled':True},'Expected both WEB transports enabled'
agents=query('AgentManager','getAgents','med')['getAgents']['agents']
assert len(agents)==1 and agents[0]['state']=='AVAILABLE','Require fresh single available MED agent'
agent=agents[0];assert str((Path('/proc')/str(agent['pid'])/'cwd').resolve())=='/dados/pasoe/sursum-api/work'
metrics=query('AgentManager','getSessionMetrics',agent['agentId']);sessions=metrics['getSessionMetrics']['AgentSession']
assert isinstance(sessions,list)and sessions and all(s.get('SessionState')=='IDLE'and s.get('ThreadId')==-1 for s in sessions),'MED request active; inspection only'
assert len({s['SessionId']for s in sessions})==len(sessions)
out={'success':True,'observedAtUtc':observed,'completedAtUtc':datetime.datetime.now(datetime.timezone.utc).isoformat(),'inspectionId':str(uuid.uuid4()),'inspectorSha256':sha(Path(__file__)),'mountConfirmed':True,'instance':'sursum-api','context':'med','targets':targets,'transportBean':bean,'medWebTransport':med,'imaWebTransport':ima,'medAgents':agents,'medSessionMetrics':metrics,'allMedSessionsIdle':True,'businessWrites':False,'transportChanged':False,'runtimeChanged':False}
(stage/'runtime-before.json').write_text(json.dumps(out,indent=2)+'\n');print('PASS4 fresh hashes/MED-IMA WEB/MED IDLE; readonly; no session IDs assumed')
'''
def prepare_inspection():
 assert sha(B/'release.json')==RELEASE
 before=baselines();abi=abi_proof();script=INSPECTOR.replace('__REMOTE__',REMOTE).replace('__EXPECTED__',repr(before));ast.parse(script)
 write_once(D/'inspect-runtime.py',script);write_once(D/'abi-proof.json',abi)
 write_once(D/'inspect-plan.json',dict(server='runtime',directories=[REMOTE],uploads=[dict(local=str((D/'inspect-runtime.py').relative_to(W)),remote=REMOTE+'/inspect-runtime.py')],commands=['python3 '+REMOTE+'/inspect-runtime.py'],downloads=[dict(local=str((D/'runtime-before.json').relative_to(W)),remote=REMOTE+'/runtime-before.json')]))
 write_once(D/'runtime-preparation.json',dict(success=True,state='INSPECTOR_PREPARED_NOT_EXECUTED',releaseSha256=RELEASE,inspectorSha256=sha(D/'inspect-runtime.py'),abiProofSha256=sha(D/'abi-proof.json'),expectedRuntimeBaselines=before,publicationNotGenerated=True,officialProofRequired=True,canonicalReceiptRequired=True,freshInspectionSeconds=600,businessWrites=False,networkExecuted=False,canonicalWrites=False))
def proof_module():
 p=Path(__file__).with_name('prepare-ciw-build12-v3-integration.py');spec=importlib.util.spec_from_file_location('ciw_build12_v3_integration',p);mod=importlib.util.module_from_spec(spec);spec.loader.exec_module(mod);return mod
def fresh_inspection(before,now):
 assert before['success']and before['mountConfirmed']and before['instance']=='sursum-api'and before['context']=='med'
 age=(now-datetime.datetime.fromisoformat(before['observedAtUtc'])).total_seconds();assert 0<=age<=600,'Fresh runtime inspection required'
 assert before['inspectorSha256']==sha(D/'inspect-runtime.py')and before['allMedSessionsIdle']is True
 assert before['businessWrites']is False and before['transportChanged']is False and before['runtimeChanged']is False
 assert before['transportBean']=='OewebTransportManager'and before['medWebTransport']=={'isTransportEnabled':True}and before['imaWebTransport']=={'isTransportEnabled':True}
 assert set(before['targets'])==set(RELS)
 for rel,value in baselines().items():assert before['targets'][rel]['before']==value
 agents=before['medAgents'];assert len(agents)==1 and agents[0]['state']=='AVAILABLE'
 sessions=before['medSessionMetrics']['getSessionMetrics']['AgentSession'];assert sessions and all(s.get('SessionState')=='IDLE'and s.get('ThreadId')==-1 for s in sessions)
def publisher_script():
 p=R/'runtime-build11/publish-runtime.py';assert sha(p)=='3703682647932a5d6ba5da3750811cb03de85c794d999156397d378feca5fb83'
 t=p.read_text();t=t.replace('import json,hashlib,shutil,os,subprocess,time','import json,hashlib,shutil,os,subprocess,time,datetime')
 t=t.replace('/tmp/ciw-completion-20261028-wave8',REMOTE).replace("proof['totalChecks']==384","proof['totalChecks']==5704")
 t=t.replace("priority=['CiwErpReadService','CiwCadastrosCrud']","priority=['CiwErpReadService','ContainersPainelFinanceReadService']").replace("['CiwCadastrosCrud','CiwCadastrosCrud']","['ContainersPainelFinanceReadService','ContainersPainelFinanceReadService']").replace('completion-wave8-tmp','completion-build12-tmp')
 anchor="approved={x['relative']:x for x in proof['files']};assert set(approved)==set(m['targets'])and len(approved)==4"
 replacement=anchor+"\nexpected="+repr(set(RELS))+"\nassert set(m['targets'])==expected and proof['releaseSha256']==m['releaseSha256']=='"+RELEASE+"' and proof['compileCount']==42 and proof['numDbsCompile']==1 and proof['numDbsTests']==0 and proof['testLogs']==28\nassert sha(stage/'official-compile-verification.json')==m['officialProofSha256']\nassert sha(Path(__file__))==m['publicationScriptSha256']\nassert sha(stage/'runtime-before.json')==m['inspectionSha256']\nbefore=load(stage/'runtime-before.json');age=(datetime.datetime.now(datetime.timezone.utc)-datetime.datetime.fromisoformat(before['observedAtUtc'])).total_seconds()\nassert before['success']and before['instance']=='sursum-api'and before['context']=='med'and before['allMedSessionsIdle']and 0<=age<=600,'Inspection stale; no runtime changed'\nassert before['inspectorSha256']==m['inspectorSha256']and before['targets']=={rel:{'before':x['before']}for rel,x in m['targets'].items()}\nfor rel,x in m['targets'].items():assert Path(x['file']).name==x['file']and x['before']is not None\n"
 assert anchor in t;t=t.replace(anchor,replacement)
 t=t.replace("agent=agents[0]","agent=agents[0];inspected=before['medAgents'][0];assert str(agent['agentId'])==str(inspected['agentId'])and str(agent['pid'])==str(inspected['pid']),'Agent changed; fresh inspection required'")
 t=t.replace("return all(s.get('SessionState')=='IDLE'and s.get('ThreadId')==-1 for s in rows)","return bool(rows)and all(s.get('SessionState')=='IDLE'and s.get('ThreadId')==-1 for s in rows)")
 anchor="assert idle(sessions()),'MED request active; no transport/runtime changed'"
 helper="""
def refresh_med():
 live=query('AgentManager','getAgents','med')['getAgents']['agents']
 assert len(live)==1 and live[0]['agentId']==agent['agentId']and str(live[0]['pid'])==str(agent['pid']),'MED agent changed'
 rows=sessions();assert idle(rows),'MED session active before cache refresh'
 ids={s['SessionId']for s in rows};assert len(ids)==len(rows)
 result=query('AgentManager','refreshAgent',agent['agentId']);returned=result.get('refreshAgent',{}).get('agent',{})
 assert str(returned.get('pid'))==str(agent['pid'])
 outcomes=returned.get('sessions',[])
 assert{s.get('sessionId')for s in outcomes}==ids and all(s.get('terminateResult')=='success'for s in outcomes)
 return result
"""
 assert anchor in t;t=t.replace(anchor,anchor+helper)
 t=t.replace("if x['before']is not None:shutil.copy2(root/rel,backup/Path(rel).name)","if x['before']is not None:\n  shutil.copy2(root/rel,backup/Path(rel).name);assert sha(backup/Path(rel).name)==x['before'],'Backup changed; no replacement'")
 t=t.replace("attempt['drainedSessionIds']=[s['SessionId']for s in rows]","attempt['drainedSessionIds']=[s['SessionId']for s in rows]\n assert len(set(attempt['drainedSessionIds']))==len(rows)\n live=query('AgentManager','getAgents','med')['getAgents']['agents'];assert len(live)==1 and live[0]['agentId']==agent['agentId']and str(live[0]['pid'])==str(agent['pid'])\n for rel,x in m['targets'].items():assert sha(root/rel)==x['before'],'Runtime changed while draining'")
 t=t.replace("with temp.open('xb')as f:f.write((stage/x['file']).read_bytes())","with temp.open('xb')as f:f.write((stage/x['file']).read_bytes());f.flush();os.fsync(f.fileno())\n  assert sha(temp)==x['sha256']")
 start=t.index(" refreshed=query('AgentManager','refreshAgent',agent['agentId']);")
 end=t.index('\n success=True',start)
 t=t[:start]+" refreshed=refresh_med();attempt['vendorRefresh']=refreshed"+t[end:]
 start=t.index('except Exception as error:');end=t.index('\nfinally:',start)
 rollback="""except Exception as error:
 failure=type(error).__name__+': '+str(error);attempt['rollbackErrors']=[]
 for rel in reversed(written):
  x=m['targets'][rel]
  try:
   assert sha(root/rel)==x['sha256'],'Concurrent runtime change preserved'
   saved=backup/Path(rel).name;assert sha(saved)==x['before']
   temp=(root/rel).with_name(Path(rel).name+'.completion-build12-rollback-tmp')
   with temp.open('xb')as f:f.write(saved.read_bytes());f.flush();os.fsync(f.fileno())
   shutil.copystat(saved,temp);st=(root/rel).stat();os.chown(temp,st.st_uid,st.st_gid);os.replace(temp,root/rel)
  except Exception as rollbackError:attempt['rollbackErrors'].append({'relative':rel,'error':type(rollbackError).__name__})
 attempt['rollbackComplete']=all(sha(root/rel)==x['before']for rel,x in m['targets'].items())
 if written and attempt['rollbackComplete']:
  try:attempt['rollbackRefresh']=refresh_med()
  except Exception:attempt['rollbackRefreshUnconfirmed']=True
"""
 t=t[:start]+rollback.rstrip()+t[end:]
 t=t.replace("if pauseAttempted:\n  try:","safeToResume=success or not written or attempt.get('rollbackComplete')is True and not attempt.get('rollbackRefreshUnconfirmed',False)\n if pauseAttempted and not safeToResume:attempt['medWebRestored']=False;attempt['manualRecoveryRequired']=True\n if pauseAttempted and safeToResume:\n  try:")
 t=t.replace("attempt['imaWebUnchanged']=enabled('ima')is True;attempt['durationSeconds']", "\n try:attempt['imaWebUnchanged']=enabled('ima')is True\n except Exception:attempt['imaWebUnchanged']=False\n attempt['finalHashes']={rel:sha(root/rel)for rel in m['targets']}\n attempt['durationSeconds']")
 t=t.replace("assert success\n(stage/", "assert success\nfor rel,x in m['targets'].items():assert sha(root/rel)==x['sha256']\n(stage/")
 t=t.replace("routesChanged=False,coherentWebMedPause=True", "routesChanged=False,releaseSha256=m['releaseSha256'],officialProofSha256=m['officialProofSha256'],inspectionSha256=m['inspectionSha256'],abiUnchanged=True,apiWrapperRepublished=False,coherentWebMedPause=True")
 ast.parse(t);return t
def prepare_publication():
 # Deliberately first: no manifest/publisher/upload can appear without real proof.
 assert(B/'official-compile-verification.json').is_file(),'Official12.2 proof absent; publication is not generated'
 proof=proof_module().verify_proof();canonical=load(B/'canonical-manifest.json')
 assert canonical['success']and canonical['releaseSha256']==RELEASE and canonical['officialProofSha256']==sha(B/'official-compile-verification.json')and len(canonical['files'])==5
 for x in canonical['files']:assert sha(Path(x['target']))==x['sha256']
 before=load(D/'runtime-before.json');fresh_inspection(before,datetime.datetime.now(datetime.timezone.utc))
 abi=load(D/'abi-proof.json');assert sha(D/'abi-proof.json')==load(D/'runtime-preparation.json')['abiProofSha256']and abi['success']
 assert sha(Path(abi['wrapper']['path']))==abi['wrapper']['sha256']
 assert not any((D/n).exists()for n in ['publish-runtime.py','publication-manifest.json','publish-plan.json','publication-attempt.json','active-manifest.json']),'Previous publication preparation/attempt exists; inspect, never regenerate'
 targets={};uploads=[]
 for x in proof['files']:
  rel=x['relative'];assert rel in RELS and sha(W/x['source'])==x['sha256']
  if rel.endswith('.p'):
   found=[y for y in canonical['files']if Path(y['target']).name==x['file']];assert len(found)==1 and found[0]['before']==before['targets'][rel]['before']and found[0]['sha256']==x['sha256']
  targets[rel]=dict(file=x['file'],sha256=x['sha256'],before=before['targets'][rel]['before']);uploads.append(dict(local=x['source'],remote=REMOTE+'/'+x['file']))
 assert set(targets)==set(RELS)
 script=publisher_script();scriptsha=hashlib.sha256(script.encode()).hexdigest()
 manifest=dict(success=True,releaseSha256=RELEASE,targets=targets,transportBean='OewebTransportManager',medWebEnabledBefore=True,imaWebEnabledBefore=True,officialProofSha256=sha(B/'official-compile-verification.json'),canonicalReceiptSha256=sha(B/'canonical-manifest.json'),inspectionSha256=sha(D/'runtime-before.json'),inspectorSha256=sha(D/'inspect-runtime.py'),publicationScriptSha256=scriptsha,abiProofSha256=sha(D/'abi-proof.json'),businessWrites=False,routesChanged=False,apiWrapperRepublished=False)
 write_once(D/'publish-runtime.py',script);write_once(D/'publication-manifest.json',manifest)
 for name in ['publish-runtime.py','publication-manifest.json','runtime-before.json']:uploads.append(dict(local=str((D/name).relative_to(W)),remote=REMOTE+'/'+name))
 uploads.append(dict(local=str((B/'official-compile-verification.json').relative_to(W)),remote=REMOTE+'/official-compile-verification.json'))
 write_once(D/'publish-plan.json',dict(server='runtime',directories=[REMOTE],uploads=uploads,commands=['python3 '+REMOTE+'/publish-runtime.py'],downloads=[dict(local=str((D/name).relative_to(W)),remote=REMOTE+'/'+name)for name in ['active-manifest.json','publication-attempt.json']]))
def main():
 p=argparse.ArgumentParser();p.add_argument('--prepare-publication',action='store_true');args=p.parse_args()
 if args.prepare_publication:prepare_publication();print('PASS generated guarded4artifact publication; not executed')
 else:prepare_inspection();print('PASS prepared readonly4target inspector; publication files do not exist')
if __name__=='__main__':main()
