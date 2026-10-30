$ErrorActionPreference='Stop'
$python='C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/python/python.exe'
$node='C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/bin/node.exe'
$state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-tax-only'
& (Join-Path $PSScriptRoot 'run-abl.ps1') | Tee-Object -FilePath (Join-Path $state 'abl-final.log')
if($LASTEXITCODE -ne 0){throw 'ABL failed'}
& $python (Join-Path $PSScriptRoot 'prepare-php.py')
if($LASTEXITCODE -ne 0){throw 'PHP preparation failed'}
& $python (Join-Path $PSScriptRoot 'prepare-metadata.py')
if($LASTEXITCODE -ne 0){throw 'Metadata preparation failed'}
& $python (Join-Path $PSScriptRoot 'verify-wiring.py') | Tee-Object -FilePath (Join-Path $state 'wiring-final.log')
if($LASTEXITCODE -ne 0){throw 'Wiring failed'}
& php D:/opencode/construtor-pg/backend/vendor/phpunit/phpunit/phpunit -c (Join-Path $PSScriptRoot 'phpunit.xml') | Tee-Object -FilePath (Join-Path $state 'phpunit-final.log')
if($LASTEXITCODE -ne 0){throw 'PHP runtime/regression failed'}
& php (Join-Path $PSScriptRoot 'preview-native.php') | Tee-Object -FilePath (Join-Path $state 'builder-final.log')
if($LASTEXITCODE -ne 0){throw 'Builder preview failed'}
& $node (Join-Path $PSScriptRoot 'browser-process.cjs') | Tee-Object -FilePath (Join-Path $state 'process-native-final.log')
if($LASTEXITCODE -ne 0){throw 'ProcessEngine real failed'}
Push-Location D:/opencode/construtor-pg
try { & $node tests/frontend/api-process-context-smoke.mjs | Tee-Object -FilePath (Join-Path $state 'process-regression-final.log');if($LASTEXITCODE -ne 0){throw 'Existing process frontend failed'} } finally { Pop-Location }
Write-Output 'PASS tax-only candidate; no canonical/remote/business changes'
