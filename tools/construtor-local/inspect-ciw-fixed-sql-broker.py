"""Observe only espec brokers and the already-configured SQL listener10112."""
from pathlib import Path
import sys,json,getpass
ROOT=Path(__file__).resolve().parents[2]
sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
target=ROOT/'.runtime/ciw-completion-20261028/sql-fixed-broker-readonly-v1.json'
assert not target.exists()
remote=r'''
import subprocess,json,shlex,os,socket
brokers=[]
for line in subprocess.check_output(['ps','-eo','args'],universal_newlines=True).splitlines():
 try:args=shlex.split(line)
 except ValueError:continue
 if not args or os.path.basename(args[0])!='_mprosrv':continue
 names=[args[n+1] for n,v in enumerate(args[:-1]) if v=='-db']
 if not names and len(args)>1 and not args[1].startswith('-'):names=[args[1]]
 if len(names)!=1 or os.path.basename(names[0])!='espec':continue
 services=[args[n+1] for n,v in enumerate(args[:-1]) if v=='-S']
 if len(services)!=1:continue
 try:port=int(services[0]) if services[0].isdecimal() else socket.getservbyname(services[0],'tcp')
 except (OSError,ValueError):port=None
 types=[args[n+1] for n,v in enumerate(args[:-1]) if v.lower()=='-servertype']
 brokers.append({'databaseBasename':'espec','service':services[0],'tcpPort':port,'serverType':types[0] if len(types)==1 and types[0] in ('SQL','4GL','BOTH') else None})
listeners=[]
for line in subprocess.check_output(['ss','-ltnH'],universal_newlines=True).splitlines():
 parts=line.split()
 if len(parts)>3 and parts[3].rsplit(':',1)[-1]=='10112':listeners.append({'tcpPort':10112,'listening':True})
print(json.dumps({'success':True,'brokers':brokers,'fixedSqlListeners':listeners,'connectionAttempted':False,'sqlExecuted':False,'businessReads':False,'businessWrites':False}))
'''
c=paramiko.SSHClient();c.load_host_keys(str(Path.home()/'.ssh/known_hosts'));c.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha SSH PASOE (somente memoria): ')
try:
 c.connect('192.168.0.111',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 inp,out,err=c.exec_command('python3 -',timeout=25);inp.write(remote);inp.flush();inp.channel.shutdown_write();raw=out.read();err.read();assert out.channel.recv_exit_status()==0,'Closed broker inspection failed'
 result=json.loads(raw);target.write_text(json.dumps(result,indent=2)+'\n');print(json.dumps(result))
finally:password=None;c.close()
