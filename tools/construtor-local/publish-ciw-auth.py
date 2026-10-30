"""Runtime111: lote novo de autenticacao; publica mapeamento por ultimo."""
import hashlib,json,os,shutil
from pathlib import Path
ROOT=Path('/mnt/datasul/ERP/sursum')
STAGE=Path('/tmp/ciw-auth-20261017')
HANDLERS=Path('/dados/pasoe/sursum-api/webapps/med/WEB-INF/adapters/web/ROOT/ROOT.handlers')
plan=json.loads((STAGE/'manifest.json').read_text(encoding='utf-8'))
expected={'sursum-api/programs/CiwAuthenticationService'+e for e in ['.p','.r']}
expected.update(n+e for n in ['CiwAuthenticationBoundary','CiwAuthenticationWebHandler'] for e in ['.cls','.r'])
expected.add('sursum-conf/ciw-authentication.json')
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
if set(plan['targets'])!=expected:raise RuntimeError('Escopo inesperado')
log=(STAGE/'ciw-auth-compile.log').read_text(encoding='utf-8-sig')
if 'OpenEdge 12.2' not in log or 'MISSING' in log or 'COMPILER:ERROR=yes' in log:raise RuntimeError('Compilacao incompleta')
for filename in ['CiwAuthenticationService.p','CiwAuthenticationBoundary.cls','CiwAuthenticationWebHandler.cls']:
 if filename+' COMPILER:ERROR=no' not in log:raise RuntimeError('Compilacao de produto ausente')
for culture in ['AMERICAN','EUROPEAN']:
 for prefix in ['ciw-auth-service-','ciw-auth-boundary-']:
  proof=(STAGE/(prefix+culture+'.log')).read_text(encoding='utf-8-sig')
  if not proof.startswith('PASS ') or 'FAIL' in proof:raise RuntimeError('Teste sem prova')
if sha(HANDLERS)!=plan['handlersBeforeSha256']:raise RuntimeError('Handlers mudaram; preservar e reler baseline')
for rel,entry in plan['targets'].items():
 if (ROOT/rel).exists():raise RuntimeError('Destino ja existe: '+rel)
 if sha(STAGE/entry['file'])!=entry['sha256']:raise RuntimeError('Hash staging divergente')
config=json.loads((STAGE/'ciw-authentication.json').read_text(encoding='utf-8'))
if set(config)!=set(['tokenSha256']) or len(config['tokenSha256'])!=64:raise RuntimeError('Configuracao invalida')
handlers=json.loads(HANDLERS.read_text(encoding='utf-8-sig'))
if any(h.get('uri')=='/CiwAuthentication' for h in handlers['handlers']):raise RuntimeError('Mapping ja existe')
handlers['handlers'].append({'uri':'/CiwAuthentication','class':'CiwAuthenticationWebHandler','enabled':True})
handlerBytes=(json.dumps(handlers,ensure_ascii=False,indent=2)+'\n').encode('utf-8')
backup=STAGE/'backup-before';backup.mkdir()
shutil.copy2(HANDLERS,backup/'ROOT.handlers')
written=[];temps=[];mapped=False
try:
 for rel,entry in sorted(plan['targets'].items()):
  target=ROOT/rel;tmp=target.with_name(target.name+'.ciw-auth-new')
  with tmp.open('xb') as out:out.write((STAGE/entry['file']).read_bytes())
  temps.append(tmp)
  template=ROOT/('sursum-conf/containers-api.json' if rel.endswith('.json') else 'sursum-api/programs/ContainersPainelRead'+('.r' if rel.endswith('.r') else '.p'))
  st=template.stat();os.chmod(tmp,st.st_mode&0o777);os.chown(tmp,st.st_uid,st.st_gid)
  if sha(tmp)!=entry['sha256']:raise RuntimeError('Transferencia divergente')
  os.link(str(tmp),str(target));written.append(rel);tmp.unlink()
 if sha(HANDLERS)!=plan['handlersBeforeSha256']:raise RuntimeError('Mapping concorrente')
 tmp=HANDLERS.with_name('ROOT.handlers.ciw-auth-new')
 with tmp.open('xb') as out:out.write(handlerBytes)
 temps.append(tmp);shutil.copystat(HANDLERS,tmp)
 st=HANDLERS.stat();os.chown(tmp,st.st_uid,st.st_gid)
 if sha(HANDLERS)!=plan['handlersBeforeSha256']:raise RuntimeError('Mapping concorrente')
 os.replace(str(tmp),str(HANDLERS));mapped=True
 for rel,entry in plan['targets'].items():
  if sha(ROOT/rel)!=entry['sha256']:raise RuntimeError('Publicado divergente')
except Exception:
 if mapped and sha(HANDLERS)==hashlib.sha256(handlerBytes).hexdigest():
  tmp=HANDLERS.with_name('ROOT.handlers.ciw-auth-restore');shutil.copy2(backup/'ROOT.handlers',tmp);os.replace(str(tmp),str(HANDLERS))
 for rel in reversed(written):
  if (ROOT/rel).exists() and sha(ROOT/rel)==plan['targets'][rel]['sha256']:(ROOT/rel).unlink()
 raise
finally:
 for tmp in temps:
  if tmp.exists():tmp.unlink()
active={'instance':'sursum-api','context':'med','businessWrites':False,'artifacts':{r:e['sha256'] for r,e in plan['targets'].items()},'handlersSha256':sha(HANDLERS),'backup':str(backup),'positiveCase':'pending_real_user_session'}
(STAGE/'active-manifest.json').write_text(json.dumps(active,indent=2),encoding='utf-8')
print('PASS:6artefatos12.2+config hash publicados; novo handler mesclado por ultimo, sem alterar roteador generico')
