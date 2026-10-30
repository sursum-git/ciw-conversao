$ErrorActionPreference='Stop'
$script = @'
$ErrorActionPreference='Stop';$ProgressPreference='SilentlyContinue'
Set-Location 'C:\Users\tadeu.parreiras\codex-program-log-20261015'
$env:DLC='C:\Progress_12\OE'
foreach($culture in @('AMERICAN','EUROPEAN')) {
  & 'C:\Progress_12\OE\bin\_progres.exe' -b -cpinternal UTF-8 -cpstream UTF-8 -p CompileDespesasTest.p -param $culture *> ('audit-process-'+$culture+'.log')
  $compile=Get-Content compile-despesas-tests.log
  $tests=Get-Content despesas-tests.log
  $compile
  $tests
  Copy-Item compile-despesas-tests.log ('audit-compile-'+$culture+'.log')
  Copy-Item despesas-tests.log ('audit-tests-'+$culture+'.log')
  if(($compile -match 'COMPILER:ERROR=yes') -or -not ($tests -match '^PASS:')) {exit 1}
}
Write-Output ('SOURCE_SHA256='+(Get-FileHash DespesasCrudService.p -Algorithm SHA256).Hash)
Write-Output ('ARTIFACT_BASE64='+[Convert]::ToBase64String([IO.File]::ReadAllBytes((Join-Path (Get-Location) 'DespesasCrudService.r'))))
'@
$encoded=[Convert]::ToBase64String([Text.Encoding]::Unicode.GetBytes($script))
ssh tadeu.parreiras@192.168.0.42 "powershell -NoProfile -EncodedCommand $encoded" > .runtime/despesas-audit-compiled-20261015/compile-response.txt
exit $LASTEXITCODE
