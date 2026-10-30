$ErrorActionPreference='Stop'
$domainDir=Split-Path -Parent $PSScriptRoot
$local='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/comparison-after11/service-local'
$target=Join-Path $local 'package/sursum-api/programs'
New-Item -ItemType Directory -Path $target -Force|Out-Null
$paths=@('test-inputs/ContainersVersionService.p','candidate-exact/CiwErpReadService.p','candidate-exact/ContainersVersionHistoryLabels.p','candidate-exact/CiwCadastrosCrud.p','abl/ContainersVersionComparisonProjection.p','abl/ContainersVersionComparisonMaterializer.p','abl/ContainersVersionComparisonService.p','abl/ContainersVersionComparisonApi.p')
$rootPath=$domainDir.Replace([char]92,[char]47)
$propath=$local.Replace([char]92,[char]47)+'/package,'+$rootPath+'/candidate-exact,'+$rootPath+'/abl,'+$rootPath+'/test-inputs,'+$rootPath+'/includes,C:/Progress/OpenEdge/gui/netlib/OpenEdge.Net.pl,'
$lines=@("DEFINE VARIABLE n AS INTEGER NO-UNDO.","PROPATH='$propath' + PROPATH.","OUTPUT TO 'compile-service-current.log'.","PUT UNFORMATTED PROVERSION ' NUMDBS=' NUM-DBS SKIP.","IF NUM-DBS<>0 THEN QUIT.")
foreach($file in $paths){
 $source=(Join-Path $domainDir $file).Replace([char]92,[char]47)
 $name=Split-Path -Leaf $source
 $outPath=$target.Replace([char]92,[char]47)
 $lines+="COMPILE '$source' SAVE INTO '$outPath' NO-ERROR."
 $lines+="PUT UNFORMATTED 'FILE=$name ERROR=' COMPILER:ERROR SKIP."
 $lines+='DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-NUMBER(n) SKIP. END.'
}
$lines+='OUTPUT CLOSE. QUIT.'
[IO.File]::WriteAllText((Join-Path $local 'CompileCurrent.p'),($lines -join "`n"),[Text.UTF8Encoding]::new($false))
$info=[Diagnostics.ProcessStartInfo]::new();$info.FileName='C:/Progress/OpenEdge/bin/_progres.exe';$info.WorkingDirectory=$local
$info.Arguments='-b -cpinternal UTF-8 -cpstream UTF-8 -p CompileCurrent.p -T "'+$local+'"';$info.UseShellExecute=$false;$info.CreateNoWindow=$true;$info.WindowStyle=[Diagnostics.ProcessWindowStyle]::Hidden;$info.EnvironmentVariables['DLC']='C:/Progress/OpenEdge'
$process=[Diagnostics.Process]::Start($info);if(!$process.WaitForExit(35000)){throw 'Local diagnostic compile timeout'}
$proof=Get-Content -Raw (Join-Path $local 'compile-service-current.log')
if($process.ExitCode -ne 0 -or $proof -match 'ERROR=yes' -or ([regex]::Matches($proof,'ERROR=no')).Count -ne $paths.Count -or $proof -notmatch '12.8 NUMDBS=0'){throw 'Local diagnostic compile failed; inspect its log'}
$process.Dispose()
Write-Output 'PASS local12.8 ONLY 8 compiles/NUMDBS0. No official artifact, connection, business or publication.'
