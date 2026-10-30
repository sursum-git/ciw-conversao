$ErrorActionPreference='Stop'
$python='C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/python/python.exe'
$state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-expense-batch'
& $python (Join-Path $PSScriptRoot 'prepare-native.py')
if($LASTEXITCODE -ne 0){throw 'native preparation failed'}
& $python (Join-Path $PSScriptRoot 'prepare-bridge.py')
if($LASTEXITCODE -ne 0){throw 'bridge preparation failed'}
& $python (Join-Path $PSScriptRoot 'verify-wiring.py') | Tee-Object -FilePath (Join-Path $state 'public-wiring-final.log')
if($LASTEXITCODE -ne 0){throw 'public wrapper wiring failed'}
& (Join-Path $PSScriptRoot 'run-seam.ps1') | Tee-Object -FilePath (Join-Path $state 'abl-final.log')
if($LASTEXITCODE -ne 0){throw 'ABL failed'}
& php (Join-Path $PSScriptRoot 'runtime-boundary.php') (Join-Path $state 'bridge') | Tee-Object -FilePath (Join-Path $state 'runtime-boundary-final.log')
if($LASTEXITCODE -ne 0){throw 'Runtime boundary failed'}
& php (Join-Path $PSScriptRoot 'preview-native.php') (Join-Path $state 'native') (Join-Path $state 'bridge') | Tee-Object -FilePath (Join-Path $state 'builder-final.log')
if($LASTEXITCODE -ne 0){throw 'Builder preview failed'}
& 'C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/bin/node.exe' (Join-Path $PSScriptRoot 'native-batch.cjs') (Join-Path $state 'native') (Join-Path $state 'bridge') | Tee-Object -FilePath (Join-Path $state 'native-batch-final.log')
if($LASTEXITCODE -ne 0){throw 'Native batch failed'}
& 'C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/bin/node.exe' (Join-Path $PSScriptRoot 'browser-native.cjs') (Join-Path $state 'native') (Join-Path $state 'bridge') | Tee-Object -FilePath (Join-Path $state 'kendo-final.log')
if($LASTEXITCODE -ne 0){throw 'Real Kendo batch failed'}
& 'C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/bin/node.exe' (Join-Path $state 'native/legacy-batch-regression.mjs') | Tee-Object -FilePath (Join-Path $state 'legacy-batch-final.log')
if($LASTEXITCODE -ne 0){throw 'Existing batch regression failed'}
& php D:/opencode/construtor-pg/backend/vendor/phpunit/phpunit/phpunit --no-configuration --bootstrap (Join-Path $PSScriptRoot 'phpunit-bootstrap.php') --do-not-cache-result D:/opencode/construtor-pg/backend/tests/Runtime/RuntimeApiEntityBatchTest.php | Tee-Object -FilePath (Join-Path $state 'phpunit-existing-batch-final.log')
if($LASTEXITCODE -ne 0){throw 'Existing PHP batch regression failed'}
Write-Output 'PASS expense batch candidate; no canonical/remote/business changes'
