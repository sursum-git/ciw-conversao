param([ValidateSet('red','green')][string]$Phase = 'green')
$ErrorActionPreference = 'Stop'
$auditRemote = @'
$ErrorActionPreference='Stop'
$ProgressPreference='SilentlyContinue'
Set-Location 'C:\Users\tadeu.parreiras\codex-apis-audit-20261016'
$env:DLC='C:\Progress_12\OE'
$phase='__PHASE__'
$allPassed=$true
foreach($culture in @('AMERICAN','EUROPEAN')) {
  foreach($test in @(@('RunEmpresasCrudTests.p','empresas-tests'),@('TiposAnexoCrudTest.p','tipos-anexo-tests'))) {
    Remove-Item -LiteralPath 'compile-apis-audit.log',($test[1]+'.log') -ErrorAction SilentlyContinue
    & 'C:\Progress_12\OE\bin\_progres.exe' -b -cpinternal UTF-8 -cpstream UTF-8 -p CompileApisAuditTest.p -param ($test[0]+','+$culture) *> ('process-'+$test[1]+'-'+$culture+'.log')
    foreach($name in @('compile-apis-audit',$test[1])) {
      Write-Output ($name+' '+$culture)
      if(!(Test-Path -LiteralPath ($name+'.log'))) {throw ('Log ausente '+$name)}
      Get-Content -LiteralPath ($name+'.log')
      Copy-Item -LiteralPath ($name+'.log') -Destination ($name+'-'+$culture+'.log')
      Copy-Item -LiteralPath ($name+'.log') -Destination ($name+'-'+$culture+'-'+$phase+'.log')
      $lines=Get-Content -LiteralPath ($name+'.log')
      if($name -eq 'compile-apis-audit') {
        if(($lines -match 'COMPILER:ERROR=yes') -or ($lines -match '^FAIL:')) {$allPassed=$false}
      } elseif($phase -eq 'green') {
        if(!($lines -match '^PASS:') -or ($lines -match '^FAIL:')) {$allPassed=$false}
      } else {
        $expected=if($name -eq 'empresas-tests'){'^FAIL: create retorna snapshot transacional confirmado$'}else{'^FAIL: resposta confirmada inclui snapshot transacional$'}
        if(!($lines -match $expected)) {$allPassed=$false}
      }
    }
  }
}
if(!$allPassed){exit 1}
'@
$auditRemote=$auditRemote.Replace('__PHASE__',$Phase)
$auditEncoded=[Convert]::ToBase64String([Text.Encoding]::Unicode.GetBytes($auditRemote))
ssh tadeu.parreiras@192.168.0.42 "powershell -NoProfile -EncodedCommand $auditEncoded"
exit $LASTEXITCODE
