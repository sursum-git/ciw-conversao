"""Runtime111: habilita apenas o provedor comprovado, sem alterar token ou ACL."""
import hashlib,json,os,shutil
from pathlib import Path
ROOT=Path('/mnt/datasul/ERP/sursum');STAGE=Path('/tmp/ciw-auth-source-20261017')
plan=json.loads((STAGE/'manifest.json').read_text())
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
target=ROOT/'sursum-conf/ciw-access.json'
for relative,h in plan['artifacts'].items():
 if sha(ROOT/relative)!=h:raise RuntimeError('Artefato concorrente: '+relative)
proof=plan['proof']
if proof.get('username')!='tasilpar' or proof.get('provider')!='ima-user-web' or proof.get('status')!='active' or proof.get('realBrowserSessionVerified') is not True:raise RuntimeError('Sessao real sem prova')
config=json.loads(target.read_text());before=sha(target)
if set(config)!=set(['tokenSha256','allowedAuthProviders']) or config['allowedAuthProviders']!=[]:raise RuntimeError('Allowlist concorrente')
backup=STAGE/'ciw-access.before.json';shutil.copy2(target,backup)
config['allowedAuthProviders']=['ima-user-web'];data=(json.dumps(config,indent=2)+'\n').encode()
tmp=target.with_name('ciw-access.json.auth-source-new')
with tmp.open('xb') as stream:stream.write(data)
shutil.copystat(target,tmp);st=target.stat();os.chown(tmp,st.st_uid,st.st_gid)
if sha(target)!=before:raise RuntimeError('Configuracao concorrente')
os.replace(str(tmp),str(target))
if target.read_bytes()!=data:raise RuntimeError('Hash publicado divergiu')
result={'instance':'sursum-api','context':'med','file':'sursum-conf/ciw-access.json','before':before,'after':sha(target),'allowedAuthProviders':['ima-user-web'],'tokenUnchanged':True,'businessWrites':False,'backup':str(backup)}
(STAGE/'active-manifest.json').write_text(json.dumps(result,indent=2))
print('PASS: somente ima-user-web permitido; token, ACL, fontes e compilados preservados; configuracao lida por chamada')
