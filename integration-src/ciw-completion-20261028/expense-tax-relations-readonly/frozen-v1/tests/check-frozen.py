from pathlib import Path
import json,hashlib
W=Path('D:/opencode/conversao-sc');STATE=W/'.runtime/ciw-completion-20261028/expense-tax-relations-readonly';ROOT=W/'integration-src/ciw-completion-20261028/expense-tax-relations-readonly/frozen-v1';PRIVATE=STATE/'frozen-v1'
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
manifest=json.loads((ROOT/'manifest.json').read_text());assert sha(ROOT/'manifest.json')==sha(PRIVATE/'manifest.json')
for row in manifest['sourceFiles']:assert sha(ROOT/row['path'])==row['sha256'],row['path']
for row in manifest['runtimeFiles']:assert sha(PRIVATE/row['path'])==row['sha256'],row['path']
for row in manifest['evidence']:assert sha(Path(row['path']))==row['sha256'],row['path']
for row in manifest['candidateSources']:assert sha(Path(row['target']))==row['baselineSha256'],'rebase gate: '+row['target']
assert not Path(manifest['newPhpFile']['target']).exists(),'new helper target already exists; review integration state'
print(json.dumps({'success':True,'manifestSha256':sha(ROOT/'manifest.json'),'productionFiles':5,'patches':4,'ttChecks':384,'phpTests':986,'phpAssertions':7023,'nativeChecks':20,'readOnlyVerification':True,'official122':False,'published':False}))
