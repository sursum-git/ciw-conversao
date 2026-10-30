"""Obtém só dicionários pelo endpoint de metadados já existente no PASOE."""
import json
from pathlib import Path
from urllib.request import urlopen

ROOT=Path(__file__).resolve().parents[2]
destination=ROOT/'integration-src/ciw-access/schema'
destination.mkdir(parents=True,exist_ok=True)
for table in ('user-web','usuarios_grupos','grupos_aplicacoes'):
    url='http://127.0.0.1:19910/med/web/SursumDynamicQuery/metadata/tables/'+table+'/fields?database=espec'
    with urlopen(url,timeout=15) as response:
        metadata=json.load(response)
    if metadata.get('success') is not True or not isinstance(metadata.get('data'),list):
        raise RuntimeError('Contrato de metadados inválido para '+table)
    name = ('grupos-aplicacoes-runtime-fields.json' if table == 'grupos_aplicacoes'
            else table.replace('-','_')+'-runtime-fields.json')
    (destination/name).write_text(json.dumps(metadata,ensure_ascii=False,indent=2),encoding='utf-8')
    print(table+': '+str(len(metadata['data']))+' campos; nenhum registro de negócio lido.')
