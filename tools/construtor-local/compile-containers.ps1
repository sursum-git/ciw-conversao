$ErrorActionPreference='Stop'
$taskRoot=[IO.Path]::GetFullPath((Join-Path $PSScriptRoot '../..'))
$remoteStage='C:/Users/tadeu.parreiras/codex-containers-20261016'
$localStage='.runtime/containers-compiled-20261016'
New-Item -ItemType Directory -Path (Join-Path $taskRoot $localStage) -Force | Out-Null
$files=@('ContainersConsulta.p','ContainersConsultaService.p','ContainersConsultaTest.p','CompileContainersTests.p')
$uploads=@($files | ForEach-Object {@{local=('integration-src/containers/'+$_);remote=($remoteStage+'/'+$_)}})
$script=@'
$ErrorActionPreference='Stop'
$ProgressPreference='SilentlyContinue'
$stage='C:\Users\tadeu.parreiras\codex-containers-20261016'
if((Resolve-Path -LiteralPath $stage).Path -ne $stage){throw 'Staging remoto inesperado'}
Set-Location -LiteralPath $stage
$env:DLC='C:\Progress_12\OE'
foreach($file in @('compile-containers-tests-AMERICAN.log','containers-tests-AMERICAN.log','containers-tests-EUROPEAN.log','ContainersConsulta.r','ContainersConsultaService.r')) {
 if(Test-Path -LiteralPath $file){Remove-Item -LiteralPath $file}
}
& 'C:\Progress_12\OE\bin\_progres.exe' -b -cpinternal UTF-8 -cpstream UTF-8 -p CompileContainersTests.p *> compile-process.log
foreach($file in @('compile-containers-tests-AMERICAN.log','containers-tests-AMERICAN.log','containers-tests-EUROPEAN.log')) {
 if(!(Test-Path -LiteralPath $file)){Get-Content compile-process.log;throw ('Log ausente: '+$file)}
 $log=Get-Content -LiteralPath $file -Raw
 Write-Output $file
 Write-Output $log
 if($log -match 'FAIL|COMPILER:ERROR=yes' -or $log -notmatch 'PASS'){throw ('Falha em '+$file)}
 if($file.StartsWith('compile-') -and $log -notmatch 'OpenEdge 12\.2'){throw 'Compilador incompatível'}
}
foreach($file in @('ContainersConsulta.r','ContainersConsultaService.r')) {
 if(!(Test-Path -LiteralPath $file)){throw ('Compilado ausente: '+$file)}
}
'@
$encoded=[Convert]::ToBase64String([Text.Encoding]::Unicode.GetBytes($script))
$downloads=@(@('ContainersConsulta.r','ContainersConsultaService.r','compile-containers-tests-AMERICAN.log','containers-tests-AMERICAN.log','containers-tests-EUROPEAN.log','compile-process.log') | ForEach-Object {@{remote=($remoteStage+'/'+$_);local=($localStage+'/'+$_)}})
$plan=@{server='compiler';directories=@($remoteStage);uploads=$uploads;commands=@('powershell -NoProfile -EncodedCommand '+$encoded);downloads=$downloads}
$planPath=Join-Path $taskRoot ($localStage+'/compile-plan.json')
$plan|ConvertTo-Json -Depth 8|Set-Content -LiteralPath $planPath -Encoding utf8
$python=Join-Path $env:USERPROFILE '.cache/codex-runtimes/codex-primary-runtime/dependencies/python/python.exe'
& $python (Join-Path $PSScriptRoot 'containers-remote-task.py') $planPath
exit $LASTEXITCODE
