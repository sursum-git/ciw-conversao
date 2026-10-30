"""Leitura delimitada do caminho de permissao; nao executa PHP remoto."""
import getpass,hashlib,importlib.util,io,json,re,sys,tarfile
from pathlib import Path
ROOT=Path(__file__).resolve().parents[2]
sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
spec=importlib.util.spec_from_file_location('collector',Path(__file__).with_name('inspect-ciw-phase1.py'))
module=importlib.util.module_from_spec(spec);spec.loader.exec_module(module)
apps=['bl_logar','menu_ctrl_importacao','menu','ctrl_login_html']
remote=module.REMOTE.replace('apps=APPS','apps='+repr(apps)).replace("path=base+'/'+app","path=base+'/'+app\n  if not os.path.isdir(path):continue")
client=paramiko.SSHClient();client.load_host_keys(str(Path.home()/'.ssh/known_hosts'));client.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 client.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 stdin,stdout,stderr=client.exec_command('python3 -',timeout=120);stdin.write(remote);stdin.flush();stdin.channel.shutdown_write()
 data=stdout.read();stderr.read()
 if stdout.channel.recv_exit_status()!=0:raise RuntimeError('Leitura remota falhou; diagnostico bruto omitido')
 destination=ROOT/'sources/scriptcase/auth-path-20261019';records=[]
 sensitive=re.compile(r'''(?im)^([^\r\n]*(?:senha|password|passwd|token|secret|bindpw|bind_pw)[^\r\n]*?(?:=|=>)\s*)("(?:\\.|[^"\\])*"|'(?:\\.|[^'\\])*')''')
 with tarfile.open(fileobj=io.BytesIO(data),mode='r:gz') as archive:
  for member in archive:
   parts=Path(member.name).parts
   if len(parts)!=2 or parts[0] not in apps or not member.isfile():raise RuntimeError('Fora do escopo')
   raw=archive.extractfile(member).read();text=raw.decode('utf-8',errors='replace').replace('\r\n','\n').replace('\r','\n')
   clean,n=sensitive.subn(lambda m:m.group(1)+"'__OMITIDO_NA_COPIA_DE_ANALISE__'",text)
   p=destination/member.name;p.parent.mkdir(parents=True,exist_ok=True);p.write_text(clean,encoding='utf-8')
   records.append({'application':parts[0],'file':parts[1],'remoteSha256':hashlib.sha256(raw).hexdigest(),'analysisSha256':hashlib.sha256(p.read_bytes()).hexdigest(),'omitted':n})
 state=ROOT/'.runtime/ciw-auth-tcassimiro-20261019';state.mkdir(exist_ok=True)
 (state/'source-path-manifest.json').write_text(json.dumps({'requested':apps,'found':sorted({r['application'] for r in records}),'analysisOnly':True,'phpExecuted':False,'files':records},indent=2))
 print(json.dumps({'files':len(records),'found':sorted({r['application'] for r in records}),'phpExecuted':False}))
finally:password=None;client.close()
