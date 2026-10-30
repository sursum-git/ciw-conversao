param([string]$UserName='root', [string]$Server='192.168.0.111')
$ErrorActionPreference='Stop'
Write-Output 'Mantenha este terminal aberto. O SSH solicitará a credencial sem gravá-la.'
& ssh -o ConnectTimeout=15 -o ExitOnForwardFailure=yes -o ServerAliveInterval=30 -o ServerAliveCountMax=3 -N -L 127.0.0.1:19910:127.0.0.1:9910 "$UserName@$Server"
if ($LASTEXITCODE -ne 0) { throw 'O túnel SSH foi encerrado.' }
