"""Read exactly two requested lookup files, sanitize in RAM, no fallback/PHP execution."""
from pathlib import Path
import sys,json,getpass,hashlib,re,stat
R=Path(__file__).resolve().parents[2];sys.path.insert(0,str(R/'.runtime/ssh-deps'))
import paramiko
base='/var/www/clients/client1/web2/web/ciw'
dest=R/'sources/scriptcase/ciw-completion-expense-tax-lookups-20261028'
manifest=R/'integration-src/ciw-inventory/ciw-completion-expense-tax-lookups-20261028-source-manifest.json'
assert not dest.exists() and not manifest.exists()
files=['grid_despesas_impostos/grid_despesas_impostos_lookup.class.php','form_despesas_impostos/form_despesas_impostos_lookup.class.php']
pattern=re.compile(r'''(?i)(?:senha|password|passwd|authorization|bindpass|banco_pass|nm_db_pass|token|secret|bindpw|bind_pw|api[_-]?key|access[_-]?key|(?<![A-Za-z])(?:pwd|pass)(?![A-Za-z])).*?(?:=|=>)\s*["']''')
c=paramiko.SSHClient();c.load_host_keys(str(Path.home()/'.ssh/known_hosts'));c.set_missing_host_key_policy(paramiko.RejectPolicy());password=getpass.getpass('Senha SSH CIW (somente memoria): ')
rows=[]
try:
 c.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 with c.open_sftp() as sftp:
  for rel in files:
   try:info=sftp.lstat(base+'/'+rel)
   except FileNotFoundError:rows.append(dict(file=rel,exists=False));continue
   assert stat.S_ISREG(info.st_mode) and not stat.S_ISLNK(info.st_mode) and info.st_size<=8*1024*1024
   with sftp.open(base+'/'+rel,'rb') as stream:raw=stream.read()
   assert len(raw)==info.st_size
   lines=raw.decode('utf-8',errors='replace').replace('\r\n','\n').replace('\r','\n').splitlines(keepends=True)
   omitted=sum(bool(pattern.search(line)) for line in lines)
   clean=''.join('/* __CRED_LITERAL_OMITIDO_NA_COPIA_DE_ANALISE__ */\n' if pattern.search(line) else line for line in lines)
   target=dest/rel;target.parent.mkdir(parents=True,exist_ok=True);target.write_text(clean,encoding='utf-8')
   rows.append(dict(file=rel,exists=True,remote_sha256=hashlib.sha256(raw).hexdigest(),copied_sha256=hashlib.sha256(target.read_bytes()).hexdigest(),sensitive_assignment_lines_omitted=omitted))
 manifest.write_text(json.dumps(dict(success=True,scope=files,files=rows,readOnly=True,executeLegacyPhp=False,sanitizedBeforePersist=True,noFallback=True),indent=2)+'\n')
 print(json.dumps(dict(success=True,files=rows,executeLegacyPhp=False)))
finally:password=None;c.close()
