"""Root-only offline preparation. Default prepares readonly inspection, not publication."""
from pathlib import Path
import argparse,ast,datetime,hashlib,importlib.util,json
W=Path(__file__).resolve().parents[2];R=W/'.runtime/ciw-completion-20261028'
B=R/'official-build13-v3';D=R/'runtime-build13-v4';C=R/'build13-root-companions-v3'
RELEASE='7694b83727c554f9503cbafff4294f33c6da2f02bf2770dc4cc217d219cab9e9'
REMOTE='/tmp/ciw-completion-20261028-build13-v4'
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()if p.is_file()else None
def load(p):return json.loads(p.read_bytes())
def write_once(p,v):
 data=v.encode()if isinstance(v,str)else(json.dumps(v,ensure_ascii=False,indent=2)+'\n').encode();p.parent.mkdir(parents=True,exist_ok=True)
 if p.exists():assert p.read_bytes()==data,'Existing output differs; preserve '+str(p)
 else:
  with p.open('xb')as f:f.write(data)
def module(name):
 p=Path(__file__).with_name(name);s=importlib.util.spec_from_file_location(name,p);m=importlib.util.module_from_spec(s);s.loader.exec_module(m);return m
def rels():
 assert sha(B/'release.json')==RELEASE
 result=[x['relative']for x in load(B/'runtime-targets.json')['targets']]
 assert len(result)==len(set(result))==17 and result[0]=='sursum-api/includes/ContainersVersionComparisonTable.i'
 assert result[-2:]==['sursum-api/programs/CiwCadastrosCrud.p','sursum-api/programs/CiwCadastrosCrud.r']
 return result
def baselines():
 receipts=[('official-build3/active-manifest.json','5f23a359a7d29c0f37448b45c5172afcfa4e5af930ae8825b22fde3cf9b5051f'),('official-build6-v2/active-manifest.json','e08a30480eefda530706e9f70ea4a605a28cefd7e53b14f9c1b0449d6f7f6263'),('runtime-build11/active-manifest.json','26f74418c5fe81ce4526aaa4a3b60564462daba856bca3c6e52242aff375afad'),('runtime-build12/active-manifest.json','a4eddbc9a2ff7a3dd5e856e47e6b5737817b85ceadb4d459146cb46750209867')]
 result={x:None for x in rels()}
 for p,digest in receipts:
  assert sha(R/p)==digest,p
  m=load(R/p);assert m['success']and m['instance']=='sursum-api'and m['context']=='med'
  for rel in result:
   if rel in m['targets']:result[rel]=m['targets'][rel]['sha256']
 assert sum(x is None for x in result.values())==9
 return result,receipts
def prepare_inspection():
 before,receipts=baselines();old=module('prepare-ciw-build12-v3-runtime.py');script=old.INSPECTOR
 script=script.replace('__REMOTE__',REMOTE).replace('__EXPECTED__',repr(before))
 script=script.replace("sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()",'''def sha(p):
 if not p.exists():return None
 assert not p.is_symlink()and p.is_file()and p.stat().st_size<=64*1024*1024,'Unsafe/oversized target'
 return hashlib.sha256(p.read_bytes()).hexdigest()''')
 anchor="target=root/rel;assert not target.is_symlink()and target.is_file()and target.resolve().parent==(root/'sursum-api/programs').resolve(),'Nonregular/outside target'"
 assert anchor in script
 script=script.replace(anchor,"target=root/rel;assert not target.is_symlink()and target.parent.resolve()in[(root/'sursum-api/programs').resolve(),(root/'sursum-api/includes').resolve()],'Nonregular/outside target'\n assert not target.exists()or target.is_file(),'Nonregular target'")
 script=script.replace("observed=datetime.datetime.now(datetime.timezone.utc).isoformat()", "observed=datetime.datetime.now(datetime.timezone.utc).isoformat()\nassert not(stage/'inspection-attempt.json').exists()and not(stage/'runtime-before.json').exists(),'Prior inspection attempt; no replay'\nwith(stage/'inspection-attempt.json').open('x')as f:json.dump({'state':'STARTED','startedAtUtc':observed,'scriptSha256':sha(Path(__file__)),'businessWrites':False},f)")
 script=script.replace("print('PASS4 fresh hashes", "(stage/'inspection-attempt.json').write_text(json.dumps({'state':'COMPLETED','startedAtUtc':observed,'completedAtUtc':out['completedAtUtc'],'runtimeBeforeSha256':sha(stage/'runtime-before.json'),'businessWrites':False},indent=2)+'\\n');print('PASS17 fresh hashes")
 ast.parse(script)
 write_once(D/'inspect-runtime.py',script)
 write_once(D/'inspect-plan.json',dict(server='runtime',directories=[REMOTE],uploads=[dict(local=str((D/'inspect-runtime.py').relative_to(W)),remote=REMOTE+'/inspect-runtime.py',sha256=sha(D/'inspect-runtime.py'))],commands=['python3 '+REMOTE+'/inspect-runtime.py'],downloads=[dict(local=str((D/n).relative_to(W)),remote=REMOTE+'/'+n)for n in ['runtime-before.json','inspection-attempt.json']]))
 write_once(D/'runtime-preparation.json',dict(state='INSPECTOR_PREPARED_NOT_EXECUTED',releaseSha256=RELEASE,inspectorSha256=sha(D/'inspect-runtime.py'),inspectionPlanSha256=sha(D/'inspect-plan.json'),expectedRuntimeBaselines=before,baselineReceipts=[dict(path=p,sha256=h)for p,h in receipts],newAbsentTargets=9,existingTargets=8,freshInspectionSeconds=600,vendorImplementationReused=str(Path(old.__file__).relative_to(W)),publicationRequires=['official12.2 proof69/88/8020/269','canonical12-target receipt','fresh runtime-before <=600seconds'],publicationGenerated=False,noNetwork=True,noCanonicalWrite=True))
 return script
def fresh_inspection(before):
 expected,_=baselines();age=(datetime.datetime.now(datetime.timezone.utc)-datetime.datetime.fromisoformat(before['observedAtUtc'])).total_seconds()
 assert before['success']and before['mountConfirmed']and before['instance']=='sursum-api'and before['context']=='med'and 0<=age<=600
 assert before['inspectorSha256']==sha(D/'inspect-runtime.py')and before['targets']=={k:{'before':v}for k,v in expected.items()}
 assert before['allMedSessionsIdle']and before['businessWrites']is False and before['transportChanged']is False and before['runtimeChanged']is False
 assert before['transportBean']=='OewebTransportManager'and before['medWebTransport']==before['imaWebTransport']=={'isTransportEnabled':True}
 assert len(before['medAgents'])==1 and before['medAgents'][0]['state']=='AVAILABLE'
 rows=before['medSessionMetrics']['getSessionMetrics']['AgentSession'];assert rows and all(x['SessionState']=='IDLE'and x['ThreadId']==-1 for x in rows)
def prepare_publication():
 # This gate runs before any publication artifact is created.
 integration=module('prepare-ciw-build13-v3-integration.py');proof=integration.verify_proof();receipt=load(C/'canonical-manifest.json')
 assert receipt['success']and receipt['releaseSha256']==RELEASE and receipt['officialProofSha256']==sha(C/'official-compile-verification.json')and len(receipt['files'])==12
 for x in receipt['files']:assert sha(Path(x['target']))==x['sha256']
 before=load(D/'runtime-before.json');fresh_inspection(before)
 assert not any((D/n).exists()for n in ['publish-runtime.py','publication-manifest.json','publish-plan.json','publication-attempt.json','active-manifest.json'])
 script=publisher_script();targets={};uploads=[]
 for x in proof['files']:
  rel=x['relative'];assert rel in rels()and sha(W/x['source'])==x['sha256']
  if rel.endswith(('.p','.i')):
   found=[v for v in receipt['files']if Path(v['target']).name==x['file']];assert len(found)==1 and found[0]['before']==before['targets'][rel]['before']and found[0]['sha256']==x['sha256']
  targets[rel]=dict(file=x['file'],sha256=x['sha256'],before=before['targets'][rel]['before']);uploads.append(dict(local=x['source'],remote=REMOTE+'/'+x['file']))
 assert set(targets)==set(rels())
 manifest=dict(success=True,releaseSha256=RELEASE,targets=targets,transportBean='OewebTransportManager',officialProofSha256=sha(C/'official-compile-verification.json'),canonicalReceiptSha256=sha(C/'canonical-manifest.json'),inspectionSha256=sha(D/'runtime-before.json'),inspectorSha256=sha(D/'inspect-runtime.py'),publicationScriptSha256=hashlib.sha256(script.encode()).hexdigest(),businessWrites=False,routesChanged=False)
 write_once(D/'publish-runtime.py',script);write_once(D/'publication-manifest.json',manifest)
 for n in ['publish-runtime.py','publication-manifest.json','runtime-before.json']:uploads.append(dict(local=str((D/n).relative_to(W)),remote=REMOTE+'/'+n))
 uploads.append(dict(local=str((C/'official-compile-verification.json').relative_to(W)),remote=REMOTE+'/official-compile-verification.json'))
 write_once(D/'publish-plan.json',dict(server='runtime',directories=[REMOTE],uploads=uploads,commands=['python3 '+REMOTE+'/publish-runtime.py'],downloads=[dict(local=str((D/n).relative_to(W)),remote=REMOTE+'/'+n)for n in ['active-manifest.json','publication-attempt.json']]))
def publisher_script():
 # Reuse the published12 vendor transport/refresh/finally implementation verbatim.
 p=R/'runtime-build12/publish-runtime.py'
 assert sha(p)=='8d3fcfa6a1c1780ee5f0d5a2ad3c81adc798bb2b19f05d7d38b75e963546eadf'
 t=p.read_text()
 def replace(old,new):
  nonlocal t
  assert old in t,'Proven publisher anchor missing: '+old[:90]
  t=t.replace(old,new)
 replace('/tmp/ciw-completion-20261028-build12',REMOTE)
 replace("proof['totalChecks']==5704","proof['totalChecks']==8020")
 replace('and len(approved)==4','and len(approved)==17')
 start=t.index('expected=');end=t.index('\nassert set(m[',start)
 t=t[:start]+'expected=set('+repr(sorted(rels()))+')'+t[end:]
 replace('409a6bb3aca9dffac9412b7f90816acf62308f52d89ed651ec4720b86f562a7b',RELEASE)
 replace("proof['compileCount']==42","proof['compileCount']==69")
 replace("proof['testLogs']==28","proof['testLogs']==88 and proof['downloadCount']==269")
 replace("and x['before']is not None", "and x['before']=="+repr(baselines()[0])+"[rel]")
 replace("assert not(stage/'active-manifest.json').exists()and not(stage/'publication-attempt.json').exists()", "assert not(stage/'active-manifest.json').exists()and not(stage/'publication-attempt.json').exists()and not(stage/'backup-before').exists()")
 replace("assert not(root/rel).is_symlink() and (not(root/rel).exists()or(root/rel).is_file()),'Non-regular target '+rel", "assert not(root/rel).is_symlink()and(root/rel).parent.resolve()in[(root/'sursum-api/programs').resolve(),(root/'sursum-api/includes').resolve()]and(not(root/rel).exists()or(root/rel).is_file()),'Non-regular/outside target '+rel")
 priority=['ContainersVersionComparisonTable','ContainersVersionService','ContainersVersionHistoryLabels','ContainersVersionComparisonProjection','ContainersVersionComparisonMaterializer','ContainersVersionComparisonService','ContainersVersionComparisonApi','CiwErpReadService','CiwCadastrosCrud']
 replace("priority=['CiwErpReadService','ContainersPainelFinanceReadService']",'priority='+repr(priority))
 replace("assert len(order)==4 and [Path(x).stem for x in order[-2:]]==['ContainersPainelFinanceReadService','ContainersPainelFinanceReadService']", "assert len(order)==17 and order[0]=='sursum-api/includes/ContainersVersionComparisonTable.i'and[Path(x).stem for x in order[-2:]]==['CiwCadastrosCrud','CiwCadastrosCrud']")
 replace("'targets':4", "'targets':17,'startedAtUtc':datetime.datetime.now(datetime.timezone.utc).isoformat()")
 replace("os.replace(temp,target);written.append(rel)","os.replace(temp,target);written.append(rel);attempt['written']=list(written);(stage/'publication-attempt.json').write_text(json.dumps(attempt,indent=2))")
 replace("   saved=backup/Path(rel).name;assert sha(saved)==x['before']", "   if x['before']is None:\n    (root/rel).unlink();continue\n   saved=backup/Path(rel).name;assert sha(saved)==x['before']")
 replace("attempt['durationSeconds']=round(time.monotonic()-started,3)", "attempt['completedAtUtc']=datetime.datetime.now(datetime.timezone.utc).isoformat();attempt['durationSeconds']=round(time.monotonic()-started,3)")
 replace('completion-build12','completion-build13-v4')
 replace('apiWrapperRepublished=False','apiWrapperRepublished=True')
 replace("print('PASS4official12.2 artifacts", "print('PASS17official12.2 artifacts")
 ast.parse(t)
 # Guard against accidental mutation of vendor calls/configuration during derivation.
 old=p.read_text()
 for name,nextname in [('query','bean='),('enabled','assert enabled'),('sessions','def idle'),('idle','assert idle'),('refresh_med','backup=')]:
  anchor='def '+name+'(';a=old[old.index(anchor):old.index('\n'+nextname,old.index(anchor))]
  b=t[t.index(anchor):t.index('\n'+nextname,t.index(anchor))];assert a==b,'Vendor helper changed '+name
 return t
if __name__=='__main__':
 p=argparse.ArgumentParser();p.add_argument('--prepare-publication',action='store_true');a=p.parse_args()
 if a.prepare_publication:prepare_publication()
 else:prepare_inspection();print('PASS prepared17target readonly inspector; not executed')
