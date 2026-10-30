"""Inspect only InstallDir and fixed driver message catalogs; no connection."""
from pathlib import Path
import sys,json,getpass
ROOT=Path(__file__).resolve().parents[2];sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
target=ROOT/'.runtime/ciw-completion-20261028/sql-fixed-odbc-messages-readonly-v1.json';assert not target.exists()
remote=r'''
from pathlib import Path
import configparser,json,gettext
result={'success':True,'installationSettings':[],'messageFiles':[],'translations':[],'connectionAttempted':False,'sqlExecuted':False,'businessReads':False,'businessWrites':False}
for filename in ['/etc/odbc.ini','/etc/odbcinst.ini']:
 config=configparser.ConfigParser(interpolation=None,strict=False)
 config.read(filename)
 if config.has_section('ODBC'):
  value=config.get('ODBC','InstallDir',fallback=None)
  result['installationSettings'].append({'file':filename,'installDir':value,'exists':Path(value).is_dir() if value and value.startswith('/') else False})
folder=Path('/usr/dlc/odbc/locale/en_US/LC_MESSAGES')
result['fixedLocaleDirectoryExists']=folder.is_dir()
if folder.is_dir():
 for file in folder.iterdir():
  if not file.is_file() or len(result['messageFiles'])>=40:continue
  result['messageFiles'].append({'name':file.name,'bytes':file.stat().st_size})
  if file.suffix!='.mo':continue
  try:
   with file.open('rb') as stream:catalog=gettext.GNUTranslations(stream)
   for code in ['20101','1201','60']:
    translated=catalog.gettext(code)
    if translated!=code:result['translations'].append({'file':file.name,'code':code,'message':translated})
  except (OSError,ValueError,EOFError):pass
print(json.dumps(result))
'''
c=paramiko.SSHClient();c.load_host_keys(str(Path.home()/'.ssh/known_hosts'));c.set_missing_host_key_policy(paramiko.RejectPolicy());password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 c.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 inp,out,err=c.exec_command('python3 -',timeout=25);inp.write(remote);inp.flush();inp.channel.shutdown_write();raw=out.read();err.read();assert out.channel.recv_exit_status()==0,'Closed message catalog inspection failed'
 result=json.loads(raw);target.write_text(json.dumps(result,indent=2)+'\n');print(json.dumps(result))
finally:password=None;c.close()
