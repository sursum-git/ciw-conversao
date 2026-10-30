"""Sincroniza somente o lote novo, preservando diffs e catalogos concorrentes."""
from pathlib import Path
import hashlib,json
R=Path(__file__).resolve().parents[2];S=R/'integration-src/ciw-cadastros';P=R/'.runtime/ciw-cadastros-20261020';B=Path('D:/opencode/construtor-pg');M=Path('D:/opencode/motor-progress/v2')
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest() if p.exists() else None
file=P/'canonical-manifest.json';state=json.loads(file.read_text()) if file.exists() else {};pairs=[]
for f in (S/'backend').rglob('*.php'):
 if f.relative_to(S/'backend').as_posix()=='tests/bootstrap.php':continue
 pairs.append((f,B/'backend'/f.relative_to(S/'backend')))
for f in (S/'metadata').glob('*.json'):pairs.append((f,B/'integrations/ciw-cadastros'/f.name))
for name in ['CiwCadastroCrudService','CiwCadastroDefinition','CiwCadastrosCrud']:pairs.append((S/(name+'.p'),M/'sursum-api/programs'/(name+'.p')))
for name in ['CiwCadastroCrudTest','CiwCadastroDefinitionTest','CompileCiwCadastros']:pairs.append((S/(name+'.p'),M/'tests/abl/ciw-cadastros'/(name+'.p')))
core=B/'backend/src/Runtime/RuntimeApiEntityActionService.php'
if str(core) not in state:assert sha(core)==sha(P/'RuntimeApiEntityActionService.before.php'),'Core alterado por outro trabalho'
catalogPath=M/'conf-web-handler/program-routes.json';catalog=json.loads(catalogPath.read_text(encoding='utf-8-sig'));route={'route':'/SursumPrograms/ciw-cadastros','method':'POST','program':'sursum-api/programs/CiwCadastrosCrud.p'}
found=[x for x in catalog['routes'] if x.get('route')==route['route']]
if not found:catalog['routes'].append(route)
else:assert found==[route],'Rota concorrente'
candidate=P/'canonical-routes.json';candidate.write_text(json.dumps(catalog,ensure_ascii=False,indent=2)+'\n',encoding='utf-8');pairs.append((candidate,catalogPath))
# Todos os guards antes de gravar; core existente so e tocado por baseline conhecido.
for source,target in pairs:
 entry=state.get(str(target));actual=sha(target)
 if entry:assert actual==entry['sha256'],'Guard: '+str(target)
 elif target==core:assert actual==sha(P/'RuntimeApiEntityActionService.before.php')
 elif target==catalogPath:pass # candidato mesclado da leitura corrente
 else:assert actual is None,'Destino novo ja existe: '+str(target)
backup=P/'canonical-backup';backup.mkdir(exist_ok=True)
for source,target in pairs:
 key=str(target);old=sha(target)
 if key not in state and target.exists():(backup/(str(len(state))+'-'+target.name)).write_bytes(target.read_bytes())
 target.parent.mkdir(parents=True,exist_ok=True);target.write_bytes(source.read_bytes());state[key]={'before':state.get(key,{}).get('before',old),'sha256':sha(target)}
file.write_text(json.dumps(state,indent=2)+'\n');print('PASS: '+str(len(pairs))+' arquivos do lote sincronizados por guard/hash; nenhum schema/Kendo alterado.')
