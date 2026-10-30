param([string]$Build='5-v6')
$ErrorActionPreference='Stop'
$root='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028'
$snapshot=Join-Path $root ('official-build'+$Build+'/package')
$local=Join-Path $root ('local-diagnostic-build'+$Build)
if(Test-Path -LiteralPath $local){throw 'Do not replace diagnostic run'}
Copy-Item -LiteralPath $snapshot -Destination $local -Recurse
$remote='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build'+$Build
foreach($name in @('Compile.p','Regression.p','compile122.ps1')){
 $p=Join-Path $local $name;$text=[IO.File]::ReadAllText($p).Replace($remote,$local.Replace('\','/'))
 if($name -eq 'Compile.p'){
  foreach($excluded in @('sursum-api/programs/ContainersCustoRead.p','sursum-api/programs/ContainersDespesasBatchApi.p')){if(-not $text.Contains($excluded+',')){throw 'Missing excluded physical wrapper'};$text=$text.Replace($excluded+',','')}
  $text=$text.Replace('IF NUM-DBS<>1','IF NUM-DBS<>0').Replace("PROVERSION BEGINS '12.2'","PROVERSION BEGINS '12.8'")
 }
 if($name -eq 'compile122.ps1'){
  $text=$text.Replace("'-db','espec','-H','192.168.0.111','-S','10012','-N','TCP','-ld','espec',",'').Replace('C:/Progress_12/OE','C:/Progress/OpenEdge').Replace('OpenEdge 12[.]2','OpenEdge 12[.]8').Replace("'NUM-DBS=1'","'NUM-DBS=0'").Replace('Official12.2 wave2 tests executed','DEVELOPMENT12.8 ONLY; two static IMA wrappers excluded from local compile;40 test AVMs')
 }
 [IO.File]::WriteAllText($p,$text,[Text.UTF8Encoding]::new($false))
}
& (Join-Path $local 'compile122.ps1')
if($LASTEXITCODE -ne 0){throw 'Local diagnostics failed; official snapshot unchanged'}
Write-Output 'DEVELOPMENT ONLY:41 compiles/noDB;2physical wrappers official12.2 gate;40TTlogs/noDB. Never publish local r-code.'
