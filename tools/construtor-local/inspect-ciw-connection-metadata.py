"""Somente estrutura/tipos de conexao. Nunca retorna credenciais ou config bruta."""
import getpass,json,sys
from pathlib import Path
ROOT=Path(__file__).resolve().parents[2];sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
REMOTE=r'''
import configparser,importlib.util,json,os,re,shutil,subprocess,xml.etree.ElementTree as ET
base='/var/www/clients/client1/web2/web/ciw'
result={'clients':{n:bool(shutil.which(n)) for n in ['php','mysql','sqlcmd','isql']},'ini':[],'config':[]}
for app in ['menu','menu_ctrl_importacao','ctrl_login_html','grid_pub_coloracoes','form_pub_coloracoes']:
 path=base+'/'+app
 for name in os.listdir(path):
  if not re.search(r'_ini(?:\.class)?\.php$',name):continue
  text=open(path+'/'+name,encoding='utf-8',errors='replace').read()
  types=sorted(set(re.findall(r"['\"](mssqlnative|mssql|sqlsrv|pdo_sqlsrv|mysqlt|mysql|mysqli|odbc|odbc_mssql|progress|postgres|postgres7)['\"]",text)))
  keys=sorted(set(re.findall(r'(nm_[a-z_]*(?:banco|conexao)[a-z_]*|nmgp_banco)',text,re.I)))
  result['ini'].append({'application':app,'file':name,'databaseTypes':types,'metadataKeys':keys})
conf=base+'/_lib/conf'
for name in sorted(os.listdir(conf)):
 if name not in ['prod.config.php','prod.config','conn.config.php']:continue
 data=open(conf+'/'+name,'rb').read();entry={'file':name,'bytes':len(data),'phpWrapped':data.lstrip().startswith(b'<?')}
 try:
  root=ET.fromstring(data);entry['tags']=sorted({e.tag for e in root.iter()});entry['attributeKeys']=sorted({k for e in root.iter() for k in e.attrib})
 except ET.ParseError:entry['xml']=False
 text=data.decode('utf-8','replace')
 entry['arrayKeys']=sorted(set(re.findall(r"(?:^|[,\r\n])\s*['\"]([A-Za-z_][A-Za-z0-9_]{0,39})['\"]\s*=>",text)))[:60]
 entry['iniSections']=re.findall(r'^\[([A-Za-z0-9_.:-]{1,80})\]$',text,re.M)[:30]
 entry['knownAliasOccurrences']={a:text.lower().count(a) for a in ['ticontrole','espec','connections','nm_config','base64_decode','unserialize']}
 entry['variableNames']=sorted(set(re.findall(r'\$([A-Za-z_][A-Za-z0-9_]*)',text)))[:30]
 entry['iniKeys']=sorted(set(re.findall(r'^\s*([A-Za-z_][A-Za-z0-9_.-]*)\s*=',text,re.M)))[:50]
 result['config'].append(entry)
result['odbc']=[]
for filename in ['/etc/odbc.ini','/usr/local/etc/odbc.ini']:
 if not os.path.isfile(filename):continue
 cfg=configparser.ConfigParser(interpolation=None,strict=False);cfg.read(filename)
 for section in cfg.sections():
  if section not in ['espec_pro','ticontrole']:continue
  entry={'file':filename,'dsn':section}
  for key in ['Driver','Server','Servername','Database','HostName','PortNumber','DatabaseName']:
   value=cfg.get(section,key,fallback='')
   if value and len(value)<250 and not any(c in value for c in ';=\r\n'):entry[key]=value
  result['odbc'].append(entry)
php="<?php $c=@odbc_connect('ticontrole','','');echo json_encode(['connected'=>(bool)$c,'sqlstate'=>$c?null:odbc_error()]);if($c)odbc_close($c);"
try:
 run=subprocess.run(['php'],input=php.encode(),stdout=subprocess.PIPE,stderr=subprocess.PIPE,timeout=20)
 result['ticontroleDsnProbe']=json.loads(run.stdout)
except Exception:result['ticontroleDsnProbe']={'connected':False,'diagnostic':'unavailable'}
print(json.dumps(result))
'''
client=paramiko.SSHClient();client.load_host_keys(str(Path.home()/'.ssh/known_hosts'));client.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 client.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 stdin,stdout,stderr=client.exec_command('python3 -',timeout=60);stdin.write(REMOTE);stdin.flush();stdin.channel.shutdown_write()
 data=stdout.read();stderr.read()
 if stdout.channel.recv_exit_status()!=0:raise RuntimeError('Metadados indisponiveis; diagnostico bruto omitido')
 result=json.loads(data)
 stdin,stdout,stderr=client.exec_command('php',timeout=30);stdin.write(Path(__file__).with_name('inspect-ciw-config-structure.php').read_text());stdin.flush();stdin.channel.shutdown_write()
 parsed=stdout.read();diagnostic=stderr.read()
 exit_code=stdout.channel.recv_exit_status()
 if exit_code==0:
  try:result['safeConfigStructure']=json.loads(parsed)
  except Exception:result['safeConfigStructure']={'parsed':False}
 else:result['safeConfigStructure']={'parsed':False,'exitCode':exit_code,'errorCategories':sorted(set(__import__('re').findall(r'(Parse error|Fatal error|TypeError|Error)',diagnostic.decode('utf-8','replace'))))}
 out=ROOT/'.runtime/ciw-auth-tcassimiro-20261019/connection-metadata.json';out.write_text(json.dumps(result,indent=2))
 print(json.dumps(result))
finally:password=None;client.close()
