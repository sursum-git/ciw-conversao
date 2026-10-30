"""Run only a compiled filesystem SEARCH diagnostic with configured MED PROPATH."""
from pathlib import Path
import json, hashlib
root=Path(__file__).resolve().parents[2]
base=root/'.runtime/ciw-completion-20261028/currency-trigger-search-v1'
log=(base/'compile.log').read_text()
assert 'OpenEdge 12.2' in log and 'NUMDBS=0' in log and 'ERROR=no' in log and 'PASS COMPILE' in log
stage='/tmp/ciw-currency-trigger-search-20261028-v1'
script='''from pathlib import Path
import json,subprocess,os,hashlib
stage=Path(STAGE)
assert not(stage/'trigger-search-private.json').exists(),'No replay: inspect prior outcome'
assert hashlib.sha256((stage/'CurrencyTriggerSearch.r').read_bytes()).hexdigest()==RCODESHA
instance=Path('/dados/pasoe/sursum-api')
props=instance/'conf/openedge.properties'
raw=props.read_bytes()
lines=[x.strip().split('=',1)[1] for x in raw.decode().splitlines() if x.strip().startswith('PROPATH=') and '${CATALINA_BASE}/webapps/med/WEB-INF/openedge' in x]
assert len(lines)==1,'Exact configured MED PROPATH required'
propath=lines[0].replace('${CATALINA_BASE}',str(instance)).replace('${DLC}','/usr/dlc12')
assert '${'not in propath and propath.split(',')[0]==str(instance/'webapps/med/WEB-INF/openedge')
env=dict(os.environ,DLC='/usr/dlc12',PROPATH=propath)
completed=subprocess.run(['/usr/dlc12/bin/_progres','-b','-cpinternal','UTF-8','-cpstream','UTF-8','-p',str(stage/'CurrencyTriggerSearch.r'),'-T',str(stage)],cwd=stage,env=env,stdout=subprocess.PIPE,stderr=subprocess.PIPE,timeout=25)
(stage/'probe-process.log').write_bytes(completed.stdout+completed.stderr)
assert completed.returncode==0 and props.read_bytes()==raw,'Probe failed or configuration changed concurrently'
data=json.loads((stage/'trigger-search-private.json').read_text())
assert data['openEdge'].startswith('12.2')and data['numDbs']==0 and data['propath']==propath
assert data['businessReads']is False and data['businessWrites']is False and data['triggersExecuted']is False
assert [x['requested']for x in data['triggers']]==['database/tgun/tdp/tdun003.p','database/tguni/tcp/tcuni003.p','database/tguni/tdp/tduni003.p','database/tguni/twp/twuni003.p']
for row in data['triggers']:
 for key in ['sourceResolved','rcodeResolved']:
  if key not in row:continue
  resolved=row[key];physical=Path(resolved.split('<<',1)[0])
  assert physical.is_absolute(),'Unclassified relative SEARCH result'
  info={'path':str(physical),'exists':physical.exists(),'symlink':physical.is_symlink()}
  if physical.is_file():
   info['bytes']=physical.stat().st_size
   if info['bytes']<=67108864:info['sha256']=hashlib.sha256(physical.read_bytes()).hexdigest()
   else:info['hashOmitted']='bounded64MiB'
  row[key+'Physical']=info
data.update(success=True,instance='sursum-api',context='med',configuredPropathOnly=True,liveAgentPropathClaimed=False,globalConfigChanged=False,configurationSha256=hashlib.sha256(raw).hexdigest())
(stage/'trigger-search-private.json').write_text(json.dumps(data,indent=2)+'\\n')
print(json.dumps(dict(success=True,numDbs=0,triggers=[dict(requested=x['requested'],sourceFound=x['sourceFound'],rcodeFound=x['rcodeFound'])for x in data['triggers']],triggersExecuted=False,businessWrites=False)))
'''.replace('STAGE',repr(stage)).replace('RCODESHA',repr(hashlib.sha256((base/'CurrencyTriggerSearch.r').read_bytes()).hexdigest()))
(base/'runtime-search.py').write_text(script)
plan=dict(server='runtime',directories=[stage],uploads=[dict(local=str((base/n).relative_to(root)),remote=stage+'/'+n)for n in ['CurrencyTriggerSearch.r','runtime-search.py']],commands=['python3 '+stage+'/runtime-search.py'],downloads=[dict(local=str((base/n).relative_to(root)),remote=stage+'/'+n)for n in ['trigger-search-private.json','probe-process.log']])
(base/'runtime-plan.json').write_text(json.dumps(plan,indent=2)+'\n')
print('Prepared scratch-only runtime SEARCH with configured MED PROPATH; no agent/config or business changes')
