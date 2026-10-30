"""Prepare a fixed, DB-free SEARCH probe; never executes ERP trigger programs."""
from pathlib import Path
import json
root=Path(__file__).resolve().parents[2]
base=root/'.runtime/ciw-completion-20261028/currency-trigger-search-v1'
base.mkdir()
remote='C:/Users/tadeu.parreiras/codex-ciw-currency-trigger-search-v1'
probe='''USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE result AS JsonObject NO-UNDO.
DEFINE VARIABLE rows AS JsonArray NO-UNDO.
DEFINE VARIABLE rowData AS JsonObject NO-UNDO.
DEFINE VARIABLE paths AS CHARACTER NO-UNDO.
DEFINE VARIABLE item AS CHARACTER NO-UNDO.
DEFINE VARIABLE resolved AS CHARACTER NO-UNDO.
DEFINE VARIABLE i AS INTEGER NO-UNDO.
IF NUM-DBS <> 0 THEN QUIT.
ASSIGN result=NEW JsonObject() rows=NEW JsonArray()
 paths="database/tgun/tdp/tdun003.p,database/tguni/tcp/tcuni003.p,database/tguni/tdp/tduni003.p,database/tguni/twp/twuni003.p".
DO i=1 TO NUM-ENTRIES(paths):
 item=ENTRY(i,paths).
 rowData=NEW JsonObject().
 rowData:Add("requested",item).
 resolved=SEARCH(item).
 rowData:Add("sourceFound",resolved<>?).
 IF resolved<>? THEN rowData:Add("sourceResolved",resolved).
 resolved=SEARCH(SUBSTRING(item,1,LENGTH(item)-1)+"r").
 rowData:Add("rcodeFound",resolved<>?).
 IF resolved<>? THEN rowData:Add("rcodeResolved",resolved).
 rows:Add(rowData).
END.
result:Add("openEdge",PROVERSION).
result:Add("numDbs",NUM-DBS).
result:Add("propath",PROPATH).
result:Add("triggers",rows).
result:Add("businessReads",FALSE).
result:Add("businessWrites",FALSE).
result:Add("triggersExecuted",FALSE).
result:WriteFile("trigger-search-private.json",TRUE).
QUIT.
'''
compile='''OUTPUT TO "compile.log".
PUT UNFORMATTED "OpenEdge " PROVERSION " NUMDBS=" NUM-DBS SKIP.
IF NUM-DBS<>0 THEN QUIT.
COMPILE CurrencyTriggerSearch.p SAVE NO-ERROR.
PUT UNFORMATTED "ERROR=" COMPILER:ERROR SKIP.
IF NOT COMPILER:ERROR THEN PUT UNFORMATTED "PASS COMPILE" SKIP.
OUTPUT CLOSE.
QUIT.
'''
runner=f'''$ErrorActionPreference='Stop'
Set-Location -LiteralPath '{remote}'
if(Test-Path -LiteralPath 'compile.log'){{throw 'Fresh stage required'}}
$env:DLC='C:/Progress_12/OE'
$info=New-Object Diagnostics.ProcessStartInfo
$info.FileName='C:/Progress_12/OE/bin/_progres.exe'
$info.WorkingDirectory=$PWD.Path
$info.Arguments='-b -cpinternal UTF-8 -cpstream UTF-8 -p Compile.p'
$info.UseShellExecute=$false
$info.CreateNoWindow=$true
$info.WindowStyle=[Diagnostics.ProcessWindowStyle]::Hidden
$info.RedirectStandardOutput=$true
$info.RedirectStandardError=$true
$p=[Diagnostics.Process]::Start($info)
$stdout=$p.StandardOutput.ReadToEndAsync();$stderr=$p.StandardError.ReadToEndAsync()
if(!$p.WaitForExit(25000)){{throw 'Compile timeout'}}
[Threading.Tasks.Task]::WaitAll([Threading.Tasks.Task[]]@($stdout,$stderr))
[IO.File]::WriteAllText((Join-Path $PWD.Path 'compile-process.log'),$stdout.Result+$stderr.Result)
if($p.ExitCode -ne 0){{throw 'Compile process failed'}}
$log=Get-Content -LiteralPath 'compile.log' -Raw
if($log -notmatch 'OpenEdge 12[.]2' -or $log -notmatch 'NUMDBS=0' -or $log -notmatch 'ERROR=no' -or $log -notmatch 'PASS COMPILE'){{throw 'Compile proof failed'}}
Write-Output 'PASS12.2 SEARCH probe compiled;NUMDBS0;not executed;no ERP trigger executed'
'''
for name,body in [('CurrencyTriggerSearch.p',probe),('Compile.p',compile),('Compile.ps1',runner)]:
 (base/name).write_text(body,encoding='utf-8')
plan=dict(server='compiler',directories=[remote],uploads=[dict(local=str((base/n).relative_to(root)),remote=remote+'/'+n) for n in ['CurrencyTriggerSearch.p','Compile.p','Compile.ps1']],commands=['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/Compile.ps1'],downloads=[dict(local=str((base/n).relative_to(root)),remote=remote+'/'+n) for n in ['compile.log','compile-process.log','CurrencyTriggerSearch.r']])
(base/'compile-plan.json').write_text(json.dumps(plan,indent=2)+'\n')
print('Prepared four fixed trigger SEARCH-only program; official compile first; runtime plan not yet prepared')
