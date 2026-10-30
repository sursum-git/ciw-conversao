$ErrorActionPreference='Stop'
$python='C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/python/python.exe'
$node='C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/bin/node.exe'
$state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/native-process-options-normalization-companion'
$phpunit='D:/opencode/construtor-pg/backend/vendor/phpunit/phpunit/phpunit'
$env:CIW_OPTIONS_COMPANION_STATE=Join-Path $state 'red'
& php $phpunit --no-configuration --do-not-cache-result --bootstrap (Join-Path $state 'red/bootstrap.php') --filter 'testRealEntityNormalizationPreserves|testPublicExternalValidationBuilds' (Join-Path $PSScriptRoot 'NormalizedDependentOptionsTest.php') 2>&1 | Tee-Object -FilePath (Join-Path $state 'red-final.log')
if($LASTEXITCODE -eq 0){throw 'Expected RED baseline unexpectedly green'}
$red=[string](Get-Content (Join-Path $state 'red-final.log') -Raw);if($red -notmatch 'Referenced string/dropdown enum lost by real normalizeEntityPayload' -or $red -notmatch 'Parametro exige enum escalar fechado'){throw 'Unexpected RED failure'}
$env:CIW_OPTIONS_COMPANION_STATE=Join-Path $state 'local'
& php $phpunit --do-not-cache-result --bootstrap (Join-Path $state 'local/bootstrap.php') -c (Join-Path $PSScriptRoot 'phpunit.xml') | Tee-Object -FilePath (Join-Path $state 'phpunit-final.log');if($LASTEXITCODE -ne 0){throw 'PHP failed'}
& php $phpunit --no-configuration --do-not-cache-result --bootstrap (Join-Path $state 'local/bootstrap.php') (Join-Path $state 'local/CombinedMetadataTest.php') | Tee-Object -FilePath (Join-Path $state 'combined-final.log');if($LASTEXITCODE -ne 0){throw 'Combined metadata failed'}
& $node (Join-Path $PSScriptRoot 'schema.cjs') | Tee-Object -FilePath (Join-Path $state 'schema-final.log');if($LASTEXITCODE -ne 0){throw 'Schema failed'}
& $node (Join-Path $state 'local/browser-normalized.cjs') | Tee-Object -FilePath (Join-Path $state 'browser-final.log');if($LASTEXITCODE -ne 0){throw 'Native normalized frontend failed'}
& $python (Join-Path $PSScriptRoot 'verify.py') | Tee-Object -FilePath (Join-Path $state 'wiring-final.log');if($LASTEXITCODE -ne 0){throw 'Byte/scope checks failed'}
'PASS normalized dependent options companion; no stage8/freezes/canonical/business changes' | Tee-Object -FilePath (Join-Path $state 'suite-complete.log')
