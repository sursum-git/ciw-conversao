"""Own local stages only; no network, DB, canonical writes or official12.2."""
from pathlib import Path
import hashlib,json,shutil
ROOT=Path('D:/opencode/conversao-sc')
DOMAIN=ROOT/'integration-src/ciw-completion-20261028/supplier-discounts-readonly'
OUT=ROOT/'.runtime/ciw-completion-20261028/supplier-discounts-readonly'
OFFICIAL=ROOT/'.runtime/ciw-completion-20261028/official-build11'
def digest(p):return hashlib.sha256(p.read_bytes()).hexdigest()
for row in json.loads((DOMAIN/'baselines.json').read_text())['files']:
 assert digest(Path(row['target']))==row['sha256'],row['target']
 assert digest(DOMAIN/row['baselineFile'])==row['sha256']
for name in ['ImportDiscountsCollectorTest.p','ImportDiscountsReadTest.p','ImportDiscountsLabelsTest.p']:
 shutil.copy2(ROOT/'.runtime/ciw-completion-20261028/official-build7/package'/name,DOMAIN/'tests/abl'/name)
pkg=OUT/'local/package';(pkg/'sursum-api/includes').mkdir(parents=True,exist_ok=True)
for source in (DOMAIN/'candidate-exact').glob('*.i'):shutil.copy2(source,pkg/'sursum-api/includes'/source.name)
for source in (DOMAIN/'includes').glob('*.i'):shutil.copy2(source,pkg/'sursum-api/includes'/source.name)
for source in (DOMAIN/'test-inputs/sursum-api/includes').glob('*.i'):shutil.copy2(source,pkg/'sursum-api/includes'/source.name)
full=OUT/'full-php';full.mkdir(exist_ok=True)
shutil.copytree(OFFICIAL/'backend-stage',full/'backend-stage',dirs_exist_ok=True)
shutil.copytree(OFFICIAL/'php-tests',full/'php-tests',dirs_exist_ok=True)
shutil.copy2(OFFICIAL/'php-bootstrap.php',full/'php-bootstrap.php')
for p in (DOMAIN/'candidate-exact').glob('*.php'):shutil.copy2(p,full/'backend-stage/backend/src/Runtime'/p.name)
config=f'''<?xml version="1.0" encoding="UTF-8"?><phpunit bootstrap="{full.as_posix()}/php-bootstrap.php" cacheResult="false"><testsuites><testsuite name="SupplierDiscountFullStage"><directory>D:/opencode/construtor-pg/backend/tests</directory><directory>{full.as_posix()}/php-tests</directory><directory>{DOMAIN.as_posix()}/tests/php</directory></testsuite></testsuites></phpunit>'''
(full/'phpunit.xml').write_text(config,encoding='utf-8')
consumer_files=[DOMAIN/'candidate-exact/ImportDiscountsCollector.p',DOMAIN/'candidate-exact/ImportDiscountsReadService.p',DOMAIN/'abl/ImportDiscountsSupplierCollector.p']
closed={'scope':'Internal TT ABI includes arquivo; existing JSON resources retain old field list; all direct TT consumers must compile and deploy coherently','canonicalDirectConsumers':['ImportDiscountsCollector.p','ImportDiscountsReadService.p'],'newDirectConsumers':['ImportDiscountsSupplierCollector.p'],'allDirectConsumers':[{'path':str(p),'sha256':digest(p)}for p in consumer_files],'table':{'path':str(DOMAIN/'candidate-exact/ImportDiscountsReadTables.i'),'sha256':digest(DOMAIN/'candidate-exact/ImportDiscountsReadTables.i')},'uniqueCollectorBody':{'path':str(DOMAIN/'includes/ImportDiscountsCollectorBody.i'),'sha256':digest(DOMAIN/'includes/ImportDiscountsCollectorBody.i')},'localOnly':True,'official122Required':True}
(OUT/'abi-closure.json').write_text(json.dumps(closed,indent=2)+'\n',encoding='utf-8')
print(json.dumps({'prepared':True,'fullStage':str(full),'ttConsumerCount':len(consumer_files),'canonicalWrites':False}))
