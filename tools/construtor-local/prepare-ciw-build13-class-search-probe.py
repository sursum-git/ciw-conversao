"""Prepare a two-name SEARCH diagnostic only; no COMPILE, database or runtime writes."""
from pathlib import Path
import json
root=Path(__file__).resolve().parents[2]
out=root/'.runtime/ciw-completion-20261028/official-build13-search-probe'
assert not out.exists();out.mkdir()
remote='C:/Users/tadeu.parreiras/codex-ciw-build13-search-probe'
source='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-v2'
abl='''BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE resultValue AS JsonObject NO-UNDO.
DEFINE VARIABLE rowsValue AS JsonArray NO-UNDO.
DEFINE VARIABLE rowValue AS JsonObject NO-UNDO.
DEFINE VARIABLE initialPath AS CHARACTER NO-UNDO.
DEFINE VARIABLE rootPath AS CHARACTER NO-UNDO INITIAL "'''+source+'''".
DEFINE VARIABLE classPath AS CHARACTER NO-UNDO.
DEFINE VARIABLE className AS CHARACTER NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
IF NUM-DBS<>0 OR NOT PROVERSION BEGINS '12.2' THEN UNDO, THROW NEW Progress.Lang.AppError('Diagnostic environment mismatch',1).
classPath=rootPath + '/sursum-api/sursum'. initialPath=PROPATH.
resultValue=NEW JsonObject(). rowsValue=NEW JsonArray().
DO n=1 TO 2:
 className=ENTRY(n,'PasoeRuntimeIdentity.cls,PasoeExecutionContext.cls'). rowValue=NEW JsonObject().
 rowValue:Add('class',className).
 PROPATH=rootPath + ',' + rootPath + '/sursum-api/programs,' + rootPath + '/sursum-api/includes,' + classPath + ',' + initialPath.
 rowValue:Add('rootFirst',SEARCH(className)).
 PROPATH=classPath + ',' + rootPath + ',' + rootPath + '/sursum-api/programs,' + rootPath + '/sursum-api/includes,' + initialPath.
 rowValue:Add('classFirst',SEARCH(className)). rowsValue:Add(rowValue).
END.
PROPATH=initialPath.
resultValue:Add('success',TRUE). resultValue:Add('version',PROVERSION). resultValue:Add('numDbs',NUM-DBS).
resultValue:Add('compiledProducts',FALSE). resultValue:Add('businessWrites',FALSE). resultValue:Add('rows',rowsValue).
resultValue:WriteFile('search-result.json',TRUE).
QUIT.
'''
ps='''$ErrorActionPreference='Stop'
Set-Location -LiteralPath 'SOURCE'
if(Test-Path -LiteralPath 'probe-attempt.json'){throw 'Earlier probe exists; inspect without replay'}
[IO.File]::WriteAllText((Join-Path $PWD.Path 'probe-attempt.json'),'{"started":true,"businessWrites":false}',[Text.UTF8Encoding]::new($false))
$info=New-Object Diagnostics.ProcessStartInfo
$info.FileName='C:/Progress_12/OE/bin/_progres.exe';$info.WorkingDirectory=$PWD.Path
$info.Arguments='-b -cpinternal UTF-8 -cpstream UTF-8 -p SearchProbe.p -T .'
$info.UseShellExecute=$false;$info.CreateNoWindow=$true;$info.WindowStyle=[Diagnostics.ProcessWindowStyle]::Hidden
$info.EnvironmentVariables['DLC']='C:/Progress_12/OE';$info.RedirectStandardOutput=$true;$info.RedirectStandardError=$true
$p=New-Object Diagnostics.Process;$p.StartInfo=$info
if(!$p.Start()){throw 'Probe AVM not started'}
$stdout=$p.StandardOutput.ReadToEndAsync();$stderr=$p.StandardError.ReadToEndAsync()
if(!$p.WaitForExit(15000)){throw 'Probe timeout; inspect process, no retry'}
$p.WaitForExit();$p.Refresh();[Threading.Tasks.Task]::WaitAll([Threading.Tasks.Task[]]@($stdout,$stderr))
[IO.File]::WriteAllText((Join-Path $PWD.Path 'probe-process.log'),$stdout.Result+$stderr.Result,[Text.UTF8Encoding]::new($false))
if(!$p.HasExited -or $null -eq $p.ExitCode -or $p.ExitCode -ne 0){throw 'Probe exit not confirmed'}
$value=Get-Content -Raw -LiteralPath 'search-result.json'|ConvertFrom-Json
if(!$value.success -or $value.numDbs -ne 0){throw 'Probe result not confirmed'}
Write-Output 'PASS official12.2 two-name class SEARCH only; zero databases/compilations/business writes'
'''.replace('SOURCE',remote)
(out/'SearchProbe.p').write_bytes(abl.encode())
(out/'RunProbe.ps1').write_bytes(ps.encode())
plan=dict(server='compiler',directories=[remote],uploads=[dict(local=str((out/n).relative_to(root)),remote=remote+'/'+n) for n in ['SearchProbe.p','RunProbe.ps1']],commands=['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/RunProbe.ps1'],downloads=[dict(remote=remote+'/'+n,local=str((out/n).relative_to(root))) for n in ['search-result.json','probe-process.log','probe-attempt.json']])
(out/'remote-plan.json').write_bytes((json.dumps(plan,indent=2)+'\n').encode())
print('PASS prepared two-class search probe, no product compilation or database connection')
