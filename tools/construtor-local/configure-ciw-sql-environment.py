"""Configura somente arquivos privados do lote CIW aprovado; nunca imprime segredos."""
import getpass,json,subprocess,sys
from pathlib import Path
ROOT=Path(__file__).resolve().parents[2];PRIVATE=ROOT/'.runtime/ciw-authz-sql-20261019/private'
REMOTE=r'''<?php
$raw=file_get_contents('/var/www/clients/client1/web2/web/ciw/_lib/conf/prod.config.php');
if(!preg_match('/a:\d+:\{/',$raw,$m,PREG_OFFSET_CAPTURE))exit(2);
$data=@unserialize(substr($raw,$m[0][1]),['allowed_classes'=>false]);$cfg=$data['PROFILE']['ticontrole2'];
require_once '/var/www/clients/client1/web2/web/ciw/_lib/prod/lib/php/nm_ini_lib.php';
foreach(['VAL_HOST','VAL_BASE','VAL_USER','VAL_PASS'] as $k)if(strncmp($cfg[$k],'enc_nm_enc_v1',13)===0)$cfg[$k]=decode_string($cfg[$k]);
if($cfg['VAL_HOST']!=='192.168.0.170:1433'||strtolower($cfg['VAL_BASE'])!=='ticontrole')exit(3);
echo json_encode(['host'=>'127.0.0.1','port'=>19933,'database'=>'ticontrole','username'=>$cfg['VAL_USER'],'password'=>$cfg['VAL_PASS'],'timeoutSeconds'=>8]);
'''
def main():
 sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'));import paramiko
 PRIVATE.mkdir(exist_ok=True,parents=True)
 # ACL aplicada ANTES da primeira gravacao de credencial tecnica.
 import csv,io
 sid=list(csv.reader(io.StringIO(subprocess.check_output(['whoami','/user','/fo','csv','/nh'],text=True))))[0][1]
 subprocess.run(['icacls',str(PRIVATE),'/inheritance:r','/grant:r','*'+sid+':(OI)(CI)F'],check=True,stdout=subprocess.DEVNULL,stderr=subprocess.DEVNULL)
 s=paramiko.SSHClient();s.load_host_keys(str(Path.home()/'.ssh/known_hosts'));s.set_missing_host_key_policy(paramiko.RejectPolicy())
 password=getpass.getpass('Senha SSH CIW (somente memoria): ')
 try:
  s.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
  inp,out,err=s.exec_command('php',timeout=30);inp.write(REMOTE);inp.flush();inp.channel.shutdown_write();raw=out.read();err.read()
  if out.channel.recv_exit_status()!=0:raise RuntimeError('Configuracao remota indisponivel')
  cfg=json.loads(raw);raw=None
  if cfg.get('host')!='127.0.0.1' or cfg.get('port')!=19933 or cfg.get('database')!='ticontrole' or not isinstance(cfg.get('password'),str):raise ValueError()
  target=PRIVATE/'sql-connection.json';target.write_text(json.dumps(cfg));cfg=None
 finally:password=None;s.close()
 old=json.loads((ROOT/'.runtime/ciw-access-20261016/connection.json').read_text(encoding='utf-8-sig'))
 if not isinstance(old.get('token'),str) or len(old['token'])!=64:raise ValueError('Token CIW indisponivel')
 identity={'url':'http://127.0.0.1:19910/med/web/SursumPrograms/ciw-identity','token':old['token'],'timeoutSeconds':8};old=None
 (PRIVATE/'identity-connection.json').write_text(json.dumps(identity));identity=None
 env=Path('D:/opencode/construtor-pg/backend/.env.local');text=env.read_text(encoding='utf-8');before=text
 for name,file in [('CIW_SQL_CONNECTION_FILE','sql-connection.json'),('CIW_IDENTITY_CONNECTION_FILE','identity-connection.json'),('CIW_SQL_TUNNEL_STATE_FILE','tunnel-state.json')]:
  value=(PRIVATE/file).as_posix();line=name+'='+value
  matches=[x for x in text.splitlines() if x.startswith(name+'=')]
  if matches and matches!=[line]:raise ValueError('Variavel de ambiente concorrente')
  if not matches:text+='\n'+line+'\n'
 if text!=before:
  (PRIVATE/'backend-env.before').write_text(before,encoding='utf-8');env.write_text(text,encoding='utf-8')
 print('PASS: conexoes privadas configuradas, ACL restrita e somente caminhos no ambiente.')
if __name__=='__main__':
 try:main()
 except Exception:print('Configuracao CIW falhou; detalhes sensiveis omitidos.',file=sys.stderr);sys.exit(1)
