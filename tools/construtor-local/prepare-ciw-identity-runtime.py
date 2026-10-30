"""Prepara lote CIW12.2 e publicacao guardada; nao grava segredos."""
from pathlib import Path
import hashlib,json
ROOT=Path(__file__).resolve().parents[2];P=ROOT/'.runtime/ciw-authz-sql-20261019';STAGE='/tmp/ciw-sql-20261019'
REMOTE=r'''from pathlib import Path
import hashlib,json,os,shutil
R=Path('/mnt/datasul/ERP/sursum');S=Path('/tmp/ciw-sql-20261019')
h=lambda p:hashlib.sha256(p.read_bytes()).hexdigest() if p.exists() else None
plan=json.loads((S/'manifest.json').read_text());cat=R/'conf-web-handler/program-routes.json'
for rel,entry in plan['targets'].items():
 if h(R/rel)!=entry['before'] or h(S/entry['file'])!=entry['sha256']:raise RuntimeError('Artefato concorrente ou staging divergente')
if h(cat)!=plan['catalogBeforeSha256']:raise RuntimeError('Catalogo concorrente')
if json.loads((R/'sursum-conf/ciw-access.json').read_text()).get('allowedAuthProviders')!=['ima-user-web']:raise RuntimeError('Origem CIW divergente')
log=(S/'compile-ciw-access.log').read_text(encoding='utf-8-sig')
if 'OpenEdge 12.2' not in log or 'COMPILER:ERROR=yes' in log or 'MISSING' in log:raise RuntimeError('Compilacao12.2 ausente')
for culture in ['AMERICAN','EUROPEAN']:
 for prefix in ['ciw-access-tests','ciw-access-boundary','ciw-identity-tests','ciw-identity-boundary']:
  proof=(S/(prefix+'-'+culture+'.log')).read_text(encoding='utf-8-sig')
  if not proof.startswith('PASS ') or 'FAIL' in proof:raise RuntimeError('Teste ausente')
catalog=json.loads(cat.read_text(encoding='utf-8-sig'));route={'route':'/SursumPrograms/ciw-identity','method':'POST','program':'sursum-api/programs/CiwIdentityRead.p'}
if any(r.get('route')==route['route'] for r in catalog['routes']):raise RuntimeError('Rota existente')
catalog['routes'].append(route);catalogBytes=(json.dumps(catalog,ensure_ascii=False,indent=2)+'\n').encode()
backup=S/'backup-before';backup.mkdir();shutil.copy2(cat,backup/'program-routes.json')
for rel,entry in plan['targets'].items():
 if entry['before'] is not None:shutil.copy2(R/rel,backup/Path(rel).name)
written=[];catalogWritten=False
try:
 for rel,entry in plan['targets'].items():
  target=R/rel
  if h(target)!=entry['before']:raise RuntimeError('Artefato alterado durante publicacao')
  temp=target.with_name(target.name+'.ciw-sql-new');data=(S/entry['file']).read_bytes()
  with temp.open('xb') as f:f.write(data)
  template=target if target.exists() else R/('sursum-api/programs/CiwAccessRead'+target.suffix)
  stat=template.stat();os.chmod(temp,stat.st_mode&0o777);os.chown(temp,stat.st_uid,stat.st_gid)
  if h(target)!=entry['before']:temp.unlink();raise RuntimeError('Artefato concorrente')
  os.replace(temp,target);written.append(rel)
 if h(cat)!=plan['catalogBeforeSha256']:raise RuntimeError('Catalogo concorrente')
 temp=cat.with_name(cat.name+'.ciw-sql-new')
 with temp.open('xb') as f:f.write(catalogBytes)
 shutil.copystat(cat,temp);stat=cat.stat();os.chown(temp,stat.st_uid,stat.st_gid)
 if h(cat)!=plan['catalogBeforeSha256']:temp.unlink();raise RuntimeError('Catalogo concorrente')
 os.replace(temp,cat);catalogWritten=True
 for rel,entry in plan['targets'].items():
  if h(R/rel)!=entry['sha256']:raise RuntimeError('Hash publicado divergente')
except Exception:
 if catalogWritten and h(cat)==hashlib.sha256(catalogBytes).hexdigest():shutil.copy2(backup/'program-routes.json',cat)
 for rel in reversed(written):
  target=R/rel;entry=plan['targets'][rel]
  if h(target)==entry['sha256']:
   if entry['before'] is None:target.unlink()
   else:shutil.copy2(backup/target.name,target)
 raise
active={'instance':'sursum-api','context':'med','businessWrites':False,'artifacts':{k:v['sha256'] for k,v in plan['targets'].items()},'catalogSha256':h(cat),'backup':str(backup)}
(S/'active-manifest.json').write_text(json.dumps(active,indent=2));print('PASS: 8 artefatos12.2 e rota ciw-identity publicados com guard/backup; config de autenticacao preservada.')
'''
def main():
 baseline=json.loads((P/'runtime-baseline.json').read_text());targets={};uploads=[]
 old=json.loads((ROOT/'.runtime/ciw-access-20261016/publish/active-manifest.json').read_text())['artifacts']
 for name in ['CiwIdentityService','CiwIdentityBoundary','CiwIdentityRead','CiwAccessService']:
  for ext in ['.p','.r']:
   rel='sursum-api/programs/'+name+ext;before=baseline['targets'][rel]
   if name=='CiwAccessService' and before!=old[rel]:raise RuntimeError('Servico anterior diverge da publicacao conhecida')
   if name!='CiwAccessService' and before is not None:raise RuntimeError('Novo componente ja existe')
   source=ROOT/'integration-src/ciw-access'/(name+ext) if ext=='.p' else P/'compiled'/(name+ext)
   targets[rel]={'file':name+ext,'sha256':hashlib.sha256(source.read_bytes()).hexdigest(),'before':before};uploads.append({'local':source.relative_to(ROOT).as_posix(),'remote':STAGE+'/'+name+ext})
 (P/'publish-ciw-identity.py').write_text(REMOTE)
 manifest=P/'manifest.json';manifest.write_text(json.dumps({'targets':targets,'catalogBeforeSha256':baseline['catalogSha256']},indent=2))
 for name in ['publish-ciw-identity.py','manifest.json']:uploads.append({'local':(P/name).relative_to(ROOT).as_posix(),'remote':STAGE+'/'+name})
 for f in (P/'compile').glob('*.log'):uploads.append({'local':f.relative_to(ROOT).as_posix(),'remote':STAGE+'/'+f.name})
 refresh=(ROOT/'.runtime/ciw-auth-20261017/encoding-publish/refresh-med.py').read_text().replace('/tmp/ciw-auth-20261017',STAGE)
 (P/'refresh-med.py').write_text(refresh);uploads.append({'local':(P/'refresh-med.py').relative_to(ROOT).as_posix(),'remote':STAGE+'/refresh-med.py'})
 plan={'server':'runtime','uploads':uploads,'commands':['python3 '+STAGE+'/publish-ciw-identity.py','python3 '+STAGE+'/refresh-med.py'],'downloads':[{'remote':STAGE+'/active-manifest.json','local':(P/'publish/active-manifest.json').relative_to(ROOT).as_posix()},{'remote':STAGE+'/med-session-refresh.json','local':(P/'publish/med-session-refresh.json').relative_to(ROOT).as_posix()},{'remote':'/mnt/datasul/ERP/sursum/conf-web-handler/program-routes.json','local':(P/'runtime-routes-after.json').relative_to(ROOT).as_posix()}]}
 (P/'publish-plan.json').write_text(json.dumps(plan,indent=2));print('Lote CIW12.2 guardado preparado.')
if __name__=='__main__':main()
