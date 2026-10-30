$ErrorActionPreference = 'Stop'
$state = [IO.Path]::GetFullPath((Join-Path $PSScriptRoot '..\..\.runtime\construtor-pg'))
foreach ($service in @('frontend','backend')) {
    $pidFile = Join-Path $state ($service + '.pid')
    if (!(Test-Path -LiteralPath $pidFile)) { continue }
    $servicePid = [int](Get-Content -LiteralPath $pidFile)
    $process = Get-CimInstance Win32_Process -Filter "ProcessId=$servicePid"
    $expected = if ($service -eq 'frontend') { 'tools\construtor-local\server.cjs' } else { 'construtor-pg\backend\public\index.php' }
    if ($process -and $process.CommandLine.Contains($expected)) {
        Stop-Process -Id $servicePid
    } elseif ($process) {
        throw "PID de $service não corresponde ao processo desta instalação."
    }
    Remove-Item -LiteralPath $pidFile -Force
}
& 'C:\Program Files\PostgreSQL\14\bin\pg_ctl.exe' -D (Join-Path $state 'postgres') -m fast -w stop
if ($LASTEXITCODE -ne 0) { throw 'Não foi possível parar o PostgreSQL desta instalação.' }
