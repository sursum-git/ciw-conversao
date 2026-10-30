"""Inspect only fixed DSN transport configuration; no connection or SQL call."""
from pathlib import Path
import sys, json, getpass
ROOT=Path(__file__).resolve().parents[2]
sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
target=ROOT/'.runtime/ciw-completion-20261028/sql-fixed-dsn-transport-readonly-v1.json'
assert not target.exists(), 'Inspect existing receipt; do not replay'
remote=r'''
import configparser,json,os,socket,re
result={'success':True,'profile':'espec_pro','configurations':[],'connectionAttempted':False,'sqlExecuted':False,'businessReads':False,'businessWrites':False}
allowed={'hostname','host','servername','server','portnumber','port','servicename','service','databasename','database','driver','description','servertype','protocol'}
for filename in ['/etc/odbc.ini','/usr/local/etc/odbc.ini']:
 if not os.path.isfile(filename):continue
 config=configparser.ConfigParser(interpolation=None,strict=False)
 try:
  config.read(filename)
  if not config.has_section('espec_pro'):continue
  row={'file':filename,'transport':{}}
  for key,value in config.items('espec_pro'):
   normalized=re.sub('[^a-z]','',key.lower())
   if normalized not in allowed:continue
   if not re.fullmatch(r'[A-Za-z0-9 _./:\\()@-]{1,256}',value):
    row['transport'][normalized]='UNSUPPORTED_VALUE_OMITTED';continue
   row['transport'][normalized]=value
   if normalized=='driver':row['driverFileExists']=os.path.isfile(value)
   if normalized in ('servicename','service','port','portnumber'):
    try:row['resolvedTcpPort']=int(value) if value.isdecimal() else socket.getservbyname(value,'tcp')
    except (ValueError,OSError):row['resolvedTcpPort']=None
  result['configurations'].append(row)
 except Exception:result['success']=False
print(json.dumps(result))
'''
client=paramiko.SSHClient();client.load_host_keys(str(Path.home()/'.ssh/known_hosts'));client.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 client.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 inp,out,err=client.exec_command('python3 -',timeout=25);inp.write(remote);inp.flush();inp.channel.shutdown_write()
 raw=out.read();err.read();assert out.channel.recv_exit_status()==0,'Closed configuration inspection failed'
 result=json.loads(raw);assert result['connectionAttempted'] is False and result['sqlExecuted'] is False
 target.write_text(json.dumps(result,indent=2)+'\n');print(json.dumps(result))
finally:password=None;client.close()
