"""Guarded source synchronization only. Does not compile, publish, or change databases."""
from pathlib import Path
import hashlib,json,shutil
root=Path(__file__).resolve().parents[2];source=root/'integration-src/iol-pagina-inicial-gerencial'
motor=Path('D:/opencode/motor-progress/v2');state=root/'.runtime/iol-engine-20261019';state.mkdir(exist_ok=True)
old=json.loads((root/'.runtime/iol-gerencial/deliverables-sync-manifest.json').read_text())
baseline={str(Path(x['path'])):x['sha256'] for x in old}
previous=state/'canonical-manifest.json'
if previous.exists():baseline.update({str(Path(x['path'])):x['sha256'] for x in json.loads(previous.read_text())})
hashbytes=lambda data:hashlib.sha256(data).hexdigest()
active_path=state/'publish/active-manifest-v5.json'
published={Path(k).name:v for k,v in json.loads(active_path.read_text())['files'].items()} if active_path.exists() else {}
pairs=[]
for name in ['IolInicialGerencial.p','IolGerencialCollector.p','IolGerencialEnginePolicy.p','IolGerencialAggregate128.p','InstallIolEngineParameter.p']:
 pairs.append((source/name,motor/'sursum-api/programs'/name))
for name in ['IolGerencialIdentityTest.p','IolGerencialEnginePolicyTest.p','CompileIolGerencialTests.p','CompileIolGerencial128.p']:
 pairs.append((source/name,motor/'tests/abl/iol'/name))
for f in (source/'tests128').iterdir():
 if f.is_file():pairs.append((f,motor/'tests/abl/iol/tests128'/f.name))
for src,dst in pairs:
 if dst.exists() and dst.read_bytes()!=src.read_bytes() and hashbytes(dst.read_bytes())!=baseline.get(str(dst)):
  raise SystemExit('Canonical source diverged: '+str(dst))
manifest=[]
for src,dst in pairs:
 data=src.read_bytes();before=dst.read_bytes() if dst.exists() else None
 backup=state/'before-canonical'/dst.relative_to(motor)
 if before is not None and before!=data and not backup.exists():backup.parent.mkdir(parents=True,exist_ok=True);backup.write_bytes(before)
 dst.parent.mkdir(parents=True,exist_ok=True)
 if before is not None and dst.read_bytes()!=before:raise SystemExit('Concurrent source change: '+str(dst))
 dst.write_bytes(data)
 status='source matches published v5; executable availability in active manifest' if published.get(src.name)==hashbytes(data) else 'test or deployment utility; not an HTTP program'
 manifest.append({'path':str(dst),'sha256':hashbytes(data),'state':status})
previous.write_text(json.dumps(manifest,indent=2),encoding='utf-8')
print('PASS canonical source candidates synchronized: '+str(len(manifest))+'; no deployment')
