param([string]$Build='1')
$ErrorActionPreference='Stop'
$workspace='D:/opencode/conversao-sc'
$snapshot=Join-Path $workspace ('.runtime/ciw-completion-20261028/official-build'+$Build+'/package')
$diagnostic=Join-Path $workspace ('.runtime/ciw-completion-20261028/local-diagnostic-build'+$Build)
if(Test-Path -LiteralPath $diagnostic){throw 'Do not replace a diagnostic run'}
Copy-Item -LiteralPath $snapshot -Destination $diagnostic -Recurse
$remote='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build'+$Build
foreach($name in @('Compile.p','Regression.p','compile122.ps1')){
 $file=Join-Path $diagnostic $name
 $value=[IO.File]::ReadAllText($file).Replace($remote,$diagnostic.Replace('\','/'))
 if($name -eq 'compile122.ps1'){$value=$value.Replace('C:/Progress_12/OE','C:/Progress/OpenEdge').Replace('OpenEdge 12[.]2','OpenEdge 12[.]8').Replace('Official12.2 combined tests executed','DEVELOPMENT12.8 ONLY combined tests executed')}
 [IO.File]::WriteAllText($file,$value,[Text.UTF8Encoding]::new($false))
}
& (Join-Path $diagnostic 'compile122.ps1')
if($LASTEXITCODE -ne 0){throw 'Local diagnostic failed; official snapshot remains unchanged'}
Write-Output 'DEVELOPMENT ONLY. Never publish diagnostic r-code.'
