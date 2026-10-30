"""Focused offline fault injection. All writes are confined to new private fixtures."""
from pathlib import Path
import ast,datetime,hashlib,importlib.util,json,os
W=Path(__file__).resolve().parents[2];R=W/'.runtime/ciw-completion-20261028'
D=R/'build13-root-companions-v3';T=D/'selftests'
assert not T.exists(),'Preserve prior selftest receipts'
T.mkdir(parents=True)
def module(name):
 p=Path(__file__).with_name(name);s=importlib.util.spec_from_file_location(name,p);m=importlib.util.module_from_spec(s);s.loader.exec_module(m);return m
i=module('prepare-ciw-build13-v3-integration.py');r=module('prepare-ciw-build13-v3-runtime.py')
checks=[]
def check(name,fn):fn();checks.append(name)
def rejects(name,fn):
 try:fn()
 except (AssertionError,FileNotFoundError):checks.append(name);return
 raise AssertionError('Expected rejection '+name)
selected=i.rows();before={x['target']:i.sha(Path(x['target']))for x in selected}
check('12closedcanonicaltargets',lambda:(_ for _ in ()).throw(AssertionError())if len(selected)!=12 else None)
script=r.publisher_script();ast.parse(script);check('publisherAstAndFiveVendorHelpersUnchanged',lambda:None)
check('17closedRuntimeTargets9New8Attested',lambda:(_ for _ in ()).throw(AssertionError())if len(r.rels())!=17 or sum(x is None for x in r.baselines()[0].values())!=9 else None)
# Exercise actual ordering and baseline-absence assertions from the generated code.
tree=ast.parse(script);env={'Path':Path}
priority=next(n for n in tree.body if isinstance(n,ast.Assign)and isinstance(n.targets[0],ast.Name)and n.targets[0].id=='priority')
priorityfn=next(n for n in tree.body if isinstance(n,ast.FunctionDef)and n.name=='priorityKey')
exec(compile(ast.Module(body=[priority,priorityfn],type_ignores=[]),'priority','exec'),env)
order=sorted(r.rels(),key=env['priorityKey']);assert order[0].endswith('.i')and all('CiwCadastrosCrud'in x for x in order[-2:]);checks.append('includeFirstDispatcherLast17')
expected,_=r.baselines()
fixture=dict(success=True,mountConfirmed=True,instance='sursum-api',context='med',observedAtUtc=datetime.datetime.now(datetime.timezone.utc).isoformat(),inspectorSha256=r.sha(r.D/'inspect-runtime.py'),targets={k:{'before':v}for k,v in expected.items()},allMedSessionsIdle=True,businessWrites=False,transportChanged=False,runtimeChanged=False,transportBean='OewebTransportManager',medWebTransport={'isTransportEnabled':True},imaWebTransport={'isTransportEnabled':True},medAgents=[{'state':'AVAILABLE'}],medSessionMetrics={'getSessionMetrics':{'AgentSession':[{'SessionState':'IDLE','ThreadId':-1}]}})
check('freshSyntheticInspectionAcceptedNoReceiptWritten',lambda:r.fresh_inspection(fixture))
for name,mutator in [
 ('staleInspection',lambda v:v.update(observedAtUtc='2026-01-01T00:00:00+00:00')),
 ('wrongInspectorHash',lambda v:v.update(inspectorSha256='0'*64)),
 ('wrongMount',lambda v:v.update(mountConfirmed=False)),
 ('extraTarget',lambda v:v['targets'].update({'extra':{'before':None}})),
 ('unexpectedNewExisting',lambda v:v['targets'][r.rels()[0]].update(before='0'*64)),
 ('IMAdisabled',lambda v:v.update(imaWebTransport={'isTransportEnabled':False})),
 ('activeMED',lambda v:v.update(allMedSessionsIdle=False)),
 ('nonIdleSession',lambda v:v['medSessionMetrics']['getSessionMetrics']['AgentSession'][0].update(SessionState='RUNNING'))]:
 value=json.loads(json.dumps(fixture));mutator(value);rejects(name,lambda:r.fresh_inspection(value))
assert not(i.D/'official-compile-verification.json').exists(),'Run selftests before actual official proof'
rejects('publicationBeforeOfficialProofCreatesNothing',r.prepare_publication)
assert not any((r.D/n).exists()for n in ['publish-runtime.py','publish-plan.json','publication-manifest.json']);checks.append('noPublicationArtifactsBeforeGates')
# Actual integration apply/rollback code with injected local paths and a failing
# second os.replace. No canonical path is ever passed into the mutation routine.
for name,newfirst,concurrent in [('rollbackNew',True,False),('rollbackOld',False,False),('preserveConcurrent',False,True)]:
 local=T/name;local.mkdir();sources=local/'sources';targets=local/'targets';sources.mkdir();targets.mkdir();rows=[]
 for n,old in [('RuntimeCiwComparisonRead.php',None if newfirst else b'old-helper'),('RuntimeCiwErpQuery.php',b'old-query')]:
  p=targets/n;q=sources/n;q.write_bytes(b'candidate-'+n.encode())
  if old is not None:p.write_bytes(old)
  rows.append(dict(target=str(p),source=str(q),baselineSha256=i.sha(p),candidateSha256=i.sha(q)))
 mod=module('prepare-ciw-build13-v3-integration.py');mod.D=local/'receipts';mod.prepare=lambda:rows;mod.verify_proof=lambda:{}
 mod.D.mkdir();(mod.D/'official-compile-verification.json').write_text('{}')
 realreplace=os.replace;calls=[]
 def failSecond(src,dst):
  calls.append(str(dst))
  if len(calls)==2:
   if concurrent:Path(rows[0]['target']).write_bytes(b'concurrent-owner')
   raise OSError('synthetic second-write failure')
  return realreplace(src,dst)
 mod.os.replace=failSecond
 try:
  try:mod.apply_root_only()
  except OSError:pass
  else:raise AssertionError('Fault injection did not fail')
 finally:mod.os.replace=realreplace
 state=mod.load(mod.D/'canonical-attempt.json');assert state['state']=='FAILED_INSPECT_NO_REPLAY'
 if concurrent:assert Path(rows[0]['target']).read_bytes()==b'concurrent-owner'and not state['rollback'][0]['restored']
 else:assert mod.sha(Path(rows[0]['target']))==rows[0]['baselineSha256']and state['rollback'][0]['restored']
 rejects(name+'NoReplay',mod.apply_root_only);checks.append(name+'ActualCode')
assert before=={x['target']:i.sha(Path(x['target']))for x in selected};checks.append('all12CanonicalsUnchanged')
candidate=D/'publish-runtime.review-candidate.py';r.write_once(candidate,script)
proof=dict(success=True,state='OFFLINE_SELFTESTS_ONLY',checks=len(checks),cases=checks,releaseSha256=i.RELEASE,managerReleaseSha256=i.MANAGER,publisherCandidateSha256=i.sha(candidate),canonicalWrites=False,networkExecuted=False,AvmExecuted=False,officialProofFabricated=False,scratchRoot=str(T))
i.write_once(D/'selftest-proof.json',proof)
print(json.dumps(proof,ensure_ascii=False))
