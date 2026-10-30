from pathlib import Path
import hashlib,json
r=Path(__file__).resolve().parents[2];b=r/'.runtime/purchase-signals-20261027'
block=(r/'integration-src/purchase-signals/ACCESS_CONTEXT_UPDATE.md').read_bytes().rstrip()+b'\n\n'
start=b'<!-- BEGIN CIW_PURCHASE_SIGNALS_20261027 -->';end=b'<!-- END CIW_PURCHASE_SIGNALS_20261027 -->'
backup=b/'memory-access-backup';assert not backup.exists();backup.mkdir();receipt=[]
for i,p in enumerate([r/'context/RETOMADA_2026-10-16.md',r/'context/PROJECT_CONTEXT.md',Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'),Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md')]):
 old=p.read_bytes();assert old.count(start)==1 and old.count(end)==1
 a=old.index(start);z=old.index(end)+len(end)
 while z<len(old)and old[z:z+1]in[b'\r',b'\n']:z+=1
 new=old[:a]+block+old[z:];q=backup/(str(i)+'-'+p.name);q.write_bytes(old);assert p.read_bytes()==old;p.write_bytes(new);receipt.append(dict(path=str(p),sha256=hashlib.sha256(new).hexdigest()))
(b/'memory-access-update.json').write_text(json.dumps(dict(success=True,files=receipt),indent=2)+'\n')
print('PASS four memories: exact read granted/consumed; menu correction pending specific approval')
