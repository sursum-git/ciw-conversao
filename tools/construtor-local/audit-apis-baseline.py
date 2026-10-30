"""Leitura restrita dos hashes de publicacao; nunca imprime configuracoes."""
import hashlib, json, subprocess
from pathlib import Path
root = Path('/mnt/datasul/ERP/sursum')
names = ['EmpresasCrud.p','EmpresasCrud.r','EmpresasCrudService.p','EmpresasCrudService.r',
         'TiposAnexoCrud.p','TiposAnexoCrud.r','TiposAnexoCrudService.p','TiposAnexoCrudService.r']
paths = {name: root/'sursum-api/programs'/name for name in names}
paths.update({name: root/'sursum-conf'/name for name in ['empresas-api.json','tipos-anexo-api.json']})
paths['program-routes.json'] = root/'conf-web-handler/program-routes.json'
result = {'root':str(root),'instance':'sursum-api','context':'med',
          'hashes':{name:hashlib.sha256(path.read_bytes()).hexdigest() for name,path in paths.items()}}
result['mount'] = subprocess.check_output(['findmnt','-T',str(root),'-n','-o','SOURCE,TARGET'],text=True).strip()
routes=json.loads(paths['program-routes.json'].read_text(encoding='utf-8-sig'))
result['routes']=[r for r in routes['routes'] if r.get('route') in ['/SursumPrograms/empresas','/SursumPrograms/tipos-anexo']]
print(json.dumps(result,indent=2))
