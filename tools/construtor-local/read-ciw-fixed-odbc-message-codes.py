"""Read only static driver catalog entries for the three observed codes."""
from pathlib import Path
import sys,json,getpass
ROOT=Path(__file__).resolve().parents[2];sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
target=ROOT/'.runtime/ciw-completion-20261028/sql-fixed-odbc-code-catalog-v2.json';assert not target.exists()
remote=r'''
from pathlib import Path
import json,re
entries=[]
for name in ['pgoe27.po','pgmback.po','odbc.po']:
 text=(Path('/usr/dlc/odbc/locale/en_US/LC_MESSAGES')/name).read_text(errors='replace')
 lines=text.splitlines()
 for n,line in enumerate(lines):
  if re.match(r'^\s*(?:1201|20101|60)\s+"',line):
   selected=[line]
   for follow in lines[n+1:n+8]:
    if re.match(r'^\s*(?:\d+\s|\$)',follow):break
    selected.append(follow)
   entries.append({'file':name,'entry':'\n'.join(selected)[:1600]})
print(json.dumps({'success':True,'entries':entries[:20],'connectionAttempted':False,'sqlExecuted':False,'businessReads':False,'businessWrites':False}))
'''
c=paramiko.SSHClient();c.load_host_keys(str(Path.home()/'.ssh/known_hosts'));c.set_missing_host_key_policy(paramiko.RejectPolicy());password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 c.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 inp,out,err=c.exec_command('python3 -',timeout=25);inp.write(remote);inp.flush();inp.channel.shutdown_write();raw=out.read();err.read();assert out.channel.recv_exit_status()==0,'Closed catalog read failed'
 result=json.loads(raw);target.write_text(json.dumps(result,indent=2)+'\n');print(json.dumps(result))
finally:password=None;c.close()
