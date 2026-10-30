param([ValidateSet('red','green')][string]$Phase='red')
$ErrorActionPreference='Stop'
$domainDir=Split-Path -Parent $PSScriptRoot
$local='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/comparison-orphan-read-policy/v1/'+$Phase
$package=Join-Path $local 'package'
$programs=Join-Path $package 'sursum-api/programs'
New-Item -ItemType Directory -Force $programs | Out-Null
Copy-Item -LiteralPath (Join-Path $domainDir 'test-inputs/sursum-api') -Destination $package -Recurse -Force
foreach($name in @('ContainersVersionService.p','ContainersVersionComparisonService.p')){
 $inputDirectory=if($Phase -eq 'red'){'baseline-exact/'}else{'candidate-exact/'}
 Copy-Item -LiteralPath (Join-Path $domainDir ($inputDirectory+$name)) -Destination (Join-Path $programs $name) -Force
}
$domainSlash=$domainDir.Replace([char]92,[char]47)
$packageSlash=$package.Replace([char]92,[char]47)
$propath=$packageSlash+','+$packageSlash+'/sursum-api/programs,'+$domainSlash+'/tests,'+$domainSlash+'/test-inputs,C:/Progress/OpenEdge/gui/netlib/OpenEdge.Net.pl,'
function Avm([string]$entry,[string]$cp,[string]$culture,[string]$label){
 $info=[Diagnostics.ProcessStartInfo]::new();$info.FileName='C:/Progress/OpenEdge/bin/_progres.exe';$info.WorkingDirectory=$local
 $info.Arguments='-b -cpinternal '+$cp+' -cpstream UTF-8 -p '+$entry+' -param '+$culture+' -T "'+$local+'"';$info.UseShellExecute=$false;$info.CreateNoWindow=$true;$info.WindowStyle=[Diagnostics.ProcessWindowStyle]::Hidden;$info.EnvironmentVariables['DLC']='C:/Progress/OpenEdge'
 $p=[Diagnostics.Process]::Start($info); if(!$p.WaitForExit(35000)){ $p.Kill(); throw 'Local diagnostic timeout' };if($p.ExitCode -ne 0){throw ('Local AVM exit failure '+$label)};$p.Dispose()
}
$compiles=if($Phase -eq 'red'){@('ContainersVersionService.p')}else{@('ContainersVersionService.p','CiwErpReadService.p','ContainersVersionHistoryLabels.p','ContainersVersionHistoryService.p','ContainersVersionAuxHistoryService.p','ContainersVersionComparisonProjection.p','ContainersVersionComparisonMaterializer.p','ContainersVersionComparisonService.p')}
$lines=@("DEFINE VARIABLE n AS INTEGER NO-UNDO.","PROPATH='$propath' + PROPATH.","OUTPUT TO 'compile.log'.","PUT UNFORMATTED PROVERSION ' NUMDBS=' NUM-DBS SKIP.","IF NUM-DBS<>0 THEN QUIT.")
foreach($name in $compiles){
 $source=(Join-Path $programs $name).Replace([char]92,[char]47)
 $lines+="COMPILE '$source' SAVE INTO '$($programs.Replace([char]92,[char]47))' NO-ERROR."
 $lines+="PUT UNFORMATTED '$name ERROR=' COMPILER:ERROR SKIP."
 $lines+='DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-NUMBER(n) " " ERROR-STATUS:GET-MESSAGE(n) SKIP. END.'
}
$lines+='OUTPUT CLOSE. QUIT.'
[IO.File]::WriteAllText((Join-Path $local 'Compile.p'),($lines -join "`n"),[Text.UTF8Encoding]::new($false))
Avm 'Compile.p' 'UTF-8' 'AMERICAN' 'compile'
$compile=Get-Content -Raw (Join-Path $local 'compile.log')
if($compile -match 'ERROR=yes' -or ([regex]::Matches($compile,'ERROR=no')).Count -ne $compiles.Count -or $compile -notmatch '12.8 NUMDBS=0'){throw 'Local compile failed; inspect log'}
$suites=@(@{name='OrphanVersionReadPolicyTest.p';output='orphan-read-policy-tests.log'})
if($Phase -eq 'green'){
 $suites+=@(@{name='ComparisonOrphanServiceTest.p';output='comparison-service-tests.log'},@{name='ContainersVersionTest.p';output='containers-version-tests-{culture}.log'},@{name='ContainersVersionHistoryTest.p';output='container-version-history-tests.log'},@{name='ContainersVersionAuxHistoryTest.p';output='container-version-aux-history-tests.log'},@{name='CiwErpReadTest.p';output='erp-read-{culture}.log'},@{name='PurchaseItemsReadTest.p';output='purchase-item-read-{culture}.log'})
}
foreach($suite in $suites){foreach($cp in @('UTF-8','ISO8859-1')){foreach($culture in @('AMERICAN','EUROPEAN')){
 $run=@("PROPATH='$propath' + PROPATH.","IF NUM-DBS<>0 THEN QUIT.","SESSION:NUMERIC-FORMAT=SESSION:PARAMETER.","RUN $($suite.name).","QUIT.")
 [IO.File]::WriteAllText((Join-Path $local 'Run.p'),($run -join "`n"),[Text.UTF8Encoding]::new($false))
 Avm 'Run.p' $cp $culture $suite.name
 $outputName=$suite.output.Replace('{culture}',$culture);$output=Join-Path $local $outputName
 if(!(Test-Path -LiteralPath $output)){throw ('Missing suite log '+$suite.name)}
 $raw=Get-Content -Raw $output
 Copy-Item -LiteralPath $output -Destination (Join-Path $local ($suite.name.Replace('.p','')+'-'+$cp+'-'+$culture+'.log')) -Force
 if($Phase -eq 'red'){if($raw -notmatch 'FAIL checks=5 .*private selected-version read accepts real orphan snapshot'){throw ('Wrong RED failure: '+$raw)}}
 elseif($raw -notmatch 'PASS \d+(?:\s|$)' -or $raw -match 'FAIL'){throw ('Local suite failed '+$suite.name+': '+$raw)}
}}}
Write-Output ('PASS diagnostic12.8 '+$Phase+' compile='+$compiles.Count+' logs='+($suites.Count*4)+' NUMDBS0; no official compile/network/business.')
