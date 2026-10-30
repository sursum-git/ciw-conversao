$ErrorActionPreference='Stop'
$python='C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/python/python.exe'
$node='C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/bin/node.exe'
$state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-attachments-download'
& (Join-Path $PSScriptRoot 'run-abl.ps1') -Red | Tee-Object -FilePath (Join-Path $state 'red-final.log');if($LASTEXITCODE -ne 0){throw 'RED proof failed'}
& (Join-Path $PSScriptRoot 'run-abl.ps1') | Tee-Object -FilePath (Join-Path $state 'abl-final.log');if($LASTEXITCODE -ne 0){throw 'ABL failed'}
foreach($name in @('prepare-metadata.py','verify-wiring.py')){& $python (Join-Path $PSScriptRoot $name) | Tee-Object -FilePath (Join-Path $state ($name+'.log'));if($LASTEXITCODE -ne 0){throw $name}}
& php D:/opencode/construtor-pg/backend/vendor/phpunit/phpunit/phpunit -c (Join-Path $PSScriptRoot 'phpunit.xml') | Tee-Object -FilePath (Join-Path $state 'phpunit-final.log');if($LASTEXITCODE -ne 0){throw 'PHP failed'}
& php (Join-Path $PSScriptRoot 'preview-native.php') | Tee-Object -FilePath (Join-Path $state 'builder-final.log');if($LASTEXITCODE -ne 0){throw 'Builder failed'}
& $node (Join-Path $PSScriptRoot 'native-download.cjs') | Tee-Object -FilePath (Join-Path $state 'native-final.log');if($LASTEXITCODE -ne 0){throw 'Native/AJV failed'}
'PASS container attachment authenticated readonly download; no canonical/network/business mutation' | Tee-Object -FilePath (Join-Path $state 'suite-complete.log')
