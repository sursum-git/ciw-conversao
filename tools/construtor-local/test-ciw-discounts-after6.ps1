$ErrorActionPreference='Stop'
$stage='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/import-discounts-readonly/rebase-after6-local'
function Run-Local([string]$Program,[string]$Cp,[string]$Culture,[string]$Log){
 $info=New-Object Diagnostics.ProcessStartInfo;$info.FileName='C:/Progress/OpenEdge/bin/_progres.exe';$info.WorkingDirectory=$stage
 $info.Arguments='-b -cpinternal '+$Cp+' -cpstream UTF-8 -param '+$Culture+' -p '+$Program+' -T '+$stage
 $info.UseShellExecute=$false;$info.CreateNoWindow=$true;$info.WindowStyle=[Diagnostics.ProcessWindowStyle]::Hidden
 $info.RedirectStandardOutput=$true;$info.RedirectStandardError=$true;$info.EnvironmentVariables['DLC']='C:/Progress/OpenEdge'
 $proc=[Diagnostics.Process]::Start($info);$out=$proc.StandardOutput.ReadToEndAsync();$err=$proc.StandardError.ReadToEndAsync()
 if(!$proc.WaitForExit(35000)){throw 'Local AVM timeout'};[Threading.Tasks.Task]::WaitAll([Threading.Tasks.Task[]]@($out,$err))
 [IO.File]::WriteAllText((Join-Path $stage $Log),$out.Result+$err.Result,[Text.UTF8Encoding]::new($false));if($proc.ExitCode -ne 0){throw 'Local AVM error'};$proc.Dispose()
}
foreach($cp in @('UTF-8','ISO8859-1')){
 Run-Local 'Compile.p' $cp 'AMERICAN' ('compile-process-'+$cp+'.log')
 $compiled=Get-Content (Join-Path $stage 'compile.log') -Raw;if(([regex]::Matches($compiled,'ERROR=no')).Count -ne 9 -or $compiled -match 'ERROR=yes'){throw $compiled}
 Copy-Item (Join-Path $stage 'compile.log') (Join-Path $stage ('compile-'+$cp+'.log'))
 foreach($culture in @('AMERICAN','EUROPEAN')){
  $proof=''
  foreach($name in @('Collector','Read','Labels')){
   Run-Local ('Run'+$name+'.p') $cp $culture ('process-'+$name+'-'+$cp+'-'+$culture+'.log')
   $file=switch($name){'Collector'{'collector-tests.log'}'Read'{'read-tests.log'}'Labels'{'discount-labels-tests.log'}}
   $result=Get-Content (Join-Path $stage $file) -Raw;if($result -notmatch 'PASS' -or $result -match 'FAIL'){throw $result};$proof+=$result
  }
  [IO.File]::WriteAllText((Join-Path $stage ('green-'+$cp+'-'+$culture+'.log')),$proof,[Text.UTF8Encoding]::new($false));Write-Output $proof.Trim()
 }
}
