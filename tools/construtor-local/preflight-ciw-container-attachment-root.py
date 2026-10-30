"""Fixed-root readonly storage comparison; never loads broker key or executes legacy PHP."""
from pathlib import Path
import getpass,json,sys,re
ROOT=Path(__file__).resolve().parents[2]
sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
base=ROOT/'.runtime/ciw-completion-20261028/container-attachments-download'
assert sys.argv[1:]in ([],['--observed-probe'],['--recent-probe'],['--all-observed-probe']),'Closed preflight mode required'
observed=bool(sys.argv[1:]);recent=sys.argv[1:]==['--recent-probe'];allObserved=sys.argv[1:]==['--all-observed-probe']
receipt=base/('document-all-observed-files-preflight.json'if allObserved else'document-recent-files-preflight.json'if recent else'document-files-preflight.json'if observed else'document-root-preflight.json')
assert not receipt.exists(),'Inspect prior preflight; do not replay'
if observed:
 probeDir=base.parent/'attachment-identity-readonly-probe'
 if recent:probeDir=probeDir/'recent-v1.1'
 if allObserved:probeDir=probeDir/'all-v1.2'
 proof=json.loads((probeDir/'results/attachment-identity-private.json').read_text(encoding='utf-8'))
 log=(probeDir/'results/compile.log').read_text(encoding='utf-8-sig')
 assert 'PASS COMPILE'in log and'ERROR=no'in log and'FAIL'not in log and'OpenEdge 12.2'in log
 assert proof['completed']and not proof['partial']and proof['numDbs']==1 and proof['openEdge'].startswith('12.2')and proof['physicalReads']<=50000
 assert 0<proof['foundCount']==len(proof['pairs'])<=(200 if allObserved else 5)
 refs={'success':True,'references':[dict(id=p['anexo_container_id'],container_id=p['container_id'],reference=p['basename'])for p in proof['pairs']]}
else:refs=json.loads((base/'references-preflight-private.json').read_text(encoding='utf-8'))
assert refs['success'] and len(refs['references'])<=(200 if allObserved else 5)
for entry in refs['references']:
 assert isinstance(entry['container_id'],int)and entry['container_id']>0 and isinstance(entry['id'],int)and entry['id']>0
 if not observed:assert entry['container_id']==332526
 assert isinstance(entry['reference'],str) and len(entry['reference'])<=255 and not re.search(r'[\\/\x00-\x1f]',entry['reference']) and entry['reference']not in('.','..')
remote=r'''
import os,re,json,hashlib,stat
expected='/var/www/clients/client1/web2/web/ciw/_lib/file/doc'
bootstrap='/var/www/clients/client1/web2/private/ciw-attachments/bootstrap.php'
with open(bootstrap,'rb')as f:code=f.read()
match=re.search(rb"'root'\s*=>\s*'([^']+)'",code)
root=match.group(1).decode('utf-8')if match else None
same=root==expected
result={'success':False,'preflightScope':'root comparison; file availability only if sampled references exist','fileAvailabilityValidated':False,'readOnly':True,'documentWrites':False,'configurationChanged':False,'brokerRootMatchesLegacyDoc':same,'rootExists':False,'rootSymlink':None,'references':[],'bootstrapSha256':hashlib.sha256(code).hexdigest()}
if same:
 result['rootExists']=os.path.isdir(root);result['rootSymlink']=os.path.islink(root)
 if result['rootExists']and not result['rootSymlink']:
  for item in REFERENCES:
   path=os.path.join(root,item['reference']);exists=os.path.exists(path)
   safe=exists and not os.path.islink(path)and os.path.isfile(path)and os.path.dirname(os.path.realpath(path))==os.path.realpath(root)
   result['references'].append({'id':item['id'],'container_id':item['container_id'],'exists':exists,'regularReadableFile':safe and os.access(path,os.R_OK),'size':os.stat(path).st_size if safe else None})
 result['success']=result['rootExists']and not result['rootSymlink']and all(x['regularReadableFile']for x in result['references'])
 result['fileAvailabilityValidated']=result['success']and len(result['references'])>0
print(json.dumps(result))
'''
remote=remote.replace('REFERENCES',repr(refs['references']))
client=paramiko.SSHClient();client.load_host_keys(str(Path.home()/'.ssh/known_hosts'));client.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 client.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 inp,out,err=client.exec_command('python3 -',timeout=60);inp.write(remote);inp.flush();inp.channel.shutdown_write();raw=out.read();err.read()
 assert out.channel.recv_exit_status()==0,'Bounded root preflight failed; raw output omitted'
 result=json.loads(raw)
 result['availableCount']=sum(1 for row in result['references']if row['regularReadableFile'])
 result['missingCount']=sum(1 for row in result['references']if not row['exists'])
 result['positiveFileAvailability']=result['availableCount']>0
 receipt.write_text(json.dumps(result,indent=2)+'\n',encoding='utf-8')
 print(json.dumps({k:v for k,v in result.items()if k!='references'}))
finally:password=None;client.close()
