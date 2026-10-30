$ErrorActionPreference='Stop'
$taskDir=Split-Path -Parent $PSScriptRoot
$taskLocal='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/sample-container-items-readonly/local'
node "$taskDir/prepare.cjs"
if($LASTEXITCODE -ne 0){throw 'Preparation failed'}
foreach($cp in @('UTF-8','ISO8859-1')){
 $p=Start-Process -FilePath C:/Progress/OpenEdge/bin/_progres.exe -ArgumentList @('-b','-p',"$taskLocal/Compile.p",'-cpinternal',$cp,'-cpstream','UTF-8') -WorkingDirectory $taskLocal -WindowStyle Hidden -PassThru
 $p.WaitForExit()
 Copy-Item -LiteralPath "$taskLocal/compile.log" -Destination "$taskLocal/compile-$cp.log"
 $log=Get-Content "$taskLocal/compile-$cp.log" -Raw
 if($log.Contains('ERROR=yes') -or ([regex]::Matches($log,'ERROR=no')).Count -ne 6){throw "Compile failed $cp"}
 foreach($culture in @('AMERICAN','EUROPEAN')){
  $p=Start-Process -FilePath C:/Progress/OpenEdge/bin/_progres.exe -ArgumentList @('-b','-p',"$taskLocal/Run.p",'-cpinternal',$cp,'-cpstream','UTF-8','-param',$culture) -WorkingDirectory $taskLocal -WindowStyle Hidden -PassThru
  $p.WaitForExit()
  Copy-Item -LiteralPath "$taskLocal/sample-tests.log" -Destination "$taskLocal/green-$cp-$culture.log"
  $log=Get-Content "$taskLocal/green-$cp-$culture.log" -Raw
  if($log -notmatch "PASS 35 NUMDBS=0 CULTURE=$culture"){throw "TT failed $cp $culture"}
  Write-Output $log.Trim()
 }
}
