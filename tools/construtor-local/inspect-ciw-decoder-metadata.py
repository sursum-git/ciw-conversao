"""Descobre apenas nomes de funcoes/includes de decodificacao, sem copiar chaves."""
import getpass,json,sys
from pathlib import Path
ROOT=Path(__file__).resolve().parents[2];sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
REMOTE=r'''
import json,os,re
base='/var/www/clients/client1/web2/web/ciw'
result=[]
roots=[base+'/_lib/lib/php',base+'/_lib/prod/lib/php','/var/www/clients/client1/web2/web/scriptcase/prod/lib/php']
for root in roots:
 if not os.path.isdir(root):continue
 for name in sorted(os.listdir(root)):
  if not name.endswith('.php') or not (any(k in name for k in ['perfil','enc','crypto','cript']) or name in ['nm_ini_lib.php','nm_serialize.php','nm_sec_prod.php']):continue
  path=root+'/'+name
  if os.path.getsize(path)>2000000:continue
  text=open(path,encoding='utf-8',errors='replace').read()
  result.append({'file':path,'functions':re.findall(r'function\s+([A-Za-z_][A-Za-z0-9_]*)\s*\(',text),'classes':re.findall(r'class\s+([A-Za-z_][A-Za-z0-9_]*)',text),'decodeCalls':sorted(set(re.findall(r'\b([A-Za-z_][A-Za-z0-9_]*(?:decript|decrypt|decode)[A-Za-z0-9_]*)\s*\(',text,re.I))),'includes':sorted(set(re.findall(r'(?:require|include)(?:_once)?[^\r\n;]*["\x27]([A-Za-z0-9_./-]+\.php)["\x27]',text)))})
print(json.dumps(result))
'''
client=paramiko.SSHClient();client.load_host_keys(str(Path.home()/'.ssh/known_hosts'));client.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 client.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 stdin,stdout,stderr=client.exec_command('python3 -',timeout=30);stdin.write(REMOTE);stdin.flush();stdin.channel.shutdown_write();data=stdout.read();stderr.read()
 if stdout.channel.recv_exit_status()!=0:raise RuntimeError('Metadados de funcoes indisponiveis')
 result=json.loads(data);(ROOT/'.runtime/ciw-auth-tcassimiro-20261019/decoder-metadata.json').write_text(json.dumps(result,indent=2));print(json.dumps(result))
finally:password=None;client.close()
