"""Read only environment and IOL engine log metadata, never business payloads."""
from pathlib import Path
import getpass,sys,json
ROOT=Path(__file__).resolve().parents[2];sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
cli=paramiko.SSHClient();cli.load_host_keys(str(Path.home()/'.ssh/known_hosts'));cli.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha SSH inspecao IOL: ')
cli.connect('192.168.0.111',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15)
password=None
script="""import pathlib,json,re,subprocess
root=pathlib.Path('/mnt/datasul/ERP/sursum')
route=[r for r in json.loads((root/'conf-web-handler/program-routes.json').read_text())['routes'] if r.get('route')=='/SursumPrograms/iol-inicial-gerencial']
lines=[]
for f in pathlib.Path('/dados/pasoe/sursum-api/logs').glob('*.log'):
 if f.stat().st_size>0:
  with f.open('rb') as stream:
   stream.seek(max(0,f.stat().st_size-250000));tail=stream.read().decode('utf-8',errors='replace')
  for line in tail.splitlines():
   if 'IOL_ENGINE' in line and 'engine=' in line:
    match=re.search(r'engine=([0-9.]+) runtime=([0-9.]+)',line)
    if match:lines.append({'file':f.name,'engine':match.group(1),'runtime':match.group(2)})
folder=root/'sursum-api/programs/iol-gerencial-20261019-v5'
print(json.dumps({'version':pathlib.Path('/usr/dlc12/version').read_text().strip(),'route':route,'aggregate128ExecutablePresent':(folder/'IolGerencialAggregate128.r').exists(),'logs':lines[-6:],'databaseService10012':subprocess.run(['getent','services','10012/tcp'],capture_output=True,text=True).stdout.strip()}))
"""
try:
 _,out,err=cli.exec_command('python3 -',timeout=30);out.channel.sendall(script.encode());out.channel.shutdown_write()
 data=out.read().decode();errors=err.read().decode();status=out.channel.recv_exit_status()
 if status:raise RuntimeError(errors)
 result=json.loads(data)
 if not result['logs'] or any(x['engine']!='12.2' for x in result['logs']):raise RuntimeError('Engine122 not proven by runtime log')
 if result['aggregate128ExecutablePresent']:raise RuntimeError('Unexpected128 executable')
 (ROOT/'.runtime/iol-engine-20261019/runtime-inspection.json').write_text(json.dumps(result,indent=2))
 print(json.dumps(result,indent=2))
finally:cli.close()
