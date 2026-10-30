from pathlib import Path
import json,hashlib,datetime
r=Path(__file__).resolve().parents[2];b=r/'.runtime/purchase-signals-20261027'
block=(r/'integration-src/purchase-signals/CONTEXT_UPDATE.md').read_bytes()
targets=[r/'context/RETOMADA_2026-10-16.md',r/'context/PROJECT_CONTEXT.md',Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'),Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md')]
sha=lambda x:hashlib.sha256(x).hexdigest()
backup=b/'memory-backup';assert not backup.exists();backup.mkdir();receipt=[]
for i,p in enumerate(targets):
 old=p.read_bytes();assert b'BEGIN CIW_PURCHASE_SIGNALS_20261027' not in old
 q=backup/(str(i)+'-'+p.name);q.write_bytes(old)
 assert p.read_bytes()==old,'Concurrent context edit'
 p.write_bytes(block+old);assert p.read_bytes()==block+old
 receipt.append(dict(path=str(p),beforeSha256=sha(old),afterSha256=sha(p.read_bytes()),backup=str(q)))
(b/'memory-update.json').write_text(json.dumps(dict(success=True,files=receipt,at=datetime.datetime.now(datetime.timezone.utc).isoformat()),indent=2)+'\n')
print('PASS four project memories updated; existing text preserved')
