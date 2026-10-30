$ErrorActionPreference='Stop'
$python='C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/python/python.exe'
$node='C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/bin/node.exe'
$state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-expense-default-selection'
& (Join-Path $PSScriptRoot 'run-abl.ps1') | Tee-Object -FilePath (Join-Path $state 'abl-final.log')
if($LASTEXITCODE -ne 0){throw 'ABL failed'}
foreach($file in @('prepare-php.py','prepare-native.py','prepare-schemas.py','prepare-metadata.py','prepare-regressions.py')){
 & $python (Join-Path $PSScriptRoot $file);if($LASTEXITCODE -ne 0){throw ('Preparation failed '+$file)}
}
& $python (Join-Path $PSScriptRoot 'verify-wiring.py') | Tee-Object -FilePath (Join-Path $state 'wiring-final.log')
if($LASTEXITCODE -ne 0){throw 'Exact patch wiring failed'}
& php D:/opencode/construtor-pg/backend/vendor/phpunit/phpunit/phpunit -c (Join-Path $PSScriptRoot 'phpunit.xml') | Tee-Object -FilePath (Join-Path $state 'phpunit-final.log')
if($LASTEXITCODE -ne 0){throw 'PHP runtime/regression failed'}
& php (Join-Path $PSScriptRoot 'preview-native.php') | Tee-Object -FilePath (Join-Path $state 'builder-final.log')
if($LASTEXITCODE -ne 0){throw 'Builder preview failed'}
& $node (Join-Path $PSScriptRoot 'schema-ajv.cjs') | Tee-Object -FilePath (Join-Path $state 'schema-ajv-final.log')
if($LASTEXITCODE -ne 0){throw 'JSONSchema AJV failed'}
& $node (Join-Path $PSScriptRoot 'browser-selection.cjs') | Tee-Object -FilePath (Join-Path $state 'process-native-final.log')
if($LASTEXITCODE -ne 0){throw 'ProcessEngine real failed'}
Push-Location D:/opencode/construtor-pg
try{foreach($file in @('api-process-context-smoke.mjs','container-process-logs-smoke.mjs','process-session-flag-smoke.mjs')){
 & $node (Join-Path $state ('regressions/'+$file)) | Tee-Object -FilePath (Join-Path $state ($file+'.log'));if($LASTEXITCODE -ne 0){throw ('Existing frontend failed '+$file)}
}}finally{Pop-Location}
'PASS selection1047 candidate, central planners and opt-in native frontend; no canonical/remote/business changes' | Tee-Object -FilePath (Join-Path $state 'suite-complete.log')
