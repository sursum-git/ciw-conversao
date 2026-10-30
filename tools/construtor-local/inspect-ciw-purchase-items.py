"""Copia fontes para análise de processos de compra; só leitura remota, sem executar PHP.

Literais atribuídos a variáveis sensíveis são omitidos da cópia de análise.
Hashes originais permanecem no manifesto, sem guardar credenciais.
"""
import getpass
import hashlib
import io
import json
from pathlib import Path
import re
import sys
import tarfile

ROOT=Path(__file__).resolve().parents[2]
sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko

REMOTE=r'''
import gzip,io,json,os,re,tarfile
base='/var/www/clients/client1/web2/web/ciw'
apps=APPS
with tarfile.open(fileobj=__import__('sys').stdout.buffer,mode='w|gz') as archive:
 for app in apps:
  path=base+'/'+app
  for name in sorted(os.listdir(path)):
   if name not in ('index.php',app+'.php',app+'_apl.php',app+'_grid.class.php',app+'_form0.php',app+'_menu.php',app+'_data.php',app+'_sajax.php',app+'_js0.php') and not (app=='menu' and name.endswith(('.php','.json','.js')) and 'config' not in name.lower()):
    continue
   with open(path+'/'+name,'rb') as src:data=src.read()
   member=tarfile.TarInfo(app+'/'+name);member.size=len(data)
   archive.addfile(member,io.BytesIO(data))
'''

def main():
 # Escopo fixo desta entrega
 apps=sorted(['grid_itens_proc_compra','form_itens_proc_compra'])
 assert all(re.fullmatch(r'[A-Za-z0-9_]+',n) for n in apps)
 client=paramiko.SSHClient();client.load_host_keys(str(Path.home()/'.ssh/known_hosts'))
 client.set_missing_host_key_policy(paramiko.RejectPolicy())
 password=getpass.getpass('Senha SSH CIW (somente memoria): ')
 try:
  client.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15)
  password=None
  stdin,stdout,stderr=client.exec_command('python3 -',timeout=180)
  stdin.write(REMOTE.replace('apps=APPS','apps='+repr(apps)));stdin.flush();stdin.channel.shutdown_write()
  data=stdout.read();stderr.read()
  if stdout.channel.recv_exit_status()!=0:raise RuntimeError('Falha na leitura remota delimitada')
  destination=ROOT/'sources/scriptcase/purchase-items'
  manifest=[]
  with tarfile.open(fileobj=io.BytesIO(data),mode='r:gz') as archive:
   for member in archive:
    parts=Path(member.name).parts
    if len(parts)!=2 or parts[0] not in apps or not member.isfile():raise ValueError('Membro fora do escopo')
    raw=archive.extractfile(member).read()
    text=raw.decode('utf-8',errors='replace').replace('\r\n','\n').replace('\r','\n')
    # Não altera argumentos dinâmicos nem valores de negócio; omite literais sensíveis.
    sensitive=re.compile(r'''(?im)^([^\r\n]*(?:senha|password|passwd|token|secret|bindpw|bind_pw)[^\r\n]*?(?:=|=>)\s*)("(?:\\.|[^"\\])*"|'(?:\\.|[^'\\])*')''')
    clean,n=sensitive.subn(lambda m:m.group(1)+"'__OMITIDO_NA_COPIA_DE_ANALISE__'",text)
    target=destination/member.name;target.parent.mkdir(parents=True,exist_ok=True)
    target.write_text(clean,encoding='utf-8')
    manifest.append(dict(application=parts[0],file=parts[1],remote_sha256=hashlib.sha256(raw).hexdigest(),
                         copied_sha256=hashlib.sha256(target.read_bytes()).hexdigest(),sensitive_literals_omitted=n))
  output=ROOT/'integration-src/purchase-items/source-manifest.json'
  output.write_text(json.dumps(dict(scope=apps,analysis_copies=True,files=manifest),ensure_ascii=False,indent=2),encoding='utf-8')
  print(json.dumps(dict(applications=len(apps),files=len(manifest),omitted_literals=sum(x['sensitive_literals_omitted'] for x in manifest))))
 finally:
  password=None;client.close()

if __name__=='__main__':main()
