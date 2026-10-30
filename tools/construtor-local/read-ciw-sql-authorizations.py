"""Executa diagnostico PHP proprio, somente SELECT e sem copiar credenciais."""
import getpass,json,sys
from pathlib import Path
ROOT=Path(__file__).resolve().parents[2];sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
shape='--decoder-shape' in sys.argv
client=paramiko.SSHClient();client.load_host_keys(str(Path.home()/'.ssh/known_hosts'));client.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 client.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 stdin,stdout,stderr=client.exec_command('php',timeout=60);stdin.write(Path(__file__).with_name('inspect-ciw-decoder-shape.php' if shape else 'inspect-ciw-sql-authorizations.php').read_text());stdin.flush();stdin.channel.shutdown_write()
 data=stdout.read();stderr.read()
 if stdout.channel.recv_exit_status()!=0:raise RuntimeError('Diagnostico falhou; detalhes brutos omitidos')
 result=json.loads(data)
 if shape:
  dest=ROOT/'.runtime/ciw-auth-tcassimiro-20261019/decoder-shapes';dest.mkdir(exist_ok=True)
  for name,text in result.items():
   if name not in ['nm_serialize.php','nm_ini_lib.php']:raise RuntimeError('Arquivo fora do escopo')
   (dest/(name+'.txt')).write_text(text)
  print('Analise estatica salva com literais removidos');sys.exit(0)
 (ROOT/'.runtime/ciw-auth-tcassimiro-20261019/sql-authorization-evidence.json').write_text(json.dumps(result,indent=2))
 summary={k:v for k,v in result.items() if k not in ['schema','menuOne']}
 summary['schemaColumns']=len(result.get('schema',[]));print(json.dumps(summary))
finally:password=None;client.close()
