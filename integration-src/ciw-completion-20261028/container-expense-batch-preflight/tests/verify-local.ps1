$ErrorActionPreference='Stop'
$root=Split-Path -Parent $PSScriptRoot
$state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-expense-batch-preflight/local'
New-Item -ItemType Directory -Force -Path (Join-Path $state 'sursum-api/includes') | Out-Null
Copy-Item -LiteralPath (Join-Path $root 'abl/ExpenseBatch1042ReadOnlyPreflight.p') -Destination (Join-Path $state 'Probe.p')
Copy-Item -LiteralPath 'D:/opencode/motor-progress/v2/sursum-api/includes/parametros_ima.i' -Destination (Join-Path $state 'sursum-api/includes/parametros_ima.i')
$probe=Get-Content (Join-Path $state 'Probe.p') -Raw
[IO.File]::WriteAllText((Join-Path $state 'Probe.p'),$probe.Replace('BLOCK-LEVEL ON ERROR UNDO, THROW.','').Replace('USING Progress.Json.ObjectModel.*.',''),[Text.UTF8Encoding]::new($false))
$wrapper=@'
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE TEMP-TABLE ttProbeParams NO-UNDO FIELD cod-param AS CHARACTER FIELD val-param AS CHARACTER.
&SCOPED-DEFINE SURSUM_PARAMETROS_IMA_TABELA ttProbeParams
{Probe.p}
'@
[IO.File]::WriteAllText((Join-Path $state 'LocalOnly.p'),$wrapper,[Text.UTF8Encoding]::new($false))
[IO.File]::WriteAllText((Join-Path $state 'Compile.p'),"OUTPUT TO 'compile.log'. COMPILE LocalOnly.p SAVE NO-ERROR. PUT UNFORMATTED 'OpenEdge ' PROVERSION ' NUM-DBS=' NUM-DBS ' ERROR=' COMPILER:ERROR SKIP. DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(n) SKIP. END. OUTPUT CLOSE. QUIT.",[Text.UTF8Encoding]::new($false))
$compile=Get-Content (Join-Path $state 'Compile.p') -Raw
[IO.File]::WriteAllText((Join-Path $state 'Compile.p'),"DEFINE VARIABLE n AS INTEGER NO-UNDO.`n"+$compile,[Text.UTF8Encoding]::new($false))
function Run-Avm([string]$Program) {
 $i=New-Object Diagnostics.ProcessStartInfo;$i.FileName='C:/Progress/OpenEdge/bin/_progres.exe';$i.WorkingDirectory=$state;$i.Arguments='-b -cpinternal UTF-8 -cpstream UTF-8 -p '+$Program;$i.UseShellExecute=$false;$i.CreateNoWindow=$true;$i.WindowStyle=[Diagnostics.ProcessWindowStyle]::Hidden;$i.RedirectStandardOutput=$true;$i.RedirectStandardError=$true;$i.EnvironmentVariables['DLC']='C:/Progress/OpenEdge'
 $p=[Diagnostics.Process]::Start($i);$out=$p.StandardOutput.ReadToEndAsync();$err=$p.StandardError.ReadToEndAsync();if(!$p.WaitForExit(20000)){throw 'AVM timeout'};[Threading.Tasks.Task]::WaitAll([Threading.Tasks.Task[]]@($out,$err));if($p.ExitCode -ne 0){throw ($out.Result+$err.Result)};$p.Dispose()
}
Run-Avm 'Compile.p'
$log=Get-Content (Join-Path $state 'compile.log') -Raw;if($log -notmatch 'ERROR=no'){throw $log}
Run-Avm 'LocalOnly.r'
$result=Get-Content (Join-Path $state 'expense-batch-preflight.json') -Raw | ConvertFrom-Json
if($result.num_dbs -ne 0 -or $result.completed -ne $false -or $result.cleanup_proven -ne $false -or $result.error -notmatch 'read-only connection required'){throw 'NoDB refusal failed'}
Write-Output 'PASS local compile12.8 NUMDBS0 and no-connection refusal; no real configuration read or writer executed'
