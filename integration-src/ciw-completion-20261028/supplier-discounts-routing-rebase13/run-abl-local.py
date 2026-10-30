"""Synthetic-only local12.8/NUMDBS0. Never use these rcode for publication."""
from pathlib import Path
import subprocess,json,os,re,hashlib
D=Path(__file__).resolve().parent;W=D.parents[2];A=W/'.runtime/ciw-completion-20261028/supplier-discounts-routing-rebase13/abl-local-v1'
env=os.environ.copy();env['DLC']='C:/Progress/OpenEdge';exe='C:/Progress/OpenEdge/bin/_progres.exe'
def run(source,cwd,args=[]):
 assert not (cwd/'process.log').exists(),'No receipt overwrite'
 with (cwd/'process.log').open('wb')as output:r=subprocess.run([exe,'-b','-p',str(source),'-T',str(cwd),*args],cwd=cwd,env=env,stdout=output,stderr=subprocess.STDOUT,timeout=35,creationflags=subprocess.CREATE_NO_WINDOW)
 assert r.returncode==0,('local AVM failed',str(source),r.returncode)
run(A/'Compile.p',A);text=(A/'compile.log').read_text();assert text.count('ERROR=no')==7 and 'ERROR=yes'not in text and 'NUMDBS=0'in text,text
suites=[('SupplierDiscountReadTest.p','supplier-discounts-tests.log',32),('ImportDiscountsCollectorTest.p','collector-tests.log',18),('ImportDiscountsReadTest.p','read-tests.log',44),('ImportDiscountsLabelsTest.p','discount-labels-tests.log',17)]
logs=[]
for cp in ['UTF-8','ISO8859-1']:
 for culture,sep,dec,date in [('american','44','46','mdy'),('european','46','44','dmy')]:
  for name,log,expected in suites:
   cwd=A/'matrix'/f'{cp}-{culture}'/name.removesuffix('.p');cwd.mkdir(parents=True);p=cwd/'Run.p';p.write_text(f"PROPATH='{(A/'package').as_posix()},{(D/'tests/abl').as_posix()},C:/Progress/OpenEdge/gui/netlib/OpenEdge.Net.pl,' + PROPATH.\nIF NUM-DBS<>0 THEN QUIT.\nRUN {name}.\nQUIT.\n")
   run(p,cwd,['-cpinternal',cp,'-cpstream',cp,'-numsep',sep,'-numdec',dec,'-d',date]);out=cwd/log;txt=out.read_text(encoding='utf-8');m=re.search(r'PASS (\d+)',txt);assert m and int(m[1])==expected and 'FAIL'not in txt,(name,txt)
   logs.append({'suite':name,'cpinternal':cp,'culture':culture,'checks':int(m[1]),'path':str(out),'sha256':hashlib.sha256(out.read_bytes()).hexdigest()})
proof={'success':True,'version':'12.8 diagnostic only','official122Required':True,'compileCount':7,'checks':sum(x['checks']for x in logs),'logs':logs,'logCount':16,'numDbs':0,'networkExecuted':False,'businessWrites':False};(A/'proof.json').write_text(json.dumps(proof,indent=2)+'\n');print(json.dumps({k:v for k,v in proof.items()if k!='logs'}))
