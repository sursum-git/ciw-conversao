from pathlib import Path
import ast, json, re, sys, hashlib
r=Path(__file__).resolve().parents[2];c=r/'integration-src/purchase-quantity-periods';motor=Path('D:/opencode/motor-progress/v2')
number=int(sys.argv[1]);red=len(sys.argv)>2 and sys.argv[2]=='red';b=r/f'.runtime/purchase-quantity-periods-20261028/build{number}';package=b/'package'
assert not b.exists();package.mkdir(parents=True)
programs=['CiwErpReadService.p'] if red else ['PurchaseImportQuantitiesCollector.p','PurchaseImportQuantitiesService.p','PurchaseImportQuantityRules.p','PurchaseQuantityPeriodRules.p','PurchaseQuantityPeriodFilter.p','PurchaseQuantityPeriodsService.p','PurchaseQuantityPeriodsApi.p','CiwMedCompanyContext.p','CiwErpReadService.p','CiwCadastrosCrud.p']
files={}
for n in programs:files['sursum-api/programs/'+n]=(c/'abl'/n)if(c/'abl'/n).exists()else motor/'sursum-api/programs'/n
for n in ['PurchaseQuantityPeriodRulesTest.p','PurchaseQuantityPeriodFilterTest.p','PurchaseQuantityPeriodsServiceTest.p']:
 if(c/'tests'/n).exists():files[n]=c/'tests'/n
if not red:
 for n,p in [('PurchaseImportQuantitiesServiceTest.p','purchase-quantities'),('PurchaseImportQuantityRulesTest.p','purchase-quantities'),('CiwErpReadTest.p','ciw-erp-consultas'),('PurchaseItemsReadTest.p','purchase-items')]:files[n]=(c/'tests'/n)if(c/'tests'/n).exists()else motor/'tests/abl'/p/n
pending=list(files.values())
while pending:
 source=pending.pop()
 for include in re.findall(r'\{(sursum-api/[^\s{}]+\.i)',source.read_text(encoding='utf-8-sig')):
  if include not in files:
   candidate=c/'includes'/Path(include).name
   files[include]=candidate if candidate.exists()else motor/include
   pending.append(files[include])
for rel,p in files.items():target=package/rel;target.parent.mkdir(parents=True,exist_ok=True);target.write_bytes(p.read_bytes())
if not red:
 (package/'CiwMedCompanyContext.p').write_bytes((motor/'sursum-api/programs/CiwMedCompanyContext.p').read_bytes())
(package/'CiwErpReadService.p').write_text('''USING Progress.Json.ObjectModel.*.
DEFINE INPUT PARAMETER h AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER resourceValue AS CHARACTER NO-UNDO.
DEFINE INPUT PARAMETER companyValue AS CHARACTER NO-UNDO.
DEFINE INPUT PARAMETER requestValue AS JsonObject NO-UNDO.
DEFINE OUTPUT PARAMETER responseValue AS JsonObject NO-UNDO.
RUN sursum-api/programs/CiwErpReadService.p(h,resourceValue,companyValue,requestValue,OUTPUT responseValue).
''',encoding='utf-8')
(package/'Regression.p').write_text("SESSION:NUMERIC-FORMAT=ENTRY(1,SESSION:PARAMETER).\nRUN VALUE(ENTRY(2,SESSION:PARAMETER)).\nQUIT.\n",encoding='utf-8')
entries=[n for n in files if n.endswith('.p')]+['CiwErpReadService.p','Regression.p']
(package/'Compile.p').write_text('''DEFINE VARIABLE entries AS CHARACTER NO-UNDO INITIAL "'''+','.join(entries)+'''".
DEFINE VARIABLE k AS INTEGER NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.
OUTPUT TO 'compile.log'. PUT UNFORMATTED 'OpenEdge ' PROVERSION ' NUM-DBS=' NUM-DBS SKIP.
DO k=1 TO NUM-ENTRIES(entries):
 COMPILE VALUE(ENTRY(k,entries)) SAVE NO-ERROR.
 PUT UNFORMATTED ENTRY(k,entries) ' COMPILER:ERROR=' COMPILER:ERROR SKIP.
 IF COMPILER:ERROR THEN DO: DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END. OUTPUT CLOSE. QUIT. END.
END. PUT UNFORMATTED 'PASS COMPILE ALL' SKIP. OUTPUT CLOSE. QUIT.
''',encoding='utf-8')
remote=f'C:/Users/tadeu.parreiras/codex-purchase-quantity-periods-20261028-build{number}'
# Reuse the already audited AVM process launcher; never execute imported Python.
tree=ast.parse((r/'tools/construtor-local/prepare-purchase-quantities-build.py').read_text())
node=next(n for n in tree.body if isinstance(n,ast.Assign)and any(isinstance(t,ast.Name)and t.id=='ps'for t in n.targets))
template=ast.literal_eval(node.value.func.value).replace('REMOTE',remote)
ps=template.split("Run-Avm @('-b'")[0]
db=''if red else "'-db','espec','-H','192.168.0.111','-S','10012','-N','TCP','-ld','espec',"
ps+="Run-Avm @("+db+"'-b','-cpinternal','UTF-8','-cpstream','UTF-8','-p','Compile.p','-T',$PWD.Path) 'compile-process.log'\n"
ps+="$compiled=Get-Content -LiteralPath compile.log -Raw; if($compiled -notmatch 'OpenEdge 12[.]2' -or $compiled -notmatch 'PASS COMPILE ALL'){throw 'Compilation unconfirmed'}\n"
suites=[('PurchaseQuantityPeriodRulesTest.p','quantity-period-rules-')]
for name,prefix in [('PurchaseQuantityPeriodFilterTest.p','quantity-period-filter-'),('PurchaseQuantityPeriodsServiceTest.p','quantity-period-service-')]:
 if name in files:suites.append((name,prefix))
if not red:suites += [('PurchaseImportQuantitiesServiceTest.p','quantities-service-'),('PurchaseImportQuantityRulesTest.p','quantity-rules-'),('CiwErpReadTest.p','erp-read-'),('PurchaseItemsReadTest.p','purchase-item-read-')]
ps+="foreach($cp in @('UTF-8','ISO8859-1')){foreach($culture in @('AMERICAN','EUROPEAN')){\n"
for name,prefix in suites:
 if name in ['CiwErpReadTest.p','PurchaseItemsReadTest.p']:
  ps+="Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-param',($culture+',"+name+"'),'-p','Regression.p','-T',$PWD.Path) ('process-"+prefix+"'+$cp+'-'+$culture+'.log')\n"
 else:
  ps+="Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-param',$culture,'-p','"+name[:-2]+".r','-T',$PWD.Path) ('process-"+prefix+"'+$cp+'-'+$culture+'.log')\n"
 ps+="Copy-Item -LiteralPath ('"+prefix+"'+$culture+'.log') -Destination ('"+prefix+"'+$cp+'-'+$culture+'.log')\n"
ps+="}}\nWrite-Output 'Official12.2 executed; inspect compiler and assertions'\n"
(package/'compile122.ps1').write_text("try {\n"+ps+"} catch { Write-Output $_.Exception.Message; if(Test-Path compile.log){Get-Content compile.log -Raw}; exit 1 }\n",encoding='utf-8')
logs=[prefix+cp+'-'+culture+'.log'for name,prefix in suites for cp in ['UTF-8','ISO8859-1']for culture in ['AMERICAN','EUROPEAN']]
downloads=['compile.log','compile-process.log']+[n[:-2]+'.r'for n in entries]+logs
dirs=[remote]+[remote+'/'+p.relative_to(package).as_posix()for p in sorted(package.rglob('*'))if p.is_dir()]
uploads=[dict(local=str(p.relative_to(r)),remote=remote+'/'+p.relative_to(package).as_posix())for p in package.rglob('*')if p.is_file()]
(b/'remote-plan.json').write_text(json.dumps(dict(server='compiler',directories=dirs,uploads=uploads,commands=['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/compile122.ps1'],downloads=[dict(local=str((b/'compiled122'/n).relative_to(r)),remote=remote+'/'+n,optional=True)for n in downloads]),indent=2)+'\n')
(b/'source-manifest.json').write_text(json.dumps([dict(file=u['local'],sha256=hashlib.sha256((r/u['local']).read_bytes()).hexdigest())for u in uploads],indent=2)+'\n')
print('Prepared fresh official12.2 build',number,'RED'if red else 'GREEN',len(entries),'entries')
