"""Tunel local CIW SQL: somente loopback ate o proprio host SQL via SSH."""
import getpass,json,select,socketserver,sys,threading,time
from pathlib import Path
ROOT=Path(__file__).resolve().parents[2]
class SqlTunnel:
 def __init__(self,transport,host='127.0.0.1',port=19933):
  if host!='127.0.0.1' or port!=19933:raise ValueError('Destino local invalido')
  self.transport=transport;self.host=host;self.port=port;self.server=None;self.thread=None;self.channels=set();self.lock=threading.Lock();self.stopped=threading.Event()
 def __enter__(self):
  if not self.transport or not self.transport.is_active():raise ConnectionError('SSH indisponivel')
  owner=self
  class Forward(socketserver.BaseRequestHandler):
   def handle(self):
    ch=None
    try:
     if not owner.transport.is_active():return
     ch=owner.transport.open_channel('direct-tcpip',('192.168.0.170',1433),self.request.getpeername(),timeout=10)
     with owner.lock:owner.channels.add(ch)
     while not owner.stopped.is_set():
      ready,_,_=select.select([self.request,ch],[],[],.25)
      for source in ready:
       data=source.recv(65536)
       if not data:return
       (ch if source is self.request else self.request).sendall(data)
    except Exception:pass # Sem dados/credenciais em logs de transporte.
    finally:
     if ch:
      with owner.lock:owner.channels.discard(ch)
      ch.close()
  self.server=socketserver.ThreadingTCPServer((self.host,self.port),Forward);self.server.daemon_threads=True
  self.thread=threading.Thread(target=self.server.serve_forever,daemon=True);self.thread.start();return self
 def __exit__(self,*args):
  self.stopped.set()
  with self.lock:
   for ch in list(self.channels):ch.close()
  if self.server:self.server.shutdown();self.server.server_close()
  if self.thread:self.thread.join(timeout=2)
def main():
 sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'));import paramiko
 client=paramiko.SSHClient();client.load_host_keys(str(Path.home()/'.ssh/known_hosts'));client.set_missing_host_key_policy(paramiko.RejectPolicy())
 password=getpass.getpass('Senha SSH CIW (somente memoria): ')
 try:
  client.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None;client.get_transport().set_keepalive(30)
  with SqlTunnel(client.get_transport()):
   state=ROOT/'.runtime/ciw-authz-sql-20261019/private/tunnel-state.json'
   import os
   state.write_text(json.dumps({'pid':os.getpid(),'port':19933,'host':'127.0.0.1','sshHost':'192.168.0.170','destination':'192.168.0.170:1433'}))
   print('READY: CIW SQL loopback19933, hostkey verificada; sem escrita de negocio.',flush=True)
   try:
    while client.get_transport().is_active():time.sleep(1)
   finally:
    if state.exists() and json.loads(state.read_text()).get('pid')==os.getpid():state.unlink()
 finally:password=None;client.close()
if __name__=='__main__':
 try:main()
 except KeyboardInterrupt:pass
 except Exception as error:print('Tunel CIW indisponivel ['+type(error).__name__+']; detalhes sensiveis omitidos.',file=sys.stderr);sys.exit(1)
