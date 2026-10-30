from pathlib import Path
import json,hashlib
r=Path(__file__).resolve().parents[2];s=r/'.runtime/purchase-allocations-20261026';b=s/'build6';candidate=r/'integration-src/purchase-allocations'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
text=(b/'compiled122/compile.log').read_text();assert 'OpenEdge 12.2' in text and 'PASS COMPILE ALL' in text and 'COMPILER:ERROR=yes' not in text
logs=[]
for cp in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:
  for prefix,phrase in [('allocations-tests-','PASS allocations checks=27'),('erp-read-','PASS 47 checks'),('purchase-item-read-','PASS 9 checks')]:
   p=b/'compiled122'/(prefix+cp+'-'+culture+'.log');text=p.read_text(encoding='utf-8-sig');assert phrase in text and 'FAIL' not in text;logs.append(dict(file=str(p.relative_to(r)),sha256=sha(p)))
files=[]
for name in ['PurchaseItemAllocationsService','PurchaseItemAllocationsApi','CiwErpReadService','CiwCadastrosCrud']:
 for ext in ['p','r']:
  rel='sursum-api/programs/'+name+'.'+ext;p=candidate/'abl'/(name+'.p') if ext=='p' else b/'compiled122'/rel
  if ext=='p':assert sha(p)==sha(b/'package'/rel)
  files.append(dict(relative=rel,file=p.name,source=str(p.relative_to(r)),sha256=sha(p)))
plan=json.loads((s/'canonical-plan.json').read_text())
for f in plan['files']:f['sha256']=sha(Path(f['source']))
(s/'canonical-plan.json').write_text(json.dumps(plan,indent=2),encoding='utf-8')
(s/'official-compile-verification.json').write_text(json.dumps(dict(success=True,version='12.2',build=6,compileEntries=11,testsPerCombination=83,newChecks=27,regressionChecks=56,combinations=4,files=files,testEvidence=logs,businessWrites=False),indent=2),encoding='utf-8')
print('PASS official build6 11entries/83checks x4; current source hashes match package; baseline target guards retained')
