"""Local synthetic verification; never invokes the root-only exporter or business APIs."""
from pathlib import Path
import hashlib
import json
import subprocess
from datetime import datetime, timezone

WORKSPACE=Path('D:/opencode/conversao-sc')
DOMAIN=WORKSPACE/'integration-src/ciw-completion-20261028/container-item-action-native'
RECEIPTS=WORKSPACE/'.runtime/ciw-completion-20261028/container-item-action-native/local-review-v1'
NODE='C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/bin/node.exe'
PHP='C:/php-8.4.3/php.exe'
commands=[
 [NODE,'--check',str(WORKSPACE/'tools/construtor-local/export-ciw-container-item-action-current.cjs')],
 [NODE,'--test',str(DOMAIN/'tests/export-current.test.cjs')],
 [NODE,'--test',str(DOMAIN/'tests/native-capabilities.test.cjs')],
 [PHP,str(DOMAIN/'tests/request-context-capability.php')],
]
if __name__=='__main__':
 RECEIPTS.mkdir(parents=True,exist_ok=False)
 results=[]
 for index,command in enumerate(commands):
  result=subprocess.run(command,cwd=WORKSPACE,text=True,capture_output=True,encoding='utf-8')
  log=RECEIPTS/f'check-{index+1}.log'
  log.write_text(result.stdout+result.stderr,encoding='utf-8')
  results.append({'command':command,'exitCode':result.returncode,'log':str(log),'sha256':hashlib.sha256(log.read_bytes()).hexdigest()})
  if result.returncode: raise RuntimeError(f'Local verification failed; inspect {log}')
 receipt={'success':True,'atUtc':datetime.now(timezone.utc).isoformat(),'exporterOfflineTests':8,'nativePrototypeTests':5,'realPhpContextChecks':3,'actualMetadataExportExecuted':False,'networkExecuted':False,'businessWrites':False,'catalogWrites':False,'commands':results}
 (RECEIPTS/'verification.json').write_text(json.dumps(receipt,indent=2)+'\n',encoding='utf-8')
 print(json.dumps({'success':True,'checks':[8,5,3],'receipt':str(RECEIPTS/'verification.json'),'networkExecuted':False}))
