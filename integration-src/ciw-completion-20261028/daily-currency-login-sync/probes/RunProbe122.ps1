param([Parameter(Mandatory=$true)][string]$ConnectionsFile)
$ErrorActionPreference='Stop'
$probeStage='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-currency-dictionary-ro'
if($PSScriptRoot.Replace([char]92,[char]47) -ne $probeStage){throw 'Fixed isolated remote staging required'}
Set-Location -LiteralPath $PSScriptRoot
if((Test-Path -LiteralPath 'compile.log') -or (Test-Path -LiteralPath 'currency-dictionary-private.json')){throw 'Fresh stage required; inspect previous state'}
$bindings=Get-Content -LiteralPath $ConnectionsFile -Raw|ConvertFrom-Json
if($bindings.approvedFor -ne 'daily-currency-login-sync-dictionary-only' -or $bindings.connections.Count -ne 2){throw 'Root-approved two-database bindings required'}
if((($bindings.PSObject.Properties.Name|Sort-Object)-join ',') -ne 'approvedFor,connections'){throw 'Closed connection descriptor required'}
$dbArgs=@()
foreach($alias in @('comum','ems5')){
 $rows=@($bindings.connections|Where-Object {$_.logicalName -eq $alias})
 if($rows.Count -ne 1){throw 'Exact dictionary aliases required'};$binding=$rows[0]
 if((($binding.PSObject.Properties.Name|Sort-Object)-join ',') -ne 'database,host,logicalName,port'){throw 'Connection descriptor forbids credentials and extra options'}
 if($binding.database -notmatch '^[A-Za-z0-9_-]{1,64}$' -or $binding.host -notmatch '^[A-Za-z0-9][A-Za-z0-9.-]{0,127}$' -or !($binding.port -is [int] -or $binding.port -is [long]) -or $binding.port -lt 1 -or $binding.port -gt 65535){throw 'Invalid root connection descriptor'}
 $dbArgs+=@('-db',$binding.database,'-H',$binding.host,'-S',[string]$binding.port,'-N','TCP','-ld',$alias)
}
function Invoke-DictionaryAvm([string]$Program,[string]$Log){
 $arguments=$dbArgs+@('-b','-cpinternal','UTF-8','-cpstream','UTF-8','-p',$Program,'-T',$PSScriptRoot)
 $info=New-Object Diagnostics.ProcessStartInfo;$info.FileName='C:/Progress_12/OE/bin/_progres.exe';$info.WorkingDirectory=$PSScriptRoot
 $info.Arguments=($arguments|ForEach-Object {'"'+$_+'"'}) -join ' ';$info.UseShellExecute=$false;$info.CreateNoWindow=$true;$info.WindowStyle=[Diagnostics.ProcessWindowStyle]::Hidden
 $info.EnvironmentVariables['DLC']='C:/Progress_12/OE';$info.RedirectStandardOutput=$true;$info.RedirectStandardError=$true
 $process=[Diagnostics.Process]::Start($info);$stdout=$process.StandardOutput.ReadToEndAsync();$stderr=$process.StandardError.ReadToEndAsync()
 if(!$process.WaitForExit(35000)){throw 'AVM timeout; inspect before retry'}
 [Threading.Tasks.Task]::WaitAll([Threading.Tasks.Task[]]@($stdout,$stderr));[IO.File]::WriteAllText((Join-Path $PSScriptRoot $Log),$stdout.Result+$stderr.Result,[Text.UTF8Encoding]::new($false))
 if($process.ExitCode -ne 0){throw 'AVM failed'};$process.Dispose()
}
Invoke-DictionaryAvm 'Compile.p' 'compile-process.log'
$compiled=Get-Content -LiteralPath 'compile.log' -Raw
if($compiled -notmatch 'OpenEdge 12[.]2' -or $compiled -notmatch 'NUMDBS=2' -or $compiled -notmatch 'ERROR=no' -or $compiled -notmatch 'PASS COMPILE' -or $compiled -match 'FAIL'){throw 'Official compile unconfirmed'}
Invoke-DictionaryAvm 'CurrencyDictionaryReadonlyProbe.r' 'probe-process.log'
$proof=Get-Content -LiteralPath 'currency-dictionary-private.json' -Raw|ConvertFrom-Json
if($proof.openEdge -notmatch '^12[.]2' -or $proof.numDbs -ne 2 -or $proof.partial -ne $false -or $proof.dictionaryReads -gt 50000 -or $proof.businessReads -ne $false -or $proof.businessWrites -ne $false){throw 'Dictionary proof bounds invalid'}
if($proof.completed -ne $true){if($proof.tables.Count -ne 0){throw 'Partial metadata forbidden'};throw 'Dictionary probe incomplete'}
if($proof.tables.Count -ne 2 -or $proof.tables[0].database -ne 'comum' -or $proof.tables[0].table -ne 'cotacao' -or $proof.tables[1].database -ne 'ems5' -or $proof.tables[1].table -ne 'cotac_parid'){throw 'Exact metadata tables required'}
Write-Output 'PASS dictionary-only probe; see private JSON; no business read/write'
