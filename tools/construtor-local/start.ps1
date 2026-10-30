param([string]$ProjectDir = 'D:\opencode\construtor-pg')
$ErrorActionPreference = 'Stop'
$state = [IO.Path]::GetFullPath((Join-Path $PSScriptRoot '..\..\.runtime\construtor-pg'))
$pgBin = 'C:\Program Files\PostgreSQL\14\bin'
& (Join-Path $pgBin 'pg_ctl.exe') -D (Join-Path $state 'postgres') status | Out-Null
if ($LASTEXITCODE -ne 0) {
    & (Join-Path $pgBin 'pg_ctl.exe') -D (Join-Path $state 'postgres') -l (Join-Path $state 'postgres.log') -o '-h 127.0.0.1 -p 55432' -w start
    if ($LASTEXITCODE -ne 0) { throw 'Não foi possível iniciar o PostgreSQL local.' }
}
$backendPhp = (Get-Command php -ErrorAction Stop).Source
$backendPhpArgs = @()
$ldapLoaded = & $backendPhp -r 'echo extension_loaded("ldap") ? "yes" : "no";'
if ($ldapLoaded -ne 'yes') {
    $ldapProbe = & $backendPhp -d extension=ldap -r 'echo extension_loaded("ldap") ? "yes" : "no";'
    if ($LASTEXITCODE -ne 0 -or $ldapProbe -ne 'yes') { throw 'Extensao LDAP indisponivel no PHP do backend.' }
    $backendPhpArgs = @('-d','extension=ldap')
}
$backendPhpArgs+=@('-d','upload_max_filesize=20M','-d','post_max_size=22M','-d','max_execution_time=180')
foreach ($service in @(
    @{Name='backend'; Port=8000; File=$backendPhp;
      Args=($backendPhpArgs + @('-S','127.0.0.1:8000','-t',(Join-Path $ProjectDir 'backend\public'),(Join-Path $ProjectDir 'backend\public\index.php')))},
    @{Name='frontend'; Port=8765; File=(Get-Command node -ErrorAction Stop).Source;
      Args=@((Join-Path $PSScriptRoot 'server.cjs'),$ProjectDir,'8765')}
)) {
    $listener = Get-NetTCPConnection -State Listen -LocalPort $service.Port -ErrorAction SilentlyContinue
    if ($listener) {
        $pidFile = Join-Path $state ($service.Name + '.pid')
        $owned = (Test-Path -LiteralPath $pidFile) -and
            ($listener.OwningProcess -contains [int](Get-Content -LiteralPath $pidFile))
        if (!$owned) { throw "Porta $($service.Port) ocupada por outro processo." }
        continue
    }
    $process = Start-Process -FilePath $service.File -ArgumentList $service.Args -WorkingDirectory $ProjectDir -WindowStyle Hidden -PassThru `
        -RedirectStandardOutput (Join-Path $state ($service.Name + '.stdout.log')) `
        -RedirectStandardError (Join-Path $state ($service.Name + '.stderr.log'))
    Set-Content -LiteralPath (Join-Path $state ($service.Name + '.pid')) -Value $process.Id
}
Write-Output 'Acesso local: http://127.0.0.1:8765/production/login.html'
