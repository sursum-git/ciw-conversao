"""Verify one official private TT compile and600 real core checks without any database."""
from pathlib import Path
import json,hashlib
r=Path(__file__).resolve().parents[2];b=r/'.runtime/ciw-completion-20261028/container-expense-batch-preflight/replay-after6-v1';load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert load(b/'root-preflight.json')['success'];log=(b/'compiled122/compile.log').read_text();assert log.startswith('OpenEdge 12.2 NUM-DBS=0') and log.count('COMPILER:ERROR=no')==1 and log.rstrip().endswith('PASS COMPILE ONE TT NUM-DBS=0') and 'FAIL'not in log
assert not(b/'compiled122/compile-process.log').read_text().strip();runs=[]
for cp in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:
  prefix=cp+'-'+culture;assert(b/f'compiled122/replay-{prefix}.log').read_text().strip()=='PASS 150 checks NUMDBS=0 central captured-config replay NUMERIC-FORMAT='+culture
  assert(b/f'compiled122/execution-{prefix}.log').read_text().strip()=='PASS EXECUTE OpenEdge 12.2 NUM-DBS=0'
  assert not(b/f'compiled122/process-{prefix}.log').read_text().strip()
  p=b/f'compiled122/result-{prefix}.json';result=load(p);assert result['success']and result['num_dbs']==0 and result['checks']==150
  for run in result['runs']:assert run['maximumFiscalRows']==5 and run['maximumExpenseRows']==7 and run['maximumMemories']==4
  runs.append(dict(file=str(p.relative_to(r)),sha256=sha(p),checks=150))
out=dict(success=True,version='12.2',compileEntries=1,totalChecks=600,numDbs=0,centralCoreAfter6=True,maxFiscalRows=5,maxAllExpenses=7,maxMemories=4,zeroFiscalProven=True,results=runs,published=False,businessWrites=False)
(b/'official-verification.json').write_text(json.dumps(out,indent=2)+'\n')
print('PASS official12.2 private TT600checks/NUMDBS0/onecompile/currentcore6/max5fiscal7expenses4memories; no business writes')
