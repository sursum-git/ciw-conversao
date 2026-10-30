$ErrorActionPreference='Stop'
$compileScript = @'
$ErrorActionPreference='Stop';$ProgressPreference='SilentlyContinue'
Set-Location 'C:\Users\tadeu.parreiras\codex-program-log-20261015'
$env:DLC='C:\Progress_12\OE'
& 'C:\Progress_12\OE\bin\_progres.exe' -b -cpinternal UTF-8 -cpstream UTF-8 -p CompileEventsUtf8.p *> compile-events-process.log
$lines=Get-Content compile-events-utf8.log
$lines
if(-not ($lines -contains 'PASS: compile events UTF8')) {exit 1}
Write-Output ('SOURCE_SHA256='+(Get-FileHash DynamicQueryWebHandler.cls -Algorithm SHA256).Hash)
Write-Output ('ARTIFACT_BASE64='+[Convert]::ToBase64String([IO.File]::ReadAllBytes((Join-Path (Get-Location) 'DynamicQueryWebHandler.r'))))
'@
$encoded=[Convert]::ToBase64String([Text.Encoding]::Unicode.GetBytes($compileScript))
ssh tadeu.parreiras@192.168.0.42 "powershell -NoProfile -EncodedCommand $encoded" > .runtime/events-utf8-compiled-20261016/compile-response.txt
exit $LASTEXITCODE
