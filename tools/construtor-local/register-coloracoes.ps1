# Cadastra somente a fonte de consulta; nao altera entidades/telas existentes.
$ErrorActionPreference = 'Stop'
$root = [IO.Path]::GetFullPath((Join-Path $PSScriptRoot '..\..'))
$state = Join-Path $root '.runtime\construtor-pg'
$access = Get-Content -LiteralPath (Join-Path $state 'acesso-local.txt') | Where-Object { $_.StartsWith('Senha inicial=') }
$base = 'http://127.0.0.1:8765'
$login = @{username='admin'; password=$access.Substring('Senha inicial='.Length); tenantId='default'; rememberMe=$false}
$session = Invoke-RestMethod -Uri "$base/api/auth/login" -Method Post -ContentType 'application/json' -Body ($login | ConvertTo-Json)
if (!$session.authenticated) { throw 'Login administrativo nao concluido.' }
$headers = @{Authorization=('Bearer '+$session.token); 'X-Runtime-Auth-Token'=[string]$session.token;
    'X-Runtime-Tenant-Id'=[string]$session.tenantId; 'X-Runtime-User-Id'=[string]$session.user.id;
    'X-Runtime-Session-Id'=[string]$session.session.sessionId}
try {
    $source = Get-Content -LiteralPath (Join-Path $root 'examples\coloracoes-manual\api-source.json') -Raw | ConvertFrom-Json
    $connection = Get-Content -LiteralPath (Join-Path $state 'coloracoes-connection.json') -Raw | ConvertFrom-Json
    $source.authHeaders.'X-Coloracoes-Token' = $connection.integrationToken
    $catalog = Invoke-RestMethod -Uri "$base/api/admin/program-builder/bootstrap" -Headers $headers
    if (($catalog | ConvertTo-Json -Depth 60).Contains('motor_progress_coloracoes_manual')) { throw 'Fonte ja cadastrada; revisar antes de substituir.' }
    $saved = Invoke-RestMethod -Uri "$base/api/admin/program-builder/api-sources" -Method Post -Headers $headers -ContentType 'application/json' -Body ($source | ConvertTo-Json -Depth 30)
    if ($saved.apiSource.responseContract -ne 'sursum-programs') { throw 'Contrato nao preservado.' }
    if (($saved | ConvertTo-Json -Depth 60).Contains($connection.integrationToken)) { throw 'Credencial exposta na resposta administrativa.' }
    @{sourceCode=$saved.apiSource.code; responseContract=$saved.apiSource.responseContract; operations=@($saved.apiSource.operations.code); registeredAt=[DateTime]::UtcNow.ToString('o')} |
        ConvertTo-Json | Set-Content -LiteralPath (Join-Path $state 'coloracoes-registration.json') -Encoding utf8
    'PASS: fonte motor_progress_coloracoes_manual cadastrada; credencial mascarada.'
} finally {
    try { $null = Invoke-RestMethod -Uri "$base/api/auth/logout" -Method Post -Headers $headers -ContentType 'application/json' -Body '{}' } catch {}
}
