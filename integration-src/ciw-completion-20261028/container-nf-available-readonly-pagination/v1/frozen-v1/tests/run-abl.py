from pathlib import Path
import subprocess,os,sys,json
S=Path('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-nf-available-readonly-pagination/v1')
red='--red' in sys.argv;stage=S/('red'if red else'local')
env=os.environ.copy();env['DLC']='C:/Progress/OpenEdge'
def run(program,cp='UTF-8',culture='AMERICAN'):
 args=['C:/Progress/OpenEdge/bin/_progres.exe','-b','-cpinternal',cp,'-cpstream','UTF-8','-numdec','46'if culture=='AMERICAN'else'44','-numsep','44'if culture=='AMERICAN'else'46','-p',program,'-T',str(stage)]
 r=subprocess.run(args,cwd=stage,env=env,capture_output=True,timeout=55,creationflags=subprocess.CREATE_NO_WINDOW)
 (stage/(program+'-'+cp+'-'+culture+'-process.log')).write_bytes(r.stdout+r.stderr)
 assert r.returncode==0,'AVM nonzero, see isolated process log'
run('Compile.p');compiled=(stage/'compile.log').read_text(encoding='utf8');assert'PASS COMPILE'in compiled,compiled
proof=[]
for cp in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:
  run('Execute.p',cp,culture);execution=(stage/'execution.log').read_text(encoding='utf8')
  if red:
   assert'FAIL 401 candidates must page successfully instead of candidate cap:'in execution,execution
   assert'CONTAINER_NF_CANDIDATE_LIMIT'in execution,execution
   print(json.dumps({'red':True,'cause':'CONTAINER_NF_CANDIDATE_LIMIT','NUMDBS':0,'codepage':cp,'culture':culture}));sys.exit(0)
  assert'PASS EXECUTE NUMDBS=0'in execution,execution
  run('CiwErpReadTest.r',cp,culture)
  suite=(stage/('nf-page-'+culture+'.log')).read_text(encoding='utf8');assert'PASS'in suite,suite
  suites=[suite]
  for name in ['container-panel-finance-tests-','alias-strict-','nf-available-','nf-page-budget-','erp-read-','expense-tax-relations-']:
   result=(stage/(name+culture+'.log')).read_text(encoding='utf8');assert'PASS'in result,result;suites.append(result)
  (stage/('test-'+cp+'-'+culture+'.log')).write_text(execution+''.join(suites),encoding='utf8')
  proof.append({'codepage':cp,'culture':culture,'suites':[s.strip()for s in suites],'NUMDBS':0})
(stage/'abl-proof.json').write_text(json.dumps({'success':True,'official122':False,'combinations':proof},indent=2)+'\n',encoding='utf8')
print(json.dumps(proof))
