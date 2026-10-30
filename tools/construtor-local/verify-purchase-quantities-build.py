from pathlib import Path
import json,hashlib
r=Path(__file__).resolve().parents[2];s=r/'.runtime/purchase-quantities-20261027';b=s/'build3';c=r/'integration-src/purchase-quantities';motor=Path('D:/opencode/motor-progress/v2');builder=Path('D:/opencode/construtor-pg')
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
t=(b/'compiled122/compile.log').read_text();assert 'OpenEdge 12.2' in t and 'PASS COMPILE ALL' in t and 'COMPILER:ERROR=yes' not in t
logs=[]
for cp in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:
  for prefix,phrase in [('quantity-rules-','PASS quantity rules checks=50'),('quantities-service-','PASS quantities service checks=44'),('erp-read-','PASS 47 checks'),('purchase-item-read-','PASS 9 checks')]:
   p=b/'compiled122'/(prefix+cp+'-'+culture+'.log');t=p.read_text(encoding='utf-8-sig');assert phrase in t and 'FAIL'not in t;logs.append(dict(file=str(p.relative_to(r)),sha256=sha(p)))
files=[];targets=[]
for n in ['PurchaseImportQuantityRules','PurchaseImportQuantitiesService','PurchaseImportQuantitiesApi','CiwErpReadService','CiwCadastrosCrud']:
 for ext in ['p','r']:
  rel='sursum-api/programs/'+n+'.'+ext;p=c/'abl'/(n+'.p')if ext=='p'else b/'compiled122'/rel
  if ext=='p':assert sha(p)==sha(b/'package'/rel)
  files.append(dict(relative=rel,file=p.name,source=str(p.relative_to(r)),sha256=sha(p)))
 targets.append((c/'abl'/(n+'.p'),motor/'sursum-api/programs'/(n+'.p')))
for n in ['PurchaseImportQuantityRulesTest.p','PurchaseImportQuantitiesServiceTest.p']:targets.append((c/'tests'/n,motor/'tests/abl/purchase-quantities'/n))
for n in ['proc-compra-quantidades-builder-draft.json','processos-compra-med-builder-draft.json','api-source-additions.json']:targets.append((c/'metadata'/n,builder/'integrations/ciw-purchase-quantities'/n))
base={str(Path(x['source']).resolve()):x['sha256']for x in json.loads((s/'baseline-manifest.json').read_text())}
plan=[]
for source,target in targets:
 before=base.get(str(target.resolve()))
 assert (sha(target)if target.exists()else None)==before,'Concurrent or unexpected target '+str(target)
 plan.append(dict(source=str(source),target=str(target),sha256=sha(source),beforeSha256=before))
assert not (s/'canonical-plan.json').exists()
(s/'canonical-plan.json').write_text(json.dumps(dict(files=plan),indent=2)+'\n')
(s/'official-compile-verification.json').write_text(json.dumps(dict(success=True,version='12.2',build=3,compileEntries=13,testsPerCombination=150,newChecks=94,regressionChecks=56,combinations=4,files=files,testLogs=logs,businessWrites=False),indent=2)+'\n')
print('PASS official12.2/build3:150checks x4,10artifacts,10guarded canonical files')
