$ErrorActionPreference = 'Stop'
$root = [IO.Path]::GetFullPath((Join-Path $PSScriptRoot '..\..'))
$state = Join-Path $root '.runtime\construtor-pg'
$url = 'http://127.0.0.1:19910/med/web/SursumPrograms/coloracoes-consulta-manual'
$token = (Get-Content -LiteralPath (Join-Path $state 'coloracoes-connection.json') -Raw | ConvertFrom-Json).integrationToken
foreach ($headers in @(@{}, @{'X-Coloracoes-Token'=('0'*64)})) {
    $denied = Invoke-RestMethod -Uri $url -Method Post -ContentType 'application/json' -Body '{}' -Headers $headers -TimeoutSec 30
    if ($denied.success -ne $false -or $denied.error.code -ne 'COLORACAO_AUTH_REQUIRED' -or $denied.error.status -ne 401) { throw 'Falha ao recusar credencial ausente/incorreta.' }
}
$response = Invoke-RestMethod -Uri $url -Method Post -ContentType 'application/json' -Body '{}' -Headers @{'X-Coloracoes-Token'=$token} -TimeoutSec 30
if ($response.success -ne $true -or $null -eq $response.data) { throw 'Consulta nao retornou contrato valido.' }
$previous = $null
$accented = 0
foreach ($row in $response.data) {
    $names = @($row.PSObject.Properties.Name | Sort-Object)
    if (($names -join ',') -ne 'coloracao_id,descricao,log_inativo') { throw 'Campos inesperados.' }
    if ($null -ne $row.coloracao_id -and $row.coloracao_id -isnot [int] -and $row.coloracao_id -isnot [long]) { throw 'ID nao inteiro.' }
    if ($null -ne $previous -and $row.coloracao_id -lt $previous) { throw 'Ordenacao por ID incorreta.' }
    $previous = $row.coloracao_id
    if ($null -ne $row.descricao -and $row.descricao -isnot [string]) { throw 'Descricao nao textual.' }
    if ($row.descricao -match '[\u00c0-\u00ff]') { $accented++ }
    if ($row.descricao -match '\uFFFD') { throw 'Caracter de substituicao na descricao.' }
    if ($null -ne $row.log_inativo -and $row.log_inativo -isnot [bool]) { throw 'Inativo nao booleano.' }
}
@{success=$true; recordCount=@($response.data).Count; accentedDescriptions=$accented; authMissingRejected=$true; authWrongRejected=$true; fieldsAndTypes=$true; sortedById=$true; verifiedAt=[DateTime]::UtcNow.ToString('o')} |
    ConvertTo-Json | Set-Content -LiteralPath (Join-Path $state 'coloracoes-validation.json') -Encoding utf8
"PASS: consulta real com $(@($response.data).Count) coloracoes; campos/tipos/ordem e duas recusas de autenticacao conferidos."
