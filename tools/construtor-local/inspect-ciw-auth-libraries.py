"""Rastreia bibliotecas CIW sem executar PHP nem copiar segredos."""
import getpass
import json
from pathlib import Path
import sys
ROOT=Path(__file__).resolve().parents[2]
sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
REMOTE=r'''
import os,re,json,hashlib
base='/var/www/clients/client1/web2/web/ciw'
names=['validarLogin','logar','getDadosUserWeb','getCamposUsuario','aplicarPermissoesSC','getReg','retirarAcentoSimples','sc_ldap_login']
safe={'espec','user-web','login','Login','senha','ativo','s_users','usuarios_grupos','grupos_aplicacoes','Y','N','prj','sys','grp'}
files=[]
lib=base+'/_lib'
roots=[e for e in sorted(os.listdir(lib)) if os.path.isdir(lib+'/'+e)]
for root,dirs,entries in os.walk(lib):
 dirs[:]=[d for d in dirs if d.lower() not in {'third','thirdparty','vendor','node_modules','doc','tmp','cache','css','img','images','fonts','js','lang','conf'}]
 for name in entries:
  if name.lower().endswith('.php'):files.append(root+'/'+name)
files.extend(base+'/'+a+'/'+f for a,f in [('bl_tela_login','index.php'),('app_login','app_login_apl.php'),('bl_logar','index.php'),('ctrl_login_html','ctrl_login_html_apl.php')])
for app in ['bl_tela_login','ctrl_login_html']:
 for name in os.listdir(base+'/'+app):
  if name.endswith('.php') and any(x in name for x in ['ini','bibli','lib','session']):files.append(base+'/'+app+'/'+name)
out={'library_directories':roots,'files_read':0,'matches':[],'php_executed':False,'custom_library_files':[],'includes':[]}
literal=re.compile(r""""(?:\\.|[^"\\])*"|'(?:\\.|[^'\\])*'""")
for file in sorted(set(files)):
 if not os.path.isfile(file) or os.path.getsize(file)>12000000:continue
 raw=open(file,'rb').read();text=raw.decode('utf-8','replace');out['files_read']+=1
 if '/_lib/libraries/' in file:out['custom_library_files'].append(os.path.relpath(file,base))
 for match in re.finditer(r"""(?im)^.*(?:include|require).*$""",text):
  for quoted in literal.finditer(match.group()):
   value=quoted.group()[1:-1]
   if re.fullmatch(r'[A-Za-z0-9_./$-]+\.php',value):
    out['includes'].append({'file':os.path.relpath(file,base),'line':text.count('\n',0,match.start())+1,'path':value})
 hits=list(re.finditer(r'(?im)^\s*(?:public\s+|private\s+|protected\s+)?function\s+('+'|'.join(names)+r')\s*\(',text))
 for hit in hits:
  tail=text[hit.start():]
  offset=hit.end()-hit.start()
  nextfn=re.search(r'(?im)^\s*(?:public\s+|private\s+|protected\s+)?function\s+\w+\s*\(',tail[offset:])
  end=offset+nextfn.start() if nextfn else min(len(tail),18000)
  body=tail[:end]
  def clean(m):
   return m.group() if m.group()[1:-1] in safe else "'__LITERAL_OMITIDO__'"
  sanitized=literal.sub(clean,body)
  sanitized=re.sub(r'(?m)//[^\n]*|/\*[\s\S]*?\*/','',sanitized)
  out['matches'].append({'file':os.path.relpath(file,base),'function':hit.group(1),'line':text.count('\n',0,hit.start())+1,
   'file_sha256':hashlib.sha256(raw).hexdigest(),'body_sha256':hashlib.sha256(body.encode()).hexdigest(),
   'calls':sorted(set(re.findall(r'(?:->)?([A-Za-z_][A-Za-z_0-9]*)\s*\(',body))),
   'password_equality_with_dynamic_value':bool(re.search(r"senha\s*=\s*['\"]?\$spswd",body,re.I)),
   'password_digest_calls':[n for n in ['md5','sha1','hash','password_verify','crypt','ldap_bind','sc_ldap_login'] if re.search(r'\b'+n+r'\s*\(',body,re.I)],
   'sanitized_body':sanitized[:18000]})
print(json.dumps(out,ensure_ascii=False))
'''
def main():
 client=paramiko.SSHClient();client.load_host_keys(str(Path.home()/'.ssh/known_hosts'))
 client.set_missing_host_key_policy(paramiko.RejectPolicy())
 password=getpass.getpass('Senha SSH CIW (somente memoria): ')
 try:
  client.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15)
  password=None
  stdin,stdout,stderr=client.exec_command('python3 -',timeout=180)
  stdin.write(REMOTE);stdin.flush();stdin.channel.shutdown_write()
  data=stdout.read();stderr.read()
  if stdout.channel.recv_exit_status()!=0:raise RuntimeError('Falha na inspecao delimitada; diagnostico remoto omitido')
  report=json.loads(data)
  output=ROOT/'integration-src/ciw-access/auth-library-evidence.json'
  output.write_text(json.dumps(report,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
  print(json.dumps({'files_read':report['files_read'],'matches':len(report['matches']),'output':str(output)}))
 finally:password=None;client.close()
if __name__=='__main__':main()
