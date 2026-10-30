"""Snapshot agent candidates for official 12.2 tests; no canonical or business writes."""
from pathlib import Path
import json, hashlib, re, sys
r=Path(__file__).resolve().parents[2];m=Path('D:/opencode/motor-progress/v2')
c=r/'integration-src/purchase-pending-20261028';b=r/f'.runtime/purchase-pending-integration-20261028/build{int(sys.argv[1])}';p=b/'package'
assert not b.exists();p.mkdir(parents=True)
load=lambda q:json.loads(q.read_text(encoding='utf-8-sig'))
sha=lambda q:hashlib.sha256(q.read_bytes()).hexdigest()
shared={}
for name in ['CiwErpReadService.p','CiwCadastrosCrud.p']:
 target=m/'sursum-api/programs'/name;value=target.read_text(encoding='utf-8-sig')
 patch=load(c/'signals-global/patches'/(name+'.json'));assert sha(target)==patch['baselineSHA256']
 assert patch['operation']=='insertBefore' and value.count(patch['anchor'])==1
 value=value.replace(patch['anchor'],patch['insertion']+patch['anchor'],1)
 if name=='CiwCadastrosCrud.p':
  extra=next(x for x in load(c/'signal-config/patches/integration.json')['patches'] if x['target'].endswith(name));assert sha(target)==extra['baselineSha256'];assert value.count(extra['anchor'])==1
  value=value.replace(extra['anchor'],extra['insertBefore']+extra['anchor'],1)
 shared[name]=value
files={}
for scope in ['signals-global','signal-config']:
 for source in (c/scope/'abl').glob('*.p'):files['sursum-api/programs/'+source.name]=source
 for source in (c/scope/'includes').glob('*.i'):files['sursum-api/includes/'+source.name]=source
for name in ['CiwCadastroCoreService.p','CiwCadastroCrudService.p','CiwCadastroDefinition.p','PurchaseSignalRules.p','CiwMedCompanyContext.p']:
 files['sursum-api/programs/'+name]=m/'sursum-api/programs'/name
for name in shared:files['sursum-api/programs/'+name]=m/'sursum-api/programs'/name
tests=[('PurchaseSignalConfigServiceTest.p',c/'signal-config/tests/PurchaseSignalConfigServiceTest.p','signal-config-tests-','culture'),('PurchaseSignalContainerRulesTest.p',c/'signals-global/tests/PurchaseSignalContainerRulesTest.p','container-rule','fixed'),('PurchaseSignalsGlobalServiceTest.p',c/'signals-global/tests/PurchaseSignalsGlobalServiceTest.p','global-service','fixed'),('PurchaseSignalsServiceTest.p',m/'tests/abl/purchase-signals/PurchaseSignalsServiceTest.p','signals-service-','culture'),('PurchaseSignalRulesTest.p',m/'tests/abl/purchase-signals/PurchaseSignalRulesTest.p','signal-rules-','culture'),('CiwErpReadTest.p',m/'tests/abl/ciw-erp-consultas/CiwErpReadTest.p','erp-read-','culture'),('PurchaseItemsReadTest.p',m/'tests/abl/purchase-items/PurchaseItemsReadTest.p','purchase-item-read-','culture'),('CiwCadastroCrudTest.p',m/'tests/abl/ciw-cadastros/CiwCadastroCrudTest.p','ciw-cadastro-tests-','culture'),('CiwCadastroDefinitionTest.p',m/'tests/abl/ciw-cadastros/CiwCadastroDefinitionTest.p','ciw-cadastro-definition-','codepage')]
for name,source,*_ in tests:files[name]=source
pending=list(files.values())
while pending:
 source=pending.pop()
 for include in re.findall(r'\{(sursum-api/[^\s{}]+\.i)',source.read_text(encoding='utf-8-sig')):
  if include not in files:
   candidate=c/'signals-global/includes'/Path(include).name
   files[include]=candidate if candidate.exists() else m/include;pending.append(files[include])
for rel,source in files.items():q=p/rel;q.parent.mkdir(parents=True,exist_ok=True);q.write_bytes(source.read_bytes())
for name,value in shared.items():q=p/'sursum-api/programs'/name;q.write_text(value,encoding='utf-8')
for name in ['CiwCadastroCrudService.p','CiwCadastroDefinition.p','CiwMedCompanyContext.p']:(p/name).write_bytes((p/'sursum-api/programs'/name).read_bytes())
(p/'CiwErpReadService.p').write_text('''USING Progress.Json.ObjectModel.*.
DEFINE INPUT PARAMETER h AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER resourceValue AS CHARACTER NO-UNDO.
DEFINE INPUT PARAMETER companyValue AS CHARACTER NO-UNDO.
DEFINE INPUT PARAMETER requestValue AS JsonObject NO-UNDO.
DEFINE OUTPUT PARAMETER responseValue AS JsonObject NO-UNDO.
RUN sursum-api/programs/CiwErpReadService.p(h,resourceValue,companyValue,requestValue,OUTPUT responseValue).
''',encoding='utf-8')
(p/'Regression.p').write_text("SESSION:NUMERIC-FORMAT=ENTRY(1,SESSION:PARAMETER).\nRUN VALUE(ENTRY(2,SESSION:PARAMETER)).\nQUIT.\n",encoding='utf-8')
entries=[str(q.relative_to(p)).replace('\\','/')for q in p.rglob('*.p')]
(p/'Compile.p').write_text('''DEFINE VARIABLE entries AS CHARACTER NO-UNDO INITIAL "'''+','.join(entries)+'''".
DEFINE VARIABLE k AS INTEGER NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.
OUTPUT TO 'compile.log'. PUT UNFORMATTED 'OpenEdge ' PROVERSION ' NUM-DBS=' NUM-DBS SKIP.
DO k=1 TO NUM-ENTRIES(entries):
 COMPILE VALUE(ENTRY(k,entries)) SAVE NO-ERROR.
 PUT UNFORMATTED ENTRY(k,entries) ' COMPILER:ERROR=' COMPILER:ERROR SKIP.
 IF COMPILER:ERROR THEN DO: DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END. OUTPUT CLOSE. QUIT. END.
END. PUT UNFORMATTED 'PASS COMPILE ALL' SKIP. OUTPUT CLOSE. QUIT.
''',encoding='utf-8')
remote='C:/Users/tadeu.parreiras/codex-purchase-pending-20261028-build'+sys.argv[1]
ps=(r/'.runtime/purchase-quantity-periods-20261028/build9/package/compile122.ps1').read_text().split("Run-Avm @('-db'")[0].replace('C:/Users/tadeu.parreiras/codex-purchase-quantity-periods-20261028-build9',remote)
ps+="Run-Avm @('-b','-cpinternal','UTF-8','-cpstream','UTF-8','-p','Compile.p','-T',$PWD.Path) 'compile-process.log'\n$compiled=Get-Content -LiteralPath compile.log -Raw; if($compiled -notmatch 'OpenEdge 12[.]2' -or $compiled -notmatch 'PASS COMPILE ALL'){throw 'Compilation unconfirmed'}\n"
ps+="foreach($cp in @('UTF-8','ISO8859-1')){foreach($culture in @('AMERICAN','EUROPEAN')){\n"
logs=[]
for name,source,prefix,kind in tests:
 ps+="Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-param',($culture+',"+name+"'),'-p','Regression.p','-T',$PWD.Path) ('process-"+name+"-'+$cp+'-'+$culture+'.log')\n" if name in ['CiwErpReadTest.p','PurchaseItemsReadTest.p','CiwCadastroCrudTest.p','CiwCadastroDefinitionTest.p'] else "Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-param',$culture,'-p','"+name[:-2]+".r','-T',$PWD.Path) ('process-"+name+"-'+$cp+'-'+$culture+'.log')\n"
 origin="'"+prefix+".log'"if kind=='fixed' else "('"+prefix+"'+"+('$culture'if kind=='culture'else'$cp')+"+'.log')"
 ps+="Copy-Item -LiteralPath "+origin+" -Destination ('"+name[:-2]+"-'+$cp+'-'+$culture+'.log')\n"
 logs.extend(name[:-2]+'-'+cp+'-'+culture+'.log' for cp in ['UTF-8','ISO8859-1']for culture in ['AMERICAN','EUROPEAN'])
ps+="}}\nWrite-Output 'Official12.2 executed; inspect compiler and assertions'\n} catch {Write-Output $_.Exception.Message; if(Test-Path compile.log){Get-Content compile.log -Raw};exit 1}\n"
(p/'compile122.ps1').write_text(ps,encoding='utf-8')
downloads=['compile.log','compile-process.log']+[n[:-2]+'.r'for n in entries]+logs
plan=dict(server='compiler',directories=[remote]+[remote+'/'+q.relative_to(p).as_posix()for q in sorted(p.rglob('*'))if q.is_dir()],uploads=[dict(local=str(q.relative_to(r)),remote=remote+'/'+q.relative_to(p).as_posix())for q in p.rglob('*')if q.is_file()],commands=['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/compile122.ps1'],downloads=[dict(local=str((b/'compiled122'/n).relative_to(r)),remote=remote+'/'+n,optional=True)for n in downloads])
(b/'remote-plan.json').write_text(json.dumps(plan,indent=2)+'\n');(b/'source-manifest.json').write_text(json.dumps([dict(file=u['local'],sha256=sha(r/u['local']))for u in plan['uploads']],indent=2)+'\n');(b/'test-list.json').write_text(json.dumps([dict(name=n,prefix=prefix,kind=kind)for n,_,prefix,kind in tests],indent=2)+'\n')
print('Prepared official12.2 snapshot',b.name,'compile entries',len(entries),'test logs',len(logs),'NUM-DBS0; no canonical writes')
