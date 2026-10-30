param([switch]$Red)
$ErrorActionPreference='Stop'
$state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-expense-default-selection'
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
$compiled=Get-Content (Join-Path $stage 'compile.log') -Raw;if($compiled -notmatch 'PASS COMPILE ALL'){throw $compiled}
foreach($cp in @('UTF-8','ISO8859-1')){foreach($culture in @('AMERICAN','EUROPEAN')){
 Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-numdec',$(if($culture -eq 'AMERICAN'){'46'}else{'44'}),'-numsep',$(if($culture -eq 'AMERICAN'){'44'}else{'46'}),'-p','Execute.p','-T',$stage) ('test-'+$cp+'-'+$culture+'-process.log')
 $log=Get-Content (Join-Path $stage 'execution.log') -Raw;$suite=Get-Content (Join-Path $stage ('containers-impostos-tests-'+$culture+'.log')) -Raw
 [IO.File]::WriteAllText((Join-Path $stage ('test-'+$cp+'-'+$culture+'.log')),$log+$suite)
 if($Red){if($suite -notmatch 'FAIL.*selected defaults operation succeeds'){throw ('Unexpected RED: '+$log+$suite)};Write-Output 'PASS expected RED selection defaults absent over frozen1043';exit 0}
 if($log -notmatch 'PASS EXECUTE'){throw $log};Write-Output $suite.Trim()
 $rootLog=Get-Content (Join-Path $stage ('containers-selection-root-tests-'+$culture+'.log')) -Raw
 if($rootLog -notmatch '^PASS '){throw $rootLog};Write-Output $rootLog.Trim()
}}
