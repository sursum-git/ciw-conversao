param([string]$ProjectDir='D:\opencode\construtor-pg')
$ErrorActionPreference='Stop'
$state=[IO.Path]::GetFullPath((Join-Path $PSScriptRoot '..\..\.runtime\construtor-pg'))
$servicePid=[int](Get-Content -LiteralPath (Join-Path $state 'frontend.pid'))
$process=Get-CimInstance Win32_Process -Filter "ProcessId=$servicePid"
$server=Join-Path $PSScriptRoot 'server.cjs'
if(!$process -or !$process.CommandLine.Replace('/','\').Contains($server) -or !$process.CommandLine.Replace('/','\').Contains($ProjectDir)){throw 'Frontend PID does not belong to this installation'}
if((Get-NetTCPConnection -State Listen -LocalPort 8765).OwningProcess -notcontains $servicePid){throw 'Frontend listener ownership mismatch'}
Stop-Process -Id $servicePid
Wait-Process -Id $servicePid -Timeout 10 -ErrorAction SilentlyContinue
$new=Start-Process -FilePath (Get-Command node).Source -ArgumentList @($server,$ProjectDir,'8765') -WorkingDirectory $ProjectDir -WindowStyle Hidden -PassThru -RedirectStandardOutput (Join-Path $state 'frontend.stdout.log') -RedirectStandardError (Join-Path $state 'frontend.stderr.log')
Set-Content -LiteralPath (Join-Path $state 'frontend.pid') -Value $new.Id
'PASS only local frontend restarted; attachment stream timeout active'
