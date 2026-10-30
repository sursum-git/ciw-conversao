"""Consulta apenas metadados de navegação; não executa PHP legado."""
import getpass
import json
from pathlib import Path
import re
import sys
ROOT=Path(__file__).resolve().parents[2]
sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
SCRIPT=r'''
import json,re,subprocess
query="SELECT TABLE_SCHEMA FROM information_schema.TABLES WHERE TABLE_NAME='itens_menu' ORDER BY TABLE_SCHEMA"
def sql(q):
 p=subprocess.run(['mysql','--batch','--skip-column-names','-e',q],stdout=subprocess.PIPE,stderr=subprocess.PIPE,timeout=20)
 return p.returncode,p.stdout.decode('utf-8',errors='replace')
try:
 code,out=sql(query)
 result={'metadata_available':code==0,'matches':[]}
 if code==0:
  for database in out.splitlines():
   if not re.fullmatch('[A-Za-z0-9_]+',database):continue
   q="SELECT menu_id,descricao,link,cod_tipo_link,item_menu_id_pai FROM `"+database+"`.itens_menu WHERE menu_id=1 AND (LOWER(descricao) LIKE '%corrente%' OR LOWER(descricao) LIKE '%tarefa%')"
   status,rows=sql(q)
   if status==0:
    for line in rows.splitlines():result['matches'].append(line.split('\t'))
 print(json.dumps(result,ensure_ascii=False))
except (FileNotFoundError,subprocess.TimeoutExpired):
 print(json.dumps({'metadata_available':False,'matches':[]}))
except Exception as exc:
 print(json.dumps({'metadata_available':False,'matches':[],'error_type':type(exc).__name__}))
'''
client=paramiko.SSHClient();client.load_host_keys(str(Path.home()/'.ssh/known_hosts'))
client.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 client.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15)
 password=None
 stdin,stdout,stderr=client.exec_command('python3 -',timeout=90)
 stdin.write(SCRIPT);stdin.flush();stdin.channel.shutdown_write()
 payload=stdout.read().decode('utf-8',errors='replace')
 diagnostic=stderr.read().decode('utf-8',errors='replace')
 if not payload.strip():
  kinds=re.findall(r'(\w+(?:Error|Exception)):',diagnostic)
  result={'metadata_available':False,'matches':[],'remote_error_type':kinds[-1] if kinds else 'empty_output','exit_code':stdout.channel.recv_exit_status()}
 else:result=json.loads(payload)
 (ROOT/'integration-src/ciw-inventory/menu-exclusion-evidence.json').write_text(json.dumps(result,ensure_ascii=False,indent=2),encoding='utf-8')
 print(json.dumps(result,ensure_ascii=False))
finally:password=None;client.close()
