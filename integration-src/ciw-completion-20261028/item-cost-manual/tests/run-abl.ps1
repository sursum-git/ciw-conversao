param([switch]$Red)
$ErrorActionPreference='Stop'
$state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/item-cost-manual'
& 'C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/python/python.exe' (Join-Path $PSScriptRoot 'prepare.py') $(if($Red){'--red'}else{'--green'})
if($LASTEXITCODE -ne 0){throw 'prepare failed'}
$stage=Join-Path $state $(if($Red){'red'}else{'local'})
function Run-Avm([string[]]$Arguments,[string]$Log) {
 $info=New-Object Diagnostics.ProcessStartInfo;$info.FileName='C:/Progress/OpenEdge/bin/_progres.exe';$info.WorkingDirectory=$stage
 $info.Arguments=($Arguments|ForEach-Object {'"'+$_+'"'}) -join ' ';$info.UseShellExecute=$false;$info.CreateNoWindow=$true;$info.WindowStyle=[Diagnostics.ProcessWindowStyle]::Hidden
 $info.RedirectStandardOutput=$true;$info.RedirectStandardError=$true;$info.EnvironmentVariables['DLC']='C:/Progress/OpenEdge'
 $p=[Diagnostics.Process]::Start($info);$out=$p.StandardOutput.ReadToEndAsync();$err=$p.StandardError.ReadToEndAsync()
 if(!$p.WaitForExit(45000)){throw 'AVM timeout'};[Threading.Tasks.Task]::WaitAll([Threading.Tasks.Task[]]@($out,$err))
 [IO.File]::WriteAllText((Join-Path $stage $Log),$out.Result+$err.Result,[Text.UTF8Encoding]::new($false));if($p.ExitCode -ne 0){throw 'AVM nonzero exit'};$p.Dispose()
}
Run-Avm @('-b','-cpinternal','UTF-8','-cpstream','UTF-8','-p','Compile.p','-T',$stage) 'compile-process.log'
$compiled=Get-Content (Join-Path $stage 'compile.log') -Raw;if($compiled -notmatch 'PASS COMPILE'){throw $compiled}
foreach($cp in @('UTF-8','ISO8859-1')){foreach($culture in @('AMERICAN','EUROPEAN')){
 Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-numdec',$(if($culture -eq 'AMERICAN'){'46'}else{'44'}),'-numsep',$(if($culture -eq 'AMERICAN'){'44'}else{'46'}),'-p','Execute.p','-T',$stage) ('test-'+$cp+'-'+$culture+'-process.log')
 $log=[string](Get-Content (Join-Path $stage 'execution.log') -Raw)
 if($Red){if($log -notmatch 'FAIL manual readonly resource exists'){throw $log};Write-Output 'PASS expected RED new manual resource absent';exit 0}
 if($log -notmatch 'PASS EXECUTE NUMDBS=0'){throw $log}
 $suite=Get-Content (Join-Path $stage ('item-manual-'+$culture+'.log')) -Raw
 [IO.File]::WriteAllText((Join-Path $stage ('test-'+$cp+'-'+$culture+'.log')),$log+$suite)
 Write-Output $suite.Trim()
 $prior=Get-Content (Join-Path $stage ('erp-read-'+$culture+'.log')) -Raw
 if($prior -notmatch 'PASS '){throw $prior};Write-Output $prior.Trim()
 $purchase=[string](Get-Content (Join-Path $stage ('purchase-item-read-'+$culture+'.log')) -Raw)
 if($purchase -notmatch '^PASS .*NUMDBS=0'){throw $purchase};Write-Output $purchase.Trim()
}}
