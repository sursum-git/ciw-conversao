from pathlib import Path
import argparse,shutil,json,hashlib
D=Path(__file__).resolve().parent;W=D.parents[2];source=W/'.runtime/ciw-completion-20261028/supplier-discounts-routing-rebase13/full-stage-v2'
p=argparse.ArgumentParser();p.add_argument('--out',required=True);out=Path(p.parse_args().out).resolve();assert out.is_relative_to(W/'.runtime') and not out.exists(),'Fresh workspace .runtime output required'
out.mkdir(parents=True)
for rel in ['php-stage','legacy13']:shutil.copytree(source/rel,out/rel)
for rel in ['php-bootstrap.php','phpunit.xml']:shutil.copyfile(source/rel,out/rel)
for f in out.rglob('*'):
 if not f.is_file() or f.suffix not in ['.php','.json','.xml']:continue
 before=f.read_bytes();body=before
 for a,b in [(source.as_posix(),out.as_posix()),(str(source),str(out)),(str(source).replace('\\','\\\\'),str(out).replace('\\','\\\\'))]:body=body.replace(a.encode(),b.encode())
 if body!=before:f.write_bytes(body)
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert all(sha(p)==sha(out/'php-stage'/p.relative_to(source/'php-stage'))for p in(source/'php-stage').rglob('*.php'))
print(json.dumps({'success':True,'out':str(out),'stageProductBytesExact':True,'networkExecuted':False,'testsExecuted':False}))
