"""Copy sealed local inputs to NEW review output; never run network or overwrite receipts."""
from pathlib import Path
import argparse,shutil,json
D=Path(__file__).resolve().parent;W=D.parents[2]
p=argparse.ArgumentParser();p.add_argument('--out',required=True);a=p.parse_args();out=Path(a.out).resolve()
assert not out.exists(),'Review output must be new'
assert out.is_relative_to(W/'.runtime'),'Review output must stay in workspace .runtime'
src=W/'.runtime/ciw-completion-20261028/container-supplier-discounts-integer-range-v2/final-local-v1'
out.mkdir(parents=True);shutil.copytree(src/'php-stage',out/'php-stage')
for name in ['php-stage-bootstrap.php','phpunit.xml']:
 body=(src/name).read_bytes().replace(src.as_posix().encode(),out.as_posix().encode());(out/name).write_bytes(body)
print(json.dumps({'success':True,'out':str(out),'executeOnlyLocally':True,'networkExecuted':False,'businessWrites':False}))
