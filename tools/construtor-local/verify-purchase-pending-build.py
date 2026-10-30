from pathlib import Path
import json,hashlib,re
r=Path(__file__).resolve().parents[2];b=r/'.runtime/purchase-pending-integration-20261028';build=b/'build3';compiled=build/'compiled122';package=build/'package'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
text=(compiled/'compile.log').read_text(encoding='utf-8-sig');assert 'OpenEdge 12.2 NUM-DBS=0' in text and 'PASS COMPILE ALL' in text and not re.search(r'COMPILER:ERROR=(yes|true)',text,re.I)
assert text.count('COMPILER:ERROR=')==28
expected={'PurchaseSignalConfigServiceTest':40,'PurchaseSignalContainerRulesTest':13,'PurchaseSignalsGlobalServiceTest':55,'PurchaseSignalsServiceTest':34,'PurchaseSignalRulesTest':30,'CiwErpReadTest':47,'PurchaseItemsReadTest':9,'CiwCadastroCrudTest':60,'CiwCadastroDefinitionTest':10}
logs=[]
for cp in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:
  count=0
  for name,n in expected.items():
   p=compiled/(name+'-'+cp+'-'+culture+'.log');s=p.read_text(encoding='utf-8-sig');assert 'PASS' in s and 'FAIL' not in s,(p,s)
   assert re.search(r'(?:checks='+str(n)+r'\b|PASS '+str(n)+r' checks\b)',s),(p,s)
   logs.append(dict(file=str(p.relative_to(r)),sha256=sha(p)));count+=n
  assert count==298
programs=['PurchaseSignalContainerRules','PurchaseSignalsCollector','PurchaseSignalsService','PurchaseSignalsGlobalService','PurchaseSignalsGlobalApi','PurchaseSignalConfigService','PurchaseSignalConfigApi','CiwErpReadService','CiwCadastrosCrud']
files=[]
for name in programs:
 for extension in ['.p','.r']:
  relative='sursum-api/programs/'+name+extension;p=(package if extension=='.p'else compiled)/relative;assert p.exists();files.append(dict(relative=relative,file=p.name,source=str(p.relative_to(r)),sha256=sha(p)))
relative='sursum-api/includes/PurchaseSignalsTable.i';p=package/relative;files.append(dict(relative=relative,file=p.name,source=str(p.relative_to(r)),sha256=sha(p)))
v=dict(success=True,version='12.2',build=3,compileEntries=28,testsPerCombination=298,combinations=4,testLogs=logs,files=files,compileWithoutDatabase=True,testsWithoutDatabase=True,businessWrites=False)
(b/'official-compile-verification.json').write_text(json.dumps(v,indent=2)+'\n')
print('PASS official12.2:28compiles,298checks x4,36PASSlogs,19publish artifacts,NUMDBS0')
