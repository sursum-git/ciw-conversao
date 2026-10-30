from pathlib import Path
import json,hashlib
r=Path(__file__).resolve().parents[2];b=r/'.runtime/purchase-quantity-periods-20261028';old=r/'.runtime/purchase-quantities-20261027';stage='/tmp/ciw-purchase-quantity-periods-20261028'
load=lambda n:json.loads((b/n).read_text(encoding='utf-8-sig'))
save=lambda n,v:(b/n).write_text(json.dumps(v,indent=2)+'\n')
proof=load('official-compile-verification.json');before=load('runtime-before.json')
assert proof['success']and proof['testsPerCombination']==231 and before['success'] and before['parameterIncludeMatches']
assert load('canonical-manifest.json')['success']and load('review-final.json')['status']=='reviewed_no_open_confirmed_P1_P2'
assert not(b/'publication-manifest.json').exists()
targets={};uploads=[]
for f in proof['files']:
 p=r/f['source'];assert hashlib.sha256(p.read_bytes()).hexdigest()==f['sha256']
 targets[f['relative']]={**before['targets'][f['relative']],'sha256':f['sha256']};uploads.append(dict(local=f['source'],remote=stage+'/'+f['file']))
save('publication-manifest.json',dict(success=True,targets=targets,businessWrites=False))
publish=(old/'publish-runtime.py').read_text().replace('ciw-purchase-quantities-20261027','ciw-purchase-quantity-periods-20261028').replace("assert json.loads((stage/'review-final.json').read_text())['success']","assert json.loads((stage/'review-final.json').read_text())['status']=='reviewed_no_open_confirmed_P1_P2'").replace("proof['testsPerCombination']==150","proof['testsPerCombination']==231").replace('len(approved)==10 and len(m[\'targets\'])==10',"len(approved)==18 and len(m['targets'])==18").replace("priority=['PurchaseImportQuantityRules','PurchaseImportQuantitiesService','PurchaseImportQuantitiesApi','CiwErpReadService','CiwCadastrosCrud']","priority=['PurchaseImportQuantitiesTable','PurchaseQuantityPeriodDates','PurchaseImportQuantitiesCollector','PurchaseQuantityPeriodRules','PurchaseQuantityPeriodFilter','PurchaseQuantityPeriodsService','PurchaseImportQuantitiesService','CiwErpReadService','PurchaseQuantityPeriodsApi','CiwCadastrosCrud']").replace('.container-allocation-tmp','.quantity-period-tmp').replace('PASS10 reviewed','PASS18 reviewed')
(b/'publish-runtime.py').write_text(publish)
(b/'refresh-runtime.py').write_text((old/'refresh-runtime.py').read_text().replace('ciw-purchase-quantities-20261027','ciw-purchase-quantity-periods-20261028'))
for name in ['publication-manifest.json','official-compile-verification.json','review-final.json','publish-runtime.py','refresh-runtime.py']:uploads.append(dict(local=str((b/name).relative_to(r)),remote=stage+'/'+name))
save('publish-plan.json',dict(server='runtime',directories=[stage],uploads=uploads,commands=['python3 '+stage+'/publish-runtime.py'],downloads=[dict(local=str((b/'active-manifest.json').relative_to(r)),remote=stage+'/active-manifest.json')]))
save('refresh-plan.json',dict(server='runtime',commands=['python3 '+stage+'/refresh-runtime.py'],downloads=[dict(local=str((b/name).relative_to(r)),remote=stage+'/'+name)for name in ['jmx-inspection.json','med-session-refresh.json']]))
print('PASS guarded publication18official artifacts;dependency order,dispatcher last;refresh only idleMED')
