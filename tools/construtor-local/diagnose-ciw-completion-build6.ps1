param([string]$Build='6-v2')
$ErrorActionPreference='Stop'
$state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028'
$source=Join-Path $state ('official-build'+$Build+'/package')
$local=Join-Path $state ('local-diagnostic-build'+$Build)
if(Test-Path -LiteralPath $local){throw 'Never replace local diagnostic'}
Copy-Item -LiteralPath $source -Destination $local -Recurse
$remote='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build'+$Build
foreach($name in @('Compile.p','Regression.p','compile122.ps1')){
 $p=Join-Path $local $name;$text=[IO.File]::ReadAllText($p).Replace($remote,$local.Replace('\','/'))
 if($name -eq 'Compile.p'){
  foreach($excluded in @('sursum-api/programs/ContainersCustoRead.p','sursum-api/programs/ContainersDespesasBatchApi.p','sursum-api/programs/ContainersProcessos.p')){
   if(-not $text.Contains($excluded+',')){throw ('Missing physical wrapper '+$excluded)};$text=$text.Replace($excluded+',','')
  }
  $text=$text.Replace('IF NUM-DBS<>1','IF NUM-DBS<>0').Replace("PROVERSION BEGINS '12.2'","PROVERSION BEGINS '12.8'")
 }
 if($name -eq 'compile122.ps1'){
  $text=$text.Replace("'-db','espec','-H','192.168.0.111','-S','10012','-N','TCP','-ld','espec',",'').Replace('C:/Progress_12/OE','C:/Progress/OpenEdge').Replace('OpenEdge 12[.]2','OpenEdge 12[.]8').Replace("'NUM-DBS=1'","'NUM-DBS=0'").Replace('Official12.2 build6','DEVELOPMENT12.8 ONLY')
 }
 [IO.File]::WriteAllText($p,$text,[Text.UTF8Encoding]::new($false))
}
& (Join-Path $local 'compile122.ps1')
if(-not $?){throw 'Development diagnostics failed; official package unchanged'}
Write-Output 'DEVELOPMENT ONLY: physical wrappers remain official12.2 gate; no local r-code publication.'
