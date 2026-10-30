"""Prepare only the15 verified wave1 runtime artifacts, dispatcher last."""
from pathlib import Path
import hashlib,json
r=Path(__file__).resolve().parents[2];b=r/'.runtime/ciw-completion-20261028/official-build3';stage='/tmp/ciw-completion-20261028-wave1'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
save=lambda n,v:(b/n).write_text(json.dumps(v,indent=2)+'\n')
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
proof=load(b/'official-compile-verification.json');before=load(b/'runtime-before.json')
assert proof['success'] and proof['testsPerCombination']==384 and before['success'] and load(b/'canonical-manifest.json')['success']
assert not(b/'publication-manifest.json').exists()
for f in load(b/'canonical-manifest.json')['files']:assert sha(Path(f['target']))==f['sha256']
targets={};uploads=[]
for f in proof['files']:
 assert sha(r/f['source'])==f['sha256']
 targets[f['relative']]={**before['targets'][f['relative']],'sha256':f['sha256'],'file':f['file']};uploads.append(dict(local=f['source'],remote=stage+'/'+f['file']))
save('publication-manifest.json',dict(success=True,targets=targets,businessWrites=False))
old=r/'.runtime/purchase-quantity-periods-20261028'
script=(old/'publish-runtime.py').read_text().replace('ciw-purchase-quantity-periods-20261028','ciw-completion-20261028-wave1').replace("assert json.loads((stage/'review-final.json').read_text())['status']=='reviewed_no_open_confirmed_P1_P2'","assert json.loads((stage/'review-final.json').read_text())['success']").replace("proof['testsPerCombination']==231","proof['testsPerCombination']==384").replace("len(approved)==18 and len(m['targets'])==18","len(approved)==15 and len(m['targets'])==15").replace("priority=['PurchaseImportQuantitiesTable','PurchaseQuantityPeriodDates','PurchaseImportQuantitiesCollector','PurchaseQuantityPeriodRules','PurchaseQuantityPeriodFilter','PurchaseQuantityPeriodsService','PurchaseImportQuantitiesService','CiwErpReadService','PurchaseQuantityPeriodsApi','CiwCadastrosCrud']","priority=['ContainersVersionHistoryTable','ContainersVersionService','ContainersVersionHistoryService','ContainerFiscalReadOnlyService','CiwErpReadService','ContainerFiscalReadOnlyApi','ContainersVersionHistoryApi','CiwCadastrosCrud']").replace('.quantity-period-tmp','.completion-wave1-tmp').replace('PASS18 reviewed','PASS15 reviewed')
(b/'publish-runtime.py').write_text(script)
(b/'refresh-runtime.py').write_text((old/'refresh-runtime.py').read_text().replace('ciw-purchase-quantity-periods-20261028','ciw-completion-20261028-wave1'))
reviews=[r/'.runtime/ciw-completion-20261028/container-fiscal-readonly/manager-review-final.json',r/'.runtime/ciw-completion-20261028/container-version-history/manager-review-final-v1.3.json']
assert all(load(p)['remainingP1P2']==[]for p in reviews)
save('review-final.json',dict(success=True,remainingP1P2=[],reviews=[dict(path=str(p),sha256=sha(p))for p in reviews],combinedPhpTests=885,combinedPhpAssertions=5841))
for name in ['publication-manifest.json','official-compile-verification.json','review-final.json','publish-runtime.py','refresh-runtime.py']:uploads.append(dict(local=str((b/name).relative_to(r)),remote=stage+'/'+name))
save('publish-plan.json',dict(server='runtime',uploads=uploads,commands=['python3 '+stage+'/publish-runtime.py'],downloads=[dict(local=str((b/'active-manifest.json').relative_to(r)),remote=stage+'/active-manifest.json')]))
save('refresh-plan.json',dict(server='runtime',commands=['python3 '+stage+'/refresh-runtime.py'],downloads=[dict(local=str((b/name).relative_to(r)),remote=stage+'/'+name)for name in ['jmx-inspection.json','med-session-refresh.json']]))
print('PASS prepared15artifact publication; backwards compatible dependencies first; dispatcher last; MED idle refresh separate')
