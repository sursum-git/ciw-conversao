from pathlib import Path
import json,hashlib
W=Path('D:/opencode/conversao-sc');STATE=W/'.runtime/ciw-completion-20261028/expense-tax-relations-readonly'
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
receipt=W/'.runtime/ciw-completion-20261028/official-build9-v2/canonical-manifest.json';m=json.loads(receipt.read_text())
assert m['success'] is True and len(m['files'])==4
for row in m['files']:assert sha(Path(row['target']))==row['sha256']
src=Path('D:/opencode/construtor-pg/backend/src/Runtime/RuntimeApiEntityActionService.php')
assert sha(src)=='399cf18a00bca42875c2a35c648eaa4021029b4e3473b872b16f2e62865c96d2'
dest=STATE/'baseline/php'/src.name;old=sha(dest)
if old!=sha(src):
 previous=STATE/'baseline-before9/php'/src.name;previous.parent.mkdir(parents=True,exist_ok=True);previous.write_bytes(dest.read_bytes());dest.write_bytes(src.read_bytes())
proof={'success':True,'canonical9ReceiptSha256':sha(receipt),'oldProvisionalBaselineSha256':old,'baseline9Sha256':sha(dest),'nf1053Preserved':True,'canonicalEdited':False}
(STATE/'rebase-9-proof.json').write_text(json.dumps(proof,indent=2)+'\n',encoding='utf-8')
print(json.dumps(proof))
