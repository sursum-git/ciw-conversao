param([switch]$Red)
$ErrorActionPreference='Stop'
$candidate=Split-Path -Parent $PSScriptRoot
$workspace='D:/opencode/conversao-sc'
$receipt=Join-Path $workspace '.runtime/ciw-completion-20261028/container-fiscal-readonly'
$stage=Join-Path $receipt $(if($Red){'red'}else{'local'})
New-Item -ItemType Directory -Path $stage -Force | Out-Null
& 'C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/python/python.exe' (Join-Path $candidate 'tests/prepare-stage.py') $stage $(if($Red){'red'}else{'green'})
if($LASTEXITCODE -ne 0){throw 'stage failed'}
function Run-Avm([string[]]$Arguments,[string]$Log) {
 $info=New-Object Diagnostics.ProcessStartInfo
 $info.FileName='C:/Progress/OpenEdge/bin/_progres.exe'; $info.WorkingDirectory=$stage
 $info.Arguments=($Arguments|ForEach-Object {'"'+$_+'"'}) -join ' '
 $info.UseShellExecute=$false; $info.CreateNoWindow=$true; $info.WindowStyle=[Diagnostics.ProcessWindowStyle]::Hidden
 $info.RedirectStandardOutput=$true; $info.RedirectStandardError=$true; $info.EnvironmentVariables['DLC']='C:/Progress/OpenEdge'
 $p=[Diagnostics.Process]::Start($info); $out=$p.StandardOutput.ReadToEndAsync(); $err=$p.StandardError.ReadToEndAsync()
 if(!$p.WaitForExit(45000)){throw 'AVM timeout: inspect process before retry'}
 [Threading.Tasks.Task]::WaitAll([Threading.Tasks.Task[]]@($out,$err))
 [IO.File]::WriteAllText((Join-Path $stage $Log),$out.Result+$err.Result,[Text.UTF8Encoding]::new($false))
 if($p.ExitCode -ne 0){throw 'AVM nonzero exit'}; $p.Dispose()
}
Run-Avm @('-b','-cpinternal','UTF-8','-cpstream','UTF-8','-p','Compile.p','-T',$stage) 'compile-process.log'
$compiled=Get-Content (Join-Path $stage 'compile.log') -Raw
if($compiled -notmatch 'PASS COMPILE ALL'){throw $compiled}
foreach($cp in @('UTF-8','ISO8859-1')) { foreach($culture in @('AMERICAN','EUROPEAN')) {
 Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-numdec',$(if($culture -eq 'AMERICAN'){'46'}else{'44'}),'-numsep',$(if($culture -eq 'AMERICAN'){'44'}else{'46'}),'-p','ContainerFiscalReadOnlyTest.r','-T',$stage) ('test-'+$cp+'-'+$culture+'-process.log')
 $log=Get-Content (Join-Path $stage 'fiscal-tests.log') -Raw
 [IO.File]::WriteAllText((Join-Path $stage ('test-'+$cp+'-'+$culture+'.log')),$log)
 if($Red){if($log -notmatch 'FAIL service missing'){throw 'RED failure was not expected missing service'}; Write-Output 'PASS expected RED: missing implementation';exit 0}
 if($log -notmatch 'PASS fiscal checks='){throw $log}; Write-Output $log.Trim()
 foreach($suite in @(@{name='CiwErpReadTest.r';prefix='erp-read-'},@{name='PurchaseItemsReadTest.r';prefix='purchase-item-read-'})) {
  Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-numdec',$(if($culture -eq 'AMERICAN'){'46'}else{'44'}),'-numsep',$(if($culture -eq 'AMERICAN'){'44'}else{'46'}),'-p',$suite.name,'-T',$stage) ($suite.prefix+$cp+'-'+$culture+'-process.log')
  $regression=Get-Content (Join-Path $stage ($suite.prefix+$culture+'.log')) -Raw
  [IO.File]::WriteAllText((Join-Path $stage ($suite.prefix+$cp+'-'+$culture+'.log')),$regression)
  if($regression -notmatch 'PASS ' -or $regression -match 'FAIL '){throw $regression};Write-Output $regression.Trim()
 }
}}
