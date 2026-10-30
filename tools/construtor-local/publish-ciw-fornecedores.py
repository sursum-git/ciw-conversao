"""Publicador remoto: servico novo e delta do wrapper, sem mudar config/rotas."""
from pathlib import Path
import hashlib,json,os,shutil
R=Path('/mnt/datasul/ERP/sursum');S=Path('/tmp/ciw-fornecedores-20261020-fix')
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
m=json.loads((S/'manifest.json').read_text());expected={'sursum-api/programs/'+name+ext for name in ['CiwFornecedoresService','CiwCadastrosCrud'] for ext in ['.p','.r']}
assert set(m['targets'])==expected
log=(S/'compile-ciw-fornecedores.log').read_text(encoding='utf-8-sig')
assert 'OpenEdge 12.2' in log and 'COMPILER:ERROR=yes' not in log
for name in ['CiwFornecedoresService','CiwCadastrosCrud','CiwFornecedoresTest']:assert name+'.p COMPILER:ERROR=no' in log
for culture in ['AMERICAN','EUROPEAN']:
 assert (S/('fornecedores-tests-'+culture+'.log')).read_text().strip()=='PASS 27 checks '+culture
routes=json.loads((R/'conf-web-handler/program-routes.json').read_text(encoding='utf-8-sig'))['routes']
assert [x for x in routes if x.get('route')=='/SursumPrograms/ciw-cadastros']==[{'route':'/SursumPrograms/ciw-cadastros','method':'POST','program':'sursum-api/programs/CiwCadastrosCrud.p'}]
for rel,item in m['targets'].items():
 assert sha(S/item['file'])==item['sha256'],'Staging divergente'
 assert (sha(R/rel) if (R/rel).exists() else None)==item['before'],'Destino concorrente'
backup=S/'backup-before';backup.mkdir();written=[]
for rel,item in m['targets'].items():
 if item['before'] is not None:shutil.copy2(R/rel,backup/Path(rel).name)
try:
 for name in ['CiwFornecedoresService','CiwCadastrosCrud']:
  for ext in ['.p','.r']:
   rel='sursum-api/programs/'+name+ext;item=m['targets'][rel];target=R/rel;temp=target.with_name(target.name+'.ciw-fornecedores')
   with temp.open('xb') as f:f.write((S/item['file']).read_bytes())
   template=target if target.exists() else R/('sursum-api/programs/CiwCadastroCrudService'+ext)
   shutil.copystat(template,temp);st=template.stat();os.chown(temp,st.st_uid,st.st_gid)
   assert (sha(target) if target.exists() else None)==item['before'],'Destino concorrente'
   if item['before'] is None:os.link(temp,target);temp.unlink()
   else:os.replace(temp,target)
   written.append(rel)
 for rel,item in m['targets'].items():assert sha(R/rel)==item['sha256']
except Exception:
 for rel in reversed(written):
  if sha(R/rel)==m['targets'][rel]['sha256']:
   if m['targets'][rel]['before'] is None:(R/rel).unlink()
   else:shutil.copy2(backup/Path(rel).name,R/rel)
 raise
(S/'active-manifest.json').write_text(json.dumps({'instance':'sursum-api','context':'med','artifacts':m['targets'],'backup':str(backup),'routesChanged':False,'runtimeValidation':'pending'},indent=2))
print('PASS:4artefatos12.2 publicados por guard/hash; rotas/config e negocio preservados.')
