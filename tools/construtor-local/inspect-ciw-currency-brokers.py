"""Read only the two documented ABL broker identities; never reads credentials or business rows."""
from pathlib import Path
import getpass,json,sys,inspect,shlex,os,socket
R=Path(__file__).resolve().parents[2];sys.path.insert(0,str(R/'.runtime/ssh-deps'))
import paramiko
target=R/'.runtime/ciw-completion-20261028/daily-currency-login-sync/dictionary-probe/current-brokers-readonly-v3.json'
assert not target.exists(),'Inspect previous broker receipt; no replay'
def parse_brokers(lines):
 rows=[];count=0;services=[]
 for line in lines:
  try:args=shlex.split(line)
  except ValueError:continue
  if not args or os.path.basename(args[0])!='_mprosrv':continue
  count+=1
  ports=[args[n+1]for n,v in enumerate(args[:-1])if v=='-S']
  names=[args[n+1]for n,v in enumerate(args[:-1])if v=='-db']
  if not names and len(args)>1 and not args[1].startswith('-'):names=[args[1]]
  if len(ports)!=1:continue
  service=ports[0];services.append(service)
  try:port=int(service)if service.isdecimal()else socket.getservbyname(service,'tcp')
  except (OSError,ValueError):continue
  if port in(10033,10032):
   rows.append({'databaseBasename':os.path.basename(names[0])if len(names)==1 else None,'service':service,'port':port,'host':'192.168.0.111'})
 return {'success':len(rows)==2 and sorted(x['port']for x in rows)==[10032,10033]and all(x['databaseBasename']for x in rows),'readOnly':True,'businessReads':False,'businessWrites':False,'brokerProcessesObserved':count,'observedServices':services,'brokers':rows}
assert parse_brokers(['/usr/dlc12/bin/_mprosrv /a/ems2cad -S 10033','/usr/dlc12/bin/_mprosrv -db /b/ems5 -S 10032'])['success']
assert not parse_brokers(['/usr/dlc12/bin/_mprosrv /a/espec -S 10012'])['success']
remote='import subprocess,json,shlex,os,socket\n'+inspect.getsource(parse_brokers)+"\nprint(json.dumps(parse_brokers(subprocess.check_output(['ps','-eo','args'],universal_newlines=True).splitlines())))\n"
client=paramiko.SSHClient();client.load_host_keys(str(Path.home()/'.ssh/known_hosts'));client.set_missing_host_key_policy(paramiko.RejectPolicy());password=getpass.getpass('Senha SSH PASOE (somente memoria): ')
try:
 client.connect('192.168.0.111',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 inp,out,err=client.exec_command('python3 -',timeout=30);inp.write(remote);inp.flush();inp.channel.shutdown_write();raw=out.read();err.read();assert out.channel.recv_exit_status()==0,'Closed broker inspection unavailable'
 result=json.loads(raw);target.write_text(json.dumps(result,indent=2)+'\n',encoding='utf-8');print(json.dumps({k:v for k,v in result.items()if k!='observedServices'}))
finally:password=None;client.close()
