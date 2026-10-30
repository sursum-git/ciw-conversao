"""Compile/test only IOL engine candidates on OE12.2/.42; password stays in memory."""
from pathlib import Path
import getpass,sys,base64,hashlib,json
ROOT=Path(__file__).resolve().parents[2]
sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
cli=paramiko.SSHClient();cli.load_host_keys(str(Path.home()/'.ssh/known_hosts'));cli.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha compilador IOL: ')
cli.connect('192.168.0.42',username='tadeu.parreiras',password=password,look_for_keys=False,allow_agent=False,timeout=15)
password=None
stage='C:/Users/tadeu.parreiras/codex-iol-engine-20261019'
src=ROOT/'integration-src/iol-pagina-inicial-gerencial'
dest=ROOT/'.runtime/iol-engine-20261019/compiled122';dest.mkdir(parents=True,exist_ok=True)
args=''
for db,port in [('espec',10012),('ems2cad',10033),('ems2med',10031),('ems5',10032)]:args+=f' -db {db} -H 192.168.0.111 -S {port} -N TCP -ld {db}'
ps=f"$ProgressPreference='SilentlyContinue'; $s='{stage}'; if ((Resolve-Path -LiteralPath $s).Path.Replace('\\','/') -ne $s) {{throw 'Staging inesperado'}}; Set-Location -LiteralPath $s; Get-ChildItem -LiteralPath $s -File -Filter '*.r' | Remove-Item; Get-ChildItem -LiteralPath $s -File -Filter '*.log' | Remove-Item; & 'C:/Progress_12/OE/bin/_progres.exe' -b -cpinternal UTF-8 -cpstream UTF-8{args} -p CompileIolGerencialTests.p *> compile-process.log"
command='powershell -NoProfile -EncodedCommand '+base64.b64encode(ps.encode('utf-16le')).decode()
try:
 with cli.open_sftp() as sf:
  for folder in [stage,stage+'/sursum-api',stage+'/sursum-api/includes']:
   try:sf.mkdir(folder)
   except OSError:pass
 while True:
  print('Comando restrito: compile / install-parameter / exit',flush=True)
  action=input().strip()
  if action=='exit':break
  if action=='install-parameter':
   receipt=dest/'iol-engine-parameter-install.log'
   log=(dest/'compile-iol.log').read_text(encoding='utf-8-sig')
   if 'OpenEdge 12.2' not in log or 'PASS IOL' not in log or 'FAIL' in log:raise RuntimeError('Compile12.2 required')
   bound=json.loads((dest/'compiled-source-hashes.json').read_text())
   for name,sha in bound.items():
    if hashlib.sha256((src/name).read_bytes()).hexdigest()!=sha:raise RuntimeError('Source changed after compilation: '+name)
   sha=hashlib.sha256((dest/'InstallIolEngineParameter.r').read_bytes()).hexdigest()
   install_ps=f"$s='{stage}'; Set-Location -LiteralPath $s; if ((Get-FileHash -LiteralPath './InstallIolEngineParameter.r' -Algorithm SHA256).Hash -ne '{sha}') {{throw 'Installer hash differs'}}; if (Test-Path -LiteralPath './iol-engine-parameter-install.log') {{Remove-Item -LiteralPath './iol-engine-parameter-install.log'}}; & 'C:/Progress_12/OE/bin/_progres.exe' -b -cpinternal UTF-8 -cpstream UTF-8{args} -p InstallIolEngineParameter.r -param install-iol-engine-12.2 *> parameter-install-process.log"
   install_command='powershell -NoProfile -EncodedCommand '+base64.b64encode(install_ps.encode('utf-16le')).decode()
   _,out,err=cli.exec_command(install_command,timeout=90);out.read();err.read()
   with cli.open_sftp() as sf:
    sf.get(stage+'/parameter-install-process.log',str(dest/'parameter-install-process.log'))
    sf.get(stage+'/iol-engine-parameter-install.log',str(receipt))
   value=receipt.read_text(encoding='utf-8-sig')
   if 'PASS parameter=iol_gerencial_engine value=12.2' not in value:raise RuntimeError('Parameter install not proven')
   print(value,flush=True)
   continue
  if action!='compile':continue
  bound={}
  with cli.open_sftp() as sf:
   sf.put('D:/opencode/motor-progress/v2/sursum-api/includes/parametros_ima.i',stage+'/sursum-api/includes/parametros_ima.i')
   for f in src.iterdir():
    if f.is_file() and f.suffix in ['.p','.i','.json']:
     bound[f.name]=hashlib.sha256(f.read_bytes()).hexdigest();sf.put(str(f),stage+'/'+f.name)
  _,out,err=cli.exec_command(command,timeout=180);out.read();err.read()
  with cli.open_sftp() as sf:
   for name in sf.listdir(stage):
    if name.endswith(('.log','.r')):sf.get(stage+'/'+name,str(dest/name))
  (dest/'compiled-source-hashes.json').write_text(json.dumps(bound,indent=2))
  print((dest/'compile-iol.log').read_text(encoding='utf-8-sig',errors='replace'),flush=True)
finally:cli.close()
