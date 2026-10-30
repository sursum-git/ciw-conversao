"""Sincroniza apenas fontes novos CIW e mescla uma rota; preserva diffs existentes."""
import hashlib
import json
from pathlib import Path
ROOT=Path(__file__).resolve().parents[2]
M=Path('D:/opencode/motor-progress/v2')
SOURCE=ROOT/'integration-src/ciw-access'
PRIVATE=ROOT/'.runtime/ciw-access-20261016'
BACKUP=PRIVATE/'canonical-backup'
BACKUP.mkdir(exist_ok=True)
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
compiled=json.loads((PRIVATE/'compiled-green/source-manifest.json').read_text(encoding='utf-8'))
active=json.loads((PRIVATE/'publish/active-manifest.json').read_text(encoding='utf-8'))
proof=json.loads((PRIVATE/'pasoe-negative-validation.json').read_text(encoding='utf-8'))
if len(proof['cases'])!=11 or not all(c['passed'] for c in proof['cases']):raise RuntimeError('PASOE nao validado')
files={}
for name in ['CiwAccessService.p','CiwAccessBoundary.p','CiwAccessRead.p']:
 if sha(SOURCE/name)!=compiled[name] or sha(SOURCE/name)!=active['artifacts']['sursum-api/programs/'+name]:raise RuntimeError('Fonte diverge da publicacao')
 files['sursum-api/programs/'+name]=(SOURCE/name).read_bytes()
for name in ['CiwAccessServiceTest.p','CiwAccessBoundaryTest.p','RunCiwAccessTests.p','CompileCiwAccessTests.p','ReadCiwAccessSchema.p']:
 if sha(SOURCE/name)!=compiled[name]:raise RuntimeError('Teste diverge da compilacao')
 files['tests/abl/ciw-access/'+name]=(SOURCE/name).read_bytes()
files['docs/CIW_ACCESS.md']=(SOURCE/'CiwAccessRead.md').read_bytes()
catalog=M/'conf-web-handler/program-routes.json'
baseline=catalog.read_bytes()
routes=json.loads(baseline.decode('utf-8-sig'))
route={'route':'/SursumPrograms/ciw-access','method':'POST','program':'sursum-api/programs/CiwAccessRead.p'}
matches=[r for r in routes['routes'] if r.get('route')==route['route']]
if matches and matches!=[route]:raise RuntimeError('Rota canonica conflitante')
if not matches:routes['routes'].append(route)
for relative,data in files.items():
 target=M/relative
 if target.exists() and target.read_bytes()!=data:raise RuntimeError('Arquivo canonico existente diferente: '+relative)
if catalog.read_bytes()!=baseline:raise RuntimeError('Catalogo mudou concorrentemente')
backupCatalog=BACKUP/'program-routes-before.json'
if not backupCatalog.exists():backupCatalog.write_bytes(baseline)
records=[]
for relative,data in files.items():
 target=M/relative
 target.parent.mkdir(parents=True,exist_ok=True)
 if not target.exists():
  with target.open('xb') as out:out.write(data)
 if target.read_bytes()!=data:raise RuntimeError('Hash canonico divergente')
 records.append({'file':relative,'sha256':sha(target)})
if not matches:
 if catalog.read_bytes()!=baseline:raise RuntimeError('Catalogo mudou; nao sobrescrever')
 catalog.write_text(json.dumps(routes,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
records.append({'file':'conf-web-handler/program-routes.json','sha256':sha(catalog)})
context=M/'context/PROJECT_CONTEXT.md'
marker='## CIW1A autorizado, publicado negando por padrao —16/10/2026'
text=context.read_text(encoding='utf-8-sig')
if marker not in text:
 (BACKUP/'PROJECT_CONTEXT-before.md').write_bytes(context.read_bytes())
 addition='\n\n'+marker+'\n\nCiwAccessRead/Boundary/Service novos em sursum-api/programs; rota POST /SursumPrograms/ciw-access mesclada preservando entradas existentes. Compilados OpenEdge12.2 no42, publicados com hashes/backup no compartilhamento137 via111; PASOE sursum-api/med validou11negativos. Servico156checks+fronteira82checks/cultura AMERICAN/EUROPEAN. Nenhuma escrita de negocio, schema, usuario, grupo, grant ou commit. Primeira configuracao privada tem allowedAuthProviders vazia: todos negados ate confirmar sessao real do provedor IMA. Caso positivo real e conclusao1A pendentes; nao incluir local/admin para fabricar prova. HTTP200 do roteador serializa envelope success=false e error.status de dominio; arrayraiz HTTP400 INVALID_JSON. Testes em tests/abl/ciw-access; contrato/docs em docs/CIW_ACCESS.md e D:/opencode/conversao-sc/docs/integracao-ciw-access-validacao.md. Credencial privada apenas no workspace conversao-sc/.runtime/ciw-access-20261016/connection.json; nunca imprimir conteudo. Sem frontend novo.\n'
 with context.open('a',encoding='utf-8') as out:out.write(addition)
(PRIVATE/'canonical-sync-manifest.json').write_text(json.dumps(records,indent=2),encoding='utf-8')
print('PASS:9arquivos novos canonicos e1rota; contexto atualizado, nenhuma configuracao privada copiada.')
