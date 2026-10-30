$ErrorActionPreference='Stop'
$workspace='D:/opencode/conversao-sc'
$state=Join-Path $workspace '.runtime/ciw-completion-20261028/container-nf-available-readonly'
$python='C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/python/python.exe'
$node='C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/bin/node.exe'
Set-Location -LiteralPath $workspace
# Pinned inputs only: no source/metadata/patch preparation and no remote execution.
& $python (Join-Path $PSScriptRoot 'verify-wiring.py')
if($LASTEXITCODE -ne 0){throw 'Byte guard/wiring failed'}
& powershell -NoProfile -ExecutionPolicy Bypass -File (Join-Path $PSScriptRoot 'run-abl.ps1') -NoPrepare
if($LASTEXITCODE -ne 0){throw 'TT suite failed'}
& php D:/opencode/construtor-pg/backend/vendor/phpunit/phpunit/phpunit -c (Join-Path $PSScriptRoot 'phpunit.xml') --do-not-cache-result --log-junit (Join-Path $state 'php-focused.xml')
if($LASTEXITCODE -ne 0){throw 'Runtime/Builder/PHP contract suite failed'}
& $node (Join-Path $PSScriptRoot 'native-readonly.cjs')
if($LASTEXITCODE -ne 0){throw 'Native/AJV/browser suite failed'}
& php -l (Join-Path $PSScriptRoot '../php/RuntimeContainerNfAvailableRead.php')
if($LASTEXITCODE -ne 0){throw 'PHP helper lint failed'}
& php -l (Join-Path $state 'local/php/RuntimeApiEntityActionService.php')
if($LASTEXITCODE -ne 0){throw 'PHP shared candidate lint failed'}
& $python (Join-Path $PSScriptRoot 'verify-wiring.py')
if($LASTEXITCODE -ne 0){throw 'Final byte guard failed'}
Write-Output 'PASS LOCAL op1053 pinned verification; NUMDBS0; official12.2/PASOE not executed'
