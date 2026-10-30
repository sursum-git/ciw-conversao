"""Aplica somente o candidato IOL, preservando SHA256 dos diffs anteriores."""
from pathlib import Path
import hashlib,json,shutil
ROOT=Path(__file__).resolve().parents[2]
stage=ROOT/'integration-src/iol-pagina-inicial-gerencial/construtor-core'
target=Path('D:/opencode/construtor-pg')
state=ROOT/'.runtime/iol-gerencial'
baseline={x['path']:x['sha256'] for x in json.loads((state/'baseline.json').read_text(encoding='utf-8'))}
previousPath=state/'core-sync-manifest.json'
previous={x['path']:x for x in json.loads(previousPath.read_text(encoding='utf-8'))} if previousPath.exists() else {}
digest=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
files=[]
for directory in ['backend/src','backend/tests','tests','src','public','docs']:
 for src in (stage/directory).rglob('*') if (stage/directory).exists() else []:
  if not src.is_file():continue
  rel=src.relative_to(stage).as_posix();dst=target/rel
  if dst.exists() and digest(src)==digest(dst):continue
  expected=previous.get(rel,{}).get('sha256',baseline.get(rel))
  if dst.exists() and digest(dst)!=expected:raise SystemExit('Destino alterado fora do baseline: '+rel)
  files.append((src,dst,rel))
backup=state/'before-core-sync';manifest=[]
for src,dst,rel in files:
 if dst.exists() and not (backup/rel).exists():
  save=backup/rel;save.parent.mkdir(parents=True,exist_ok=True);shutil.copy2(dst,save)
 dst.parent.mkdir(parents=True,exist_ok=True);shutil.copy2(src,dst)
 if digest(dst)!=digest(src):raise SystemExit('Falha de hash: '+rel)
 manifest.append({'path':rel,'sha256':digest(dst),'before':baseline.get(rel)})
for entry in manifest:previous[entry['path']]=entry
(state/'core-sync-manifest.json').write_text(json.dumps(list(previous.values()),indent=2),encoding='utf-8')
print('Aplicados '+str(len(manifest))+' arquivos IOL com baseline/backup/hashes.')
