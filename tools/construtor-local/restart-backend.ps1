param([string]$ProjectDir='D:\opencode\construtor-pg')
$ErrorActionPreference='Stop'
$state=[IO.Path]::GetFullPath((Join-Path $PSScriptRoot '..\..\.runtime\construtor-pg'))
$pidFile=Join-Path $state 'backend.pid'
$servicePid=[int](Get-Content -LiteralPath $pidFile)
$process=Get-CimInstance Win32_Process -Filter "ProcessId=$servicePid"
$expected=[IO.Path]::GetFullPath((Join-Path $ProjectDir 'backend\public\index.php'))
if(!$process -or !$process.CommandLine.Replace('/','\').Contains($expected)) {throw 'PID nao corresponde ao backend local desta instalacao.'}
$listeners=Get-NetTCPConnection -State Listen -LocalPort 8000 -ErrorAction Stop
if($listeners.OwningProcess -notcontains $servicePid){throw 'Porta8000 nao pertence ao backend registrado.'}
$phpExecutable=(Get-Command php).Source
$phpOptions=@()
$pdoDrivers=& $phpExecutable -r 'echo implode(chr(44),PDO::getAvailableDrivers());'
if($LASTEXITCODE -ne 0){throw 'Nao foi possivel verificar drivers PHP; backend atual preservado.'}
if($pdoDrivers.Split(',') -notcontains 'odbc') {
    $odbcExtension=Join-Path (Split-Path $phpExecutable) 'ext\php_pdo_odbc.dll'
    if(!(Test-Path -LiteralPath $odbcExtension)){throw 'Extensao PDO_ODBC ausente; backend atual preservado.'}
    $phpOptions=@('-d',('extension="'+$odbcExtension+'"'))
}
$phpOptions+=@('-d','upload_max_filesize=20M','-d','post_max_size=22M','-d','max_execution_time=180')
$ldapLoaded=& $phpExecutable -r 'echo extension_loaded(chr(108).chr(100).chr(97).chr(112)) ? 1 : 0;'
if($LASTEXITCODE -ne 0){throw 'LDAP probe failed; current backend preserved'}
if($ldapLoaded -ne '1'){$phpOptions+=@('-d','extension=ldap')}
Stop-Process -Id $servicePid
Wait-Process -Id $servicePid -Timeout 10 -ErrorAction SilentlyContinue
$newProcess=Start-Process -FilePath $phpExecutable -ArgumentList ($phpOptions+@('-S','127.0.0.1:8000','-t',(Join-Path $ProjectDir 'backend\public'),$expected)) -WorkingDirectory $ProjectDir -WindowStyle Hidden -PassThru -RedirectStandardOutput (Join-Path $state 'backend.stdout.log') -RedirectStandardError (Join-Path $state 'backend.stderr.log')
Set-Content -LiteralPath $pidFile -Value $newProcess.Id
'PASS: somente backend PHP local reiniciado; frontend/banco/tunel preservados.'
