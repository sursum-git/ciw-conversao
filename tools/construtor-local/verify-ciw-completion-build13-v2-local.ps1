param([switch]$ContinueAfterFixtureRepair)
$ErrorActionPreference='Stop'
$build='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/official-build13-v2'
$local=Join-Path $build 'local/abl'
$stage=Join-Path $local 'package'
New-Item -ItemType Directory -Force $local | Out-Null
Copy-Item -LiteralPath (Join-Path $build 'package') -Destination $local -Recurse -Force
$programs=(Join-Path $stage 'sursum-api/programs').Replace([char]92,[char]47)
$classes=(Join-Path $stage 'sursum-api/sursum').Replace([char]92,[char]47)
$propath=$stage.Replace([char]92,[char]47)+','+$programs+','+$stage.Replace([char]92,[char]47)+'/sursum-api/includes,'+$classes+',C:/Progress/OpenEdge/gui/netlib/OpenEdge.Net.pl,'
function Avm([string]$entry,[string]$cp,[string]$parameters,[string]$label){
 $info=[Diagnostics.ProcessStartInfo]::new();$info.FileName='C:/Progress/OpenEdge/bin/_progres.exe';$info.WorkingDirectory=$local
 $info.Arguments='-b -cpinternal '+$cp+' -cpstream UTF-8 -p '+$entry+' -param '+$parameters+' -T "'+$local+'"';$info.UseShellExecute=$false;$info.CreateNoWindow=$true;$info.WindowStyle=[Diagnostics.ProcessWindowStyle]::Hidden;$info.EnvironmentVariables['DLC']='C:/Progress/OpenEdge'
 $p=[Diagnostics.Process]::Start($info);if(!$p.WaitForExit(55000)){$p.Kill();throw ('Local diagnostic timeout '+$label)};if($p.ExitCode -ne 0){Get-ChildItem -LiteralPath $local -Filter '*.log'|ForEach-Object{Get-Content -LiteralPath $_.FullName};throw ('Local AVM failed '+$label)};$p.Dispose()
}
$programNames=@('CiwErpReadService.p','CiwCadastrosCrud.p','CiwMedCompanyContext.p','ContainersPainelFinanceReadService.p','ContainersVersionHistoryLabels.p','ContainersVersionService.p','ContainersVersionHistoryService.p','ContainersVersionAuxHistoryService.p','ImportDiscountsCollector.p','ImportDiscountsReadService.p','CostDistributionEligibleCollector.p','CostDistributionEligibleReadService.p','CostDistributionLedgerCollector.p','CostDistributionLedgerReadService.p','SampleContainerItemsCollector.p','SampleContainerItemsReadService.p','ContainersVersionComparisonProjection.p','ContainersVersionComparisonMaterializer.p','ContainersVersionComparisonService.p','ContainersVersionComparisonApi.p','ContainersCustoCalculator.p','NfPageBudgetFixture.p','NfSlowReaderFixture.p')
$tests=Get-Content -Raw (Join-Path $build 'test-list.json')|ConvertFrom-Json
$lines=@('DEFINE VARIABLE n AS INTEGER NO-UNDO.',"PROPATH='$propath' + PROPATH.","OUTPUT TO 'compile-local.log'.","PUT UNFORMATTED PROVERSION ' NUMDBS=' NUM-DBS SKIP.","IF NUM-DBS<>0 THEN QUIT.")
foreach($name in @('PasoeRuntimeIdentity.cls','PasoeExecutionContext.cls')){
 $lines+="COMPILE '$name' SAVE INTO '$classes' NO-ERROR."
 $lines+="PUT UNFORMATTED '$name ERROR=' COMPILER:ERROR SKIP."
 $lines+='DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-NUMBER(n) " " ERROR-STATUS:GET-MESSAGE(n) SKIP. END.'
}
foreach($name in $programNames){
 $lines+="COMPILE '$programs/$name' SAVE INTO '$programs' NO-ERROR."
 $lines+="PUT UNFORMATTED '$name ERROR=' COMPILER:ERROR SKIP."
 $lines+='DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-NUMBER(n) " " ERROR-STATUS:GET-MESSAGE(n) SKIP. END.'
}
# Root copies are intentional: existing TT sources RUN their .p names directly.
foreach($name in @('CiwErpReadService.p','ContainersPainelFinanceReadService.p','CiwMedCompanyContext.p')+@($tests|ForEach-Object{$_.file})+@('ContainersVersionFixture.p')){
 $source=$stage.Replace([char]92,[char]47)+'/'+$name
 $lines+="COMPILE '$source' SAVE INTO '$($stage.Replace([char]92,[char]47))' NO-ERROR."
 $lines+="PUT UNFORMATTED '$name ERROR=' COMPILER:ERROR SKIP."
 $lines+='DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-NUMBER(n) " " ERROR-STATUS:GET-MESSAGE(n) SKIP. END.'
}
$lines+='OUTPUT CLOSE. QUIT.'
[IO.File]::WriteAllText((Join-Path $local 'CompileLocal.p'),($lines -join "`n"),[Text.UTF8Encoding]::new($false))
if(!$ContinueAfterFixtureRepair){Avm 'CompileLocal.p' 'UTF-8' 'AMERICAN' 'compile'}
$compile=Get-Content -Raw (Join-Path $local 'compile-local.log');$expectedCompiles=2+$programNames.Count+3+$tests.Count+1
if($compile -match 'ERROR=yes' -or ([regex]::Matches($compile,'ERROR=no')).Count -ne $expectedCompiles -or $compile -notmatch '12.8 NUMDBS=0'){Write-Output $compile;throw 'Local diagnostic compile failed'}
$total=0;$logs=@()
foreach($test in $tests){foreach($cp in @('UTF-8','ISO8859-1')){foreach($culture in @('AMERICAN','EUROPEAN')){
 $existingName=$test.file.Replace('.p','')+'-'+$cp+'-'+$culture+'.log'
 $existing=Join-Path $build ('local/logs/'+$existingName)
 if($ContinueAfterFixtureRepair -and $test.file -in @('ComparisonProjectionTest.p','ComparisonRoundingEvidenceTest.p','ComparisonItemJoinTest.p','ComparisonMaterializerTest.p','ComparisonReaderTest.p')){
  $prior=Get-Content -Raw $existing
  if($prior -notmatch ('PASS:? '+$test.checks+'(?:\s|$)') -or $prior -match 'FAIL'){throw 'Cannot reuse a failed prior local log'}
  $total+=$test.checks;$logs+=@{file=$existingName;checks=$test.checks;sha256=(Get-FileHash -LiteralPath $existing -Algorithm SHA256).Hash.ToLowerInvariant();reusedBeforeJsonFixtureRepair=$true};continue
 }
 $run=@("PROPATH='$propath' + PROPATH.","IF NUM-DBS<>0 THEN QUIT.","SESSION:NUMERIC-FORMAT=SESSION:PARAMETER.","RUN $($test.file).","QUIT.")
 [IO.File]::WriteAllText((Join-Path $local 'RunLocal.p'),($run -join "`n"),[Text.UTF8Encoding]::new($false))
 Avm 'RunLocal.p' $cp $culture $test.file
 $path=Join-Path $local $test.output.Replace('{culture}',$culture)
 if(!(Test-Path -LiteralPath $path)){Get-ChildItem -LiteralPath $local -Filter '*.log'|ForEach-Object{Get-Content -LiteralPath $_.FullName};throw ('Missing log '+$test.file)}
 $text=Get-Content -Raw $path
 if($text -notmatch ('PASS:? '+$test.checks+'(?:\s|$)') -or $text -match 'FAIL'){Write-Output $text;throw ('Test failed '+$test.file)}
 $name=$test.file.Replace('.p','')+'-'+$cp+'-'+$culture+'.log';$dest=Join-Path $build ('local/logs/'+$name);New-Item -ItemType Directory -Force (Split-Path -Parent $dest)|Out-Null;Copy-Item -LiteralPath $path -Destination $dest -Force
 $total+=$test.checks;$logs+=@{file=$name;checks=$test.checks;sha256=(Get-FileHash -LiteralPath $dest -Algorithm SHA256).Hash.ToLowerInvariant()}
}}}
if($total -ne 8020 -or $logs.Count -ne 88){throw 'Unexpected diagnostic totals'}
foreach($part in @('first','second','filtered','desc')){Copy-Item -LiteralPath (Join-Path $local ('nf-page-native-'+$part+'.json')) -Destination (Join-Path $build ('local/nf-page-native-'+$part+'.json')) -Force}
$response=Get-Content -Raw (Join-Path $local 'comparison-service-actual.json')|ConvertFrom-Json
$rowJson=ConvertTo-Json -InputObject $response.data[0] -Depth 20
[IO.File]::WriteAllText((Join-Path $build 'tests/php/reader-row.json'),$rowJson,[Text.UTF8Encoding]::new($false))
$proof=@{success=$true;official122=$false;diagnostic='12.8';NUMDBS=0;compiles=$expectedCompiles;suites=$tests.Count;checks=$total;logs=$logs;noNetwork=$true;noBusiness=$true}
[IO.File]::WriteAllText((Join-Path $build 'local/abl-proof.json'),(ConvertTo-Json $proof -Depth 20),[Text.UTF8Encoding]::new($false))
Write-Output ('PASS diagnostic12.8 '+$expectedCompiles+'compiles/22suites/88logs/8020checks NUMDBS0')
