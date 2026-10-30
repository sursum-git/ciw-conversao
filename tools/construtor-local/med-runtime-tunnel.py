"""Local-only MED tunnel. Password stays in memory; three bounded reconnects."""
from pathlib import Path
import getpass, select, socketserver, sys, threading, time
ROOT=Path(__file__).resolve().parents[2]
sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko

lock=threading.RLock()
transport=None
class Server(socketserver.ThreadingTCPServer):
 allow_reuse_address=True
 daemon_threads=True
class Forward(socketserver.BaseRequestHandler):
 def handle(self):
  channel=None
  try:
   with lock:
    current=transport
    if current is None or not current.is_active():return
    channel=current.open_channel('direct-tcpip',('127.0.0.1',9910),self.request.getpeername(),timeout=15)
   while channel is not None:
    ready,_,_=select.select([self.request,channel],[],[],1)
    if self.request in ready:
     data=self.request.recv(65536)
     if not data:break
     channel.sendall(data)
    if channel in ready:
     data=channel.recv(65536)
     if not data:break
     self.request.sendall(data)
    if not current.is_active():break
  except (OSError,EOFError,paramiko.SSHException):pass
  finally:
   if channel is not None:channel.close()

def main():
 global transport
 password=getpass.getpass('Senha SSH MED (somente memoria): ')
 client=None;server=None
 try:
  for attempt in range(4):
   if attempt:
    print('MED SSH reconnect '+str(attempt)+'/3',flush=True)
    time.sleep(2)
   client=paramiko.SSHClient();client.load_host_keys(str(Path.home()/'.ssh/known_hosts'));client.set_missing_host_key_policy(paramiko.RejectPolicy())
   try:
    client.connect('192.168.0.111',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15,auth_timeout=20,banner_timeout=20)
    with lock:transport=client.get_transport();transport.set_keepalive(10)
    if server is None:
     server=Server(('127.0.0.1',19910),Forward)
     threading.Thread(target=server.serve_forever,daemon=True).start()
    print('MED tunnel ready:127.0.0.1:19910 -> same-instance loopback9910',flush=True)
    while transport.is_active():time.sleep(.5)
    print('MED SSH disconnected; forwarding remains local-only',flush=True)
   except (OSError,paramiko.SSHException) as error:
    print('MED tunnel connection failed ['+type(error).__name__+']',flush=True)
   finally:
    with lock:transport=None
    client.close()
  raise RuntimeError('MED tunnel reconnect limit reached')
 finally:
  password=None
  if server is not None:server.shutdown();server.server_close()
  if client is not None:client.close()
if __name__=='__main__':main()
