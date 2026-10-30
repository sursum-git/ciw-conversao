$ErrorActionPreference='Stop'
$domainDir=Split-Path -Parent $PSScriptRoot
$local='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/comparison-after11/reader-local'
New-Item -ItemType Directory -Path $local -Force|Out-Null
$propath=($domainDir.Replace([char]92,[char]47)+'/candidate-exact,'+$domainDir.Replace([char]92,[char]47)+'/abl,'+$domainDir.Replace([char]92,[char]47)+'/test-inputs,'+$domainDir.Replace([char]92,[char]47)+'/tests/abl,'+$domainDir.Replace([char]92,[char]47)+'/includes,C:/Progress/OpenEdge/gui/netlib/OpenEdge.Net.pl,')
foreach($suite in @(@{file='ComparisonReaderTest.p';prefix='reader';count=13})) {
 $runner="PROPATH='"+$propath+"' + PROPATH.`nIF NUM-DBS<>0 THEN QUIT.`nSESSION:NUMERIC-FORMAT=SESSION:PARAMETER.`nRUN "+$suite.file+".`nQUIT.`n"
 [IO.File]::WriteAllText((Join-Path $local 'Run.p'),$runner,[Text.UTF8Encoding]::new($false))
 foreach($cp in @('UTF-8','ISO8859-1')){foreach($culture in @('AMERICAN','EUROPEAN')){
  $info=[Diagnostics.ProcessStartInfo]::new();$info.FileName='C:/Progress/OpenEdge/bin/_progres.exe';$info.WorkingDirectory=$local
  $arguments=@('-b','-cpinternal',$cp,'-cpstream','UTF-8','-p','Run.p','-param',$culture,'-T',$local)
  $info.Arguments=($arguments|ForEach-Object {'"'+$_+'"'})-join ' ';$info.UseShellExecute=$false;$info.CreateNoWindow=$true;$info.WindowStyle=[Diagnostics.ProcessWindowStyle]::Hidden
  $info.EnvironmentVariables['DLC']='C:/Progress/OpenEdge';$info.RedirectStandardOutput=$true;$info.RedirectStandardError=$true
  $process=[Diagnostics.Process]::Start($info);$stdout=$process.StandardOutput.ReadToEndAsync();$stderr=$process.StandardError.ReadToEndAsync()
  if(!$process.WaitForExit(35000)){throw 'Local TT timeout; inspect before retry'}
  [Threading.Tasks.Task]::WaitAll([Threading.Tasks.Task[]]@($stdout,$stderr));$text=$stdout.Result+$stderr.Result
  $name=$suite.prefix+'-'+$cp+'-'+$culture
  [IO.File]::WriteAllText((Join-Path $local ('process-'+$name+'.log')),$text,[Text.UTF8Encoding]::new($false))
  if($process.ExitCode -ne 0 -or $text -match '\*\*|ERROR|Exception'){throw ('Local TT process failed '+$name)};$process.Dispose()
  $sourceLog='comparison-reader-tests.log'
  $proof=Get-Content -LiteralPath (Join-Path $local $sourceLog) -Raw
  if($proof -notmatch ('PASS '+$suite.count+' checks') -or $proof -match 'FAIL'){throw ('Seam assertions failed '+$name+': '+$proof)}
  Copy-Item -LiteralPath (Join-Path $local $sourceLog) -Destination (Join-Path $local ($name+'.log'))
 }}
}
Write-Output 'PASS local12.8 ONLY reader13x4/NUMDBS0; no business or publication'
