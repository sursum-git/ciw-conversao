$ErrorActionPreference='Stop'
$candidate=Split-Path -Parent $PSScriptRoot
$state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-fiscal-readonly'
& (Join-Path $PSScriptRoot 'run-local.ps1') | Tee-Object -FilePath (Join-Path $state 'abl-local-final.log')
if($LASTEXITCODE -ne 0){throw 'ABL failed'}
$stage=Join-Path $state 'local'
& php (Join-Path $PSScriptRoot 'RuntimeContainerFiscalReadOnlyQueryTest.php') $stage | Tee-Object -FilePath (Join-Path $state 'php-routing-final.log')
if($LASTEXITCODE -ne 0){throw 'PHP routing failed'}
& php (Join-Path $PSScriptRoot 'RuntimeContainerFiscalReadPageTest.php') $stage | Tee-Object -FilePath (Join-Path $state 'php-real-read-final.log')
if($LASTEXITCODE -ne 0){throw 'real ERP read path failed'}
& php (Join-Path $PSScriptRoot 'preview-native.php') $stage | Tee-Object -FilePath (Join-Path $state 'builder-preview-final.log')
if($LASTEXITCODE -ne 0){throw 'native Builder failed'}
& 'C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/bin/node.exe' (Join-Path $PSScriptRoot 'validate-native.cjs') $stage | Tee-Object -FilePath (Join-Path $state 'native-js-final.log')
if($LASTEXITCODE -ne 0){throw 'native JS failed'}
Write-Output 'PASS package verification; local12.8 only, official12.2/PASOE gates remain'
