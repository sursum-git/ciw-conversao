param(
    [ValidatePattern('^construtor_pg_seed_[a-z]+$')]
    [string]$DatabaseName = 'construtor_pg_seed_check'
)
$ErrorActionPreference = 'Stop'
$backend = 'D:\opencode\construtor-pg\backend'
$line = Get-Content -LiteralPath (Join-Path $backend '.env.local') |
    Where-Object { $_.StartsWith('DATABASE_URL=') }
$url = $line.Substring('DATABASE_URL='.Length)
if (!$url.Contains('@127.0.0.1:55432/construtor_pg?')) {
    throw 'Este teste aceita somente o cluster local isolado da porta 55432.'
}
$env:DATABASE_URL = $url.Replace('/construtor_pg?', "/${DatabaseName}?")
$env:APP_DATABASE_IDENTITY = "local:$DatabaseName"
Push-Location $backend
try {
    php bin/console app:install:bootstrap --create-database --skip-integrity --no-interaction --quiet
    if ($LASTEXITCODE -ne 0) { throw 'Bootstrap da base de teste falhou.' }
    php bin/console app:integrity:monitor --fail-on-invalid --no-interaction --quiet
    if ($LASTEXITCODE -ne 0) {
        throw 'FAIL: seed novo gera assinatura diferente na sessão seguinte.'
    }
    Write-Output 'PASS: seed de banco novo mantém a integridade em outra sessão PHP.'
} finally {
    Pop-Location
    Remove-Item Env:\DATABASE_URL -ErrorAction SilentlyContinue
    Remove-Item Env:\APP_DATABASE_IDENTITY -ErrorAction SilentlyContinue
}
