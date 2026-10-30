"""Resolve the observed named ODBC driver; never connects to a database."""
from pathlib import Path
import sys,json,getpass
ROOT=Path(__file__).resolve().parents[2]
sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
target=ROOT/'.runtime/ciw-completion-20261028/sql-fixed-driver-readonly-v1.json'
assert not target.exists()
observed=json.loads((target.parent/'sql-fixed-dsn-transport-readonly-v1.json').read_text())
assert observed['configurations'][0]['transport']=={'driver':'Progress OpenEdge 11 Driver','databasename':'espec','portnumber':'10112','hostname':'192.168.0.111'}
remote=r'''
import configparser,json,os,re
result={'success':True,'driverName':'Progress OpenEdge 11 Driver','registrations':[],'connectionAttempted':False,'sqlExecuted':False,'businessReads':False,'businessWrites':False}
for filename in ['/etc/odbcinst.ini','/usr/local/etc/odbcinst.ini']:
 if not os.path.isfile(filename):continue
 config=configparser.ConfigParser(interpolation=None,strict=False)
 try:
  config.read(filename)
  if not config.has_section(result['driverName']):continue
  row={'file':filename,'libraries':{}}
  for name in ('Driver','Driver64','Setup','Setup64'):
   value=config.get(result['driverName'],name,fallback=None)
   if value is None:continue
   if not re.fullmatch(r'/[A-Za-z0-9_./-]{1,255}',value):row['libraries'][name]={'recognizedAbsolutePath':False};continue
   row['libraries'][name]={'recognizedAbsolutePath':True,'path':value,'exists':os.path.isfile(value),'symlink':os.path.islink(value)}
  result['registrations'].append(row)
 except Exception:result['success']=False
print(json.dumps(result))
'''
c=paramiko.SSHClient();c.load_host_keys(str(Path.home()/'.ssh/known_hosts'));c.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 c.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 inp,out,err=c.exec_command('python3 -',timeout=25);inp.write(remote);inp.flush();inp.channel.shutdown_write();raw=out.read();err.read();assert out.channel.recv_exit_status()==0,'Closed driver registry inspection failed'
 result=json.loads(raw);target.write_text(json.dumps(result,indent=2)+'\n');print(json.dumps(result))
finally:password=None;c.close()
