"""Inspect fixed CLI/driver architecture and dependencies, without connecting."""
from pathlib import Path
import sys,json,getpass
ROOT=Path(__file__).resolve().parents[2];sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
target=ROOT/'.runtime/ciw-completion-20261028/sql-fixed-odbc-runtime-readonly-v1.json';assert not target.exists()
remote=r'''
import subprocess,json,re
from pathlib import Path
driver=Path('/usr/dlc/odbc/lib/pgoe27.so')
header=driver.open('rb').read(5)
php=subprocess.run(['php','-r','echo json_encode(["bits"=>PHP_INT_SIZE*8,"odbcLoaded"=>extension_loaded("odbc"),"version"=>PHP_VERSION]);'],stdout=subprocess.PIPE,stderr=subprocess.PIPE,universal_newlines=True,timeout=10)
assert php.returncode==0
runtime=json.loads(php.stdout)
deps=subprocess.run(['ldd',str(driver)],stdout=subprocess.PIPE,stderr=subprocess.PIPE,universal_newlines=True,timeout=10)
dependencies=[]
for line in deps.stdout.splitlines():
 match=re.match(r'\s*([A-Za-z0-9_.+-]+)\s*=>\s*(not found|/[^ ]+)',line)
 if match:dependencies.append({'name':match.group(1),'resolved':match.group(2)!='not found'})
print(json.dumps({'success':True,'php':runtime,'driverElfBits':{1:32,2:64}.get(header[4]) if header[:4]==b'\x7fELF' else None,'lddExitCode':deps.returncode,'dependencies':dependencies,'connectionAttempted':False,'sqlExecuted':False,'businessReads':False,'businessWrites':False}))
'''
c=paramiko.SSHClient();c.load_host_keys(str(Path.home()/'.ssh/known_hosts'));c.set_missing_host_key_policy(paramiko.RejectPolicy());password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 c.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 inp,out,err=c.exec_command('python3 -',timeout=30);inp.write(remote);inp.flush();inp.channel.shutdown_write();raw=out.read();err.read();assert out.channel.recv_exit_status()==0,'Closed runtime inspection failed'
 result=json.loads(raw);target.write_text(json.dumps(result,indent=2)+'\n');print(json.dumps(result))
finally:password=None;c.close()
