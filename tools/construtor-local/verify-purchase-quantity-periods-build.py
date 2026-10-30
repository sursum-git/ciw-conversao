from pathlib import Path
import hashlib,json,re
r=Path(__file__).resolve().parents[2];s=r/'.runtime/purchase-quantity-periods-20261028';b=s/'build9';c=r/'integration-src/purchase-quantity-periods';motor=Path('D:/opencode/motor-progress/v2');builder=Path('D:/opencode/construtor-pg')
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
text=(b/'compiled122/compile.log').read_text();assert 'OpenEdge 12.2' in text and 'PASS COMPILE ALL'in text and 'COMPILER:ERROR=yes'not in text and text.count('COMPILER:ERROR=no')==19
logs=[]
checks=[('quantity-period-rules-','PASS period rules checks=21'),('quantity-period-filter-','PASS period filter checks=27'),('quantity-period-service-','PASS period service checks=33'),('quantities-service-','PASS quantities service checks=44'),('quantity-rules-','PASS quantity rules checks=50'),('erp-read-','PASS 47 checks'),('purchase-item-read-','PASS 9 checks')]
for cp in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:
  for prefix,expected in checks:
   p=b/'compiled122'/(prefix+cp+'-'+culture+'.log');value=p.read_text(encoding='utf-8-sig');assert expected in value and 'FAIL'not in value
   logs.append(dict(file=str(p.relative_to(r)),sha256=sha(p)))
files=[];targets=[]
for name in ['PurchaseImportQuantitiesCollector','PurchaseImportQuantitiesService','PurchaseQuantityPeriodRules','PurchaseQuantityPeriodFilter','PurchaseQuantityPeriodsService','PurchaseQuantityPeriodsApi','CiwErpReadService','CiwCadastrosCrud']:
 for ext in ['p','r']:
  relative='sursum-api/programs/'+name+'.'+ext;p=c/'abl'/(name+'.p')if ext=='p'else b/'compiled122'/relative
  if ext=='p':assert sha(p)==sha(b/'package'/relative)
  files.append(dict(relative=relative,file=p.name,source=str(p.relative_to(r)),sha256=sha(p)))
 targets.append((c/'abl'/(name+'.p'),motor/'sursum-api/programs'/(name+'.p')))
for name in ['PurchaseImportQuantitiesTable.i','PurchaseQuantityPeriodDates.i']:
 p=c/'includes'/name;relative='sursum-api/includes/'+name;assert sha(p)==sha(b/'package'/relative)
 files.append(dict(relative=relative,file=p.name,source=str(p.relative_to(r)),sha256=sha(p)));targets.append((p,motor/relative))
for name in ['PurchaseQuantityPeriodRulesTest.p','PurchaseQuantityPeriodFilterTest.p','PurchaseQuantityPeriodsServiceTest.p']:targets.append((c/'tests'/name,motor/'tests/abl/purchase-quantity-periods'/name))
targets.append((c/'php/RuntimeCiwErpQuery.php',builder/'backend/src/Runtime/RuntimeCiwErpQuery.php'))
targets.append((c/'tests/RuntimePurchaseQuantityPeriodsQueryTest.php',builder/'backend/tests/Runtime/RuntimePurchaseQuantityPeriodsQueryTest.php'))
for name in ['quantidades-importadas-periodo-med-builder-draft.json','api-source-additions.json']:targets.append((c/'metadata'/name,builder/'integrations/ciw-purchase-quantity-periods'/name))
base={str(Path(x['source']).resolve()):x['sha256']for x in json.loads((s/'baseline-manifest.json').read_text())}
plan=[]
for source,target in targets:
 before=base.get(str(target.resolve()));assert (sha(target)if target.exists()else None)==before,'Concurrent target '+str(target)
 plan.append(dict(source=str(source),target=str(target),sha256=sha(source),beforeSha256=before))
assert len(plan)==17 and len(files)==18
assert not(s/'canonical-plan.json').exists()
(s/'canonical-plan.json').write_text(json.dumps(dict(files=plan),indent=2)+'\n')
(s/'official-compile-verification.json').write_text(json.dumps(dict(success=True,version='12.2',build=9,compileEntries=19,testsPerCombination=231,combinations=4,files=files,testLogs=logs,compileWithSchemaOnly=True,testsWithoutDatabase=True,businessWrites=False),indent=2)+'\n')
print('PASS official12.2/build9:19compiles,231checks x4,18runtime artifacts,17guarded canonical targets')
