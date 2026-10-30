"""Aplica somente lote PHP CIW autenticacao, com baseline/backup e sem segredos."""
import hashlib,json
from pathlib import Path
ROOT=Path(__file__).resolve().parents[2]
STAGE=ROOT/'.runtime/ciw-auth-20261017/php'
B=Path('D:/opencode/construtor-pg/backend')
baseline=json.loads((STAGE/'baseline.json').read_text())
mapping={p:'src/Auth/'+p.name for p in (STAGE/'src').glob('ImaUserWeb*.php')}
mapping[STAGE/'src/ConfigureImaUserWebProviderCommand.php']='src/Command/ConfigureImaUserWebProviderCommand.php'
mapping.update({p:'tests/Auth/'+p.name for p in (STAGE/'tests').glob('*.php')})
mapping[STAGE/'tests/fixtures/ima-user-web.php']='tests/Auth/fixtures/ima-user-web.php'
mapping[STAGE/'src/AuthService.php']='src/Auth/AuthService.php'
mapping[STAGE/'src/AdminCrudDefinitionFactory.php']='src/Admin/AdminCrudDefinitionFactory.php'
mapping[STAGE/'services.yaml']='config/services.yaml'
def digest(p):return hashlib.sha256(p.read_bytes()).hexdigest()
for source,relative in mapping.items():
 target=B/relative
 if relative in baseline:
  if not target.exists() or digest(target)!=baseline[relative]:raise RuntimeError('Canonico mudou: '+relative)
 elif target.exists():raise RuntimeError('Arquivo novo ja existe: '+relative)
backup=STAGE/'canonical-backup'
backup.mkdir(exist_ok=True)
records=[]
for source,relative in mapping.items():
 target=B/relative;target.parent.mkdir(parents=True,exist_ok=True)
 if target.exists():
  copy=backup/relative;copy.parent.mkdir(parents=True,exist_ok=True)
  if not copy.exists():copy.write_bytes(target.read_bytes())
  if digest(target)!=baseline[relative]:raise RuntimeError('Alteracao concorrente: '+relative)
  target.write_bytes(source.read_bytes())
 else:
  with target.open('xb') as out:out.write(source.read_bytes())
 if digest(target)!=digest(source):raise RuntimeError('Aplicacao divergente')
 records.append({'file':relative,'before':baseline.get(relative),'after':digest(target)})
(STAGE/'applied-manifest.json').write_text(json.dumps(records,indent=2),encoding='utf-8')
print('PASS:'+str(len(records))+'arquivosPHP aplicados com guards/backups; sem cadastro/conta/config privada alterados')
