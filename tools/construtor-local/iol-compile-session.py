"""Sessao restrita para repetir compilacao/testes IOL12.2; senha so em memoria."""
from pathlib import Path
import getpass,sys,base64,json
ROOT=Path(__file__).resolve().parents[2]
sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
cli=paramiko.SSHClient();cli.load_host_keys(str(Path.home()/'.ssh/known_hosts'));cli.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha compilador IOL: ')
cli.connect('192.168.0.42',username='tadeu.parreiras',password=password,look_for_keys=False,allow_agent=False,timeout=15)
password=None
stage='C:/Users/tadeu.parreiras/codex-iol-gerencial-20261016'
src=ROOT/'integration-src/iol-pagina-inicial-gerencial'
dest=ROOT/'.runtime/iol-gerencial/compiled';dest.mkdir(parents=True,exist_ok=True)
args=''
for db,port in [('espec',10012),('ems2cad',10033),('ems2med',10031),('ems5',10032)]:args+=f' -db {db} -H 192.168.0.111 -S {port} -N TCP -ld {db}'
ps=f"$ProgressPreference='SilentlyContinue'; $s='{stage}'; if ((Resolve-Path -LiteralPath $s).Path.Replace('\\','/') -ne $s) {{throw 'Staging inesperado'}}; Set-Location -LiteralPath $s; Get-ChildItem -LiteralPath $s -File -Filter '*.r' | Remove-Item; Get-ChildItem -LiteralPath $s -File -Filter 'calculator-*.log' | Remove-Item; Get-ChildItem -LiteralPath $s -File -Filter 'identity-*.log' | Remove-Item; & 'C:/Progress_12/OE/bin/_progres.exe' -b -cpinternal UTF-8 -cpstream UTF-8{args} -p CompileIolGerencialTests.p *> compile-process.log"
command='powershell -NoProfile -EncodedCommand '+base64.b64encode(ps.encode('utf-16le')).decode()
try:
 while True:
  print('Comando restrito: compile / exit',flush=True)
  action=input().strip()
  if action=='exit':break
  if action!='compile':continue
  with cli.open_sftp() as sf:
   for folder in [stage+'/sursum-api',stage+'/sursum-api/includes']:
    try:sf.mkdir(folder)
    except OSError:pass
   sf.put('D:/opencode/motor-progress/v2/sursum-api/includes/parametros_ima.i',stage+'/sursum-api/includes/parametros_ima.i')
   for f in src.iterdir():
    if f.is_file() and f.suffix in ['.p','.i','.json']:sf.put(str(f),stage+'/'+f.name)
  _,out,err=cli.exec_command(command,timeout=180);out.read();err.read()
  with cli.open_sftp() as sf:
   for name in sf.listdir(stage):
    if name.endswith(('.log','.r')):sf.get(stage+'/'+name,str(dest/name))
  log=(dest/'compile-iol.log').read_text(encoding='utf-8-sig',errors='replace')
  print(log,flush=True)
finally:cli.close()
