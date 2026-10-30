"""Prova descartavel: SQL tecnico em memoria SSH->stdinPHP; sem arquivo secreto."""
import getpass,json,select,socketserver,subprocess,sys,threading
from pathlib import Path
ROOT=Path(__file__).resolve().parents[2];sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
REMOTE=r'''<?php
$raw=file_get_contents('/var/www/clients/client1/web2/web/ciw/_lib/conf/prod.config.php');
if(!preg_match('/a:\d+:\{/',$raw,$m,PREG_OFFSET_CAPTURE))exit(2);
$data=@unserialize(substr($raw,$m[0][1]),['allowed_classes'=>false]);
$cfg=$data['PROFILE']['ticontrole2'];
require_once '/var/www/clients/client1/web2/web/ciw/_lib/prod/lib/php/nm_ini_lib.php';
foreach(['VAL_HOST','VAL_BASE','VAL_USER','VAL_PASS'] as $k)if(strncmp($cfg[$k],'enc_nm_enc_v1',13)===0)$cfg[$k]=decode_string($cfg[$k]);
if($cfg['VAL_HOST']!=='192.168.0.170:1433'||strtolower($cfg['VAL_BASE'])!=='ticontrole')exit(3);
echo json_encode(['host'=>$cfg['VAL_HOST'],'database'=>$cfg['VAL_BASE'],'username'=>$cfg['VAL_USER'],'password'=>$cfg['VAL_PASS']]);
'''
client=paramiko.SSHClient();client.load_host_keys(str(Path.home()/'.ssh/known_hosts'));client.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha SSH CIW (somente memoria): ')
server=None
try:
 client.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 stdin,stdout,stderr=client.exec_command('php',timeout=30);stdin.write(REMOTE);stdin.flush();stdin.channel.shutdown_write();private=stdout.read();stderr.read()
 if stdout.channel.recv_exit_status()!=0:raise RuntimeError('Parametros privados indisponiveis')
 if '--ssh' in sys.argv:
  transport=client.get_transport()
  class Forward(socketserver.BaseRequestHandler):
   def handle(self):
    channel=transport.open_channel('direct-tcpip',('192.168.0.170',1433),self.request.getpeername(),timeout=15)
    try:
     while True:
      ready,_,_=select.select([self.request,channel],[],[],20)
      if not ready:break
      for source in ready:
       data=source.recv(65536)
       if not data:return
       (channel if source is self.request else self.request).sendall(data)
    finally:channel.close()
  server=socketserver.ThreadingTCPServer(('127.0.0.1',0),Forward);server.daemon_threads=True
  threading.Thread(target=server.serve_forever,daemon=True).start()
  cfg=json.loads(private);cfg['transport']='ssh';cfg['port']=server.server_address[1];private=json.dumps(cfg).encode();cfg=None
 # Nenhum dado privado e impresso, persistido ou interpolado em argumentos.
 run=subprocess.run(['C:/php-8.4.3/php.exe','-d','extension=php_pdo_odbc.dll',str(Path(__file__).with_suffix('.php'))],input=private,stdout=subprocess.PIPE,stderr=subprocess.PIPE,timeout=30)
 private=None
 if run.returncode!=0:raise RuntimeError('Prova local falhou; diagnostico bruto omitido')
 result=json.loads(run.stdout);name='ssh-sql-transport-proof.json' if '--ssh' in sys.argv else 'local-sql-transport-proof.json';(ROOT/'.runtime/ciw-auth-tcassimiro-20261019'/name).write_text(json.dumps(result,indent=2));print(json.dumps(result))
finally:
 if server:server.shutdown();server.server_close()
 password=None;client.close()
