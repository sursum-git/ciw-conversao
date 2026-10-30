"""Inspect21runtime artifact hashes and vendor WEB transport metadata/state, read-only."""
from pathlib import Path
import json
r=Path(__file__).resolve().parents[2];b=r/'.runtime/ciw-completion-20261028/official-build6-v2';stage='/tmp/ciw-completion-20261028-wave3'
proof=json.loads((b/'official-compile-verification.json').read_text());assert proof['success']and len(proof['files'])==21
rels=[x['relative']for x in proof['files']]
script='''from pathlib import Path
import json,hashlib,subprocess,re
root=Path('/mnt/datasul/ERP/sursum');stage=Path(STAGE);instance=Path('/dados/pasoe/sursum-api')
assert '192.168.0.137'in subprocess.check_output(['findmnt','-n','-o','SOURCE','-T',str(root)],universal_newlines=True)
rels=RELS;targets={rel:{'before':hashlib.sha256((root/rel).read_bytes()).hexdigest()if(root/rel).is_file()else None}for rel in rels}
def query(bean,method,*args):
 proc=subprocess.run(['bash',str(instance/'bin/oejmx.sh'),'-Q',json.dumps({'O':'PASOE:type=OEManager,name='+bean,'M':[method,*args]},separators=(',',':'))],cwd=instance,stdout=subprocess.PIPE,stderr=subprocess.PIPE,universal_newlines=True,timeout=45)
 assert proc.returncode==0,'Vendor inspection failed '+method
 for line in proc.stdout.splitlines():
  if line.strip().startswith('{'):return json.loads(line)
 raise RuntimeError('No vendor JSON '+method)
proc=subprocess.run(['bash',str(instance/'bin/oejmx.sh'),'-C','-O',str(stage/'beans-metadata.txt')],cwd=instance,stdout=subprocess.PIPE,stderr=subprocess.PIPE,universal_newlines=True,timeout=45)
assert proc.returncode==0 and(stage/'beans-metadata.txt').is_file(),'Vendor MBean metadata unavailable'
metadata=(stage/'beans-metadata.txt').read_text();names=sorted(set(re.findall(r'PASOE:type=OEManager,name=([A-Za-z]*[Ww]ebTransportManager)',metadata)))
out={'success':True,'mountConfirmed':True,'targets':targets,'transportManagers':names,'businessWrites':False,'transportChanged':False}
if 'OewebTransportManager'in names:
 bean='OewebTransportManager';out['transportBean']=bean;out['medWebTransport']=query(bean,'isTransportEnabled','med','med');out['imaWebTransport']=query(bean,'isTransportEnabled','ima','ima')
 out['supportedOperations']={name:('Operation: '+name+'('in metadata)for name in ['disableTransport','enableTransport','isTransportEnabled']}
agents=query('AgentManager','getAgents','med')['getAgents']['agents'];out['medAgents']=agents
assert len(agents)==1 and agents[0]['state']=='AVAILABLE'
pid=str(agents[0]['pid']);assert str((Path('/proc')/pid/'cwd').resolve())=='/dados/pasoe/sursum-api/work'
out['medSessionMetrics']=query('AgentManager','getSessionMetrics',agents[0]['agentId'])
(stage/'runtime-before.json').write_text(json.dumps(out,indent=2));print('PASS21runtime hashes/vendor WEB metadata inspected readonly; no transport/session/runtime mutation')
'''.replace('STAGE',repr(stage)).replace('RELS',repr(rels))
(b/'inspect-runtime.py').write_text(script)
plan=dict(server='runtime',directories=[stage],uploads=[dict(local=str((b/'inspect-runtime.py').relative_to(r)),remote=stage+'/inspect-runtime.py')],commands=['python3 '+stage+'/inspect-runtime.py'],downloads=[dict(local=str((b/'runtime-before.json').relative_to(r)),remote=stage+'/runtime-before.json')]);(b/'inspect-runtime-plan.json').write_text(json.dumps(plan,indent=2)+'\n')
print('Prepared21artifact readonly hashes and vendor transport metadata inspection')
