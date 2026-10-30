from pathlib import Path
import hashlib,json
D=Path(__file__).resolve().parent
manifest=D/'frozen-v1/manifest.json'
value=json.loads(manifest.read_text(encoding='utf-8'))
for item in value['files']:
 p=Path(item['path']);assert hashlib.sha256(p.read_bytes()).hexdigest()==item['sha256'],str(p)
print(json.dumps({'success':True,'readOnly':True,'filesVerified':len(value['files']),'manifestSha256':hashlib.sha256(manifest.read_bytes()).hexdigest(),'testsRerun':False,'networkExecuted':False}))
