"""Verify downloaded official compiler evidence; prepare read-only runtime inspection."""
from pathlib import Path
import hashlib,json,re
root=Path(__file__).resolve().parents[2]
build=root/'.runtime/ciw-completion-20261028/official-build3'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
manifest=load(build/'build-manifest.json')
assert sha(build/'build-manifest.json')=='13593e74e2cab80ac4cf83bc1cf0ec04cbb67ac2338bec0fc435f5804e3672ee'
for item in load(build/'source-manifest.json'):assert sha(root/item['file'])==item['sha256']
compiled=build/'compiled122'
log=(compiled/'compile.log').read_text()
assert log.splitlines()[0]=='OpenEdge 12.2 NUM-DBS=0'
assert log.rstrip().endswith('PASS COMPILE ALL') and 'COMPILER:ERROR=yes' not in log
assert sum('COMPILER:ERROR=no' in line for line in log.splitlines())==26
assert not (compiled/'compile-process.log').read_text().strip()
counts={'ContainerFiscalReadOnlyTest':41,'ContainersVersionHistoryTest':28,'ContainersVersionTest':189,'ContainersVersionCompositionTest':34,'ContainersVersionContextTest':11,'ContainersProcessBoundaryTest':25,'CiwErpReadTest':47,'PurchaseItemsReadTest':9}
tests=[]
for encoding in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:
  for name,count in counts.items():
   p=compiled/f'{name}-{encoding}-{culture}.log';text=p.read_text()
   assert text.startswith('PASS ') and re.search(r'\b'+str(count)+r'\b',text) and 'FAIL' not in text
   tests.append(dict(file=str(p.relative_to(root)),sha256=sha(p),checks=count,encoding=encoding,culture=culture))
files=[]
for rel in manifest['productionDelta']:
 for source in [build/'package'/rel]+([compiled/Path(rel).with_suffix('.r')] if rel.endswith('.p') else []):
  assert source.is_file() and source.stat().st_size>0
  relative=rel if source.suffix!='.r' else str(Path(rel).with_suffix('.r')).replace('\\','/')
  files.append(dict(relative=relative,source=str(source.relative_to(root)),file=source.name,sha256=sha(source)))
assert len(files)==15 and len({f['file']for f in files})==15
proof=dict(success=True,version='12.2',databaseConnections=0,compileEntries=26,testLogs=32,testsPerCombination=384,totalChecks=1536,tests=tests,files=files,publication=False)
(build/'official-compile-verification.json').write_text(json.dumps(proof,indent=2)+'\n')
stage='/tmp/ciw-completion-20261028-wave1'
script='''from pathlib import Path
import json,hashlib,subprocess
root=Path('/mnt/datasul/ERP/sursum');stage=Path(STAGE)
mount=subprocess.check_output(['findmnt','-n','-o','SOURCE','-T',str(root)],text=True).strip()
assert '192.168.0.137' in mount
targets={}
for rel in RELATIVES:
 p=root/rel
 targets[rel]={'before':hashlib.sha256(p.read_bytes()).hexdigest() if p.is_file() else None}
(stage/'runtime-before.json').write_text(json.dumps({'success':True,'mountConfirmed':True,'targets':targets},indent=2))
print('PASS read-only runtime hashes;15 exact targets; no writes to shared runtime')
'''.replace('STAGE',repr(stage)).replace('RELATIVES',repr([f['relative']for f in files]))
(build/'inspect-runtime.py').write_text(script)
plan=dict(server='runtime',directories=[stage],uploads=[dict(local=str((build/'inspect-runtime.py').relative_to(root)),remote=stage+'/inspect-runtime.py')],commands=['python3 '+stage+'/inspect-runtime.py'],downloads=[dict(local=str((build/'runtime-before.json').relative_to(root)),remote=stage+'/runtime-before.json')])
(build/'inspect-runtime-plan.json').write_text(json.dumps(plan,indent=2)+'\n')
print('PASS official12.2:26compiles;32logs;1536checks;15production artifacts identified')
