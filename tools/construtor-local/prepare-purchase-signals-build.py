"""Isolated OpenEdge12.2 package. Never writes a business database."""
from pathlib import Path
import hashlib,json,re,sys
root=Path(__file__).resolve().parents[2]; canonical=Path('D:/opencode/motor-progress/v2')
number=int(sys.argv[1]); red=len(sys.argv)>2 and sys.argv[2]=='red'
base=root/f'.runtime/purchase-signals-20261027/build{number}'; package=base/'package'
assert not base.exists(); package.mkdir(parents=True)
candidate=root/'integration-src/purchase-signals'; files={}
programs=['CiwErpReadService.p'] if red else ['PurchaseSignalRules.p','PurchaseSignalsService.p','PurchaseSignalsApi.p','CiwErpReadService.p','CiwCadastrosCrud.p','CiwMedCompanyContext.p']
for name in programs:
 local=candidate/'abl'/name; files['sursum-api/programs/'+name]=local if local.exists() else canonical/'sursum-api/programs'/name
files['PurchaseSignalRulesTest.p']=candidate/'tests/PurchaseSignalRulesTest.p'
files['PurchaseSignalsServiceTest.p']=candidate/'tests/PurchaseSignalsServiceTest.p'
files['CiwErpReadTest.p']=canonical/'tests/abl/ciw-erp-consultas/CiwErpReadTest.p'
files['PurchaseItemsReadTest.p']=canonical/'tests/abl/purchase-items/PurchaseItemsReadTest.p'
pending=list(files.values())
while pending:
 source=pending.pop()
 for include in re.findall(r'\{(sursum-api/[^\s{}]+\.i)',source.read_text(encoding='utf-8-sig')):
  if include not in files: files[include]=canonical/include; pending.append(canonical/include)
for name,source in files.items():
 target=package/name;target.parent.mkdir(parents=True,exist_ok=True);target.write_bytes(source.read_bytes())
if not red:
 files['CiwMedCompanyContext.p']=canonical/'sursum-api/programs/CiwMedCompanyContext.p'
 (package/'CiwMedCompanyContext.p').write_bytes(files['CiwMedCompanyContext.p'].read_bytes())
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
END.
PUT UNFORMATTED 'PASS COMPILE ALL' SKIP. OUTPUT CLOSE. QUIT.
''',encoding='utf-8')
remote=f'C:/Users/tadeu.parreiras/codex-purchase-signals-20261027-build{number}'
ps='''$ErrorActionPreference='Stop'
Set-Location -LiteralPath 'REMOTE'
function Run-Avm([string[]]$Arguments,[string]$Log) {
 $info=New-Object Diagnostics.ProcessStartInfo
 $info.FileName='C:/Progress_12/OE/bin/_progres.exe';$info.WorkingDirectory=$PWD.Path
 $info.Arguments=($Arguments|ForEach-Object {'"'+$_+'"'}) -join ' '
 $info.UseShellExecute=$false;$info.CreateNoWindow=$true;$info.WindowStyle=[Diagnostics.ProcessWindowStyle]::Hidden
 $info.RedirectStandardOutput=$true;$info.RedirectStandardError=$true;$info.EnvironmentVariables['DLC']='C:/Progress_12/OE'
 $p=[Diagnostics.Process]::Start($info);$out=$p.StandardOutput.ReadToEndAsync();$err=$p.StandardError.ReadToEndAsync()
 if(!$p.WaitForExit(35000)){throw 'AVM timeout; inspect before retry'}
 [Threading.Tasks.Task]::WaitAll([Threading.Tasks.Task[]]@($out,$err))
 [IO.File]::WriteAllText((Join-Path $PSScriptRoot $Log),$out.Result+$err.Result,[Text.UTF8Encoding]::new($false))
 if($p.ExitCode -ne 0){throw 'AVM nonzero exit'};$p.Dispose()
}
Run-Avm @('-b','-cpinternal','UTF-8','-cpstream','UTF-8','-p','Compile.p','-T',$PWD.Path) 'compile-process.log'
$compile=Get-Content -LiteralPath 'compile.log' -Raw
if($compile -notmatch 'OpenEdge 12[.]2' -or $compile -notmatch 'PASS COMPILE ALL' -or $compile -match 'COMPILER:ERROR=(yes|true)'){throw 'Compile unconfirmed'}
foreach($cp in @('UTF-8','ISO8859-1')){foreach($culture in @('AMERICAN','EUROPEAN')){
 Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-param',$culture,'-p','PurchaseSignalRulesTest.r','-T',$PWD.Path) ('test-'+$cp+'-'+$culture+'-process.log')
 Copy-Item -LiteralPath ('signal-rules-'+$culture+'.log') -Destination ('signal-rules-'+$cp+'-'+$culture+'.log')
 Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-param',$culture,'-p','PurchaseSignalsServiceTest.r','-T',$PWD.Path) ('service-'+$cp+'-'+$culture+'-process.log')
 Copy-Item -LiteralPath ('signals-service-'+$culture+'.log') -Destination ('signals-service-'+$cp+'-'+$culture+'.log')
 REGRESSIONS
}}
Write-Output 'PASS official12.2 package executed; inspect all assertion logs'
'''.replace('REMOTE',remote)
reg="""foreach($suite in @(@{name='CiwErpReadTest.p';prefix='erp-read-'},@{name='PurchaseItemsReadTest.p';prefix='purchase-item-read-'})){
 Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-param',($culture+','+$suite.name),'-p','Regression.p','-T',$PWD.Path) ('regression-'+$suite.prefix+$cp+'-'+$culture+'-process.log')
 Copy-Item -LiteralPath ($suite.prefix+$culture+'.log') -Destination ($suite.prefix+$cp+'-'+$culture+'.log')
 }"""
(package/'compile122.ps1').write_text("try {\n"+ps.replace('REGRESSIONS','' if red else reg)+"\n} catch { Write-Output $_.Exception.Message; if(Test-Path -LiteralPath compile.log){Get-Content -LiteralPath compile.log -Raw}; if(Test-Path -LiteralPath compile-process.log){Get-Content -LiteralPath compile-process.log -Raw}; exit 1 }\n",encoding='utf-8')
dirs=[remote]+[remote+'/'+p.relative_to(package).as_posix() for p in sorted(package.rglob('*')) if p.is_dir()]
upload=[dict(local=str(p.relative_to(root)),remote=remote+'/'+p.relative_to(package).as_posix()) for p in package.rglob('*') if p.is_file()]
downloads=['compile.log','compile-process.log']+[n[:-2]+'.r' for n in entries]
downloads += [prefix+cp+'-'+culture+'.log' for prefix in (['signal-rules-','signals-service-'] if red else ['signal-rules-','signals-service-','erp-read-','purchase-item-read-']) for cp in ['UTF-8','ISO8859-1'] for culture in ['AMERICAN','EUROPEAN']]
plan=dict(server='compiler',directories=dirs,uploads=upload,commands=['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/compile122.ps1'],downloads=[dict(local=str((base/'compiled122'/n).relative_to(root)),remote=remote+'/'+n,optional=True) for n in downloads])
(base/'remote-plan.json').write_text(json.dumps(plan,indent=2),encoding='utf-8')
(base/'source-manifest.json').write_text(json.dumps([dict(file=u['local'],sha256=hashlib.sha256((root/u['local']).read_bytes()).hexdigest()) for u in upload],indent=2),encoding='utf-8')
print('Prepared fresh build',number,'RED' if red else 'GREEN','entries',len(entries))
