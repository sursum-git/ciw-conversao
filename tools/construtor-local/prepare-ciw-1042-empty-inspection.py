"""Prepare a single read-only absence check, using recovered official12.2 output."""
from pathlib import Path
import json,hashlib
r=Path(__file__).resolve().parents[2];b=r/'.runtime/ciw-completion-20261028/batch1042-fixture-inspector-v2'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert sha(b/'FixtureInspector.p')=='422a40106069ba3b5ca59843ee12ef818b2f5e829c87f7b71545009866b9ed74'
assert sha(b/'FixtureInspector.r')=='f93a2aac0c828aac4dcbf975b6a9ecbe2d40a16ff13ab1355c06d5f7a6bedc8e'
log=(b/'compile.log').read_text();assert all(x in log for x in ['OpenEdge 12.2','NUMDBS=0','ERROR=no','PASS COMPILE'])
assert (b/'compile-stderr.log').read_bytes()==b''
(b/'official-compile-verification.json').write_text(json.dumps(dict(success=True,version='12.2',numDbs=0,sourceSha256=sha(b/'FixtureInspector.p'),rcodeSha256=sha(b/'FixtureInspector.r'),compileLogSha256=sha(b/'compile.log'),wrapperReportedFailure=True,wrapperExitCodeUnconfirmed=True,compilerSuccessIndependentlyVerified=True,recompiled=False,sourceAndRcodeRemoteHashesMatched=True,downloadOnlySession=85774,businessExecuted=False),indent=2)+'\n')
remote='C:/Users/tadeu.parreiras/codex-ciw-1042-fixture-inspector-v2'
runner=f'''$ErrorActionPreference='Stop'
Set-Location -LiteralPath '{remote}'
if((Test-Path -LiteralPath fixture-empty.json) -or (Test-Path -LiteralPath inspect-empty-attempt.json)){{throw 'Prior inspection exists; do not replay'}}
if((Get-FileHash -Algorithm SHA256 -LiteralPath FixtureInspector.r).Hash -ne 'F93A2AAC0C828AAC4DCBF975B6A9ECBE2D40A16FF13AB1355C06D5F7A6BEDC8E'){{throw 'Official artifact mismatch'}}
[IO.File]::WriteAllText((Join-Path $PWD.Path 'inspect-empty-attempt.json'),'{{"phase":"empty","container_id":2147000110,"businessWrites":false}}')
$info=New-Object Diagnostics.ProcessStartInfo
$info.FileName='C:/Progress_12/OE/bin/_progres.exe';$info.WorkingDirectory=$PWD.Path
$info.Arguments='-b -db espec -H 192.168.0.111 -S 10012 -N TCP -ld espec -cpinternal UTF-8 -cpstream UTF-8 -p FixtureInspector.r -param empty'
$info.UseShellExecute=$false;$info.CreateNoWindow=$true;$info.WindowStyle=[Diagnostics.ProcessWindowStyle]::Hidden
$info.EnvironmentVariables['DLC']='C:/Progress_12/OE';$info.RedirectStandardOutput=$true;$info.RedirectStandardError=$true
$p=[Diagnostics.Process]::Start($info);$stdout=$p.StandardOutput.ReadToEndAsync();$stderr=$p.StandardError.ReadToEndAsync()
if(!$p.WaitForExit(35000)){{throw 'Read-only inspector timeout'}}
[Threading.Tasks.Task]::WaitAll([Threading.Tasks.Task[]]@($stdout,$stderr))
[IO.File]::WriteAllText((Join-Path $PWD.Path 'inspect-empty-process.log'),$stdout.Result+$stderr.Result)
if($p.ExitCode -ne 0){{throw 'Read-only inspector process failed'}}
$proof=Get-Content -LiteralPath fixture-empty.json -Raw|ConvertFrom-Json
if($proof.success -ne $true -or $proof.numDbs -ne 1 -or $proof.container_id -ne 2147000110 -or $proof.phase -ne 'empty' -or $proof.rows.Count -ne 13 -or $proof.businessWrites -ne $false -or $proof.readRows -ne 0 -or @($proof.rows|Where-Object {{$_.count -ne 0}}).Count -ne 0){{throw 'Fixture is not proven completely absent; no mutation permitted'}}
Write-Output 'PASS13fixedtable counts allzero for2147000110; read-only; no triggers or business writers explicitly called'
'''
(b/'InspectEmpty.ps1').write_text(runner)
plan=dict(server='compiler',uploads=[dict(local=str((b/'InspectEmpty.ps1').relative_to(r)),remote=remote+'/InspectEmpty.ps1')],commands=['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/InspectEmpty.ps1'],downloads=[dict(local=str((b/n).relative_to(r)),remote=remote+'/'+n)for n in ['fixture-empty.json','inspect-empty-process.log']])
(b/'inspect-empty-plan.json').write_text(json.dumps(plan,indent=2)+'\n')
print('Prepared closed read-only13table absence check; compiler success verified without recompilation; no business scenario executed')
