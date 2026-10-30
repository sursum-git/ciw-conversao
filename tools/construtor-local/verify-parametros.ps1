$ErrorActionPreference='Stop'
$state=[IO.Path]::GetFullPath((Join-Path $PSScriptRoot '..\..\.runtime\construtor-pg'))
$token=(Get-Content -LiteralPath (Join-Path $state 'parametros-ima-connection.json') -Raw|ConvertFrom-Json).integrationToken
$url='http://127.0.0.1:19910/med/web/SursumPrograms/parametros-ima-verificar'
foreach($headers in @(@{}, @{'X-Parametros-Ima-Token'=('0'*64)})) {
    $denied=Invoke-RestMethod -Uri $url -Method Post -ContentType 'application/json' -Body '{}' -Headers $headers -TimeoutSec 30
    if($denied.success -ne $false -or $denied.error.code -ne 'PARAMETRO_AUTH_REQUIRED' -or $denied.error.status -ne 401){throw 'Autenticacao ausente/incorreta nao foi recusada.'}
}
$result=Invoke-RestMethod -Uri $url -Method Post -ContentType 'application/json' -Body '{}' -Headers @{'X-Parametros-Ima-Token'=$token} -TimeoutSec 30
if($result.success -ne $true -or $result.data.databaseConnected -ne $true -or $result.data.valueMatchesDatabase -ne $true -or $result.data.defaultValueVerified -ne $true -or $result.data.cacheEnabled -ne $false -or $result.data.helpersVerified -ne $true){throw 'Diagnostico da include/auxiliares falhou.'}
$names=@($result.data.PSObject.Properties.Name|Sort-Object)
if(($names -join ',') -ne 'cacheEnabled,databaseConnected,defaultValueVerified,helpersVerified,parameterExists,valueMatchesDatabase'){throw 'Diagnostico retornou campos inesperados.'}
@{at=[DateTime]::UtcNow.ToString('o');success=$true;data=$result.data;authMissingRejected=$true;authWrongRejected=$true}|ConvertTo-Json -Depth 6|Set-Content -LiteralPath (Join-Path $state 'parametros-ima-validation.json') -Encoding utf8
'PASS: include executada no PASOE com leitura real, valor padrao e sem cache; autenticacao conferida; nenhum valor de parametro exposto.'
