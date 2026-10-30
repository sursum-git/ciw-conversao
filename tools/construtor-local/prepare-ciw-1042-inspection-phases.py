"""Prepare fresh, timestamped RO inspection folders for the three scenario gates."""
from pathlib import Path
import hashlib,json
r=Path(__file__).resolve().parents[2];b=r/'.runtime/ciw-completion-20261028/batch1042-fixture-inspector-v3'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
artifact=sha(b/'FixtureInspector.r');log=(b/'compile.log').read_text()
assert 'OpenEdge 12.2'in log and 'ERROR=no'in log and 'PASS COMPILE'in log
for label,phase in [('empty-before-create','empty'),('owned-before-cleanup','owned'),('cleaned-after-cleanup','cleaned')]:
 local=b/label;local.mkdir();remote='C:/Users/tadeu.parreiras/codex-ciw-1042-v3-'+label
 extra="if($rows['pp-container'] -ne 1 -or $proof.markerExact -ne $true -or $rows['despesas_container'] -gt 22 -or $rows['calcs_imp_container'] -gt 4){throw 'Owned counts/marker outside approved scenario'}\nforeach($key in $rows.Keys){if($key -notin @('pp-container','despesas_container','calcs_imp_container') -and $rows[$key] -ne 0){throw 'Forbidden related records; no cleanup allowed'}}" if phase=='owned'else "if(@($proof.rows|Where-Object {$_.count -ne 0}).Count -ne 0){throw 'Fixture keys are not all absent'}"
 runner=f'''$ErrorActionPreference='Stop'
Set-Location -LiteralPath '{remote}'
if((Test-Path -LiteralPath 'inspection-started.json') -or (Test-Path -LiteralPath 'fixture-{phase}.json')){{throw 'Prior inspection exists; inspect outcome, never overwrite'}}
$expectedHash='{artifact.upper()}'
if((Get-FileHash -Algorithm SHA256 -LiteralPath FixtureInspector.r).Hash -ne $expectedHash){{throw 'Official artifact mismatch'}}
$started=[DateTimeOffset]::UtcNow.ToString('o')
[IO.File]::WriteAllText((Join-Path $PWD.Path 'inspection-started.json'),(@{{phase='{phase}';container_id=2147000110;startedAt=$started;businessWrites=$false}}|ConvertTo-Json))
$info=New-Object Diagnostics.ProcessStartInfo
$info.FileName='C:/Progress_12/OE/bin/_progres.exe';$info.WorkingDirectory=$PWD.Path
$info.Arguments='-b -db espec -H 192.168.0.111 -S 10012 -N TCP -ld espec -cpinternal UTF-8 -cpstream UTF-8 -p FixtureInspector.r -param {phase}'
$info.UseShellExecute=$false;$info.CreateNoWindow=$true;$info.WindowStyle=[Diagnostics.ProcessWindowStyle]::Hidden
$info.EnvironmentVariables['DLC']='C:/Progress_12/OE';$info.RedirectStandardOutput=$true;$info.RedirectStandardError=$true
$p=[Diagnostics.Process]::Start($info);$stdout=$p.StandardOutput.ReadToEndAsync();$stderr=$p.StandardError.ReadToEndAsync()
if(!$p.WaitForExit(35000)){{throw 'Inspection timeout; preserve process/journal and inspect before any retry'}}
[Threading.Tasks.Task]::WaitAll([Threading.Tasks.Task[]]@($stdout,$stderr))
[IO.File]::WriteAllText((Join-Path $PWD.Path 'process.log'),$stdout.Result+$stderr.Result)
if($p.ExitCode -ne 0){{throw 'Read-only inspection process failed'}}
$proof=Get-Content -LiteralPath 'fixture-{phase}.json' -Raw|ConvertFrom-Json
if($proof.success -ne $true -or $proof.numDbs -ne 1 -or $proof.container_id -ne 2147000110 -or $proof.phase -ne '{phase}' -or $proof.rows.Count -ne 12 -or $proof.indirectLedgerJoinEmptyItems -ne $true -or $proof.ledgerGlobalScan -ne $false -or $proof.businessWrites -ne $false){{throw 'Closed inspection unconfirmed'}}
$rows=@{{}};foreach($row in $proof.rows){{if($rows.ContainsKey($row.table)){{throw 'Duplicate table proof'}};$rows[$row.table]=$row.count}}
{extra}
$receipt=@{{success=$true;phase='{phase}';label='{label}';container_id=2147000110;startedAt=$started;completedAt=[DateTimeOffset]::UtcNow.ToString('o');artifactSha256=$expectedHash.ToLower();resultSha256=(Get-FileHash -Algorithm SHA256 -LiteralPath 'fixture-{phase}.json').Hash.ToLower();businessWrites=$false;ownershipOfRecordIdsClaimed=$false}}
[IO.File]::WriteAllText((Join-Path $PWD.Path 'inspection-receipt.json'),($receipt|ConvertTo-Json))
Write-Output 'PASS fixed1042 {label} read-only inspection; timestamped artifact/result receipt; no business writes'
'''
 (local/'Inspect.ps1').write_text(runner)
 plan=dict(server='compiler',directories=[remote],uploads=[dict(local=str((b/'FixtureInspector.r').relative_to(r)),remote=remote+'/FixtureInspector.r'),dict(local=str((local/'Inspect.ps1').relative_to(r)),remote=remote+'/Inspect.ps1')],commands=['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/Inspect.ps1'],downloads=[dict(local=str((local/n).relative_to(r)),remote=remote+'/'+n)for n in ['fixture-'+phase+'.json','inspection-receipt.json','process.log']])
 (local/'remote-plan.json').write_text(json.dumps(plan,indent=2)+'\n')
print('Prepared3 separate RO phase gates with actual run timestamps; execute only at the matching scenario phase')
