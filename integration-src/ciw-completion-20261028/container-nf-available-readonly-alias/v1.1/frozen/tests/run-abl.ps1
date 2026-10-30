param([switch]$Red)
$ErrorActionPreference='Stop'
& 'C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/python/python.exe' (Join-Path $PSScriptRoot 'prepare.py') $(if($Red){'--red'}else{'--green'})
if($LASTEXITCODE -ne 0){throw 'prepare failed'}
$state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-nf-available-readonly-alias/v1.1';$stage=Join-Path $state $(if($Red){'red'}else{'local'})
function Run-Avm([string[]]$Arguments,[string]$Log){
 $info=New-Object Diagnostics.ProcessStartInfo;$info.FileName='C:/Progress/OpenEdge/bin/_progres.exe';$info.WorkingDirectory=$stage
 $info.Arguments=($Arguments|ForEach-Object {'"'+$_+'"'}) -join ' ';$info.UseShellExecute=$false;$info.CreateNoWindow=$true;$info.WindowStyle=[Diagnostics.ProcessWindowStyle]::Hidden
 $info.RedirectStandardOutput=$true;$info.RedirectStandardError=$true;$info.EnvironmentVariables['DLC']='C:/Progress/OpenEdge'
 $p=[Diagnostics.Process]::Start($info);$out=$p.StandardOutput.ReadToEndAsync();$err=$p.StandardError.ReadToEndAsync();if(!$p.WaitForExit(45000)){throw 'AVM timeout'};[Threading.Tasks.Task]::WaitAll([Threading.Tasks.Task[]]@($out,$err));[IO.File]::WriteAllText((Join-Path $stage $Log),$out.Result+$err.Result,[Text.UTF8Encoding]::new($false));if($p.ExitCode -ne 0){throw 'AVM nonzero'};$p.Dispose()
}
Run-Avm @('-b','-cpinternal','UTF-8','-cpstream','UTF-8','-p','Compile.p','-T',$stage) 'compile-process.log'
$compiled=Get-Content (Join-Path $stage 'compile.log') -Raw;if($compiled -notmatch 'PASS COMPILE'){throw $compiled}
foreach($cp in @('UTF-8','ISO8859-1')){foreach($culture in @('AMERICAN','EUROPEAN')){
 $common=@('-b','-cpinternal',$cp,'-cpstream','UTF-8','-numdec',$(if($culture -eq 'AMERICAN'){'46'}else{'44'}),'-numsep',$(if($culture -eq 'AMERICAN'){'44'}else{'46'}),'-T',$stage)
 Run-Avm ($common+@('-p','Execute.p')) ('alias-'+$cp+'-'+$culture+'-process.log')
 $alias=Get-Content (Join-Path $stage 'Execute.p.log') -Raw
 if($Red){if($alias -notmatch 'FAIL trailing alias must fail'){throw $alias}}
 elseif($alias -notmatch 'PASS EXECUTE NUMDBS=0'){throw $alias}
 Run-Avm ($common+@('-p','TimeoutExecute.p')) ('timeout-'+$cp+'-'+$culture+'-process.log')
 $timeout=Get-Content (Join-Path $stage 'TimeoutExecute.p.log') -Raw
 if($Red){if($timeout -notmatch 'FAIL timeout cause distinct'){throw $timeout}}
 elseif($timeout -notmatch 'PASS EXECUTE NUMDBS=0'){throw $timeout}
 Run-Avm ($common+@('-p','CauseExecute.p')) ('causes-'+$cp+'-'+$culture+'-process.log')
 $causes=Get-Content (Join-Path $stage 'CauseExecute.p.log') -Raw
 if($Red){if($causes -notmatch 'FAIL CONTAINER_NF_CANDIDATE_LIMIT'){throw $causes};[IO.File]::WriteAllText((Join-Path $stage 'expected-red.log'),$alias+$timeout+$causes);Write-Output 'PASS three REDs: trailing alias accepted; timeout/candidate causes generic';exit 0}
 if($causes -notmatch 'PASS EXECUTE NUMDBS=0'){throw $causes}
 $proof=$alias+$timeout+$causes
 foreach($name in @('alias-strict','alias-timeout','nf-available','container-panel-finance-tests')){$raw=Get-Content (Join-Path $stage ($name+'-'+$culture+'.log')) -Raw;if($raw -notmatch 'PASS' -or $raw -match 'FAIL'){throw $raw};$proof+=$raw}
 [IO.File]::WriteAllText((Join-Path $stage ('test-'+$cp+'-'+$culture+'.log')),$proof);Write-Output ($cp+' '+$culture+' '+($proof -replace "`r?`n",'; '))
}}
