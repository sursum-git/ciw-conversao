"""Sincroniza apenas fontes CIW12.2 compilados; preserva catalogo/diffs canônicos."""
from pathlib import Path
import hashlib,json
R=Path(__file__).resolve().parents[2];P=R/'.runtime/ciw-authz-sql-20261019';M=Path('D:/opencode/motor-progress/v2');S=R/'integration-src/ciw-access'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest() if p.exists() else None
manifest={};pairs=[]
for name in ['CiwIdentityService','CiwIdentityBoundary','CiwIdentityRead','CiwAccessService']:
 src=S/(name+'.p');target=M/'sursum-api/programs'/src.name
 if name=='CiwAccessService':assert sha(target)==sha(P/'CiwAccessService.before.p'),'Fonte canônica alterada por outro trabalho'
 else:assert not target.exists(),'Novo componente ja existe'
 pairs.append((src,target))
for name in ['CiwIdentityServiceTest','CiwIdentityBoundaryTest','CompileCiwAccessTests','RunCiwAccessTests']:
 src=S/(name+'.p');pairs.append((src,M/'tests/abl/ciw-access'/src.name))
cat=M/'conf-web-handler/program-routes.json';before=cat.read_bytes();catalog=json.loads(before);route={'route':'/SursumPrograms/ciw-identity','method':'POST','program':'sursum-api/programs/CiwIdentityRead.p'}
assert not any(r.get('route')==route['route'] for r in catalog['routes'])
catalog['routes'].append(route);candidate=P/'canonical-routes.json';candidate.write_text(json.dumps(catalog,ensure_ascii=False,indent=2)+'\n',encoding='utf-8');pairs.append((candidate,cat))
for src,dest in pairs:manifest[str(dest)]={'before':sha(dest),'sha256':sha(src)}
backup=P/'motor-backup';backup.mkdir(exist_ok=True)
for src,dest in pairs:
 assert sha(dest)==manifest[str(dest)]['before'],'Guard de alteracao concorrente'
 if dest.exists():(backup/dest.name).write_bytes(dest.read_bytes())
for src,dest in pairs:
 assert sha(dest)==manifest[str(dest)]['before'],'Guard de alteracao concorrente'
 dest.parent.mkdir(parents=True,exist_ok=True);dest.write_bytes(src.read_bytes());assert sha(dest)==sha(src)
(P/'motor-canonical-manifest.json').write_text(json.dumps(manifest,indent=2));print('PASS:9fontes/catalogo canônicos sincronizados com backup/hash, sem outras alteracoes.')
