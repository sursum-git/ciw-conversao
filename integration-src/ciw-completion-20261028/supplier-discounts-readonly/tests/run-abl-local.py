"""Diagnostic12.8, isolated TT AVMs NUMDBS0. Root owns official12.2."""
from pathlib import Path
import subprocess,json,os,re,hashlib
ROOT=Path('D:/opencode/conversao-sc');DOMAIN=ROOT/'integration-src/ciw-completion-20261028/supplier-discounts-readonly';OUT=ROOT/'.runtime/ciw-completion-20261028/supplier-discounts-readonly/local'
env=os.environ.copy();env['DLC']='C:/Progress/OpenEdge'
exe='C:/Progress/OpenEdge/bin/_progres.exe'
def run(source,cwd,args=[]):
 with (cwd/'avm-process.log').open('wb')as log:
  result=subprocess.run([exe,'-b','-p',str(source),'-T',str(cwd),*args],cwd=cwd,env=env,stdout=log,stderr=subprocess.STDOUT,timeout=35,creationflags=subprocess.CREATE_NO_WINDOW)
 assert result.returncode==0,(source,result.returncode)
import sys
if '--skip-compile'not in sys.argv:run(OUT/'CompileCandidate.p',OUT)
compile_text=(OUT/'compile-candidate.log').read_text();assert compile_text.count('ERROR=no')==7 and 'ERROR=yes'not in compile_text
suites=[('SupplierDiscountReadTest.p','supplier-discounts-tests.log',32),('ImportDiscountsCollectorTest.p','collector-tests.log',18),('ImportDiscountsReadTest.p','read-tests.log',44),('ImportDiscountsLabelsTest.p','discount-labels-tests.log',None)]
logs=[]
for cp in ['UTF-8','ISO8859-1']:
 for culture,numsep,numdec,dateformat in [('american','44','46','mdy'),('european','46','44','dmy')]:
  for source,log,expected in suites:
   cwd=OUT/'matrix'/f'{cp}-{culture}'/source.removesuffix('.p');cwd.mkdir(parents=True,exist_ok=True)
   runner=cwd/'Run.p';runner.write_text(f"PROPATH='{(OUT/'package').as_posix()},{(DOMAIN/'tests/abl').as_posix()},C:/Progress/OpenEdge/gui/netlib/OpenEdge.Net.pl,' + PROPATH.\nIF NUM-DBS<>0 THEN QUIT.\nRUN {source}.\nQUIT.\n",encoding='utf-8')
   run(runner,cwd,['-cpinternal',cp,'-cpstream',cp,'-numsep',numsep,'-numdec',numdec,'-d',dateformat])
   output=cwd/log;message=output.read_text(encoding='utf-8');match=re.search(r'PASS (\d+)',message);assert match and 'FAIL'not in message,(source,cp,culture,message)
   count=int(match.group(1));assert expected is None or expected==count
   logs.append({'suite':source,'cpinternal':cp,'culture':culture,'checks':count,'path':str(output),'sha256':hashlib.sha256(output.read_bytes()).hexdigest()})
proof={'success':True,'diagnosticVersion':'12.8','official122Required':True,'compileCount':7,'numDbs':0,'newChecksPerCombination':32,'regressionsPerCombination':sum(x['checks']for x in logs[:4])-32,'totalChecks':sum(x['checks']for x in logs),'logCount':len(logs),'networkExecuted':False,'businessWrites':False,'logs':logs}
(OUT.parent/'abl-local-proof.json').write_text(json.dumps(proof,indent=2)+'\n',encoding='utf-8');print(json.dumps({k:v for k,v in proof.items()if k!='logs'}))
